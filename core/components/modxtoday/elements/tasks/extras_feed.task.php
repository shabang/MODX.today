<?php
/**
 * @var modX $modx
 * @var sTask $task
 * @var sTaskRun $run
 */

$task->schedule('+1 hour');

$corePath = $modx->getOption('contentblocks.core_path', null, MODX_CORE_PATH . 'components/contentblocks/') . 'model/contentblocks/';
/** @var ContentBlocks $contentBlocks */
$contentBlocks = $modx->getService('contentblocks', 'ContentBlocks', $corePath);
if (!$contentBlocks) {
    $run->addError('service_not_loaded', array(
        'message' => 'Could not load ContentBlocks service.',
        'path' => $corePath
    ));
    return false;
}

/**
 * @param modTransportProvider $provider
 * @param $packageInfo
 * @return bool|string
 */
function getPackageLink(modTransportProvider $provider, $packageInfo) {
    $signature = $packageInfo['signature'];
    $lcaseName = substr($signature, 0, strpos($signature, '-'));
    switch ($provider->get('name')) {
        case 'modmore.com':
            return 'https://www.modmore.com/extras/' . $lcaseName . '/?pk_campaign=releaserobotrobbie&pk_kwd=releases_' . date('W') . '_' . $lcaseName;

        case 'modx.com':
            return 'http://modx.com/extras/package/' . $lcaseName . '?utm_source=modxtoday&utm_medium=releaserobotrobbie&utm_campaign=releases_' . date('W') . '&utm_term=' . $lcaseName;

        case 'extras.io':
            return 'https://extras.io/extras/' . $lcaseName . '?utm_source=modxtoday&utm_medium=releaserobotrobbie&utm_campaign=releases_' . date('W') . '&utm_term=' . $lcaseName;
    }

    return false;
}

require_once dirname(dirname(dirname(__FILE__))) . '/model/htmlpurifier-4.6.0/library/HTMLPurifier.auto.php';
/**
 * @param modTransportProvider $provider
 * @param $changelog
 * @return string
 */
function prepareChangelog(modTransportProvider $provider, $changelog)  {
    $changelog = str_replace(array('[',']'), array('&#91;','&#93;'), $changelog);
    if ($provider->get('name') === 'modmore.com') {
        // Changelogs are trusted from modmore.com, and in a plain text form.
        // We process these into nicely formatted HTML here.
        $changelogRaw = explode("\n", $changelog);
        $output = array();

        $ulLevel = 0;
        foreach ($changelogRaw as $line) {
            $thisUlLevel = 0;
            while (substr(ltrim($line), 0 , 1) == '-') {
                $thisUlLevel++;
                $line = substr(trim($line), 1);
            }
            if ($thisUlLevel > $ulLevel) {
                $output[] = str_repeat('<ul>', $thisUlLevel - $ulLevel);
            }
            elseif ($thisUlLevel < $ulLevel) {
                $output[] = str_repeat('</ul>', $ulLevel - $thisUlLevel);
            }

            if ($thisUlLevel > 0) {
                $output[] = '<li>' . $line . '</li>';
            }
            elseif (!empty($line)) {
                $output[] = '<p><b>' . $line . '</b></p>';
            }

            $ulLevel = $thisUlLevel;
        }
        while ($ulLevel > 0) {
            $output[] = '</ul>';
            $ulLevel--;
        }

        $output = implode("\n", $output);
        return $output;
    }

    // Other sources may not be trusted, and contain raw HTML, so we purify the HTML here.
    $config = HTMLPurifier_Config::createDefault();
    $config->set('CSS.AllowedProperties', array());
    $config->set('AutoFormat.RemoveEmpty', true);
    $config->set('Attr.AllowedClasses', array());
    $purifier = new HTMLPurifier($config);
    return $purifier->purify($changelog);
}

$providers = array(
    'modmore.com',
    'modx.com',
    'extras.io', // doesn't provide a changelog yet
);

$startOfWeek = mktime(0, 0, 0, date("n"), date("j") - date("N") + 1);
$startOfWeekDate = strftime('%B %d, %Y', $startOfWeek);

$newPackages = array();

foreach ($providers as $providerName) {
    /** @var modTransportProvider $provider */
    $modx->loadClass('transport.modTransportProvider');
    $provider = $modx->getObject('transport.modTransportProvider', array('name' => $providerName));
    if (!$provider) {
        $run->addError('provider_not_found:'.$providerName, array(
            'message' => 'Could not find a provider with the specified name to fetch packages from.',
            'name' => $providerName
        ));
        continue;
    }
    /** @var modProcessorResponse $result */
    $result = $modx->runProcessor('workspace/packages/rest/getinfo', array(
        'provider' => $provider->get('id'),
    ));

    if ($result && !$result->isError()) {
        $data = $result->getObject();
        if (isset($data['newest']) && is_array($data['newest'])) {
            $newest = array_reverse($data['newest']);
            foreach ($newest as $newPkg) {
                // Only deal with releases from the last week
                $releasedOn = strtotime($newPkg['releasedon']);
                if ($releasedOn < $startOfWeek) {
                    continue;
                }

                // Create the new package array
                $name = $newPkg['package_name'];
                if (empty($name)) {
                    $name = $newPkg['name'];
                }
                $newPackage = array(
                    'package_name' => $name,
                    'version' => trim(substr($newPkg['name'], strlen($name))),
                    'changelog' => '',
                    'link' => '',
                    'releasedon' => date('Y-m-d', $releasedOn)
                );

                // Get more information from the provider; in particular the changelog and info to create a link
                $packageInfo = $modx->runProcessor('workspace/packages/rest/getlist', array(
                    'provider' => $provider->get('id'),
                    'query' => $name
                ));
                $packageResults = $modx->fromJSON($packageInfo->response);

                // Try to find the specified package.
                $package = false;
                foreach ($packageResults['results'] as $info) {
                    if ($info['name'] == $name) {
                        $package = $info;
                    }
                }

                // If we found no exact match, try for something that starts with the right name.
                if (!$package) {
                    $nameLength = strlen($name);
                    foreach ($packageResults['results'] as $info) {
                        $partialName = substr($info['name'], 0, $nameLength);
                        if ($partialName == $name) {
                            $package = $info;
                        }
                    }
                }

                // If we have the package, add more info
                if ($package) {
                    $link = getPackageLink($provider, $package);
                    if ($link) {
                        $newPackage['link'] = $link;
                    }
                    $newPackage['changelog'] = prepareChangelog($provider, $package['changelog']);
                    if (empty($newPackage['changelog'])) {
                        $newPackage['changelog'] = '<p><em>There is no changelog available for this release.</em></p>';
                    }
                    $newPackage['version'] = $package['version-compiled'];
                }

                // Add it to the list
                $newPackages[$name] = $newPackage;

                // Delay processing for 0.3s to not hit external services _too_ quickly
                usleep(300000);
            }
        }
    }
}

$isNew = false;

$c = $modx->newQuery('modResource');
$c->where(array(
    'parent:=' => 1,      // Posts container
    'AND:template:=' => 8,    // Article - Extras Feed template
    'AND:publishedon:>=' => $startOfWeek
));

/** @var modResource $resource */
$resource = $modx->getObject('modDocument', $c);

if (!$resource) {
    $isNew = true;
    $resource = $modx->newObject('modDocument');
    $resource->fromArray(array(
        'parent' => 1,
        'template' => 8,
        'createdon' => time(),
        'pagetitle' => 'Extra Updates for Week&nbsp;' . date('W')
    ));
    $resource->set('alias', $resource->cleanAlias($resource->get('pagetitle')));
    $resource->save();
    $resource->set('description', 'Our loyal Release Robot Robbie has compiled a list of new and updated MODX Extras in the week of ' . $startOfWeekDate . '. The updates this week include [[getReleases? &resource=`' . $resource->get('id') . '`]].');
    $resource->set('introtext', '<p>Our loyal Release Robot Robbie has compiled a list of new and updated MODX Extras in the week of ' . $startOfWeekDate . '. The updates this week include [[getReleases? &resource=`' . $resource->get('id') . '`]].</p>');
    $resource->setTVValue('author', 'robbie');

    $blankContent = $modx->toJSON($contentBlocks->getDefaultCanvas($resource, 'Our loyal Release Robot Robbie has compiled a list of new and updated MODX Extras in the week of ' . $startOfWeekDate . '.'));
    $resource->setProperties(array(
        'content' => $blankContent,
        '_isContentBlocks' => true,
    ), 'contentblocks', true);

    $resource->save();
}


$cbContent = $resource->getProperty('content', 'contentblocks');
$cbContent = $modx->fromJSON($cbContent);

$changed = false;
foreach ($cbContent as $layoutIdx => $layout) {
    foreach ($layout['content'] as $columnKey => $fields) {
        foreach ($fields as $fieldIdx => $field) {
            if ($field['field'] === 12) {

                foreach ($newPackages as $name => $info) {

                    $found = false;
                    foreach ($field['rows'] as $idx => $fieldRow) {
                        if ($fieldRow['package_name']['value'] == $name) {
                            $found = true;
                            // Only update if the version is different
                            if ($fieldRow['version']['value'] != $info['version']) {
                                $cbContent[$layoutIdx]['content'][$columnKey][$fieldIdx]['rows'][$idx]['version']['value'] = $info['version'];
                                $cbContent[$layoutIdx]['content'][$columnKey][$fieldIdx]['rows'][$idx]['changelog']['value'] = $info['changelog'];
                                $cbContent[$layoutIdx]['content'][$columnKey][$fieldIdx]['rows'][$idx]['link']['value'] = $info['link'];
                                $cbContent[$layoutIdx]['content'][$columnKey][$fieldIdx]['rows'][$idx]['releasedon']['value'] = $info['releasedon'];
                            }
                        }
                    }

                    if (!$found) {
                        $newRow = array(
                            'package_name' => array(
                                'value' => $info['package_name'],
                                'fieldId' => 'contentblocks-imported-field-' . $info['package_name'] . '-package_name'
                            ),
                            'version' => array(
                                'value' => $info['version'],
                                'fieldId' => 'contentblocks-imported-field-' . $info['package_name'] . '-version'
                            ),
                            'changelog' => array(
                                'value' => $info['changelog'],
                                'fieldId' => 'contentblocks-imported-field-' . $info['package_name'] . '-changelog'
                            ),
                            'link' => array(
                                'link' => $info['link'],
                                'linkType' => 'link',
                                'fieldId' => 'contentblocks-imported-field-' . $info['package_name'] . '-link'
                            ),
                            'releasedon' => array(
                                'value' => $info['releasedon'],
                                'fieldId' => 'contentblocks-imported-field-' . $info['package_name'] . '-releasedon'
                            ),
                        );
                        $cbContent[$layoutIdx]['content'][$columnKey][$fieldIdx]['rows'][] = $newRow;
                    }

                }

                break;
            }
        }
    }
}

$modx->getParser();
$contentBlocks->loadInputs();
$contentBlocks->loadParser();

$jsonContent = $modx->toJSON($cbContent);
$resource->setProperty('content', $jsonContent, 'contentblocks');

$contentBlocks->setResource($resource);
$summary = $contentBlocks->summarizeContent($cbContent);
$resource->setProperties(array(
    'linear' => $summary['linear'],
    'fieldcounts' => $summary['fieldcounts'],
), 'contentblocks', true);

$parsedContent = $contentBlocks->generateHtml($cbContent);
$resource->setContent($parsedContent);

if (!$resource->get('published') && count($newPackages) > 0) {
    $resource->set('published', true);
    $resource->set('publishedon', time());
    $resource->set('publishedby', 1);

    if (strpos($resource->get('alias'),'/') === false) {
        $root = $modx->makeUrl(1);
        $publishedon = strtotime($resource->get('publishedon'));
        $alias = strftime('%Y',$publishedon) . '/' . strftime('%m',$publishedon) . '/' . $resource->get('alias');
        $resource->set('alias', $alias);
        $resource->set('uri', $root . $alias);
    }

}

$resource->save();



$modx->getCacheManager()->delete('web/resources/' . $resource->id, array(
    xPDO::OPT_CACHE_KEY => 'resource'
));
$modx->cacheManager->delete('articles-grid/', array(
    xPDO::OPT_CACHE_KEY => 'default'
));
if ($isNew) {
    $modx->cacheManager->delete($resource->get('context_key'), array(
        xPDO::OPT_CACHE_KEY => 'context_settings'
    ));
}

$path = $modx->getOption('scheduler.core_path', null, $modx->getOption('core_path') . 'components/scheduler/');
$scheduler = $modx->getService('scheduler', 'Scheduler', $path . 'model/scheduler/');
if (!$scheduler) {
    return;
}
$task = $scheduler->getTask('gitifywatch', 'extract');
if ($task instanceof sTask) {
    $trigger = array(
        'username' => 'Release Robot Robbie',
        'mode' => $isNew ? 'created' : 'updated',
        'target' => $resource->get('pagetitle'),
        'partition' => 'content',
    );

    // Try to find one already scheduled
    $extract = $modx->getObject('sTaskRun', array(
        'task' => $task->get('id'),
        'status' => sTaskRun::STATUS_SCHEDULED,
    ));

    if ($extract instanceof sTaskRun) {
        $data = $extract->get('data');
        $data['triggers'][] = $trigger;
        $extract->set('data', $data);
        $extract->save();
    } else {
        $task->schedule(time() - 60, array(
            'triggers' => array($trigger),
        ));
    }
}

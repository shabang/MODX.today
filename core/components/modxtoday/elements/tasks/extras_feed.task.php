<?php
/**
 * @var modX $modx
 * @var sTask $task
 * @var sTaskRun $run
 */

$task->schedule(time() - 60);

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

$providers = array(
    'modx.com' => array(
        'url' => 'http://rest.modx.com/extras/',
    ),
    'modmore.com' => array(
        'url' => 'https://rest.modmore.com/',
        'username' => '',
        'apikey' => '',
    )
);

$monday = mktime(0, 0, 0, date("n"), date("j") - date("N") + 1);

$newPackages = array(
    'FormIt' => array(
        'package_name' => 'FormIt',
        'version' => '2.2.7',
        'changelog' => 'awesome updates',
        'link' => 'google.com/formit',
        'releasedon' => '2015-05-22',
    ),
    'SmartTag' => array(
        'package_name' => 'SmartTag',
        'version' => '1.0.6',
        'changelog' => 'new awesome updates in 1.0.6',
        'link' => 'google.com/smarttag',
        'releasedon' => '2015-05-22',
    ),
    'VersionX' => array(
        'package_name' => 'VersionX',
        'version' => '1.3.0',
        'changelog' => '<p>Auto-saving of drafts<br>New UI</p>',
        'link' => 'http://modx.com/extras/package/versionx',
        'releasedon' => '2015-05-22',
    ),
);

/** @var modResource $resource */
$resource = $modx->getObject('modResource', array(
    'parent' => 1,      // Posts container
    'template' => 8,    // Article - Extras Feed template
    'AND:createdon:>=' => $monday
));
if (!$resource) {
    $resource = $modx->newObject('modResource');
    $resource->fromArray(array(
        'parent' => 1,
        'template' => 8,
        'createdon' => time(),
        'pagetitle' => 'Extra Updates for week ' . date('W')
    ));
    $resource->set('alias', $resource->cleanAlias($resource->get('pagetitle')));
    $resource->save();
    $resource->setTVValue('author', 'releaserobot');

    $blankContent = $modx->toJSON($contentBlocks->getDefaultCanvas($resource));
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

if (!$resource->get('published')) {
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
$modx->getCacheManager()->delete('articles-grid/' . $resource->id, array(
    xPDO::OPT_CACHE_KEY => 'default'
));

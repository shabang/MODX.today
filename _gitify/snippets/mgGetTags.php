id: 14
name: mgGetTags
description: 'Gets all tags, or all tags from a specific MoreGallery resource. (Part of MoreGallery)'
category: MoreGallery
properties: "a:12:{s:5:\"cache\";a:7:{s:4:\"name\";s:5:\"cache\";s:4:\"desc\";s:32:\"moregallery.mggettags.cache_desc\";s:4:\"type\";s:13:\"combo-boolean\";s:7:\"options\";s:0:\"\";s:5:\"value\";b:1;s:7:\"lexicon\";s:19:\"moregallery:default\";s:4:\"area\";s:0:\"\";}s:8:\"resource\";a:7:{s:4:\"name\";s:8:\"resource\";s:4:\"desc\";s:35:\"moregallery.mggettags.resource_desc\";s:4:\"type\";s:11:\"numberfield\";s:7:\"options\";s:0:\"\";s:5:\"value\";i:0;s:7:\"lexicon\";s:19:\"moregallery:default\";s:4:\"area\";s:0:\"\";}s:6:\"sortBy\";a:7:{s:4:\"name\";s:6:\"sortBy\";s:4:\"desc\";s:33:\"moregallery.mggettags.sortby_desc\";s:4:\"type\";s:9:\"textfield\";s:7:\"options\";s:0:\"\";s:5:\"value\";s:7:\"display\";s:7:\"lexicon\";s:19:\"moregallery:default\";s:4:\"area\";s:0:\"\";}s:7:\"sortDir\";a:7:{s:4:\"name\";s:7:\"sortDir\";s:4:\"desc\";s:34:\"moregallery.mggettags.sortdir_desc\";s:4:\"type\";s:9:\"textfield\";s:7:\"options\";s:0:\"\";s:5:\"value\";s:3:\"ASC\";s:7:\"lexicon\";s:19:\"moregallery:default\";s:4:\"area\";s:0:\"\";}s:5:\"where\";a:7:{s:4:\"name\";s:5:\"where\";s:4:\"desc\";s:32:\"moregallery.mggettags.where_desc\";s:4:\"type\";s:9:\"textfield\";s:7:\"options\";s:0:\"\";s:5:\"value\";s:0:\"\";s:7:\"lexicon\";s:19:\"moregallery:default\";s:4:\"area\";s:0:\"\";}s:3:\"tpl\";a:7:{s:4:\"name\";s:3:\"tpl\";s:4:\"desc\";s:30:\"moregallery.mggettags.tpl_desc\";s:4:\"type\";s:9:\"textfield\";s:7:\"options\";s:0:\"\";s:5:\"value\";s:5:\"mgtag\";s:7:\"lexicon\";s:19:\"moregallery:default\";s:4:\"area\";s:0:\"\";}s:9:\"separator\";a:7:{s:4:\"name\";s:9:\"separator\";s:4:\"desc\";s:36:\"moregallery.mggettags.separator_desc\";s:4:\"type\";s:9:\"textfield\";s:7:\"options\";s:0:\"\";s:5:\"value\";s:1:\"\n\";s:7:\"lexicon\";s:19:\"moregallery:default\";s:4:\"area\";s:0:\"\";}s:10:\"wrapperTpl\";a:7:{s:4:\"name\";s:10:\"wrapperTpl\";s:4:\"desc\";s:37:\"moregallery.mggettags.wrappertpl_desc\";s:4:\"type\";s:9:\"textfield\";s:7:\"options\";s:0:\"\";s:5:\"value\";s:0:\"\";s:7:\"lexicon\";s:19:\"moregallery:default\";s:4:\"area\";s:0:\"\";}s:13:\"toPlaceholder\";a:7:{s:4:\"name\";s:13:\"toPlaceholder\";s:4:\"desc\";s:40:\"moregallery.mggettags.toplaceholder_desc\";s:4:\"type\";s:9:\"textfield\";s:7:\"options\";s:0:\"\";s:5:\"value\";s:0:\"\";s:7:\"lexicon\";s:19:\"moregallery:default\";s:4:\"area\";s:0:\"\";}s:8:\"totalVar\";a:7:{s:4:\"name\";s:8:\"totalVar\";s:4:\"desc\";s:35:\"moregallery.mggettags.totalvar_desc\";s:4:\"type\";s:9:\"textfield\";s:7:\"options\";s:0:\"\";s:5:\"value\";s:5:\"total\";s:7:\"lexicon\";s:19:\"moregallery:default\";s:4:\"area\";s:0:\"\";}s:5:\"limit\";a:7:{s:4:\"name\";s:5:\"limit\";s:4:\"desc\";s:32:\"moregallery.mggettags.limit_desc\";s:4:\"type\";s:11:\"numberfield\";s:7:\"options\";s:0:\"\";s:5:\"value\";i:0;s:7:\"lexicon\";s:19:\"moregallery:default\";s:4:\"area\";s:0:\"\";}s:6:\"offset\";a:7:{s:4:\"name\";s:6:\"offset\";s:4:\"desc\";s:33:\"moregallery.mggettags.offset_desc\";s:4:\"type\";s:11:\"numberfield\";s:7:\"options\";s:0:\"\";s:5:\"value\";i:0;s:7:\"lexicon\";s:19:\"moregallery:default\";s:4:\"area\";s:0:\"\";}}"

-----

/**
 * Gets tags for all or just the current resource.
 *
 * @author Mark Hamstra for modmore <support@modmore.com>
 * @var modX $modx
 * @var array $scriptProperties
 */

$scriptProperties = array_merge(array(
    'cache' => true,
    'resource' => $modx->resource->get('id'),
    'sortBy' => 'display',
    'sortDir' => 'ASC',
    'where' => '',

    'tpl' => 'mgtag',
    'separator' => "\n",
    'wrapperTpl' => '',
    'toPlaceholder' => '',

    'totalVar' => 'total',
    'limit' => 0,
    'offset' => 0,
), $scriptProperties);

/** @var moreGallery $moreGallery */
$corePath = $modx->getOption('moregallery.core_path', null, $modx->getOption('core_path') . 'components/moregallery/');
$moreGallery = $modx->getService('moregallery', 'moreGallery', $corePath . 'model/moregallery/');
if (!($moreGallery instanceof moreGallery)) {
    $modx->log(modX::LOG_LEVEL_ERROR, 'Error loading moreGallery class from ' . $corePath);
    return 'Error loading moreGallery class.';
}
$cacheOptions = array(xPDO::OPT_CACHE_KEY => 'moregallery');
$cacheKey = 'tags/r_' . md5(serialize($scriptProperties));
$chunkHash = md5($moreGallery->getChunk($scriptProperties['tpl'])) . md5($moreGallery->getChunk($scriptProperties['wrapperTpl'], array('output' => '')));

/**
 * Get from cache if we can
 */
if ($scriptProperties['cache']) {
    $cached = $modx->cacheManager->get($cacheKey, $cacheOptions);
    if (is_array($cached)) {
        if ($chunkHash == $cached['chunkHash']) {
            return $cached['formatted'];
        }
    }
}

$c = $modx->newQuery('mgTag');
if ($scriptProperties['resource'] > 0)
{
    $subc = $modx->newQuery('mgImageTag');
    $subc->where(array(
        'resource' => $scriptProperties['resource'],
        '`tag` = mgTag.id'
    ));
    $subc->prepare();
    $c->where('EXISTS (' . $subc->toSQL() . ')');
}

if (!empty($scriptProperties['where']))
{
    $where = $modx->fromJSON($scriptProperties['where']);
    if (is_array($where))
    {
        $c->where($where);
    }
    else
    {
        $modx->log(modX::LOG_LEVEL_ERROR, '&where property is not valid JSON: ' . $scriptProperties['where'], '', 'mgGetTags', __FILE__, __LINE__);
    }
}

$c->sortby($scriptProperties['sortBy'], $scriptProperties['sortDir']);

$total = $modx->getCount('mgImage', $c);
$modx->setPlaceholder($scriptProperties['totalVar'], $total);
if ($scriptProperties['limit'] > 0) {
    $c->limit($scriptProperties['limit'], $scriptProperties['offset']);
}


$tags = array();
$i = 0;
/** @var mgTag $tag */
foreach ($modx->getIterator('mgTag', $c) as $tag) {
    $tArray = $tag->toArray();
    $tArray['idx'] = $i;
    $tags[] = $tArray;
    $i++;
}

$formatted = array();
foreach ($tags as $t) {
    $formatted[] = $moreGallery->getChunk($scriptProperties['tpl'], $t);
}
$formatted = implode($scriptProperties['separator'], $formatted);

if (!empty($scriptProperties['wrapperTpl'])) {
    $formatted = $moreGallery->getChunk($scriptProperties['wrapperTpl'], array('output' => $formatted, 'tag_total' => $total));
}

$cached = array(
    'formatted' => $formatted,
    'chunkHash' => $chunkHash,
    'cached' => date('c'),
);
// Write to cache
$modx->cacheManager->set($cacheKey, $cached, 0, $cacheOptions);

if (!empty($scriptProperties['toPlaceholder'])) {
    $modx->setPlaceholder($scriptProperties['toPlaceholder'], $formatted);
} else {
    return $formatted;
}
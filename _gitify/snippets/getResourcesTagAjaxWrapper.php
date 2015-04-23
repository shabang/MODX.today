id: 28
name: getResourcesTagAjaxWrapper
category: tagLister
properties: 'a:0:{}'

-----

$cacheParams = $scriptProperties;
$cacheRequestParams = array('author', 'page');
foreach ($cacheRequestParams as $reqParam) {
    if (isset($_REQUEST[$reqParam])) {
        $cacheParams[$reqParam] = $_REQUEST[$reqParam];
    }
}
$cacheParams = serialize($cacheParams);
$cacheKey = 'articles-grid/' . md5($cacheParams);

$result = $modx->cacheManager->get($cacheKey);
if (empty($result)) {
    // Call getResourcesTag to handle processing of stuff
    $snippet = $modx->getObject('modSnippet', array('name' => 'getResourcesTag'));
    $snippet->setCacheable(false);
    $result = $snippet->process($scriptProperties);
    
    // Write to the cache
    $modx->cacheManager->set($cacheKey, $result);
}

// Check if we're dealing with an AJAX request
$isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
if ($isAjax) {
    // If it is ajax, we parse the content and return it before the entire page gets parsed.
    $modx->parser->processElementTags('', $result, false, false);
    $modx->parser->processElementTags('', $result, true, true);
    echo '<div id="container">' . $result . '</div>';
    @session_write_close();
    exit();
}

// No ajax? Just return the value.
return $result;
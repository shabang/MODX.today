id: 28
name: getResourcesTagAjaxWrapper
category: tagLister
properties: null

-----

// Call getResourcesTag to handle processing
$result = $modx->runSnippet('getResourcesTag', $scriptProperties);

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

// No ajax? Just do nothing else.
return $result;
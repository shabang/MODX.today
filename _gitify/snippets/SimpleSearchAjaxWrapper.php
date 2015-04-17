id: 35
name: SimpleSearchAjaxWrapper
category: tagLister
properties: null

-----

// Call getResourcesTag to handle processing
$result = $modx->runSnippet('SimpleSearch', $scriptProperties);

// Check if we're dealing with an AJAX request
$isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
if ($isAjax) {
    // If it is ajax, we parse the content and return it before the entire page gets parsed.
    $modx->parser->processElementTags('', $result, false, false);
    $modx->parser->processElementTags('', $result, true, true);
    echo $result;
    @session_write_close();
    exit();
}

// No ajax? Just do nothing else.
return $result;
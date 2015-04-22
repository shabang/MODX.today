id: 36
name: getShareCount
properties: 'a:0:{}'

-----

$resourceId = $modx->getOption('resource', $_REQUEST, $modx->resource->get('id'));
$url = $modx->makeUrl($resourceId, '', '', 'full');
$urlHash = md5($url);

$cached = $modx->cacheManager->get('shares/' . $urlHash);
if (is_array($cached)) {
    return $modx->toJSON($cached);
}

$urlEnc = urlencode($url);
$total = 0;
$results = array(
    'url' => $url,
    'sources' => array(),
);

// Facebook
$fbUrl = "http://api.facebook.com/restserver.php?method=links.getStats&format=json&urls={$urlEnc}";
$fbCount = reset($modx->fromJSON(file_get_contents($fbUrl)));
// var_dump($fbCount);
if (is_array($fbCount) && isset($fbCount['total_count'])) {
    $total += $fbCount['total_count'];
    $results['sources']['facebook'] = $fbCount['total_count'];
}

// Twitter - private endpoint
$twitterUrl = "https://cdn.api.twitter.com/1/urls/count.json?url={$urlEnc}";
$twitterCount = $modx->fromJSON(file_get_contents($twitterUrl));
// var_dump($twitterCount);

if (is_array($twitterCount) && isset($twitterCount['count'])) {
    $total += $twitterCount['count'];
    $results['sources']['twitter'] = $twitterCount['count'];
}

// Google+ - private endpoint
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $url . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
$curl_results = curl_exec ($curl);
curl_close ($curl);
$json = json_decode($curl_results, true);

if (isset($json[0]['result']['metadata']['globalCounts']['count'])) {
    $total += $json[0]['result']['metadata']['globalCounts']['count'];
    $results['sources']['googleplus'] = $json[0]['result']['metadata']['globalCounts']['count'];
}

// LinkedIn
$linkedinUrl = "https://www.linkedin.com/countserv/count/share?url={$urlEnc}&format=json";
$linkedinCount = $modx->fromJSON(file_get_contents($linkedinUrl));
// var_dump($linkedinCount);

if (is_array($linkedinCount) && isset($linkedinCount['count'])) {
    $total += $linkedinCount['count'];
    $results['sources']['linkedin'] = $linkedinCount['count'];
}

$results['total'] = $total;

$modx->cacheManager->set('shares/' . $urlHash, $results, 60 * 15);
return $modx->toJSON($results);
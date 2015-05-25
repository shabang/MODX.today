id: 45
name: getReleases
properties: null

-----

$repeater = $modx->runSnippet('cbGetFieldContent', array('field' => 12, 'resource' => $resource, 'returnAsJSON' => 1, 'limit' => 1));

$repeater = $modx->fromJSON($repeater);
$repeater = reset($repeater);

$output = array();
foreach ($repeater['rows'] as $item) {
   $output[] = $item['package_name']['value'];
}

if (count($output) > 1) {
  $last = array_pop($output);
  $output = implode(', ', $output);
  return $output . ' and ' . $last;
}

$output = implode(', ', $output);
return $output;
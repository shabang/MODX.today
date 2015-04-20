id: 29
name: getAuthorList
properties: 'a:0:{}'

-----

$chunks = $modx->getCollection('modChunk', array('category' => 44));

$output = array();
foreach ($chunks as $chunk) {
  $output[] = $chunk->getContent();
}
return implode("\n", $output);
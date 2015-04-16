id: 29
name: getAuthorList
properties: null

-----

$chunks = $modx->getCollection('modChunk', array('category' => 44));

$output = array();
foreach ($chunks as $chunk) {
  $output[] = $chunk->getContent();
}
return implode("\n", $output);
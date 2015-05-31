id: 29
name: getAuthorList
properties: 'a:0:{}'

-----

$c = $modx->newQuery('modChunk');
$c->where(array(
  'category' => 44,
));
$c->sortby('name', 'ASC');

$chunks = $modx->getCollection('modChunk', $c);

$output = array();
foreach ($chunks as $chunk) {
  $output[] = $chunk->getContent();
}
return implode("\n", $output);
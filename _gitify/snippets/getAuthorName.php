id: 44
name: getAuthorName
properties: null

-----

$chunk = $modx->getObject('modChunk', array('name' => $input));
if ($chunk) {
  return $chunk->get('description');
}
return $input;
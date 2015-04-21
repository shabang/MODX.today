id: 40
name: getImageHeight
properties: null

-----

$base_path = $modx->getOption('base_path', null, MODX_BASE_PATH);
$image = $base_path . ltrim($input, '/');

if (file_exists($image)){
  list($width, $height) = getimagesize($image);
  return $height;
}
return ' ';
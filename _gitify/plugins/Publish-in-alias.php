id: 14
name: 'Publish in alias'
properties: 'a:0:{}'

-----

$parent = $resource->get('parent');
if ($parent != 2) {
    return;
}

$postRoot = $modx->makeUrl($parent);

if (!$resource->get('published')) return;
if (strpos($resource->get('alias'),'/') !== false) return;

$publishedon = strtotime($resource->get('publishedon'));
$newAlias = strftime('%Y',$publishedon) . '/' . strftime('%m',$publishedon) . '/' . $resource->get('alias');
$resource->set('alias', $newAlias);

return;
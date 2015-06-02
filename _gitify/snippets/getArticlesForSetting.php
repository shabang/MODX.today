id: 49
name: getArticlesForSetting
properties: null

-----

$c = $modx->newQuery('modResource');
$c->where(array(
  'parent' => 1,
  'deleted' => false,
));
$c->sortby('published', 'desc');
$c->sortby('pagetitle', 'asc');

$iterator = $modx->getIterator('modResource', $c);
$output = array();
foreach ($iterator as $resource) {
  $id = $resource->get('id');
  $display = $resource->get('pagetitle');
  if ($resource->get('published')) {
    $display .= ' (' . date('Y-m-d', strtotime($resource->get('publishedon'))) . ')';
  }
  $output[] = $display . '=' . $id;
}

$output = implode("\n", $output);
return $output;
id: 43
name: hitsColumnRenderer
properties: null

-----

// get the hit service
$defaultHitsCorePath = $modx->getOption('core_path').'components/hits/';
$hitsCorePath = $modx->getOption('hits.core_path',null,$defaultHitsCorePath);
$hitService = $modx->getService('hits','Hits',$hitsCorePath.'model/hits/',$scriptProperties);
if (!($hitService instanceof Hits)) {
    $modx->log(modX::LOG_LEVEL_ERROR, 'Could not load Hits from ' . $hitsCorePath);
    return; 
}

$id = $row['id'];

$hit = $modx->getObject('Hit',array(
    	'hit_key' => $id
    ));

if ($hit) {
  return $hit->get('hit_count');
}

return 0;
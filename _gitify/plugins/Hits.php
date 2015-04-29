id: 26
name: Hits
description: 'Adaption of the Hits snippet to use as plugin instead'
properties: 'a:0:{}'

-----

// get the hit service
$defaultHitsCorePath = $modx->getOption('core_path').'components/hits/';
$hitsCorePath = $modx->getOption('hits.core_path',null,$defaultHitsCorePath);
$hitService = $modx->getService('hits','Hits',$hitsCorePath.'model/hits/',$scriptProperties);
if (!($hitService instanceof Hits)) {
    $modx->log(modX::LOG_LEVEL_ERROR, 'Could not load Hits from ' . $hitsCorePath);
    return; 
}

$hitKey = false;

switch ($modx->event->name) {
    case 'OnLoadWebDocument':
        if ($modx->resource instanceof modResource && $modx->resource->get('parent') === 1) {
            $hitKey = $modx->resource->get('id');
        }
        break;
}

if ($hitKey) {
    $hit = $modx->getObject('Hit',array(
    	'hit_key' => $hitKey
    ));

    if($hit) {
    	// increment the amount
    	$hit->set('hit_count', (integer)$hit->get('hit_count') + 1); 
    } else {
    	// create a new hit record
    	$hit = $modx->newObject('Hit');
    	$hit->fromArray(array(
    		'hit_key' => $hitKey,
    		'hit_count' => 1
    	));
    }
	$hit->save();
}
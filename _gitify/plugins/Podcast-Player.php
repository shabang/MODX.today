id: 16
name: 'Podcast Player'
properties: 'a:0:{}'

-----

switch ($modx->event->name) {
    case 'OnPageNotFound':
        if ($modx->context->get('key') == 'mgr') return;
        
        $url = $_REQUEST[$modx->getOption('request_param_alias', null, 'q')];
        
        $urlparts = explode('/', $url);
        //die('<pre>'.print_r($urlparts,true).'</pre>');
        
        if (!($urlparts[0] == 'podcast' && $urlparts[1] == 'play')) return "";
        
        $episodeId = $urlparts[2];
        
        $tvValue = $modx->getObject('modTemplateVarResource', array(
            'tmplvarid' => 5,
            'value' => $episodeId,
        ));
        
        if ($tvValue) {
            $resource = $modx->getObject('modResource', $tvValue->get('contentid'));
            if (!$resource) return;
        
            $placeholders = $resource->toArray();
            $placeholders['number'] = $episodeId;
            $modx->setPlaceholders($placeholders, 'episode.');
            $modx->sendForward(22);
            return;
        }
    break;
}
return "";
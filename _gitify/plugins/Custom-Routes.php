id: 16
name: 'Custom Routes'
properties: 'a:0:{}'

-----

switch ($modx->event->name) {
    case 'OnPageNotFound':
        if ($modx->context->get('key') == 'mgr') return;
        
        $url = $_REQUEST[$modx->getOption('request_param_alias', null, 'q')];
        $urlparts = explode('/', $url);

        if ($urlparts[0] == 'podcast' && $urlparts[1] == 'play') {
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
        }
        
        elseif ($urlparts[0] == 'posts' && $urlparts[1] == 'author') {
            $authorSlug = $urlparts[2];
            $exists = $modx->getObject('modChunk', array('name' => $authorSlug));
            if ($exists) {
                $_REQUEST['author'] = $_GET['author'] = $authorSlug;
                $modx->setPlaceholder('author_filter', $authorSlug);
                $modx->setPlaceholder('author_name', $exists->get('description'));
                $modx->sendForward(1);
            }
        }
        
    break;
}
return "";
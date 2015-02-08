id: 12
name: 'Autofill Image TV'
properties: 'a:0:{}'

-----

switch ($modx->event->name)
{
    case 'OnDocFormSave':
        $oldImageValue = $resource->getTVValue('image'); //1200x630
        $imageValue = false;
        
        if (empty($oldImageValue))
        {
            $isGallery = (class_exists('mgResource') && $resource instanceof mgResource);
            $isContentBlocks = (bool)$resource->getProperty('_isContentBlocks', 'contentblocks');
            
            if ($isGallery) 
            {
                // Make sure MG is loaded
                $corePath = $modx->getOption('moregallery.core_path', null, $modx->getOption('core_path') . 'components/moregallery/');
                $moreGallery = $modx->getService('moregallery', 'moreGallery', $corePath . 'model/moregallery/');
                
                $imgc = $modx->newQuery('mgImage');
                $imgc->where(array(
                    'resource' => $resource->get('id'),
                    'active' => true,
                ));
                $imgc->sortby('sortorder', 'ASC');
                
                $galImage = $modx->getObject('mgImage', $imgc);
                
                if ($galImage) {
                    $galImageArray = $galImage->toArray();
                    $imageValue = $galImageArray['file_url']; 
                }
            }
            
            if (!$imageValue && $isContentBlocks)
            {
                $contents = $resource->getProperty('linear', 'contentblocks');
                $imageField = 4;
                
                foreach($contents as $item) {
                  	if($item['field'] == $imageField) {
                        $imageValue = $item['url'];
                        break;
                  	}
                }
            }
            
            if ($imageValue)
            {
                $resource->setTVValue('image', $imageValue);
                $resource->save();
            }
        }
        
        break;
}
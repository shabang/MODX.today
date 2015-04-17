id: 33
name: CollectionPostTypeRenderer
properties: null

-----

$input = $modx->getOption('value', $scriptProperties, '');
if ($input == '') return 'empty';

$tpl = $modx->getObject('modTemplate', $input);
return '<div class="collections-grid-date" style="text-align:left;padding:0;">'.str_replace('Article - ', '',$tpl->get('templatename')).'</div>';
id: 7
name: Collections
category: Collections
properties: 'a:0:{}'

-----

/**
 * Collections
 *
 * DESCRIPTION
 *
 * This plugin inject JS to handle proper working of close buttons in Resource's panel (OnDocFormPrerender)
 * This plugin handles setting proper show_in_tree parameter (OnBeforeDocFormSave, OnResourceSort)
 *
 */
$corePath = $modx->getOption('collections.core_path', null, $modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/collections/');
/** @var Collections $collections */
$collections = $modx->getService(
    'collections',
    'Collections',
    $corePath . 'model/collections/',
    array(
        'core_path' => $corePath
    )
);

$className = 'Collections' . $modx->event->name;

$modx->loadClass('CollectionsPlugin', $collections->getOption('modelPath') . 'collections/events/', true, true);
$modx->loadClass($className, $collections->getOption('modelPath') . 'collections/events/', true, true);

if (class_exists($className)) {
    $handler = new $className($modx, $scriptProperties);
    $handler->run();
}

return;
id: 13
name: MoreGallery
description: 'Registers CSS to the manager for proper display of the custom resource. (Part of MoreGallery)'
category: MoreGallery
properties: null

-----

/**
 * @var modX $modx
 *
 * @event OnHandleRequest
 */

$assetsUrl = $modx->getOption('moregallery.assets_url', null, $modx->getOption('assets_url').'components/moregallery/');

switch ($modx->event->name) {
    case 'OnHandleRequest':
        if ($modx->context && $modx->context instanceof modContext && $modx->context->get('key') == 'mgr') {
            $modx->regClientStartupHTMLBlock('<link rel="stylesheet" type="text/css" href="' . $assetsUrl . 'mgr/css/moregallery.css' . '" />');
        }
        break;

    case 'OnSiteRefresh':
        $modx->getCacheManager()->clean(array(
            xPDO::OPT_CACHE_KEY => 'moregallery'
        ));
        $modx->log(modX::LOG_LEVEL_INFO, 'Cleared MoreGallery cache');

        break;

    case 'OnManagerPageBeforeRender':
        $modxVersion = $modx->getVersionData();
        if (version_compare($modxVersion['full_version'], '2.3.0-dev', '>=')) {
            $controller->addHtml(<<<HTML
<script type="text/javascript">
Ext.onReady(function() {
    Ext.getBody().addClass('moregallery_v23');
});
</script>
HTML
            );
        }
        /**
         * @var modManagerController $controller
         */
        if (!$modx->getOption('moregallery.add_icon_to_toolbar', null, true)) {
            return;
        }
        $controller->addHtml(<<<HTML
<script>
var mgTreeToolbarInitiated = false;
Ext.onReady(function() {
    var tree = Ext.getCmp('modx-resource-tree'),
        tb = (tree) ? tree.getTopToolbar() : false;
    if (!tb) return;

    if (!mgTreeToolbarInitiated) {
        mgTreeToolbarInitiated = true;
        setTimeout(function() {
            tb.insertButton(4, {
                cls: 'tree-new-gallery',
                tooltip: 'Add Gallery',
                handler: function() {
                    var action = (MODx.action && MODx.action['resource/create']) ? MODx.action['resource/create'] : 'resource/create';
                    MODx.loadPage(action, 'class_key=mgResource');
                }
            });
            tb.doLayout();
        }, 150);
    }
});
</script>
HTML
);
}

return;
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
        /**
         * @var modManagerController $controller
         */
        // Load the moregallery lexicon
        $controller->addLexiconTopic('moregallery:default');

        // If we're on at least 2.3, add a class to the page for improved styling
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

        // Add the moregallery icon to the toolbar if requested
        if ($modx->getOption('moregallery.add_icon_to_toolbar', null, true)) {
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
                tooltip: _('moregallery.new'),
                handler: function() {
                    var action = (MODx.action && MODx.action['resource/create']) ? MODx.action['resource/create'] : 'resource/create';
                    MODx.loadPage(action, 'class_key=mgResource');
                }
            });
            tb.doLayout();
        }, 500);
    }
});
</script>
HTML
            );
        }
    break;

    /**
     * @var string $path
     */
    case 'OnFileManagerFileRename':
        $corePath = $modx->getOption('moregallery.core_path', null, $modx->getOption('core_path').'components/moregallery/');
        $moreGallery =& $modx->getService('moregallery', 'moreGallery' , $corePath . 'model/moregallery/');
        $moreGallery->renames[] = $path;
        break;
}

return;
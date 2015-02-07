Ext.onReady(function() {
    MODx.load({
        xtype: 'contentblocks-page-home',
        renderTo: 'contentblocks-admin-home'
    });
});
 
ContentBlocksComponent.page.Home = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        cls: 'container form-with-labels',
        border: false,
        components: [{
            xtype: 'panel',
            html: '<h2>' + _('contentblocks.mgr.home') + '</h2>',
            border: false,
            cls: 'modx-page-header'
        },{
            xtype: 'modx-tabs',
            id: 'contentblocks-page-home-tabs',
            width: '98%',
            border: true,

            stateful: true,
            stateId: 'contentblocks-page-home',
            stateEvents: ['tabchange'],
            getState: function() {
                return {
                    activeTab:this.items.indexOf(this.getActiveTab())
                };
            },

            defaults: {
                border: false,
                autoHeight: true,
                defaults: {
                    border: false
                }
            },
            items: [{
                title: _('contentblocks.fields'),
                id: 'contentblocks-page-home-tabs-fields',
                items: [{
                    xtype: 'panel',
                    bodyCssClass: 'panel-desc',
                    html: '<p>' + _('contentblocks.field_desc') + '</p>'
                },{
                    xtype: 'contentblocks-grid-fields',
                    cls: 'main-wrapper'
                }]
            },{
                title: _('contentblocks.layouts'),
                id: 'contentblocks-page-home-tabs-layouts',
                items: [{
                    xtype: 'panel',
                    bodyCssClass: 'panel-desc',
                    html: '<p>' + _('contentblocks.layout_desc') + '</p>'
                },{
                    xtype: 'contentblocks-grid-layouts',
                    cls: 'main-wrapper'
                }]
            },{
                title: _('contentblocks.templates'),
                id: 'contentblocks-page-home-tabs-templates',
                items: [{
                    xtype: 'panel',
                    bodyCssClass: 'panel-desc',
                    html: '<p>' + _('contentblocks.templates_desc') + '</p>'
                },{
                    xtype: 'contentblocks-grid-templates',
                    cls: 'main-wrapper'
                }]
            },{
                title: _('contentblocks.defaults'),
                id: 'contentblocks-page-home-tabs-defaults',
                items: [{
                    xtype: 'panel',
                    bodyCssClass: 'panel-desc',
                    html: '<p>' + _('contentblocks.defaults.intro') + '</p>'
                },{
                    xtype: 'contentblocks-grid-defaults',
                    cls: 'main-wrapper'
                }]
            }]
        }, ContentBlocksComponent.attribution()],
        buttons: [{
            text: _('help_ex'),
            handler: this.loadHelpPane,
            scope: this,
            id: 'modx-abtn-help'
        }, '-', {
            text: _('contentblocks.rebuild_content'),
            handler: this.rebuildContent,
            scope: this
        }]
    });
    ContentBlocksComponent.page.Home.superclass.constructor.call(this,config);
};
Ext.extend(ContentBlocksComponent.page.Home,MODx.Component,{
    loadHelpPane: function() {
        var tabs = Ext.getCmp('contentblocks-page-home-tabs'),
            aTab = tabs.activeTab,
            baseUrl = 'https://www.modmore.com/extras/contentblocks/documentation/',
            url = '';

        switch (aTab.id) {
            case 'contentblocks-page-home-tabs-fields':
                url = 'fields/';
                break;
            case 'contentblocks-page-home-tabs-layouts':
                url = 'layouts/';
                break;
            case 'contentblocks-page-home-tabs-templates':
                url = 'templates/';
                break;
            case 'contentblocks-page-home-tabs-defaults':
                url = 'defaults/';
                break;
        }

        if (url.length > 0) {
            MODx.config.help_url = baseUrl + url + '?embed=1';
            MODx.loadHelpPane();
        }
    },

    rebuildContent: function() {
        Ext.Msg.confirm(_('contentblocks.rebuild_content'), _('contentblocks.rebuild_content.confirm'), function(e) {
            if (e == 'yes') {
                var win = MODx.load({xtype: 'contentblocks-window-rebuild_content'});
                win.show();
            }
        });
    }
});
Ext.reg('contentblocks-page-home',ContentBlocksComponent.page.Home);

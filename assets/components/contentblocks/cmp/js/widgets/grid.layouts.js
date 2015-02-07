ContentBlocksComponent.grid.Layouts = function(config) {
    config = config || {};
    var exp = new Ext.grid.RowExpander({
        tpl : new Ext.Template('<p style="margin-top: 8px">{description}</p>'),
        renderer : function(v, p, record){
            return record.get('description').length > 0 ? '<div class="x-grid3-row-expander">&#160;</div>' : '&#160;';
        },
        expandOnEnter: false,
        expandOnDblClick: false
    });
    Ext.applyIf(config,{
		url: ContentBlocksComponent.config.connectorUrl,
		id: 'contentblocks-grid-layouts',
		baseParams: {
            action: 'mgr/layouts/getlist'
        },
        autosave: true,
        save_action: 'mgr/layouts/update_from_grid',
        emptyText: _('no_results'),
		fields: [
            {name: 'id', type: 'int'},
            {name: 'name', type: 'string'},
            {name: 'description', type: 'string'},
            {name: 'sortorder', type: 'int'},
            {name: 'icon', type: 'string'},
            {name: 'icon_type', type: 'string'},
            {name: 'columns', type: 'object'},
            {name: 'availability', type: 'object'},
            {name: 'times_per_page', type: 'int'},
            {name: 'layout_only_nested', type: 'bool'},
            {name: 'settings', type: 'object'},
            {name: 'template', type: 'string'}
        ],
        paging: true,
		remoteSort: true,
        plugins: [exp, new Ext.ux.dd.GridDragDropRowOrder({
            copy: false,
            scrollable: true, // enable scrolling support
            listeners: {
                'afterrowmove': {
                    fn:this.onAfterRowMove,
                    scope:this
                }
            }
        })],
		columns: [exp, {
			header: _('contentblocks.id'),
			dataIndex: 'id',
			sortable: true,
			width: .05,
            hidden: true
		},{
			header: _('contentblocks.name'),
			dataIndex: 'name',
			sortable: true,
			width: .2,
            renderer: function(v, cell, record) {
                if (record.data.icon.length > 0) {
                    var icon_type = (record.data.icon_type != '') ? record.data.icon_type : 'core',
                        icon_base_url = (icon_type == 'core') ? ContentBlocksComponent.config.assetsUrl + 'img/icons/' : ContentBlocksComponent.config.customIconUrl;
                    v = '<img class="contentblocks-icon" src="' + icon_base_url + record.data.icon + '.png" alt="' + record.data.icon + '" style=""> ' + v + ' <span class="contentblocks-id">(' + record.data.id + ')</span>';
                }
                return v;
            }
		},{
			header: _('contentblocks.columns'),
			dataIndex: 'columns',
			sortable: true,
			width: .3,
            renderer: function (v) {
                var o = [];
                Ext.each(v, function(col) {
                    o.push(col.reference + " (" + col.width + "%)");
                });
                return o.join(", ");
            }
		},{
			header: _('contentblocks.sortorder'),
			dataIndex: 'sortorder',
			sortable: true,
			width: .05,
            editor: {
                xtype: 'numberfield'
            }
		}],
        tbar: [{
            text: _('contentblocks.add_layout'),
            handler: this.addLayout,
            scope: this
        }, '->', {
            text: _('contentblocks.export_layouts'),
            handler: this.exportLayouts,
            scope: this
        }, '-', {
            text: _('contentblocks.import_layouts'),
            handler: this.importLayouts,
            scope: this
        }]
    });
    ContentBlocksComponent.grid.Layouts.superclass.constructor.call(this,config);
};
Ext.extend(ContentBlocksComponent.grid.Layouts,MODx.grid.Grid,{
    addLayout: function() {
        var win = MODx.load({
            xtype: 'contentblocks-window-layout',
            listeners: {
                success: {fn: function() {
                    this.refresh();
                },scope: this},
                scope: this
            }
        });
        win.show();
    },

    editLayout: function() {
        var record = this.menu.record;
        var win = MODx.load({
            xtype: 'contentblocks-window-layout',
            record: record,
            isUpdate: true,
            listeners: {
                success: {fn: function() {
                    this.refresh();
                },scope: this},
                scope: this
            }
        });
        win.setValues(record);
        win.show();
    },

    duplicateLayout: function() {
        var record = vcJquery.extend(true, {}, this.menu.record);
        record.id = 0;
        record.name = _('duplicate_of', {name: record.name});
        var win = MODx.load({
            xtype: 'contentblocks-window-layout',
            record: record,
            isUpdate: false,
            title: _('contentblocks.duplicate_layout'),
            listeners: {
                success: {fn: function(r) {
                    this.refresh();
                },scope: this},
                scope: this
            }
        });
        win.setValues(record);
        win.show();
    },


    deleteLayout: function() {
        var record = this.menu.record;

        MODx.msg.confirm({
            title: _('warning'),
            text: _('contentblocks.delete_layout.confirm'),
            url: ContentBlocksComponent.config.connectorUrl,
            params: {
                id: record.id,
                action: 'mgr/layouts/remove'
            },
            listeners: {
                'success':{fn: function(r) {
                    this.refresh();
                },scope:this}
            }
        });
    },

    getMenu: function() {
        var m = [];

        m.push({
            text: _('contentblocks.edit_layout'),
            handler: this.editLayout,
            scope: this
        }, {
            text: _('contentblocks.duplicate_layout'),
            handler: this.duplicateLayout,
            scope: this
        }, '-', {
            text: _('contentblocks.delete_layout'),
            handler: this.deleteLayout,
            scope: this
        });
        return m;
    },

    exportLayouts: function() {
        Ext.Msg.confirm(_('contentblocks.export_layouts'), _('contentblocks.export_layouts.confirm'), function(e) {
            if (e == 'yes') {
                window.location = ContentBlocksComponent.config.connectorUrl + '?action=mgr/layouts/export&HTTP_MODAUTH=' + MODx.siteId;
            }
        });
    },

    importLayouts: function() {
        var win = MODx.load({
            xtype: 'contentblocks-window-import',
            title: _('contentblocks.import_layouts.title'),
            introduction: _('contentblocks.import_layouts.intro'),
            what: _('contentblocks.layouts'),
            baseParams: {
                action: 'mgr/layouts/import'
            },
            listeners: {
                success: {fn: function(r) {
                    this.refresh();
                },scope: this},
                scope: this
            }
        });
        win.show();
    },

    onAfterRowMove: function(dt,sri,ri,sels) {
        var s = this.getStore(),
            total = s.getTotalCount();

        // Loop over all rows to set the new sortorder
        var r;
        for (var x = 0; x<total; x++) {
            r = s.getAt(x);
            if (r) {
                r.set('sortorder',x);

                var e = {
                    grid: this,
                    record: r,
                    cancel:false
                };
                this.fireEvent('afteredit', e);
                r.commit();
            }
        }
        return true;
    }
});
Ext.reg('contentblocks-grid-layouts',ContentBlocksComponent.grid.Layouts);

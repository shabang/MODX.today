ContentBlocksComponent.grid.Categories = function (config) {
    config = config || {};
    config.id = config.id || Ext.id();
    Ext.applyIf(config, {
        url: ContentBlocksComponent.config.connectorUrl,
        baseParams: {
            action: 'mgr/categories/getlist',
            showNone: false
        },
        autosave: true,
        save_action: 'mgr/categories/update_from_grid',
        autoHeight: true,
        emptyText: _('no_results'),
        fields: [
            {name: 'id', type: 'int'},
            {name: 'name', type: 'string'},
            {name: 'description', type: 'string'},
            {name: 'sortorder', type: 'int'}
        ],
        paging: true,
        remoteSort: true,
        plugins: [new Ext.ux.dd.GridDragDropRowOrder({
            copy: false,
            scrollable: true, // enable scrolling support
            listeners: {
                'afterrowmove': {
                    fn: this.onAfterRowMove,
                    scope: this
                }
            }
        })],
        columns: [
            {
                header: _('contentblocks.id'),
                dataIndex: 'id',
                hidden: true,
                sortable: true,
                width: .10
            },
            {
                header: _('contentblocks.name'),
                dataIndex: 'name',
                sortable: true,
                width: .30,
                editor: {
                    xtype: 'textfield'
                }
            },
            {
                header: _('contentblocks.description'),
                dataIndex: 'description',
                sortable: true,
                width: .60,
                editor: {
                    xtype: 'textarea'
                }
            },
            {
                header: _('contentblocks.sortorder'),
                dataIndex: 'sortorder',
                sortable: true,
                width: .10,
                editor: {
                    xtype: 'numberfield'
                }
            }
        ],
        tbar: [{
            text: _('contentblocks.add_category'),
            handler: this.addCategory,
            scope: this
        }, '->', {
            text: _('contentblocks.export_fields'),
            handler: this.exportAllCategories,
            scope: this
        }, '-', {
            text: _('contentblocks.import_fields'),
            handler: this.importCategories,
            scope: this
        }]
    });
    ContentBlocksComponent.grid.Categories.superclass.constructor.call(this, config);
    this.propRecord = Ext.data.Record.create(config.fields);
};
Ext.extend(ContentBlocksComponent.grid.Categories, MODx.grid.Grid, {
    addCategory: function () {
        var win = MODx.load({
            xtype: 'contentblocks-window-categories',
            listeners: {
                success: {fn: function (r) {
                    this.refresh();
                }, scope: this},
                scope: this
            }
        });
        win.show();
    },

    editCategory: function () {
        var record = this.menu.record;
        var win = MODx.load({
            xtype: 'contentblocks-window-categories',
            record: record,
            isUpdate: true,
            initCount: 0,
            listeners: {
                success: {fn: function () {
                    this.refresh();
                }, scope: this},
                scope: this
            }
        });
        win.setValues(record);
        win.show();
    },


    duplicateCategory: function() {
        var record =  vcJquery.extend(true, {}, this.menu.record);
        record.id = 0;
        var win = MODx.load({
            xtype: 'contentblocks-window-categories',
            record: record,
            isUpdate: false,
            isDuplicate: true,
            title: _('contentblocks.duplicate_category'),
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


    deleteCategory: function () {
        var record = this.menu.record;

        MODx.msg.confirm({
            title: _('warning'),
            text: _('contentblocks.delete_category.confirm'),
            url: ContentBlocksComponent.config.connectorUrl,
            params: {
                id: record.id,
                action: 'mgr/categories/remove'
            },
            listeners: {
                'success': {fn: function (r) {
                    this.refresh();
                }, scope: this}
            }
        });
    },

    getMenu: function () {
        var m = [];

        m.push({
            text: _('contentblocks.edit_category'),
            handler: this.editCategory,
            scope: this
        }, {
            text: _('contentblocks.duplicate_category'),
            handler: this.duplicateCategory,
            scope: this
        }, {
            text: _('contentblocks.export_category'),
            handler: this.exportCategory,
            scope: this
        }, '-', {
            text: _('contentblocks.delete_category'),
            handler: this.deleteCategory,
            scope: this
        });
        return m;
    },

    exportCategory: function() {
        var record = this.menu.record;
        window.location = ContentBlocksComponent.config.connectorUrl + '?action=mgr/categories/export&items=' + record.id + '&HTTP_MODAUTH=' + MODx.siteId;
    },

    exportAllCategories: function() {
        var that = this;
        Ext.Msg.confirm(_('contentblocks.export_categories'), _('contentblocks.export_categories.confirm'), function(e) {
            if (e == 'yes') {
                var url = ContentBlocksComponent.config.connectorUrl + '?action=mgr/categories/export&HTTP_MODAUTH=' + MODx.siteId;
                window.location = url;
            }
        });
    },

    importCategories: function() {
        var win = MODx.load({
            xtype: 'contentblocks-window-import',
            title: _('contentblocks.import_categories.title'),
            introduction: _('contentblocks.import_categories.intro'),
            what: _('contentblocks.categories'),
            baseParams: {
                action: 'mgr/categories/import'
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

    onAfterRowMove: function (dt, sri, ri, sels) {
        var s = this.getStore(),
            total = s.getTotalCount();

        // Loop over all rows to set the new sortorder
        var r;
        for (var x = 0; x < total; x++) {
            r = s.getAt(x);
            if (r) {
                r.set('sortorder', x);

                var e = {
                    grid: this,
                    record: r,
                    cancel: false
                };
                this.fireEvent('afteredit', e);
                r.commit();
            }
        }
        return true;
    }
});
Ext.reg('contentblocks-grid-categories', ContentBlocksComponent.grid.Categories);

ContentBlocksComponent.grid.Fields = function(config) {
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
		id: 'contentblocks-grid-fields',
		baseParams: {
            action: 'mgr/fields/getlist'
        },
        autosave: true,
        save_action: 'mgr/fields/update_from_grid',
        emptyText: _('no_results'),
		fields: [
            {name: 'id', type: 'int'},
            {name: 'input', type: 'string'},
            {name: 'input_display', type: 'string'},
            {name: 'name', type: 'string'},
            {name: 'description', type: 'string'},
            {name: 'icon', type: 'string'},
            {name: 'icon_type', type: 'string'},
            {name: 'sortorder', type: 'int'},
            {name: 'template', type: 'string'},
            {name: 'properties', type: 'object'},
            {name: 'availability', type: 'object'},
            {name: 'layouts', type: 'string'},
            {name: 'times_per_page', type: 'int'},
            {name: 'times_per_layout', type: 'int'},
            {name: 'settings', type: 'object'}
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
			width: .3,
            renderer: function(v, cell, record) {
                if (record.data.icon.length > 0) {
                    var icon_type = (record.data.icon_type != '') ? record.data.icon_type : 'core',
                        icon_base_url = (icon_type == 'core') ? ContentBlocksComponent.config.assetsUrl + 'img/icons/' : ContentBlocksComponent.config.customIconUrl;
                    v = '<img class="contentblocks-icon" src="' + icon_base_url + record.data.icon + '.png" alt="' + record.data.icon + '" style=""> ' + v + ' <span class="contentblocks-id">(' + record.data.id + ')</span>';
                }
                return v;
            }
		},{
			header: _('contentblocks.input'),
			dataIndex: 'input',
			sortable: true,
			width: .1,
            renderer: function (v, cell, record) {
                return record.data.input_display
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
            text: _('contentblocks.add_field'),
            handler: this.addField,
            scope: this
        }, '->', {
            text: _('contentblocks.export_fields'),
            handler: this.exportFields,
            scope: this
        }, '-', {
            text: _('contentblocks.import_fields'),
            handler: this.importFields,
            scope: this
        }]
    });
    ContentBlocksComponent.grid.Fields.superclass.constructor.call(this,config);
};
Ext.extend(ContentBlocksComponent.grid.Fields,MODx.grid.Grid,{
    addField: function() {
        var win = MODx.load({
            xtype: 'contentblocks-window-field',
            listeners: {
                success: {fn: function() {
                    this.refresh();
                },scope: this},
                scope: this
            }
        });
        win.show();
    },

    editField: function() {
        var record = this.menu.record;
        var win = MODx.load({
            xtype: 'contentblocks-window-field',
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

    duplicateField: function() {
        var record =  vcJquery.extend(true, {}, this.menu.record);
        record.id = 0;
        var win = MODx.load({
            xtype: 'contentblocks-window-field',
            record: record,
            isUpdate: false,
            title: _('contentblocks.duplicate_field'),
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


    deleteField: function() {
        var record = this.menu.record;

        MODx.msg.confirm({
            title: _('warning'),
            text: _('contentblocks.delete_field.confirm'),
            url: ContentBlocksComponent.config.connectorUrl,
            params: {
                id: record.id,
                action: 'mgr/fields/remove'
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
            text: _('contentblocks.edit_field'),
            handler: this.editField,
            scope: this
        }, {
            text: _('contentblocks.duplicate_field'),
            handler: this.duplicateField,
            scope: this
        }, '-', {
            text: _('contentblocks.delete_field'),
            handler: this.deleteField,
            scope: this
        });
        return m;
    },

    exportFields: function() {
        Ext.Msg.confirm(_('contentblocks.export_fields'), _('contentblocks.export_fields.confirm'), function(e) {
            if (e == 'yes') {
                window.location = ContentBlocksComponent.config.connectorUrl + '?action=mgr/fields/export&HTTP_MODAUTH=' + MODx.siteId;
            }
        });
    },

    importFields: function() {
        var win = MODx.load({
            xtype: 'contentblocks-window-import',
            title: _('contentblocks.import_fields.title'),
            introduction: _('contentblocks.import_fields.intro'),
            what: _('contentblocks.fields'),
            baseParams: {
                action: 'mgr/fields/import'
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
Ext.reg('contentblocks-grid-fields',ContentBlocksComponent.grid.Fields);

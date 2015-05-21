ContentBlocksComponent.window.Field = function(config) {
    config = config || {};
    config.id = config.id || Ext.id(),
    Ext.applyIf(config,{
        title: (config.isUpdate) ?
            _('contentblocks.edit_field') :
            _('contentblocks.add_field'),
        autoHeight: true,
        boxMaxHeight:  Math.max(document.documentElement.clientHeight, window.innerHeight || 0) - 150 + 'px',
        resizable: false,
        maximizable: false,
        url: ContentBlocksComponent.config.connectorUrl,
        baseParams: {
            action: (config.isUpdate) ?
                'mgr/fields/update' :
                'mgr/fields/create'
        },
        width: 750,
        y: 20,
        bodyCssClass: 'window-vtabs',
        fields: [{
            xtype: 'hidden',
            name: 'id'
        },{
            width: 600,
            xtype: 'modx-vtabs',
            autoHeight: true,
            deferredRender: false,
            forceLayout: true,
            resizeTabs: false,
            hideMode: 'offsets',
            defaults: {
                border: false,
                layout: 'form',
                autoHeight: true,
                cls: 'main-wrapper',
                deferredRender: false,
                forceLayout: true,
                hideMode: 'offsets'
            },
            items: [{
                title: _('contentblocks.general'),
                layout: 'form',
                items: [{
                    xtype: 'contentblocks-combo-inputs',
                    name: 'input',
                    fieldLabel: _('contentblocks.input'),
                    allowBlank: false,
                    anchor: '100%',
                    maxLength: 255,
                    id: config.id + '-input',
                    formId: config.id,
                    listeners: {
                        select: {fn: function(fld) {
                            fld.fireEvent('change', fld);
                        }, scope: this},
                        change: this.inputChange,
                        blur: {fn: function(fld) {
                            fld.fireEvent('change', fld);
                        }, scope: this}
                    }
                },{
                    xtype: 'textfield',
                    name: 'name',
                    fieldLabel: _('contentblocks.name'),
                    allowBlank: false,
                    anchor: '100%',
                    maxLength: 255
                },{
                    xtype: 'textarea',
                    name: 'description',
                    fieldLabel: _('contentblocks.description'),
                    allowBlank: true,
                    anchor: '100%',
                    maxLength: 1024
                },{
                    xtype: 'contentblocks-combo-icons',
                    name: 'icon',
                    id: config.id + '-icon',
                    formId: config.id,
                    fieldLabel: _('contentblocks.icon'),
                    allowBlank: false,
                    anchor: '100%',
                    maxLength: 255,
                    listWidth: 435,
                    listeners: {
                        select: {fn: function(fld) {
                            fld.fireEvent('change', fld);
                        }, scope: this},
                        change: this.iconChange,
                        blur: {fn: function(fld) {
                            fld.fireEvent('change', fld);
                        }, scope: this}
                    }
                },{
                    xtype: 'hidden',
                    name: 'icon_type',
                    value: 'core',
                    id: config.id + '-icon_type',
                    fieldLabel: 'icon type',
                    anchor: '100%',
                    maxLength: 255,
                    listWidth: 435
                },{
                    xtype: 'numberfield',
                    name: 'sortorder',
                    fieldLabel: _('contentblocks.sortorder'),
                    allowBlank: false,
                    anchor: '100%',
                    maxLength: 5,
                    value: 0
                }]
            },{
                title: _('contentblocks.properties'),
                items: [{
                    layout: 'form',
                    bodyStyle: 'max-height: ' + (Math.max(document.documentElement.clientHeight, window.innerHeight || 0) - 150) + 'px;',
                    id: config.id + '-properties',
                    items: []
                }]
            },{
                title: _('contentblocks.availability'),
                id: config.id + '-availability',
                items: [{
                    xtype: 'panel',
                    cls: 'panel-desc',
                    html: '<p>' + _('contentblocks.availability.field_description') + '</p>'
                },{
                    xtype: 'contentblocks-grid-availability',
                    id: config.id + '-availability-grid'
                },{
                    layout: 'form',
                    bodyStyle: 'padding-top: 10px;',
                    items: [{
                        fieldLabel: _('contentblocks.availibility.layouts'),
                        description: _('contentblocks.availibility.layouts.description'),
                        xtype: 'textfield',
                        name: 'layouts',
                        anchor: '100%',
                        maxLength: 255,
                        allowBlank: true
                    },{
                        fieldLabel: _('contentblocks.availibility.times_per_page'),
                        description: _('contentblocks.availibility.times_per_page.description'),
                        xtype: 'numberfield',
                        name: 'times_per_page',
                        anchor: '100%',
                        allowNegative:false,
                        maxLength: 255,
                        allowBlank: true
                    },{
                        fieldLabel: _('contentblocks.availibility.times_per_layout'),
                        description: _('contentblocks.availibility.times_per_layout.description'),
                        xtype: 'numberfield',
                        name: 'times_per_layout',
                        anchor: '100%',
                        allowNegative:false,
                        maxLength: 255,
                        allowBlank: true
                    }]
                }]
            },{
                title: _('contentblocks.settings'),
                id: config.id + '-settings',
                items: [{
                    xtype: 'panel',
                    cls: 'panel-desc',
                    html: '<p>' + _('contentblocks.settings.field_description') + '</p>'
                },{
                    xtype: 'contentblocks-grid-settings',
                    id: config.id + '-settings-grid'
                }]
            }]
        }],

        listeners: {
            render: {fn: this.initWindow, scope: this},
            scope: this
        },

        keys: [],
        buttons: this.getWindowButtons(config)
    });
    ContentBlocksComponent.window.Field.superclass.constructor.call(this,config);
    this.on('beforeSubmit', this.beforeSubmit);
    this.on('render', this.initWindow);
};
Ext.extend(ContentBlocksComponent.window.Field, MODx.Window, {
    propHolder: null,
    getWindowButtons: function(config) {
        var b = [{
            text: _('cancel'),
            scope: this,
            handler: function() { this.hide(); }
        },'-'];

        if (config.isUpdate) {
            b.push([{
                text: _('save'),
                scope: this,
                handler: function() { this.submit(false); },
                cls: 'primary-button'
            },{
                text: _('save_and_close'),
                scope: this,
                handler: this.submit,
                cls: 'primary-button'
            }]);
        }
        else {
            b.push([{
                text: _('save'),
                scope: this,
                handler: this.submit,
                cls: 'primary-button'
            }]);
        }
        return b;
    },
    getDefaultProps: function() {
        var id = this.config.id + '-input',
            input = Ext.getCmp(id);

        this.propHolder = Ext.getCmp(this.config.id + '-properties');
        this.propHolder.add([{
            xtype: Ext.ComponentMgr.isRegistered('modx-texteditor') ? 'modx-texteditor' : 'textarea',
            mimeType: 'text/html',
            name: 'template',
            id: this.config.id + '-template',
            fieldLabel: _('contentblocks.template'),
            description: _('contentblocks.' + input.getValue() + '_template.description') || undefined,
            allowBlank: true,
            anchor: '100%',
            grow: true,
            growMin: 75,
            growMax: 400,
            value: (this.config.record) ? this.config.record.template : ''
        }]);
        this.propHolder.doLayout();
    },

    beforeSubmit: function() {
        var f = this.fp.getForm(),
            availability = [],
            grid = Ext.getCmp(this.config.id + '-availability-grid'),
            data = grid.getStore().data;
        data.each(function(item) {
            availability.push(item.data);
        });

        availability = Ext.encode(availability);

        // Get setting definitions
        var settings = [],
            settingsGrid = Ext.getCmp(this.config.id + '-settings-grid'),
            settingsData = settingsGrid.getStore().data;

        settingsData.each(function(item) {
            settings.push(item.data);
        });
        settings = Ext.encode(settings);

        Ext.apply(f.baseParams, {availability: availability, settings: settings});
    },

    initWindow: function() {
        this.getDefaultProps();

        var id = this.config.id + '-input',
            input = Ext.getCmp(id);

        input.getStore().on('load', function() {
            input.fireEvent('change', input);
        });

        var grid = Ext.getCmp(this.config.id + '-availability-grid'),
            availability = this.record && this.record.availability ? this.record.availability : false,
            store = grid.getStore();

        if (availability) {
            Ext.iterate(availability, function(av) {
                var rec = new grid.propRecord(av);
                store.add(rec);
            });
        }

        var settingGrid = Ext.getCmp(this.config.id + '-settings-grid'),
            settings = this.record && this.record.settings ? this.record.settings : false,
            settingsStore = settingGrid.getStore();

        if (settings) {
            Ext.iterate(settings, function(av) {
                var rec = new settingGrid.propRecord(av);
                settingsStore.add(rec);
            });
        }
    },

    inputChange: function(combo) {
        var f = Ext.getCmp(combo.formId),
            propHolder = Ext.getCmp(combo.formId + '-properties'),

            value = combo.getValue(),
            selected = combo.store.find('value', value),
            record = combo.getStore().getAt(selected),
            items = [],
            that = this;
        if (!record) {
            return;
        }

        Ext.each(record.data.properties, function(prop) {
            prop.name = 'properties[' + prop.key + ']';
            prop.value = (f.config.record && f.config.record.properties && f.config.record.properties[prop.key]) ? f.config.record.properties[prop.key] : prop.default;
            prop.anchor = '100%';

            switch (prop.xtype) {
                case 'code': // This is separate as it can use Ace
                    prop.xtype = Ext.ComponentMgr.isRegistered('modx-texteditor') ? 'modx-texteditor' : 'textarea';
                    prop.mimeType = 'text/html';
                    break;

                default:
                    //prop.xtype = 'textfield';
                    break;
            }
            items.push(prop);
        });

        propHolder.removeAll();
        with (f) {
            f.getDefaultProps();
        }
        if (items.length > 0) {
            propHolder.add([items]);
            propHolder.doLayout();
        }

        if (!f.config.isUpdate && !f.config.isDuplicate) {
            if (record.data.defaultTpl) {
                var tpl = Ext.getCmp(combo.formId + '-template');
                tpl.setValue(record.data.defaultTpl);
            }
            if (record.data.defaultIcon) {
                var icon = Ext.getCmp(combo.formId + '-icon');
                icon.setValue(record.data.defaultIcon);
                icon.fireEvent('change', icon);
            }
        }
    },

    iconChange: function(combo) {
        var f = Ext.getCmp(combo.formId),
            value = combo.getValue(),
            selected = combo.store.find('value', value),
            record = combo.getStore().getAt(selected);
        if (!record) {
            return;
        }
        var icon_type = Ext.getCmp(combo.formId + '-icon_type');
        icon_type.setValue(record.data.icon_type);
    }
});
Ext.reg('contentblocks-window-field', ContentBlocksComponent.window.Field);

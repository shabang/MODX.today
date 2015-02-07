ContentBlocksComponent.window.Settings = function(config) {
    config = config || {};
    config.id = config.id || Ext.id(),
    Ext.applyIf(config,{
        title: (config.isUpdate) ?
            _('contentblocks.edit_setting') :
            _('contentblocks.add_setting'),
        autoHeight: true,
        modal: true,
        width: 400,
        fields: [{
            xtype: 'textfield',
            name: 'reference',
            fieldLabel: _('contentblocks.reference'),
            allowBlank: false,
            anchor: '100%',
            maxLength: 25,
            vtype: 'alphanum'
        },{
            xtype: 'textfield',
            name: 'title',
            fieldLabel: _('contentblocks.title'),
            allowBlank: false,
            anchor: '100%'
        },{
            xtype: 'contentblocks-combo-fieldtypes',
            name: 'fieldtype',
            fieldLabel: _('contentblocks.fieldtype'),
            allowBlank: false,
            anchor: '100%',
            value: 'textfield',
            listeners: {
                blur: function(fld) {
                    setTimeout(function() {
                        fld.fireEvent('change', fld, fld.getValue());
                    }, 100)
                },
                change: function(fld, value) {
                    var fldOpts = Ext.getCmp(config.id + '-fieldoptions');
                    if (value != 'select') {
                        fldOpts.hide();
                    }
                    else {
                        fldOpts.show();
                    }
                }
            }
        },{
            xtype: 'textfield',
            name: 'default_value',
            fieldLabel: _('contentblocks.default_value'),
            allowBlank: true,
            anchor: '100%'
        },{
            xtype: 'textarea',
            name: 'fieldoptions',
            id: config.id + '-fieldoptions',
            fieldLabel: _('contentblocks.fieldoptions'),
            description: _('contentblocks.fieldoptions.description'),
            allowBlank: true,
            anchor: '100%',
            grow: true,
            growMin: 50,
            growMax: 150,
            hidden: (config.record) ? ( config.record.fieldtype != 'select' ) : true
        },{
            xtype: 'contentblocks-combo-field_is_exposed',
            fieldLabel : _('contentblocks.field_is_exposed'),
            description: _('contentblocks.field_is_exposed.description'),
            name: 'field_is_exposed',
            allowBlank: false,
            anchor: '100%',
            value: 'modal',
            id: config.id + '-field_is_exposed'
        },{
            xtype: 'checkbox',
            boxLabel : 'Process tags', //_('contentblocks.process_tags'),
            description: _('contentblocks.process_tags.description'),
            name: 'process_tags',
            allowBlank: false,
            anchor: '100%',
            inputValue: 1,
            id: config.id + '-process_tags'
        }],
        keys: []
    });
    ContentBlocksComponent.window.Settings.superclass.constructor.call(this,config);
};
Ext.extend(ContentBlocksComponent.window.Settings, MODx.Window, {
    submit: function() {
        var r = this.fp.getForm().getValues();
        this.fireEvent('success',r);
        this.close();
        return false;
    }
});
Ext.reg('contentblocks-window-settings',ContentBlocksComponent.window.Settings);

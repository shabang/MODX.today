moreGallery.panel.Resource = function(config) {
    moreGallery.panel.Resource.superclass.constructor.call(this,config);
    moreGallery.ResourceRecord = config.record;
};
Ext.extend(moreGallery.panel.Resource, MODx.panel.Resource, {
    defaultClassKey: 'mgResource',
    classLexiconKey: 'moregallery.name',

    getFields: function(config) {
        var fields = moreGallery.panel.Resource.superclass.getFields.call(this,config);

        var contentPosition = moreGallery.getResourceProperty(config.record, 'content_position', moreGallery.config.content_position);

        if (contentPosition == 'tab') {
            var tabs = fields.filter(function (row) {
                if(row.id == 'modx-resource-tabs') {
                    return row;
                } else {
                    return false;
                }
            });

            tabs[0].items.splice(1, 0, {
                title: _('resource_content'),
                id: 'modx-resource-content-tab',
                cls: 'modx-resource-tab',
                layout: 'form',
                labelAlign: 'top',
                labelSeparator: '',
                bodyCssClass: 'tab-panel-wrapper main-wrapper',
                autoHeight: true,
                items: [{
                    xtype: 'panel',
                    layout: 'form',
                    anchor: '98%',
                    border: false,
                    autoHeight: true,
                    id: 'modx-resource-content',
                    items: [MODx.panel.Resource.prototype.getContentField(config)]
                }]
            });
        }

        var ct = MODx.panel.Resource.prototype.getContentField(config);
        if (ct) {
            Ext.each(fields, function(item, index, all) {
                if(item.id == 'modx-resource-content') {
                    all[index] = this.getContentField(config);
                    return false;
                }
            }, this);
        }

        return fields;
    },

    getPageHeader: function() {
        return {
            html: '<h2>'+_('moregallery.new')+'</h2>'
            ,id: 'modx-resource-header'
            ,cls: 'modx-page-header'
            ,border: false
            ,forceLayout: true
            ,anchor: '100%'
        };
    },

    getContentField: function(config) {
        var rc = this.getResourceContentField(config);

        var c = {
            xtype: 'modx-panel',
            id: 'moregallery-content',
            items: [],
            border: false,
            defaults: {}
        };


        if (config.mode == 'update') {
            c.items.push([{
                xtype: 'modx-panel',
                title: _('moregallery.name'),
                id: 'mgresource-backbone-wrapper',
                html: '<div id="mgresource-backbone"></div>',
                bodyCssClass: 'main-wrapper',
                collapsible: true,
                animCollapse: false
            }]);
        }
        else {
            c.items.push([{
                html: '<p>' + _('moregallery.please_save_first') + '</p>',
                title: _('moregallery.name'),
                xtype: 'modx-panel',
                bodyCssClass: 'main-wrapper'
            }]);
        }

        var contentPosition = moreGallery.getResourceProperty(config.record, 'content_position', moreGallery.config.content_position);

        switch (contentPosition) {
            case 'above':
                return [rc, c];
            case 'below':
                return [c, rc];
        }
        return [c];
    },

    getResourceContentField: function(config) {
        return {
            title: _('resource_content')
            ,id: 'modx-resource-content'
            ,layout: 'form'
            ,bodyCssClass: 'main-wrapper'
            ,autoHeight: true
            ,collapsible: true
            ,animCollapse: false
            ,hideMode: 'offsets'
            ,items: MODx.panel.Resource.prototype.getContentField(config)
            ,style: 'margin-top: 10px'
        };
    },

    getSettingLeftFields: function(config) {
        var flds = MODx.panel.Resource.prototype.getSettingLeftFields(config);
        flds.push({
            xtype: 'contentblocks-combo-source'
            ,fieldLabel: _('moregallery.source')
            ,description: _('moregallery.source.desc')
            ,name: 'properties_source'
            ,hiddenName: 'properties_source'
            ,id: 'moregallery-source'
            ,anchor: '100%'
            ,value: moreGallery.getResourceProperty(config.record, 'source', 'inherit')
        },{
            xtype: 'textfield'
            ,fieldLabel: _('moregallery.relative_url')
            ,description: _('moregallery.relative_url.desc')
            ,name: 'properties_relative_url'
            ,hiddenName: 'properties_relative_url'
            ,id: 'moregallery-relative_url'
            ,anchor: '100%'
            ,value: moreGallery.getResourceProperty(config.record, 'relative_url', 'inherit')
        },{
            xtype: 'moregallery-combo-contentlocation'
            ,fieldLabel: _('moregallery.content_position')
            ,description: _('moregallery.content_position.desc')
            ,name: 'properties_content_position'
            ,hiddenName: 'properties_content_position'
            ,id: 'moregallery-content_position'
            ,anchor: '100%'
            ,value: moreGallery.getResourceProperty(config.record, 'content_position', 'inherit')
        },{
            xtype: 'textfield'
            ,fieldLabel: _('setting_moregallery.crops')
            ,description: _('setting_moregallery.crops_desc')
            ,name: 'properties_crops'
            ,hiddenName: 'properties_crops'
            ,id: 'moregallery-crops'
            ,anchor: '100%'
            ,value: moreGallery.getResourceProperty(config.record, 'crops', 'inherit')
        });
        return flds;
    }
});
Ext.reg('modx-panel-resource',moreGallery.panel.Resource);

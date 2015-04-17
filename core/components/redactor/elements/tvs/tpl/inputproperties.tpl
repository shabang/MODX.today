<div id="tv-input-properties-form{$tv}"></div>
{literal}
<script type="text/javascript">
// <![CDATA[
var params = {
{/literal}{foreach from=$params key=k item=v name='p'}
 '{$k}': '{$v|escape:"javascript"}'{if NOT $smarty.foreach.p.last},{/if}
{/foreach}{literal}
};
var oc = {'change':{fn:function(){Ext.getCmp('modx-panel-tv').markDirty();},scope:this}};
MODx.load({
    renderTo: 'tv-input-properties-form{/literal}{$tv}{literal}'
    ,xtype: 'panel'
    ,layout: 'column'
    ,autoHeight: true
    ,border: false
    ,items: [{
        columnWidth:.5,
        border: false,
        layout: 'form',
        cls: 'form-with-labels',
        labelAlign: 'top',
        items: [{
            xtype: 'radiogroup'
            ,fieldLabel: 'Air Mode'
            ,description: 'Air Mode'
            ,name: 'inopt_air'
            ,hiddenName: 'inopt_air'
            ,columns: 1
            ,items: [
                {boxLabel: 'On', name: 'inopt_air', inputValue: '1'},
                {boxLabel: 'Off', name: 'inopt_air', inputValue: '0'},
                {boxLabel: 'Inherit', name: 'inopt_air', inputValue: 'inherit'}
            ]
            ,listeners: oc
            ,value: params['air']
            ,defaultValue: 'inherit'
        },{
            xtype: 'radiogroup'
            ,fieldLabel: 'Auto Resize'
            ,description: 'Auto Resize'
            ,name: 'inopt_autoresize'
            ,hiddenName: 'inopt_autoresize'
            ,columns: 1
            ,items: [
                {boxLabel: 'On', name: 'inopt_autoresize', inputValue: '1'},
                {boxLabel: 'Off', name: 'inopt_autoresize', inputValue: '0'},
                {boxLabel: 'Inherit', name: 'inopt_autoresize', inputValue: 'inherit'}
            ]
            ,listeners: oc
            ,value: params['autoresize']
            ,defaultValue: 'inherit'
        },{
            xtype: 'radiogroup'
            ,fieldLabel: 'Adv Attributes'
            ,description: 'Adv Attributes'
            ,name: 'inopt_advAttrib'
            ,hiddenName: 'inopt_advAttrib'
            ,columns: 1
            ,items: [
                {boxLabel: 'On', name: 'inopt_advAttrib', inputValue: 1},
                {boxLabel: 'Off', name: 'inopt_advAttrib', inputValue: 0},
                {boxLabel: 'Inherit', name: 'inopt_advAttrib', inputValue: 'inherit'}
            ]
            ,listeners: oc
            ,value: params['advAttrib']
            ,defaultValue: 'inherit'
        },{
            xtype: 'radiogroup'
            ,fieldLabel: 'Cleanup'
            ,description: 'Cleanup'
            ,name: 'inopt_cleanup'
            ,hiddenName: 'inopt_cleanup'
            ,columns: 1
            ,items: [
                {boxLabel: 'On', name: 'inopt_cleanup', inputValue: '1'},
                {boxLabel: 'Off', name: 'inopt_cleanup', inputValue: '0'},
                {boxLabel: 'Inherit', name: 'inopt_cleanup', inputValue: 'inherit'}
            ]
            ,listeners: oc
            ,value: params['cleanup']
            ,defaultValue: 'inherit'
        },{
            xtype: 'radiogroup'
            ,fieldLabel: 'Convert Divs'
            ,description: 'Convert Divs'
            ,name: 'inopt_convertDivs'
            ,hiddenName: 'inopt_convertDivs'
            ,columns: 1
            ,items: [
                {boxLabel: 'On', name: 'inopt_convertdivs', inputValue: '1'},
                {boxLabel: 'Off', name: 'inopt_convertdivs', inputValue: '0'},
                {boxLabel: 'Inherit', name: 'inopt_convertdivs', inputValue: 'inherit'}
            ]
            ,listeners: oc
            ,value: params['convertdivs']
            ,defaultValue: 'inherit'
        },{
            xtype: 'radiogroup'
            ,fieldLabel: 'Clean Spaces'
            ,description: 'Clean Spaces'
            ,name: 'inopt_cleanSpaces'
            ,hiddenName: 'inopt_cleanSpaces'
            ,columns: 1
            ,items: [
                {boxLabel: 'On', name: 'inopt_cleanSpaces', inputValue: '1'},
                {boxLabel: 'Off', name: 'inopt_cleanSpaces', inputValue: '0'},
                {boxLabel: 'Inherit', name: 'inopt_cleanSpaces', inputValue: 'inherit'}
            ]
            ,listeners: oc
            ,value: params['cleanSpaces']
            ,defaultValue: 'inherit'
        },{
            xtype: 'radiogroup'
            ,fieldLabel: 'Convert Links'
            ,description: 'Convert Links'
            ,name: 'inopt_convertLinks'
            ,hiddenName: 'inopt_convertLinks'
            ,columns: 1
            ,items: [
                {boxLabel: 'On', name: 'inopt_convertlinks', inputValue: '1'},
                {boxLabel: 'Off', name: 'inopt_convertlinks', inputValue: '0'},
                {boxLabel: 'Inherit', name: 'inopt_convertlinks', inputValue: 'inherit'}
            ]
            ,listeners: oc
            ,value: params['convertlinks']
            ,defaultValue: 'inherit'
        },{
            xtype: 'radiogroup'
            ,fieldLabel: 'WYM'
            ,description: 'WYM'
            ,name: 'inopt_wym'
            ,hiddenName: 'inopt_wym'
            ,columns: 1
            ,items: [
                {boxLabel: 'On', name: 'inopt_wym', inputValue: '1'},
                {boxLabel: 'Off', name: 'inopt_wym', inputValue: '0'},
                {boxLabel: 'Inherit', name: 'inopt_wym', inputValue: 'inherit'}
            ]
            ,listeners: oc
            ,value: params['wym']
            ,defaultValue: 'inherit'
        },{
            xtype: 'radiogroup'
            ,fieldLabel: 'Typewriter'
            ,description: 'Typewriter'
            ,name: 'inopt_typewriter'
            ,hiddenName: 'inopt_typewriter'
            ,columns: 1
            ,items: [
                {boxLabel: 'On', name: 'inopt_typewriter', inputValue: '1'},
                {boxLabel: 'Off', name: 'inopt_typewriter', inputValue: '0'},
                {boxLabel: 'Inherit', name: 'inopt_typewriter', inputValue: 'inherit'}
            ]
            ,listeners: oc
            ,value: params['typewriter']
            ,defaultValue: 'inherit'
        },{
            xtype: 'radiogroup'
            ,fieldLabel: 'Source Button'
            ,description: 'Source Button'
            ,name: 'inopt_buttonSource'
            ,hiddenName: 'inopt_buttonSource'
            ,columns: 1
            ,items: [
                {boxLabel: 'On', name: 'inopt_buttonSource', inputValue: '1'},
                {boxLabel: 'Off', name: 'inopt_buttonSource', inputValue: '0'},
                {boxLabel: 'Inherit', name: 'inopt_buttonSource', inputValue: 'inherit'}
            ]
            ,listeners: oc
            ,value: params['buttonSource']
            ,defaultValue: 'inherit'
        },{
            xtype: 'radiogroup'
            ,fieldLabel: 'Fullpage'
            ,description: 'Fullpage'
            ,name: 'inopt_fullpage'
            ,hiddenName: 'inopt_fullpage'
            ,columns: 1
            ,items: [
                {boxLabel: 'On', name: 'inopt_fullpage', inputValue: '1'},
                {boxLabel: 'Off', name: 'inopt_fullpage', inputValue: '0'},
                {boxLabel: 'Inherit', name: 'inopt_fullpage', inputValue: 'inherit'}
            ]
            ,listeners: oc
            ,value: params['fullpage']
            ,defaultValue: 'inherit'
        },{
            xtype: 'radiogroup'
            ,fieldLabel: 'Fullscreen Button'
            ,description: 'Fullscreen Button'
            ,name: 'inopt_buttonFullScreen'
            ,hiddenName: 'inopt_buttonFullScreen'
            ,columns: 1
            ,items: [
                {boxLabel: 'On', name: 'inopt_buttonFullScreen', inputValue: '1'},
                {boxLabel: 'Off', name: 'inopt_buttonFullScreen', inputValue: '0'},
                {boxLabel: 'Inherit', name: 'inopt_buttonFullScreen', inputValue: 'inherit'}
            ]
            ,listeners: oc
            ,value: params['buttonFullScreen']
            ,defaultValue: 'inherit'
        },{
            xtype: 'radiogroup'
            ,fieldLabel: 'Toolbar Overflow'
            ,description: 'Toolbar Overflow'
            ,name: 'inopt_toolbarOverflow'
            ,hiddenName: 'inopt_toolbarOverflow'
            ,columns: 1
            ,items: [
                {boxLabel: 'On', name: 'inopt_toolbarOverflow', inputValue: '1'},
                {boxLabel: 'Off', name: 'inopt_toolbarOverflow', inputValue: '0'},
                {boxLabel: 'Inherit', name: 'inopt_toolbarOverflow', inputValue: 'inherit'}
            ]
            ,listeners: oc
            ,value: params['toolbarOverflow']
            ,defaultValue: 'inherit'
        },{
            xtype: 'radiogroup'
            ,fieldLabel: 'Toolbar Fixed'
            ,description: 'Toolbar Fixed'
            ,name: 'inopt_toolbarFixed'
            ,hiddenName: 'inopt_toolbarFixed'
            ,columns: 1
            ,items: [
                {boxLabel: 'On', name: 'inopt_toolbarFixed', inputValue: '1'},
                {boxLabel: 'Off', name: 'inopt_toolbarFixed', inputValue: '0'},
                {boxLabel: 'Inherit', name: 'inopt_toolbarFixed', inputValue: 'inherit'}
            ]
            ,listeners: oc
            ,value: params['toolbarFixed']
            ,defaultValue: 'inherit'
        },{
            xtype: 'radiogroup'
            ,fieldLabel: 'Toolbar Fixed Box'
            ,description: 'Toolbar Fixed Box'
            ,name: 'inopt_toolbarFixedBox'
            ,hiddenName: 'inopt_toolbarFixedBox'
            ,columns: 1
            ,items: [
                {boxLabel: 'On', name: 'inopt_toolbarFixedBox', inputValue: '1'},
                {boxLabel: 'Off', name: 'inopt_toolbarFixedBox', inputValue: '0'},
                {boxLabel: 'Inherit', name: 'inopt_toolbarFixedBox', inputValue: 'inherit'}
            ]
            ,listeners: oc
            ,value: params['toolbarFixedBox']
            ,defaultValue: 'inherit'
        },{
            xtype: 'radiogroup'
            ,fieldLabel: 'Direction'
            ,description: 'Direction'
            ,name: 'inopt_direction'
            ,hiddenName: 'inopt_direction'
            ,id: 'inopt_direction{/literal}{$tv}{literal}'
            ,columns: 1
            ,value: params['direction']
            ,items: [
                {boxLabel: 'Left to Right', name: 'inopt_direction', inputValue: 'ltr'},
                {boxLabel: 'Right to Left', name: 'inopt_direction', inputValue: 'rtl'},
                {boxLabel: 'Inherit', name: 'inopt_direction', inputValue: 'inherit'}
            ]
            ,listeners: oc
            ,value: params['direction']
            ,defaultValue: 'inherit'
        },{
            xtype: 'radiogroup'
            ,fieldLabel: 'Protocol'
            ,description: 'Protocol'
            ,name: 'inopt_linkProtocol'
            ,hiddenName: 'inopt_linkProtocol'
            ,columns: 1
            ,items: [
                {boxLabel: 'None', name: 'inopt_linkProtocol', inputValue: 'none'},
                {boxLabel: 'http://', name: 'inopt_linkProtocol', inputValue: 'http://'},
                {boxLabel: 'https://', name: 'inopt_linkProtocol', inputValue: 'https://'},
                {boxLabel: 'Inherit', name: 'inopt_linkProtocol', inputValue: 'inherit'}
            ]
            ,listeners: oc
            ,value: params['linkProtocol']
            ,defaultValue: 'inherit'
        },{
            xtype: 'radiogroup'
            ,fieldLabel: 'No Follow'
            ,description: 'No Follow'
            ,name: 'inopt_noFollow'
            ,hiddenName: 'inopt_noFollow'
            ,columns: 1
            ,items: [
                {boxLabel: 'On', name: 'inopt_noFollow', inputValue: 1},
                {boxLabel: 'Off', name: 'inopt_noFollow', inputValue: 0},
                {boxLabel: 'Inherit', name: 'inopt_noFollow', inputValue: 'inherit'}
            ]
            ,listeners: oc
            ,value: params['noFollow']
            ,defaultValue: 'inherit'
        },{
            xtype: 'radiogroup'
            ,fieldLabel: 'Mobile'
            ,description: 'Mobile'
            ,name: 'inopt_mobile'
            ,hiddenName: 'inopt_mobile'
            ,columns: 1
            ,items: [
                {boxLabel: 'On', name: 'inopt_mobile', inputValue: 1},
                {boxLabel: 'Off', name: 'inopt_mobile', inputValue: 0},
                {boxLabel: 'Inherit', name: 'inopt_mobile', inputValue: 'inherit'}
            ]
            ,listeners: oc
            ,value: params['mobile']
            ,defaultValue: 'inherit'
        },{
            xtype: 'radiogroup'
            ,fieldLabel: 'Drag Upload'
            ,description: 'Drag Upload'
            ,name: 'inopt_dragUpload'
            ,hiddenName: 'inopt_dragUpload'
            ,columns: 1
            ,items: [
                {boxLabel: 'On', name: 'inopt_dragUpload', inputValue: 1},
                {boxLabel: 'Off', name: 'inopt_dragUpload', inputValue: 0},
                {boxLabel: 'Inherit', name: 'inopt_dragUpload', inputValue: 'inherit'}
            ]
            ,listeners: oc
            ,value: params['dragUpload']
            ,defaultValue: 'inherit'
        },{
            xtype: 'radiogroup'
            ,fieldLabel: 'Convert Image Links'
            ,description: 'Convert Image Links'
            ,name: 'inopt_convertImageLinks'
            ,hiddenName: 'inopt_convertImageLinks'
            ,columns: 1
            ,items: [
                {boxLabel: 'On', name: 'inopt_convertImageLinks', inputValue: 1},
                {boxLabel: 'Off', name: 'inopt_convertImageLinks', inputValue: 0},
                {boxLabel: 'Inherit', name: 'inopt_convertImageLinks', inputValue: 'inherit'}
            ]
            ,listeners: oc
            ,value: params['convertImageLinks']
            ,defaultValue: 'inherit'
        },{
            xtype: 'radiogroup'
            ,fieldLabel: 'Convert Video Links'
            ,description: 'Convert Video Links'
            ,name: 'inopt_convertVideoLinks'
            ,hiddenName: 'inopt_convertVideoLinks'
            ,columns: 1
            ,items: [
                {boxLabel: 'On', name: 'inopt_convertVideoLinks', inputValue: 1},
                {boxLabel: 'Off', name: 'inopt_convertVideoLinks', inputValue: 0},
                {boxLabel: 'Inherit', name: 'inopt_convertVideoLinks', inputValue: 'inherit'}
            ]
            ,listeners: oc
            ,value: params['convertVideoLinks']
            ,defaultValue: 'inherit'
        }]
    },{
        columnWidth:.5,
        border: false,
        layout: 'form',
        cls: 'form-with-labels',
        labelAlign: 'top',
        items: [{
            xtype: 'panel',
            html: '<p>Leave any of the fields below empty to use the default from the System Settings.</p>',
            border: false
        },{
            xtype: 'modx-combo-language'
            ,fieldLabel: 'Language'
            ,description: 'Language'
            ,name: 'inopt_lang'
            ,hiddenName: 'inopt_lang'
            ,listeners: oc
            ,value: params['lang']
            ,anchor: '100%'
            ,allowBlank: true
        },{
            xtype: 'textarea'
            ,fieldLabel: 'Allowed Tags'
            ,name: 'inopt_allowedTags'
            ,listeners: oc
            ,value: params['allowedTags']
            ,anchor: '100%'
        },{
            xtype: 'textarea'
            ,fieldLabel: 'Denied Tags'
            ,name: 'inopt_deniedTags'
            ,listeners: oc
            ,value: params['deniedTags']
            ,anchor: '100%'
        },{
            xtype: 'textarea'
            ,fieldLabel: 'Formatting Tags'
            ,description: 'Formatting Tags'
            ,name: 'inopt_formattingTags'
            ,listeners: oc
            ,value: params['formattingTags']
            ,anchor: '100%'
        },{
            xtype: 'textarea'
            ,fieldLabel: 'Custom Formatting'
            ,description: 'Custom Formatting'
            ,name: 'inopt_stylesJson'
            ,listeners: oc
            ,value: params['stylesJson']
            ,anchor: '100%'
        },{
            xtype: 'textarea'
            ,fieldLabel: 'Clips'
            ,description: 'Clips'
            ,name: 'inopt_clipsJson'
            ,listeners: oc
            ,value: params['clipsJson']
            ,anchor: '100%'
        },{
            xtype: 'textarea'
            ,fieldLabel: 'Colors'
            ,name: 'inopt_colors'
            ,listeners: oc
            ,value: params['colors']
            ,anchor: '100%'
        },{
            xtype: 'textarea'
            ,fieldLabel: 'Air Buttons'
            ,description: 'Air Buttons'
            ,name: 'inopt_airButtons'
            ,listeners: oc
            ,value: params['airButtons']
            ,anchor: '100%'
        },{
            xtype: 'textarea'
            ,fieldLabel: 'Buttons'
            ,description: 'Buttons'
            ,name: 'inopt_buttons'
            ,listeners: oc
            ,value: params['buttons']
            ,anchor: '100%'
        },{
            xtype: 'textarea'
            ,fieldLabel: 'Hidden Mobile Buttons'
            ,description: 'Hidden Mobile Buttons'
            ,name: 'inopt_buttonsHideOnMobile'
            ,listeners: oc
            ,value: params['buttonsHideOnMobile']
            ,anchor: '100%'
        },{
            xtype: 'textfield'
            ,fieldLabel: 'Min Height'
            ,description: 'Min Height'
            ,name: 'inopt_minHeight'
            ,listeners: oc
            ,value: params['minHeight']
        },{
            xtype: 'modx-combo-source'
            ,fieldLabel: 'Media Source'
            ,name: 'inopt_mediasource'
            ,hiddenName: 'inopt_mediasource'
            ,listeners: oc
            ,value: params['mediasource']
            ,anchor: '100%'
        },{
            xtype: 'radiogroup'
            ,fieldLabel: 'Image Tab Link'
            ,description: 'Image Tab Link'
            ,name: 'inopt_imageTabLink'
            ,hiddenName: 'inopt_imageTabLink'
            ,columns: 1
            ,items: [
                {boxLabel: 'On', name: 'inopt_imageTabLink', inputValue: '1'},
                {boxLabel: 'Off', name: 'inopt_imageTabLink', inputValue: '0'},
                {boxLabel: 'Inherit', name: 'inopt_imageTabLink', inputValue: 'inherit'}
            ]
            ,listeners: oc
            ,value: params['imageTabLink']
            ,defaultValue: 'inherit'
        },{
            xtype: 'textfield'
            ,fieldLabel: 'Image Upload Path'
            ,name: 'inopt_image_upload_path'
            ,listeners: oc
            ,value: params['image_upload_path']
            ,anchor: '100%'
        },{
            xtype: 'textfield'
            ,fieldLabel: 'Image Browse Path'
            ,name: 'inopt_image_browse_path'
            ,listeners: oc
            ,value: params['image_browse_path']
            ,anchor: '100%'
        },{
            xtype: 'textfield'
            ,fieldLabel: 'File Upload Path'
            ,name: 'inopt_file_upload_path'
            ,listeners: oc
            ,value: params['file_upload_path']
            ,anchor: '100%'
        },{
            xtype: 'textfield'
            ,fieldLabel: 'File Browse Path'
            ,name: 'inopt_file_browse_path'
            ,listeners: oc
            ,value: params['file_browse_path']
            ,anchor: '100%'
        },{
            xtype: 'textfield'
            ,fieldLabel: 'Predefined Links'
            ,name: 'inopt_predefinedLinks'
            ,listeners: oc
            ,value: params['predefinedLinks']
            ,anchor: '100%'
        }]
    }]
});
// ]]>
</script>
{/literal}

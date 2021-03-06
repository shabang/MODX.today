var ContentBlocksFields, ContentBlocksLayouts, ContentBlocksCategories, ContentBlocksContents, ContentBlocksConfig, ContentBlocksWrapperCls, ContentBlocksExtraSelectors, ContentBlocksTemplates, ContentBlocksResource;

ContentBlocksConfig.permissions = ContentBlocksConfig.permissions || {};

var vcJquery = $.noConflict();
(function ($) {
    // For retina icons
    var dpr = (window.devicePixelRatio && window.devicePixelRatio > 1) ? '@2x' : '';

    // Make the underscore function available in templates for i18n
    tmpl.helper += ",_=window._";
    window.ContentBlocks = {
        debug: ContentBlocksConfig.debug,
        $: $,
        cbWrapper: {},
        fldId: 0,
        layoutId: 0,
        addField: function (container, fldId, placeholders, position) {
            var fieldType = (ContentBlocksFields['_'+fldId]) ? $.extend(true, {}, ContentBlocksFields['_'+fldId]) : {
                input: (window.Ext && Ext.getCmp && Ext.getCmp('modx-resource-richtext') && Ext.getCmp('modx-resource-richtext').getValue()) ? 'richtext' : 'textarea',
                name: 'Content'
            };
            position = (position || position === 0) ? position : 'bottom';

            var settings = placeholders.settings;
            vcJquery.extend(placeholders, fieldType);

            // Add a unique ID
            ContentBlocks.fldId++;
            placeholders.generated_id = 'contentblocks-field-' + ContentBlocks.fldId;
            placeholders.field = fldId;

            // Build the field from its input template
            try {
                var generatedField = tmpl('contentblocks-field-' + fieldType.input, placeholders);
            } catch (e) {
                ContentBlocks.alert(_('contentblocks.error.input_not_found.message', {input: fieldType.input}) , _('contentblocks.error.input_not_found'));
                if (window.console) {
                    console.error('Error initialising input type "' + fieldType.input + '": ' + e.message);
                    console.log(e.stack);
                }
                return;
            }

            // Inject it top of bottom of the stack
            if (position == 'top') container.prepend(generatedField);
            else if (position == 'bottom') container.append(generatedField);
            else container.children('li').eq(position).after(generatedField);

            // Get the generated DOM as jQuery object
            var dom = $('#' + placeholders.generated_id),
                ab = dom.find('.contentblocks-field-actions');
            // Add the "delete field" button
            ab.append(tmpl('contentblocks-button-delete-field', {}));
            
            var allFieldSettings = ContentBlocks.getSettingFields(fieldType.settings);
            if(allFieldSettings.modalFields.length) {
                var modalFieldSettingsHTML = tmpl('contentblocks-button-field-settings', {});
                ab.append(modalFieldSettingsHTML);
            }

            if (settings) {
                dom.data('settings', Ext.encode(settings));
            }

            // Create a new instance of the input js
            if (typeof ContentBlocks.fieldTypes[fieldType.input] !== 'function') {
                ContentBlocks.alert('Uh oh, could not load the input type ' + fieldType.input);
                return;
            }

            var input = ContentBlocks.fieldTypes[fieldType.input](dom, placeholders);
            input.id = placeholders.generated_id;
            if (input.init) input.init();
            input.fieldId = fldId;

            // Store the input
            ContentBlocks.generatedContentFields[placeholders.generated_id] = input;
            if (allFieldSettings.exposedFields.length || allFieldSettings.exposedSettingFields.length) {
                ContentBlocks.addExposedFieldSettings(dom);
            }
            
            container.removeClass('contentblocks-column-is-empty');

            ContentBlocks.fixColumnHeights();

            return dom;
        },

        deleteField: function(e, field, noConfirm) {
            field = field || $(this).closest('.contentblocks-field');
            noConfirm = noConfirm || false;
            var fieldWrapper = field.closest('li.contentblocks-field-outer'),
                fieldGeneratedId = fieldWrapper.attr('id'),
                input = ContentBlocks.generatedContentFields[fieldGeneratedId],
                container = $(this).closest('.contentblocks-content'),           
                requireConfirm = input && input.confirmBeforeDelete ? input.confirmBeforeDelete : function() {
                    if (input && input.getData) {
                        var inpData = input.getData();

                        for (var key in inpData) {
                            if (inpData.hasOwnProperty(key) && inpData[key].length) {
                                return true;
                            }
                        }
                    }
                    return false;
                };
                

            if (noConfirm || !requireConfirm() || ContentBlocks.utilities.confirm(_('contentblocks.delete_field.confirm.js'))) {
                if (input && input.destroy) input.destroy();
                fieldWrapper.remove();
                delete ContentBlocks.generatedContentFields[fieldGeneratedId];

                if(container.children().length == 1) {
                    container.addClass('contentblocks-column-is-empty');
                }
                else {
                    container.removeClass('contentblocks-column-is-empty');
                } 
                
                ContentBlocks.fixColumnHeights();
                ContentBlocks.fireChange();
            }
        },

        fixColumnHeights: function() {
            // Make sure ContentBlocks is done initialising, otherwise we don't have the dom ready
            if (!ContentBlocks.initialized) {
                return;
            }
            var $column = null,
                container = $('.contentblocks-layout-wrapper'),
                layouts = container.find('.contentblocks-region-content'),
                allColumns = container.find('.contentblocks-region');

            // Reset all min heights
            allColumns.css('min-height', '');

            $.each(layouts, function(indx, layout) {
                var highest = 0,
                    height = 0,
                    $layout = $(layout),
                    regions = $layout.find('.contentblocks-region').not($layout.find('.contentblocks-region .contentblocks-region')),
                    layoutWidth = $layout.width(),
                    columnWidths = 0,
                    affectedColumns = [];

                $.each(regions, function(index, column) {
                    $column = $(column);
                    columnWidths = columnWidths + $column.outerWidth();

                    affectedColumns.push($column);

                    height = $column.outerHeight();
                    if (height > highest) {
                        highest = height;
                    }

                    if (columnWidths >= layoutWidth) {
                        $.each(affectedColumns, function(index, $affColumn) {
                            $affColumn.css('min-height', highest + 'px');
                            if (!$affColumn.hasClass('contentblocks-region-middle')) {
                                $affColumn.addClass('contentblocks-region-middle');

                                if ((index + 1) === affectedColumns.length) {
                                    $affColumn.addClass('contentblocks-region-last');
                                }
                            }
                        });
                        affectedColumns = [];
                        highest = 0;
                        columnWidths = 0;
                    }
                });

                $.each(affectedColumns, function(index, $affColumn) {
                    $affColumn.css('min-height', highest + 'px');
                });
            });
        },

        fireChange: function() {
            if (ContentBlocks.initialized) {
                if (MODx.fireResourceFormChange) MODx.fireResourceFormChange();
            }
        },

        buildContents: function (content, container) {
            // default container is top-level
            container = container ? container : $('.contentblocks-wrapper > .contentblocks-layout-wrapper');
            this.$.each(content, function (index, region) {
                // actually build the layout with the correct container
                ContentBlocks.buildLayout(region.layout, region.content, region.settings || {}, container, region.title);
            });
        },

        buildLayout: function (layoutId, content, settings, container, title, position) {
            position = (position || position === 0) ? position : 'bottom';
            container = container || $('.contentblocks-wrapper > .contentblocks-layout-wrapper');
            ContentBlocks.layoutId++;
            var meta = null;

            if (ContentBlocksLayouts['_' + layoutId]) {
                meta = $.extend(true, {}, ContentBlocksLayouts['_'+layoutId]);
            }

            // Layout not found? Fall back to the default layout
            if (!meta && ContentBlocksLayouts['_' + ContentBlocksConfig.default_layout]) {
                meta = $.extend(true, {}, ContentBlocksLayouts['_' + ContentBlocksConfig.default_layout]);
            }

            // Still not?
            if (!meta) {
                container.append('<li class="contentblocks-layout">' +
                    '<div class="contentblocks-region-container">' +
                    '   <div class="contentblocks-region-content" style="padding: 2em;">' +
                    '<p class="error"><b>Layout #' + layoutId + ' was requested, but it does not exist.</b> The default layout #' + ContentBlocksConfig.default_layout + ' was also not found. This probably means you either have no layouts defined yet in the ContentBlocks component, the contentblocks.default_layout setting is not defined properly, or a layout that was in use has been removed. <a href="https://support.modmore.com/faq/8-contentblocks/#faq_149">Read more about this issue and how to resolve it.</a></p>' +
                    '<p>When you save this resource, the content of this layout will be deleted. If you may need to restore the content, copy the following raw data to a safe place before saving.</p><textarea>' + Ext.encode(content) + '</textarea>' +
                    '</div></div></li>');
                return false;
            }

            // Support for adding per-layout titles to the layout
            meta.title = title || meta.name;

            // Decode the columns
            var columns = Ext.decode(meta.columns),
                columnCount = columns.length,
                columnsHtml = [],
                columnIndex = 1;

            meta.generated_id = 'layout-' + layoutId + '-' + ContentBlocks.layoutId;

            this.$.each(columns, function (index, column) {
                column.classes = (columnIndex == columnCount) ? 'contentblocks-region-last' : '';
                columnsHtml.push(tmpl('contentblocks-layout-column', column));
                columnIndex++;
            });

            meta.columns_html = columnsHtml.join('');
            var html = tmpl('contentblocks-layout-wrapper', meta);

            // Add layout to container
            if (position == 'top') container.prepend(html);
            else if (position == 'bottom') container.append(html);
            else container.children('li').eq(position).before(html);

            // Get the injected layout
            var layout = container.find('#' + meta.generated_id);
            
            if (settings) {
                layout.parent().data('settings', Ext.encode(settings));
            }
            
            var allLayoutSettings = ContentBlocks.getSettingFields(meta.settings);
            
            if (!meta.settings || meta.settings.length < 1 || !allLayoutSettings.modalFields.length) {
                layout.find('.contentblocks-layout-settings').hide();
            }
            
            if (allLayoutSettings.exposedFields.length || allLayoutSettings.exposedSettingFields.length) {
              ContentBlocks.addExposedLayoutSettings(layout.parent());
            }
            else {
              layout.find('.contentblocks-region-settings').hide();
            }
            
            var addContentHere = tmpl('contentblocks-empty-field');
            
            var markupColumns = layout.find('.contentblocks-region-content').first().children('.contentblocks-region[data-part]');
            $.each(markupColumns, function(index, column) {
                var container = $(column).find('.contentblocks-content');
                container.prepend(addContentHere);
            });

            // Add fields to the layout
            $.each(content, function (key, fields) {
                var column = layout.find('.contentblocks-region-content').first().children('.contentblocks-region[data-part=' + key + ']');
                $.each(fields, function (index, field) {
                    var container = column.find('.contentblocks-content').first();
                    ContentBlocks.addField(container, field.field, field);
                });
            });

            // Enable the sortable
            layout.find('.contentblocks-content').sortable({
                connectWith: '.contentblocks-content',
                forceHelperSize: true,
                forcePlaceholderSize: true,
                placeholder: 'ui-sortable-placeholder',
                tolerance: 'pointer',
                cursor: 'move',
                cancel: 'input,textarea,button,select,option,.prevent-drag',
                update: function(event, ui) {
                    ui.item.trigger('contentblocks:field_dragged');
                    ContentBlocks.fixColumnHeights();
                    ContentBlocks.fireChange();
                },

                start: function(event, ui) {
                    ui.placeholder.height(ui.item.height());
                },

                stop: function(event, ui) {
                    if (window.tinymce) {
                        var tinyInstance = ui.item.find('.mceEditor');
                        if (tinyInstance.length > 0) {
                            var tinyId = $(tinyInstance[0]).attr('id').replace('textarea_parent','textarea');
                            tinymce.execCommand('mceRemoveControl', true, tinyId);
                            tinymce.execCommand('mceAddControl', true, tinyId);
                        }
                    }
                    $('.contentblocks-content').each(function() {
                        if($(this).children().length == 1) {
                            $(this).addClass('contentblocks-column-is-empty');
                        }
                        else {
                            $(this).removeClass('contentblocks-column-is-empty');
                        }                      
                    });
                    ContentBlocks.fixColumnHeights();
                }
            }).each(function() {
                if($(this).children().length == 1) {
                    $(this).addClass('contentblocks-column-is-empty');
                }
            });
            
            ContentBlocks.generatedLayouts[meta.generated_id] = meta;
            ContentBlocks.fixColumnHeights();
            return layout;
        },

        buildTemplate: function (templateId, container, position) {
            var meta = $.extend(true, {}, ContentBlocksTemplates['_'+templateId]);
            if (!meta) {
                if (console) console.error('Error, template with ID ' + templateId + ' not found.');
                return;
            }

            container = container || $('.contentblocks-wrapper > .contentblocks-layout-wrapper').first();

            $.each(meta.content, function(i, layout) {
                ContentBlocks.buildLayout(layout.layout, layout.content, layout.settings, container, layout.title, position);
            });
        },
        
        addExposedLayoutSettings: function(layout) {
            var layoutId = layout.data('layout'),
                currentData = Ext.decode(layout.data('settings')) || {},
                layoutMeta = ContentBlocksLayouts['_'+layoutId] || {},
                settings = layoutMeta['settings'] ? layoutMeta['settings'] : {},
                defaultSettings = {},
                html = '';
                
            var allLayoutSettings = ContentBlocks.getSettingFields(settings);
            if (!settings || settings.length < 1) return;
            
            // ensure that currentData is something. If it isn't, exposed fields freak out.
            if (!currentData || currentData < 1) currentData = defaultSettings;

            if (allLayoutSettings.exposedFields.length) {
                layoutMeta.exposed_fields_asField = ContentBlocks.generateSettingFields(settings, defaultSettings, currentData, 'asField', layout.attr('id'));
                html += tmpl('contentblocks-field-settings-exposed-as-field', layoutMeta);
            }

            if (allLayoutSettings.exposedSettingFields.length) {
                layoutMeta.exposed_fields_asSetting = ContentBlocks.generateSettingFields(settings, defaultSettings, currentData, 'asSetting', layout.attr('id'));
                html += tmpl('contentblocks-field-settings-exposed-as-setting', layoutMeta);
            }
            
            layout.data('settings', Ext.encode(currentData));

            var layoutWrap = layout.find('.contentblocks-region-settings');
            
            layoutWrap.append(html);

            $(layout).find('.contentblocks-exposed-fields-wrapper .contentblocks-setting-link input[id]').each(function() {
                ContentBlocks.initializeLinkField(this)//, {properties : { limit_to_current_context : $(this).data('limitToCurrentContext')}});
            });
                        
            $(layout).find('.contentblocks-exposed-fields-wrapper :input[data-name]').on('change blur keyup', function() {
                var settings = Ext.decode(layout.data('settings')) || {}; // this means we get any data from the modal fields
                settings[$(this).data('name')] = $(this).val();

                layout.data('settings', Ext.encode(settings));
                ContentBlocks.fireChange();
            });
        },

        addContentModal: function() {
            var btn = $(this),
                column = btn.closest('.contentblocks-region'),
                contentWrapper = column.children('.contentblocks-content'),
                layout = column.closest('.contentblocks-layout').data('layout'),
                fieldDef = [],
                position = btn.hasClass('contentblocks-add-content-here-link') ? btn.closest('li.contentblocks-field-outer').index() : 'bottom',
                thisLayoutFields = ContentBlocks.getLayoutFields(column.closest('.contentblocks-layout')).allFields,
                allPageFields = [],
                usedFields = [],
                categoryHtml = [];

            $.each(ContentBlocks.generatedContentFields, function(idx, fld) {
                allPageFields.push(fld.fieldId);
            });

            for (var key in ContentBlocksFields) {
                if (ContentBlocksFields.hasOwnProperty(key)) {
                    if (ContentBlocksFields[key].layouts && ContentBlocksFields[key].layouts.length > 0) {
                        var ia = $.inArray(layout, ContentBlocksFields[key].layouts);
                        if (ia < 0) {
                            continue;
                        }
                    }
                    fieldDef.push(ContentBlocksFields[key]);
                }
            }
            fieldDef.sort(function(a, b) {
                if (a.sortorder < b.sortorder) return -1;
                if (a.sortorder > b.sortorder) return 1;
                return 0;
            });

            $.each(ContentBlocksCategories, function(idx, category) {
                var fields = [];

                $.each(fieldDef, function(id, data) {
                    var fieldsInLayout = $.grep(thisLayoutFields, function(n,i) {return n == data.id}).length;
                    var fieldsInPage = $.grep(allPageFields, function(n,i) {return n == data.id}).length;
                    if(
                      (data.times_per_layout && fieldsInLayout >= data.times_per_layout)
                      || (data.times_per_page && fieldsInPage >= data.times_per_page)
                      || (!data.available)
                      || data.category != category.id
                    ) {
                        return;
                    }

                    // Hide subfields from the window
                    if (data.parent !== 0) {
                        return;
                    }

                    // I18N
                    var lexName = _(data.name),
                      lexDescription = _(data.description);
                    if (lexName && lexName.length) {
                        data.name = lexName;
                    }
                    if (lexDescription && lexDescription.length) {
                        data.description = lexDescription;
                    }

                    data.icon = data.icon.replace('--DPR--', dpr);
                    fields.push(tmpl('contentblocks-modal-add-content-field', data));
                    usedFields.push(fieldDef[id]);
                });
                fieldDef = $(fieldDef).not(usedFields).get();
                if(fields.length) {
                    fields = fields.join('');
                    // if we only have uncategorized entries, don't show the title
                    categoryHtml.push(tmpl('contentblocks-modal-add-content-category', {
                        fields: fields,
                        category_name: (category.id == 0 && categoryHtml.length == 0) ? '' : category.name,
                        category_description: category.description,
                        category_id: category.id
                    }));
                }
            });

            var html = tmpl('contentblocks-modal-add-content', {
              category_html : categoryHtml.join('')
            });

            ContentBlocks.openModal(_('contentblocks.add_content'), html, {
                initCallback: function(modal) {
                    var list = modal.find('.contentblocks-add-field-list'),
                        highest = 0;
                    list.find('a').on('click', function() {
                        var field = $(this);
                        ContentBlocks.addField(contentWrapper, field.data('id'), {value: ''}, position);
                        ContentBlocks.closeModal();
                    }).each(function(i, field) {
                        field = $(field);
                        var height = field.find('span').height();
                        if (height > highest) highest = height;
                    }).css('height', 108 + highest);

                    // Boot up tooltips
                    modal.find('.tooltip').powerTip({
                        placement: 's',
                        smartPlacement: true
                    });
                }
            });
        },
        
        getSettingFields: function(settings) {
            var modalFields = [];
            var exposedFields = [];
            var exposedSettingFields = [];
            if(typeof settings !== 'undefined' && settings.length) {
                $.each(settings, function(id, setting) {
                    if (setting.field_is_exposed == 'asField' || setting.field_is_exposed == 1) {
                        exposedFields.push(setting);
                    }
                    else if (setting.field_is_exposed == 'asSetting') {
                        exposedSettingFields.push(setting);
                    }
                    else {
                        modalFields.push(setting);
                    }
                });
            }

            return {
                modalFields: modalFields,
                exposedFields: exposedFields,
                exposedSettingFields: exposedSettingFields
            };
        },

        generateSettingFields: function(settings, defaultSettings, currentData, fieldDisplayType, settingInstance) {
            fieldDisplayType = (typeof fieldDisplayType === "undefined") ? 'modal' : fieldDisplayType;
            var fields = [],
                fieldHasOptions = ['select', 'radio', 'checkbox'];
            $.each(settings, function(id, setting) {
                defaultSettings[setting.reference] = setting.default_value;
                if(
                    (fieldDisplayType == 'modal' && (!setting.field_is_exposed || setting.field_is_exposed == 'modal')) ||
                    (fieldDisplayType == 'asField' && (setting.field_is_exposed == 'asField' || setting.field_is_exposed == 1)) ||
                    (fieldDisplayType == 'asSetting' && setting.field_is_exposed == 'asSetting')
                ) {
                    setting.value = currentData[setting.reference] ? currentData[setting.reference] : setting.default_value;
                    var tpl = 'contentblocks-modal-layout-setting-' + setting.fieldtype,
                        lexTitle = _(setting.title);
                    if (lexTitle && lexTitle.length) {
                        setting.title = lexTitle;
                    }

                    if (fieldHasOptions.indexOf(setting.fieldtype) >= 0 && setting.fieldoptions.length) {
                        setting.value = String(setting.value || '');
                        var settingType = setting.fieldtype,
                            settingValues = (setting.fieldtype === 'checkbox') ? setting.value.split(',') : [setting.value];
                        setting.options = [];
                        $.each(setting.fieldoptions, function(idx, opt) {
                            var value = false, display = false;

                            // new format is for settings of value==Displayed Value
                            // old format is for settings of Displayed Value=value (@deprecated - to be removed in 2.0)
                            opt = opt.split('==');
                            // if it's an array longer than 1, it's the new format
                            if(opt.length > 1) {
                                value = opt[0];
                                display = opt[1];
                            }
                            // if it's 1, it's the old format
                            // or the value and display should be the same
                            else {
                                opt = opt[0].split('=');
                                // if it's still 1, then the first value in the array
                                // should be both the value and the display
                                // because there were no equal signs
                                if(opt.length == 1) {
                                    value = display = opt[0];
                                }
                                // otherwise, it's the old format
                                else {
                                    value = opt[1];
                                    display = opt[0];
                                }
                            }

                            var selected = (settingValues.indexOf(value) !== -1) ? ' selected="selected"' : '',
                                checked = (settingValues.indexOf(value) !== -1) ? ' checked="checked"' : '',
                                displayLex = _(display),
                                tpl = 'contentblocks-modal-layout-setting-' + settingType + '-option';

                            if (displayLex && displayLex.length > 0) {
                                display = displayLex;
                            }

                            var option = {value : value, selected : selected, checked: checked, display: display, reference: setting.reference, settingInstance: settingInstance};

                            setting.options.push(tmpl(tpl, option));
                        });
                        setting.options = setting.options.join('');
                    }
                    setting.settingInstance = settingInstance;
                    fields.push(tmpl(tpl, setting));
                }
            });
            fields = fields.join('');
            return fields;
        },

        openLayoutSettings: function() {
            var l = $(this).closest('li.contentblocks-layout'),
                lId = l.data('layout'),
                currentData = Ext.decode(l.data('settings')) || {},
                layoutMeta = ContentBlocksLayouts['_'+lId] || {},
                settings = layoutMeta['settings'] ? layoutMeta['settings'] : {},
                defaultSettings = {};
                
            if (!settings || settings.length < 1) return;
            
            // ensure that currentData is something. If it isn't, exposed fields freak out.
            if (!currentData || currentData < 1) currentData = defaultSettings;

            layoutMeta.setting_fields = ContentBlocks.generateSettingFields(settings, defaultSettings, currentData, 'modal', l.attr('id'));
            var html = tmpl('contentblocks-modal-layout-setting', layoutMeta);

            ContentBlocks.openModal(_('contentblocks.layout_settings.modal_header', {name: layoutMeta.name}), html, {
                width: '450px',
                initCallback: function(modal) {
                    modal.on('click', '.contentblocks-setting-radio input, .contentblocks-setting-checkbox input', ContentBlocks.storeSettingValuesInHiddenField);
                    modal.find('.contentblocks-setting-link input[id]').each(function() {
                        ContentBlocks.initializeLinkField(this);
                    });
                    modal.find('.save-layout_settings-button').on('click', function(e) {
                        e.preventDefault();

                        var settings = currentData;
                        modal.find(':input[data-name]').each(function(i, fld) {
                            settings[$(fld).data('name')] = $(fld).val();
                        });
                        l.data('settings', Ext.encode(settings));
                        ContentBlocks.fireChange();
                        ContentBlocks.closeModal();
                    });
                }
            });
        },
        
        addExposedFieldSettings: function(fld) {
            var fldId = fld.data('field'),
                currentData = Ext.decode(fld.data('settings')) || {},
                fieldMeta = ContentBlocksFields['_'+fldId] || {},
                settings = fieldMeta['settings'] ? fieldMeta['settings'] : {},
                defaultSettings = {},
                html = '';
                
            var allFieldSettings = ContentBlocks.getSettingFields(settings);
            if (!settings || settings.length < 1) return;
            
            // ensure that currentData is something. If it isn't, exposed fields freak out.
            if (!currentData || currentData < 1) currentData = defaultSettings;

            if (allFieldSettings.exposedFields.length) {
              fieldMeta.exposed_fields_asField = ContentBlocks.generateSettingFields(settings, defaultSettings, currentData, 'asField', fld.attr('id'));
              html += tmpl('contentblocks-field-settings-exposed-as-field', fieldMeta);
            }

            if (allFieldSettings.exposedSettingFields.length) {
              fieldMeta.exposed_fields_asSetting = ContentBlocks.generateSettingFields(settings, defaultSettings, currentData, 'asSetting', fld.attr('id'));
              html += tmpl('contentblocks-field-settings-exposed-as-setting', fieldMeta);
            }
            
            fld.data('settings', Ext.encode(currentData));

            var fieldWrap = fld.children('.contentblocks-field-wrap');
            
            fieldWrap.append(html);
            
            fld.find('.contentblocks-setting-link input[id]').each(function() {
                ContentBlocks.initializeLinkField(this);
            });
            
            $(fieldWrap).children('.contentblocks-exposed-fields-wrapper').find(':input[data-name]').on('change blur keyup', function() {
                var settings = Ext.decode(fld.data('settings')) || {}, // this means we get any data from the modal fields
                    value = $(this).val(),
                    name = $(this).data('name');
                settings[name] = value;

                fld.data('settings', Ext.encode(settings));
                ContentBlocks.fireChange();
            });
            
        },

        openFieldSettings: function() {
            var fld = $(this).closest('li.contentblocks-field-outer');
            // ensure that data in exposed fields has actually saved
            $(fld).find('.contentblocks-exposed-fields-wrapper :input').blur();
            
            var fldId = fld.data('field'),
                currentData = Ext.decode(fld.data('settings')) || {},
                fieldMeta = ContentBlocksFields['_'+fldId] || {},
                settings = fieldMeta['settings'] ? fieldMeta['settings'] : {},
                defaultSettings = {};
            if (!settings || settings.length < 1) return;
            
            // ensure that currentData is something. If it isn't, exposed fields freak out.
            if (!currentData || currentData < 1) currentData = defaultSettings;
            
            fieldMeta.setting_fields = ContentBlocks.generateSettingFields(settings, defaultSettings, currentData, 'modal', fld.attr('id'));
            var html = tmpl('contentblocks-modal-field-setting', fieldMeta);

            ContentBlocks.openModal(_('contentblocks.field_settings.modal_header', {name: fieldMeta.name}), html, {
                width: '450px',
                initCallback: function(modal) {
                    modal.on('click', '.contentblocks-setting-radio input, .contentblocks-setting-checkbox input', ContentBlocks.storeSettingValuesInHiddenField);
                    modal.find('.contentblocks-setting-link input[id]').each(function() {
                        ContentBlocks.initializeLinkField(this);
                    });
                    modal.find('.save-field_settings-button').on('click', function(e) {
                        e.preventDefault();
                        var settings = currentData; // this means we get any data from the modal fields
                        modal.find(':input[data-name]').each(function(i, fld) {
                            settings[$(fld).data('name')] = $(fld).val();
                        });
                        fld.data('settings', Ext.encode(settings));
                        ContentBlocks.fireChange();
                        ContentBlocks.closeModal();
                    });
                }
            });
        },

        addLayoutModal: function() {
            var btn = $(this),
                layoutDef = [],
                allPageLayouts = [],
                // set container so that we can pass it to buildLayout
                container = btn.prevAll('.contentblocks-layout-wrapper'),
                // get data for field, primarily to make sure that we only allow specified layouts on nested layouts
                parentData = container.closest('li.contentblocks-field-outer').data() || false,
                allowedLayouts = [],
                categoryLayoutHtml = [],
                allowedTemplates = [],
                categoryTemplateHtml = [],
                templates = [],
                position = 'bottom';

            if (btn.hasClass('contentblocks-add-layout-here')) {
                container = btn.closest('.contentblocks-layout-wrapper');
                parentData = container.closest('li.contentblocks-field-outer').data() || false;
                position = btn.closest('li.contentblocks-layout').index();
            }

            if(parentData && parentData.layouts) {
                allowedLayouts = parentData.layouts;
                if (allowedLayouts == '-1') allowedLayouts = false;
                else allowedLayouts = allowedLayouts.split(/, ?/);
            }
            if(parentData && parentData.templates) {
                allowedTemplates = parentData.templates;
                if (allowedTemplates == '-1') allowedTemplates = false;
                else allowedTemplates = allowedTemplates.split(/, ?/);
            }


            if (allowedLayouts) {
                $.each(ContentBlocks.generatedLayouts, function(idx, lay) {
                    allPageLayouts.push(lay.id);
                });

                for (var key in ContentBlocksLayouts) {
                    if (ContentBlocksLayouts.hasOwnProperty(key)) {
                        layoutDef.push(ContentBlocksLayouts[key]);
                    }
                }
                layoutDef.sort(function(a, b) {
                    if (a.sortorder < b.sortorder) return -1;
                    if (a.sortorder > b.sortorder) return 1;
                    return 0;
                });

                var usedLayouts = [];

                $.each(ContentBlocksCategories, function(idx, category) {
                    var layouts = [];

                    $.each(layoutDef, function(id, data) {
                        var layoutsInPage = $.grep(allPageLayouts, function(n,i) {return n == data.id}).length;
                        if(
                          (data.times_per_page && layoutsInPage >= data.times_per_page)
                          || (data.layout_only_nested == "1" && !parentData)
                          || (!data.available)
                          || (allowedLayouts.length && allowedLayouts.indexOf(data.id.toString()) == -1)
                          || data.category != category.id
                        ) {
                            return;
                        }

                        data.icon = data.icon.replace('--DPR--', dpr);
                        layouts.push(tmpl('contentblocks-modal-add-layout-option', data));
                        usedLayouts.push(layoutDef[id]);
                    });
                    layoutDef = $(layoutDef).not(usedLayouts).get();
                    if(layouts.length) {
                        layouts = layouts.join('');

                        // if we only have uncategorized entries, don't show the title
                        categoryLayoutHtml.push(tmpl('contentblocks-modal-add-layout-category', {
                            layouts: layouts,
                            layout_type: 'layout',
                            category_name: (category.id == 0 && categoryLayoutHtml.length == 0) ? '' : category.name,
                            category_description: category.description,
                            category_id: category.id
                        }));
                    }
                });

                categoryLayoutHtml = categoryLayoutHtml.join('');
            }


            if (allowedTemplates) {
                // Grab templates
                var avlTemplates = [];

                for (var k in ContentBlocksTemplates) {
                    if (ContentBlocksTemplates.hasOwnProperty(k)) {
                        avlTemplates.push(ContentBlocksTemplates[k]);
                    }
                }

                // Sort templates
                avlTemplates.sort(function(a, b) {
                    if (a.sortorder < b.sortorder) return -1;
                    if (a.sortorder > b.sortorder) return 1;
                    return 0;
                });

                var usedTemplates = [];

                $.each(ContentBlocksCategories, function(idx, category) {
                    var templates = [];

                    // Loop over templates to parse and stuff inside a template
                    $.each(avlTemplates, function(id, data) {
                        if (!data.available) return;
                        if (allowedTemplates.length && allowedTemplates.indexOf(data.id.toString()) == -1) return;
                        if (data.category != category.id) return;

                        // I18N
                        var lexName = _(data.name),
                          lexDescription = _(data.description);
                        if (lexName && lexName.length) {
                            data.name = lexName;
                        }
                        if (lexDescription && lexDescription.length) {
                            data.description = lexDescription;
                        }

                        data.icon = data.icon.replace('--DPR--', dpr);
                        templates.push(tmpl('contentblocks-modal-add-layout-template-option', data));
                        usedTemplates.push(avlTemplates[id]);
                    });
                    avlTemplates = $(avlTemplates).not(usedTemplates).get();
                    if(templates.length) {
                        templates = templates.join('');

                        // if we only have uncategorized entries, don't show the title
                        categoryTemplateHtml.push(tmpl('contentblocks-modal-add-layout-category', {
                            layouts: templates,
                            layout_type: 'template',
                            category_name: (category.id == 0 && categoryTemplateHtml.length == 0) ? '' : category.name,
                            category_description: category.description,
                            category_id: category.id
                        }));
                    }
                });

                categoryTemplateHtml = categoryTemplateHtml.join('');
            }



            var html = tmpl('contentblocks-modal-add-layout', {
                hasLayouts: usedLayouts && usedLayouts.length > 0,
                category_layout_html: categoryLayoutHtml,
                hasTemplates: usedTemplates && usedTemplates.length > 0,
                category_template_html: categoryTemplateHtml
            });

            ContentBlocks.openModal(_('contentblocks.add_layout'), html, {
                initCallback: function(modal) {
                    // Initiate the layouts
                    var layoutList = modal.find('.contentblocks-add-layout-list'),
                        layoutHighest = 0;
                    layoutList.find('a').on('click', function() {
                        var layout = $(this);
                        ContentBlocks.buildLayout(layout.data('id'), [], [], container, false, position);
                        ContentBlocks.closeModal();
                    }).each(function(i, layout) {
                        layout = $(layout);
                        var height = layout.find('span').height();
                        if (height > layoutHighest) layoutHighest = height;
                    }).css('height', 108 + layoutHighest);

                    // Do the same for templates
                    var templatesList = modal.find('.contentblocks-add-template-list'),
                        templateHighest = 0;
                    templatesList.find('a').on('click', function() {
                        var template = $(this);
                        ContentBlocks.buildTemplate(template.data('id'), container, position);
                        ContentBlocks.closeModal();
                    }).each(function(i, template) {
                        template = $(template);
                        var height = template.find('span').height();
                        if (height > templateHighest) templateHighest = height;
                    }).css('height', 108 + templateHighest);

                    // Boot up tooltips
                    modal.find('.tooltip').powerTip({
                        placement: 's',
                        smartPlacement: true
                    });
                }
            });
        },
        
        repeatLayout: function (event) {
            var layout = $(this).closest('.contentblocks-layout'),
                layoutId = layout.data('layout'),
                container = $(this).closest('.contentblocks-layout-wrapper'),
                builtLayout = ContentBlocks.buildLayout(layoutId, [], Ext.decode(layout.data('settings')), container);

            // shim in window.event for all browsers (it only exists in IE)
            // this allows us to test for whether we're repeating the layout in
            // the layout input js, so we don't pop up the add layout modal
            // when repeating layouts
            window.event = event;
                
                // Add fields to the layout
                var layoutFields = ContentBlocks.getLayoutFields(layout);
                $.each(layoutFields.content, function (key, fields) {
                    var column = builtLayout.find('.contentblocks-region[data-part=' + key + ']');
                    $.each(fields, function (index, field) {
                        ContentBlocks.addField(column.find('.contentblocks-content'), field.field, {value: ''});
                    });
                });
        },

        deleteLayout: function(e, layout, noConfirm) {
            layout = layout || $(this).closest('li.contentblocks-layout');
            noConfirm = noConfirm || false;

            var layoutId = layout.data('layout'),
                layoutMeta = ContentBlocksLayouts['_'+layoutId] || {name: ''},
                layoutInstanceWrapperId = layout.attr('id'),
                layoutInstanceId = layoutInstanceWrapperId.substr(0, layoutInstanceWrapperId.length - 8);
                
            if (noConfirm || ContentBlocks.utilities.confirm(_('contentblocks.delete_layout.confirm.js', {layoutName: layoutMeta.name}))) {
                delete ContentBlocks.generatedLayouts[layoutInstanceId];
                layout.remove();
            }
        },
        
        getLayoutFields: function(layout) {
            var layoutId = layout.data('layout'),
                regionData = {
                    layout: layoutId,
                    content: {},
                    settings: Ext.decode(layout.data('settings')) || {},
                    allFields: []
                };

            layout.find('.contentblocks-content').filter(function () {
                var $this = $(this);
                return $this.parent().closest('.contentblocks-layout').is(layout);
            }).each(function (partIndex, part) {
                var $part = $(part),
                    partName = $part.data('part'),
                    partFields = [];

                $.each($part.children('li'), function (fieldIndex, field) {
                    var $field = $(field),
                        fieldId = $field.data('field'),
                        inputId = $field.attr('id'),
                        input = ContentBlocks.generatedContentFields[inputId];

                    if (input) {
                        var fieldValue = input.getData();
                        fieldValue.field = fieldId;
                        fieldValue.settings = Ext.decode($field.data('settings')) || {};
                        partFields.push(fieldValue);
                        regionData.allFields.push(fieldId);
                    }
                });

                regionData.content[partName] = partFields;
            });
            return regionData;
        },

        getData: function (root) {
            var data = [];
            root = root || $('.contentblocks-wrapper');

            $.each(root.children('.contentblocks-layout-wrapper').children('li'), function (index, region) {
                var $region = $(region),
                    layoutId = $region.data('layout') || false,
                    layoutDomId = $region.attr('id'),
                    // have to get parent() first because $(this) is an li
                    parent = $(this).parent().closest('li.contentblocks-field-outer').data('field') || 0,
                    regionData = {
                        layout: layoutId,
                        content: {},
                        settings: Ext.decode($region.data('settings')) || {},
                        parent: parent,
                        title: ''
                    };

                // Don't include layouts without an ID
                if (!layoutId) {
                    return;
                }

                // Custom titles per layout requires a bit of processing and ugly searching
                var title = $region.find('> .contentblocks-region-container > .contentblocks-region-container-header .contentblocks-layout-title').text(),
                    originalTitle = (ContentBlocksLayouts['_' + layoutId]) ? ContentBlocksLayouts['_' + layoutId].name : '';

                if (_(originalTitle)) {
                    originalTitle = _(originalTitle);
                }
                if (title && title.length && title !== originalTitle) {
                    regionData.title = title;
                }
                
                // have to filter to account for nested layouts. can't use children() because .contentblocks-content is buried.    
                var children = $region.find('.contentblocks-content').not($(this).find('.contentblocks-content .contentblocks-content'));
                $.each(children, function (partIndex, part) {
                    var $part = $(part),
                        partName = $part.data('part'),
                        partFields = [];

                    $.each($part.children('li').not('.contentblocks-field-empty'), function (fieldIndex, field) {
                        var $field = $(field),
                            fieldId = $field.data('field'),
                            inputId = $field.attr('id'),
                            input = ContentBlocks.generatedContentFields[inputId];

                        if (input) {
                            var fieldValue = input.getData();
                            fieldValue.field = fieldId;
                            fieldValue.settings = Ext.decode($field.data('settings')) || {};
                            partFields.push(fieldValue);
                        }
                    });

                    regionData.content[partName] = partFields;
                });
                if (!parent) {
                    data.push(regionData);
                }
            });

             if (!JSON) {
                 ContentBlocks.alert(_('contentblocks.error.no_json'));
                 return true;
             }
             
             data = JSON.stringify(data);
             return data;
        },

        modal: null,
        modalMask: null,
        openModal: function(title, content, options) {
            options = $.extend({
                initCallback: null,
                width: '70%',
                classes: '',
                maxHeight: $(window).height() - 100
            }, options);

            if (!ContentBlocks.modalMask) {
                ContentBlocks.modalMask = this.$('#contentblocks-modal-mask');
                ContentBlocks.modalMask.on('click', ContentBlocks.closeModal);
            }

            // Load modal and fade it in
            ContentBlocks.modal = $('#contentblocks-modal').html(tmpl('contentblocks-modal-wrapper', {
                title: title,
                content: content,
                classes: options.classes
            })).css({'width': options.width, maxHeight: options.maxHeight + 40 + 'px'});
            
            $(document).on('keyup.ContentBlocksModal', function(e) {
                if(e.keyCode == 27) {
                    ContentBlocks.closeModal();
                }
            });

            // Apply a max-height to the content area so we get a nice scroll
            ContentBlocks.modal.find('.contentblocks-modal-content').css('maxHeight', options.maxHeight + 'px');

            // Show it!
            ContentBlocks.modalMask.fadeIn();
            ContentBlocks.modal.fadeIn();

            // Add listener for close button
            ContentBlocks.modal.find('.close').on('click', function() {
                ContentBlocks.closeModal();
            });

            if (options.initCallback) options.initCallback(ContentBlocks.modal, options);
        },

        closeModal: function() {
            $(document).unbind('keyup.ContentBlocksModal');
            ContentBlocks.modal.fadeOut();
            ContentBlocks.modal = null;
            ContentBlocks.modalMask.fadeOut();
        },

        addTinyRte: function (field) {
            var textOptions = {
                defaultActions: ["bold", "italic", "link", "unlink"],
                addLinkCallback: function(callback, currentLink) {
                    var html = tmpl('contentblocks-modal-tinyrte-link', {value: currentLink, title: 'Link'});
                    var newLink = currentLink;
                    ContentBlocks.openModal(_('contentblocks.link'), html, {
                        width: '450px',
                        initCallback: function(modal) {
                            modal.find('.contentblocks-setting-link input[id]').each(function() {
                                ContentBlocks.initializeLinkField(this);
                            });
                            modal.find('.save-button').on('click', function(e) {
                                e.preventDefault();
                                newLink = modal.find('#tinyrte-link').val();
                                if(newLink != '') {
                                    var linkType = ContentBlocks.getLinkFieldDataType(newLink);
                                    switch(linkType) {
                                        case 'resource' :
                                            newLink = '[[~' + newLink + ']]';
                                        break;
                                        case 'email' : 
                                            newLink = 'mailto:' + newLink;
                                        break;
                                        default : break;
                                    }
                                }
                                callback(newLink);
                                ContentBlocks.fireChange();
                                ContentBlocks.closeModal();
                            }).end().find('.delete-button').on('click', function(e) {
                                e.preventDefault();
                                modal.find('#tinyrte-link').val('');
                                newLink = '';
                                callback(newLink);
                                ContentBlocks.fireChange();
                                ContentBlocks.closeModal();
                            });
                        }
                    });
                }
            };
            setTimeout(function() {
                field.TinyRTE(textOptions);
            }, 10);
            field.closest('.contentblocks-field').addClass('has-tinyrte');
        },

        fieldTypes: {},
        utilities: {
            confirm: function(message) {
                var timeBefore = new Date(),
                    confirmation = window.confirm(message),
                    timeAfter = new Date();

                // If the time between the two is less than 3.5 milliseconds, the user dismissed
                // the confirm boxes, so we assume they want the action to be confirmed.
                if ((timeAfter - timeBefore) < 350) {
                    confirmation = true;
                }
                return confirmation;
            },

            getThumbnailUrl: function(url, size) {
                // Get the normalised urls, forcing it to relative mode so phpthumb can use the cleaned, relative url
                var normalised = ContentBlocks.utilities.normaliseUrls(url, 'relative');
                if (size > 0 || size.length > 0) {
                    var width = size.split('x')[0],
                        height = size.split('x')[1] || width,
                        thumbUrl = MODx.config.connectors_url + 'system/phpthumb.php';

                    // Only return a thumbnail if the width and height are larget than 0
                    if (width > 0 && height > 0) {
                        thumbUrl += '?src=' + normalised.cleanedSrc;
                        thumbUrl += '&w=' + width + '&h=' + height + '&zc=1';
                        thumbUrl += '&HTTP_MODAUTH=' + MODx.siteId;
                        return thumbUrl;
                    }
                }
                return normalised.displaySrc;
            },
            normaliseUrls: function(url, mode) {
                mode = mode || ContentBlocksConfig.base_url_mode || 'relative';
                var baseUrl = ContentBlocksConfig.modx_base_url,
                    siteUrl = ContentBlocksConfig.modx_site_url;

                var imageSrc = url,
                    hasBaseUrl = (imageSrc.substr(0, baseUrl.length) === baseUrl);

                if ((imageSrc.substr(0, 4) === 'http') || (imageSrc.substr(0, 2) === '//')) {
                    if (imageSrc.substr(0, siteUrl.length) === siteUrl) {
                        imageSrc = imageSrc.substr(siteUrl.length);
                        hasBaseUrl = false;
                    }
                    else {
                        return {
                            'displaySrc': url,
                            'cleanedSrc': url
                        };
                    }
                }

                var displaySrc = imageSrc,
                    cleanedSrc = imageSrc;

                switch (mode) {
                    case 'full':
                        if (!hasBaseUrl) {
                            displaySrc = cleanedSrc = siteUrl + imageSrc;
                        } else {
                            cleanedSrc = siteUrl + imageSrc.substr(baseUrl.length);
                        }
                        break;

                    case 'absolute':
                        if (!hasBaseUrl) {
                            displaySrc = baseUrl + imageSrc;
                            cleanedSrc = baseUrl + imageSrc;
                        }
                        break;

                    case 'relative':
                    default:
                        if (!hasBaseUrl) {
                            displaySrc = baseUrl + imageSrc;
                        } else {
                            cleanedSrc = imageSrc.substr(baseUrl.length);
                        }
                        break;
                }
                return {
                    'displaySrc': displaySrc,
                    'cleanedSrc': cleanedSrc
                };
            },
            // Thanks, Remy https://remysharp.com/2010/07/21/throttling-function-calls
            debounce: function(fn, delay) {
                var timer = null;
                return function () {
                    var context = this, args = arguments;
                    clearTimeout(timer);
                    timer = setTimeout(function () {
                        fn.apply(context, args);
                    }, delay);
                };
            }
        },
        generatedContentFields: {},
        toBoolean: function (v) {
            return !(v == 'No' || !v || v == '0' || v == 'false');
        },
        generatedLayouts: {},
        expandLayout: function() {
            $(this).removeClass('contentblocks-layout-collapsed').addClass('contentblocks-layout-expanded').text('-').closest('.contentblocks-region-container').children('.contentblocks-region-content').slideDown(300, function() {
                ContentBlocks.fixColumnHeights();
            });
        },
        collapseLayout: function() {
            $(this).removeClass('contentblocks-layout-expanded').addClass('contentblocks-layout-collapsed').text('+').closest('.contentblocks-region-container').children('.contentblocks-region-content').slideUp(300, function() {
                ContentBlocks.fixColumnHeights();
            });
        },
        expandAllLayouts: function() {
            ContentBlocks.cbWrapper.find('.contentblocks-layout-collapsed').removeClass('contentblocks-layout-collapsed').addClass('contentblocks-layout-expanded').text('-').closest('.contentblocks-region-container').children('.contentblocks-region-content').slideDown(300, function() {
                ContentBlocks.fixColumnHeights();
            });
        },
        collapseAllLayouts: function() {
            ContentBlocks.cbWrapper.find('.contentblocks-layout-expanded').removeClass('contentblocks-layout-expanded').addClass('contentblocks-layout-collapsed').text('+').closest('.contentblocks-region-container').children('.contentblocks-region-content').slideUp(300, function() {
                ContentBlocks.fixColumnHeights();
            });
        },
        editLayoutTitle: function() {
            var $this = $(this),
                $parent = $(this).parent();
            $this.replaceWith('<input type="text" value="' + $this.text() + '" class="contentblocks-layout-title-edit">');
            $parent.find('.contentblocks-layout-title-edit').focus();
        },
        updateLayoutTitle: function() {
            var $input = $(this);
            $input.replaceWith('<span class="contentblocks-layout-title">' + $input.val() + '</span>');
        },
        maybeUpdateLayoutTitle: function(e) {
            var key = e.which || e.keyCode;
            if (key == 13) {
                e.preventDefault();
                e.stopPropagation();
                var $input = $(this);
                $input.replaceWith('<span class="contentblocks-layout-title">' + $input.val() + '</span>');
                return false;
            }
        },

        storeSettingValuesInHiddenField: function() {
            var options_container = $(this).closest('.contentblocks-modal-field'),
                value_container = options_container.find('input[type=hidden]'),
                value = options_container.find(':checked').map(function() {
                    return this.value;
                }).get().join(',');
            value_container.val(value).change();
        },

        initDelegates: function(dom) {
            // Field functions
            dom.on('click', '.contentblocks-field-settings', this.openFieldSettings);
            dom.on('click', '.contentblocks-field-delete', this.deleteField);
            dom.on('click', '.contentblocks-add-content-here-link', this.addContentModal);
            dom.on('click', '.contentblocks-add-block', this.addContentModal);
            dom.on('change', 'input,select,textarea', ContentBlocks.fireChange);

            // Layout functions
            dom.on('click', '.contentblocks-add-layout', this.addLayoutModal);
            dom.on('click', '.contentblocks-add-layout-here', this.addLayoutModal);
            dom.on('click', '.contentblocks-layout-delete', this.deleteLayout);
            dom.on('click', '.contentblocks-layout-settings', this.openLayoutSettings);
            dom.on('click', '.contentblocks-repeat-layout',  this.repeatLayout);
            dom.on('click', '.contentblocks-layout-expanded', this.collapseLayout);
            dom.on('click', '.contentblocks-layout-collapsed', this.expandLayout);
            dom.on('click', '.contentblocks-layout-title', this.editLayoutTitle);
            dom.on('blur', '.contentblocks-layout-title-edit', this.updateLayoutTitle);
            dom.on('keydown', '.contentblocks-layout-title-edit', this.maybeUpdateLayoutTitle);

            // Setting functions
            dom.on('click', '.contentblocks-setting-radio input, .contentblocks-setting-checkbox input', this.storeSettingValuesInHiddenField);

            // Layout moves
            dom.on('click', '.contentblocks-layout-move-up', function() {
                var l = $(this).closest('li.contentblocks-layout'),
                    target = l.prev();

                ContentBlocks.animateLayoutMove(l, target, true);
            });
            dom.on('click', '.contentblocks-layout-move-down', function() {
                var thisLayout = $(this).closest('li.contentblocks-layout'),
                    target = thisLayout.next();

                ContentBlocks.animateLayoutMove(thisLayout, target);
            });
        },

        animateLayoutMove: function (element, target, before) {
            before = before || false;
            element = $(element); //Allow passing in either a JQuery object or selector
            target= $(target); //Allow passing in either a JQuery object or selector
            var elementPosition = element.position(),
                elementWidth = element.width(),
                targetPosition = target.position(),
                targetWidth = target.width();

            // TinyMCE compatibility; grab tiny instances and store the IDs
            var tinyInstances = element.find('.mceEditor'),
                tinyIds = [];

            tinyInstances.add(target.find('.mceEditor'));
            tinyInstances.each(function(i, instance) {
                var tinyId = $(instance).attr('id').replace('textarea_parent','textarea');
                tinymce.execCommand('mceRemoveControl', true, tinyId);
                tinyIds.push(tinyId);
            });

            var tempOriginal = element.clone().insertBefore(element);
            tempOriginal.css('position', 'absolute')
                .css('top', elementPosition.top)
                .css('width', elementWidth)
                .css('zIndex', 1001)
                .css('boxShadow', '0 0 5px 2px #bbb');

            var tempTarget = target.clone().insertBefore(target);
            tempTarget.css('position', 'absolute')
                .css('top', targetPosition.top)
                .css('width', targetWidth)
                .css('zIndex', 1000)
                //.css('border', '1px solid blue')
                .css('opacity', 0.5);

            if (before) {
                element.insertBefore(target);
            }
            else {
                element.insertAfter(target);
            }

            element.css('opacity', 0);
            target.css('opacity', 0);

            var newElementPosition = element.position(),
                newTargetPosition = target.position();

            tempOriginal.animate({top: newElementPosition.top}, 600, 'linear', function() {
                element.css('opacity', 1);
                tempOriginal.remove();
            });
            tempTarget.animate({top: newTargetPosition.top}, 600, 'linear', function() {
                target.css('opacity', 1);
                tempTarget.remove();

                $.each(tinyIds, function(i, id) {
                    tinymce.execCommand('mceAddControl', true, id);
                });
            });


            setTimeout(function() {
                // make auto-scroll go to whatever's at the top. keeps scrolling from being really weird.
                scrollPosition = (newElementPosition.top > newTargetPosition.top) ? newElementPosition.top : newTargetPosition.top;
                $('#modx-panel-resource').parent().animate({scrollTop: scrollPosition - 50});
            }, 600);
        },

        alert: function(msg, title) {
            title = title || 'Error';
            if (MODx && MODx.msg) {
                MODx.msg.alert(title, msg);
            }
            else {
                alert(msg);
            }
        },

        initDrops: function() {
            // Prevent dropping on top of the document from doing the default browser action
            $(document).on('drop dragover', function (e) {
                e.preventDefault();
            });

            // Add "in" class when dragging, and "over" when dragging over a specific drop zone
            $(document).on('dragover', function (e) {
                var dropZones = $('.contentblocks-drop-target'),
                    dropZonesParents = dropZones.closest('.contentblocks-field-outer'),
                    timeout = window.dropZoneTimeout;
                if (!timeout) {
                    dropZonesParents.addClass('in');
                } else {
                    clearTimeout(timeout);
                }
                // Find the active dropzone
                var $node = $(e.target);
                // Remove active classes
                dropZonesParents.removeClass('contentblocks-drop-target-over');

                // Add class to the active drop target
                $node.parents('.contentblocks-drop-target').closest('.contentblocks-field-outer').addClass('contentblocks-drop-target-over');

                window.dropZoneTimeout = setTimeout(function () {
                    window.dropZoneTimeout = null;
                    dropZonesParents.removeClass('in contentblocks-drop-target-over');
                }, 100);
            });
        },

        getResourceName: function(link, displayLocation) {
            var l = parseInt(link);
            var fillLink = function(suggestions) {
                $(suggestions).each(function(i, suggestion) {
                    if(suggestion.id == l) {
                        // are we sending an input field or some other node type?
                        suggestion.pagetitle = $('<div/>').html(suggestion.pagetitle).text();
                        if(displayLocation.get(0).nodeName == 'INPUT') {
                            $(displayLocation).val(suggestion.pagetitle);
                        }
                        else {
                            $(displayLocation).text(suggestion.pagetitle);
                        }
                        return false;
                    }
                });
            };

            ContentBlocks.resourcesSource.search(link, fillLink, fillLink);
        },
        
        initializeLinkField : function(input, data) {
            var data = data || {},
                $link = $(input),
                // because tmpl uses data.value the first time through, but we use data.link, and also because links as settings don't have data
                linkVal = ($link.val() != 'undefined') ? $link.val() : '',
                showDisplayText = function($displayText) { $displayText.css({'opacity' : '1', 'z-index' : '1'}); },
                hideDisplayText = function($displayText) { $displayText.css({'opacity' : '0', 'z-index' : '-1' }); },
                linkPattern = (data.properties && typeof data.properties.link_detection_pattern_override !== 'undefined' && data.properties.link_detection_pattern_override != '') ? data.properties.link_detection_pattern_override : ContentBlocksConfig['link.link_detection_pattern'],
                limitContext = (data.properties && data.properties.limit_to_current_context || $(input).data('limitToCurrentContext')) ? 1 : 0,
                linkRE = new RegExp(linkPattern, 'i'),
                resourceRE = /^\[\[~\d*\]\]/,
                linkType = ContentBlocks.getLinkFieldDataType(linkVal);

            // remove mailto: from email links
            linkVal = linkVal.replace('mailto:', '');
            
            // find out if it's mostly numbers, i.e. a resource ID
            var resourceVal = parseInt(linkVal.replace(/[^\d]/g, ''));

            // account for [[~ ]] stored with the link. Esp. helpful in tinyrte.
            if(resourceRE.test(linkVal)) {
                $link.val(resourceVal.toString());
                linkType = 'resource';
            } else {
                // set this so that the mailto: is replaced in email links. Esp. helpful in tinyrte
                $link.val(linkVal);
            }
            
            var displayTextHolder = $('<div />', {class : 'contentblocks-field-link-displaytext'}).on('click', function() {
                $link.focus().select();
            });
            hideDisplayText(displayTextHolder);
            
            $link.attr('data-link-type', linkType).before(displayTextHolder);
            
            if (linkType == 'resource') {
                ContentBlocks.getResourceName($link.val(), displayTextHolder);
                showDisplayText(displayTextHolder);
            }

            $link.typeahead(null, {
                name: 'resources-oss',
                source: ContentBlocks.resourcesSource.ttAdapter(),
                templates: {
                    suggestion: function (datum) {
                        return '<div><p class="resource-id">#' + datum.id + '</p>' +
                            '<p class="resource-name">' + datum.pagetitle + '</p>' +
                            '<p class="resource-introtext">' + datum.introtext + '</p></div>';
                    }
                },
                displayKey: 'id'
            }).on('typeahead:selected',function (eventObject, suggestionObject) {
                displayTextHolder.text($('<div/>').html(suggestionObject.pagetitle).text());
                $link.attr('data-link-type', 'resource').blur();
            }).on('keyup',function () {
                // On each key stroke check the data type and update the shown icon
                var val = $(this).val(),
                    type = ContentBlocks.getLinkFieldDataType(val);
                $link.attr('data-link-type', type);
            }).on('blur', function() {
                // When leaving the input type, check if we've added http(s)/ftp protocols
                var val = $(this).val(),
                    type = ContentBlocks.getLinkFieldDataType(val);
                    
                if (type == 'link') {
                    if (val != '' && !linkRE.test(val)) {
                        $(this).val('http://' + val);
                    }
                }
                else if(type == 'resource') {
                    showDisplayText(displayTextHolder);
                }
            }).on('focus', function() {
                if(typeof ContentBlocksResource !== 'undefined') {
                    ContentBlocks.resourcesSource.remote.url = ContentBlocksConfig.connectorUrl + '?action=content/resources/search&query=%TERM%&limitToContext=' + limitContext + "&context=" + ContentBlocksResource.context_key;
                }
                hideDisplayText(displayTextHolder);
              
            }).after('<span/>');

            $link.blur();
        },
        initFields : function() {
            for (var key in ContentBlocksFields) {
                if (ContentBlocksFields.hasOwnProperty(key)) {
                    var nameLex = _(ContentBlocksFields[key].name);
                    if (nameLex && nameLex.length) {
                        ContentBlocksFields[key].name = nameLex;
                    }
                    var descLex = _(ContentBlocksFields[key].description);
                    if (descLex && descLex.length) {
                        ContentBlocksFields[key].description = descLex;
                    }
                }
            }
        },
        initLayouts : function() {
            for (var key in ContentBlocksLayouts) {
                if (ContentBlocksLayouts.hasOwnProperty(key)) {
                    var nameLex = _(ContentBlocksLayouts[key].name);
                    if (nameLex && nameLex.length) {
                        ContentBlocksLayouts[key].name = nameLex;
                    }
                    var descLex = _(ContentBlocksLayouts[key].description);
                    if (descLex && descLex.length) {
                        ContentBlocksLayouts[key].description = descLex;
                    }
                }
            }
        },
        initTemplates : function() {
            for (var key in ContentBlocksTemplates) {
                if (ContentBlocksTemplates.hasOwnProperty(key)) {
                    var nameLex = _(ContentBlocksTemplates[key].name);
                    if (nameLex && nameLex.length) {
                        ContentBlocksTemplates[key].name = nameLex;
                    }
                    var descLex = _(ContentBlocksTemplates[key].description);
                    if (descLex && descLex.length) {
                        ContentBlocksTemplates[key].description = descLex;
                    }
                }
            }
        },
        initCategories : function() {
            var categories = [];

            for (var key in ContentBlocksCategories) {
                if (ContentBlocksCategories.hasOwnProperty(key)) {
                    var nameLex = _(ContentBlocksCategories[key].name);
                    if (nameLex && nameLex.length) {
                        ContentBlocksCategories[key].name = nameLex;
                    }
                    var descLex = _(ContentBlocksCategories[key].description);
                    if (descLex && descLex.length) {
                        ContentBlocksCategories[key].description = descLex;
                    }

                    categories.push(ContentBlocksCategories[key]);
                }
            }

            categories.sort(function(a, b) {
                if (a.sortorder < b.sortorder) return -1;
                if (a.sortorder > b.sortorder) return 1;
                return 0;
            });
            categories.push({id : '0', name : "Uncategorized", description: ""});

            // TODO: Should we just do this, which changes the type from object of objects to array of object
            // or would it be better to create a whole new thing? It seems silly to me to create another var
            // to just hold onto the same data.
            ContentBlocksCategories = categories;
        },
        initialized: false,
        initialize: function(contentBody) {
            // for typeahead
            $.ajaxSetup({
                beforeSend:function(xhr, settings){
                    if(!settings.crossDomain) {
                        xhr.setRequestHeader('modAuth',MODx.siteId);
                    }
                }
            });
            ContentBlocks.resourcesSource = ContentBlocks.resourcesSourceInit();
            ContentBlocks.initFields();
            ContentBlocks.initLayouts();
            ContentBlocks.initTemplates();
            ContentBlocks.initCategories();

            // Insert the new content blocks editing stuff
            contentBody.append(tmpl('contentblocks-wrapper-tpl', {}));
            var cbWrapper = contentBody.find('.contentblocks-wrapper');

            // Hide the wrapper first before generating the content
            cbWrapper.hide();
            cbWrapper.addClass(ContentBlocksWrapperCls);
            ContentBlocks.cbWrapper = cbWrapper;

            // Build the content and build the fields
            ContentBlocks.buildContents(ContentBlocksContents);
            ContentBlocks.initDelegates(cbWrapper);
            ContentBlocks.initDrops();            
            // Add modal html divs to start of body
            if ($('#contentblocks-modal').length < 1) {
                var $body = $('body');
                $body.addClass('contentblocks_loaded');
                $body.prepend('<div id="contentblocks-modal-mask"></div><div id="contentblocks-modal" class="' + ContentBlocksWrapperCls + '"></div>');
            }

            // Resize before showing. Seems somewhat counter-intuitive that it would work, but it does.
            $(window).resize();
            // Show ContentBlocks!
            cbWrapper.show();
            // .. and hide the loading message
            contentBody.find('#contentblocks_loading').remove();

            // For good measure we wait another few seconds for setting initialized to true
            setTimeout(function() {
                ContentBlocks.initialized = true;
                ContentBlocks.fixColumnHeights();
                cbWrapper.trigger('ContentBlocks.initialized');
            }, 2500);

            setTimeout(function() {
                ContentBlocks.fixColumnHeights();
            }, 3000);

        },
        
        getLinkFieldDataType: function(val) {
            var emailRE = new RegExp('^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$', 'i'),
                type = 'link';

            if (emailRE.test(val)) {
                type = 'email';
            }
            else if (val != '' && !isNaN(val)) {
                type = 'resource';
            }

            return type;            
        },
        
        // set up the resource source for resource link typeahead
        resourcesSource: false,

        resourcesSourceInit: function() {
            var source = new Bloodhound({
                prefetch: {
                    url: (typeof ContentBlocksResource !== 'undefined') ? ContentBlocksConfig.connectorUrl + '?action=content/resources/prefetch&context=' + ContentBlocksResource.context_key : ContentBlocksConfig.connectorUrl + '?action=content/resources/prefetch',
                    ttl: 3600000
                },
                remote: {
                    url: ContentBlocksConfig.connectorUrl + '?action=content/resources/search&query=%TERM%',
                    wildcard: '%TERM%',
                    rateLimitWait: 0, // kill rate limiting or link names won't show up when CB is initialized
                    rateLimitBy: 'throttle' // same as above
                },
                limit: 15,
                dupDetector: function (remoteMatch, localMatch) {
                    return remoteMatch.id == localMatch.id;
                },
                datumTokenizer: function (d) {
                    return d.tokens;
                },
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });
            source.initialize();
            return source;
        },

        render: function(selector) {
            var contentBody = $(selector);
            if (!contentBody || !contentBody.length) {
                if (console) console.error("Could not start up ContentBlocks; there are no matches for the selector. Trying to get CB working on a custom resource type? Contact support@modmore.com, we'd be glad to help. Tried: " + selector);
                return;
            }

            // Hide all existing bits in the content wrapper
            contentBody.children().hide();
            contentBody.append('<div id="contentblocks_loading" class="' + ContentBlocksWrapperCls + '">' + _('contentblocks.generating_canvas') + '</div>');

            setTimeout(function() {
                ContentBlocks.initialize(contentBody);
            }, 150);
        }
    };
})(vcJquery);

(function ($, ContentBlocks) {
    ContentBlocks.fieldTypes.repeater = function(dom, data) {
        var wrapper = dom.find('.contentblocks-repeater-wrapper'),
            emptyRowTmpl = tmpl('contentblocks-repeater-item'),
            maxItems = (data.properties && data.properties.max_items) ? data.properties.max_items : 0,
            minItems = (data.properties && data.properties.min_items) ? data.properties.min_items : 0,
            addFirstItem = (data.properties && typeof data.properties.add_first_item !== 'undefined') ? ContentBlocks.toBoolean(data.properties.add_first_item) : true,
            buttons = wrapper.siblings('.contentblocks-field-actions-bottom, .contentblocks-field-actions-top');

        var input = {
            init: function () {
                if (data.rows && $.isArray(data.rows) && data.rows.length > 0) {
                    $.each(data.rows, function(i, rowData) {
                        input.addRow(rowData);
                    })
                }
                else {
                    if(minItems > 1) {
                        for(var i = 0; i < minItems; i++) {
                            this.addRow();
                        }
                        dom.find('.contentblocks-repeater-delete-row').hide();
                    }
                    else if (addFirstItem) {
                        this.addRow();
                    }
                }

                buttons.on('click', '.contentblocks-repeater-add-item', input.addEmptyRow);
                dom.on('click', '.contentblocks-repeater-delete-row', input.deleteRow);
                dom.on('click', '.contentblocks-repeater-expanded', function() {
                    $(this).removeClass('contentblocks-repeater-expanded').addClass('contentblocks-repeater-collapsed').text('+').closest('.contentblocks-field-repeater').children('.contentblocks-repeater-wrapper').slideUp(300, function() {
                        ContentBlocks.fixColumnHeights();
                    });
                }).on('click', '.contentblocks-repeater-collapsed', function() {
                    $(this).removeClass('contentblocks-repeater-collapsed').addClass('contentblocks-repeater-expanded').text('-').closest('.contentblocks-field-repeater').children('.contentblocks-repeater-wrapper').slideDown(300, function() {
                        ContentBlocks.fixColumnHeights();
                    });
                });

                dom.on('click', '.contentblocks-repeater-item-expanded', function() {
                    $(this).removeClass('contentblocks-repeater-item-expanded').addClass('contentblocks-repeater-item-collapsed').text('+').closest('.contentblocks-repeater-row').children('.contentblocks-repeater-item-wrapper').slideUp(300, function() {
                        ContentBlocks.fixColumnHeights();
                    });
                }).on('click', '.contentblocks-repeater-item-collapsed', function() {
                    $(this).removeClass('contentblocks-repeater-item-collapsed').addClass('contentblocks-repeater-item-expanded').text('-').closest('.contentblocks-repeater-row').children('.contentblocks-repeater-item-wrapper').slideDown(300, function() {
                        ContentBlocks.fixColumnHeights();
                    });
                });

                wrapper.sortable({
                    items: '> li',
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
                    }
                });
            },

            deleteRow: function() {
                var currentItems = wrapper.children().length;

                if(currentItems > minItems) {
                    $(this).closest('.contentblocks-repeater-row').remove();
                    currentItems--;
                    // current items should never be able to get to be lower than minItems, but who knows?
                    if(currentItems <= minItems) {
                        dom.find('.contentblocks-repeater-delete-row').hide();
                    }
                }
                if (maxItems > 0) {
                    if(currentItems == (maxItems - 1)) {
                        buttons.find('.contentblocks-repeater-add-item').show();
                    }
                }

                ContentBlocks.fixColumnHeights();
            },

            addEmptyRow: function() {
                if (maxItems > 0) {
                    var currentItems = wrapper.children().length;
                    if (currentItems >= maxItems) {
                        ContentBlocks.alert(_('contentblocks.repeater.max_items_reached', {max: maxItems}));
                        return;
                    }
                }

                input.addRow({}, $(this).data('target'));
            },

            addRow: function(rowData, target) {
                rowData = rowData || {};

                // Generate the empty row wrapper, and inject it into the page
                var newRow = $(emptyRowTmpl({}));
                if (!target || target == 'bottom') {
                    wrapper.append(newRow);
                }
                else {
                    wrapper.prepend(newRow);
                }

                // Loop over each of the subfields to generate them individually, added tp the wrapper.
                $.each(data.subfields, function(idx, fld) {
                    // First make sure we combine whatever values we have available
                    var values = $.extend(true, {}, fld);
                    if (rowData[fld.parent_properties.key]) {
                        values = $.extend(true, {}, values, rowData[fld.parent_properties.key]);
                    }
                    // Call the ContentBlocks.addField API to create the subfield and have it injected into the canvas
                    var generatedField = ContentBlocks.addField(newRow.children('ul'), fld.id, values, 'bottom');

                    // Add a class for the width
                    if (values.parent_properties.width > 0) {
                        generatedField.css('width', values.parent_properties.width  + '%');
                    }
                    // Keep track of the repeater-key value so we can link it back together later
                    generatedField.data('repeater-key', values.parent_properties.key);
                });

                // Limit the number of items that can be added
                var currentItems = wrapper.children().length;
                if (maxItems > 0) {
                    if(currentItems == maxItems) {
                        buttons.find('.contentblocks-repeater-add-item').hide();
                    }
                }
                if (minItems > 0) {
                    if(currentItems > minItems) {
                        dom.find('.contentblocks-repeater-delete-row').show();
                    }
                }

                // Ensure the various columns are kept nicely aligned
                ContentBlocks.fixColumnHeights();
            },

            getData: function () {
                var rows = [];

                wrapper.children('.contentblocks-repeater-row').each(function(idx, row) {
                    var rowFields = {};
                    row = $(row);
                    row.children('ul').children('li').each(function(fldIdx, field) {
                        field = $(field);

                        var fldId = field.attr('id'),
                            input = ContentBlocks.generatedContentFields[fldId],
                            repeaterKey = field.data('repeater-key');

                        if (input) {
                            var value = input.getData();
                            value.fieldId = fldId;
                            // at this point settings are not supported, but maybe in the future
                            // value.settings = Ext.decode($field.data('settings')) || {};
                            rowFields[repeaterKey] = value;
                        }
                        else {
                            if (console) console.error('input not found with id', fldId);
                        }
                    });

                    rows.push(rowFields);
                });

                return {
                    rows: rows
                }
            }
        };

        return input;
    };
})(vcJquery, ContentBlocks);

(function ($, ContentBlocks) {
    ContentBlocks.fieldTypes.repeater = function(dom, data) {
        var group = Ext.decode(data.properties.group),
            wrapper = dom.find('.contentblocks-repeater-wrapper'),
            emptyRowTmpl = tmpl('contentblocks-repeater-item'),
            maxItems = (data.properties && data.properties.max_items) ? data.properties.max_items : 0,
            buttons = wrapper.next('.contentblocks-field-actions-bottom');

        var input = {
            init: function () {
                if (data.rows && $.isArray(data.rows) && data.rows.length > 0) {
                    $.each(data.rows, function(i, rowData) {
                        input.addRow(rowData);
                    })
                }
                else {
                    this.addRow();
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
                $(this).closest('.contentblocks-repeater-row').remove();
                if (maxItems > 0) {
                    var currentItems = wrapper.children().length;
                    if(currentItems == (maxItems - 1)) {
                        buttons.find('.contentblocks-repeater-add-item').show();
                    }
                }
            },

            addEmptyRow: function() {
                if (maxItems > 0) {
                    var currentItems = wrapper.children().length;
                    if (currentItems >= maxItems) {
                        ContentBlocks.alert(_('contentblocks.repeater.max_items_reached', {max: maxItems}));
                        return;
                    }
                }
                input.addRow();
            },

            addRow: function(rowData) {
                rowData = rowData || {};

                var newRow = $(emptyRowTmpl({}));
                $.each(group, function(idx, fld) {
                    var values = $.extend(true, {}, fld);
                    if (rowData[fld.key]) {
                        values = $.extend(true, {}, values, rowData[fld.key]);
                    }
                    newRow.children('ul').append(
                        input.createField(values)
                    );
                });

                newRow.on('click', '.contentblocks-repeater-item-expanded', function() {
                    $(this).removeClass('contentblocks-repeater-item-expanded').addClass('contentblocks-repeater-item-collapsed').text('+').closest('.contentblocks-repeater-row').children('.contentblocks-repeater-item-wrapper').slideUp(300, function() {
                        ContentBlocks.fixColumnHeights();
                    });
                }).on('click', '.contentblocks-repeater-item-collapsed', function() {
                    $(this).removeClass('contentblocks-repeater-item-collapsed').addClass('contentblocks-repeater-item-expanded').text('-').closest('.contentblocks-repeater-row').children('.contentblocks-repeater-item-wrapper').slideDown(300, function() {
                        ContentBlocks.fixColumnHeights();
                    });
                });
                wrapper.append(newRow);

                if (maxItems > 0) {
                    var currentItems = wrapper.children().length;
                    if(currentItems == maxItems) {
                        buttons.find('.contentblocks-repeater-add-item').hide();
                    }
                }
                ContentBlocks.fixColumnHeights();
            },

            createField: function(placeholders) {
                ContentBlocks.fldId++;
                placeholders.generated_id = 'contentblocks-field-' + ContentBlocks.fldId;
                placeholders.field = 0;

                // I18n for the name
                var nameLex = _(placeholders.name);
                if (nameLex && nameLex.length) {
                    placeholders.name = nameLex;
                }

                // Create the field html
                var fieldMarkup = $(tmpl('contentblocks-field-' + placeholders.input, placeholders));

                // Add a class for the width
                if (placeholders.width > 0) {
                    fieldMarkup.css('width', placeholders.width + '%');
                }
                fieldMarkup.data('repeater-key', placeholders.key);

                // Create a new instance of the input js
                if (typeof ContentBlocks.fieldTypes[placeholders.input] !== 'function') {
                    ContentBlocks.alert('Uh oh, could not load the input type ' + fieldType.input);
                    return false;
                }
                var inp = ContentBlocks.fieldTypes[placeholders.input](fieldMarkup, placeholders);

                // Set the id on the input
                inp.id = placeholders.generated_id;

                // Init the input
                if (inp.init) {
                    setTimeout(function() { inp.init() }, 150);
                }

                // Store the input
                ContentBlocks.generatedContentFields[placeholders.generated_id] = inp;
                return fieldMarkup;
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

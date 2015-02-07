(function ($, ContentBlocks) {
    ContentBlocks.fieldTypes.chunk = function(dom, data) {
        var input = {
            preview: dom.find('.chunkOutput'),
            propList: dom.find('.contentblocks-properties-list')
        };

        input.init = function() {
            if (!data.properties || !data.properties.chunk || data.properties.chunk < 1) {
                input.preview.html('<p>' + _('contentblocks.chunk.no_chunk_set') + '</p>');
                return;
            }

            var loadPreview = true;
            if (data.properties.custom_preview && data.properties.custom_preview.length > 1) {
                loadPreview = false;
                input.preview.html(data.properties.custom_preview);
            }
            else {
                dom.addClass('contentblocks-field-loading');
            }
            $.ajax({
                dataType: 'json',
                url: MODx.config.connector_url ? MODx.config.connector_url : MODx.config.connectors_url + "/element/chunk.php",
                type: "POST",
                headers: {
                    'modAuth': MODx.siteId
                },
                data: {
                    action: MODx.config.connector_url ? 'element/chunk/get' : 'get',
                    id: data.properties.chunk
                },
                context: this,
                success: function(result) {
                    if (!result.success) {
                        input.preview.html(result.message);
                        ContentBlocks.alert(result.message);
                    }
                    else {
                        if (loadPreview) {
                            var content = result.object.content;
                            content = content.replace(/(<\s*\/?\s*)script(\s*([^>]*)?\s*>)/gi ,'$1jscript$2');
                            dom.find('.chunkOutput').html(content);
                        }

                        if (result.object.properties) {
                            this.loadProperties(result.object.properties);
                        }
                    }
                    dom.removeClass('contentblocks-field-loading');
                }
            });
        };

        input.getData = function() {
            var properties = {};

            input.propList.find('li').each(function(idx, li) {
                var $li = $(li),
                    ip = $li.find('input,select'),
                    key = ip.data('name');
                properties[key] = ip.val();
            });
            return {
                chunk_properties: properties
            };
        };

        input.loadProperties = function(props) {
            input.propList.empty().hide();
            if (props) {
                $.each(props, function(key, property) {
                    var val = (data.chunk_properties && data.chunk_properties[key]) ? data.chunk_properties[key] : property.value;

                    property.id = 'contentblocks-chunk-property-' + key + '-' + data.generated_id;
                    property.key = key;
                    property.value = val;

                    switch (property.type) {
                        default:
                            input.propList.append(tmpl('contentblocks-field-chunk-property', property));
                            break;
                    }

                    var prop = input.propList.find('#' + property.id);
                    prop.find('input,select').on('change', function() {
                        ContentBlocks.fireChange();
                    })
                });
                input.propList.show();
                ContentBlocks.fixColumnHeights();
            }
        };

        return input;
    }
})(vcJquery, ContentBlocks);

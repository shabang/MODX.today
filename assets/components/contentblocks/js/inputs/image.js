(function ($, ContentBlocks) {
    ContentBlocks.fieldTypes.image = function(dom, data) {
        var input = {
            fileBrowser: false,
            source: data.properties.source > 0 ? data.properties.source : ContentBlocksConfig['image.source'],
            directory: data.properties.directory
        };

        input.init = function() {
            if (data.url && data.url.length) {
                var urls = ContentBlocks.utilities.normaliseUrls(data.url);
                dom.find('.url').val(urls.cleanedSrc);
                dom.find('.size').val(data.size);
                dom.find('.width').val(data.width);
                dom.find('.height').val(data.height);
                dom.find('.extension').val(data.extension);
                dom.find('img').attr('src', (data.properties.thumbnail_size)
                    ? ContentBlocks.utilities.getThumbnailUrl(data.url, data.properties.thumbnail_size)
                    : urls.displaySrc);
                dom.addClass('preview');
            }

            dom.find('.contentblocks-field-delete-image').on('click', function() {
                dom.removeClass('preview');
                dom.find('.url').val('');
                dom.find('.size').val('');
                dom.find('.width').val('');
                dom.find('.height').val('');
                dom.find('.extension').val('');
                dom.find('img').attr('src', '');

                ContentBlocks.fixColumnHeights();
                ContentBlocks.fireChange();
            });
            dom.find('.contentblocks-field-upload').on('click', function() {
                dom.find('.contentblocks-field-upload-field').click();
            });

            dom.find('.contentblocks-field-image-choose').on('click', $.proxy(function() {
                this.chooseImage();
            }, this));
            dom.find('.contentblocks-field-image-url').on('click', $.proxy(function() {
                this.promptImage();
            }, this));

            this.initUpload();
            this.initDropReceiver();
        };

        input.initDropReceiver = function() {
            MODx.load({
                xtype: 'modx-treedrop'
                ,target: dom
                ,targetEl: dom.get(0)
                ,onInsert: function(val) {
                    input.insertFromUrl(val);
                }
            });
        };

        input.initUpload = function() {

            var id = dom.attr('id');
            dom.find('#' + id + '-upload').fileupload({
                url: ContentBlocksConfig.connectorUrl + '?action=content/image/upload',
                dataType: 'json',
                dropZone: dom,
                progressInterval: 250,
                paramName: 'file',
                pasteZone: null,

                /**
                 * Add an item to the upload queue.
                 *
                 * The item gets an image preview using the FileReader APIs if available
                 *
                 * @param e
                 * @param data
                 */
                add: function(e, data) {
                    ContentBlocks.fireChange();
                    dom.addClass('uploading');
                    data.files[0].ext = data.files[0].name.split('.').pop();
                    if (data.files[0].size < 700000 && window.FileReader) {
                        // Only if the image is smaller than ~ 700kb we want to show a preview.
                        // This is to prevent filling up the users' RAM, while providing the user
                        // with a fancy preview of what they're uploading.
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            dom.find('img').attr('src', e.target.result);
                            ContentBlocks.fixColumnHeights();
                        };
                        reader.readAsDataURL(data.files[0]);
                    }

                    setTimeout(function() {
                        data.submit();
                    }, 1000);
                },

                /**
                 * When the image has been uploaded add it to the collection.
                 *
                 */
                done: function(e, responseData) {
                    if (responseData.result.success) {
                        var record = responseData.result.object,
                            urls = ContentBlocks.utilities.normaliseUrls(record.url);
                        dom.find('.url').val(urls.cleanedSrc);
                        dom.find('.size').val(record.size);
                        dom.find('.width').val(record.width);
                        dom.find('.height').val(record.height);
                        dom.find('.extension').val(record.extension);
                        dom.find('img').attr('src', (data.properties.thumbnail_size)
                            ? ContentBlocks.utilities.getThumbnailUrl(record.url, data.properties.thumbnail_size)
                            : urls.displaySrc);
                        dom.addClass('preview');
                        input.loadTinyRTE();
                    }
                    else {
                        var message = _('contentblocks.upload_error', {file: responseData.files[0].filename, message: responseData.result.message});
                        if (responseData.files[0].size > 1048576*1.5) {
                            message += _('contentblocks.upload_error.file_too_big');
                        }
                        ContentBlocks.alert(message);
                        dom.find('img').attr('src','');
                    }
                    dom.removeClass('uploading');

                    setTimeout(function() {
                        ContentBlocks.fixColumnHeights(dom.parents('.contentblocks-region-content'));
                    }, 150);
                },

                fail: function(e, data) {
                    var message = _('contentblocks.upload_error', {file: data.files[0].filename, message:  data.result.message});
                    if (data.files[0].size > 1048576*1.5) {
                        message += _('contentblocks.upload_error.file_too_big');
                    }
                    ContentBlocks.alert(message);

                    dom.removeClass('uploading');
                    dom.find('img').attr('src','');

                    ContentBlocks.fixColumnHeights(dom.parents('.contentblocks-region-content'));
                },

                /**
                 * Fetch the items we want to send along in the POST. In this case,
                 * this is overridden because normally it sends the entire form = the resource.
                 * All we really want is the resource ID, which we fetch from the URL.
                 * @returns {Array}
                 */
                formData: function() {
                    return [{
                        name: 'HTTP_MODAUTH',
                        value: MODx.siteId
                    },{
                        name: 'resource',
                        value: MODx.request.id || 0
                    },{
                        name: 'field',
                        value: data.id
                    }];
                },

                /**
                 * Update progress for queue items
                 */
                progress: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10) + '%';
                    dom.find('.upload-progress .bar').width(progress);
                }
            });
        };

        input.chooseImage = function() {
            var fileBrowser = MODx.load({
                xtype: 'modx-browser',
                id: Ext.id(),
                multiple: true,
                listeners: {
                    select: function(imageData) {
                        input.chooseImageCallback(imageData);
                    }
                },
                allowedFileTypes: data.properties.file_types,
                hideFiles: true,
                title: _('contentblocks.choose_image'),
                source: input.source
            });
            fileBrowser.setSource(input.source);

            fileBrowser.show();
        };

        input.chooseImageCallback = function(imageData) {
            var url = imageData.fullRelativeUrl;
            if (url.substr(0, 4) != 'http' && url.substr(0,1) != '/' ) {
                url = MODx.config.base_url + url;
            }
            var urls = ContentBlocks.utilities.normaliseUrls(url);
            dom.find('.url').val(urls.cleanedSrc);
            dom.find('.size').val(imageData.size);
            dom.find('.width').val(imageData.image_width);
            dom.find('.height').val(imageData.image_height);
            dom.find('.extension').val(imageData.ext);
            dom.find('img').attr('src', (data.properties.thumbnail_size)
                ? ContentBlocks.utilities.getThumbnailUrl(url, data.properties.thumbnail_size)
                : urls.displaySrc);
            dom.addClass('preview');
            ContentBlocks.fireChange();
            this.loadTinyRTE();
        };

        // Prompts the user to enter an image url directly.
        input.promptImage = function() {
            Ext.Msg.prompt(_('contentblocks.from_url_title'),
                _('contentblocks.from_url_prompt'),
                function(btn, url, prompt) {
                    // The user cancelled
                    if (btn !== 'ok') {
                        return;
                    }

                    input.insertFromUrl(url);
                }, this);
        };

        input.insertFromUrl = function(url) {
            if (!url || url.length < 3) {
                ContentBlocks.alert('No URL provided.');
                return;
            }

            dom.addClass('contentblocks-field-loading');
            $.ajax({
                dataType: 'json',
                url: ContentBlocksConfig.connector_url,
                type: "POST",
                beforeSend:function(xhr, settings){
                    if(!settings.crossDomain) {
                        xhr.setRequestHeader('modAuth',MODx.siteId);
                    }
                },
                data: {
                    action: 'content/image/download',
                    field: data.field,
                    resource: ContentBlocksResource && ContentBlocksResource.id ? ContentBlocksResource.id : 0,
                    url: url
                },
                context: this,
                success: function(result) {
                    dom.removeClass('contentblocks-field-loading');
                    if (!result.success) {
                        ContentBlocks.alert(result.message);
                    }
                    else {
                        var urls = ContentBlocks.utilities.normaliseUrls(result.object.url);

                        dom.find('.url').val(urls.cleanedSrc);
                        dom.find('.size').val(result.object.size);
                        dom.find('.width').val(result.object.width);
                        dom.find('.height').val(result.object.height);
                        dom.find('.extension').val(result.object.extension);
                        dom.find('img').attr('src', (data.properties.thumbnail_size)
                            ? ContentBlocks.utilities.getThumbnailUrl(urls.cleanedSrc, data.properties.thumbnail_size)
                            : urls.displaySrc);
                        dom.addClass('preview');
                        ContentBlocks.fireChange();
                        this.loadTinyRTE();
                    }
                }
            });
        };

        input.getData = function () {
            return {
                url: dom.find('.url').val(),
                size: dom.find('.size').val(),
                width: dom.find('.width').val(),
                height: dom.find('.height').val(),
                extension: dom.find('.extension').val()
            };
        };

        input.loadTinyRTE = function() { };

        return input;
    };

    ContentBlocks.fieldTypes.image_with_title = function(dom, data) {
        var input = ContentBlocks.fieldTypes.image(dom, data);

        input.init = function () {
            if (data.url && data.url.length) {
                var urls = ContentBlocks.utilities.normaliseUrls(data.url);
                dom.find('.url').val(urls.cleanedSrc);
                dom.find('.size').val(data.size);
                dom.find('.width').val(data.width);
                dom.find('.height').val(data.height);
                dom.find('.extension').val(data.extension);
                dom.find('img').attr('src', (data.properties.thumbnail_size)
                    ? ContentBlocks.utilities.getThumbnailUrl(data.url, data.properties.thumbnail_size)
                    : urls.displaySrc);
                dom.find('.title').val(data.title || '');
                dom.addClass('preview');
                this.loadTinyRTE();
            }

            dom.find('.contentblocks-field-delete-image').on('click', function() {
                dom.removeClass('preview');
                dom.find('.url').val('');
                dom.find('.size').val('');
                dom.find('.width').val('');
                dom.find('.height').val('');
                dom.find('.extension').val('');
                dom.find('.title').val('').removeClass('tinyrte-replaced');
                dom.find('img').attr('src', '');
                dom.find('.tinyrte-container').remove();

                ContentBlocks.fixColumnHeights();
                ContentBlocks.fireChange();
            });
            dom.find('.contentblocks-field-upload').on('click', function() {
                dom.find('.contentblocks-field-upload-field').click();
            });

            dom.find('.contentblocks-field-image-choose').on('click', $.proxy(function() {
                this.chooseImage();
            }, this));
            dom.find('.contentblocks-field-image-url').on('click', $.proxy(function() {
                this.promptImage();
            }, this));

            this.initUpload();
            this.initDropReceiver();
        };

        input.loadTinyRTE = function() {
            if (ContentBlocks.toBoolean(data.properties.use_tinyrte)) {
                var title = dom.find('.title');
                ContentBlocks.addTinyRte(title);
            }
        };

        input.getData = function () {
            return {
                url: dom.find('.url').val(),
                title: dom.find('.title').val(),
                size: dom.find('.size').val(),
                width: dom.find('.width').val(),
                height: dom.find('.height').val(),
                extension: dom.find('.extension').val()
            };
        };
        return input;
    };

})(vcJquery, ContentBlocks);

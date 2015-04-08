jQuery(function($) {
    var importId = 0;
    var templates = {
        image: '<div data-id="<%= cid %>" class="inner <% if (active) { %> image_active <% } else { %> image_inactive <% } %>"><div class="image-wrapper">' +
            '<div class="image" style="background-image: url(<%= mgr_thumb %>);">' +
            '   <div class="mask">' +
            '       <div class="image-actions">' +
                '       <a class="zoom mgsearchicon icon icon-search" href="javascript:void(0); //View full-size image" title="<%= moreGallery.lang("view_full_size_image") %>"></span>' +
                '       <a class="activate mgtrashicon icon icon-eye" href="javascript:void(0); //<%= moreGallery.lang("activate_image") %>" title="<%= moreGallery.lang("activate_image") %>"></a>' +
                '       <a class="deactivate mgtrashicon icon icon-eye-slash" href="javascript:void(0); //<%= moreGallery.lang("deactivate_image") %>" title="<%= moreGallery.lang("deactivate_image") %>"></a>' +
                '       <a class="delete mgtrashicon icon icon-trash-o" href="javascript:void(0); //Delete this image" title="<%= moreGallery.lang("delete_image") %>"></a>' +
            '       </div>' +
            '   </div>' +
            '</div>' +
            '<div class="meta">' +
            '   <p class="name"><%= name %></p>' +
            '   <p class="filename"><%= filename %></p>' +
            '   <a class="edit mgicon-pencil icon icon-pencil-square-o"></a>' +
            '</div>' +
            '<div class="uploadprogress">' +
            '   <div class="uploading"></div>' +
            '   <div class="filename"><%= filename %></div>' +
            '   <div class="bar"></div>' +
            '</div>' +
        '</div>' +
        '</div>',

        appView: '<div class="mgresource-toolbar">' +
            '<ul>' +
            '   <li><a href="javascript: void(0);" id="mgresource-image-upload" title="<%= moreGallery.lang("upload_image") %>">' +
                '   <span class="icon mgicon-upload icon-upload"></span>' +
                '   <span class="headline"><%= moreGallery.lang("upload") %></span>' +
            '   </a></li>' +
            '   <li><a href="javascript: void(0);" id="mgresource-image-import" title="<%= moreGallery.lang("import_image") %>">' +
                '   <span class="icon mgicon-download icon-download"></span>' +
                '   <span class="headline"><%= moreGallery.lang("import") %></span>' +
            '   </a></li>' +
            '   <li><a href="javascript: void(0);" id="mgresource-image-refresh" title="<%= moreGallery.lang("refresh") %>">' +
                '   <span class="icon mgicon-cycle icon-refresh"></span>' +
                '   <!--<span class="headline"><%= moreGallery.lang("refresh") %></span>-->' +
            '   </a></li>' +
            '   <li id="mgresource-droparea">' +
        '           <p><i class="mgicon-upload icon icon-upload"></i> <%= moreGallery.lang("drop_to_upload") %></p>' +
            '   </li>' +
            '   <li id="mgresource-stats">' +
                '   <span id="mgresource-image-count">0</span> <%= moreGallery.lang("images_count") %>' +
            '   </li>' +
            '</ul>' +
            '</div>' +

            '<div class="mgresource-loading spinner"></div>' +
            '' +
            '<input id="mgresource-upload-input" type="file" name="upload" multiple>' +
            '' +
            '<div id="mgresource-modal-mask"></div>' +
            '' +
            '<div id="mgresource-imagearea"><ul id="mgresource-imagelist"></ul></div>' +
            '' +
            '<div id="mgresource-modal"></div>',

        modalImageView: '<div class="image-large">' +
            '   <img id="mgimage-image" src="<%= file_url %>" alt="<%= filename %>" />' +
            '   <div class="mgimage-crops"></div>' +
            '</div>' +
            '<div class="edit-form">' +
            '   <a href="javascript:void(0);" class="close">&times;</a>' +
            '   <h3><%= moreGallery.lang("edit_image_header") %></h3>' +
            '   <label><%= moreGallery.lang("name_field") %> <br /><input type="text" name="mgimage-name" id="mgimage-name" value="<%= name %>"></label><br />' +
            '   <label for="mgimage-description"><%= moreGallery.lang("description") %></label> <br />' +
            '   <textarea name="mgimage-description" id="mgimage-description" rows="5"><%= description %></textarea> <br />' +
            '' +
            '   <div class="mgimage-tags">' +
            '       <label for="mgimage-new-tag"><%= moreGallery.lang("tags") %></label>' +
            '       <br />' +
            '       <div class="mgimage-tags-holder mgimage-tags-loading">' +
            '           <input type="text" id="mgimage-new-tag">' +
            '           <button id="mgimage-add-new-tag"><%= moreGallery.lang("tags.add") %></button>' +
            '           <ul></ul>' +
            '           <div class="spinner"></div>' +
            '       </div>' +
            '   </div>' +
            '' +
            '   <label><%= moreGallery.lang("url") %> <br /><input type="text" name="mgimage-url" id="mgimage-url" value="<%= url %>"></label>' +
            '   <div class="edit-form-buttons">' +
        '           <a href="javascript:void(0);" class="save">' +
        '               <span class="headline"><%= moreGallery.lang("save") %></span>' +
        '           </a>' +
            '   </div>' +
            '</div>',
        modalImageTagView: '<li class="mgimage-tag" data-tag-id="<%= id %>">' +
            '   <span class="mgimage-tag-remove">&times;</span>' +
            '   <span class="mgimage-tag-display"><%= display %></span>' +
            '</li>',
        modalZoomView: '<div class="image-zoom">' +
            '   <h3><%= name %></h3>' +
            '   <a href="javascript:void(0);" class="close">&times;</a>' +
            '   <img src="<%= file_url %>" alt="<%= filename %>" />' +
            '</div>',
        cropView: '<div class="image-crop">' +
            '   <a href="<%= thumbnail_url %>" target="_blank" class="image-crop-preview">' +
            '       <img src="<%= thumbnail_url %>" alt="<%= key %>" >' +
            '   </a>' +
            '   <label><%= key_display %></label>' +
            '   <button class="image-crop-edit" data-crop="<%= key %>"><%= moreGallery.lang("edit_crop") %></button>' +
            '   <span class="image-crop-saving-spinner"></span> ' +
            '</div>',
        modalImport: '<div class="modal-import">' +
            '   <a href="javascript:void(0);" class="close">&times;</a>' +
            '   <h3>Import Images</h3>' +
            '   <p>Choose import Source</p>' +
            '' +
            '<ul class="options">' +
            '   <li>' +
            '       <a href="javascript:void(0);" class="import-from-gallery">Gallery</a>' +
            '       <div class="content">' +
            '           <select name="selection"><%= galleries %></select>' +
            '       </div>' +
            '   </li>' +
            '   <li>' +
            '       <a href="javascript:void(0);" class="import-from-file">File</a>' +
            '   </li>' +
            '   <li>' +
            '       <a href="javascript:void(0);" class="import-from-file">Folder</a>' +
            '   </li>' +
            '</ul>' +
            '</div>'
    };

    Backbone.sync = moreGallery.backboneSync;

    var Image = Backbone.Model.extend({
        defaults: {
            id: 0,
            resource: MODx.request.id,
            filename: '',
            file: '',
            file_url: '',
            mgr_thumb: '',
            active: true,
            name: '',
            description: '',
            url: '',
            sortorder: 0,
            width: 0,
            height: 0,
            crops: ''
        },

        actions: {
            create: 'mgr/images/create',
            read: 'mgr/images/getlist',
            update: 'mgr/images/update',
            delete: 'mgr/images/remove',
            patch: 'mgr/images/update'
        },
        url: moreGallery.config.connector_url + '?resource='+MODx.request.id
    });

    var ImageView = Backbone.View.extend({
        tagName: 'li',
        template: underscore.template(templates.image),

        events: {
            'click .meta': 'startEdit',
            'click a.delete': 'removeItem',
            'click a.activate': 'toggleActive',
            'click a.deactivate': 'toggleActive',
            'click .mask': 'viewImage'
        },

        render: function(){
            var data = this.model.attributes;
            data.cid = this.model.cid;
            this.$el.html(this.template(data));
            return this;
        },

        initialize: function() {
            this.listenTo(this.model, 'change', this.render);
            this.listenTo(this.model, 'destroy', this.remove);
            this.listenTo(this.model, 'uploadComplete', this.uploadComplete);
        },

        startEdit: function() {
            this.model.trigger('startEdit', {model: this.model});
        },

        viewImage: function() {
            this.model.trigger('zoomImage', {model: this.model});
        },

        toggleActive: function() {
            this.model.set('active', !this.model.get('active'));
            this.model.save();
            return false;
        },

        removeItem: function() {
            if (confirm(moreGallery.lang('confirm_remove', {name: this.model.attributes.name}))) {
                var view = this;
                this.$el.animate({opacity: 0}, 800, function() {
                    $(this).animate({width: 0}, 400, function() {
                        view.model.destroy();
                    })
                });
            }
            return false;
        },

        uploadComplete: function() {
            var view = this,
                viewInner = view.$el.find('> div');
            viewInner.addClass('mgimage-upload-new').removeClass('mgimage-uploading');

            setTimeout(function() {
                viewInner.removeClass('mgimage-upload-new');
            }, 2500);
        }
    });


    var ImageCollection = Backbone.Collection.extend({
        el : $('#mgresource-imagelist'),

        // Reference to this collection's model.
        model: Image,

        actions: {
            create: 'mgr/images/create',
            read: 'mgr/images/getlist',
            update: 'mgr/images/update',
            delete: 'mgr/images/remove',
            patch: 'mgr/images/update'
        },
        url: moreGallery.config.connector_url + '?resource='+MODx.request.id,

        render: function() {
            $(this.imageCount).html(this.length);
        },

        initialize: function() {
            this.listenTo(this, 'add', this.addOne);
            this.listenTo(this, 'add', this.render);
            this.listenTo(this, 'remove', this.render);
        },

        addOne: function(image) {
            var view = new ImageView({model: image});
            $(this.el.selector).append(view.render().el);
        }
    });
    var imageCollection = new ImageCollection;

    moreGallery.ImageAppView = Backbone.View.extend({
        appViewTemplate: underscore.template(templates.appView),
        modalViewTemplate: underscore.template(templates.modalImageView),
        modalZoomViewTemplate: underscore.template(templates.modalZoomView),
        modalImportTemplate: underscore.template(templates.modalImport),
        cropViewTemplate: underscore.template(templates.cropView),

        collection: imageCollection,

        imageCount: '#mgresource-image-count',

        rendered: false,

        modal: null,
        modalSelector: '#mgresource-modal',
        modalMask: null,
        modalMaskSelector: '#mgresource-modal-mask',
        activeModelInModal: null,

        fileBrowser: null,

        dropZoneInitiated: false,

        refresh: function() {
            this.startLoading();
            this.collection.fetch({
                success: this.doneLoading,
                error: this.doneLoading
            });
        },

        render: function() {
            if (!this.rendered) {
                var html = this.appViewTemplate({});
                this.$el.html(html);


                var appView = this,
                    relMaxPos = jQuery('#modx-header').height() + 12;
                jQuery('#modx-content').find('> .x-panel-bwrap > .x-panel-body').scroll(function() {
                    var hasCls = appView.$el.hasClass('fixed-toolbar'),
                        relPos = appView.$el.offset().top;

                    if (!hasCls && (relPos < relMaxPos)) {
                        appView.$el.addClass('fixed-toolbar');
                    }
                    if (hasCls && (relPos > relMaxPos)) {
                        appView.$el.removeClass('fixed-toolbar');
                    }
                });

                this.refresh();
                this.initializeUpload();
                this.rendered = true;
            }
            return this;
        },

        initialize: function() {
            this.listenTo(this.collection, 'sync', this.doSortable);
            this.listenTo(this.collection, 'add', this.updateCount);
            this.listenTo(this.collection, 'remove', this.updateCount);
            this.listenTo(this.collection, 'startEdit', this.modelStartEdit);
            this.listenTo(this.collection, 'stopEdit', this.modelStopEdit);
            this.listenTo(this.collection, 'zoomImage', this.zoomImage);
        },

        events: {
            "click #mgresource-image-refresh"  : 'refresh',
            "click #mgresource-image-upload"   : function() {
                $('#mgresource-upload-input').trigger('click');
            },
            //"click #mgresource-image-import": 'openImportModal',
            "click #mgresource-image-import": 'importFromFile',
            "updateSort": 'updateSort',
            'click #mgresource-modal-mask' : 'modelStopEdit',
            'click #mgresource-modal .close': 'modelStopEdit',
            'blur #mgresource-modal .edit-form input, #mgresource-modal .edit-form textarea': 'updateFromModal',
            'click #mgresource-modal .save': 'updateFromModal',

            'click .modal-import .import-from-file': 'importFromFile'
        },

        openImportModal: function(e) {
            var data = {
                attributes: {
                    galleries: '<option value="1">Gallery Uno</option><option value="2">Gallery Deux</option><option value="3">Gallery Trois</option>'
                }
            };

            this.openModal(this.modalImportTemplate, data, '50%');
        },

        importFromFile: function(e) {
            var appView = this;
            if (!this.fileBrowser) this.fileBrowser = MODx.load({
                xtype: 'modx-browser',
                onSelect: function(data) {
                    with(appView) { appView.importFromFileSelect(data); }
                },
                allowedFileTypes: 'jpg,jpeg,png,gif',
                hideFiles: true,
                title: moreGallery.lang('import_image'),
                source: moreGallery.getResourceProperty(moreGallery.ResourceRecord, 'source', moreGallery.config.source)
            });

            this.fileBrowser.show();

        },

        importFromFileSelect: function(data) {
            importId++;
            var image = new Image({
                id: 'import_' + importId,
                filename: data.name,
                mgr_thumb: moreGallery.config.assets_url + 'mgr/img/importing.png',
                file_url: moreGallery.config.assets_url + 'mgr/img/importing.png',
                name: data.name,
                sortorder: this.collection.length
            });
            this.collection.add(image);

            var postData = {
                tmpid: 'import_' + importId,
                cid: image.cid,
                file: data.pathname,
                filename: data.name,
                resource: MODx.request.id
            };

            var appView = this;
            jQuery.ajax({
                url: moreGallery.config.connector_url + '?action=mgr/images/import_file',
                data: postData,
                dataType: 'json',
                type: 'POST',
                success: function(data, textStatus, jqXhr) {
                    // Successful processor?
                    if (data.success) {
                        var record = data.object;
                        jQuery.each(record, function(key, value) {
                            image.set(key, value);
                        });
                        image.trigger('uploadComplete');
                    }
                    // Uh oh, no bueno.
                    else {
                        alert(moreGallery.lang('upload_error', {file: postData.filename, message: data.message}));
                        image.trigger('destroy');
                    }
                },
                error: function(jqXhr, textStatus, errorThrown) {
                    alert(moreGallery.lang('upload_error', {file: postData.filename, message: textStatus + ' ('+errorThrown+')'}));
                    image.trigger('destroy');
                }
            });
        },

        modelStartEdit: function(data) {
            this.openModal(this.modalViewTemplate, data.model);

            if (MODx && MODx.loadRTE && moreGallery.config.use_rte_for_images) {
                var appView = this;
                MODx.loadRTE('mgimage-description');
                setTimeout(function() {
                    with (appView) { appView.fixContainerHeight(); }
                }, 150);
            }

            $('#mgimage-name, #mgimage-url').on('keydown', function(e)
            {
                if (e.keyCode == 13)
                {
                    e.preventDefault();
                }
            });

            // Initiate tags
            var imageTags = new moreGallery.Views.TagCollection({
                el: $('.mgimage-tags-holder'),
                image: data.model.id
            });

            var cropsHolder = $('.mgimage-crops'),
                currentCrops = Ext.decode(data.model.attributes.crops) || {},
                that = this,
                jcrop_api;

            this.displayCrops(cropsHolder, currentCrops, this);

            cropsHolder.on('click', '.image-crop-edit', function() {
                var btn = $(this),
                    key = btn.data('crop'),
                    crop = moreGallery.crops[key],
                    text = btn.text();

                if (text == moreGallery.lang('save_crop'))
                {
                    // Grab the selected coords and release the selection
                    var selected = jcrop_api.tellSelect(),
                        previewSpinner = btn.siblings('.image-crop-saving-spinner');

                    btn.attr('disabled', true).text(moreGallery.lang('processing_crop'));
                    previewSpinner.addClass('spinner');
                    jcrop_api.release();
                    jcrop_api.disable();

                    // Make sure we have full pixels instead of decimals
                    $.each(selected, function(index, value) {
                        selected[index] = Math.round(value);
                    });

                    // Update the currentCrops object and write it to the database
                    currentCrops[key].x = selected.x;
                    currentCrops[key].y = selected.y;
                    currentCrops[key].x2 = selected.x2;
                    currentCrops[key].y2 = selected.y2;
                    currentCrops[key].width = selected.w;
                    currentCrops[key].height = selected.h;

                    var encoded = Ext.encode(currentCrops);
                    data.model.set('crops', encoded);
                    data.model.save(null, {
                        success: function (model, response, options)
                        {
                            var newCrops = Ext.decode(model.attributes.crops) || {};
                            // Redraw the crops display so it shows the updated values
                            that.displayCrops(cropsHolder, newCrops, that);
                            // Update the text and re-enable buttons
                            btn.text(moreGallery.lang('edit_crop'));
                            cropsHolder.find('button').removeAttr('disabled');
                            previewSpinner.removeClass('spinner');
                        }
                    });


                }
                else {
                    // Disable all buttons except the current, set to save
                    cropsHolder.find('button').attr('disabled', true);
                    btn.text(moreGallery.lang('save_crop')).removeAttr('disabled');

                    // Select the current crop if there is one
                    if (currentCrops[key] && currentCrops[key].width > 0)
                    {
                        jcrop_api.setSelect([currentCrops[key].x,currentCrops[key].y,currentCrops[key].x2,currentCrops[key].y2]);
                    }

                    // Update some crop-specific options
                    jcrop_api.setOptions({
                        aspectRatio: crop['aspect'] ? crop['aspect'] : null,
                        minSize: [
                            crop['min_width'] ? crop['min_width'] : 0,
                            crop['min_height'] ? crop['min_height'] : 0
                        ]
                    });

                    // Enable the crop
                    jcrop_api.enable();
                }
            });

            this.$('#mgimage-image').Jcrop({
                trueSize: [data.model.attributes.width, data.model.attributes.height],
                keySupport: false
            }, function() {
                jcrop_api = this;
                jcrop_api.disable();
            });

            if (!this.dropZoneInitiated) {
                this.dropZoneInitiated = true;
                new MODx.load({
                    xtype: 'modx-treedrop'
                    ,target: this.$('#mgimage-url')
                    ,targetEl: this.$('#mgimage-url')[0]
                });
            }
        },

        displayCrops: function(cropsHolder, currentCrops, that)
        {
            cropsHolder.empty();

            $.each(moreGallery.crops, function(key, options) {
                options = $.extend({}, options, currentCrops[key] || {});
                options.key = key;
                options.thumbnail_url = options.thumbnail_url + '?hash=' + options.thumbnail_hash;
                options.key_display = _('crop_name.' + key) || key;
                cropsHolder.append(that.cropViewTemplate(options));
            });
        },

        zoomImage: function(data) {
            this.openModal(this.modalZoomViewTemplate, data.model);
        },

        openModal: function(template, model, width) {
            width = width || '80%';
            if (!this.modalMask) {
                this.modalMask = this.$(this.modalMaskSelector);
            }

            this.activeModelInModal = model;

            // Load modal
            var modalHtml = template(model.attributes);
            this.modal = this.$(this.modalSelector).html(modalHtml);
            this.modal.css('width', width);
            this.modalMask.fadeIn();
            this.modal.fadeIn();

            this.fixContainerHeight();

            var appView = this;
            this.modal.find('img').on('load', function() {
                appView.fixContainerHeight();
            });

            // Set the top position of the modal so it's within view.
            var pageScrolled = $('#modx-panel-resource').parent().scrollTop(),
                appViewTop = $('#moregallery-content').position().top,
                headerHeight = $('#modx-header').height(),
                modalTop = pageScrolled - appViewTop + headerHeight;

            if (modalTop < 150) modalTop = 150;

            this.modal.css('top', modalTop);
        },

        fixContainerHeight: function() {
            if (this.modal) {
                var height = this.modal.height(),
                    offset = this.modal.position().top,
                    total = height + offset,
                    currentHeight = this.$el.find('#mgresource-imagearea').height();

                if (currentHeight < total) {
                    this.$el.find('#mgresource-imagearea').height(total);
                }
            }
        },

        modelStopEdit: function() {
            if (this.modal) {
                var appView = this;
                this.modal.fadeOut({
                    complete: function() {
                        appView.modal = null;
                        appView.$el.find('#mgresource-imagearea').height('auto');
                    }
                });
                this.modalMask.fadeOut();


                if (window.tinyMCE) {
                    var ed = tinyMCE.get('mgimage-description');
                    if (ed) ed.remove();
                }
            }
        },

        updateFromModal: function() {
            var diff = false,
                fields = [{
                    name: 'mgimage-name',
                    key: 'name'
                },{
                    name: 'mgimage-description',
                    key: 'description'
                },{
                    name: 'mgimage-url',
                    key: 'url'
                }],
                appView = this,
                saveBtn = appView.$el.find('#mgresource-modal .save');

            $.each(fields, function(index, fld) {
                var fieldValue = '',
                    field = appView.$('#mgresource-modal input[name='+fld.name+'], #mgresource-modal textarea[name='+fld.name+']'),
                    currentValue = appView.activeModelInModal.get(fld.key);
                if (field) fieldValue = field.val();

                if (fieldValue != currentValue) {
                    diff = true;
                    appView.activeModelInModal.set(fld.key, fieldValue);
                }
            });

            if (diff) {
                saveBtn.text(moreGallery.lang('saving')).addClass('mgimage-saving');
                appView.activeModelInModal.save(null, {
                    success: function() {
                        var d = new Date,
                            hours = d.getHours(),
                            minutes = d.getMinutes(),
                            seconds = d.getSeconds();
                        if (hours < 10) hours = '0' + hours.toString();
                        if (minutes < 10) minutes = '0' + minutes.toString();
                        if (seconds < 10) seconds = '0' + seconds.toString();

                        var time = hours + ':' + minutes + ':' + seconds;
                        saveBtn.text(moreGallery.lang('saved_at', {time: time})).removeClass('mgimage-saving');
                    }
                });
            }
        },

        updateCount: function(model, collection) {
            this.$('#mgresource-image-count').html(collection.length);
            this.doSortable();
        },

        sortInitialized: false,
        isSortableDrop: false,
        doSortable: function() {
            if (!this.sortInitialized) {
                var appView = this;
                this.$('#mgresource-imagelist').sortable({
                    placeholder: 'sortable-placeholder',
                    update: function(event, ui) {
                        appView.isSortableDrop = false;
                        $(this).find('li > div').each(function(i) {
                            var id = $(this).data('id');
                            var item = imageCollection.get(id);
                            if (item.get('sortorder') != i+1) {
                                item.set({sortorder: i+1}, {silent: true});
                                item.save();
                            }
                        });
                    },
                    forcePlaceholderSize: true,
                    forceHelperSize: true
                });
                this.sortInitialized = true;
            }
        },

        startLoading: function() {
            $('#mgresource-imagearea').css('opacity', .2);
            $('.mgresource-loading').show();
        },
        doneLoading: function() {
            $('.mgresource-loading').hide();
            $('#mgresource-imagearea').css('opacity', 1);
        },

        /**
         * Initalizes the multi drag/drop html5 uploads
         */
        initializeUpload: function () {
            var appView = this;

            // Prevent the default browser action for dropping an image
            $(document).bind('drop dragover', function (e) {
                e.preventDefault();
            });

            // Show a note about dropping images as long as we're not doing a DnD sort
            $(document).bind('dragenter', function () {
                if (!appView.isSortableDrop) {
                    appView.$el.addClass('mgresource-drag-entered');
                }
            });
            // Hide the note again after we dropped the image or stopped dragging.
            $(document).bind('drop dragend', function () {
                appView.$el.removeClass('mgresource-drag-entered');
            });

            var uploadId = 0;

            $('#mgresource-upload-input').fileupload({
                url: moreGallery.config.connector_url + '?action=mgr/images/upload',
                dataType: 'json',
                dropZone: $('#mgresource-backbone-wrapper'),
                pasteZone: false,
                progressInterval: 250,

                /**
                 * Add an item to the upload queue.
                 *
                 * The item gets an image preview using the FileReader APIs if available
                 *
                 * @param e
                 * @param data
                 */
                add: function(e, data) {
                    if (data.files[0].size > (moreGallery.config.memory_limit / 12)) {
                        if (!confirm(moreGallery.lang('preupload_very_big', {file: data.files[0].name}))) {
                            return;
                        }
                    }

                    uploadId++;
                    var image = new Image({
                        id: 'tmp'+uploadId,
                        filename: data.files[0].name,
                        mgr_thumb: moreGallery.config.assets_url + 'mgr/img/uploading.png',
                        file_url: moreGallery.config.assets_url + 'mgr/img/uploading.png',
                        name: data.files[0].name,
                        sortorder: appView.collection.length
                    });
                    appView.collection.add(image);
                    data.context = image.cid;

                    var imageView = appView.$('div[data-id='+data.context+']');
                    if (imageView) {
                        imageView.addClass('mgimage-uploading');
                    }

                    if (data.files[0].size < 700000 && window.FileReader) {
                        // Only if the image is smaller than ~ 700kb we want to show a preview.
                        // This is to prevent filling up the users' RAM, while providing the user
                        // with a fancy preview of what they're uploading.
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            imageView.find('.image img').attr('src', e.target.result)
                        };
                        reader.readAsDataURL(data.files[0]);
                    }

                    // Delay upload to give backbone a chance to render stuff.
                    setTimeout(function() {
                        data.submit();
                    }, 1000);
                },

                /**
                 * When the image has been uploaded add it to the collection.
                 *
                 */
                done: function(e, data) {
                    var image = appView.collection.get(data.context);
                    if (image) {
                        if (data.result.success) {
                            var record = data.result.object;
                            $.each(record, function(key, value) {
                                image.set(key, value);
                            });

                            image.trigger('uploadComplete');
                        }
                        else {
                            var message = moreGallery.lang('upload_error', {file: image.attributes.filename, message: data.result.message});
                            if (data.files[0].size > 1048576*1.5) {
                                message += "\n\n" + moreGallery.lang('upload_error_huge', {size: (data.files[0].size / 1048576).toFixed(2)});
                            }
                            alert(message);
                            image.trigger('destroy');
                        }
                    }
                    else {
                        alert(moreGallery.lang('model_error'));
                        if (console) console.error('Could not find model: ', data.context, appView.collection.get(data.context));
                    }
                },

                fail: function(e, data) {
                    var image = appView.collection.get(data.context);
                    if (image) {
                        image.trigger('destroy');
                    }
                    var message = moreGallery.lang('upload_error', {file: image.attributes.filename, message: data.errorThrown});
                    if (data.files[0].size > 1048576*1.5) {
                        message += "\n\n" + moreGallery.lang('upload_error_huge', {size: (data.files[0].size / 1048576).toFixed(2)});
                    }
                    alert(message);
                },

                /**
                 * Fetch the items we want to send along in the POST. In this case,
                 * this is overridden because normally it sends the entire form = the resource.
                 * All we really want is the resource ID, which we fetch from the URL.
                 * @returns {Array}
                 */
                formData: function() {
                    return [{
                        name: 'resource',
                        value: MODx.request.id
                    }];
                },

                /**
                 * Update progress for queue items
                 */
                progress: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10),
                        imageView = appView.$('div[data-id='+data.context+']');
                    if (imageView) {
                        imageView.find('.uploadprogress .bar').width(progress+'%');
                    }
                }
            });
        }
    });
});

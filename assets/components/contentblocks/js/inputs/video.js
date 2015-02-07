(function ($, ContentBlocks) {
    ContentBlocks.fieldTypes.video = function(dom, data) {
        window.googleApiClientReady = function() {
            gapi.client.setApiKey('AIzaSyB0dw388ateBJGR-wIGxPTWtJUmDx55gKw');
            gapi.client.load('youtube', 'v3', input.apiClientReady);
        };
        var input = {
            apiInserted: false,
            apiLoaded: false
        };

        input.init = function() {
            if (data.value) {
                this.selectVideo(data.value);
            }
            // Backwards compat for < 0.2.1, will be removed in 1.0.
            if (data.video_id) {
                this.selectVideo(data.video_id)
            }

            if (!this.apiInserted) {
                $('body').append('<script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>');
                this.apiInserted = true;
            }

            dom.find('.contentblocks-field-delete-video').on('click', function(e) {
                e.preventDefault();

                dom.find('.video_id').val('');
                dom.find('.contentblocks-field-video-preview').empty();
                dom.removeClass('hasVideo');
                ContentBlocks.fireChange();
            });

            dom.find('.contentblocks-field-video-link').on('change', function () {
                var url = $(this).val();
                // http://stackoverflow.com/a/9102270/1277345
                var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
                var match = url.match(regExp);
                if (match&&match[2].length==11){
                    $(this).val('');
                    input.selectVideo(match[2]);
                    ContentBlocks.fireChange();
                }
            }).on('keyup', function() {
                var fld = $(this);
                setTimeout(function() {
                    fld.trigger('change');
                }, 100);
            });

            dom.find('.contentblocks-field-video-choose').on('click', function(e) {
                e.preventDefault();

                if (!input.apiLoaded) {
                    ContentBlocks.alert(_('contentblocks.video.youtube_not_loaded'));
                    return;
                }

                var html = tmpl('contentblocks-modal-video', {});
                ContentBlocks.openModal('Choose Video', html, {
                    initCallback: function(modal, options) {
                        modal.addClass('contentblocks-modal-video');

                        var maxHeight = modal.find('.contentblocks-modal-content').css('maxHeight').slice(0, -2);
                        maxHeight = maxHeight - 85;
                        modal.find('.contentblocks-modal-scrollable-area').css('maxHeight', maxHeight + 'px');

                        var form = modal.find('form'),
                            field = form.find('.query'),
                            results = modal.find('.youtube-search-results'),
                            moreBtn = modal.find('.contentblocks-search-results-more');

                        moreBtn.hide();

                        form.on('submit', function(e) {
                            e.preventDefault();

                            var q = field.val();

                            var request = gapi.client.youtube.search.list({
                                q: q,
                                part: 'id,snippet',
                                maxResults: 12,
                                type: 'video',
                                videoEmbeddable: true
                            });

                            request.execute(function(response) {
                                // check for errors and display them
                                if (response.error) {
                                    results.html('<p class="error">' + _('contentblocks.video.api_error', {message: response.error.message, code: response.error.code}) + '</p>');
                                    moreBtn.hide();
                                }
                                // No errors, so display the video results
                                else {
                                    var html = [];
                                    $.each(response.items, function(idx, video) {
                                        video.snippet.publishedAt = new Date(video.snippet.publishedAt).format(MODx.config.manager_date_format);
                                        html.push(tmpl('contentblocks-field-video-item', video));
                                    });
                                    results.html(html.join(''));

                                    if (response.result.nextPageToken) {
                                        moreBtn.data('token',response.result.nextPageToken).show();
                                    }
                                    results.find('li').on('click', function() {
                                        var vidId = $(this).data('video_id');
                                        if (vidId != '') {
                                            ContentBlocks.closeModal();
                                            input.selectVideo(vidId);
                                            ContentBlocks.fireChange();
                                        }
                                    });
                                }
                            })
                        });

                        // Load more results
                        moreBtn.on('click', function() {
                            var q = field.val(),
                                nextPageToken = moreBtn.data('token');

                            var request = gapi.client.youtube.search.list({
                                q: q,
                                part: 'id,snippet',
                                maxResults: 12,
                                type: 'video',
                                videoEmbeddable: true,
                                pageToken: nextPageToken
                            });

                            // Request the data
                            request.execute(function(response) {
                                // check for errors and display them
                                if (response.error) {
                                    results.append('<p class="error">' + _('contentblocks.video.api_error', {message: response.error.message, code: response.error.code}) + '</p>');
                                }
                                // No errors, so display the video results
                                else {
                                    var html = [];
                                    $.each(response.items, function(idx, video) {
                                        video.snippet.publishedAt = new Date(video.snippet.publishedAt).format(MODx.config.manager_date_format);
                                        html.push(tmpl('contentblocks-field-video-item', video));
                                    });
                                    html = html.join('');
                                    results.append(html);

                                    if (response.result.nextPageToken) {
                                        moreBtn.data('token',response.result.nextPageToken).show();
                                    }
                                    results.find('li').on('click', function() {
                                        var vidId = $(this).data('video_id');
                                        if (vidId != '') {
                                            ContentBlocks.closeModal();
                                            input.selectVideo(vidId);
                                            ContentBlocks.fireChange();
                                        }
                                    });
                                }
                            })
                        });
                    }
                });
            });
        };

        input.selectVideo = function(vidId) {
            dom.addClass('hasVideo');
            dom.find('.video_id').val(vidId);

            var preview = dom.find('.contentblocks-field-video-preview');
            preview.html('<iframe class="youtube-player" src="https://www.youtube.com/embed/'+vidId+'" frameborder="0">');
        };

        input.apiClientReady = function() {
            input.apiLoaded = true;
        };

        input.getData = function () {
            return {
                value: dom.find('.video_id').val()
            };
        };
        return input;
    };
})(vcJquery, ContentBlocks);

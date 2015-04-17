<script type="text/javascript">
    if (!RedactorPlugins) var RedactorPlugins = {};
</script>
<script type="text/javascript" src="[[+assetsUrl]]redactor-1.6.0.min.js"></script>
[[+plugin_files]]
[[+langFile:notempty=`<script type="text/javascript" src="[[+langFile]]"></script>`]]
<script type="text/javascript">
    var $red = (typeof($red) != 'undefined') ? $red : $.noConflict();
    $red(document).ready(function($) {
        var redactorOptions = [[+optionsJson]];
        redactorOptions._keyTriggered = false;
        redactorOptions.changeCallback = MODx.fireResourceFormChange ? function(html) {
            if(!redactorOptions._keyTriggered) MODx.fireResourceFormChange();
            redactorOptions._keyTriggered = true;
        } : null;

        redactorOptions.toolbarFixedTarget = '#modx-content > .x-panel-bwrap > .x-panel-body';
        redactorOptions.imageUploadErrorCallback = function(json) {
            alert(json.error);
        };
        redactorOptions.modalCallback = function() {
            $('.typeahead').each(function(){
                $(this).typeahead({
                name: 'resources-oss',
                prefetch: {
                    url: '[[+assetsUrl]]connector.php?action=resources/prefetch',
                    ttl: [[+prefetch_ttl]]
                },
                remote: {
                    url: '[[+assetsUrl]]connector.php?action=resources/search&query=%TERM%',
                    wildcard: '%TERM%'
                },
                template: [
                    '<p class="resource-id">#{{id}}</p>',
                    '<p class="resource-name">{{& pagetitle}}</p>',
                    '<p class="resource-introtext">{{& introtext}}</p>'
                ].join(''),
                valueKey: 'id',
                limit: 15,
                engine: Hogan
            });
            });

            var redactorInsertLinkBtn = $('#redactor_insert_link_btn');
            $('.redactor_link_text').on('keyup', function(e) {
                ($(this).val()) ? redactorInsertLinkBtn.removeAttr('disabled') : redactorInsertLinkBtn.attr('disabled','disabled');
            }).trigger('keyup');
        };

        if (!MODx.loadRTE) {
            MODx.loadRTE = function(elements) {
                if ($.isArray(elements)) {
                    var tmpElements = [];
                    $.each(elements, function(idx, value) {
                        tmpElements.push('#'+value);
                    });
                    elements = tmpElements;
                    elements = elements.join(',');
                } else {
                    elements = '#'+elements;
                }

                if (elements.indexOf('#ta') > -1) {
                    elements += ', .modx-richtext';
                }

                $(elements).redactor(redactorOptions);
            };
        }

        /** Setup jQuery's ajax to pass the necessary headers */
        MODx.on('ready', function(){
            $.ajaxSetup({
                headers: {
                    'modAuth': MODx.siteId,
                    'Powered-By': 'Redactor in MODX Revolution'
                }
            });

            var panel = Ext.getCmp('modx-panel-resource');
            if(panel) {
                panel.on('success', function() {
                    redactorOptions._keyTriggered = false;
                });
            }
        });
    });
</script>

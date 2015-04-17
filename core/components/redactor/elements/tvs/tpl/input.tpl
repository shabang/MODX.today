<script type="text/javascript" src="{$assetsUrl}redactor-1.6.0.min.js"></script>
{$langFile}
<textarea id="tv{$tv->id}" class="red-richtext" name="tv{$tv->id}" tvtype="{$tv->type}">{$tv->get('value')|escape}</textarea>

<script type="text/javascript">
    var $redTv = $redTv || ((typeof($red) != 'undefined') ? $red : $.noConflict());
    $redTv(document).ready(function($) {
        MODx.on('ready', function(){
            var tv{$tv->id}Options = {$params_json};
            tv{$tv->id}Options._keyTriggered = false;
            tv{$tv->id}Options.changeCallback = function(obj,event) {
                if(!tv{$tv->id}Options._keyTriggered) MODx.fireResourceFormChange();
                tv{$tv->id}Options._keyTriggered = true;
            };
            tv{$tv->id}Options.modalCallback = function(){
                $('.typeahead').each(function(){
                    $(this).typeahead({
                        name: 'resources-oss',
                        prefetch: {
                            url: '{$assetsUrl}connector.php?action=resources/prefetch',
                            ttl: {$params.prefetch_ttl}
                        },
                        remote: {
                            url: '{$assetsUrl}connector.php?action=resources/search&query=%TERM%',
                            wildcard: '%TERM%'
                        },
                        template: [{literal}
                            '<p class="resource-id">#{{id}}</p>',
                            '<p class="resource-name">{{& pagetitle}}</p>',
                            '<p class="resource-introtext">{{& introtext}}</p>'
                        {/literal}].join(''),
                        valueKey: 'id',
                        limit: 15,
                        engine: Hogan
                    });
                });
            };

            $('#tv{$tv->id}').redactor(tv{$tv->id}Options);

            Ext.getCmp('modx-panel-resource').on('success', function() {
                tv{$tv->id}Options._keyTriggered = false;
            });


            /** Setup jQuery's ajax to pass the necessary headers */
            $.ajaxSetup({
                headers: {
                    'modAuth': MODx.siteId,
                    'Powered-By': 'Redactor in MODX Revolution'
                }
            });

            Ext.getCmp('modx-panel-resource').on('success', function() {
                tv{$tv->id}Options._keyTriggered = false;
            });
        });
    });
</script>

if (!RedactorPlugins) var RedactorPlugins = {};

(function($)
{
	RedactorPlugins.modmore = function()
	{
		return {
			init: function()
			{
				this.modal.addCallback('link', $.proxy(this.modmore.load, this));
			},
			load: function()
			{
                var that = this;
                $('#redactor-modal-body > section').wrapInner('<div id="redactor_tab1" class="redactor_tab">');
                
                var $tabNav = $('<div id="redactor_tabs">');
                $tabNav.html(
                      '<a href="#" class="redactor_tabs_act">URL</a>'
                    + '<a href="#">' + (this.opts.curLang.resource || 'Resource') + '</a>' // #janky
                ).after('<input type="hidden" id="redactor_tab_selected" value="1">');

                var $tab1 = $('#redactor_tab1');
                var $tab2 = $('<div id="redactor_tab2" class="redactor_tab" style="display:none">');
                var $tab3 = $('<div id="redactor_tab3" class="redactor_tab" style="display:none">');
                var $tab4 = $('<div id="redactor_tab4" class="redactor_tab" style="display:none">');

                $tab2.html(
                      '<label>' + (this.opts.curLang.resource || 'Resource') +'</label>'
                    + '<input type="text" class="redactor_input typeahead" id="redactor_link_resource" placeholder="' + this.opts.curLang.resource_placeholder +'"  />'
                );

                $tab3.html(
                      '<label>Email</label>'
                    + '<input type="email" id="redactor_link_mailto" class="redactor_input" />'
                );
                
                $tab4.html(
                      '<label>' + this.opts.curLang.anchor + '</label>'
                    + '<input type="text" class="redactor_input" id="redactor_link_anchor"  />'
                );
                
                $('#redactor-modal-body > section').prepend($tabNav);
                
                var $tabs = $tab1.wrap('<div class="tabs">').parent();
                
                $tabs.append($tab2);
                if(this.opts.linkEmail)  {
                    $tabNav.append('<a href="#">Email</a>');
                    $tabs.append($tab3);
                }
                if(this.opts.linkAnchor) {
                    $tabNav.append('<a href="#">' + this.opts.curLang.anchor + '</a>');
                    $tabs.append($tab4);
                }
                
                $('#redactor_link_resource').bind('input',function(e){
                    that.link.url = '[[~' + $(this).val() + ']]';
                }).bind('typeahead:selected', function(obj, datum, name) {
                    that.link.$inputUrl.val('[[~' + datum.id + ']]');
                    if(!that.link.$inputText.val()) that.link.$inputText.val(datum.pagetitle);
                    that.link.$inputUrl.removeClass('redactor-input-error').trigger('keyup');
                });
                
                $tabs.children('.redactor_tab').each(function(i,s){
                    $(this).attr('id','redactor_tab' + (i+1).toString());
                })
                
                $('#redactor-link-blank').parent().attr('id','redactor-link-open-in-new-tab');
                $tabs.append(
                    $('<div id="redactor-link-bottom-opts" class="redactor_tab">').append([
                        $('#redactor-link-url-text').prev('label').detach(),
                        $('#redactor-link-url-text').detach(),
                        $('#redactor-link-open-in-new-tab').detach()
                    ])
                );
                
                $('.typeahead').each(function(){
                     $(this).typeahead({
                         name: 'resources-oss',
                         prefetch: {
                             url: that.opts.assetsUrl + 'connector.php?action=resources/prefetch',
                             ttl: (that.opts.prefetch_ttl) ? that.opts.prefetch_ttl : 86400000
                         },
                         remote: {
                             url: that.opts.assetsUrl + 'connector.php?action=resources/search&query=%TERM%',
                             wildcard: '%TERM%'
                         },
                         template: [
                             '<p class="resource-id" title="{{context_key}} context">#{{id}}</p>',
                             '<p class="resource-name">{{& pagetitle}}</p>',
                             '<p class="resource-introtext">{{& introtext}}</p>'
                         ].join(''),
                         valueKey: 'id',
                         limit: 15,
                         engine: Hogan
                     });
                });
                
                
                
                assignTabListeners(this,$tabNav);
			}
		};
	};
})(jQuery);
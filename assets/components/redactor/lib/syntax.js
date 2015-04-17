if (!RedactorPlugins) var RedactorPlugins = {};
if(typeof ace === 'undefined') document.write('<script src="' + this.opts.assetsUrl + 'lib/ace/ace.js' + '"><\/script>');
 
(function($)
{
	RedactorPlugins.syntax = function()
	{
        return {
            init: function() {
                var that = this;
                this.$textarea.after('<div class="redactor__modx-code-pretty-content" rows="4" style="display:none"></div>');
                var _p = this.$textarea.parent().children('div.redactor__modx-code-pretty-content').attr('id','redactor__modx-code-pretty-content' + this.uuid);
                var editor = ace.edit('redactor__modx-code-pretty-content' + this.uuid);
                editor.setTheme(this.opts.aceTheme || "ace/theme/monokai");
                editor.getSession().setMode(this.opts.aceMode || "ace/mode/html");
                editor.setValue(this.$textarea.val());
            
                var textarea = this.$textarea;
            
                editor.getSession().on('change',function(){
                    textarea.val(editor.getSession().getValue());
                });
            
                this.$element.on("source",function(data){ // #janky REQUIRES redactor.js#L2717 hack.
                    if(!that.opts.visual) {
                        that.$textarea.hide();
                        editor.setValue(that.$textarea.val());
                        _p.show();  
                    } else {
                        _p.hide();
                    }
                });
            
                /*
                this.opts.sourceCallback = function(html) { // #janky?
                }
                */
            }
        };
	};
})(jQuery);


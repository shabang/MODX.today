!function(a,b){b.fieldTypes.heading=function(c,d){var e={};return e.init=function(){var e=d.properties.available_levels||"h1=heading_1,h2=heading_2,h3=heading_3,h4=heading_4,h5=heading_5,h6=heading_6",f=c.find(".contentblocks-field-heading-level select");if(e=e.split(","),a.each(e,function(a,b){b=b.split("=");var c=_("contentblocks."+b[1])||b[1];f.append('<option value="'+b[0]+'">'+c+"</option>")}),d.level)f.val(d.level);else{var g=d.properties.default_level||"h2";f.val(g)}if(b.toBoolean(d.properties.use_tinyrte)){var h=c.find("#"+d.generated_id+"_input");b.addTinyRte(h)}},e.getData=function(){return{value:c.find(".contentblocks-field-heading-input input").val(),level:c.find(".contentblocks-field-heading-level select").val()}},e.confirmBeforeDelete=function(){var a=e.getData(),b=a.level!=d.properties.default_level,c=a.value.replace(/^\s\s*/,"").replace(/\s\s*$/,"").length>0;return b||c},e},b.fieldTypes.textarea=function(a,c){return{init:function(){if(c.properties&&b.toBoolean(c.properties.use_tinyrte)){var d=a.find("#"+c.generated_id+"_textarea");b.addTinyRte(d)}else setTimeout(function(){a.find(".contentblocks-field-textarea textarea").autoGrow().on("change",b.fixColumnHeights)},100)},getData:function(){return{value:a.find(".contentblocks-field-textarea textarea").val()}}}},b.fieldTypes.richtext=function(a,c){return{init:function(){var c=a.find(".contentblocks-field-textarea textarea");MODx.loadRTE?(MODx.loadRTE(c.attr("id")),setTimeout(function(){b.fixColumnHeights()},100)):setTimeout(function(){c.autoGrow()},100),c.on("change",b.fixColumnHeights)},getData:function(){return{value:a.find(".contentblocks-field-textarea textarea").val()}}}},b.fieldTypes.textfield=function(a,c){return{init:function(){if(b.toBoolean(c.properties.use_tinyrte)){var d=a.find("#"+c.generated_id+"_textfield");b.addTinyRte(d)}},getData:function(){return{value:a.find(".contentblocks-field-text input").val()}}}},b.fieldTypes.quote=function(a,c){return{init:function(){if(b.toBoolean(c.properties.use_tinyrte)){var d=a.find("#"+c.generated_id+"_quote");b.addTinyRte(d)}else setTimeout(function(){a.find(".contentblocks-field-textarea textarea").autoGrow().on("change",b.fixColumnHeights)},100);c.cite&&a.find(".contentblocks-field-text input").val(c.cite)},getData:function(){return{value:a.find(".contentblocks-field-textarea textarea").val(),cite:a.find(".contentblocks-field-text input").val()}}}}}(vcJquery,ContentBlocks),function(a,b){b.fieldTypes.link=function(a,c){var d={};return d.init=function(){b.initializeLinkField(a.find("input[id].linkfield"),c)},d.getData=function(){var c=a.find("input[id].linkfield");return{link:c.val(),linkType:b.getLinkFieldDataType(c.val())}},d}}(vcJquery,ContentBlocks),function(a,b){b.fieldTypes.table=function(a,c){var d={table:!1,handsontable:!1};return d.init=function(){this.table=a.find(".contentblocks-field-table-instance");var e={startRows:3,minSpareRows:1,minSpareCols:1,startCols:4,stretchH:"all",manualColumnMove:!0,enterBeginsEditing:!1,contextMenu:!0,autoWrapCol:!0,nativeScrollbars:!1,afterChange:function(){b.fireChange()},afterCreateRow:b.fixColumnHeights,afterRemoveRow:b.fixColumnHeights};c.value&&(e.data=c.value),this.table.handsontable(e),this.handsontable=this.table.handsontable("getInstance"),a.on("contentblocks:field_dragged",function(){d.handsontable.render()})},d.getData=function(){var a=this.handsontable.getData();return{value:a}},d}}(vcJquery,ContentBlocks),function(a,b){b.fieldTypes.hr=function(a,b){var c={};return c.getData=function(){return{value:1}},c}}(vcJquery,ContentBlocks),function(a,b){b.fieldTypes.image=function(c,d){var e={fileBrowser:!1,source:d.properties.source>0?d.properties.source:ContentBlocksConfig["image.source"],directory:d.properties.directory};return e.init=function(){if(d.url&&d.url.length){var e=b.utilities.normaliseUrls(d.url);c.find(".url").val(e.cleanedSrc),c.find(".size").val(d.size),c.find(".width").val(d.width),c.find(".height").val(d.height),c.find(".extension").val(d.extension),c.find("img").attr("src",d.properties.thumbnail_size?b.utilities.getThumbnailUrl(d.url,d.properties.thumbnail_size):e.displaySrc),c.addClass("preview")}c.find(".contentblocks-field-delete-image").on("click",function(){c.removeClass("preview"),c.find(".url").val(""),c.find(".size").val(""),c.find(".width").val(""),c.find(".height").val(""),c.find(".extension").val(""),c.find("img").attr("src",""),b.fixColumnHeights(),b.fireChange()}),c.find(".contentblocks-field-upload").on("click",function(){c.find(".contentblocks-field-upload-field").click()}),c.find(".contentblocks-field-image-choose").on("click",a.proxy(function(){this.chooseImage()},this)),c.find(".contentblocks-field-image-url").on("click",a.proxy(function(){this.promptImage()},this)),this.initUpload(),this.initDropReceiver()},e.initDropReceiver=function(){MODx.load({xtype:"modx-treedrop",target:c,targetEl:c.get(0),onInsert:function(a){e.insertFromUrl(a)}})},e.initUpload=function(){var a=c.attr("id");c.find("#"+a+"-upload").fileupload({url:ContentBlocksConfig.connectorUrl+"?action=content/image/upload",dataType:"json",dropZone:c,progressInterval:250,paramName:"file",pasteZone:null,add:function(a,d){if(b.fireChange(),c.addClass("uploading"),d.files[0].ext=d.files[0].name.split(".").pop(),d.files[0].size<7e5&&window.FileReader){var e=new FileReader;e.onload=function(a){c.find("img").attr("src",a.target.result),b.fixColumnHeights()},e.readAsDataURL(d.files[0])}setTimeout(function(){d.submit()},1e3)},done:function(a,f){if(f.result.success){var g=f.result.object,h=b.utilities.normaliseUrls(g.url);c.find(".url").val(h.cleanedSrc),c.find(".size").val(g.size),c.find(".width").val(g.width),c.find(".height").val(g.height),c.find(".extension").val(g.extension),c.find("img").attr("src",d.properties.thumbnail_size?b.utilities.getThumbnailUrl(g.url,d.properties.thumbnail_size):h.displaySrc),c.addClass("preview"),e.loadTinyRTE()}else{var i=_("contentblocks.upload_error",{file:f.files[0].filename,message:f.result.message});f.files[0].size>1572864&&(i+=_("contentblocks.upload_error.file_too_big")),b.alert(i),c.find("img").attr("src","")}c.removeClass("uploading"),setTimeout(function(){b.fixColumnHeights(c.parents(".contentblocks-region-content"))},150)},fail:function(a,d){var e=_("contentblocks.upload_error",{file:d.files[0].filename,message:d.result.message});d.files[0].size>1572864&&(e+=_("contentblocks.upload_error.file_too_big")),b.alert(e),c.removeClass("uploading"),c.find("img").attr("src",""),b.fixColumnHeights(c.parents(".contentblocks-region-content"))},formData:function(){return[{name:"HTTP_MODAUTH",value:MODx.siteId},{name:"resource",value:MODx.request.id||0},{name:"field",value:d.id}]},progress:function(a,b){var d=parseInt(b.loaded/b.total*100,10)+"%";c.find(".upload-progress .bar").width(d)}})},e.chooseImage=function(){var a=MODx.load({xtype:"modx-browser",id:Ext.id(),multiple:!0,listeners:{select:function(a){e.chooseImageCallback(a)}},allowedFileTypes:d.properties.file_types,hideFiles:!0,title:_("contentblocks.choose_image"),source:e.source});a.setSource(e.source),a.show()},e.chooseImageCallback=function(a){var e=a.fullRelativeUrl;"http"!=e.substr(0,4)&&"/"!=e.substr(0,1)&&(e=MODx.config.base_url+e);var f=b.utilities.normaliseUrls(e);c.find(".url").val(f.cleanedSrc),c.find(".size").val(a.size),c.find(".width").val(a.image_width),c.find(".height").val(a.image_height),c.find(".extension").val(a.ext),c.find("img").attr("src",d.properties.thumbnail_size?b.utilities.getThumbnailUrl(e,d.properties.thumbnail_size):f.displaySrc),c.addClass("preview"),b.fireChange(),this.loadTinyRTE()},e.promptImage=function(){Ext.Msg.prompt(_("contentblocks.from_url_title"),_("contentblocks.from_url_prompt"),function(a,b,c){"ok"===a&&e.insertFromUrl(b)},this)},e.insertFromUrl=function(e){return!e||e.length<3?void b.alert("No URL provided."):(c.addClass("contentblocks-field-loading"),void a.ajax({dataType:"json",url:ContentBlocksConfig.connector_url,type:"POST",beforeSend:function(a,b){b.crossDomain||a.setRequestHeader("modAuth",MODx.siteId)},data:{action:"content/image/download",field:d.field,resource:ContentBlocksResource&&ContentBlocksResource.id?ContentBlocksResource.id:0,url:e},context:this,success:function(a){if(c.removeClass("contentblocks-field-loading"),a.success){var e=b.utilities.normaliseUrls(a.object.url);c.find(".url").val(e.cleanedSrc),c.find(".size").val(a.object.size),c.find(".width").val(a.object.width),c.find(".height").val(a.object.height),c.find(".extension").val(a.object.extension),c.find("img").attr("src",d.properties.thumbnail_size?b.utilities.getThumbnailUrl(e.cleanedSrc,d.properties.thumbnail_size):e.displaySrc),c.addClass("preview"),b.fireChange(),this.loadTinyRTE()}else b.alert(a.message)}}))},e.getData=function(){return{url:c.find(".url").val(),size:c.find(".size").val(),width:c.find(".width").val(),height:c.find(".height").val(),extension:c.find(".extension").val()}},e.loadTinyRTE=function(){},e},b.fieldTypes.image_with_title=function(c,d){var e=b.fieldTypes.image(c,d);return e.init=function(){if(d.url&&d.url.length){var e=b.utilities.normaliseUrls(d.url);c.find(".url").val(e.cleanedSrc),c.find(".size").val(d.size),c.find(".width").val(d.width),c.find(".height").val(d.height),c.find(".extension").val(d.extension),c.find("img").attr("src",d.properties.thumbnail_size?b.utilities.getThumbnailUrl(d.url,d.properties.thumbnail_size):e.displaySrc),c.find(".title").val(d.title||""),c.addClass("preview"),this.loadTinyRTE()}c.find(".contentblocks-field-delete-image").on("click",function(){c.removeClass("preview"),c.find(".url").val(""),c.find(".size").val(""),c.find(".width").val(""),c.find(".height").val(""),c.find(".extension").val(""),c.find(".title").val("").removeClass("tinyrte-replaced"),c.find("img").attr("src",""),c.find(".tinyrte-container").remove(),b.fixColumnHeights(),b.fireChange()}),c.find(".contentblocks-field-upload").on("click",function(){c.find(".contentblocks-field-upload-field").click()}),c.find(".contentblocks-field-image-choose").on("click",a.proxy(function(){this.chooseImage()},this)),c.find(".contentblocks-field-image-url").on("click",a.proxy(function(){this.promptImage()},this)),this.initUpload(),this.initDropReceiver()},e.loadTinyRTE=function(){if(b.toBoolean(d.properties.use_tinyrte)){var a=c.find(".title");b.addTinyRte(a)}},e.getData=function(){return{url:c.find(".url").val(),title:c.find(".title").val(),size:c.find(".size").val(),width:c.find(".width").val(),height:c.find(".height").val(),extension:c.find(".extension").val()}},e}}(vcJquery,ContentBlocks),function(a,b){b.fieldTypes.file=function(c,d){var e={fileCount:0,fileBrowser:!1,source:d.properties.source>0?d.properties.source:ContentBlocksConfig["image.source"],directory:d.properties.directory};return e.init=function(){this.initUpload(),c.find(".contentblocks-field-upload").on("click",function(){c.find(".contentblocks-field-upload-field").click()}),c.find(".contentblocks-field-file-choose").on("click",a.proxy(function(){this.chooseFile()},this)),a.isArray(d.files)&&a.each(d.files,function(a,b){e.fileCount++,b.id=d.generated_id+"-file"+e.fileCount,e.addFile(b)}),c.find(".file-holder").sortable({connectWith:".file-holder",forceHelperSize:!0,forcePlaceholderSize:!0,placeholder:"contentblocks-file-placeholder",tolerance:"pointer",cursor:"move",update:function(){b.fixColumnHeights(),MODx.fireResourceFormChange()},start:function(a,b){b.placeholder.height(b.item.height())}})},e.chooseFile=function(){var a=d.properties.max_files,b=c.find(".file-holder").find("li").length;if(a>0&&b>=a)return alert(_("contentblocks.file.max_files.reached",{max:a})),!1;var f=MODx.load({xtype:"modx-browser",id:Ext.id(),multiple:!0,listeners:{select:function(a){e.chooseFileCallback(a)}},allowedFileTypes:d.properties.file_types,hideFiles:!0,title:_("contentblocks.file.choose_file"),source:e.source});f.setSource(e.source),f.show()},e.chooseFileCallback=function(a){var b=a.fullRelativeUrl;"http"!=b.substr(0,4)&&"/"!=b.substr(0,1)&&(b=MODx.config.base_url+b),e.fileCount++;var d=c.attr("id")+"-file"+e.fileCount,f=a.size,g=Math.round(Date.parse(a.lastmod)/1e3),h=a.ext;this.addFile({url:b,title:a.filename,id:d,size:f,upload_date:g,extension:h})},e.addFile=function(d){var f=d.url||d.title,g=c.find(".file-holder");d.filename=f.split("/").pop(),d.icon=e.getIconClass(d.extension),g.append(tmpl("contentblocks-field-fileinput_file",d));var h=a("#"+d.id);h.find(".contentblocks-fileinput_file-delete").on("click",function(){h.fadeOut(function(){h.remove(),b.fixColumnHeights(),MODx.fireResourceFormChange()})})},e.getIconClass=function(a){switch(a){case"doc":case"docx":case"pages":case"odt":case"rtf":case"tex":case"wpd":case"wps":return"word";case"txt":case"msg":case"log":case"dat":case"sdf":return"text";case"pps":case"ppt":case"pptx":case"key":return"powerpoint";case"csv":case"xlr":case"xls":case"xlsx":return"excel";case"pdf":case"indd":return"pdf";case"aif":case"iff":case"m3u":case"m4a":case"mid":case"mp3":case"mpa":case"ra":case"wav":case"wma":return"audio";case"3g2":case"3gp":case"asf":case"asx":case"avi":case"flv":case"m4v":case"mov":case"mp4":case"mpg":case"rm":case"swf":case"vob":case"wmv":return"video";case"bmp":case"dds":case"gif":case"jpg":case"jpeg":case"png":case"psd":case"pspimage":case"tga":case"thm":case"tif":case"tiff":case"yuv":case"ai":case"eps":case"ps":case"svg":return"image";case"7z":case"cbr":case"deb":case"gz":case"pkg":case"rar":case"rpm":case"sitx":case"tar":case"zip":case"zipx":return"zip";default:return a}},e.initUpload=function(){var f=c.attr("id"),g=d.properties.max_files;c.find("#"+f+"-upload").fileupload({url:ContentBlocksConfig.connectorUrl+"?action=content/file/upload",dataType:"json",dropZone:a("#"+f),progressInterval:250,paramName:"file",multiple:!0,pasteZone:null,add:function(b,d){var h=c.find(".file-holder").find("li").length;if(g>0&&h>=g)return alert(_("contentblocks.file.max_files.reached",{max:g})),!1;e.fileCount++;var i=f+"-file"+e.fileCount;d.files[0].ext=d.files[0].name.split(".").pop(),e.addFile({title:d.files[0].name,url:"",id:i,size:d.files[0].size,upload_date:d.files[0].upload_date,extension:d.files[0].ext}),d.domId="#"+i;var j=a(d.domId);j.addClass("uploading"),setTimeout(function(){d.submit()},1e3),MODx.fireResourceFormChange()},done:function(c,d){var e=a(d.domId);if(d.result.success){var f=d.result.object;e.find(".url").val(f.url),e.find(".size").val(f.size),e.find(".upload_date").val(f.upload_date),e.find(".extension").val(f.extension),e.removeClass("uploading")}else{var g=_("contentblocks.upload_error",{file:d.files[0].filename,message:d.result.message});d.files[0].size>MODx.config.upload_maxsize&&(g+=_("contentblocks.upload_error.file_too_big")),alert(g),e.remove()}setTimeout(function(){b.fixColumnHeights()},150)},fail:function(c,d){var e=_("contentblocks.upload_error",{file:d.files[0].filename,message:d.result.message});d.files[0].size>MODx.config.upload_maxsize&&(e+=_("contentblocks.upload_error.file_too_big")),alert(e),a(d.domId).remove(),b.fixColumnHeights()},formData:function(){return[{name:"HTTP_MODAUTH",value:MODx.siteId},{name:"resource",value:MODx.request.id||0},{name:"field",value:d.id}]},progress:function(b,c){var d=parseInt(c.loaded/c.total*100,10)+"%";a(c.domId).find(".upload-progress .bar").width(d)}}).on("fileuploaddragover",function(){a(this).css("background","red")})},e.getData=function(){var b=[];return c.find(".file-holder li").each(function(c,d){var e=a(d),f={url:e.find(".url").val(),title:e.find(".title").val(),size:e.find(".size").val(),upload_date:e.find(".upload_date").val(),extension:e.find(".extension").val()};b.push(f)}),{files:b}},e}}(vcJquery,ContentBlocks),function(a,b){b.fieldTypes.chunk=function(c,d){var e={preview:c.find(".chunkOutput"),propList:c.find(".contentblocks-properties-list"),dynamicPreview:!0,fieldWrapper:c.closest(".contentblocks-field-outer")};return e.init=function(){if(!d.properties||!d.properties.chunk||d.properties.chunk<1)return void e.preview.html("<p>"+_("contentblocks.chunk.no_chunk_set")+"</p>");if(d.properties.custom_preview&&d.properties.custom_preview.length>1)e.dynamicPreview=!1,e.preview.html(d.properties.custom_preview);else{c.addClass("contentblocks-field-loading");var a=window.Ext&&Ext.getCmp?Ext.getCmp("modx-panel-resource"):null;a&&a.on("success",function(a){e.loadPreview(!1,e.getPreviewData())})}e.fieldWrapper.on("input change","input, textarea, select",b.utilities.debounce(function(){b.fireChange(),e.dynamicPreview&&e.loadPreview(!1,e.getPreviewData())},300)),e.loadPreview(!0,e.getPreviewData(!0))},e.getPreviewData=function(b){b=b||!1;var c=a.extend({settings:Ext.decode(e.fieldWrapper.data("settings"))||{}},e.getData());return b&&(c.chunk_properties=d.chunk_properties),c},e.loadPreview=function(f,g){a.ajax({dataType:"json",url:ContentBlocksConfig.connector_url,type:"POST",beforeSend:function(a,b){b.crossDomain||a.setRequestHeader("modAuth",MODx.siteId)},data:{action:"content/chunk/get",id:d.properties.chunk,field:d.field,resource:ContentBlocksResource&&ContentBlocksResource.id?ContentBlocksResource.id:0,data:g},context:this,success:function(a){if(a.success){if(e.dynamicPreview){var d=a.object.preview;d=d.replace(/(<\s*\/?\s*)script(\s*([^>]*)?\s*>)/gi,"$1jscript$2"),c.find(".chunkOutput").html(d)}f&&a.object.properties&&this.loadProperties(a.object.properties)}else e.preview.html(a.message),b.alert(a.message);c.removeClass("contentblocks-field-loading")}})},e.getData=function(){var b={};return e.propList.find("li").each(function(c,d){var e=a(d),f=e.find("input,select"),g=f.data("name");b[g]=f.val()}),{chunk_properties:b}},e.loadProperties=function(c){e.propList.empty().hide(),c&&(a.each(c,function(a,b){var c=d.chunk_properties&&d.chunk_properties[a]?d.chunk_properties[a]:b.value;switch(b.id="contentblocks-chunk-property-"+a+"-"+d.generated_id,b.key=a,b.value=c,b.type){default:e.propList.append(tmpl("contentblocks-field-chunk-property",b))}}),e.propList.show(),b.fixColumnHeights())},e}}(vcJquery,ContentBlocks),function(a,b){b.fieldTypes.dropdown=function(c,d){var e={fieldId:d.field,select:null,options:{}};return e.init=function(){c.addClass("contentblocks-field-loading"),this.select=c.find(".contentblocks-field-dropdown-select select"),a.ajax({dataType:"json",url:ContentBlocksConfig.connectorUrl,data:{action:"content/dropdown/getlist",field:e.fieldId,resource:MODx.request.id||0},context:this,beforeSend:function(a,b){b.crossDomain||a.setRequestHeader("modAuth",MODx.siteId)},success:function(a){a.results?(e.setOptions(a.results),this.optionsLoaded()):b.alert(_("contentblocks.dropdown.none_available")),c.removeClass("contentblocks-field-loading")}})},e.setOptions=function(a){e.options=a,e.optionsLoaded()},e.optionsLoaded=function(){e.select.empty(),a.each(e.options,function(b,c){var d=a("<option></option>");d.attr("value",c.value),d.text(c.display),c.disabled&&d.attr("disabled","disabled"),e.select.append(d)}),d.value||(d.value=d.properties.default_value),d.value&&e.select.val(d.value)},e.getData=function(){return{value:e.select.val()||"",display:e.select.find(":selected").text()}},e}}(vcJquery,ContentBlocks),function(a,b){b.fieldTypes.snippet=function(c,d){var e={fieldId:d.field,propertyId:0,snippet:"",snippets:{},properties:{},hiddenProperties:{},select:null,propertiesList:null,propertiesSelectWrapper:null,propertiesSelect:null};return e.init=function(){b.toBoolean(d.properties.allow_uncached)?c.find(".uncached").val(d.uncached||""):c.find(".contentblocks-field-snippet-uncached").hide(),c.addClass("contentblocks-field-loading"),this.select=c.find(".contentblocks-field-snippet-select select"),this.propertiesList=c.find(".contentblocks-properties-list"),this.propertiesSelectWrapper=c.find(".contentblocks-field-snippet-add-property"),this.propertiesSelect=this.propertiesSelectWrapper.find("select"),this.select.on("change",a.proxy(function(){this.chooseSnippet(this.select.val())},this)),this.propertiesSelect.on("change",a.proxy(function(){this.chooseProperty(this.propertiesSelect.val())},this)),a.ajax({dataType:"json",url:ContentBlocksConfig.connectorUrl,data:{action:"content/snippet/getlist",field:e.fieldId},context:this,beforeSend:function(a,b){b.crossDomain||a.setRequestHeader("modAuth",MODx.siteId)},success:function(d){d.results?d.results&&d.results.length?(a.each(d.results,function(a,b){e.snippets[b.name]=b}),this.snippetsLoaded()):b.alert(_("contentblocks.snippet.none_available")):b.alert(d.message),c.removeClass("contentblocks-field-loading")}})},e.snippetsLoaded=function(){if(e.select.empty(),e.select.append("<option></option>"),a.each(e.snippets,function(a,b){e.select.append('<option value="'+a+'">'+b.name+"</option>")}),!d.snippet||!d.snippet.length&&1==e.snippets.length){for(var b in e.snippets)break;d.snippet=b}d.snippet&&(e.select.val(d.snippet),e.chooseSnippet(d.snippet),d.snippet_properties&&a.each(d.snippet_properties,function(a,b){e.chooseProperty(a,b)})),e.select.find("option").length<2?e.select.hide():e.select.show()},e.chooseSnippet=function(b){var c=this.snippets[b];return c?(e.snippet=b,e.properties=c.properties,e.propertiesSelect.empty(),e.propertiesList.empty(),e.propertiesSelect.append("<option></option>"),c.properties&&a.each(c.properties,function(a,b){e.propertiesSelect.append('<option value="'+a+'">'+b.name+"</option>")}),e.propertiesSelect.append('<option value="__other__">'+_("contentblocks.snippet.other_property")+"</option>"),void e.propertiesSelectWrapper.show()):(console&&console.error("Snippet "+b+" not found in available snippets: ",this.snippets),!1)},e.chooseProperty=function(a,c){c=c||"",e.propertyId++;var d=!1;if(d="__other__"==a?{name:_("contentblocks.snippet.other_property"),desc_trans:_("contentblocks.snippet.other_property.desc")}:!(!e.properties||!e.properties[a])&&e.properties[a],!d)return void(console&&console.error("Property "+a+" not found for snippet "+e.snippet));d.id="contentblocks-snippet-property-"+e.propertyId,d.key=a,d.value=c;var f=e.propertiesSelect.find("option[value="+a+"]");f.remove(),e.hiddenProperties[a]=d,e.propertiesList.append(tmpl("contentblocks-field-snippet-property",d));var g=e.propertiesList.find("#"+d.id);g.find(".contentblocks-field-snippet-delete-property").on("click",function(){e.propertiesSelect.append('<option value="'+a+'">'+d.name+"</option>"),e.hiddenProperties[a]=!1,g.remove(),e.propertiesList.find("li").length<1&&e.propertiesList.hide()}),g.find("input").on("keyup",function(){b.fireChange()}),e.propertiesList.show()},e.getData=function(){var f={};e.propertiesList.find("li").each(function(b,c){var d=a(c),e=d.find("input"),g=e.data("name");f[g]=e.val()});var g=b.toBoolean(d.properties.allow_uncached)?c.find(".uncached").val():"0";return{snippet:e.snippet,snippet_properties:f,uncached:g}},e}}(vcJquery,ContentBlocks),function(a,b){b.fieldTypes.chunk_selector=function(c,d){var e={fieldId:d.field,propertyId:0,chunk_selector:"",chunk_selectors:{},properties:{},hiddenProperties:{},select:null,propertiesList:null,propertiesSelectWrapper:null,propertiesSelect:null};return e.init=function(){c.addClass("contentblocks-field-loading"),this.select=c.find(".contentblocks-field-chunk_selector-select select"),this.propertiesList=c.find(".contentblocks-properties-list"),this.propertiesSelectWrapper=c.find(".contentblocks-field-chunk_selector-add-property"),this.propertiesSelect=this.propertiesSelectWrapper.find("select"),this.select.on("change",a.proxy(function(){this.chooseChunk(this.select.val())},this)),this.propertiesSelect.on("change",a.proxy(function(){this.chooseProperty(this.propertiesSelect.val())},this)),a.ajax({dataType:"json",url:ContentBlocksConfig.connectorUrl,data:{action:"content/chunk_selector/getlist",field:e.fieldId},context:this,beforeSend:function(a,b){b.crossDomain||a.setRequestHeader("modAuth",MODx.siteId)},success:function(d){d.results?d.results&&d.results.length?(a.each(d.results,function(a,b){e.chunk_selectors[b.name]=b}),this.chunk_selectorsLoaded()):b.alert(_("contentblocks.snippet.none_available")):b.alert(d.message),c.removeClass("contentblocks-field-loading")}})},e.chunk_selectorsLoaded=function(){if(e.select.empty(),e.select.append("<option></option>"),a.each(e.chunk_selectors,function(a,b){b.name=""!=b.description?b.name+" ("+b.description+")":b.name,e.select.append('<option value="'+a+'">'+b.name+"</option>")}),!d.chunk_selector||!d.chunk_selector.length&&1==e.chunk_selectors.length){for(var b in e.chunk_selectors)break;d.chunk_selector=b}d.chunk_selector&&(e.select.val(d.chunk_selector),e.chooseChunk(d.chunk_selector),d.chunk_selector_properties&&a.each(d.chunk_selector_properties,function(a,b){e.chooseProperty(a,b)})),e.select.find("option").length<2?e.select.hide():e.select.show()},e.chooseChunk=function(b){var c=this.chunk_selectors[b];return c?(e.chunk_selector=b,e.properties=c.properties,e.propertiesSelect.empty(),e.propertiesList.empty(),e.propertiesSelect.append("<option></option>"),c.properties&&a.each(c.properties,function(a,b){e.propertiesSelect.append('<option value="'+a+'">'+b.name+"</option>")}),e.propertiesSelect.append('<option value="__other__">'+_("contentblocks.snippet.other_property")+"</option>"),void e.propertiesSelectWrapper.show()):(console&&console.error("Chunk "+b+" not found in available chunks: ",this.chunk_selectors),!1)},e.chooseProperty=function(a,c){c=c||"",e.propertyId++;var d=!1;if(d="__other__"==a?{name:_("contentblocks.snippet.other_property"),desc_trans:_("contentblocks.snippet.other_property.desc")}:!(!e.properties||!e.properties[a])&&e.properties[a],!d)return void(console&&console.error("Property "+a+" not found for chunk_selector "+e.chunk_selector));d.id="contentblocks-chunk_selector-property-"+e.propertyId,d.key=a,d.value=c;var f=e.propertiesSelect.find("option[value="+a+"]");f.remove(),e.hiddenProperties[a]=d,e.propertiesList.append(tmpl("contentblocks-field-chunk_selector-property",d));var g=e.propertiesList.find("#"+d.id);g.find(".contentblocks-field-chunk-delete-property").on("click",function(){e.propertiesSelect.append('<option value="'+a+'">'+d.name+"</option>"),e.hiddenProperties[a]=!1,g.remove(),e.propertiesList.find("li").length<1&&e.propertiesList.hide()}),g.find("input").on("keyup",function(){b.fireChange()}),e.propertiesList.show()},e.getData=function(){var b={};return e.propertiesList.find("li").each(function(c,d){var e=a(d),f=e.find("input"),g=f.data("name");b[g]=f.val()}),{chunk_selector:e.chunk_selector,chunk_selector_properties:b}},e}}(vcJquery,ContentBlocks),function(a,b){b.fieldTypes.layout=function(c,d){var e={};return e.init=function(){var e=d.child_layouts||{},f=!1;if(d.properties.available_layouts&&c.data("layouts",d.properties.available_layouts),d.properties.available_templates&&c.data("templates",d.properties.available_templates),"undefined"!=typeof window.event){var g=a(window.event.target);f=g.hasClass("contentblocks-repeat-layout")}!f&&a.isEmptyObject(e)&&b.initialized&&setTimeout(function(){c.find(".contentblocks-add-layout").click()},500),b.buildContents(e,c.find(".contentblocks-layout-wrapper").first())},e.destroy=function(){c.find(".contentblocks-layout").each(function(c,d){var e=a(d),f=e.find(".contentblocks-content").not(e.find(".contentblocks-layout .contentblocks-content"));a.each(f,function(c,d){a.each(a(d).find(".contentblocks-field").not(a(d).find(".contentblocks-field .contentblocks-field")),function(c,d){b.deleteField(window.event,a(d),!0)})}),b.deleteLayout(window.event,e,!0)})},e.getData=function(){var d=[];return c.find(".contentblocks-layout-wrapper").first().children(".contentblocks-layout").each(function(c,e){var f=a(e),g=f.data("layout"),h=a(this).parent().closest("li.contentblocks-field-outer").data("field")||0,i={layout:g,content:{},settings:Ext.decode(f.data("settings"))||{},parent:h},j=f.find(".contentblocks-content").not(f.find(".contentblocks-content .contentblocks-content"));a.each(j,function(c,d){var e=a(d),f=e.data("part"),g=[];a.each(e.children("li"),function(c,d){var e=a(d),f=e.data("field"),h=e.attr("id"),i=b.generatedContentFields[h];if(i){var j=i.getData();j.field=f,j.settings=Ext.decode(e.data("settings"))||{},g.push(j)}}),i.content[f]=g}),d.push(i)}),{child_layouts:d}},e}}(vcJquery,ContentBlocks);
//# sourceMappingURL=all-min.js.map
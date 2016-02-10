<?php
/**
 * Author: Mark Hamstra
 * Last updated: 2013-10-30
 */

$_lang['moregallery'] = 'MoreGallery';
$_lang['moregallery.new'] = 'Nytt galleri';
$_lang['moregallery.new_description'] = 'Skapa ett nytt gallery som du kan ladda upp bilder till.';
$_lang['moregallery.name'] = 'Galleri';
$_lang['moregallery.name_here'] = 'Skapa ett galleri här';
$_lang['moregallery.please_save_first'] = 'Du måste spara galleriet innan du kan börja lägga till bilder. Efter att du har sparat galleriet kan du ladda upp bilder här.';



$_lang['moregallery.inherit'] = 'Ärv';
$_lang['moregallery.inherit.desc'] = 'Använd systemstandardvärdena.';
$_lang['moregallery.source'] = 'Mediakälla';
$_lang['moregallery.source.desc'] = 'Den mediakälla som bilderna ska sparas i. <b>Obs:</b> Om du ändrar denna efter att du har lagt till bilder kommer de bilderna INTE att flyttas automatiskt. Du måste flytta dem själv.';
$_lang['moregallery.relative_url'] = 'Relativ URL';
$_lang['moregallery.relative_url.desc'] = 'Den relativa URL:en till mediakällan där bilderna ska sparas. Börja inte med ett snedstreck (slash). <b>Obs:</b> Om du ändrar denna efter att du har lagt till bilder kommer de bilderna INTE att flyttas automatiskt. Du måste flytta dem själv.';
$_lang['moregallery.content_position'] = 'Innehållsfältets position';
$_lang['moregallery.content_position.desc'] = 'Flytta resursens innehållsfält till en annan, mer praktisk plats.';

$_lang['moregallery.content_position.above'] = 'Ovanför bilderna';
$_lang['moregallery.content_position.below'] = 'Nedanför bilderna';
$_lang['moregallery.content_position.tab'] = 'På fliken innehåll';
$_lang['moregallery.content_position.hide'] = 'Dölj';

$_lang['moregallery.view_full_size_image'] = 'Visa bilden i full storlek';
$_lang['moregallery.delete_image'] = 'Ta bort bilden';
$_lang['moregallery.deactivate_image'] = 'Dölj bild från galleriet';
$_lang['moregallery.activate_image'] = 'Märk bilden som synlig';
$_lang['moregallery.upload_image'] = 'Ladda upp bilder till galleriet';
$_lang['moregallery.upload'] = 'Ladda upp';
$_lang['moregallery.import_image'] = 'Importera bilder från andra källor';
$_lang['moregallery.import'] = 'Importera';
$_lang['moregallery.refresh'] = 'Uppdatera';
$_lang['moregallery.drop_to_upload'] = 'Dra och släpp bilder för att ladda upp dem till galleriet';
$_lang['moregallery.images_count'] = 'bilder';
$_lang['moregallery.edit_image_header'] = 'Redigera bilden';
$_lang['moregallery.name_field'] = 'Namn';
$_lang['moregallery.description'] = 'Beskrivning';
$_lang['moregallery.url'] = 'URL (eller resursens ID)';
$_lang['moregallery.save'] = 'Spara';
$_lang['moregallery.saving'] = 'Sparar..';
$_lang['moregallery.saved_at'] = 'Sparad (kl [[+time]])';
$_lang['moregallery.confirm_remove'] = 'Är du säker på att du vill ta bort "[[+name]]"? Bilden kommer att raderas från servern.';
$_lang['moregallery.preupload_very_big'] = 'Filen "[[+file]]" är väldigt stor. Det kan ta lång tid att ladda upp den, och servern har kanske inte tillräckligt med minne för att bearbeta den sen. Är du säker på att du vill fortsätta?';
$_lang['moregallery.upload_error'] = 'Aj då, ett fel uppstod när bilden [[+file]] skulle laddas upp: [[+message]]';
$_lang['moregallery.upload_error_huge'] = 'Den uppladdade bilden var över [[+size]]MB i storlek, vilken kan ha varit för mycket för servern att hantera. Prova att minska storleken på bilden innan du laddar upp den igen.';
$_lang['moregallery.model_error'] = 'Ett oväntat fel uppstod, bildens typ kunde inte hittas. Prova med att uppdatera sidan.';

$_lang['moregallery.error_invalid_resource'] = 'Ett oväntat fel uppstod, resursen "[[+resource]]" är inte ett giltigt galleri.';
$_lang['moregallery.error_loading_source'] = 'Ett fel uppstod när galleriets mediakälla skulle laddas.';
$_lang['moregallery.error_invalid_filetype'] = 'Sorry, .[[+extension]] files are not allowed.';
$_lang['moregallery.error_upload_failed'] = 'the file could not be uploaded (Error [[+error]]).';

// Tags related, for MoreGallery 1.1
$_lang['moregallery.tags'] = 'Bildens taggar';
$_lang['moregallery.tags.add'] = 'Lägg till';
// Imports, also new in 1.1
$_lang['moregallery.file_doesnt_exist'] = 'Filen som ska importeras verkar inte existera eller är inte läsbar: [[+file]]';
$_lang['moregallery.edit_crop'] = 'Redigera klipp';
$_lang['moregallery.save_crop'] = 'Spara klipp';
$_lang['moregallery.preview_crop'] = 'Förhandsgranska klipp';
$_lang['moregallery.processing_crop'] = 'Bearbetar...';

/**
 * Settings
 */
$_lang['setting_moregallery.source_relative_url'] = 'Relativ URL till källa';
$_lang['setting_moregallery.source_relative_url_desc'] = 'Relativ URL till roten för vald mediakälla som bilder skall laddas upp till. Kan åsidosättas per galleri resurs under fliken Inställningar.';

$_lang['setting_moregallery.source'] = 'Mediakälla';
$_lang['setting_moregallery.source_desc'] = 'Välj mediakälla att ladda upp bilder till. Kan åsidosättas per galleri resurs under fliken Inställningar.';

$_lang['setting_moregallery.image_id_in_name'] = 'Bild-ID i filnamn';
$_lang['setting_moregallery.image_id_in_name_desc'] = 'Sätt till antingen "prefix" eller "suffix" för att lägga till bild-ID i filnamnet vid uppladdning. Detta försäkrar att filnamnet är unikt.';
$_lang['setting_moregallery.resource_id_in_path'] = 'Resurs-ID i sökväg';
$_lang['setting_moregallery.resource_id_in_path_desc'] = 'När aktiverat kommer galleriets resurs-ID att läggas till i slutet av källans relativa URL så att varje galleri har en egen mapp.';
$_lang['setting_moregallery.content_position'] = 'Innehållsposition';
$_lang['setting_moregallery.content_position_desc'] = 'Sätt till "över", "under", "flik" eller "dölj" för att bestämma hur innehållsfältet visas, om alls.';
$_lang['setting_moregallery.use_rte_for_images'] = 'Använd Rich Text redigerare';
$_lang['setting_moregallery.use_rte_for_images_desc'] = 'När aktiverat kommer den aktiva rich text redigeraren att laddas in i bild beskrivningsfältet. Vi rekommenderar att man använder Redactor, men andra redigerare stöds också.';
$_lang['setting_moregallery.crops'] = 'Klipp';
$_lang['setting_moregallery.crops_desc'] = 'Insert your Crops configuration here to enable region of interest cropping on images. An example could be <code>small:width=200,height=200,aspect=1|medium:width=500,aspect=0.7</code>. As this is an advanced feature, please refer to the <a href="https://www.modmore.com/extras/moregallery/documentation/crops/" target="_blank">full Crops documentation</a> for more information about syntax and functionality.';
$_lang['setting_moregallery.single_image_url_param'] = 'Single Image URL Parameter';
$_lang['setting_moregallery.single_image_url_param_desc'] = 'Used with the mgGetImages snippet, the single image url parameter determines whether a listing or single image is displayed. This URL parameter will contain the image ID and, if not found, it will send the user to the configured 404 page. ';
$_lang['setting_moregallery.add_icon_to_toolbar'] = 'Lägg till ikon i verktygsfältet';
$_lang['setting_moregallery.add_icon_to_toolbar_desc'] = 'When enabled, a "New Gallery" icon will be added to resource toolbar providing quick access to create new Galleries.';

$_lang['setting_moregallery.sanitize_replace'] = 'Saneringsersättning';
$_lang['setting_moregallery.sanitize_replace_desc'] = 'Alla tecken i de uppladdade filnamnen som inte matchar saneringsmönstret kommer att ersättas med detta tecken.';
$_lang['setting_moregallery.sanitize_pattern'] = 'Saniteringsmönster';
$_lang['setting_moregallery.sanitize_pattern_desc'] = 'Ett RegEx mönster för att rensa upp filnamn vid uppladdning.';
$_lang['setting_mgr_tree_icon_mgresource'] = 'Galleri trädikon';
$_lang['setting_mgr_tree_icon_mgresource_desc'] = 'Font Awesome ikonklassen att lägga till för MoreGallery resurser i filträdet. ';

/**
 * Snippet properties
 */

/** mgGetImages */
$_lang['moregallery.mggetimages.cache_desc'] = 'Cachea galleri utdata?';
$_lang['moregallery.mggetimages.resource_desc'] = 'Ange en resurs-ID att ta bilder ifrån.';
$_lang['moregallery.mggetimages.sortby_desc'] = 'The field to sort by. Valid values: filename, name, description, sortorder, uploadedon, editedon';
$_lang['moregallery.mggetimages.sortdir_desc'] = 'Riktningen som bilderna ska sorteras i. Det kan vara "asc" (stigande) eller "desc" (fallande).';
$_lang['moregallery.mggetimages.tags_desc'] = 'A comma separated list of tag names or IDs to filter images on.';
$_lang['moregallery.mggetimages.tagsfromurl_desc'] = 'Set to the name of a URL parameter to get tags to filter on.';
$_lang['moregallery.mggetimages.getresourcefields_desc'] = 'When enabled, resource fields will be loaded into the image template.';
$_lang['moregallery.mggetimages.getresourcetvs_desc'] = 'Provide a comma separated list of TV names to load into the image template.';
$_lang['moregallery.mggetimages.tagtpl_desc'] = 'The name of a Chunk to load for templating tags.';
$_lang['moregallery.mggetimages.imagetpl_desc'] = 'The name of a Chunk to load for templating images.';
$_lang['moregallery.mggetimages.singleimagetpl_desc'] = 'The name of a Chunk to load when viewing the special one-image view.';
$_lang['moregallery.mggetimages.tagseparator_desc'] = 'A string to separate tag templates with for each of the images.';
$_lang['moregallery.mggetimages.imageseparator_desc'] = 'A string to separate image templates with in gallery view.';
$_lang['moregallery.mggetimages.wrappertpl_desc'] = 'When not empty, the specified Chunk will be used to wrap the entire output in.';
$_lang['moregallery.mggetimages.toplaceholder_desc'] = 'When not empty, the snippet will set a placeholder with the output and will not output content directly.';
$_lang['moregallery.mggetimages.totalvar_desc'] = 'Used for getPage pagination, set this to a placeholder to set for the total number of results.';
$_lang['moregallery.mggetimages.limit_desc'] = 'The number of images to load in the result set.';
$_lang['moregallery.mggetimages.offset_desc'] = 'he number of images to skip in the result set.';
$_lang['moregallery.mggetimages.scheme_desc'] = 'The scheme to use in generating URLs; defaults to the value of the link_tag_scheme value.';
$_lang['moregallery.mggetimages.where_desc'] = 'A generic condition to add to the query can be added here, in JSON format. For example {"uploadedby":4} or {"name:LIKE":"%train%"} ';

/** mgGetTags */
$_lang['moregallery.mggettags.cache_desc_desc'] = 'Cache the Tag output?';
$_lang['moregallery.mggettags.resource_desc'] = 'Specify a resource ID to get tags from.';
$_lang['moregallery.mggettags.sortby_desc'] = 'The field to sort by. Valid values: display, createdon';
$_lang['moregallery.mggettags.sortdir_desc'] = 'The direction to sort tags by. This can be "asc" or "desc".';
$_lang['moregallery.mggettags.tpl_desc'] = 'The name of a Chunk to load for templating tags.';
$_lang['moregallery.mggettags.separator_desc'] = 'A string to separate tags with.';
$_lang['moregallery.mggettags.wrappertpl_desc'] = 'When not empty, the specified Chunk will be used to wrap the entire output in.';
$_lang['moregallery.mggettags.toplaceholder_desc'] = 'When not empty, the snippet will set a placeholder with the output and will not output content directly.';
$_lang['moregallery.mggettags.totalvar_desc'] = 'Used for getPage pagination, set this to a placeholder to set for the total number of results.';
$_lang['moregallery.mggettags.limit_desc'] = 'Antal bilder att ladda in.';
$_lang['moregallery.mggettags.offset_desc'] = 'Antal bilder att hoppa över.';
$_lang['moregallery.mggettags.where_desc'] = 'Ett allmänt tillstånd att lägga till i förfrågan kan läggas till här, i JSON-format. Till exempel {"createdon:>=":1390737600} eller {"display:LIKE":"%train%"} ';

<?php
/**
 * Author: Mark Hamstra
 * Last updated: 2013-10-30
 */

$_lang['moregallery'] = 'MoreGalerij';
$_lang['moregallery.new'] = 'Nieuwe Galerij';
$_lang['moregallery.new_description'] = 'Maak een nieuwe Galerij aan om afbeeldingen naar te uploaden.';
$_lang['moregallery.name'] = 'Galerij';
$_lang['moregallery.name_here'] = 'Maak een nieuwe galerij hier';
$_lang['moregallery.please_save_first'] = 'Om afbeeldingen aan de galerij toe te kunnen voegen dient deze eerst opgeslagen te worden. Na het uploaden is het hier mogelijk om afbeeldingen te uploaden.';



$_lang['moregallery.inherit'] = 'Erven';
$_lang['moregallery.inherit.desc'] = 'Gebruik the systeem standaarden.';
$_lang['moregallery.source'] = 'Media Source';
$_lang['moregallery.source.desc'] = 'De media source om afbeeldingen in op te slaan. <b>Let op:</b> reeds geuploade afbeeldingen worden na het veranderen van deze instelling NIET automatisch verplaatst, dit dient handmatig te gebeuren.';
$_lang['moregallery.relative_url'] = 'Relatieve URL';
$_lang['moregallery.relative_url.desc'] = 'De relatieve URL om afbeeldingen in de media source in op te slaan. Begint niet met een slash. <b>Let op:</b> reeds geuploade afbeeldingen worden na het veranderen van deze instelling NIET automatisch verplaatst, dit dient handmatig te gebeuren.';
$_lang['moregallery.content_position'] = 'Content Positie';
$_lang['moregallery.content_position.desc'] = 'Deze instelling bepaalt waar het Document Content veld getoond word.';

$_lang['moregallery.content_position.above'] = 'Boven Afbeeldingen';
$_lang['moregallery.content_position.below'] = 'Onder Afbeeldingen';
$_lang['moregallery.content_position.tab'] = 'In een nieuwe "Content" Tab';
$_lang['moregallery.content_position.hide'] = 'Verberg Content';

$_lang['moregallery.view_full_size_image'] = 'Bekijk afbeelding op volledige grootte';
$_lang['moregallery.delete_image'] = 'Verwijder afbeelding';
$_lang['moregallery.deactivate_image'] = 'Hide image from the Gallery';
$_lang['moregallery.activate_image'] = 'Mark image as visible';
$_lang['moregallery.upload_image'] = 'Upload afbeeldingen naar de Galerij';
$_lang['moregallery.upload'] = 'Upload';
$_lang['moregallery.import_image'] = 'Importeer afbeeldingen van andere bronnen';
$_lang['moregallery.import'] = 'Importeer';
$_lang['moregallery.refresh'] = 'Ververs';
$_lang['moregallery.drop_to_upload'] = 'Laat bestanden los om deze naar de Galerij te uploaden.';
$_lang['moregallery.images_count'] = 'afbeeldingen';
$_lang['moregallery.edit_image_header'] = 'Bewerk Afbeelding';
$_lang['moregallery.name_field'] = 'Naam';
$_lang['moregallery.description'] = 'Omschrijving';
$_lang['moregallery.url'] = 'Url (of Document ID)';
$_lang['moregallery.save'] = 'Opslaan';
$_lang['moregallery.saving'] = 'Wordt opgeslagen..';
$_lang['moregallery.saved_at'] = 'Opgeslagen (om [[+time]])';
$_lang['moregallery.confirm_remove'] = 'Weet je zeker dat je de afbeelding "[[+name]]" wilt verwijderen? De afbeelding zal van de server worden verwijderd.';
$_lang['moregallery.preupload_very_big'] = 'Het betand [[+file]] is erg groot. Het uploaden kan een redelijke tijd duren, en na de upload heeft de server mogelijk niet genoeg geheugen om de afbeelding te verwerken. Weet je zeker dat je deze afbeelding wilt uploaden?';
$_lang['moregallery.upload_error'] = 'Oeps, er is iets niet goed gegaan tijdens het uploaden van het bestand [[+file]]: [[+message]]';
$_lang['moregallery.upload_error_huge'] = 'Het geuploade bestand was ruim [[+size]]mb in grootte, wat mogelijk te groot is geweest voor de server om te uploaden of te verwerken. Probeer om het bestand te verkleinen voor deze te uploaden.';
$_lang['moregallery.model_error'] = 'Een onverwachte fout is opgetreden, de afbeelding representatie kon niet worden gevonden. Probeer de pagina te verversen.';

$_lang['moregallery.error_invalid_resource'] = 'Een onverwachte fout is opgetreden, document "[[+resource]]" is geen Galerij.';
$_lang['moregallery.error_loading_source'] = 'Er is een fout opgetreden bij het laden van de Media Source voor deze Galerij.';

// Tags related, for MoreGallery 1.1
$_lang['moregallery.tags'] = 'Tags';
$_lang['moregallery.tags.add'] = 'Toevoegen';
// Imports, also new in 1.1
$_lang['moregallery.file_doesnt_exist'] = 'Het bestand wat geïmporteerd moet worden lijkt niet te bestaan of is niet leesbaar: [[+file]]';
$_lang['moregallery.edit_crop'] = 'Edit Crop';
$_lang['moregallery.save_crop'] = 'Save Crop';
$_lang['moregallery.preview_crop'] = 'Preview crop';
$_lang['moregallery.processing_crop'] = 'Verwerken...';

/**
 * Settings
 */
$_lang['setting_moregallery.source_relative_url'] = 'Source Relative URL';
$_lang['setting_moregallery.source_relative_url_desc'] = 'The URL relative to the root of the selected media source to upload images to. Can be overridden per Gallery resource on its Settings tab.';

$_lang['setting_moregallery.source'] = 'Media Source';
$_lang['setting_moregallery.source_desc'] = 'Choose a Media Source to upload images to. Can be overridden per Gallery resource on its Settings tab.';

$_lang['setting_moregallery.image_id_in_name'] = 'Image ID in Filename';
$_lang['setting_moregallery.image_id_in_name_desc'] = 'Set to either "prefix" or "suffix" to add the image ID to the file name on upload. This ensures the filename is unique.';
$_lang['setting_moregallery.resource_id_in_path'] = 'Resource ID in Path';
$_lang['setting_moregallery.resource_id_in_path_desc'] = 'When enabled, the Gallery Resource ID will be suffixed to the Source Relative URL so each gallery has its own directory.';
$_lang['setting_moregallery.content_position'] = 'Content Position';
$_lang['setting_moregallery.content_position_desc'] = 'Set to "above", "below", "tab" or "hide" to determine how the Content field will be displayed, if at all.';
$_lang['setting_moregallery.use_rte_for_images'] = 'Use Rich Text Editor';
$_lang['setting_moregallery.use_rte_for_images_desc'] = 'When enabled, the currently active rich text editor will be loaded into the Image Description field. We recommend using Redactor, but other editors are also supported.';
$_lang['setting_moregallery.crops'] = 'Crops';
$_lang['setting_moregallery.crops_desc'] = 'Insert your Crops configuration here to enable region of interest cropping on images. An example could be <code>small:width=200,height=200,aspect=1|medium:width=500,aspect=0.7</code>. As this is an advanced feature, please refer to the <a href="https://www.modmore.com/extras/moregallery/documentation/crops/">full Crops documentation</a> for more information about syntax and functionality.';
$_lang['setting_moregallery.single_image_url_param'] = 'Single Image URL Parameter';
$_lang['setting_moregallery.single_image_url_param_desc'] = 'Used with the mgGetImages snippet, the single image url parameter determines whether a listing or single image is displayed. This URL parameter will contain the image ID and, if not found, it will send the user to the configured 404 page. ';
$_lang['setting_moregallery.add_icon_to_toolbar'] = 'Add Icon to Toolbar';
$_lang['setting_moregallery.add_icon_to_toolbar_desc'] = 'When enabled, a "New Gallery" icon will be added to resource toolbar providing quick access to create new Galleries.';

$_lang['setting_moregallery.sanitize_replace'] = 'Sanitize Replacement';
$_lang['setting_moregallery.sanitize_replace_desc'] = 'Any characters in the uploaded filenames that do not match the sanitize pattern will be replaced with this character.';
$_lang['setting_moregallery.sanitize_pattern'] = 'Sanitize Pattern';
$_lang['setting_moregallery.sanitize_pattern_desc'] = 'A RegEx pattern for cleaning up filenames on upload.';
$_lang['setting_mgr_tree_icon_mgresource'] = 'Gallery Tree Icon';
$_lang['setting_mgr_tree_icon_mgresource_desc'] = 'The Font Awesome icon class to add to MoreGallery Resources in the file tree. ';

/**
 * Snippet properties
 */

/** mgGetImages */
$_lang['moregallery.mggetimages.cache_desc'] = 'De galerij output cachen?';
$_lang['moregallery.mggetimages.resource_desc'] = 'Geef een document ID op om afbeeldingen van te laden.';
$_lang['moregallery.mggetimages.sortby_desc'] = 'Het veld waarop afbeeldingen worden gesorteerd. De mogelijk waarden zijn: filename, name, description, sortorder, uploadedon, editedon';
$_lang['moregallery.mggetimages.sortdir_desc'] = 'De richting voor het sorteren van de afbeeldingen. Dit kan "asc" of "desc" zijn. ';
$_lang['moregallery.mggetimages.tags_desc'] = 'Een komma gescheiden lijst met tag namen of IDs om afbeeldingen op te filteren.';
$_lang['moregallery.mggetimages.tagsfromurl_desc'] = 'Stel de naam van een URL paramater in waarmee op tags gefilterd kan worden.';
$_lang['moregallery.mggetimages.getresourcefields_desc'] = 'Indien ingeschakeld zullen document velden in de afbeeldingstemplate beschikbaar zijn. ';
$_lang['moregallery.mggetimages.getresourcetvs_desc'] = 'Geef een komma gescheiden lijst op van template variabel namen die geladen moeten worden in de afbeelding template.';
$_lang['moregallery.mggetimages.tagtpl_desc'] = 'De naam van een chunk om voor tags te gebruiken.';
$_lang['moregallery.mggetimages.imagetpl_desc'] = 'De naam van een chunk om te gebruiken als template voor de afbeeldingen.';
$_lang['moregallery.mggetimages.singleimagetpl_desc'] = 'De naam van een chunk om te gebruiken wanneer er een enkele afbeelding wordt getoond.';
$_lang['moregallery.mggetimages.tagseparator_desc'] = 'Een tekenreeks om tag templates van elkaar te scheiden in de afbeelding templates.';
$_lang['moregallery.mggetimages.imageseparator_desc'] = 'Een tekenreeks om afbeelding templates van elkaar te scheiden in de galerijweergave.';
$_lang['moregallery.mggetimages.wrappertpl_desc'] = 'Indien opgegeven zal deze naam van een chunk gebruikt worden als wrapper voor de complete output.';
$_lang['moregallery.mggetimages.toplaceholder_desc'] = 'Indien opgegeven zal de snippet een placeholder instellen met deze naam, waarin de volledige output wordt opgeslagen.';
$_lang['moregallery.mggetimages.totalvar_desc'] = 'Gebruikt voor paginatie met getPage, deze placeholder zal het totaal aantal resultaten bevatten.';
$_lang['moregallery.mggetimages.limit_desc'] = 'Het aantal afbeeldingen dat geladen moet worden.';
$_lang['moregallery.mggetimages.offset_desc'] = 'Het aantal afbeeldingen dat aan het begin van de resultaten overgeslagen moet worden.';
$_lang['moregallery.mggetimages.scheme_desc'] = 'Het schema wat gebruikt moet worden voor het generen van URLs; standaard zal dit de waarde zijn van de link_tag_scheme instelling.';
$_lang['moregallery.mggetimages.where_desc'] = 'A generic condition to add to the query can be added here, in JSON format. For example {"uploadedby":4} or {"name:LIKE":"%train%"} ';

/** mgGetTags */
$_lang['moregallery.mggettags.cache_desc_desc'] = 'Cache de Tag resultaten?';
$_lang['moregallery.mggettags.resource_desc'] = 'Geef een document ID op om tags van te laden.';
$_lang['moregallery.mggettags.sortby_desc'] = 'Het veld om op te sorteren. Geldige waarden: display, createdon';
$_lang['moregallery.mggettags.sortdir_desc'] = 'De richting voor het sorteren van de tags. Dit kan "asc" of "desc" zijn.';
$_lang['moregallery.mggettags.tpl_desc'] = 'De naam van een chunk om te gebruiken als template voor de tags.';
$_lang['moregallery.mggettags.separator_desc'] = 'Een tekenreeks om tussen tags te gebruiken.';
$_lang['moregallery.mggettags.wrappertpl_desc'] = 'Indien opgegeven zal deze naam van een chunk gebruikt worden als wrapper voor de complete output.';
$_lang['moregallery.mggettags.toplaceholder_desc'] = 'Indien opgegeven zal de snippet een placeholder instellen met deze naam, waarin de volledige output wordt opgeslagen.';
$_lang['moregallery.mggettags.totalvar_desc'] = 'Gebruikt voor paginatie met getPage, deze placeholder zal het totaal aantal resultaten bevatten.';
$_lang['moregallery.mggettags.limit_desc'] = 'Het aantal tags dat geladen moet worden.';
$_lang['moregallery.mggettags.offset_desc'] = 'Het aantal tags dat aan het begin van de resultaten overgeslagen moet worden.';
$_lang['moregallery.mggettags.where_desc'] = 'A generic condition to add to the query can be added here, in JSON format. For example {"createdon:>=":1390737600} or {"display:LIKE":"%train%"} ';

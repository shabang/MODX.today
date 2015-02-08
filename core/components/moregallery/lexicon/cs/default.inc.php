<?php
/**
 * Author: Mark Hamstra
 * Last updated: 2013-10-30
 */

$_lang['moregallery'] = 'MoreGallery';
$_lang['moregallery.new'] = 'Nová galerie';
$_lang['moregallery.new_description'] = 'Vytvoření nové galerie, do které budete moci nahrát obrázky.';
$_lang['moregallery.name'] = 'Galerie';
$_lang['moregallery.name_here'] = 'Galerii';
$_lang['moregallery.please_save_first'] = 'Pro přidání obrázků nejprve prosím uložte galerii. Po prvním uložení galerie, zde bude možné nahrávat obrázky.';



$_lang['moregallery.inherit'] = 'Výchozí';
$_lang['moregallery.inherit.desc'] = 'Použít výchozí nastavení systému.';
$_lang['moregallery.source'] = 'Zdroje médií';
$_lang['moregallery.source.desc'] = 'Zdroj médií, který bude použit pro ukládání obrázků. <b>Poznámka:</b> Pokud změníte zdroj médií po nahrání obrázků, nahrané obrázky NEBUDOU automaticky přesunuty do nového zdroje.';
$_lang['moregallery.relative_url'] = 'Relativní URL';
$_lang['moregallery.relative_url.desc'] = 'Relativní URL pro ukládání obrázků ve zdroji médií. Nezačínejte lomítkem. <b>Poznámka:</b> Pokud změníte zdroj médií po nahrání obrázků, nahrané obrázky NEBUDOU automaticky přesunuty do nového zdroje.';
$_lang['moregallery.content_position'] = 'Pozice obsahu';
$_lang['moregallery.content_position.desc'] = 'Přesune pole pro obsah dokumentu na jinou, více vhodnou pozici.';

$_lang['moregallery.content_position.above'] = 'Nad galerií';
$_lang['moregallery.content_position.below'] = 'Pod galerií';
$_lang['moregallery.content_position.tab'] = 'V samostatné záložce "Obsah dokumentu"';
$_lang['moregallery.content_position.hide'] = 'Skrýt';

$_lang['moregallery.view_full_size_image'] = 'Zabrazit obrázek v plné velikosti';
$_lang['moregallery.delete_image'] = 'Odstranit obrázek';
$_lang['moregallery.deactivate_image'] = 'Hide image from the Gallery';
$_lang['moregallery.activate_image'] = 'Mark image as visible';
$_lang['moregallery.upload_image'] = 'Nahrát obrázky do galerie';
$_lang['moregallery.upload'] = 'Nahrát';
$_lang['moregallery.import_image'] = 'Importovat obrázky z jiných zdrojů';
$_lang['moregallery.import'] = 'Importovat';
$_lang['moregallery.refresh'] = 'Obnovit';
$_lang['moregallery.drop_to_upload'] = 'Přetáhněte sem obrázky pro jejich nahrádní do galerie';
$_lang['moregallery.images_count'] = 'obrázků';
$_lang['moregallery.edit_image_header'] = 'Upravit obrázek';
$_lang['moregallery.name_field'] = 'Název';
$_lang['moregallery.description'] = 'Popis';
$_lang['moregallery.url'] = 'Odkaz nebo ID dokumentu';
$_lang['moregallery.save'] = 'Uložit';
$_lang['moregallery.saving'] = 'Ukládám...';
$_lang['moregallery.saved_at'] = 'Uloženo v [[+time]]';
$_lang['moregallery.confirm_remove'] = 'Opravdu chcete odstranit obrázek "[[+name]]"? Obrázek bude odstraněn ze serveru.';
$_lang['moregallery.preupload_very_big'] = 'Soubor "[[+file]]" je velmi velký. Nahrávání může trvat dlouho a server nemusí mít dostatek paměti ke zpracování obrázku po jeho nahrání. Opravdu chcete pokračovat?';
$_lang['moregallery.upload_error'] = 'Jejda, při nahrávání souboru "[[+file]]" nastal problém: [[+message]]';
$_lang['moregallery.upload_error_huge'] = 'Nahraný soubor byl větší než [[+size]] MB, což mohlo být více, než server zvládne nahrát a zpracovat. Zkuste před nahráváním obrázek zmenšit.';
$_lang['moregallery.model_error'] = 'Vyskytla se neočekávaná chyba, obrázek nebyl nalezen. Zkuste obnovit stránku.';

$_lang['moregallery.error_invalid_resource'] = 'Vyskytla se neočekávaná chyba, dokument "[[+resource]]" není platná galerie.';
$_lang['moregallery.error_loading_source'] = 'Vyskytl se chyba při načítání obrázků ze zdroje médií pro tuto galerii.';

// Tags related, for MoreGallery 1.1
$_lang['moregallery.tags'] = 'Tagy';
$_lang['moregallery.tags.add'] = 'Přidat';
// Imports, also new in 1.1
$_lang['moregallery.file_doesnt_exist'] = 'Soubor, který chcete importovat, zřejmě neexistuje nebo není čitelný: [[+ file]]';
$_lang['moregallery.edit_crop'] = 'Edit Crop';
$_lang['moregallery.save_crop'] = 'Save Crop';
$_lang['moregallery.preview_crop'] = 'Preview crop';
$_lang['moregallery.processing_crop'] = 'Processing...';

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
$_lang['moregallery.mggetimages.cache_desc'] = 'Uložit výstup galerie do cache?';
$_lang['moregallery.mggetimages.resource_desc'] = 'Zadejte ID galerie, ze které se mají získat obrázky.';
$_lang['moregallery.mggetimages.sortby_desc'] = 'Pole pro řazení. Platné hodnoty: filename, name, description, sortorder, uploadedon, editedon';
$_lang['moregallery.mggetimages.sortdir_desc'] = 'Směr řazení obrázků. Hodnota "asc" pro vzestupné a "desc" pro sestupné řazení.';
$_lang['moregallery.mggetimages.tags_desc'] = 'Čárkou oddělený seznam tagů nebo ID, dle kterých se mají obrázky vyfiltrovat.';
$_lang['moregallery.mggetimages.tagsfromurl_desc'] = 'Nastavte název URL parametru pro filtrování.';
$_lang['moregallery.mggetimages.getresourcefields_desc'] = 'Pokud je povoleno, hodnoty políček dokumentu budou dostupné v šabloně obrázku.';
$_lang['moregallery.mggetimages.getresourcetvs_desc'] = 'Zadejte čárkou oddělený seznam názvů TV, které mají být dostupné v šabloně obrázku.';
$_lang['moregallery.mggetimages.tagtpl_desc'] = 'Název chunku, který se použije jako šablona pro tagy.';
$_lang['moregallery.mggetimages.imagetpl_desc'] = 'Název chunku, který se použije jako šablona pro obrázky.';
$_lang['moregallery.mggetimages.singleimagetpl_desc'] = 'Název chunku, který se použije jako šablona pro speciální jedno-obrázkové zobrazení.';
$_lang['moregallery.mggetimages.tagseparator_desc'] = 'Řetězec, který bude oddělovat jednotlivé tagy v rámci všech obrázků.';
$_lang['moregallery.mggetimages.imageseparator_desc'] = 'Řetězec, který bude oddělovat jednotlivé šablony obrázků v rámci výpisu galerie.';
$_lang['moregallery.mggetimages.wrappertpl_desc'] = 'Pokud je definován, tak se tento chunk použije jako vnější obal celého výstupu.';
$_lang['moregallery.mggetimages.toplaceholder_desc'] = 'Pokud je definován, tak snippet uloží výstup do placeholderu pro pozdější použití.';
$_lang['moregallery.mggetimages.totalvar_desc'] = 'Používá se pro getPage stránkování, nastavte placeholder pro celkový počet výsledků.';
$_lang['moregallery.mggetimages.limit_desc'] = 'Počet obrazů k načtení v rámci jednoho dotazu.';
$_lang['moregallery.mggetimages.offset_desc'] = 'Počet obrázků, které se mají přeskočit v rámci daného dotazu.';
$_lang['moregallery.mggetimages.scheme_desc'] = 'Schéma, které se má použít při generování URL; Výchozí hodnota je shodná s hodnotou link_tag_scheme.';
$_lang['moregallery.mggetimages.where_desc'] = 'A generic condition to add to the query can be added here, in JSON format. For example {"uploadedby":4} or {"name:LIKE":"%train%"} ';

/** mgGetTags */
$_lang['moregallery.mggettags.cache_desc_desc'] = 'Ukládat výstup tagu do cache?';
$_lang['moregallery.mggettags.resource_desc'] = 'Zadejte ID galerie, ze které se mají získat tagy.';
$_lang['moregallery.mggettags.sortby_desc'] = 'Pole pro řazení tagů. Platné hodnoty: display, createdon';
$_lang['moregallery.mggettags.sortdir_desc'] = 'Směr řazení tagů. Hodnota "asc" pro vzestupné a "desc" pro sestupné řazení.';
$_lang['moregallery.mggettags.tpl_desc'] = 'Název chunku, který se použije jako šablona pro tagy.';
$_lang['moregallery.mggettags.separator_desc'] = 'Řetězec, který se použije pro oddělené jednotlivých tagů.';
$_lang['moregallery.mggettags.wrappertpl_desc'] = 'Pokud je definován, tak se tento chunk použije jako vnější obal celého výstupu.';
$_lang['moregallery.mggettags.toplaceholder_desc'] = 'Pokud je definován, tak snippet uloží výstup do placeholderu pro pozdější použití.';
$_lang['moregallery.mggettags.totalvar_desc'] = 'Používá se pro getPage stránkování, nastavte placeholder pro celkový počet výsledků.';
$_lang['moregallery.mggettags.limit_desc'] = 'Počet obrazů k načtení v rámci jednoho dotazu.';
$_lang['moregallery.mggettags.offset_desc'] = 'Počet obrázků, které se mají přeskočit v rámci daného dotazu.';
$_lang['moregallery.mggettags.where_desc'] = 'A generic condition to add to the query can be added here, in JSON format. For example {"createdon:>=":1390737600} or {"display:LIKE":"%train%"} ';

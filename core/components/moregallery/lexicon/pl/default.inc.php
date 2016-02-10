<?php
/**
 * Author: Mark Hamstra
 * Last updated: 2013-10-30
 */

$_lang['moregallery'] = 'Galeria MoreGallery';
$_lang['moregallery.new'] = 'Nowy dokument z galerią';
$_lang['moregallery.new_description'] = 'Utwórz nową galerię aby móc wgrywać zdjęcia';
$_lang['moregallery.name'] = 'Dokument z galerią';
$_lang['moregallery.name_here'] = 'Utwórz nowy dokument z galerią';
$_lang['moregallery.please_save_first'] = 'Zapisz nowy dokument, aby móc wgrać zdjęcia do galerii';



$_lang['moregallery.inherit'] = 'Odziedzicz (użyj domyślnych)';
$_lang['moregallery.inherit.desc'] = 'Użyj domyślnych ustawień systemowych.';
$_lang['moregallery.source'] = 'Źródło plików';
$_lang['moregallery.source.desc'] = 'Źródło plików do przechowywania obrazów. <b>Uwaga:</b> Po zmianie źródła plików wcześniej wgrane obrazy nie zostaną automatycznie przeniesione - prosimy zrobić to ręcznie';
$_lang['moregallery.relative_url'] = 'Relatywny URL';
$_lang['moregallery.relative_url.desc'] = 'Relatywny URL do przechowywania obrazów w źródle plików. Ścieżka nie może zaczynać od ukośnika (/).';
$_lang['moregallery.content_position'] = 'Położenie treści';
$_lang['moregallery.content_position.desc'] = 'Przenosi edycję dokumentu do oddzielnej zakładki.';

$_lang['moregallery.content_position.above'] = 'Powyżej obrazów';
$_lang['moregallery.content_position.below'] = 'Poniżej obrazów';
$_lang['moregallery.content_position.tab'] = 'Jako zakładka';
$_lang['moregallery.content_position.hide'] = 'Ukryj';

$_lang['moregallery.view_full_size_image'] = 'Pokaż obraz w pełnych rozmiarach';
$_lang['moregallery.delete_image'] = 'Usuń obraz';
$_lang['moregallery.deactivate_image'] = 'Ukryj obraz z galerii';
$_lang['moregallery.activate_image'] = 'Zaznacz obraz jako widoczny';
$_lang['moregallery.upload_image'] = 'Wgraj obrazy do galerii';
$_lang['moregallery.upload'] = 'Wgraj';
$_lang['moregallery.import_image'] = 'Importuj obrazy z innych źródeł';
$_lang['moregallery.import'] = 'Importuj';
$_lang['moregallery.refresh'] = 'Odśwież';
$_lang['moregallery.drop_to_upload'] = 'Przeciągnij tu obrazy aby wgrać je do galerii';
$_lang['moregallery.images_count'] = 'obrazy/obrazów';
$_lang['moregallery.edit_image_header'] = 'Edytuj obraz';
$_lang['moregallery.name_field'] = 'Nazwa';
$_lang['moregallery.description'] = 'Opis';
$_lang['moregallery.url'] = 'Odnośnik (lub Id)';
$_lang['moregallery.save'] = 'Zapisz';
$_lang['moregallery.saving'] = 'Zapisywanie..';
$_lang['moregallery.saved_at'] = 'Zapisane (w ciągu [[+time]])';
$_lang['moregallery.confirm_remove'] = 'Czy na pewno chcesz usunąć "[[+name]]"? Obraz zostanie usunięty z serwera';
$_lang['moregallery.preupload_very_big'] = 'Plik "[[+file]]" jest bardzo duży. Wgrywanie może zając dużo czasu oraz serwer może nie mieć wystarczającej ilości pamięci aby obsłużyć proces. Czy na pewno chcesz kontynuować?';
$_lang['moregallery.upload_error'] = 'Podczas wgrywania pliku [[+file]] pojawił się błąd: [[+message]]';
$_lang['moregallery.upload_error_huge'] = 'Wgrywany obraz przekracza rozmiar [[+size]]MB. Zmniejsz obraz przed wgrywaniem';
$_lang['moregallery.model_error'] = 'Nieznany błąd. Nie można załadować modelu obrazu. Spróbuj odświeżyć stronę. ';

$_lang['moregallery.error_invalid_resource'] = 'Pojawił się nieoczekiwany błąd. Dokument "[[+resource]]" nie jest Dokumentem z galerią';
$_lang['moregallery.error_loading_source'] = 'Pojawił się błąd podczas ładowania Źródła plików dla tego zasobu';
$_lang['moregallery.error_invalid_filetype'] = 'Sorry, .[[+extension]] files are not allowed.';
$_lang['moregallery.error_upload_failed'] = 'the file could not be uploaded (Error [[+error]]).';

// Tags related, for MoreGallery 1.1
$_lang['moregallery.tags'] = 'Tagi';
$_lang['moregallery.tags.add'] = 'Dodaj';
// Imports, also new in 1.1
$_lang['moregallery.file_doesnt_exist'] = 'Plik "[[+file]]" nie istnieje lub nie da się go odczytać';
$_lang['moregallery.edit_crop'] = 'Edytuj kadr';
$_lang['moregallery.save_crop'] = 'Zapisz kadr';
$_lang['moregallery.preview_crop'] = 'Podgląd kadru';
$_lang['moregallery.processing_crop'] = 'Przetwarzanie...';

/**
 * Settings
 */
$_lang['setting_moregallery.source_relative_url'] = 'URL w obrębie źródła plików';
$_lang['setting_moregallery.source_relative_url_desc'] = 'Ścieżka w obrębie źródła plików zasobu, do której mają być wgrywane pliki.  Wartość ta może być nadpisana w dokumencie galerii w zakładc e ustawienia.';

$_lang['setting_moregallery.source'] = 'Źródło plików';
$_lang['setting_moregallery.source_desc'] = 'Wybierz źródło plików gdzie mają być wgrywane obrazy. Ustawienie może być zmieniane dla każdego dokumentu w zakładce Ustawienia';

$_lang['setting_moregallery.image_id_in_name'] = 'ID obrazu w nazwie pliku';
$_lang['setting_moregallery.image_id_in_name_desc'] = 'Ustaw gdzie ma być dodane ID w nazwie pliku podczas wgrywania (wartość "prefix" lub "suffix"). Dzięki temu nazwa pliku będzie unikalna';
$_lang['setting_moregallery.resource_id_in_path'] = 'ID dokumentu w ścieżce';
$_lang['setting_moregallery.resource_id_in_path_desc'] = 'Gdy aktywne, ID dokumentu będzie dodane do URL w obrębie źródła plików';
$_lang['setting_moregallery.content_position'] = 'Pozycja treści w panelu';
$_lang['setting_moregallery.content_position_desc'] = 'Ustaw "above", "below", "tab" lub "hide" aby zdefiniowac jak ma być wyświetlana treść';
$_lang['setting_moregallery.use_rte_for_images'] = 'Użyj edytora RTE';
$_lang['setting_moregallery.use_rte_for_images_desc'] = 'Aktywuje edytor RTE w polu opis obrazu';
$_lang['setting_moregallery.crops'] = 'Kadrowanie';
$_lang['setting_moregallery.crops_desc'] = 'Insert your Crops configuration here to enable region of interest cropping on images. An example could be <code>small:width=200,height=200,aspect=1|medium:width=500,aspect=0.7</code>. As this is an advanced feature, please refer to the <a href="https://www.modmore.com/extras/moregallery/documentation/crops/" target="_blank">full Crops documentation</a> for more information about syntax and functionality.';
$_lang['setting_moregallery.single_image_url_param'] = 'Parametr URL pojedynczego obrazu ';
$_lang['setting_moregallery.single_image_url_param_desc'] = 'Parametr używany ze snippetem mgGetImages. Określa czy jest wyświetlana lista, czy pojedynczy obraz. Parametr URL będzie zawierał ID obrazu i jeśli nie zostanie odnaleziony,. użytkownik będzie przeniesiony do strony 404';
$_lang['setting_moregallery.add_icon_to_toolbar'] = 'Dodaj ikonę na pasku narzędzi';
$_lang['setting_moregallery.add_icon_to_toolbar_desc'] = 'Gdy aktywne, w pasku narzędzi (lewe menu ) zostanie dodana ikona Nowy dokument z galerią';

$_lang['setting_moregallery.sanitize_replace'] = 'Znak transliteracji';
$_lang['setting_moregallery.sanitize_replace_desc'] = 'Niedozwolone znaki w nazwach plików zostaną zastąpione tym znakiem';
$_lang['setting_moregallery.sanitize_pattern'] = 'Wzór transliteracji';
$_lang['setting_moregallery.sanitize_pattern_desc'] = 'Wzór RegEx do zmiany nazw plików przy wgrywaniu';
$_lang['setting_mgr_tree_icon_mgresource'] = 'Ikonka galerii w drzewie plików';
$_lang['setting_mgr_tree_icon_mgresource_desc'] = 'Klasa ikony Font Awesome dodawana w drzewie plików przed folderem galerii ';

/**
 * Snippet properties
 */

/** mgGetImages */
$_lang['moregallery.mggetimages.cache_desc'] = 'Cache the Gallery output?';
$_lang['moregallery.mggetimages.resource_desc'] = 'Specify a resource ID to get images from.';
$_lang['moregallery.mggetimages.sortby_desc'] = 'The field to sort by. Valid values: filename, name, description, sortorder, uploadedon, editedon';
$_lang['moregallery.mggetimages.sortdir_desc'] = 'The direction to sort images by. This can be "asc" or "desc".';
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
$_lang['moregallery.mggettags.limit_desc'] = 'The number of images to load in the result set.';
$_lang['moregallery.mggettags.offset_desc'] = 'he number of images to skip in the result set.';
$_lang['moregallery.mggettags.where_desc'] = 'A generic condition to add to the query can be added here, in JSON format. For example {"createdon:>=":1390737600} or {"display:LIKE":"%train%"} ';

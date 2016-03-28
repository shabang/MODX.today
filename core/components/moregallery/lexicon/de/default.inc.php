<?php
/**
 * Author: Mark Hamstra
 * Last updated: 2013-10-30
 */

$_lang['moregallery'] = 'Sprache';
$_lang['moregallery.new'] = 'Neue Galerie';
$_lang['moregallery.new_description'] = 'Erstellen Sie eine neue Galerie, um Bilder hochzuladen.';
$_lang['moregallery.name'] = 'Galerie';
$_lang['moregallery.name_here'] = 'Galerie hier erstellen';
$_lang['moregallery.please_save_first'] = 'Um Bilder hochzuladen, speichern Sie die Galerie bitte zuerst. Nachdem Sie sie gespeichert haben können Sie hier Bilder hochladen.';



$_lang['moregallery.inherit'] = 'Vererbt';
$_lang['moregallery.inherit.desc'] = 'Standard-Systemeinstellungen benutzen.';
$_lang['moregallery.source'] = 'Medienquelle';
$_lang['moregallery.source.desc'] = 'Die Medienquelle in der Bilder gespeichert werden sollen. <b>Hinweis:</b> Wenn Sie diese Einstellungen nach dem Hochladen von Bildern ändern, werden bereits hochgeladene Bilder NICHT zum neuen Ort verschoben. Bitte übernehmen Sie das Verschieben selbst.';
$_lang['moregallery.relative_url'] = 'Relative URL';
$_lang['moregallery.relative_url.desc'] = 'Die relative URL (OHNE beginnenden Slash) zur Medienquelle unter der die Bilder gespeichert werden sollen. <b>Hinweis:</b> Wenn Sie diese Einstellungen nach dem Hochladen von Bildern ändern, werden bereits hochgeladene Bilder NICHT zum neuen Ort verschoben. Bitte übernehmen Sie das Verschieben selbst.';
$_lang['moregallery.content_position'] = 'Objekt Position';
$_lang['moregallery.content_position.desc'] = 'Verschieb das Content Feld der Ressource an eine alternative Position.';

$_lang['moregallery.content_position.above'] = 'Über den Bildern';
$_lang['moregallery.content_position.below'] = 'Unter den Bildern';
$_lang['moregallery.content_position.tab'] = 'Im Content Tab';
$_lang['moregallery.content_position.hide'] = 'Versteckt';

$_lang['moregallery.view_full_size_image'] = 'Originalgröße anzeigen';
$_lang['moregallery.delete_image'] = 'Bild löschen';
$_lang['moregallery.deactivate_image'] = 'Bild ausblenden';
$_lang['moregallery.activate_image'] = 'Bild als sichtbar markieren';
$_lang['moregallery.upload_image'] = 'Bilder hochladen';
$_lang['moregallery.upload'] = 'Hochladen';
$_lang['moregallery.import_image'] = 'Bilder aus anderen Quellen importieren';
$_lang['moregallery.import'] = 'Importieren';
$_lang['moregallery.refresh'] = 'Aktualisieren';
$_lang['moregallery.drop_to_upload'] = 'Bilder hier ablegen um sie hochzuladen';
$_lang['moregallery.images_count'] = 'Bilder';
$_lang['moregallery.edit_image_header'] = 'Bild bearbeiten';
$_lang['moregallery.name_field'] = 'Name';
$_lang['moregallery.description'] = 'Beschreibung';
$_lang['moregallery.url'] = 'Url (oder Ressourcen ID)';
$_lang['moregallery.save'] = 'Speichern';
$_lang['moregallery.saving'] = 'Speichere..';
$_lang['moregallery.saved_at'] = 'Gespeichert (um [[+time]])';
$_lang['moregallery.confirm_remove'] = 'Sind Sie sicher, dass Sie "[[+name]]" löschen möchten? Das Bild wird vom Server gelöscht werden.';
$_lang['moregallery.preupload_very_big'] = 'Die Datei "[[+file]]" ist sehr groß. Das Hochladen kann einige Zeit in Anspruch nehmen und der Server könnte nicht genügend Speicher haben, um das Bild nach dem Hochladen zu verarbeiten. Sind Sie sicher das sie fortfahren möchten?';
$_lang['moregallery.upload_error'] = 'Oh oh! Es trat ein Fehler beim Hochladen der Datei [[+file]] auf: [[+message]]';
$_lang['moregallery.upload_error_huge'] = 'Das hochgeladene Bild war über [[+size]]mb groß, was wahrscheinlich zu viel für den Server war. Bitte versuchen Sie das Bild zu verkleinern bevor Sie es hochladen.';
$_lang['moregallery.model_error'] = 'Es trat ein unerwarteter Fehler auf: Das Bild-Modell konnte nicht gefunden werden. Versuchen Sie die Seite neu zu laden.';

$_lang['moregallery.error_invalid_resource'] = 'Es trat ein unerwarteter Fehler auf: Die Ressource "[[+resource]]" ist keine gültige Galerie.';
$_lang['moregallery.error_loading_source'] = 'Es trat ein Fehler beim Laden der Medienquelle auf.';
$_lang['moregallery.error_invalid_filetype'] = 'Entschuldigung, der Dataityp [[+extension]] ist nicht erlaubt.';
$_lang['moregallery.error_upload_failed'] = 'die Datei konnte nicht hochgeladen werden (Fehler [[+ Fehler]]).';

// Tags related, for MoreGallery 1.1
$_lang['moregallery.tags'] = 'Tags';
$_lang['moregallery.tags.add'] = 'Hinzufügen';
// Imports, also new in 1.1
$_lang['moregallery.file_doesnt_exist'] = 'Die zu kopierende Datei existiert nicht oder ist nicht lesbar';
$_lang['moregallery.edit_crop'] = 'Ausschnitt bearbeiten';
$_lang['moregallery.save_crop'] = 'Ausschnitt speichern';
$_lang['moregallery.preview_crop'] = 'Ausschnitt ansehen';
$_lang['moregallery.processing_crop'] = 'Verarbeitung...';

/**
 * Settings
 */
$_lang['setting_moregallery.source_relative_url'] = 'Relative URL zur Quelle';
$_lang['setting_moregallery.source_relative_url_desc'] = 'Die URL relativ zum Root der ausgewählten Medienquelle für Bilder-Uploads. Kann überschrieben werden für jede Galerie im Setting-Tab.';

$_lang['setting_moregallery.source'] = 'Medienquelle';
$_lang['setting_moregallery.source_desc'] = 'Wählen Sie eine Medienquelle, um Bilder zu laden. Kann pro Galerie-Ressource auf der Registerkarte Einstellungen überschrieben werden.';

$_lang['setting_moregallery.image_id_in_name'] = 'Bild-ID im Dateinamen';
$_lang['setting_moregallery.image_id_in_name_desc'] = 'Auf "prefix" oder "suffix" setzen, um beim Upload die Bild-ID zum Dateinamen hinzuzufügen. Dadurch wird sichergestellt, dass der Dateiname eindeutig ist.';
$_lang['setting_moregallery.resource_id_in_path'] = 'ID der Ressource im Pfad';
$_lang['setting_moregallery.resource_id_in_path_desc'] = 'Wenn aktiviert, wird die ID der Galerie-Ressource der Quell-URL hinzugefügt, so dass jede Galerie ihr eigenes Verzeichnis bekommt.';
$_lang['setting_moregallery.content_position'] = 'Position des Content-Felds';
$_lang['setting_moregallery.content_position_desc'] = '"above" (über), "below" (unter), "tab" oder "hide" (ausblenden), um zu bestimmen, wie das Inhaltsfeld angezeigt wird, wenn überhaupt.';
$_lang['setting_moregallery.use_rte_for_images'] = 'Rich-Text-Editor verwenden';
$_lang['setting_moregallery.use_rte_for_images_desc'] = 'Wenn aktiviert, wird der derzeit aktive Richtext-Editor ins Bildbeschreibungsfeld geladen. Wir empfehlen, Redactor zu verwenden, aber andere Editoren werden ebenfalls unterstützt.';
$_lang['setting_moregallery.crops'] = 'Ausschnitte';
$_lang['setting_moregallery.crops_desc'] = 'Fügen Sie hier ihre Beschnitt-Konfiguraton ein, um den Beschnitt um einen interessanten Bereich zu erlauben. Ein Beispiel wäre: <code>small:width=200,height=200,aspect=1|medium:width=500,aspect=0.7</code>. Da es sich um eine eher fortgeschrittene Funktion handelt, lesen Sie bitte die <a href="https://www.modmore.com/extras/moregallery/documentation/crops/" target="_blank">vollständige Dokumentation</a> für mehr Informationen zu Syntax und Funktionalität.';
$_lang['setting_moregallery.single_image_url_param'] = 'Einzelnes Bild-URL-Parameter';
$_lang['setting_moregallery.single_image_url_param_desc'] = 'Wird mit dem mgGetImage snippet verwendet, der einzelne Bild-URL-Parameter bestimmt, ob eine Liste oder ein einzelnes Bild angezeigt wird. Dieser URL-Parameter wird die Bild-ID enthalten und schickt den Betrachter auf die eingestellte 404-Seite, falls diese nicht gefunden wird. ';
$_lang['setting_moregallery.add_icon_to_toolbar'] = 'Icon zur Symbolleiste hinzufügen';
$_lang['setting_moregallery.add_icon_to_toolbar_desc'] = 'Wenn aktiviert, wird ein »Neue Galerie«-Symbol zur Ressourcen-Symbolleiste hinzugefügt, um schnell neue Galerien erzeugen zu können.';

$_lang['setting_moregallery.sanitize_replace'] = 'Sanitize Replacement';
$_lang['setting_moregallery.sanitize_replace_desc'] = 'Any characters in the uploaded filenames that do not match the sanitize pattern will be replaced with this character.';
$_lang['setting_moregallery.sanitize_pattern'] = 'Desinfizieren Muster';
$_lang['setting_moregallery.sanitize_pattern_desc'] = 'A RegEx pattern for cleaning up filenames on upload.';
$_lang['setting_moregallery.crop_jpeg_quality'] = 'JPEG Crop Quality';
$_lang['setting_moregallery.crop_jpeg_quality_desc'] = 'For JPEG images you can control the quality of the thumbnails being generated by specifying a number between 0 and 100.';
$_lang['setting_moregallery.thumbnail_format'] = 'Manager Thumbnail Format';
$_lang['setting_moregallery.thumbnail_format_desc'] = 'Set the format (png, gif or jpg) that is used for thumbnails in the manager (mgr_thumb). This does not affect image cropping; those will use the same format as the original image.';
$_lang['setting_moregallery.prefill_from_iptc'] = 'Prefill from IPTC';
$_lang['setting_moregallery.prefill_from_iptc_desc'] = 'When enabled the image will automatically populate the name, description and tags with information stored in the image.';


$_lang['setting_moregallery.translit'] = "Transliteration";
$_lang['setting_moregallery.translit_desc'] = "When set to a value that is not \"none\" or empty, this will enable transliteration prior to the sanitization process, enabling translating of invalid characters to valid ones. If this value is empty, it will inherit from the core \"friendly_alias_translit\" setting.";

$_lang['setting_moregallery.translit_class'] = "Translit-Klasse";
$_lang['setting_moregallery.translit_class_desc'] = "The name of the class to use for transliteration. If this value is empty, it will inherit from the core \"friendly_alias_translit_class\" setting.";
$_lang['setting_moregallery.translit_class_path'] = "Translit Class Path";
$_lang['setting_moregallery.translit_class_path_desc'] = "The path to the class to use for transliteration. If this value is empty, it will inherit from the core \"friendly_alias_translit_class_path\" setting.";
$_lang['setting_moregallery.custom_fields'] = "Benutzerdefinierte Felder";
$_lang['setting_moregallery.custom_fields_desc'] = "Allows you to add additional options to the image edit modal. This setting requires a JSON object. For more information about how custom fields are defined and used, please <a href=\"https://www.modmore.com/moregallery/documentation/custom-fields/\">read the documentation here</a>.";

$_lang['setting_mgr_tree_icon_mgresource'] = 'Galerie-Baum-Icon';
$_lang['setting_mgr_tree_icon_mgresource_desc'] = 'The Font Awesome icon class to add to MoreGallery Resources in the file tree. ';

/**
 * Snippet properties
 */

/** mgGetImages */
$_lang['moregallery.mggetimages.cache_desc'] = 'Sollen die bisher angezeigten Bilder im Cache zwischengespeichert werden?';
$_lang['moregallery.mggetimages.resource_desc'] = 'Bitte legen sie eine Quelle fest um Bilder anzuzeigen.';
$_lang['moregallery.mggetimages.sortby_desc'] = 'Das Feld zum Sortieren von. Gültige Werte: Dateiname, Name, Einzelheiten, Sortierreihenfolge, Hochgeladen auf, Bearbeitet auf';
$_lang['moregallery.mggetimages.sortdir_desc'] = 'Die Richtung, in der Bilder sortiert werden. Dies kann "Asc" (aufsteigend) bzw. "Desc" (absteigend) sein.';
$_lang['moregallery.mggetimages.tags_desc'] = 'Eine kommagetrennte Liste von Tag-Namen oder IDs, nach der die Bildern gefiltert wird.';
$_lang['moregallery.mggetimages.tagsfromurl_desc'] = 'Fügen sie den Namen eines URL parameters hinzu um die Suche einzuschränken.';
$_lang['moregallery.mggetimages.getresourcefields_desc'] = 'When enabled, resource fields will be loaded into the image template.';
$_lang['moregallery.mggetimages.getresourcetvs_desc'] = 'Provide a comma separated list of TV names to load into the image template.';
$_lang['moregallery.mggetimages.tagtpl_desc'] = 'The name of a Chunk to load for templating tags.';
$_lang['moregallery.mggetimages.imagetpl_desc'] = 'The name of a Chunk to load for templating images.';
$_lang['moregallery.mggetimages.singleimageenabled_desc'] = 'When set to 1, the snippet will respond to requests with the singleImageParam URL property by showing the single image view.';
$_lang['moregallery.mggetimages.singleimagetpl_desc'] = 'The name of a Chunk to load when viewing the special one-image view.';
$_lang['moregallery.mggetimages.singleimageparam_desc'] = 'Can be used to override the moregallery.single_image_url_param system setting per snippet call. Useful if you show multiple galleries on the same page.';
$_lang['moregallery.mggetimages.tagseparator_desc'] = 'A string to separate tag templates with for each of the images.';
$_lang['moregallery.mggetimages.imageseparator_desc'] = 'A string to separate image templates with in gallery view.';
$_lang['moregallery.mggetimages.wrappertpl_desc'] = 'When not empty, the specified Chunk will be used to wrap the entire output in.';
$_lang['moregallery.mggetimages.wrapperifempty_desc'] = 'Set to 0 to only use the wrapperTpl if there is at least 1 result. When set to 1 it will always use the wrapperTpl, even without results.';
$_lang['moregallery.mggetimages.toplaceholder_desc'] = 'When not empty, the snippet will set a placeholder with the output and will not output content directly.';
$_lang['moregallery.mggetimages.totalvar_desc'] = 'Used for getPage pagination, set this to a placeholder to set for the total number of results.';
$_lang['moregallery.mggetimages.limit_desc'] = 'The number of images to load in the result set.';
$_lang['moregallery.mggetimages.offset_desc'] = 'he number of images to skip in the result set.';
$_lang['moregallery.mggetimages.scheme_desc'] = 'The scheme to use in generating URLs; defaults to the value of the link_tag_scheme value.';
$_lang['moregallery.mggetimages.where_desc'] = 'A generic condition to add to the query can be added here, in JSON format. For example {"uploadedby":4} or {"name:LIKE":"%train%"} ';

/** mgGetTags */
$_lang['moregallery.mggettags.cache_desc_desc'] = 'Die Tag-Ausgabe cachen?';
$_lang['moregallery.mggettags.resource_desc'] = 'Specify a resource ID to get tags from.';
$_lang['moregallery.mggettags.sortby_desc'] = 'The field to sort by. Valid values: display, createdon';
$_lang['moregallery.mggettags.sortdir_desc'] = 'The direction to sort tags by. This can be "asc" or "desc".';
$_lang['moregallery.mggettags.tpl_desc'] = 'The name of a Chunk to load for templating tags.';
$_lang['moregallery.mggettags.separator_desc'] = 'Text, um Tags durch.';
$_lang['moregallery.mggettags.wrappertpl_desc'] = 'When not empty, the specified Chunk will be used to wrap the entire output in.';
$_lang['moregallery.mggettags.wrapperifempty_desc'] = 'Set to 0 to only use the wrapperTpl if there is at least 1 result. When set to 1 it will always use the wrapperTpl, even without results.';
$_lang['moregallery.mggettags.toplaceholder_desc'] = 'When not empty, the snippet will set a placeholder with the output and will not output content directly.';
$_lang['moregallery.mggettags.includecount_desc'] = 'When set to 1 the [[+image_count]] placeholder will contain the number of active images that are using this tag.';
$_lang['moregallery.mggettags.totalvar_desc'] = 'Used for getPage pagination, set this to a placeholder to set for the total number of results.';
$_lang['moregallery.mggettags.limit_desc'] = 'The number of images to load in the result set.';
$_lang['moregallery.mggettags.offset_desc'] = 'he number of images to skip in the result set.';
$_lang['moregallery.mggettags.where_desc'] = 'A generic condition to add to the query can be added here, in JSON format. For example {"createdon:>=":1390737600} or {"display:LIKE":"%train%"} ';

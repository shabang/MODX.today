<?php
/**
 * Author: Mark Hamstra
 * Last updated: 2013-10-30
 */

$_lang['moregallery'] = 'moreGallery';
$_lang['moregallery.new'] = 'Nouvelle galerie';
$_lang['moregallery.new_description'] = 'Créer une nouvelle galerie pour ajouter des images.';
$_lang['moregallery.name'] = 'Galerie';
$_lang['moregallery.name_here'] = 'Créer une nouvelle galerie ici';
$_lang['moregallery.please_save_first'] = 'Veuillez enregistrer la ressource pour commencer à ajouter des images. ';



$_lang['moregallery.inherit'] = 'Hériter';
$_lang['moregallery.inherit.desc'] = 'Utiliser les valeurs par défaut du système.';
$_lang['moregallery.source'] = 'Media Source';
$_lang['moregallery.source.desc'] = 'Le media source à utiliser pour stocker les images. <b>Note:</b> Si vous changez de media source après avoir ajouté des images, celles-ci ne seront PAS automatiquement déplacées vers le nouveau media source.';
$_lang['moregallery.relative_url'] = 'URL relative';
$_lang['moregallery.relative_url.desc'] = 'L\'URL relative utilisée pour stocker les images dans le media source. Ne commence pas par un slash. <b>Note:</b> Si vous changez ce paramètre après avoir ajouté des images, celles-ci ne seront PAS automatiquement déplacées vers le nouveau media source.';
$_lang['moregallery.content_position'] = 'Position du contenu';
$_lang['moregallery.content_position.desc'] = 'Déplacer le champ de contenu de la ressource vers un endroit plus approprié.';

$_lang['moregallery.content_position.above'] = 'Au dessus des images';
$_lang['moregallery.content_position.below'] = 'En dessous des images';
$_lang['moregallery.content_position.tab'] = 'Dans l\'onglet contenu';
$_lang['moregallery.content_position.hide'] = 'Masquer';

$_lang['moregallery.view_full_size_image'] = 'Voir en taille réelle';
$_lang['moregallery.delete_image'] = 'Supprimer l\'image';
$_lang['moregallery.deactivate_image'] = 'Masquer l\'image de la Galerie';
$_lang['moregallery.activate_image'] = 'Marquer l\'image comme visible';
$_lang['moregallery.upload_image'] = 'Uploader des images à la galerie';
$_lang['moregallery.upload'] = 'Envoyer';
$_lang['moregallery.import_image'] = 'Importer des images depuis d\'autres sources';
$_lang['moregallery.import'] = 'Importer';
$_lang['moregallery.refresh'] = 'Rafraîchir';
$_lang['moregallery.drop_to_upload'] = 'Déposez des Images pour les ajouter à la Galerie';
$_lang['moregallery.images_count'] = 'images';
$_lang['moregallery.edit_image_header'] = 'Éditer l\'image';
$_lang['moregallery.name_field'] = 'Nom';
$_lang['moregallery.description'] = 'Description';
$_lang['moregallery.url'] = 'URL (ou ID de resource)';
$_lang['moregallery.save'] = 'Enregistrer';
$_lang['moregallery.saving'] = 'Enregistrement..';
$_lang['moregallery.saved_at'] = 'Enregistré (à [[+time]])';
$_lang['moregallery.confirm_remove'] = 'Êtes-vous sûr de vouloir supprimer "[[+name]]" ? L\'image sera supprimée du serveur.';
$_lang['moregallery.preupload_very_big'] = 'Le fichier "[[+file]]" est volumineux. L\'upload peut prendre un certain temps. Il se peut également que le serveur n\'ai pas assez de mémoire pour traiter le fichier après l\'upload. Êtes-vous sûr de vouloir continuer ?';
$_lang['moregallery.upload_error'] = 'Oh oh, une erreur est survenue lors de l\'upload de [[+file]]: [[+message]]';
$_lang['moregallery.upload_error_huge'] = 'Le poids de l\'image est supérieur à [[+size]]mb, ce qui est peut-être trop volumineux pour que le serveur puisse recevoir et traiter l\'image. Essayez de redimenssionner l\'image avant de retenter.';
$_lang['moregallery.model_error'] = 'Une erreur est survenue, le modèle d\'image n\'a pu être trouvé. Veuillez actualiser la page.';

$_lang['moregallery.error_invalid_resource'] = 'Une erreur est survenue, la ressource "[[+resource]]" n\'est pas une galerie valide.';
$_lang['moregallery.error_loading_source'] = 'Une erreur est survenue lors du chargement du media source de cette galerie.';
$_lang['moregallery.error_invalid_filetype'] = 'Sorry, .[[+extension]] files are not allowed.';
$_lang['moregallery.error_upload_failed'] = 'the file could not be uploaded (Error [[+error]]).';

// Tags related, for MoreGallery 1.1
$_lang['moregallery.tags'] = 'Tags';
$_lang['moregallery.tags.add'] = 'Ajouter';
// Imports, also new in 1.1
$_lang['moregallery.file_doesnt_exist'] = 'Le fichier à importer ne semble pas exister, ou n\'est pas lisible: [[+file]]';
$_lang['moregallery.edit_crop'] = 'Recadrer';
$_lang['moregallery.save_crop'] = 'Enregistrer le recadrage';
$_lang['moregallery.preview_crop'] = 'Aperçu du recadrage';
$_lang['moregallery.processing_crop'] = 'En cours...';

/**
 * Settings
 */
$_lang['setting_moregallery.source_relative_url'] = 'URL relative à la Source';
$_lang['setting_moregallery.source_relative_url_desc'] = 'L\'URL relative au Media Source sélectionné. Peut être défini par ressource, dans l\'onglet "Paramètres".';

$_lang['setting_moregallery.source'] = 'Media Source';
$_lang['setting_moregallery.source_desc'] = 'Sélectionnez le Media Source à utiliser pour uploader les images. Peut être défini par ressource, dans l\'onglet "Paramètres".';

$_lang['setting_moregallery.image_id_in_name'] = 'ID de l\'image dans le nom de fichier';
$_lang['setting_moregallery.image_id_in_name_desc'] = 'Indiquez "prefix" ou "suffix" pour ajouter l\'ID de l\'image dans son nom de fichier, lors de l\'upload. Cela vous permet d\'être certain que le nom de l\'image est unique.';
$_lang['setting_moregallery.resource_id_in_path'] = 'Resource ID in Path';
$_lang['setting_moregallery.resource_id_in_path_desc'] = 'When enabled, the Gallery Resource ID will be suffixed to the Source Relative URL so each gallery has its own directory.';
$_lang['setting_moregallery.content_position'] = 'Position du contenu';
$_lang['setting_moregallery.content_position_desc'] = 'Indiquez "above" (au dessus), "below" (en dessous), "tab" (dans un onglet) ou "hide" (masqué) pour définir comment le champ de contenu sera affiché.';
$_lang['setting_moregallery.use_rte_for_images'] = 'Utilisez l\'éditeur de texte enrichi';
$_lang['setting_moregallery.use_rte_for_images_desc'] = 'Activez cette option pour que l\'éditeur de texte enrichi soit utilisé pour le champ de description de l\'image. Nous recommandons l\'utilisation de Redactor, mais d\'autres éditeurs sont également supportés.';
$_lang['setting_moregallery.crops'] = 'Crops';
$_lang['setting_moregallery.crops_desc'] = 'Insert your Crops configuration here to enable region of interest cropping on images. An example could be <code>small:width=200,height=200,aspect=1|medium:width=500,aspect=0.7</code>. As this is an advanced feature, please refer to the <a href="https://www.modmore.com/extras/moregallery/documentation/crops/" target="_blank">full Crops documentation</a> for more information about syntax and functionality.';
$_lang['setting_moregallery.single_image_url_param'] = 'Single Image URL Parameter';
$_lang['setting_moregallery.single_image_url_param_desc'] = 'Used with the mgGetImages snippet, the single image url parameter determines whether a listing or single image is displayed. This URL parameter will contain the image ID and, if not found, it will send the user to the configured 404 page. ';
$_lang['setting_moregallery.add_icon_to_toolbar'] = 'Ajouter l\'icône à la barre d\'outils';
$_lang['setting_moregallery.add_icon_to_toolbar_desc'] = 'Activez cette option pour qu\'une icône "Nouvelle Galerie" soit ajoutée à la barre d\'outils des ressources, donnant un accès rapide à la création de nouvelle galeries.';

$_lang['setting_moregallery.sanitize_replace'] = 'Sanitize Replacement';
$_lang['setting_moregallery.sanitize_replace_desc'] = 'Any characters in the uploaded filenames that do not match the sanitize pattern will be replaced with this character.';
$_lang['setting_moregallery.sanitize_pattern'] = 'Sanitize Pattern';
$_lang['setting_moregallery.sanitize_pattern_desc'] = 'A RegEx pattern for cleaning up filenames on upload.';
$_lang['setting_mgr_tree_icon_mgresource'] = 'Icône de Gallerie';
$_lang['setting_mgr_tree_icon_mgresource_desc'] = 'La classe CSS de Font Awesome à utiliser comme icône des ressources MoreGallery, dans l\'arborescence. ';

/**
 * Snippet properties
 */

/** mgGetImages */
$_lang['moregallery.mggetimages.cache_desc'] = 'Mettre en cache l\'affichage de la Galerie ?';
$_lang['moregallery.mggetimages.resource_desc'] = 'Indiquez un ID de ressource depuis laquelle obtenir les images.';
$_lang['moregallery.mggetimages.sortby_desc'] = 'Le champ sur lequel Trier. Les valeurs valides : filename, name, description, sortorder, uploadedon, editedon';
$_lang['moregallery.mggetimages.sortdir_desc'] = 'La direction dans laquelle trier les images. Cela peut être « asc » ou « desc ».';
$_lang['moregallery.mggetimages.tags_desc'] = 'Une liste, séparée par des virgules, de noms de tags ou d\'ID, utilisée pour filtrer les images.';
$_lang['moregallery.mggetimages.tagsfromurl_desc'] = 'Indiquez le nom du paramètre d\'URL à utiliser pour filtrer par tags.';
$_lang['moregallery.mggetimages.getresourcefields_desc'] = 'Activez cette option pour les champs de la ressource soient chargés dans le modèle de l\'image.';
$_lang['moregallery.mggetimages.getresourcetvs_desc'] = 'Indiquez une liste, séparée par des virgules, de noms de TV à charger dans le modèle de l\'image.';
$_lang['moregallery.mggetimages.tagtpl_desc'] = 'Le nom du chunk à charger pour mettre en page/formatter les tags.';
$_lang['moregallery.mggetimages.imagetpl_desc'] = 'Le nom du chunk à charger pour mettre en page/formater les images.';
$_lang['moregallery.mggetimages.singleimagetpl_desc'] = 'Le nom du chunk à charger pour afficher la vue spéciale "image seule".';
$_lang['moregallery.mggetimages.tagseparator_desc'] = 'Une chaîne de caractère(s) à utiliser pour séparer les tags des modèles, pour chacune des images.';
$_lang['moregallery.mggetimages.imageseparator_desc'] = 'Une chaîne de caractère(s) à utiliser pour séparer les modèles d\'image dans la "vue galerie".';
$_lang['moregallery.mggetimages.wrappertpl_desc'] = 'Indiquez un nom de chunk (optionnel) à utiliser pour envelopper l\'affichage complet.';
$_lang['moregallery.mggetimages.toplaceholder_desc'] = 'Lorsque cette option est définie, le snippet ajoutera l\'affichage complet du contenu dans un placeholder, au lieu de le retourner.';
$_lang['moregallery.mggetimages.totalvar_desc'] = 'Indiquez le placeholder dans lequel insérer le nombre total de résultats, afin de l\'utiliser avec la pagination de getPage.';
$_lang['moregallery.mggetimages.limit_desc'] = 'Le nombre d\'images à charger dans le jeu de résultats.';
$_lang['moregallery.mggetimages.offset_desc'] = 'Le nombre de résultats à omettre dans le jeu de résultats.';
$_lang['moregallery.mggetimages.scheme_desc'] = 'Le schéma à utiliser pour générer les URLs; par défaut, la valeur de link_tag_scheme est utilisée.';
$_lang['moregallery.mggetimages.where_desc'] = 'A generic condition to add to the query can be added here, in JSON format. For example {"uploadedby":4} or {"name:LIKE":"%train%"} ';

/** mgGetTags */
$_lang['moregallery.mggettags.cache_desc_desc'] = 'Mettre en cache le tag ?';
$_lang['moregallery.mggettags.resource_desc'] = 'Indiquez un ID de ressource depuis laquelle obtenir les tags.';
$_lang['moregallery.mggettags.sortby_desc'] = 'Le champ à utiliser pour le classement. Les valeurs valides sont : display, createdon';
$_lang['moregallery.mggettags.sortdir_desc'] = 'La direction dans laquelle classer les tags. Les valeurs valides sont "asc" ou "desc".';
$_lang['moregallery.mggettags.tpl_desc'] = 'Le nom du chunk à charger pour mettre le forme les tags.';
$_lang['moregallery.mggettags.separator_desc'] = 'Le caractère à utiliser pour séparer les tags.';
$_lang['moregallery.mggettags.wrappertpl_desc'] = 'Indiquez un nom de chunk (optionnel) à utiliser pour envelopper l\'affichage complet.';
$_lang['moregallery.mggettags.toplaceholder_desc'] = 'Lorsque cette option est définie, le snippet ajoutera l\'affichage complet du contenu dans un placeholder, au lieu de le retourner.';
$_lang['moregallery.mggettags.totalvar_desc'] = 'Indiquez le placeholder dans lequel insérer le nombre total de résultats, afin de l\'utiliser avec la pagination de getPage.';
$_lang['moregallery.mggettags.limit_desc'] = 'Le nombre d\'images à charger dans le jeu de résultats.';
$_lang['moregallery.mggettags.offset_desc'] = 'Le nombre de résultats à omettre dans le jeu de résultats.';
$_lang['moregallery.mggettags.where_desc'] = 'A generic condition to add to the query can be added here, in JSON format. For example {"createdon:>=":1390737600} or {"display:LIKE":"%train%"} ';

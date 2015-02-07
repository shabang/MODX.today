<?php
/**
 * Default Language file for Redactor
 *
 * @package redactor
 * @subpackage lexicon
 */

$_lang['setting_redactor'] = 'Redactor';

$_lang['setting_area_general'] = 'Paramètres généraux';

$_lang['setting_redactor.air'] = 'Air-Mode';
$_lang['setting_redactor.air_desc'] = 'Activer le mode "air"';

$_lang['setting_redactor.autoresize'] = 'Agrandissement automatique';
$_lang['setting_redactor.autoresize_desc'] = 'Cette option active l\'agrandisssement automatique, en fonction de la quantité de texe inséré';

$_lang['setting_redactor.linkAnchor'] = 'Ancres (liens)';
$_lang['setting_redactor.linkAnchor_desc'] = 'Activez cette option pour que la modale <em>insérer un lien</em> ai un onglet permettant d\'ajouter des ancres.';

$_lang['setting_redactor.linkEmail'] = 'Emails (liens)';
$_lang['setting_redactor.linkEmail_desc'] = 'Activez cette option pour la modale <em>insérer un lien</em> ai un onglet permattant d\'ajouter des liens <code>mailto:</code>.';

$_lang['setting_redactor.linkResource'] = 'Ressources (liens)';
$_lang['setting_redactor.linkResource_desc'] = 'Activez cette option pour la modale <em>insérer un lien</em> ai un onglet permattant d\'ajouter des liens vers des ressources MODX.';

$_lang['setting_redactor.minHeight'] = 'Hauteur minimale';
$_lang['setting_redactor.minHeight_desc'] = 'La hauteur minimale (ie pixels)';

$_lang['setting_redactor.modalOverlay'] = 'Superposition';
$_lang['setting_redactor.modalOverlay_desc'] = 'Activez cette option pour qu\'un "overlay" empêche les clics sur les éléments autres que ceux de Redactor, lorsqu\'une modale est ouverte (liens, uploads, etc.)';

$_lang['setting_redactor.placeholder'] = 'Placeholder';
$_lang['setting_redactor.placeholder_desc'] = 'Lorsque la valeur de cette option est différente de 0, cette valeur sera affichée si le contenu de l\'éditeur est vide.';

$_lang['setting_redactor.shortcuts'] = 'Raccourcis';
$_lang['setting_redactor.shortcuts_desc'] = 'Activez-désactivez les raccourcis clavier haut/bas';

$_lang['setting_redactor.tabindex'] = 'Index de tabulation';
$_lang['setting_redactor.tabindex_desc'] = 'Optional tab index';

$_lang['setting_redactor.visual'] = 'Visuel';
$_lang['setting_redactor.visual_desc'] = 'Activez cette option pour que l\'éditeur démarre en mode "visual" (avec la barre d\'outils). Désactivez cette option pour démarrer avec le code HTML (très utile en tant que paramètre utilisateur!)';

$_lang['setting_redactor.wym'] = 'WYM';
$_lang['setting_redactor.wym_desc'] = 'Activer la structure visuelle';

$_lang['setting_redactor.direction'] = 'Direction';
$_lang['setting_redactor.direction_desc'] = 'Indiquez le sens du texte (ltr pour gauche à droite ou rtl droite à gauche)';

$_lang['setting_redactor.lang'] = 'Langue';
$_lang['setting_redactor.lang_desc'] = 'Paramètre de langue de Redactor';

$_lang['setting_redactor.allowedTags'] = 'Tags autorisés';
$_lang['setting_redactor.allowedTags_desc'] = 'Liste de tags, séparés par des virgules, de tags HTML autorisés';

$_lang['setting_redactor.boldTag'] = 'Tag Bold (gras)';
$_lang['setting_redactor.boldTag_desc'] = 'Le tag HTML à utiliser pour les éléments en gras. Soit <code>b</code> ou <code>strong</code>.';

$_lang['setting_redactor.cleanup'] = 'Nettoyage';
$_lang['setting_redactor.cleanup_desc'] = 'Active/désactive le "nettoyage" du texte lors d\'un copier-coller';

$_lang['setting_redactor.convertDivs'] = 'Convertir les divs';
$_lang['setting_redactor.convertDivs_desc'] = 'Activez cette option pour que Redactor convertisse les divs en paragraphes';

$_lang['setting_redactor.convertLinks'] = 'Convertir les liens';
$_lang['setting_redactor.convertLinks_desc'] = 'Activez cette option pour que Redactor convertisse les URLs par des liens hypertextes';

$_lang['setting_redactor.deniedTags'] = 'Tags interdits';
$_lang['setting_redactor.deniedTags_desc'] = 'Vous pouvez utiliser le paramètre "Tags autorisés" ou les "Tags interdits", mais pas les deux simultanément! En utilisant cette option, vous pouvez définir les tags non autorisés dans le code source.';

$_lang['setting_redactor.formattingPre'] = 'Mise en forme dans les balises "pre"';
$_lang['setting_redactor.formattingPre_desc'] = 'Activez ce paramètre pour pouvoir utiliser les options de formatage (tels que gras, italique, etc.) à l\'intérieur des balises <code>&lt;pre&gt;</code>.';

$_lang['setting_redactor.italicTag'] = 'Tag italique';
$_lang['setting_redactor.italicTag_desc'] = 'Le tag HTML à utiliser pour les éléments en italique. Soit <code>i</code> ou <code>em</code>.';

$_lang['setting_redactor.linebreaks'] = 'Retour à la ligne';
$_lang['setting_redactor.linebreaks_desc'] = 'Activez cette option pour que les retours à la ligne soient <code>&lt;br&gt;</code> au lieu de nouveaux paragraphes. Notez qu\'activer cette option désactivera le mode <code>Paragraphe</code>.';

$_lang['setting_redactor.marginFloatLeft'] = 'Float Left Margin';
$_lang['setting_redactor.marginFloatLeft_desc'] = 'Marge (margin) ou classe CSS à utiliser sur les images flottantes à gauche (float left)';

$_lang['setting_redactor.marginFloatRight'] = 'Float Right Margin';
$_lang['setting_redactor.marginFloatRight_desc'] = 'Marge (margin) ou classe CSS à utiliser sur les images flottantes à droite (float right)';

$_lang['setting_redactor.paragraphy'] = 'Paragraphe';
$_lang['setting_redactor.paragraphy_desc'] = 'Activez cette option pour chaque nouvel élément soit inséré à l\'intérieur de tags <code>&lt;p&gt;</code> (paragraphes). Notez que si vous activez le mode <code>Retour à la ligne</code>, cette option sera désactivée.';

$_lang['setting_redactor.css'] = 'CSS iframe';
$_lang['setting_redactor.css_desc'] = 'URL du fichier CSS à utiliser avec l\'iframe';

$_lang['setting_redactor.iframe'] = 'iframe';
$_lang['setting_redactor.iframe_desc'] = 'Option pour utiliser l\'éditeur dans une iframe avec des styles personnalisés';

$_lang['setting_redactor.linkProtocol'] = 'Protocole';
$_lang['setting_redactor.linkProtocol_desc'] = 'Cette option permet d\'indiquer le protocale à ajouter aux liens (http://,https://). Laissez vide pour ne pas ajouter de protocole';

$_lang['setting_redactor.mobile'] = 'Mobile';
$_lang['setting_redactor.mobile_desc'] = 'Cette option active/désactive l\'éditeur pour mobile';

$_lang['setting_redactor.observeImages'] = 'Images actives';
$_lang['setting_redactor.observeImages_desc'] = 'Activez ou désactiver la possibiblité de cliquer sur une image pour afficher la fenêtre de paramètres de l\'image';

$_lang['setting_redactor.browse_recursive'] = 'Navigation récursive';
$_lang['setting_redactor.browse_recursive_desc'] = 'Activez cette option pour ajouter un dropdown (menu déroulant) pour sélectionner les sous répertoires lors de la navigation au sein des fichiers.';

$_lang['setting_redactor.date_files'] = 'Dates de fichiers';
$_lang['setting_redactor.date_files_desc'] = 'Activez cette option pour que les fichiers uploadés soient préfixés avec le timestamp complet, afin de garantir des noms de fichiers uniques.';

$_lang['setting_redactor.date_images'] = 'Dater les images';
$_lang['setting_redactor.date_images_desc'] = 'Activez cette option pour vous assurer que les fichiers d\'images uploadées seront uniques';

$_lang['setting_redactor.file_upload_path'] = 'Chemin des uploads';
$_lang['setting_redactor.file_upload_path_desc'] = 'Le chemin, relatif au media source défini dans le paramètre <code>Media Source</code>, dans lequel les fichiers seront uploadés. Vous pouvez utiliser les placeholders suivants (mais pas "d\'output filters" SVP) :
    <ul>
        <li><code>&#91;&#91;+year&#93;&#93;</code> les 4 chiffres de l\'année courrante.</li>
        <li><code>&#91;&#91;+month&#93;&#93;</code> les 2 chiffres du mois actuel</li>
        <li><code>&#91;&#91;+day&#93;&#93;</code> les 2 chiffres du jour actuel</li>
        <li><code>&#91;&#91;+user&#93;&#93;</code> l\'ID de l\'utilisateur actuellement connecté.</li>
        <li><code>&#91;&#91;+username&#93;&#93;</code> le nom d\'utilisateur de l\'utilisateur actuellement connecté.</li>
    </ul>
    Veuillez également regarder du côté des paramètres <code>Chemin des images</code>, <code>Media Source</code> et de <a href="https://www.modmore.com/extras/redactor/documentation/media-sources/">Using Media Sources with Redactor</a> [en]';

$_lang['setting_redactor.image_upload_path'] = 'Chemin d\'upload des images';
$_lang['setting_redactor.image_upload_path_desc'] = 'Chemin vers lequel uploader les images et depuis lequel choisir les images';
    
$_lang['setting_redactor.file_upload_path'] = 'Chemin des uploads';
$_lang['setting_redactor.file_upload_path_desc'] = 'Le chemin, relatif au media source défini dans le paramètre <code>Media Source</code>, dans lequel les fichiers seront uploadés. Vous pouvez utiliser les placeholders suivants (mais pas "d\'output filters" SVP) :
    <ul>
        <li><code>&#91;&#91;+year&#93;&#93;</code> les 4 chiffres de l\'année courrante.</li>
        <li><code>&#91;&#91;+month&#93;&#93;</code> les 2 chiffres du mois actuel</li>
        <li><code>&#91;&#91;+day&#93;&#93;</code> les 2 chiffres du jour actuel</li>
        <li><code>&#91;&#91;+user&#93;&#93;</code> l\'ID de l\'utilisateur actuellement connecté.</li>
        <li><code>&#91;&#91;+username&#93;&#93;</code> le nom d\'utilisateur de l\'utilisateur actuellement connecté.</li>
    </ul>
    Veuillez également regarder du côté des paramètres <code>Chemin des images</code>, <code>Media Source</code> et de <a href="https://www.modmore.com/extras/redactor/documentation/media-sources/">Using Media Sources with Redactor</a> [en]';

$_lang['setting_redactor.mediasource'] = 'Media Source';
$_lang['setting_redactor.mediasource_desc'] = 'Media Source à utiliser pour uploader les images et depuis laquelle choisir les images';

$_lang['setting_redactor.prefetch_ttl'] = 'TTL de prefetch';
$_lang['setting_redactor.prefetch_ttl_desc'] = 'Durée (en millisecondes) durant laquelle les données récupérer de la pré-saisie (typeadead) doivent être mises en cache (localStorage)';

$_lang['setting_redactor.typeahead.include_introtext'] = 'Inclure Introtext';
$_lang['setting_redactor.typeahead.include_introtext_desc'] = 'Activez cette option pour le "typeahead" conienne également les champs "introtext" de chaque ressource, vous donnant plus d\'informations concernant les ressources.';

$_lang['setting_redactor.airButtons'] = 'Buttons du mode "air"';
$_lang['setting_redactor.airButtons_desc'] = 'Liste de boutons, séparés par des virgules, à afficher en mode "air"';

$_lang['setting_redactor.buttonSource'] = 'Bouton Source';
$_lang['setting_redactor.buttonSource_desc'] = 'Désactivez cette option pour que le bouton de code source (<code>html</code> dans la configuration des boutons) soit supprimé.';

$_lang['setting_redactor.buttons'] = 'Bouttons';
$_lang['setting_redactor.buttons_desc'] = 'Liste de boutons, séparés par des virgules, à afficher dans la barre d\'outils';

$_lang['setting_redactor.colors'] = 'Couleurs';
$_lang['setting_redactor.colors_desc'] = 'Liste de couleurs, séparées par des virgules';

$_lang['setting_redactor.formattingTags'] = 'Tags de style';
$_lang['setting_redactor.formattingTags_desc'] = 'Configurez les éléments affichés dans le menu de style';

$_lang['setting_redactor.browse_recursive'] = 'Navigation récursive';
$_lang['setting_redactor.browse_recursive_desc'] = 'Activez cette option pour ajouter un dropdown (menu déroulant) pour sélectionner les sous répertoires lors de la navigation au sein des fichiers.';

$_lang['setting_redactor.image_browse_path'] = 'Chemin de navigation au sein des images';
$_lang['setting_redactor.image_browse_path_desc'] = 'Le chemin à utiliser lors de la navigation/choix des images, relatif à la racine du media source défini dans le paramètre <code>Media Source</code> (utilisé dans la modale d\'insertion d\'image).';

$_lang['setting_redactor.buttonFullScreen'] = 'Bouton plein écran (fullscreen)';
$_lang['setting_redactor.buttonFullScreen_desc'] = 'Activez cette option pour afficher un bouton "plein écran" sur la droite de la barre d\'outils.';

$_lang['setting_redactor.dynamicThumbs'] = 'Thumbs (vignettes) dynamiques';
$_lang['setting_redactor.dynamicThumbs_desc'] = 'Désactivez cette option pour que les images originales soient affichées lors de la navigation au sein des images (au lieu des miniatures).';

$_lang['setting_redactor.displayImageNames'] = 'Afficher les noms d\'images';
$_lang['setting_redactor.displayImageNames_desc'] = 'Activez cette option pour que les noms des images soient affichés lors de la navigation au sein des images.';

$_lang['setting_redactor.cleanFileNames'] = 'Nettoyage des noms de fichiers';
$_lang['setting_redactor.cleanFileNames_desc'] = 'Activez cette option pour que les caractères spéciaux soient supprimés lors de l\'upload des fichiers.';

$_lang['setting_redactor.file_browse_path'] = 'Chemin de navigation au sein des fichiers';
$_lang['setting_redactor.file_browse_path_desc'] = 'Le chemin à utiliser lors de la navigation/choix des fichiers, relatif à la racine du media source défini dans le paramètre <code>Media Source</code>.';

$_lang['setting_redactor.browse_files'] = 'Navigation au sein des fichiers';
$_lang['setting_redactor.browse_files_desc'] = 'Activez cette option pour autoriser la sélection/navigation des fichiers uploadés.';

$_lang['redactor.browse_warning'] = "Uh oh, il n'y a pas d'images ici. Modifier les paramètres de browse_image_path pour parcourir un autre emplacement ou télécharger des images à [[+path]].";
$_lang['redactor.browse_files_warning'] = "Uh oh, il n'y a pas de fichiers ici. Modifier les paramètres de file_browse_path pour parcourir un autre emplacement ou télécharger des images à[[+path]].";

$_lang['setting_redactor.searchImages'] = "Rechercher des images";
$_lang['setting_redactor.searchImages_desc'] = "Activez ce paramètre pour utiliser une zone de recherche afin de filtrer les images dans la fenêtre modale de sélection d'image.";

$_lang['setting_redactor.clipsJson'] = 'Clips JSON';
$_lang['setting_redactor.clipsJson_desc'] = 'Si défini à une chaîne de caractères JSON valide, le plugin Redactor "Clips" sera ajouté à la barre d\'outils.';

$_lang['setting_redactor.stylesJson'] = 'Styles JSON';
$_lang['setting_redactor.stylesJson_desc'] = 'Si défini à une chaîne de caractères JSON valide, le plugin Redactor "Styles" sera ajouté à la barre d\'outils.';

$_lang['setting_redactor.additionalPlugins'] = 'Plugins supplémentaires';
$_lang['setting_redactor.additionalPlugins_desc'] = 'Indiquez une liste de plugins Redactor au format  "nomduplugin:fichier" et séparée par des virgules, afin de les activer.';

$_lang['setting_redactor.fullpage'] = 'Plein-écran';
$_lang['setting_redactor.fullpage_desc'] = 'Permet l\'édition d\'une page HTML complète (y compris html, head, body et autres balises) en mode iframe et plein-écran.';

$_lang['setting_redactor.dragUpload'] = 'Upload par glisser/déposer';
$_lang['setting_redactor.dragUpload_desc'] = 'Ce paramètre permet aux utilisateurs de faire glisser/déposer des images dans Redactor, depuis leur ordinateur, pour les uploader vers le serveur. Cette fonctionnalité est opérationnelle dans tous les navigateurs récents, à l\'exception d\'IE.';

$_lang['setting_redactor.convertImageLinks'] = 'Convertir les liens d\'images';
$_lang['setting_redactor.convertImageLinks_desc'] = 'Convertit les liens tels que "http://site.com/image.jpg" en balises img en pressant la touche entré.';

$_lang['setting_redactor.convertVideoLinks'] = 'Convertir les liens de vidéo';
$_lang['setting_redactor.convertVideoLinks_desc'] = 'Convertit les liens tels que https://www.youtube.com/watch?v=DcRp9V5GbqQ dans le lecteur intégré YouTube en pressant la touche entré.';

$_lang['setting_redactor.tidyHtml'] = 'Nettoyer le code HTML';
$_lang['setting_redactor.tidyHtml_desc'] = 'Utilisez la valeur false pour désactiver le formatage de code.';

$_lang['setting_redactor.observeLinks'] = 'Voir les liens';
$_lang['setting_redactor.observeLinks_desc'] = 'Utilisez la valeur true pour autoriser le suivi/la modification des liens lors du survol des liens dans Redactor.';

//$_lang['setting_redactor.imageFloatMargin'] = 'Image Float Margin';
//$_lang['setting_redactor.imageFloatMargin_desc'] = 'Custom margin for images setting.';

$_lang['setting_redactor.tabSpaces'] = 'Espaces de tabulation';
$_lang['setting_redactor.tabSpaces_desc'] = 'Utilisez la valeur true pour utiliser des espaces pour les marges de la langue chinoise.';

$_lang['setting_redactor.removeEmptyTags'] = 'Supprimer les balises vides';
$_lang['setting_redactor.removeEmptyTags_desc'] = 'Ce paramètre permet d\'activer/désactiver le suppression des balises vides.';

$_lang['setting_redactor.sanitizeReplace'] = 'Assainir le remplacement';
$_lang['setting_redactor.sanitizeReplace_desc'] = 'Le caractère de remplacement utilisé lors de "l\'assainissement" des noms de fichiers uploadés.';

$_lang['setting_redactor.sanitizePattern'] = 'Modèle "d\'assainissement"';
$_lang['setting_redactor.sanitizePattern_desc'] = 'Le modèle RegEx à appliquer lors de "l\'assainissement" des noms des fichiers uploadés.';

$_lang['setting_redactor.linkSize'] = 'Taille du lien';
$_lang['setting_redactor.linkSize_desc'] = 'Nombre de caractères maximum pour l\'affichage d\'une URL.';

$_lang['setting_redactor.advAttrib'] = 'Attributs avancés';
$_lang['setting_redactor.advAttrib_desc'] = 'Activez cette option pour que les attributs (tels que class, id et title) soient disponibles dans l\'édition des liens et images.';

$_lang['setting_redactor.linkNofollow'] = 'Lien "No-Follow"';
$_lang['setting_redactor.linkNofollow_desc'] = 'Ce paramètre ajout l\'attribut "nofollow" aux liens ajoutés depuis Redactor.';

$_lang['setting_redactor.typewriter'] = 'Mode machine à écrire';
$_lang['setting_redactor.typewriter_desc'] = 'Mode machine à écrire sans stress. http://imperavi.com/Redactor/examples/Typewriter/';

$_lang['setting_redactor.buttonsHideOnMobile'] = 'Boutons cachés sur mobiles';
$_lang['setting_redactor.buttonsHideOnMobile_desc'] = 'Avec cette option, vous pouvez spécifier quels boutons de la barre d\'outils peuvent être cachées sur les appareils mobiles.';

$_lang['setting_redactor.toolbarOverflow'] = 'Toolbar Overflow';
$_lang['setting_redactor.toolbarOverflow_desc'] = 'With this option, you can specify a toolbar button to build only one row on mobile devices.';

$_lang['setting_redactor.imageTabLink'] = 'Image Tab Link';
$_lang['setting_redactor.imageTabLink_desc'] = 'With this option you can enable/disabled a tab with insert image as link.';

$_lang['setting_redactor.cleanSpaces'] = 'Nettoyer les espaces';
$_lang['setting_redactor.cleanSpaces_desc'] = 'Supprimes les espaces supplémentaires des textes collés lorsque la valeur est "oui", les laisse lorsque la valeur est "non".';

$_lang['setting_redactor.predefinedLinks'] = 'Liens prédéfinis';
$_lang['setting_redactor.predefinedLinks_desc'] = 'Ce paramètre permet de définir une liste de liens disponibles dans la fenêtre "Ajouter un lien". http://imperavi.com/redactor/docs/settings/#set-predefinedLinks';

$_lang['setting_redactor.shortcutsAdd'] = 'Raccourcis supplémentaires';
$_lang['setting_redactor.shortcutsAdd_desc'] = 'Ce paramètre ajoute vos raccourcis à Redactor. http://imperavi.com/redactor/docs/settings/#set-shortcutsAdd';

$_lang['setting_redactor.commemorateRebecca'] = 'Commémorer Rebecca';
$_lang['setting_redactor.commemorateRebecca_desc'] = 'Souhaite un joyeux anniversaire à <a href="http://www.zeldman.com/2014/06/10/the-color-purple/" target="_blank">Rebecca Meyer</a> en affectant à la barre d\'outils Redactor <strong style="color:#663399;color:rebeccapurple;"> sa couleur préférée</strong> le sept juin.';

$_lang['setting_redactor.toolbarFixed'] = 'Barre d\'outils fixe';
$_lang['setting_redactor.toolbarFixed_desc'] = 'Si cette option est activée, la barre d\'outils de Redactor restera en permanence en haut de la fenêtre du navigateur. Pour désactiver, vous devez définir redactor.toolbarFixedBox à "non".';

$_lang['setting_redactor.toolbarFixedBox'] = 'Barre d\'outils fixe';
$_lang['setting_redactor.toolbarFixedBox_desc'] = 'Cette option rend la barre d\'outils fixe et de la largeur de l\'éditeur.';




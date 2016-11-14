<?php
$_lang['contentblocks'] = "Content Blocks";
$_lang['contentblocks.menu'] = "Content Blocks";
$_lang['contentblocks.menu_desc'] = "Gestisci il campi e i layout di Content Blocks.";
$_lang['contentblocks.mgr.home'] = "Content Blocks";

$_lang['contentblocks.general'] = "Generale";
$_lang['contentblocks.properties'] = "Proprietà";
$_lang['contentblocks.clear_filters'] = "Clear filters";
$_lang['contentblocks.search'] = "Search";

$_lang['contentblocks.link'] = "Link";
$_lang['contentblocks.link.description'] = "A field for creating links. Resource, email, and URLs are supported.";
$_lang['contentblocks.link_template.description'] = "A template for the link. Available placeholders: <code>[[+link]]</code>, <code>[[+link_raw]]</code>, <code>[[+linkType]]</code>";
$_lang['contentblocks.link.resource'] = "Risorsa";
$_lang['contentblocks.link.url'] = "URL";
$_lang['contentblocks.link.email'] = "Indirizzo e-mail";
$_lang['contentblocks.link.link_new_tab'] = "Apri in una nuova finestra";
$_lang['contentblocks.link.add'] = "Aggiungi link";
$_lang['contentblocks.link.remove'] = "Rimuovi link";
$_lang['contentblocks.link.placeholder'] = "Comincia a scrivere il nome di una risorsa, di un link esterno o di un indirizzo e-mail";
$_lang['contentblocks.link.link_detection_pattern_override'] = 'Link detection pattern override';
$_lang['contentblocks.link.link_detection_pattern_override.description'] = 'Regex per determinare se un link è valido; se non lo è, http:// sarà aggiunto.';
$_lang['contentblocks.link.limit_to_current_context'] = 'Limit resource results to current context';
$_lang['contentblocks.link.limit_to_current_context.description'] = 'Limits typeahead results to resources contained within the same context as the page being edited';

$_lang['setting_contentblocks.link.link_detection_pattern'] = 'Link detection pattern';
$_lang['setting_contentblocks.link.link_detection_pattern_desc'] = 'Regex to detect whether a link is valid; if not, http:// will be prepended.';

$_lang['setting_contentblocks.typeahead.include_introtext'] = 'Include Introtext in Typeahead';
$_lang['setting_contentblocks.typeahead.include_introtext_desc'] = 'When enabled, the typeahead will include the introtext for each of the resources, providing you with more information about the resource.';

$_lang['contentblocks.error.not_an_export'] = "The file does not seem to be a ContentBlocks export";
$_lang['contentblocks.error.importing_row'] = "Error importing row: ";
$_lang['contentblocks.error.no_valid_field'] = "No valid field found for request.";
$_lang['contentblocks.error.no_valid_input'] = "No valid input found for request.";
$_lang['contentblocks.error.no_snippets'] = "Nessuno snipper disponible";
$_lang['contentblocks.error.missing_id'] = "Missing ID property";
$_lang['contentblocks.error.input_not_found'] = "Input not found";
$_lang['contentblocks.error.input_not_found.message'] = "Uh oh. A field with input type \"[[+input]]\" was loaded, however that input type does not exist.";
$_lang['contentblocks.error.field_not_found'] = "Campo non trovato";
$_lang['contentblocks.error.category_not_found'] = "Category not found";
$_lang['contentblocks.error.layout_not_found'] = "Layout non trovato";
$_lang['contentblocks.error.error_saving_object'] = "Si è verificato un errore nel tentativo di salvare l'oggetto";
$_lang['contentblocks.error.xml_not_loaded'] = "Non è stato possibile caricare il file XML";
$_lang['contentblocks.error.no_icons'] = "Non è stato possibile aprire la directory delle icone";
$_lang['contentblocks.error.no_json'] = "Il tuo browser non supporta JSON, richiesto per il funzionamento di ContenBlocks. Per favore aggiorna il tuo browser.";

$_lang['contentblocks.availability'] = "Disponibilità";
$_lang['contentblocks.availability.layout_description'] = "By default, Layouts are always available. If you add conditions below, they will only be available when one of the conditions is true. Separate multiple valid values with a comma.";
$_lang['contentblocks.availability.field_description'] = "By default, Fields are always available. If you add conditions below, they will only be available when one of the conditions is true. Separate multiple valid values with a comma.";
$_lang['contentblocks.availability.template_description'] = "By default, Templates are always available. If you add conditions below, they will only be available when one of the conditions is true. Separate multiple valid values with a comma.";
$_lang['contentblocks.add_condition'] = "Aggiungi condizione";
$_lang['contentblocks.edit_condition'] = "Modifica condizione";
$_lang['contentblocks.delete_condition'] = "Elimina condizione";
$_lang['contentblocks.delete_condition.confirm'] = "Sei sicuro di voler eliminare questa condizione?";
$_lang['contentblocks.condition_field'] = "Campo";
$_lang['contentblocks.condition_field.resource'] = "ID della risorsa";
$_lang['contentblocks.condition_field.parent'] = "ID della risorsa genitore";
$_lang['contentblocks.condition_field.ultimateparent'] = "Ultimate Parent ID";
$_lang['contentblocks.condition_field.class_key'] = "Class Key";
$_lang['contentblocks.condition_field.context'] = "Contesto";
$_lang['contentblocks.condition_field.template'] = "Template (ID)";
$_lang['contentblocks.condition_field.usergroup'] = "User Group (name)";
$_lang['contentblocks.condition_value'] = "Valore/i";
$_lang['contentblocks.availibility.layouts'] = "Layout";
$_lang['contentblocks.availibility.layouts.description'] = "Restrict usage of this Field to one or more (comma separated) Layouts. If left empty, this field is available on all layouts, otherwise it is restricted to the ones you specify.";
$_lang['contentblocks.availibility.times_per_page'] = "Times per page";
$_lang['contentblocks.availibility.times_per_page.description'] = "Restrict usage to this many times on page. Leave blank for no restriction.";
$_lang['contentblocks.availibility.times_per_layout'] = "Times per layout";
$_lang['contentblocks.availibility.times_per_layout.description'] = "Restrict usage to this many times on layout. Leave blank for no restriction.";
$_lang['contentblocks.availibility.only_nested'] = "Permetti solo come layout annidato";
$_lang['contentblocks.availibility.only_nested.description'] = "Do not allow layout to be used outside of layout field.";


$_lang['contentblocks.field_desc'] = "Fields are the backbone of ContentBlocks - they define exactly how much <em>Creative Freedom</em> editors get in managing their content. Each field consists primarily of an input type and a template that dictates how it is parsed to the front-end. For more information on using Fields properly, hit the Help button at the top right of the screen.";
$_lang['contentblocks.add_field'] = "Aggiungi campo";
$_lang['contentblocks.edit_field'] = "Modifica campo";
$_lang['contentblocks.duplicate_field'] = "Duplica campo";
$_lang['contentblocks.delete_field'] = "Elimina campo";
$_lang['contentblocks.delete_field.confirm'] = "Are you sure you want to delete this Field? Potentially disastrous things can happen with any content that used this Field.";
$_lang['contentblocks.delete_field.confirm.js'] = "Sei sicuro di voler eliminare questo campo?";
$_lang['contentblocks.export_field'] = "Export Field";
$_lang['contentblocks.export_fields'] = "Export";
$_lang['contentblocks.export_fields.confirm'] = "After clicking Yes below, we will prepare an XML export of all Fields. This can be used to import the Fields later or in a different installation. Generating the XML can take a few seconds depending on the number of fields you have configured.";
$_lang['contentblocks.import_fields'] = "Import";
$_lang['contentblocks.import_fields.title'] = "Import Fields";
$_lang['contentblocks.import_fields.intro'] = "By uploading an XML file and choosing the right import mode, you can import Fields you exported before or from a different site. <b>Be careful</b> with importing Fields if you have content using the current fields already. Please contact support@modmore.com if you are unsure about what mode to use in the import.";

$_lang['contentblocks.layout_desc'] = "Ogni layout è essenzialmente una riga orizzontale, che contiene una o più colonne. Mentre si modifica una risorsa, ognuna delle colonne è un contenitore vuoto con un pulsante per aggiungere del contenuto (usando i campi). Per maggiori informazioni su come utilizzare i layout nel modo corretto, clicca il pulsante Help in altro a destra dello schermo.";
$_lang['contentblocks.add_layout'] = "Aggiungi layout";
$_lang['contentblocks.repeat_layout'] = "Ripeti layout";
$_lang['contentblocks.edit_layout'] = "Modifica layout";
$_lang['contentblocks.duplicate_layout'] = "Duplica layout";
$_lang['contentblocks.export_layout'] = "Export Layout";
$_lang['contentblocks.delete_layout'] = "Elimina layout";
$_lang['contentblocks.delete_layout.confirm'] = "Are you sure you want to delete this Layout? Potentially disastrous things can happen with any content that used this Layout.";
$_lang['contentblocks.delete_layout.confirm.js'] = "Are you sure you want to delete this [[+layoutName]] layout? All its content will be deleted with it if you continue.";
$_lang['contentblocks.export_layouts'] = "Esportazione";
$_lang['contentblocks.export_layouts.confirm'] = "After clicking Yes below, we will prepare an XML export of all Layouts. This can be used to import the Layouts later or in a different installation. Generating the XML can take a few seconds depending on the number of layouts you have configured.";
$_lang['contentblocks.import_layouts'] = "Importazione";
$_lang['contentblocks.import_layouts.title'] = "Import Layouts";
$_lang['contentblocks.import_layouts.intro'] = "By uploading an XML file and choosing the right import mode, you can import Layouts you exported before or from a different site. <b>Be careful</b> with importing Layouts if you have content using the current Layouts already. Please contact support@modmore.com if you are unsure about what mode to use in the import.";

$_lang['contentblocks.layout_settings'] = "Layout Settings";
$_lang['contentblocks.layout_settings.modal_header'] = "[[+name]] Settings";

$_lang['contentblocks.field_settings'] = "Content Settings";
$_lang['contentblocks.field_settings.modal_header'] = "[[+name]] Settings";

$_lang['contentblocks.add_layoutcolumn'] = "Aggiungi colonna";
$_lang['contentblocks.edit_layoutcolumn'] = "Modifica colonna";
$_lang['contentblocks.delete_layoutcolumn'] = "Elimina colonna";
$_lang['contentblocks.delete_layoutcolumn.confirm'] = "Are you sure you want to delete this Column? Potentially disastrous things can happen with any content that used this Column.";
$_lang['contentblocks.add_setting'] = "Add Setting";
$_lang['contentblocks.edit_setting'] = "Edit Setting";
$_lang['contentblocks.duplicate_setting'] = "Duplicate Setting";
$_lang['contentblocks.delete_setting'] = "Delete Setting";
$_lang['contentblocks.delete_setting.confirm'] = "Are you sure you want to delete this Setting?";

$_lang['contentblocks.defaults'] = 'Defaults';
$_lang['contentblocks.defaults.intro'] = 'With Defaults, you can configure how resources that have not yet been edited with ContentBlocks (such as new resources, or pages that existed prior to installing ContentBlocks) are managed. This works by parsing the defined Default Rules defined below, from top to bottom, until a match is found and it inserts the defined template.';
$_lang['contentblocks.constraint_field'] = 'Constraint Field';
$_lang['contentblocks.constraint_value'] = 'Constraint Value';
$_lang['contentblocks.default_template'] = 'Default Template';
$_lang['contentblocks.target_layout'] = 'Target Layout';
$_lang['contentblocks.target_field'] = 'Target Field';
$_lang['contentblocks.target_column'] = 'Target Column';
$_lang['contentblocks.add_default'] = 'Add Default Rule';
$_lang['contentblocks.edit_default'] = 'Edit Default Rule';
$_lang['contentblocks.delete_default'] = 'Delete Default Rule';
$_lang['contentblocks.delete_default.confirm'] = 'Are you sure you want to delete this Default Rule?';


$_lang['contentblocks.start_import'] = "Start Import";
$_lang['contentblocks.import_file'] = "File";
$_lang['contentblocks.import_mode'] = "Import Mode";
$_lang['contentblocks.import_mode.insert'] = "Insert: leave existing [[+what]] and add the imported data";
$_lang['contentblocks.import_mode.overwrite'] = "Overwrite: leave existing [[+what]], but overwrite them if they have the same ID";
$_lang['contentblocks.import_mode.replace'] = "Replace: first remove all current [[+what]], and then import the new rows.";

$_lang['contentblocks.id'] = "ID";
$_lang['contentblocks.field'] = "Campo";
$_lang['contentblocks.fields'] = "Campi";
$_lang['contentblocks.layout'] = "Layout";
$_lang['contentblocks.layout.description'] = "A wrapper for fields";
$_lang['contentblocks.layouts'] = "Layout";
$_lang['contentblocks.layoutcolumn'] = "Colonna";
$_lang['contentblocks.layoutcolumns'] = "Colonne";
$_lang['contentblocks.setting'] = "Setting";
$_lang['contentblocks.settings'] = "Settings";
$_lang['contentblocks.settings.layout_description'] = "Settings are user-defined properties that can be tweaked when a layout has been added to the content. The setting values are then available in the template as placeholders, for example [[+class]] for a setting with reference \"class\".";
$_lang['contentblocks.settings.field_description'] = "Settings are user-defined properties that can be tweaked when a field has been added to the content by clicking the cog icon in the top right of the field. The setting values are then available in the template as placeholders, for example [[+class]] for a setting with reference \"class\".";
$_lang['contentblocks.input'] = "Input Type";
$_lang['contentblocks.inputs'] = "Input Types";
$_lang['contentblocks.name'] = "Name";
$_lang['contentblocks.columns'] = "Columns";
$_lang['contentblocks.columns.description'] = "Columns define how the layout is displayed in the manager, where the width is defined as a percentage. The reference is used for a placeholder which you can use in the Template.";
$_lang['contentblocks.sortorder'] = "Sort Order";
$_lang['contentblocks.icon'] = "Icon";
$_lang['contentblocks.description'] = "Description";
$_lang['contentblocks.template'] = "Template";
$_lang['contentblocks.template.description'] = "The template for the layout has several available placeholders, depending on the Columns and Settings you define in the tabs on the left.";
$_lang['contentblocks.width'] = "Width";
$_lang['contentblocks.width.description'] = "The width of the field (in percentages) that this field will take up in the canvas. Fields are floated left so you can create some basic layouts with this option.";
$_lang['contentblocks.save'] = "Save";
$_lang['contentblocks.reference'] = "Reference";
$_lang['contentblocks.default_value'] = "Valore di default";
$_lang['contentblocks.fieldtype'] = "Tipo di campo";
$_lang['contentblocks.fieldtype.select'] = "Select";
$_lang['contentblocks.fieldtype.radio'] = "Radio options";
$_lang['contentblocks.fieldtype.checkbox'] = "Checkbox options";
$_lang['contentblocks.fieldtype.textfield'] = "Testo";
$_lang['contentblocks.fieldtype.link'] = "Link";
$_lang['contentblocks.fieldtype.textarea'] = "Textarea";
$_lang['contentblocks.fieldoptions'] = "Field Options";
$_lang['contentblocks.fieldoptions.description'] = "Used for Select field types only. Define available values as \"placeholder_value==Displayed Value\" (\"Displayed Value=placeholder_value\" is also supported, but will be removed in 2.0), one per line. If you only pass a single value per line (such as \"foo\"), that will be used as both displayed and placeholder value.";
$_lang['contentblocks.field_is_exposed'] = "Expose field";
$_lang['contentblocks.field_is_exposed.description'] = "Show field on canvas instead of only after clicking settings icon";
$_lang['contentblocks.field_is_exposed.modal'] = "Show field setting in modal window";
$_lang['contentblocks.field_is_exposed.exposedassetting'] = "Expose field on canvas as a setting";
$_lang['contentblocks.field_is_exposed.exposedasfield'] = "Expose field on canvas as a regular field";

$_lang['contentblocks.directory'] = 'Directory';
$_lang['contentblocks.directory.description'] = 'A subfolder within the media source (whether overridden or using the ContentBlocks system setting)';
$_lang['contentblocks.file_types'] = 'Allowed File Extensions';
$_lang['contentblocks.file_types.description'] = 'Files with these extensions (comma-separated) will be uploaded. For no restriction, leave blank.';
$_lang['contentblocks.file_types.disallowed'] = 'File type not allowed in this field';

// Categories
$_lang['contentblocks.category'] = "Category";
$_lang['contentblocks.categories'] = "Categories";
$_lang['contentblocks.categories.intro'] = "Use Categories to better organise your Fields, Layouts and Templates. When assigned to an element, the Add Content and Add Layout modals will show categorized items first, followed by an \"Uncategorized\" category.";
$_lang['contentblocks.uncategorized'] = "Uncategorized";
$_lang['contentblocks.add_category'] = "Add Category";
$_lang['contentblocks.edit_category'] = "Edit Category";
$_lang['contentblocks.duplicate_category'] = "Duplicate Category";
$_lang['contentblocks.delete_category'] = "Delete Category";
$_lang['contentblocks.delete_category.confirm'] = "Are you sure you want to delete this Category? Any elements that currently use the category will be set to uncategorized instead.";
$_lang['contentblocks.delete_category.confirm.js'] = "Are you sure you want to delete this Category?";
$_lang['contentblocks.export_category'] = "Export Category";
$_lang['contentblocks.export_categories'] = "Export";
$_lang['contentblocks.export_categories.confirm'] = "After clicking Yes below, we will prepare an XML export of all Categories. This can be used to import the Categories later or in a different installation. Generating the XML should only take a few seconds.";
$_lang['contentblocks.import_categories'] = "Import";
$_lang['contentblocks.import_categories.title'] = "Import Categories";
$_lang['contentblocks.import_categories.intro'] = "By uploading an XML file and choosing the right import mode, you can import Categories you exported before or from a different site. <b>Be careful</b> with importing Categories if you have content using the current fields already. Please contact support@modmore.com if you are unsure about what mode to use in the import.";


// Templates
$_lang['contentblocks.templates'] = 'Templates';
$_lang['contentblocks.templates_desc'] = 'Templates are predefined sets of Layouts and Fields that can be used as shortcut for adding content to the canvas. ';
$_lang['contentblocks.add_template'] = 'Aggiungi template';
$_lang['contentblocks.edit_template'] = 'Modifica template';
$_lang['contentblocks.duplicate_template'] = 'Duplica template';
$_lang['contentblocks.export_template'] = 'Export Template';
$_lang['contentblocks.export_templates'] = 'Esporta i template';
$_lang['contentblocks.import_templates'] = 'Import Templates';
$_lang['contentblocks.import_templates.title'] = 'Import Templates';
$_lang['contentblocks.import_templates.intro'] = 'By uploading an XML file and choosing the right import mode, you can import Templates you exported before or from a different site. <b>Note:</b> Templates contain references to Field and Layout IDs; if you are importing Templates, you will probably need to import Layouts and Fields from the same place as well.';
$_lang['contentblocks.delete_template'] = 'Elimina template';
$_lang['contentblocks.delete_template.confirm'] = 'Sei sicuro di voler elminare questo template?';


// Input types
$_lang['contentblocks.chunk'] = "Chunk";
$_lang['contentblocks.chunk.description'] = "Define a chunk to be inserted into the content.";
$_lang['contentblocks.chunk.choose_chunk'] = "Choose Chunk";
$_lang['contentblocks.chunk.choose_chunk.description'] = "Choose the chunk that needs to be inserted.";
$_lang['contentblocks.chunk_template.description'] = "A template for the chunk. Available placeholders: <code>[[+tag]]</code>, <code>[[+chunk_name]]</code>";
$_lang['contentblocks.chunk.custom_preview'] = "Custom Preview";
$_lang['contentblocks.chunk.custom_preview.description'] = "By default if this field is left empty, the Chunk Input will load the actual chunk and display that as preview. If you want, you can override that preview by entering the HTML for the preview here.";
$_lang['contentblocks.chunk.no_chunk_set'] = "Uh oh.. there is no chunk defined for this field.";

$_lang['contentblocks.chunkselector'] = 'Chunk Selector';
$_lang['contentblocks.chunk_selector_template.description'] = 'The template for the selected chunk. Available placeholders: <code>[[+value]]</code> (contains the full chunk tag), <code>[[+chunk_name]]</code> (contains the name of the selected chunk)';
$_lang['contentblocks.chunkselector.description'] = 'Choose a chunk to display';
$_lang['contentblocks.chunkselector.available_chunks'] = "Name or IDs of allowed chunks (Optional)";
$_lang['contentblocks.chunkselector.available_chunks.description'] = "To limit the available chunks for the editor, specify a comma separated list of chunks names or IDs. Chunks in this list will always be available, irrespective of the other properties below.";
$_lang['contentblocks.chunkselector.available_categories'] = "Categorie";
$_lang['contentblocks.chunkselector.available_categories.description'] = "Specify a list of category names or IDs to limit the available chunks to.";

$_lang['contentblocks.code'] = "Code";
$_lang['contentblocks.code.description'] = "Shows a textarea with code highlighting.";
$_lang['contentblocks.code_template.description'] = "The value of the code input is stored in the <code>[[+value]]</code> placeholder. Depending on your anticipated usage of this field, you would just add the placeholder to the template, or you would encode it (e.g. by doing <code>&lt;pre&gt;&lt;code&gt;[[+value:htmlent]]&lt;/code&gt;&lt;/pre&gt;) for display instead of execution. The <code>[[+lang]]</code> placeholder contains the selected language in the dropdown.";
$_lang['contentblocks.code.available_languages'] = "Lingue disponibili";
$_lang['contentblocks.code.available_languages.description'] = "Specify a comma-separated list of <code>value=display</code> entries for the available languages with syntax highlighting. If there is only one language specified, it will be selected and the language dropdown hidden.";
$_lang['contentblocks.code.default_language'] = "Lingua di default";
$_lang['contentblocks.code.default_language.description'] = "The language to select by default.";
$_lang['contentblocks.code.language'] = "Lingua";
$_lang['contentblocks.code.entities'] = "Encode Entities?";
$_lang['contentblocks.code.entities.description'] = "When enabled, the entered code will have entities and MODX tags encoded for displaying code.";

$_lang['contentblocks.file'] = 'File Input';
$_lang['contentblocks.file.description'] = 'Add files for linking';
$_lang['contentblocks.file_template.description'] = 'Valid placeholders are <code>[[+url]]</code>, <code>[[+title]]</code>, <code>[[+size]]</code> (in bytes), <code>[[+upload_date]]</code>, and <code>[[+extension]]</code>';
$_lang['contentblocks.file.remove_file'] = 'Rimuovi file';
$_lang['contentblocks.file.max_files'] = 'Numero massimo di file';
$_lang['contentblocks.file.file.or_drop_files'] = 'or drop files here';
$_lang['contentblocks.file.max_files'] = 'Numero massimo di file';
$_lang['contentblocks.file.max_files.description'] = 'Defines the maximum number of files allowed per upload field. Additional files over the limit will be refused.';
$_lang['contentblocks.file.max_files.reached'] = 'Sorry, you cannot use more than [[+max]] files in this section.';
$_lang['contentblocks.file.directory'] = 'Directory';
$_lang['contentblocks.file.directory.description'] = 'A subfolder within the media source (whether overridden or using the ContentBlocks system setting)';
$_lang['contentblocks.file.file_types'] = 'Allowed File Extensions';
$_lang['contentblocks.file.file_types.description'] = 'Files with these extensions (comma-separated) will be uploaded. For no restriction, leave blank.';
$_lang['contentblocks.file.file_types.disallowed'] = 'File type not allowed in this field';
$_lang['contentblocks.file.choose_file'] = 'Choose file';

$_lang['contentblocks.gallery'] = "Gallery";
$_lang['contentblocks.gallery.description'] = "A simple gallery input featuring easy multi-image uploads, drag/drop sorting and title attributes.";
$_lang['contentblocks.gallery_template.description'] = "Used to wrap individual images. Available placeholders:  <code>[[+url]]</code> (the full link to the image), <code>[[+title]]</code> (the entered title for the image), <code>[[+size]]</code>, <code>[[+extension]]</code>";
$_lang['contentblocks.gallery_wrapper_template.description'] = "Used for wrapping all images in (as container). Available placeholders: <code>[[+images]]</code>";
$_lang['contentblocks.gallery_max_images.description'] = "Defines the maximum number of images allowed per gallery. Additional images over the limit will be refused.";
$_lang['contentblocks.gallery.thumb_size'] = "Dimensioni della miniatura";
$_lang['contentblocks.gallery.thumb_size.description'] = "Choose one of the options to define how small/big the thumbnails are displayed in the canvas.";
$_lang['contentblocks.gallery.thumb_size.small'] = "Piccola";
$_lang['contentblocks.gallery.thumb_size.medium'] = "Media";
$_lang['contentblocks.gallery.thumb_size.large'] = "Grande";
$_lang['contentblocks.gallery.show_description'] = "Mostra descrizione";
$_lang['contentblocks.gallery.show_description.description'] = "Show a Description box to allow the editor to add a longer description to each of the images.";
$_lang['contentblocks.gallery.show_link_field'] = "Show Link field";
$_lang['contentblocks.gallery.show_link_field.description'] = "Show a link field so images can be linked to resources or external websites.";

$_lang['contentblocks.heading'] = "Heading";
$_lang['contentblocks.heading.description'] = "A combination of a select field for the heading level, and a textfield.";
$_lang['contentblocks.heading_template.description'] = "Template for the heading field. Available placeholders are <code>[[+level]]</code> (the value of the level dropdown) and <code>[[+value]]</code>(the value of the text input).";
$_lang['contentblocks.default_level'] = "Default Level";
$_lang['contentblocks.available_levels'] = "Available Levels";
$_lang['contentblocks.heading_default_level.description'] = "The value that should be selected by default on new instances of the Heading input.";
$_lang['contentblocks.heading_available_levels.description'] = "A list, separated by commas, of <code>value=display</code> items for available levels in the dropdown. For the display value, a lexicon prefix of <code>contentblocks.</code> is checked and used if available. Example: <code>h1=heading_1, h2=Second Level,h3=heading_3</code>";
$_lang['contentblocks.heading_1'] = "Heading 1";
$_lang['contentblocks.heading_2'] = "Heading 2";
$_lang['contentblocks.heading_3'] = "Heading 3";
$_lang['contentblocks.heading_4'] = "Heading 4";
$_lang['contentblocks.heading_5'] = "Heading 5";
$_lang['contentblocks.heading_6'] = "Heading 6";

$_lang['contentblocks.hr'] = "Horizontal Rule";
$_lang['contentblocks.hr.description'] = "Simple placeholder for a <hr> tag to insert a horizontal line.";
$_lang['contentblocks.hr_template.description'] = "How to display the horizontal row. No placeholders are available, but using the <code>&lt;hr&gt;</code> tag here is recommended.";

$_lang['contentblocks.image'] = "Immagine";
$_lang['contentblocks.image.description'] = "Input type with easy image upload or selection.";
$_lang['contentblocks.image.source'] = "Media Source Override";
$_lang['contentblocks.image.source.description'] = "Leave this at (none) to use the system default media source for images, or choose a specific media source to override that setting for this specific field.";
$_lang['contentblocks.image_template.description'] = "Template for the image input type. Should probably include an <code>&lt;img&gt;</code> tag. Available Placeholders: <code>[[+url]]</code>, <code>[[+size]]</code>, <code>[[+width]]</code>, <code>[[+height]]</code>, <code>[[+extension]]</code>";
$_lang['contentblocks.imagewithtitle'] = "Immagine con titolo";
$_lang['contentblocks.imagewithtitle.description'] = "Same as image, but this time with a textfield to add an alt or title attribute.";
$_lang['contentblocks.image_with_title'] = "Image with Title";
$_lang['contentblocks.image_with_title_template.description'] = "Template for the image input type. Should probably include an <code>&lt;img&gt;</code> tag. Available placeholders: <code>[[+url]]</code>, <code>[[+title]]</code>, <code>[[+size]]</code>, <code>[[+width]]</code>, <code>[[+height]]</code>, <code>[[+extension]]</code>";

$_lang['contentblocks.list'] = "Lista";
$_lang['contentblocks.list.description'] = "Input type for easily building (nested) unordered lists.";
$_lang['contentblocks.list_template.description'] = "Template for individual list items. This should probably contain a <code>&lt;li&gt;</code> tag. Available placeholders: <code>[[+value]]</code> (the list item text), <code>[[+idx]]</code> (an incrementing item number, starting at 1 on each level) and <code>[[+items]]</code> (sub-lists, templated with the other templates).";
$_lang['contentblocks.list_wrapper_template.description'] = "Outer most template for lists. This should probably contain a <code>&lt;ul&gt;</code> tag. Available placeholder: <code>[[+items]]</code> (list items templated with the other templates).";
$_lang['contentblocks.list_nested_template.description'] = "Inner template for indented sub-lists. This should probably contain a <code>&lt;ul&gt;</code> tag. Available placeholder: <code>[[+items]]</code> (list items templated with the other templates).";

$_lang['contentblocks.orderedlist'] = "Lista ordinata";
$_lang['contentblocks.orderedlist.description'] = "Same as the List type, except with an ordered list instead.";
$_lang['contentblocks.ordered_list'] = "Ordered List";
$_lang['contentblocks.ordered_list_template.description'] = "Template for individual list items. This should probably contain a <code>&lt;li&gt;</code> tag. Available placeholders: <code>[[+value]]</code> (the list item text), <code>[[+idx]]</code> (an incrementing item number, starting at 1 on each level) and <code>[[+items]]</code> (sub-lists, templated with the other templates).";
$_lang['contentblocks.ordered_list_wrapper_template.description'] = "Outer most template for ordered lists. This should probably contain a <code>&lt;ol&gt;</code> tag. Available placeholder: <code>[[+items]]</code> (list items templated with the other templates).";
$_lang['contentblocks.ordered_list_nested_template.description'] = "Inner template for indented sub-lists. This should probably contain a <code>&lt;ol&gt;</code> tag. Available placeholder: <code>[[+items]]</code> (list items templated with the other templates).";

$_lang['contentblocks.quote'] = "Quote";
$_lang['contentblocks.quote.description'] = "Textarea field combined with a small textfield for quote citations.";
$_lang['contentblocks.quote_template.description'] = "Template for the quote, should probably included a <code>&lt;blockquote&gt;</code> and <code>&lt;cite&gt;</code> tag. Available placeholders: <code>[[+value]]</code> (the quote input) and <code>[[+cite]]</code> (the small author input).";
$_lang['contentblocks.quote.author'] = "Autore";

$_lang['contentblocks.repeater'] = "Repeater";
$_lang['contentblocks.repeater.description'] = "Allows you to define a group of fields, that the editor can then repeat as a group.";
$_lang['contentblocks.repeater_template.description'] = "The template for each individual row in the repeater. There is no default as it completely depends on your groups configuration! For each of the Fields you define, you also need to set a key. The repeater will first parse all of the defined fields through their own processor (so an image field is first parsed as if it were a standalone image field), and the result of that is set into the placeholder based on the key. Please consult the documentation at modmore.com for a more in-depth instruction of how the repeater field works. Also supports a <code>[[+idx]]</code> placeholder.";
$_lang['contentblocks.repeater.width'] = "Larghezza (in %)";
$_lang['contentblocks.repeater.key'] = "Chiave";
$_lang['contentblocks.repeater.key.description'] = "The key by which the value of this field are available in the Repeater template. ";
$_lang['contentblocks.repeater.group'] = "Gruppo";
$_lang['contentblocks.repeater.group.description'] = "The Repeater field lets you repeat a group of fields. This is where you define the fields that are repeated.";
$_lang['contentblocks.repeater.max_items'] = "Numero massimo di elementi";
$_lang['contentblocks.repeater.max_items.description'] = "When set to a number larger than 0, additional rows cannot be added beyond this limit.";
$_lang['contentblocks.repeater.max_items_reached'] = "Sorry, you are not allowed to add more than [[+max]] items.";
$_lang['contentblocks.repeater.min_items'] = "Minimum number of Items";
$_lang['contentblocks.repeater.min_items.description'] = "When set to a number larger than 0, rows cannot be removed beyond this limit.";
$_lang['contentblocks.repeater.add_first_item'] = "Automatically add first item";
$_lang['contentblocks.repeater.add_first_item.description'] = "When enabled the Repeater will automatically get a first item added if there are none added yet.";
$_lang['contentblocks.repeater.add_item'] = "Aggiungi elemento";
$_lang['contentblocks.repeater.delete_item'] = "Elimina elemento";
$_lang['contentblocks.repeater.wrapper_template.description'] = "Outer template to wrap all other parsed rows in. Should contain the <code>[[+rows]]</code> placeholder, can also contain <code>[[+total]]</code>, .";
$_lang['contentblocks.repeater.row_separator'] = "Row Separator";
$_lang['contentblocks.repeater.row_separator.description'] = "A string to glue together individual rows. This could just be some line breaks, like in the default, or it could be a bunch of html you want in between rows.";


$_lang['contentblocks.richtext'] = "Rich Text";
$_lang['contentblocks.richtext.description'] = "Simple Rich Text field. Supports both TinyMCE and Redactor.";
$_lang['contentblocks.richtext_template.description'] = "As rich text fields typically handle their own markup generation, the template for a rich text input is typically just the <code>[[+value]]</code> placeholder, though you could wrap it in a container or something.";

$_lang['contentblocks.table'] = "Tabella";
$_lang['contentblocks.table.description'] = "Interactive widget for tabular data.";
$_lang['contentblocks.table_template.description'] = "Template for each of the table cells. Should probably include a &lt;td&gt; tag. Available placeholder: <code>[[+cell]]</code>, <code>[[+colIdx]]</code>, <code>[[+colTotal]]</code>";
$_lang['contentblocks.table.row_template'] = "Row Template";
$_lang['contentblocks.table.row_template.description'] = "The template for each of the rows in the table, probably contains a <code>&lt;tr&gt;</code> tag. Available placeholder: <code>[[+row]]</code> (contains each of the cells in this row), <code>[[+idx]]</code>";
$_lang['contentblocks.table.wrapper_template.description'] = "The wrapper template for the entire table. Available placeholder: <code>[[+body]]</code>, <code>[[+total]]</code>.";

$_lang['contentblocks.textarea'] = "Text Area";
$_lang['contentblocks.textarea.description'] = "Simple multi-line text field.";

$_lang['contentblocks.textfield'] = "Text Field";
$_lang['contentblocks.textfield.description'] = "Simple single-line text field.";
$_lang['contentblocks.textfield_template.description'] = "For the textfield simply use the <code>[[+value]]</code> placeholder with a container of choice (a paragraph, heading etc).";

$_lang['contentblocks.video'] = "Video";
$_lang['contentblocks.video.description'] = "YouTube integration allowing keyword search and pasting in YouTube links to insert videos easily.";
$_lang['contentblocks.video_template.description'] = "When using a Video input, the YouTube Video ID is stored in the <code>[[+value]]</code> placeholder. This can be used to generate the embed code in this template.";
$_lang['contentblocks.video.search'] = "Search!";
$_lang['contentblocks.video.search_introduction'] = "Use the search box below to search YouTube for videos.";
$_lang['contentblocks.video.enter_keywords'] = "Enter one or more keywords..";
$_lang['contentblocks.video.load_more_results'] = "Carica più risultati";
$_lang['contentblocks.video.search_youtube'] = "Cerca su YouTube";
$_lang['contentblocks.video.paste_link'] = "Incolla un link qui";
$_lang['contentblocks.video.youtube_not_loaded'] = "Le API di YouTube non sono state caricate. Per favore prova di nuovo tra qualche secondo. Se il problema persiste, le API potrebbero essere momentaneamente non disponibili.";
$_lang['contentblocks.video.api_error'] = "Uh oh, an error occured: [[+message]] (Code [[+code]])";

// Select
$_lang['contentblocks.dropdown'] = "Dropdown";
$_lang['contentblocks.dropdown.description'] = "A simple dropdown field, allowing the editor to choose one item from a number of predefined options.";
$_lang['contentblocks.dropdown_template.description'] = "Template for the dropdown field. Available placeholders are <code>[[+value]]</code> (the value option for the chosen item), <code>[[+display]]</code> (the displayed value in the dropdown).";
$_lang['contentblocks.dropdown.options'] = "Drop-down Options";
$_lang['contentblocks.dropdown.options.description'] = "Define available values as 'value==Displayed Value', with one option per line. If you only pass a single value per line (such as 'foo'), that will be used as both displayed and placeholder value. Prefixing a single value with # will make it a disabled option. You can also use @SNIPPET bindings to dynamically provide option values. For detailed information on specifying options consult the Dropdown documentation at modmo.re/cb.";
$_lang['contentblocks.dropdown.default_value'] = "Default Value";
$_lang['contentblocks.dropdown.default_value.description'] = "The default value to choose when the dropdown is inserted, or nothing is selected.";

// Snippet
$_lang['contentblocks.snippet'] = "Snippet";
$_lang['contentblocks.snippet.description'] = "Allow the user to choose a snippet and enter properties for it.";
$_lang['contentblocks.snippet.available_snippets'] = "Name or IDs of allowed Snippets (Optional)";
$_lang['contentblocks.snippet.available_snippets.description'] = "To limit the available snippets for the editor, specify a comma separated list of snippet names or IDs. Snippets in this list will always be available, irrespective of the other properties below.";
$_lang['contentblocks.snippet.categories'] = "Categorie";
$_lang['contentblocks.snippet.categories.description'] = "Specify a list of category names or IDs to limit the available snippets to.";
$_lang['contentblocks.snippet.add_property'] = "Aggiungi proprietà";
$_lang['contentblocks.snippet.choose_snippet'] = "Choose Snippet";
$_lang['contentblocks.snippet.other_property'] = "Other (manual input)";
$_lang['contentblocks.snippet.other_property.desc'] = "Any properties to add to the end of the snippet call can be specified here. Make sure to use the proper tag syntax, like this: &property=`value`";
$_lang['contentblocks.snippet.allow_uncached'] = "Allow Uncached?";
$_lang['contentblocks.snippet.allow_uncached.description'] = "When enabled, an \"Uncached?\" option will be available for snippets. If disabled all snippets will be called cached.";
$_lang['contentblocks.snippet.uncached'] = "Cache?";
$_lang['contentblocks.snippet.uncached_0'] = "Si";
$_lang['contentblocks.snippet.uncached_1'] = "No, non mettere in cache questo snippet";
$_lang['contentblocks.snippet.none_available'] = "There are no snippets available for this Field.";

$_lang['contentblocks.layout_template.description'] = 'The template for this nested layout field. Keep in mind that any layouts contained within will also have their templates parsed. Available placeholder: <code>[[+value]]</code> (the fully parsed HTML from the contained layouts)';
$_lang['contentblocks.layoutfield.available_layouts'] = "Layout disponibili";
$_lang['contentblocks.layoutfield.available_layouts.description'] = "Comma-separated list of layouts which should be allowed. To not allow any layouts, for example to only allow templates to be inserted, specify -1.";
$_lang['contentblocks.layoutfield.available_templates'] = "Template disponibili";
$_lang['contentblocks.layoutfield.available_templates.description'] = "Comma-separated list of templates which should be allowed. To not allow any templates, specify -1.";

// Image related
$_lang['contentblocks.choose_image'] = "Seleziona immagine";
$_lang['contentblocks.wrapper_template'] = "Wrapper Template";
$_lang['contentblocks.nested_template'] = "Template annidato";
$_lang['contentblocks.max_images'] = "Maximum amount of Images";
$_lang['contentblocks.max_images_reached'] = "Sorry, you cannot use more than [[+max]] images in this Gallery.";
$_lang['contentblocks.upload_error'] = "Uh oh, something went wrong uploading [[+file]]: [[+message]]";
$_lang['contentblocks.upload_error.file_too_big'] = "\"\n\nThe file may have been too big.";
$_lang['contentblocks.image.thumbnail_size'] = "Manager Thumbnail Size";
$_lang['contentblocks.image.thumbnail_size.description'] = "Dimensions for manager thumbnails. Leave blank for none, one numeric value for square images, and dimensions in wxh for rectangular images. Example: 100 or 100x50";

// Misc
$_lang['contentblocks.use_contentblocks'] = "Usare ContentBlocks?";
$_lang['contentblocks.use_contentblocks.description'] = "When enabled, the content area will be replaced with a ContentBlocks canvas for creating multi-column, structured content.";
$_lang['contentblocks.or'] = "o";
$_lang['contentblocks.title'] = "Titolo";
$_lang['contentblocks.delete'] = "Elimina";
$_lang['contentblocks.delete_video'] = "Elimina video";
$_lang['contentblocks.move_layout_up'] = "Sposta su";
$_lang['contentblocks.move_layout_down'] = "Sposta giù";
$_lang['contentblocks.delete_image'] = "Elimina immagine";
$_lang['contentblocks.add_content'] = "Aggiungi contenuto";
$_lang['contentblocks.add_content.introduction'] = "Please select the type of content to insert into the layout. Hover over the name to check a longer description.";
$_lang['contentblocks.add_layout'] = "Aggiungi layout";
$_lang['contentblocks.add_layout.introduction'] = "Choose the Layout to add to the Content.";
$_lang['contentblocks.upload'] = "Upload";
$_lang['contentblocks.choose'] = "Choose";
$_lang['contentblocks.image.or_drop_images'] = "or drop images here";
$_lang['contentblocks.image.or_drop_image'] = "or drop an image here";
$_lang['contentblocks.use_tinyrte'] = "Use Tiny RTE?";
$_lang['contentblocks.use_tinyrte.description'] = "When enabled, the input will be enhanced with a tiny rich text editor allowing for simple formatting (bold, italics and links).";
$_lang['contentblocks.use_tinyrte.description.image'] = "When enabled, the title input will be enhanced with a tiny rich text editor allowing for simple formatting (bold, italics and links). If you use the title input for alt text or a title attribute, you may need to do some extra processing (i.e. htmlentities) to prevent the added markup from breaking your img tag. ";

$_lang['contentblocks.rebuild_content'] = "Rebuild Content";
$_lang['contentblocks.rebuild_content.confirm'] = "By rebuilding the content, all resources will be regenerated from their structured content. This means all layouts and fields previously used will be parsed again and the old content overwritten. Depending on the size of the website, this can take between several seconds and several minutes. To start this process, please click Yes below.";
$_lang['contentblocks.rebuild_content.initialising'] = "Initialising...";
$_lang['contentblocks.rebuild_content.resources_found'] = "Found a total of [[+total]] resources. Rebuild will take ~ [[+estimate]] minutes.";
$_lang['contentblocks.rebuild_content.loading_dependencies'] = "Loading dependencies for parsing content...";
$_lang['contentblocks.rebuild_content.loaded_dependencies'] = "Dependencies load, starting to rebuild content...";
$_lang['contentblocks.rebuild_content.skipping_not_allowed'] = "Skipping #[[+id]] ([[+pagetitle]]), ContentBlocks is instructed to not act on this resource (Type: [[+class_key]])";
$_lang['contentblocks.rebuild_content.skipping_not_used'] = "Skipping #[[+id]] ([[+pagetitle]]), does not yet use ContentBlocks.";
$_lang['contentblocks.rebuild_content.skipping_corrupt'] = "Skipping #[[+id]] ([[+pagetitle]]), the content is invalid or missing.";
$_lang['contentblocks.rebuild_content.done'] = "Done rebuilding content! [[+total_rebuild]] resources were rebuilt, [[+total_skipped]] were skipped and [[+total_skipped_broken]] were skipped because of invalid content.";
$_lang['contentblocks.rebuild_content.clear_cache'] = "Clearing the cache for context(s): [[+contexts]]";
$_lang['contentblocks.rebuild_content.clear_cache_complete'] = "Cache cleared. All done!";
$_lang['contentblocks.generating_canvas'] = "Generating your Content Canvas... this should only take a moment.";
$_lang['contentblocks.content'] = "Template Contents";
$_lang['contentblocks.open_template_builder'] = "Build Template";
$_lang['contentblocks.template_builder'] = "Template Builder";

/**
 * Settings. Oh boy.
 */

$_lang['setting_contentblocks.accepted_resource_types'] = "Accepted Resource Types";
$_lang['setting_contentblocks.accepted_resource_types_desc'] = "A comma separated list of resource Class Keys that ContentBlocks will attempt to enhance. ";

$_lang['setting_contentblocks.clear_cache_after_rebuild'] = "Clear Cache after Rebuild";
$_lang['setting_contentblocks.clear_cache_after_rebuild_desc'] = "When enabled the Rebuild Content feature in the component will automatically clear the resource cache when it is complete.";

$_lang['setting_contentblocks.debug'] = "Debug";
$_lang['setting_contentblocks.debug_desc'] = "When enabled ContentBlocks will use non-minified javascript in the manager to make it easier to debug issues.";

$_lang['setting_contentblocks.disabled'] = "Disabilitato";
$_lang['setting_contentblocks.disabled_desc'] = "Set this setting to 1 to completely disable ContentBlocks on this site. This can be overridden on the context level to only use it on specific contexts. ";

$_lang['setting_contentblocks.implode_string'] = "Implode String";
$_lang['setting_contentblocks.implode_string_desc'] = "The glue between individual field and layout outputs when parsing the content. ";

$_lang['setting_contentblocks.default_layout'] = "Layout di default";
$_lang['setting_contentblocks.default_layout_desc'] = "Specify the ID of the default layout to use on new resources, or resources that have not yet been used with ContentBlocks. As of 1.2, this only applies when no Default Template is found.";

$_lang['setting_contentblocks.default_layout_part'] = "Colonna di default";
$_lang['setting_contentblocks.default_layout_part_desc'] = "Specify the reference of a column in the Default Layout you specified. On new resources or resources that have not yet been used with ContentBlocks, a field (defined with the Default Field setting) will be inserted into this column with the content. As of 1.2, this only applies when no Default Template is found.";

$_lang['setting_contentblocks.default_field'] = "Campo di default";
$_lang['setting_contentblocks.default_field_desc'] = "Specify the ID of a field to insert into the default column of the default layout you specified. When set to 0, a simple rich text or textarea field will be used. As of 1.2, this only applies when no Default Template is found.";

$_lang['setting_contentblocks.code.theme'] = "Code Theme";
$_lang['setting_contentblocks.code.theme_desc'] = "The theme to use for the Code Input. Refer to the Ace documentation to find the possibilities.";

$_lang['setting_contentblocks.image.hash_name'] = "Hash Name";
$_lang['setting_contentblocks.image.hash_name_desc'] = "When enabled uploaded files will be hashed to obfuscate the original file names.";

$_lang['setting_contentblocks.image.prefix_time'] = "Prefix Time";
$_lang['setting_contentblocks.image.prefix_time_desc'] = "When enabled uploaded files will have their name prepended with a unix timestamp.";

$_lang['setting_contentblocks.image.sanitize'] = "Sanitize";
$_lang['setting_contentblocks.image.sanitize_desc'] = "When enabled uploaded file names will be sanitized before upload to make sure there are no funky characters. Sanitization also supports using transliteration with iconv or third party translit libraries.";

$_lang['setting_contentblocks.image.source'] = "Sorgente";
$_lang['setting_contentblocks.image.source_desc'] = "Choose the default media source to use for image and gallery input types. This can be overriden on the Field level.";

$_lang['setting_contentblocks.image.upload_path'] = "Upload Path";
$_lang['setting_contentblocks.image.upload_path_desc'] = "The path, within the defined media source, to which the files should be uploaded. This supports [[+year]], [[+month]], [[+day]], [[+user]], [[+username]] and [[+resource]] placeholders.";

$_lang['setting_contentblocks.sanitize_pattern'] = "Sanitize Pattern";
$_lang['setting_contentblocks.sanitize_pattern_desc'] = "A RegEx pattern to use in sanitizing file names that need to be sanitized.";

$_lang['setting_contentblocks.sanitize_replace'] = "Sanitize Replacement";
$_lang['setting_contentblocks.sanitize_replace_desc'] = "A string to replace occurrences of the RegEx pattern for sanitization with.";

$_lang['setting_contentblocks.custom_icon_path'] = "Custom icon path";
$_lang['setting_contentblocks.custom_icon_path_desc'] = "Path to custom icons. {assets_path} is allowed.";

$_lang['setting_contentblocks.custom_icon_url'] = "Custom icon URL";
$_lang['setting_contentblocks.custom_icon_url_desc'] = "URL to custom icons. {assets_url} is allowed.";

$_lang['setting_contentblocks.translit'] = "Transliteration";
$_lang['setting_contentblocks.translit_desc'] = "When set to a value that is not \"none\" or empty, this will enable transliteration prior to the sanitization process, enabling translating of invalid characters to valid ones. If this value is empty, it will inherit from the core \"friendly_alias_translit\" setting.";

$_lang['setting_contentblocks.hide_logo'] = "Nascondi logo";
$_lang['setting_contentblocks.hide_logo_desc'] = "By default we show a small modmore logo in the bottom right of the ContentBlocks component. If for whatever reason you don't want it there, simply enable this setting and it will disappear.";

$_lang['setting_contentblocks.translit_class'] = "Translit Class";
$_lang['setting_contentblocks.translit_class_desc'] = "The name of the class to use for transliteration. If this value is empty, it will inherit from the core \"friendly_alias_translit_class\" setting.";
$_lang['setting_contentblocks.translit_class_path'] = "Translit Class Path";
$_lang['setting_contentblocks.translit_class_path_desc'] = "The path to the class to use for transliteration. If this value is empty, it will inherit from the core \"friendly_alias_translit_class_path\" setting.";

$_lang['setting_contentblocks.base_url_mode'] = "Base URL Mode";
$_lang['setting_contentblocks.base_url_mode_desc'] = "When uploading images, the URLs are automatically normalised in a way relative to the base url to ensure they show up in the front and back-end. Depending on your MODX setup, especially in multi-context sites, you might need to change this mode for images to show in the front-end. The accepted values are: <code>relative</code> (default: images are relative to the MODX base url), <code>absolute</code> (image urls contain the MODX base url) or <code>full</code> (images contain the full MODX site url)";

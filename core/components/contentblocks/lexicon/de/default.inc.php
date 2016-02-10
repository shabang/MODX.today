<?php
$_lang['contentblocks'] = "Content Blocks";
$_lang['contentblocks.menu'] = "Content Blocks";
$_lang['contentblocks.menu_desc'] = "Verwalten Sie die Content Blocks Felder und Layouts.";
$_lang['contentblocks.mgr.home'] = "Content Blocks";

$_lang['contentblocks.general'] = "Allgemein";
$_lang['contentblocks.properties'] = "Eigenschaften";

$_lang['contentblocks.link'] = "Link";
$_lang['contentblocks.link.description'] = "Ein Feld, um Links zu erstellen. Resourcen, E-Mail-Adressen und URLs werden unterstützt.";
$_lang['contentblocks.link_template.description'] = "Eine Template für den Link. Verfügbare Platzhalter:  <code>[[+link]]</code>, <code>[[+link_raw]]</code>, <code>[[+linkType]]</code>";
$_lang['contentblocks.link.resource'] = "Ressource";
$_lang['contentblocks.link.url'] = "URL";
$_lang['contentblocks.link.email'] = "E-Mail-Adresse";
$_lang['contentblocks.link.link_new_tab'] = "In neuem Tab öffnen";
$_lang['contentblocks.link.add'] = "Link hinzufügen";
$_lang['contentblocks.link.remove'] = "Link entfernen";
$_lang['contentblocks.link.placeholder'] = "Fangen Sie an den Namen einer Ressource, externen Links oder e-Mail-Adresse einzugeben";
$_lang['contentblocks.link.link_detection_pattern_override'] = 'Link-Erkennungsmuster überschreiben';
$_lang['contentblocks.link.link_detection_pattern_override.description'] = 'Regex um festzustellen, ob ein Link gültig ist; falls nicht, wird http:// vorangestellt.';
$_lang['contentblocks.link.limit_to_current_context'] = 'Ressource-Ergebnisse auf aktuellen Kontext limitieren';
$_lang['contentblocks.link.limit_to_current_context.description'] = 'Beschränkt die Typeahead Ergebnisse auf Ressourcen, die sich im gleichen Kontext befinden';

$_lang['setting_contentblocks.link.link_detection_pattern'] = 'Link-Erkennungs-Muster';
$_lang['setting_contentblocks.link.link_detection_pattern_desc'] = 'Regex um festzustellen, ob ein Link gültig ist; falls nicht, wird http:// vorangestellt.';

$_lang['setting_contentblocks.typeahead.include_introtext'] = 'Introtext in Typeahead aufnehmen';
$_lang['setting_contentblocks.typeahead.include_introtext_desc'] = 'Wenn aktiviert, wird typeahead die Introtexte für jede der Ressourcen einbinden, um Ihnen mehr Informationen zu der Ressource bereitzustellen.';

$_lang['contentblocks.error.not_an_export'] = "Diese Datei scheint kein ContentBlocks-Export zu sein";
$_lang['contentblocks.error.importing_row'] = "Fehler beim Import der Zeile: ";
$_lang['contentblocks.error.no_valid_field'] = "Kein gültiges Feld gefunden";
$_lang['contentblocks.error.no_snippets'] = "Keine Snippets zur Verwendung verfügbar";
$_lang['contentblocks.error.missing_id'] = "ID-Eigenschaft fehlt";
$_lang['contentblocks.error.input_not_found'] = "Eingabe nicht gefunden";
$_lang['contentblocks.error.input_not_found.message'] = "Hoppla, ein Feld mit einem Eingabetyp \"[[+ Eingabe]]\" war definiert. Dieser Wert existiert aber nicht.";
$_lang['contentblocks.error.field_not_found'] = "Feld nicht gefunden";
$_lang['contentblocks.error.layout_not_found'] = "Layout nicht gefunden";
$_lang['contentblocks.error.error_saving_object'] = "Fehler beim Speichern des Objekts";
$_lang['contentblocks.error.xml_not_loaded'] = "Die XML-Datei konnte nicht geladen werden";
$_lang['contentblocks.error.no_icons'] = "Konnte Icon-Ordner nicht zum Lesen öffnen";
$_lang['contentblocks.error.no_json'] = "Ihr Browser unterstützt kein JSON, welches für ContentBlocks erforderlich ist. Bitte aktualisieren Sie Ihren Browser.";

$_lang['contentblocks.availability'] = "Verfügbarkeit";
$_lang['contentblocks.availability.layout_description'] = "Standardmäßig sind Layouts immer verfügbar. Wenn Sie nachfolgend Bedingungen hinzufügen, wird dieses Layout nur verfügbar sein, wenn die Bedingungen erfüllt sind. Trennen Sie mehrere gültige Werte mit einem Komma! ";
$_lang['contentblocks.availability.field_description'] = "Standardmäßig sind Felder immer verfügbar. Wenn Sie nachfolgende Bedingungen hinzufügen, wird dieses Feld nur verfügbar sein, wenn die Bedingungen erfüllt sind. Trennen Sie mehrere gültige Werte mit einem Komma! ";
$_lang['contentblocks.availability.template_description'] = "Standardmäßig sind Templates immer verfügbar. Wenn Sie nachfolgend Bedingungen hinzufügen, wird dieses Feld nur verfügbar sein, wenn die Bedingungen erfüllt sind. Trennen Sie mehrere gültige Werte mit einem Komma.";
$_lang['contentblocks.add_condition'] = "Bedingung hinzufügen";
$_lang['contentblocks.edit_condition'] = "Bedingung bearbeiten";
$_lang['contentblocks.delete_condition'] = "Bedingung löschen";
$_lang['contentblocks.delete_condition.confirm'] = "Sind Sie sicher, dass Sie diese Bedingung löschen möchten?";
$_lang['contentblocks.condition_field'] = "Feld";
$_lang['contentblocks.condition_field.resource'] = "Ressourcen-ID";
$_lang['contentblocks.condition_field.parent'] = "Eltern-Ressource";
$_lang['contentblocks.condition_field.ultimateparent'] = "Oberste Eltern-Ressource";
$_lang['contentblocks.condition_field.class_key'] = "Klassen-Schlüssel";
$_lang['contentblocks.condition_field.context'] = "Kontext";
$_lang['contentblocks.condition_field.template'] = "Template (ID)";
$_lang['contentblocks.condition_field.usergroup'] = "Benutzergruppe (Name)";
$_lang['contentblocks.condition_value'] = "Wert(e)";
$_lang['contentblocks.availibility.layouts'] = "Layout(s)";
$_lang['contentblocks.availibility.layouts.description'] = "Beschränken Sie die Verwendung dieses Felds auf ein oder mehrere Layouts (Komma-getrennt). Wenn Sie diese Einstellung leer lassen, kann dieses Feld in allen Layouts verwendet werden - ansonsten nur innerhalb der von Ihnen angegebenen Layouts. ";
$_lang['contentblocks.availibility.times_per_page'] = "Mal pro Seite";
$_lang['contentblocks.availibility.times_per_page.description'] = "Beschränken Sie die Verwendung auf diese Anzahl auf der Seite. Freilassen für keine Beschränkung.";
$_lang['contentblocks.availibility.times_per_layout'] = "Mal pro Layout";
$_lang['contentblocks.availibility.times_per_layout.description'] = "Beschränken Sie die Verwendung auf diese Anzahl auf der Seite. Freilassen für keine Beschränkung.";
$_lang['contentblocks.availibility.only_nested'] = "Nur als verschachteltes Layout erlauben";
$_lang['contentblocks.availibility.only_nested.description'] = "Das Layout nicht außerhalb des Layout-Feldes erlauben.";


$_lang['contentblocks.field_desc'] = "Felder sind der Grundgedanke hinter Content Blocks - sie definieren exakt, wie viel <em>Creative Freedom</em> Redakteure beim Bearbeiten von Inhalten erhalten sollen. Jedes Feld besteht hauptsächlich aus einem Eingabetyp und einem Template, das vorgibt, wie der Inhalt im Frontend ausgegeben werden soll. Mehr Informationen wie Sie Felder richtig einsetzen, erhalten Sie über den Hilfe-Button oben rechts.";
$_lang['contentblocks.add_field'] = "Feld hinzufügen";
$_lang['contentblocks.edit_field'] = "Feld bearbeiten";
$_lang['contentblocks.duplicate_field'] = "Feld duplizieren";
$_lang['contentblocks.delete_field'] = "Feld löschen";
$_lang['contentblocks.delete_field.confirm'] = "Sind Sie sicher, dass Sie dieses Feld löschen möchten? Es können unschöne Dinge mit Inhalten passieren, die dieses Feld noch verwenden! ";
$_lang['contentblocks.delete_field.confirm.js'] = "Sind Sie sicher, dass Sie dieses Feld löschen möchten?";
$_lang['contentblocks.export_field'] = "Feld exportieren";
$_lang['contentblocks.export_fields'] = "Exportieren";
$_lang['contentblocks.export_fields.confirm'] = "Wenn Sie unten Ja klicken, wird ein XML-Export aller Felder erzeugt. Dieser kann dazu genutzt werden, Felder später oder in einer anderen Installation wieder importieren zu können. Die Generierung kann abhängig von der Anzahl der konfigurierten Felder ein paar Sekunden in Anspruch nehmen.";
$_lang['contentblocks.import_fields'] = "Importieren";
$_lang['contentblocks.import_fields.title'] = "Felder importieren";
$_lang['contentblocks.import_fields.intro'] = "Wenn Sie eine XML-Datei hochladen und den richtigen Importmodus wählen, können Sie zuvor aus einer anderen Installation exportierte Felder hier übernehmen. <b>Seien Sie vorsichtig</b>, wenn Sie Felder importieren, die bereits existieren und von Inhalten genutzt werden! Bitte wenden Sie sich an support@modmore.com, wenn Sie sich unsicher sind, welchen Import-Modus Sie verwenden sollen. ";

$_lang['contentblocks.layout_desc'] = "Jedes Layout ist im wesentlichen eine horizontale Zeile, die aus einer oder mehreren Spalten besteht. Wenn Sie eine Ressource bearbeiten, sind alle Spalten leere Bereiche, denen Inhalt (über Felder) hinzugefügt werden kann. Mehr Informationen wie Sie Layouts korrekt verwenden, erhalten Sie über den Hilfe-Button oben rechts!";
$_lang['contentblocks.add_layout'] = "Layout hinzufügen";
$_lang['contentblocks.repeat_layout'] = "Layout wiederholen";
$_lang['contentblocks.edit_layout'] = "Layout bearbeiten";
$_lang['contentblocks.duplicate_layout'] = "Layout duplizieren";
$_lang['contentblocks.export_layout'] = "Layout exportieren";
$_lang['contentblocks.delete_layout'] = "Layout löschen";
$_lang['contentblocks.delete_layout.confirm'] = "Sind Sie sichder, dass dieses Layout gelöscht werden soll? Es können unschöne Dinge mit Inhalten passieren, die dieses Layout noch verwenden! ";
$_lang['contentblocks.delete_layout.confirm.js'] = "Sind Sie sicher, dass dieses Layout [[+layoutName]] gelöscht werden soll? Auch sein Inhalt wird gelöscht, wenn Sie fortfahren.";
$_lang['contentblocks.export_layouts'] = "Exportieren";
$_lang['contentblocks.export_layouts.confirm'] = "Wenn Sie unten Ja klicken, wird ein XML-Export aller Layouts generiert. Dieser kann dazu genutzt werden, Layouts später oder in einer anderen Installation wieder zu importieren. Die Generierung der XML-Datei kann in Abhängigkeit von der Anzahl der konfigurierten Layouts ein paar Sekunden dauern.";
$_lang['contentblocks.import_layouts'] = "Importieren";
$_lang['contentblocks.import_layouts.title'] = "Layouts importieren";
$_lang['contentblocks.import_layouts.intro'] = "Wenn Sie eine XML-Datei hochladen und den richtigen Importmodus wählen, können Sie zuvor aus einer anderen Installation exportierte Layouts hier übernehmen. <b>Seien Sie vorsichtig</b>, wenn Sie Layouts importieren, die bereits existieren und von Inhalten genutzt werden! Bitte wenden Sie sich an support@modmore.com, wenn Sie sich unsicher sind, welchen Import-Modus Sie verwenden sollen. ";

$_lang['contentblocks.layout_settings'] = "Layout-Einstellungen";
$_lang['contentblocks.layout_settings.modal_header'] = "[[+name]]-Einstellungen";

$_lang['contentblocks.field_settings'] = "Inhalts-Einstellungen";
$_lang['contentblocks.field_settings.modal_header'] = "[[+name]]-Einstellungen";

$_lang['contentblocks.add_layoutcolumn'] = "Spalte hinzufügen";
$_lang['contentblocks.edit_layoutcolumn'] = "Spalte bearbeiten";
$_lang['contentblocks.delete_layoutcolumn'] = "Spalte löschen";
$_lang['contentblocks.delete_layoutcolumn.confirm'] = "Sine Sie sicher, dass diese Spalte gelöscht werden soll? Es können unschöne Dinge mit Inhalten passieren, die diese Spalte noch nutzen. ";
$_lang['contentblocks.add_setting'] = "Einstellung hinzufügen";
$_lang['contentblocks.edit_setting'] = "Einstellung bearbeiten";
$_lang['contentblocks.delete_setting'] = "Einstellung löschen";
$_lang['contentblocks.delete_setting.confirm'] = "Sind Sie sicher, dass diese Einstellung gelöscht werden soll?";

$_lang['contentblocks.defaults'] = 'Standardwerte';
$_lang['contentblocks.defaults.intro'] = 'Mit Standardwerten können Sie festlegen, wie die Ressourcen, die noch nicht mit ContentBlocks (wie beispielsweise neue Ressourcen, oder Seiten, die vor der Installation von ContentBlocks bestanden) bearbeitet wurden, verwaltet werden. Dies funktioniert durch von oben nach unten durchlaufen der definierten Standardregeln welche unten definiert sind, bis eine Übereinstimmung gefunden wird und das definierte Template einfügt wird.';
$_lang['contentblocks.constraint_field'] = 'Einschränkung-Feld';
$_lang['contentblocks.constraint_value'] = 'Einschränkungswert';
$_lang['contentblocks.default_template'] = 'Standard Template';
$_lang['contentblocks.target_layout'] = 'Ziel-Layout';
$_lang['contentblocks.target_field'] = 'Zielfeld';
$_lang['contentblocks.target_column'] = 'Zielspalte';
$_lang['contentblocks.add_default'] = 'Standardregel hinzufügen';
$_lang['contentblocks.edit_default'] = 'Standardregel bearbeiten';
$_lang['contentblocks.delete_default'] = 'Standard-Regel löschen';
$_lang['contentblocks.delete_default.confirm'] = 'Sind Sie sicher, dass Sie diese Default-Regel löschen möchten?';


$_lang['contentblocks.start_import'] = "Import starten";
$_lang['contentblocks.import_file'] = "Datei";
$_lang['contentblocks.import_mode'] = "Import-Modus";
$_lang['contentblocks.import_mode.insert'] = "Einfügen: bestehende [[+what]] auslassen und neue Daten hinzufügen";
$_lang['contentblocks.import_mode.overwrite'] = "Überschreiben: bestehende [[+what]] auslassen, aber überschreiben, wenn sie dieselbe ID haben";
$_lang['contentblocks.import_mode.replace'] = "Ersetzen: zunächst alle bestehenden [[+what]] löschen, dann neue Zeilen hinzufügen.";

$_lang['contentblocks.id'] = "ID";
$_lang['contentblocks.field'] = "Feld";
$_lang['contentblocks.fields'] = "Felder";
$_lang['contentblocks.layout'] = "Layout";
$_lang['contentblocks.layout.description'] = "Ein Wrapper für Felder";
$_lang['contentblocks.layouts'] = "Layouts";
$_lang['contentblocks.layoutcolumn'] = "Spalte";
$_lang['contentblocks.layoutcolumns'] = "Spalten";
$_lang['contentblocks.setting'] = "Einstellung";
$_lang['contentblocks.settings'] = "Einstellungen";
$_lang['contentblocks.settings.layout_description'] = "Einstellungen sind benutzerdefinierte Eigenschaften, die konfiguriert werden können, wenn ein Layout dem Inhalt hinzugefügt wurde. Der Wert der Einstellung ist im Template als Platzhalter verfügbar, zum Beispiel [[+class]] für eine Einstellung mit der Referenz \"class\".";
$_lang['contentblocks.settings.field_description'] = "Einstellungen sind benutzerdefinierte Eigenschaften, die konfiguriert werden können, wenn ein Feld dem Inhalt hinzugefügt wurde. Der Wert der Einstellung ist im Template als Platzhalter verfügbar, zum Beispiel [[+class]] für eine Einstellung mit der Referenz \"class\".";
$_lang['contentblocks.input'] = "Eingabe-Typ";
$_lang['contentblocks.inputs'] = "Eingabe-Typen";
$_lang['contentblocks.name'] = "Name";
$_lang['contentblocks.columns'] = "Spalten";
$_lang['contentblocks.columns.description'] = "Spalten legen fest, wie das Layout im Manager dargestellt wird, wobei die Breite in Prozent angegeben wird. Als Referenz geben Sie den Namen eines Platzhalters an, den Sie im Template verwenden können. ";
$_lang['contentblocks.sortorder'] = "Sortier-Reihenfolge";
$_lang['contentblocks.icon'] = "Symbol";
$_lang['contentblocks.description'] = "Beschreibung";
$_lang['contentblocks.template'] = "Template";
$_lang['contentblocks.template.description'] = "Im Layout-Template können verschiedene Platzhalter genutzt werden, abhängig von den Spalten und Einstellungen, die Sie über die Tabs links konfiguriert haben. ";
$_lang['contentblocks.width'] = "Breite";
$_lang['contentblocks.width.description'] = "Die Breite des Feldes (in Prozent), die dieses Feld in die Bühne verwendet. Felder sind \"floated left\", sodass Sie grundlegende Layouts mit dieser Option erstellen können.";
$_lang['contentblocks.save'] = "Speichern";
$_lang['contentblocks.reference'] = "Referenz";
$_lang['contentblocks.default_value'] = "Standard-Wert";
$_lang['contentblocks.fieldtype'] = "Feld-Typ";
$_lang['contentblocks.fieldtype.select'] = "Auswahlfeld";
$_lang['contentblocks.fieldtype.radio'] = "Radio-Optionen";
$_lang['contentblocks.fieldtype.checkbox'] = "CheckBox-Optionen";
$_lang['contentblocks.fieldtype.textfield'] = "Textfeld";
$_lang['contentblocks.fieldtype.link'] = "Link";
$_lang['contentblocks.fieldtype.textarea'] = "Mehrzeiliges Textfeld";
$_lang['contentblocks.fieldoptions'] = "Feld-Optionen";
$_lang['contentblocks.fieldoptions.description'] = "Nur für Auswahlfelder. Legen Sie mögliche Optionen nach dem Schema \"Angezeigter Wert=platzhalter_wert\", eine Option pro Zeile. Wenn Sie nur einen einzelnen Wert pro Zeile (z.B. \"foo\") angeben, wird dieser sowohl angezeigt als auch als Platzhalter-Wert verwendet.";
$_lang['contentblocks.field_is_exposed'] = "Feld anzeigen";
$_lang['contentblocks.field_is_exposed.description'] = "Zeige Feld auf Fläche, anstatt erst nach Klick auf das Einstellungen-Icon";
$_lang['contentblocks.field_is_exposed.modal'] = "Zeige Feld-Einstellungen in einem Modal-Fenster";
$_lang['contentblocks.field_is_exposed.exposedassetting'] = "Zeige Feld als Einstellmöglichkeit auf Fläche";
$_lang['contentblocks.field_is_exposed.exposedasfield'] = "Zeige Feld auf Fläche als normales Feld";

$_lang['contentblocks.directory'] = 'Ordner';
$_lang['contentblocks.directory.description'] = 'Ein Unterordner in einer Medienquelle (ob überschrieben oder unter Verwendung der ContentBlocks-Systemeinstellung)';
$_lang['contentblocks.file_types'] = 'Erlaubte Dateierweiterungen';
$_lang['contentblocks.file_types.description'] = 'Dateien mit diesen Erweiterungen (durch Kommata getrennt) werden hochgeladen. Freilassen für keine Beschränkung.';
$_lang['contentblocks.file_types.disallowed'] = 'Dateityp in diesem Feld nicht erlaubt';

// Templates
$_lang['contentblocks.templates'] = 'Templates';
$_lang['contentblocks.templates_desc'] = 'Templates sind vordefinierte Sets von Layouts und Feldern, die als Vereinfachung verwendet werden können, um Inhalt zur Seite hinzuzufügen. ';
$_lang['contentblocks.add_template'] = 'Template hinzufügen';
$_lang['contentblocks.edit_template'] = 'Template bearbeiten';
$_lang['contentblocks.duplicate_template'] = 'Template duplizieren';
$_lang['contentblocks.export_template'] = 'Template exportieren';
$_lang['contentblocks.export_templates'] = 'Template exportieren';
$_lang['contentblocks.import_templates'] = 'Templates importieren';
$_lang['contentblocks.import_templates.title'] = 'Templates importieren';
$_lang['contentblocks.import_templates.intro'] = 'Durch das Hochladen einer XML-Datei und Auswahl des passenden Importmodus, können Sie Templates importieren, die Sie vorher oder auf einer anderen Website exportiert haben. <b>Hinweis:</b> Templates enthalten Verweise auf Feld- und Layout-IDs; falls Sie Templates importieren, müssen Sie wahrscheinlich auch Layouts und Felder von der selben Website importieren.';
$_lang['contentblocks.delete_template'] = 'Template löschen';
$_lang['contentblocks.delete_template.confirm'] = 'Sind Sie sicher, dass Sie diese Template löschen wollen?';


// Input types
$_lang['contentblocks.chunk'] = "Chunk";
$_lang['contentblocks.chunk.description'] = "Fügt dem Inhalt einen bestimmten Chunk hinzu.";
$_lang['contentblocks.chunk.choose_chunk'] = "Chunk wählen";
$_lang['contentblocks.chunk.choose_chunk.description'] = "Wählen Sie den Chunk der hinzugefügt werden soll.";
$_lang['contentblocks.chunk_template.description'] = "Vorlage für einen Chunk. Verfügbaren Platzhalter: <code>[[+tag]]</code>, <code>[[+chunk_name]]</code>";
$_lang['contentblocks.chunk.custom_preview'] = "Angepasste Vorschau";
$_lang['contentblocks.chunk.custom_preview.description'] = "Wenn dieses Feld leer ist, wird der eigentliche Chunk als Vorschau im Manager angezeigt. Alternativ können Sie hier auch eigenen HTML-Code angeben, der zur Vorschau im Manager verwendet werden soll. ";
$_lang['contentblocks.chunk.no_chunk_set'] = "Hoppla... Für dieses Feld wurde kein Chunk angegeben.";

$_lang['contentblocks.chunkselector'] = 'Chunk-Auswahl';
$_lang['contentblocks.chunk_selector_template.description'] = 'Template für den ausgewählten Chunk. Verfügbare Platzhalter <code>[[+value]]</code>(Beinhaltet vollständigen Chunk), <code>[[+chunk_name]]</code>(Beinhaltet nur den Namen des Chunks)';
$_lang['contentblocks.chunkselector.description'] = 'Wählen Sie einen Chunk, der angezeigt werden soll';
$_lang['contentblocks.chunkselector.available_chunks'] = "Namen oder IDs der zulässigen Chunks (optional)";
$_lang['contentblocks.chunkselector.available_chunks.description'] = "Um die verfügbaren Chunks einzugrenzen, geben Sie bitte durch Kommata getrennt die Chunk-Namen oder IDs an. Chunks in dieser Liste werden immer verfügbar sein, unabhängig von den anderen, unten aufgeführten Einstellungen.";
$_lang['contentblocks.chunkselector.available_categories'] = "Kategorien";
$_lang['contentblocks.chunkselector.available_categories.description'] = "Geben Sie eine Liste zulässiger Kategorie-Namen oder -IDs an, um die Auswahl der Chunks einzuschränken.";

$_lang['contentblocks.code'] = "Code";
$_lang['contentblocks.code.description'] = "Zeigt einen Textbereich mit Syntax-Hervorhebung.";
$_lang['contentblocks.code_template.description'] = "Der Wert dieses Felds wird in dem Platzhalter <code>[[+value]]</code> gespeichert. Je nachdem, wie Sie dieses Feld verwenden möchten, fügen Sie diesen Platzhalter einfach dem Template hinzu, oder kodieren ihn vorher (z.B. über <code>&lt;pre&gt;&lt;code&gt;[[+value:htmlent]]&lt;/code&gt;&lt;/pre&gt;), damit er angezeigt und nicht ausgegeben wird. Der Platzhalter <code>[[+lang]]</code> enthält die ausgewählte Programmiersprache.";
$_lang['contentblocks.code.available_languages'] = "Verfügbare Programmiersprachen";
$_lang['contentblocks.code.available_languages.description'] = "Geben Sie eine Komma-getrennte Liste mit Einträgen nach dem Schema <code>value=display</code> für die verfügbaren Sprachen mit Syntax-Hervorhebung an. Wenn nur eine Sprache zur Verfügung steht, wird diese automatisch gewählt und das Auswahlfeld wird ausgeblendet.";
$_lang['contentblocks.code.default_language'] = "Standard-Sprache";
$_lang['contentblocks.code.default_language.description'] = "Die Programmiersprache die standardmäßig ausgewählt werden soll.";
$_lang['contentblocks.code.language'] = "Sprache";
$_lang['contentblocks.code.entities'] = "Entities kodieren?";
$_lang['contentblocks.code.entities.description'] = "Falls aktiviert wird der eingegebene Code und MODX tags umgeschrieben, sodass er angezeigt und nicht ausgeführt wird.";

$_lang['contentblocks.file'] = 'Datei-Eingabe';
$_lang['contentblocks.file.description'] = 'Hinzufügen von Dateien zur Verlinkung';
$_lang['contentblocks.file_template.description'] = 'Gültige Platzhalter sind <code>[[+url]]</code>, <code>[[+title]]</code>, <code>[[+size]]</code> (in Bytes), <code>[[+upload_date]]</code> und <code>[[+extension]]</code>';
$_lang['contentblocks.file.remove_file'] = 'Datei entfernen';
$_lang['contentblocks.file.max_files'] = 'Maximale Dateianzahl';
$_lang['contentblocks.file.file.or_drop_files'] = 'oder Dateien per Drag & Drop hier hinziehen';
$_lang['contentblocks.file.max_files'] = 'Maximale Dateianzahl';
$_lang['contentblocks.file.max_files.description'] = 'Definiert die maximale Anzahl der pro Upload Feld zulässigen Dateien. Zusätzliche Dateien über dem Limit werden abgelehnt.';
$_lang['contentblocks.file.max_files.reached'] = 'Leider können nicht mehr als [[+max]] Dateien in dieser Sektion nutzen.';
$_lang['contentblocks.file.directory'] = 'Ordner';
$_lang['contentblocks.file.directory.description'] = 'Ein Unterordner in einer Medienquelle (ob überschrieben oder unter Verwendung der ContentBlocks-Systemeinstellung)';
$_lang['contentblocks.file.file_types'] = 'Erlaubte Dateierweiterungen';
$_lang['contentblocks.file.file_types.description'] = 'Dateien mit diesen Erweiterungen (durch Kommata getrennt) werden hochgeladen. Freilassen für keine Beschränkung.';
$_lang['contentblocks.file.file_types.disallowed'] = 'Dateityp in diesem Feld nicht erlaubt';
$_lang['contentblocks.file.choose_file'] = 'Datei auswählen';

$_lang['contentblocks.gallery'] = "Galerie";
$_lang['contentblocks.gallery.description'] = "Ein einfacher Eingabetyp für eine Galerie, inkl. einfachen Mehrfach-Bild-Uploads, Sortierung per Drag/Drop und Titel-Attributen. ";
$_lang['contentblocks.gallery_template.description'] = "Wird benutzt, um einzelne Bilder zu umschließen. Mögliche Platzhalter: <code>[[+url]]</code> (der vollständige Link zum Bild) und <code>[[+title]]</code> (der für das jeweilige Bild angegebene Titel), <code>[[+size]]</code>, <code>[[+extension]]</code>";
$_lang['contentblocks.gallery_wrapper_template.description'] = "Wird als Container benutzt, der alle Bilder enthält. Mögliche Platzhalter: <code>[[+images]]</code>";
$_lang['contentblocks.gallery_max_images.description'] = "Legt die maximale Anzahl an Bildern fest, die pro Galerie erlaubt sein sollen. Bei Überschreiten dieses Limits werden weitere Bilder zurückgewiesen. ";
$_lang['contentblocks.gallery.thumb_size'] = "Thumbnail Größe";
$_lang['contentblocks.gallery.thumb_size.description'] = "Geben Sie über eine der Optionen an, wie groß/klein die Thumbnails sein sollen, die im Manager angezeigt werden.";
$_lang['contentblocks.gallery.thumb_size.small'] = "Klein";
$_lang['contentblocks.gallery.thumb_size.medium'] = "Mittel";
$_lang['contentblocks.gallery.thumb_size.large'] = "Groß";
$_lang['contentblocks.gallery.show_description'] = "Beschreibung anzeigen";
$_lang['contentblocks.gallery.show_description.description'] = "Zeige ein Beschreibungsfeld, um dem Bearbeiter für jedes Bild das Eintragen einer längeren Beschreibung  zu ermöglichen.";
$_lang['contentblocks.gallery.show_link_field'] = "Link-Feld anzeigen";
$_lang['contentblocks.gallery.show_link_field.description'] = "Zeige den Link an damit Bilder mit Ressourcen oder externen Websites verknüpft werden können.";

$_lang['contentblocks.heading'] = "Überschrift";
$_lang['contentblocks.heading.description'] = "Eine Kombination aus einem Auswahlfeld (legt fest, welcher Ordnung eine Überschrift sein soll) und einem Textfeld.";
$_lang['contentblocks.heading_template.description'] = "Template für ein Überschriften-Feld. Mögliche Platzhalter sind: <code>[[+level]]</code> (die gewählte Ordnung der Überschrift) und <code>[[+value]]</code> (der im Textfeld angegebene Wert).";
$_lang['contentblocks.default_level'] = "Standard-Ordnung";
$_lang['contentblocks.available_levels'] = "Mögliche Ordnungen";
$_lang['contentblocks.heading_default_level.description'] = "Der Wert der standardmäßig bei neuen Instanzen des Überschriften-Eingabefelds vorausgewählt sein soll.";
$_lang['contentblocks.heading_available_levels.description'] = "Eine Komma-getrennte Liste mit Einträgen nach dem Schema <code>value=display</code> für verfügbare Überschriften-Ordnungen. Zur Darstellung wird im Lexikon nach einem gleichnamigen Eintrag mit dem Präfix  <code>contentblocks.</code> gesucht und genutzt, falls ein solcher existiert. Beispiel: <code>h1=heading_1, h2=Überschrift 2. Ordnung ,h3=heading_3</code>";
$_lang['contentblocks.heading_1'] = "Überschrift 1";
$_lang['contentblocks.heading_2'] = "Überschrift 2";
$_lang['contentblocks.heading_3'] = "Überschrift 3";
$_lang['contentblocks.heading_4'] = "Überschrift 4";
$_lang['contentblocks.heading_5'] = "Überschrift 5";
$_lang['contentblocks.heading_6'] = "Überschrift 6";

$_lang['contentblocks.hr'] = "Horizontale Linie";
$_lang['contentblocks.hr.description'] = "Ein einfacher Platzhalter für ein <hr>-Tag, um eine horizontale Linie einzufügen.";
$_lang['contentblocks.hr_template.description'] = "Das Template um die horizontale Linie auszugeben. Es gibt hierfür keine Platzhalter, aber es wird empfohlen, das <code>&lt;hr&gt;</code>-Tag zu verwenden.";

$_lang['contentblocks.image'] = "Bild";
$_lang['contentblocks.image.description'] = "Ein Eingabetyp zum einfachen Upload oder zur Auswahl eines Bildes. ";
$_lang['contentblocks.image.source'] = "Medienquelle";
$_lang['contentblocks.image.source.description'] = "Belassen Sie diese Einstellung auf (keine), um die Standard-Medienquelle des Systems für Bilder zu verwenden, oder geben Sie eine bestimmte Medienquelle an, um die Medienquelle für dieses spezifische Feld zu überschreiben.";
$_lang['contentblocks.image_template.description'] = "Vorlage für den Eingabetyp Bild. Sollte einen <code>&lt; Img &gt;</code>-Tag enthalten. Verfügbare Platzhalter: <code>[[+url]]</code>, <code>[[+size]]</code>, <code>[[+width]]</code>, <code>[[+height]]</code>, <code>[[+extension]]</code>";
$_lang['contentblocks.imagewithtitle'] = "Bild mit Titel";
$_lang['contentblocks.imagewithtitle.description'] = "Dasselbe wie der Bild-Eingabetyp, aber zusätzlich mit einem Textfeld, über das ein alt- oder title-Attribut angegeben werden kann.";
$_lang['contentblocks.image_with_title'] = $_lang['contentblocks.imagewithtitle'];
$_lang['contentblocks.image_with_title_template.description'] = "Vorlage für den Eingabetyp Bild. Sollte einen <code>&lt;Img&gt;</code>-Tag enthalten. Verfügbare Platzhalter: <code>[[+url]]</code>, <code>[[+title]]</code>, <code>[[+size]]</code>, <code>[[+width]]</code>, <code>[[+height]]</code>, <code>[[+extension]]</code>";

$_lang['contentblocks.list'] = "Liste";
$_lang['contentblocks.list.description'] = "Eingabetyp zur einfachen Erstellung (beliebig verschachtelbarer) ungeordneter Aufzählungslisten. ";
$_lang['contentblocks.list_template.description'] = "Template für einzelne Listen-Einträge. Dies sollte in den meisten Fällen ein <code>&lt;li&gt;</code>-Tag enthalten. Mögliche Platzhalter: <code>[[+value]]</code> (der Text des Listeneintrags), <code>[[+idx]]</code> (eine automatisch hochgezählte Eintragsnummer, beginnend mit 1 auf jedem Level) und <code>[[+items]]</code> (untergeordnete/verschachtelte Listen, wird über die anderen Templates ausgegeben).  ";
$_lang['contentblocks.list_wrapper_template.description'] = "Das Template zum Umschließen der Liste auf oberster Ebene. Dies sollte in den meisten Fällen ein <code>&lt;ul&gt;</code>-Tag enthalten. Mögliche Platzhalter: <code>[[+items]]</code> (Listeneinträge, diese werden über die anderen Templates ausgegeben. ";
$_lang['contentblocks.list_nested_template.description'] = "Das Template zum Umschließen untergeordneter/verschachtelter Listen. Dies sollte in den meisten Fällen ein <code>&lt;ul&gt;</code>-Tag enthalten. Mögliche Platzhalter: <code>[[+items]]</code> (Listeneinträge, diese werden über die anderen Templates ausgegeben). ";

$_lang['contentblocks.orderedlist'] = "Geordnete Liste";
$_lang['contentblocks.orderedlist.description'] = "Eingabetyp zur einfachen Erstellung (beliebig verschachtelbarer) geordneter Aufzählungslisten.";
$_lang['contentblocks.ordered_list'] = $_lang['contentblocks.orderedlist'];
$_lang['contentblocks.ordered_list_template.description'] = "Template für einzelne Listen-Einträge. Dies sollte in den meisten Fällen ein <code>&lt;li&gt;</code>-Tag enthalten. Mögliche Platzhalter: <code>[[+value]]</code> (der Text des Listeneintrags), <code>[[+idx]]</code> (eine automatisch hochgezählte Eintragsnummer, beginnend mit 1 auf jedem Level) und <code>[[+items]]</code> (untergeordnete/verschachtelte Listen, wird über die anderen Templates ausgegeben). ";
$_lang['contentblocks.ordered_list_wrapper_template.description'] = "Das Template zum Umschließen der Liste auf oberster Ebene. Dies sollte in den meisten Fällen ein <code>&lt;ul&gt;</code>-Tag enthalten. Mögliche Platzhalter: <code>[[+items]]</code> (Listeneinträge, diese werden über die anderen Templates ausgegeben. ";
$_lang['contentblocks.ordered_list_nested_template.description'] = "Das Template zum Umschließen untergeordneter/verschachtelter Listen. Dies sollte in den meisten Fällen ein <code>&lt;ul&gt;</code>-Tag enthalten. Mögliche Platzhalter: <code>[[+items]]</code> (Listeneinträge, diese werden über die anderen Templates ausgegeben). ";

$_lang['contentblocks.quote'] = "Zitat";
$_lang['contentblocks.quote.description'] = "Ein Textbereich-Eingabefeld, kombiniert mit einem kleinen Textfeld für Urheber-/Autoren-Angaben zum Zitat";
$_lang['contentblocks.quote_template.description'] = "Das Template für das Zitat. Dieses sollte in den meisten Fällen ein <code>&lt;blockquote&gt;</code>- und ein <code>&lt;cite&gt;</code>-Tag enthalten. Mögliche Platzhalter: <code>[[+value]]</code> (das Zitat) and <code>[[+cite]]</code> (der angegebene Urheber/Autor des Zitats).";
$_lang['contentblocks.quote.author'] = "Autor";

$_lang['contentblocks.repeater'] = "Repeater";
$_lang['contentblocks.repeater.description'] = "Erlaubt es eine Gruppe von Feldern zu definieren, welche der Editor als Gruppe wiederholen kann.";
$_lang['contentblocks.repeater_template.description'] = "Die Vorlage für jede einzelne Zeile in dem Repeater-Feld. Es gibt keine Standardwerte, da diese ausschließlich von Ihrer Gruppen-Konfiguration abhängig sind! Für jedes der Felder, welches Sie festlegen, müssen Sie auch einen Schlüssel-Wert setzen. Der Repeater wird zuerst alle definierten Felder mit ihrem eigenen Prozessor durchlaufen (z.B. wird ein Bildfeld zunächst so geparst, als ob es ein einzelnes Bildfeld wäre), und das Ergebnis wird im Platzhalter mit dem Namen des Schlüssels gespeichert. Bitte lesen Sie die Dokumentation auf modmore.com für eine ausführlichere Anleitung dafür, wie das Repeater-Feld arbeitet.";
$_lang['contentblocks.repeater.width'] = "Breite (in %)";
$_lang['contentblocks.repeater.key'] = "Schlüssel";
$_lang['contentblocks.repeater.key.description'] = "Der Schlüssel bei denen der Wert dieses Feldes in der Repeater-Vorlage zur Verfügung steht. ";
$_lang['contentblocks.repeater.group'] = "Gruppe";
$_lang['contentblocks.repeater.group.description'] = "Mit dem Repeater-Feld können Sie eine Gruppe von Feldern wiederholen. Hier können Sie die Felder definieren welche sich wiederholen sollen.";
$_lang['contentblocks.repeater.max_items'] = "Maximale Anzahl von Elementen";
$_lang['contentblocks.repeater.max_items.description'] = "Wann Sie eine Zahl größer als 0 wählen, können keine zusätzlichen Zeilen über diese Grenze hinaus hinzugefügt werden.";
$_lang['contentblocks.repeater.max_items_reached'] = "Tut mir leid, Sie dürfen dieses Element nicht mehr als [[+ max]] mal hinzufügen.";
$_lang['contentblocks.repeater.min_items'] = "Minimale Anzahl Elemente";
$_lang['contentblocks.repeater.min_items.description'] = "Wenn der Wert auf eine Zahl größer als 0 gesetzt wird, können Zeilen über diese Grenze hinaus nicht entfernt werden.";
$_lang['contentblocks.repeater.add_item'] = "Eintrag hinzufügen";
$_lang['contentblocks.repeater.delete_item'] = "Eintrag löschen";
$_lang['contentblocks.repeater.wrapper_template.description'] = "Die äußere Vorlagen, die alle anderen geparsten Zeilen umschließt. Sollte den <code>[[+row]]</code> Platzhalter enthalten, kann aber auch <code>[[+total]]</code> enthalten.";
$_lang['contentblocks.repeater.row_separator'] = "Zeilentrennzeichen";
$_lang['contentblocks.repeater.row_separator.description'] = "Eine Zeichenkette zum zusammenfügen individueller Reihen. Dies könnte nur ein paar Zeilenumbrüche sein, wie in der Standardvorgabe, oder es könnten html-Tags sein die Sie zwischen den Zeilen einfügen möchten.";


$_lang['contentblocks.richtext'] = "Formatierter Text";
$_lang['contentblocks.richtext.description'] = "Ein einfaches Rich-Text-Feld. Unterstützt sowohl TinyMCE als auch Redactor.";
$_lang['contentblocks.richtext_template.description'] = "Da Rich-Text-Felder typischerweise ihr eigenes Markup generieren, wird als Template normalerweise nur der <code>[[+value]]</code> Platzhalter verwendet, wobei Sie dies natürlich auch von einem Container oder Ähnlichem umschließen können.";

$_lang['contentblocks.table'] = "Tabelle";
$_lang['contentblocks.table.description'] = "Interaktives Widget für Tabellen. ";
$_lang['contentblocks.table_template.description'] = "Vorlage für jede der Tabellenzellen. Sollte einen &lt;td&gt; tag enthalten. Verfügbare Platzhalter: <code>[[+cell]]</code>, <code>[[+colIdx]]</code>, <code>[[+colTotal]]</code>";
$_lang['contentblocks.table.row_template'] = "Zeilen-Template";
$_lang['contentblocks.table.row_template.description'] = "Die Vorlage für jede der Zeilen in der Tabelle, enthält wahrscheinlich einen <code>&lt;tr&gt;</ code> -Tag. Verfügbare Platzhalter: <code>[[+ row]]</ code> (enthält jede der Zellen in dieser Zeile), <code>[[+ idx]]</ code>";
$_lang['contentblocks.table.wrapper_template.description'] = "Der Wrapper-Vorlage für die gesamte Tabelle. Verfügbare Platzhalter: <code>[[+body]]</ code>, <code>[[+total]]</ code>.";

$_lang['contentblocks.textarea'] = "Textbereich";
$_lang['contentblocks.textarea.description'] = "Ein einfaches, mehrzeiliges Textfeld.";

$_lang['contentblocks.textfield'] = "Textfeld";
$_lang['contentblocks.textfield.description'] = "Ein einfaches, einzeiliges Textfeld.";
$_lang['contentblocks.textfield_template.description'] = "Um den Wert des Textfeldes auszugeben, verwenden Sie einfach den Platzhalter <code>[[+value]]</code> mit einem umschließenden Container Ihrer Wahl (ein Absatz, eine Überschrift, etc.).";

$_lang['contentblocks.video'] = "Video";
$_lang['contentblocks.video.description'] = "Die YouTube-Integration erlaubt Ihnen nach Schlüsselbegriffen zu suchen und Videos über YouTube-Links einzufügen.";
$_lang['contentblocks.video_template.description'] = "Bei Eingabe eines Videos findet sich dessen ID im Platzhalter <code>[[+value]]</code>. Diese kann verwendet werden, um den Code zum Einbetten über dieses Template zu generieren.";
$_lang['contentblocks.video.search'] = "Suchen!";
$_lang['contentblocks.video.search_introduction'] = "Benutzen Sie das Suchfeld unten, um nach Videos bei YouTube zu suchen!";
$_lang['contentblocks.video.enter_keywords'] = "Geben Sie ein oder mehrere Schlüsselbegriff ein...";
$_lang['contentblocks.video.load_more_results'] = "Mehr Ergebnisse laden";
$_lang['contentblocks.video.search_youtube'] = "YouTube durchsuchen";
$_lang['contentblocks.video.paste_link'] = "Link hier einfügen";
$_lang['contentblocks.video.youtube_not_loaded'] = "Die YouTube-API wure nicht geladen. Bitte versuchen Sie es erneut in wenigen Sekunden. Bleibt das Problem bestehen, ist die API zurzeit nicht erreichbar.";
$_lang['contentblocks.video.api_error'] = "Hoppla, hier ist ein Fehler aufgetreten: [[+message]] (Code [[+code]])";

// Snippet
$_lang['contentblocks.snippet'] = "Snippet";
$_lang['contentblocks.snippet.description'] = "Dieser Eingabetyp erlaubt Benutzern, ein Snippet auszuwählen und Parameter dafür einzugeben.";
$_lang['contentblocks.snippet.available_snippets'] = "Name oder IDs erlaubter Snippets (optional)";
$_lang['contentblocks.snippet.available_snippets.description'] = "Um die vom Benutzer auswählbaren Snippets einzuschränken, geben Sie eine Komma-getrennte Liste mit zulässigen Snippet-Namen oder Snippet-IDs an. Nur diese stehen dann zur Auswahl zur Verfügung.";
$_lang['contentblocks.snippet.categories'] = "Kategorien";
$_lang['contentblocks.snippet.categories.description'] = "Geben Sie eine Liste zulässiger Kategorien über deren Namen oder IDs an und der Benutzer kann nur aus Snippets wählen, die diesen Kategorien entsprechen. ";
$_lang['contentblocks.snippet.add_property'] = "Parameter hinzufügen";
$_lang['contentblocks.snippet.choose_snippet'] = "Snippet auswählen";
$_lang['contentblocks.snippet.other_property'] = "Andere (freie Eingabe)";
$_lang['contentblocks.snippet.other_property.desc'] = "Jeder beliebige Parameter, der beim Aufruf des Snippets übergeben werden soll, kann hier angegeben werden. Stellen Sie sicher, dass die korrekte Tag-Syntax verwendet wird (z.B. &property=`bar`)";
$_lang['contentblocks.snippet.allow_uncached'] = "\"Cache verwenden\" erlauben?";
$_lang['contentblocks.snippet.allow_uncached.description'] = "Wenn diese Option aktiviert ist, kann der Benutzer angeben, dass die Ausgabe des Snippets nicht gecached werden soll. Falls nicht werden alle Snippets immer gecached ausgeführt.";
$_lang['contentblocks.snippet.uncached'] = "Cache verwenden?";
$_lang['contentblocks.snippet.uncached_0'] = "Ja";
$_lang['contentblocks.snippet.uncached_1'] = "Nein, dieses Snippet nicht cachen";
$_lang['contentblocks.snippet.none_available'] = "Für dieses Feld sind keine Snippets verfügbar. ";

$_lang['contentblocks.layout_template.description'] = 'Die Vorlage für dieses innere Layout. Denken Sie daran, dass alle darin enthaltenen Layouts auch ihre Templates durchlaufen. Verfügbare Platzhalter: <code>[[+ value]] </code> (der voll geparsten HTML-Code von den enthaltenen Layouts)';
$_lang['contentblocks.layoutfield.available_layouts'] = "Verfügbare(s) Layout(s)";
$_lang['contentblocks.layoutfield.available_layouts.description'] = "Durch Kommata getrennte Liste von erlaubten Layouts. Um keine Layouts zu erlauben, beispielsweise, um nur das Einfügen von Templates zu erlauben, setzen Sie hier -1.";
$_lang['contentblocks.layoutfield.available_templates'] = "Verfügbare Template(s)";
$_lang['contentblocks.layoutfield.available_templates.description'] = "Durch Kommata getrennte Liste von erlaubten Templates. Um keine Templates zu erlauben, setzen Sie hier -1.";

// Image related
$_lang['contentblocks.choose_image'] = "Bild auswählen";
$_lang['contentblocks.wrapper_template'] = "Umschließendes Template";
$_lang['contentblocks.nested_template'] = "Inneres Template";
$_lang['contentblocks.max_images'] = "Maximale Anzahl zulässiger Bilder";
$_lang['contentblocks.max_images_reached'] = "Entschuldigung, Sie können nicht mehr als [[+max]] Bilder in dieser Galerie platzieren.";
$_lang['contentblocks.upload_error'] = "Hoppla, beim Upload der Datei [[+file]] ist etwas schiefgelaufen: [[+message]]";
$_lang['contentblocks.upload_error.file_too_big'] = "\"\n\nDie Datei könnte zu groß gewesen sein.";
$_lang['contentblocks.image.thumbnail_size'] = "Manager-Thumbnail-Größe";
$_lang['contentblocks.image.thumbnail_size.description'] = "Abmessungen für Manager-Tumbnails. Freilassen Sie für keine, einen numerischen Wert für quadratische Bilder und Abmessungen BxH für rechteckige Bilder zum Beispiel: 100 oder 100 x 50";

// Misc
$_lang['contentblocks.use_contentblocks'] = "ContentBlocks benutzen?";
$_lang['contentblocks.use_contentblocks.description'] = "Wenn aktiviert, wird das Inhalt-Feld von ContentBlocks ersetzt, um mehrspaltige, strukturierte Inhalte erstellen zu können.";
$_lang['contentblocks.or'] = "oder";
$_lang['contentblocks.title'] = "Titel";
$_lang['contentblocks.delete'] = "Löschen";
$_lang['contentblocks.delete_video'] = "Video löschen";
$_lang['contentblocks.move_layout_up'] = "Nach oben bewegen";
$_lang['contentblocks.move_layout_down'] = "Nach unten bewegen";
$_lang['contentblocks.delete_image'] = "Bild löschen";
$_lang['contentblocks.add_content'] = "Inhalt hinzufügen";
$_lang['contentblocks.add_content.introduction'] = "Bitte wählen Sie den Typ des in das Layout einzufügenden Inhalts. Bewegen Sie die Maus über den Namen, um eine ausführlichere Beschreibung zu sehen.";
$_lang['contentblocks.add_layout'] = "Layout hinzufügen";
$_lang['contentblocks.add_layout.introduction'] = "Bitte wählen Sie das hinzuzufügende Layout!";
$_lang['contentblocks.upload'] = "Upload";
$_lang['contentblocks.choose'] = "Auswählen";
$_lang['contentblocks.image.or_drop_images'] = "oder Bilder hier ablegen";
$_lang['contentblocks.image.or_drop_image'] = "oder ein Bild hier ablegen";
$_lang['contentblocks.use_tinyrte'] = "Soll Tiny RTE verwendet werden?";
$_lang['contentblocks.use_tinyrte.description'] = "Falls aktiviert, werden im Eingabeeditor einfache Formatierungen möglich (fett, kursiv und Links).";
$_lang['contentblocks.use_tinyrte.description.image'] = "Falls aktiviert, werden im Titel-Eingabeeditor einfache Formatierungen möglich (fett, kursiv und Links). Falls Sie das Titel-Feld für den Alt-Text oder das title-Attribut nutzen möchten, benötigen Sie möglicherweise weitere Behandlung des Textes (z.B. durch htmlentities), um zu verhindern, dass die zusätzlichen Formatierungen das img-Tag durcheinanderbringen. ";

$_lang['contentblocks.rebuild_content'] = "Content neu aufbauen";
$_lang['contentblocks.rebuild_content.confirm'] = "Beim Neuaufbauen der Inhalte werden sämtliche Ressourcen aus ihrem strukturierten Inhalt neu generiert. Das bedeutet, dass alle darin genutzten Layouts und Felder neu interpretiert und der alte Inhalt überschrieben wird. Je nach der Größe Ihrer Website kann dieser Vorgang zwischen mehreren Sekunden bis zu mehreren Minuten in Anspruch nehmen. Um den Prozess zu starten, klicken Sie bitte unten auf Ja.";
$_lang['contentblocks.rebuild_content.initialising'] = "Initialisierung...";
$_lang['contentblocks.rebuild_content.resources_found'] = "Es wurden insgesamt [[+total]] Ressourcen gefunden. Der Neuaufbau wird voraussichtlich [[+estimate]] Minuten dauern.";
$_lang['contentblocks.rebuild_content.loading_dependencies'] = "Lade Abhängigkeiten zum Interpretieren von Inhalten...";
$_lang['contentblocks.rebuild_content.loaded_dependencies'] = "Abhängigkeiten geladen, beginne mit dem Neuaufbau des Inhalts...";
$_lang['contentblocks.rebuild_content.skipping_not_allowed'] = "Überspringe #[[+id]] ([[+pagetitle]]), da in der Ressource angegeben wurde, ContentBlocks dafür nicht zu verwenden (Typ: [[+class_key]])";
$_lang['contentblocks.rebuild_content.skipping_not_used'] = "Überspringe #[[+id]] ([[+pagetitle]]), diese Ressource verwendet ContentBlocks aktuell nicht.";
$_lang['contentblocks.rebuild_content.skipping_corrupt'] = "Überspringe #[[+id]] ([[+pagetitle]]), der Inhalt ist ungültig oder fehlt.";
$_lang['contentblocks.rebuild_content.done'] = "Fertig mit dem Neuaufbau des Contents! [[+total_rebuild]] Ressourcen wurden wieder aufgebaut, [[+total_skipped]] wurden übersprungen und [[+ total_skipped_broken]] wurden wegen ungültigem Inhalt übersprungen.";
$_lang['contentblocks.rebuild_content.clear_cache'] = "Löschen des Caches für Kontext(e): [[+contexts]]";
$_lang['contentblocks.rebuild_content.clear_cache_complete'] = "Cache gelöscht. Alles fertig!";
$_lang['contentblocks.generating_canvas'] = "Erzeuge Ihren Inhaltsbereich … das sollte nur einen Moment dauern.";
$_lang['contentblocks.content'] = "Inhalte der Template";
$_lang['contentblocks.open_template_builder'] = "Template erzeugen";
$_lang['contentblocks.template_builder'] = "Template-Generator";

/**
 * Settings. Oh boy.
 */

$_lang['setting_contentblocks.accepted_resource_types'] = "Erlaubte Ressourcentypen";
$_lang['setting_contentblocks.accepted_resource_types_desc'] = "Eine durch Kommata getrennte Liste von Ressourcen-Klassen-Schlüsseln, die ContentBlocks zu verbessern versucht. ";

$_lang['setting_contentblocks.clear_cache_after_rebuild'] = "Leere Cache nach Rekonstruktion";
$_lang['setting_contentblocks.clear_cache_after_rebuild_desc'] = "Wenn aktiviert, wird die Inhalts-Rekontruktion der Komponente nach Abschluss den Ressourcen-Cache löschen.";

$_lang['setting_contentblocks.debug'] = "Debug";
$_lang['setting_contentblocks.debug_desc'] = "Wenn aktiviert, wird ContentBlocks nicht-minimiertes Javascript im Manager verwenden, um das Debuggen zu erleichtern.";

$_lang['setting_contentblocks.disabled'] = "Deaktiviert";
$_lang['setting_contentblocks.disabled_desc'] = "Setzen Sie diese Einstellung auf 1, um ContentBlocks komplett auf dieser Site zu deaktivieren. Dies kann auf Kontext-Ebene überschrieben werden, um es nur auf bestimmten Kontexten zu verwenden. ";

$_lang['setting_contentblocks.implode_string'] = "Zeichenkette zusammenfügen";
$_lang['setting_contentblocks.implode_string_desc'] = "Die Zeichen zwischen einzelnem Feld und Layout-Ausgabe, wenn der Inhalt geparst wird. ";

$_lang['setting_contentblocks.default_layout'] = "Standardlayout";
$_lang['setting_contentblocks.default_layout_desc'] = "Geben Sie die ID des Standard-Layouts an welches neue Ressourcen oder Ressourcen die noch nicht mit ContentBlocks verwendet wurden erhalten. Ab 1.2 gilt dies nur, wenn keine Standardvorlage gefunden wird.";

$_lang['setting_contentblocks.default_layout_part'] = "Standardspalte";
$_lang['setting_contentblocks.default_layout_part_desc'] = "Geben Sie die Referenz einer Spalte in dem von Ihnen festgelegten Standard-Layout an. Bei neuen Ressourcen oder Ressourcen die noch nicht mit ContentBlocks verwendet worden sind, wird ein Feld (welches durch die Standardfeldeinstellung definiert wird) in dieser Spalte mit dem Inhalt eingefügt werden. Ab 1.2 gilt dies nur, wenn keine Standardvorlage gefunden wird.";

$_lang['setting_contentblocks.default_field'] = "Standardfeld";
$_lang['setting_contentblocks.default_field_desc'] = "Geben Sie die ID des Feldes an, welches in der default Spalte des von Ihnen definierten default Layouts eingefügt werden soll. Wenn die ID auf 0 gesetzt ist, wird eine einfaches Rich-Text oder textarea-Feld verwendet. Ab 1.2 wird dies nur angewendet, wenn keine Standardvorlage gefunden wird.";

$_lang['setting_contentblocks.code.theme'] = "Code-Thema";
$_lang['setting_contentblocks.code.theme_desc'] = "Das Thema für Code-Eingabe. Lesen Sie die Ace-Dokumentation für mögliche Eingaben.";

$_lang['setting_contentblocks.image.hash_name'] = "Hash-Name";
$_lang['setting_contentblocks.image.hash_name_desc'] = "Wenn aktiviert, werden hochgeladene Dateien mit einem Hash versehen, um die ursprünglichen Dateinamen zu verschleiern.";

$_lang['setting_contentblocks.image.prefix_time'] = "Zeit-Präfix";
$_lang['setting_contentblocks.image.prefix_time_desc'] = "Wenn aktiviert, wird hochgeladenen Dateien ein Unix-Zeitstempel vorangesetzt.";

$_lang['setting_contentblocks.image.sanitize'] = "Säubern";
$_lang['setting_contentblocks.image.sanitize_desc'] = "Wenn aktiviert, werden hochgeladene Dateinamen vor dem Upload gesäubert, um sicherzustellen, dass keine problematischen Zeichen enthalten sind. Die Säuberung unterstützt auch Transliteration mit iconv oder Transliterationsbibliotheken von Fremdherstellern.";

$_lang['setting_contentblocks.image.source'] = "Medienquelle";
$_lang['setting_contentblocks.image.source_desc'] = "Wählen Sie die Medienquelle, die für Bild- und Galerie-Eingabetypen verwendet werden soll. Sie kann auf Feld-Ebene überschieben werden.";

$_lang['setting_contentblocks.image.upload_path'] = "Upload-Pfad";
$_lang['setting_contentblocks.image.upload_path_desc'] = "Der Pfad innerhalb der definierten Medienquelle, auf den die Dateien hochgeladen werden sollen. Dieser unterstützt die Platzhalter: [[+year]], [[+month]], [[+day]], [[+user]], [[+username]] und [[+resource]].";

$_lang['setting_contentblocks.cache_source'] = "Cachequelle";
$_lang['setting_contentblocks.cache_source.description'] = "Wählen Sie die Medienquelle für zur verwendung für Bild und Galerie-Thumbnail-Cache-Dateien.";

$_lang['setting_contentblocks.cache_path'] = "Cachepfad";
$_lang['setting_contentblocks.cache_path.description'] = "Der Pfad innerhalb der definierten Medien-Quelle in den Thumbnail-Cache-Dateien hochgeladen werden.";

$_lang['setting_contentblocks.sanitize_pattern'] = "Sanitize Pattern";
$_lang['setting_contentblocks.sanitize_pattern_desc'] = "Ein RegEx-Pattern, welches zum Säubern von säuberungsbedürftigen Dateinamen verwendet wird.";

$_lang['setting_contentblocks.sanitize_replace'] = "Säuberungs-Ersatz";
$_lang['setting_contentblocks.sanitize_replace_desc'] = "Eine Zeichenkette, die Vorkommen des von RegEx-Musters zur Säuberung ersetzt.";

$_lang['setting_contentblocks.custom_icon_path'] = "Pfad für eigene Icons";
$_lang['setting_contentblocks.custom_icon_path_desc'] = "Pfad zu eigenen Icons. {assets_path} ist erlaubt.";

$_lang['setting_contentblocks.custom_icon_url'] = "URL für eigene Icons";
$_lang['setting_contentblocks.custom_icon_url_desc'] = "URL zu eigenen Icons. {assets_url} ist erlaubt.";

$_lang['setting_contentblocks.translit'] = "Transliteration";
$_lang['setting_contentblocks.translit_desc'] = "Wenn auf einen Wert gesetzt, der \"none\" oder leer ist, wird die Transliteration vor der Säuberung aktiviert, welche unerlaubte Zeichen mit erlaubten ersetzt. Falls dieser Wert leer ist, wird er von der Core-Systemeinstellung \"friendly_alias_translit\" geerbt.";

$_lang['setting_contentblocks.hide_logo'] = "Logo verbergen";
$_lang['setting_contentblocks.hide_logo_desc'] = "Standardmäßig zeigen wir ein kleines modmore-Logo unten rechts auf der ContentBlocks-Komponente. Wenn Sie das aus irgendwelchen Gründen nicht möchten, aktivieren Sie einfach diese Einstellung und es wird verschwinden.";

$_lang['setting_contentblocks.translit_class'] = "Translit Class";
$_lang['setting_contentblocks.translit_class_desc'] = "Der Name der Klasse, die für Transliteration verwendet werden soll. Falls dieser Wert hier leer ist, wird er von der Core-Einstellung \"friendly_alias_translit_class\" geerbt.";
$_lang['setting_contentblocks.translit_class_path'] = "Translit Class Path";
$_lang['setting_contentblocks.translit_class_path_desc'] = "Der Name der Klasse, die für Transliteration verwendet werden soll. Falls dieser Wert hier leer ist, wird er von der Core-Einstellung \"friendly_alias_translit_class\" geerbt.";

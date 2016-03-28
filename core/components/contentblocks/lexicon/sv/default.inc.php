<?php
$_lang['contentblocks'] = "Content Blocks";
$_lang['contentblocks.menu'] = "Content Blocks";
$_lang['contentblocks.menu_desc'] = "Hantera Content Blocks fält och layouter.";
$_lang['contentblocks.mgr.home'] = "Content Blocks";

$_lang['contentblocks.general'] = "Allmänt";
$_lang['contentblocks.properties'] = "Egenskaper";

$_lang['contentblocks.link'] = "Länk";
$_lang['contentblocks.link.description'] = "Ett fält för att skapa länkar. Resurs, e-post och webbadresser stöds.";
$_lang['contentblocks.link_template.description'] = "En mall för länken. Tillgängliga platshållare: <code>[[+link]]</code>, <code>[[+link_raw]]</code>, <code>[[+ linkType]]</code>";
$_lang['contentblocks.link.resource'] = "Resurs";
$_lang['contentblocks.link.url'] = "URL";
$_lang['contentblocks.link.email'] = "E-postadress";
$_lang['contentblocks.link.link_new_tab'] = "Öppna i ny flik";
$_lang['contentblocks.link.add'] = "Lägg till länk";
$_lang['contentblocks.link.remove'] = "Ta bort länk";
$_lang['contentblocks.link.placeholder'] = "Börja skriva namnet på en resurs, extern länk eller e-postadress";
$_lang['contentblocks.link.link_detection_pattern_override'] = 'Åsidosättande av länk detektionsmönster';
$_lang['contentblocks.link.link_detection_pattern_override.description'] = 'Regex för att upptäcka om en länk är giltig; om inte, kommer http:// att infogas i början.';
$_lang['contentblocks.link.limit_to_current_context'] = 'Begränsa resurs resultat till aktuell kontext';
$_lang['contentblocks.link.limit_to_current_context.description'] = 'Begränsar typeahead resultat till resurser som finns i samma kontext som den sida som redigeras';

$_lang['setting_contentblocks.link.link_detection_pattern'] = 'Länk detektionsmönster';
$_lang['setting_contentblocks.link.link_detection_pattern_desc'] = 'Regex för att upptäcka om en länk är giltig; om inte, kommer http:// att infogas i början.';

$_lang['setting_contentblocks.typeahead.include_introtext'] = 'Inkludera Introtext i Typeahead';
$_lang['setting_contentblocks.typeahead.include_introtext_desc'] = 'När aktiverat, kommer typeahead att inkludera introtext för varje resurs, vilket ger dig mer information om resursen.';

$_lang['contentblocks.error.not_an_export'] = "Filen ser inte ut att vara en export från ContentBlocks";
$_lang['contentblocks.error.importing_row'] = "Fel vid import av rad:";
$_lang['contentblocks.error.no_valid_field'] = "Inget giltigt fält hittades";
$_lang['contentblocks.error.no_snippets'] = "Inga snippets finns tillgängliga att användas";
$_lang['contentblocks.error.missing_id'] = "ID egenskap saknas";
$_lang['contentblocks.error.input_not_found'] = "Inmatning hittades inte";
$_lang['contentblocks.error.input_not_found.message'] = "Åh nej. Ett fält med inmatningstypen \"[[+input]]\" lästes in, men den inmatningstypen finns inte.";
$_lang['contentblocks.error.field_not_found'] = "Fältet kunde inte hittas";
$_lang['contentblocks.error.layout_not_found'] = "Layouten kunde inte hittas";
$_lang['contentblocks.error.error_saving_object'] = "Fel vid lagring av objekt";
$_lang['contentblocks.error.xml_not_loaded'] = "Kunde inte ladda XML filen";
$_lang['contentblocks.error.no_icons'] = "Kunde inte öppna ikonkatalogen för läsning";
$_lang['contentblocks.error.no_json'] = "Din webbläsare stöder inte JSON, vilket behövs för ContentBlocks. Vänligen uppdatera din webbläsare.";

$_lang['contentblocks.availability'] = "Tillgänglighet";
$_lang['contentblocks.availability.layout_description'] = "Som standard är layouter alltid tillgängliga. Om du lägger till villkor nedan, kommer de endast att vara tillgängliga när ett av villkoren är sant. Separera multipla giltiga värden med ett kommatecken. ";
$_lang['contentblocks.availability.field_description'] = "Som standard är fält alltid tillgängliga. Om du lägger till villkor nedan, kommer de endast att vara tillgängliga när ett av villkoren är sant. Separera multipla giltiga värden med ett kommatecken. ";
$_lang['contentblocks.availability.template_description'] = "Som standard är mallar alltid tillgängliga. Om du lägger till villkor nedan, kommer de endast att vara tillgängliga när ett av villkoren är sant. Separera multipla giltiga värden med ett kommatecken.";
$_lang['contentblocks.add_condition'] = "Lägg till villkor";
$_lang['contentblocks.edit_condition'] = "Redigera villkor";
$_lang['contentblocks.delete_condition'] = "Radera villkor";
$_lang['contentblocks.delete_condition.confirm'] = "Är du säker att du vill radera detta villkor?";
$_lang['contentblocks.condition_field'] = "Fält";
$_lang['contentblocks.condition_field.resource'] = "Resurs ID";
$_lang['contentblocks.condition_field.parent'] = "Förälder ID";
$_lang['contentblocks.condition_field.ultimateparent'] = "Ultimatförälder ID";
$_lang['contentblocks.condition_field.class_key'] = "Klassnyckel";
$_lang['contentblocks.condition_field.context'] = "Kontext";
$_lang['contentblocks.condition_field.template'] = "Mall (ID)";
$_lang['contentblocks.condition_field.usergroup'] = "Användargrupp (namn)";
$_lang['contentblocks.condition_value'] = "Värde(n)";
$_lang['contentblocks.availibility.layouts'] = "Layout(er)";
$_lang['contentblocks.availibility.layouts.description'] = "Begränsa användning av detta fält till ett eller flera (kommaseparerade) layouter. Om detta lämnas tomt är fältet tillgängligt i alla layouter, annars är det begränsat till de du anger. ";
$_lang['contentblocks.availibility.times_per_page'] = "Antal gånger per sida";
$_lang['contentblocks.availibility.times_per_page.description'] = "Begränsa användning till så här många gånger per sida. Lämna blankt för ingen begränsning.";
$_lang['contentblocks.availibility.times_per_layout'] = "Antal gånger per layout";
$_lang['contentblocks.availibility.times_per_layout.description'] = "Begränsa användning till så här många gånger per layout.";
$_lang['contentblocks.availibility.only_nested'] = "Tillåt endast som nästlad layout";
$_lang['contentblocks.availibility.only_nested.description'] = "Tillåt inte användning av layouten utanför layoutfältet.";


$_lang['contentblocks.field_desc'] = "Fält är själva ryggraden i ContentBlocks - de definierar exakt hur mycket <em>Creative Freedom</em> redigerare får i hanterandet av deras innehåll. Varje fält består i huvudsak av en inmatningstyp och en mall som dikterar hur det skrivs ut i front-end. För mera information om hur man använder fält på rätt sätt, klicka på Hjälp knappen högst uppe till höger på skärmen.";
$_lang['contentblocks.add_field'] = "Lägg till fält";
$_lang['contentblocks.edit_field'] = "Redigera fält";
$_lang['contentblocks.duplicate_field'] = "Duplicera fält";
$_lang['contentblocks.delete_field'] = "Radera fält";
$_lang['contentblocks.delete_field.confirm'] = "Är du säker att du vill radera detta fält? Potentiellt katastrofala saker kan hända med allt innehåll som använde detta fält. ";
$_lang['contentblocks.delete_field.confirm.js'] = "Är du säker att du vill radera detta fält?";
$_lang['contentblocks.export_field'] = "Exportera fält";
$_lang['contentblocks.export_fields'] = "Exportera";
$_lang['contentblocks.export_fields.confirm'] = "Efter att ha klickat Ja nedan kommer vi att bereda en XML export av alla fält. Detta kan användas för att importera fälten senare eller på en annan installation. Genererandet av XMLen kan ta ett par sekunder beroende på antalet fält du har konfigurerat.";
$_lang['contentblocks.import_fields'] = "Importera";
$_lang['contentblocks.import_fields.title'] = "Importera fält";
$_lang['contentblocks.import_fields.intro'] = "Genom att ladda upp en XML-fil och välja rätt importläge kan du importera fält du exporterade tidigare eller från en annan plats. <b>Var försiktig</b> med att importera fält om du har innehåll som använder sig av de nuvarande fälten. Vänligen kontakta support@modmore.com om du är osäker vilket läge som bör användas för importen. ";

$_lang['contentblocks.layout_desc'] = "Varje layout är väsentligen en horizontell rad, bestående av en eller flera kolumner. Vid redigering av en resurs är varje kolumn en tom låda för innehåll med en knapp för att lägga till innehåll (genom fält). För mera information hur man använder layouter på rätt sätt, klicka på Hjälp knappen högst uppe till höger på skärmen.";
$_lang['contentblocks.add_layout'] = "Lägg till layout";
$_lang['contentblocks.repeat_layout'] = "Upprepa layout";
$_lang['contentblocks.edit_layout'] = "Redigera layout";
$_lang['contentblocks.duplicate_layout'] = "Duplicera layout";
$_lang['contentblocks.export_layout'] = "Exportera layout";
$_lang['contentblocks.delete_layout'] = "Radera layout";
$_lang['contentblocks.delete_layout.confirm'] = "Är du säker att du vill radera denna layout? Potentiellt katastrofala saker kan hända med allt innehåll som använde denna layout. ";
$_lang['contentblocks.delete_layout.confirm.js'] = "Är du säker att du vill radera denna [[+layoutName]] layout? All dess innehåll kommer att raderas tillsammas med den om du fortsätter.";
$_lang['contentblocks.export_layouts'] = "Exportera";
$_lang['contentblocks.export_layouts.confirm'] = "Efter att ha klickat Ja nedan kommer vi att bereda en XML export av alla layouter. Detta kan användas för att importera layouterna senare eller på en annan installation. Genererandet av XMLen kan ta ett par sekunder beroende på antalet layouter du har konfigurerat.";
$_lang['contentblocks.import_layouts'] = "Importera";
$_lang['contentblocks.import_layouts.title'] = "Importera layouter";
$_lang['contentblocks.import_layouts.intro'] = "Genom att ladda upp en XML-fil och välja rätt importläge kan du importera layouter du exporterade tidigare eller från en annan plats. <b>Var försiktig</b> med att importera layouter om du har innehåll som använder sig av de nuvarande layouterna. Vänligen kontakta support@modmore.com om du är osäker vilket läge som bör användas för importen. ";

$_lang['contentblocks.layout_settings'] = "Layout inställningar";
$_lang['contentblocks.layout_settings.modal_header'] = "[[+name]] inställningar";

$_lang['contentblocks.field_settings'] = "Innehållsinställningar";
$_lang['contentblocks.field_settings.modal_header'] = "[[+name]] inställningar";

$_lang['contentblocks.add_layoutcolumn'] = "Lägg till kolumn";
$_lang['contentblocks.edit_layoutcolumn'] = "Redigera kolumn";
$_lang['contentblocks.delete_layoutcolumn'] = "Radera kolumn";
$_lang['contentblocks.delete_layoutcolumn.confirm'] = "Är du säker att du vill radera denna kolumn? Potentiellt katastrofala saker kan hända med allt innehåll som använde denna kolumn. ";
$_lang['contentblocks.add_setting'] = "Lägg till inställning";
$_lang['contentblocks.edit_setting'] = "Redigera inställning";
$_lang['contentblocks.delete_setting'] = "Radera inställning";
$_lang['contentblocks.delete_setting.confirm'] = "Är du säker att du vill radera denna inställning?";

$_lang['contentblocks.defaults'] = 'Standarder';
$_lang['contentblocks.defaults.intro'] = 'Med standardvärden kan du konfigurera hur resurser som inte ännu har redigerats med ContentBlocks (t.ex. nya resurser eller sidor som fanns innan du installerade ContentBlocks) hanteras. Detta fungerar genom att analysera de definierade standardregler som anges nedan, från topp till botten, tills en matchning hittas och det infogar den angivna mallen.';
$_lang['contentblocks.constraint_field'] = 'Begränsningsfält';
$_lang['contentblocks.constraint_value'] = 'Begränsningsvärde';
$_lang['contentblocks.default_template'] = 'Standardmall';
$_lang['contentblocks.target_layout'] = 'Mållayout';
$_lang['contentblocks.target_field'] = 'Målfält';
$_lang['contentblocks.target_column'] = 'Målkolumn';
$_lang['contentblocks.add_default'] = 'Lägg till standardregel';
$_lang['contentblocks.edit_default'] = 'Redigera standardregel';
$_lang['contentblocks.delete_default'] = 'Radera standardregel';
$_lang['contentblocks.delete_default.confirm'] = 'Är du säker att du vill radera denna standardregel?';


$_lang['contentblocks.start_import'] = "Starta import";
$_lang['contentblocks.import_file'] = "Fil";
$_lang['contentblocks.import_mode'] = "Importläge";
$_lang['contentblocks.import_mode.insert'] = "Infoga: lämna existerande [[+what]] och lägg till importerad data";
$_lang['contentblocks.import_mode.overwrite'] = "Skriv över: lämna existerande [[+what]], men skriv över dem om de har samma ID";
$_lang['contentblocks.import_mode.replace'] = "Ersätt: radera först alla existerande [[+what]] och importera sedan de nya raderna.";

$_lang['contentblocks.id'] = "ID";
$_lang['contentblocks.field'] = "Fält";
$_lang['contentblocks.fields'] = "Fält";
$_lang['contentblocks.layout'] = "Layout";
$_lang['contentblocks.layout.description'] = "Ett omslag för fält";
$_lang['contentblocks.layouts'] = "Layouter";
$_lang['contentblocks.layoutcolumn'] = "Kolumn";
$_lang['contentblocks.layoutcolumns'] = "Kolumner";
$_lang['contentblocks.setting'] = "Inställning";
$_lang['contentblocks.settings'] = "Inställningar";
$_lang['contentblocks.settings.layout_description'] = "Inställningar är användardefinierade egenskaper som kan justeras när en layout har lagts till i innehållet. Inställningarnas värden finns då tillgängliga i mallen som platshållare, exempelvis [[+klass]] för en inställning med referensen \"klass\".";
$_lang['contentblocks.settings.field_description'] = "Inställningar är användardefinierade egenskaper som kan justeras när ett fält har lagts till i innehållet genom att klicka på kugghjulsikonen högst uppe till höger i fältet. Inställningarnas värden finns då tillgängliga i mallen som platshållare, exempelvis [[+klass]] för en inställning med referensen \"klass\".";
$_lang['contentblocks.input'] = "Inmatningstyp";
$_lang['contentblocks.inputs'] = "Inmatningstyper";
$_lang['contentblocks.name'] = "Namn";
$_lang['contentblocks.columns'] = "Kolumner";
$_lang['contentblocks.columns.description'] = "Kolumner definierar hur layouten visas i hanteraren, var bredden definieras som ett procentantal. Referensen används till en platshållare som du kan använda i mallen. ";
$_lang['contentblocks.sortorder'] = "Sorteringsföljd";
$_lang['contentblocks.icon'] = "Ikon";
$_lang['contentblocks.description'] = "Beskrivning";
$_lang['contentblocks.template'] = "Mall";
$_lang['contentblocks.template.description'] = "Mallen för layouten har flera tillgängliga platshållare, beroende på de kolumner och inställningar du definierar i flikarna till vänster. ";
$_lang['contentblocks.width'] = "Bredd";
$_lang['contentblocks.width.description'] = "Bredden på fältet (i procent) som det här fältet kommer att uppta i canvasen. Fält är vänsterjusterade (floated left) så du kan skapa en form av enkel layout med den här inställningen.";
$_lang['contentblocks.save'] = "Spara";
$_lang['contentblocks.reference'] = "Referens";
$_lang['contentblocks.default_value'] = "Standardvärde";
$_lang['contentblocks.fieldtype'] = "Fälttyp";
$_lang['contentblocks.fieldtype.select'] = "Urvalsfält";
$_lang['contentblocks.fieldtype.radio'] = "Radioalternativ";
$_lang['contentblocks.fieldtype.checkbox'] = "Kryssrutealternativ";
$_lang['contentblocks.fieldtype.textfield'] = "Text";
$_lang['contentblocks.fieldtype.link'] = "Länk";
$_lang['contentblocks.fieldtype.textarea'] = "Textruta";
$_lang['contentblocks.fieldoptions'] = "Fältalternativ";
$_lang['contentblocks.fieldoptions.description'] = "Används endast för fälttypen Urvalsfält. Definiera tillgängliga värden som \"Visat värde=platshållarvärde\", en per rad. Om du endast lägger ett värde per rad (så som \"foo\"), kommer det att användas till både visnings- och platshållarvärdet.";
$_lang['contentblocks.field_is_exposed'] = "Gör fältet synligt";
$_lang['contentblocks.field_is_exposed.description'] = "Visa fältet på canvasen istället för endast efter att ha klickat på inställningsikonen";
$_lang['contentblocks.field_is_exposed.modal'] = "Visa fältinställning i modalt fönster";
$_lang['contentblocks.field_is_exposed.exposedassetting'] = "Visa fältet på canvasen som en inställning";
$_lang['contentblocks.field_is_exposed.exposedasfield'] = "Visa fältet på canvasen som ett vanligt fält";

$_lang['contentblocks.directory'] = 'Katalog';
$_lang['contentblocks.directory.description'] = 'En underkatalog i mediakällan (vare sig åsidosatt eller genom ContentBlocks system inställningen)';
$_lang['contentblocks.file_types'] = 'Tillåtna filändelser';
$_lang['contentblocks.file_types.description'] = 'Filer med dessa ändelser (komma-separerade) kommer att laddas upp. För obegränsat, lämna tomt.';
$_lang['contentblocks.file_types.disallowed'] = 'Filtypen tillåts ej i detta fält';

// Templates
$_lang['contentblocks.templates'] = 'Mallar';
$_lang['contentblocks.templates_desc'] = 'Mallar är fördefinierade uppsättningar av layouter och fält som kan användas som genväg för att lägga till innehåll till canvasen. ';
$_lang['contentblocks.add_template'] = 'Lägg till mall';
$_lang['contentblocks.edit_template'] = 'Redigera mall';
$_lang['contentblocks.duplicate_template'] = 'Duplicera mall';
$_lang['contentblocks.export_template'] = 'Exportera mall';
$_lang['contentblocks.export_templates'] = 'Exportera mallar';
$_lang['contentblocks.import_templates'] = 'Importera mallar';
$_lang['contentblocks.import_templates.title'] = 'Importera mallar';
$_lang['contentblocks.import_templates.intro'] = 'Genom att ladda upp en XML-fil och välja rätt importläge kan du importera mallar du har exporterat tidigare eller från en annan plats. <b>Obs:</b> Mallar innehåller referenser till fält- och layout-IDn. Om du importerar mallar kommer du förmodligen också behöva importera layouter och fält från samma plats.';
$_lang['contentblocks.delete_template'] = 'Radera mall';
$_lang['contentblocks.delete_template.confirm'] = 'Är du säker att du vill radera denna mall?';


// Input types
$_lang['contentblocks.chunk'] = "Chunk";
$_lang['contentblocks.chunk.description'] = "Definiera en chunk som skall infogas i innehållet.";
$_lang['contentblocks.chunk.choose_chunk'] = "Välj chunk";
$_lang['contentblocks.chunk.choose_chunk.description'] = "Välj den chunk som skall infogas.";
$_lang['contentblocks.chunk_template.description'] = "En mall för chunken. Tillgängliga platshållare: <code>[[+tag]]</code>, <code>[[+chunk_name]]</code>";
$_lang['contentblocks.chunk.custom_preview'] = "Anpassad förhandsvisning";
$_lang['contentblocks.chunk.custom_preview.description'] = "Som standard om detta fält lämnas tomt, kommer chunk inmatningen att ladda den riktiga chunken och visa den som förhandsvisning. Om du vill kan du åsidosätta den förhandsvisningen genom att ange HTML för förhandsvisningen här. ";
$_lang['contentblocks.chunk.no_chunk_set'] = "Åh nej.. det finns ingen chunk definierad för detta fält.";

$_lang['contentblocks.chunkselector'] = 'Chunkväljare';
$_lang['contentblocks.chunk_selector_template.description'] = 'Mall för vald chunk. Tillgängliga platshållare: <code>[[+value]]</code> (innehåller hela chunktaggen), <code>[[+chunk_name]]</code> (innehåller namnet på den vald chunk)';
$_lang['contentblocks.chunkselector.description'] = 'Välj en chunk att visa';
$_lang['contentblocks.chunkselector.available_chunks'] = "Namn eller IDn på tillåtna chunks (Valfritt)";
$_lang['contentblocks.chunkselector.available_chunks.description'] = "För att begränsa tillgängliga chunks i redigerarenm ange en kommaseparerad lista med chunknamn eller IDn. Chunks i denna lista kommer alltid vara tillgängliga, oberoende av de andra egenskaperna nedan.";
$_lang['contentblocks.chunkselector.available_categories'] = "Kategorier";
$_lang['contentblocks.chunkselector.available_categories.description'] = "Ange en lista med kategorinamn eller IDn att begränsa tillgängliga snippets till. ";

$_lang['contentblocks.code'] = "Kod";
$_lang['contentblocks.code.description'] = "Visar en textruta med kodmarkering.";
$_lang['contentblocks.code_template.description'] = "Värdet från kodinmatningen lagras i <code>[[+value]]</code> platshållaren. Beroende på din beräknade användning av detta fält skulle du bara lägga till platshållaren i mallen, eller så skulle du koda det (ex. genom att göra <code>&lt;pre&gt;&lt;code&gt;[[+value:htmlent]]&lt;/code&gt;&lt;/pre&gt;) för visning istället för exekvering. Platshållaren <code>[[+lang]]</code> innehåller det valda språket i urvalsfältet.";
$_lang['contentblocks.code.available_languages'] = "Tillgängliga språk";
$_lang['contentblocks.code.available_languages.description'] = "Ange en kommaseparerad lista av <code>värde=visning</code> poster för de tillgängliga språken med syntax markering. Om det endast finns ett sådant språk angivet, kommer det väljas och språkets urvalsfält göms.";
$_lang['contentblocks.code.default_language'] = "Standard språk";
$_lang['contentblocks.code.default_language.description'] = "Det språk som skall väljas som standard.";
$_lang['contentblocks.code.language'] = "Språk";
$_lang['contentblocks.code.entities'] = "Koda enheter?";
$_lang['contentblocks.code.entities.description'] = "När detta är aktivt kommer den inmatade koden få sina enheter och MODX taggar kodade för visning av kod.";

$_lang['contentblocks.file'] = 'Filinmatning';
$_lang['contentblocks.file.description'] = 'Lägg till filer för länkning';
$_lang['contentblocks.file_template.description'] = 'Giltiga platshållare är <code>[[+url]]</code>, <code>[[+title]]</code>, <code>[[+size]]</code> (i byte), <code>[[+upload_date]]</code> och <code>[[+extension]]</code>';
$_lang['contentblocks.file.remove_file'] = 'Radera filen';
$_lang['contentblocks.file.max_files'] = 'Maximalt antal filer';
$_lang['contentblocks.file.file.or_drop_files'] = 'eller släpp filer här';
$_lang['contentblocks.file.max_files'] = 'Maximalt antal filer';
$_lang['contentblocks.file.max_files.description'] = 'Definierar det maximala antalet filer som tillåts per uppladdningsfält. Ytterligare filer över gränsen kommer att avslås.';
$_lang['contentblocks.file.max_files.reached'] = 'Tyvärr, du kan inte använda mer än [[+max]] filer i det här avsnittet.';
$_lang['contentblocks.file.directory'] = 'Katalog';
$_lang['contentblocks.file.directory.description'] = 'En underkatalog i mediakällan (vare sig åsidosatt eller genom ContentBlocks system inställning)';
$_lang['contentblocks.file.file_types'] = 'Tillåtna filändelser';
$_lang['contentblocks.file.file_types.description'] = 'Filer med dessa ändelser (komma-separerade) kommer att laddas upp. För ingen begränsning, lämna tomt.';
$_lang['contentblocks.file.file_types.disallowed'] = 'Filtypen tillåts ej i detta fält';
$_lang['contentblocks.file.choose_file'] = 'Välj fil';

$_lang['contentblocks.gallery'] = "Galleri";
$_lang['contentblocks.gallery.description'] = "En enkel galleri inmatning som erbjuder lätthanterlig flerbildsuppladdning, drag/släpp sortering och och titel attribut. ";
$_lang['contentblocks.gallery_template.description'] = "Används för att rama in individuella bilder. Tillgängliga platshållare:  <code>[[+url]]</code> (den fullständiga länken till bilden) och <code>[[+title]]</code> (den angivna titeln för bilden), <code>[[+size]]</code>, <code>[[+extension]]</code>";
$_lang['contentblocks.gallery_wrapper_template.description'] = "Används för att rama in alla bilder (som en behållare). Tillgängliga platshållare: <code>[[+images]]</code>";
$_lang['contentblocks.gallery_max_images.description'] = "Definierar max antalet bilder som tillåts per galleri. Ytterligare bilder över begränsningen kommer att nekas.";
$_lang['contentblocks.gallery.thumb_size'] = "Miniatyrstorlek";
$_lang['contentblocks.gallery.thumb_size.description'] = "Välj ett av alternativen för att definiera hur smått/stort miniatyrerna visas på duken.";
$_lang['contentblocks.gallery.thumb_size.small'] = "Liten";
$_lang['contentblocks.gallery.thumb_size.medium'] = "Medel";
$_lang['contentblocks.gallery.thumb_size.large'] = "Stor";
$_lang['contentblocks.gallery.show_description'] = "Visa beskrivning";
$_lang['contentblocks.gallery.show_description.description'] = "Visa en beskrivningslåda för att tillåta redigören att ge en längre beskrivning till varje bild. ";
$_lang['contentblocks.gallery.show_link_field'] = "Visa länk fält";
$_lang['contentblocks.gallery.show_link_field.description'] = "Visa ett länkfält så att bilder kan kopplas till resurser eller externa webbplatser.";

$_lang['contentblocks.heading'] = "Rubrik";
$_lang['contentblocks.heading.description'] = "En kombination av ett urvalsfält för rubrik nivå och ett textfält.";
$_lang['contentblocks.heading_template.description'] = "Mall för rubrikfältet. Tillgängliga platshållare är <code>[[+level]]</code> (värdet från nivåurvalet) och <code>[[+value]]</code>(värdet från textinmatningen).";
$_lang['contentblocks.default_level'] = "Standard nivå";
$_lang['contentblocks.available_levels'] = "Tillgängliga nivåer";
$_lang['contentblocks.heading_default_level.description'] = "Det värde som skall väljas som standard på nya instanser av rubriksinmatningen.";
$_lang['contentblocks.heading_available_levels.description'] = "En kommaseparerad lista med <code>värde=visning</code> poster av tillgängliga nivåer i urvalsfältet. Fär visningsvärdet kontrolleras lexikonprefixet <code>contentblocks.</code> och används om tillgängligt. Exempel: <code>h1=heading_1, h2=Andra nivån, h3=heading_3</code>";
$_lang['contentblocks.heading_1'] = "Rubrik 1";
$_lang['contentblocks.heading_2'] = "Rubrik 2";
$_lang['contentblocks.heading_3'] = "Rubrik 3";
$_lang['contentblocks.heading_4'] = "Rubrik 4";
$_lang['contentblocks.heading_5'] = "Rubrik 5";
$_lang['contentblocks.heading_6'] = "Rubrik 6";

$_lang['contentblocks.hr'] = "Horizontell linje";
$_lang['contentblocks.hr.description'] = "En enkel platshållare för en <hr> tagg för att infoga en horizontell linje.";
$_lang['contentblocks.hr_template.description'] = "Hur den horizontella linjen skall visas. Inga platshållare finns tillgängliga, men att använda <code>&lt;hr&gt;</code> taggen här rekommenderas.";

$_lang['contentblocks.image'] = "Bild";
$_lang['contentblocks.image.description'] = "Inmatningstyp med enkel bilduppladdning eller valmöjlighet. ";
$_lang['contentblocks.image.source'] = "Åsidosätt mediakälla";
$_lang['contentblocks.image.source.description'] = "Lämna detta på (none) för att använda systemstandardens mediakälla för bilder, eller välj en specifik mediakälla för att åsidosätta den inställningen för detta fält.";
$_lang['contentblocks.image_template.description'] = "Mall för bild inmatningstypen. Bör förmodligen innehålla en <code>&lt;img&gt;</code> tagg. Tillgängliga platshållare: <code>[[+url]]</code>, <code>[[+size]]</code>, <code>[[+width]]</code>, <code>[[+height]]</code>, <code>[[+extension]]</code>";
$_lang['contentblocks.imagewithtitle'] = "Bild med titel";
$_lang['contentblocks.imagewithtitle.description'] = "Samma som bild men denna gång med ett textfält för att ange ett alt eller title attribut.";
$_lang['contentblocks.image_with_title'] = $_lang['contentblocks.imagewithtitle'];
$_lang['contentblocks.image_with_title_template.description'] = "Mall för bild inmatningstypen. Bör förmodligen innehålla en <code>&lt;img&gt;</code> tagg. Tillgängliga platshållare: <code>[[+url]]</code>, <code>[[+title]]</code>, <code>[[+size]]</code>, <code>[[+width]]</code>, <code>[[+height]]</code>, <code>[[+extension]]</code>";

$_lang['contentblocks.list'] = "Lista";
$_lang['contentblocks.list.description'] = "Inmatningstyp för att enkelt bygga (kapslade) oordnade listor. ";
$_lang['contentblocks.list_template.description'] = "Mall för individuella punkter i listan. Denna bör troligen innehålla en <code>&lt;li&gt;</code> tagg. Tillgängliga platshållare: <code>[[+value]]</code> (listpunktens text), <code>[[+idx]]</code> (en växande punktnumrering, med start från 1 på varje nivå) och <code>[[+items]]</code> (underlistor, styrda med de andra mallarna).  ";
$_lang['contentblocks.list_wrapper_template.description'] = "Yttersta mallen för listor. Denna bör troligen innehålla en <code>&lt;ul&gt;</code> tagg. Tillgänglig platshållare: <code>[[+items]]</code> (listpunkter styrda med de andra mallarna). ";
$_lang['contentblocks.list_nested_template.description'] = "Inre mall för indragna underlistor. Denna bör troligen innehålla en <code>&lt;ul&gt;</code> tagg. Tillgänglig platshållare: <code>[[+items]]</code> (listpunkter styrda med de andra mallarna). ";

$_lang['contentblocks.orderedlist'] = "Sorterad lista";
$_lang['contentblocks.orderedlist.description'] = "Samma som typen Lista, men med en sorterad lista istället.";
$_lang['contentblocks.ordered_list'] = $_lang['contentblocks.orderedlist'];
$_lang['contentblocks.ordered_list_template.description'] = "Mall för individuella punkter i listan. Denna bör troligen innehålla en <code>&lt;li&gt;</code> tagg. Tillgängliga platshållare: <code>[[+value]]</code> (listpunktens text), <code>[[+idx]]</code> (en växande punktnumrering, med start från 1 på varje nivå) och <code>[[+items]]</code> (underlistor, styrda med de andra mallarna).  ";
$_lang['contentblocks.ordered_list_wrapper_template.description'] = "Yttersta mallen för listor. Denna bör troligen innehålla en <code>&lt;ol&gt;</code> tagg. Tillgänglig platshållare: <code>[[+items]]</code> (listpunkter styrda med de andra mallarna). ";
$_lang['contentblocks.ordered_list_nested_template.description'] = "Inre mall för indragna underlistor. Denna bör troligen innehålla en <code>&lt;ol&gt;</code> tagg. Tillgänglig platshållare: <code>[[+items]]</code> (listpunkter styrda med de andra mallarna). ";

$_lang['contentblocks.quote'] = "Citat";
$_lang['contentblocks.quote.description'] = "Textruta kombinerad med ett litet textfält för citat.";
$_lang['contentblocks.quote_template.description'] = "Mall för citatet, bör troligen innehålla <code>&lt;blockquote&gt;</code> och <code>&lt;cite&gt;</code> taggarna. Tillgängliga platshållare: <code>[[+value]]</code> (citatets inmatning) och <code>[[+cite]]</code> (den lilla författarinmatningen).";
$_lang['contentblocks.quote.author'] = "Författare";

$_lang['contentblocks.repeater'] = "Upprepare";
$_lang['contentblocks.repeater.description'] = "Låter dig definiera en grupp med fält som redigeraren sedan kan repetera som en grupp.";
$_lang['contentblocks.repeater_template.description'] = "Mallen för varje enskild rad i uppreparen. Det finns ingen standard eftersom det helt beror på din grupps konfiguration! För varje fält du definierar, måste du även ange en nyckel. Uppreparen kommer först att behandla alla definierade fält genom sin egen processor (så att ett bildfält först behandlas som om det var ett självständigt bildfält), och resultatet från det placeras i platshållaren baserat på nyckeln. Vänligen se dokumentationen på modmore.com för en mer detaljerade instruktioner över hur uppreparen fungerar. Platshållaren <code>[[+idx]]</code> stöds också.";
$_lang['contentblocks.repeater.width'] = "Bredd (i %)";
$_lang['contentblocks.repeater.key'] = "Nyckel";
$_lang['contentblocks.repeater.key.description'] = "Nyckeln genom vilket värdet för det här fältet är tillgängligt i mallen Repeater. ";
$_lang['contentblocks.repeater.group'] = "Grupp";
$_lang['contentblocks.repeater.group.description'] = "Uppreparfältet låter dig upprepa en grupp med fält. Det är här du definierar fälten som skall upprepas.";
$_lang['contentblocks.repeater.max_items'] = "Maximalt antal objekt";
$_lang['contentblocks.repeater.max_items.description'] = "När inställt på ett värde större än 0, kan ytterligare rader inte läggas till utöver denna gräns.";
$_lang['contentblocks.repeater.max_items_reached'] = "Tyvärr, du får inte lägga till fler än [[+max]] objekt.";
$_lang['contentblocks.repeater.min_items'] = "Minsta antal objekt";
$_lang['contentblocks.repeater.min_items.description'] = "När satt till ett nummer större än 0, kan inte antalet rader blir lägre än denna gräns.";
$_lang['contentblocks.repeater.add_item'] = "Lägg till objekt";
$_lang['contentblocks.repeater.delete_item'] = "Radera objekt";
$_lang['contentblocks.repeater.wrapper_template.description'] = "Yttre mall som omsluter alla övriga behandlade rader. Ska innehålla platshållaren <code>[[+rows]]</code>, kan också innehålla platshållaren <code>[[+total]]</code>.";
$_lang['contentblocks.repeater.row_separator'] = "Radavgränsare";
$_lang['contentblocks.repeater.row_separator.description'] = "En sträng för att limma ihop enskilda rader. Detta kunde vara bara några radbrytningar, som i standarden, eller så kan det vara en bunt html du vill ha mellan raderna.";


$_lang['contentblocks.richtext'] = "Rich text";
$_lang['contentblocks.richtext.description'] = "Enkelt Rich Text fält. Stöder både TinyMCE och Redactor.";
$_lang['contentblocks.richtext_template.description'] = "Eftersom rich text fält oftast hanterar sin egen markeringsgenerering, är mallen för en rich text inmatning oftast endast <code>[[+value]]</code> platshållaren, med du kunde rama in den i en behållare eller liknande.";

$_lang['contentblocks.table'] = "Tabell";
$_lang['contentblocks.table.description'] = "Interaktiv widget för tabelldata. ";
$_lang['contentblocks.table_template.description'] = "Mall för varje cell i tabellen. Bör förmodligen innehålla en &lt;td&gt; tagg. Tillgängliga platshållare: <code>[[+cell]]</code>, <code>[[+colIdx]]</code>, <code>[[+colTotal]]</code>";
$_lang['contentblocks.table.row_template'] = "Mall för rad";
$_lang['contentblocks.table.row_template.description'] = "Mallen för varje rad i tabellen. Innehåller förmodligen en <code>&lt;tr&gt;</code> tagg. Tillgängliga platshållare: <code>[[+row]]</code> (innehåller varje cell på raden), <code>[[+idx]]</code>";
$_lang['contentblocks.table.wrapper_template.description'] = "Omslutningsmallen för hela tabellen. Tillgängliga platshållare: <code>[[+body]]</code>, <code>[[+total]]</code>.";

$_lang['contentblocks.textarea'] = "Textruta";
$_lang['contentblocks.textarea.description'] = "Simpel fler-rads inmatning.";

$_lang['contentblocks.textfield'] = "Text fält";
$_lang['contentblocks.textfield.description'] = "Simpel enkel-rads textfält.";
$_lang['contentblocks.textfield_template.description'] = "För textfältet använd bara <code>[[+value]]</code> platshållaren med en valfri behållare (ett stycke, rubrik etc).";

$_lang['contentblocks.video'] = "Video";
$_lang['contentblocks.video.description'] = "YouTube integrering som tillåter sökning med nyckelord och klistrande av YouTube länkar för att lägga in videon enkelt.";
$_lang['contentblocks.video_template.description'] = "Vid användning av en Video inmatning lagras YouTube videons ID i <code>[[+value]]</code> platshållaren. Denna kan användas för att generera inbäddningskoden i denna mall.";
$_lang['contentblocks.video.search'] = "Sök!";
$_lang['contentblocks.video.search_introduction'] = "Änvänd sök rutan nedan för att söka efter videon på YouTube.";
$_lang['contentblocks.video.enter_keywords'] = "Ange ett eller flera nyckelord..";
$_lang['contentblocks.video.load_more_results'] = "Ladda flera resultat";
$_lang['contentblocks.video.search_youtube'] = "Sök på YouTube";
$_lang['contentblocks.video.paste_link'] = "Klistra in en länk här";
$_lang['contentblocks.video.youtube_not_loaded'] = "YouTube APIn har inte laddats. Vänligen försök igen om några sekunder. Om problemet kvarstår är kanske inte APIn tillgänglig för tillfället.";
$_lang['contentblocks.video.api_error'] = "Åh nej, ett fel uppstod: [[+message]] (Kod [[+code]])";

// Snippet
$_lang['contentblocks.snippet'] = "Snippet";
$_lang['contentblocks.snippet.description'] = "Tillåt användaren att välja en snippet och ange egenskaper för den.";
$_lang['contentblocks.snippet.available_snippets'] = "Namn eller IDn på tillåtna snippets (Valfritt)";
$_lang['contentblocks.snippet.available_snippets.description'] = "För att begränsa tillgängliga snippets i redigeraren, ange en kommaseparerad lista med snippet namn eller IDn. Snippets i denna lista kommer alltid att vara tillgängliga, oberoende av de andra egenskaperna nedan.";
$_lang['contentblocks.snippet.categories'] = "Kategorier";
$_lang['contentblocks.snippet.categories.description'] = "Ange en lista med kategorinamn eller IDn att begränsa tillgängliga snippets till. ";
$_lang['contentblocks.snippet.add_property'] = "Lägg till egenskap";
$_lang['contentblocks.snippet.choose_snippet'] = "Välj snippet";
$_lang['contentblocks.snippet.other_property'] = "Annat (manuell inmatning)";
$_lang['contentblocks.snippet.other_property.desc'] = "Egenskaper som skall läggas till i slutet av påkallningen av snippeten kan anges här. Försäkra att du använder rätt taggsyntax syntax, likt såhär: &egenskap=`bar`";
$_lang['contentblocks.snippet.allow_uncached'] = "Tillåt ocachad?";
$_lang['contentblocks.snippet.allow_uncached.description'] = "När funktionen är aktiv visas ett \"Ocachad?\" alternativ för snippets. Om inaktiverat så påkallas alla snippets cachade.";
$_lang['contentblocks.snippet.uncached'] = "Cache?";
$_lang['contentblocks.snippet.uncached_0'] = "Ja";
$_lang['contentblocks.snippet.uncached_1'] = "Nej, cacha inte denna snippet";
$_lang['contentblocks.snippet.none_available'] = "Det finns inga snippets tillgängliga för detta fält. ";

$_lang['contentblocks.layout_template.description'] = 'Mallen för detta kapslad layout fält. Tänk på att alla layouter som finns inom detta fält har också sina mallar analyserade. Tillgängliga platshållare: <code>[[+value]]</code> (fullt analyserad HTML från de inneslutna layouterna)';
$_lang['contentblocks.layoutfield.available_layouts'] = "Tillgängliga layouter";
$_lang['contentblocks.layoutfield.available_layouts.description'] = "Komma-separerad lista med layouter som skall tillåtas. För att inte tillåta några layouter, exempelvis för att endast tillåta att mallar införs, ange -1.";
$_lang['contentblocks.layoutfield.available_templates'] = "Tillgängliga mallar";
$_lang['contentblocks.layoutfield.available_templates.description'] = "Komma-separerad lista med mallar som skall tillåtas. För att inte tillåta några mallar, ange -1.";

// Image related
$_lang['contentblocks.choose_image'] = "Väl bild";
$_lang['contentblocks.wrapper_template'] = "Omramande mall";
$_lang['contentblocks.nested_template'] = "Indragen mall";
$_lang['contentblocks.max_images'] = "Max antal bilder";
$_lang['contentblocks.max_images_reached'] = "Tyvärr, du kan inte använda fler än [[+max]] bilder i detta galleri.";
$_lang['contentblocks.upload_error'] = "Åh nej, nånting gick fel vid uppladdningen av [[+file]]: [[+message]]";
$_lang['contentblocks.upload_error.file_too_big'] = "\"\n\nFilen kanske var för stor.";
$_lang['contentblocks.image.thumbnail_size'] = "Manager miniatyrstorlek";
$_lang['contentblocks.image.thumbnail_size.description'] = "Storlek för tumnaglar i hanteraren. Lämna tomt för ingen, ett numeriskt värde för kvadratiska bilder, och dimensioner på formen lxb för rektangulära bilder. Exemple: 100 eller 100x50.";

// Misc
$_lang['contentblocks.use_contentblocks'] = "Använd ContentBlocks?";
$_lang['contentblocks.use_contentblocks.description'] = "När funktionen är aktiv kommer innehållsområdet att ersättas med en ContentBlocks kanvas för att skapa fler-kolumnigt, strukturerat innehåll.";
$_lang['contentblocks.or'] = "eller";
$_lang['contentblocks.title'] = "Titel";
$_lang['contentblocks.delete'] = "Radera";
$_lang['contentblocks.delete_video'] = "Radera video";
$_lang['contentblocks.move_layout_up'] = "Flytta upp";
$_lang['contentblocks.move_layout_down'] = "Flytta ner";
$_lang['contentblocks.delete_image'] = "Radera bild";
$_lang['contentblocks.add_content'] = "Lägg till innehåll";
$_lang['contentblocks.add_content.introduction'] = "Vänligen välj en typ av innehåll att infoga i layouten. Peka på namnet för att få en längre beskrivning.";
$_lang['contentblocks.add_layout'] = "Lägg till layout";
$_lang['contentblocks.add_layout.introduction'] = "Väl layouten du vill lägga till i innehållet.";
$_lang['contentblocks.upload'] = "Ladda upp";
$_lang['contentblocks.choose'] = "Välj";
$_lang['contentblocks.image.or_drop_images'] = "eller släpp bilder här";
$_lang['contentblocks.image.or_drop_image'] = "eller släpp en bild här";
$_lang['contentblocks.use_tinyrte'] = "Använd Tiny RTE?";
$_lang['contentblocks.use_tinyrte.description'] = "När funktionen är aktiv kommer inmatningsfältet att förbättras med en liten rich text redigerare för att tillåta enkel formattering (fet stil, kursivt och länkar).";
$_lang['contentblocks.use_tinyrte.description.image'] = "När funktionen är aktiv kommer titelfältet att förbättras med en liten rich text redigerare för att tillåta enkel formattering (fet stil, kursivt och länkar). Om du använder titelfältet för alt text eller ett title attribut, kan du behöva göra lite extra behandling (ex. htmlentities) för att förhindra att given markup bryter sönder din img tagg.";

$_lang['contentblocks.rebuild_content'] = "Bygg om innehåll";
$_lang['contentblocks.rebuild_content.confirm'] = "Genom att bygga om innehållet kommer alla resurser att genereras om från deras strukturerade innehåll. Detta betyder att alla layouter och fält som använts tidigare kommer att läsas in pånytt och gammalt innehåll kommer att skrivas över. Beroende på webbsidans storlek kan detta ta allt mellan några sekunder och flera minuter. För att starta denna process, klicka Ja nedan.";
$_lang['contentblocks.rebuild_content.initialising'] = "Initierar...";
$_lang['contentblocks.rebuild_content.resources_found'] = "Hittade totalt [[+total]] resurser. Ombyggnaden kommer att ta ~ [[+estimate]] minuter.";
$_lang['contentblocks.rebuild_content.loading_dependencies'] = "Laddar beroenden för analys av innehåll...";
$_lang['contentblocks.rebuild_content.loaded_dependencies'] = "Beroenden laddade, påbörjar ombyggnad av innehåll...";
$_lang['contentblocks.rebuild_content.skipping_not_allowed'] = "Hoppar över #[[+id]] ([[+pagetitle]]), ContentBlocks är instruerad att inte agera på denna resurs (Typ: [[+class_key]])";
$_lang['contentblocks.rebuild_content.skipping_not_used'] = "Hoppar över #[[+id]] ([[+pagetitle]]), använder ännu inte ContentBlocks.";
$_lang['contentblocks.rebuild_content.skipping_corrupt'] = "Hoppar över #[[+id]] ([[+pagetitle]]), innehållet är felaktigt eller saknas.";
$_lang['contentblocks.rebuild_content.done'] = "Ombyggnad av innehåll slutfört! [[+total_rebuild]] resurser byggdes om, [[+total_skipped]] hoppades över och [[+total_skipped_broken]] hoppades över på grund av ogiltigt innehåll.";
$_lang['contentblocks.rebuild_content.clear_cache'] = "Rensar cachen för kontext(er): [[+contexts]]";
$_lang['contentblocks.rebuild_content.clear_cache_complete'] = "Cachen rensad. Allt klart!";
$_lang['contentblocks.generating_canvas'] = "Genererar din innehållscanvas... detta borde bara ta en liten stund.";
$_lang['contentblocks.content'] = "Mallinnehåll";
$_lang['contentblocks.open_template_builder'] = "Skapa mall";
$_lang['contentblocks.template_builder'] = "Mallskapare";

/**
 * Settings. Oh boy.
 */

$_lang['setting_contentblocks.accepted_resource_types'] = "Tillåtna resurstyper";
$_lang['setting_contentblocks.accepted_resource_types_desc'] = "En kommaseparerad lista med resursers klassnycklar som ContentBlocks kommer att försöka förbättra.";

$_lang['setting_contentblocks.clear_cache_after_rebuild'] = "Rensa cachen efter ombyggnad";
$_lang['setting_contentblocks.clear_cache_after_rebuild_desc'] = "När funktionen är aktiv kommer funktionen Bygg om innehåll i komponenten att automatiskt rensa resurscachen när den är klar.";

$_lang['setting_contentblocks.debug'] = "Felsök";
$_lang['setting_contentblocks.debug_desc'] = "När funktionen är aktiv kommer ContentBlocks att använda ominifierad javascript i hanteraren för att underlätta felsökning av problem.";

$_lang['setting_contentblocks.disabled'] = "Inaktiverad";
$_lang['setting_contentblocks.disabled_desc'] = "Sätt denna inställning till 1 för att inaktivera ContentBlocks helt på denna hemsida. Detta kan åsidosättas på kontextnivå för att endast använda det på specifika kontexter.";

$_lang['setting_contentblocks.implode_string'] = "Kombinera sträng";
$_lang['setting_contentblocks.implode_string_desc'] = "Limmet mellan individuella fält och layout utskrifter när innehållet parsas.";

$_lang['setting_contentblocks.default_layout'] = "Standardlayout";
$_lang['setting_contentblocks.default_layout_desc'] = "Ange ID för standardlayout på nya resurser eller resurser som ännu inte använts med ContentBlocks. Från och med 1.2 gäller detta endast när ingen standardmall finns.";

$_lang['setting_contentblocks.default_layout_part'] = "Standard kolumn";
$_lang['setting_contentblocks.default_layout_part_desc'] = "Ange referensen till en kolumn i standardlayouten du angett. På nya resurser eller resurser som ännu inte använts med ContentBlocks, kommer att ett fält (definieras med inställningen standardfält) infogas i denna kolumn med innehållet. Från och med 1.2 gäller detta endast när ingen standardmall finns.";

$_lang['setting_contentblocks.default_field'] = "Standardfält";
$_lang['setting_contentblocks.default_field_desc'] = "Ange ID för ett fält att infoga i standardkolumnen för standardlayouten du angett. När satt till 0, kommer ett enkelt rik-text fält eller textruta att användas. Från och med 1.2 gäller detta endast när ingen standardmall finns.";

$_lang['setting_contentblocks.code.theme'] = "Kodtema";
$_lang['setting_contentblocks.code.theme_desc'] = "Det tema som skall användas vid inmatning av kod. Hänvisa till Ace dokumentationen för att hitta de olika möjligheterna.";

$_lang['setting_contentblocks.image.hash_name'] = "Hash namn";
$_lang['setting_contentblocks.image.hash_name_desc'] = "När funktionen är aktiv hashas de uppladdade filnamnen för att dölja de ursprungliga filnamnen.";

$_lang['setting_contentblocks.image.prefix_time'] = "Använd tid som prefix";
$_lang['setting_contentblocks.image.prefix_time_desc'] = "När funktionen är aktiv ges de uppladdade filnamnen ett unix tidsstämpel som prefix.";

$_lang['setting_contentblocks.image.sanitize'] = "Sanera";
$_lang['setting_contentblocks.image.sanitize_desc'] = "När funktionen är aktiv saneras filnamn innan uppladdning för att försäkra att det inte finns några ovanliga tecken. Sanering stöder också transkribering genom iconv eller tredjeparts translit paket.";

$_lang['setting_contentblocks.image.source'] = "Källa";
$_lang['setting_contentblocks.image.source_desc'] = "Välj standard media källa att använda för bild och galleri inmatningstyper. Detta kan åsidosättas på fält nivå.";

$_lang['setting_contentblocks.image.upload_path'] = "Uppladdningssökväg";
$_lang['setting_contentblocks.image.upload_path_desc'] = "Sökvägen, inom den definierade media källan, vart filer skall laddas upp. Detta stöder [[+year]], [[+month]], [[+day]], [[+user]], [[+username]] och [[+resource]] platshållare.";

$_lang['setting_contentblocks.cache_source'] = "Cache källa";
$_lang['setting_contentblocks.cache_source.description'] = "Välj den mediakälla som ska användas för bilder och cache för galleriets tumnaglar.";

$_lang['setting_contentblocks.cache_path'] = "Cache sökväg";
$_lang['setting_contentblocks.cache_path.description'] = "Sökvägen, inom den definierade mediakällan, som cache filerna för tumnaglarna ska laddas upp till.";

$_lang['setting_contentblocks.sanitize_pattern'] = "Saniteringsmönster";
$_lang['setting_contentblocks.sanitize_pattern_desc'] = "Ett RegEx mönster att använda vid sanering av filnamn vid behov.";

$_lang['setting_contentblocks.sanitize_replace'] = "Saneringsersättning";
$_lang['setting_contentblocks.sanitize_replace_desc'] = "En sträng att ersätta förekomster av RegEx mönstret för sanering med.";

$_lang['setting_contentblocks.custom_icon_path'] = "Anpassad ikon sökväg";
$_lang['setting_contentblocks.custom_icon_path_desc'] = "Sökväg till anpassade ikoner. {assets_path} är tillåtet.";

$_lang['setting_contentblocks.custom_icon_url'] = "Anpassad ikon URL";
$_lang['setting_contentblocks.custom_icon_url_desc'] = "URL till anpassade ikoner. {assets_url} är tillåtet.";

$_lang['setting_contentblocks.translit'] = "Transkribering";
$_lang['setting_contentblocks.translit_desc'] = "När värdet inte är \"none\" eller tomt aktiverar detta transkribering innan saneringsprocessen, som översätter felaktiga tecken till tillåtna sådana. Om detta värde är tomt, ärver den det från kärnans \"frriendly_alias_translit\" inställning.";

$_lang['setting_contentblocks.hide_logo'] = "Dölj logo";
$_lang['setting_contentblocks.hide_logo_desc'] = "Som standard visar vi en liten modmore logotyp i nedre högra hörnet av komponenten ContentBlocks. Om du av någon anledning inte vill ha den där, aktivera helt enkelt den här inställningen så kommer den att försvinna.";

$_lang['setting_contentblocks.translit_class'] = "Translit klass";
$_lang['setting_contentblocks.translit_class_desc'] = "Namnet på den klass som skall användas för transkribering. Om detta vädse är tomt, ärver den det från kärnans \"friendly_alias_translit_class\" inställning.";
$_lang['setting_contentblocks.translit_class_path'] = "Sökväg till Translit klass";
$_lang['setting_contentblocks.translit_class_path_desc'] = "Sökvägen till klassen att använda för transkribering. Om detta värde är tomt ärver det från kärnans \"friendly_alias_translit_class_path\" inställning.";

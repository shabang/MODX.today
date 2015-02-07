<script type="text/x-tmpl" id="contentblocks-wrapper-tpl">
    <div class="contentblocks-wrapper" id="contentblocks">
        <ul class="contentblocks-layout-wrapper"></ul>
        <div class="contentblocks-add-layout">
            <h3><a href="javascript:void(0);">+ {%=_('contentblocks.add_layout')%}</a></h3>
        </div>
    </div>
</script>

<script type="text/x-tmpl" id="contentblocks-layout-wrapper">
<li data-layout="{%=o.id%}" class="contentblocks-layout" id="{%=o.generated_id%}-wrapper">
    <div class="contentblocks-region-container" id="{%=o.generated_id%}">
        <div class="contentblocks-region-container-header">
            <div class="contentblocks-region-container-tools">
                <a href="javascript:void(0);" class="contentblocks-layout-settings"><span class="icon icon-cog"></span> {%=_('contentblocks.layout_settings')%}</a>
                <a href="javascript:void(0);" class="contentblocks-layout-move-up">&#9650;</a>
                <a href="javascript:void(0);" class="contentblocks-layout-move-down">&#9660;</a>

                <div class="contentblocks-dropmenu-container">
                    <a href="javascript:void(0);" class="contentblocks-layout-menu contentblocks-dropmenu-title"></a>
                    <ul class="contentblocks-dropmenu-items">
                        <li><a href="javascript:void(0);" class="contentblocks-repeat-layout">{%=_('contentblocks.repeat_layout')%}</a></li>
                        <li class="separator"></li>
                        <li><a href="javascript:void(0);" class="contentblocks-layout-delete">&times; {%=_('contentblocks.delete_layout')%}</a></li>
                    </ul>
                </div>
            </div>

            <h3><a class="contentblocks-collapser contentblocks-layout-collapser contentblocks-layout-expanded" href="javascript:void(0)">-</a> {%=o.name%}</h3>
        </div>
        <div class="contentblocks-region-settings"></div>
        <div class="contentblocks-region-content">
            {%#o.columns_html%}
        </div>
    </div>
</li>
</script>

<script type="text/x-tmpl" id="contentblocks-layout-column">
<div class="contentblocks-region {%=o.classes%}" data-part="{%=o.reference%}" style="width: {%=o.width%}%;">
    <ul class="contentblocks-content" data-part="{%=o.reference%}"></ul>

    <div class="contentblocks-add-block">
        <h3><a href="javascript:void(0);">+ {%=_('contentblocks.add_content')%}</a></h3>
    </div>
</div>
</script>

<script type="text/x-tmpl" id="contentblocks-modal-wrapper">
<div class="contentblocks-modal-header">
    <a href="javascript:void(0);" class="close">&times;</a>
    <h3>{%=o.title%}</h3>
</div>
<div class="contentblocks-modal-content {%=o.classes%}">
    {%#o.content%}
</div>
</script>
<script type="text/x-tmpl" id="contentblocks-modal-add-content">
<p>{%=_('contentblocks.add_content.introduction')%}</p>
<ul class="contentblocks-add-field-list">{%#o.fields%}</ul>
</script>
<script type="text/x-tmpl" id="contentblocks-modal-add-content-field">
    <li>
        <a href="javascript:void(0);" title="{%=o.description%}" data-id="{%=o.id%}" class="tooltip">
            <img src="{%=o.icon%}">
            <span>{%=o.name%}</span>
        </a>
    </li>
</script>


<script type="text/x-tmpl" id="contentblocks-modal-layout-setting">
<p>{%=_('contentblocks.layout_setting.introduction')%}</p>
{%#o.setting_fields%}
<div class="contentblocks-save-layout_settings">
    <a href="javascript:void(0);" class="big contentblocks-field-button save-layout_settings-button">{%=_('contentblocks.save')%}</a>
</div>
</script>
<script type="text/x-tmpl" id="contentblocks-modal-layout-setting-select">
<div class="contentblocks-modal-field">
    <label for="setting-{%=o.reference%}">{%=o.title%}</label>
    <select data-name="{%=o.reference%}" id="setting-{%=o.reference%}">
        {%#o.options%}
    </select>
</div>
</script>
<script type="text/x-tmpl" id="contentblocks-modal-layout-setting-textfield">
<div class="contentblocks-modal-field">
    <label for="setting-{%=o.reference%}">{%=o.title%}</label>
    <input type="text" data-name="{%=o.reference%}" id="setting-{%=o.reference%}" value="{%=o.value%}">
</div>
</script>
<script type="text/x-tmpl" id="contentblocks-modal-layout-setting-link">
<div class="contentblocks-modal-field contentblocks-modal-field-link">
    <label for="setting-{%=o.reference%}">{%=o.title%}</label>
    <div class="contentblocks-setting-link">
        <input type="text" class="linkfield" data-name="{%=o.reference%}" id="setting-{%=o.reference%}" value="{%=o.value%}">
    </div>
</div>
</script>
<script type="text/x-tmpl" id="contentblocks-modal-layout-setting-textarea">
<div class="contentblocks-modal-field">
    <label for="setting-{%=o.reference%}">{%=o.title%}</label>
    <textarea data-name="{%=o.reference%}" id="setting-{%=o.reference%}">{%=o.value%}</textarea>
</div>
</script>

<script type="text/x-tmpl" id="contentblocks-modal-tinyrte-link">
<div class="contentblocks-modal-field contentblocks-modal-field-link">
    <label>{%=o.title%}</label>
    <div class="contentblocks-setting-link">
        <input type="text" id="tinyrte-link" class="linkfield" value="{%=o.value%}">
    </div>
    <div class="contentblocks-actions">
        <a href="javascript:void(0);" class="big contentblocks-field-button save-button">{%=_('contentblocks.save')%}</a>
        <a href="javascript:void(0);" class="big contentblocks-field-button delete-button right">&times; {%=_('contentblocks.delete')%}</a>
    </div>
</div>
</script>

<script type="text/x-tmpl" id="contentblocks-modal-add-layout">
<p>{%=_('contentblocks.add_layout.introduction')%}</p>
{% if (o.hasTemplates) { %}
    <h2>{%=_('contentblocks.templates')%}</h2>
    <ul class="contentblocks-add-template-list">{%#o.templates%}</ul>

    {% if (o.hasLayouts) { %}
        <h2>{%=_('contentblocks.layouts')%}</h2>
    {% } %}
{% } %}
{% if (o.hasLayouts) { %}
    <ul class="contentblocks-add-layout-list">{%#o.layouts%}</ul
{% } %}
</script>
<script type="text/x-tmpl" id="contentblocks-modal-add-layout-option">
    <li>
        <a href="javascript:void(0);" title="{%=o.description%}" data-id="{%=o.id%}" class="tooltip">
            <img src="{%=o.icon%}">
            <span>{%=o.name%}</span>
        </a>
    </li>
</script>
<script type="text/x-tmpl" id="contentblocks-modal-add-layout-template-option">
    <li>
        <a href="javascript:void(0);" title="{%=o.description%}" data-id="{%=o.id%}" class="tooltip">
            <img src="{%=o.icon%}">
            <span>{%=o.name%}</span>
        </a>
    </li>
</script>

<script type="text/x-tmpl" id="contentblocks-empty-field">
    <li class="contentblocks-field-outer contentblocks-field-empty">
        <div class="contentblocks-field-wrap">
            <div class="contentblocks-add-first-content">
                
            </div>
        </div>
    </li>
</script>

<script type="text/x-tmpl" id="contentblocks-button-delete-field">
<a href="javascript:void(0);" class="contentblocks-field-delete">&times; {%=_('contentblocks.delete')%}</a>
</script>

<script type="text/x-tmpl" id="contentblocks-button-field-settings">
<a href="javascript:void(0);" class="contentblocks-field-settings"><span class="icon icon-cog"></span></a>
</script>

<script type="text/x-tmpl" id="contentblocks-field-settings-exposed-as-field">
<div class="contentblocks-exposed-fields-wrapper contentblocks-exposed-fields-as-field-wrapper">
{%#o.exposed_fields_asField%}
</div>
</script>

<script type="text/x-tmpl" id="contentblocks-field-settings-exposed-as-setting">
<div class="contentblocks-exposed-fields-wrapper contentblocks-exposed-fields-as-setting-wrapper">

<label><span class="icon icon-cog"></span> {%=_('contentblocks.field_settings')%}</label>
{%#o.exposed_fields_asSetting%}
</div>
</script>

<script type="text/x-tmpl" id="contentblocks-modal-field-setting">
{%#o.setting_fields%}
<div class="contentblocks-save-layout_settings">
    <a href="javascript:void(0);" class="big contentblocks-field-button save-field_settings-button">{%=_('contentblocks.save')%}</a>
</div>
</script>

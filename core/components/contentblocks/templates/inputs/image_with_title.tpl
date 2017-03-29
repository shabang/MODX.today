<div class="contentblocks-loader"></div>

<div class="contentblocks-field contentblocks-field-image contentblocks-field-image_with_title  contentblocks-drop-target">
    <input type="hidden" class="url" />
    <input type="hidden" class="size" />
    <input type="hidden" class="width" />
    <input type="hidden" class="height" />
    <input type="hidden" class="extension" />
    <div class="contentblocks-field-actions">
        <a href="javascript:void(0);" class="contentblocks-field-delete-image">&times; {%=_('contentblocks.delete_image')%}</a>
    </div>

    <label>{%=o.name%}</label>
    <div class="contentblocks-field-image-upload">
        <a href="javascript:void(0);" class="big contentblocks-field-button contentblocks-field-image-choose">{%=_('contentblocks.choose')%}</a>
        <a href="javascript:void(0);" class="big contentblocks-field-button contentblocks-field-upload">{%=_('contentblocks.upload')%}</a>
        <a href="javascript:void(0);" class="big contentblocks-field-button contentblocks-field-image-url">{%=_('contentblocks.from_url')%}</a>
        {%=_('contentblocks.image.or_drop_image')%}
        <input type="file" id="{%=o.generated_id%}-upload" class="contentblocks-field-upload-field">
    </div>
    <div class="contentblocks-field-image-uploading">
        <div class="upload-progress">
            <div class="bar"></div>
        </div>
    </div>
    <div class="contentblocks-field-image-preview">
        <img />
        <input type="text" class="title" value="" id="{%=o.generated_id%}_title">
    </div>
</div>

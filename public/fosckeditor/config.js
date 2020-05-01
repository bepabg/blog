CKEDITOR.editorConfig = function (config) {
    config.removeButtons = 'Styles,Flash,Table,Language,Templates,Replace,SelectAll,Scayt,Form,Find,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,BidiLtr,BidiRtl';
    config.height = '500px';
    config.language = 'en';
    config.uiColor = '#c2d7eb';
    config.filebrowserBrowseUrl = '/kcfinder/browse.php?opener=ckeditor';
    config.filebrowserImageBrowseUrl = '/kcfinder/browse.php?opener=ckeditor';
    config.filebrowserFlashBrowseUrl = '/kcfinder/browse.php?opener=ckeditor';
    config.filebrowserUploadUrl = '/kcfinder/upload.php?opener=ckeditor';
    config.filebrowserImageUploadUrl = '/kcfinder/upload.php?opener=ckeditor';
    config.filebrowserFlashUploadUrl = '/kcfinder/upload.php?opener=ckeditor';
    config.extraPlugins = 'image2';
    config.extraAllowedContent = 'img[title]';
    config.toolbarGroups = [
        { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
        { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
        { name: 'links' },
        { name: 'insert' },
        { name: 'forms' },
        { name: 'tools' },
        { name: 'document',       groups: [ 'mode', 'document', 'doctools' ] },
        { name: 'others' },
        '/',
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
        { name: 'styles' },
        { name: 'colors' },
        { name: 'about' }
    ];
};



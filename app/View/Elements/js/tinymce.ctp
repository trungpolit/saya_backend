<?php
echo $this->start('script');
echo $this->Html->script('plugins/tinymce/tinymce.min');
?>
<script>
    tinymce.init({
        selector: "textarea.editor",
        language: 'vi',
        paste_data_images: true,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor imagetools"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons | sizeselect | fontselect |  fontsizeselect",
        relative_urls: false,
        external_filemanager_path: "<?php echo Router::url('/', true) ?>filemanager/",
        filemanager_title: "Quản lý file",
        external_plugins: {"filemanager": "<?php echo Router::url('/', true) ?>filemanager/plugin.min.js"}
    });
</script>
<?php
echo $this->end();

<?php
$this->start('css');
//echo $this->Html->css('plugins/JqueryFileUpload/styles/style');
echo $this->Html->css('plugins/JqueryFileUpload/styles/blueimp-gallery.min');
echo $this->Html->css('plugins/JqueryFileUpload/styles/jquery.fileupload');
echo $this->Html->css('plugins/JqueryFileUpload/styles/jquery.fileupload-ui');

echo $this->Html->css('plugins/JqueryFileUpload/styles/blueimp-gallery-indicator');
echo $this->Html->css('plugins/JqueryFileUpload/styles/blueimp-gallery-video');
?>
<noscript><?php echo $this->Html->css('plugins/JqueryFileUpload/styles/jquery.fileupload-noscript') ?></noscript>
<noscript><?php echo $this->Html->css('plugins/JqueryFileUpload/styles/jquery.fileupload-ui-noscript') ?></noscript>
<?php
$this->end();
?>
<?php
$this->start('script');
echo $this->Html->script('plugins/JqueryFileUpload/vendor/jquery.ui.widget');
echo $this->Html->script('plugins/JqueryFileUpload/tmpl.min');
echo $this->Html->script('plugins/JqueryFileUpload/load-image.all.min');
echo $this->Html->script('plugins/JqueryFileUpload/canvas-to-blob.min');
echo $this->Html->script('plugins/JqueryFileUpload/jquery.blueimp-gallery.min');
echo $this->Html->script('plugins/JqueryFileUpload/jquery.iframe-transport');

echo $this->Html->script('plugins/JqueryFileUpload/blueimp-helper');
echo $this->Html->script('plugins/JqueryFileUpload/blueimp-gallery.min');
echo $this->Html->script('plugins/JqueryFileUpload/blueimp-gallery-fullscreen');
echo $this->Html->script('plugins/JqueryFileUpload/blueimp-gallery-indicator');
echo $this->Html->script('plugins/JqueryFileUpload/blueimp-gallery-video');

echo $this->Html->script('plugins/JqueryFileUpload/jquery.fileupload');
echo $this->Html->script('plugins/JqueryFileUpload/jquery.fileupload-process');
echo $this->Html->script('plugins/JqueryFileUpload/jquery.fileupload-image');
echo $this->Html->script('plugins/JqueryFileUpload/jquery.fileupload-audio');
echo $this->Html->script('plugins/JqueryFileUpload/jquery.fileupload-video');
echo $this->Html->script('plugins/JqueryFileUpload/jquery.fileupload-validate');
echo $this->Html->script('plugins/JqueryFileUpload/jquery.fileupload-ui');
?>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<?php
echo $this->Html->script('plugins/JqueryFileUpload/cors/jquery.xdr-transport');
?>
<![endif]-->
<?php
$this->end();

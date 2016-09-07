<?php
$options = !empty($options) ? $options : array();
$dom_id = !empty($options['id']) ?
        $options['id'] : $this->Html->domId($options);
$upload_id = 'upload-' . $dom_id;
$file_hidden_id = 'file-hidden-' . $dom_id;
$template_upload_id = 'template-upload-' . $dom_id;
$template_download_id = 'template-download-' . $dom_id;
$default_upload_options = array(
    'uploadTemplateId' => '"' . $template_upload_id . '"',
    'downloadTemplateId' => '"' . $template_download_id . '"',
    'acceptFileTypes' => '/(\.|\/)(gif|jpe?g|png)$/i',
    'url' => '"' . Router::url(array('action' => 'reqUpload')) . '"',
    'disableImageResize' => '/Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent)',
    'maxFileSize' => Configure::read('saya.App.max_file_size_upload'),
);

if (!empty($upload_options['acceptFileTypes'])) {

    $upload_options['acceptFileTypes'] = '/(\.|\/)(' . $upload_options['acceptFileTypes'] . ')$/i';
}

if (!empty($upload_options)) {

    $upload_options = Hash::merge($default_upload_options, $upload_options);
} else {

    $upload_options = $default_upload_options;
}

// lấy về tên input_name thật sự từ cách đặt fieldName của Cake, mục đích mờ hóa
$origin_name = $name;
$extract_name = explode('.', $name);
$name = 'data[' . implode('][', $extract_name) . ']';

if (!empty($options['multiple'])) {

    $name = $name . '[]';
}

if (empty($request_data_file)) {

    $request_data_file = $this->request->data($origin_name);
}

$class = !empty($options['class']) ? $options['class'] : '';
$required_clss = !empty($options['required']) ? 'required' : '';

// trình xem media: audio/video
$playerPreview = !empty($options['playerPreview']) ? $options['playerPreview'] : '';

// xác định lỗi validate
$validationErrors = !empty($options['validationErrors']) ?
        $options['validationErrors'] : $this->Form->error($origin_name);
$validate_error_clss = !empty($validationErrors) ? 'error' : '';

// xác định xem video có upload lên youtube hay không?
$uploadYoutube = !empty($options['uploadYoutube']) ? $options['uploadYoutube'] : 0;

// tạo ra tên input dành cho cờ upload youtube
if (!empty($uploadYoutube)) {

    $extract_youtube_name = $extract_name;
    $extract_youtube_name[count($extract_name) - 1] = 'upload_youtube';
    $upload_youtube_name = 'data[' . implode('][', $extract_youtube_name) . ']';

    if (!empty($options['multiple'])) {

        $upload_youtube_name = $upload_youtube_name . '[]';
    }
}
?>
<div class="fileupload-container form-group <?php echo $required_clss ?> <?php echo $validate_error_clss ?>">
    <!-- The file upload form used as target for the file upload widget -->
    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
    <?php if (!empty($options['label'])): ?>
        <label for="<?php echo $upload_id ?>" class="control-label">
            <?php echo $options['label'] ?>
        </label>
    <?php endif; ?>
    <div id="<?php echo $upload_id ?>" class="fileupload-input">
        <div class="row fileupload-buttonbar">
            <div class="col-md-12 col-sm-12">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span><?php echo __('add_files') ?>...</span>
                    <input type="file" name="files[]" multiple id="<?php echo $file_hidden_id ?>">
                </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span><?php echo __('start_upload') ?></span>
                </button>
                <!--				<button type="reset" class="btn btn-warning cancel visible-lg">
                                    <i class="glyphicon glyphicon-ban-circle"></i>
                                    <span><?php echo __('cancel_upload') ?></span>
                                </button>-->
                <button type="button" class="btn btn-danger delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span><?php echo __('delete') ?></span>
                </button>
                <input type="checkbox" class="toggle">
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-md-12 col-sm-12 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped">
            <tbody class="files">
                <?php if (!empty($validationErrors)): ?>
                    <tr>
                        <td>
                            <div class="error-message"><?php echo $validationErrors ?></div>
                        </td>
                    </tr>
                <?php endif; ?>
                <?php if (!empty($request_data_file)): ?>
                    <?php
                    if (!is_array($request_data_file)) {

                        $request_data_file = array($request_data_file);
                    }
                    ?>
                    <?php foreach ($request_data_file as $file): ?>
                        <?php if (is_string($file) && !empty(json_decode($file, true))): ?>
                            <?php $file = json_decode($file, true); ?>
                        <?php endif; ?>
                        <?php if (!empty($file) && is_array($file)): ?>
                            <?php
                            $file_id = $file['id'];
                            $file_uri = ltrim($file['uri'], DS);
                            $file_url = Router::url('/', true) . $file_uri;
                            $file_name = $file['name'];
                            $file_size = $file['size'];
                            $file_delete_url = Router::url(array(
                                        'action' => 'reqDeleteFile',
                                        '?' => array(
                                            'id' => $file_id,
                            )));

                            // chuỗi hóa thông tin về file
                            $fileSerialize = json_encode($file);

                            // xác định xem file có phải là ảnh không
                            $image_type = @exif_imagetype(WWW_ROOT . $file_uri);
                            $data_gallery = '';
                            
                            if ($image_type !== false) {

                                $data_gallery = 'data-gallery="#blueimp-gallery-' . $dom_id . '"';
                            }
                            // kiểm tra xem file có phải là video hay không
                            else {

                                $video_types = Configure::read('saya.App.video_types');
                                $data_gallery = 'data-gallery="#blueimp-gallery-' . $dom_id . '"';
                                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                                $video_type = array_search($file_ext, $video_types);

                                if ($video_type !== false) {

                                    $video_data_attr = 'type="video/' . $video_types[$video_type] . '"';
                                }
                            }

                            // làm đẹp hiện thị file_size
                            $file_size = $this->Common->formatSizeUnits($file_size);
                            ?>
                            <tr class="template-download fade in">
                                <td>
                                    <span class="preview">
                                        <?php if ($image_type !== false): ?>

                                            <a class="<?php echo $playerPreview ?>" href="<?php echo $file_url; ?>" title="<?php echo $file_name ?>" download="<?php echo $file_name ?>" <?php echo $data_gallery ?>>
                                                <img src="<?php echo $file_url ?>" class="img-responsive img-thumbnail">
                                            </a>
                                        <?php elseif (!empty($video_data_attr)): ?>
                                            <a class="<?php echo $playerPreview ?>" href="<?php echo $file_url; ?>" title="<?php echo $file_name ?>" download="<?php echo $file_name ?>" <?php echo $data_gallery ?> <?php echo $video_data_attr ?>>
                                            </a>
                                        <?php else : ?>
                                            <a class="<?php echo $playerPreview ?>" href="<?php echo $file_url; ?>" title="<?php echo $file_name ?>" download="<?php echo $file_name ?>" <?php echo $data_gallery ?>>
                                            </a>
                                        <?php endif; ?>
                                    </span>
                                </td>
                                <td>
                                    <p class="name">
                                        <?php if (empty($video_data_attr)): ?>
                                            <a class="<?php echo $playerPreview ?>" href="<?php echo $file_url ?>" title="<?php echo $file_name ?>" download="<?php echo $file_name ?>" <?php echo $data_gallery ?>>
                                                <?php echo $file_name ?>
                                            </a>
                                        <?php else : ?>
                                            <a class="<?php echo $playerPreview ?>" href="<?php echo $file_url; ?>" title="<?php echo $file_name ?>" download="<?php echo $file_name ?>" <?php echo $data_gallery ?> <?php echo $video_data_attr ?>>
                                                <?php echo $file_name ?>
                                            </a>
                                        <?php endif; ?>
                                        <input type="hidden" class="file-hidden <?php echo $class ?>" name="<?php echo $name ?>" value='<?php echo $fileSerialize ?>' />
                                    </p>
                                </td>
                                <td>
                                    <span class="size"><?php echo $file_size ?></span>
                                </td>
                                <td>
                                    <?php if (!empty($file_delete_url)): ?>
                                        <button class="btn btn-danger delete" data-type="delete" data-url="<?php echo $file_delete_url ?>">
                                            <i class="glyphicon glyphicon-trash"></i>
                                            <span><?php echo __('delete') ?></span>
                                        </button>
                                        <input type="checkbox" name="delete" value="1" class="toggle">
                                    <?php else: ?>
                                        <button class="btn btn-warning cancel">
                                            <i class="glyphicon glyphicon-ban-circle"></i>
                                            <span><?php echo __('cancel') ?></span>
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <br>
</div>
<!-- The blueimp Gallery widget -->
<div id="blueimp-gallery-<?php echo $dom_id ?>" class="blueimp-gallery blueimp-gallery-carousel" data-filter=":even" data-hide-page-scrollbars="false">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
<!-- The template to display files available for upload -->
<script id="<?php echo $template_upload_id ?>" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
    <td>
    <span class="preview"></span>
    </td>
    <td>
    <p class="name">{%=file.name%}</p>
    <strong class="error text-danger"></strong>
    </td>
    <td>
    <p class="size"><?php echo __('processing') ?>...</p>
    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
    </td>
    <td>
    {% if (!i && !o.options.autoUpload) { %}
    <button class="btn btn-primary start" disabled>
    <i class="glyphicon glyphicon-upload"></i>
    <span><?php echo __('start') ?></span>
    </button>
    {% } %}
    {% if (!i) { %}
    <button class="btn btn-warning cancel">
    <i class="glyphicon glyphicon-ban-circle"></i>
    <span><?php echo __('cancel') ?></span>
    </button>
    {% } %}
    </td>
    </tr>
    {% } %}
</script>
<!-- The template to display files available for download -->
<script id="<?php echo $template_download_id ?>" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
    <td>
    <span class="preview">
    {% if (file.thumbnailUrl) { %}
    <a class="<?php echo $playerPreview ?>" href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery="#blueimp-gallery-<?php echo $dom_id ?>"><img src="{%=file.thumbnailUrl%}"></a>
    {% } %}
    </span>
    </td>
    <td>
    <p class="name">
    {% if (file.url) { %}
    <a class="<?php echo $playerPreview ?>" href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery="#blueimp-gallery-<?php echo $dom_id ?>"':''%}>{%=file.name%}</a>
    {% } else { %}
    <span>{%=file.name%}</span>
    {% } %}
    {% if (file.fileSerialize) { %}
    <input type="hidden" class="file-hidden <?php echo $class ?>" name="<?php echo $name ?>" value='{%=file.fileSerialize%}' />
    {% } %}
    </p>
    {% if (file.error) { %}
    <div><span class="label label-danger"><?php echo __('error') ?></span> {%=file.error%}</div>
    {% } %}
    </td>
    <td>
    <span class="size">{%=o.formatFileSize(file.size)%}</span>
    </td>
    <td>
    {% if (file.deleteUrl) { %}
    <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
    <i class="glyphicon glyphicon-trash"></i>
    <span><?php echo __('delete') ?></span>
    </button>
    <input type="checkbox" name="delete" value="1" class="toggle">
    {% } else { %}
    <button class="btn btn-warning cancel">
    <i class="glyphicon glyphicon-ban-circle"></i>
    <span><?php echo __('cancel') ?></span>
    </button>
    {% } %}
    <?php if (!empty($uploadYoutube)): ?>
        <br/><br/>
        <a href="#upload-youtube" class="upload-youtube btn btn-primary">
        <i class="fa fa-cloud-upload">  </i><span><?php echo __('youtube') ?></span>
        </a>
        <input type="hidden" name="<?php echo $upload_youtube_name ?>" value="0">
        <input type="checkbox" name="<?php echo $upload_youtube_name ?>" value="1"> 
    <?php endif; ?>
    </td>
    </tr>
    {% } %}
</script>
<script type="text/javascript">
    $(function () {
        'use strict';
        $('#<?php echo $upload_id ?>').fileupload({<?php foreach ($upload_options as $k => $v): ?><?php echo $k ?>: <?php echo $v ?>,<?php endforeach; ?>});
    });

</script>



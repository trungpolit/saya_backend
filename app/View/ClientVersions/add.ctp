<?php
echo $this->element('js/chosen');
?>
<script>
    $(function () {

        $('.chosen-select').chosen();
    });
</script>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <?php
                echo $this->Form->create($model_name, array(
                    'class' => 'form-horizontal',
                ));
                ?>
                <?php
                if (!empty($this->request->data[$model_name]['id'])) {

                    echo $this->Form->hidden($model_name . '.id', array(
                        'value' => $this->request->data[$model_name]['id'],
                    ));
                }
                ?>
                <?php
                $name_err = $this->Form->error($model_name . '.name');
                $name_err_class = !empty($name_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $name_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('client_version_name') ?> <?php echo $this->element('required') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.name', array(
                            'class' => 'form-control',
                            'div' => false,
                            'label' => false,
                            'required' => true,
                        ));
                        ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <?php
                $description_err = $this->Form->error($model_name . '.description');
                $description_err_class = !empty($description_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $description_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('client_version_description') ?> <?php echo $this->element('required') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->textarea($model_name . '.description', array(
                            'class' => 'form-control',
                            'div' => false,
                            'label' => false,
                            'required' => true,
                            'rows' => 12,
                        ));
                        ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <?php
                $platform_os_err = $this->Form->error($model_name . '.platform_os');
                $platform_os_err_class = !empty($platform_os_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $platform_os_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('client_version_platform_os') ?> <?php echo $this->element('required') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.platform_os', array(
                            'class' => 'form-control',
                            'div' => false,
                            'label' => false,
                            'options' => $platforms,
                            'empty' => '-------',
                        ));
                        ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <?php
                $platform_version_err = $this->Form->error($model_name . '.platform_version');
                $platform_version_err_class = !empty($platform_version_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $platform_version_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('client_version_platform_version') ?> <?php echo $this->element('required') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.platform_version', array(
                            'class' => 'form-control',
                            'div' => false,
                            'label' => false,
                            'type' => 'number',
                        ));
                        ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <?php
                $download_link_err = $this->Form->error($model_name . '.download_link');
                $download_link_err_class = !empty($download_link_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $download_link_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('client_version_download_link') ?> <?php echo $this->element('required') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.download_link', array(
                            'class' => 'form-control',
                            'div' => false,
                            'label' => false,
                        ));
                        ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <a href="<?php echo Router::url(array('action' => 'index')) ?>" class="btn btn-white"><i class="fa fa-ban"></i> <span><?php echo __('cancel_btn') ?></span> </a>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <span><?php echo __('save_btn') ?></span> </button>
                    </div>
                </div>
                <?php
                echo $this->Form->end();
                ?>
            </div>
        </div>
    </div>
</div>
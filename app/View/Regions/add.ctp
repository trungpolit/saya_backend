<?php
echo $this->element('js/chosen');
// sử dụng công cụ soạn thảo
echo $this->element('js/tinymce');
// sử dụng upload file
echo $this->element('JqueryFileUpload/basic_plus_ui_assets');
?>
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
                <?php if ($type == 'child'): ?>
                    <?php
                    $parent_id_err = $this->Form->error($model_name . '.parent_id');
                    $parent_id_err_class = !empty($parent_id_err) ? 'has-error' : '';
                    ?>
                    <div class="form-group <?php echo $parent_id_err_class ?>">
                        <label class="col-sm-2 control-label"><?php echo __('region_parent_id') ?> <?php echo $this->element('required') ?></label>

                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input($model_name . '.parent_id', array(
                                'class' => 'form-control',
                                'div' => false,
                                'label' => false,
                                'required' => true,
                                'empty' => '-------',
                                'options' => $parents,
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                <?php endif; ?>
                <?php
                $name_err = $this->Form->error($model_name . '.name');
                $name_err_class = !empty($name_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $name_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('region_name') ?> <?php echo $this->element('required') ?></label>

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
                    <label class="col-sm-2 control-label"><?php echo __('region_description') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.description', array(
                            'type' => 'textarea',
                            'class' => 'form-control editor',
                            'div' => false,
                            'label' => false,
                        ));
                        ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <?php
                $weight_err = $this->Form->error($model_name . '.weight');
                $weight_err_class = !empty($weight_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $weight_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('region_weight') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.weight', array(
                            'class' => 'form-control',
                            'div' => false,
                            'label' => false,
                            'type' => 'number',
                        ));
                        ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo __('region_status') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.status', array(
                            'class' => 'form-control',
                            'div' => false,
                            'label' => false,
                            'default' => 2,
                            'options' => $status,
                        ));
                        ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <a href="<?php echo Router::url(array('action' => 'index', $type)) ?>" class="btn btn-white"><i class="fa fa-ban"></i> <span><?php echo __('cancel_btn') ?></span> </a>
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
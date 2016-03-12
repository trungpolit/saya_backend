<?php
echo $this->element('js/chosen');
// sử dụng công cụ soạn thảo
echo $this->element('js/tinymce');
echo $this->element('js/datetimepicker');
?>
<script>
    $(function () {

        $('.chosen-select').chosen();
        $('.datetimepicker').datetimepicker({
            'format': 'DD-MM-YYYY HH:mm:ss',
            'showTodayButton': true
        });
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
                $region_id_err = $this->Form->error($model_name . '.region_id');
                $region_id_err_class = !empty($region_id_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $region_id_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('notification_region_id') ?> <?php echo $this->element('required') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.region_id', array(
                            'class' => 'form-control chosen-select',
                            'div' => false,
                            'label' => false,
                            'required' => true,
                            'empty' => '-------',
                            'options' => $regionTree,
                        ));
                        ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <?php
                $name_err = $this->Form->error($model_name . '.name');
                $name_err_class = !empty($name_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $name_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('notification_name') ?> <?php echo $this->element('required') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->textarea($model_name . '.name', array(
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
                $begin_at_err = $this->Form->error($model_name . '.begin_at');
                $begin_at_err_class = !empty($begin_at_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $begin_at_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('notification_begin_at') ?> <?php echo $this->element('required') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.begin_at', array(
                            'class' => 'form-control datetimepicker',
                            'div' => false,
                            'label' => false,
                            'required' => true,
                            'type' => 'text',
                            'value' => !empty($this->request->data[$model_name]['begin_at']) ?
                                    $this->Common->parseDateTime($this->request->data[$model_name]['begin_at']) : '',
                        ));
                        ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <?php
                $end_at_err = $this->Form->error($model_name . '.end_at');
                $end_at_err_class = !empty($end_at_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $end_at_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('notification_end_at') ?> <?php echo $this->element('required') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.end_at', array(
                            'class' => 'form-control datetimepicker',
                            'div' => false,
                            'label' => false,
                            'required' => true,
                            'type' => 'text',
                            'value' => !empty($this->request->data[$model_name]['end_at']) ?
                                    $this->Common->parseDateTime($this->request->data[$model_name]['end_at']) : '',
                        ));
                        ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <?php
//                $description_err = $this->Form->error($model_name . '.description');
//                $description_err_class = !empty($description_err) ? 'has-error' : '';
                ?>
<!--                <div class="form-group <?php echo $description_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('notification_description') ?> <?php echo $this->element('required') ?></label>

                    <div class="col-sm-10">
                <?php
//                        echo $this->Form->input($model_name . '.description', array(
//                            'type' => 'textarea',
//                            'class' => 'form-control editor',
//                            'div' => false,
//                            'label' => false,
//                        ));
                ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>-->
                <?php
                $weight_err = $this->Form->error($model_name . '.weight');
                $weight_err_class = !empty($weight_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $weight_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('notification_weight') ?></label>

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
                    <label class="col-sm-2 control-label"><?php echo __('notification_status') ?></label>

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
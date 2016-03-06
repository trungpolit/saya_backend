<?php
echo $this->element('js/chosen');
?>
<script>
    $(function () {

        $('.chosen-select').chosen({
            max_selected_options: 1
        });

        $('form').validate();
        // thực hiện validate cho password và password confirm
        $("#password_confirm").rules("add", {
            equalTo: '#password',
            messages: {
                equalTo: "<?php echo __('password_confirm_invalid') ?>"
            }
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
                $username_err = $this->Form->error($model_name . '.username');
                $username_err_class = !empty($username_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $username_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('user_username') ?> <?php echo $this->element('required') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.username', array(
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
                $role_id_err = $this->Form->error($model_name . '.role_id');
                $role_id_err_class = !empty($role_id_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $role_id_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('user_role_id') ?> <?php echo $this->element('required') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.role_id', array(
                            'class' => 'form-control chosen-select',
                            'div' => false,
                            'label' => false,
                            'options' => $roles,
                        ));
                        ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo __('user_password') ?> <?php echo $this->element('required') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.password', array(
                            'class' => 'form-control',
                            'div' => false,
                            'label' => false,
                            'required' => true,
                            'type' => 'password',
                            'id' => 'password',
                        ));
                        ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo __('user_password_confirm') ?> <?php echo $this->element('required') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.password_confirm', array(
                            'class' => 'form-control',
                            'div' => false,
                            'label' => false,
                            'required' => true,
                            'type' => 'password',
                            'id' => 'password_confirm',
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
                    <label class="col-sm-2 control-label"><?php echo __('user_description') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->textarea($model_name . '.description', array(
                            'class' => 'form-control',
                            'div' => false,
                            'label' => false,
                            'rows' => 12,
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
                    <label class="col-sm-2 control-label"><?php echo __('user_weight') ?></label>

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
                <?php
                $status_err = $this->Form->error($model_name . '.status');
                $status_err_class = !empty($status_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $status_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('user_status') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.status', array(
                            'class' => 'form-control',
                            'div' => false,
                            'label' => false,
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
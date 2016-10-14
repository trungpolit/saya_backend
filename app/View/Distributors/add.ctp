<?php
echo $this->element('js/chosen');
echo $this->element('js/validate');
echo $this->element('js/select2');
?>
<script>
    $(function () {

        $('.chosen-select').chosen({
        });
        $('#email').select2({
            tags: true,
            tokenSeparators: [",", " "]
        });

<?php if ($this->action == 'add'): ?>
            $('form').validate();
            // thực hiện validate cho password và password confirm
            $("#password_confirm").rules("add", {
                equalTo: '#password',
                messages: {
                    equalTo: "<?php echo __('password_confirm_invalid') ?>"
                }
            });
<?php else: ?>
            $('form#reset-password-form').validate();
            // thực hiện validate cho password và password confirm
            $("#password_confirm").rules("add", {
                equalTo: '#password',
                messages: {
                    equalTo: "<?php echo __('password_confirm_invalid') ?>"
                }
            });
<?php endif; ?>
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
                    <label class="col-sm-2 control-label"><?php echo __('distributor_name') ?> <?php echo $this->element('required') ?></label>

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
                <?php if ($this->action == 'add'): ?>
                    <?php
                    $code_err = $this->Form->error($model_name . '.code');
                    $code_err_class = !empty($code_err) ? 'has-error' : '';
                    ?>
                    <div class="form-group <?php echo $code_err_class ?>">
                        <label class="col-sm-2 control-label"><?php echo __('distributor_code') ?> <?php echo $this->element('required') ?></label>

                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input($model_name . '.code', array(
                                'class' => 'form-control',
                                'div' => false,
                                'label' => false,
                                'required' => true,
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                <?php else: ?>
                    <?php
                    $code_err = $this->Form->error($model_name . '.code');
                    $code_err_class = !empty($code_err) ? 'has-error' : '';
                    ?>
                    <div class="form-group <?php echo $code_err_class ?>">
                        <label class="col-sm-2 control-label"><?php echo __('distributor_code') ?> <?php echo $this->element('required') ?></label>

                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input($model_name . '.code', array(
                                'class' => 'form-control',
                                'div' => false,
                                'label' => false,
                                'required' => true,
                                'readonly' => true,
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                <?php endif; ?>
                <?php
                $username_err = $this->Form->error($model_name . '.username');
                $username_err_class = !empty($username_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $username_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('distributor_username') ?> <?php echo $this->element('required') ?></label>

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
                <?php if ($this->action == 'add'): ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo __('distributor_password_show') ?> <?php echo $this->element('required') ?></label>

                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input($model_name . '.password_show', array(
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
                        <label class="col-sm-2 control-label"><?php echo __('distributor_password_confirm') ?> <?php echo $this->element('required') ?></label>

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
                <?php else: ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo __('distributor_password_show') ?> <?php echo $this->element('required') ?></label>

                        <div class="col-sm-7">
                            <?php
                            echo $this->Form->input($model_name . '.password_show', array(
                                'class' => 'form-control',
                                'div' => false,
                                'label' => false,
                                'required' => true,
                                'readonly' => true,
                            ));
                            ?>
                        </div>
                        <div class="col-sm-3">
                            <a class="btn btn-primary" href="#reset-password" data-toggle="modal" data-target="#reset-password">
                                <i class="fa fa-unlock"></i> <span>Đặt lại mật khẩu</span>
                            </a>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                <?php endif; ?>
                <?php
                $region_id_err = $this->Form->error($model_name . '.region_id');
                $region_id_err_class = !empty($region_id_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $region_id_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('distributor_region_id') ?> <?php echo $this->element('required') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.region_id', array(
                            'class' => 'form-control chosen-select',
                            'div' => false,
                            'label' => false,
                            'options' => $regionTree,
                            'multiple' => true,
                            'required' => true,
                        ));
                        ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <?php
                $email_err = $this->Form->error($model_name . '.email');
                $email_err_class = !empty($email_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $email_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('distributor_email') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.email', array(
                            'class' => 'form-control',
                            'div' => false,
                            'label' => false,
                            'id' => 'email',
                            'multiple' => true,
                            'options' => !empty($this->request->data[$model_name]['email']) ?
                                    $this->request->data[$model_name]['email'] : array(),
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
                    <label class="col-sm-2 control-label"><?php echo __('distributor_description') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->textarea($model_name . '.description', array(
                            'class' => 'form-control',
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
                    <label class="col-sm-2 control-label"><?php echo __('distributor_weight') ?></label>

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
                    <label class="col-sm-2 control-label"><?php echo __('distributor_status') ?></label>

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

<?php if ($this->action == 'edit'): ?>
    <div aria-hidden="true" role="dialog" tabindex="-1" id="reset-password" class="modal inmodal fade" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <?php
                echo $this->Form->create($model_name, array(
                    'url' => array(
                        'controller' => Inflector::pluralize($model_name),
                        'action' => 'resetPassword',
                    ),
                    'class' => 'form-horizontal',
                    'id' => 'reset-password-form',
                ));
                ?>
                <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><?php echo __('reset_password_action_title') ?></h4>
                </div>
                <div class="modal-body">

                    <?php
                    if (!empty($this->request->data[$model_name]['id'])) {

                        echo $this->Form->hidden($model_name . '.id', array(
                            'value' => $this->request->data[$model_name]['id'],
                        ));
                    }
                    ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo __('user_password') ?> <?php echo $this->element('required') ?></label>

                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input($model_name . '.password_show', array(
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
                </div>

                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-white" type="button"><?php echo __('cancel_btn') ?></button>
                    <button class="btn btn-primary"><?php echo __('save_btn') ?></button>
                </div>
                <?php
                echo $this->Form->end();
                ?>
            </div>
        </div>
    </div>
    <?php















 endif; 

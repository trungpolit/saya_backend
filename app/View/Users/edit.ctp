<?php
echo $this->element('js/chosen');
echo $this->element('js/validate');
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
<?php echo $this->start('page-heading') ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2><?php echo $page_title ?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo!empty($home_url) ? $home_url : '' ?>"><?php echo __('home_title') ?></a>
            </li>
            <?php if (!empty($breadcrumb)): ?>
                <?php
                if (!is_array($breadcrumb[0])) {

                    $breadcrumb = array($breadcrumb);
                }
                ?>
                <?php foreach ($breadcrumb as $k => $item): ?>
                    <?php
                    $li_class = '';
                    if ($k == count($breadcrumb) - 1) {

                        $li_class = 'active';
                    }
                    ?>
                    <li class="<?php echo $li_class ?>">
                        <a href="<?php echo $item['url'] ?>" >
                            <?php if (!empty($li_class)): ?>
                                <strong><?php echo $item['label'] ?></strong>
                            <?php else: ?>
                                <?php echo $item['label'] ?>
                            <?php endif; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <a class="btn btn-primary" href="#reset-password" data-toggle="modal" data-target="#reset-password">
                <i class="fa fa-unlock"></i> <span><?php echo __('reset_password_action_title') ?></span>
            </a>
        </div>
    </div>
</div>
<?php echo $this->end() ?>
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
                            'required' => true,
                        ));
                        ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <?php
                $region_id_err = $this->Form->error($model_name . '.region_id');
                $region_id_err_class = !empty($region_id_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $region_id_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('user_region_id') ?> <?php echo $this->element('required') ?></label>

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
                $bundle_id_err = $this->Form->error($model_name . '.bundle_id');
                $bundle_id_err_class = !empty($bundle_id_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $bundle_id_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('user_bundle_id') ?> <?php echo $this->element('required') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.bundle_id', array(
                            'class' => 'form-control chosen-select',
                            'div' => false,
                            'label' => false,
                            'options' => $bundles,
                            'multiple' => true,
                            'required' => true,
                        ));
                        ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <?php
                $description_err = $this->Form->error($model_name . '.code');
                $description_err_class = !empty($description_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $description_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('user_code') ?></label>

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
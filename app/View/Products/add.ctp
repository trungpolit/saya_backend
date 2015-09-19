<?php
echo $this->element('js/chosen');
// sử dụng công cụ soạn thảo
echo $this->element('js/tinymce');
// sử dụng upload file
echo $this->element('JqueryFileUpload/basic_plus_ui_assets');
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
                $region_parent_id_err = $this->Form->error($model_name . '.region_parent_id');
                $region_parent_id_err_class = !empty($region_parent_id_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $region_parent_id_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('product_region_parent_id') ?> <?php echo $this->element('required') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.region_parent_id', array(
                            'class' => 'form-control chosen-select',
                            'div' => false,
                            'label' => false,
                            'required' => true,
                            'empty' => '-------',
                            'options' => $region_parents,
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
                    <label class="col-sm-2 control-label"><?php echo __('product_region_id') ?> <?php echo $this->element('required') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.region_id', array(
                            'class' => 'form-control chosen-select',
                            'div' => false,
                            'label' => false,
                            'required' => true,
                            'empty' => '-------',
                            'options' => $region_children,
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
                    <label class="col-sm-2 control-label"><?php echo __('product_bundle_id') ?> <?php echo $this->element('required') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.bundle_id', array(
                            'class' => 'form-control chosen-select',
                            'div' => false,
                            'label' => false,
                            'required' => true,
                            'empty' => '-------',
                            'options' => $bundles,
                        ));
                        ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <?php
                $category_id_err = $this->Form->error($model_name . '.category_id');
                $category_id_err_class = !empty($category_id_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $category_id_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('product_category_id') ?> <?php echo $this->element('required') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.category_id', array(
                            'class' => 'form-control chosen-select',
                            'div' => false,
                            'label' => false,
                            'required' => true,
                            'empty' => '-------',
                            'options' => $categories,
                            'multiple' => true,
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
                    <label class="col-sm-2 control-label"><?php echo __('product_name') ?> <?php echo $this->element('required') ?></label>

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
                $price_err = $this->Form->error($model_name . '.price');
                $price_err_class = !empty($price_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $price_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('product_price') ?> <?php echo $this->element('required') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.price', array(
                            'class' => 'form-control',
                            'div' => false,
                            'label' => false,
                            'required' => true,
                            'type' => 'number',
                        ));
                        ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <?php
                $unit_err = $this->Form->error($model_name . '.unit');
                $unit_err_class = !empty($unit_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $unit_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('product_unit') ?> <?php echo $this->element('required') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.unit', array(
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
                    <label class="col-sm-2 control-label"><?php echo __('product_description') ?></label>

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
                $supplier_err = $this->Form->error($model_name . '.supplier');
                $supplier_err_class = !empty($supplier_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $supplier_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('product_supplier') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.supplier', array(
                            'class' => 'form-control',
                            'div' => false,
                            'label' => false,
                        ));
                        ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <?php
                $contact_err = $this->Form->error($model_name . '.contact');
                $contact_err_class = !empty($contact_err) ? 'has-error' : '';
                ?>
                <div class="form-group <?php echo $contact_err_class ?>">
                    <label class="col-sm-2 control-label"><?php echo __('product_contact') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input($model_name . '.contact', array(
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
                    <label class="col-sm-2 control-label"><?php echo __('product_weight') ?></label>

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
                    <label class="col-sm-2 control-label"><?php echo __('product_logo') ?></label>

                    <div class="col-sm-10">
                        <?php
                        echo $this->element('JqueryFileUpload/basic_plus_ui', array(
                            'name' => $model_name . '.logo',
                            'options' => array(
                                'id' => 'logo',
                            ),
                            'upload_options' => array(
                                'maxNumberOfFiles' => 1,
                            ),
                        ));
                        ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo __('product_status') ?></label>

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
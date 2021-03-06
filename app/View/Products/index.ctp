<?php
echo $this->element('page-heading-with-add-action');
echo $this->element('js/chosen');
echo $this->element('js/datetimepicker');
?>
<script>
    $(function () {

        $('.chosen-select').chosen();
        $('.datepicker').datetimepicker({
            'format': 'DD-MM-YYYY HH:mm:ss',
            'showTodayButton': true
        });
        var action = '<?php echo $this->action ?>';
        var distributor_id = $('#distributor_id').val();
        $('#region_id').on('change', function () {
            var region_id = $(this).val();
            var request = '<?php echo $this->Html->url(array('action' => 'reqDistributorByRegionId')) ?>';
            var req = $.get(request, {region_id: region_id, action: action}, function (data) {
                $('#distributor_id_container').html(data);
                $('#distributor_id').val(distributor_id);
                $('#distributor_id').chosen();
            });
            req.fail(function () {
                alert('reqDistributorByRegionId was failed.');
            });
        });
        $('#region_id').trigger('change');
    });
</script>
<style>
    .product-logo {
        width: 64px;
    }
    .long-text {
        word-wrap: break-word; /* IE */
        word-break: break-all;
    }
</style>
<div class="ibox-content m-b-sm border-bottom">
    <?php
    echo $this->Form->create('Search', array(
        'url' => array(
            'action' => $this->action,
            'controller' => Inflector::pluralize($model_name),
        ),
        'type' => 'get',
    ))
    ?>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <?php
                echo $this->Form->input('region_id', array(
                    'div' => false,
                    'class' => 'form-control chosen-select',
                    'label' => __('product_region_id'),
                    'options' => $regionTree,
                    'empty' => '-------',
                    'default' => $this->request->query('region_id'),
                    'id' => 'region_id',
                ));
                ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group" id="distributor_id_container">
                <?php
                echo $this->Form->input('distributor_id', array(
                    'div' => false,
                    'class' => 'form-control chosen-select',
                    'label' => __('product_distributor_id'),
                    'options' => $distributors,
                    'empty' => '-------',
                    'default' => $this->request->query('distributor_id'),
                    'id' => 'distributor_id',
                ));
                ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php
                echo $this->Form->input('name', array(
                    'div' => false,
                    'class' => 'form-control',
                    'label' => __('product_name'),
                    'default' => $this->request->query('name'),
                ));
                ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php
                echo $this->Form->input('status', array(
                    'div' => false,
                    'class' => 'form-control',
                    'label' => __('product_status'),
                    'options' => $status,
                    'empty' => '-------',
                    'default' => $this->request->query('status'),
                ));
                ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php
                echo $this->Form->input('created_start', array(
                    'div' => false,
                    'class' => 'form-control datepicker',
                    'label' => __('product_created_start'),
                    'default' => $this->request->query('created_start'),
                ));
                ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php
                echo $this->Form->input('created_end', array(
                    'div' => false,
                    'class' => 'form-control datepicker',
                    'label' => __('product_created_end'),
                    'default' => $this->request->query('created_end'),
                ));
                ?>
            </div>
        </div>
        <div class="col-md-4">
            <div>
                <label style="visibility: hidden"><?php echo __('search_btn') ?></label>
            </div>
            <?php echo $this->element('buttonSearchClear'); ?>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>
<div class="ibox float-e-margins">
    <div class="ibox-content">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <?php if (!empty($list_data)): ?>
                            <th><?php echo __('no') ?></th>
                            <th><?php echo $this->Paginator->sort('name', __('product_name')); ?></th>
                            <th>
                                <?php echo __('product_region_parent_id'); ?>
                                <br/>
                                <?php echo $this->Paginator->sort('region_id', __('product_region_id')); ?>
                            </th>
                            <th><?php echo $this->Paginator->sort('distributor_id', __('product_distributor_id')); ?></th>
                            <th><?php echo __('product_category_id'); ?></th>
                            <th><?php echo $this->Paginator->sort('weight', __('product_weight')); ?></th>
                            <th><?php echo $this->Paginator->sort('status', __('product_status')); ?></th>
                            <th>
                                <?php echo $this->Paginator->sort('modified', __('product_modified')); ?>
                            </th>
                            <th><?php echo __('operation') ?></th>
                        <?php else: ?>
                            <th><?php echo __('no') ?></th>
                            <th><?php echo __('product_name'); ?></th>
                            <th>
                                <?php echo __('product_region_parent_id'); ?>
                                <br/>
                                <?php echo __('product_region_id'); ?>
                            </th>
                            <th><?php echo __('product_distributor_id'); ?></th>
                            <th><?php echo __('product_category_id'); ?></th>
                            <th><?php echo __('product_weight'); ?></th>
                            <th><?php echo __('product_status') ?></th>
                            <th>
                                <?php echo __('product_modified') ?>
                            </th>
                            <th><?php echo __('operation') ?></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($list_data)): ?>
                        <?php
                        $stt = $this->Paginator->counter('{:start}');
                        ?>
                        <?php foreach ($list_data as $item): ?>
                            <tr class="form-edit">
                                <td >
                                    <?php
                                    $id = $item[$model_name]['id'];
                                    echo $this->Form->hidden('id', array(
                                        'value' => $id,
                                    ));
                                    echo $this->Form->hidden('region_id', array(
                                        'value' => $item[$model_name]['region_id'],
                                    ));
                                    echo $this->Form->hidden('category_id', array(
                                        'value' => $item[$model_name]['category_id'],
                                    ));
                                    echo $this->Form->hidden('distributor_id', array(
                                        'value' => $item[$model_name]['distributor_id'],
                                    ));
                                    echo $stt;
                                    ?>
                                </td>
                                <td>
                                    <strong>
                                        <?php
                                        echo $item[$model_name]['name'];
                                        ?>
                                    </strong>
                                    <br/>
                                    <img class="product-logo" src="<?php echo Router::url('/', true) . $item[$model_name]['logo_path'] ?>" />
                                </td>
                                <td>
                                    <?php
//                                    echo $this->Form->input('region_parent_id', array(
//                                        'div' => false,
//                                        'class' => 'form-control chosen-select',
//                                        'label' => false,
//                                        'default' => isset($item[$model_name]['region_parent_id']) ?
//                                                $item[$model_name]['region_parent_id'] : '',
//                                        'options' => $region_parents,
//                                        'empty' => '-------',
//                                    ));
                                    ?>
                                    <?php
//                                    echo $this->Form->input('region_id', array(
//                                        'div' => false,
//                                        'class' => 'form-control chosen-select',
//                                        'label' => false,
//                                        'default' => isset($item[$model_name]['region_id']) ?
//                                                $item[$model_name]['region_id'] : '',
//                                        'options' => $region_children,
//                                        'empty' => '-------',
//                                    ));
                                    ?>
                                    <?php
                                    echo!empty($region_parents[$item[$model_name]['region_parent_id']]) ?
                                            $region_parents[$item[$model_name]['region_parent_id']] : __('unknown');
                                    ?>
                                    <br/>
                                    <?php
                                    echo!empty($region_children[$item[$model_name]['region_id']]) ?
                                            $region_children[$item[$model_name]['region_id']] : __('unknown');
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo!empty($distributors[$item[$model_name]['distributor_id']]) ?
                                            $distributors[$item[$model_name]['distributor_id']] : __('unknown');
                                    ?>
                                </td>
                                <td>
                                    <?php
//                                    echo $this->Form->input('category_id', array(
//                                        'div' => false,
//                                        'class' => 'form-control chosen-select',
//                                        'label' => false,
//                                        'default' => isset($item[$model_name]['category_id']) ?
//                                                $item[$model_name]['category_id'] : array(),
//                                        'options' => $categories,
////                                        'multiple' => true,
//                                    ));
                                    echo!empty($categories[$item[$model_name]['category_id']]) ?
                                            $categories[$item[$model_name]['category_id']] : __('unknown');
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('weight', array(
                                        'div' => false,
                                        'class' => 'form-control',
                                        'label' => false,
                                        'default' => isset($item[$model_name]['weight']) ?
                                                $item[$model_name]['weight'] : '',
                                    ));
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('status', array(
                                        'div' => false,
                                        'class' => 'form-control',
                                        'label' => false,
                                        'default' => isset($item[$model_name]['status']) ?
                                                $item[$model_name]['status'] : 2,
                                        'options' => $status,
                                    ));
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $this->Common->parseDateTime($item[$model_name]['modified']);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $this->element('Button/req_edit', array(
                                        'id' => $id,
                                    ));
                                    ?>
                                    <?php
                                    echo $this->element('Button/edit', array(
                                        'id' => $id,
                                    ));
                                    ?>
                                    <?php
                                    echo $this->element('Button/delete', array(
                                        'id' => $id,
                                    ));
                                    ?>
                                </td>
                            </tr>
                            <?php $stt++; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" style="text-align: center"><?php echo __('no_result') ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php echo $this->element('pagination'); ?>
    </div>
</div>


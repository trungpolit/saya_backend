<?php
//echo $this->element('page-heading');
echo $this->element('js/chosen');
echo $this->element('js/datetimepicker');
?>
<script>
    $(function () {

        $('.chosen-select').chosen();
        $('.datepicker').datetimepicker({
            'format': 'DD-MM-YYYY',
            'showTodayButton': true
        });
    });
</script>
<style>
    .product-logo {
        width: 64px;
    }
</style>
<div class="ibox-content m-b-sm border-bottom">

    <div class="row">
        <div class="col-md-3">
            <strong><?php echo __('customer_detail_title') ?></strong>
            <ul class="list-group clear-list m-t">
                <li class="list-group-item fist-item">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php echo __('customer_name') ?>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            echo h($customer[$model_name]['name']);
                            ?>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <?php
                        echo $this->Form->create($model_name, array(
                            'url' => array(
                                'action' => $this->action,
                                'controller' => Inflector::pluralize($model_name),
                                $id,
                                '?' => $this->request->query,
                            ),
                        ))
                        ?>
                        <?php
                        $cust_status_class = $this->Common->getCustomerClass($customer[$model_name]['status']);
                        ?>
                        <div class="col-sm-6">
                            <?php echo __('customer_status') ?>
                            <button type="submit" class="btn <?php echo $cust_status_class ?>"><i class="fa fa-flag"></i></button>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            echo $this->Form->hidden('id', array(
                                'value' => $customer[$model_name]['id'],
                            ));
                            ?>
                            <?php
                            echo $this->Form->input('status', array(
                                'div' => false,
                                'class' => 'form-control',
                                'label' => false,
                                'options' => $status,
                                'default' => $customer[$model_name]['status'],
                            ));
                            ?>
                        </div>
                        <?php
                        echo $this->Form->end();
                        ?>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php echo __('customer_region_id') ?>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            echo!empty($regionTree[$customer[$model_name]['region_id']]) ?
                                    $regionTree[$customer[$model_name]['region_id']] : __('unknown');
                            ?>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php echo __('customer_mobile') ?>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            echo h($customer[$model_name]['mobile']);
                            ?>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php echo __('customer_mobile2') ?>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            echo h($customer[$model_name]['mobile2']);
                            ?>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php echo __('customer_address') ?>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            echo h($customer[$model_name]['address']);
                            ?>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php echo __('customer_total_order_bundle') ?>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            echo number_format($customer[$model_name]['total_order_bundle']);
                            ?>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php echo __('customer_total_order_bundle_success') ?>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            echo number_format($customer[$model_name]['total_order_bundle_success']);
                            ?>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php echo __('customer_total_order_bundle_pending') ?>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            echo number_format($customer[$model_name]['total_order_bundle_pending']);
                            ?>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php echo __('customer_total_order_bundle_fail') ?>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            echo number_format($customer[$model_name]['total_order_bundle_fail']);
                            ?>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php echo __('customer_total_order_bundle_bad') ?>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            echo number_format($customer[$model_name]['total_order_bundle_bad']);
                            ?>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col-md-9">
            <?php
            echo $this->Form->create('Search', array(
                'url' => array(
                    'action' => $this->action,
                    'controller' => Inflector::pluralize($model_name),
                    $id,
                ),
                'type' => 'get',
            ))
            ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php
                        echo $this->Form->input('bundle_id', array(
                            'div' => false,
                            'class' => 'form-control',
                            'label' => __('daily_report_bundle_id'),
                            'default' => $this->request->query('bundle_id'),
                            'options' => $bundles,
                            'empty' => '-------',
                        ));
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php
                        echo $this->Form->input('code', array(
                            'div' => false,
                            'class' => 'form-control',
                            'label' => __('orders_bundle_code'),
                            'default' => $this->request->query('code'),
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
                            'label' => __('orders_bundle_status'),
                            'options' => $status_order,
                            'empty' => '-------',
                            'default' => $this->request->query('status'),
                        ));
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php
                        echo $this->Form->input('date_start', array(
                            'div' => false,
                            'class' => 'form-control datepicker',
                            'label' => __('daily_report_date_start'),
                            'default' => $this->request->query('date_start'),
                        ));
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php
                        echo $this->Form->input('date_end', array(
                            'div' => false,
                            'class' => 'form-control datepicker',
                            'label' => __('daily_report_date_end'),
                            'default' => $this->request->query('date_end'),
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
            <hr  />
            <div class="table-responsive float-e-margins">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <?php if (!empty($list_data)): ?>
                                <th><?php echo __('no') ?></th>
                                <th><?php echo $this->Paginator->sort('code', __('orders_bundle_code')); ?></th>
                                <th>
                                    <?php echo $this->Paginator->sort('bundle_id', __('orders_bundle_bundle_id')); ?>
                                </th>
                                <th><?php echo $this->Paginator->sort('total_qty', __('orders_bundle_total_qty')); ?></th>
                                <th><?php echo $this->Paginator->sort('total_price', __('orders_bundle_total_price')); ?></th>
                                <th><?php echo $this->Paginator->sort('status', __('orders_bundle_status')); ?></th>
                                <th>
                                    <?php echo $this->Paginator->sort('created', __('orders_bundle_created')); ?>
                                </th>
                                <th><?php echo __('operation') ?></th>
                            <?php else: ?>
                                <th><?php echo __('no') ?></th>
                                <th><?php echo __('orders_bundle_code'); ?></th>
                                <th>
                                    <?php echo __('orders_bundle_bundle_id'); ?>
                                </th>
                                <th><?php echo __('orders_bundle_total_qty'); ?></th>
                                <th><?php echo __('orders_bundle_total_price') ?></th>
                                <th><?php echo __('orders_bundle_status') ?></th>
                                <th><?php echo __('orders_bundle_created') ?></th>
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
                                <?php
                                $order_class = $this->Common->getOrderClass($item['OrdersBundle']['status']);
                                ?>
                                <tr class="form-edit <?php echo $order_class ?>">
                                    <td >
                                        <?php
                                        $id = $item['OrdersBundle']['id'];
                                        echo $this->Form->hidden('id', array(
                                            'value' => $id,
                                        ));
                                        echo $this->Form->hidden('customer_id', array(
                                            'value' => $item['OrdersBundle']['customer_id'],
                                        ));
                                        echo $this->Form->hidden('customer_code', array(
                                            'value' => $item['OrdersBundle']['customer_code'],
                                        ));
                                        echo $this->Form->hidden('no', array(
                                            'value' => $item['OrdersBundle']['no'],
                                        ));
                                        echo $this->Form->hidden('region_id', array(
                                            'value' => $item['OrdersBundle']['region_id'],
                                        ));
                                        echo $this->Form->hidden('bundle_id', array(
                                            'value' => $item['OrdersBundle']['bundle_id'],
                                        ));
                                        echo $this->Form->hidden('created', array(
                                            'value' => $item['OrdersBundle']['created'],
                                        ));
                                        echo $this->Form->hidden('total_price', array(
                                            'value' => $item['OrdersBundle']['total_price'],
                                        ));
                                        echo $stt;
                                        ?>
                                    </td>
                                    <td>
                                        <strong>
                                            <?php
                                            echo $item['OrdersBundle']['code'];
                                            ?>
                                        </strong>
                                    </td>
                                    <td>
                                        <?php
                                        echo!empty($bundles[$item['OrdersBundle']['bundle_id']]) ?
                                                $bundles[$item['OrdersBundle']['bundle_id']] : __('unknown');
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo number_format($item['OrdersBundle']['total_qty']);
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo number_format($item['OrdersBundle']['total_price']);
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $this->Form->input('status', array(
                                            'div' => false,
                                            'class' => 'form-control',
                                            'label' => false,
                                            'default' => isset($item['OrdersBundle']['status']) ?
                                                    $item['OrdersBundle']['status'] : STATUS_PENDING,
                                            'options' => $status_order,
                                        ));
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $this->Common->parseDateTime($item['OrdersBundle']['created']);
                                        ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="#product-data-<?php echo $id ?>" data-toggle="collapse" >
                                            <i class="fa fa-list-ul"> <?php echo __('detail_btn') ?></i>
                                        </a>
                                        <?php
                                        echo $this->element('Button/req_edit', array(
                                            'id' => $id,
                                            'model_name' => 'OrdersBundle',
                                        ));
                                        ?>
                                        <?php
//                                    echo $this->element('Button/edit', array(
//                                        'id' => $id,
//                                    ));
                                        ?>
                                        <?php
//                                    echo $this->element('Button/delete', array(
//                                        'id' => $id,
//                                    ));
                                        ?>
                                    </td>
                                </tr>
                                <tr  class="panel-collapse collapse"  id="product-data-<?php echo $id ?>">
                                    <td colspan="10">
                                        <?php
                                        $product_data = $item['OrdersBundle']['product_data'];
                                        ?>
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo __('no') ?></th>
                                                        <th><?php echo __('product_logo') ?></th>
                                                        <th><?php echo __('product_name') ?></th>
                                                        <th><?php echo __('qty') ?></th>
                                                        <th><?php echo __('product_price') ?></th>
                                                        <th><?php echo __('product_unit') ?></th>
                                                        <th><?php echo __('product_total_price') ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $product_index = 1;
                                                    ?>
                                                    <?php foreach ($product_data as $product): ?>
                                                        <?php
                                                        $product_url = Router::url(array(
                                                                    'controller' => 'Products',
                                                                    'action' => 'index',
                                                                    '?' => array(
                                                                        'id' => $product['product_id'],
                                                                    ),
                                                        ));
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $product_index ?></td>
                                                            <td>
                                                                <a href="<?php echo $product_url ?>" target="_blank">
                                                                    <img class="product-logo" src="<?php echo Router::url('/', true) . $product['product_logo_uri'] ?>" />
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a href="<?php echo $product_url ?>" target="_blank">
                                                                    <?php
                                                                    echo $product['product_name']
                                                                    ?>
                                                                </a>
                                                            </td>
                                                            <td><?php echo number_format($product['qty']) ?></td>
                                                            <td><?php echo number_format($product['product_price']) ?></td>
                                                            <td><?php echo $product['product_unit'] ?></td>
                                                            <td><?php echo number_format($product['qty'] * $product['product_price']) ?></td>
                                                        </tr>
                                                        <?php $product_index++; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                <?php $stt++; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" style="text-align: center"><?php echo __('no_result') ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php echo $this->element('pagination'); ?>
        </div>
    </div>
</div>
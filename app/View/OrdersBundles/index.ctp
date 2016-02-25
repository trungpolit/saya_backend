<?php
//echo $this->element('page-heading');
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
    });
</script>
<style>
    .product-logo {
        width: 64px;
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
                    'class' => 'form-control',
                    'label' => __('orders_bundle_region_id'),
                    'default' => $this->request->query('region_id'),
                    'options' => $regionTree,
                    'empty' => '-------',
                ));
                ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php
                echo $this->Form->input('bundle_id', array(
                    'div' => false,
                    'class' => 'form-control',
                    'label' => __('orders_bundle_bundle_id'),
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
                echo $this->Form->input('customer_name', array(
                    'div' => false,
                    'class' => 'form-control',
                    'label' => __('orders_bundle_customer_name'),
                    'default' => $this->request->query('customer_name'),
                ));
                ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php
                echo $this->Form->input('customer_mobile', array(
                    'div' => false,
                    'class' => 'form-control',
                    'label' => __('orders_bundle_customer_mobile'),
                    'default' => $this->request->query('customer_mobile'),
                ));
                ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php
                echo $this->Form->input('customer_id', array(
                    'div' => false,
                    'class' => 'form-control',
                    'label' => __('orders_bundle_customer_id'),
                    'default' => $this->request->query('customer_id'),
                    'type' => 'number',
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
                    'label' => __('orders_bundle_created_start'),
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
                    'label' => __('orders_bundle_created_end'),
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
                            <th><?php echo $this->Paginator->sort('code', __('orders_bundle_code')); ?></th>
                            <th style="width: 15%">
                                <?php echo $this->Paginator->sort('region_id', __('orders_bundle_region_id')); ?>
                                <br/>
                                <?php echo $this->Paginator->sort('bundle_id', __('orders_bundle_bundle_id')); ?>
                            </th>
                            <th style="width: 15%"><?php echo $this->Paginator->sort('customer_id', __('orders_bundle_customer_details')); ?></th>
                            <th><?php echo $this->Paginator->sort('total_price', __('orders_bundle_notes')); ?></th>
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
                                <?php echo __('orders_bundle_region_id'); ?>
                                <br/>
                                <?php echo __('orders_bundle_bundle_id'); ?>
                            </th>
                            <th><?php echo __('orders_bundle_customer_details'); ?></th>
                            <th><?php echo __('orders_bundle_notes') ?></th>
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
                            $order_class = $this->Common->getOrderClass($item[$model_name]['status']);
                            ?>
                            <tr class="form-edit <?php echo $order_class ?>">
                                <td >
                                    <?php
                                    $id = $item[$model_name]['id'];
                                    echo $this->Form->hidden('id', array(
                                        'value' => $id,
                                    ));
                                    echo $this->Form->hidden('customer_id', array(
                                        'value' => $item[$model_name]['customer_id'],
                                    ));
                                    echo $this->Form->hidden('customer_code', array(
                                        'value' => $item[$model_name]['customer_code'],
                                    ));
                                    echo $this->Form->hidden('no', array(
                                        'value' => $item[$model_name]['no'],
                                    ));
                                    echo $this->Form->hidden('region_id', array(
                                        'value' => $item[$model_name]['region_id'],
                                    ));
                                    echo $this->Form->hidden('bundle_id', array(
                                        'value' => $item[$model_name]['bundle_id'],
                                    ));
                                    echo $this->Form->hidden('created', array(
                                        'value' => $item[$model_name]['created'],
                                    ));
                                    echo $this->Form->hidden('total_price', array(
                                        'value' => $item[$model_name]['total_price'],
                                    ));
                                    echo $stt;
                                    ?>
                                </td>
                                <td>
                                    <strong>
                                        <?php
                                        echo $item[$model_name]['code'];
                                        ?>
                                    </strong>
                                </td>
                                <td>
                                    <?php
                                    echo!empty($item[$model_name]['region_name']) ?
                                            $item[$model_name]['region_name'] : __('unknown');
                                    ?>
                                    <br/>
                                    <?php
                                    echo!empty($bundles[$item[$model_name]['bundle_id']]) ?
                                            $bundles[$item[$model_name]['bundle_id']] : __('unknown');
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $customer_name = !empty($item['Customer']['name']) ? h($item['Customer']['name']) : __('unknown');
                                    $customer_id = !empty($item['Customer']['id']) ? $item['Customer']['id'] : __('unknown');

                                    $customer_title = $customer_name . ' (ID:' . $customer_id . ')';
                                    echo $this->Html->link($customer_title, array(
                                        'controller' => 'Customers',
                                        'action' => 'detail',
                                        $customer_id,
                                    ));
                                    ?>
                                    <?php if (!empty($item['Customer']['mobile'])): ?>
                                        <br/>
                                        <span>ĐT: <?php echo $item['Customer']['mobile'] ?></span>
                                    <?php endif; ?>
                                    <?php if (!empty($item['Customer']['mobile2'])): ?>
                                        <br/>
                                        <span>ĐT2: <?php echo $item['Customer']['mobile2'] ?></span>
                                    <?php endif; ?>
                                    <?php if (!empty($item['Customer'])): ?>   
                                        <?php
                                        $cus_total_order = !empty($item['Customer']['total_order']) ? $item['Customer']['total_order'] : 0;
                                        $cus_total_order_bundle_success = !empty($item['Customer']['total_order_bundle_success']) ? $item['Customer']['total_order_bundle_success'] : 0;
                                        $cus_total_order_bundle_pending = !empty($item['Customer']['total_order_bundle_pending']) ? $item['Customer']['total_order_bundle_pending'] : 0;
                                        $cus_total_order_bundle_fail = !empty($item['Customer']['total_order_bundle_fail']) ? $item['Customer']['total_order_bundle_fail'] : 0;
                                        $cus_total_order_bundle_bad = !empty($item['Customer']['total_order_bundle_bad']) ? $item['Customer']['total_order_bundle_bad'] : 0;
                                        ?>
                                        <hr/>
                                        <span><strong>Lịch sử đơn hàng</strong></span>
                                        <br/>
                                        <span>Tổng số: <?php echo number_format($cus_total_order) ?></span>
                                        <br/>
                                        <span>Tổng thành công: <?php echo number_format($cus_total_order_bundle_success) ?></span>
                                        <br/>
                                        <span>Tổng chờ xử lý: <?php echo number_format($cus_total_order_bundle_pending) ?></span>
                                        <br/>
                                        <span>Tổng hủy: <?php echo number_format($cus_total_order_bundle_fail) ?></span>
                                        <br/>
                                        <span>Tổng giả mạo: <?php echo number_format($cus_total_order_bundle_bad) ?></span>
                                        <br/>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                    echo h($item[$model_name]['customer_address']);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo number_format($item[$model_name]['total_qty']);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo number_format($item[$model_name]['total_price']);
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
                                    echo $this->Common->parseDateTime($item[$model_name]['created']);
                                    ?>
                                </td>
                                <td>
                                    <a class="btn btn-info" href="#product-data-<?php echo $id ?>" data-toggle="collapse" >
                                        <i class="fa fa-list-ul"> Chi tiết đơn hàng</i>
                                    </a>
                                    <br/>
                                    <?php
                                    echo $this->element('Button/req_edit', array(
                                        'id' => $id,
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
                                    $product_data = $item[$model_name]['product_data'];
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
                            <td colspan="11" style="text-align: center"><?php echo __('no_result') ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php echo $this->element('pagination'); ?>
    </div>
</div>
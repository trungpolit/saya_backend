<?php
echo $this->element('js/chosen');
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
                    'class' => 'form-control',
                    'label' => __('product_region_id'),
                    'options' => $regionTree,
                    'empty' => '-------',
                    'default' => $this->request->query('region_id'),
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
                    'label' => __('notification_name'),
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
                    'label' => __('notification_status'),
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
                echo $this->Form->input('end_at_start', array(
                    'div' => false,
                    'class' => 'form-control datetimepicker',
                    'label' => __('notification_end_at_start'),
                    'default' => $this->request->query('end_at_start'),
                ));
                ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php
                echo $this->Form->input('end_at_end', array(
                    'div' => false,
                    'class' => 'form-control datetimepicker',
                    'label' => __('notification_end_at_end'),
                    'default' => $this->request->query('end_at_end'),
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
                            <th style="width: 25%"><?php echo $this->Paginator->sort('name', __('notification_name')); ?></th>
                            <th>
                                <?php echo __('notification_region_parent_id'); ?>
                                <br/>
                                <?php echo $this->Paginator->sort('region_id', __('notification_region_id')); ?>
                            </th>
                            <th style="width: 15%">
                                <?php echo $this->Paginator->sort('begin_at', __('notification_begin_at')); ?>
                                <br/>
                                <?php echo $this->Paginator->sort('end_at', __('notification_end_at')); ?>
                            </th>
                            <th><?php echo $this->Paginator->sort('weight', __('notification_weight')); ?></th>
                            <th><?php echo $this->Paginator->sort('status', __('notification_status')); ?></th>
                            <th>
                                <?php echo $this->Paginator->sort('modified', __('notification_modified')); ?>
                            </th>
                        <?php else: ?>
                            <th><?php echo __('no') ?></th>
                            <th><?php echo __('notification_name'); ?></th>
                            <th>
                                <?php echo __('notification_region_parent_id'); ?>
                                <br/>
                                <?php echo __('notification_region_id'); ?>
                            </th>
                            <th>
                                <?php echo __('notification_begin_at'); ?>
                                <br/>
                                <?php echo __('notification_end_at'); ?>
                            </th>
                            <th><?php echo __('notification_weight'); ?></th>
                            <th><?php echo __('notification_status') ?></th>
                            <th>
                                <?php echo __('notification_modified') ?>
                            </th>
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
                                    $region_id = $item[$model_name]['region_id'];
                                    echo $this->Form->hidden('region_id', array(
                                        'value' => $region_id,
                                    ));
                                    echo $stt;
                                    ?>
                                </td>
                                <td class="long-text">
                                    <strong>
                                        <?php
                                        echo $item[$model_name]['name'];
                                        ?>
                                    </strong>
                                </td>
                                <td>
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
                                    echo $this->Common->parseDateTime($item[$model_name]['begin_at']);
                                    ?>
                                    <br/>
                                    <?php
                                    echo $this->Common->parseDateTime($item[$model_name]['end_at']);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo isset($item[$model_name]['weight']) ?
                                            $item[$model_name]['weight'] : '';
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo isset($status[$item[$model_name]['status']]) ?
                                            $status[$item[$model_name]['status']] : __('unknown');
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $this->Common->parseDateTime($item[$model_name]['modified']);
                                    ?>
                                </td>
                            </tr>
                            <?php $stt++; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center"><?php echo __('no_result') ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php echo $this->element('pagination'); ?>
    </div>
</div>

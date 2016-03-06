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
                    'label' => __('daily_report_region_id'),
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
</div>
<div class="ibox float-e-margins">
    <div class="ibox-content">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <?php if (!empty($list_data)): ?>
                            <th><?php echo __('no') ?></th>
                            <th><?php echo $this->Paginator->sort('date', __('daily_report_date')); ?></th>
                            <th><?php echo $this->Paginator->sort('region_id', __('daily_report_region_id')); ?></th>
                            <th><?php echo $this->Paginator->sort('bundle_id', __('daily_report_bundle_id')); ?></th>
                            <th><?php echo $this->Paginator->sort('total_revernue', __('daily_report_total_revernue')); ?></th>
                            <th><?php echo $this->Paginator->sort('total_order_bundle', __('daily_report_total_order_bundle')); ?></th>
                            <th><?php echo $this->Paginator->sort('total_order_bundle_success', __('daily_report_total_order_bundle_success')); ?></th>
                            <th><?php echo $this->Paginator->sort('total_order_bundle_pending', __('daily_report_total_order_bundle_pending')); ?></th>
                            <th><?php echo $this->Paginator->sort('total_order_bundle_fail', __('daily_report_total_order_bundle_fail')); ?></th>
                            <th> <?php echo $this->Paginator->sort('total_order_bundle_bad', __('daily_report_total_order_bundle_bad')); ?></th>
                        <?php else: ?>
                            <th><?php echo __('no') ?></th>
                            <th><?php echo __('daily_report_date'); ?></th>
                            <th><?php echo __('daily_report_region_id'); ?></th>
                            <th><?php echo __('daily_report_bundle_id'); ?></th>
                            <th><?php echo __('daily_report_total_revernue'); ?></th>
                            <th><?php echo __('daily_report_total_order_bundle') ?></th>
                            <th><?php echo __('daily_report_total_order_bundle_success'); ?></th>
                            <th><?php echo __('daily_report_total_order_bundle_pending') ?></th>
                            <th><?php echo __('daily_report_total_order_bundle_fail') ?></th>
                            <th><?php echo __('daily_report_total_order_bundle_bad') ?></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($list_data)): ?>
                        <?php
                        $stt = $this->Paginator->counter('{:start}');
                        ?>
                        <?php foreach ($list_data as $item): ?>
                            <tr>
                                <td >
                                    <?php
                                    echo $stt;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $this->Common->parseDate($item[$model_name]['date']);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo!empty($regions[$item[$model_name]['region_id']]) ?
                                            $regions[$item[$model_name]['region_id']] : __('unknown');
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo!empty($bundles[$item[$model_name]['bundle_id']]) ?
                                            $bundles[$item[$model_name]['bundle_id']] : __('unknown');
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo number_format($item[$model_name]['total_revernue']);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo number_format($item[$model_name]['total_order_bundle']);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo number_format($item[$model_name]['total_order_bundle_success']);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo number_format($item[$model_name]['total_order_bundle_pending']);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo number_format($item[$model_name]['total_order_bundle_fail']);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo number_format($item[$model_name]['total_order_bundle_bad']);
                                    ?>
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
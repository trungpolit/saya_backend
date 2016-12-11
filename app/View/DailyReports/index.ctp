<?php
if (!empty($refresh)):
    ?>
    <?php echo $this->start('meta'); ?>
    <meta http-equiv="refresh" content="<?php echo $refresh ?>">
    <?php echo $this->end(); ?>
<?php endif; ?>
<?php
//echo $this->element('page-heading');
echo $this->element('js/chosen');
echo $this->element('js/datetimepicker');

$user_type = CakeSession::read('Auth.User.type');
?>
<script>
    $(function () {

        $('.chosen-select').chosen();
        $('.datepicker').datetimepicker({
            'format': 'DD-MM-YYYY',
            'showTodayButton': true
        });
<?php if ($user_type == ADMIN_TYPE): ?>
            $('#region_id').on('change', function () {
                var region_id = $(this).val();
                var request = '<?php echo $this->Html->url(array('action' => 'reqDistributorByRegionId')) ?>';
                var req = $.get(request, {region_id: region_id}, function (data) {
                    $('#distributor_id_container').html(data);
                    $('#distributor_id').chosen();
                });
                req.fail(function () {
                    alert('reqDistributorByRegionId was failed.');
                });
            });
            $('#region_id').trigger('change');
<?php endif; ?>
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
                    'class' => 'form-control chosen-select',
                    'label' => __('daily_report_region_id'),
                    'default' => $this->request->query('region_id'),
                    'options' => $regionTree,
                    'empty' => '-------',
                    'id' => 'region_id',
                ));
                ?>
            </div>
        </div>
        <?php if ($user_type == ADMIN_TYPE): ?>
            <div class="col-md-4">
                <div class="form-group" id="distributor_id_container">
                    <?php
                    echo $this->Form->input('distributor_id', array(
                        'div' => false,
                        'class' => 'form-control chosen-select',
                        'label' => __('daily_report_distributor_id'),
                        'default' => $this->request->query('distributor_id'),
                        'options' => $distributors,
                        'empty' => '-------',
                        'id' => 'distributor_id',
                    ));
                    ?>
                </div>
            </div>
        <?php endif; ?>
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
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <?php if (!empty($list_data)): ?>
                            <th><?php echo __('no') ?></th>
                            <th><?php echo $this->Paginator->sort('date', __('daily_report_date')); ?></th>
                            <th><?php echo $this->Paginator->sort('region_id', __('daily_report_region_id')); ?></th>
                            <th><?php echo $this->Paginator->sort('distributor_id', __('daily_report_distributor_id')); ?></th>
                            <th><?php echo $this->Paginator->sort('total_revernue', __('daily_report_total_revernue')); ?></th>
                            <th><?php echo $this->Paginator->sort('total_order_distributor', __('daily_report_total_order_distributor')); ?></th>
                            <th><?php echo $this->Paginator->sort('total_order_distributor_success', __('daily_report_total_order_distributor_success')); ?></th>
                            <th><?php echo $this->Paginator->sort('total_order_distributor_pending', __('daily_report_total_order_distributor_pending')); ?></th>
                            <th><?php echo $this->Paginator->sort('total_order_distributor_processing', __('daily_report_total_order_distributor_processing')); ?></th>
                            <th><?php echo $this->Paginator->sort('total_order_distributor_fail', __('daily_report_total_order_distributor_fail')); ?></th>
                            <th> <?php echo $this->Paginator->sort('total_order_distributor_bad', __('daily_report_total_order_distributor_bad')); ?></th>
                        <?php else: ?>
                            <th><?php echo __('no') ?></th>
                            <th><?php echo __('daily_report_date'); ?></th>
                            <th><?php echo __('daily_report_region_id'); ?></th>
                            <th><?php echo __('daily_report_distributor_id'); ?></th>
                            <th><?php echo __('daily_report_total_revernue'); ?></th>
                            <th><?php echo __('daily_report_total_order_distributor') ?></th>
                            <th><?php echo __('daily_report_total_order_distributor_success'); ?></th>
                            <th><?php echo __('daily_report_total_order_distributor_pending') ?></th>
                            <th><?php echo __('daily_report_total_order_distributor_processing') ?></th>
                            <th><?php echo __('daily_report_total_order_distributor_fail') ?></th>
                            <th><?php echo __('daily_report_total_order_distributor_bad') ?></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($list_data)): ?>
                        <?php
                        $stt = $this->Paginator->counter('{:start}');
                        ?>
                        <tr class="success">
                            <td colspan="4" style="text-align: center"><strong><?php echo __('daily_report_sum') ?></strong></td>
                            <td><strong><?php echo number_format($sum_revernue) ?></strong></td>
                            <td><strong><?php echo number_format($sum_order_distributor) ?></strong></td>
                            <td><strong><?php echo number_format($sum_order_distributor_success) ?></strong></td>
                            <td><strong><?php echo number_format($sum_order_distributor_pending) ?></strong></td>
                            <td><strong><?php echo number_format($sum_order_distributor_processing) ?></strong></td>
                            <td><strong><?php echo number_format($sum_order_distributor_fail) ?></strong></td>
                            <td><strong><?php echo number_format($sum_order_distributor_bad) ?></strong></td>
                        </tr>
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
                                    echo!empty($distributors[$item[$model_name]['distributor_id']]) ?
                                            $distributors[$item[$model_name]['distributor_id']] : __('unknown');
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo number_format($item[$model_name]['total_revernue']);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo number_format($item[$model_name]['total_order_distributor']);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo number_format($item[$model_name]['total_order_distributor_success']);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo number_format($item[$model_name]['total_order_distributor_pending']);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo number_format($item[$model_name]['total_order_distributor_processing']);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo number_format($item[$model_name]['total_order_distributor_fail']);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo number_format($item[$model_name]['total_order_distributor_bad']);
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
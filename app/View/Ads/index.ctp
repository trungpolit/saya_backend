<?php
echo $this->element('js/tinymce');
?>
<div class="ibox float-e-margins">
    <div class="ibox-content">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <?php if (!empty($list_data)): ?>
                            <th><?php echo __('no') ?></th>
                            <th><?php echo $this->Paginator->sort('name', __('ads_name')); ?></th>
                            <th style="width: 40%"><?php echo $this->Paginator->sort('description', __('ads_description')); ?></th>
                            <th><?php echo $this->Paginator->sort('status', __('ads_status')); ?></th>
                            <th>
                                <?php echo $this->Paginator->sort('modified', __('ads_modified')); ?>
                            </th>
                            <th><?php echo __('operation') ?></th>
                        <?php else: ?>
                            <th><?php echo __('no') ?></th>
                            <th><?php echo __('ads_name'); ?></th>
                            <th><?php echo __('ads_description'); ?></th>
                            <th><?php echo __('product_category_id'); ?></th>
                            <th><?php echo __('ads_status') ?></th>
                            <th>
                                <?php echo __('ads_modified') ?>
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
                                    echo $stt;
                                    ?>
                                </td>
                                <td>
                                    <strong>
                                        <?php
                                        echo $item[$model_name]['name'];
                                        ?>
                                    </strong>
                                </td>
                                <td>
                                    <?php
                                    echo $this->Form->textarea('description', array(
                                        'value' => $item[$model_name]['description'],
                                        'class' => 'editor form-control',
                                        'rows' => 12,
                                        'id' => 'editor_' . $id,
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
                                                $item[$model_name]['status'] : STATUS_ENABLE,
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
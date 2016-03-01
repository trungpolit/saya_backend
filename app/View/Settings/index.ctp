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
                            <th style="width: 4%"><?php echo __('no') ?></th>
                            <th style="width: 18%"><?php echo $this->Paginator->sort('name', __('setting_key')); ?></th>
                            <th style="width: 50%"><?php echo $this->Paginator->sort('value', __('setting_value')); ?></th>
                            <th style="width: 22%">
                                <?php echo $this->Paginator->sort('description', __('setting_description')); ?>
                                <br/>
                                <?php echo $this->Paginator->sort('modified', __('setting_modified')); ?>
                            </th>
                            <th style="width: 10%"><?php echo __('operation') ?></th>
                        <?php else: ?>
                            <th style="width: 4%"><?php echo __('no') ?></th>
                            <th style="width: 18%"><?php echo __('setting_key'); ?></th>
                            <th style="width: 50%"><?php echo __('setting_value'); ?></th>
                            <th style="width: 22%">
                                <?php echo __('setting_description'); ?>
                                <br/>
                                <?php __('setting_modified'); ?>
                            </th>
                            <th style="width: 10%"><?php echo __('operation') ?></th>
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
                                    <?php
                                    echo $item[$model_name]['key'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (in_array($item[$model_name]['key'], $editor_keys)) {

                                        echo $this->Form->textarea('value', array(
                                            'value' => $item[$model_name]['value'],
                                            'class' => 'editor form-control',
                                            'rows' => 12,
                                            'id' => 'editor_' . $id,
                                        ));
                                    } else {

                                        echo $this->Form->input('value', array(
                                            'value' => $item[$model_name]['value'],
                                            'class' => 'form-control',
                                            'label' => false,
                                        ));
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $this->Form->textarea('description', array(
                                        'value' => $item[$model_name]['description'],
                                        'rows' => 19,
                                        'class' => 'form-control',
                                    ));
                                    ?>
                                    <br/>
                                    <?php
                                    echo $this->Common->parseDateTime($item[$model_name]['modified']);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $this->element('Button/req_edit', array(
                                        'action_path' => Router::url(array('action' => 'reqEdit', $id)),
                                    ));
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


<?php
echo $this->element('page-heading-with-add-action');
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
                            <th><?php echo $this->Paginator->sort('name', __('client_version_name')); ?></th>
                            <th><?php echo $this->Paginator->sort('description', __('client_version_description')); ?></th>
                            <th><?php echo $this->Paginator->sort('platform_os', __('client_version_platform_os')); ?></th>
                            <th><?php echo $this->Paginator->sort('platform_version', __('client_version_platform_version')); ?></th>
                            <th><?php echo $this->Paginator->sort('download_link', __('client_version_download_link')); ?></th>
                            <th>
                                <?php echo $this->Paginator->sort('modified', __('client_version_modified')); ?>
                            </th>
                            <th><?php echo __('operation') ?></th>
                        <?php else: ?>
                            <th><?php echo __('no') ?></th>
                            <th><?php echo __('client_version_name'); ?></th>
                            <th><?php echo __('client_version_description'); ?></th>
                            <th><?php echo __('client_version_platform_os'); ?></th>
                            <th><?php echo __('client_version_platform_version') ?></th>
                            <th><?php echo __('client_version_download_link') ?></th>
                            <th>
                                <?php echo __('client_version_modified') ?>
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
                                    echo nl2br($item[$model_name]['description']);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('platform_os', array(
                                        'div' => false,
                                        'class' => 'form-control',
                                        'label' => false,
                                        'default' => isset($item[$model_name]['platform_os']) ?
                                                $item[$model_name]['platform_os'] : '',
                                        'options' => $platforms,
                                        'empty' => '-------',
                                    ));
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('platform_version', array(
                                        'div' => false,
                                        'class' => 'form-control',
                                        'label' => false,
                                        'default' => $item[$model_name]['platform_version'],
                                    ));
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('download_link', array(
                                        'div' => false,
                                        'class' => 'form-control',
                                        'label' => false,
                                        'default' => $item[$model_name]['download_link'],
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
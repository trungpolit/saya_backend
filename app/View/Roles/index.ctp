<?php
echo $this->element('page-heading-with-add-action');
?>
<div class="ibox-content m-b-sm bweight-bottom">
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
                echo $this->Form->input('name', array(
                    'div' => false,
                    'class' => 'form-control',
                    'label' => __('role_name'),
                    'default' => $this->request->query('name'),
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
                        <?php if (empty($list_data)): ?>
                            <th><?php echo __('no') ?></th>
                            <th><?php echo __('role_name') ?></th>
                            <th><?php echo __('role_description') ?></th>
                            <th><?php echo __('role_weight') ?></th>
                            <th><?php echo __('role_status') ?></th>
                            <th><?php echo __('role_modified') ?></th>
                            <th><?php echo __('operation') ?></th>
                        <?php else: ?>
                            <th><?php echo __('no') ?></th>
                            <th><?php echo $this->Paginator->sort('name', __('role_name')); ?></th>
                            <th><?php echo __('role_description') ?></th>
                            <th><?php echo $this->Paginator->sort('weight', __('role_weight')); ?></th>
                            <th><?php echo $this->Paginator->sort('status', __('role_status')); ?></th>
                            <th><?php echo $this->Paginator->sort('modified', __('role_modified')); ?></th>
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
                            $id = $item[$model_name]['id'];
                            ?>
                            <tr class="form-edit">
                                <td><?php echo $stt ?></td>
                                <td><?php echo $item[$model_name]['name'] ?></td>
                                <td><?php echo nl2br($item[$model_name]['description']) ?></td>
                                <td>
                                    <?php
                                    echo $this->Form->input('weight', array(
                                        'div' => false,
                                        'class' => 'form-control',
                                        'label' => false,
                                        'default' => $item[$model_name]['weight'],
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
                                                $item[$model_name]['status'] : '',
                                        'options' => $status,
                                        'empty' => '-------',
                                    ));
                                    ?>  
                                </td>
                                <td>
                                    <?php
                                    echo $this->Common->parseDateTime($item[$model_name]['modified'])
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


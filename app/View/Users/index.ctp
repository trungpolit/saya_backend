<?php
echo $this->element('page-heading-with-add-action');
echo $this->element('js/chosen');
?>
<script>
    $(function () {

        $('.chosen-select-one').chosen({
            max_selected_options: 1
        });
    });
</script>
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
                echo $this->Form->input('username', array(
                    'div' => false,
                    'class' => 'form-control',
                    'label' => __('user_username'),
                    'default' => $this->request->query('username'),
                ));
                ?>
            </div>
        </div>
        <!--        <div class="col-md-4">
                    <div class="form-group">
        <?php
//                echo $this->Form->input('role_id', array(
//                    'div' => false,
//                    'class' => 'form-control',
//                    'label' => __('user_role_id'),
//                    'default' => $this->request->query('role_id'),
//                    'options' => $roles,
//                    'empty' => '-------',
//                ));
        ?>
                    </div>
                </div>-->
        <div class="col-md-4">
            <div class="form-group">
                <?php
                echo $this->Form->input('region_id', array(
                    'div' => false,
                    'class' => 'form-control',
                    'label' => __('user_region_id'),
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
                echo $this->Form->input('distributor_id', array(
                    'div' => false,
                    'class' => 'form-control',
                    'label' => __('user_distributor_id'),
                    'default' => $this->request->query('distributor_id'),
                    'options' => $distributors,
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
                    'label' => __('user_distributor_code'),
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
                    'label' => __('user_status'),
                    'default' => $this->request->query('status'),
                    'options' => $status,
                    'empty' => '-------',
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
                            <th><?php echo __('user_username') ?></th>
                            <th><?php echo __('user_role_id') ?></th>
                            <th><?php echo __('user_distributor_id') ?></th>
                            <th><?php echo __('user_distributor_code') ?></th>
                            <th><?php echo __('user_region_id') ?></th>
                            <th><?php echo __('user_password_show') ?></th>
                            <th><?php echo __('user_status') ?></th>
                            <th><?php echo __('user_modified') ?></th>
                            <th><?php echo __('operation') ?></th>
                        <?php else: ?>
                            <th><?php echo __('no') ?></th>
                            <th><?php echo $this->Paginator->sort('name', __('user_username')); ?></th>
                            <th><?php echo $this->Paginator->sort('role_id', __('user_role_id')); ?></th>
                            <th><?php echo $this->Paginator->sort('distributor_id', __('user_distributor_id')) ?></th>
                            <th><?php echo $this->Paginator->sort('distributor_code', __('user_distributor_code')); ?></th>
                            <th><?php echo $this->Paginator->sort('region_id', __('user_region_id')) ?></th>
                            <th><?php echo $this->Paginator->sort('password_show', __('user_password_show')); ?></th>
                            <th><?php echo $this->Paginator->sort('status', __('user_status')); ?></th>
                            <th><?php echo $this->Paginator->sort('modified', __('user_modified')); ?></th>
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
                                <td><?php echo $item[$model_name]['username'] ?></td>
                                <td>
                                    <?php
                                    echo!empty($roles[$item[$model_name]['role_id']]) ?
                                            $roles[$item[$model_name]['role_id']] : __('unknown');
                                    ?>
                                </td>
                                <td>
                                    <?php
//                                    echo $this->Form->input($model_name . '.distributor_id', array(
//                                        'class' => 'form-control chosen-select-one',
//                                        'div' => false,
//                                        'label' => false,
//                                        'options' => $distributors,
//                                        'default' => $item[$model_name]['distributor_id'],
//                                        'disabled' => true,
//                                    ));
                                    echo!empty($distributors[$item[$model_name]['distributor_id']]) ?
                                            $distributors[$item[$model_name]['distributor_id']] : __('unknown');
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $item[$model_name]['distributor_code'];
                                    ?>
                                </td>
                                <td>
                                    <?php
//                                    echo $this->Form->input($model_name . '.region_id', array(
//                                        'class' => 'form-control chosen-select-one',
//                                        'div' => false,
//                                        'label' => false,
//                                        'options' => $regionTree,
//                                        'multiple' => true,
//                                        'default' => $item[$model_name]['region_id'],
//                                        'disabled' => true,
//                                    ));
                                    if (!empty($item[$model_name]['region_id'])):
                                        ?>
                                        <?php foreach ($item[$model_name]['region_id'] as $v): ?>
                                            <?php
                                            echo $regions[$v] ? $regions[$v] : __('unknown');
                                            ?><hr/>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                    echo $item[$model_name]['password_show'];
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
                            <td colspan="10" style="text-align: center"><?php echo __('no_result') ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php echo $this->element('pagination'); ?>
    </div>
</div>


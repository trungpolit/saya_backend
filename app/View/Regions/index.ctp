<?php echo $this->start('page-heading') ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2><?php echo $page_title ?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo!empty($home_url) ? $home_url : '#' ?>"><?php echo __('home_title') ?></a>
            </li>
            <?php if (!empty($breadcrumb)): ?>
                <?php
                if (!is_array($breadcrumb[0])) {

                    $breadcrumb = array($breadcrumb);
                }
                ?>
                <?php foreach ($breadcrumb as $k => $item): ?>
                    <?php
                    $li_class = '';
                    if ($k == count($breadcrumb) - 1) {

                        $li_class = 'active';
                    }
                    ?>
                    <li class="<?php echo $li_class ?>">
                        <a href="<?php echo $item['url'] ?>" >
                            <?php if (!empty($li_class)): ?>
                                <strong><?php echo $item['label'] ?></strong>
                            <?php else: ?>
                                <?php echo $item['label'] ?>
                            <?php endif; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <a class="btn btn-primary" href="<?php echo Router::url(array('action' => 'add', $type)) ?>">
                <i class="fa fa-plus"></i> <span><?php echo __('add_action_title') ?></span>
            </a>
        </div>
    </div>
</div>
<?php echo $this->end() ?>
<div class="ibox-content m-b-sm border-bottom">
    <?php
    echo $this->Form->create('Search', array(
        'url' => array(
            'action' => $this->action,
            'controller' => Inflector::pluralize($model_name),
            $type,
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
                    'label' => __('region_name'),
                    'default' => $this->request->query('name'),
                ));
                ?>
            </div>
        </div>
        <?php if ($type == 'child'): ?>
            <div class="col-md-4">
                <div class="form-group">
                    <?php
                    echo $this->Form->input('parent_id', array(
                        'div' => false,
                        'class' => 'form-control',
                        'label' => __('region_parent_id'),
                        'default' => $this->request->query('parent_id'),
                        'options' => $parents,
                    ));
                    ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-4">
            <div class="form-group">
                <?php
                echo $this->Form->input('status', array(
                    'div' => false,
                    'class' => 'form-control',
                    'label' => __('region_status'),
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
                echo $this->Form->input('weight', array(
                    'type' => 'number',
                    'div' => false,
                    'class' => 'form-control',
                    'label' => __('region_weight'),
                    'default' => $this->request->query('weight'),
                ));
                ?>
            </div>
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
                            <th style="width: 4%"><?php echo __('no') ?></th>
                            <th style="width: 18%"><?php echo $this->Paginator->sort('name', __('region_name')); ?></th>
                            <?php if ($type == 'child'): ?>
                                <th style="width: 18%"><?php echo $this->Paginator->sort('parent_id', __('region_parent_id')); ?></th>
                            <?php endif; ?>
                            <th style="width: 18%"><?php echo $this->Paginator->sort('description', __('region_description')); ?></th>
                            <th style="width: 6%"><?php echo $this->Paginator->sort('weight', __('region_weight')); ?></th>
                            <th style="width: 12%"><?php echo (__('region_status')); ?></th>
                            <th style="width: 12%">
                                <?php echo $this->Paginator->sort('modified', __('region_modified')); ?>
                            </th>
                            <th style="width: 10%"><?php echo __('operation') ?></th>
                        <?php else: ?>
                            <th><?php echo __('no') ?></th>
                            <th><?php echo __('region_name'); ?></th>
                            <?php if ($type == 'child'): ?>
                                <th style="width: 18%"><?php echo __('region_parent_id'); ?></th>
                            <?php endif; ?>
                            <th><?php echo __('region_description'); ?></th>
                            <th><?php echo __('region_weight'); ?></th>
                            <th><?php echo __('region_status') ?></th>
                            <th>
                                <?php echo __('region_modified') ?>
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
                                <?php if ($type == 'child'): ?>
                                    <td>
                                        <?php
                                        echo $this->Form->input('parent_id', array(
                                            'div' => false,
                                            'class' => 'form-control',
                                            'label' => false,
                                            'default' => isset($item[$model_name]['parent_id']) ?
                                                    $item[$model_name]['parent_id'] : '',
                                            'empty' => '-------',
                                            'options' => $parents,
                                        ));
                                        ?>
                                    </td>
                                <?php endif; ?>
                                <td>
                                    <strong>
                                        <?php
                                        echo $item[$model_name]['description'];
                                        ?>
                                    </strong>
                                </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('weight', array(
                                        'div' => false,
                                        'class' => 'form-control',
                                        'label' => false,
                                        'default' => isset($item[$model_name]['weight']) ?
                                                $item[$model_name]['weight'] : '',
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
                                                $item[$model_name]['status'] : 2,
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
                                        'action_path' => Router::url(array('action' => 'reqEdit', $type, $id)),
                                    ));
                                    ?>
                                    <?php
                                    echo $this->element('Button/edit', array(
                                        'action_path' => Router::url(array('action' => 'edit', $type, $id)),
                                    ));
                                    ?>
                                    <?php
                                    echo $this->element('Button/delete', array(
                                        'action_path' => Router::url(array('action' => 'reqDelete', $type, $id)),
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


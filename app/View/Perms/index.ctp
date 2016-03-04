<?php echo $this->start('page-heading') ?>
<div class="row wrapper bweight-bottom white-bg page-heading">
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
            <a class="btn btn-info" href="<?php echo Router::url(array('action' => 'refresh')) ?>">
                <i class="fa fa-refresh"></i> <span><?php echo __('refresh_action_title') ?></span>
            </a>
            <a class="btn btn-primary" href="<?php echo Router::url(array('action' => 'add')) ?>">
                <i class="fa fa-plus"></i> <span><?php echo __('add_action_title') ?></span>
            </a>
        </div>
    </div>
</div>
<?php echo $this->end() ?>
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
                    'label' => __('perm_name'),
                    'default' => $this->request->query('name'),
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
                    'label' => __('perm_code'),
                    'default' => $this->request->query('code'),
                ));
                ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php
                echo $this->Form->input('module', array(
                    'div' => false,
                    'class' => 'form-control',
                    'label' => __('perm_module'),
                    'default' => $this->request->query('module'),
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
                            <th><?php echo __('perm_name') ?></th>
                            <th><?php echo __('perm_code') ?></th>
                            <th><?php echo __('perm_module') ?></th>
                            <th><?php echo __('perm_description') ?></th>
                            <th><?php echo __('perm_weight') ?></th>
                            <th><?php echo __('operation') ?></th>
                        <?php else: ?>
                            <th><?php echo __('no') ?></th>
                            <th><?php echo $this->Paginator->sort('name', __('perm_name')); ?></th>
                            <th><?php echo $this->Paginator->sort('code', __('perm_code')); ?></th>
                            <th><?php echo $this->Paginator->sort('module', __('perm_module')); ?></th>
                            <th><?php echo __('perm_description') ?></th>
                            <th><?php echo $this->Paginator->sort('weight', __('perm_weight')); ?></th>
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
                            <tr>
                                <td><?php echo $stt ?></td>
                                <td><?php echo $item[$model_name]['name'] ?></td>
                                <td><?php echo $item[$model_name]['code'] ?></td>
                                <td><?php echo $item[$model_name]['module'] ?></td>
                                <td><?php echo nl2br($item[$model_name]['description']) ?></td>
                                <td><?php echo $item[$model_name]['weight'] ?></td>
                                <td>
                                    <a href="<?php echo Router::url(array('action' => 'edit', $id)) ?>" class="btn btn-primary" title="<?php echo __('edit_btn') ?>">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="<?php echo Router::url(array('action' => 'reqDelete', $id)) ?>" class="btn btn-danger remove" title="<?php echo __('delete_btn') ?>">
                                        <i class="fa fa-trash"></i>
                                    </a>
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


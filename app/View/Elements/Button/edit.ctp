<?php
if (empty($action_path)) {

    $action_path = Router::url(array('action' => 'edit', 'controller' => Inflector::pluralize($model_name), $id));
}
?>
<a href="<?php echo $action_path ?>" class="btn btn-primary" title="<?php echo __('edit_btn') ?>">
    <i class="fa fa-edit"></i>
</a>
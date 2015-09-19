<?php
if (empty($action_path)) {

    $action_path = Router::url(array('action' => 'reqDelete', 'controller' => Inflector::pluralize($model_name), $id));
}
?>
<a href="<?php echo $action_path ?>" class="btn btn-danger remove" title="<?php echo __('delete_btn') ?>">
    <i class="fa fa-trash"></i>
</a>
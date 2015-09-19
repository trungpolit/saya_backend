<?php
if (empty($action_path)) {

    $action_path = Router::url(array('action' => 'reqEdit', 'controller' => Inflector::pluralize($model_name), $id));
}
?>
<button class="btn btn-info req-edit" 
        data-model_name="<?php echo $model_name ?>" 
        data-action="<?php echo $action_path ?>"
        >
    <i class="fa fa-save"></i>
</button>
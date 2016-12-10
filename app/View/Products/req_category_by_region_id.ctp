<?php

$attr = array(
    'class' => 'form-control chosen-select',
    'div' => false,
    'label' => false,
//    'required' => true,
    'empty' => '-------',
    'options' => $categories,
    'id' => 'category_id',
);
if (!empty($disable_label)) {
    $attr['label'] = false;
} else {
    $attr['label'] = __('product_category_id');
}
echo $this->Form->input($model_name . '.category_id', $attr);

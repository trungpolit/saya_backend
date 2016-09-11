<?php

$attr = array(
    'class' => 'form-control chosen-select',
    'div' => false,
    'label' => false,
    'required' => true,
    'empty' => '-------',
    'options' => $products,
    'id' => 'product_id',
    'name' => 'product_id',
);
if (!empty($disable_label)) {
    $attr['label'] = false;
} else {
    $attr['label'] = __('daily_product_report_product_id');
}
echo $this->Form->input($model_name . '.product_id', $attr);

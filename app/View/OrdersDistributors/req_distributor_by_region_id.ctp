<?php

if ($action == 'index' || $action == 'indexView') {
    $attr = array(
        'class' => 'form-control chosen-select',
        'div' => false,
        'label' => false,
//        'required' => true,
        'empty' => '-------',
        'options' => $distributors,
        'id' => 'distributor_id',
        'name' => 'distributor_id',
    );
} else {
    $attr = array(
        'class' => 'form-control chosen-select',
        'div' => false,
        'label' => false,
        'required' => true,
        'empty' => '-------',
        'options' => $distributors,
        'id' => 'distributor_id',
    );
}

if (!empty($disable_label)) {
    $attr['label'] = false;
} else {
    $attr['label'] = __('product_distributor_id');
}
echo $this->Form->input($model_name . '.distributor_id', $attr);

<?php

echo $this->Form->input($model_name . '.distributor_id', array(
    'class' => 'form-control chosen-select',
    'div' => false,
    'label' => false,
    'required' => true,
    'empty' => '-------',
    'options' => $distributors,
    'id' => 'distributor_id',
));
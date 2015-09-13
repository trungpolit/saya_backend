<?php

class Category extends AppModel {

    public $useTable = 'categories';
    public $file_fields = array('logo');
    public $actsAs = array('FileCommon');

}

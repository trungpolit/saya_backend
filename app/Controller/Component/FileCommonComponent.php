<?php

class FileCommonComponent extends Component {

    public $controller = '';
    public $uses = array(
        'FileMapping',
        'FileManaged',
    );

    public function initialize(\Controller $controller) {

        parent::initialize($controller);

        $this->controller = $controller;
    }

}

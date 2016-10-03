<?php

class PermLimitComponent extends Component {

    public $controller = '';
    public $allowedActions = array();

    public function initialize(\Controller $controller) {

        parent::initialize($controller);

        $this->controller = $controller;
    }

    public function startup(\Controller $controller) {
        parent::startup($controller);

        // nếu action hiện tại thuộc vào allowedActions thì luôn cho phép
        if (in_array($controller->action, $this->allowedActions)) {

            return true;
        }
        $user = CakeSession::read('Auth.User');
        if (empty($user) || empty($user['perms'])) {

            return $this->controller->redirect($this->controller->Auth->loginRedirect);
        }
        $perm = $this->controller->name . '/' . $this->controller->action;
        if (!in_array($perm, $user['perms'])) {

            return $this->controller->redirect($this->controller->Auth->loginRedirect);
        }

        return true;
    }

    public function allow($action = null) {

        $args = func_get_args();
        if (empty($args) || $action === null) {
            $this->allowedActions = $this->controller->methods;
            return;
        }
        if (isset($args[0]) && is_array($args[0])) {
            $args = $args[0];
        }
        $this->allowedActions = array_merge($this->allowedActions, $args);
    }

}

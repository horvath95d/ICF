<?php

class Controller {

    public function __construct() {
        
    }

    public function loadModel($model) {
        require_once 'application/models/'.$model.'.php';
        return new $model;
    }

    public function loadView($view, $data = []) {
        require_once 'application/views/template/header.php';
        require_once 'application/views/'.$view.'.php';
        require_once 'application/views/template/footer.php';
    }
}
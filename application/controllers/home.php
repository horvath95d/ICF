<?php

class Home extends Controller {

    public $home_model;

    public function __construct() {
        parent::__construct();
        $this->home_model = $this->loadModel('home_model');
    }

    public function index() {
        $this->loggedIn();

        $data['user'] = $this->home_model->getUserById($_SESSION['user_id']);
        $data['groups'] = $this->home_model->getUsersGroups($_SESSION['user_id']);
        $this->loadView('home/index', $data);
    }

    public function admin() {
        $this->loggedIn();

        $data['user'] = $this->home_model->getUserById($_SESSION['user_id']);
        $data['groups'] = $this->home_model->getUsersGroups($_SESSION['user_id']);

        if (in_array(1, array_column($data['groups'], 'id')))
            $this->loadView('home/admin', $data);
        else 
            header('Location: '.URL);
    }
    
    public function editor() {
        $this->loggedIn();
        
        $data['user'] = $this->home_model->getUserById($_SESSION['user_id']);
        $data['groups'] = $this->home_model->getUsersGroups($_SESSION['user_id']);
        $groupIds = array_column($data['groups'], 'id');

        if (in_array(1, $groupIds) || in_array(2, $groupIds))
            $this->loadView('home/editor', $data);
        else 
            header('Location: '.URL);
    }
    
    public function user() {
        $this->loggedIn();
        
        $data['user'] = $this->home_model->getUserById($_SESSION['user_id']);
        $data['groups'] = $this->home_model->getUsersGroups($_SESSION['user_id']);
        $groupIds = array_column($data['groups'], 'id');

        if (in_array(1, $groupIds) || in_array(3, $groupIds))
            $this->loadView('home/user', $data);
        else 
            header('Location: '.URL);
    }

    public function login() {
        $data['captcha'] = $this->home_model->needCaptcha();
        
        if (empty($_POST)) {
            $this->loadView('home/login', $data);
        
        } else {

            if ($data['captcha']) {
                $res = $this->postCaptcha($_POST['g-recaptcha-response']);
            
                if (!$res['success']) {
                    $_SESSION['message'] = 'Hibás captcha';
                    header('Location: '.URL.'login');
                    die();
                }
            }
            
            if ($this->home_model->login($_POST['identity'], $_POST['password'])) {
                $_SESSION['message'] = $this->home_model->message;
                header('Location: '.URL);

            } else {
                $_SESSION['message'] = $this->home_model->message;
                header('Location: '.URL.'login');
            }
        }
    }

    private function postCaptcha($user_response) {
        $fields_string = '';
        $fields = array(
            'secret' => '6Let0PIUAAAAAE20hvHiY3oD0DHChderep1mKjnm',
            'response' => $user_response
        );
        foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    public function logout() {
        session_unset();
        $_SESSION['message'] = "Sikeres kijelentkezés";
        header('Location: '.URL);
    }

    public function loggedIn() {
        if (!isset($_SESSION['user_id']))
            header('Location: '.URL.'login');
    }
}
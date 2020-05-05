<?php

class home_model extends Model {

    public $message;

    public function login($identity, $password) {
        $user = $this->getRecord("SELECT * FROM `users`
            WHERE `username` = '".$identity."'");
        
        if (!empty($user)) {

            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
    
                $this->updateLastLogin($user['id']);
                $this->clearLoginAttempts($identity);
                
                $this->message = "Sikeres bejelentkezés";
                return true;
            
            } else 
                $this->message = "Hibás jelszó";
        
        } else
            $this->message = "Hibás felhasználónév";

        $this->increaseLoginAttempts($identity);
        return false;
    }
    
    private function increaseLoginAttempts($identity) {
        $this->executeDML("INSERT INTO `login_attempts` (`ip_address`, `identity`, `time`) VALUES
            ('".$_SERVER['REMOTE_ADDR']."', '".$identity."', ".Time().")");
    }
    
    private function clearLoginAttempts($identity) {
        $this->executeDML("DELETE FROM `login_attempts`
            WHERE `ip_address` = '".$_SERVER['REMOTE_ADDR']."'
            AND `identity` = '".$identity."'
            OR `time` < ".(Time()-86400));// vagy ha elmúlt 1 nap
    }

    private function updateLastLogin($id) {
        $this->executeDML("UPDATE `users` SET `last_login` = ".Time()." WHERE `id` = ".$id);
    }

    public function needCaptcha() {
        $query = $this->getList("SELECT * FROM `login_attempts`
            WHERE `ip_address` = '".$_SERVER['REMOTE_ADDR']."'");

        return count($query) > 2;
    }
    
    public function getUserById($id) {
        $query = $this->getRecord("SELECT * FROM `users` WHERE `id` = ".$id);
        return $query;
    }

    public function getUsersGroups($id) {
        $query = $this->getList("SELECT * FROM `groups`
            WHERE `id` IN (SELECT `group_id` FROM `users_groups` WHERE `user_id` =".$id.")
            ORDER BY `id` ASC");
        return $query;
    }
}
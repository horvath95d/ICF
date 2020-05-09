<?php

class session_model extends Model implements SessionHandlerInterface {
    
    public function open($savePath, $sessionName) {
        return true;
    }
    
    public function close() {
        return true;
    }
    
    public function read($id) {
        $query = "SELECT * FROM `sessions` WHERE `id` = :id";
        $params = [
            ':id' => $id
        ];

        $result = $this->getRecord($query, $params);
        
        return isset($result['data']) ? $result['data'] : "";
    }
    
    
    public function write($id, $data) {
        $query = "REPLACE INTO `sessions` (`id`, `data`, `modified_timestamp`) VALUE (:id, :data, NOW())";
        $params = [
            ':id'   => $id,
            ':data' => $data
        ];
        $execute = $this->executeDML($query, $params);
        
        if (empty($execute))
            return true;
        else
            return false;
    }
        
    public function destroy($id) {
        $query = "DELETE FROM `sessions`  WHERE `id` = :id";
        $params = [
            ':id'   => $id
        ];
        $this->executeDML($query, $params);
        
        return true;
    }
    
    public function gc($maxlifetime) {
        $query = "DELETE FROM `sessions` WHERE DATE_ADD(modified_timestamp, INTERVAL :maxlifetime SECOND) < NOW()";
        $params = [
            ':maxlifetime'   => $maxlifetime
        ];
        $this->executeDML($query, $params);
        
        return true;
    }
}
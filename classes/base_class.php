<?php

class base_class extends db {

    private $query;

    public function customQuery($query, $param = null){
        if(is_null($param)){
            // select * from (haven't params)
            $this->query = $this->conn->prepare($query);
            return $this->query->execute();
        } else {
            // ex WHERE id = ?, VALUES ? ? ? (have params)
            $this->query = $this->conn->prepare($query);
            return $this->query->execute($param);
        }
    }

    public function countRows(){
        return $this->query->rowCount();
    }

    public function fetch_all(){
        return $this->query->fetchAll(PDO::FETCH_OBJ);
    }

    public function security($data){
        // ** prevention <script> attack
        return trim(strip_tags($data));
    }

    public function setSession($key, $value){
        return $_SESSION["$key"] = $value;
    }

    public function singleResultFetch(){
        return $this->query->fetch(PDO::FETCH_OBJ);
    }
    

}


?>
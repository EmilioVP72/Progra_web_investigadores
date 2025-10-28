<?php

class Sistema{
    var $_dsn = "pgsql:host=postgres;dbname=database";
    var $_user = "user";
    var $_password = "password";
    var $_db = null;
    
    function connect(){
        $this->_db = new PDO($this->_dsn, $this->_user, $this->_password);

    }
}

class User extends Sistema{

    function create($data){
        $this->connect();
        $this->_db->beginTransaction();
        try{
            $sql = "INSERT INTO user(email, password) VALUES (:email, :password);";
            $sth = $this->_db->prepare($sql);
            $sth->bindParam(":email", $data['email'], PDO::PARAM_STR);
            $sth->bindParam(":password", $data['password'], PDO::PARAM_STR);
            $sth->execute();
            $affectedRows = $sth->rowCount();
            $this->_db->commit();
            return $affectedRows;
        } catch(Exception $e){
            $this->_db->rollback();
            return null;
        }
    }

    function read(){
        $this->connect();
        $sth = $this->_db->prepare("SELECT id_user, email FROM user");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function readOne($id){
        $this->connect();
        $sql = "SELECT id_user, email, password FROM user WHERE id_user = :id_user";
        $sth = $this->_db->prepare($sql);
        $sth->bindParam(":id_user", $id, PDO::PARAM_INT);
        $sth->execute();
        $data = $sth->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    function update($id, $data){
        if (is_numeric($id)){
            $this->connect();
            $this->_db->beginTransaction();
            try {
                $sql = "UPDATE user SET email = :email, password = :password WHERE id_user = :id_user";
                $sth = $this->_db->prepare($sql);
                $sth->bindParam(":id_user", $id, PDO::PARAM_INT);
                $sth->bindParam(":email", $data['email'], PDO::PARAM_STR);
                $sth->bindParam(":password", $data['password'], PDO::PARAM_STR);
                $sth->execute();
                $affectedRows = $sth->rowCount();
                $this->_db->commit();
                return $affectedRows;
            } catch(Exception $e){
                $this->_db->rollback();
                return null;
            }
        } else{
            return null;
        }
    }

    function delete($id){
        if (is_numeric($id)){
            $this->connect();
            $this->_db->beginTransaction();
            try {
                $sql = "DELETE FROM user WHERE id_user = :id_user";
                $sth = $this->_db->prepare($sql);
                $sth->bindParam(":id_user", $id, PDO::PARAM_INT);
                $sth->execute();
                $affectedRows = $sth->rowCount();
                $this->_db->commit();
                return $affectedRows;
            } catch(Exception $e){
                $this->_db->rollback();
                return null;
            }
        } else{
            return null;
        }
    }
}
?>

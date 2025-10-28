<?php
require_once("../models/sistema.php");
class Tratamiento extends Sistema{
    function create($data){
        $this->connect();
        $this->_db->beginTransaction();
        try{
            $sql = "INSERT INTO tratamiento(tratamiento) VALUES (:tratamiento);";
            $sth = $this->_db->prepare($sql);
            $sth->bindParam(":tratamiento", $data['tratamiento'], PDO::PARAM_STR);
            $sth->execute();
            $affectedRows = $sth->rowCount();
            $this->_db->commit();
            return $affectedRows;
        } catch(Exception $e){
            $this->_db->rollback();
        }
    }

    function read(){
        $this->connect();
        $sth = $this->_db->prepare("SELECT * FROM tratamiento");
        $sth->execute();
        $data = $sth->fetchAll();
        return $data;
    }

    function readOne($id){
        $this->connect();
        $sth = $this->_db->prepare("SELECT * FROM tratamiento
        where id_tratamiento = :id_tratamiento");
        $sth->bindParam(":id_tratamiento", $id, PDO::PARAM_INT);
        $sth->execute();
        $data = $sth->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    function update($id, $data){
        if (is_numeric($id)){
            $this->connect();
            $this->_db->beginTransaction();
            try {
                $sql = "UPDATE tratamiento SET tratamiento = :tratamiento WHERE id_tratamiento = :id_tratamiento";
                $sth = $this->_db->prepare($sql);
                $sth->bindParam(":id_tratamiento", $id, PDO::PARAM_INT);
                $sth->bindParam(":tratamiento", $data['tratamiento'], PDO::PARAM_STR);
                $sth->execute();
                $affectedRows = $sth->fetchAll();
                $this->_db->commit();
                return $affectedRows;
            } catch(Exception $e){
                $this->_db->rollback();
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
                $sql = ("DELETE FROM tratamiento WHERE id_tratamiento = :id_tr");
                $sth = $this->_db->prepare($sql);
                $sth->bindParam(":id_tratamiento", $id, PDO::PARAM_INT);
                $sth->execute();
                $affectedRows = $sth->rowCount();
                $this->_db->commit();
                return $affectedRows;
            } catch(Exception $e){
                $this->_db->rollback();
            }
        } else{
            return null;
        }
    }

    function Validate($data){
        if($data['tratamiento'] == ""){
            
        }
        
        return true;
    }    
}
?>
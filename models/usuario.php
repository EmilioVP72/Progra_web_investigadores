<?php
require_once("../models/sistema.php");


class Usuario extends Sistema{
    function create($data){
        $this->connect();
        $this->_db->beginTransaction();
        try{
            $sql = "INSERT INTO usuario(correo, contrasena) VALUES (:correo, :contrasena)";
            $sth = $this->_db->prepare($sql);
            $sth->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
            $contrasena = password_hash($data['password'], PASSWORD_DEFAULT);
            $sth->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
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
        $sth = $this->_db->prepare("SELECT * FROM usuario");
        $sth->execute();
        $data = $sth->fetchAll();
        return $data;
    }

    function readOne($id){
        $this->connect();
        $sth = $this->_db->prepare("SELECT * FROM usuario WHERE id_usuario = :id_usuario");
        $sth->bindParam(":id_usuario", $id, PDO::PARAM_INT);
        $sth->execute();
        $data = $sth->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    function update($id, $data){
        if (is_numeric($id)){
            $this->connect();
            $this->_db->beginTransaction();
            try {
                $sql = "UPDATE usuario SET correo = :correo";
                if (isset($data['password']) && !empty($data['password'])) {
                    $sql .= ", contrasena = :contrasena";
                }
                $sql .= " WHERE id_usuario = :id_usuario";

                $sth = $this->_db->prepare($sql);
                $sth->bindParam(":id_usuario", $id, PDO::PARAM_INT);
                $sth->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
                if (isset($data['password']) && !empty($data['password'])) {
                    $contrasena = password_hash($data['password'], PASSWORD_DEFAULT);
                    $sth->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
                }
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
                $sql = ("DELETE FROM usuario WHERE id_usuario = :id_usuario");
                $sth = $this->_db->prepare($sql);
                $sth->bindParam(":id_usuario", $id, PDO::PARAM_INT);
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

}
?>
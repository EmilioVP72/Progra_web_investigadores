<?php
require_once("../models/sistema.php");
class Investigador extends Sistema{
    function create($data){
        $this->connect();
        $this->_db->beginTransaction();
        try{
            $sql = "INSERT INTO investigador(primer_apellido, segundo_apellido, nombre, fotografia, id_institucion, semblanza, id_tratamiento) 
                    VALUES (:primer_apellido, :segundo_apellido, :nombre, :fotografia, :id_institucion, :semblanza, :id_tratamiento);";
            $sth = $this->_db->prepare($sql);
            $sth->bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);
            $sth->bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);
            $sth->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
            $sth->bindParam(":id_institucion", $data['id_institucion'], PDO::PARAM_INT);
            $sth->bindParam(":semblanza", $data['semblanza'], PDO::PARAM_STR);
            $sth->bindParam(":id_tratamiento", $data['id_tratamiento'], PDO::PARAM_INT);
            $fotografia = $this->cargarFotografia('investigadores', 'fotografia');
            $sth->bindParam(":fotografia",$fotografia, PDO::PARAM_STR);
            $sth->execute();
            $affectedRows = $sth->rowCount();
            $sql = "INSERT INTO usuario(correo, contrasena) VALUES (:correo, :contrasena)";
            $sth = $this->_db->prepare($sql);
            $sth->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
            $contrasena = password_hash($data['password'], PASSWORD_DEFAULT);
            $sth->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
            $sth->execute();
            $sql = "SELECT * FROM usuario WHERE correo = :correo";
            $sth = $this->_db->prepare($sql);
            $sth->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
            $sth->execute();
            $usuario = $sth->fetch(PDO::FETCH_ASSOC);
            $id_usuario = $usuario['id_usuario'];
            $sql = "INSERT INTO usuario_rol(id_usuario, id_rol) VALUES (:id_usuario, 2)";
            $sth = $this->_db->prepare($sql);
            $sth->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $sth->execute();
            $sql = "SELECT * FROM investigador WHERE ORDER BY id_investigador DESC LIMIT 1";
            $sth = $this->_db->prepare($sql);
            $sth->execute();
            $investigador = $sth->fetch(PDO::FETCH_ASSOC);
            $sql = "UPDATE investigador SET id_usuario = :id_usuario WHERE id_investigador = :id_investigador";
            $sth = $this->_db->prepare($sql);
            $sth->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $sth->bindParam(":id_investigador", $investigador['id_investigador'], PDO::PARAM_INT);
            $sth->execute();
            $this->_db->commit();
            return $affectedRows;
        } catch(Exception $e){
            $this->_db->rollback();
        }
    }

    function read(){
        $this->connect();
        $sth = $this->_db->prepare("SELECT * FROM investigador inv
        left join institucion i on inv.id_institucion = i.id_institucion
        left join tratamiento t on inv.id_tratamiento = t.id_tratamiento");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function readOne($id){
        $this->connect();
        $sth = $this->_db->prepare("SELECT inv.*, i.institucion, t.tratamiento 
                FROM investigador inv 
                LEFT JOIN institucion i ON inv.id_institucion = i.id_institucion 
                LEFT JOIN tratamiento t ON inv.id_tratamiento = t.id_tratamiento 
                WHERE inv.id_investigador = :id_investigador");
        $sth->bindParam(":id_investigador", $id, PDO::PARAM_INT);
        $sth->execute();
        $data = $sth->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    function update($id, $data){
        if (is_numeric($id)){
            $this->connect();
            $this->_db->beginTransaction();
            try {
                $sql = "UPDATE investigador 
                        SET primer_apellido = :primer_apellido,
                            segundo_apellido = :segundo_apellido,
                            nombre = :nombre,
                            id_institucion = :id_institucion,
                            semblanza = :semblanza,
                            id_tratamiento = :id_tratamiento
                        WHERE id_investigador = :id_investigador";
                if (isset($_FILES['fotografia'])){
                    if ($_FILES['fotografia']['error'] == 0){
                        $sql = "UPDATE investigador 
                        SET primer_apellido = :primer_apellido,
                            segundo_apellido = :segundo_apellido,
                            nombre = :nombre,
                            fotografia = :fotografia,
                            id_institucion = :id_institucion,
                            semblanza = :semblanza,
                            id_tratamiento = :id_tratamiento
                        WHERE id_investigador = :id_investigador";
                        $fotografia = $this->cargarFotografia('investigadores', 'fotografia');
                    }
                }
                $sth = $this->_db->prepare($sql);
                $sth->bindParam(":id_investigador", $id, PDO::PARAM_INT);
                $sth->bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);
                $sth->bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);
                $sth->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
                $sth->bindParam(":id_institucion", $data['id_institucion'], PDO::PARAM_INT);
                $sth->bindParam(":semblanza", $data['semblanza'], PDO::PARAM_STR);
                $sth->bindParam(":id_tratamiento", $data['id_tratamiento'], PDO::PARAM_INT);
                if (isset($_FILES['fotografia'])){
                    if ($_FILES['fotografia']['error'] == 0){
                        $fotografia = $this->cargarFotografia('investigadores', 'fotografia');
                        $sth->bindParam(":fotografia",$fotografia, PDO::PARAM_STR);
                    }
                }
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
                $sql = ("DELETE FROM investigador WHERE id_investigador = :id_investigador");
                $sth = $this->_db->prepare($sql);
                $sth->bindParam(":id_investigador", $id, PDO::PARAM_INT);
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
        if($data['primer_apellido'] == "" || $data['segundo_apellido'] == "" || $data['nombre'] == "" || $data['fotografia'] == "" || $data['id_institucion'] == "" || $data['semblanza'] == "" || $data['id_tratamiento'] == ""){
            
        }  
        return true;
    }    
}
?>
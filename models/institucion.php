<?php
require_once(__DIR__ . "/sistema.php");
class Institucion extends Sistema{
    function create($data){
        $this->connect();
        $this->_db->beginTransaction();
        try{
            $sql = "INSERT INTO institucion(institucion, logotipo) VALUES (:institucion, :logotipo);";
            $sth = $this->_db->prepare($sql);
            $sth->bindParam(":institucion", $data['institucion'], PDO::PARAM_STR);
            $sth->bindParam(":logotipo", $data['logotipo'], PDO::PARAM_STR);
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
        $sth = $this->_db->prepare("SELECT * FROM institucion");
        $sth->execute();
        $data = $sth->fetchAll();
        return $data;
    }

    function readOne($id){
        $this->connect();
        $sth = $this->_db->prepare("SELECT * FROM institucion
        where id_institucion = :id_institucion");
        $sth->bindParam(":id_institucion", $id, PDO::PARAM_INT);
        $sth->execute();
        $data = $sth->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    function update($id, $data){
        if (is_numeric($id)){
            $this->connect();
            $this->_db->beginTransaction();
            try {
                $sql = "UPDATE institucion SET institucion = :institucion, :logotipo WHERE id_institucion = :id_institucion";
                $sth = $this->_db->prepare($sql);
                $sth->bindParam(":id_institucion", $id, PDO::PARAM_INT);
                $sth->bindParam(":institucion", $data['institucion'], PDO::PARAM_STR);
                $sth->bindParam(":logotipo", $data['logotio'], PDO::PARAM_STR);
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
                $sql = ("DELETE FROM institucion WHERE id_institucion = :id_institucion");
                $sth = $this->_db->prepare($sql);
                $sth->bindParam(":id_institucion", $id, PDO::PARAM_INT);
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
        if($data['institucion'] == "" || $data['logotipo'] == ""){
            
        }
        
        return true;
    } 
    
    function reporteInstitucionesInvestigadores(){
        $this->connect();
        $sql = "SELECT it.institucion, count(iv.id_investigador) AS cantidad_investigadores
                FROM institucion it JOIN investigador iv ON it.id_institucion = iv.id_institucion
                GROUP BY it.institucion
                ORDER BY cantidad_investigadores DESC;";
        $sth = $this->_db->prepare($sql);
        $sth->execute();
        if($sth->rowCount() > 0){
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } else{
            return null;
        }
    }
}
?>
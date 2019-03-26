<?php
namespace System;

abstract class Model {

    function __construct() {
        $this->con = Conexao::getConn();
    }    

    //metodos CRUD
    public function find($id){
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if($stmt->rowCount() > 0){
          return $stmt->fetch(\PDO::FETCH_ASSOC);
      } else { return false; }
    }

    public function findAll($order = 'id DESC', $limit = ''){
        $sql = "SELECT * FROM $this->table ORDER BY {$order} {$limit}";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0){
          return $stmt->fetchAll(\PDO::FETCH_ASSOC);
      } else { return false; }
    } 

    public function findWhere($where = '', $order = 'id DESC', $limit = ''){
        if($where) $w = "AND $where";
        $sql = "SELECT * FROM $this->table WHERE 1=1 $w ORDER BY {$order} {$limit}";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0){
          return $stmt->fetchAll(\PDO::FETCH_ASSOC);
      } else { return false; }
    }     

    public function insert($dados){
        $sql = "INSERT INTO $this->table (" . implode(',', array_keys($dados)) . ") VALUES (:" . implode(',:', array_keys($dados)) .")";
        $stmt = $this->con->prepare($sql);
        foreach($dados as $key => $value) $stmt->bindParam(":{$key}", $dados[$key]);
        if($stmt->execute()){
          return $this->con->lastInsertId();
      } else { return false; }
    }  

    public function update($dados, $id){
        foreach($dados as $key => $value) $values[] = "{$key} = :{$key}";
        $sql = "UPDATE $this->table SET ". implode(',', $values) ." WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        foreach($dados as $key => $value) $stmt->bindParam(":{$key}", $dados[$key]);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }  

    public function delete($id){
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }      


}
<?php

namespace Younes\DriveLoc\Controller;

abstract class Base {
    private $db;
    private $table = null;

    public function __construct($db, $table)
    {
        $this->db = $db;
        $this->table = $table;
    }

    public function create($data) {
        $columns = implode(",", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($sql);
    
        foreach ($data as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }
    
        $stmt->execute();
    }

    public function all() {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->db->prepare($sql);
        if($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        }
    }

    public function find($id) {
        $column_name = substr($this->table, 0, -1);
        $sql = "SELECT * FROM {$this->table} WHERE {$column_name}_id  = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        if($stmt->execute()) {
            return $stmt->fetch();
        } else {
            return null;
        }
    }

    public function delete($id) {
        $column_name = substr($this->table, 0, -1);
        $sql = "DELETE FROM {$this->table} WHERE {$column_name}_id = :id";
        var_dump($sql);
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function update($id, $data) {
        $columns = [];
        $params = [':id' => $id];
    
        foreach ($data as $key => $value) {
            $columns[] = "$key = :$key";
            $params[":$key"] = $value;
        }
    
        $columns = implode(', ', $columns);
        $sql = "UPDATE table_name SET $columns WHERE id = :id";
        $stmt = $this->db->prepare($sql);
    
        foreach ($params as $param => $value) {
            $stmt->bindValue($param, $value);
        }
    
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

?>
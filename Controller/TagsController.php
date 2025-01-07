<?php

namespace Younes\DriveLoc\Controller;

trait TagsController
{
    private $db;
    private $tableTags = "tags";

    public function createTag($instanceTag)
    {
        $columns = implode(",", array_keys(get_object_vars($instanceTag)));
        $placeholders = ":" . implode(", :", array_keys(get_object_vars($instanceTag)));
        $sql = "INSERT INTO {$this->tableTags} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($sql);

        foreach ($instanceTag as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }

        return $stmt->execute();
    }

    public function updateTag($id, $tag_name)
    {
        $query = "UPDATE $this->tableTags SET tag_name = :tag_name WHERE tag_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':tag_name', $tag_name);
        $stmt->execute();
    }

    public function deleteTag($id)
    {
        $query = "DELETE FROM $this->tableTags WHERE tag_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getAllTags()
    {
        $sql = "SELECT * FROM {$this->tableTags}";
        $stmt = $this->db->prepare($sql);
        if($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        }
    }

}
<?php

namespace Younes\DriveLoc\Controller;

trait ArticleController
{
    private $db;
    private $tableArticle = "articles";

    public function createArticle($instanceArticle)
    {
        $columns = implode(",", array_keys(get_object_vars($instanceArticle)));
        $placeholders = ":" . implode(", :", array_keys(get_object_vars($instanceArticle)));
        $sql = "INSERT INTO {$this->tableArticle} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($sql);

        foreach ($instanceArticle as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }

        return $stmt->execute();
    }

    public function updateArticle($id, $article_title, $article_content)
    {
        $query = "UPDATE $this->tableArticle SET article_title = :article_title, article_content = :article_content WHERE article_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':article_title', $article_title);
        $stmt->bindParam(':article_content', $article_content);
        $stmt->execute();
    }

    public function deleteArticle($id)
    {
        $query = "UPDATE $this->tableArticle SET is_deleted = 1 WHERE article_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getAllArticles()
    {
        $sql = "SELECT * FROM {$this->tableArticle} WHERE";
        $stmt = $this->db->prepare($sql);
        if($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        }
    }

    public function getArticle($id)
    {
        $sql = "SELECT * FROM {$this->tableArticle} WHERE article_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        if($stmt->execute()) {
            return $stmt->fetch();
        } else {
            return null;
        }
    }

    public function approuveArticle($id)
    {
        $query = "UPDATE $this->tableArticle SET article_status = 'Approuve' WHERE article_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function rejectArticle($id)
    {
        $query = "UPDATE $this->tableArticle SET article_status = 'Reject' WHERE article_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }


}
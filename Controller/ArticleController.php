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

        $query = "DELETE FROM $this->tableArticle WHERE article_id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getAllArticles()
    {
        $sql = "SELECT * FROM {$this->tableArticle}";
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
        $query = "UPDATE $this->tableArticle SET article_status = 'Approve' WHERE article_id = :id";
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

    public function GetUserArticle($user_id) {
        $sql = "SELECT A.article_id, A.article_title, A.article_image, A.article_status, T.theme_nom as article_theme FROM articles A JOIN themes T ON A.fk_theme_id = T.theme_id JOIN users U ON A.fk_user_id = U.user_id WHERE A.fk_user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        if($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        }
    }

    public function getArticleForAdmin() {
        $sql = "SELECT * FROM GestionDesArticles";
        $stmt = $this->db->prepare($sql);
        if($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        }
    }

    public function getArticlesPerTheme($theme_id) {
        $sql = "SELECT * FROM {$this->tableArticle} WHERE fk_theme_id = :theme_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':theme_id', $theme_id);
        if($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        }
    }


}
<?php

namespace Younes\DriveLoc\Controller;

trait ArticleController
{
    private $db;
    private $tableArticle = "articles";

    public function createArticle($instanceArticle)
    {
        $InsertRequest = "CALL CreateArticle(:article_title, :article_content, :article_image, :fk_user_id, :fk_theme_id)";
        $stmt = $this->db->prepare($InsertRequest);
        $stmt->bindParam(':article_title', $instanceArticle->article_title);
        $stmt->bindParam(':article_content', $instanceArticle->article_content);
        $stmt->bindParam(':article_image', $instanceArticle->article_image);
        $stmt->bindParam(':fk_user_id', $instanceArticle->fk_user_id);
        $stmt->bindParam(':fk_theme_id', $instanceArticle->fk_theme_id);
        if($stmt->execute()) {
            $data = $stmt->fetch();
            $lastInsert = $data['lastInsert'];
            foreach ($instanceArticle->tags as $key => $tag) {
                $InsertRequest = "INSERT INTO articles_tags (fk_article_id, fk_tags_id) VALUES (:article_id, :tag_id)";
                $stmt = $this->db->prepare($InsertRequest);
                $stmt->bindParam(':article_id', $lastInsert);
                $stmt->bindParam(':tag_id', $key);
                if(!$stmt->execute()) {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
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
        $sql = "SELECT  U.nom, U.prenom, A.article_id, article_title, A.article_content, A.article_image FROM articles A JOIN users U ON A.fk_user_id = U.user_id WHERE A.article_id = :id";
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
        $sql = "SELECT * FROM {$this->tableArticle} WHERE fk_theme_id = :theme_id AND article_status = 'Approve'";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':theme_id', $theme_id);
        if($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        }
    }

    public function searchArticles($search) {
        $sql = "SELECT * FROM {$this->tableArticle} WHERE article_title LIKE :search";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':search', "%$search%");
        if($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        }
    }

    public function articlePagination($theme_id, $limit, $offset)
    {
        $sql = "SELECT * FROM {$this->tableArticle} WHERE fk_theme_id = :fk_theme_id LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":limit", $limit);
        $stmt->bindValue(":offset", $offset);
        $stmt->bindParam(':fk_theme_id', $theme_id);
        if ($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        }
    }



}
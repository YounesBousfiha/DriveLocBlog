-- SQLCODE de Ajoute des Tableux necessaire pour le BLOG

CREATE TABLE IF NOT EXISTS themes (
                                      theme_id int NOT NULL AUTO_INCREMENT,
                                      theme_nom varchar(255),
                                      theme_image varchar(255) NOT NULL,
                                      fk_user_id int NOT NULL,
                                      PRIMARY KEY(theme_id),
                                      FOREIGN KEY (fk_user_id) REFERENCES users (user_id)
);

CREATE TABLE IF NOT EXISTS articles (
                                        article_id int NOT NULL AUTO_INCREMENT,
                                        article_title varchar(255) NOT NULL,
                                        article_content TEXT NOT NULL,
                                        article_image varchar(255) NOT NULL,
                                        article_status ENUM('Pending', 'Approve', 'Reject') DEFAULT 'Pending',
                                        fk_user_id int NOT NULL,
                                        fk_theme_id int NOT NULL,
                                        PRIMARY KEY(article_id),
                                        FOREIGN KEY (fk_user_id) REFERENCES users (user_id),
                                        FOREIGN KEY (fk_theme_id) REFERENCES themes(theme_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS  tags(
                                    tag_id int NOT NULL AUTO_INCREMENT,
                                    tag_nom varchar(32) NOT NULL,
                                    PRIMARY KEY(tag_id)
);

CREATE TABLE IF NOT EXISTS articles_tags(
                                            fk_article_id int NOT NULL AUTO_INCREMENT,
                                            fk_tags_id int NOT NULL,
                                            PRIMARY KEY (fk_article_id, fk_tags_id),
                                            foreign key (fk_article_id) REFERENCES articles(article_id),
                                            FOREIGN KEY (fk_tags_id) REFERENCES tags (tag_id)
);

CREATE TABLE IF NOT EXISTS commentaires(
                                           commentaire_id int NOT NULL AUTO_INCREMENT,
                                           commentaire_content TEXT NOT NULL,
                                           fk_user_id int NOT NULL,
                                           fk_article_id int NOT NULL,
                                           PRIMARY KEY (commentaire_id),
                                           FOREIGN KEY (fk_user_id) REFERENCES users(user_id),
                                           FOREIGN KEY (fk_article_id) REFERENCES articles(article_id) ON DELETE CASCADE
);



CREATE TABLE IF NOT EXISTS favoris(
                                      favoris_id int NOT NULL AUTO_INCREMENT,
                                      fk_article_id int NOT NULL,
                                      fk_user_id int NOT NULL,
                                      PRIMARY KEY (favoris_id),
                                      FOREIGN KEY (fk_user_id) REFERENCES users(user_id),
                                      FOREIGN KEY (fk_article_id) REFERENCES  articles(article_id) ON DELETE CASCADE
);

-- CREATE VIEW 1
CREATE VIEW CommentaireForAdmin as
SELECT C.commentaire_id ,U.nom, U.prenom, A.article_title, C.commentaire_content
FROM commentaires C
         JOIN articles A ON A.article_id = C.fk_article_id
         JOIN users U ON U.user_id = C.fk_user_id

-- CREATE VIEW 2
CREATE VIEW ArticleForUser as
SELECT O.nom as owner_nom, O.prenom as owner_prenom , A.article_title, A.article_image, A.article_content, R.nom as commentAuthorNom, R.prenom as commentAuthorPrenom , C.commentaire_content
FROM articles A
         JOIN commentaires C ON A.article_id = C.fk_article_id
         JOIN users R ON C.fk_user_id = R.user_id
         JOIN users O ON A.fk_user_id = O.user_id


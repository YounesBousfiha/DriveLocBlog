<?php

namespace Younes\DriveLoc\Controller;


class UserController {
    use AuthController, AvisController, FavoriController;
    use ReservationController {
        createReservation as public;
        getReservationForUser as public;
    }
    use VehiculeController {
        getAllVehicules as public;
        countVehiculePerCategory as public;
    }
    use CategorieController {
        getAllCategories as public;
    }

    use ThemeController {
        getAllThemes as public;
    }
    use CommentaireController {
        createCommentaire as public;
        updateCommentaire as public;
        deleteCommentaire as public;
    }
    use TagsController {
        getAllTags as public;
    }
    use ArticleController {
        getAllArticles as public;
        articlePaginationPertheme as public;
    }
    public function __construct($db) {
        $this->setDb($db);
    }
}
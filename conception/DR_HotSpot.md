# Routes

## Sprint 1

| URL | Méthode HTTP | Controller | Méthode | Identifiant | Titre de la page | Contenu | Commentaire |
|--|--|--|--|--|--|--|--|
| `/` | `GET` | `MainController` | `home` | `home` | `HotSpot` | `Page d'accueil avec mise en avant de 5 events et de 5 spots` | `les events et spots mis en avant seront les contenus les plus récents` |
| `/mentions-legales` | `GET` | `MainController` | `legalMentions` | `legal-mentions` | `Mentions Légales` |  |  |
| `/about` | `GET` | `MainController` | `about` | `about` | `A propos` |  |  |
| `/contact` | `GET` | `MainController` | `contact` | `contact` | `Contact` | `Formulaire pour contacter l'administration` |  |
| `/contact` | `POST` | `MainController` | `contact` | `contact` | `Contact` | `Formulaire pour contacter l'administration` |  |
| `/404` | `GET` | `MainController` | `error404` | `error-404` | `404` | `Page non trouvée, retour à l'accueil` |  |
| `/login` | `GET` | `UserController` | `login` | `login` | `Connexion` | `Formulaire de connexion` |  |
| `/login` | `POST` | `UserController` | `loginPost` | `login-post` | `Connexion` | `Connexion de l'utilisateur` |  |
| `/register` | `GET` | `UserController` | `register` | `register` | `Inscription` | `Formulaire d'inscription` |  |
| `/register` | `POST` | `UserController` | `registerPost` | `register-post` | `Inscription` | `Inscription en tant qu'utilisateur` |  |
| `/my-profile` | `GET` | `UserController` | `profile` | `profile` | `Profil de l'utilisateur` | `Formulaire de modification du profil connecté  / !!Ajout des route permettant de modifier-supprimer son compte` |  |
| `/my-profile` | `POST` | `UserController` | `profilePost` | `profile-post` | `Profil de l'utilisateur` | `Modification du profil utilisateur connecté` |  |
| `/user/[id]` | `GET` | `UserController` | `userDetail` | `user-detail` | `Détail d'un profil utilisateur` | `Le détail de l'utilisateur sélectionné` | `[id] est l'identifiant de l'utilisateur dans la base de données` |
| `/events` | `GET/POST` | `EventController` | `eventsList/eventPost` | `events-list/event-post` | `Liste des events/Ajouter un event` | `La liste de tous les events futurs/Formulaire d'ajout d'un event` | `Rangés du plus proche au plus lointain` |
| `/event/[id]` | `GET/UPDATE/DELETE` | `EventController` | `eventDetail/eventUpdate/eventDelete` | `event-detail/event-update/event-delete` | `Détail d'un event/Modification d'un event/suppression d'un event` | `L'event sélectionné détaillé/Formulaire de modification d'un event/Bouton de suppression d'un event` | `[id] est l'identifiant de l'event sélectionné/Formlaire accessible uniquement si auteur de l'event connecté/Bouton accessible uniquement si auteur de l'event connecté` |
| `/spots` | `GET` | `SpotController` | `spotsList` | `spots-list` | `Liste des spots` | `La liste de tous les spots` | `!!Ajout de la route pour créer un spot` |
| `/spot/[id]` | `GET` | `SpotController` | `spotDetail` | `spot-detail` | `Détail d'un spot` | `Le spot sélectionné détaillé` | `[id] est l'identifiant du spot sélectionné / !! Ajout des routes pour modifier-supprimer un spot` |
| `/search/[action]` | `GET` | `SearchController` | `searchResult` | `search-result` | `Résultat de la recherche` | `Les résultats de la recherche` | `[action] est le terme recherché / !!Ajouter la méthode POST de la barre de recherhe ?` |
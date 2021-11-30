# Routes

## Sprint 1

| URL | Méthode HTTP | Controller | Méthode | Identifiant | Titre de la page | Contenu | Commentaire |
|--|--|--|--|--|--|--|--|
| `/` | `GET` | `MainController` | `home` | `home` | `Dans les Shoe` | `Page d'accueil avec mise en avant de 5 catégories` | `les catégories à mettre en avant seront paramétrables dans le backoffice (sprint 2)` |
| `/mentions-legales` | `GET` | `MainController` | `legalMentions` | `legal-mentions` | `Mentions Légales` |  |  |
| `/catalogue/categorie/[id]` | `GET` | `CatalogController` | `category` | `catalog-category` | `Catalogue + nom de la catégorie` | `Une liste de produits triée sur la catégorie [id]` | `[id] sera un entier non-signé correspondant à l'identifiant unique de la catégorie sur laquelle on souhaite filtrer la liste de produits` |
| `/catalogue/type/[id]` | `GET` | `CatalogController` | `type` | `catalog-type` | `Catalogue + nom du type` | `Une liste de produits triée sur le type [id]` | `[id] sera un entier non-signé correspondant à l'identifiant unique du type de produit sur lequel on souhaite filtrer la liste de produits` |
| `/catalogue/marque/[id]` | `GET` | `CatalogController` | `brand` | `catalog-brand` | `Catalogue + nom de la marque` | `Une liste de produits triée sur la marque [id]` | `[id] sera un entier non-signé correspondant à l'identifiant unique d'une marque sur laquelle on souhaite filtrer la liste de produits` |
| `/catalogue/produit/[id]` | `GET` | `CatalogController` | `product` | `catalog-product` | `Catalogue + nom du produit` | `Page produit [id]` | `[id] sera un entier non-signé correspondant à l'identifiant unique du produit` |


# Dictionnaire de données

## Surfer profile (`hs_surfer_profile`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant de l'utilisateur connecté|
|surfername|VARCHAR(64)|NOT NULL|Le pseudo de l'utilisateur|
|description|TEXT|NULL|Présentation de l'utilisateur|
|picture|VARCHAR(128)|NULL|L'URL de la photo de l'utilisateur|
|level|TINYINT(1)|NOT NULL, DEFAULT 0|Niveau de compétence en surf de l'utilisateur|
|city|VARCHAR(64)|NULL|La ville de l'utilisateur|
|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création du profil utilisateur|
|updated_at|TIMESTAMP|NULL|La date de la dernière mise à jour du profil utilisateur|


## Events (`hs_event`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant de l'événement|
|name|VARCHAR(64)|NOT NULL|Le nom de l'événement|
|description|TEXT|NULL|La description de l'événement|
|picture|VARCHAR(128)|NULL|L'URL de l'image de l'événement|
|date|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de l'événement|
|spot_id|INT|FOREIGN KEY, NOT NULL, UNSIGNED|L'identifiant du spot de l'event|
|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création de l'événement|
|updated_at|TIMESTAMP|NULL|La date de la dernière mise à jour de l'événement|



## Spots (`hs_spot`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant du spot|
|name|VARCHAR(64)|NOT NULL|Le nom du spot|
|picture|VARCHAR(128)|NULL|L'URL de l'image du spot|
|address|VARCHAR(64)|NULL|L'adresse du spot|
|city|VARCHAR(64)|NULL|La ville du spot|
|zipcode|MEDIUMINT|NULL|Le code postal du spot|
|latitude|VARCHAR(128)|NULL|Latitude du spot pour la carte|
|longitude|VARCHAR(128)|NULL|Longitude du spot pour la carte|
|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création du spot|
|updated_at|TIMESTAMP|NULL|La date de la dernière mise à jour du spot|


## Levels (`hs_level`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant du niveau de compétence|
|name|VARCHAR(64)|NOT NULL|Le nom du niveau de compétence|
|icon|VARCHAR(128)|NULL|L'URL de l'image d'illustration de la compétence|
|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création du niveau de compétence|
|updated_at|TIMESTAMP|NULL|La date de la dernière mise à jour du niveau de compétence|


## Departements (`hs_departement`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant du département|
|name|VARCHAR(64)|NOT NULL|Le nom du niveau de compétence|
|zipcode|VARCHAR(4)|NULL|Le numéro du département|
|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création du département|
|updated_at|TIMESTAMP|NULL|La date de la dernière mise à jour du département|

## Event Discipline (`hs_discipline`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant de la discipline|
|name|VARCHAR(64)|NOT NULL|Le nom de la discipline|
|icon|VARCHAR(128)|NULL|L'URL de l'image d'illustration de la discipline|
|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création de la discipline|
|updated_at|TIMESTAMP|NULL|La date de la dernière mise à jour de la discipline|

## Participation (`hs_surfer_event_participation`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|surfer_id|INT|NOT NULL, UNSIGNED|L'identifiant de l'utilisateur|
|event_id|INT|NOT NULL, UNSIGNED|L'identifiant de l'event|
|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création de la participation|
|updated_at|TIMESTAMP|NULL|La date de la dernière mise à jour de la participation|
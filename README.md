# Description

Projet de développement web durant ma 3e année de licence

Ce projet a été séparé en 3 étapes distinct, vous retrouverez toutes les choses qui ont été faite à chaque étape dans la suite de ce readme.

# Comment utiliser le projet

- Récupérer le dossier projet et le mettre sur un serveur
- importer la base de donnée à l’aide du fichier pokemon_simple_type.sql qui est dans le dossier projet
- se rendre ensuite sur votre navigateur et ouvrir le dossier depuis votre serveur

# Etape 1

implémentation du modèle MVC/Objet/POO

### Structure du projet

- le dossier public contient
    - un dossier img avec toutes les images
    - un dossier css avec le fichier style.css
    - un dossier Js avec tous les scripts javascript utilisé
- le dossier contrôleur avec le fichier controleur.php
- le dossier Modele qui contient tout les fichier de class
- le dossier Vue qui contient tous les fichiers qui gère l’aspect visuel du site
- le fichier index.php qui seras notre routeur

### Fonctionnement du site

Le site utilise une architecture MVC (Modèle-Vue-Contrôleur), ce qui signifie que toutes les demandes de l'utilisateur sont transmises au contrôleur via le fichier index(routeur). Le contrôleur effectue les actions nécessaires et renvoie les pages appropriées. Le routeur appelle les fonctions nécessaires pour répondre aux demandes de l'utilisateur, puis transmet les valeurs pour les afficher sur la vue de la page demandée.

![Untitled](https://s3-us-west-2.amazonaws.com/secure.notion-static.com/c1ba24a1-2179-459c-ac1c-2d59f636667d/Untitled.png)

Chaque vue est définie par le fichier gabarit.php, qui détermine l'apparence générale du site. Le tableau affiché sur la page test est généré à partir de requêtes SQL effectuées dans les fichiers disponibles dans le dossier modèle. Ce tableau est un tableau d'objets contenant la liste de tous les Pokémon et leurs types présents dans la base de données. Chaque Pokémon est un objet, de même que chaque type, créé respectivement par les classes 'pokemon.php' et 'type.php'.

![Untitled](https://s3-us-west-2.amazonaws.com/secure.notion-static.com/1789833e-c7f6-46ff-9986-2dc97680a96b/Untitled.png)

# Etape 2

Application de gestion de Pokémon 

Etape 2 du projet

implémentation de la modification d’un Pokémon et de l’historique de l’accès à la data base 

## Ajout de nouvelle fonction dans le dossier Model

Pour pouvoir modifier un Pokémon et écrire les changements dans le fichier XML, j'ai créé deux nouvelles fonctions qui étaient nécessaires. Celles-ci ont été ajoutées dans un nouveau fichier appelé "model.php". Les deux fonctions sont "ecritureXML" et "modifierPokemon".

## Modification des fonctions “historisation”, “modification” et “test” dans le contrôleur

Dans le passé, les fonctions “historisation” et “modification” ne faisaient qu'afficher la vue correspondante. Maintenant, la fonction “modification” prend en entrée l'id du Pokémon choisi dans la liste déroulante de la vue modification. Ensuite, elle crée un nouveau Pokémon et appelle la fonction “modifierPokemon” qui mettra à jour le Pokémon correspondant dans la table pokemon avec les nouvelles valeurs de taille et poids renseignées dans les champs du formulaire. Une fois la modification effectuée, la fonction “ecritureXML” est appelée avec le type "modification" et le message qui contient les changements effectués. Ces changements sont maintenant sauvegardés dans le fichier XML “histo.xml”.

La fonction “historisation”, quant à elle, affiche maintenant l’heure et la description des appels à la base de données répartis en trois tableaux différents : Modifier qui affiche chaque modification avec les détails correspondants, Voir qui affiche toutes les fois où l'on est allé sur la page Test et Autre qui affiche tous les autres appels à la base de données, notamment lors de la création de la base de données.

Enfin, pour pouvoir sauvegarder chacun des passages effectués sur la page, la fonction “ecritureXML” a été ajoutée avec le type "voir" et le message qui indique qu'un passage a été enregistré.

# Etape 3

Implémentation de l’affichage des pokémons en fonction du type demandé

## Ajout de nouvelle fonction dans le dossier Model

Pour pouvoir réaliser cette implémentation, nous avons besoin de nouvelles fonctions :

- getTypes : cette fonction ne prend aucun paramètre et renvoie tous les types présents dans la base de données.
- getTypesId : cette fonction prend un paramètre id qui est l'ID du pokémon pour lequel on souhaite récupérer ses types.
- getPokemonByTypeID : cette fonction prend un paramètre id qui est l'ID du type pour lequel on souhaite récupérer tous les pokémons qui possèdent ce type. Cette méthode utilise getTypesID pour récupérer les types de chaque pokémon un par un et retourne le tableau avec toutes les informations des pokémons avec le type concerné.

## Modification de la fonction “afficher” dans le contrôleur et ajout de la fonction “afficherPokemonType”

Précédemment, la fonction “afficher” affichait uniquement le gabarit sans plus d’informations. Maintenant, cette fonction appelle la fonction getTypes du modèle pour récupérer tous les types, puis crée un formulaire qui sert à la sélection du type des pokémons que l'on souhaite afficher.

Comme pour l'étape 2, cette fonction fait un appel à la base de données, il sera donc historisé dans le fichier XML.

La nouvelle fonction afficherPokemonType prend en paramètre un ID qui sera l'ID du type pour lequel on souhaite récupérer tous les pokémons. Cette fonction appelle la fonction getPokemonByTypeID du modèle, puis crée un JSON qui est rempli des informations reçues de la fonction getPokemonByTypeID. Comme elle fait appel à la base de données, cet appel sera sauvegardé dans le fichier XML.

## Nouveau script javascript “AJAX.js”

Le script JavaScript disponible dans le dossier "Public/js" est appelé depuis la vue "Afficher" lorsqu'un type est sélectionné dans le menu déroulant.

Ce script utilise la méthode AJAX pour récupérer un JSON contenant tous les pokémons ayant le type sélectionné, sans avoir à recharger la page. Les données sont récupérées depuis le serveur via une requête HTTP, puis affichées sous forme de tableau sur la page web.

Il permet donc de récupérer les données du serveur sans avoir à recharger la page.

## Modification de l’index

La modification de l'index a été nécessaire pour pouvoir accéder à l'URL appropriée pour le script JavaScript et retrouver le JSON souhaité. Un nouveau cas a donc été ajouté dans le switch case.

Ce cas permet de vérifier si l'URL se termine par :

/?view=getTypeID&IDType=id

Si c'est le cas, on vérifie si la valeur après "view" est "getTypeID", puis on récupère l'ID du type fourni après "IDType". Si on est dans ce cas, la fonction "afficherPokemonType" est appelée avec l'ID du type récupéré, sans afficher aucune vue car ce cas est uniquement destiné à la récupération du JSON dans la page. La méthode AJAX est utilisée pour récupérer les données du serveur sans avoir besoin de recharger la page.

# Amélioration possible du projet

Le projet étant terminé, voici quelques améliorations qui pourraient être apportées à l'application :

- Ajouter des images pour chaque Pokémon, ce qui rendrait l'ergonomie et le visuel de l'application beaucoup plus agréable pour les utilisateurs, en particulier pour la page test.
- Ajouter une nouvelle page pour l'ajout manuel d'un Pokémon dans la base de données. Cela permettrait aux utilisateurs d'ajouter des informations sur des Pokémon qui ne sont pas encore référencés dans la base de données.
- Ajouter une fonctionnalité de recherche pour permettre aux utilisateurs de rechercher des Pokémon spécifiques en fonction de leurs caractéristiques telles que le nom, le type, la taille ou le poids.
- Améliorer la convivialité en ajoutant des messages d'erreur plus détaillés et en améliorant la navigation entre les pages de l'application.

Ces améliorations pourraient aider à rendre l'application encore plus conviviale et fonctionnelle pour les utilisateurs.

# Auteur

Alexandre Salgueiro Henriques De Jesus

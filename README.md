ECF ARCADIA

Le projet consiste à développer une application web pour le zoo Arcadia, situé en Bretagne, France. L'objectif est de permettre aux visiteurs de visualiser les animaux, leur état de santé, ainsi que les services et horaires du zoo. L'application reflètera les valeurs écologiques du zoo, entièrement autonome en énergie.

Deployment

Configuration de l'Environnement
PHP 8.2.12

Symfony CLI

Symfony

mySQL

MongoDB

Cloner le dépot git

Un dépot git public est associé au projet Arcadia. Pour le cloner en local, exécuter la commande :

git clone https://github.com/MARGARIDA76/Arcadia-zoo.git


Configurer les variables d'environnement


Créer le fichier .env.local Windows powershell:

ni .env.local

Dans ce fichier .env.local , ajouter les variables d'environnement: (valables uniquement pour le déploiement en local, configurer les valeurs si vous avez modifié les ports par défaut).


DATABASE_URL="mysql://root:@127.0.0.1:3307/arcadia-zoo2024?serverVersion=MiariaDB-8.2.12"
MONGODB_URL=mongodb://localhost:27017
#MAILER_DSN= voir copie 

Installer les dépendances du projet

composer install

Installer la base de donnée
Créer la base de donneés:

-Un fichier sql permettant de créer la base de données et les tables est disponible dans le dossier Documentation\SQL
-S'y positionner depuis le dossier Arcadia:

cd Documentation
cd SQL


à continuer """"""
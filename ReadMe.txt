Afin de réinstaller le site sur un serveur local UWAMP, il est nécessaire de modifier le fichier
/classes/DataBasePDO.class.php

Dans ce fichier, commenter la ligne

		$mysql_adresse="mysql:host=localhost:3306;dbname=quentin_coquerel;charset=utf8";

et décommenter la ligne 
		//$mysql_adresse="mysql:host=localhost;dbname=table;charset=utf8";
Modifier dbname avec le nom de la table utilisée en local

Par la suite, commenter les lignes 

		$mysql_user="quentin.coquerel";
		$mysql_password="UBQovgbj";

et décommenter les lignes 		

		//$mysql_user="root";
		//$mysql_password="root";

Finalement, si nécessaire, changer les valeurs de $mysql_user et $mysql_password avec les données utilisées pour accéder à la
base de données depuis localhost/mysql (par défaut les valeurs sont root/root)


Placer tous les fichiers du site dans le dossier www du dossier dans lequel se trouve l'exécutable d'UWAMP

Lancer l'exécutable UWAMP.exe

Ouvrir un navigateur, et accéder à localhost/mysql

Se connecter avec les identifiants à la base de données locale.

Cliquer sur la table utilisée par le site (celle dont le nom est placée dans dbname dans la variable $mysql_adresse)

Cliquer sur le bouton "Import"

Importer le fichier sql/crebas.sql, puis le fichier sql/donnees.sql

Le site devrait être prêt d'utilisation et fonctionnel.
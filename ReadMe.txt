Afin de réinstaller le site sur un serveur local UWAMP, il est nécessaire de modifier le fichier
/classes/DataBasePDO.class.php

Dans ce fichier, commenter la ligne

		$mysql_adresse="mysql:host=localhost:3306;dbname=quentin_coquerel;charset=utf8";

et décommenter la ligne 
		//$mysql_adresse="mysql:host=localhost;dbname=table;charset=utf8";

Par la suite, commenter les lignes 

		$mysql_user="quentin.coquerel";
		$mysql_password="UBQovgbj";

et décommenter les lignes 		

		//$mysql_user="root";
		//$mysql_password="root";

Finalement, si nécessaire, changer les valeurs de $mysql_user et $mysql_password avec les données utilisées pour accéder à la
base de données depuis localhost/mysql


Placer tous les fichiers du site dans le dossier www du dossier dans lequel se trouve l'exécutable d'UWAMP

Lancer l'exécutable UWAMP.exe

Ouvrir un navigateur, et accéder à localhost

Le site devrait être fonctionnel.
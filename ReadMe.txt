Afin de r�installer le site sur un serveur local UWAMP, il est n�cessaire de modifier le fichier
/classes/DataBasePDO.class.php

Dans ce fichier, commenter la ligne

		$mysql_adresse="mysql:host=localhost:3306;dbname=quentin_coquerel;charset=utf8";

et d�commenter la ligne 
		//$mysql_adresse="mysql:host=localhost;dbname=table;charset=utf8";
Modifier dbname avec le nom de la table utilis�e en local

Par la suite, commenter les lignes 

		$mysql_user="quentin.coquerel";
		$mysql_password="UBQovgbj";

et d�commenter les lignes 		

		//$mysql_user="root";
		//$mysql_password="root";

Finalement, si n�cessaire, changer les valeurs de $mysql_user et $mysql_password avec les donn�es utilis�es pour acc�der � la
base de donn�es depuis localhost/mysql (par d�faut les valeurs sont root/root)


Placer tous les fichiers du site dans le dossier www du dossier dans lequel se trouve l'ex�cutable d'UWAMP

Lancer l'ex�cutable UWAMP.exe

Ouvrir un navigateur, et acc�der � localhost/mysql

Se connecter avec les identifiants � la base de donn�es locale.

Cliquer sur la table utilis�e par le site (celle dont le nom est plac�e dans dbname dans la variable $mysql_adresse)

Cliquer sur le bouton "Import"

Importer le fichier sql/crebas.sql, puis le fichier sql/donnees.sql

Le site devrait �tre pr�t d'utilisation et fonctionnel.
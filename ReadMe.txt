Afin de r�installer le site sur un serveur local UWAMP, il est n�cessaire de modifier le fichier
/classes/DataBasePDO.class.php

Dans ce fichier, commenter la ligne

		$mysql_adresse="mysql:host=localhost:3306;dbname=quentin_coquerel;charset=utf8";

et d�commenter la ligne 
		//$mysql_adresse="mysql:host=localhost;dbname=table;charset=utf8";

Par la suite, commenter les lignes 

		$mysql_user="quentin.coquerel";
		$mysql_password="UBQovgbj";

et d�commenter les lignes 		

		//$mysql_user="root";
		//$mysql_password="root";

Finalement, si n�cessaire, changer les valeurs de $mysql_user et $mysql_password avec les donn�es utilis�es pour acc�der � la
base de donn�es depuis localhost/mysql


Placer tous les fichiers du site dans le dossier www du dossier dans lequel se trouve l'ex�cutable d'UWAMP

Lancer l'ex�cutable UWAMP.exe

Ouvrir un navigateur, et acc�der � localhost

Le site devrait �tre fonctionnel.
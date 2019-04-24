
    
        <?php 
        
            foreach($resultats as $resultat){
				
				
				
				echo"<div class=\"questionnaire \" >";
                echo "<div class=\"classement\">". $resultat['classement'] . ". ".$resultat['login']." </div>";
                echo "<div>Prenom: ". $resultat['prenom'] ." Nom: ". $resultat['nom'] ." </div>";
                echo "<div>Résultat: ". $resultat['valeur']." sur ". $noteMax ." </div>";
                
				
				echo "</div>";
				
				
            }
        
        ?>

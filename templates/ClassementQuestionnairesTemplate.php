
    
        <?php 
        
            foreach($resultats as $resultat){
				
				
				
				echo"<div class=\"questionnaire \" >";
                echo "<div class=\"classement\">". $resultat['classement'] . ". ".$resultat['login']." </div>";
                echo "<div>Prenom: ". $resultat['prenom'] ." Nom: ". $resultat['nom'] ." </div>";
                echo "<div>Note: ". $resultat['valeur']." sur ". $noteMax ." </div>";
				echo "</div>";
				
				
            }
        
        ?>

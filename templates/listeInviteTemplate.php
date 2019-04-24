
        <?php 
        
            foreach($invites as $invite){
				
				
				echo"<div class=\"questionnaire \" >";
                echo "<div>Prenom: ". $invite['prenom'] ." Nom: ". $invite['nom'] ." </div>";
                echo "<div>Email: ". $invite['email'] ." </div>";
				if($invite['note']!=""){
                echo "<div>Note: ". $invite['note']." sur ". $noteMax ." </div>";}
				else{
					echo "<div> cette utilisateur n'a pas encore répondu au questionnaire</div>";
				}
				echo "</div>";
				
				
            }
        
        ?>



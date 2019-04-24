
<?php echo"<h2 class=\"h2_centre\">". $nomDePage .'</h2>'   ?>


        <?php 
        
            foreach($questionnaires as $questionnaire){
				if($questionnaire['dateOuverture']!=""){
					$dateStringO=substr($questionnaire['dateOuverture'],-2,2).'-'.substr($questionnaire['dateOuverture'],5,2).'-'.substr($questionnaire['dateOuverture'],0,4);
				}
				else{
					$dateStringO = "";
				}
				if($questionnaire['dateFermeture']!=""){
					$dateStringF=substr($questionnaire['dateFermeture'],-2,2).'-'.substr($questionnaire['dateFermeture'],5,2).'-'.substr($questionnaire['dateFermeture'],0,4);
				}
				else{
					$dateStringF = "";
				}
				
				echo "<div class=\"questionnaire\">";
                echo "<button class=\"btn bouton_col_ens\" type=\"button\" data-toggle=\"collapse\" data-target=\"#collapseExample".$questionnaire['id']."\" aria-expanded=\"false\" aria-controls=\"collapseExample\">"
				.$questionnaire['titre']."</button>" ;
				 echo "</div>";
				echo"<div class=\"nomQuestionnaire collapse\" id=\"collapseExample".$questionnaire['id']."\">";
                echo "<div class=\"description\"><a class=\"descriptionQuestionnaire\">Description :";
                echo $questionnaire['description'];
                echo "</a></div>";
				echo "<div class=\"date\"><span class=\"dateOuverture\">Date d'Ouverture: ".$dateStringO."</span>
                    <span class=\"dateFermeture\">Date de Fermeture: ".$dateStringF ."</span>
                    </div>";
                echo "<div class=\"etat\">Etat: ". $questionnaire['etat'] ." </div>";
                echo "<div class=\"createur\">Createur: ". $questionnaire['createur'] ." </div>";
                echo "<div class=\"boutons\">
				<form action=\"index.php?action=repondreQuiz&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Répondre'></form>
				";
				
				echo "</div></div>";
				
            }
        
        ?>


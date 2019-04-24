
        <?php 
        
            foreach($questionnaires as $questionnaire){
				
				
				echo "<div class=\"questionnaire\">";
                echo "<button class=\"btn bouton_col_ens\" type=\"button\" data-toggle=\"collapse\" data-target=\"#collapseExample".$questionnaire['id']."\" aria-expanded=\"false\" aria-controls=\"collapseExample\">"
				.$questionnaire['titre']."</button>" ;
				 echo "</div>";
				echo"<div class=\"nomQuestionnaire collapse\" id=\"collapseExample".$questionnaire['id']."\">";
                echo "<div class=\"description\"><a class=\"descriptionQuestionnaire\">Description :";
                echo $questionnaire['description'];
                echo "</a></div>";
                echo "<div class=\"etat\">Etat: ". $questionnaire['etat'] ." </div>";
                echo "<div class=\"createur\">Createur: ". $questionnaire['createur'] ." </div>";
                echo "<div class=\"note\">Note: ". $questionnaire['note']." sur ". $questionnaire['noteMax'] ." </div>";
				if($questionnaire['corrige']==1){
					echo "<div>Ce questionnaire n'a pas encore été totalement corrigé </div>";
				}
                echo "<div class=\"boutons\">
				<form action=\"index.php?action=classementQuiz&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Classement'></form>
				";
				
				echo "</div></div>";
				
				
            }
        
        ?>
<!--
<table>

    <thead>
    
        <tr>
            <th>TITRE</th>
            <th>DESCRIPTION</th>
            <th>DATE OUVERTURE</th>
            <th>DATE FERMETURE</th>
            <th>CONNEXION REQUISE</th>
            <th>ETAT</th>
            <th>URL</th>
           
        </tr>
    </thead>

    <tbody>
    -->
        <?php 

            foreach($questionnaires as $questionnaire){
                echo "<div class=\"questionnaire\"><div class=\"nomQuestionnaire\">";
                echo "<a>".$questionnaire['titre']."</a>" ;
                echo "<div class=\"description\"><a class=\"descriptionQuestionnaire\">Description :";
                echo $questionnaire['description'];
                echo "</a></div>";
                    echo "<div class=\"date\"><span class=\"dateOuverture\">Date d'Ouverture: ".$questionnaire['dateOuverture']."</span>
                    <span class=\"dateFermeture\">Date de Fermeture: ".$questionnaire['dateFermeture'] ."</span>
                    </div>";
                echo "<div class=\"etat\">Etat: ". $questionnaire['etat'] ." </div>";
                echo "<div class=\"boutons\">
                <form action=\"index.php?action=modifierQuestionnaire&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Modifier Questions'></form>";
                
                if ($questionnaire['aCorriger']==1){
                    echo "<form action=\"index.php?action=corrigerQuestionnaire&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Corriger'></form>";
                }
                else{
                    echo "<form action=\"index.php?action=classementQuiz&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Classement'></form>";
                }
                echo "<form action=\"index.php?action=inviterQuiz&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Inviter'></form>
                <form action=\"index.php?action=voirInviterQuiz&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Voir invités'></form>
                ";


                echo "</div>";

                echo "</div></div>";
                
                
                /*echo "<th><form action=\"index.php?action=modifierQuestionnaire&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Modifier Questions'></form></th>";
                if($questionnaire['aCorriger']==1){                
                    echo "<th><form action=\"index.php?action=corrigerQuestionnaire&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Corriger'></form></th>";
                }
                echo "<th><form action=\"index.php?action=classementQuiz&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Classement'></form></th>
                ";
				if($questionnaire['etat']=='Prive'){
				echo "<th><form action=\"index.php?action=inviterQuiz&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Inviter'></form></th>";
                echo "<th><form action=\"index.php?action=voirInviterQuiz&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Voir invités'></form></th>";
                }*/

            }
        
        ?>
<!--
    </tbody>

</table>
        -->




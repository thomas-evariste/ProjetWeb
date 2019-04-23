
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
            <th>CREATEUR</th> <!-- Laissé pour débuggage -->
        </tr>
    </thead>

    <tbody>
    
        <?php 

            foreach($questionnaires as $questionnaire){
                echo "<tr>   
                <th>" . $questionnaire['titre'] ." </th>
                <th>" . $questionnaire['description']."</th>
                <th>" . $questionnaire['dateOuverture'] ."</th>
                <th>" . $questionnaire['dateFermeture'] ."</th>
                <th>" . $questionnaire['connexionRequise'] ."</th>
                <th>" . $questionnaire['etat'] ."</th>
                <th>" . $questionnaire['url'] ."</th>
                <th>" . $questionnaire['createur'] ."</th>  
                <th><form action=\"index.php?action=modifierQuestionnaire&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Modifier Questions'></form></th>";
                if($questionnaire['aCorriger']==1){                
                    echo "<th><form action=\"index.php?action=corrigerQuestionnaire&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Corriger'></form></th>";
                }
                echo "<th><form action=\"index.php?action=classementQuiz&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Classement'></form></th>
                ";
				if($questionnaire['etat']=='Prive'){
				echo "<th><form action=\"index.php?action=inviterQuiz&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Inviter'></form></th>";
                echo "<th><form action=\"index.php?action=voirInviterQuiz&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Voir invités'></form></th>";
                }
				echo "</tr>";
            }
        
        ?>

    </tbody>

</table>





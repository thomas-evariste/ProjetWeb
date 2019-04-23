
<?php echo'<h2>'. $nomDePage .'</h2>'   ?>

<table class='table_espacee'>

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
                <th><form action=\"index.php?action=repondreQuiz&controller=user\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Répondre'></form></th>
                </tr>";
            }
        
        ?>

    </tbody>

</table>





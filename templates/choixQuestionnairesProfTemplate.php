
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
                echo "<tr>   
                <th>" . $questionnaire['titre'] ." </th>
                <th>" . $questionnaire['description']."</th>
                <th>" . $dateStringO ."</th>
                <th>" . $dateStringF ."</th>
                <th>" . $questionnaire['connexionRequise'] ."</th>
                <th>" . $questionnaire['etat'] ."</th>
                <th>" . $questionnaire['url'] ."</th>
                <th>" . $questionnaire['createur'] ."</th> 
                <th><form action=\"index.php?action=repondreQuiz&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Repondre'></form></th>
                </tr>";
            }
        
        ?>

    </tbody>

</table>






<table>

    <thead>
    
        <tr>
            <th>TITRE</th>
            <th>DESCRIPTION</th>
            <th>ETAT</th>
            <th>CREATEUR</th>
            <th>NOTE</th> 
        </tr>
    </thead>

    <tbody>
    
        <?php 
        
            foreach($questionnaires as $questionnaire){
                echo "<tr>   
                <th>" . $questionnaire['titre'] ." </th>
                <th>" . $questionnaire['description']."</th>
                <th>" . $questionnaire['etat'] ."</th>
                <th>" . $questionnaire['createur'] ."</th> 
                <th>" . $questionnaire['note'] ."</th> 
				<th><form action=\"index.php?action=repondreQuiz&controller=user\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Repondre'></form></th>
                </tr>";
            }
        
        ?>

    </tbody>

</table>





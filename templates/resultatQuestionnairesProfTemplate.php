
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
                <th>" . $questionnaire['note']." sur ". $questionnaire['noteMax'] ."</th> 
				<th><form action=\"index.php?action=classementQuiz&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Classement'></form></th>
                </tr>";
				
				if($questionnaire['corrige']==1){
					echo "<tr>  <th colspan='4'> ce questionnaire n'a pas encore été totalement corrigé </th></tr>";
				}
            }
        
        ?>

    </tbody>

</table>

<table>

    <thead>
    
        <tr>
            <th>Classement</th>
            <th>Pseudo</th>
            <th>Prenom</th>
            <th>Nom</th>
            <th>Note</th> 
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
                 </tr>";
            }
        
        ?>

    </tbody>

</table>
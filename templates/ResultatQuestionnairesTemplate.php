
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
                 </tr>";
            }
        
        ?>

    </tbody>

</table>





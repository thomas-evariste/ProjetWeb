
<table>

    <thead>
    
        <tr>
            <th>PRENOM</th>
            <th>NOM</th>
            <th>EMAIL</th>
            <th>NOTE</th> 
        </tr>
    </thead>

    <tbody>
    
        <?php 
        
            foreach($invites as $invite){
                echo "<tr>   
                <th>" . $invite['prenom'] ." </th>
                <th>" . $invite['nom']."</th>
                <th>" . $invite['email'] ."</th>"
              //  <th>" . $invite['note'] ."</th> 
				."</tr>";
				
            }
        
        ?>

    </tbody>

</table>



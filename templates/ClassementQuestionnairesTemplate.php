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
        
            foreach($resultats as $resultat){
				
                echo "<tr>   
                <th>" . $resultat['classement'] ." </th>
                <th>" . $resultat['login']."</th>
                <th>" . $resultat['prenom'] ."</th>
                <th>" . $resultat['nom'] ."</th> 
                <th>" . $resultat['valeur']." sur ". $noteMax ."</th> 
                 </tr>";
            }
        
        ?>

    </tbody>

</table>
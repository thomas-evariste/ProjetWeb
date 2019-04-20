<script>

    function validerReponse(idReponse,idUser){
        var dataAJAX = {};
        dataAJAX['idReponse']=idReponse;
        dataAJAX['idUser']=idUser;
        dataAJAX['answerValue']=1;
        $.ajax({
                type:'POST',
                url:'index.php?action=corrigerQuestion&controller=Prof',
                data:dataAJAX,
                }).done(function(data){
                    alert(data);
                })
    }

    function invaliderReponse(idReponse,idUser){
        var dataAJAX = {};
        dataAJAX['idReponse']=idReponse;
        dataAJAX['idUser']=idUser;
        dataAJAX['answerValue']=0;
        $.ajax({
                type:'POST',
                url:'index.php?action=corrigerQuestion&controller=Prof',
                data:dataAJAX,
                }).done(function(data){
                    alert(data);
                })
    }


</script>


<table id="questionList">
<!--
    <thead id="questionListHead">
    
        <tr>
            <th>ID</th>
            <th>TYPE</th>
            <th>INTITULE</th>
        </tr>
    </thead>
-->
    <tbody id="questionListBody">
    
        <?php 
            $i = 0;

            foreach($questions as $question){
                echo "<ul class=\"intituleQuestion\">".  
                //<th>" . $question['id'] ." </th>
                //<th>" . $question['type']."</th>
                "<li>" . $question['intitule'] ."</li>";
                echo "<ul class=\"reponseQO\">";
                foreach($reponses[$i] as $reponse){
                    echo "<li><a>". $reponse['intitule'] . "</a></li>";
                    echo "<input type='submit' value='Réponse valide' onclick='validerReponse(".$reponse['id'].", ".$reponse['id_user'].")'>";
                    echo "<input type='submit' value='Mauvaise réponse' onclick='invaliderReponse(".$reponse['id'].", ".$reponse['id_user'].")'>";
                }
                echo "</ul>";
                echo "</ul>";

                //<th><form action=\"index.php?action=modifierQuestion&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$question['id']."'><input type='submit' value='Modifier'></form></th>

                $i++;
            }
        
        ?>

    </tbody>

</table>

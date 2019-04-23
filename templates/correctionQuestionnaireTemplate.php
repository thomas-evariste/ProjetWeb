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
                    $("#reponse"+idReponse).attr('class', 'ReponseCorrecte');
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
                    $("#reponse"+idReponse).attr('class', 'ReponseFausse');
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
        $compte = 0;
            foreach($questionnaire->getQuestions() as $question){
                if (sizeof($question->getReponses())>0){
                    echo "<ul class=\"intituleQuestion\">".  
                    //<th>" . $question['id'] ." </th>
                    //<th>" . $question['type']."</th>
                    "<li>" . $question->getIntitule() ."</li>";
                    echo "<ul class=\"reponseQO\">";
                    foreach($question->getReponses() as $reponse){
                        echo "<li><a id=\"reponse".$reponse->getId()."\">". $reponse->getIntitule() . "</a></li>";
                        echo "<input type='submit' value='Réponse valide' onclick='validerReponse(".$reponse->getId().", ".$reponse->getIdUser().")'>";
                        echo "<input type='submit' value='Mauvaise réponse' onclick='invaliderReponse(".$reponse->getId().", ".$reponse->getIdUser().")'>";
                    }
                    echo "</ul>";
                    echo "</ul>";
                    $compte=$compte+1;
                    //<th><form action=\"index.php?action=modifierQuestion&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$question['id']."'><input type='submit' value='Modifier'></form></th>
                }
            }
            if ($compte == 0){
                echo "<div>Il n'y a aucune question à corriger !</div>";
            }
        
        ?>

    </tbody>

</table>

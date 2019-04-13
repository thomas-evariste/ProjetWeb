<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<?php 

echo $questionnaireId; 

?>


<table>

    <thead>
    
        <tr>
            <th>ID</th>
            <th>TYPE</th>
            <th>INTITULE</th>
        </tr>
    </thead>

    <tbody>
    
        <?php 
        
            foreach($questions as $question){
                echo "<tr>   
                <th>" . $question['id'] ." </th>
                <th>" . $question['type']."</th>
                <th>" . $question['intitule'] ."</th>
                <th><form action=\"index.php?action=modifierQuestionnaire&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$question['id']."'><input type='submit' value='Modifier'></form></th>
                </tr>";
            }
        
        ?>

    </tbody>

</table>

<script>

    var questionEnCours=false;
    var nbRep = 0;

    function creerQuestion(selecter){
        removeElement("question");
        removeElement("selecter");
        addElement("Form","input","intitule","",{"type":"text","name":"intitule","class":"form-control input_user","placeholder":"Entrez intitulé"});
        if(selecter.value!="QO"){
            if(selecter.value=="QCM"){
                addElement("Form","button","addReponse","Ajouter Réponse",{"type":"button","onclick":"ajouterReponse(\"Form\");"});
            }
            if(selecter.value=="QCU"){
                addElement("Form","button","addReponse","Ajouter Réponse",{"type":"button","onclick":"ajouterReponseQCU(\"Form\");"});
            }
        }
        addElement("Form","input","bareme","",{"type":"number","name":"bareme","class":"form-control input_user","placeholder":"Entrez barème","min":0,"max":10, "step":0.1})
        $('#Form').append("<input id=\"submitButton\" type=\"button\" value=\"Send\">");
        $('#submitButton').click(function(){
            validateQuestion();
        });
        questionEnCours=selecter.value;
    }

    function validateQuestion(){
        var dataAJAX = {};
        var checked = $("#Form input:checked").length>0;
        var erreurPresente=false;
        var reponseList = [];
        $("#Error").empty();
        if ($('#intitule').val().trim() == "" || $('#intitule').val().length > 100){
            $("#Error").append("<p>Merci de ne pas excéder 100 caractères et de ne pas laisser l'intitulé de la question vide</p>")
            erreurPresente=true;
        }
        for (var i=0;i<nbRep;i++){
            if ($('#rep'+i).val().trim() == "" || $('#rep'+i).val().length >100){
                $("#Error").append("<p>L'intitulé de la réponse " + (i+1) + " est vide ou excède 100 caractères</p>");
                erreurPresente=true;
            }
        }
        if(questionEnCours!="QO"){
            if (!checked){
                $("#Error").append("<p>Merci de sélectionner au moins une bonne réponse</p>")
                erreurPresente=true;
            }
        }
        if(isNaN(bareme.value)){
            $("#Error").append("<p>Merci d'insérer un barème de type numérique</p>");
            erreurPresente=true;
        }
        if(!erreurPresente){
            dataAJAX['intitule_question']=($('#intitule').val());
            dataAJAX['bareme_question']=($('#bareme').val());
            dataAJAX['type_question']=questionEnCours;
            dataAJAX['idQuestionnaire']=<?=$questionnaireId?>;
            dataAJAX['nbRep']=nbRep;
            if (questionEnCours!="QO"){
                for (var i=0;i<nbRep;i++){
                    dataAJAX['rep'+i]=$('#rep'+i).val();
                    if (questionEnCours=="QCM"){
                        if ($('#repCorrecteCheckBox'+i).prop('checked')){
                            dataAJAX['repCorrecte'+i]=$('#repCorrecteCheckBox'+i).val();
                        }
                        else{
                            dataAJAX['repCorrecte'+i]=0;
                        }
                    }
                    if (questionEnCours=="QCU"){
                        if ($('#repCorrecteRadioBox'+i).prop('checked')){
                            dataAJAX['repCorrecte'+i]=$('#repCorrecteRadioBox'+i).val();
                        }
                        else{
                            dataAJAX['repCorrecte'+i]=0;
                        }                    
                    }
                }
            }            
            alert((dataAJAX));
            $.ajax({
                type:'POST',
                url:'index.php?action=insertionQuestion&controller=Prof',
                data:dataAJAX,
                }).done(function(data){
                    alert("data saved" + data);
                })
        }
        return false;
    }

    function ajouterReponseQCU(question){
        var val = nbRep;
        addElement(question,"input","rep"+nbRep,"",{"type":"text","name":"rep"+nbRep,"class":"form-control input_user","placeholder":"Entrez intitulé"})
        addElement(question,"input","repCorrecteRadioBox"+nbRep,"",{"type":"radio","name":"repCorrecteRadioBox"+nbRep,"class":"form-control input_user","value":"1"})
        document.getElementById('repCorrecteRadioBox'+nbRep).onchange = function(){
            decocherRadioBoxes(val);
        }
        nbRep=nbRep+1;
    }

    function ajouterReponse(question,r){
        addElement(question,"input","rep"+nbRep,"",{"type":"text","name":"rep"+nbRep,"class":"form-control input_user","placeholder":"Entrez intitulé"})
        addElement(question,"input","repCorrecteCheckBox"+nbRep,"",{"type":"checkbox","name":"repCorrecteRadioBox"+nbRep,"class":"form-control input_user","value":"1"})
        nbRep=nbRep+1;
    }


    function decocherRadioBoxes(reponseId){
        for (var i=0;i<nbRep;i++){
            if (i!=reponseId){
                document.getElementById('repCorrecteRadioBox'+i).checked=false;
            }
        }
    }
    
    function addElement(parentId,elementTag,elementId,html,elementAttributes=Object()){
        var p = document.getElementById(parentId);
        var newElement = document.createElement(elementTag);
        newElement.setAttribute('id',elementId);
        newElement.innerHTML=html;
        for (var i in elementAttributes){
            newElement.setAttribute(i, elementAttributes[i]);
        }
        p.insertBefore(newElement,p.validateButton);
    }

    function removeElement(elementId) {
        // Removes an element from the document
        var element = document.getElementById(elementId);
        element.parentNode.removeChild(element);
    }

    $(document).ready(function() {
        $('#addlinkbtn').click(function(e) {
            if (!questionEnCours){
                questionEnCours=true;
                addQuestionIn($('#Linking'));
            }
            else{
                alert("Merci de valider la dernière question avant d'en créer une nouvelle");
            }
        });
    });

    function addQuestionIn($elem){
        $elem.append($('<select id="question" "size="3"><option value="QCM">QCM</option><option value="QCU">QCU</option><option value="QO">Question ouverte</option></select>'));
        $elem.append($('<th /><td><input id="selecter" type="submit" value="Valider type" /></td>'));
        document.getElementById('selecter').onclick = function(){
            creerQuestion(document.getElementById('question'));
        }
    }


</script>

<button id="addlinkbtn">Add Question</button>

<form id="Form" method="post" onsubmit="validateQuestion();return false"></form>

<ul id="Linking"></ul>

<div id="Error"></div>

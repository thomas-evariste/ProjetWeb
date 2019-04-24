<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    
        <?php 
		
		
            echo "<div id=\"listeQuestion\">";
            foreach($questionnaire->getQuestions() as $question){
                $idQuestion = $question->getId();
                echo "<div class=\"questionnaire niveau2\">";
				echo "<button class=\"btn bouton_col_ens\" type=\"button\" data-toggle=\"collapse\" data-target=\"#collapseExample".$idQuestion."\" aria-expanded=\"false\" aria-controls=\"collapseExample\">";
                echo "<div id=\"question".$idQuestion."\"><a id=\"intitule".$idQuestion."\">" 
				. $question->getIntitule() 
				."</a><button class=\"suppression\" onclick=supprimerQuestion(".$idQuestion.")></button>"
				."<button class=\"modification\" onclick=modifierQuestion(".$idQuestion.")></button>";
				echo "</div>";
				echo "</button>";
                echo "<div class=\"niveau3\">";
				echo"<div class=\"nomQuestionnaire collapse\" id=\"collapseExample".$idQuestion."\">";
                foreach($question->getReponses() as $reponse){
                    if($question->getType()=="QCM" | $question->getType()=="QCU" ){
                        $r = $reponse->getId();
                        echo "<div id=\"reponse".$r."Question".$idQuestion."\"><div style=\"margin:0;display:flex\"><a id=\"intituleRep".$r."\" class=\"" .($reponse->getReponseCorrecte() ? "ReponseCorrecte":"ReponseFausse") ."\" >". $reponse->getIntitule() ."</a><button class=\"suppression\" onclick=supprimerReponse(".$r.",".$idQuestion.")></button><button class=\"modification\" onclick=modifierReponse(".$r.",".$idQuestion.",&quot;".($reponse->getReponseCorrecte() ? "ReponseCorrecte":"ReponseFausse") ."&quot;)></button></div></div>";
                    }
                }
                echo "</div>";
                echo "</div>";
                

            }
            echo "</div>";
        ?>



<script>

    var questionEnCours=false;
    var nbRep = 0;
    var nbTag=0;
    var idQuestionL = <?=Question::createId()?>;
    var idReponseL = <?=Reponse::createId()?>;

    function supprimerQuestionDecrement(idQuestion){
        supprimerQuestion(idQuestion);
        idQuestionL=idQuestionL-1;
    }

    function supprimerQuestion(idQuestion){
        var dataAJAX = {};
        dataAJAX['idQuestion']=idQuestion;
        $.ajax({
                type:'POST',
                url:'index.php?action=suppressionQuestion&controller=Prof',
                data:dataAJAX,
                }).done(function(data){
                    removeElement("question"+idQuestion);
                    $('#Error').html("La question a été supprimée avec succès !");
                });
    }

    function supprimerReponse(idReponse,idQuestion){
        var dataAJAX = {};
        dataAJAX['idReponse']=idReponse;
        $.ajax({
            type:'POST',
            url:'index.php?action=suppressionReponse&controller=Prof',
            data:dataAJAX,
            }).done(function(data){
                removeElement("reponse"+idReponse+"Question"+idQuestion);
                $('#Error').html("La réponse a été supprimée avec succès !");
            });
    }

    function modifierNvleQuestion(idQuestion){
        intitule = $('#question'+idQuestion).children().first().children().first().html();
        $('#question'+idQuestion).children().first().remove();
        $('#question'+idQuestion).prepend("<div id=\"modifDivQuestion"+idQuestion +"\"><input type=\"text\" class=\"modificationForm\" id=\"modifier"+idQuestion+"\" value=\""+intitule+"\"><button class=\"validerChangement\" onclick=\"validerModificationQuestion("+idQuestion+")\"></button><button class=\"annulerChangement\" onclick=\"annulerModificationNvleQuestion("+idQuestion+",&quot;"+intitule+"&quot;)\"></button></div>");
    }

    function modifierQuestion(idQuestion){
        intitule = $('#question'+idQuestion).children().first().children().first().html();
        $('#question'+idQuestion).children().first().remove();
        $('#question'+idQuestion).prepend("<div id=\"modifDivQuestion"+idQuestion +"\"><input type=\"text\" class=\"modificationForm\" id=\"modifier"+idQuestion+"\" value=\""+intitule+"\"><button class=\"validerChangement\" onclick=\"validerModificationQuestion("+idQuestion+")\"></button><button class=\"annulerChangement\" onclick=\"annulerModificationQuestion("+idQuestion+",&quot;"+intitule+"&quot;)\"></button></div>");

    }

    function modifierReponse(idReponse,idQuestion,classe){
        intitule=$('#reponse'+idReponse+'Question'+idQuestion).children().first().children().first().html();
        $('#reponse'+idReponse+'Question'+idQuestion).children().first().remove();
        $('#reponse'+idReponse+'Question'+idQuestion).prepend("<div id=\"modifDivRep"+ idReponse +"\"><input type=\"text\" class=\"modificationForm\" id=\"modifierReponse"+idReponse+"\" value=\""+intitule+"\"><button class=\"validerChangement\" onclick=\"validerModificationReponse("+idReponse+","+idQuestion+",&quot;"+classe+"&quot;)\"></button><button class=\"annulerChangement\" onclick=\"annulerModificationReponse("+idQuestion+","+idReponse+",&quot;"+intitule+"&quot;,&quot;"+classe+"&quot;)\"></button></div>");
        
    }

    function validerModificationQuestion(idQuestion){
        var dataAJAX = {};
        dataAJAX['intituleQuestion']= $('#modifier'+idQuestion).val();
        dataAJAX['idQuestion']=idQuestion;
        $.ajax({
            type:'POST',
            url:'index.php?action=modifierQuestion&controller=Prof',
            data:dataAJAX,
            }).done(function(data){
                removeElement('modifDivQuestion'+idQuestion);
                $('#question'+idQuestion).prepend("<div style=\"margin:0;display:flex\"><a id=\"intitule"+idQuestion+"\">" + dataAJAX['intituleQuestion'] +"</a><button class=\"suppression\" onclick=supprimerQuestion("+idQuestion+")></button><button class=\"modification\" onclick=modifierQuestion("+idQuestion+")></button></div>");
            });
    }

    function validerModificationReponse(idReponse,idQuestion,classe){
        var dataAJAX = {};
        dataAJAX['intituleReponse']= $('#modifierReponse'+idReponse).val();
        dataAJAX['idReponse']=idReponse;
        $.ajax({
            type:'POST',
            url:'index.php?action=modifierReponse&controller=Prof',
            data:dataAJAX,
            }).done(function(data){
                removeElement('modifDivRep'+idReponse);
                $('#reponse'+idReponse+'Question'+idQuestion).prepend("<div style=\"margin:0;display:flex\"><a id=\"intituleRep"+ idReponse+"\" class=\"" + classe +"\" >" + dataAJAX['intituleReponse'] +"</a><button class=\"suppression\" onclick=supprimerReponse("+idReponse+","+idQuestion+")></button><button class=\"modification\" onclick=modifierReponse("+idReponse+","+idQuestion+",&quot;"+classe+"&quot;)></button></div>");
            });
    }

    function annulerModificationNvleQuestion(idQuestion,intitule){
        $('#question'+idQuestion).children().first().remove();
        $('#question'+idQuestion).prepend("<div style=\"margin:0;display:flex\"><a id=\"intitule"+idQuestion+"\">" +intitule +"</a><button class=\"suppression\" onclick=supprimerQuestionDecrement("+idQuestion+")></button><button class=\"modification\" onclick=modifierNvleQuestion("+idQuestion+")></button></div>");
    }

    function annulerModificationQuestion(idQuestion,intitule){
        $('#question'+idQuestion).children().first().remove();
        $('#question'+idQuestion).prepend("<div style=\"margin:0;display:flex\"><a id=\"intitule"+idQuestion+"\">" +intitule +"</a><button class=\"suppression\" onclick=supprimerQuestion("+idQuestion+")></button><button class=\"modification\" onclick=modifierQuestion("+idQuestion+")></button></div>");
    }

    function annulerModificationReponse(idQuestion,idReponse,intitule,classe){
        $('#reponse'+idReponse+'Question'+idQuestion).children().first().remove();
        $('#reponse'+idReponse+'Question'+idQuestion).prepend("<div style=\"margin:0;display:flex\"><a class=\"" + classe +"\" >"+ intitule +"</a><button class=\"suppression\" onclick=supprimerReponse("+idReponse+","+idQuestion+")></button><button class=\"modification\" onclick=modifierReponse("+idReponse+","+idQuestion+",&quot;"+classe+"&quot;)></button></div>");
    }

    function creerQuestion(selecter){
        removeElement("question");
        removeElement("selecter");
        addElement("Form","input","intitule","",{"type":"text","name":"intitule","class":"form-control input_user","placeholder":"Entrez intitulé"});
        addElement("Form","input","bareme","",{"type":"number","name":"bareme","class":"form-control input_user","placeholder":"Entrez barème","min":0,"max":10, "step":0.1})
        addElement("Form","div","tagList","Tags de la question :",{"class":"tagList"});
        addElement("Form","div","answerList","Réponses possibles :",{"class":"answerList"});
        addElement("Form","div","buttonList","",{"class":"buttonList"});
        addElement("buttonList","button","addTag","Ajouter Tag",{"type":"button","onclick":"ajouterTag(\"tagList\");"});
        if(selecter.value!="QO"){
            if(selecter.value=="QCM"){
                addElement("buttonList","button","addReponse","Ajouter Réponse",{"type":"button","onclick":"ajouterReponse(\"answerList\");"});
            }
            if(selecter.value=="QCU"){
                addElement("buttonList","button","addReponse","Ajouter Réponse",{"type":"button","onclick":"ajouterReponseQCU(\"answerList\");"});
            }
        }
        $('#buttonList').append("<input id=\"submitButton\" type=\"button\" value=\"Send\">");
        $('#submitButton').click(function(){
            validateQuestion();
        });
        questionEnCours=selecter.value;
    }
    
    function ajouterTag(element){
        addElement(element,"input","tag"+nbTag,"",{"type":"text","name":"tag"+nbTag,"class":"form-control input_user","placeholder":"Entrez tag"});
        nbTag=nbTag+1;
    }

    function isNumber(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }



    function validateQuestion(){
        
        var dataAJAX = {};
        var checked = $("#Form input:checked").length>0;
        var erreurPresente=false;
        var reponseList = [];
        var reponseCorrecte=[];
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
        for (var i=0;i<nbTag;i++){
            if ($('#tag'+i).val().trim() == "" || $('#tag'+i).val().length >50){
                $("#Error").append("<p>L'intitulé du tag " + (i+1) + " est vide ou excède 50 caractères</p>");
                erreurPresente=true;
            }
        }
        if(questionEnCours!="QO"){
            if (!checked){
                $("#Error").append("<p>Merci de sélectionner au moins une bonne réponse</p>")
                erreurPresente=true;
            }
        }
        if(!isNumber($('#bareme').val())){
            $("#Error").append("<p>Merci d'insérer un barème de type numérique</p>");
            erreurPresente=true;
        }
        else{
            if($('#bareme').val() > 1000){
                $("#Error").append("<p>Merci d'insérer un barème, qui est de valeur inférieure à 1000</p>");
                erreurPresente=true;
            }
        }
        
        if(!erreurPresente){
            dataAJAX['intitule_question']=($('#intitule').val());
            dataAJAX['bareme_question']=($('#bareme').val());
            dataAJAX['type_question']=questionEnCours;
            dataAJAX['idQuestionnaire']=<?=$questionnaire->getId()?>;
            dataAJAX['nbRep']=nbRep;
            dataAJAX['nbTag']=nbTag;
            for (var j=0;j<nbTag;j++){
                dataAJAX['tag'+j] = $('#tag'+j).val();
            }
            if (questionEnCours!="QO"){
                for (var i=0;i<nbRep;i++){
                    dataAJAX['rep'+i]=$('#rep'+i).val();
                    if (questionEnCours=="QCM"){
                        if ($('#repCorrecteCheckBox'+i).prop('checked')){
                            dataAJAX['repCorrecte'+i]=$('#repCorrecteCheckBox'+i).val();
                            reponseCorrecte[i]="ReponseCorrecte";
                        }
                        else{
                            dataAJAX['repCorrecte'+i]=0;
                            reponseCorrecte[i]="ReponseFausse";
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
            $.ajax({
                type:'POST',
                url:'index.php?action=insertionQuestion&controller=Prof',
                data:dataAJAX,
                }).done(function(data){
                    $('#Error').append("La question a été ajoutée avec succès ! Si vous voulez modifier les réponses, merci d'actualiser la page");
                    $('#listeQuestion').append("<ul class=\"niveau2\"><li id=\"question"+idQuestionL+"\"><div style=\"margin:0;display:flex\"><a id=\"intitule"+idQuestionL+"\">"+($('#intitule').val())+"</a><button class=\"suppression\" onclick=supprimerQuestionDecrement("+idQuestionL+")></button><button class=\"modification\" onclick=modifierNvleQuestion("+idQuestionL+")></button></div><ul id=\"reponsesList"+idQuestionL+"\" class=\"niveau3\"></ul></li></ul>");
                    for(var i=0;i<nbRep;i++){
                        $('#reponsesList'+idQuestionL).append("<li id=\"reponse"+idReponseL+"Question"+idQuestionL+"\"><div style=\"margin:0;display:flex\"><a id=\"intituleRep"+idReponseL+"\" class=\""+reponseCorrecte[i]+"\">"+$('#rep'+i).val()+"</a></div></li>")
                        idReponseL=idReponseL+1;
                    }
                    removeChildren("Form");
                    questionEnCours=false;
                    nbRep=0;
                    nbTag=0;
                    idQuestionL=idQuestionL+1;
                })
        }
        return false;
    }

    function addToQuestionList(id,type,intitule){
        addElement("questionListBody","tr","questionAdded","");
        addElement("questionAdded","th","idQuestionAdded",id);
        addElement("questionAdded","th","typeQuestionAdded",type);
        addElement("questionAdded","th","intituleQuestionAdded",intitule);
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

    function removeChildren(elementId){
        var element = document.getElementById(elementId);
        while (element.firstChild) {
            element.removeChild(element.firstChild);
        }
    }

    $(document).ready(function() {
        $('#addlinkbtn').click(function(e) {
            if (!questionEnCours){
                questionEnCours=true;
                addQuestionIn($('#Linking'));
            }
            else{
                $("#Error").append("Merci de valider la dernière question avant d'en créer une nouvelle");
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

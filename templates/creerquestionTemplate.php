<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- <script src="js/refreshform.js"></script> -->

<script>
    $(document).ready(function() {
      console.log($.ajax);
    });
    </script>
<script>

    var linkId=0;
    var reponsesId=[0];
    var questionsList=[true];
    
    
    function addLinkIn($elem){
        $elem.append($('<select id=\"q' +linkId +'" "size=\"3\"><option value="QCM">QCM</option><option value="QCU">QCU</option><option value="QO">Question ouverte</option></select>'));
        //$elem.append($('<th /><td><input id="selecter'+linkId+'" type="submit" value="Sélectionner question" onclick="creerQuestion('+linkId +','+$("#q"+linkId)+')" /></td>'));
        $elem.append($('<th /><td><input id="selecter'+linkId+'" type="submit" value="Sélectionner question" /></td>'));
        //$("selecter"+linkId).bind('click', creerQuestion(linkId,$("q"+linkId)));
        document.getElementById('selecter'+linkId).onclick = function(){
            //alert (linkId);
           // alert("q"+linkId);
            creerQuestion(linkId,document.getElementById('q'+linkId));
        }
        //alert(document.getElementById('selecter'+linkId).getAttribute("onclick"));
    }

    function ajouterReponse(question,idQuestion){
        var reponseId = reponsesId[idQuestion];
        //alert("reponseId"+reponseId);
        //La partie "idQuestion+reponseId+1) de la ligne suivante constitue du débuggage, elle sera à enlever plus tard : 
        addElement(question,"td","backlineQ"+idQuestion+"r"+reponseId,"Réponse à la question"+idQuestion+"n°"+(reponseId+1),{"class":"input-group mb-3"});
        

        addElement("backlineQ"+idQuestion+"r"+reponseId,"input","reponse"+reponseId,"Inscrire Réponse",{"type":"text","name":"reponse"+reponseId,"class":"form-control input_user","placeholder":"Entrez intitulé"});
        addElement("backlineQ"+idQuestion+"r"+reponseId,"input","repCorrecteCheckBoxQ"+idQuestion+"r"+reponseId,"",{"type":"checkbox","name":"reponseCheck"+reponseId,"class":"form-control input_user","value":"1"});
        reponsesId[idQuestion]=reponsesId[idQuestion]+1;
        //alert(reponsesId);
    }

    function decocherRadioBoxes(idQuestion,reponseId){
        for (var i=0;i<reponsesId[idQuestion];i++){
            //alert("rId:"+reponseId + "/idQ" + idQuestion+"/i:"+i);
            //alert('repCorrecteRadioBoxQ'+idQuestion+'r'+i);
            if (i!=reponseId){
                //alert('repCorrecteRadioBoxQ'+idQuestion+'r'+i);
                document.getElementById('repCorrecteRadioBoxQ'+idQuestion+'r'+i).checked=false;
            }
        }
    }

    function ajouterReponseQCU(question,idQuestion){
        var reponseId = reponsesId[idQuestion];
        addElement(question,"td","backlineQ"+idQuestion+"r"+reponseId,"Réponse à la question"+idQuestion+"n°"+(reponseId+1),{"class":"input-group mb-3"});
        addElement("backlineQ"+idQuestion+"r"+reponseId,"input","reponse"+reponseId,"Inscrire Réponse",{"type":"text","name":"reponse"+reponseId,"class":"form-control input_user","placeholder":"Entrez intitulé"});
        addElement("backlineQ"+idQuestion+"r"+reponseId,"input","repCorrecteRadioBoxQ"+idQuestion+"r"+reponseId,"",{"type":"radio","name":"reponseCheckQ"+idQuestion+"r"+reponseId,"class":"form-control input_user","value":"1"});
        document.getElementById('repCorrecteRadioBoxQ'+idQuestion+"r"+reponseId).onchange = function(){
            //alert('Changement sur la box repCorrecteRadioBoxQ'+idQuestion+"r"+reponseId);
            decocherRadioBoxes(idQuestion,reponseId);
        }
        reponsesId[idQuestion]=reponsesId[idQuestion]+1;
        //alert(reponsesId);
    }

    function creerQuestion(idQuestion,selecter){
        //alert(selecter.value);
        removeElement("q"+idQuestion);
        removeElement("selecter"+idQuestion);
        addElement("questionsListTable","tr","question"+idQuestion,"",{"class":"input-group mb-3"});
        //addElement("question"+idQuestion,"td","td"+idQuestion,"");
        addElement("question"+idQuestion,"input","intitule"+idQuestion,"",{"type":"text","name":"intitule"+idQuestion,"class":"form-control input_user","placeholder":"Entrez intitulé"});
        //alert(selecter.value);
        if(selecter.value!="QO"){
            if(selecter.value=="QCM"){
                //alert("Génération QCM");
                addElement("question"+idQuestion,"button","addReponse","Ajouter Réponse",{"type":"button","onclick":"ajouterReponse(\"question" +idQuestion +"\","+idQuestion+");"});
            }
            if(selecter.value=="QCU"){
                addElement("question"+idQuestion,"button","addReponse","Ajouter Réponse",{"type":"button","onclick":"ajouterReponseQCU(\"question" +idQuestion +"\","+idQuestion+");"});
            }
        }
        reponsesId.push(0);
        questionsList[linkId]=selecter.value;
    }

    function verifLastQ(){
//        alert("VERIF LAST Q : " + linkId + " / " + questionsList+ "/" + questionsList[linkId]);
        return (questionsList[linkId]);
    }

    $(document).ready(function() {
        $('#addlinkbtn').click(function(e) {
            if (verifLastQ()!=false){
                linkId=linkId+1;
                addLinkIn($('#linkslist'));
                questionsList.push(false);
                //alert (linkId);
            }
            else{
                alert("Merci de valider la dernière question avant d'en créer une nouvelle");
            }
        });
    });

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

/*
    function validateQuestion(linkId, reponsesId){
        var typeQ;
        var intitule;
        for (var i=0;i<linkId;i++){
            //alert (questionsList);
            if (questionsList[i+1]!="DELETED"){
                //alert(questionsList[i+1] + " / i: "+i);
                if (questionsList[i+1]!="QCM" && questionsList[i+1]!="QCU" && questionsList[i+1]!="QO"){
                    alert ("Question "+(i+1)+" invalide : erreur de type, réessayez");
                }
                else if(document.getElementById("intitule"+(i+1)).value.length>100){
                    alert ("Intitule de la question "+ (i+1) + " trop long, merci d'insérer une longueur inférieure à 100")
                }
                else if(document.getElementById("intitule"+(i+1)).value==""){
                    alert("Merci de mettre un intitulé à la question "+(i+1));
                }
                else{
                    
                    if (questionsList[i+1]=="QCM" || questionsList[i+1]=="QCU"){
                        typeQ = questionsList[i+1];
                        intitule = document.getElementById("intitule"+(i+1)).value ;
                        /*
                        appelAjax('index.php?action=insertionQuestion&controller=Prof',{intitule_question: intitule, type_question: typeQ}).done(function(resultat){
                            removeElement("question"+(i+1));
                            questionsList[i+1]="DELETED";
                        });*/
                        $.ajax({
                            type:'POST',
                            url:'index.php?action=insertionQuestion&controller=Prof',
                            data:{intitule_question: intitule, type_question: typeQ},
                            /*complete:function(response){
                                $('#success_para').html("La question "+i+" a bien été insérée.");
                                //alert(i);
                                removeElement("question"+(i));
                                questionsList[i]="DELETED";
                            }*/
                        }).done(function(data){
                            removeElement("question"+(i+1));
                            questionsList[i+1]="DELETED";
                        }); 
                    }
                    else{

                        //alert("Passage dans AJAX QCO "+i + " / linkId: "+linkId);
                        typeQ = questionsList[i+1];
                        intitule = document.getElementById("intitule"+(i+1)).value ;
                        /*
                        appelAjax('index.php?action=insertionQuestion&controller=Prof',{intitule_question: intitule, type_question: typeQ}).done(function(resultat){
                            removeElement("question"+(i+1));
                            questionsList[i+1]="DELETED";
                        });*/
                        $.ajax({
                            type:'POST',
                            url:'index.php?action=insertionQuestion&controller=Prof',
                            data:{intitule_question: intitule, type_question: typeQ},
                            /*complete:function(response){
                                $('#success_para').html("La question "+i+" a bien été insérée.");
                                removeElement("question"+(i));
                                questionsList[i]="DELETED";
                            }*/
                        }).done(function(data){
                            removeElement("question"+(i+1));
                            questionsList[i+1]="DELETED";
                        });
                    }

                }   
            }
            else{
                alert("Question supprimée ignorée");
            }  
        }
        alert(questionsList);
    }
*/
/*
    function appelAjax(pUrl,pData) {
        return new Promise(function(resolve, reject) {
            $.ajax({
                type: 'POST',
                url: pUrl,
                data:pData,
                success: function (data){
                    var deferred = $.Deferred();
                    switch (data.code) {
                        case 200:
                            deferred.resolve(data);
                            break;
                        default:
                            deferred.reject(data);
                            break;
                    }
                    return deferred.promise();
                },
                error:function(){
                    $.Deferred().reject();
                }
                
            });
        })
    }
*/
</script>



    <h1>Ajout de questions</h1>

    <button id="addlinkbtn">Add Question</button>

    <form id="questionsList" method="post" onsubmit="validateQuestion(linkId, reponsesId);return false">
        <table id="questionsListTable">
        

        <tr id="validateButton" class="d-flex justify-content-center mt-3 login_container">
			<th /><td> <input type="submit" value="Envoyer les questions" /></td>
		</tr>
        </table>
    </form>

    <p id="success_para"></p>

    <ul id="linkslist">
        <!--
        <form id="form1" method="post" onsubmit="creerQuestion(1);return false">
            <select id="q1" size="3">
                <option value="QCM">QCM</option>
                <option value="QCU">QCU</option>
                <option value="QO">Question ouverte</option>
                <th /><td> <input id="selecter1" type="submit" value="Sélectionner question" /></td>
            </select>
        </form>
        -->
    </ul>



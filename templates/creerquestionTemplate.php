<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>

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
        addElement("backlineQ"+idQuestion+"r"+reponseId,"input","repCorrecteCheckBox","",{"type":"checkbox","name":"reponseCheck"+reponseId,"class":"form-control input_user","value":"1"});
        reponsesId[idQuestion]=reponsesId[idQuestion]+1;
        alert(reponsesId);
    }

    function ajouterReponseQCU(question,idQuestion){
        var reponseId = reponsesId[idQuestion];
        addElement(question,"td","backlineQ"+idQuestion+"r"+reponseId,"Réponse à la question"+idQuestion+"n°"+(reponseId+1),{"class":"input-group mb-3"});
        addElement("backlineQ"+idQuestion+"r"+reponseId,"input","reponse"+reponseId,"Inscrire Réponse",{"type":"text","name":"reponse"+reponseId,"class":"form-control input_user","placeholder":"Entrez intitulé"});
        addElement("backlineQ"+idQuestion+"r"+reponseId,"input","repCorrecteCheckBox"+reponseId,"",{"type":"radio","name":"reponseCheck"+reponseId,"class":"form-control input_user","value":"1"});
        reponsesId[idQuestion]=reponsesId[idQuestion]+1;
        alert(reponsesId);
   }

    function creerQuestion(idQuestion,selecter){
        //alert(selecter.value);
        removeElement("q"+idQuestion);
        removeElement("selecter"+idQuestion);
        addElement("questionsListTable","tr","question"+idQuestion,"",{"class":"input-group mb-3"});
        //addElement("question"+idQuestion,"td","td"+idQuestion,"");
        addElement("question"+idQuestion,"input","input"+idQuestion,"",{"type":"text","name":"intitule1","class":"form-control input_user","placeholder":"Entrez intitulé"});
        alert(selecter.value);
        if(selecter.value!="QO"){
            if(selecter.value=="QCM"){
                alert("Génération QCM");
                addElement("question"+idQuestion,"button","addReponse","Ajouter Réponse",{"type":"button","onclick":"ajouterReponse(\"question" +idQuestion +"\","+idQuestion+");"});
            }
            if(selecter.value=="QCU"){
                addElement("question"+idQuestion,"button","addReponse","Ajouter Réponse",{"type":"button","onclick":"ajouterReponseQCU(\"question" +idQuestion +"\","+idQuestion+");"});
            }
        }
        reponsesId.push(0);
        questionsList[linkId]=true;
    }

    function verifLastQ(){
//        alert("VERIF LAST Q : " + linkId + " / " + questionsList+ "/" + questionsList[linkId]);
        return (questionsList[linkId]);
    }

    $(document).ready(function() {
        $('#addlinkbtn').click(function(e) {
            if (verifLastQ()){
                linkId=linkId+1;
                addLinkIn($('#linkslist'));
                questionsList.push(false);
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

</script>



    <h1>Ajout de questions</h1>

    <button id="addlinkbtn">Add Question</button>

    <form id="questionsList" method="post" onsubmit="validateQuestions();return false">
        <table id="questionsListTable">
        

        <tr id="validateButton" class="d-flex justify-content-center mt-3 login_container">
			<th /><td> <input type="submit" value="Envoyer les questions" /></td>
		</tr>
        </table>
    </form>



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



<!--
<table>

    <thead>
    
        <tr>
            <th>TITRE</th>
            <th>DESCRIPTION</th>
            <th>DATE OUVERTURE</th>
            <th>DATE FERMETURE</th>
            <th>CONNEXION REQUISE</th>
            <th>ETAT</th>
            <th>URL</th>
           
        </tr>
    </thead>

    <tbody>
    
	<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Button with data-target
  </button>
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
  </div>
</div>-->
	
        <?php 

            foreach($questionnaires as $questionnaire){
                echo "<div class=\"questionnaire\">";
                echo "<button class=\"btn bouton_col_ens\" type=\"button\" data-toggle=\"collapse\" data-target=\"#collapseExample".$questionnaire['id']."\" aria-expanded=\"false\" aria-controls=\"collapseExample\">"
				.$questionnaire['titre']."</button>" ;
				 echo "</div>";
				echo"<div class=\"nomQuestionnaire collapse\" id=\"collapseExample".$questionnaire['id']."\">";
                echo "<div class=\"description\"><a class=\"descriptionQuestionnaire\">Description :";
                echo $questionnaire['description'];
                echo "</a></div>";
                    echo "<div class=\"date\"><span class=\"dateOuverture\">Date d'Ouverture: ".$questionnaire['dateOuverture']."</span>
                    <span class=\"dateFermeture\">Date de Fermeture: ".$questionnaire['dateFermeture'] ."</span>
                    </div>";
                echo "<div class=\"etat\">Etat: ". $questionnaire['etat'] ." </div>";
                echo "<div class=\"boutons\">
                <form action=\"index.php?action=modifierQuestionnaire&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Modifier Questions'></form>";
                
                if ($questionnaire['aCorriger']==1){
                    echo "<form action=\"index.php?action=corrigerQuestionnaire&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Corriger'></form>";
                }
                else{
                    echo "<form action=\"index.php?action=classementQuiz&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Classement'></form>";
                }
                echo "<form action=\"index.php?action=inviterQuiz&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Inviter'></form>
                <form action=\"index.php?action=voirInviterQuiz&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Voir invités'></form>
                ";


               

                echo "</div></div>";
                
                
                /*echo "<th><form action=\"index.php?action=modifierQuestionnaire&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Modifier Questions'></form></th>";
                if($questionnaire['aCorriger']==1){                
                    echo "<th><form action=\"index.php?action=corrigerQuestionnaire&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Corriger'></form></th>";
                }
                echo "<th><form action=\"index.php?action=classementQuiz&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Classement'></form></th>
                ";
				if($questionnaire['etat']=='Prive'){
				echo "<th><form action=\"index.php?action=nombreDInvitation&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Inviter'></form></th>";
                echo "<th><form action=\"index.php?action=voirInviterQuiz&controller=prof\" method=\"POST\"><input type='hidden' name='questionnaireId' value='".$questionnaire['id']."'><input type='submit' value='Voir invités'></form></th>";
                }*/

            }
        
        ?>
<!--
    </tbody>

</table>
        -->




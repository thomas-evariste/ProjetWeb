<!--
		<nav>
		
			<ul>
				<li><a href=\"index.php?action=home&controller=prof\">Home</a></li>
				<li><a href=\"index.php?action=profil&controller=prof\">Profil</a></li>
				<li><a href=\"index.php?action=deconnexion&controller=prof\">Deconnecter</a></li>
				<li><a href=\"index.php?action=creerQuestion&controller=prof\">Créer question</a></a></li> 
				
			</ul>
			
		</nav>-->




<nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php?action=home&controller=prof">
          <i class="fa fa-home"></i>
          Home
          <span class="sr-only">(current)</span>
          </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?action=profil&controller=prof">
          <i class="fa fa-user"></i>
          Profil
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-question-circle"></i>
          Mes Quiz
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="index.php?action=voirMesQuestionnaires&controller=prof">
          <i class="fa fa-check-circle"></i>
          Mes questionnaires
        </a>
        <a class="dropdown-item" href="index.php?action=creerQuestionnaire&controller=prof">
          <i class="fa fa-plus-circle"></i>
          Créer un questionnaire
        </a>
        <a class="dropdown-item" href="index.php?action=creerQuestion&controller=prof">
          <i class="fa fa-plus-circle"></i>
          Créer une question
        </a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-question-circle"></i>
          Quiz
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="index.php?action=voirQuestionnaires&controller=prof">Répondre à un nouveau quiz</a>
          <a class="dropdown-item" href="index.php?action=voirResultatQuestionnaires&controller=prof">Voir résultats</a>
        </div>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="index.php?action=deconnexion&controller=prof">
          <i class="fa fa-sign-out-alt"></i>
          Déconnexion
        </a>
      </li>
    </ul>
  </div>
</nav>

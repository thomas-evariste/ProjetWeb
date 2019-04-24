

<nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
	<li class="nav-item">
        <img src="css/images/IMT_Lille_Douai_Logo_WEB.png" alt="logo imt lille douai" class="logo_imt_l_d">
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="index.php?action=home&controller=user">
          <i class="fa fa-home"></i>
          Home
          <span class="sr-only">(current)</span>
          </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?action=profil&controller=user">
          <i class="fa fa-user"></i>
          Profil
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-question-circle"></i>
          Quiz
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="index.php?action=voirQuestionnaires&controller=user">Répondre à un nouveau quiz</a>
          <a class="dropdown-item" href="index.php?action=voirQuestionnairesInvite&controller=user">Mes invitations à des quiz</a>
          <a class="dropdown-item" href="index.php?action=voirResultatQuestionnaires&controller=user">Voir mes résultats</a>
        </div>
      </li>
    <div class="alignRight">
	  <li class="nav-item">
        <a class="nav-link" href="index.php?action=deconnexion&controller=user">
          <i class="fa fa-sign-out-alt"></i>
          Déconnexion
        </a>
      </li>
</div>
    </ul>
  </div>
</nav>

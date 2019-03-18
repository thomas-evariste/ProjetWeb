<?php 
	if (isset($_SESSION['login'])){
		
	
		echo "
		<nav>
		
			<ul>
				<li><a href=\"index.php?action=home\">Home</a></li>
				<li><a href=\"index.php?action=deconnexion\">Déconnecter</a></li>
				
			</ul>
			
		</nav>";
	}


	else{
		echo "
		<nav>
	
			<ul>
				<li><a href=\"index.php?action=home\">Home</a></li>
				<li><a href=\"index.php?action=login\">Login</a></li>
				<li><a href=\"index.php?action=inscription\">Inscription</a></li>
				
			</ul>
		
		</nav>";
	}

?>

<?php /* 	<form id="style_form" action="<?php $_SERVER['REQUEST_URI']; ?>" method="POST"> 
		<select name="css"> 
			<option value="style1">style1</option> 
			<option value="style2">style2</option> 
		</select> 

		<input type="submit" value="Appliquer" /> 
	</form> 
	
	
	ENLEVER BLOC <?php?>
	
	*/?>
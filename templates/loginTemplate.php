



	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card_log">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="css/images/user.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				
				
				<div class="d-flex justify-content-center form_container">
					<form  action="index.php?action=tryLogin" method="post">
				<h2 class="titre-insc">Login</h2>
						<?php if(isset($inscErrorText)){
							echo "<div>".$inscErrorText."</div>";
						} ?>
						<table>
						<tr class="input-group mb-3">
							<td><input type="text" name="loginLogin" class="form-control input_user" value="" placeholder="Login :"></td>
						</tr>
						<tr class="input-group mb-2">
							<td><input type="password" name="loginPassword" class="form-control input_user" value="" placeholder="Mot de passe :"></td>
						</tr>


						<tr class="d-flex justify-content-center mt-3 login_container">
							
							<th /><td> <input type="submit" value="Se connecter" /></td>
						</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>


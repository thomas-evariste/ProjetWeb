



	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card_insc">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="css/images/user.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form  action="index.php?action=validateModification&controller=prof" method="post">
						<table>
<!--
						<tr class="input-group mb-3">
							<td><input type="text" name="login" class="form-control input_user" value="" placeholder="Login :"></td>
						</tr>
-->
						<tr class="input-group mb-3">
							<td><input type="password" name="password" class="form-control input_user" value="" placeholder="Nouveau mot de passe :"></td>
						</tr>
                        <tr class="input-group mb-3">
							<td><input type="password" name="passwordConf" class="form-control input_user" value="" placeholder="Confirmez le nouveau mdp :"></td>
						</tr>
                        <tr class="input-group mb-2">
							<td><input type="text" name="prenom" class="form-control input_pass" value="" placeholder="Prenom :"></td>
						</tr>
                        <tr class="input-group mb-3">
							<td><input type="text" name="nom" class="form-control input_user" value="" placeholder="Nom :"></td>
						</tr>
                        <tr class="input-group mb-3">
							<td><input type="text" name="mail" class="form-control input_user" value="" placeholder="Mail :"></td>
						</tr>
                        <tr class="input-group mb-2">
							<td class="interne_quest">Interne:  <input type='hidden' value='0' name='interne'><INPUT type="checkbox" name="interne" class="form-control interne_btn " value="1" </td>
						</tr>
						<tr class="input-group mb-2">
							<td><input type="text" name="description" class="form-control input_pass" value="" placeholder="Description :"></td>
						</tr>





						<tr class="d-flex justify-content-center mt-3 login_container">
							
							<th /><td> <input type="submit" value="Valider les modifications" /></td>
						</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
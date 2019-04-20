	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card_insc_prof">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="css/images/user.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form  action="index.php?action=validateCreationQuestionnaire&controller=prof" method="post">
					<h2 class="titre-insc">Création de questionnaire</h2>
						<table>
							<tr class="input-group mb-3">
								<td><input type="text" name="titre" class="form-control input_user" value="" placeholder="Titre* :"></td>
							</tr>
							<tr class="input-group mb-3">
								<td><input type="text" name="description" class="form-control input_user" value="" placeholder="Description :"></td>
							</tr>
							<tr class="input-group mb-2">
								<td><input type="date" name="dateOuverture" class="form-control input_user" value="" placeholder="Date Ouverture :"></td>
							</tr>
							<tr class="input-group mb-3">
								<td><input type="date" name="dateFermeture" class="form-control input_user" value="" placeholder="Date Fermeture :"></td>
							</tr>  

							<tr class="input-group mb-2">
								<td>Disponibilité: 
                                    <select name="etat" class="form-control input_user" placeholder="Prenom :">
                                        <option value = "Disponible">Disponible</option>
                                        <option value = "Ferme">Fermé</option>
                                    </select>

                                </td>
							</tr>
							<tr class="input-group mb-2">
                                
								<td class="interne_quest">Connexion Requise:  <input type='hidden' value='0' name='connexionRequise'> <INPUT type="checkbox" name="connexionRequise" class="form-control interne_btn " value="1" ></td>
							</tr>
							<tr class="d-flex justify-content-center mt-3 login_container">
								<th /><td> <input type="submit" value="Creer mon questionnaire" /></td>
							</tr>

						</table>
					</form>
				</div>
			</div>
		</div>
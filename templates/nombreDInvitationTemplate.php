
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card_insc">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="css/images/user.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form  action="index.php?action=inviterQuiz<?php if($mail==0){echo "SansMail";} ?>&controller=prof" method="post">
					<h2 class="titre-insc">Invitation</h2>
						<table>
						<tr class="input-group mb-3">
							<td>Combient de personnes à inviter :</td>
						</tr>
						<tr class="input-group mb-3">
							<td><input type="number" name="nbInvitation" class="form-control input_user" value="1" ></td>
						</tr>
						<tr class="input-group mb-3">
							<td>idQuestionnaire:<input type="number" name="idQuestionnaire" class="form-control input_user" value="<?php echo $idQuestionnaire;?>" readonly></td>
						</tr>
						<tr class="d-flex justify-content-center mt-3 login_container">
							
							<th /><td> <input type="submit" value="Inviter" /></td>
						</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
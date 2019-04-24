
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card_mail_adapt">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="css/images/user.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form  action="index.php?action=envoiEmail<?php if($mail==0){echo "SansEmail";} ?>&controller=prof" method="post">
					<h2 class="titre-insc">Invitation</h2>
						<table>




 <div class="container">
            <div class="row">
                <div class="col-md-12  toppad  offset-md-0 ">
				
                </div>
                <div class="col-md-6  offset-md-0  toppad" >
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Profil :</h2>
                            <table class="table table-user-information ">
                                <tbody>
                                    <tr>
                                        <td>Login:</td>
                                        <td><?php echo $user->getLogin() ?></td>  
									
                                    </tr>
                                    <tr>
                                        <td>Prenom:</td>
                                       <td><?php echo $user->getPrenom() ?></td> 
                                    </tr>
                                    <tr>
                                        <td>Nom de famille:</td>
                                        <td><?php echo $user->getNom() ?></td> 
                                    </tr>
                                    <tr>
                                        <td>Email:</td>
                                        <td><?php echo $user->getMail() ?></td>
                                    </tr>
                                    <tr>
                                        <td>Interne:</td>
                                        <td><?php echo $user->getInterne() ?></td> 

                                    </tr>
                                    <tr>
                                        <td>Description:</td>
                                        <td><?php echo $user->getDescription() ?></td> 
                                    </tr>
									
                                </tbody>
                            </table>
                            <a href="index.php?action=modifier&controller=prof" onClick={props.handleSubmitProfile} class="btn btn-primary ml-2">
							<i class="fa fa-user-edit"></i>
							Modifier</a>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
		
		
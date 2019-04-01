



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
                                        <td>Promotion:</td>
                                        <td><?php echo $user->getPromotion() ?></td> 

                                    </tr>
                                    <tr>
                                        <td>Majeure:</td>
                                        <td><?php echo $user->getMajeure() ?></td> 
                                    </tr>
									
                                </tbody>
                            </table>
                            <a href="#" onClick={props.handleSubmitProfile} class="btn btn-primary ml-2">Modifer</a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
		
		
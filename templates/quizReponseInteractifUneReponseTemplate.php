
    
                    
                        <div class="col-md-4">
                            <div class="frb frb-success margin-bottom-none">
    						<input type="<?php echo $type ?>" id="<?php echo $type ?>-button-<?php echo $numero+1 ?>-<?php echo $numero_reponse+1 ?>" name="<?php echo $type ?>-button-<?php echo $numero+1 ?><?php if($type=='checkbox') {echo '-' ;echo $numero_reponse+1;} ?>" value="<?php echo $reponse['id_proposition'] ?>">
    						<label for="<?php echo $type ?>-button-<?php echo $numero+1 ?>-<?php echo $numero_reponse+1 ?>">
    							<span class="frb-title"><?php echo $reponse['intitule_proposition'] ?></span>
    						</label>
							</div>
                        </div>
						
						
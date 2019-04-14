
    <div class="row">
        <div class="col-md-8 col-md-offset-2 panel" id="panel<?php echo $numero + 1 ?>">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-danger">
                        <i class="fa fa-question-circle fa-3x"></i> <?php echo $numero+1 ?>. <?php echo $question['intitule']  ?>  
                    </h3>
                </div>
                <div class="panel-body two-col">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="frb frb-success margin-bottom-none">
    						<input type="radio" id="radio-button-<?php echo $numero+1 ?>-1" name="radio-button" value="5">
    						<label for="radio-button-<?php echo $numero+1 ?>-1">
    							<span class="frb-title">Answer 1</span>
    						</label>
							</div>
                        </div>
                        <div class="col-md-4">
                            <div class="frb frb-danger margin-bottom-none">
    						<input type="radio" id="radio-button-<?php echo $numero+1 ?>-2" name="radio-button" value="5">
    						<label for="radio-button-<?php echo $numero+1 ?>-2">
    							<span class="frb-title">Answer 2</span>
    						</label>
    					</div>
                        </div>
                        <div class="col-md-4">
                            <div class="frb frb-danger margin-bottom-none">
    						<input type="radio" id="radio-button-<?php echo $numero+1 ?>-3" name="radio-button" value="5">
    						<label for="radio-button-<?php echo $numero+1 ?>-3">
    							<span class="frb-title">Answer 3</span>
    						</label>
    					</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="frb frb-danger margin-bottom-none">
    						<input type="radio" id="radio-button-<?php echo $numero+1 ?>-4" name="radio-button" value="5">
    						<label for="radio-button-<?php echo $numero+1 ?>-4">
    							<span class="frb-title">Answer 4</span>
    						</label>
    					</div>
                        </div>
                        <div class="col-md-4">
                            <div class="frb frb-danger margin-bottom-none">
    						<input type="radio" id="radio-button-<?php echo $numero+1 ?>-5" name="radio-button" value="5">
    						<label for="radio-button-<?php echo $numero+1 ?>-5">
    							<span class="frb-title">Answer 5</span>
    						</label>
    					</div>
                        </div>
                        <div class="col-md-4">
                            <div class="frb frb-danger margin-bottom-none">
    						<input type="radio" id="radio-button-<?php echo $numero+1 ?>-6" name="radio-button" value="5">
    						<label for="radio-button-<?php echo $numero+1 ?>-6">
    							<span class="frb-title">Answer 6</span>
    						</label>
    					</div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button id="step<?php echo $numero+0 ?>" type="button" class="btn btn-success btn-sm btn-block hidden">
                                <span class="fa fa-send"></span>back</button>
                        </div>
                        <div class="col-md-6">
                            <button id="step<?php echo $numero+2 ?>" type="button" class="btn btn-primary btn-sm btn-block">
                               next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




<?php   
		include('header_admin.php');
		if(isset($_REQUEST['edit']))
		{	
				$editid = $_REQUEST['edit'];
				$res = $this->db->query("select * from plans where id='$editid'");
				$row = $res->result();
				$id = $row['0']->id;
		}
?>	
		<section class="vbox">          
        <section class="scrollable padder wrapper">            
            <div class="row">
                <div class="col-sm-6">
                <form action="<?php echo base_url().'index.php/admin_client/edit_plan_list/'; ?>" data-validate="parsley" enctype="multipart/form-data" method="post">
				<section class="panel panel-default">
                      <header class="panel-heading">
                        <span class="h4">Plan List</span>
                      </header>
	             <div class="panel-body">
	                    <p class="text-muted">Please fill the information to continue</p>
	                    <div class="form-group">
	                      <label>Plan Name </label>
	                      <input type="hidden" name="id" value="<?php echo $id; ?>">
	                      <input type="text" name="txtPlanName"
	                             value="<?php echo $row['0']->plan_name; ?>" id="txtPayment" placeholder="" class="form-control" required="" />                        
	                    </div>
	                   <div class="form-group">
	                      <label>Plan Price </label>
	                      <input type="text" name="txtPlanPrice"
	                             value="<?php echo $row['0']->plan_price; ?>" id="txtPayment" placeholder="In USD" class="form-control" required="" />                        
	                    </div>
	              </div>
	              <footer class="panel-footer text-right bg-light lter">
	                    <button type="submit" class="btn btn-success btn-s-xs">Submit</button>
	                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="mycancel" class="modal fade bs-example-modal-sm">
	                        <div class="modal-dialog modal-sm">
	                            <div class="modal-content">
	                                <div class="modal-header">
	                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                                    <h4 class="modal-title"><i class="fa fa-building-o"></i> Plan Insert Master Alert</h4>
	                                </div>
	                                <div class="modal-body">
	                                    <i class="fa fa-question-circle"></i> Are You Sure To Go Back!
	                                </div>
	                                <div class="modal-footer">                          
	                                    <input type='button' value='Yes' class="btn btn-success btn-shadow" onclick=""/>
	                                    <button data-dismiss="modal" class="btn btn-danger btn-shadow" type="button">No</button>
	                                </div>                      
	                            </div>
	                        </div>
	                    </div>
	<!--                        End Code for Cancle Alert-->
	                    <a href="" data-toggle='modal' class="btn btn-success btn-s-xs" name="cancel">Cancel</a>
	                  </footer>
                    </section>
                    </form>
                </div>
                </div>
                <section class="panel panel-default">
							  <div class="adv-table">                 
							    <table class="display table table-bordered table-striped no_mrgn_btm" id="example">
								      <thead>
								        <tr>
								          <th width="15%">Plan Name</th> 
								          <th width="15%">Plan Price</th> 
								          <th width="10%">Plan Date</th> 
								          <th width="15%"></th> 
								          <th width="15%"></th> 
								        </tr>
								     </thead>
								     <?php 	$result_client = $this->db->query("select * from plans");
								     		$row_client = $result_client->result();
								     		foreach($row_client as $row){
								     		?>
								       <tr class='gradeA'> 
								       	   <td><?php echo $row->plan_name; ?></td>
								       	   <td><?php echo $row->plan_price; ?></td>
								       	   <td><?php echo $row->datetime; ?></td>
								       	   <td><a href="<?php echo base_url(); ?>index.php/admin_client/select_plan_list/?edit=<?php echo $row->id; ?>">
								       	    		<img src ="<?php echo base_url(); ?>/public/images/edit_new.png"/>
								       	    	</a>
						       	    		</td>
								       	    <td><a href="<?php echo base_url(); ?>index.php/admin_client/remove_user/?delete=<?php echo $row->id; ?>">
								       	    		<img src ="<?php echo base_url(); ?>/public/images/delete_new.png"/>
								       	    	</a>
						       	    		</td>
								      </tr>
								      <?php } ?>
							  	</table>	
							</div>                
					</section>
				</section>
			</section>	
   <?php include('footer_admin.php'); ?>

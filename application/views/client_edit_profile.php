<?php 
		include('header_client.php'); 

	  	$adminid = $this->session->userdata('id');

 	 	$result_edit_profile = $this->db->query("select * from admin where id='$adminid'");

 		$row_edit_profile = $result_edit_profile->result();


 ?>

      <section class="vbox">          

        <section class="scrollable padder wrapper">            

            <div class="row">

            		

                      <form action="<?php echo base_url().'index.php/client_information/edit_insert_profile/';  ?>" data-validate="parsley" enctype="multipart/form-data" method="post">

                        <div class="col-sm-12">

					             <header class="panel-heading form_panel">

					                        <span class="h4">Your Profile</span>

					              </header>

                <div class="col-sm-6">

                

				<section class="panel panel-default">

                      

	             <div class="panel-body">

	                    <div class="form-group">

	                      <label>First Name</label>

	                      <input type="text" name="txtName" value="<?php echo $row_edit_profile['0']->fname; ?>" id="txtPlan" class="form-control" required="" />                        

	                    </div>

	                    <div class="form-group">

	                      <label>Last Name</label>

	                      <input type="text" name="txtLName" value="<?php echo $row_edit_profile['0']->lname; ?>" id="txtPlan" class="form-control" required="" />                        

	                    </div>

	                   <div class="form-group">

	                      <label>Email Address </label>

	                      <input type="text" name="txtEmail"

	                             value="<?php echo $row_edit_profile['0']->email; ?>" id="txtPayment" class="form-control" required="" />                        

	                    </div>

	                    <div class="form-group">

	                      <label>Phone Number </label>

	                      <input type="text" name="txtPhoneNumber" 

	                             value="<?php echo $row_edit_profile['0']->mobile; ?>"

	                             id="txtPayment" class="form-control"  required="" />                        

	                    </div>

	                    

                    </section>

                   

                </div>



                <div class="col-sm-6">

                

				<section class="panel panel-default">

                      

	             <div class="panel-body">

	                    

	                    <div class="form-group">

	                      <label>Password </label>

	                      <input type="password" name="txtPassword"

	                             value="<?php echo $row_edit_profile['0']->password; ?>" id="txtAmount" class="form-control"  required="" />                        

	                    </div>

	                    <div class="form-group">

	                      <label>Confirm Password</label>

	                      <input type="password" name="txtConfirmPassword"

	                             value="<?php echo $row_edit_profile['0']->password; ?>" id="txtAmount" class="form-control"  required="" />                        

	                    </div>

	                    <div class="form-group">

				                 <label > Plan </label> 

				                 <br/>

        				<select name="txtPlan" id="gender" style="height: 30px;width: 100%;" class="">

						                 <option value=""> Select Plan  </option>

						                 <option value="1" <?php if($row_edit_profile['0']->plan_id == '1')

						                 {

						                 	echo "selected";

						                 }?>> Plan A  </option>

						                 <option value="2" <?php if($row_edit_profile['0']->plan_id == '2')

						                 {

						                 	echo "selected";

						                 }?>> Plan B  </option>

						                 <option value="3" <?php if($row_edit_profile['0']->plan_id == '3')

						                 {

						                 	echo "selected";

						                 }?>> Plan C  </option>

				        </select>

            			</div>

	                    <div class="form-group">

						  <label>Address</label>

						  <textarea class="form-control" id="txtDesc1" cols="66" rows="5.5" name="txtDesc1"                                    

						  placeholder="">

						  	<?php echo htmlspecialchars($row_edit_profile['0']->address); ?>

						  </textarea>

						  

						</div>

	              </div>

	             

                    </section>

                   

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

	                    <a href="http://cmexpertiseinfotech.in/ci_test/index.php/Home/index" data-toggle='modal' class="btn btn-success btn-s-xs" name="cancel">Cancel</a>

	                  </footer>

	                </div>

                 </form>



                </div>

				</section>

			</section>

   <?php include('footer_client.php'); ?>


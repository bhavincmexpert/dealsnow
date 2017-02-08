<?php  include('header_client.php');    ?>	

			<!-- ajax code starts here -->

			<script>
					$(document).on('change', 'select.Business1', function(){
         				   var business1 = $('select.Business1 option:selected').val();
						   var value = $(this).val();
						   $.ajax({
						   		type:"POST",
						   		data: { business1:business1 },
						   		url: '<?php echo site_url('client_area/select_business_sub_cat'); ?>',
						   		success : function (data){
					   				$('#business2').empty();
									$('#business2').append(data);
						   		}
						   });
					});
			</script>

			<!-- ajax code ends here -->

			<!-- ajax code starts here -->

			<script>
				    $(document).on('click','.Business2',function(){
         				   var business12 = $('select.Business2 option:selected').val();
						   $.ajax({
						   		type:"POST",
						   		data: { business12:business12 },
						   		url: '<?php echo site_url('client_area/select_business_sub_sub_cat1'); ?>',
						   		success : function (data){
					   				$('#business3').empty();
									$('#business3').append(data);
						   		}
						   });
					});
			</script>

			<!-- ajax code ends here -->

	  <style>
        #myMap {
		   height: 600px;
		   width: 300px;
		}
      </style>
      <section class="vbox">          
        <section class="scrollable padder wrapper">            
            <div class="row">
            <form action="<?php echo base_url().'index.php/Client_area/insert_business/';  ?>" data-validate="parsley" enctype="multipart/form-data" method="post">
             <div class="col-sm-12">
             <header class="panel-heading form_panel">
                        <span class="h4">ADD Business</span>
             </header>
                <p class="text-muted">Please fill the information to continue</p>
                <div class="col-sm-6">
				<section class="panel panel-default">
	             <div class="panel-body">
	            <div class="form-group">
	                      <label>Business Name</label>
	                      <input type="text" name="txtName" value="" id="txtBusinessmain" class="form-control" required="" />                        
	             </div>
	             <div class="form-group">
	                      <label>Email Address</label>
	                      <input type="email" name="txtEmail" value="" id="txtEmail" class="form-control"  />                        
	             </div>
	             <div class="form-group">
	                      <label>Phone Number</label>
	                       <input type="text" name="txtPhone" value="" id="txtPhone" class="form-control"  />    
	            </div>
	            <div class="form-group">
	                      <label>Cousine</label>
	                      <input type="text" name="txtCousine" value="" id="txtCousine" class="form-control" required="" />                        
	            </div>
                </section>
                </div>
                <div class="col-sm-6">
				<section class="panel panel-default">
	             <div class="panel-body">
	            <div class="form-group">
	                      <label> Address</label>
	                      <input type="text" id="address" data-toggle="modal" data-target="#myModal" name="txtAddress" value=""  class="form-control abc address_open" />     
	                         <input type="hidden" id="latitude" placeholder="Latitude"/>
		           			 <input type="hidden" id="longitude" placeholder="Longitude"/>                   
	             </div>
	             <div class="form-group">
	                      <label>WebSite</label>
	                      <input type="url" name="txtWebsite" value="" id="txtPlan" class="form-control" />                        
	             </div>
	             <div class="form-group">
	                      <label>Facebook Link</label>
	                      <input type="url" name="txtFacebook" value="" id="txtPlan" class="form-control" />                        
	             </div>
	             <div class="form-group">
	                      <label>Twitter Link</label>
	                      <input type="url" name="txtTwitter" value="" id="txtPlan" class="form-control"  />                        
	             </div>
                 </section>
                 </div>
                </div>
                <div class="col-sm-12">
            	<header class="panel-heading form_panel">
                        <span class="h4">Choose Your Business</span>
              	</header>
                <div class="col-sm-6">
						<section class="panel panel-default">
			             <div class="panel-body">
			             <div class="form-group">
			                    <label>Business 1</label>
		        				<select name="txtBusiness1" id="" style="height: 30px;width: 100%;" class="Business1" required="">
								                 <option value=""> Select Business </option>
								               	 <?php 
								               	 $result_cat1 =  $this->db->query("select * from category");
												 $row_cat1 = $result_cat1->result();
								               	 ?>
										        <?php foreach($row_cat1 as $item){ ?>
										        <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
										        <?php } ?>
						        </select>                        
			             </div>
			             <div class="form-group">
			                    <label>Business 2</label>
		        				<select name="txtBusiness2" id="business2" style="height: 30px;width: 100%;" class="Business2">
								                 <option value=""> Select Business2 </option>
						        </select>                        
			             </div>
			             <div class="form-group">
			                    <label>Business 3</label>
		        				<select name="txtBusiness4" id="business3" style="height: 30px;width: 100%;" class="Business3">
								                 <option value=""> Select Business3 </option>
						        </select>                        
			             </div>
			             <div class="form-group">
			                      <label>Your Business Name</label>
			                      <input type="text" name="txtBusiness3" value="" id="" class="form-control" required="" />                        
			            </div>
		                </section>
                </div>
                </div>
		        <!-- bootstrap model pop up code starts here  -->
		          <div class="modal fade" id="myModal" role="dialog">
					    <div class="modal-dialog modal-lg">
					      <div class="modal-content">
					        <div class="modal-header">
					          <button type="button" class="close" data-dismiss="modal">&times;</button>
					          <h4 class="modal-title">Map View</h4>
					        </div>					        
					        <div class="modal-body">
					          <div id="myMap" class="Mymap1" style="width:100%;float:left;"></div>
					        </div>
					        <div class="modal-footer">
					          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					        </div>
					      </div>
					    </div>
					  </div>
					</div>
		        <!-- bootstrap model pop up code ends here  -->
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
                </form>
                </div>
			</section>
			</section>
			
   <?php  include('footer_client.php'); ?>
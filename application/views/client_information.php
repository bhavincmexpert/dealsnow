<?php include('header_client.php'); ?>

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
				    $(document).on('change','.Business2',function(){
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

			<script type="text/javascript">
					$(document).on('change','.Business3',function(){
							var business3 = $('select.Business3 option:selected').val();
							$.ajax({
									type:"POST",
									data: { business3 : business3 },
									url: '<?php echo site_url('client_information/edit_gallery'); ?>',
									success : function(data)
									{	
										alert(data);
										$('#edit_gallery').html(data);
										$('#edit_gallery').show();
									}
							});
						 });
					
			</script>	
			
			<!-- script for Menu starts here -->

			<script type='text/javascript'>
						    //var $j = jQuery.noConflict();
						    $(document).ready(function(){
						      $("#add-file-field").click(function(){
						        $("#text").append("<div class='added-field'><input class='input_file upload_action' name='userfile[]' type='file' required/><input type='button' class='remove_input remove-btn' value='Remove Photo' /></div>");
						      });
						     $(document).on('click','.remove-btn',function(){
						       $(this).parent().remove();
						      });
						    });
			  </script>
			<!-- script for Menu ends here -->
	
	<section class="vbox">          
        <section class="scrollable padder wrapper">            
            <div class="row">
            <form action="<?php echo base_url().'index.php/client_information/insert_gallery/';  ?>" data-validate="parsley" enctype="multipart/form-data" method="post">
            <div class="col-sm-12">
            	<header class="panel-heading form_panel">
                        <span class="h4">Choose Your Business</span>
              	</header>
              	<div class="col-sm-12">
						<section class="panel panel-default">
			             <div class="panel-body">
			             <div class="col-md-6">
					             <div class="form-group">
					                    <label>Business 1</label>
				        				<select name="txtBusiness1" id="" style="height: 30px;width: 100%;" class="Business1">
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
			             </div>
			             <div class="col-md-6">
			             <div class="form-group">
			                    <label>Business 3</label>
		        				<select name="txtBusiness4" id="business3" style="height: 30px;width: 100%;" class="Business3">
								                 <option value=""> Select Business3 </option>
						        </select>                        
			             </div>
			             </div>
		                </section>
                </div>
                <div class="col-sm-12" id="edit_gallery" style="display: none;">
						<section class="panel panel-default">
			             <div class="panel-body">
			             <div class="col-md-6">

			             </div>
			             <div class="col-md-6">
			             <div class="form-group">
			                    <label>Business 3</label>
		        				<select name="txtBusiness4" id="business3" style="height: 30px;width: 100%;" class="Business3">
								                 <option value=""> Select Business3 </option>
						        </select>                        
			             </div>
			             </div>
		                </section>
                </div>
             </div>
             <div class="col-sm-12" id="gallery">
             <header class="panel-heading form_panel">
                        <span class="h4"> Gallery to Your Business</span>
             </header>
                <center>
                <b>
                   <h4 class="text-muted"> Note: (You can Add Unlimited Images by clicking Add Menu Image Button)</p>
                </b>
            </center> 
            <div class="col-sm-6">
					<section class="panel panel-default">
		            <div class="panel-body">
		            <div class="form-group">
					              <label>Menu</label>
				                    <div id="text">
						                    <div class="abc">
						                         <input class="input_file" name="userfile[]" type="file" 
						                         />
						                          <input class="add_input" type="button" id="add-file-field" name="add" value="Add Photo" />
						                    </div>
				                    </div>
				                    <input class="" type='hidden' name="action" value="uploadfiles" />
				                    <input type="hidden" value="Upload File" />
		             </div>
	                </section>
            </div>
                </div>
                <div class="col-md-12">

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
	                                    <h4 class="modal-title"><i class="fa fa-building-o"></i> Plan Insert Master Alert </h4>
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
						<!-- End Code for Cancle Alert-->
	                    <a href="" data-toggle='modal' class="btn btn-success btn-s-xs" name="cancel">Cancel</a>
	            </footer>
                </form>
                <button type="submit" class="edit_gallery_button"  > Edit Gallery </button>
                </div>
			</section>
			</section>
			
<?php include('footer_client.php'); ?>
<?php 
   $super_admin = $this->session->userdata('email_admin');
   $zone_manager = $this->session->userdata('email_zone_manager');
   $zone_manager_id = $this->session->userdata('zone_manager_id');
   if($this->session->userdata('email_admin'))
   {	
   		include('header_admin.php');
   }
   if($this->session->userdata('email_zone_manager'))
   {
   		include('header_zone_manager.php');
   }

?>
	  <script type="text/javascript">
			 $(document).ready(function(){
		            $('#invoice_generate').on('click', function(event) {    
		            alert(1);    
		         });
		     });
	  </script>
	  <script type="text/javascript">
	  	function generate_invoice(value1,value2) {
	  		var adminid = value2;
	  		var planid  = value1;
	  		$.ajax({
				   		type:"POST",
				   		data: { adminid:adminid, planid:planid },
				   		url: '<?php echo site_url('admin_invoice/invoice_generate'); ?>',
				   		success : function (data){
			   				alert(data);
			   				location.reload();
				   		}
				   });
  		  }	
	  </script>

      <section class="vbox">          
        <section class="scrollable padder wrapper">            
	            
	            <div class="row">
	                <div class="col-sm-12">
						<section class="panel panel-default">
		                      <header class="panel-heading">
		                        <span class="h4"> Associate Client with Zone Manager </span>
		                      </header>
			            
		                </section>
	                </div>
	            </div>
	            

				<section class="panel panel-default">
							  <div class="adv-table">                 
							    <table class="display table table-bordered table-striped no_mrgn_btm" id="example">
								      <thead>
								        <tr>
									      <th class="sorting" role="columnheader" tabindex="0" aria-controls="example"
	                                            rowspan="1" colspan="1"
	                                            aria-label="Rendering engine: activate to sort column ascending"
	                                            style="width: 100px;"><input type="checkbox" class="checkboxMain">
	                                      </th>
								          <th width="15%">First Name</th> 
								          <th width="15%">Phone Number</th> 
								          <th width="15%">Email Address</th> 
								          <th width="15%">Address</th> 
								          <th width="15%">Zone Name</th> 
								          <th width="15%">Password</th> 
								          <th width="10%">Plan</th> 
								          <th width="15%"></th> 
								        </tr>
								     </thead>
								     <?php 	
							     	   if($this->session->userdata('email_admin'))
											{	
							     			$result_client = $this->db->query("select * from admin LEFT JOIN client_city_data ON client_city_data.client_id = admin.id where type='0'");
							     		}
							     		if($this->session->userdata('email_zone_manager'))
							     		{
							     			$result_client = $this->db->query("select * from admin where zone_manager_id = '$zone_manager_id'");	
							     		}
							     		$row_client = $result_client->result();
							     		$i = 1;
								     		foreach($row_client as $row){
								     		?>
								       <tr class='gradeA'> 
								       	   <td><input type="checkbox" name="delete[]" id='iId' value="<?php echo $row->client_id; ?>" class="checkbox_user"> </td>
								       	   <td><?php echo $row->fname; ?></td>
								       	   <td><?php echo $row->mobile; ?></td>
								       	   <td><?php echo $row->email; ?></td>
								       	   <td><?php echo $row->address; ?></td>
								       	   <td> <?php echo $row->city_name; ?> </td>
								       	   <td><?php echo $row->password; ?></td>
								       	   <td>
								       	   <?php
								       	    $planid = $row->plan_id; 
								       	    $res_plans = $this->db->query("select plan_name from plans where id='$planid'");
								       	    $row_plans = $res_plans->result();
								       	   	echo $row_plans['0']->plan_name;
								       	    ?>
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
					<div class="row">
	                <div class="col-sm-12">
						<section class="panel panel-default">
		                      <header class="panel-heading">
		                        <span class="h4"> Select Zone Manager for Client Allocation  </span>
		                      </header>
		                </section>
		                <div class="col-md-6">
			                <div class="form-group">
		                    	<select name="state" class="" style="height: 30px;width: 100%;" id="zone_manager_id_1" required="">
										<option value="">Select Zone Manager</option>
										<?php 
										$select_zone_manager = $this->db->query("select *,zone_data.zone_admin_id as zone_manager_id from admin LEFT JOIN zone_data ON admin.id = zone_data.zone_admin_id where admin.type ='3'");
										$row_zone_manager = $select_zone_manager->result();
										?>
										<?php foreach ($row_zone_manager as $singlevalue) { ?>
											<option value="<?php echo $singlevalue->zone_manager_id; ?>"> <?php echo $singlevalue->city_name; ?> </option>
										<?php } ?>
								</select>
		                    </div>
		                </div>
		                <div class="col-md-6">
		                	<a href="" class="btn btn-success" id="allocation_button" onclick=""> Allocate selected Clients to this Zone Manager </a>
		                </div>
	                </div>
	            </div>
				</section>
			</section>

	<script type="text/javascript">
			  $("#allocation_button").click(function(){
			  		 
			  		 var selected_value = $( "#zone_manager_id_1 option:selected" ).val();
			  		 var zone_name = $( "#zone_manager_id_1 option:selected" ).text();
			  		 alert(zone_name);
			       	 if($('.checkbox_user:checked').length == 0) {
				            alert('Please select at least one Client to Allocation');
				            return;
				     }
				     else
				     {
					     	alert('we are in else');
					     	var ids = [];
			                $('.checkbox_user:checked').each(function() {
			                    ids.push($(this).val());
			                });
					     	var ids = ids;
					     	var zone_name = zone_name;
					     	alert(ids);
					     	$.ajax({
					                type: "POST",
					                url: "<?php echo site_url('zone_manager/associate_client_add'); ?>",
					                data: { ids: ids.toString() , zone_name: zone_name , selected_value: selected_value },
					                success: function (data) {
					                    alert(data);
					                    e.preventDefault();
    				 					e.stopPropagation();
					                }
					            });
				     }
			    }); 
	</script>
	<?php // exit(); ?>
   <?php include('footer_admin.php');
    ?>

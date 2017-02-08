<?php 
   
   $super_admin = $this->session->userdata('email_admin');
   $zone_manager = $this->session->userdata('email_zone_manager');
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
				   		url: '<?php echo site_url('admin_invoice/invoice_generate1'); ?>',
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
		                        <span class="h4">List Client ( Due )</span>
		                      </header>
			            
		                </section>
	                </div>
	            </div>
				<section class="panel panel-default">
							  <div class="adv-table">                 
							    <table class="display table table-bordered table-striped no_mrgn_btm" id="example">
								      <thead>
								        <tr>
								          <th width="15%">First Name</th> 
								          <th width="15%">Phone Number</th> 
								          <th width="15%">Email Address</th> 
								          <th width="15%">Address</th> 
								          <th width="15%">Password</th> 
								          <th width="10%">Plan</th> 
								          <th width="20%">Generate Request for Due Invoice</th> 
								          <th width="15%"></th> 
								        </tr>
								     </thead>
								     <?php 	
								     if($this->session->userdata('email_admin'))
								     {
								     	$result_client = $this->db->query("select admin.*,invoice.*,admin.plan_id as planid FROM admin LEFT JOIN invoice ON admin.id = invoice.admin_id where admin.type = '0' and invoice.admin_id IS NULL");
								     }
								     if($this->session->userdata('email_zone_manager'))
								     {
								     	$zone_manager_id = $this->session->userdata('zone_manager_id');
								     	$result_client = $this->db->query("select admin.*,invoice.*,admin.plan_id as planid FROM admin LEFT JOIN invoice ON admin.id = invoice.admin_id where admin.type = '0' and admin.zone_manager_id = '$zone_manager_id' and invoice.admin_id IS NULL");
								     }
								     		$row_client = $result_client->result();
								     		$i = 1;
								     		foreach($row_client as $row){
								     		?>
								       <tr class='gradeA'> 
								       	   <td><?php echo $row->fname; ?></td>
								       	   <td><?php echo $row->mobile; ?></td>
								       	   <td><?php echo $row->email; ?></td>
								       	   <td><?php echo $row->address; ?></td>
								       	   <td><?php echo $row->password; ?></td>
								       	   <td>
								       	   <?php
								       	    $planid = $row->planid; 
								       	    $res_plans = $this->db->query("select plan_name from plans where id='$planid'");
								       	    $row_plans = $res_plans->result();
								       	   	echo $row_plans['0']->plan_name;
								       	    ?>
								       	   </td>
								       	    <td>
								       	    <?php 
								       	    $planid = $row->plan_id;
								       	    $adminid = $row->id;
								       	    $res_invoice_exist = $this->db->query("select * from invoice where admin_id='$adminid' and plan_id='$planid'");
											if($res_invoice_exist -> num_rows > 0)
											{
											?>
											<a href="javascript:;" disabled="disabled" class="btn btn-success">Already Generated</a>
											<?php 
											}else
											{
								       	    ?>
								       	    <a href="javascript:;" class="btn btn-success" onclick="generate_invoice(<?php echo $row->plan_id; ?>,<?php echo $row->id; ?>)">Generate Overdue</a>
								       	    <?php } ?>
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

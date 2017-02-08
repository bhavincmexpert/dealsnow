<?php include('header_admin.php'); 
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
		                        <span class="h4">List of Zone Managers</span>
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
								          <th width="15%">Zone Name</th> 
								          <th width="15%"></th> 
								        </tr>
								     </thead>
								     <?php 	$result_client = $this->db->query("select * from admin LEFT JOIN zone_data ON admin.id = zone_data.zone_admin_id where admin.type ='3'");
								     		$row_client = $result_client->result();
								     		$i = 1;
								     		foreach($row_client as $row){
								     		?>
								       <tr class='gradeA'> 
								       	   <td><?php echo $row->fname; ?></td>
								       	   <td><?php echo $row->mobile; ?></td>
								       	   <td><?php echo $row->email; ?></td>
								       	   <td><?php echo $row->address; ?></td>
								       	   <td><?php echo $row->city_name; ?></td>
								       	  
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

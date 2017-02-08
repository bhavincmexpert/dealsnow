<?php include('header_client.php'); 
	print_r($_REQUEST);
	if(isset($_REQUEST['cancel_return']))
	{
		echo "<script>";
		echo "alert('Transaction is cancelled by User...!')";
		echo "</script>";
		$url = base_url().'/index.php/client_invoice/client_recent_invoice/';
		header("refresh:0.5;url=$url");
	}
	// paypal URLs code starts here

	$paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
	$paypal_id="paypal.cmexpertise@gmail.com"; // Business email ID

	// paypal URLs code ends here


?>
		<script type="text/javascript">
				$(document).on('click','#payment_start',function(){

				});
		</script>
        <section class="vbox">          
        <section class="scrollable padder wrapper">   
        <section class="panel panel-default">      
            	<header class="panel-heading">
                        <span class="h4">Your Invoice</span>
                </header>
        </section>
		<section class="panel panel-default">
	  <div class="adv-table">                 
	    <table class="display table table-bordered table-striped" id="example">
		      <thead>
		        <tr>
		          <th width="10%"> Plan Name </th> 
		          <th width="10%"> Plan Price </th> 
		          <th width="15%"></th> 
		        </tr>
		     </thead>
		     <?php
		     		$status = "pending";
		     		$adminid = $this->session->userdata('id');
		     		$res_plan_invoice = $this->db->query("select * from invoice where admin_id='$adminid'");
		     		$row_plan_invoice = $res_plan_invoice->result();
		     		$planid = $row_plan_invoice['0']->plan_id;
		     		$res_plan_name = $this->db->query("select * from plans where id='$planid'");
		     		$row_plan_name = $res_plan_name->result();
		     ?>
		<tr class='gradeA'> 
           <td><?php echo $row_plan_name['0']->plan_name; ?></td>
           <td><?php echo $row_plan_name['0']->plan_price; ?></td>
           <td>
          <form action="<?php echo $paypal_url; ?>" method="post" name="frmPayPal1">
		    <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
		    <input type="hidden" name="cmd" value="_xclick">
		    <input type="hidden" name="item_name" value="<?php echo $row_plan_name['0']->plan_name; ?>">
		    <input type="hidden" name="credits" value="510">
		    <input type="hidden" name="userid" value="1">
		    <input type="hidden" name="amount" value="<?php echo $row_plan_name['0']->plan_price; ?>">
		    <input type="hidden" name="cpp_header_image" value="http://cmexpertiseinfotech.com/wp-content/uploads/2016/07/logo-small.png">
		    <input type="hidden" name="no_shipping" value="1">
		    <input type="hidden" name="currency_code" value="USD">
		    <input type="hidden" name="handling" value="0">
		    <input type="hidden" name="cancel_return" value="http://localhost/dealsnow/index.php/client_invoice/client_recent_invoice/?cancel_return">
		    <input type="hidden" name="return" value="http://localhost/dealsnow/index.php/client_invoice/client_recent_invoice/">
		   	<a href="#"><input type="submit" value="Pending" class="btn btn-sucess"  /></a>
		    <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
   		   </form> 
		    </td>
		</tr>
	  	</table>	
	   </div>                
	</section>
  </section>
</section>

   <?php include('footer_client.php'); ?>

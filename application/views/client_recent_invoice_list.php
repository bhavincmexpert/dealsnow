<?php include('header_client.php'); 

	$adminid = $this->session->userdata('id');
	if(isset($_REQUEST['txn_id'])
	&& isset($_REQUEST['payer_id'])
	&& isset($_REQUEST['mc_gross'])
	&& isset($_REQUEST['item_name'])
	&& isset($_REQUEST['business'])
	&& isset($_REQUEST['residence_country'])
	&& isset($_REQUEST['receiver_email'])
	&& isset($_REQUEST['payment_status']))
	{
		$txnid = $_REQUEST['txn_id'];
		$payerid = $_REQUEST['payer_id'];
		$mc_gross = $_REQUEST['mc_gross'];
		$itemname = $_REQUEST['item_name'];
		$currency = $_REQUEST['residence_country'];
		$email = $_REQUEST['receiver_email'];
		$payment_status = $_REQUEST['payment_status'];
		
		$data = array(
			'user_id' => $adminid,
			'product_id' => $payerid,
			'txn_id' => $txnid,
			'payment_gross' => $mc_gross,
			'payer_email' => $email,
			'payment_status' => $payment_status
			);

		$insert_transcation = $this->db->insert("payments",$data);
		if($insert_transcation)
		{
			echo "<script>";
			echo "alert('Transaction Successfully completed...!')";
			echo "</script>";
			$url = base_url().'/index.php/client_invoice/client_recent_invoice/';
			header("refresh:0.5;url=$url");
		}

	}


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
		     		$adminid = $this->session->userdata('id');
		     		$res_plan_invoice = $this->db->query("select * from invoice where admin_id='$adminid'");
		     		$row_plan_invoice = $res_plan_invoice->result();
		     		$planid = @$row_plan_invoice['0']->plan_id;
		     		$res_plan_name = $this->db->query("select * from plans where id='$planid'");
		     		$row_plan_name = $res_plan_name->result();
		     ?>
		<tr class='gradeA'> 
           <td><?php 
           if($res_plan_name -> num_rows > 0)
           {
           		echo $row_plan_name['0']->plan_name;;
           }
           else
           {
           		echo "";
           }
            ?></td>
            <td><?php 
           if($res_plan_name -> num_rows > 0)
           {
           		echo $row_plan_name['0']->plan_price;
           }
           else
           {
           		echo "";
           }
            ?></td>

           <td>
          <form action="<?php echo $paypal_url; ?>" method="post" name="frmPayPal1">
		    <input type="hidden" name="business" value="<?php if(isset($paypal_id))
		    {
		    	echo $paypal_id;
		    }; ?>">
		    <input type="hidden" name="cmd" value="_xclick">
		    <input type="hidden" name="item_name" value="<?php if(isset($row_plan_name['0']->plan_name))
		    {
		    	echo $row_plan_name['0']->plan_name;
		    }; ?>">
		     <input type="hidden" name="item_number" value="1">
		    <input type="hidden" name="credits" value="510">
		    <input type="hidden" name="userid" value="1">
		    <input type="hidden" name="amount" value="<?php if(isset($row_plan_name['0']->plan_price))
		    {
		    	echo $row_plan_name['0']->plan_price;
		    }; ?>">
		    <input type="hidden" name="cpp_header_image" value="http://cmexpertiseinfotech.com/wp-content/uploads/2016/07/logo-small.png">
		    <input type="hidden" name="no_shipping" value="1">
		    <input type="hidden" name="rm" value="2">
			<input type="hidden" name="cbt" value="Please Click Here to Complete Payment">
		    <input type="hidden" name="currency_code" value="USD">
		    <input type="hidden" name="handling" value="0">
		    <input type="hidden" name="cancel_return" value="<?php echo base_url(); ?>/index.php/client_invoice/client_recent_invoice/?cancel_return">
		    <input type="hidden" name="return" value="<?php echo base_url(); ?>/index.php/client_invoice/client_recent_invoice/">
		   	<a href="#"><input type="submit" value="
		   	<?php 
		   	$res_payment = $this->db->query("select * from payments where user_id='$adminid'");
		   	if($res_payment -> num_rows > 0)
		    {
		    	echo "Payment Completed";
		    }
		    else
		    {
		    	echo "Pending";
		    } 
		   	?>" class="btn btn-sucess"  /></a>
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

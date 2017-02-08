<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_invoice extends CI_Controller {

		public function invoice_generate()
		{
			$adminid = $this->input->post('adminid');
			$planid = $this->input->post('planid');
			$data = array(
				'admin_id' => $adminid,
				'plan_id' => $planid
				);
			$res_invoice_exist = $this->db->query("select * from invoice where admin_id='$adminid' and plan_id='$planid'");
			if($res_invoice_exist -> num_rows > 0)
			{
				echo "Invoice already generated";
			}
			else
			{
				$generate_invoice_request = $this->db->insert('invoice',$data);
				if($generate_invoice_request)
				{
						echo "Invoice Successfully generated..!";
				}
				else
				{	
						echo "Error in invoice...!";		
				}	
			}
		}
}

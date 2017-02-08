<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Client_invoice extends CI_Controller {

		public function client_recent_invoice()
		{
			$this->load->view('client_recent_invoice_list');
		}

}
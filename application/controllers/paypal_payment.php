<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal_payment extends CI_Controller 
{
		public function paypal_payment_pending()
		{
			$this->load->view('paypal_payment_view');
		}
		public function cancel_url()
		{
			$this->load->view('cancel_paypal_page');
		}
}


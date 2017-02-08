<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Zone_manager extends CI_Controller {

		public function add_zone_manager()
		{
			$this->load->view('admin_zone_manager');
		}

		public function list_zone_manager()
		{
			$this->load->view('list_zone_manager');
		}

		public function associate_with_client()
		{
			$this->load->view('associate_with_client');
		}
			
		public function associate_client_add()
		{
			// print_r($_REQUEST);
			$zone_name = $_REQUEST['zone_name'];
			$zone_manager_id = $_REQUEST['selected_value'];
			$ids = $_REQUEST['ids'];
			$id = explode( ',', $ids);
			foreach ($id as $singlevalue) {
					$this->db->where('id', $singlevalue);
					echo "update admin set zone_manager_id='$zone_manager_id' where id='$singlevalue'";
					$update_data = $this->db->query("update admin set zone_manager_id='$zone_manager_id' where id='$singlevalue'");
			}
			echo "Client's successfully Allocated";

		}

		public function insert_zone_manager()

			{
				print_r($_REQUEST);
				exit();
				parse_str($_SERVER['QUERY_STRING'],$_REQUEST);

				if(isset($_POST['id']))

				{

						parse_str($_SERVER['QUERY_STRING'],$_REQUEST);

						$name = $this->input->post('txtName');

						$email = $this->input->post('txtEmail');

						$phonenumber = $this->input->post('txtPhoneNumber');

						$password = $this->input->post('txtPassword');

						$confirmpassword = $this->input->post('txtConfirmPassword');

						$plan = $this->input->post('txtPlan');

						$address = $this->input->post('txtDesc1');

						$city_name = $this->input->post('city_id');

						$id = $_POST['id'];



						

						if($password != $confirmpassword)

						{

							echo "<script>";

							echo "alert('Password Doesnot Match')";

							echo "</script>";

						}



						$data = array(

								'fname' => $name,

								'email' => $email,

								'mobile' => $phonenumber,

								'password' => $password,

								'plan_id' => $plan,

								'address' => $address,

								'type' => '3'

							);



						$this->db->where('id', $id);

						$update_data = $this->db->update('admin',$data);

						$this->load->view('admin_add_client');

				}

				else

				{

						$name = $this->input->post('txtName');

						$email = $this->input->post('txtEmail');

						$phonenumber = $this->input->post('txtPhoneNumber');

						$password = $this->input->post('txtPassword');

						$confirmpassword = $this->input->post('txtConfirmPassword');

						$plan = $this->input->post('txtPlan');

						$address = $this->input->post('txtDesc1');

						$city_name = $this->input->post('city_id');

						if($password != $confirmpassword)

						{
							echo "<script>";
							echo "alert('Password Doesnot Match')";
							echo "</script>";
							$this->load->view('admin_add_client');
						}
						else
						{

  							$data = array(

									'fname' => $name,

									'email' => $email,

									'mobile' => $phonenumber,

									'password' => $password,

									'plan_id' => $plan,

									'address' => $address,

									'type' => '3'

								);
							$insert_data = $this->db->insert('admin',$data);

							$last_insert_id = $this->db->insert_id();

							$data = array(

								'city_name' => $city_name,

								'zone_admin_id' => $last_insert_id,

								'dt_added' => time(),

								'dt_updated' => time(),

								'status' => '1'

								);

							$insert_data = $this->db->insert('zone_data',$data);
							if($insert_data)
							{
									echo "<script>";
									echo "alert('Zone Manager successfully Added')";
									echo "</script>";
									$url = base_url().'index.php/zone_manager/list_zone_manager/';
						    		header("refresh:1;url=$url");
							}
							else
							{	
									echo "<script>";
									echo "Error in Insertion";
									echo "</script>";
							}	
						}
				}
			}
}


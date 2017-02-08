<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_client extends CI_Controller {



	public function edit_plan_list()

	{	

		$abcd = "new change for commit 4";
		
		$test = "test for pull git";

		$abc = "new test";

		$planname = $this->input->post('txtPlanName');

		$planprice = $this->input->post('txtPlanPrice');

		$id = 	$this->input->post('id');

		$data = array(

			'plan_name' => $planname,

			'plan_price' => $planprice

			);



		$this->db->where('id',$id);

		$update_data = $this->db->update('plans',$data);

		if($update_data)

		{

				echo "<script>";

				echo "alert('Plan successfully Updated')";

				echo "</script>";

				$url = base_url().'index.php/admin_client/select_plan_list/';

	    		header("refresh:0.5;url=$url");

		}

		else

		{

				echo "<script>";

				echo "alert('Error in Updation')";

				echo "</script>";

				$url = base_url().'index.php/admin_client/select_plan_list/';

	    		header("refresh:0.5;url=$url");

		}

	}

	public function select_plan_list()

	{

		$this->load->view('select_plan_list');

	}

	public function select_client_list()

	{

		$this->load->view('select_client_list_view');

	}

	public function select_client_list_paid_invoice()

	{

		$this->load->view('select_client_list_view_paid_invoice');

	}

	public function select_client_list_due_invoice()

	{

		$this->load->view('select_client_list_view_due_invoice');

	}

	

	public function add_client(){

			$this->load->view('admin_add_client');

	}

	public function insert_client()

	{

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

				$id = $_POST['id'];

				$zone_manager_id = $this->input->post('zone_manager_id'); 

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

						'zone_manager_id' => $zone_manager_id

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

				$zone_manager_id = $this->input->post('zone_manager_id');

				$city_name = $this->input->post('city_id');

				print_r($_REQUEST);

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

							'zone_manager_id' => $zone_manager_id

						);

					$insert_data = $this->db->insert('admin',$data);

					$last_insert_id = $this->db->insert_id();

							$data = array(

								'city_name' => $city_name,

								'client_id' => $last_insert_id,

								'dt_added' => time(),

								'dt_updated' => time(),

								'status' => '1'

								);

					$insert_data = $this->db->insert('client_city_data',$data);

					if($insert_data)

					{

							echo "<script>";

							echo "alert('Client successfully Added')";

							echo "</script>";

							$url = base_url().'index.php/admin_client/select_client_list/';

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

	public function select_user()

	{

		parse_str($_SERVER['QUERY_STRING'],$_REQUEST);

		$id = $_REQUEST['edit'];

		$result_client = $this->db->query("select * from admin where type='0' and id='$id'");

		$row_client = $result_client->result();

		$data = array(

			'email' => $row_client['0']->email,

			'fname' => $row_client['0']->fname,

			'lname' => $row_client['0']->lname,

			'password' => $row_client['0']->password,

			'mobile' => $row_client['0']->mobile,

			'plan' => $row_client['0']->plan,

			'address' => $row_client['0']->address,

			'id' => $row_client['0']->id

			);

		$this->load->view('admin_add_client',$data);		

	}

	public function remove_user()

	{

		$del_user = $this->db->query("delete from admin where id='".$_REQUEST['delete']."'");

			if($del_user)

			{

					echo "<script>";

					echo "alert('Client successfully Removed...!')";

					echo "</script>";

					$url = base_url().'index.php/admin_client/select_client_list/';

		    		header("refresh:0.5;url=$url");

			}

			else

			{	

					echo "<script>";

					echo "alert('Error in Deletion...!')";

					echo "</script>";

			}	

	}

	public function add_category()
	{
		$this->load->view('add_category_admin');
	}

	public function insert_category()
	{
		## Image Upload ##
		$this->load->library('upload');
		$files = $_FILES;

		$image = time().$files['image']['name'];

		$_FILES['image']['name']= time().$files['image']['name'];
		$_FILES['image']['type']= $files['image']['type'];
		$_FILES['image']['tmp_name']= $files['image']['tmp_name'];
		$_FILES['image']['error']= $files['image']['error'];
		$_FILES['image']['size']= $files['image']['size'];
		$this->upload->initialize($this->set_upload_options());
		$this->upload->do_upload('image');
		
		$name = $this->input->post('name');
		$adminid = $this->session->userdata('id');

		$data = array(
			'name' => $name,
			'admin_id' => $adminid,
			'category_image' => $image,
			'status' => '1',
			'dt_added' => strtotime(date('Y-m-d H:i:s')),
			'dt_updated' => strtotime(date('Y-m-d H:i:s'))
		);
		$insert_data = $this->db->insert('category',$data);
		if($insert_data)
		{
			echo "<script>";
			echo "alert('Category successfully Added')";
			echo "</script>";
			$url = base_url().'/index.php/admin_client/add_category';
			header("refresh:1;url=$url");
		}
		else
		{
			echo "Error in Insertion";
		}

	}

	## Image Upload Creditinals ##
	private function set_upload_options()
	{
		$config = array();
		$config['upload_path'] = './public/images/CATEGORIES';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']      = '0';
		$config['overwrite']     = TRUE;

		return $config;
	}

	public function select_business_sub_cat()
	{
		$business1 = $this->input->post('category');
		$result_sub_cat1 = $this->db->query("select category.id,subcategory.* From category LEFT JOIN subcategory ON category.id = subcategory.category_id where category.id = '$business1' AND category.name != '' AND subcategory.name != ''  ");
		$row_cat1 = $result_sub_cat1->result();

		echo "<option value='' > Select  Business </option>";
		foreach ($row_cat1 as $item) {
			echo "<option value='" . $item->id . "'>" . $item->name . "</option>";
		}
	}

	public function insert_sub_category()
	{
		$category_id = $this->input->post('select_category');
		$sub_category_name = $this->input->post('sub_name');

		$data = array(
			'category_id' => $category_id,
			'name' => $sub_category_name,
			'status' => '1',
			'dt_added' => strtotime(date('Y-m-d H:i:s')),
			'dt_updated' => strtotime(date('Y-m-d H:i:s'))
		);

		$insert_data = $this->db->insert('subcategory',$data);
		if($insert_data)
		{
			echo "<script>";
			echo "alert('Sub Category successfully added')";
			echo "</script>";
			$url = base_url().'/index.php/admin_client/add_category';
			header("refresh:1;url=$url");
		}
		else
		{
			echo "Error in Insertion";
		}

	}

	public function insert_sub_sub_category()
	{
		$category_id = $this->input->post('select_cat');
		$sub_category_id = $this->input->post('select_sub_cat');
		$sub_sub_category_name = $this->input->post('sub_sub_category');
		$adminid = $this->session->userdata('id');

		$data = array(
			'name' => $sub_sub_category_name,
			'category_id' => $category_id,
			'sub_category_id' => $sub_category_id,
			'timestamp' => date('Y-m-d H:i:s'),
			'admin_id' => $adminid
		);

		$insert_data = $this->db->insert('sub_sub_category',$data);
		if($insert_data)
		{
			echo "<script>";
			echo "alert('Sub sub category successfully added')";
			echo "</script>";
			$url = base_url().'/index.php/admin_client/add_category';
			header("refresh:1;url=$url");
		}
		else
		{
			echo "Error in Insertion";
		}
	}
}

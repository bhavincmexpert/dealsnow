<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Client_information extends CI_Controller {



	public function gallery()

	{

		$this->load->view('client_gallery');

	}

	public function edit_gallery()

	{

		$business3 = $this->input->post('business3');

		$adminid = $this->session->userdata('id');

		$select_image_gallery_user_wise = $this->db->query("SELECT * FROM `gallery_image` where admin_id='35' LIMIT 5");

		$row_select_image_gallery_user_wise = $select_image_gallery_user_wise->result();

		// print_r($row_select_image_gallery_user_wise);

					echo '<div class="col-md-12">';

		$i=0;

		foreach ($row_select_image_gallery_user_wise as $item) {

					echo '<img class="image'.$i.'" width="150" height="150" src='.base_url().'/public/business_gallery/'.$item->image_name.'>';

					echo '<a href="'.base_url().'index.php/client_area/image_remove/?delete='.$item->image_id.'"><img src="http://cmexpertiseinfotech.com/karenlee/admin/images/delete_new.png"/></a>';

		$i++;

		}

					echo '<div>';

	}

	function insert_gallery()

	{   

		// check for gallery existance or not



		$categoryid = $this->input->post('category_id');

		$subcatid = $this->input->post('sub_cat_id');

		$subsubcatid = $this->input->post('sub_sub_cat_id');

    	$adminid = $this->session->userdata('id');



    	$res_gallery = $this->db->query("select * from gallery where category_id='$categoryid' and subcategory_id='$subcatid' and sub_sub_categoryid='$subsubcatid' and admin_id='$adminid'");

    	if($res_gallery -> num_rows > 0)

    	{

    		// file upload code starts here

		    $this->load->library('upload');

		    $files = $_FILES;

		    $cpt = count($_FILES['userfile']['name']);

		    for($i=0; $i<$cpt; $i++)

		    {           

		        $_FILES['userfile']['name']= time().$files['userfile']['name'][$i];

		        $_FILES['userfile']['type']= $files['userfile']['type'][$i];

		        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];

		        $_FILES['userfile']['error']= $files['userfile']['error'][$i];

		        $_FILES['userfile']['size']= $files['userfile']['size'][$i];    

		        $this->upload->initialize($this->set_upload_options());

		        $this->upload->do_upload();

		        $data = array(

		        	'admin_id' => $adminid,

		        	'image_name' => $_FILES['userfile']['name'],

		        	'status' => 1

		        	);



		        $insert_gallery_images = $this->db->insert('gallery_image',$data);

		        if(!$insert_gallery_images)

		        {

		        		echo "<script>";

						echo "alert('Error in Insertion...!')";

						echo "</script>";

		        }

		    }

		    echo "<script>";

			echo "alert('Gallery Photo successfully Updated.',function(){window.location.reload(true);});";

			echo "</script>";

			$url = base_url().'/index.php/client_business/your_business/';

			header("refresh:1;url=$url");

		    // file upload code ends here

    	}

    	else

    	{

    		// gallery insert code starts here (gallery only once for particular business)



		    $data = array(

		    		'category_id' => $categoryid,

					'subcategory_id' => $subcatid,

					'sub_sub_categoryid' => $subsubcatid,

					'admin_id	' => $adminid,

					'status' => 1

		    		);



		    $insert_gallery = $this->db->insert('gallery',$data);	



		    // gallery insert code ends here (gallery only once for particular business)



		    	// file upload code starts here

		    $this->load->library('upload');

		    $files = $_FILES;

		    $cpt = count($_FILES['userfile']['name']);

		    for($i=0; $i<$cpt; $i++)

		    {           

		        $_FILES['userfile']['name']= time().$files['userfile']['name'][$i];

		        $_FILES['userfile']['type']= $files['userfile']['type'][$i];

		        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];

		        $_FILES['userfile']['error']= $files['userfile']['error'][$i];

		        $_FILES['userfile']['size']= $files['userfile']['size'][$i];    

		        $this->upload->initialize($this->set_upload_options());

		        $this->upload->do_upload();

		        $data = array(

		        	'admin_id' => $adminid,

		        	'image_name' => $_FILES['userfile']['name'],

		        	'status' => 1

		        	);



		        $insert_gallery_images = $this->db->insert('gallery_image',$data);

		        if(!$insert_gallery_images)

		        {

		        		echo "<script>";

						echo "alert('Error in Insertion...!')";

						echo "</script>";

		        }

		    }

		    echo "<script>";

			echo "alert('Gallery Photo successfully added.',function(){window.location.reload(true);});";

			echo "</script>";

			$url = base_url().'/index.php/client_business/your_business/';

			header("refresh:1;url=$url");

		    // file upload code ends here

    	}

	

	





	

	}

	private function set_upload_options()

	{   

	    //upload an image options

	    $config = array();

	    $config['upload_path'] = './public/business_gallery/';

	    $config['allowed_types'] = 'gif|jpg|png';

	    $config['max_size']      = '0';

	    $config['overwrite']     = TRUE;



	    return $config;

	}

	public function edit_insert_profile()

	{

			

			$name = $this->input->post('txtName');

			$lname = $this->input->post('txtLName');

			$email = $this->input->post('txtEmail');

			$phonenumber = $this->input->post('txtPhoneNumber');

			$password = $this->input->post('txtConfirmPassword');

			$confirmpassword = $this->input->post('txtPassword');

			$plan = $this->input->post('txtPlan');

			$desc1 = $this->input->post('txtDesc1');

			$adminid = $this->session->userdata('id');

			$data = array(

							'fname' => $name,

							'lname' => $lname,

							'email' => $email,

							'mobile' => $phonenumber,

							'password' => $password,

							'plan_id' => $plan,

							'address' => $desc1,

							);

			$this->db->where('id', $adminid);

			$update_data = $this->db->update('admin',$data);

			if($update_data)

			{

					

					echo "<script>";

					echo "alert('profile successfully Updated.')";

					echo "</script>";

					$url = base_url().'/index.php/client_area/edit_profile';

					header("refresh:0;url=$url");

			}

			else

			{

					echo "<script>";

					echo "alert('Error in Updation...!')";

					echo "</script>";

			}	

	}

	public function information()

	{

		$this->load->view('client_information');

	}

	public function edit_client()

	{

		$this->load->view('edit_client_offers');

	}

	public function insert_information()

	{

		echo "<pre>";

		print_r($_REQUEST);

		isset($_REQUEST['action']) ? $action = $_REQUEST['action'] : $action = '';

	}

	public function edit_insert_offer()

	{

				// Upload files Code starts Here



					$config =  array(

		              'upload_path'     => "./public/image_offers/",

		              'allowed_types'   => "gif|jpg|png|jpeg|pdf",

		              'overwrite'       => TRUE,

		              'max_size'        => "2048000",  // Can be set to particular file size

		              'max_height'      => "768",

		              'max_width'       => "1024"  

		            );    

					$this->load->library('upload', $config);

					$this->upload->do_upload();

					$upload_data = $this->upload->data();

					$imagename = $upload_data['file_name'];

					$adminid = $this->session->userdata('id');



			// Upload files Code starts Here



			$imagename = $upload_data['file_name'];

			if($imagename != "")

			{

						$name = $this->input->post('txtName');

						$image = $this->input->post('userfile');

						$desc = $this->input->post('txtDescription');

						$originalprice = $this->input->post('txtOriginalPrice');

						// $offerprice = $this->input->post('txtOfferPrice');

						$start = $this->input->post('txtStart');

						$search = '-';

						$trimmed_start = str_replace($search, '', $start);

						$startdb =  date("Y-m-d H:i:s",strtotime($trimmed_start));

						$end = $this->input->post('txtEnd');

						$trimmed_end = str_replace($search, '', $end);

						$enddb = date("Y-m-d H:i:s",strtotime($trimmed_end));

						$business2 = $this->input->post('txtBusiness2');

						$business1 = $this->input->post('txtBusiness1');

						$id = $this->input->post('id');



						$data = array(

										'title' => $name,

										'description' => $desc,

										'image' => $imagename,

										'original_price' => $originalprice,

										'start_date' => $startdb,

										'end_date' => $enddb,

										'category_id' => $business1,

										'subcategory_id' => $business2,

										'admin_id' => $adminid,

										);



						$this->db->where('id', $id);

						$update_data = $this->db->update('offers',$data);



						if($update_data)

						{

								// redirect('client_area/client_offers_list/');

								echo "<script>";

								echo "alert('Offer successfully Updated')";

								echo "</script>";

								$url = base_url().'/index.php/client_area/client_offers_list';

								header("refresh:0;url=$url");

						}

						else

						{

								echo "<script>";

								echo "alert('Error in Updation...!')";

								echo "</script>";

						}

			}

			else

			{

						$name = $this->input->post('txtName');

						$desc = $this->input->post('txtDescription');

						$originalprice = $this->input->post('txtOriginalPrice');

						// $offerprice = $this->input->post('txtOfferPrice');

						$start = $this->input->post('txtStart');

						$search = '-';

						$trimmed_start = str_replace($search, '', $start);

						$startdb =  date("Y-m-d H:i:s",strtotime($trimmed_start));

						$end = $this->input->post('txtEnd');

						$trimmed_end = str_replace($search, '', $end);

						$enddb = date("Y-m-d H:i:s",strtotime($trimmed_end));

						$business2 = $this->input->post('txtBusiness2');

						$business1 = $this->input->post('txtBusiness1');

						$id = $this->input->post('id');

						$data = array(

										'title' => $name,

										'description' => $desc,

										'original_price' => $originalprice,

										'start_date' => $startdb,

										'end_date' => $enddb,

										'category_id' => $business1,

										'subcategory_id' => $business2,

										'admin_id' => $adminid,

										);



						$this->db->where('id', $id);

						$update_data = $this->db->update('offers',$data);

						if($update_data)

						{

								

								// redirect('client_area/client_offers_list/');

								echo "<script>";

								echo "alert('Offer successfully Updated')";

								echo "</script>";

								$url = base_url().'/index.php/client_area/client_offers_list';

								header("refresh:0;url=$url");

						}

						else

						{

								echo "<script>";

								echo "alert('Error in Updation...!')";

								echo "</script>";

						}	

			}

	}



}
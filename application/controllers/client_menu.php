<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client_menu extends CI_Controller {

	public function client_menu1()
	{
		$this->load->view('client_menu');
	}
	public function insert_menu()
	{
		$business_id = $this->input->post('business_id');
		$categoryid = $this->input->post('category_id');
		$subcatid = $this->input->post('sub_cat_id');
		$subsubcatid = $this->input->post('sub_sub_cat_id');
    	$adminid = $this->session->userdata('id');

    	$res_menu = $this->db->query("select * from menu where category_id='$categoryid' and 
    		subcategory_id='$subcatid' and sub_sub_categoryid='$subsubcatid' and admin_id='$adminid' and business_id='$business_id'");
    	if($res_menu -> num_rows > 0)
    	{
    		// already menu exists starts here

    			$adminid = $this->session->userdata('id');
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
			        	'business_id' => $business_id,
			        	'image_name' => $_FILES['userfile']['name'],
			        	'status' => 1
			        	);
    	            
			        $insert_gallery_images = $this->db->insert('menu_image',$data);
			        if(!$insert_gallery_images)
			        {
			        		echo "<script>";
							echo "alert('Error in Insertion...!')";
							echo "</script>";
			        }
			    }
			    echo "<script>";
				echo "alert('Menu Photo successfully Updated.',function(){window.location.reload(true);});";
				echo "</script>";
				$url = base_url().'/index.php/client_business/your_business/';
				header("refresh:1;url=$url");
			    // file upload code ends here
    		// already menu exists ends here 
    	}
    	else
    	{	
    				  
    			  // menu insert code starts here (menu only once for particular business)
				    $data = array(
				    		'business_id' => $business_id,
				    		'category_id' => $categoryid,
							'subcategory_id' => $subcatid,
							'sub_sub_categoryid' => $subsubcatid,
							'admin_id	' => $adminid,
							'status' => 1
				    		);

				    $insert_gallery = $this->db->insert('menu',$data);	
		  		  // menu insert code ends here (menu only once for particular business)
    				$adminid = $this->session->userdata('id');
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
				        	'business_id' => $business_id,
				        	'image_name' => $_FILES['userfile']['name'],
				        	'status' => 1
				        	);
				       
				        $insert_gallery_images = $this->db->insert('menu_image',$data);
				        if(!$insert_gallery_images)
				        {
				        		echo "<script>";
								echo "alert('Error in Insertion...!')";
								echo "</script>";
				        }
				    }
				    echo "<script>";
					echo "alert('Menu Photo successfully added.',function(){window.location.reload(true);});";
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
	public function timing_description_insert()
	{
		$business_id = $this->input->post('business_id');
		$categoryid = $this->input->post('category_id');
		$subcatid = $this->input->post('sub_cat_id');
		$subsubcatid = $this->input->post('sub_sub_cat_id');
    	$adminid = $this->session->userdata('id');
    	$data_timing = $this->input->post('hide');
    	$description = $this->input->post('description');

		$res_timing_description_business = $this->db->query("select * from timing_business where business_id='$business_id' and admin_id='$adminid'");
		$row_timing_description_business = $res_timing_description_business->result();
		$id = $row_timing_description_business['0']->id;
		if($res_timing_description_business -> num_rows > 0)
		{
			// already exists data (Update)

		    $data = array(
		    		'category_id' => $categoryid,
		    		'business_id' => $business_id,
					'subcategory_id' => $subcatid,
					'sub_sub_categoryid' => $subsubcatid,
					'admin_id	' => $adminid,
					'timing_json_array' => $data_timing,
					'description' => $description
		    		);
		    print_r($data);
		    exit();
		    $this->db->where('id',$id);
		    $insert_gallery = $this->db->update('timing_business',$data);	
		    if($insert_gallery)
		    {
		    	echo "<script>";
				echo "alert('Timing and description successfully Updated.',function(){window.location.reload(true);});";
				echo "</script>";
				$url = base_url().'/index.php/client_business/your_business/';
				header("refresh:1;url=$url");
		    }
		}
		else
		{
			// Timing description insert code starts here (Timing description only once for particular business)

		    $data = array(
		    		'category_id' => $categoryid,
		    		'business_id' => $business_id,
					'subcategory_id' => $subcatid,
					'sub_sub_categoryid' => $subsubcatid,
					'admin_id' => $adminid,
					'timing_json_array' => $data_timing,
					'description' => $description
		    		);

		    $insert_gallery = $this->db->insert('timing_business',$data);	

		    // Timing description insert code ends here (Timing description only once for particular business)
		    if($insert_gallery)
		    {
					echo "<script>";
					echo "alert('Timing and description successfully Added.',function(){window.location.reload(true);});";
					echo "</script>";
					$url = base_url().'/index.php/client_business/your_business/';
					header("refresh:1;url=$url");
		    }
		}

	}
}
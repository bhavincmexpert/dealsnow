<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client_menu extends CI_Controller {

	public function client_menu()
	{
		$this->load->view('client_menu');
	}
	
	// public function insert_menu()
	// {   
 //     	$adminid = $this->session->userdata('id');
	//     $this->load->library('upload');
	//     $files = $_FILES;
	//     $cpt = count($_FILES['userfile']['name']);
	//     for($i=0; $i<$cpt; $i++)
	//     {           
	//         $_FILES['userfile']['name']= time().$files['userfile']['name'][$i];
	//         $_FILES['userfile']['type']= $files['userfile']['type'][$i];
	//         $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
	//         $_FILES['userfile']['error']= $files['userfile']['error'][$i];
	//         $_FILES['userfile']['size']= $files['userfile']['size'][$i];    
	//         $this->upload->initialize($this->set_upload_options());
	//         $this->upload->do_upload();
	//         $data = array(
	//         	'admin_id' => $adminid,
	//         	'image_name' => $_FILES['userfile']['name'],
	//         	'status' => 1
	//         	);

	//         $insert_gallery_images = $this->db->insert('gallery_image',$data);
	//         if(!$insert_gallery_images)
	//         {
	//         		echo "<script>";
	// 				echo "alert('Error in Insertion...!')";
	// 				echo "</script>";
	//         }
	//     }
	//     echo "<script>";
	// 	echo "alert('Gallery Photo successfully added.',function(){window.location.reload(true);});";
	// 	echo "</script>";
	// 	$url = base_url().'/index.php/client_business/your_business/';
	// 	header("refresh:1;url=$url");
	//     // file upload code ends here
	// }
	// private function set_upload_options()
	// {   
	//     //upload an image options
	//     $config = array();
	//     $config['upload_path'] = './public/business_gallery/';
	//     $config['allowed_types'] = 'gif|jpg|png';
	//     $config['max_size']      = '0';
	//     $config['overwrite']     = TRUE;

	//     return $config;
	// }
}
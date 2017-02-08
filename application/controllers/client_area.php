<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Client_area extends CI_Controller
{


    public function edit_profile()
    {
        $this->load->view('client_edit_profile');
    }

    public function restaurants()
    {
        $this->load->view('client_restaurants');
    }

    public function restaurants1()
    {
        $this->load->view('client_restaurants_test');
    }

    public function client_offers()
    {
        $this->load->view('client_offers');
    }

    public function select_business_cat1()
    {
        $result_cat1 = $this->db->query("select * from category");
        $row_cat1 = $result_cat1->result();
        $data1 = array(
            'id' => $row_cat1['0']->id,
            'name' => $row_cat1['0']->name
        );
        $this->load->view('client_restaurants', $data1);
    }

    public function select_business_sub_cat()
    {
        $business1 = $this->input->post('business1');
        $result_sub_cat1 = $this->db->query("select category.id,subcategory.* From category LEFT JOIN subcategory ON category.id = subcategory.category_id where category.id = '$business1'");
        $row_cat1 = $result_sub_cat1->result();
        echo "<option value='' > Select  Business </option>";
        foreach ($row_cat1 as $item) {
            // echo $row_cat1['0']->id;
            echo "<option value='" . $item->id . "'>" . $item->name . "</option>";
        }
    }

    public function select_business_sub_sub_cat1()
    {
        $business2 = $this->input->post('business12');
        $result_sub_sub_cat1 = $this->db->query("select category.id,subcategory.*,sub_sub_category.* From category LEFT JOIN subcategory ON category.id = subcategory.category_id LEFT JOIN sub_sub_category ON sub_sub_category.id = subcategory.category_id where category.id = '$business2'");
        $row_sub_sub_cat1 = $result_sub_sub_cat1->result();
        echo "<option value='' > Select  Business </option>";
        foreach ($row_sub_sub_cat1 as $item_sub) {
            echo "<option value='" . $item_sub->id . "'>" . $item_sub->name . "</option>";
        }
    }

    public function image_remove()
    {
        $deleteid = $_REQUEST['del_id'];
        $delete_image = $this->db->query("delete from gallery_image where image_id='$deleteid'");
        if ($delete_image) {
            echo "success";
        }
    }

    public function image_remove_menu()
    {
        $deleteid = $_REQUEST['del_id'];
        $delete_image = $this->db->query("delete from menu_image where image_id='$deleteid'");
        if ($delete_image) {
            echo "success";
        }
    }

    public function offer_on_off()
    {
        $id = $this->input->post('id');
        $on_off = $this->input->post('on_off');

        $this->db->query("update offers set primary_offer='$on_off' where id='$id'");
    }

    public function insert_business()
    {

        $name = $this->input->post('txtName');
        $email = $this->input->post('txtEmail');
        $phone = $this->input->post('txtPhone');
        $cousine = $this->input->post('txtCousine');
        $address = $this->input->post('txtAddress');
        $website = $this->input->post('txtWebsite');
        $facebook = $this->input->post('txtFacebook');
        $twitter = $this->input->post('txtTwitter');
        $business1 = $this->input->post('txtBusiness1');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        $city = $this->input->post('city');
        /*$business2 = $this->input->post('txtBusiness2');
        $business3 = $this->input->post('txtBusiness3');
        $business4 = $this->input->post('txtBusiness4');*/

        $adminid = $this->session->userdata('id');

        ## Image Upload ##
        $this->load->library('upload');
        $files = $_FILES;

        $business_image_name = time() . $files['business_image']['name'];

        $_FILES['business_image']['name'] = time() . $files['business_image']['name'];
        $_FILES['business_image']['type'] = $files['business_image']['type'];
        $_FILES['business_image']['tmp_name'] = $files['business_image']['tmp_name'];
        $_FILES['business_image']['error'] = $files['business_image']['error'];
        $_FILES['business_image']['size'] = $files['business_image']['size'];
        $this->upload->initialize($this->set_upload_options());
        $this->upload->do_upload('business_image');
        $city_data = array(
            'city_name' => $city
        );
        $this->db->insert('city_data', $city_data);
        $last_city_id = $this->db->insert_id();
        $data = array(
            'name' => $name,
            'email' => $email,
            'mobile' => $phone,
            'cousine' => $cousine,
            'address' => $address,
            'website' => $website,
            'facebook' => $facebook,
            'twitter' => $twitter,
            'category_id' => $business1,
            'admin_id' => $adminid,
            'business_image' => $business_image_name,
            'city_id' => $last_city_id,
            'latitude' => $latitude,
            'longitude' => $longitude
        );
        $insert_data = $this->db->insert('information_business', $data);
        if ($insert_data) {
            echo "<script>";
            echo "alert('Business successfully Added')";
            echo "</script>";
            $url = base_url() . '/index.php/client_area/restaurants1';
            header("refresh:0.1;url=$url");
        } else {
            echo "Error in Insertion";
        }

    }

    ## Image Upload Creditinals ##
    private function set_upload_options()
    {
        $config = array();
        $config['upload_path'] = './public/images/business_image';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '0';
        $config['overwrite'] = TRUE;

        return $config;
    }

    public function insert_offer()
    {
        // Upload files Code starts Here

        $image_name = $_FILES['userfile']['name'];
        $imagename = time() . $image_name;
        $config = array(
            'upload_path' => "./public/image_offers",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => TRUE,
            'max_size' => "2048000",  // Can be set to particular file size
            'max_height' => "768",
            'max_width' => "1024",
            'file_name' => $imagename
        );
        $this->load->library('upload', $config);
        $this->upload->do_upload();
        $upload_data = $this->upload->data();
        $adminid = $this->session->userdata('id');

        // Upload files Code starts Here

        $name = $this->input->post('txtName');
        $image = $this->input->post('userfile');
        $desc = $this->input->post('txtDescription');
        $originalprice = $this->input->post('txtOriginalPrice');
        $offerprice = $this->input->post('txtOfferPrice');
        $start = $this->input->post('txtStart');
        $search = '-';
        $trimmed_start = str_replace($search, '', $start);
        $startdb = date("Y-m-d H:i:s", strtotime($trimmed_start));
        $end = $this->input->post('txtEnd');
        $trimmed_end = str_replace($search, '', $end);
        $enddb = date("Y-m-d H:i:s", strtotime($trimmed_end));
        $business2 = $this->input->post('txtBusiness2');
        $business1 = $this->input->post('txtBusiness1');
        $business_id = $this->input->post('txtBusiness3');
        $discount = $this->input->post('discount');

        $data = array(
            'title' => $name,
            'description' => $desc,
            'image' => $imagename,
            'original_price' => $originalprice,
            'offer_price' => $offerprice,
            'start_date' => $startdb,
            'end_date' => $enddb,
            'category_id' => $business1,
            'subcategory_id' => $business2,
            'business_id' => $business_id,
            'admin_id' => $adminid,
            'discount' => $discount
        );
        $insert_data = $this->db->insert('offers', $data);

        if ($insert_data) {
            echo "<script>";
            echo "alert('Offer successfully Added')";
            echo "</script>";
            $url = base_url() . '/index.php/client_area/client_offers';
            header("refresh:1;url=$url");
        } else {
            echo "<script>";
            echo "alert('Error in Insertion of Offers')";
            echo "</script>";
        }
    }

    public function test()
    {
        $this->load->view('bootstrap_Test');
    }

    public function client_offers_list()
    {
        $this->load->view('client_offers_list');
    }

    public function single_delete_offer_list()
    {

        $ids = $_REQUEST['ids'];

        $this->db->where('id', $ids);
        $this->db->delete('offers');

        ob_get_clean();
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        echo json_encode(['status'=>1]);
        exit;
    }

    public function append_business_data()
    {
        $adminid = $this->session->userdata('id');
        $business_id = $_REQUEST['business_id'];

        $result_client = $this->db->query("select o.*, b.name as business_name  from offers as o  LEFT JOIN  information_business as b ON b.id = o.business_id where o.admin_id='$adminid' AND business_id = '$business_id' order by o.id DESC ");
        $row_client = $result_client->result();


        foreach ($row_client as $row) {

            $off =  ($row->primary_offer =='0')? "selected" : "";
            $on =  ($row->primary_offer =='1')? "selected" : "";

            $html = '
				<tr class="gradeA">
					<td>
						<input type="hidden" name="id" id="id" value="<?php echo $row->id; ?>">
						<img width="200" height="200" src=" ' . base_url() . '/public/image_offers/' . $row->image . '">
					</td>
					<td> ' . $row->title . ' </td>
					<td> ' . $row->description . '</td>
					<td> ' . $row->start_date . ' </td>
					<td> ' . $row->end_date . ' </td>
					<td> ' . $row->original_price . ' </td>
					<td> ' . $row->discount . ' </td>
					<td>
						<div class="form-group">
							<label></label>
							<select name="offer_dropdown" id="offer_dropdown" onchange="offer_dropdown(' . $row->id . ')">
								<option value="0" '. $off .' > OFF </option>
								<option value="1" '. $on .' > ON </option>
							</select>
						</div>
					</td>
					<td>
						<a href="' . base_url() . 'index.php/client_information/edit_client/?edit=' . $row->id . '">
							<img src="' . base_url() . '/public/images/edit_new.png"/>
						</a>
					</td>
					<td>
						<a href="' . base_url() . 'index.php/client_information/edit_client/?delete=' . $row->id . '">
							<img src="' . base_url() . '/public/images/delete_new.png"/>
						</a>
					</td>
				</tr>
			';

            echo $html;
        }

        return;
        exit();
    }
}

?>
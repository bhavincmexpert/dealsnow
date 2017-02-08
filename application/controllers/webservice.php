<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webservice extends CI_Controller 

{

		function login()

		{

				if(isset($_REQUEST['email']) && isset($_REQUEST['password']))

				{

							//converts query string into global GET array variable

							$email = $_REQUEST['email'];

							$password = $_REQUEST['password'];

						  	$result_login = $this->db->query("select * from admin where email='$email' and password='$password' and type='2'");

						  	if($result_login ->num_rows > 0)

						  	{	

						  			$response = array();

									$data ["success"] = 1;

									$data ["message"] = "Login Successfully...!";

								  	$row_login = $result_login->result();

								    foreach ($row_login as $row) 

							        {	

							        		$data['User Id'] = $row->id;

										  	$data['Email'] = $row->email;

										  	$data['Password'] = $row->password;

										  	$data['Name'] = $row->fname;

										  	$data['Phone Number'] = $row->mobile;

							        }



							        $output2 = json_encode(array('responsedata' => $data));

									echo $output2;

						    }

						  
						    else

						    {

						    		$response = array();

									$response ["success"] = 0;			

									$response ["message"] = "Invalid Login.";

									$output2 = json_encode(array('responsedata' => $response));

									echo $output2;

						    }   
						 

				}

				else

			    {

			    		$response = array();

						$response ["success"] = 0;			

						$response ["message"] = "Error.";

						$output2 = json_encode(array('responsedata' => $response));

						echo $output2;

			    }			

		}

		function registration()

		{	



			if(isset($_REQUEST['email']) && isset($_REQUEST['password']) && isset($_REQUEST['name']) && isset($_REQUEST['phone_number']))
			{

				$email = $_REQUEST['email'];

				$phonenumber = $_REQUEST['phone_number'];

				$name = $_REQUEST['name'];

				$password = $_REQUEST['password'];

				$data = array(

					'email'=> $email,

					'password' => $password,

					'fname' => $name,

					'mobile' => $phonenumber,

					'type' => '2'

					);


				$insert_data = $this->db->insert('admin',$data);

				if($insert_data)

				{

						$response = array();

						$response ["success"] = 1;			

						$response ["message"] = "User Successfully Registered.";

						$output2 = json_encode(array('responsedata' => $response));

						echo $output2;

				}

				else

				{	

						$response = array();

						$response ["success"] = 0;			

						$response ["message"] = "Error.";

						$output2 = json_encode(array('responsedata' => $response));

						echo $output2;

				}

			}

			else

			{



						$response = array();

						$response ["success"] = 0;			

						$response ["message"] = "Error.";

						$output2 = json_encode(array('responsedata' => $response));

						echo $output2;

			}	

		}

		function edit_user()

		{

			if(isset($_REQUEST['email']) && isset($_REQUEST['phone_number']) && isset($_REQUEST['name']) && isset($_REQUEST['user_id']))

				{
								$email = $_REQUEST['email'];
								$phone_number = $_REQUEST['phone_number'];
								$user_id = $_REQUEST['user_id'];
								$name = $_REQUEST['name'];
								$data = array(

									'email'=> $email,

									'fname' => $name,

									'mobile' => $phone_number,

									);



								$this->db->where('id', $user_id);

								$update_data = $this->db->update('admin',$data);

								if($update_data)

								{

										$response = array();

										$response ["success"] = 1;			

										$response ["message"] = "User's Information Successfully Updated.";

										// $response['User Id'] = $row_login['0']->user_id;

									 //  	$response['Email'] = $row_login['0']->email;

									 //  	$response['Name'] = $row_login['0']->name;

									 //  	$response['Phone Number'] = $row_login['0']->phone_number;

										$output2 = json_encode(array('responsedata' => $response));

										echo $output2;

								}

								else

								{	

										$response = array();

										$response ["success"] = 0;			

										$response ["message"] = "Error.";

										$output2 = json_encode(array('responsedata' => $response));

										echo $output2;

								}

				}

				else

				{

								$response = array();

								$response ["success"] = 0;			

								$response ["message"] = "Error.";

								$output2 = json_encode(array('responsedata' => $response));

								echo $output2;

				}

		}

		function  list_user()

		{	 



					$res_login = $this->db->query("select * from user_registration");

					$row_login = $res_login -> result();

					

					$response['success'] = "1";

					$response['message'] = "List found";

					$response["data"] = array();

					$counter = 0;



					foreach($row_login as $row)

					{

							$data = array();





							$data['Email Address'] = $row->email;

							$data['Password'] = $row->password;

				  			$data['Date'] = $row->date;

				  			$data['Name'] = $row->name;

							array_push($response["data"], $data);

							$counter++;

					}

					echo $output2 = json_encode(array('responsedata' => $response));

		}

		public function change_password()

		{

			if(isset($_REQUEST['current_password']) && isset($_REQUEST['new_password']) && isset($_REQUEST['user_id']))

			{

				$current_password = $_REQUEST['current_password'];

				$new_password = $_REQUEST['new_password'];

				$user_id = $_REQUEST['user_id'];



				$res_current_password = $this->db->query("select * from admin where password='$current_password' and id='$user_id'");

				if($res_current_password -> num_rows > 0)

				{

						$data = array(

							'password' => $new_password

							);



						$this->db->where('id',$user_id);

						$this->db->update('admin',$data);	

						$response = array();

						$response ["success"] = 1;			

						$response ["message"] = "Password is Successfully Updated..!";

						$output2 = json_encode(array('responsedata' => $response));

						echo $output2;

				}

				else

				{

						$response = array();

						$response ["success"] = 0;			

						$response ["message"] = "Current Password is Wrong..!";

						$output2 = json_encode(array('responsedata' => $response));

						echo $output2;

				}

			}

			else

				{

						$response = array();

						$response ["success"] = 0;			

						$response ["message"] = "Error...!";

						$output2 = json_encode(array('responsedata' => $response));

						echo $output2;

				}

		}

		public function forgot_password()

		{

			if(isset($_REQUEST['email']))

			{

					$email = $_REQUEST['email'];



					$res_user = $this->db->query("select * from admin where email='$email'");

					$row_user = $res_user->result();

					$password = $row_user['0']->password;



					if($res_user -> num_rows() > 0)

					{

							$response = array();

							$response ["success"] = 1;			



							// Mail code starts here 



							 $this->load->library('email');



							  $config = Array(

							   'protocol' => 'smtp',

							   'smtp_host' => 'ssl://smtp.gmail.com',

							   'smtp_port' => 465,

							   'smtp_user' => 'neel.cmexpertise@gmail.com',

							   'smtp_pass' => 'neel@1255',

							   'mailtype'  => 'text',

							   'charset'   => 'utf-8'

							  );





							  //Mail Send

							    $from_email = 'sales@pos.com';

							    $subject = 'Password Reset';



							    $receipt = 'Your Password is:-'.$password;



							    $this->email->initialize($config);

							    $this->email->set_newline("\r\n");



							    $this->email->from($from_email);

							    $this->email->to($email);

							    $this->email->subject($subject);

							    $this->email->message($receipt);



							    if($this->email->send())

							    {

							    				

							    }

							    else

							    {

							    		 

							    }

							// Mail code ends here 



							$response ["message"] = "Password is successfully send on Your Email Address....";

							$output2 = json_encode(array('responsedata' => $response));

							echo $output2;

					}

					else

					{

							$response = array();

							$response ["success"] = 0;			

							$response ["message"] = "Email Address is not registered.";

							$output2 = json_encode(array('responsedata' => $response));

							echo $output2;

					}

				}

			else

			{

							$response = array();

							$response ["success"] = 0;			

							$response ["message"] = "Error.";

							$output2 = json_encode(array('responsedata' => $response));

							echo $output2;

			}

		}

		public function add_user_categories()

		{

				if(isset($_REQUEST['device_id']) && isset($_REQUEST['latitude']) && isset($_REQUEST['longitude']) && isset($_REQUEST['category_id_array']))



					$device_id = $_REQUEST['device_id'];

					$latitude = $_REQUEST['latitude'];

					$longitude = $_REQUEST['longitude'];

					$category_id_array = $_REQUEST['category_id_array'];



					$data = array(

						'device_id' => $device_id,

						'latitude' => $latitude,

						'longitude' => $longitude,

						'category_list' => $category_id_array,

						);



					$insert_data = $this->db->insert('user_catogories',$data);



					if($insert_data)

					{

							$response = array();

							$response ["success"] = 1;			

							$response ["message"] = "Added";

							$output2 = json_encode(array('responsedata' => $response));

							echo $output2;

					}

					else

					{

							$response = array();

							$response ["success"] = 0;			

							$response ["message"] = "Error.";

							$output2 = json_encode(array('responsedata' => $response));

							echo $output2;

					}

		}

		public function city_list()

		{

					$res_login = $this->db->query("select * from city_data");

					if($res_login -> num_rows > 0)

					{

							$row_login = $res_login -> result();

							$response['success'] = "1";

							$response['message'] = "List found";

							$response["data"] = array();

							$counter = 0;



							foreach($row_login as $row)

							{

									$data = array();

									$data['City Name'] = $row->city_name;

						  			$data['City Id'] = $row->city_id;

									array_push($response["data"], $data);

									$counter++;

							}

							echo $output2 = json_encode(array('responsedata' => $response));

					}

					else

					{

							$response = array();

							$response ["success"] = 0;			

							$response ["message"] = "Error.";

							$output2 = json_encode(array('responsedata' => $response));

							echo $output2;

					}

		}	

		public function list_categories()

		{

					$res_login = $this->db->query("select * from category");

					if($res_login -> num_rows > 0)

					{

							$row_login = $res_login -> result();

							$response['success'] = "1";

							$response['message'] = "List found";

							$response["data"] = array();

							$counter = 0;



							foreach($row_login as $row)

							{

									$data = array();

									$gunimage = $row->category_image;

									$data['Catgories Id'] = $row->id;

									$data['Category Image'] = $_SERVER["HTTP_HOST"]."/dealsnow/public/images/CATEGORIES/"."$gunimage";

									$data['Name'] = $row->name;

						  			$data['User Id'] = $row->admin_id;

						  			$data['Status'] = $row->status;

						  			$data['IsChecked'] = '0';

									array_push($response["data"], $data);

									$counter++;

							}

							echo $output2 = json_encode(array('responsedata' => $response));

					}

					else

					{

							$response = array();

							$response ["success"] = 0;			

							$response ["message"] = "Error.";

							$output2 = json_encode(array('responsedata' => $response));

							echo $output2;

					}

		}
		public function select_business_categorywise()
		{
			if(isset($_REQUEST['device_id']) && isset($_REQUEST['user_id']) && isset($_REQUEST['city_id']) && isset($_REQUEST['latitude']) && isset($_REQUEST['longitude']) && isset($_REQUEST['category_id_array']))
			{
					$device_id = $_REQUEST['device_id'];
					$user_id = $_REQUEST['user_id'];
					$city_id = $_REQUEST['city_id'];
					$latitude = $_REQUEST['latitude'];
					$longitude = $_REQUEST['longitude'];
					$category_id_array = $_REQUEST['category_id_array'];

					if($latitude == '' && $longitude == '' && $city_id == '')
					{
								$response = array();
								$response ["success"] = 0;			
								$response ["message"] = "Please select Location or City Name.";
								$output2 = json_encode(array('responsedata' => $response));
								echo $output2;
					}
					elseif($latitude != '' && $longitude != '' && $city_id == '')
					{	
						echo "SELECT * , ( 3959 * ACOS( COS( RADIANS(  '$latitude' ) ) * COS( RADIANS( latitude ) ) * COS( RADIANS( longitude ) - RADIANS(  '$longitude' ) ) + SIN( RADIANS(  '$latitude' ) ) * SIN( RADIANS( latitude ) ) ) ) AS distance, information_business.name AS business_name,information_business.id as business_Id FROM information_business LEFT JOIN category ON information_business.category_id = category.id LEFT JOIN offers ON offers.category_id = category.id WHERE category.id IN ($category_id_array) HAVING distance < 10 ORDER BY distance";
						$res_whole_criteria = $this->db->query("SELECT * , ( 3959 * ACOS( COS( RADIANS(  '$latitude' ) ) * COS( RADIANS( latitude ) ) * COS( RADIANS( longitude ) - RADIANS(  '$longitude' ) ) + SIN( RADIANS(  '$latitude' ) ) * SIN( RADIANS( latitude ) ) ) ) AS distance, information_business.name AS business_name,information_business.id as business_Id FROM information_business LEFT JOIN category ON information_business.category_id = category.id LEFT JOIN offers ON offers.category_id = category.id WHERE category.id IN ($category_id_array) HAVING distance < 10 ORDER BY distance");
						$row_whole_criteria = $res_whole_criteria->result();
						// echo "<pre>";
						// print_r($res_whole_criteria);
						// $business_id = $row_whole_criteria['0']->business_id;
						// // if(isset($business_id))
						// // {
						// // 		$response['success'] = "0";
						// // 		$response['message'] = "No data Found";
						// // 		$response["data"] = array();	
						// // }
						// // code for count business_wise_like starts here 
						// $like_count_businesswise = $this->db->query("SELECT COUNT( id ) AS business_wise_like FROM  `business_likes` WHERE business_id = '$business_id'");
						// $row_like_businesswise = $like_count_businesswise->result();
						// $businesswisecount = $row_like_businesswise['0']->business_wise_like;
						// // code for count business_wise_like ends here 

						if($res_whole_criteria -> num_rows > 0)
						{
								$counter = 0;
								$response['success'] = "1";
								$response['message'] = "List found for near by Business Data";
								$response["data"] = array();		
								foreach($row_whole_criteria as $row)
								{
										$data = array();
										$offerimage = $row->image;
										$businessimage = $row->business_image;
										$data['Primary Offer Discount'] = $row->discount;
										$data['Offer Image'] = $_SERVER["HTTP_HOST"]."/dealsnow/public/images/CATEGORIES/"."$offerimage";
										$data['Business Type'] = $row->name;
										$data['Business Name'] = $row->business_name;
										$data['Business Information']=$row->business_desc;
										$data['Business Image'] = $_SERVER["HTTP_HOST"]."/dealsnow/public/images/business_image/"."$businessimage";
 										$data['Offer Name'] = $row->title;
										$data['Offer Address'] = $row->address;
										$data['Phone Number'] = $row->mobile;
										$data['Original Price'] = $row->original_price;
										$data['business Id'] = $row->business_Id;
	

		    echo $business_id = $row->business_Id;


			// code for count business_wise_like starts here 
			$like_count_businesswise = $this->db->query("SELECT COUNT( id ) AS business_wise_like FROM  `business_likes` WHERE business_id = '$business_id' and status='1'");
			$row_like_businesswise = $like_count_businesswise->result();
			$businesswisecount = $row_like_businesswise['0']->business_wise_like;
			// code for count business_wise_like ends here 


		// // code for count business_wise_like starts here 
		// $like_count_businesswise = $this->db->query("SELECT COUNT( id ) AS business_wise_like FROM  `business_likes` WHERE business_id = '$business_id'");
		// $row_like_businesswise = $like_count_businesswise->result();
		// $businesswisecount = $row_like_businesswise['0']->business_wise_like;
		// // code for count business_wise_like ends here 

										$data['Expiry Date']= $row->end_date;
										$data['Latitude']= $row->latitude;
										$data['Longitude']= $row->longitude;
										// $user_id = $_REQUEST['user_id'];
		// code for like status starts here 
										if($user_id == '')
										{
											$data['Like Status'] = '0';	
										}
										else
										{
		//echo "SELECT * FROM business_likes WHERE user_id = '$user_id' and business_id='$business_id'";
		$like_status = $this->db->query("SELECT * FROM business_likes WHERE user_id = '$user_id' and business_id='$business_id'");
		$row_like_status = $like_status->result();
		if($like_status -> num_rows > 0)
		{
				
				$data['Like Status'] = $row_like_status['0']->status;	
			
		}
		else
		{
			$data['Like Status'] = '0';	
		}
		
										}
		// code for like status ends here
		// code for favorites status starts here 
										if($user_id == '')
										{
											$data['Favorite Status'] = '1';	
										}
										else
										{
												$fav_status = $this->db->query("SELECT * FROM `favorite` where user_id = '$user_id' and business_id = '$business_id'");
												$row_fav_status = $fav_status->result();
												if($fav_status -> num_rows > 0)
												{
													$data['Favorite Status'] = $row_fav_status['0']->status;		
												}
												else
												{
													$data['Favorite Status'] = '1';	
												}
										}

		// code for favorites status ends here							

										$data['Like Count']= $businesswisecount;

		// code for open close array starts here
        // echo "SELECT * FROM `timing_business` where business_id = '$business_id'";
		$res_open_close = $this->db->query("SELECT * FROM `timing_business` where business_id = '$business_id'");
		// echo "SELECT * FROM `timing_business` where business_id = '$business_id'";
		// exit();
		if($res_open_close -> num_rows > 0)
		{
				$row_open_close = $res_open_close->result();
				$decoded_json = json_decode($row_open_close['0']->timing_json_array);
				//echo $row_open_close['0']->timing_json_array;
				$data['OpenClose Timing'] = $decoded_json;
		}
		else
		{	
				$blank_array = array();
				$data['OpenClose Timing'] = $blank_array;
		}
		
		// code for open close array ends here			
										array_push($response["data"], $data);
										$counter++;
								}
								echo $output2 = json_encode(array('responsedata' => $response));
						}
						else
						{
								$response = array();
								$response ["success"] = 0;			
								$response ["message"] = "Error.";
								$output2 = json_encode(array('responsedata' => $response));
								echo $output2;
						}
					}
					elseif($city_id != '' && $latitude == '' && $longitude == '')
					{
						// echo 'list for city wise data';
						echo "SELECT * , information_business.name AS business_name FROM information_business LEFT JOIN category ON information_business.category_id = category.id LEFT JOIN offers ON offers.category_id = category.id WHERE information_business.city_id =  '$city_id' AND category.id IN ($category_id_array)";
						$res_whole_criteria = $this->db->query("SELECT * , information_business.name AS business_name,information_business.id as business_Id FROM information_business LEFT JOIN category ON information_business.category_id = category.id LEFT JOIN offers ON offers.category_id = category.id WHERE information_business.city_id =  '$city_id' AND category.id IN ($category_id_array)");
						$row_whole_criteria = $res_whole_criteria->result();

						// $business_id = $row_whole_criteria['0']->business_id;
						// // code for count business_wise_like starts here 
						// $like_count_businesswise = $this->db->query("SELECT COUNT( id ) AS business_wise_like FROM  `business_likes` WHERE business_id = '$business_id'");
						// $row_like_businesswise = $like_count_businesswise->result();
						// $businesswisecount = $row_like_businesswise['0']->business_wise_like;
						// // code for count business_wise_like ends here 

						if($res_whole_criteria -> num_rows > 0)
						{

								$counter = 0;
								$response['success'] = "1";
								$response['message'] = "List found for CityWise Data";
								$response["data"] = array();		
								foreach($row_whole_criteria as $row)
								{
										$data = array();
										$offerimage = $row->image;
										$businessimage = $row->business_image;
										$data['Primary Offer Discount'] = $row->discount;
										$data['Offer Image'] = $_SERVER["HTTP_HOST"]."/dealsnow/public/images/CATEGORIES/"."$offerimage";
										$data['Business Type'] = $row->name;
										$data['Business Name'] = $row->business_name;
										$data['Business Information']=$row->business_desc;
										$data['Business Image'] = $_SERVER["HTTP_HOST"]."/dealsnow/public/images/business_image/"."$businessimage";
 										$data['Offer Name'] = $row->title;
										$data['Offer Address'] = $row->address;
										$data['Phone Number'] = $row->mobile;
										$data['Original Price'] = $row->original_price;
										$data['business Id'] = $row->business_Id;
	

		$business_id = $row->business_Id;
		// code for count business_wise_like starts here 
		$like_count_businesswise = $this->db->query("SELECT COUNT( id ) AS business_wise_like FROM  `business_likes` WHERE business_id = '$business_id' and status='1'");
		$row_like_businesswise = $like_count_businesswise->result();
		$businesswisecount = $row_like_businesswise['0']->business_wise_like;
		// code for count business_wise_like ends here 

										$data['Expiry Date']= $row->end_date;
										$data['Latitude']= $row->latitude;
										$data['Longitude']= $row->longitude;

		// code for like status starts here 
										if($user_id == '')
										{
											$data['Like Status'] = '0';	
										}
										else
										{
		
		$like_status = $this->db->query("SELECT * FROM business_likes WHERE user_id = '$user_id'");
		$row_like_status = $like_status->result();
		$data['Like Status'] = $row_like_status['0']->status;	
		
										}
		// code for like status ends here

		// code for favorites status starts here 
										if($user_id == '')
										{
											$data['Favorite Status'] = '1';	
										}
										else
										{
												$fav_status = $this->db->query("SELECT * FROM `favorite` where user_id = '$user_id' and business_id = '$business_id'");
												$row_fav_status = $fav_status->result();
												if($fav_status -> num_rows > 0)
												{
														$data['Favorite Status'] = $row_fav_status['0']->status;		
												}
												else
												{
													$data['Favorite Status'] = '1';	
												}
										}

		// code for favorites status ends here							

										$data['Like Count']= $businesswisecount;

		// code for open close array starts here
        // echo "SELECT * FROM `timing_business` where business_id = '$business_id'";
		$res_open_close = $this->db->query("SELECT * FROM `timing_business` where business_id = '$business_id'");
		if($res_open_close -> num_rows > 0)
		{
				$row_open_close = $res_open_close->result();
				$decoded_json = json_decode($row_open_close['0']->timing_json_array);
				//echo $row_open_close['0']->timing_json_array;
				$data['OpenClose Timing'] = $decoded_json;
		}
		else
		{
				$blank_array = array();
				$data['OpenClose Timing'] = $blank_array;
		}
		
		// code for open close array ends here			

										array_push($response["data"], $data);
										$counter++;
								}
								echo $output2 = json_encode(array('responsedata' => $response));
						}
						else
						{
								$response = array();
								$response ["success"] = 0;			
								$response ["message"] = "Error.";
								$output2 = json_encode(array('responsedata' => $response));
								echo $output2;
						}
					}
					else
					{	
						$response = array();
						$response ["success"] = 0;			
						$response ["message"] = "Error.";
						$output2 = json_encode(array('responsedata' => $response));
						echo $output2;
					}
			}
			else
			{
						$response = array();
						$response ["success"] = 0;			
						$response ["message"] = "Error in input parameter.";
						$output2 = json_encode(array('responsedata' => $response));
						echo $output2;
			}
		}

		public function select_business_categorywise_1()

		{

			if(isset($_REQUEST['device_id']) && isset($_REQUEST['city_id']) && isset($_REQUEST['latitude']) && isset($_REQUEST['longitude']) && isset($_REQUEST['category_id_array']))

			{
					$device_id = $_REQUEST['device_id'];
					$city_id = $_REQUEST['city_id'];
					$latitude = $_REQUEST['latitude'];
					$longitude = $_REQUEST['longitude'];
					$category_id_array = $_REQUEST['category_id_array'];
					if($latitude == '' && $longitude == '' && $city_id == '')
					{
						$res_whole_criteria = $this->db->query("SELECT *,information_business.name as business_name FROM `offers` INNER JOIN information_business ON offers.business_id =  information_business.id INNER JOIN category on category.id = offers.category_id where offers.primary_offer = '1'");
						$row_whole_criteria = $res_whole_criteria->result();
						if($res_whole_criteria -> num_rows > 0)
						{
								$response['success'] = "1";
								$response['message'] = "List found for all blank";
								$response["data"] = array();
								$counter = 0;
								foreach($row_whole_criteria as $row)
								{
										$data = array();
										$offerimage = $row->image;
										$businessimage = $row->business_image;
										$data['Primary Offer Discount'] = $row->discount;
										$data['Offer Image'] = $_SERVER["HTTP_HOST"]."/dealsnow/public/images/CATEGORIES/"."$offerimage";
											$data['Business Type'] = $row->name;
										$data['Business Name'] = $row->business_name;
										$data['Business Information']=$row->business_desc;
										$data['Business Image'] = $_SERVER["HTTP_HOST"]."/dealsnow/public/images/business_image/"."$businessimage";
										$data['Offer Name'] = $row->title;
										$data['Offer Address'] = $row->address;
										$data['Phone Number'] = $row->mobile;
										$data['Original Price'] = $row->original_price;
										$data['business Id'] = $row->business_id;
										$data['Expiry Date']= $row->end_date;
										$data['Latitude']= $row->latitude;
										$data['Longitude']= $row->longitude;
										$data['Like Status']= '0';
										$data['Favorite Status']= '1';
										$data['Like Count']= '12';
										array_push($response["data"], $data);
										$counter++;
								}
								echo $output2 = json_encode(array('responsedata' => $response));
						}
						else
						{
								$response = array();
								$response ["success"] = 0;			
								$response ["message"] = "Error.";
								$output2 = json_encode(array('responsedata' => $response));
								echo $output2;
						}
					}
					elseif($latitude != '' && $longitude != '' && $city_id == '')

					{

						$res_whole_criteria = $this->db->query("SELECT *,information_business.name as business_name FROM `offers` INNER JOIN information_business ON offers.business_id =  information_business.id INNER JOIN category on category.id = offers.category_id where offers.primary_offer = '1'");
						$row_whole_criteria = $res_whole_criteria->result();
						if($res_whole_criteria -> num_rows > 0)
						{
								$response['success'] = "1";
								$response['message'] = "List found for near by Business Data";
								$response["data"] = array();
								$counter = 0;
								foreach($row_whole_criteria as $row)
								{
										$data = array();
										$offerimage = $row->image;
										$businessimage = $row->business_image;
										$data['Primary Offer Discount'] = $row->discount;
										$data['Offer Image'] = $_SERVER["HTTP_HOST"]."/dealsnow/public/images/CATEGORIES/"."$offerimage";
										$data['Business Type'] = $row->name;
										$data['Business Name'] = $row->business_name;
										$data['Business Information']=$row->business_desc;
										$data['Business Image'] = $_SERVER["HTTP_HOST"]."/dealsnow/public/images/business_image/"."$businessimage";
 										$data['Offer Name'] = $row->title;
										$data['Offer Address'] = $row->address;
										$data['Phone Number'] = $row->mobile;
										$data['Original Price'] = $row->original_price;
										$data['business Id'] = $row->business_id;
										$data['Expiry Date']= $row->end_date;
										$data['Latitude']= $row->latitude;
										$data['Longitude']= $row->longitude;
										$data['Like Status']= '0';
										$data['Favorite Status']= '1';
										$data['Like Count']= '12';
										array_push($response["data"], $data);
										$counter++;
								}
								echo $output2 = json_encode(array('responsedata' => $response));
						}
						else
						{
								$response = array();
								$response ["success"] = 0;			
								$response ["message"] = "Error.";
								$output2 = json_encode(array('responsedata' => $response));
								echo $output2;
						}

					}

					elseif($city_id != '' && $latitude == '' && $longitude == '')

					{
						$res_whole_criteria = $this->db->query("SELECT *,information_business.name as business_name FROM `offers` INNER JOIN information_business ON offers.business_id =  information_business.id INNER JOIN category on category.id = offers.category_id where offers.primary_offer = '1'");
						$row_whole_criteria = $res_whole_criteria->result();
						if($res_whole_criteria -> num_rows > 0)
						{
								$response['success'] = "1";
								$response['message'] = "List found for CityWise business data";
								$response["data"] = array();
								$counter = 0;
								foreach($row_whole_criteria as $row)
								{
										$data = array();
										$offerimage = $row->image;
										$businessimage = $row->business_image;
										$data['Primary Offer Discount'] = $row->discount;
										$data['Offer Image'] = $_SERVER["HTTP_HOST"]."/dealsnow/public/images/CATEGORIES/"."$offerimage";
											$data['Business Type'] = $row->name;
										$data['Business Name'] = $row->business_name;
										$data['Business Information']=$row->business_desc;
										$data['Business Image'] = $_SERVER["HTTP_HOST"]."/dealsnow/public/images/business_image/"."$businessimage";
										$data['Offer Name'] = $row->title;
										$data['Offer Address'] = $row->address;
										$data['Phone Number'] = $row->mobile;
										$data['Original Price'] = $row->original_price;
										$data['business Id'] = $row->business_id;
										$data['Expiry Date']= $row->end_date;
										$data['Latitude']= $row->latitude;
										$data['Longitude']= $row->longitude;
										$data['Like Status']= '0';
										$data['Favorite Status']= '1';
										$data['Like Count']= '12';
										array_push($response["data"], $data);
										$counter++;
								}
								echo $output2 = json_encode(array('responsedata' => $response));
						}
						else
						{
								$response = array();
								$response ["success"] = 0;			
								$response ["message"] = "Error.";
								$output2 = json_encode(array('responsedata' => $response));
								echo $output2;
						}


					}

					else

					{

							$response = array();

							$response ["success"] = 0;			

							$response ["message"] = "Error.";

							$output2 = json_encode(array('responsedata' => $response));

							echo $output2;

					}	

			}

			else

			{

							$response = array();

							$response ["success"] = 0;			

							$response ["message"] = "Error in input parameter.";

							$output2 = json_encode(array('responsedata' => $response));

							echo $output2;

			}

		}

		public function select_offers_businesswise()
		{
			if(isset($_REQUEST['device_id']) && isset($_REQUEST['business_id']) && isset($_REQUEST['category_id_array']))
			{
					$device_id = $_REQUEST['device_id'];
					$business_id = $_REQUEST['business_id'];
					$category_id_array = $_REQUEST['category_id_array'];

					$res_offers_business = $this->db->query("SELECT *,ib.name as business_name  
					FROM information_business AS ib
					INNER JOIN offers AS o ON o.business_id = ib.id
					LEFT JOIN category AS c ON ib.category_id = c.id
					LEFT JOIN menu AS m ON m.business_id = ib.id
					WHERE ib.id =  '$business_id'");
					$row_offers_business = $res_offers_business->result();
					if($res_offers_business -> num_rows > 0)
					{
								$response['success'] = "1";
								$response['message'] = "List found for CityWise business data";
								$response["data"] = array();
								$counter = 0;
								foreach($row_offers_business as $row)
								{
										$data = array();
										$offerimage = $row->image;
										$businessimage = $row->business_image;
										$data['Offer Name'] = $row->discount;
										$data['Offer Image'] = $_SERVER["HTTP_HOST"]."/dealsnow/public/images/CATEGORIES/"."$offerimage";
										$data['Business Type'] = $row->name;
										$data['Business Name'] = $row->business_name;
										$data['Offer Name'] = $row->title;
										$data['Offer Address'] = $row->address;
										$data['Offer Discount'] = $row->discount;
										$data['Phone Number'] = $row->mobile;
										$data['Original Price'] = $row->original_price;
										$data['business Id'] = $row->business_id;
										$data['Start Date']= $row->start_date;
										$data['Expiry Date']= $row->end_date;
										$data['Latitude']= $row->latitude;
										$data['Longitude']= $row->longitude;
										array_push($response["data"], $data);
										$counter++;
								}
								echo $output2 = json_encode(array('responsedata' => $response));
					}
					else
					{
							$response = array();
							$response ["success"] = 0;			
							$response ["message"] = "No Offers for this business";
							$output2 = json_encode(array('responsedata' => $response));
							echo $output2;

					}
			}
			else
			{
							$response = array();
							$response ["success"] = 0;			
							$response ["message"] = "Error.";
							$output2 = json_encode(array('responsedata' => $response));
							echo $output2;

			}
		}

		public function select_menu_businesswise()
		{
			if(isset($_REQUEST['device_id']) && isset($_REQUEST['business_id']) && isset($_REQUEST['category_id_array']))
			{
					$device_id = $_REQUEST['device_id'];
					$business_id = $_REQUEST['business_id'];
					$category_id_array = $_REQUEST['category_id_array'];

					echo "SELECT * FROM menu AS m INNER JOIN menu_image AS mi ON mi.business_id = m.business_id WHERE mi.business_id =  '$business_id'";
					$res_offers_business = $this->db->query("SELECT * FROM menu AS m INNER JOIN menu_image AS mi ON mi.business_id = m.business_id WHERE mi.business_id =  '$business_id'");
					$row_offers_business = $res_offers_business->result();
					if($res_offers_business -> num_rows > 0)
					{
								$response['success'] = "1";
								$response['message'] = "List found for Businesswise Menu";
								$response["data"] = array();
								$counter = 0;
								foreach($row_offers_business as $row)
								{
										$data = array();
										$offerimage = $row->image_name;
										$data['Menu Image'] = $_SERVER["HTTP_HOST"]."/dealsnow/public/images/menu_image/"."$offerimage";
										array_push($response["data"], $data);
										$counter++;
								}
								echo $output2 = json_encode(array('responsedata' => $response));
					}
					else
					{
							$response = array();
							$response ["success"] = 0;			
							$response ["message"] = "Error in selection.";
							$output2 = json_encode(array('responsedata' => $response));
							echo $output2;

					}
			}
			else
			{
							$response = array();
							$response ["success"] = 0;			
							$response ["message"] = "Error.";
							$output2 = json_encode(array('responsedata' => $response));
							echo $output2;

			}
		}

		public function filter_discount()
		{
			if(isset($_REQUEST['device_id']) && isset($_REQUEST['user_id']) && isset($_REQUEST['city_id']) && isset($_REQUEST['category_id_array']) && isset($_REQUEST['discount']))
			{
					$device_id = $_REQUEST['device_id'];
					$user_id = $_REQUEST['user_id'];
					$city_id = $_REQUEST['city_id'];
					$category_id_array = $_REQUEST['category_id_array'];
					$discount = $_REQUEST['discount'];

					if($city_id == '' && $discount != '' && $category_id_array != '')
					{

						$res_whole_criteria = $this->db->query("SELECT *,information_business.name as business_name FROM  `offers` LEFT JOIN information_business ON offers.business_id = information_business.id LEFT JOIN category ON category.id = offers.category_id WHERE information_business.category_id IN ($category_id_array) and offers.discount >= '$discount'");
						$row_whole_criteria = $res_whole_criteria->result();
						if($res_whole_criteria -> num_rows > 0)
						{
								$response['success'] = "1";
								$response['message'] = "Filter discount wise on categories";
								$response["data"] = array();
								$counter = 0;
								foreach($row_whole_criteria as $row)
								{
										$business_id = $row->business_id;
										// code for count business_wise_like starts here 
										$like_count_businesswise = $this->db->query("SELECT COUNT( id ) AS business_wise_like FROM  `business_likes` WHERE business_id = '$business_id'  and status='1'");
										$row_like_businesswise = $like_count_businesswise->result();
										$businesswisecount = $row_like_businesswise['0']->business_wise_like;
										// code for count business_wise_like ends here 

										$data = array();
										$offerimage = $row->image;
										$businessimage = $row->business_image;
										$data['Business Information']=$row->business_desc;
										$data['Business Image'] = $_SERVER["HTTP_HOST"]."/dealsnow/public/images/business_image/"."$businessimage";
										$data['Primary Offer Discount'] = $row->discount;
										$data['Offer Image'] = $_SERVER["HTTP_HOST"]."/dealsnow/public/images/CATEGORIES/"."$offerimage";
										$data['Business Type'] = $row->name;
										$data['Business Name'] = $row->business_name;
										$data['Offer Name'] = $row->title;
										$data['Offer Address'] = $row->address;
										$data['Phone Number'] = $row->mobile;
										$data['Original Price'] = $row->original_price;
										$data['business Id'] = $row->business_id;
										$data['Expiry Date']= $row->end_date;
										$data['Latitude']= $row->latitude;
										$data['Longitude']= $row->longitude;
		// code for like status starts here 
										if($user_id == '')
										{
											$data['Like Status'] = '0';	
										}
										else
										{
		
		$like_status = $this->db->query("SELECT * FROM business_likes WHERE user_id = '$user_id'");
		$row_like_status = $like_status->result();
		$data['Like Status'] = $row_like_status['0']->status;	
		
										}
		// code for like status ends here
										
		// code for favorites status starts here 
										if($user_id == '')
										{
											$data['Favorite Status'] = '1';	
										}
										else
										{
												$fav_status = $this->db->query("SELECT * FROM `favorite` where user_id = '$user_id' and business_id = '$business_id'");
												$row_fav_status = $fav_status->result();
												if($fav_status -> num_rows > 0)
												{
														$data['Favorite Status'] = $row_fav_status['0']->status;		
												}
												else
												{
													$data['Favorite Status'] = '1';	
												}
										}

		// code for favorites status ends here			


										$data['Like Count']= $businesswisecount;

		// code for open close array starts here
        // echo "SELECT * FROM `timing_business` where business_id = '$business_id'";
		$res_open_close = $this->db->query("SELECT * FROM `timing_business` where business_id = '$business_id'");
		if($res_open_close -> num_rows > 0)
		{
				$row_open_close = $res_open_close->result();
				$decoded_json = json_decode($row_open_close['0']->timing_json_array);
				//echo $row_open_close['0']->timing_json_array;
				$data['OpenClose Timing'] = $decoded_json;
		}
		else
		{
				$blank_array = array();
				$data['OpenClose Timing'] = $blank_array;
		}
		
		// code for open close array ends here		

										array_push($response["data"], $data);
										$counter++;
								}
								echo $output2 = json_encode(array('responsedata' => $response));
						}
						else
						{
								$response = array();
								$response ["success"] = 0;			
								$response ["message"] = "No data.";
								$output2 = json_encode(array('responsedata' => $response));
								echo $output2;
						}


					}
					elseif($city_id == '' && $discount == '' && $category_id_array != '')
					{
						$res_whole_criteria = $this->db->query("SELECT *,information_business.name as business_name FROM  `offers` LEFT JOIN information_business ON offers.business_id = information_business.id LEFT JOIN category ON category.id = offers.category_id WHERE information_business.category_id IN ($category_id_array)");
						$row_whole_criteria = $res_whole_criteria->result();

						if($res_whole_criteria -> num_rows > 0)
						{
								$response['success'] = "1";
								$response['message'] = "Filter discount wise on categories";
								$response["data"] = array();
								$counter = 0;
								foreach($row_whole_criteria as $row)
								{


						$business_id = $row->business_id;
						// code for count business_wise_like starts here 
						$like_count_businesswise = $this->db->query("SELECT COUNT( id ) AS business_wise_like FROM  `business_likes` WHERE business_id = '$business_id' and status='1'");
						$row_like_businesswise = $like_count_businesswise->result();
						$businesswisecount = $row_like_businesswise['0']->business_wise_like;
						// code for count business_wise_like ends here 

										$data = array();
										$offerimage = $row->image;
										$businessimage = $row->business_image;
										$data['Business Information']=$row->business_desc;
										$data['Business Image'] = $_SERVER["HTTP_HOST"]."/dealsnow/public/images/business_image/"."$businessimage";
										$data['Primary Offer Discount'] = $row->discount;
										$data['Offer Image'] = $_SERVER["HTTP_HOST"]."/dealsnow/public/images/CATEGORIES/"."$offerimage";
										$data['Business Type'] = $row->name;
										$data['Business Name'] = $row->business_name;
										$data['Offer Name'] = $row->title;
										$data['Offer Address'] = $row->address;
										$data['Phone Number'] = $row->mobile;
										$data['Original Price'] = $row->original_price;
										$data['business Id'] = $row->business_id;
										$data['Expiry Date']= $row->end_date;
										$data['Latitude']= $row->latitude;
										$data['Longitude']= $row->longitude;
		// code for like status starts here 
										if($user_id == '')
										{
											$data['Like Status'] = '0';	
										}
										else
										{
		
		$like_status = $this->db->query("SELECT * FROM business_likes WHERE user_id = '$user_id'");
		$row_like_status = $like_status->result();
		$data['Like Status'] = $row_like_status['0']->status;	
		
										}
		// code for like status ends here
										
		// code for favorites status starts here 
										if($user_id == '')
										{
											$data['Favorite Status'] = '1';	
										}
										else
										{
												$fav_status = $this->db->query("SELECT * FROM `favorite` where user_id = '$user_id' and business_id = '$business_id'");
												$row_fav_status = $fav_status->result();
												if($fav_status -> num_rows > 0)
												{
														$data['Favorite Status'] = $row_fav_status['0']->status;		
												}
												else
												{
													$data['Favorite Status'] = '1';	
												}
										}

		// code for favorites status ends here			


										$data['Like Count']= $businesswisecount;

		// code for open close array starts here
        // echo "SELECT * FROM `timing_business` where business_id = '$business_id'";
		$res_open_close = $this->db->query("SELECT * FROM `timing_business` where business_id = '$business_id'");
		if($res_open_close -> num_rows > 0)
		{
				$row_open_close = $res_open_close->result();
				$decoded_json = json_decode($row_open_close['0']->timing_json_array);
				//echo $row_open_close['0']->timing_json_array;
				$data['OpenClose Timing'] = $decoded_json;
		}
		else
		{
				$blank_array = array();
				$data['OpenClose Timing'] = $blank_array;
		}
		
		// code for open close array ends here	

										array_push($response["data"], $data);
										$counter++;
								}
								echo $output2 = json_encode(array('responsedata' => $response));
						}
						else
						{
								$response = array();
								$response ["success"] = 0;			
								$response ["message"] = "No data.";
								$output2 = json_encode(array('responsedata' => $response));
								echo $output2;
						}

					}
					elseif($city_id != '' && $discount == '' && $category_id_array != '')
					{
						$res_whole_criteria = $this->db->query("SELECT *,information_business.name as business_name FROM  `offers` LEFT JOIN information_business ON offers.business_id = information_business.id LEFT JOIN category ON category.id = offers.category_id WHERE information_business.category_id IN ($category_id_array) and information_business.city_id='$city_id'");
						$row_whole_criteria = $res_whole_criteria->result();
						if($res_whole_criteria -> num_rows > 0)
						{
								$response['success'] = "1";
								$response['message'] = "filter city wise on categories";
								$response["data"] = array();
								$counter = 0;
								foreach($row_whole_criteria as $row)
								{

						$business_id = $row->business_id;
						// code for count business_wise_like starts here 
						$like_count_businesswise = $this->db->query("SELECT COUNT( id ) AS business_wise_like FROM  `business_likes` WHERE business_id = '$business_id' and status='1'");
						$row_like_businesswise = $like_count_businesswise->result();
						$businesswisecount = $row_like_businesswise['0']->business_wise_like;
						// code for count business_wise_like ends here 

										$data = array();
										$offerimage = $row->image;
										$businessimage = $row->business_image;
										$data['Business Information']=$row->business_desc;
										$data['Business Image'] = $_SERVER["HTTP_HOST"]."/dealsnow/public/images/business_image/"."$businessimage";
										$data['Primary Offer Discount'] = $row->discount;
										$data['Offer Image'] = $_SERVER["HTTP_HOST"]."/dealsnow/public/images/CATEGORIES/"."$offerimage";
										$data['Business Type'] = $row->name;
										$data['Business Name'] = $row->business_name;
										$data['Offer Name'] = $row->title;
										$data['Offer Address'] = $row->address;
										$data['Phone Number'] = $row->mobile;
										$data['Original Price'] = $row->original_price;
										$data['business Id'] = $row->business_id;
										$data['Expiry Date']= $row->end_date;
										$data['Latitude']= $row->latitude;
										$data['Longitude']= $row->longitude;
		// code for like status starts here 
										if($user_id == '')
										{
											$data['Like Status'] = '0';	
										}
										else
										{
											$like_status = $this->db->query("SELECT * FROM business_likes WHERE user_id = '$user_id'");
											$row_like_status = $like_status->result();
											$data['Like Status'] = $row_like_status['0']->status;	
										}
		// code for like status ends here
		// code for favorites status starts here 
										if($user_id == '')
										{
											$data['Favorite Status'] = '1';	
										}
										else
										{
												$fav_status = $this->db->query("SELECT * FROM `favorite` where user_id = '$user_id' and business_id = '$business_id'");
												$row_fav_status = $fav_status->result();
												if($fav_status -> num_rows > 0)
												{
														$data['Favorite Status'] = $row_fav_status['0']->status;		
												}
												else
												{
													$data['Favorite Status'] = '1';	
												}
										}

		// code for favorites status ends here			


										$data['Like Count']= $businesswisecount;
// code for open close array starts here
        // echo "SELECT * FROM `timing_business` where business_id = '$business_id'";
		$res_open_close = $this->db->query("SELECT * FROM `timing_business` where business_id = '$business_id'");
		if($res_open_close -> num_rows > 0)
		{
				$row_open_close = $res_open_close->result();
				$decoded_json = json_decode($row_open_close['0']->timing_json_array);
				//echo $row_open_close['0']->timing_json_array;
				$data['OpenClose Timing'] = $decoded_json;
		}
		else
		{
				$blank_array = array();
				$data['OpenClose Timing'] = $blank_array;
		}
		
		// code for open close array ends here		
										
										array_push($response["data"], $data);
										$counter++;
								}
								echo $output2 = json_encode(array('responsedata' => $response));
						}
						else
						{
								$response = array();
								$response ["success"] = 0;			
								$response ["message"] = "No data.";
								$output2 = json_encode(array('responsedata' => $response));
								echo $output2;
						}

					}
					elseif($city_id != '' && $discount != '' && $category_id_array != '')
					{
						$res_whole_criteria = $this->db->query("SELECT *,information_business.name as business_name FROM  `offers` INNER JOIN information_business ON offers.business_id = information_business.id INNER JOIN category ON category.id = offers.category_id WHERE information_business.category_id IN ($category_id_array) and information_business.city_id = '$city_id' and offers.discount >= '$discount'");
						$row_whole_criteria = $res_whole_criteria->result();
						if($res_whole_criteria -> num_rows > 0)
						{
								$response['success'] = "1";
								$response['message'] = "filter city wise with discount on categories";
								$response["data"] = array();
								$counter = 0;
								foreach($row_whole_criteria as $row)
								{
										$data = array();
										$offerimage = $row->image;
										$data['Primary Offer Discount'] = $row->discount;
										$businessimage = $row->business_image;
										$data['Business Information']=$row->business_desc;
										$data['Business Image'] = $_SERVER["HTTP_HOST"]."/dealsnow/public/images/business_image/"."$businessimage";
										$data['Offer Image'] = $_SERVER["HTTP_HOST"]."/dealsnow/public/images/CATEGORIES/"."$offerimage";
										$data['Business Type'] = $row->name;
										$data['Business Name'] = $row->name;
										$data['Offer Name'] = $row->title;
										$data['Offer Address'] = $row->address;
										$data['Phone Number'] = $row->mobile;
										$data['Original Price'] = $row->original_price;
										$data['business Id'] = $row->business_id;
										$data['Expiry Date']= $row->end_date;
										$data['Latitude']= $row->latitude;
										$data['Longitude']= $row->longitude;
										$data['Like Status']= '0';
										$data['Favorite Status']= '1';
										$data['Like Count']= '2';
										array_push($response["data"], $data);
										$counter++;
								}
								echo $output2 = json_encode(array('responsedata' => $response));
						}
						else
						{
								$response = array();
								$response ["success"] = 0;			
								$response ["message"] = "No data.";
								$output2 = json_encode(array('responsedata' => $response));
								echo $output2;
						}
					}
					else
					{
							$response = array();
							$response ["success"] = 0;			
							$response ["message"] = "Error.";
							$output2 = json_encode(array('responsedata' => $response));
							echo $output2;
					}
			}
			else
			{
					$response = array();
					$response ["success"] = 0;			
					$response ["message"] = "Error in input parameter.";
					$output2 = json_encode(array('responsedata' => $response));
					echo $output2;
			}
		}

		public function favorite_list_userwise()
		{
			if(isset($_REQUEST['user_id']) && isset($_REQUEST['category_id_array']))
			{
				$user_id = $_REQUEST['user_id'];
				$category_id_array = $_REQUEST['category_id_array'];
				$res_whole_criteria = $this->db->query("SELECT * , information_business.name AS business_name
FROM  `offers` INNER JOIN information_business ON offers.business_id = information_business.id INNER JOIN category ON category.id = offers.category_id LEFT JOIN favorite ON favorite.business_id = information_business.id WHERE category.id IN ($category_id_array) AND favorite.user_id = '$user_id'");
						$row_whole_criteria = $res_whole_criteria->result();

						if($res_whole_criteria -> num_rows > 0)
						{
								$response['success'] = "1";
								$response['message'] = "Filter discount wise on categories";
								$response["data"] = array();
								$counter = 0;
								foreach($row_whole_criteria as $row)
								{


						$business_id = $row->business_id;
						// code for count business_wise_like starts here 
						$like_count_businesswise = $this->db->query("SELECT COUNT( id ) AS business_wise_like FROM  `business_likes` WHERE business_id = '$business_id' and status='1'");
						$row_like_businesswise = $like_count_businesswise->result();
						$businesswisecount = $row_like_businesswise['0']->business_wise_like;
						// code for count business_wise_like ends here 

										$data = array();
										$offerimage = $row->image;
										$businessimage = $row->business_image;
										$data['Business Information']=$row->business_desc;
										$data['Business Image'] = $_SERVER["HTTP_HOST"]."/dealsnow/public/images/business_image/"."$businessimage";
										$data['Primary Offer Discount'] = $row->discount;
										$data['Offer Image'] = $_SERVER["HTTP_HOST"]."/dealsnow/public/images/CATEGORIES/"."$offerimage";
										$data['Business Type'] = $row->name;
										$data['Business Name'] = $row->business_name;
										$data['Offer Name'] = $row->title;
										$data['Offer Address'] = $row->address;
										$data['Phone Number'] = $row->mobile;
										$data['Original Price'] = $row->original_price;
										$data['business Id'] = $row->business_id;
										$data['Expiry Date']= $row->end_date;
										$data['Latitude']= $row->latitude;
										$data['Longitude']= $row->longitude;
		// code for like status starts here 
										if($user_id == '')
										{
											$data['Like Status'] = '0';	
										}
										else
										{
		
		$like_status = $this->db->query("SELECT * FROM business_likes WHERE user_id = '$user_id'");
		$row_like_status = $like_status->result();
		$data['Like Status'] = $row_like_status['0']->status;	
		
										}
		// code for like status ends here
										
		// code for favorites status starts here 
										if($user_id == '')
										{
											$data['Favorite Status'] = '1';	
										}
										else
										{
												$fav_status = $this->db->query("SELECT * FROM `favorite` where user_id = '$user_id' and business_id = '$business_id'");
												$row_fav_status = $fav_status->result();
												if($fav_status -> num_rows > 0)
												{
														$data['Favorite Status'] = $row_fav_status['0']->status;		
												}
												else
												{
													$data['Favorite Status'] = '1';	
												}
										}

		// code for favorites status ends here			


										$data['Like Count']= $businesswisecount;
										array_push($response["data"], $data);
										$counter++;
								}
								echo $output2 = json_encode(array('responsedata' => $response));
						}
						else
						{
								$response = array();
								$response ["success"] = 0;			
								$response ["message"] = "No data.";
								$output2 = json_encode(array('responsedata' => $response));
								echo $output2;
						}
				}
				else
				{
						$response = array();
						$response ["success"] = 0;			
						$response ["message"] = "Error in Input Parameter";
						$output2 = json_encode(array('responsedata' => $response));
						echo $output2;
				}
		}

		public function favorite_business()
		{
				if(isset($_REQUEST['user_id']) && isset($_REQUEST['business_id']) && isset($_REQUEST['status']))
				{
						$user_id = $_REQUEST['user_id'];
						$business_id = $_REQUEST['business_id'];
						$status = $_REQUEST['status'];

						$res_favorite = $this->db->query("select * from favorite where user_id='$user_id' and business_id='$business_id'");
						if($res_favorite -> num_rows > 0)
						{
							// update
							$data = array(
								'user_id' => $user_id,
								'business_id' => $business_id,
								'status' => $status,
								);
							$this->db->where(array('user_id' => $user_id,'business_id' => $business_id));
							$update_favorite = $this->db->update('favorite',$data);	
							if($update_favorite)
							{
									$response = array();
									$response ["success"] = 1;			
									$response ["message"] = "Favorite Updated successfully.";
									$output2 = json_encode(array('responsedata' => $response));
									echo $output2;
							}
							else
							{
									$response = array();
									$response ["success"] = 0;			
									$response ["message"] = "Error in updation.";
									$output2 = json_encode(array('responsedata' => $response));
									echo $output2;
							}
						}
						else
						{
							// insert
							$data = array(
								'user_id' => $user_id,
								'business_id' => $business_id,
								'status' => $status,
								);
							$insert_data = $this->db->insert('favorite',$data);
							if($insert_data)
							{
									$response = array();
									$response ["success"] = 1;			
									$response ["message"] = "Favorite Added successfully.";
									$output2 = json_encode(array('responsedata' => $response));
									echo $output2;
							}
							else
							{
									$response = array();
									$response ["success"] = 0;			
									$response ["message"] = "Error in insertion.";
									$output2 = json_encode(array('responsedata' => $response));
									echo $output2;
							}
						}
				}
				else
				{
							$response = array();
							$response ["success"] = 0;			
							$response ["message"] = "Error.";
							$output2 = json_encode(array('responsedata' => $response));
							echo $output2;
				}
		}

		public function write_feedback()
		{
			if(isset($_REQUEST['feedback_textarea']) && isset($_REQUEST['user_id']))
			{
				$feedback_textarea = $_REQUEST['feedback_textarea'];
				$userid = $_REQUEST['user_id'];
				$data = array(
					'feedback_textarea'=> $feedback_textarea,
					'user_id' => $userid
					);

				$insert_data = $this->db->insert('user_feedback',$data);
				if($insert_data)
				{
						$response = array();
						$response ["success"] = 1;			
						$response ["message"] = "Feedback Successfully Submitted.";
						$output2 = json_encode(array('responsedata' => $response));
						echo $output2;
				}
				else
				{	
						$response = array();
						$response ["success"] = 0;			
						$response ["message"] = "Error in feedback.";
						$output2 = json_encode(array('responsedata' => $response));
						echo $output2;
				}
			}
			else
			{	
					$response = array();
					$response ["success"] = 0;			
					$response ["message"] = "Error.";
					$output2 = json_encode(array('responsedata' => $response));
					echo $output2;
			}
		}
		
		public function like_business()
		{
				if(isset($_REQUEST['user_id']) && isset($_REQUEST['business_id']) && isset($_REQUEST['status']))
				{
						$user_id = $_REQUEST['user_id'];
						$business_id = $_REQUEST['business_id'];
						$status = $_REQUEST['status'];

						$res_favorite = $this->db->query("select * from business_likes where user_id='$user_id' and business_id='$business_id'");
						if($res_favorite -> num_rows > 0)
						{
							// update
							$data = array(
								'user_id' => $user_id,
								'business_id' => $business_id,
								'status' => $status,
								);
							$this->db->where(array('user_id' => $user_id,'business_id' => $business_id));
							$update_favorite = $this->db->update('business_likes',$data);	
							if($update_favorite)
							{
									$response = array();
									$response ["success"] = 1;			
									$response ["message"] = "Like Updated successfully.";
									$output2 = json_encode(array('responsedata' => $response));
									echo $output2;
							}
							else
							{
									$response = array();
									$response ["success"] = 0;			
									$response ["message"] = "Error in updation.";
									$output2 = json_encode(array('responsedata' => $response));
									echo $output2;
							}
						}
						else
						{
							// insert
							$data = array(
								'user_id' => $user_id,
								'business_id' => $business_id,
								'status' => $status,
								);
							$insert_data = $this->db->insert('business_likes',$data);
							if($insert_data)
							{
									$response = array();
									$response ["success"] = 1;			
									$response ["message"] = "Like Added successfully.";
									$output2 = json_encode(array('responsedata' => $response));
									echo $output2;
							}
							else
							{
									$response = array();
									$response ["success"] = 0;			
									$response ["message"] = "Error in insertion.";
									$output2 = json_encode(array('responsedata' => $response));
									echo $output2;
							}
						}
				}
				else
				{
							$response = array();
							$response ["success"] = 0;			
							$response ["message"] = "Error.";
							$output2 = json_encode(array('responsedata' => $response));
							echo $output2;
				}
		}

}
<?php  		

		include('header_client.php');   

		$result_client = $this->db->query("select * from information_business where id='".$_REQUEST['edit_details_business']."'");

		$row_client = $result_client->result();

?>	

	  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/jquery-ui.js" type="text/javascript"></script>

    <link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css"/>

    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBNEQCHUYPsekbYz7tym8Q4Ne2vlUsvnFc&sensor=false"></script>

    <script type="text/javascript">

        $(function () {

            $("#address").click(function () {

                $("#dialog").dialog({

                	

                    modal: true,

                    title: "Google Map",

                    width: 600,

                    hright: 450,

                    buttons: {

                        Close: function () {

                            $(this).dialog('close');

                        }

                    },

                    open: function () {

                        var mapOptions = {

                            center: new google.maps.LatLng(19.0606917, 72.836249),

                            zoom: 8,

                            mapTypeId: google.maps.MapTypeId.ROADMAP

                        }

                        var map = new google.maps.Map($("#dvMap")[0], mapOptions);



                        var myLatlng = new google.maps.LatLng(19.0606917, 72.836249);

                        var coords = new google.maps.LatLng();

                        var geocoder = new google.maps.Geocoder();

                        var infowindow = new google.maps.InfoWindow();



                        marker = new google.maps.Marker({

                            map: map,

                            position: myLatlng,

                            draggable: true

                        });



                        marker.setMap(map);



                        geocoder.geocode({'latLng': myLatlng }, function(results, status) {

                            if (status == google.maps.GeocoderStatus.OK) {

                                if (results[0]) {

                                    $('#address').val(results[0].formatted_address);

                                    $('#latitude').val(marker.getPosition().lat());

                                    $('#longitude').val(marker.getPosition().lng());

                                    infowindow.setContent(results[0].formatted_address);

                                    infowindow.open(map, marker);

                                }

                            }

                        });





                        google.maps.event.addListener(marker, 'dragend', function() {

                            geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {

                                if (status == google.maps.GeocoderStatus.OK) {

                                    if (results[0]) {

                                        $('#address').val(results[0].formatted_address);

                                        $('#latitude').val(marker.getPosition().lat());

                                        $('#longitude').val(marker.getPosition().lng());

                                        infowindow.setContent(results[0].formatted_address);

                                        infowindow.open(map, marker);

                                    }

                                }

                            });

                        });





                    }

                });

            });

        });

    </script>



	  <style>

        #myMap {

		   height: 600px;

		   width: 300px;

		}

      </style>

      <section class="vbox">          

        <section class="scrollable padder wrapper">            

            <div class="row">

            <form action="<?php echo base_url().'index.php/client_business/update_business/';  ?>" data-validate="parsley" enctype="multipart/form-data" method="post">

             <div class="col-sm-12">

             <header class="panel-heading form_panel">

                        <span class="h4">ADD Business</span>

             </header>

             <p class="text-muted">Please fill the information to continue</p>

             <div class="col-sm-6">

				<section class="panel panel-default">

	             <div class="panel-body">

	            <div class="form-group">

	                      <label>Business Name</label>

	                      <input type="text" name="txtName" value="<?php echo $row_client['0']->name; ?>" id="txtBusinessmain" class="form-control" required="" />                        

	             </div>

	             <div class="form-group">

	                      <label>Email Address</label>

	                      <input type="email" name="txtEmail" value="<?php echo $row_client['0']->email; ?>" id="txtEmail" class="form-control"  />                        

	             </div>

	             <div class="form-group">

	                      <label>Phone Number</label>

	                       <input type="tel" name="txtPhone" value="<?php echo $row_client['0']->mobile; ?>" id="txtPhone" class="form-control"  />    

	            </div>

	            <div class="form-group">

	                      <label>Cousine</label>

	                      <input type="text" name="txtCousine" value="<?php echo $row_client['0']->cousine; ?>" id="txtCousine" class="form-control" required="" /> 

	                      <input type="hidden" name="edit_details_business" 

	                      value="<?php echo $_REQUEST['edit_details_business']; ?>">                       

	            </div>

                </section>

            </div>

            <div class="col-sm-6">

				<section class="panel panel-default">

	             <div class="panel-body">

	            <div class="form-group">

	                      <label> Address</label>

	                      <input type="text" id="address" data-toggle="modal" data-target="" name="txtAddress" value="<?php echo $row_client['0']->address; ?>"  class="form-control abc address_open" />     

	                         <input type="hidden" id="latitude" placeholder="Latitude"/>

		           			 <input type="hidden" id="longitude" placeholder="Longitude"/>                   

	             </div>

	             <input id="btnShow" type="hidden" value="Show Maps"/>

			   	 <div id="dialog" style="display: none">

			        <div id="dvMap" style="height: 380px; width: 580px;">

			        </div>



			        <!-- <div>

			            Address:<br><textarea id="address" rows="5"></textarea><br/><br/>

			            Latitude:<br><input type="text" id="latitude" placeholder="Latitude"/><br><br/>

			            Longitude:<br><input type="text" id="longitude" placeholder="Longitude"/><br>

			        </div> -->

			   	 </div>

	             <div class="form-group">

	                      <label>WebSite</label>

	                      <input type="text" name="txtWebsite" value="<?php echo $row_client['0']->website; ?>" id="txtPlan" class="form-control" />                        

	             </div>

	             <div class="form-group">

	                      <label>Facebook Link</label>

	                      <input type="text" name="txtFacebook" value="<?php echo $row_client['0']->facebook; ?>" id="txtPlan" class="form-control" />                        

	             </div>

	             <div class="form-group">

	                      <label>Twitter Link</label>

	                      <input type="text" name="txtTwitter" value="<?php echo $row_client['0']->twitter; ?>" id="txtPlan" class="form-control"  />                        

	             </div>

            </section>

                 </div>

                </div>

		        <!-- bootstrap model pop up code starts here  -->

		          <div class="modal fade" id="myModal" role="dialog">

					    <div class="modal-dialog modal-lg">

					      <div class="modal-content">

					        <div class="modal-header">

					          <button type="button" class="close" data-dismiss="modal">&times;</button>

					          <h4 class="modal-title">Map View</h4>

					        </div>					        

					        <div class="modal-body">

					          <div id="myMap" class="Mymap1" style="width:100%;float:left;"></div>

					        </div>

					        <div class="modal-footer">

					          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

					        </div>

					      </div>

					    </div>

					  </div>

					</div>

		        <!-- bootstrap model pop up code ends here  -->

		        <footer class="panel-footer text-right bg-light lter">

	                    <button type="submit" class="btn btn-success btn-s-xs">Submit</button>

	                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="mycancel" class="modal fade bs-example-modal-sm">

	                        <div class="modal-dialog modal-sm">

	                            <div class="modal-content">

	                                <div class="modal-header">

	                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

	                                    <h4 class="modal-title"><i class="fa fa-building-o"></i> Plan Insert Master Alert</h4>

	                                </div>

	                                <div class="modal-body">

	                                    <i class="fa fa-question-circle"></i> Are You Sure To Go Back!

	                                </div>

	                                <div class="modal-footer">                          

	                                    <input type='button' value='Yes' class="btn btn-success btn-shadow" onclick=""/>

	                                    <button data-dismiss="modal" class="btn btn-danger btn-shadow" type="button">No</button>

	                                </div>                      

	                            </div>

	                        </div>

	                    </div>

						<!-- End Code for Cancle Alert-->

	                    <a href="" data-toggle='modal' class="btn btn-success btn-s-xs" name="cancel">Cancel</a>

	                  </footer>

                </form>

                </div>

			</section>

			</section>

			

   <?php  include('footer_client.php'); ?>
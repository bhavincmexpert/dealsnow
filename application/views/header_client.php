<?php 
   if ($this->session->userdata('email_client') == FALSE) 
   {
            redirect('Home/index');
   }
   // else
   // {
   //          redirect('home/login');
   // }

?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Deals Now</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

   <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBNEQCHUYPsekbYz7tym8Q4Ne2vlUsvnFc&sensor=false"></script>

   <script>
           $('#myModal').on('show.bs.modal', function (e) {
          google.maps.event.trigger(map, 'resize');
          $(".Mymap1").show();//Am not sure what is this?
        });
  </script>
  <script>
    $(document).ready(function(){
    $(".address_open").click(function(){
        google.maps.event.trigger(map, 'resize');
        $(".Mymap1").show();
    });
    });
    </script>
    <script type="text/javascript"> 
      var map;
      var marker;
      var coords = new google.maps.LatLng();
      var myLatlng = new google.maps.LatLng(23.022505,72.5713621);
      var geocoder = new google.maps.Geocoder();
      var infowindow = new google.maps.InfoWindow();
      function initialize(){
          var mapOptions = {
              zoom: 18,
              center: myLatlng,
              mapTypeId: google.maps.MapTypeId.ROADMAP
          };
     
          map = new google.maps.Map(document.getElementById("myMap"), mapOptions);
          google.maps.event.trigger(map, 'resize');
          marker = new google.maps.Marker({
              map: map,
              position: myLatlng,
              draggable: true 
          });     
          
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
      google.maps.event.addDomListener(window, 'load', initialize);
  </script>
  <!-- <script type="text/javascript"> 
      var map;
      var marker;
      var coords = new google.maps.LatLng();
      var myLatlng = new google.maps.LatLng(23.022505,72.5713621);
      var geocoder = new google.maps.Geocoder();
      var infowindow = new google.maps.InfoWindow();
      function initialize(){
          var mapOptions = {
              zoom: 18,
              center: myLatlng,
              mapTypeId: google.maps.MapTypeId.ROADMAP
          };
     
          map = new google.maps.Map(document.getElementById("myMap"), mapOptions);
          google.maps.event.trigger(map, 'resize');
          marker = new google.maps.Marker({
              map: map,
              position: myLatlng,
              draggable: true 
          });     
          
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
      google.maps.event.addDomListener(window, 'load', initialize);
  </script> -->  

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <script src="<?php echo base_url(); ?>/public/js/bootstrap.js"/></script>
  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/bootstrap.css" type="text/css" />


  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/bootstrap-datetimepicker.min.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/animate.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/font.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/js/calendar/bootstrap_calendar.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/app.css" type="text/css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/assets/bootstrap-datepicker/css/datepicker.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/assets/bootstrap-timepicker/compiled/timepicker.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/assets/bootstrap-datetimepicker/css/datetimepicker.css" />
  <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> -->
  
  </head>
  <body style="background-color: white;">
  <section class="vbox">
    <header class="bg-dark dk header navbar navbar-fixed-top-xs">
      <div class="navbar-header aside-md">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
          <i class="fa fa-bars"></i>
        </a>
        <a href="#" class="navbar-brand" data-toggle="fullscreen">  </a>        
      </div>
      <ul class="nav navbar-nav hidden-xs">
        <li class="dropdown">          
          <section class="dropdown-menu aside-xl on animated fadeInLeft no-borders lt">
          </section>
        </li>
      </ul>      
      <ul class="nav navbar-nav navbar-right m-n hidden-xs">       
        <li class="">
          <li class="">
               <a href="<?php echo base_url().'index.php/Home/logout/';  ?>">Logout</a>            
          </li>
        </li>
      </ul>      
    </header>
    <section>
      <section class="hbox stretch">       
        <aside class="bg-dark lter aside-md hidden-print" id="nav">          
          <section class="vbox">            
            <section class="w-f scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">                                
                <nav class="nav-primary hidden-xs">
                  <ul class="nav">
                    <li  class="active">
                      <a href="" class="active">
                        <i class="fa fa-dashboard icon">
                          <b class="bg-danger"></b>
                        </i>
                        <span>DashBoard</span>
                      </a>
                    </li>
                    <li>
                      <a href="#uikit">
                        <i class="fa fa-cog icon">
                          <b class="bg-success"></b>
                        </i>
                        <span class="pull-right">   
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>My Restaurent(s)</span>
                      </a>
                      <ul class="nav lt">
                        <li>
                            <a href="<?php echo base_url().'index.php/client_area/restaurants1/';?>">                            
                            <i class="fa fa-angle-right"></i>
                            <span>Add Restaurent</span>
                          </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'index.php/client_area/client_offers/';?>">                            
                            <i class="fa fa-angle-right"></i>
                            <span>Offers </span>
                          </a>
                        </li>
                        <!-- <li>
                            <a href="<?php // echo base_url().'index.php/client_information/information/';?>">                            
                            <i class="fa fa-angle-right"></i>
                            <span>Information </span>
                          </a>
                        </li> -->
                        <!-- <li>
                            <a href="">                            
                            <i class="fa fa-angle-right"></i>
                            <span>Details </span>
                          </a>
                        </li> -->
                        <!-- <li>
                            <a href="<?php // echo base_url().'index.php/client_information/gallery/';?>">                            
                            <i class="fa fa-angle-right"></i>
                            <span>Gallery </span>
                          </a>
                        </li> -->
                        <!-- <li>
                            <a href="">                            
                            <i class="fa fa-angle-right"></i>
                            <span>Open times </span>
                          </a>
                        </li> -->
                        <!-- <li>
                            <a href="">                            
                            <i class="fa fa-angle-right"></i>
                            <span>Locations </span>
                          </a>
                        </li> -->
                        <!-- <li>
                            <a href="">                            
                            <i class="fa fa-angle-right"></i>
                            <span>Menu</span>
                          </a>
                        </li> -->
                      </ul>
                    </li>                
                    <li>
                      <a href="#uikit">
                        <i class="fa fa-cog icon">
                          <b class="bg-success"></b>
                        </i>
                        <span class="pull-right">   
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>Setting</span>
                      </a>
                      <ul class="nav lt">
                      <li>
                            <a href="<?php echo base_url().'index.php/client_business/your_business/';?>">                            
                            <i class="fa fa-angle-right"></i>
                            <span> Your Business</span>
                          </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'index.php/client_area/client_offers_list/';?>">                            
                            <i class="fa fa-angle-right"></i>
                            <span> Your Offers</span>
                          </a>
                        </li>
                        <li>
                            <a href="" >                            
                            <i class="fa fa-angle-right"></i>
                            <span>Help</span>
                          </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'index.php/client_invoice/client_recent_invoice/';?>">                            
                            <i class="fa fa-angle-right"></i>
                            <span>Invoices</span>
                          </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'index.php/Home/change_password_client/';?>" >                            
                            <i class="fa fa-angle-right"></i>
                            <span>Change Password</span>
                          </a>
                        </li>
                        <li>
                             <a href="<?php echo base_url().'index.php/client_area/edit_profile/';?>" >                          
                            <i class="fa fa-angle-right"></i>
                            <span>Profile Details</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </nav>
              </div>
            </section>
          </section>
        </aside>    
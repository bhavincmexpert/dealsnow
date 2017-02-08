<?php 
  if ($this->session->userdata('email_zone_manager') == FALSE) 
  {
           redirect('Home/login');
  }
?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Deals Now</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBNEQCHUYPsekbYz7tym8Q4Ne2vlUsvnFc"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/bootstrap-datetimepicker.min.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/animate.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/font.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/js/calendar/bootstrap_calendar.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/app.css" type="text/css" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
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
                      <a href="<?php echo base_url().'index.php/Home/zone_manager';?>" class="active">
                        <i class="fa fa-dashboard icon">
                          <b class="bg-success"></b>
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
                        <span>Clients</span>
                      </a>
                      <ul class="nav lt">
                      <li>
                            <a href="<?php echo base_url().'index.php/admin_client/add_client/';?>">                            
                            <i class="fa fa-angle-right"></i>
                            <span>Add Client</span>
                          </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'index.php/admin_client/select_client_list/';?>" >                            
                            <i class="fa fa-angle-right"></i>
                            <span>List of Client</span>
                          </a>
                        </li>
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
                        <span>Invoices</span>
                      </a>
                      <ul class="nav lt">
                        <li>
                            <a href="<?php echo base_url().'index.php/admin_client/select_client_list/';?>" >                            
                            <i class="fa fa-angle-right"></i>
                            <span>All </span>
                          </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'index.php/admin_client/select_client_list_paid_invoice/';?>" >                            
                            <i class="fa fa-angle-right"></i>
                            <span>Paid </span>
                          </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'index.php/admin_client/select_client_list_due_invoice/';?>" >                            
                            <i class="fa fa-angle-right"></i>
                            <span>Due </span>
                          </a>
                        </li>
                        
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
                            <a href="<?php echo base_url().'index.php/admin_client/select_client_list/';?>" >                            
                            <i class="fa fa-angle-right"></i>
                            <span>List User</span>
                          </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'index.php/admin_client/add_category/';?>" >                            
                            <i class="fa fa-angle-right"></i>
                            <span> Add Category </span>
                          </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'index.php/Home/change_password_zone_manager/';?>" >                            
                            <i class="fa fa-angle-right"></i>
                            <span>Change Password</span>
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

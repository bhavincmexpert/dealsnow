<?php
   // if($this->session->userdata('email_client') == TRUE) 
   // {
   //     redirect('Home/index');
   // }
   // else
   // {
   //      redirect('Home/login');
   // }
?>

<style>
    body
    {
        background-color: white; 
    }
    </style>
<html lang="en" class="bg-dark">
    <head>
        <meta charset="utf-8" />
        <title>Login</title>
        <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/animate.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/font-awesome.min.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/font.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/app.css" type="text/css" />        
    </head>
    <body class="" style="background-image: url('../../public/images/back_orange.jpg')">
        <section id="content" class="wrapper-md animated fadeInUp">    
            <div class="container aside-xxl">
                <div class="navbar-brand block block-login">
                   <h1 style="color:#000000;"> Deals Now </h1>
                </div>
                <section class="panel panel-default bg-white m-t-lg">                    
                    <form action="<?php echo base_url().'index.php/Home/check_login/';  ?>" class="panel-body wrapper-lg" method="post" enctype="multipart/form-data" id='commentForm'>
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input type="text" id="txtEmail" name="txtEmail" placeholder="admin" class="form-control input-lg" required=""/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Password</label>
                            <input type="password" id="txtPassword" name="txtPassword" placeholder="Password" class="form-control input-lg" required=""/>
                        </div>                        
                            <div class="checkbox">
                            <label>
                                <input type="checkbox"/> Keep me logged in
                            </label>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary btn-margin">Sign in</button>
                        <button type="Reset" class="btn btn-primary cancel_btn" >Cancel</button>     
                        <div class="line line-dashed"></div>
                        <div class="line line-dashed"></div>
                    </form>
                </section>
            </div>
        </section>        
        <footer id="footer">            
            <div class="text-center padder">
                <p>
                    <h4 style="color:#000000">Deals Now &copy; 2016</h4>
                </p>
            </div>
        </footer>             
      <script type="text/javascript">
        function forgot_password() {
            alert("Password & Email-Id is Send to your Already Registered Email-Id");
        }              
        </script>
</html>
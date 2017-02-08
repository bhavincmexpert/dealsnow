      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2016 &copy; Deals Now.
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    
  <!-- footer form around -->
   <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
      <!-- <script src="<?php // echo base_url(); ?>/public/js/jquery.min.js"/></script> -->
      <!-- Bootstrap -->
      <script src="<?php echo base_url(); ?>/public/js/bootstrap.js"/></script>
      <!-- App -->
      <script src="<?php echo base_url(); ?>/public/js/app.js"/></script>
      <script src="<?php echo base_url(); ?>/public/js/app.plugin.js"/></script>
      <script src="<?php echo base_url(); ?>/public/js/slimscroll/jquery.slimscroll.min.js"></script>
      <script src="<?php echo base_url(); ?>/public/advanced-datatable/  /src/core/core.sort.js"></script>
      <script src="<?php echo base_url(); ?>/public/js/calendar/bootstrap_calendar.js"></script>
      <script src="<?php echo base_url(); ?>/public/js/calendar/bootstrap_calendar.js"></script>
      <script src="<?php echo base_url(); ?>/public/js/datepicker/bootstrap-datepicker.js"></script>
     
      <script type="text/javascript" src="<?php echo base_url(); ?>/public/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>/public/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>/public/assets/bootstrap-daterangepicker/moment.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>/public/assets/bootstrap-daterangepicker/daterangepicker.js"></script>

      <!-- <script src="<?php // echo base_url(); ?>/public/js/bootstrap-switch.js"></script> -->
        <script src="<?php echo base_url(); ?>/public/js/advanced-form-components.js"></script>
   
      <!-- <script src="<?php // echo base_url(); ?>/public/js/bootstrap-datetimepicker.min.js"></script> -->
      <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>/public/advanced-datatable/media/js/jquery.dataTables.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>/public/data-tables/DT_bootstrap.js"></script>
      <script src="<?php echo base_url(); ?>/public/js/calendar/demo.js"></script>
      
      <script src="<?php echo base_url(); ?>/public/js/sortable/jquery.sortable.js"></script>
      <script src="<?php echo base_url(); ?>/public/js/jquery.validate.min.js"></script>
      <script src="<?php echo base_url(); ?>/public/js/form-validation-script.js"></script>


      <script type="text/javascript">
         $(document).ready(function() {
                    $('#example').dataTable( {
                        "aaSorting": [[ 4, "desc" ]]
                    });
                    $('#example1').dataTable( {
                        "aaSorting": [[ 4, "desc" ]]
                    });       
                });
      </script>
      
      <script type="text/javascript">
              function myFunction() {                             
              var pass1 = document.getElementById("txtNewPassword").value;
              var pass2 = document.getElementById("txtRePassword").value;
              if (pass1 != pass2 ) {
                  alert("Passwords Do not match");
                  return false;
              }
              else {
                  if( pass1 == "" || pass2 == "")
                      {
                          alert("Password Required");
                          return false;
                      }
                  else
                      {
                          alert("Password has been Sucessfully Update..! ");
                          return true;
                      }
              }
              return true;
          }
      </script>
      


  </body>
</html>
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
      <script src="<?php echo base_url(); ?>/public/js/jquery.min.js"/></script>
      <!-- Bootstrap -->
      <script src="<?php echo base_url(); ?>/public/js/bootstrap.js"/></script>
      <!-- App -->
      <script src="<?php echo base_url(); ?>/public/js/app.js"/></script>
      <script src="<?php echo base_url(); ?>/public/js/app.plugin.js"/></script>
      <script src="<?php echo base_url(); ?>/public/js/slimscroll/jquery.slimscroll.min.js"></script>
      <script src="<?php echo base_url(); ?>/public/advanced-datatable/media/src/core/core.sort.js"></script>
      <script src="<?php echo base_url(); ?>/public/js/calendar/bootstrap_calendar.js"></script>
      <script src="<?php echo base_url(); ?>/public/js/fullcalendar/fullcalendar.min.js"></script>
      <script src="<?php echo base_url(); ?>/public/js/calendar/bootstrap_calendar.js"></script>
      <script src="<?php echo base_url(); ?>/public/js/datepicker/bootstrap-datepicker.js"></script>
      <script src="<?php echo base_url(); ?>/public/js/bootstrap-datetimepicker.min.js"></script>
      <script src="<?php echo base_url(); ?>/public/js/datepicker/datepicker.css"></script>
      <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>/public/advanced-datatable/media/js/jquery.dataTables.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>/public/data-tables/DT_bootstrap.js"></script>
      <script src="<?php echo base_url(); ?>/public/js/calendar/demo.js"></script>
      <script src="<?php echo base_url(); ?>/public/js/bootbox.min.js"></script>
      <script src="<?php echo base_url(); ?>/public/js/sortable/jquery.sortable.js"></script>
      <script src="<?php echo base_url(); ?>/public/js/jquery.validate.min.js"></script>
      <script src="<?php echo base_url(); ?>/public/js/form-validation-script.js"></script>
<!-- footer form around -->
    
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
            bootbox.alert("Passwords Do not match");
            return false;
        }
        else {
            if( pass1 == "" || pass2 == "")
                {
                    bootbox.alert("Password Required");
                    return false;
                }
            //return true;
            else
                {
                    bootbox.alert("Password has been Sucessfully Update..! ");
                    return true;
                }
        }
        return true;
    }
</script>

  </body>
</html>
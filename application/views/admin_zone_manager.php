<?php 
   $super_admin = $this->session->userdata('email_admin');
   $zone_manager = $this->session->userdata('email_zone_manager');
   $zone_manager_id = $this->session->userdata('zone_manager_id');
   if($this->session->userdata('email_admin'))
   {	
   		include('header_admin.php');
   }
   if($this->session->userdata('email_zone_manager'))
   {
   		include('header_zone_manager.php');
   }
?>
      <section class="vbox">          
        <section class="scrollable padder wrapper">            
            <div class="row">
                <div class="col-sm-6">
                <form action="<?php echo base_url().'index.php/zone_manager/insert_zone_manager/';  ?>" data-validate="parsley" enctype="multipart/form-data" method="post">
				<section class="panel panel-default">
                      <header class="panel-heading">
                        <span class="h4">ADD Zone Manager</span>
                      </header>
	             <div class="panel-body">
	                    <p class="text-muted">Please fill the information to continue</p>
	                    <div class="form-group">
	                      <label> First Name</label>
	                      <input type="text" name="txtName" value="" id="txtPlan" class="form-control" required="" />                        
	                    </div>
	                   <div class="form-group">
	                      <label> Email Address </label>
	                      <input type="email" name="txtEmail"
	                             value="" id="txtPayment" class="form-control" required="" />                        
	                    </div>
	                    <div class="form-group">
	                      <label> Phone Number </label>
	                      <input type="number" name="txtPhoneNumber" value="" id="txtPayment" class="form-control"  required="" />                        
	                    </div>
	                    <div class="form-group">
	                      <label> Password </label>
	                      <input type="password" name="txtPassword"
	                             value="" id="txtAmount" class="form-control" required="" />                        
	                    </div>
	                    <div class="form-group">
	                      <label> Confirm Password</label>
	                      <input type="password" name="txtConfirmPassword"
	                             value="" id="txtAmount" class="form-control"  required="" />                        
	                    </div>
						  <div class="form-group">
						      <label > Select Your Country </label> 
		                    <select name="country" class="countries" style="height: 30px;width: 100%;" id="countryId" required="">
									<option value="">Select Country</option>
							</select>
	                    </div>
	                    <div class="form-group">
	                    <label > Select Your State </label> 
	                    	<select name="state" class="states" style="height: 30px;width: 100%;" id="stateId" required="">
									<option value="">Select State</option>
							</select>
	                    </div>
	                    <div class="form-group">
	                    <label > Select Your City </label> 
	                    	<select name="city_id" class="cities" style="height: 30px;width: 100%;" id="cityId" required="">
									<option value="">Select City</option>
							</select>
	                    </div>
	                    <div class="form-group">
						  <label> Address </label>
						  <textarea class="form-control" id="txtDesc1" cols="66" rows="5.5" name="txtDesc1"                                    
						  placeholder="eg. Details about Hot Story"></textarea>
						</div>
	              </div>
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
	<!--                        End Code for Cancle Alert-->
	                    <a href="" data-toggle='modal' class="btn btn-success btn-s-xs" name="cancel">Cancel</a>
	                  </footer>
                    </section>
                    </form>
                </div>
                </div>
				</section>
			</section>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
			<script type="text/javascript">
					    function ajaxCall() {
					        this.send = function(data, url, method, success, type) {
					          type = type||'json';
					          var successRes = function(data) {
					              success(data);
					          }
					          var errorRes = function(e) {
					              console.log(e);
					              //alert("Error found \nError Code: "+e.status+" \nError Message: "+e.statusText);
					              //$('#loader').modal('hide');
					          }
					            $.ajax({
					                url: url,
					                type: method,
					                data: data,
					                success: successRes,
					                error: errorRes,
					                dataType: type,
					                timeout: 60000
					            });

					          }

					        }

					function locationInfo() {
					    var rootUrl = "http://iamrohit.in/lab/php_ajax_country_state_city_dropdown/api.php";
					    var call = new ajaxCall();
					    this.getCities = function(id) {
					        $(".cities option:gt(0)").remove();
					        var url = rootUrl+'?type=getCities&stateId=' + id;
					        var method = "post";
					        var data = {};
					        $('.cities').find("option:eq(0)").html("Please wait..");
					        call.send(data, url, method, function(data) {
					            $('.cities').find("option:eq(0)").html("Select City");
					            if(data.tp == 1){
					                $.each(data['result'], function(key, val) {
					                    var option = $('<option />');
					                    option.attr('value', val).text(val);
					                     option.attr('cityid', key);
					                    $('.cities').append(option);
					                });
					                $(".cities").prop("disabled",false);
					            }
					            else{
					                 alert(data.msg);
					            }
					        });
					    };

					    this.getStates = function(id) {
					        $(".states option:gt(0)").remove(); 
					        $(".cities option:gt(0)").remove(); 
					        var url = rootUrl+'?type=getStates&countryId=' + id;
					        var method = "post";
					        var data = {};
					        $('.states').find("option:eq(0)").html("Please wait..");
					        call.send(data, url, method, function(data) {
					            $('.states').find("option:eq(0)").html("Select State");
					            if(data.tp == 1){
					                $.each(data['result'], function(key, val) {
					                    var option = $('<option />');
					                        option.attr('value', val).text(val);
					                        option.attr('stateid', key);
					                    $('.states').append(option);
					                });
					                $(".states").prop("disabled",false);
					            }
					            else{
					                alert(data.msg);
					            }
					        }); 
					    };

					    this.getCountries = function() {
					        var url = rootUrl+'?type=getCountries';
					        var method = "post";
					        var data = {};
					        $('.countries').find("option:eq(0)").html("Please wait..");
					        call.send(data, url, method, function(data) {
					            $('.countries').find("option:eq(0)").html("Select Country");
					            console.log(data);
					            if(data.tp == 1){
					                $.each(data['result'], function(key, val) {
					                    var option = $('<option />');
					                    option.attr('value', val).text(val);
					                     option.attr('countryid', key);
					                    $('.countries').append(option);
					                });
					                $(".countries").prop("disabled",false);
					            }
					            else{
					                alert(data.msg);
					            }
					        }); 
					    };

					}

					$(function() {
					var loc = new locationInfo();
					loc.getCountries();
					 $(".countries").on("change", function(ev) {
					        var countryId = $("option:selected", this).attr('countryid');
					        if(countryId != ''){
					        loc.getStates(countryId);
					        }
					        else{
					            $(".states option:gt(0)").remove();
					        }
					    });
					 $(".states").on("change", function(ev) {
					        var stateId = $("option:selected", this).attr('stateid');
					        if(stateId != ''){
					        loc.getCities(stateId);
					        }
					        else{
					            $(".cities option:gt(0)").remove();
					        }
					    });
					});

			</script>

   <?php include('footer_admin.php'); ?>

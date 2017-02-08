<?php  include('header_client.php');



			$result_client = $this->db->query("select * from offers where id='".$_REQUEST['edit']."'");

			$row_client = $result_client->result();

			// echo "<pre>";

			// print_r($row_client);

			// exit();

  ?>	

		<!-- ajax code starts here -->

			<script>

					$(document).on('change', 'select.Business1', function(){

         				   var business1 = $('select.Business1 option:selected').val();

						   var value = $(this).val();



						   $.ajax({

						   		type:"POST",

						   		data: { business1:business1 },

						   		url: '<?php echo site_url('client_area/select_business_sub_cat'); ?>',

						   		success : function (data){

						   				var abc = $('#business2').html(data);

						   				

						   		}

						   });

					});

			</script>

			<!-- ajax code ends here -->

	  <style>

        #myMap {

		   height: 600px;

		   width: 300px;

		}

      </style>

      <section class="vbox">          

        <section class="scrollable padder wrapper">            

            <div class="row">

            <form action="<?php echo base_url().'index.php/client_information/edit_insert_offer/';  ?>" data-validate="parsley" enctype="multipart/form-data" method="post">

             <div class="col-sm-12">

             <header class="panel-heading form_panel">

                        <span class="h4">ADD Offer to Your Business</span>

             </header>

                <p class="text-muted">Please fill the information to continue</p>

                <div class="col-sm-6">

				<section class="panel panel-default">

	             <div class="panel-body">

	            <div class="form-group">

	                      <label>Offer Title</label>

	                      <input type="text" name="txtName" value="<?php echo $row_client['0']->title; ?>" id="" class="form-control" required="" />                        

	             </div>

	             <div class="form-group">

	                      <label>Offer Description </label>

	                      <textarea name="txtDescription" value="" id="" class="form-control"  rows='4'>

	                      <?php echo htmlspecialchars($row_client['0']->description);?>

	                      </textarea>                        

	             </div>

	             

	            <div class="form-group">

	                      <label class="col-md-12 no_padd">Offer Availability</label>

	                      <div class="input-group date form_datetime-component col-md-5 pull-left">

                                              <input type="text" value="<?php echo $row_client['0']->start_date; ?>"  name="txtStart" class="form-control" readonly="" size="16">

                                                <span class="input-group-btn">

                                                <button type="button" class="btn btn-danger date-set"><i class="fa fa-calendar"></i></button>

                                                </span>

                          </div>

	                      <div class="input-group date form_datetime-component col-md-5 pull-right">

                                              <input type="text" value="<?php echo $row_client['0']->end_date; ?>" name="txtEnd" class="form-control" readonly="" size="16">

                                                <span class="input-group-btn">

                                                <button type="button" class="btn btn-danger date-set"><i class="fa fa-calendar"></i></button>

                                                </span>

                          </div>

	            </div>

                </section>

                </div>

                <div class="col-sm-6">

				<section class="panel panel-default">

	            <div class="panel-body">

	            <div class="form-group">

	                      <label> Original Price</label>

	                      <input type="text" id="" name="txtOriginalPrice" value="<?php echo $row_client['0']->original_price; ?>"  class="form-control" />     

	            </div>

	            <div class="form-group">
                                        <label>Discount</label>
                                        <input type="number" placeholder="Discount on Original Price" name="discount" value="<?php echo $row_client['0']->discount; ?>" id="" class="form-control" required="" min="1" max="100"/>

                                    </div>

	            <!-- <div class="form-group">

	                      <label>Offer Price</label>

	                      <input type="text" name="txtOfferPrice" value="<?php // echo $row_client['0']->offer_price; ?>" id="" class="form-control" />                        

	            </div> -->

	            <div class="form-group">

	                      <label>Offer Photo</label>

	                      <input type="file" name="userfile" value="" id="" class="form-control" />

	                       <?php echo htmlspecialchars($row_client['0']->image); ?>

	                      <input type="hidden" name="id"  value="<?php echo $row_client['0']->id; ?>" />

	            </div>

                 </section>

                 </div>

                </div>

                

		        <!-- bootstrap model pop up code starts here  -->

		          

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

	<!--                        End Code for Cancle Alert-->

	                    <a href="" data-toggle='modal' class="btn btn-success btn-s-xs" name="cancel">Cancel</a>

	                  </footer>

                </form>

                </div>

			</section>

			</section>





			

   <?php  include('footer_client.php'); ?>
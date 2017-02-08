<?php include('header_client.php');
?>
    <!-- ajax code starts here -->

    <script>
        $(document).on('change', 'select.Business1', function () {
            var business1 = $('select.Business1 option:selected').val();
            var value = $(this).val();
            $.ajax({
                type: "POST",
                data: {business1: business1},
                url: '<?php echo site_url('client_area/select_business_sub_cat'); ?>',
                success: function (data) {
                    $('#business2').empty();
                    $('#business2').append(data);
                }
            });
        });
    </script>

    <!-- ajax code ends here -->

    <!-- ajax code starts here -->

    <script>
        $(document).on('click', '.Business2', function () {
            var business12 = $('select.Business2 option:selected').val();
            $.ajax({
                type: "POST",
                data: {business12: business12},
                url: '<?php echo site_url('client_area/select_business_sub_sub_cat1'); ?>',
                success: function (data) {
                    $('#business3').empty();
                    $('#business3').append(data);
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
                <form action="<?php echo base_url() . 'index.php/client_area/insert_offer/'; ?>" data-validate="parsley"
                      enctype="multipart/form-data" method="post">
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
                                        <input type="text" name="txtName" value="" id="" class="form-control"
                                               required=""/>
                                    </div>
                                    <div class="form-group">
                                        <label>Offer Description </label>
	                      <textarea name="txtDescription" value="" id="" class="form-control" rows='4'>
	                      </textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12 no_padd">Offer Availability</label>
                                        <div class="input-group date form_datetime-component col-md-5 pull-left">
                                            <input type="text" name="txtStart" class="form-control" readonly=""
                                                   size="16" required="">
                                                <span class="input-group-btn">
                                                <button type="button" class="btn btn-danger date-set"><i
                                                        class="fa fa-calendar"></i></button>
                                                </span>
                                        </div>
                                        <div class="input-group date form_datetime-component col-md-5 pull-right">
                                            <input type="text" name="txtEnd" class="form-control" readonly="" size="16" required=""> 
                                                <span class="input-group-btn">
                                                <button type="button" class="btn btn-danger date-set"><i
                                                        class="fa fa-calendar"></i></button>
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
                                        <input type="number" id="" name="txtOriginalPrice" value="" class="form-control" required=""/>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Offer Price</label>
                                        <input type="text" name="txtOfferPrice" value="" id="" class="form-control"/>
                                    </div> -->
                                    <div class="form-group">
                                        <label>Discount</label>
                                        <input type="number" placeholder="Discount on Original Price" name="discount" value="" id="" class="form-control" required="" min="1" max="100"/>

                                    </div>
                                    <div class="form-group">
                                        <label>Offer Photo</label>
                                        <input type="file" name="userfile" value="" id="" class="form-control"
                                               required=""/>
                                        <!-- <div class="fileUpload btn btn-primary pull-right fil_cls">
                                        <span>Offer Photo</span>
                                        <input type="file" name="userfile" value="" id="" class="form-control upload" required="" />
                                        </div> -->
                                    </div>

                                    

                            </section>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <header class="panel-heading form_panel">
                            <span class="h4">Choose Your Business</span>
                        </header>
                        <div class="col-sm-6">
                            <section class="panel panel-default">
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label>Your Business</label>
                                        <select name="txtBusiness3" id="" style="height: 30px;width: 100%;"
                                                class="Business3" required>
                                            <option value=""> Select Your Added Business</option>
                                            <?php
                                            $adminid = $this->session->userdata('id');
                                            $result_cat1 = $this->db->query("select * from information_business where admin_id='$adminid'");
                                            $row_cat1 = $result_cat1->result();
                                            ?>
                                            <?php foreach ($row_cat1 as $item) { ?>
                                                <option
                                                    value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
                                            <?php } ?>
                                        </select>
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
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="mycancel"
                     class="modal fade bs-example-modal-sm">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
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
                <a href="http://cmexpertiseinfotech.in/ci_test/index.php/Home/index" data-toggle='modal' class="btn btn-success btn-s-xs" name="cancel">Cancel</a>
            </footer>
            </form>
            </div>
        </section>
    </section>


<?php include('footer_client.php'); ?>
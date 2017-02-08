<?php
   $super_admin = $this->session->userdata('email_admin');
   $zone_manager = $this->session->userdata('email_zone_manager');
   if($this->session->userdata('email_admin'))
   {    
        include('header_admin.php');
   }
   if($this->session->userdata('email_zone_manager'))
   {
        include('header_zone_manager.php');
   }

    // code for category starts here 

    $category_query = $this->db->query("SELECT * FROM `category` ORDER BY id DESC");
    $category_result = $category_query->result();

     // code for category ends here 

$sub_category_query = $this->db->query("SELECT * FROM subcategory  ORDER BY id DESC ");
$sub_category_result = $sub_category_query->result();
?>
<section class="vbox">
    <section class="scrollable padder wrapper">
        <div class="row">
            <div class="col-sm-6">
                <form action="<?php echo base_url() . 'index.php/admin_client/insert_category/'; ?>"
                      data-validate="parsley" enctype="multipart/form-data" method="post">
                    <section class="panel panel-default">
                        <header class="panel-heading">
                            <span class="h4">ADD Category</span>
                        </header>
                        <div class="panel-body">
                            <p class="text-muted">Please fill the information to continue</p>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="name" name="name" value="" id="name" class="form-control" required=""/>
                            </div>

                            <div class="form-group">
                                <label>Image </label>
                                <input type="file" name="image"
                                       value="" id="image" class="form-control" required=""/>
                            </div>
                        </div>
                        <footer class="panel-footer text-right bg-light lter">
                            <button type="submit" class="btn btn-success btn-s-xs">Submit</button>
                            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1"
                                 id="mycancel" class="modal fade bs-example-modal-sm">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">&times;</button>
                                            <h4 class="modal-title"><i class="fa fa-building-o"></i> Plan Insert Master
                                                Alert</h4>
                                        </div>
                                        <div class="modal-body">
                                            <i class="fa fa-question-circle"></i> Are You Sure To Go Back!
                                        </div>
                                        <div class="modal-footer">
                                            <input type='button' value='Yes' class="btn btn-success btn-shadow"
                                                   onclick=""/>
                                            <button data-dismiss="modal" class="btn btn-danger btn-shadow"
                                                    type="button">No
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--                        End Code for Cancle Alert-->
                            <a href="http://cmexpertiseinfotech.in/ci_test/index.php/Home/admin" data-toggle='modal' class="btn btn-success btn-s-xs" name="cancel">Cancel</a>
                        </footer>
                    </section>
                </form>
            </div>

            <div class="col-sm-6">
                <form action="<?php echo base_url() . 'index.php/admin_client/insert_sub_category/'; ?>" data-validate="parsley" enctype="multipart/form-data" method="post">
                    <section class="panel panel-default">
                        <header class="panel-heading">
                            <span class="h4">Add Sub-Category</span>
                        </header>
                        <div class="panel-body">
                            <p class="text-muted">Please fill the information to continue</p>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="sub_name" value="" id="sub_name" class="form-control" required=""/>
                            </div>

                            <div class="form-group">
                                <label>Select Category</label>
                                <select name="select_category" id="select_category" class="form-control" required>
                                    <option selected disabled value="">Select Category</option>
                                    <?php foreach ($category_result as $cat){ ?>
                                        <option value="<?php echo $cat->id; ?>"> <?php echo $cat->name; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <footer class="panel-footer text-right bg-light lter">
                            <button type="submit" class="btn btn-success btn-s-xs">Submit</button>
                            <a href="http://cmexpertiseinfotech.in/ci_test/index.php/Home/admin" data-toggle='modal' class="btn btn-success btn-s-xs" name="cancel">Cancel</a>
                        </footer>
                    </section>
                </form>
            </div>
        </div>

        <div class="col-sm-6">
                <form action="<?php echo base_url() . 'index.php/admin_client/insert_sub_sub_category/'; ?>"
                      data-validate="parsley" enctype="multipart/form-data" method="post">
                    <section class="panel panel-default">
                        <header class="panel-heading">
                            <span class="h4">Add Sub Sub Category</span>
                        </header>
                        <div class="panel-body">
                            <p class="text-muted">Please fill the information to continue</p>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="sub_sub_category" value="" id="sub_sub_category" class="form-control" required=""/>
                            </div>

                            <div class="form-group">
                                <label>Select Category</label>
                                <select name="select_cat" id="select_cat" class="form-control select_cat" required="">
                                    <option selected disabled value="">Select Category</option>
                                    <?php foreach ($category_result as $cat){ ?>
                                        <option value="<?php echo $cat->id; ?>"> <?php echo $cat->name; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Select Sub-Category</label>
                                <select name="select_sub_cat" id="select_sub_cat" class="form-control select_sub_cat" required="">
                                    <option selected disabled value="">Select Sub-Category</option>
                                    <?php foreach ($sub_category_result as $sub_cat){ ?>
                                        <option value="<?php echo $sub_cat->id; ?>"> <?php echo $sub_cat->name; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>


                        </div>
                        <footer class="panel-footer text-right bg-light lter">
                            <button type="submit" class="btn btn-success btn-s-xs">Submit</button>
                            <a href="http://cmexpertiseinfotech.in/ci_test/index.php/Home/admin" data-toggle='modal' class="btn btn-success btn-s-xs" name="cancel">Cancel</a>
                        </footer>
                    </section>
                </form>
            </div>
        </div>
    </section>
</section>

<script type="text/javascript">
    $(document).on('change', 'select.select_cat', function () {
        var category = $('select.select_cat option:selected').val();

        $.ajax({
            type: "POST",
            data: {category: category},
            url: '<?php echo site_url('admin_client/select_business_sub_cat'); ?>',
            success: function (data) {
                
                $('#select_sub_cat').empty();
                $('#select_sub_cat').append(data);
            }
        });
    });
</script>

<?php include('footer_admin.php'); ?>

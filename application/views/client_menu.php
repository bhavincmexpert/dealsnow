<?php include('header_client.php');

		$businessid = $_REQUEST['edit_gallery'];
		$adminid = $this->session->userdata('id');
		$categoryid = $_REQUEST['category_id'];
		$subcatid = $_REQUEST['sub_cat_id'];
		$subsubcatid = $_REQUEST['subsubcat_id'];
		$select_image_gallery_user_wise = $this->db->query("SELECT * FROM `menu` LEFT join menu_image on menu_image.admin_id = menu.admin_id LEFT JOIN category ON category.id = menu.category_id WHERE menu_image.business_id = '$businessid' and menu.category_id = '$categoryid' GROUP BY menu_image.image_id");
		$row_select_image_gallery_user_wise = $select_image_gallery_user_wise->result();

?>
<!-- ajax for image delete starts here -->

<script>
    $(function () {
        $(".delete").click(function () {
            var element = $(this);
            var del_id = element.attr("id");
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('client_area/image_remove_menu'); ?>",
                data: {del_id: del_id},
                success: function (data) {
                    alert(data);
                    location.reload();
                }
            });
        });
    });
</script>

<!-- ajax for image delete ends here -->

<!-- script for Menu starts here -->

<script type='text/javascript'>
    //var $j = jQuery.noConflict();
    $(document).ready(function () {
        $("#add-file-field").click(function () {
            $("#text").append("<div class='added-field'><input class='input_file upload_action' name='userfile[]' type='file' required/><input type='button' class='remove_input remove-btn' value='Remove Menu Image' /></div>");
        });
        $(document).on('click', '.remove-btn', function () {
            $(this).parent().remove();
        });
    });
</script>

<!-- script for Menu ends here -->

<section class="vbox">
    <section class="scrollable padder wrapper">
        <div class="row">
            <form action="<?php echo base_url() . 'index.php/client_menu/insert_menu/'; ?>"
                  data-validate="parsley" enctype="multipart/form-data" method="post">
                <div class="col-sm-12">
                    <header class="panel-heading form_panel">
                        <span class="h4">ADD/ Edit Menu to Your Business</span>
                    </header>
                    <div class="col-md-12">
                        <?php
                        $i = 1;
                        foreach ($row_select_image_gallery_user_wise as $item) {
                            echo '<img class="image' . $i . '" width="150" height="150" src=' . base_url() . '/public/business_gallery/' . $item->image_name . '>';
                            echo '<a href="#" id="' . $item->image_id . '" class="delete"><img src="http://cmexpertiseinfotech.com/karenlee/admin/images/delete_new.png"/></a>';
                            $i++;
                        }
                        ?>
                    </div>
                </div>

                <div class="col-sm-12" id="gallery">
                    <header class="panel-heading form_panel">
                        <span class="h4"> Menu </span>
                    </header>
                    <center>
                        <b>
                            <h4 class="text-muted"> Note: (You can Add Unlimited Images to your gallery by clicking Add Photo
                                Image Button)</p>
                        </b>
                    </center>
                    <div class="col-sm-6">
                        <section class="panel panel-default">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Menu</label>
                                    <div id="text">
                                        <div class="abc">
                                            <input class="input_file" name="userfile[]" type="file"
                                            />
                                            <input class="add_input" type="button" id="add-file-field" name="add"
                                                   value="Add Menu Image"/>
                                        </div>
                                    </div>
                                    <input class="" type='hidden' name="action" value="uploadfiles"/>
                                    <input type="hidden" value="Upload File"/>
                                </div>
                                <div>   
                                
                                <input type="hidden" name="business_id" value="<?php echo $businessid; ?>" />
                                    <input type="hidden" name="category_id" value="<?php echo $categoryid; ?>" />
                                     <input type="hidden" name="sub_cat_id" value="<?php echo $subcatid; ?>" />
                                      <input type="hidden" name="sub_sub_cat_id" value="<?php echo $subsubcatid; ?>" />
                                </div>
                        </section>
                    </div>
                </div>
                <div class="col-md-12"></div>
                <!-- bootstrap model pop up code starts here  -->
                <!-- bootstrap model pop up code ends here  -->
                <footer class="panel-footer text-right bg-light lter">
                    <button type="submit" class="btn btn-success btn-s-xs">Submit</button>
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="mycancel"
                         class="modal fade bs-example-modal-sm">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-building-o"></i> Plan Insert Master Alert </h4>
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

<?php include('footer_client.php'); ?>

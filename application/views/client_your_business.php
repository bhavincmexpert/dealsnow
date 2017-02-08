<?php include('header_client.php');

?>

<section class="vbox">

    <section class="scrollable padder wrapper">

        <section class="panel panel-default">

            <header class="panel-heading">

                <span class="h4">Your Business</span>

            </header>

        </section>

        <section class="panel panel-default">

            <div class="adv-table">

                <table class="display table table-bordered table-striped" id="example">

                    <thead>

                    <tr>

                        <th width="10%"> Name</th>

                        <th width="10%"> Category Name</th>

                        <th width="10%"> Sub Category Name</th>

                        <th width="15%"> Sub Sub Category Name</th>

                        <th width="10%"> ADD/Edit</th>

                        <th width="10%"> ADD/Edit</th>

                        <th width="10%"> ADD/Edit</th>

                        <th width="10%"> ADD/Edit</th>

                        <th width="5%"></th>

                    </tr>

                    </thead>

                    <?php

                    $adminid = $this->session->userdata('id');

                    $result_client = $this->db->query("SELECT information_business.*,subcategory.name AS subcategory_name, category.name AS category_name, sub_sub_category.name AS sub_sub_category_name, information_business.name AS information_business_name, information_business.id AS information_business_id, sub_sub_category.id AS sub_sub_category_id, information_business.category_id AS business_category_id, information_business.subcategory_id AS business_subcategory_id, information_business.sub_sub_category_id AS business_sub_sub_category_id FROM information_business LEFT JOIN category ON category.id = information_business.category_id LEFT JOIN subcategory ON subcategory.id = information_business.subcategory_id LEFT JOIN sub_sub_category ON sub_sub_category.id = information_business.sub_sub_category_id WHERE information_business.admin_id =  '$adminid'");

                    $row_client = $result_client->result();

                    foreach ($row_client as $row) {

                        ?>

                        <tr class='gradeA'>

                            <td><?php echo $row->information_business_name; ?></td>

                            <td><?php echo $row->category_name; ?></td>

                            <td><?php echo $row->subcategory_name; ?></td>

                            <td><?php echo $row->sub_sub_category_name; ?></td>

                            <td><a class="remove_input_business"
                                   href="<?php echo base_url(); ?>/index.php/client_business/edit_business/?edit_details_business=<?php echo $row->information_business_id; ?>">
                                    Details </a></td>

                            <td><a class="remove_input_business"
                                   href="<?php echo base_url(); ?>/index.php/client_business/add_edit_gallery/?edit_gallery=<?php echo $row->information_business_id . "&category_id=" . $row->business_category_id . "&sub_cat_id=" . $row->business_subcategory_id . "&subsubcat_id=" . $row->business_sub_sub_category_id; ?>">
                                    Gallery </a></td>

                            <td><a class="remove_input_business"
                                   href="<?php echo base_url(); ?>/index.php/client_business/timing_description/?edit_gallery=<?php echo $row->information_business_id . "&category_id=" . $row->business_category_id . "&sub_cat_id=" . $row->business_subcategory_id . "&subsubcat_id=" . $row->business_sub_sub_category_id; ?>">
                                    Timing/Features </a></td>

                            <td><a class="remove_input_business"
                                   href="<?php echo base_url(); ?>/index.php/client_menu/client_menu1/?edit_gallery=<?php echo $row->information_business_id . "&category_id=" . $row->business_category_id . "&sub_cat_id=" . $row->business_subcategory_id . "&subsubcat_id=" . $row->business_sub_sub_category_id; ?>">
                                    Menu </a></td>

                            <td id="delete_request_business">
                                    <a href="javascript:;" onclick="single_delete('<?php echo $row->id; ?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
                            </td>

                        </tr>

                    <?php } ?>

                </table>

            </div>

        </section>

    </section>

</section>

<script type="text/javascript">

    function single_delete(value) {

        bootbox.confirm("Are you sure you want to delete ?" , function (confirmed) {
            if (confirmed == true) {
                var id = value;

                $.ajax({
                    url: '<?php echo base_url().'index.php/client_business/delete_business_info/'; ?>' ,
                    data: {
                        ids: id.toString(),
                        url: '<?php echo base_url().'index.php/client_business/delete_business_info/'; ?>' ,
                    },
                    success: function (data) {

                        if (data.status == 1) {
                            bootbox.alert("Business has been deleted successfully.", function() {
                                window.location.reload(true);
                            });
                        }
                        else {
                            alert('Failed to delete selected business.');
                        }
                    },
                    error: function () {
                        alert('Failed to delete selected business.');
                    }
                });
            }
            else
            {
                window.location.reload(true);
            }
        });
    }

</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/bootbox/4.4.0/bootbox.min.js"></script>

<?php include('footer_client.php'); ?>


<?php
include('header_client.php');

$adminid = $this->session->userdata('id');
$business_query = $this->db->query("select * from information_business WHERE admin_id='$adminid' order by id DESC");
$business_result = $business_query->result();
?>
<section class="vbox">
    <section class="scrollable padder wrapper">
        <section class="panel panel-default">
            <header class="panel-heading">
                <span class="h4">List of Your Offers</span>
            </header>
        </section>
        <section class="panel panel-default">

            <div class="form-group">
                <label>Select Business :</label>
                <select name="select_business" id="select_business">
                    <option selected disabled> Select Business</option>
                    <?php foreach ($business_result as $business) { ?>
                        <option value="<?php echo $business->id; ?>"> <?php echo $business->name; ?> </option>
                    <?php } ?>
                </select>
            </div>

            <div class="adv-table">
                <table class="display table table-bordered table-striped" id="example">
                    <thead>
                    <tr>
                        <th width="10%"> Offer Image</th>
                        <th width="10%"> Title</th>
                        <th width="20%"> Description</th>
                        <th width="15%"> Start Date Time</th>
                        <th width="15%"> End Date Time</th>
                        <th width="10%"> Original Price</th>
                        <th width="10%"> Discount (In %)</th>
                        <th width="15%"> Primary Offer</th>
                        <th width="15%"></th>
                        <th width="15%"></th>
                    </tr>
                    </thead>
                    <tbody id="client_offer_table">
                    <?php

                    $result_client = $this->db->query("select o.*, b.name as business_name  from offers as o  LEFT JOIN  information_business as b ON b.id = o.business_id where o.admin_id='$adminid' order by o.id DESC ");
                    $row_client = $result_client->result();

                    foreach ($row_client as $row) { ?>

                        <tr class='gradeA'>
                            <td>
                                <input type="hidden" name="id" id="id" value="<?php echo $row->id; ?>">
                                <img width="200" height="200"
                                     src="<?php echo base_url(); ?>public/image_offers/<?php echo $row->image; ?>">
                            </td>
                            <td><?php echo $row->title; ?></td>
                            <td><?php echo $row->description; ?></td>
                            <td><?php echo $row->start_date; ?></td>
                            <td><?php echo $row->end_date; ?></td>
                            <td><?php echo $row->original_price; ?></td>
                            <td><?php echo $row->discount; ?></td>
                            <td>
                                <div class="form-group">
                                    <label></label>
                                    <select name="offer_dropdown" id="offer_dropdown"
                                            onchange="offer_dropdown('<?php echo $row->id; ?>')">
                                        <option
                                            value="0" <?php if ($row->primary_offer == '0') { ?> selected <?php } ?> >
                                            OFF
                                        </option>
                                        <option
                                            value="1" <?php if ($row->primary_offer == '1') { ?> selected <?php } ?>> ON
                                        </option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <a href="<?php echo base_url(); ?>index.php/client_information/edit_client/?edit=<?php echo $row->id; ?>">
                                    <img src="<?php echo base_url(); ?>/public/images/edit_new.png"/>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:;" onclick="single_delete(<?php echo $row->id; ?>)" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>

                            </td>
                        </tr>

                    <?php } ?>
                    </tbody>
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
                    url: '<?php echo base_url().'index.php/client_area/single_delete_offer_list/'; ?>' ,
                    data: {
                        ids: id.toString(),
                        url: '<?php echo base_url().'index.php/client_area/single_delete_offer_list/'; ?>' ,
                    },
                    success: function (data) {

                        if (data.status == 1) {
                            bootbox.alert("Offer has been deleted successfully.", function() {
                                window.location.reload(true);
                            });
                        }
                        else {
                            alert('Failed to delete selected offer.');
                        }
                    },
                    error: function () {
                        alert('Failed to delete selected offer.');
                    }
                });
            }
            else
            {
                window.location.reload(true);
            }
        });
    }

    /*$('#offer_dropdown').on('change', function () {
     alert('Hello');

     var on_off = $('select#offer_dropdown option:selected').val();
     var id = '<?php echo $row->id ?>';

     $.ajax({
     type: "POST",
     data: {on_off: on_off, id: id},
     url: '<?php echo site_url('client_area/offer_on_off'); ?>',
     success: function (data) {
     }
     });
     });*/

    function offer_dropdown(id) {
        var on_off = $("#offer_dropdown option:selected").val();
        var id = id;

        $.ajax({
            type: "POST",
            data: {on_off: on_off, id: id},
            url: '<?php echo site_url('client_area/offer_on_off'); ?>',
            success: function (data) {
            }
        });


    }

    $(function () {

        $('#select_business').change(function () {

            var id = $(this).val();

            $.ajax({
                type: "POST",
                url: '<?php echo base_url() . 'index.php/client_area/append_business_data/'; ?>',
                data: {
                    business_id: id
                },
                success: function (data) {

                    $('#client_offer_table').html(data);
                }
            });
        });
    });
</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/bootbox/4.4.0/bootbox.min.js"></script>

<?php include('footer_client.php'); ?>

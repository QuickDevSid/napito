<?php include('header.php'); ?>
<div class="right_col" role="main">
       
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Booking Status
                </h3>
            </div>

    
        </div>
       

        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <form method="post" name="master_form" id="master_form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Status Name <b class="require">*</b></label>
                                        <input type="text" class="form-select form-control" name="status_name" id="status_name" value="<?php if (!empty($single)) {echo $single->status_name;} ?>" placeholder="Confirmed"> 
                                        <div class="status_name_validation error"></div>
                                        <input type="hidden" class="form-control" name="id" id="id" value="<?php if (!empty($single)) {echo $single->id;} ?>">
                                    </div>
                                          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <div class="custom_fields_data">
                                                    <label for="department_master">Button Background Color <b class="require">*</b></label>
                                                    <input autocomplete="off" type="text" class="color_input" name="color_input" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->status_color;}else{ echo '#808080';} ?>" id="hexcolor"></input>
                                                    <input autocomplete="off" type="color" id="colorpicker" class="status_color" name="status_color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->status_color;}else{ echo '#808080';} ?>"> 
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <div class="custom_fields_data">
                                                    <label for="department_master">Button Text Color <b class="require">*</b></label>
                                                    <input autocomplete="off" type="text" class="button_text_color_input" name="text_color_input" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->text_color;}else{ echo '#000000';} ?>" id="texthexcolor"></input>
                                                    <input autocomplete="off" type="color" id="textcolorpicker" class="text_color_input" name="text_color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->text_color;}else{ echo '#000000';} ?>"> 
                                                </div>
                                            </div>

                                </div>
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <button style="margin-top: 20px;" type="submit" id="btn_submit" class="btn btn-primary">Submit</button>
                                    </div>
                            </form>
                        </div> 
                    </div>
                </div>

            </div>



            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                      <h3>Colour List</h3>
                    </div>
                    <div class="x_content">

                        <table id="example" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Status Name</th>
                                    <th>Status color</th> 
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($booking_status)) {
                                    $i = 1;
                                    foreach ($booking_status as $booking_status_result) {
                                ?>
                                        <tr>
                                            <td scope="row">
                                                <?= $i++ ?>
                                            </td>
                                            <td><?= $booking_status_result->status_name ?></td>
                                            <td><button style="cursor: default;height: 25px;border-radius: 5px;color: white;border: 1px solid #ccc;background-color: <?= $booking_status_result->status_color ?>;color:<?= $booking_status_result->text_color ?>;"><?= $booking_status_result->status_name ?></button></td>
                                            <td>
                                                <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?= base_url() ?>admin_delete/<?= $booking_status_result->id ?>/tbl_admin_bokking_status_color"><i class="fa-solid fa-trash"></i></a>

                                                <a title="Edit" class="btn btn-success" href="<?= base_url() ?>admin_add_booking_status/<?=$booking_status_result->id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
    
</div>
<?php include('footer.php');
$id = '0';
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>


<script>
    $(document).ready(function() {
        $('#master_form').validate({
            rules: {
                status_name: 'required',
                color_input: 'required',
                text_color_input:'required',
            },
            messages: {
                status_name: "Please enter status name !",
                color_input: "Please select background colour!",
                text_color_input:'Please select text colour!',
            },
        });
    });
    $(document).ready(function() {
    $('#colorpicker').change(function() {
       var ttttt= $("#colorpicker").val(); 
        $("#hexcolor").val(ttttt); 
    });
});



$("#status_name").change(function () {
    $.ajax({
        type: "POST",
        url: "<?= base_url(); ?>salon/Ajax_controller/get_unique_color_status_details_ajax",
        data: {
            'status_name_id': $('#status_name').val(),
        },
        success: function(data) {
            var parsedData = JSON.parse(data);
            if(data !== "0"){
                $('.status_name_validation').html("This status name is already added!");
                $('#btn_submit').hide();
            }else{
                $('.status_name_validation').hide();
                $('#btn_submit').show();
            }
        }   
    }); 
}); 
</script>

<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.add-booking-status').addClass('active_cc');
    });
</script>

<script>
    $('#example').DataTable({ 
        dom: 'Blfrtip',
        responsive: true,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                
         buttons: [
                        
            {
                extend: 'excel',
                filename: 'booking-status-colour-list',
                exportOptions: {
                    columns: [0,1] 
                }
            }
        ], 
    });
</script>
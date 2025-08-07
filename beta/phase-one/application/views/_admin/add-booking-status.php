<?php include('header.php'); ?>


</style>
<!-- page content -->
<div class="right_col" role="main">
    
       
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add booking Status Colour
                </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">

                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">

            <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <form method="post" name="master_form" id="master_form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Status Name <b class="require">*</b></label>
                                        <input  autocomplete="off" type="text" class="form-control" name="status_name" id="status_name" value="<?php if (!empty($single)) {echo $single->status_name;} ?>" placeholder="Enter shift name">
                                        <input type="hidden" class="form-control" name="id" id="id" value="<?php if (!empty($single)) {echo $single->id;} ?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <button style="margin-top: 20px;" type="submit" id="submit" class="btn btn-primary">Submit</button>
                                    </div>
                            </form>
                        </div> 
                    </div>
                </div>

            </div>



            <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                      <h3>Colour List</h3>
                    </div>
                    <div class="x_content">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Status Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($color_list)) {
                                    $i = 1;
                                    foreach ($color_list as $color_list_result) {
                                ?>
                                        <tr>
                                            <th scope="row">
                                                <?= $i++ ?>
                                            </th>
                                            <td><?= $color_list_result->status_name ?></td>
                                            <td>
                                                <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?= base_url() ?>delete/<?= $color_list_result->id ?>/tbl_bokking_status_color"><i class="fa-solid fa-trash"></i></a>

                                                <a title="Edit" class="btn btn-success" href="<?= base_url() ?>add-booking-status/<?=$color_list_result->id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
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
            },
            messages: {
                status_name: "Please enter status name",
                color_input: "Please select colour",
            },
        });
    });
    $(document).ready(function() {
    $('#colorpicker').change(function() {
       var ttttt= $("#colorpicker").val(); 
        $("#hexcolor").val(ttttt); 
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
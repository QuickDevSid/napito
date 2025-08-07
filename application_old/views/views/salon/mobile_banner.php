<?php include('header.php'); ?>
<style type="text/css">
    .input-content-option {
        height: 33px;
        width: 570px;

    }

    #example_filter {
        display: none;
    }

    .dataTables_length {
        width: auto;
    }
</style>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Mobile App Banner
                </h3>
            </div>


        </div>


        <div class="row">


            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form method="post" name="master_form" id="master_form" enctype="multipart/form-data">
                            <div class="row flex_wrap align_end">
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <label style="width:100%;">Upload Photo <b class="require">*</b>
                                        <small style="text-align:right;">(Note: Upload images with 150*200 dimension)</small>
                                    </label>
                                    <input style="height: 50px;border: 0px;" type="file" accept=".png,.jpg.jpeg" class="form-control" name="banner[]" id="banner" multiple>
                                    <div class="error" id="facility_name_error"></div>
                                </div>
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <label style="width:100%;">Expire On <b class="require">*</b></label>
                                    <input type="text" placeholder="Select Expire On Date" class="form-control datepicker_employee" name="show_till" id="show_till" value="">
                                </div>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <button style="margin-top: 30px;" type="submit" id="submit" name="banner_submit" value="banner_submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <!-- <div class="x_title">
                                    
                                   <div class="clearfix"></div>
                                </div> -->
                <div class="x_content">

                    <table style="width: 100%!important;" id="example" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Banner</th>
                                <th>Expire On</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($banner)) {
                                $i = 1;
                                foreach ($banner as $tips_list_result) {
                            ?>
                                    <tr>
                                        <td scope="row"><?= $i++ ?></td>
                                        <td>
                                            <a title="View" target="_blank" href="<?= base_url() ?>admin_assets/images/mobile_banner_photo/<?= $tips_list_result->banner ?>" target="_blank">
                                                <img style="height: 100px;width: 200px;" src="<?= base_url() ?>admin_assets/images/mobile_banner_photo/<?= $tips_list_result->banner ?>">
                                            </a>
                                        </td>
                                        <td><?= date('d M, Y', strtotime($tips_list_result->show_till)); ?></td>
                                        <td>
                                            <?php
                                            if (date('Y-m-d H:i:s', strtotime($tips_list_result->created_on . ' +1 day')) <= date('Y-m-d H:i:s')) {
                                                echo 'Approved';
                                            } else {
                                                echo 'Under Review';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?= base_url() ?>delete/<?= $tips_list_result->id ?>/tbl_salon_mobile_banner"><i class="fa-solid fa-trash"></i></a>
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
        $(".datepicker_employee").datepicker({
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true,
            maxDate: "+3Y",
            minDate: "+2",
            yearRange: "0:+3"
        });
        jQuery.validator.addMethod("noHTMLtags", function(value, element) {
            if (this.optional(element) || /<\/?[^>]+(>|$)/g.test(value)) {
                if (value == "") {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        }, "HTML tags are Not allowed.");
        $('#master_form').validate({
            ignore: [],
            rules: {
                'banner[]': {
                    required: true,
                    noHTMLtags: true,
                },
                show_till: {
                    required: true,
                    noHTMLtags: true,
                },
            },
            messages: {
                'banner[]': {
                    required: "Please upload image!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                show_till: {
                    required: "Please select expire on date!",
                    noHTMLtags: "HTML tags not allowed!",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>


<script>
    $('#example').DataTable({
        dom: 'lfrtip', // Removes both Excel button and the search box
        responsive: true,
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
    });
    $(document).ready(function() {
        $('#marketing .child_menu').show();
        $('#marketing').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.app-banner').addClass('active_cc');
    });
</script>
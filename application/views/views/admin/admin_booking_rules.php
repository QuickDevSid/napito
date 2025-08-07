<?php include('header.php'); 


?>
 <div class="right_col" role="main">
       
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Manage Booking Rule
                </h3>
            </div>

        <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">

                    </div>
                </div>
            </div> -->
    </div>
    <!-- <div class="clearfix"></div> -->

        <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="container">
                        <form method="post" class="form-group" name="rules_form" id="rules_form" enctype="multipart/form-data">
                            <div class="row">

                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label>Rule Type<b class="require">*</b></label>
                                    <select class="form-select form-control" name="type" id="type">
                                        <option value="">Select Rule Type</option>
                                        <?php if (!empty($salon_type)) {
                                            foreach ($salon_type as $salon_type_result) { ?>
                                                <option value="<?= $salon_type_result->id ?>"><?= $salon_type_result->type ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>

                            </div>


                            <!-- <pre></pre> -->
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <button style="margin-top: 10px;" type="submit" name="next" value="next" class="btn btn-success">Next</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<?php include('footer.php');
$id = 0;
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>


<script>
    $(document).ready(function() {
        $('#rules_form').validate({
            ignore: "",
            rules: {
                type: 'required',
            },
            messages: {
                type: 'Please select rule type!', 
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
 
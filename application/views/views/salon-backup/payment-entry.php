<?php include('header.php'); ?>
<style type="text/css">
    .error {}

    .input-content-option {
        height: 35px;
        width: 590px;

    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Make Payment
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
            <div class="x_panel">
                <div class="x_content">
                    <div class="container">
                        <form method="post" name="employee_form" id="employee_form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Select Student <b class="require">*</b></label>
                                    <div class="select-wrapper">
                                        <select class="form-select form-control chosen-select"
                                            name="student_name" id="student_name">
                                            <option value="">Select</option>
                                            <?php if (!empty($student_list)) {
                                                foreach ($student_list as $student_list_result) { ?>
                                                    <option value="<?= $student_list_result->id ?>" <?php if (!empty($single) && $single->student_list == $student_list_result->id) { ?>selected="selected"
                                                        <?php } ?>>
                                                        <?= $student_list_result->student_name ?>
                                                    </option>
                                                <?php }
                                            } ?>
                                        </select>
                                        <div class="arrow-down"></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12" style="margin-top: 5px;">
                                    <label>Total Paid Fees <b class="require">*</b></label>
                                    <input type="text" class="form-control" name="course_name" id="course_name"
                                        value="<?php if (!empty($single)) {
                                            echo $single->course_name;
                                        } ?>" readonly>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Total Fees <b class="require">*</b></label>
                                    <input type="text" class="form-control" name="total_fees" id="total_fees" value="<?php if (!empty($single)) {
                                        echo $single->total_fees;
                                    } ?>" placeholder="" readonly>
                                    <label style="display: none;" id="total_fees-error" class="error col-md-0 col-xs-12"
                                        for="total_fees"></label>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12" style="margin-top: 5px;">
                                    <label>Total Paid Fees <b class="require">*</b></label>
                                    <input type="text" class="form-control" name="total_paid_fees" id="total_paid_fees"
                                        value="<?php if (!empty($single)) {
                                            echo $single->total_paid_fees;
                                        } ?>" readonly>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Total Pending Fees <b class="require">*</b></label>
                                    <input type="text" class="form-control" name="total_pending_fees"
                                        id="total_pending_fees" value="<?php if (!empty($single)) {
                                            echo $single->total_pending_fees;
                                        } ?>" readonly>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Amount to Paid <b class="require">*</b></label>
                                    <input type="text" class="form-control" name="amount_to_paid" id="amount_to_paid"
                                        value="<?php if (!empty($single)) {
                                            echo $single->amount_to_paid;
                                        } ?>" placeholder="Enter amount to paid">
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Date <b class="require">*</b></label>
                                    <input type="date" class="form-control" name="date" id="date" value="<?php if (!empty($single)) {
                                        echo $single->date;
                                    } ?>" placeholder="Enter account number">
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Select Payment Mode <b class="require">*</b></label>
                                    <select class="form-select form-control chosen-select"
                                        name="payment_mode" id="payment_mode">
                                        <option name="payment_mode" value="" class="">Select</option>
                                        <option name="payment_mode" value="0" class="">UPI</option>
                                        <option name="payment_mode" value="1" class="">Cash</option>
                                        <option name="payment_mode" value="2" class="">Cheque</option>
                                        <option name="payment_mode" value="3" class="">Online</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Attachment File <b class="require">*</b></label>
                                    <input type="file" class="form-control" name="attachment_file" id="attachment_file"
                                        value="<?php if (!empty($single)) {
                                            echo $single->attachment_file;
                                        } ?>" placeholder="Enter attachment_file code">

                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Remark <b class="require">*</b></label>
                                    <input type="text" class="form-control" name="remark" id="remark" value="<?php if (!empty($single)) {
                                        echo $single->remark;
                                    } ?>" placeholder="Enter account type">
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12" style="float: left; margin-top: 50px;">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form> <!------------end of form---->
                    </div> <!----------end of container-------->

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
    $(document).ready(function () {
        $('#employee_form').validate({
            ignore: "",
            rules: {
                student_name: 'required',
                course_name: 'required',
                total_fees: 'required',
                total_paid_fees: 'required',
                total_pending_fees: 'required',
                amount_to_paid: 'required',
                date: 'required',
                payment_mode: 'required',
                remark: 'required',
                attachment_file: 'required',


            },
            messages: {
                student_name: "Please enter student name",
                course_name: "Please enter course name",
                total_fees: "Please enter total fees",
                total_paid_fees: "Please enter total paid fees",
                total_pending_fees: 'Please enter pending fees',
                amount_to_paid: 'Please enter amount to paid',
                date: 'Please enter date',
                payment_mode: 'Please enter payment mode',
                remark: 'Please enter remark',
                attachment_file: 'Please upload file',
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }

        });
    });


</script>

<script type="text/javascript">
    $(document).ready(function () {
        $(".chosen-select").chosen({
            max_selected_options: 5
        });
    });
</script>
<script>
    $("#student_name").change(function () {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_course_detail",
            data: { 'student_name': $("#student_name").val() },
            success: function (data) {


                $("#course_name").empty();
                $('#course_name').append('<option value="">Select Course Name</option>');
                var opts = JSON.parse(data);
                console.log(opts);
                $.each(opts, function (i, d) {
                    $('#course_name').append('<option value="' + d.id + '">' + d.course_name + '</option>');
                });
                $('#course_name').trigger('chosen:updated');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });

    });
</script>
<script>
   $("#student_name").change(function () {
    $.ajax({
        type: "POST",
        url: "<?= base_url(); ?>salon/Ajax_controller/get_course_fees",
        data: { 'course_name_id': $('#student_name').val() },
        success: function (data) {
            console.log(data);
            data = JSON.parse(data);
            $("#total_fees").val(data.fees_amount);
            $("#course_name").val(data.course_name);
            if (data.total_paid_fees == null && data.total_pending_fees == null) {
                $("#total_paid_fees").val('0');
                $("#total_pending_fees").val(data.fees_amount);
            } else {
                $("#total_paid_fees").val('');
                $("#total_pending_fees").val('');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
});

</script>



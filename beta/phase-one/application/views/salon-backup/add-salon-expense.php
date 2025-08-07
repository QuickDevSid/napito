<?php include('header.php'); ?>
<style type="text/css">
    .error {
        color: red;
        float: left;
        /*    position: absolute;*/
    }

    .input-content-option {
        height: 35px;
        width: 600px;
        border-radius: 5px;
        border: solid gray 1px;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Expenses
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


            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">
                        <div class="container">
                            <form name="add_student" id="add_student" autocomplete="off" method="POST"
                                enctype="multipart/form-data">
                                <div class="row mt-3">
                                    <div class="form-group">
                                        <label for="student_name">Branch Name <b class="require">*</b></label>
                                        <input id="branch_name" name="branch_name" type="text" class="form-control"
                                            placeholder="Enter branch name"
                                            value="<?php echo $this->session->userdata('branch_name'); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Select Category <b class="require">*</b></label>
                                        <select class="form-select form-control input-content-option chosen-select"
                                            name="expense_type" id="expense_type">
                                            <option value="" class="">Select Category </option>
                                            <?php if (!empty($expense_name)) {
                                                foreach ($expense_name as $expense_name_result) { ?>
                                                    <option value="<?= $expense_name_result->id ?>" <?php if (!empty($single) && $single->expense_type == $expense_name_result->id) { ?>selected="selected"
                                                        <?php } ?>>
                                                        <?= $expense_name_result->expenses_name ?>
                                                    </option>
                                                <?php }
                                            } ?>
                                            <div class="error" id="expense_type_error"></div>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="parents_name">Payment Mode<b class="require">*</b></label>
                                        <input id="payment_mode" name="payment_mode" type="text" class="form-control"
                                            placeholder=" Enter payment mode"
                                            value="<?php if (!empty($single)) {
                                                echo $single->expense_amount;
                                            } ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="parents_name">Expense Amount (In Rupees)<b
                                                class="require">*</b></label>
                                        <input id="expense_amount" name="expense_amount" type="text"
                                            class="form-control" placeholder="Enter expense Amount"
                                            value="<?php if (!empty($single)) {
                                                echo $single->expense_amount;
                                            } ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="parents_name">Expense Date </label>
                                        <input id="expense_date" name="expense_date" type="date" class="form-control"
                                            placeholder="DD-MM-YYYY"
                                            value="<?php if (!empty($single) && $single->expense_date != '1970-01-01') {
                                                echo date("d-m-Y", strtotime($single->expense_date));
                                            } ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="expense_remark">Remark</label>

                                        <input id="expense_remark" name="expense_remark" type="text"
                                            class="form-control" placeholder="Enter  Remark" value="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <button class="form_submit btn btn-success">Submit </button>
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
        $('#add_student').validate({
            rules: {
                branch_name: 'required',
                expense_type: 'required',
                payment_mode: 'required',
                expense_amount: 'required',
            },
            messages: {
                branch_name: 'Please enter branch name',
                expense_type: 'Please select expense type',
                expense_amount: 'Please enter payment amount',
                payment_mode: 'Please enter payment mode',
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            },
        });
    });


</script>
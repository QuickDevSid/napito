<style>
    #add_on_plan_chosen{
        width: 100% !important;
    }
    #payment_mode_chosen{
        width: 100% !important;
    }
</style>
<form id="make_form" name="make_form" method="post" enctype="multipart/form-data" data-parsley-validate action="<?=base_url();?>purchase-add-on">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
            <label for="fullname">Select Plan*</label>
            <select class="chosen-select form-control" id="add_on_plan" name="add_on_plan">
                <option value="">Select Plan</option>
                <?php if(!empty($add_ons)){ foreach($add_ons as $row){?>
                    <option value="<?=$row->id;?>" data-amount="<?=$row->price;?>" <?=$this->input->post('requested_plan') == $row->id ? 'selected' : ''; ?>><?=$row->plan_name;?> [Rs. <?=$row->price;?>] [Qty. <?=$row->qty;?> Coins]</option>
                <?php }} ?>
            </select>
            <input type="hidden" id="id" class="form-control" name="id" value="<?php if (!empty($branch)) {
                                                                                    echo $branch->id;
                                                                                } ?>" />
            <label id="add_on_plan-error" style="display:none;" class="error" for="add_on_plan">Please select plan!</label>
        </div>
        <?php        
        $gst_no = (!empty($branch) && $branch->is_gst_applicable == '1') ? ($branch->gst_no != "" ? $branch->gst_no : null) : null;
        $igst_rate = 0;
        // $igst_rate = !empty($branch) && $branch->is_gst_applicable == '1') ? (!empty($setup) ? ($setup->gst_rate != "" ? $setup->gst_rate : 18) : 18) : 0;
        $cgst_rate = (!empty($branch) && $branch->is_gst_applicable == '1') ? (!empty($setup) ? ($setup->gst_rate != "" ? $setup->gst_rate/2 : 18/2) : 18/2) : 0;
        $sgst_rate = (!empty($branch) && $branch->is_gst_applicable == '1') ? (!empty($setup) ? ($setup->gst_rate != "" ? $setup->gst_rate/2 : 18/2) : 18/2) : 0;
        $gst_rate = (!empty($branch) && $branch->is_gst_applicable == '1') ? (!empty($setup) ? ($setup->gst_rate != "" ? $setup->gst_rate : 18) : 18) : 0;
        ?>
        <input type="hidden" name="igst_rate" id="igst_rate" value="<?=$igst_rate; ?>">
        <input type="hidden" name="cgst_rate" id="cgst_rate" value="<?=$cgst_rate; ?>">
        <input type="hidden" name="sgst_rate" id="sgst_rate" value="<?=$sgst_rate; ?>">
        <input type="hidden" name="gst_rate" id="gst_rate" value="<?=$gst_rate; ?>">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-group">
            <div class="form-group">
                <label>Is GST Applicable? <b class="require">*</b></label>
                <select class="form-control chosen-select" required name="is_gst_applicable" id="is_gst_applicable">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                <label id="is_gst_applicable-error"  class="error" style="display:block;" for="is_gst_applicable"></label>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-group">
            <div class="form-group">
                <label for="fullname" id="gst_no_label">GST No.</label>
                <input readonly placeholder="Enter GST No" type="text" name="gst_no" id="gst_no" class="form-control" value="">
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 form-group">
            <label>Plan Amount</label>
            <input readonly type="text" placeholder="Enter Plan Amount" readonly class="form-control" name="plan_amount" id="plan_amount" value="">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 form-group" style="display:none;">
            <label>IGST <small id="igst_rate_text">(<?=$igst_rate . '%'; ?>)</small></label>
            <input readonly type="text" placeholder="Enter IGST" readonly class="form-control" name="igst" id="igst" value="">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 form-group">
            <label>CGST <small id="cgst_rate_text">(<?=$cgst_rate . '%'; ?>)</small></label>
            <input readonly type="text" placeholder="Enter CGST" readonly class="form-control" name="cgst" id="cgst" value="">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 form-group">
            <label>SGST <small id="sgst_rate_text">(<?=$sgst_rate . '%'; ?>)</small></label>
            <input readonly type="text" placeholder="Enter SGST" readonly class="form-control" name="sgst" id="sgst" value="">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 form-group">
            <label>Final Amount</label>
            <input readonly type="text" placeholder="Enter Final Amount" readonly class="form-control" name="final_amount" id="final_amount" value="">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-group">
            <label for="fullname">Select Payment Mode*</label>
            <select class="form-control chosen-select payment_mode" name="payment_mode" id="payment_mode">
                <option value="">Select Payment Mode</option>
                <?php if(!empty($payment_modes)){ for($i=0;$i<count($payment_modes); $i++){ ?>
                    <option value="<?=$payment_modes[$i];?>"><?=$payment_modes[$i];?></option>
                <?php }}else{ ?>
                    <option value="UPI">UPI</option>
                    <option value="Cash">Cash</option>
                    <option value="Card">Card</option>
                    <option value="Online">Online</option>
                <?php } ?>
            </select>
            <label id="payment_mode-error" style="display:none;" class="error" for="payment_mode">Please select plan!</label>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-group">
            <label>Transaction ID</label>
            <input readonly type="text" placeholder="Enter Transaction ID" readonly class="form-control" name="payment_id" id="payment_id" value="">
        </div>
        <div class="form-group col-md-6 col-sm-6 col-xs-12" style="margin-top: 27px;">
            <button type="submit" id="submit_button" class="btn btn-success">Confirm</button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function () {
        $('#gst_no').on('input', function() {
            $(this).val($(this).val().toUpperCase());
        });
        $("#is_gst_applicable").change(function() {
            if($("#is_gst_applicable").val() == '1'){
                $('#gst_no').attr('readonly',false).attr('required',false);
                $('#gst_no_label').html('GST No. <b class="require">*</b>');
            }else{
                $('#gst_no').attr('readonly',true).val('').attr('required',false);
                $('#gst_no_label').html('GST No.');
            }
            calculateGST();
        });

        function toggleTransactionIdField() {
            var selectedMode = $('#payment_mode').val();
            if (selectedMode.toLowerCase() !== 'cash' && selectedMode !== '') {
                $('#payment_id').prop('readonly', false);
            } else {
                $('#payment_id').prop('readonly', true).val('');
            }
        }

        // Run on page load in case there's a preselected value
        toggleTransactionIdField();

        // Run on change
        $('#payment_mode').on('change', function () {
            toggleTransactionIdField();
        });        

        // ========== GST + Final Amount Calculation ==========
        function calculateGST() {
            var amount = parseFloat($("#add_on_plan option:selected").data("amount")) || 0;
            var is_gst_applicable = parseFloat($("#is_gst_applicable").val()) || '0';

            // GST rates from hidden inputs
            var igst_rate = is_gst_applicable == '1' ? (parseFloat($("#igst_rate").val()) || 0) : 0;
            var cgst_rate = is_gst_applicable == '1' ? (parseFloat($("#cgst_rate").val()) || 0) : 0;
            var sgst_rate = is_gst_applicable == '1' ? (parseFloat($("#sgst_rate").val()) || 0) : 0;

            var igst = (amount * igst_rate) / 100;
            var cgst = (amount * cgst_rate) / 100;
            var sgst = (amount * sgst_rate) / 100;

            var finalAmount = amount + igst + cgst + sgst;

            // Fill values
            $("#plan_amount").val(amount.toFixed(2));
            $("#igst").val(igst.toFixed(2));
            $("#cgst").val(cgst.toFixed(2));
            $("#sgst").val(sgst.toFixed(2));
            $("#final_amount").val(finalAmount.toFixed(2));
        }

        // Trigger GST calculation on plan change
        $("#add_on_plan").on("change", function () {
            calculateGST();
        });

        // Run once on page load if plan is pre-selected
        calculateGST();
        
        $(".chosen-select").chosen();

        jQuery.validator.addMethod("gstFormat", function(value, element) {
            return this.optional(element) || /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[A-Z0-9]{1}[Z]{1}[A-Z0-9]{1}$/.test(value);
        }, "Please enter a valid GST number in the correct format (e.g., 22AAAAA0000A1Z5).");
        $.validator.addMethod("alphanumeric", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
        }, "Only letters and numbers are allowed (no special characters).");
        $('#make_form').validate({
			ignore:[],
            rules: {
                add_on_plan: 'required',
                payment_mode: 'required',
                gst_no: {
                    // required: function(element) {
                    //     return $('#is_gst_applicable').val() === '1';
                    // },
                    maxlength: 15,
                    minlength: 15,
                    alphanumeric: true,
                    gstFormat: true,
                },
            },
            messages: {
                add_on_plan: {
                        required: "Please select plan!",
                    },
                payment_mode: {
                        required: "Please select payment mode!",
                    },
                gst_no:{
                    // required: "Please enter GST No.",
                    maxlength: "Please enter max 15 digits",
                    minlength: "Please enter min 15 digits",
                    alphanumeric: "Please enter valid GST no",
                    gstFormat: "Please enter valid GST no(e.g. 22AAAAA0000A1Z5)",
                },
            }
        });
    });
</script>
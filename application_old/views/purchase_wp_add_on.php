<form id="make_form" name="make_form" method="post" enctype="multipart/form-data" data-parsley-validate action="<?=base_url();?>purchase-add-on">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
            <label for="fullname">Select Plan*</label>
            <select class="chosen-select form-control" id="add_on_plan" name="add_on_plan">
                <option value="">Select Plan</option>
                <?php if(!empty($add_ons)){ foreach($add_ons as $row){?>
                    <option value="<?=$row->id;?>" <?=$this->input->post('requested_plan') == $row->id ? 'selected' : ''; ?>><?=$row->plan_name;?> [Rs. <?=$row->price;?>]</option>
                <?php }} ?>
            </select>
            <input type="hidden" id="id" class="form-control" name="id" value="<?php if (!empty($branch)) {
                                                                                    echo $branch->id;
                                                                                } ?>" />
            <label id="add_on_plan-error" style="display:none;" class="error" for="add_on_plan">Please select plan!</label>
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
        $(".chosen-select").chosen();
        $('#make_form').validate({
			ignore:[],
            rules: {
                add_on_plan: 'required',
                payment_mode: 'required'
            },
            messages: {
                add_on_plan: {
                        required: "Please select plan!",
                    },
                payment_mode: {
                        required: "Please select payment mode!",
                    },
            }
        });
    });
</script>
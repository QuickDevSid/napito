<?php include('header.php'); ?>
<style type="text/css">
    .form-control-option {
        height: 35px;
        width: 590px;
        float: left;
    }
    .btn-primary{
        padding: 10px 17px !important;
    }
    td span{
        float: right;
    }
    .page-title h3{
        display: block;
    }
    .current_balance{
  color: white;float:right;padding: 10px;background: linear-gradient(271deg, #800080, #ff69b4) ;
}
    
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Petty Cash
                </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <h3>
                    <label class="current_balance">Current Balance: Rs. <?=$profile->current_petty_cash_balance;?></label>
                </h3>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <form method="post" name="employee_form" id="employee_form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label>Select Employee <b class="require">*</b></label>
                                        <select class="form-control get_attendance chosen-select" name="employee" id="employee" onchange="showPersonName()">
                                            <option value="">Select Employee</option>
                                            <option value="Other">Other Employee</option>
                                            <?php if(!empty($employee)){ 
                                                foreach($employee as $employee_result){?>
                                                <option value="<?=$employee_result->id?>" <?php if(isset($_GET['employee']) && $_GET['employee'] == $employee_result->id){?>selected="selected"<?php }?>><?=$employee_result->full_name?></option>
                                            <?php }}?>
                                        </select>
                                        <label for="employee" style="display:none;" generated="true" class="error">Please select employee!</label>
                                    </div> 
                                    <div class="col-md-4 col-sm-6 col-xs-12 form-group" style="display:none;" id="person_name_div">
                                        <label>Person Name <b class="require">*</b></label>
                                        <input autocomplete="off" class="form-control" type="text" name="name" id="name" value="<?php if (!empty($single)) { echo $single->entry_by;} ?>" placeholder="Enter Person Name">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label>Type <b class="require">*</b></label>
                                        <select class="form-control chosen-select" id="type" name="type" onchange="setProductSelection()">
                                            <option value="">Select Type</option>
                                            <option value="0" <?php if (!empty($single) && $single->type == '0') {echo 'selected'; } ?> <?php if($profile->current_petty_cash_balance == null || $profile->current_petty_cash_balance == '' || (float)$profile->current_petty_cash_balance <= 0){ echo 'disabled'; }?>>Debit</option>
                                            <option value="1" <?php if (!empty($single) && $single->type == '1') {echo 'selected'; } ?>>Credit</option>
                                        </select>
                                    </div>
                                <!-- </div>
                                <div class="row"> -->
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label>Opening Balance <b class="require">*</b></label>
                                        <input readonly autocomplete="off" class="form-control" type="text" name="opening_balance" id="opening_balance" value="<?php if (!empty($single)) { echo $single->opening_balance;} ?>" placeholder="Enter Opening Balance">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Amount <b class="require">*</b></label>
                                        <input readonly type="text" autocomplete="off" placeholder="Enter Amount" class="form-control" name="amount" id="amount" value="<?php if(!empty($single)){ echo $single->amount; }?>" onkeyup="setProductSelection()">
                                        <input autocomplete="off" class="form-control" type="hidden" name="id" id="id" value="<?php if (!empty($single)) {echo $single->id;} ?>">
                                        <span class="error status_error"></span>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Closing Balance <b class="require">*</b></label>
                                        <input readonly autocomplete="off" class="form-control" type="text" name="closing_balance" id="closing_balance" value="<?php if (!empty($single)) { echo $single->closing_balance;} ?>" placeholder="Enter Closing Balance">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label>Remark <b class="require">*</b></label>
                                        <textarea autocomplete="off" class="form-control" name="remark" id="remark"><?php if (!empty($single)) {echo $single->remark;} ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12 " style="margin-top: 10px;margin-left:-10px">
                                    <button type="submit" id="submit_button" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <table  id="example" class="table table-striped responsive-utilities jambo_table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Sr.no</th>
                                        <!-- <th>Type</th> -->
                                        <th>Remark</th>
                                        <th>Opening Balance<br><small>(In INR)</small></th>
                                        <th>Amount<br><small>(In INR)</small></th>
                                        <th>Closing Balance<br><small>(In INR)</small></th>
                                        <th>Added By</th>
                                        <th>Added On</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($entries)) {
                                        $i = 1;
                                        foreach ($entries as $product_master_list_result) {
                                            if($product_master_list_result->type == '0'){
                                                $style = '#f7b9b947';
                                            }else{
                                                $style = '#96d1967a';
                                            }
                                    ?>
                                            <tr style="background-color:<?=$style;?>">
                                                <td><?= $i++ ?></td>
                                                <!-- <td> -->
                                                    <?php
                                                        // if($product_master_list_result->type == '0'){
                                                        //     echo 'Debit';
                                                        // }else{
                                                        //     echo 'Credit';
                                                        // }
                                                    ?>
                                                <!-- </td> -->
                                                <td>
                                                    <button title="Description" type="button" onclick="showDescPopup(<?=$product_master_list_result->id;?>)" class="btn btn-info" data-toggle="modal" data-target="#exampledescModal_<?=$product_master_list_result->id;?>">
                                                        <i class="fa fa-file-alt"></i>
                                                    </button>
                                                    <div class="modal fade" id="exampledescModal_<?=$product_master_list_result->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampledescModalLabel_<?=$product_master_list_result->id;?>" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampledescModalLabel_<?=$product_master_list_result->id;?>">Description</h5>
                                                                <button type="button" style="margin-top: -20px;" class="close" data-dismiss="modal" aria-label="Close" onclick="closeDescPopup(<?=$product_master_list_result->id;?>)">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div id="desc_response_<?=$product_master_list_result->id;?>">
                                                                    <?php echo $product_master_list_result->remark != "" ? $product_master_list_result->remark : 'Remark not available'; ?>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?= $product_master_list_result->opening_balance ?></td>
                                                <td><?= $product_master_list_result->amount ?></td>
                                                <td><?= $product_master_list_result->closing_balance ?></td>
                                                <td><?= $product_master_list_result->entry_by ?></td>
                                                <td><?= date('d-m-Y H:i:s',strtotime($product_master_list_result->created_on)) ?></td>
                                                
                                                <!-- <td>
                                                    <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?= base_url() ?>delete/<?= $product_master_list_result->id ?>/tbl_petty_cash_entries"><i class="fa-solid fa-trash"></i></a>
                                                </td> -->
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
        var table = $('#example').DataTable({ 
            dom: 'Blfrtip',
            responsive: true,
            // scrollX: 300,
            lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            buttons: [
                {
                    extend: 'excel',
                    filename: 'product-list',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5] 
                    }
                }
            ],
            columnDefs: [
                { 
                    orderable: false, 
                    targets: [0, 1, 2, 3, 4, 5]
                }
            ]
        });

        $('#employee_form').validate({
            ignore: "",
            rules: {
                employee: 'required',
                name: {
                    required: function(element) {
                        return $('#employee').val() == 'Other';
                    },
                },
                remark: 'required',           
                type: {
                    required: true,
                },
                amount: {
                    required: true,
                    number: true,
                    min: 1,
                },
            },
            messages: {
                employee: 'Please select employee',
                name: "Please enter name!",
                remark: "Please enter remark !",
                type: {
                    required: "Please select type !",
                },
                amount: {
                    required: "Please enter amount!",
                    number: "Only number allowed!",
                    min: "Minimum 1 amount required!",
                },
                person_name: {
                    required: "Please enter person name!",
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
            },
            submitHandler: function(form) {
                if (confirm("Are you sure you want to submit the form as this action can not be reverted back?")) {
                    form.submit();
                }
            }
        });
    });
</script>
<script type="text/javascript">
    var balance = '<?php echo $profile->current_petty_cash_balance; ?>';
    $(document).ready(function() {
        $(".chosen-select").chosen({             
        });
    });
</script>
<script>
    function setProductSelection(){
        if ($("#type").val() != "") {
            $("#opening_balance").val(parseFloat(0.00).toFixed(2));
            $("#closing_balance").val(parseFloat(0.00).toFixed(2));

            if($("#type").val() == '0'){
                $('#amount').attr('readonly',false).attr('max',parseFloat(balance).toFixed(2));
            }else{
                $('#amount').attr('readonly',false).removeAttr('max');
            }
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_petty_cash_balance_ajax",
                data: {},
                success: function(data) {
                    var parsedData = JSON.parse(data);
                    var balance = parseFloat(parsedData.current_petty_cash_balance);
                    $("#opening_balance").val(balance.toFixed(2));

                    var amount = parseFloat($("#amount").val()) || 0.00;
                    var type = $("#type").val();

                    if(type == '0'){
                        var new_balance = balance - amount;
                    }else if(type == '1'){
                        var new_balance = balance + amount;
                    }else{
                        var new_balance = 0.00;
                    }
                    $("#closing_balance").val(parseFloat(new_balance).toFixed(2));
                },
            });
        }else{
            $('#amount').attr('readonly',true).removeAttr('max');
        }
    }
    function showDescPopup(id){
        var exampleModal = $('#exampledescModal_'+id);
        exampleModal.css('display','block');
        exampleModal.css('opacity','1');
        $('.modal-open').css('overflow','auto').css('padding-right','0px'); 
    }
    function closeDescPopup(id){
        var exampleModal = $('#exampledescModal_'+id);
        exampleModal.css('display','none');
        exampleModal.css('opacity','0');
        $('.modal-open').css('overflow','auto').css('padding-right','0px');
    }
    function showPersonName(){
        if($('#employee').val() == 'Other'){
            $('#person_name_div').show();
        }else{
            $('#person_name_div').hide();
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('#reports .child_menu').show();
        $('#reports').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.petty-cash').addClass('active_cc');
    });
</script>

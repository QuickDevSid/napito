<?php include('header.php');?>
<style>    
<?php if(isset($_GET['type']) && $_GET['type'] != ""){?>
#type_chosen .chosen-single{
    color: black !important;
    background-color: #607d8b38 !important;
}
#type_chosen .chosen-container-single .chosen-single span{
    color: #000 !important;
}
<?php } ?>
<?php if(isset($_GET['from_date']) && $_GET['from_date'] != ""){?>
#from_date_chosen .chosen-single{
    color: black !important;
    background-color: #607d8b38 !important;
}
#from_date_chosen .chosen-container-single .chosen-single span{
    color: #000 !important;
}
<?php } ?>
<?php if(isset($_GET['to_date']) && $_GET['to_date'] != ""){?>
#to_date_chosen .chosen-single{
    color: black !important;
    background-color: #607d8b38 !important;
}
#to_date_chosen .chosen-container-single .chosen-single span{
    color: #000 !important;
}
<?php } ?>
<?php if(isset($_GET['product']) && $_GET['product'] != ""){?>
#product_chosen .chosen-single{
    color: black !important;
    background-color: #607d8b38 !important;
}
#product_chosen .chosen-container-single .chosen-single span{
    color: #000 !important;
}
<?php } ?>
<?php if(isset($_GET['supplier']) && $_GET['supplier'] != ""){?>
#supplier_chosen .chosen-single{
    color: black !important;
    background-color: #607d8b38 !important;
}
#supplier_chosen .chosen-container-single .chosen-single span{
    color: #000 !important;
}
<?php } ?>
<?php if(isset($_GET['category']) && $_GET['category'] != ""){?>
#category_chosen .chosen-single{
    color: black !important;
    background-color: #607d8b38 !important;
}
#category_chosen .chosen-container-single .chosen-single span{
    color: #000 !important;
}
<?php } ?>

</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Product Stock Entries
                </h3>
            </div>

            <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  
                </div>
            </div> -->
        </div>
        <!-- <div class="clearfix"></div> -->

        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form id="make_form" name="make_form" method="get" enctype="multipart/form-data" data-parsley-validate>                                
                            <div class="row"> 
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="fullname">Product Category</label>
                                    <select class="form-control choosen" id="category" name="category">
                                    <option value="">All Product Category</option>
                                    <?php 
                                        if(!empty($select_product_category)){
                                        foreach($select_product_category as $product_result){
                                    ?>
                                    <option value="<?=$product_result->id;?>" <?php if(isset($_GET['category']) && $_GET['category'] == $product_result->id){?>selected<?php } ?>><?=$product_result->product_category;?></option>
                                    <?php }} ?>
                                    </select>
                                </div>   
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="fullname">Product</label>
                                    <select class="form-control choosen" id="product" name="product">
                                    <option value="">All Product</option>
                                    <?php 
                                    if(isset($_GET['category']) && $_GET['category'] != ""){
                                        $products = $this->Salon_model->get_category_product($_GET['category']);
                                        if(!empty($products)){
                                            foreach($products as $product_result){
                                    ?>
                                    <option value="<?=$product_result->id;?>" <?php if(isset($_GET['product']) && $_GET['product'] == $product_result->id){?>selected<?php } ?>><?=$product_result->product_name;?></option>
                                    <?php }}} ?>
                                    </select>
                                </div>                       
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="fullname">From Date</label>
                                    <input type="text" class="form-control custom_date" placeholder="From Service Date" name="from_date" id="from_date" value="<?php if(isset($_GET["from_date"]) && $_GET["from_date"] != "0" && $_GET["from_date"] != ""){ echo date('d-m-Y',strtotime($_GET['from_date'])); }?>">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="fullname">To Date</label>
                                    <input type="text" class="form-control custom_date" placeholder="To Service Date" name="to_date" id="to_date" value="<?php if(isset($_GET["to_date"]) && $_GET["to_date"] != "0" && $_GET["to_date"] != ""){ echo date('d-m-Y',strtotime($_GET['to_date'])); }?>">
                                </div>      
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="fullname">Entry Type</label>
                                    <select class="form-control choosen" id="type" name="type">
                                    <option value="">All Entry Type</option>
                                    <option value="0" <?php if(isset($_GET['type']) && $_GET['type'] == '0'){?>selected<?php } ?>>Inward</option>
                                    <option value="1@@@2" <?php if(isset($_GET['type']) && $_GET['type'] == '1@@@2'){?>selected<?php } ?>>Outward - Expired</option>
                                    <!-- <option value="1@@@3" <?php if(isset($_GET['type']) && $_GET['type'] == '1@@@3'){?>selected<?php } ?>>Outward - Garbage</option> -->
                                    <option value="1@@@4" <?php if(isset($_GET['type']) && $_GET['type'] == '1@@@4'){?>selected<?php } ?>>Outward - Damaged</option>
                                    <option value="1@@@5" <?php if(isset($_GET['type']) && $_GET['type'] == '1@@@5'){?>selected<?php } ?>>Outward - Internally Used</option>
                                    </select>
                                </div>   
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label for="fullname">Inward Supplier</label>
                                    <select class="form-control choosen" id="supplier" name="supplier">
                                    <option value="">All Supplier</option>
                                    <?php 
                                        if(!empty($supplier)){
                                        foreach($supplier as $product_result){
                                    ?>
                                    <option value="<?=$product_result->id;?>" <?php if(isset($_GET['supplier']) && $_GET['supplier'] == $product_result->id){?>selected<?php } ?>><?=$product_result->name;?></option>
                                    <?php }} ?>
                                    </select>
                                </div>                                           
                            </div>                                            
                            <div class="error" id="status_error_new_2"></div>                                       
                            <div class="row">
                                <div class="col-lg-4 col-md-4  col-sm-12 col-xs-12">
                                    <button type="submit" id="submit_button" class="btn btn-success" style="margin-top:25px;">Search</button>
                                    <?php if(isset($_GET['supplier']) || isset($_GET['type']) || isset($_GET['product']) || isset($_GET['from_date']) || isset($_GET['to_date'])){ ?>
                                    <a href="<?=base_url();?><?=$this->uri->segment(1);?>" class="btn btn-warning reset_btn" style="margin-top:25px;">Reset</a>
                                    <?php } ?>
                                </div>	
                            </div>	
                            <div class="clearfix"></div>
                        </form>
                    </div>   
                    <?php $product_list = $this->Salon_model->get_all_product(); ?>
                    <div class="x_content">
                        <table id="example" class="table  responsive-utilities jambo_table" style="width: 100%;">
                            <thead>
                                <tr class="headings">
                                    <th>Sr.No.</th>
                                    <th>Entry Type</th>
                                    <th>Inward ID</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Product Unit</th>
                                    <th>Opening Stock</th>
                                    <th>Quantiy</th>
                                    <th>Closing Stock</th>
                                    <th>Entry Created On</th>
                                    <th>Inward Supplier</th>
                                    <th>Purchase Price<br><small>(Per Unit)</small></th>
                                    <th>Manufacturing Date</th>
                                    <th>Expiry Date</th>
                                    <!-- <th>Actions</th> -->
                                </tr>
                            </thead>

                            <tbody>
                                <?php if(!empty($product_list)){
                                    $i=1;
                                        foreach($product_list as $product_list_result){
                                            $product_sub_category = $this->Admin_model->get_sub_category_details($product_list_result->product_subcategory);
                                            if($product_list_result->entry_type == '0'){
                                                $style = '#96d1967a';
                                            }else{
                                                $style = '#f7b9b947';
                                            }
                                            $supplier_details = $this->Salon_model->get_single_supplier($product_list_result->supplier);
                                ?>
                                <tr style="background-color:<?=$style;?>">
                                    <td scope="row"><?=$i++?></td>
                                    <td>
                                        <?=($product_list_result->entry_type == '0') ? 'Inward' : 'Outward';?>
                                        <?php 
                                            if($product_list_result->entry_type == '1' && $product_list_result->consumption_type != ""){
                                                if($product_list_result->consumption_type == "2"){
                                                    echo '<br><small><u>Expired</u></small>';
                                                }elseif($product_list_result->consumption_type == "3"){
                                                    echo '<br><small><u>Garbage</u></small>';
                                                }elseif($product_list_result->consumption_type == "4"){
                                                    echo '<br><small><u>Damaged</u></small>';
                                                }elseif($product_list_result->consumption_type == "5"){
                                                    echo '<br><small><u>Internally Used</u></small>';
                                                }
                                            } 
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            $inward_id_details = '';
                                            if($product_list_result->barcode_id != ""){
                                                $inward_id_details = '<a style="cursor:pointer;text-decoration:underline;" onclick="showPopup('.$product_list_result->id.')" data-toggle="modal" data-target="#exampleModal_'.$product_list_result->id.'">'.$product_list_result->barcode_id.'</a>';
                                            }
                                        ?>
                                        <?=($product_list_result->entry_type == '0') ? ($inward_id_details != "" ? $inward_id_details : 'NA') : '-';?>
                                        <div class="modal fade" id="exampleModal_<?=$product_list_result->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_<?=$product_list_result->id;?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel_<?=$product_list_result->id;?>">Inward Barcode</h5>
                                                        <button style="margin-top: -25px;" type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closePopup(<?=$product_list_result->id;?>)">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div style="text-align:center;" id="response_<?=$product_list_result->id;?>">
                                                            <img style="height: 50px;width: 200px;" class="barcode-img" src="<?=base_url();?>barcode.php?codetype=Code39&size=40&text=<?=$product_list_result->barcode_id;?>&print=true" />
                                                            <p><?=$product_list_result->barcode_id;?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?=$product_list_result->product_name?></td>
                                    <td><?=$product_list_result->productcategory?></td>
                                    <td><?=!empty($product_sub_category) ? $product_sub_category->product_sub_category : '-'; ?></td>
                                    <td><?=$product_list_result->product_unit?></td>
                                    <td><?=$product_list_result->opening_stock?></td>
                                    <td><a style="text-decoration:underline;" href="<?=base_url();?>product-barcode?barcodes=<?=base64_encode($product_list_result->barcode_ids);?>"><?=$product_list_result->quantity?></a></td>
                                    <td><?=$product_list_result->closing_stock?></td>
                                    <td><?=$product_list_result->created_on != "" ? date('d-m-Y h:i A',strtotime($product_list_result->created_on)) : '-';?></td>
                                    <td><?=(!empty($supplier_details)) ? $supplier_details->name : '-'?></td>
                                    <td><?=$product_list_result->purchase_price != "" ? $product_list_result->purchase_price : '-' ;?></td>
                                    <td><?=$product_list_result->mfg_date != "" && $product_list_result->mfg_date != "1970-01-01" && $product_list_result->mfg_date != "0000-00-00" ? date('d-m-Y',strtotime($product_list_result->mfg_date)) : '-';?></td>
                                    <td><?=$product_list_result->exp_date != "" && $product_list_result->exp_date != "1970-01-01" && $product_list_result->exp_date != "0000-00-00" ? date('d-m-Y',strtotime($product_list_result->exp_date)) : '-';?></td>
                                   
                                    <!-- <td>
                                        <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$product_list_result->id?>/tbl_product_stock"><i class="fa-solid fa-trash"></i></a>    

                                        <a title="Edit" class="btn btn-success" href="<?=base_url()?>add-product-stock/<?=$product_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a> 

                                    </td> -->
                                </tr>
                            <?php }}?>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php');?>


<script>
$('#example').DataTable({ 
dom: 'Blfrtip',
responsive: true,
lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
scrollX: true,
    buttons: [
      
        {
            extend: 'excel',
            filename: 'product-stock-entries',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13] 
            }
        }
        
        
    ], 
});
    function showPopup(id){
        var exampleModal = $('#exampleModal_'+id);
        exampleModal.css('display','block');
        exampleModal.css('opacity','1');
        $('.modal-open').css('overflow','auto').css('padding-right','0px'); 
    }
    function closePopup(id){
        var exampleModal = $('#exampleModal_'+id);
        exampleModal.css('display','none');
        exampleModal.css('opacity','0');
        $('.modal-open').css('overflow','auto').css('padding-right','0px');
    }
</script>
<script>
    $(document).ready(function() {
        $( ".custom_date" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd-mm-yy",
            minDate: "-10y",
            maxDate: "+10y"
        });
        $(".choosen").chosen({
            no_results_text: "Oops, nothing found!"
        });
    });
    
    $("#from_date, #to_date").on("change", function () {
        var fromDateStr = $('#from_date').val();
        var toDateStr = $('#to_date').val();

        var fromDateParts = fromDateStr.split("-");
        var toDateParts = toDateStr.split("-");

        var fromDate = new Date(fromDateParts[2], fromDateParts[1] - 1, fromDateParts[0]);
        var toDate = new Date(toDateParts[2], toDateParts[1] - 1, toDateParts[0]);

        if (!isNaN(fromDate) && !isNaN(toDate)) {
            if (fromDate > toDate) {
                $("#status_error_new_2").html("From Date should be less than or equal to To Date");
                $("#submit_button").prop('disabled', true);
            } else {
                $("#status_error_new_2").html("");
                $("#submit_button").prop('disabled', false);
            }
        } else {
            $("#status_error_new_2").html("");
            $("#submit_button").prop('disabled', false);
        }
    });
    $("#category").on("change", function () {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_category_product_ajax",
            data: {
                'category': $("#category").val()
            },
            success: function(data) {
                var opts = $.parseJSON(data);
                $("#product").empty();
                $('#product').append('<option value="">Select Products</option>');
                $.each(opts, function(i, d) {
                    $('#product').append('<option value="' + d.id + '">' + d.product_name + '</option>');
                });
                $('#product').trigger('change');
                $('#product').trigger('chosen:updated');
            },
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#inventory .child_menu').show();
        $('#inventory').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.product-stock-entries').addClass('active_cc');
    });
</script>
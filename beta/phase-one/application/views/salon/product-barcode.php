<?php include('header.php');?>
<style>    
<?php if(isset($_GET['product']) && $_GET['product'] != ""){?>
#product_chosen .chosen-single{
    color: black !important;
    background-color: #607d8b38 !important;
}
#product_chosen .chosen-container-single .chosen-single span{
    color: #000 !important;
}
<?php } ?>
<?php if(isset($_GET['status']) && $_GET['status'] != ""){?>
#status_chosen .chosen-single{
    color: black !important;
    background-color: #607d8b38 !important;
}
#status_chosen .chosen-container-single .chosen-single span{
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
    table.dataTable{
        width: 100% !important;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Product Stock Ledger
                </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">                    
                    <div class="x_content">
                        <form id="make_form" name="make_form" method="get" enctype="multipart/form-data" data-parsley-validate>                                
                            <div class="row"> 
                                <div class="col-xs-2 form-group">
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
                                <div class="col-xs-2 form-group">
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
                                <div class="col-xs-2 form-group">
                                    <label for="fullname">Product Status</label>
                                    <select class="form-control choosen" id="status" name="status">
                                    <option value="">All Product Status</option>
                                    <option value="0" <?php if(isset($_GET['status']) && $_GET['status'] == '0'){?>selected<?php } ?>>Un-Used</option>
                                    <option value="1" <?php if(isset($_GET['status']) && $_GET['status'] == '1'){?>selected<?php } ?>>Used in Booking</option>
                                    <option value="5" <?php if(isset($_GET['status']) && $_GET['status'] == '5'){?>selected<?php } ?>>Internally Used</option>
                                    <!-- <option value="3" <?php if(isset($_GET['status']) && $_GET['status'] == '3'){?>selected<?php } ?>>Garbage</option> -->
                                    <option value="4" <?php if(isset($_GET['status']) && $_GET['status'] == '4'){?>selected<?php } ?>>Damaged</option>
                                    <option value="2" <?php if(isset($_GET['status']) && $_GET['status'] == '2'){?>selected<?php } ?>>Expired</option>
                                    </select>
                                </div>                     
                                <div class="col-xs-2 form-group">
                                    <label for="fullname">From Date</label>
                                    <input type="text" class="form-control custom_date" placeholder="From Service Date" name="from_date" id="from_date" value="<?php if(isset($_GET["from_date"]) && $_GET["from_date"] != "0" && $_GET["from_date"] != ""){ echo date('d-m-Y',strtotime($_GET['from_date'])); }?>">
                                </div>
                                <div class="col-xs-2 form-group">
                                    <label for="fullname">To Date</label>
                                    <input type="text" class="form-control custom_date" placeholder="To Service Date" name="to_date" id="to_date" value="<?php if(isset($_GET["to_date"]) && $_GET["to_date"] != "0" && $_GET["to_date"] != ""){ echo date('d-m-Y',strtotime($_GET['to_date'])); }?>">
                                </div>                                                  
                            </div>                                     
                            <div class="error" id="status_error_new_2"></div>                                       
                            <div class="row">
                                <div class="col-md-3  col-sm-3 col-xs-12">
                                    <button type="submit" id="submit_button" class="btn btn-success" style="margin-top:25px;">Search</button>
                                    <?php if(isset($_GET['status']) || isset($_GET['product']) || isset($_GET['from_date']) || isset($_GET['to_date'])){ ?>
                                    <a href="<?=base_url();?><?=$this->uri->segment(1);?>" class="btn btn-info" style="margin-top:25px;">Reset</a>
                                    <?php } ?>
                                </div>	
                            </div>	
                            <div class="clearfix"></div>
                        </form>
                    </div>  
                    <div class="x_content">
                    <?php $product_barcodes = $this->Salon_model->get_all_product_barcode();?>
                    <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Product</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Barcode Id</th>
                                        <th>Barcode</th>
                                        <th>Status</th>
                                        <th>Inward Date</th>
                                        <!-- <th>Mfg. Date</th>
                                        <th>Exp. Date</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>

            <br />
            <br />
            <br />

        </div>
    </div>
    <?php include('footer.php');?>
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
        var oldExportAction = function (self, e, dt, button, config) {
            if (button[0].className.indexOf('buttons-excel') >= 0) {
                if ($.fn.dataTable.ext.buttons.excelHtml5.available(dt, config)) {
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config);
                }
                else {
                    $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                }
            } else if (button[0].className.indexOf('buttons-print') >= 0) {
                $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
            }
        };
        var newExportAction = function (e, dt, button, config) {
            var self = this;
            var oldStart = dt.settings()[0]._iDisplayStart;
            dt.one('preXhr', function (e, s, data) {
                data.start = 0;
                data.length = 2147483647;
                dt.one('preDraw', function (e, settings) {
                    oldExportAction(self, e, dt, button, config);
                    dt.one('preXhr', function (e, s, data) {
                        settings._iDisplayStart = oldStart;
                        data.start = oldStart;
                    });
                    setTimeout(dt.ajax.reload, 0);
                    return false;
                });
            });
            dt.ajax.reload();
        };
        var table = $('#example').DataTable({
            "lengthChange": true, 
            "lengthMenu": [10, 25, 50, 100, 200],
            'searching': true,
            "processing": true,
            "serverSide": true,
            // "responsive": true,
            "cache": false,
            "order": [],
            "columnDefs": [
                { "orderable": false, "targets": "_all" }
            ],
            buttons:[
                {
                    extend: "excelHtml5",
                    messageBottom: '',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7],
                        modifier: {
                            search: 'applied',
                            order: 'applied'
                        },
                    },
                }
            ],
            dom: "Blfrtip",
            // scrollX: true, // Enable horizontal scrolling
            // scrollCollapse: true,
            "ajax":{
                "url" : "<?=base_url();?>salon/Ajax_controller/get_product_barcodes_ajx",
                "type": "POST",
                "data": function (d) {
                    d.status = '<?php echo isset($_GET['status']) ? $_GET['status'] : ''; ?>';
                    d.category = '<?php echo isset($_GET['category']) ? $_GET['category'] : ''; ?>';
                    d.product = '<?php echo isset($_GET['product']) ? $_GET['product'] : ''; ?>';
                    d.from_date = '<?php echo isset($_GET['from_date']) ? $_GET['from_date'] : ''; ?>';
                    d.to_date = '<?php echo isset($_GET['to_date']) ? $_GET['to_date'] : ''; ?>';
                    d.barcodes = '<?php echo isset($_GET['barcodes']) ? base64_decode($_GET['barcodes']) : ''; ?>';
                }				
            },
            "complete": function() {
                $('[data-toggle="tooltip"]').tooltip();			
            }, 
        });
        $('.navbar-nav.ml-auto .dropdown-menu').dropdown({
            container: '.navbar-nav.ml-auto'
        });
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
</script>
<script>
    $(document).ready(function() {
        $('#inventory .child_menu').show();
        $('#inventory').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.product-stock').addClass('active_cc');
    });
</script>
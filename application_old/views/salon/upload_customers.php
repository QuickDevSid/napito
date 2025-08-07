<?php include('header.php');?>
<style>    
    .loader_div {
        display: none;
        position: fixed;
        width: 100%;
        height: 100% !important;
        background: #00000042;
        z-index: 999;
        left: 0;
        top: 0;
    }
    .loader-new {
        position: fixed;
        top: 50%;
        left: 50%;
        z-index: 9999;
        --d: 22px;
        width: 4px;
        height: 4px;
        border-radius: 50%;
        color: #0056d0;
        box-shadow:
            calc(1*var(--d)) calc(0*var(--d)) 0 0,
            calc(0.707*var(--d)) calc(0.707*var(--d)) 0 1px,
            calc(0*var(--d)) calc(1*var(--d)) 0 2px,
            calc(-0.707*var(--d)) calc(0.707*var(--d)) 0 3px,
            calc(-1*var(--d)) calc(0*var(--d)) 0 4px,
            calc(-0.707*var(--d)) calc(-0.707*var(--d))0 5px,
            calc(0*var(--d)) calc(-1*var(--d)) 0 6px;
        animation: l27 1s infinite steps(8);
    }
    @keyframes l27 {
        100% {
            transform: rotate(1turn)
        }
    }
</style>
<?php $ids = []; if(isset($_GET['uploaded'])){ 
    $ids = !empty($this->session->userdata('ids')) ? $this->session->userdata('ids') : [];
    $total = isset($_GET['total']) ? base64_decode($_GET['total']) : 0;
    $valid = isset($_GET['valid']) ? base64_decode($_GET['valid']) : 0;
?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
            <h3>Customers Data Uploaded Successfully <br>
                <label>Total <?=$total;?> Entries uploaded and total <?=$valid;?> Customers are inserted into system.</label>
                <a href="<?=base_url();?>upload_customers" class="btn btn-primary">Upload New</a>
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="container">
                        <label>Duplicate Customers List <small>(These records are ignored by system as these are already exist into system)</small></label>
                        <table class="table table-striped responsive-utilities jambo_table"style="width: 100%;" id="example">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <?php if(isset($_GET['app_customer'])){ ?>
                                        <th>Login Status</th>
                                    <?php } ?>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Date of Birth</th>
                                    <th>Membership</th>
                                    <th>Custom Note</th>
                                    <th>Pending Amount</th>
                                    <th>Reward Balance</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table> 
                    </div> 
                </div>
            </div>
        </div>
    </div> 
</div>
<?php }else{ ?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
            <h3>Upload Customers Data</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="container">
                        <form method="post" name="master_form" id="master_form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <label>Select Branch <b class="require">*</b></label>
                                    <select class="form-select form-control chosen-select" name="branch_id" id="branch_id">
                                        <!-- <option value="">Select Branch</option> -->
                                        <?php 
                                        $salons = $this->Admin_model->get_all_salons($this->session->userdata('branch_id')); 
                                        if(!empty($salons)){foreach($salons as $row){
                                        ?>
                                        <option value="<?=$row->id;?>" <?php if($this->session->userdata('branch_id') == $row->id){ echo 'selected'; } ?>><?=$row->salon_name . ' -> ' . $row->branch_name; ?></option>
                                        <?php }} ?>
                                    </select>
                                    <div class="error" id="filter_gender_error"></div>
                                </div>
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <label>Upload File <b class="require">*</b> <small>(.csv Only)</small></label>
                                    <input type="file" class="form-control" name="file" id="file">
                                </div>
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <button style="margin-top: 30px;" type="submit" id="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form> 
                    </div> 
                </div>
            </div>
        </div>
    </div> 
</div>
<?php } ?>
<div class="loader_div">
    <div class="loader-new"></div>
</div>
<?php include('footer.php'); ?>
<script>
    $(document).ready(function () {     
        $('#master_form').validate({
            rules: {
                branch_id: {
                    required: true, 
                },
                file: {
                    required: true, 
                },
            },
            messages: {
                branch_id: {
                    required: "Please select branch!", 
                },
                file: {
                    required: "Please upload CSV file!", 
                },
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
            },
            submitHandler: function(form) { 
                if (confirm("Are you sure you want to insert these customers?")) { 
                    $('#submit').remove();
                    $('.loader_div').show();
                    form.submit();
                }
            }
        });
    });
    
    $(document).ready(function() {
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
            'responsive':true,
            "processing": true,
            "serverSide": true,
            "cache": false,
            "order": [],
            "columnDefs": [
                { "orderable": false, "targets": "_all" }
            ],
            // scrollX:300,
            buttons:[
                {
                    extend: "excelHtml5",
                    messageBottom: '',
                    filename: 'Duplicate-Customer-list',
                    exportOptions: {
                        <?php if(isset($_GET['app_customer'])){ ?>
                            columns: [0,1,2,3,4,5,6,7,9,10],
                        <?php }else{ ?>
                            columns: [0,1,2,3,4,5,6,8,9],
                        <?php } ?>
                        modifier: {
                            search: 'applied',
                            order: 'applied'
                        },
                    },
                }
            ],
            dom: "Blfrtip",
            scrollX: true,
            "ajax":{
                "url" : "<?=base_url();?>salon/Ajax_controller/get_saloon_customers_ajx",
                "type": "POST",
                "data": function (d) {
                    d.customer = '<?php echo isset($_GET['customer']) ? $_GET['customer'] : ''; ?>';
                    d.is_app_customers = '<?php echo isset($_GET['app_customer']) ? '1' : ''; ?>';
                    d.is_shop_customers = '<?php echo isset($_GET['shop_customer']) ? '1' : ''; ?>';
                    d.ids = '<?=json_encode($ids); ?>';
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
</script>
<script>
    $(document).ready(function() {
        $('#reports .child_menu').show();
        $('#reports').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.customer-list').addClass('active_cc');
    });
</script>
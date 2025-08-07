<?php include('header.php'); ?>
<style type="text/css">
    .form-control-option {
        height: 35px;
        width: 590px;
        float: left;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Supplier Management
                </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-5">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <form method="post" name="employee_form" id="employee_form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Supplier Name <b class="require">*</b></label>
                                        <input type="text" placeholder="Enter Supplier Name" class="form-control" name="name" id="name" value="<?php if(!empty($single)){ echo $single->name; }?>">
                                        <input autocomplete="off" class="form-control" type="hidden" name="id" id="id" value="<?php if (!empty($single)) {echo $single->id;} ?>">
                                        <span class="error status_error"></span>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Contact Person Name <b class="require">*</b></label>
                                        <input type="text" placeholder="Enter Contact Person Name" class="form-control" name="person_name" id="person_name" value="<?php if(!empty($single)){ echo $single->person_name; }?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                        <label>Whatsapp No. <b class="require">*</b></label>
                                        <input autocomplete="off" class="form-control" type="text" name="mobile_no" id="mobile_no" value="<?php if (!empty($single)) { echo $single->mobile_no;} ?>" placeholder="Enter Mobile No.">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Email</label>
                                        <input autocomplete="off" class="form-control" type="text" name="email" id="email" value="<?php if (!empty($single)) {echo $single->email;} ?>" placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <label>Address <b class="require">*</b></label>
                                        <textarea autocomplete="off" class="form-control" name="address" id="address"><?php if (!empty($single)) {echo $single->address;} ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12 " style="margin-top: 40px">
                                    <button type="submit" id="submit_button" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <table  id="example" class="table table-striped responsive-utilities jambo_table">
                                <thead>
                                    <tr>
                                        <th>Sr.no</th>
                                        <th>Name</th>
                                        <th>Contact Person</th>
                                        <th>Whatsapp No.</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($supplier_list)) {
                                        $i = 1;
                                        foreach ($supplier_list as $product_master_list_result) {
                                    ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $product_master_list_result->name ?></td>
                                                <td><?= $product_master_list_result->person_name ?></td>
                                                <td><?= $product_master_list_result->mobile_no ?></td>
                                                <td><?= $product_master_list_result->email != "" ? $product_master_list_result->email : ''; ?></td>
                                                <td><?= $product_master_list_result->address ?></td>
                                                <td>
                                                    <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?= base_url() ?>delete/<?= $product_master_list_result->id ?>/tbl_supplier"><i class="fa-solid fa-trash"></i></a>
                                                    <a title="Edit" class="btn btn-success" href="<?= base_url() ?>supplier-management/<?= $product_master_list_result->id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
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
        $('#example').DataTable({ 
            dom: 'Blfrtip',
            responsive: false,
            scrollX:300,
            lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                    
            buttons: [
                            
                {
                    extend: 'excel',
                    filename: 'product-list',
                    exportOptions: {
                        columns: [0,1,2,3,4,5] 
                    }
                }
            ], 
        });
        $('#employee_form').validate({
            ignore: "",
            rules: {
                name: 'required',
                address: 'required',
                person_name: 'required',              
                email: {
                    // required: true,
                    email: true,
                },
                mobile_no: {
                    required: true,
                    number: true,
                    maxlength: 10,
                    minlength: 10,
                },
            },
            messages: {
                name: "Please enter supplier name!",
                address: "Please enter address !",
                email: {
                    // required: "Please enter email !",
                    email: "Please enter valid email !",
                },
                mobile_no: {
                    required: "Please enter whatsapp mobile no!",
                    number: "Only number allowed!",
                    maxlength: "Max 10 digits allowed!",
                    minlength: "Min 10 digits allowed!",
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
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".chosen-select").chosen({             
        });
    });
</script>
<script>
     $("#name").keyup(function() {
        if($("#name").val() != ""){
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_unique_supplier",
                data: {
                    'name': $("#name").val(), 'id' : '<?php echo $id; ?>',
                },
                success: function(data) {
                    if (data == "0") {
                        $(".status_error").html("");
                        $("#submit_button").attr('disabled', false);
                    } else {
                        $(".status_error").html("Supplier Name is already added.");
                        $("#submit_button").attr('disabled', true);
                    }
                },
            });
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('#inventory .child_menu').show();
        $('#inventory').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.product-suppliers').addClass('active_cc');
    });
</script>

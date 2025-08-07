<?php include('header.php'); ?>
<style type="text/css">

</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Product Master
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


            <div class="x_panel">
                <div class="x_content">
                    <div class="container">
                        <form method="post" name="master_form" id="master_form" enctype="multipart/form-data">

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Product Category</label>
                                    <input type="text" class="form-control" name="product_category"
                                        id="product_category"
                                        value="<?php if (!empty($single)) {
                                            echo $single->product_category;
                                        } ?>"
                                        placeholder="Enter product category">

                                    <div class="error" id="product_category_error"></div>
                                    <input type="hidden" class="form-control" name="id" id="id"
                                        value="<?php if (!empty($single)) {
                                            echo $single->id;
                                        } ?>">
                                </div>
                                 </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Product Name <b class="require">*</b></label>
                                    <input type="text" class="form-control" name="product_name" id="product_name"
                                        value="<?php if (!empty($single)) {
                                            echo $single->product_name;
                                        } ?>"
                                        placeholder="Enter product name">

                                  
                                </div>
                                 </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Low Stock <b class="require">*</b></label>
                                    <input type="text" class="form-control" name="low_stock" id="low_stock"
                                        value="<?php if (!empty($single)) {
                                            echo $single->low_stock;
                                        } ?>"
                                        placeholder="Enter low stock">

                                    <div class="error" id="low_stock_error"></div>
                                </div>
                                 </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>High stock <b class="require">*</b></label>
                                    <input type="text" class="form-control" name="high_stock" id="high_stock"
                                        value="<?php if (!empty($single)) {
                                            echo $single->high_stock;
                                        } ?>"
                                        placeholder="Enter high stock">

                                    
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">

                                <div class="form-group">
                                    <label>HSN Code <b class="require">*</b></label>
                                    <input type="text" class="form-control" name="hsn_code" id="hsn_code"
                                        value="<?php if (!empty($single)) {
                                            echo $single->hsn_code;
                                        } ?>"
                                        placeholder="Enter hsn code">

                                   
                                </div>
                                 </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Manufacturing Date<b class="require">*</b></label>
                                    <input type="date" class="form-control" name="mfg_date" id="mfg_date"
                                        value="<?php if (!empty($single)) {
                                            echo $single->mfg_date;
                                        } ?>"
                                        placeholder="Enter manufacturing date">

                                  
                                </div>
                                 </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Expiry Date <b class="require">*</b></label>
                                    <input type="date" class="form-control" name="expiry_date" id="expiry_date"
                                        value="<?php if (!empty($single)) {
                                            echo $single->expiry_date;
                                        } ?>"
                                        placeholder="Enter expiry date">

                                    
                                </div>
                                 </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                                <div class="form-group" style="margin-top: 35PX;margin-left: 250px;">
                                    <button type="submit" id="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>




            </div>



            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">

                        <!-- <div class="clearfix"></div> -->
                    </div>
                    <div class="x_content">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Product Category</th>
                                    <th>Product Name</th>
                                    <th>Low Stock</th>
                                    <th>High Stock</th>
                                    <th>HSN code</th>
                                    <th>Manufacturing Date</th>
                                    <th>Expiry Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($product_master_list)) {
                                    $i = 1;
                                    foreach ($product_master_list as $product_master_list_result) {
                                        ?>
                                        <tr>
                                            <th scope="row">
                                                <?= $i++ ?>
                                            </th>
                                            <td><?= $product_master_list_result->product_category ?></td>
                                            <td><?= $product_master_list_result->product_name ?></td>
                                            <td><?= $product_master_list_result->low_stock ?></td>
                                            <td><?= $product_master_list_result->high_stock ?></td>
                                            <td><?= $product_master_list_result->hsn_code ?></td>
                                            <td><?= $product_master_list_result->mfg_date ?></td>
                                            <td><?= $product_master_list_result->expiry_date ?></td>
                                            <td>
                                                <?php if ($product_master_list_result->status == "1") { ?>
                                                    <a title="Active"
                                                        onclick="return confirm('Are you sure to inactivate this record?');"
                                                        class="btn btn-light"
                                                        href="<?= base_url() ?>inactive/<?= $product_master_list_result->id ?>/tbl_product_master"><i
                                                            style="color: blue; font-size: 25px;"
                                                            class="fa-solid fa-toggle-on"></i></a>
                                                <?php } else { ?>

                                                    <a title="Inctive" class="btn btn-light"
                                                        onclick="return confirm('Are you sure to activate this record?');"
                                                        href="<?= base_url() ?>active/<?= $product_master_list_result->id ?>/tbl_product_master"><i
                                                            style="font-size: 25px;" class="fa-solid fa-toggle-off"></i></a>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a title="Delete" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure to delete this record?');"
                                                    href="<?= base_url() ?>delete/<?= $product_master_list_result->id ?>/tbl_product_master"><i
                                                        class="fa-solid fa-trash"></i></a>

                                                <a title="Edit" class="btn btn-primary"
                                                    href="<?= base_url() ?>product-master/<?= $product_master_list_result->id ?>"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
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
<?php include('footer.php');
$id = '0';
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>


<script>
    $(document).ready(function () {
        $('#master_form').validate({
            rules: {
                product_category: 'required',
                product_name: 'required',
                low_stock: 'required',
                high_stock: 'required',
                hsn_code: 'required',
                mfg_date: 'required',
                expiry_date: 'required',
            },
            messages: {
                product_category: "Please enter product category",
                product_name: "Please enter product name",
                low_stock: "Please enter low stock",
                high_stock: "Please enter high stock",
                hsn_code: "Please enter hsn code",
                mfg_date: "Please enter manufacturing date",
                expiry_date: "Please enter expiry date",
            },
        });
    });
    $("#services_name").keyup(function () {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/Ajax_controller/get_unique_services_name",
            data: { 'services_name': $("#services_name").val(), 'id': '<?= $id ?>' },
            success: function (data) {
                console.log(data);
                if (data == "0") {
                    $("#services_name_error").html('');
                    $("#submit").show();
                } else {
                    $("#services_name_error").html('This services is already added');
                    $("#submit").hide();
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });	 
</script>
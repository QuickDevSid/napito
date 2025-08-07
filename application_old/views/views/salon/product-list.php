<?php include('header.php');?>

<style>
     .popup {
    width:100%;
    height:100%;
    display:none;
    position:fixed;
    top:0px;
    left:0px;
    background:rgba(0,0,0,0.75);
    z-index: 999999999999;
}
 
/* Inner */
.popup-inner {
    max-width:700px;
    width: 45%;
    padding:40px;
    position:absolute;
    top:20%;
    left:50%;
    -webkit-transform:translate(-50%, -50%);
    transform:translate(-50%, -50%);
    box-shadow:0px 2px 6px rgba(0,0,0,1);
    border-radius:3px;
    background:#fff;
}


 
/* Close Button */
.popup-close {
    width:30px;
    height:30px;
    padding-top:4px;
    display:inline-block;
    position:absolute;
    top:0px;
    right:0px;
    transition:ease 0.25s all;
    -webkit-transform:translate(50%, -50%);
    transform:translate(50%, -50%);
    border-radius:1000px;
    background:rgba(0,0,0,0.8);
    font-family:Arial, Sans-Serif;
    font-size:20px;
    text-align:center;
    line-height:100%;
    color:#fff;
}
 
.popup-close:hover {
    -webkit-transform:translate(50%, -50%) rotate(180deg);
    transform:translate(50%, -50%) rotate(180deg);
    background:rgba(0,0,0,1);
    text-decoration:none;
}



.popup-scroll{
  overflow-y: scroll;
  max-height: 300px;
  padding:0 1em 0 0;
}
/* .popup-scroll::-webkit-scrollbar {background-color:#EEE;width:10px;}
.popup-scroll::-webkit-scrollbar-thumb {
	border:1px #EEE solid;border-radius:2px;background:#777;
	-webkit-box-shadow: 0 0 8px #555 inset;box-shadow: 0 0 8px #555 inset;
	-webkit-transition: all .3s ease-out;transition: all .3s ease-out;
	}
.popup-scroll::-webkit-scrollbar-track {-webkit-box-shadow: 0 0 2px #ccc;box-shadow: 0 0 2px #ccc;} */
</style>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Product List
                </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table  id="example" class="table table-striped responsive-utilities jambo_table">
                                            <thead>
                                                <tr>
                                                    <th>Sr.no</th>
                                                    <th>Product Name</th>
                                                    <th>Product Category</th>
                                                    <th>Product Unit</th>
                                                    <th>Low Stock</th>
                                                    <th>High Stock</th>
                                                    <th>HSN code</th>
                                                    <th>Manufacturing Date</th>
                                                    <th>Expiry Date</th>
                                                    <th>Product Discount</th>
                                                    <th>Incentive</th>
                                                    <th>Product Selling Price</th>
                                                    <th>Stock Alert</th>
                                                    <th style="display: none;"></th>
                                                    <th style="display: none;"></th>
                                                    <th>Product Image</th>
                                                    <th>Product Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($product_master_list)) {
                                                    $i = 1;
                                                    foreach ($product_master_list as $product_master_list_result) {
                                                ?>
                                                        <tr>
                                                            <td><?= $i++ ?></td>
                                                            <td><?= $product_master_list_result->product_name ?></td>
                                                            <td><?= $product_master_list_result->productcategory ?></td>
                                                            <td><?= $product_master_list_result->productunit ?></td>
                                                            <td><?= $product_master_list_result->low_stock ?></td>
                                                            <td><?= $product_master_list_result->high_stock ?></td>
                                                            <td><?= $product_master_list_result->hsn_code ?></td>
                                                            <td><?= date("d/m/Y", strtotime($product_master_list_result->mfg_date)) ?></td>
                                                            <td><?= date("d/m/Y", strtotime($product_master_list_result->expiry_date)) ?></td>
                                                            <td><?= $product_master_list_result->discount ?></td>
                                                            <td><?= $product_master_list_result->incentive ?></td>
                                                            <td><?= $product_master_list_result->selling_price ?></td>
                                                            <td><?= $product_master_list_result->low_stock_alert ?></td>
                                                            <td style="display: none;"><?= $product_master_list_result->product_photo ?></td>
                                                            <td style="display: none;"><?= $product_master_list_result->description ?></td>
                                                            <td>
                                                                <a class="btn btn-primary" target="_blank" href="<?= base_url(); ?>admin_assets/images/product_image/<?= $product_master_list_result->product_photo ?>">View</a>
                                                            </td>
                                                            <td><a class="btn btn-primary" data-popup-open="popup-1" onclick="view_description('<?php echo  $product_master_list_result->description; ?>')">View</a></td>
                                                            <td>
                                                                <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?= base_url() ?>delete/<?= $product_master_list_result->id ?>/tbl_product"><i class="fa-solid fa-trash"></i></a>

                                                                <a title="Edit" class="btn btn-success" href="<?= base_url() ?>add-product/<?= $product_master_list_result->id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
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
        <div class="popup" data-popup="popup-1">
                <div class="popup-inner">
                    <h3>Description</h3>
                 <div class="popup-scroll">
                  <div class="descrip"></div>
                </div>
                    <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
                </div>
            </div>
    </div>
    <?php include('footer.php');?>




<script>
    $('#example').DataTable({ 
        dom: 'Blfrtip',
        responsive: true,
        scrollX:300,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                
         buttons: [
                        
            {
                extend: 'excel',
                filename: 'product-list',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15] 
                }
            }
        ], 
    });
</script>
<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.product-setup').addClass('active_cc');
    });

    $(function() {
    //----- OPEN
    $('[data-popup-open]').on('click', function(e)  {
        var targeted_popup_class = jQuery(this).attr('data-popup-open');
        $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
 
        e.preventDefault();
    });
 
    //----- CLOSE
    $('[data-popup-close]').on('click', function(e)  {
        var targeted_popup_class = jQuery(this).attr('data-popup-close');
        $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
 
        e.preventDefault();
    });
});

function view_description(des){
$('.descrip').text(des);
}
</script>
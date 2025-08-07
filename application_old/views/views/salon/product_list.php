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
.popup-scroll::-webkit-scrollbar-track {-webkit-box-shadow: 0 0 2px #ccc;box-shadow: 0 0 2px #ccc;}
    table.dataTable{
        width: 100% !important;
    }
    td a.btn.btn-warning,td a.btn-success, td a.btn.btn-info,td a.btn.btn-danger{
    width: 90px !important;
} */
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
<!-- 
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  
                </div>
            </div> -->
        </div>
        <!-- <div class="clearfix"></div> -->

        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <button id="toggle-drag" class="btn btn-primary">Enable Order Update</button>
                            <a class="btn btn-primary" href="<?=base_url();?>add-product">Add Product</a>
                            <label class="error" id="error-drag"></label>
                        </div>
                        <div class="x_content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table  id="example" class="table table-striped responsive-utilities jambo_table">
                                            <thead>
                                                <tr>
                                                    <th style="width:8%;">Sr. No.</th>
                                                    <th style="width:10%;" class="handle_order hidden">Update Order</th>
                                                    <th style="width:10%;">View Order</th>
                                                    <th>Product Name</th>
                                                    <th>Category</th>
                                                    <th>Sub Category</th>
                                                    <th>Stock<br><small>(As of <?=date('d M, Y');?>)</small></th>
                                                    <!-- <th>Product Unit</th> -->
                                                    <th>Low Stock</th>
                                                    <th>High Stock</th>
                                                    <th>HSN code</th>
                                                    <!-- <th>Manufacturing Date</th>
                                                    <th>Expiry Date</th> -->
                                                    <!-- <th>Product Discount</th>
                                                    <th>Incentive</th> -->
                                                    <th>Product Price</th>
                                                    <th>Stock Alert</th>
                                                    <th>Product Image</th>
                                                    <th>Product Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($product_master_list)) {
                                                    $count_product = 1;
                                                    foreach ($product_master_list as $product_master_list_result) {
                                                        $product_sub_category = $this->Admin_model->get_sub_category_details($product_master_list_result->product_subcategory);
                                                        if($product_master_list_result->current_stock <= $product_master_list_result->low_stock){
                                                            if($product_master_list_result->low_stock_alert == '1'){
                                                                $style = '#ffbfbf';
                                                            }else{
                                                                $style = '';
                                                            }
                                                        }elseif($product_master_list_result->current_stock >= $product_master_list_result->high_stock){
                                                            $style = '#96d1967a';
                                                        }else{                                                            
                                                            $style = '';
                                                        }
                                                ?>
                                                        <tr style="background-color:<?=$style;?>" class="draggable-rows" data-id="<?=$product_master_list_result->id;?>" data-order="<?=$product_master_list_result->order;?>">
                                                            <td style="width:8%;" class="sr-no" scope="row"><?=$count_product++?></td>
                                                            <td style="width:10%;cursor:grab;" class="handle handle_order hidden order">
                                                                <i class="fas fa-grip-vertical"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </td>
                                                            <td style="width:10%;" class="sr-no">
                                                                <?= $product_master_list_result->order != "" ? (int)$product_master_list_result->order : 0; ?>
                                                            </td>
                                                            <td><?= $product_master_list_result->product_name ?></td>
                                                            <td><?= $product_master_list_result->productcategory ?></td>
                                                            <td><?=!empty($product_sub_category) ? $product_sub_category->product_sub_category : '-'; ?></td>
                                                            <td><?= $product_master_list_result->current_stock ?></td>
                                                            <!-- <td><?= $product_master_list_result->productunit ?></td> -->
                                                            <td><?= $product_master_list_result->low_stock ?></td>
                                                            <td><?= $product_master_list_result->high_stock ?></td>
                                                            <td><?= $product_master_list_result->hsn_code ?></td>
                                                            <!-- <td><?php if($product_master_list_result->mfg_date != "0000-00-00"){ echo date("d/m/Y", strtotime($product_master_list_result->mfg_date));}?></td>
                                                            <td><?php if($product_master_list_result->expiry_date != "0000-00-00"){ echo date("d/m/Y", strtotime($product_master_list_result->expiry_date));}?></td> -->
                                                            <!-- <td> -->
                                                                <?php 
                                                                    // if($product_master_list_result->discount_in == '0'){
                                                                    //     echo $product_master_list_result->discount . '%';
                                                                    // }elseif($product_master_list_result->discount_in == '1'){
                                                                    //     echo $product_master_list_result->discount . '%';
                                                                    // }else{
                                                                    //     echo 'None';
                                                                    // }
                                                                ?>
                                                            <!-- </td> -->
                                                            <!-- <td><?= $product_master_list_result->incentive ?></td> -->
                                                            <td><?= $product_master_list_result->selling_price ?></td>
                                                            <td><?= $product_master_list_result->low_stock_alert == '1' ? 'Yes' : ($product_master_list_result->low_stock_alert == '0' ? 'No' : '-'); ?></td>
                                                            <td>
                                                                <?php 
                                                                    if ($product_master_list_result->product_photo != "") {
                                                                        $images = explode(',',$product_master_list_result->product_photo);
                                                                        for($i=0;$i<count($images);$i++){
                                                                ?>
                                                                <a style="color: blue;float: right; text-decoration:underline;margin-left: 8px;" target="_blank" href="<?= base_url(); ?>admin_assets/images/product_image/<?= $images[$i]; ?>">View</a>
                                                                <?php }} ?>
                                                            </td>
                                                            <td><a class="btn btn-primary" data-popup-open="popup-1" onclick="view_description('<?php echo  $product_master_list_result->description; ?>')">View</a></td>
                                                            <td>
                                                                <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?= base_url() ?>delete/<?= $product_master_list_result->id ?>/tbl_product"><i class="fa-solid fa-trash"></i></a>

                                                                <a title="Edit" class="btn btn-success" href="<?=base_url()?>add-product?edit=<?=$product_master_list_result->id?>&use_this=1"><i class="fa-solid fa-pen-to-square"></i></a>
                                                                <a title="Stock History" class="btn btn-info" href="<?=base_url()?>product-stock-list?product=<?=$product_master_list_result->id?>&category=<?=$product_master_list_result->product_category?>"><i class="fa-solid fa-history"></i></a>
                                                                <a title="Add Stock" class="btn btn-success" href="<?=base_url()?>add-product-stock?product=<?=$product_master_list_result->id?>&category=<?=$product_master_list_result->product_category?>"><i class="fa-solid fa-box"></i></a>
                                                                <a title="Product Barcodes" class="btn btn-warning" href="<?=base_url()?>product-barcode?product=<?=$product_master_list_result->id?>&category=<?=$product_master_list_result->product_category?>"><i class="fa-solid fa-barcode"></i></a>
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
    $(document).ready(function () {
        let dragEnabled = false;
              
        var table = $('#example').DataTable({ 
            dom: 'Blfrtip',
            responsive: true,
            lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],            
            buttons: [
                {
                    extend: 'excel',
                    filename: 'product-list',
                    exportOptions: {
                        columns: [0,2,3,4,5,6,7,8,9,10,11] 
                    }
                },
            ], 
        });

        $('#toggle-drag').click(function () {
            $('#error-drag').text('');
            var pageInfo = table.page.info();
            if (pageInfo.pages > 1) {
                $('#error-drag').text('Please load all entries on one page to enable order update.');
                return;
            }

            dragEnabled = !dragEnabled;

            if (dragEnabled) {
                $(this).text('Disable Order Update');
                $('.handle_order').removeClass('hidden');
                enableDragAndDrop();
            } else {
                $(this).text('Enable Order Update');
                $('.handle_order').addClass('hidden');
                disableDragAndDrop();
            }
        });

        function enableDragAndDrop() {
            $('#error-drag').text('');
            $('#example tbody').sortable({
                handle: '.handle',
                update: function(event, ui) {
                    var order = [];
                    $('.draggable-rows').each(function(index, element) {
                        var id = $(this).data('id');
                        $(this).data('order', index + 1);
                        
                        if (id) {
                            order.push({
                                id: id,
                                order: index + 1
                            });
                        }
                    });

                    $.ajax({
                        url: '<?=base_url();?>salon/Ajax_controller/update_product_order',
                        method: 'POST',
                        data: { order: order, category: '<?php echo $this->uri->segment(2); ?>' },
                        dataType: 'json',
                        success: function(response) {
                            console.log('Order updated successfully', response);

                            $('.draggable-rows').each(function(index) {
                                var newOrder = index + 1;
                                
                                // $(this).find('.order').html('<i class="fas fa-grip-vertical"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+newOrder);
                                $(this).find('.order').html('<i class="fas fa-grip-vertical"></i>');
                                $(this).find('.sr-no').text(newOrder);
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log('An error occurred while updating the order', error);
                        }
                    });
                }
            }).disableSelection();
        }
        function disableDragAndDrop() {
            $('#error-drag').text('');
            $("#example tbody").sortable("destroy");
        }
    });
</script>
<script>
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
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.product-setup').addClass('active_cc');
    });
</script>
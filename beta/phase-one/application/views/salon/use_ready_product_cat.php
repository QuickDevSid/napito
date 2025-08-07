<?php include('header.php');?>
<style>
    .set_price_btn{
        width: 100px;
        height: 30px;
        background-color: black;
        color: white;
        border-radius: 5px;
    } 
    .popup {
		width:100%;
		height:100%;
		display:none;
		position:fixed;
		top:0px;
		left:0px;
		background:rgba(0,0,0,0.75);
		z-index: 9;
	}
	.left_col{  
		z-index: 9 !important; 
	} 
/* Inner */
.popup-inner {
    max-width:700px;
    width:30%;
    padding:40px;
    position:absolute;
    top:30%;
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
.popup-scroll::-webkit-scrollbar {background-color:#EEE;width:10px;}
.popup-scroll::-webkit-scrollbar-thumb {
	border:1px #EEE solid;border-radius:2px;background:#777;
	-webkit-box-shadow: 0 0 8px #555 inset;box-shadow: 0 0 8px #555 inset;
	-webkit-transition: all .3s ease-out;transition: all .3s ease-out;
	}
.popup-scroll::-webkit-scrollbar-track {-webkit-box-shadow: 0 0 2px #ccc;box-shadow: 0 0 2px #ccc;}

</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Product List</h3>
                <a class="service-setup active_cc">
                    <div style="font-size: 20px;"><?php if(!empty($product_category)){ echo $product_category->product_category;}?> 
                        <span style="font-size: 17px;"> 
                            <i class="fa-solid fa-arrow-right"></i> 
                        <span>
                        <?php if(!empty($product_sub_category)){ echo $product_sub_category->product_sub_category;}?> 
                    </div>
                </a>
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
                        <table id="example" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr class="headings">
                                    <th>Sr. No.</th>
                                    <th>Product Name</th>
                                    <th>Set Product Details</th>
                                </tr>
                            </thead> 
                            <tbody>
                                <?php 
									$added_products = array();
									if(!empty($added_product)){
										foreach($added_product as $added_product_result){
											$added_products[] = $added_product_result->product_id;
										}
									}
									if(!empty($product_list)){
										$i=1;
                                        foreach($product_list as $product_list_result){
                                ?>
                                <tr>
                                    <td scope="row"><?=$i++?></td>
                                    <td><?=$product_list_result->product_name?></td>
                                    <td>
                                        <?php if(!in_array($product_list_result->id,$added_products)){?>
                                        <a href="<?=base_url();?>add-product?id=<?=$product_list_result->id;?>&use_this=1" class="btn btn-primary">Set Price</a>
                                       <?php }else{?>
                                        <p>Product Added</p>
                                        <?php }?>
                                     </td>
                                </tr>
                            <?php }}?>

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

<div class="popup" data-popup="popup-1">
    <div class="popup-inner">
    <h3>Set Price & Products</h3>
       <div class="popup-scroll"><p></p></div>
        <form method="post" name="price_form" id="price_form" enctype="multipart/form-data" accept-charset="UTF-8">
            <div class="form-group col-md-12 col-sm-6 col-xs-12">
                <label>Add Service Price<b class="require">*</b></label>
                <input type="text" class="form-control" name="final_price" id="final_price" placeholder="Enter Service Price">
            </div>
            <div class="form-group col-md-12 col-sm-6 col-xs-12">
                <label>Select Products</label>
                <select class="form-select form-control chosen-select" name="product[]" id="product" multiple> 
                <option value="">Select product</option>
                    <!-- <?php if (!empty($product_master_list)) {
                        foreach ($product_master_list as $sup_category_result) { ?>
                        <option value="<?= $sup_category_result->id ?>"><?= $sup_category_result->product_name ?></option>
                    <?php }
                    } ?> -->
                </select>
            </div>
                                    <input type="hidden" name="sup_category"       id="sup_category">
                                    <input type="hidden" name="default_status"        id="default_status">
                                    <input type="hidden" name="sub_category"          id="sub_category"  >
                                    <input type="hidden" name="service_name"          id="service_name"  >
                                    <input type="hidden" name="service_name_marathi"  id="service_name_marathi">
                                    <input type="hidden" name="category_image"        id="category_image" >
                                    <input type="hidden" name="service_duration"      id="service_duration">
                                    <input type="hidden" name="discount_in"           id="discount_in">
                                    <input type="hidden" name="discount_type"         id="discount_type">
                                    <input type="hidden" name="min"                   id="min">
                                    <input type="hidden" name="max"                   id="max">
                                    <input type="hidden" name="service_discount"      id="service_discount">
                                    <input type="hidden" name="reward_point"          id="reward_point">
                                    <input type="hidden" name="reminder_duration"     id="reminder_duration">
                                    <input type="hidden" name="service_description"   id="service_description" >
                                    <input type="hidden" name="service_pkey"   id="service_pkey" >
            <div class="form-group col-md-12 col-sm-6 col-xs-12">
                <button style="margin-top: 15px;" type="submit"  id="set_price" name="set_price" value="set_price" class="btn btn-primary">Submit</button>
            </div>
        </form>  
        <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
    </div>
</div>
    <?php include('footer.php');?>


<script>
$('#example').DataTable({ 
dom: 'Blfrtip',
responsive: false,
lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
 
    buttons: [
       
        {
            extend: 'excel',
            filename: 'ready-services',
            exportOptions: {
                columns: [0,1,2,3,4] 
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

function get_service_detail(service_id){
    $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_service_details_for_price_set_ajax",
            data: {
                'service_id': service_id,
            },
            success: function(data) {
                // $("#product").append('<option value="">Select product</option>');
            var parsedData = JSON.parse(data);
            $("#product").trigger("chosen:updated");
              $("#final_price").val(parsedData.final_price); 
              $("#service_pkey").val(service_id);
              var product_data = <?php echo json_encode($product_master_list) ?>;
              var p_length =product_data.length;
              for(var i=0;i<p_length;i++){
                if(product_data[i].product_category == parsedData.category){
                   $("#product").append('<option value="'+product_data[i].id+'">'+product_data[i].product_name+'</option>');
                }
              }

            }
        });
}
</script>
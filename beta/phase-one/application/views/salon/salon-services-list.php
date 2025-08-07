<?php include('header.php'); ?>
<style type="text/css">
    .error {
        font-weight: bold;
    }

    .fade.in {
        display: block !important;
    }
.btn-success:hover,
.btn-success:focus,
.btn-success:active,
.btn-success.active,
.open .dropdown-toggle.btn-success {
    background-color: #1ABB9C !important;
    border-color: #1ABB9C !important;
    color: #FFFFFF !important;
}
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
    top:35%;
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
    cursor: pointer;
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
        <div class="clearfix"></div>
        <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title" style="float: left;">
                                <h3>Service List</h3>
                            </div>
                            <div style="float: right;">
                            <a  class="service-setup" href="<?= base_url(); ?>add-salon-services"><div class="btn btn-dark">Back</div></a>
                            </div>
                            <div class="x_content">
                                <?php if (!empty($salon_services_list)) {
                                    $j = 0;
                                    $m = 0;
                                    $i = 1;
                                    $k = 1;
                                    foreach ($salon_services_list as $services_result) {
                                        $service_products = $this->Salon_model->get_selected_service_products($services_result->product);
                                       ?>
                                        <div class="col-md-6">
                                            <div class="service_card_box">
                                                <div class="dropdown card-btn-btn">
                                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <span class="fas fa-ellipsis-v"></span>
                                                    </button>
                                                    <ul class="dropdown-menu card-menu" aria-labelledby="dropdownMenu1">
                                                        <li>
                                                         <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$services_result->id?>/tbl_salon_emp_service"><i class="fa-solid fa-trash"></i></a>    

                                                        </li>
                                                        <li>
                                                        <a title="Edit" class="btn btn-success" href="<?=base_url()?>add-salon-services/<?=$services_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a> 

                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="service-img-box">
                                                <img style="border-radius: 50%;margin-left: -20px; width: 100%;height: 100%;" src="<?= base_url(); ?>admin_assets/images/service_image/<?php echo $services_result->category_image; ?>">
                                            </div>

                                                <div class="service-info-div">
                                                    <h4><?= $services_result->service_name ?></h4>
                                                    <p><span><?=$services_result->sup_category?>|<?=$services_result->sup_category_marathi?></span></p>
                                                    <p><?= $services_result->subcategory ?>|<?= $services_result->sub_category_marathi ?></p>
                                                    <p><i class="fa fa-clock-o" aria-hidden="true"></i> <?= $services_result->service_duration ?> min</p>
                                                    <p><span>Rs: <?= $services_result->final_price ?></span></p>
                                                </div>
                                            </div>
                                            <div class="service-card-footer">
                                                <div>
                                                    <p class="services_footer_count"><?= $services_result->reward_point ?></p>
                                                    <p> Reward</p>
                                                </div>
                                                <div class="product-modal-link" data-popup-open="popup-<?=$services_result->id?>"  onclick="view_description('<?=$services_result->id?>')">
                                                <?php if (!empty($service_products)) {
                                                    foreach ($service_products as $service_products_result) {
                                                        $j++;
                                                    }
                                                } ?>
                                                    <p class="services_footer_count"><?=$j?></p>
                                                    <p> Product</p>
                                                </div>
                                            </div>
                                        </div>



                                      
  
                                        <div class="popup" data-popup="popup-<?=$services_result->id?>">
                                            <div class="popup-inner">
                                                <h3>Products</h3>
                                                <div class="popup-scroll">
                                                    <div class="as-service-box">
                                                        <div class="service-img-box" style="background-image:url(<?= base_url('admin_assets/images/service_image/' . $services_result->category_image) ?>)"></div>
                                                        <div>
                                                            <h4><?= $services_result->service_name ?></h4>
                                                            <p><span><?=$services_result->sup_category?>|<?=$services_result->sup_category_marathi?></span></p>
                                                            <p><?= $services_result->subcategory ?>|<?= $services_result->sub_category_marathi ?></p>
                                                            <p><i class="fa fa-clock-o" aria-hidden="true"></i> <?= $services_result->service_duration ?> min</p>
                                                            <p><span>Rs: <?= $services_result->final_price ?></span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="modal-emp-box">
                                                    <?php if (!empty($service_products)) {
                                                        foreach ($service_products as $service_products_result) {?>
                                                            <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px; ">
                                                                <div class="emp-img-box" style="background-image:url(<?= base_url('admin_assets/images/product_image/' . $service_products_result->product_photo) ?>)"></div> 
                                                                <span><?= $service_products_result->product_name ?></span>
                                                            </div>    
                                                    <?php }}?>
                                                </div>
                                                <span class="popup-close" data-popup-close="popup-<?=$services_result->id?>" onclick="view_description('<?=$services_result->id?>')">x</span>
                                            </div>
                                        </div>


                                      
                                <?php $k++; $m=0;$j=0;}}else{?>
                                    <div class="col-md-12" style="font-size: 25px;">
                                       <img src="<?= base_url() ?>admin_assets/images/no_data/no_service.jpg">
                                    </div>
                                <?php }?>
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


function view_description(service_id){
    $('[data-popup-open]').on('click', function(e)  {
        var service_id = jQuery(this).attr('data-popup-open');
        $('[data-popup="' + service_id + '"]').fadeIn(350);
 
        e.preventDefault();
    });
 
    //----- CLOSE
    $('[data-popup-close]').on('click', function(e)  {
        var service_id = jQuery(this).attr('data-popup-close');
        $('[data-popup="' + service_id + '"]').fadeOut(350);
 
        e.preventDefault();
    });
}
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.service-setup').addClass('active_cc');
    });
</script>
<?php include('header.php');?> 
<style>
<?php if(isset($_GET['status']) && $_GET['status'] != ""){?>
#status_chosen .chosen-single{
    color: black !important;
    background-color: #607d8b38 !important;
}
#status_chosen .chosen-container-single .chosen-single span{
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
<?php if(isset($_GET['customer']) && $_GET['customer'] != ""){?>
#customer_chosen .chosen-single{
    color: black !important;
    background-color: #607d8b38 !important;
}
#customer_chosen .chosen-container-single .chosen-single span{
    color: #000 !important;
}
<?php } ?>
<?php if(isset($_GET['id']) && $_GET['id'] != ""){?>
#id_chosen .chosen-single{
    color: black !important;
    background-color: #607d8b38 !important;
}
#id_chosen .chosen-container-single .chosen-single span{
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
<?php if(isset($_GET['category']) && $_GET['category'] != ""){?>
#category_chosen .chosen-single{
    color: black !important;
    background-color: #607d8b38 !important;
}
#category_chosen .chosen-container-single .chosen-single span{
    color: #000 !important;
}
<?php } ?>
<?php if(isset($_GET['stylist']) && $_GET['stylist'] != ""){?>
#stylist_chosen .chosen-single{
    color: black !important;
    background-color: #607d8b38 !important;
}
#stylist_chosen .chosen-container-single .chosen-single span{
    color: #000 !important;
}
<?php } ?>
.resc_service_timeslots::-webkit-scrollbar {
    width: 8px;
}

.resc_service_timeslots::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.resc_service_timeslots::-webkit-scrollbar-thumb {
    background: #0056d1; /* Changed color to #0056d1 */
}

.resc_service_timeslots::-webkit-scrollbar-thumb:hover {
    background: #003f87; /* Adjusted hover color if needed */
}

.service_details_box{
        max-height: 250px;
        overflow: hidden;
        overflow-y: auto;
    }
   
.service_details_box::-webkit-scrollbar {
    width: 8px;
}

.service_details_box::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.service_details_box::-webkit-scrollbar-thumb {
    background: #0056d1; /* Changed color to #0056d1 */
}

.service_details_box::-webkit-scrollbar-thumb:hover {
    background: #003f87; /* Adjusted hover color if needed */
}

    .coupon-tooltip{
        width: 280px;
        position: absolute;
        left: 0;
        background-color: #feefdc;
        display: none;
        /* border: 1px solid #ccc; */
        border-radius: 8px;
        z-index: 999;
        padding: 5px;
        overflow: hidden;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }
    .coupon-tooltip p{
        margin-bottom: 0px;
        font-size: 12px;
    }
    #coupon_details_info{
        cursor: pointer;
    }
    #coupon_details_info:hover .coupon-tooltip{
       display: block;
    }

    .discount-tooltip{
        width: 280px;
        position: absolute;
        left: 0;
        background-color: #feefdc;
        display: none;
        /* border: 1px solid #ccc; */
        border-radius: 8px;
        z-index: 999;
        padding: 5px;
        overflow: hidden;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }
    .discount-tooltip p{
        margin-bottom: 0px;
        font-size: 12px;
    }
    #discount_details_info{
        cursor: pointer;
    }
    #discount_details_info:hover .discount-tooltip{
       display: block;
    }
.loading-skeleton {
    height: 70px;
    background-color: #d7d7d7; /* Background color of skeleton */
    border-radius: 4px; /* Rounded corners */
    padding: 20px; /* Padding around the skeleton */
    margin-bottom: 20px; /* Margin at the bottom */
}

.loading-project {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px; /* Margin between project details */
}

.loading-project-details {
    flex: 1;
}

.loading-project-details1 {
    flex: 0 0 30%; /* Fixed width for this section */
}

.loading-line {
    height: 10px; /* Height of each skeleton line */
    background-color: #ffffff; /* Background color of each skeleton line */
    margin-bottom: 5px; /* Margin between lines */
}
.modal-backdrop.in{
    opacity: 0 !important;
}

.loader {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.loader div {
  position: absolute;
  width: 16px;
  height: 16px;
  border-radius: 50%;
  background: #000;
  animation: loader 1.2s linear infinite;
}
.loader div:nth-child(1) {
  animation-delay: 0s;
  top: 32px;
  left: 32px;
}
.loader div:nth-child(2) {
  animation-delay: -0.4s;
  top: 0;
  left: 32px;
}
.loader div:nth-child(3) {
  animation-delay: -0.8s;
  top: 0;
  left: 0;
}
.loader div:nth-child(4) {
  animation-delay: -1.2s;
  top: 32px;
  left: 0;
}
.loader div:nth-child(5) {
  animation-delay: -1.6s;
  top: 64px;
  left: 32px;
}
@keyframes loader {
  0% {
    transform: scale(0);
  }
  100% {
    transform: scale(1);
    opacity: 0;
  }
}
.loader_container{
    position: fixed;
    background-color: #ffffffb5;
    z-index: 999;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
}
.loader_container .loader{
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
}

.arrow_btn:active{
    box-shadow:none;
}



.loader_div{
    display: none;
    position: fixed;
    width: 100%;
    height: 100% !important;
    background: #00000042;
    z-index: 999999;
    left: 0;
    top: 0;
  }

  .loader-new {
    position: fixed;
    top: 50%;
    left: 50%;
    z-index: 9999;
  --d:22px;
  width: 4px;
  height: 4px;
  border-radius: 50%;
  color: #0056d0;
  box-shadow: 
    calc(1*var(--d))      calc(0*var(--d))     0 0,
    calc(0.707*var(--d))  calc(0.707*var(--d)) 0 1px,
    calc(0*var(--d))      calc(1*var(--d))     0 2px,
    calc(-0.707*var(--d)) calc(0.707*var(--d)) 0 3px,
    calc(-1*var(--d))     calc(0*var(--d))     0 4px,
    calc(-0.707*var(--d)) calc(-0.707*var(--d))0 5px,
    calc(0*var(--d))      calc(-1*var(--d))    0 6px;
  animation: l27 1s infinite steps(8);
}
@keyframes l27 {
  100% {transform: rotate(1turn)}
}


.service_details_div table tr td{
    padding: 5px !important;
}
.service_details_div table tr th{
    padding: 5px !important;
}
.booking_pricing_div table tr th{
    padding: 5px !important;
}
.coupon_details_div table tr td{
    padding: 5px !important;
}
.coupon_details_div table tr th{
    padding: 5px !important;
}
.giftcard_details_div table tr td{
    padding: 5px !important;
}
.giftcard_details_div table tr th{
    padding: 5px !important;
}
.rewards_details_div table tr td{
    padding: 5px !important;
}
.rewards_details_div table tr th{
    padding: 5px !important;
}
.product_details_div table tr td{
    padding: 5px !important;
}
.product_details_div table tr th{
    padding: 5px !important;
}


.extra-service-discount-tooltip{
        width: 280px;
        position: absolute;
        left: 0;
        background-color: #feefdc;
        display: none;
        /* border: 1px solid #ccc; */
        border-radius: 8px;
        z-index: 999;
        padding: 5px;
        overflow: hidden;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }
    .extra-service-discount-tooltip p{
        margin-bottom: 0px;
        font-size: 12px;
    }
    #extra_service_discount_details_info{
        cursor: pointer;
    }
    #extra_service_discount_details_info:hover .extra-service-discount-tooltip{
       display: block;
    }

    .extra_service_price_table table tr th{
        padding: 5px !important;
    }
    .extra_service_products table tr th{
        padding: 5px !important;
    }
    .extra_service_products table tr td{
        padding: 5px !important;
    }
    .single_added_extra_service_details{    
        margin-left: 0px;
        margin-right: 0px;
    }
</style>
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <h3 style="margin-left: 20px;"><b>All Product Bookings</b></h3>
              <div class="title_left">            
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin:0px auto;">
                    <div class="x_panel">
                        <div class="x_content">
                            <form id="make_form" name="make_form" method="get" enctype="multipart/form-data" data-parsley-validate>                                
                                <div class="row"> 
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label for="fullname">Select Payment Status</label>
                                        <select class="form-control choosen" id="status" name="status">
                                        <option value="">All Status</option>
                                        <option value="0" <?php if(isset($_GET['status']) && $_GET['status'] == '0'){?>selected<?php } ?>>Pending</option>
                                        <option value="1" <?php if(isset($_GET['status']) && $_GET['status'] == '1'){?>selected<?php } ?>>Completed</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label for="fullname">Select Booking</label>
                                        <select class="form-control choosen" id="id" name="id">
                                        <option value="">All Bookings</option>
                                        <?php 
                                            if(!empty($bookings)){
                                            foreach($bookings as $bookings_result){
                                        ?>
                                        <option value="<?=$bookings_result->id;?>" <?php if(isset($_GET['id']) && $_GET['id'] == $bookings_result->id){?>selected<?php } ?>><?=$bookings_result->receipt_no.' ('.$bookings_result->full_name.','.$bookings_result->customer_phone.')';?></option>
                                        <?php }} ?>
                                        </select>
                                    </div>   
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label for="fullname">Select Customer</label>
                                        <select class="form-control choosen" id="customer" name="customer">
                                        <option value="">All Customers</option>
                                        <?php 
                                            if(!empty($customer)){
                                            foreach($customer as $customer_result){
                                        ?>
                                        <option value="<?=$customer_result->id;?>" <?php if(isset($_GET['customer']) && $_GET['customer'] == $customer_result->id){?>selected<?php } ?>><?=$customer_result->full_name.' ('.$customer_result->customer_phone.')';?></option>
                                        <?php }} ?>
                                        </select>
                                    </div>                       
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label for="fullname">From Booking Date</label>
                                        <input type="text" class="form-control custom_date" placeholder="From Booking Date" name="from_date" id="from_date" value="<?php if(isset($_GET["from_date"]) && $_GET["from_date"] != "0" && $_GET["from_date"] != ""){ echo date('d-m-Y',strtotime($_GET['from_date'])); }?>">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label for="fullname">To Booking Date</label>
                                        <input type="text" class="form-control custom_date" placeholder="To Booking Date" name="to_date" id="to_date" value="<?php if(isset($_GET["to_date"]) && $_GET["to_date"] != "0" && $_GET["to_date"] != ""){ echo date('d-m-Y',strtotime($_GET['to_date'])); }?>">
                                    </div> 
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label for="fullname">Select Product</label>
                                        <select class="form-control choosen" id="product" name="product">
                                        <option value="">All Product</option>
                                        <?php 
                                            if(!empty($products)){
                                            foreach($products as $products_result){
                                        ?>
                                        <option value="<?=$products_result->id;?>" <?php if(isset($_GET['product']) && $_GET['product'] == $products_result->id){?>selected<?php } ?>><?=$products_result->product_name;?></option>
                                        <?php }} ?>
                                        </select>
                                    </div>        
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label for="fullname">Select Employee</label>
                                        <select class="form-control choosen" id="stylist" name="stylist">
                                        <option value="">All Employee</option>
                                        <?php 
                                            if(!empty($stylists)){
                                            foreach($stylists as $stylist_result){
                                        ?>
                                        <option value="<?=$stylist_result->id;?>" <?php if(isset($_GET['stylist']) && $_GET['stylist'] == $stylist_result->id){?>selected<?php } ?>><?=$stylist_result->full_name;?></option>
                                        <?php }} ?>
                                        </select>
                                    </div>                                     
                                </div>                                            
                                <div class="error" id="status_error_new_2"></div>                                       
                                <div class="row">
                                    <div class="col-md-2  col-sm-3 col-xs-12">
                                        <button type="submit" id="submit_button" class="btn btn-success" style="margin:15px 0;">Search</button>
                                        <?php if(isset($_GET['id']) || isset($_GET['customer']) || isset($_GET['from_date']) || isset($_GET['to_date']) || isset($_GET['status']) || isset($_GET['product']) || isset($_GET['category'])){ ?>
                                        <a href="<?=base_url();?><?=$this->uri->segment(1);?>" class="btn btn-info" style="margin:15px 0;">Reset</a>
                                        <?php } ?>
                                    </div>	
                                </div>	
                                <div class="clearfix"></div>
                            </form>
                        </div>
                        <div class="x_content">
                            <span style="text-align: center;display: block;line-height: 35px;color: white;font-weight: 600;font-size: 15px;background:linear-gradient(271deg, #800080, #ff69b4);margin-bottom: 15px;" id="">Total Bookings: <?=count($total); ?></span>
                            <div id="all_rows"></div>
                            <div class="loading-skeleton">
                                <div class="loading-project">
                                    <div class="loading-project-details">
                                        <div class="loading-line4"></div>
                                        <div class="loading-line2"></div>
                                        <div class="loading-line"></div>
                                        <div class="loading-line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="loading-skeleton">
                                <div class="loading-project">
                                    <div class="loading-project-details">
                                        <div class="loading-line4"></div>
                                        <div class="loading-line2"></div>
                                        <div class="loading-line"></div>
                                        <div class="loading-line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="loading-skeleton">
                                <div class="loading-project">
                                    <div class="loading-project-details">
                                        <div class="loading-line4"></div>
                                        <div class="loading-line2"></div>
                                        <div class="loading-line"></div>
                                        <div class="loading-line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="loading-skeleton">
                                <div class="loading-project">
                                    <div class="loading-project-details">
                                        <div class="loading-line4"></div>
                                        <div class="loading-line2"></div>
                                        <div class="loading-line"></div>
                                        <div class="loading-line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="loading-skeleton">
                                <div class="loading-project">
                                    <div class="loading-project-details">
                                        <div class="loading-line4"></div>
                                        <div class="loading-line2"></div>
                                        <div class="loading-line"></div>
                                        <div class="loading-line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="loading-skeleton">
                                <div class="loading-project">
                                    <div class="loading-project-details">
                                        <div class="loading-line4"></div>
                                        <div class="loading-line2"></div>
                                        <div class="loading-line"></div>
                                        <div class="loading-line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="loading-skeleton">
                                <div class="loading-project">
                                    <div class="loading-project-details">
                                        <div class="loading-line4"></div>
                                        <div class="loading-line2"></div>
                                        <div class="loading-line"></div>
                                        <div class="loading-line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="loading-skeleton">
                                <div class="loading-project">
                                    <div class="loading-project-details">
                                        <div class="loading-line4"></div>
                                        <div class="loading-line2"></div>
                                        <div class="loading-line"></div>
                                        <div class="loading-line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="loading-skeleton">
                                <div class="loading-project">
                                    <div class="loading-project-details">
                                        <div class="loading-line4"></div>
                                        <div class="loading-line2"></div>
                                        <div class="loading-line"></div>
                                        <div class="loading-line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="loading-skeleton">
                                <div class="loading-project">
                                    <div class="loading-project-details">
                                        <div class="loading-line4"></div>
                                        <div class="loading-line2"></div>
                                        <div class="loading-line"></div>
                                        <div class="loading-line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="load_more_box text-center mt-5">
                                <label id="no-more" class="error" style="display:none;margin: 30px;color: #f00;">No Data Available</label>
                                <button id="load-more" class="btn btn-info mt-5">Load more</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          <div class="loader_container" style="display:none;">
            <div class="loader" >
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
          </div>
        <div id="success_alert_div" class="alert mymsg_alert alert-success animated fadeInUp success_alert" style="display:none;"></div>
        <div id="error_alert_div" class="alert  mymsg_alert alert-danger animated fadeInUp error_alert" style="display:none;"></div>

<div class="loader_div">
    <div  class="loader-new"></div>
</div>


<div class="modal fade book_model" id="BookingBillModal" tabindex="-1" aria-labelledby="BillModalLabel" aria-hidden="true" >
    <div class="modal-dialog not">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="BillModalLabel" style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Generate Product Booking Bill</span>
                </h5>                
                <!-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="if(confirm('Are you sure you want to close bill generation?')) { closePopup('BookingBillModal'); }"> -->
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="openConfirmationDialog('Are you sure you want to close bill generation?', function(confirmed) { if (confirmed) { closePopup('BookingBillModal'); } })">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="booking_bill_generation_response"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product Booking Details</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('detailsModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="booking_details_response"></div>
        </div>
    </div>
</div>
</div><div class="modal fade" id="BookingEditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditModalLabel" style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Edit Booking</span>
                </h5>                
                <!-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="if(confirm('Are you sure you want to close bill generation?')) { closePopup('BookingBillModal'); }"> -->
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('BookingEditModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="booking_edit_response"></div>
        </div>
    </div>
</div>
    <?php include('footer.php');?>
<script>    
$(document).ready(function(){
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
    $('.loader_container').hide();
    $('.loader_area').hide();
    $('#success_alert_div').html('');
    $('#error_alert_div').html('');
    $('#success_alert_div').hide();
    $('#error_alert_div').hide();
	var maxEntriesToShowSkeleton = 1;
	var offset = 0;
	var limit = 15;
    var from_date = '<?php if(isset($_GET['from_date']) && $_GET['from_date'] != ""){ echo $_GET['from_date']; }else{ echo '0'; } ?>';
    var to_date = '<?php if(isset($_GET['to_date']) && $_GET['to_date'] != ""){ echo $_GET['to_date']; }else{ echo '0'; } ?>';
    var customer = '<?php if(isset($_GET['customer']) && $_GET['customer'] != ""){ echo $_GET['customer']; }else{ echo '0'; } ?>';
    var id = '<?php if(isset($_GET['id']) && $_GET['id'] != ""){ echo $_GET['id']; }else{ echo '0'; } ?>';
    var product = '<?php if(isset($_GET['product']) && $_GET['product'] != ""){ echo $_GET['product']; }else{ echo '0'; } ?>';
    var caetgory = '<?php if(isset($_GET['caetgory']) && $_GET['caetgory'] != ""){ echo $_GET['caetgory']; }else{ echo '0'; } ?>';
    var status = '<?php if(isset($_GET['status']) && $_GET['status'] != ""){ echo $_GET['status']; }else{ echo ''; } ?>';
    var stylist = '<?php if(isset($_GET['stylist']) && $_GET['stylist'] != ""){ echo $_GET['stylist']; }else{ echo ''; } ?>';

    loadBookings();
    
    $('#load-more').click(function(){
        loadBookings();
    });

    function loadBookings(){
        $.ajax({
            type: "POST",
            url: "<?=base_url();?>salon/Ajax_controller/get_all_product_bookings_ajax",
            data:{
                'offset':offset,
                'limit':limit,
                'from_date':from_date,
                'to_date':to_date,
                'customer':customer,
                'id':id,
                'product':product,
                'caetgory':caetgory,
                'status':status,
                'stylist':stylist,
            },
            success: function (data) {
                $('.loading-skeleton').show();
                setTimeout(function() {
			        $('.loading-skeleton').hide();
                    if (!data || $.isEmptyObject(data)) {
                        $('#load-more').hide();
                        $('#no-more').show();
                    } else {
                        $('#no-more').hide();
                        $('#load-more').show();
                        $("#all_rows").append(data);
                        offset += limit;
                    }   
                }, 1000);          
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
});
function showBillProductGenerationPopup(id) {
    $.ajax({
        url: "<?= base_url(); ?>salon/Ajax_controller/get_product_booking_bill_generation_details_ajx",
        method: 'POST',
        data: { booking_id: id },
        success: function(response) {
            $('#booking_bill_generation_response').html(response)
            showPopup('BookingBillModal');
        },
        error: function(xhr, status, error) {
            console.error('Error fetching booking details:', error);
            alert("Error fetching booking details");
        }
    });
}
var user_selected_products = [];
function setSelectedProduct(productDetailsID,bookingID){
    if ($('#service_checkbox_' + productDetailsID).is(':checked')) {
        user_selected_products.push(productDetailsID.toString()); 
        $('.single_booking_product_barcodes_div_' + productDetailsID).show();
    } else {
        removeValue(user_selected_products, productDetailsID.toString());
        $('.single_booking_product_barcodes_div_' + productDetailsID).hide();
    }
    $('.single_booking_product_barcodes_' + productDetailsID).val('');
    $('#used_product_barcodes_' + productDetailsID).chosen().find('option').prop('disabled', false);
    $('#used_product_barcodes_' + productDetailsID).chosen().trigger('chosen:updated'); 
    setProductPrice(bookingID);
}
function appendProductDiv(bookingID){
    alert(bookingID);
    product = $('#select_product_' + bookingID).val();
    $.ajax({
        type: "POST",
        url: "<?= base_url(); ?>salon/Ajax_controller/get_product_details_row_ajx",
        data: { 'category_id': $('#category_' + id).val(), 'booking_id': bookingID, 'product': product },
        success: function(appendRow) {  
            $('#product_row_' + bookingID).append(appendRow);
        },
    });
}
function validateBarcodeSelection(productDetailsID) {
    var product_quantity = $('#product_quantity_' + productDetailsID).val();
    var $chosenSelect = $('#used_product_barcodes_' + productDetailsID).chosen(); // Initialize Chosen

    // Update Chosen select to reflect disabled options
    if (product_quantity != null && product_quantity !== '') {
        $chosenSelect.find('option').each(function () {
            $(this).prop('disabled', false); // Enable all options first
        });

        // Disable options that are not selected and exceed the product_quantity
        var selectedOptions = $chosenSelect.val() || [];
        if (selectedOptions.length === parseInt(product_quantity)) {
            $chosenSelect.find('option:not(:selected)').prop('disabled', true);
        }
    } else {
        $chosenSelect.find('option').prop('disabled', false); // Enable all options if product_quantity is not defined
    }

    $chosenSelect.trigger('chosen:updated'); // Update Chosen UI
}

function setProductPrice(bookingID){   
    var current_total = 0.00;
    for(var y=0;y<user_selected_products.length;y++){
        var productDetailsId = user_selected_products[y];

        var product_price = parseFloat($('#single_product_price_'+productDetailsId).val());
        var product_quantity = $('#product_quantity_'+productDetailsId).val();
        if(product_quantity == '' || isNaN(product_quantity) || typeof product_quantity === 'undefined') {
            product_quantity = 0;
        }else{
            product_quantity = parseInt(product_quantity);
        }

        var single_product_total = product_price * product_quantity;

        $('#single_product_total_amount_'+productDetailsId).text(parseFloat(single_product_total).toFixed(2));
        $('#single_product_total_amount_hidden_'+productDetailsId).val(parseFloat(single_product_total).toFixed(2));

        current_total = current_total + single_product_total;
    }      
    
    $('#total_product_amount_'+bookingID).val(parseFloat(current_total).toFixed(2));
    $('#total_product_amount_text_'+bookingID).text(parseFloat(current_total).toFixed(2));
    
    setPayableProductAmount(bookingID);
}
function removeValue(arr, value) {
    var index = arr.indexOf(value);
    if (index !== -1) {
        arr.splice(index, 1);
    }
    return arr;
}
function incrementQuantity(productDetailsId,bookingID) {
    var input = $('#product_quantity_' + productDetailsId);
    var product_stock = parseInt($('#single_product_stock_' + productDetailsId).val(), 10);
    var newValue = parseInt(input.val(), 10) + 1;

    if (newValue > product_stock) {
        $('#stock_error_' + productDetailsId + '_' + bookingID).text('Cannot exceed available stock');
        return;
    }
    $('#stock_error_' + productDetailsId + '_' + bookingID).text('');

    input.val(newValue);
    $('.single_booking_product_barcodes_' + productDetailsId).val('');
    $('#used_product_barcodes_' + productDetailsId).chosen().find('option').prop('disabled', false);
    $('#used_product_barcodes_' + productDetailsId).chosen().trigger('chosen:updated'); 
    setProductPrice(bookingID);
}

function decrementQuantity(productDetailsId,bookingID) {
    $('#stock_error_' + productDetailsId + '_' + bookingID).text('');
    var input = $('#product_quantity_' + productDetailsId);
    var newValue = parseInt(input.val(), 10) - 1;
    if (newValue >= 1) {
        input.val(newValue);
        $('.single_booking_product_barcodes_' + productDetailsId).val('');
        $('#used_product_barcodes_' + productDetailsId).chosen().find('option').prop('disabled', false);
        $('#used_product_barcodes_' + productDetailsId).chosen().trigger('chosen:updated'); 
        setProductPrice(bookingID);
    }
}
function setPayableProductAmount(bookingID){
    member_product_discount = $('#m_product_discount_' + bookingID).val();
    membership_discount_type = parseFloat($('#membership_discount_type_' + bookingID).val());

    if (typeof member_product_discount === 'undefined' || member_product_discount === '') {
        member_product_discount = 0;
    }else{
        member_product_discount = parseFloat(member_product_discount);
    }

    total_product_amount = parseFloat($('#total_product_amount_' + bookingID).val());
    
    if(membership_discount_type == '0'){
        discount = (total_product_amount * member_product_discount)/100;
    }else if(membership_discount_type == '1'){
        discount = member_product_discount;
    }else{
        discount = 0;
    }

    if(total_product_amount == 0){
        discount = 0;
    }

    $('#m_product_discount_amount_' + bookingID).val(parseFloat(discount).toFixed(2));

    payable = total_product_amount - discount;

    $('#product_payable_hidden_' + bookingID).val(parseFloat(payable).toFixed(2));

    $('#product_payable_text_' + bookingID).html(parseFloat(payable).toFixed(2));

    setPayableAmount(bookingID);
}

function setPayableAmount(bookingID){
    product_payable = parseFloat($('#product_payable_hidden_' + bookingID).val());

    payable = product_payable;

    $('#payable_hidden_' + bookingID).val(parseFloat(payable).toFixed(2));

    setBookingAmount(bookingID);
}


function setBookingAmount(bookingID){
    calculateTotalDiscount(bookingID);
    
    reward_discount = parseFloat($('#reward_discount_amount_' + bookingID).val());
    payable = parseFloat($('#payable_hidden_' + bookingID).val());

    booking = payable - reward_discount;

    $('#booking_amount_hidden_' + bookingID).val(parseFloat(booking).toFixed(2));
    $('#booking_amount_' + bookingID).text(parseFloat(booking).toFixed(2));

    setGST(bookingID);
}

function setGST(bookingID){
    rate = parseFloat($('#salon_gst_rate_' + bookingID).val());
    booking_amount = parseFloat($('#booking_amount_hidden_' + bookingID).val());

    gst_amount = (rate  * booking_amount) / 100;

    $('#gst_amount_hidden_' + bookingID).val(parseFloat(gst_amount).toFixed(2));
    $('#gst_amount_' + bookingID).text(parseFloat(gst_amount).toFixed(2));

    setGrandTotal(bookingID);
}

function setGrandTotal(bookingID){
    booking_amount = parseFloat($('#booking_amount_hidden_' + bookingID).val());
    gst_amount = parseFloat($('#gst_amount_hidden_' + bookingID).val());
    customer_pending_amount = parseFloat($('#customer_pending_amount_' + bookingID).val());
    
    total = booking_amount + gst_amount;

    allowed_max = total + customer_pending_amount;
    $('#total_due_' + bookingID).text(parseFloat(allowed_max).toFixed(2));

    $('#paid_amount_' + bookingID).val(parseFloat(allowed_max).toFixed(2)).attr('max', parseFloat(allowed_max).toFixed(2));
    $('#grand_total_hidden_' + bookingID).val(parseFloat(total).toFixed(2));
    $('#grand_total_' + bookingID).text(parseFloat(total).toFixed(2));

    calculatePendingAmount(bookingID);
}

function calculatePendingAmount(bookingID){
    var grand_total = parseFloat($('#grand_total_hidden_' + bookingID).val()) || 0;
    var paid_amount = parseFloat($('#paid_amount_' + bookingID).val()) || 0;
    var customer_pending_amount = parseFloat($('#customer_pending_amount_' + bookingID).val()) || 0;

    pending_now = (grand_total + customer_pending_amount) - paid_amount;

    $('#pending_amount_' + bookingID).val(parseFloat(pending_now).toFixed(2));
}
  
function calculateTotalDiscount(bookingID){
    $('#discount_details_div_' + bookingID).html('');
    var membership_product_discount_amount = parseFloat($('#m_product_discount_amount_' + bookingID).val());
    var reward_discount_amount = parseFloat($('#reward_discount_amount_' + bookingID).val());
    
    total_discount = membership_product_discount_amount + reward_discount_amount;
    $('#discount_amount_' + bookingID).text(parseFloat(total_discount).toFixed(2));
    $('#total_discount_hidden_' + bookingID).val(parseFloat(total_discount).toFixed(2));

    var discount_details = '<div id="discount_details_info"><i class="fas fa-info-circle" style="color:#0000ffb0;"></i>';
    discount_details += '<div class="discount-tooltip">';
    if (membership_product_discount_amount > 0) {
        discount_details += '<p>Membership Product Discount <span class="amount" style="float: right;">' + membership_product_discount_amount.toFixed(2) + '</span></p>';
    }
    if (reward_discount_amount > 0) {
        discount_details += '<p>Reward Discount <span class="amount" style="float: right;">' + reward_discount_amount.toFixed(2) + '</span></p>';
    }
    discount_details += '<div style="border-top:1px solid #ccc;margin-top:1px;"><p>Total Discount <span class="amount" style="float: right;">' + total_discount.toFixed(2) + '</span></p></div>'; // Add total discount here
    discount_details += '</div></div>';
    if(total_discount > 0){
        $('#discount_details_div_' + bookingID).html(discount_details);
    }
} 
function applyRewards(bookingID){
    $('.loader_div').show();   
    setTimeout(function() {
        var customer_reward_available = parseInt($('#customer_reward_available_' + bookingID).val());
        var customer_gender = $('#customer_gender_' + bookingID).val();
        var total_value = 0;

        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_reward_setup_ajx",
            data: { 'gender': customer_gender },
            success: function(data) {  
                var opts = $.parseJSON(data);
                if (!$.isEmptyObject(opts)) {
                    rs_per_reward = opts.rs_per_reward;
                    reward_point = opts.reward_point;
                    minimum_reward_required = parseInt(opts.minimum_reward_required);
                    maximum_reward_required = opts.maximum_reward_required;

                    payableHidden = parseFloat($('#payable_hidden_' + bookingID).val());

                    if(payableHidden > 0){
                        if(customer_reward_available >= minimum_reward_required){
                            if(customer_reward_available > maximum_reward_required){
                                available_rewards = maximum_reward_required;
                            }else{
                                available_rewards = customer_reward_available;
                            }

                            consider_rewards = available_rewards / reward_point;
                            total_value = consider_rewards * rs_per_reward;

                            $('#reward_discount_amount_' + bookingID).val(parseFloat(total_value).toFixed(2));
                            $('#used_rewards_' + bookingID).val(available_rewards);
                            $('#customer_rewards_text_' + bookingID).html('');
                            $('#customer_rewards_text_' + bookingID).html('Rewards Balance: <s>'+customer_reward_available+'</s> '+(customer_reward_available-available_rewards)+'<br>Discount: Rs.'+parseFloat(total_value).toFixed(2));
                            $('#used_rewards_msg_' + bookingID).html('<label style="color:green;font-size:10px;">'+available_rewards+' Rewards used</label>');

                            setBookingAmount(bookingID);

                            $('#rewards_button_' + bookingID).hide();
                            $('#rewards_remove_button_' + bookingID).show();
                        }else{
                            // alert('Minimum reward points required are: '+ minimum_reward_required);
                            openDialog('Minimum reward points required are: '+ minimum_reward_required); 
                        }
                    }else{
                        // alert('Total amount is not valid.');
                        openDialog('Total amount is not valid.'); 
                    } 
                    $('.loader_div').hide();  
                }
            },
        });
    }, 1500);
}
function removeRewards(bookingID){
    $('.loader_div').show();   
    setTimeout(function() {
        var customer_reward_available = parseInt($('#customer_reward_available_' + bookingID).val());
        $('#reward_discount_amount_' + bookingID).val(parseFloat(0).toFixed(2));
        $('#used_rewards_' + bookingID).val(0);
        $('#customer_rewards_text_' + bookingID).html('');
        $('#customer_rewards_text_' + bookingID).html('Rewards Balance: '+customer_reward_available);
        $('#used_rewards_msg_' + bookingID).html('');
        
        setBookingAmount(bookingID);

        $('#rewards_button_' + bookingID).show();
        $('#rewards_remove_button_' + bookingID).hide();
        
        $('.loader_div').hide();   
    }, 1500);
}
function checkArraysMatch(array1, array2) {
    return $.grep(array1, function(value1) {
        return $.grep(array2, function(value2) {
            return value1 === value2;
        }).length > 0;
    }).length > 0;
}


function showProductBookingEditPopup(id) {
    $.ajax({
        url: "<?= base_url(); ?>salon/Ajax_controller/get_product_booking_edit_details_ajx",
        method: 'POST',
        data: { booking_id: id },
        success: function(response) {
            $('#booking_edit_response').html(response)
            showPopup('BookingEditModal');
        },
        error: function(xhr, status, error) {
            console.error('Error fetching booking details:', error);
            alert("Error fetching booking details");
        }
    });
}  

function showPopup(id){
    var exampleModal = $('#'+id);
    exampleModal.css('display','block');
    exampleModal.css('opacity','1');
    $('.modal-open').css('overflow','auto').css('padding-right','0px'); 
}
function closePopup(id){
    var exampleModal = $('#'+id);

    exampleModal.css('display','none');
    exampleModal.css('opacity','0');
    $('.modal-open').css('overflow','auto').css('padding-right','0px');
}
$('.panel-heading').click(function(){
    $(this).find('.fas.fa-chevron-right').toggleClass('rotate-90');
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

function changeCSS(id){
    if ($('#collapse_' + id).hasClass('in')) {
        $('#arrow_' + id).css({
            'transform': 'rotate(0deg)',
            'transition': 'transform 0.5s ease'
        });
    } else {
        $('#arrow_' + id).css({
            'transform': 'rotate(90deg)',
            'transition': 'transform 0.5s ease'
        });
    }
}
</script>
<script>
    $(document).ready(function() {
        // $('#reports .child_menu').show();
        $('#reports').addClass('nv active');
        // $('.right_col').addClass('active_right');
        $('.product-booking-lists').addClass('active_cc');
    });
</script>
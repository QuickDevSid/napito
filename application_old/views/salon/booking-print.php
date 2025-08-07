<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Laralink">
  <!-- Site Title -->
  <title>Payment Receipt</title>
  <link rel="stylesheet" href="<?=base_url();?>invoice_assests/style.css">
</head>
<!-- Add this line to the head section of your HTML document -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<body>
  <style>
    @media (max-width: 767px) {
      .tm_invoice.tm_style1.tm_type1 .tm_logo img {
          max-height: 60px !important;
      }

      .tm_invoice.tm_style1.tm_type1 .tm_invoice_head {
          height: initial !important;
      }
/* 
      .tm_invoice_left {
          width: 50% !important;
      } */

      .tm_invoice_right {
          width: 50% !important;
      }

      .tm_invoice.tm_style1 .tm_invoice_head {
          -webkit-box-orient: unset !important;
      }

      .tm_right_footer {
          width: 100% !important;
      }

      .tm_left_footer {
          width: unset !important;
          margin-top: unset !important;
      }
      .tm_invoice_footer .tm_left_footer {
    width: 100%;
        border-top: unset !important;
      }

      .tm_note {
          margin-top: unset !important;
      }
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
  </style>
    <?php if(!empty($single_payment_details) && !empty($single)){ 
      $branch_id = $single_payment_details->branch_id;
      $salon_id = $single_payment_details->salon_id;
		  $single_profile = $this->Salon_model->get_single_branch_profile_all($single_payment_details->branch_id,$single_payment_details->salon_id);
      if(!empty($single_profile)){ 
      $package_details = $this->Salon_model->get_package_details($single_payment_details->pacakge_id);
      $membership_details = $this->Salon_model->get_membership_single_details($single_payment_details->membership_id);
      
		  $only_products = $this->Salon_model->get_booking_only_products($single_payment_details->id,$single->id);
        // echo '<pre>'; print_r($only_products); exit();
      $marketing_service_discount_amount = is_numeric($single_payment_details->marketing_service_discount_amount) ? floatval($single_payment_details->marketing_service_discount_amount) : 0;
      $marketing_product_discount_amount = is_numeric($single_payment_details->marketing_product_discount_amount) ? floatval($single_payment_details->marketing_product_discount_amount) : 0;
      $offer_discount = is_numeric($single_payment_details->offer_discount_amount) ? floatval($single_payment_details->offer_discount_amount) : 0;
      $coupon_discount = is_numeric($single_payment_details->coupon_discount_amount) ? floatval($single_payment_details->coupon_discount_amount) : 0;
      $reward_discount = is_numeric($single_payment_details->reward_discount_amount) ? floatval($single_payment_details->reward_discount_amount) : 0;
      $extra_discount = is_numeric($single_payment_details->extra_discount_amount) ? floatval($single_payment_details->extra_discount_amount) : 0;
      $gift_discount = is_numeric($single_payment_details->gift_discount) ? floatval($single_payment_details->gift_discount) : 0;
      $m_service_discount = is_numeric($single_payment_details->m_service_discount_amount) ? floatval($single_payment_details->m_service_discount_amount) : 0;
      $m_product_discount = is_numeric($single_payment_details->m_product_discount_amount) ? floatval($single_payment_details->m_product_discount_amount) : 0;
      
      $total_discount = $coupon_discount + $offer_discount + $reward_discount + $gift_discount + $m_service_discount + $m_product_discount + $marketing_service_discount_amount + $marketing_product_discount_amount + $extra_discount;
     
      $applied_giftcard_redemption = $single_payment_details->giftcard_redemption_id;
      $this->db->select('tbl_booking_payment_entry.*,tbl_salon_customer.full_name,tbl_salon_customer.customer_phone, tbl_gift_card.gender, tbl_gift_card.gift_card_code, tbl_gift_card.gift_name, tbl_gift_card.discount, tbl_gift_card.discount_in, tbl_gift_card.regular_price, tbl_gift_card.gift_price, tbl_gift_card.bg_color_input, tbl_gift_card.bg_color, tbl_gift_card.text_color_input, tbl_gift_card.text_color, tbl_gift_card.min_booking_amt');
      $this->db->join('tbl_gift_card', 'tbl_gift_card.id = tbl_booking_payment_entry.giftcard_id');
      $this->db->join('tbl_salon_customer', 'tbl_salon_customer.id = tbl_booking_payment_entry.customer_id');
      $this->db->where('tbl_booking_payment_entry.branch_id',$branch_id);
      $this->db->where('tbl_booking_payment_entry.salon_id',$salon_id);
      $this->db->where('tbl_booking_payment_entry.id',$applied_giftcard_redemption);
      $this->db->where('tbl_booking_payment_entry.is_deleted','0');
      $this->db->where('tbl_booking_payment_entry.type','3');
      $this->db->order_by('tbl_booking_payment_entry.updated_on','desc');
      $result = $this->db->get('tbl_booking_payment_entry');
      $applied_giftcards = $result->row();

      $applied_offer = $single_payment_details->applied_offer_id;
      $this->db->where('tbl_offers.id', $applied_offer);
      $this->db->where('tbl_offers.status', '1');
      $this->db->where('tbl_offers.is_deleted', '0');
      $this->db->where('tbl_offers.branch_id', $branch_id);
      $this->db->where('tbl_offers.salon_id', $salon_id);
      $this->db->order_by('tbl_offers.id', 'DESC');                
      $result = $this->db->get('tbl_offers');
      $applied_offers = $result->row();

      $applied_coupon = $single_payment_details->selected_coupon_id;
      $this->db->where('tbl_coupon_code.id', $applied_coupon);
      $this->db->where('tbl_coupon_code.status', '1');
      $this->db->where('tbl_coupon_code.is_deleted', '0');
      $this->db->where('tbl_coupon_code.branch_id', $branch_id);
      $this->db->where('tbl_coupon_code.salon_id', $salon_id);
      $this->db->order_by('tbl_coupon_code.id', 'DESC');                
      $result = $this->db->get('tbl_coupon_code');
      $applied_coupons = $result->row();

      $applied_membership = $single_payment_details->membership_history_id;
      $this->db->select('tbl_customer_membership_history.*, tbl_memebership.membership_name');
      $this->db->join('tbl_memebership', 'tbl_memebership.id = tbl_customer_membership_history.membership_id');
      $this->db->where('tbl_customer_membership_history.id',$applied_membership);
      $this->db->where('tbl_customer_membership_history.is_deleted','0');
      $applied_membership = $this->db->get('tbl_customer_membership_history')->row();
      
      if(!empty($applied_membership)){
          $applied_membership_details = array(
              'membership_id'     =>  $applied_membership->membership_id,
              'name'              =>  $applied_membership->membership_name,
              'discount_type'     =>  $applied_membership->discount_in,
              'service_discount'  =>  $applied_membership->service_discount,
              'product_discount'  =>  $applied_membership->product_discount,
              'background_color'  =>  $applied_membership->bg_color,
              'text_color'        =>  $applied_membership->text_color,
              'service_discount_amount'   =>  $m_service_discount,
              'product_discount_amount'   =>  $m_product_discount
          );
      }

      $applied_package = $single_payment_details->package_allocation_id;
      $this->db->select('tbl_customer_package_allocations.*,tbl_package.package_image, tbl_package.description as package_desc, tbl_package.service_name as package_service_name,tbl_package.product_name as package_product_name,tbl_package.package_name,tbl_package.package_name_marathi,tbl_package.discount_in,tbl_package.actual_price,tbl_package.discount');
      $this->db->join('tbl_package','tbl_package.id = tbl_customer_package_allocations.package_id');
      $this->db->where('tbl_customer_package_allocations.is_deleted', '0');
      $this->db->where('tbl_customer_package_allocations.branch_id', $branch_id);
      $this->db->where('tbl_customer_package_allocations.salon_id', $salon_id);
      $this->db->where('tbl_customer_package_allocations.id',$applied_package);
      $this->db->order_by('tbl_customer_package_allocations.id', 'DESC');                
      $result = $this->db->get('tbl_customer_package_allocations');
      $applied_packages = $result->row();
      
      if(!empty($applied_packages)){ 
          $applied_package_details = array(
              'package_id'                =>  $applied_packages->package_id,
              'package_allocation_id'     =>  $applied_packages->id,
              'package_name'              =>  $applied_packages->package_name,
              'package_name_marathi'      =>  $applied_packages->package_name_marathi,
              'package_start'             =>  date('d M, Y',strtotime($applied_packages->package_start_date)),
              'package_end'               =>  date('d M, Y',strtotime($applied_packages->package_end_date)),
              'description'               =>  $applied_packages->package_desc,
              'image'                     =>  $applied_packages->package_image != "" ? base_url('admin_assets/images/package_image/' . $applied_packages->package_image) : '',
          );  
      } 

      $amount_to_paid = is_numeric($single_payment_details->amount_to_paid) ? floatval($single_payment_details->amount_to_paid) : 0;
      $salon_gst_rate = is_numeric($single_payment_details->salon_gst_rate) ? floatval($single_payment_details->salon_gst_rate) : 0;
      $gst_amount = is_numeric($single_payment_details->gst_amount) ? floatval($single_payment_details->gst_amount) : 0;
      $booking_amount = is_numeric($single_payment_details->booking_amount) ? floatval($single_payment_details->booking_amount) : 0;
      

      $total_product_price = is_numeric($single_payment_details->total_product_price) ? floatval($single_payment_details->total_product_price) : 0;
      $total_service_price = is_numeric($single_payment_details->total_service_price) ? floatval($single_payment_details->total_service_price) : 0;
      $package_amount = is_numeric($single_payment_details->package_amount) ? floatval($single_payment_details->package_amount) : 0;
      $membership_payment_amount = $single_payment_details->is_membership_payment_included == '1' ? floatval($single_payment_details->membership_payment_amount) : 0;
    ?>
  <div class="tm_container">
    <div class="tm_invoice_wrap">
      <div class="tm_invoice tm_style1 tm_type1" id="tm_download_section">
        <div class="tm_invoice_in">
          <div class="tm_invoice_head tm_top_head tm_mb15 tm_align_center">
            <div class="tm_invoice_left">
              <div class="tm_logo"><img src="<?=base_url();?>admin_assets/images/store_logo/<?=$single_profile->store_logo; ?>" style="max-height: 107px;" alt=""></div>
            </div>
            <div class="tm_invoice_right tm_text_right tm_mobile_hide">
              <div class="tm_f50 tm_text_uppercase tm_white_color">Receipt</div>
            </div>
            <div class="tm_shape_bg tm_accent_bg tm_mobile_hide"></div>
          </div>
          <div class="tm_invoice_info tm_mb25">
            <div class="tm_card_note tm_mobile_hide"><b class="tm_primary_color">Payment Status: </b>
              <?php 
                if($single_payment_details->payment_status == '0'){ 
                  echo 'Pending';
                }elseif($single_payment_details->payment_status == '1'){
                  echo 'Complete';
                }else{
                  echo '-';
                }
              ?>
            </div>
            <div class="tm_invoice_info_list tm_white_color">
              <p class="tm_invoice_number tm_m0">Receipt No: <b><?=$single_payment_details->receipt_no; ?></b></p>
              <p class="tm_invoice_date tm_m0">Date: <b><?php echo $single_payment_details->payment_date != "" ? date("d/m/Y",strtotime($single_payment_details->payment_date)) : '-'; ?></b></p>
            </div>
            <div class="tm_invoice_seperator tm_accent_bg"></div>
          </div>
          <div class="tm_invoice_head tm_mb10" style="height:100px;">
            <div class="tm_invoice_left">
			 <p class="tm_mb2"><b class="tm_primary_color">Receipt To:</b></p>
              <p>
                <?=$single->full_name?><br>
                <?=$single->customer_phone?><br>
                <?=$single->email?>
              </p>
            </div>
            <div class="tm_invoice_right tm_text_right">
              <p class="tm_mb2"><b class="tm_primary_color">Pay To:</b></p>
              <p>
                <?=$single_profile->branch_name?> <br>
                <?=$single_profile->salon_number?> <br>
                <?=$single_profile->email?>
				        <br>               
              </p>
            </div>
          </div>
          <div class="tm_table tm_style1">
            <div class="">
              <div class="tm_table_responsive">
                <table>
                  <thead>
                    <tr class="tm_accent_bg">
                     <th class="tm_width_3 tm_semi_bold tm_white_color" style="width:15%;text-align:left;">Sr. No.</th>
                      <th class="tm_width_4 tm_semi_bold tm_white_color" style="width:55%;text-align:left;">Item</th>
                      <th class="tm_width_2 tm_semi_bold tm_white_color" style="width:20%;text-align:left;">Stylist</th>
                      <th class="tm_width_2 tm_semi_bold tm_white_color" style="width:15%;text-align:center;">Price</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $i = 1;
                      if(!empty($single_bill_services)){ 
                        foreach($single_bill_services as $single_services_result){
                          $after_bill_stylist = $this->Salon_model->get_stylist_details($single_services_result->stylist_id_after_bill);

                          $products = explode(',',$single_services_result->product_ids);

                          $paid_products = $this->Salon_model->get_service_paid_products($single_services_result->id,$single->id);

                          $product_details_str = '';
                          if (empty($paid_products)) {
                              $product_details_str = '-';
                          } else {
                              $k = 0;
                              foreach($paid_products as $paid_products_result) {
                                $product_details_str .= $paid_products_result->product_name . ' <small>(Rs. ' . $paid_products_result->product_price . ')</small>';
                                if ($k < count($paid_products) - 1) {
                                    $product_details_str .= ', ';
                                }
                                $k++;
                              }
                          }
                    ?>
                    <tr>
                      <td class="tm_width_3" style="width:15%;text-align:left;"><?=$i++; ?></td>
                      <td class="tm_width_4" style="width:55%;text-align:left;">
                        <small><?=$single_services_result->category_name;?> -> <?=$single_services_result->sub_category_name; ?></small><br>
                        <?=$single_services_result->service_name;?> | <?=$single_services_result->service_name_marathi; ?>
                        <?php if($single_services_result->service_added_from == '1' && !empty($package_details)){ ?>
                          <br><small>(Package: <?=$package_details->package_name;?>)</small>
                        <?php } ?>
                        <?=(!empty($paid_products) && $product_details_str != "") ? '<br>Products: ' . $product_details_str : ''; ?>
                      </td>
                      <td class="tm_width_2" style="width:20%;text-align:left;"><?=(!empty($after_bill_stylist)) ? $after_bill_stylist->full_name : '-'; ?></td>
                      <td class="tm_width_2" style="width:15%;text-align:center;"><?=($single_services_result->service_price != "") ? number_format($single_services_result->service_price, 2, '.', ',') : '-'; ?></td>
                    </tr> 
                    <?php }} ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="">
              <div class="tm_table_responsive">
                <table>
                  <tbody>
                    <?php 
                      if(!empty($only_products)){ 
                        foreach($only_products as $single_services_result){
                          $after_bill_stylist = $this->Salon_model->get_stylist_details($single_services_result->stylist_after_bill);
                    ?>
                    <tr>
                      <td class="tm_width_3" style="width:15%;text-align:left;"><?=$i++; ?></td>
                      <td class="tm_width_4" style="width:55%;text-align:left;">
                        <small><?=$single_services_result->product_category_name;?> -> <?=$single_services_result->product_sub_category_name; ?></small><br>
                        <?=$single_services_result->product_name; ?><br>
                        Qty: <?=$single_services_result->quantity_after_bill;?><br>
                        Price: Rs. <?=number_format($single_services_result->single_product_price, 2, '.', ',');?> <small>(Per Qty.)</small>
                      </td>
                      <td class="tm_width_2" style="width:20%;text-align:left;"><?=(!empty($after_bill_stylist)) ? $after_bill_stylist->full_name : '-'; ?></td>
                      <td class="tm_width_2" style="width:15%;text-align:center;"><?=($single_services_result->total_product_price != "") ? number_format($single_services_result->total_product_price, 2, '.', ',') : '-'; ?></td>
                    </tr> 
                    <?php }} ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tm_invoice_footer tm_border_top tm_mb15 tm_m0_md">
              <div class="tm_left_footer" style="width:35%;">
                <p class="tm_mb2"><b class="tm_primary_color">Payment info:</b></p>
                <?php if($single_payment_details->is_counter == "Yes"){ echo '<p>Counter Sale</p>'; } ?>
                <?php if($single_payment_details->payment_mode != ""){ ?>
                  <p class="tm_m0">Mode: <?=$single_payment_details->payment_mode; ?></p>
                  <?php if($single_payment_details->transaction_id != ""){ ?><p class="tm_m0">Transaction ID: <small><?=$single_payment_details->transaction_id;?></small></p> <?php } ?>
                <?php }elseif($single_payment_details->payment_mode_multiple != ""){ ?>
                <table>
                <?php if($single_payment_details->is_gst_applicable == '1'){ ?>
                    <tr>
                      <td style="border: none;padding: 0px 5px;"><small>GSTIN: <?=$single_payment_details->salon_gst_no != "" ? $single_payment_details->salon_gst_no : '-';?></td>
                    </tr>
                  <?php
                }
                    $payment_mode_multiple = explode(',',$single_payment_details->payment_mode_multiple);
                    $payment_transaction_id_multiple = explode(',',$single_payment_details->payment_transaction_id_multiple);
                    $payment_amount_multiple = explode(',',$single_payment_details->payment_amount_multiple);
                    for($i=0;$i<count($payment_mode_multiple);$i++){
                      if($payment_mode_multiple[$i] != ""){
                  ?>
                  <tr>
                    <td style="border: none;padding: 0px 5px;"><small><?=$payment_mode_multiple[$i];?></small><small><?=$payment_amount_multiple[$i] != "" ? ' (Rs. ' . number_format($payment_amount_multiple[$i], 2, '.', ',') . ')' : '';?></small><small><?=$payment_transaction_id_multiple[$i] != "" ? ' - ' . $payment_transaction_id_multiple[$i] : '';?></small></td>
                  </tr>
                  <?php }} ?>
                </table>
                <?php } ?>
              </div>
              <div class="tm_right_footer" style="width:65%;">
                <table class="tm_mb15">
                  <tbody>
                    <tr class="tm_gray_bg ">
                      <td class="tm_width_3 tm_primary_color tm_bold">Service Amt</td>
                      <td class="tm_width_3 tm_primary_color tm_bold tm_text_right">
                        <?=number_format($single_payment_details->total_service_price, 2, '.', ',');?>
                      </td>
                    </tr>
                    <?php if($single_payment_details->total_product_price != '0' && $single_payment_details->total_product_price != '0.00'){ ?>
                    <tr class="tm_gray_bg ">
                      <td class="tm_width_3 tm_primary_color tm_bold">Product Amt</td>
                      <td class="tm_width_3 tm_primary_color tm_bold tm_text_right">
                          <?=number_format($single_payment_details->total_product_price, 2, '.', ',');?>
                      </td>
                    </tr>
                    <?php } ?>
                    <?php if($single_payment_details->pacakge_id != "" && $single_payment_details->pacakge_id != null && $single_payment_details->pacakge_id != '0'){ ?>
                    <tr class="tm_gray_bg ">
                      <td class="tm_width_3 tm_primary_color tm_bold">
                        Package Amt
                        <?php if(!empty($package_details)){ ?> 
                        <br><small>(<?=$package_details->package_name;?>)</small>
                        <?php } ?>
                        <?php if($single_payment_details->package_amount == '0.00'){ ?>
                          <small> - Active</small> 
                        <?php } ?>
                      </td>
                      <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?=number_format($single_payment_details->package_amount, 2, '.', ','); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if($single_payment_details->is_membership_booking == "1" && $single_payment_details->is_membership_payment_included == '1'){ ?>
                    <tr class="tm_gray_bg ">
                      <td class="tm_width_3 tm_primary_color tm_bold">
                        Membership Amt
                        <?php if(!empty($membership_details)){ ?> 
                        <br><small>(<?=$membership_details->membership_name;?>)</small>
                        <?php } ?>
                      </td>
                      <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?=number_format($single_payment_details->membership_payment_amount, 2, '.', ','); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if ($marketing_service_discount_amount > 0) { ?>
                      <tr class="tm_gray_bg" style="background: #0080002e;">
                        <td class="tm_width_3 tm_primary_color tm_bold">
                          Service Marketing Discount
                        </td>
                        <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?=number_format($marketing_service_discount_amount, 2, '.', ','); ?></td>
                      </tr>
                    <?php } ?>
                    <?php if ($marketing_product_discount_amount > 0) { ?>
                      <tr class="tm_gray_bg" style="background: #0080002e;">
                        <td class="tm_width_3 tm_primary_color tm_bold">
                          Product Marketing Discount
                        </td>
                        <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?=number_format($marketing_product_discount_amount, 2, '.', ','); ?></td>
                      </tr>
                    <?php } ?>
                    <?php if ($m_service_discount > 0) { ?>
                      <tr class="tm_gray_bg" style="background: #0080002e;">
                        <td class="tm_width_3 tm_primary_color tm_bold">
                          Membership Service Discount <?php if(!empty($applied_membership)){ ?> <br><small style="color: green;font-size:10px;"><?=$applied_membership->membership_name;?> Membership</small> <?php } ?>
                        </td>
                        <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?=number_format($m_service_discount, 2, '.', ','); ?></td>
                      </tr>
                    <?php } ?>
                    <?php if ($m_product_discount > 0) { ?>
                      <tr class="tm_gray_bg " style="background: #0080002e;">
                        <td class="tm_width_3 tm_primary_color tm_bold">
                          Membership Product Discount <?php if(!empty($applied_membership)){ ?> <br><small style="color: green;font-size:10px;"><?=$applied_membership->membership_name;?> Membership</small> <?php } ?>
                        </td>
                        <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?=number_format($m_product_discount, 2, '.', ','); ?></td>
                      </tr>
                    <?php } ?>
                    <?php if ($offer_discount > 0) { ?>
                      <tr class="tm_gray_bg " style="background: #0080002e;">
                        <td class="tm_width_3 tm_primary_color tm_bold">
                          Offer Discount <?php if(!empty($applied_offers)){ ?> <br><small style="color: green;font-size:10px;"><?=$applied_offers->offers_name;?> Applied</small> <?php } ?>
                        </td>
                        <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?=number_format($offer_discount, 2, '.', ','); ?></td>
                      </tr>
                    <?php } ?>
                    <?php if ($coupon_discount > 0) { ?>
                      <tr class="tm_gray_bg " style="background: #0080002e;">
                        <td class="tm_width_3 tm_primary_color tm_bold">
                        Coupon Discount <?php if(!empty($applied_coupons)){ ?> <br><small style="color: green;font-size:10px;"><?=$applied_coupons->coupan_code;?> Applied</small> <?php } ?>
                        </td>
                        <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?=number_format($coupon_discount, 2, '.', ','); ?></td>
                      </tr>
                    <?php } ?>
                    <?php if ($gift_discount > 0) { ?>
                      <tr class="tm_gray_bg " style="background: #0080002e;">
                        <td class="tm_width_3 tm_primary_color tm_bold">
                        Giftcard Discount <?php if(!empty($applied_giftcards)){ ?> <br><small style="color: green;font-size:10px;"><?=$applied_giftcards->gift_name;?> Applied</small> <?php } ?>
                        </td>
                        <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?=number_format($gift_discount, 2, '.', ','); ?></td>
                      </tr>
                    <?php } ?>
                    <?php if ($reward_discount > 0) { ?>
                      <tr class="tm_gray_bg " style="background: #0080002e;">
                        <td class="tm_width_3 tm_primary_color tm_bold">
                        Reward Discount <br><small style="color: green;font-size:10px;"><?=$single_payment_details->used_rewards;?> Rewards Used</small>
                        </td>
                        <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?=number_format($reward_discount, 2, '.', ','); ?></td>
                      </tr>
                    <?php } ?>
                    <?php if ($extra_discount > 0) { ?>
                      <tr class="tm_gray_bg " style="background: #0080002e;">
                        <td class="tm_width_3 tm_primary_color tm_bold">
                        Extra Discount
                        </td>
                        <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?=number_format($extra_discount, 2, '.', ','); ?></td>
                      </tr>
                    <?php } ?>
                    <?php if ($single_payment_details->total_discount_amount > 0) { ?>
                    <tr class="tm_gray_bg "  style="background: #0080002e;border-top: 1px solid #ccc;">
                      <td class="tm_width_3 tm_primary_color tm_bold">
                        Total Discount 
                      </td>
                      <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?=number_format($single_payment_details->total_discount_amount, 2, '.', ','); ?></td>
                    </tr>
                    <?php } ?>
                    <tr class="tm_gray_bg ">
                      <td class="tm_width_3 tm_primary_color tm_bold">Sub Total</td>
                      <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?=number_format($single_payment_details->booking_amount, 2, '.', ','); ?></td>
                    </tr>
                    <?php if($single_payment_details->is_gst_applicable == '1'){ ?>
                    <tr class="tm_gray_bg">
                      <td class="tm_width_3 tm_primary_color">GST <span class="tm_ternary_color">(<?=$single_payment_details->salon_gst_rate.'%'; ?>)</span></td>
                      <td class="tm_width_3 tm_primary_color tm_text_right"><?=number_format($single_payment_details->gst_amount, 2, '.', ','); ?></td>
                    </tr>
                    <?php } ?>
                    <tr class="tm_accent_bg">
                        <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color">Grand Total </td>
                        <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color tm_text_right"><?=number_format($single_payment_details->amount_to_paid, 2, '.', ','); ?></td>
                    </tr>
                    <?php if($single_payment_details->adjust_amount != ""){ ?>
                    <tr class="tm_gray_bg ">
                      <td class="tm_width_3 tm_primary_color tm_bold">Adjust Amount<?=$single_payment_details->adjust_amount_remark != '' ? '<br><small style="font-size: 65%;">(' . $single_payment_details->adjust_amount_remark . ')</small>' : ''; ?></td>
                      <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?=$single_payment_details->amount_round_type == 'Down' ? '-' : '+'; ?> <?=number_format($single_payment_details->adjust_amount, 2, '.', ','); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if($single_payment_details->rounded_bill_amount != ""){ ?>
                    <tr class="tm_gray_bg ">
                      <td class="tm_width_3 tm_primary_color tm_bold">Round Amount</td>
                      <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?=number_format($single_payment_details->rounded_bill_amount, 2, '.', ','); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if($single_payment_details->total_due_while_bill != ""){ ?>
                    <tr class="tm_gray_bg ">
                      <td class="tm_width_3 tm_primary_color tm_bold">Total Due Amount<br><small>(Including Prev. Due of Rs. <?=number_format($single_payment_details->opening_pending_amount, 2, '.', ','); ?>)</small></td>
                      <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?=number_format($single_payment_details->total_due_while_bill, 2, '.', ','); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if($single_payment_details->actual_paid_amount != ""){ ?>
                    <tr class="tm_accent_bg">
                        <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color">Actual Paid Amount </td>
                        <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color tm_text_right"><?=number_format($single_payment_details->actual_paid_amount, 2, '.', ','); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if($single_payment_details->customer_pending_amount != ""){ ?>
                    <tr class="tm_gray_bg ">
                      <td class="tm_width_3 tm_primary_color tm_bold">Current Due Amount</td>
                      <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?=number_format($single_payment_details->customer_pending_amount, 2, '.', ','); ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tm_invoice_footer tm_type1">
              <div class="tm_left_footer"></div>
              <div class="tm_right_footer">
                <div class="tm_sign tm_text_center">
                  <p class="tm_m0 tm_ternary_color"></p>
                </div>
              </div>
            </div>
          </div>
          <div class="tm_note tm_text_center tm_font_style_normal">
            <hr class="tm_mb15">
            <p class="tm_mb2"><b class="tm_primary_color">Terms & Conditions:</b></p>
            <p class="tm_m0">This is a computer-generated receipt; no signature is required.</p>
          </div>
        </div>
      </div>
      <div class="tm_invoice_btns tm_hide_print">
        <button id="tm_download_btn" class="tm_invoice_btn tm_color2">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
          </span>
          <span class="tm_btn_text">Download</span>
        </button>
        <?php if(!isset($_GET['mobile'])){ ?>
        <?php if(isset($_GET['go']) && base64_decode($_GET['go']) != ""){ ?>
          <a href="<?=base64_decode($_GET['go']);?>" class="tm_invoice_btn tm_color1">
        <?php }elseif(isset($_GET['list'])){ ?>
          <a href="<?=base_url()?>booking-list" class="tm_invoice_btn tm_color1">
        <?php }else{ ?>
          <a href="<?=base_url()?>salon-dashboard-new" class="tm_invoice_btn tm_color1">
        <?php } ?>
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512" transform="rotate(90)">
              <path d="M256 504a16 16 0 01-11.31-4.69L4.69 267.31a16 16 0 0122.62-22.62L256 463.4l228.69-218.71a16 16 0 0122.62 22.62L267.31 499.31A16 16 0 01256 504z"/>
            </svg>
          </span>
          <span class="tm_btn_text">Back</span>
        </a>
        <?php } ?>
      </div>
    </div>
  </div> <?php }}?>
  <script src="<?=base_url();?>invoice_assests/jquery.min.js"></script>
  <script src="<?=base_url();?>invoice_assests/jspdf.min.js"></script>
  <script src="<?=base_url();?>invoice_assests/html2canvas.min.js"></script>
  <script src="<?=base_url();?>invoice_assests/main.js"></script>
  
  <?php if(isset($_GET['print'])){ ?>
    <script>
      $(document).ready(function(){
        $('#tm_download_btn').trigger('click');
      });
    </script>
  <?php } ?>
</body>
</html> 
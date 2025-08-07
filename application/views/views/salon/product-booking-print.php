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
    <?php if(!empty($single_profile) && !empty($single_payment_details) && !empty($single)){ 
      $reward_discount = is_numeric($single_payment_details->reward_discount_amount) ? floatval($single_payment_details->reward_discount_amount) : 0;
      $m_product_discount = is_numeric($single_payment_details->m_product_discount_amount) ? floatval($single_payment_details->m_product_discount_amount) : 0;
      
      $total_discount = $reward_discount + $m_product_discount;
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
                     <th class="tm_width_3 tm_semi_bold tm_white_color">Sr. No.</th>
                      <th class="tm_width_4 tm_semi_bold tm_white_color">Product</th>
                      <th class="tm_width_2 tm_semi_bold tm_white_color">Rate</th>
                      <th class="tm_width_4 tm_semi_bold tm_white_color">Quantity</th>
                      <th class="tm_width_2 tm_semi_bold tm_white_color">Total Price</th>
                      <th class="tm_width_4 tm_semi_bold tm_white_color">Stylist</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $i = 1;
                      if(!empty($single_bill_products)){ 
                        foreach($single_bill_products as $single_bill_products_result){
                          $stylist_details = $this->Salon_model->get_stylist_details($single_bill_products_result->stylist_after_bill);
                    ?>
                    <tr>
                      <td class="tm_width_3"><?=$i++; ?></td>
                      <td class="tm_width_4"><?=$single_bill_products_result->product_name;?></td>
                      <td class="tm_width_2"><?=$single_bill_products_result->single_product_price != "" ? $single_bill_products_result->single_product_price : '0.00'; ?></td>
                      <td class="tm_width_4"><?=$single_bill_products_result->quantity_after_bill;?></td>
                      <td class="tm_width_2"><?=$single_bill_products_result->total_product_price_after_bill != "" ? $single_bill_products_result->total_product_price_after_bill : '0.00'; ?></td>
                      <td class="tm_width_4"><?=!empty($stylist_details) ? $stylist_details->full_name : '-';?></td>
                    </tr> 
                    <?php }} ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tm_invoice_footer tm_border_top tm_mb15 tm_m0_md">
              <div class="tm_left_footer" style="width:40% ;margin-top:50px ;">
                <p class="tm_mb2"><b class="tm_primary_color">Payment info:</b></p>
                <?php if($single_payment_details->is_gst_applicable == '1'){ ?>
                  <p class="tm_m0">GSTIN: <?=$single_payment_details->salon_gst_no != "" ? $single_payment_details->salon_gst_no : '-';?></p>
                <?php } ?>
                <p class="tm_m0">Payment By:</p>
                <p class="tm_m0">Mode: <?=$single_payment_details->payment_mode;?></p>
                <?php if($single_payment_details->transaction_id != ""){ ?><p class="tm_m0">Transaction ID: <?=$single_payment_details->transaction_id;?></p> <?php } ?>
              </div>
              <div class="tm_right_footer" style="width:60% ;margin-top:50px ;">
                <table class="tm_mb15">
                  <tbody>
                    <tr class="tm_gray_bg ">
                      <td class="tm_width_3 tm_primary_color tm_bold">Product Amt</td>
                      <td class="tm_width_3 tm_primary_color tm_bold tm_text_right">
                          <?=$single_payment_details->total_product_price;?>
                      </td>
                    </tr>
                    <tr class="tm_gray_bg ">
                      <td class="tm_width_3 tm_primary_color tm_bold">
                        Discount <small>(-)</small>
                        <div id="discount_details_div" style="position: relative;display:inline-block; width:auto;">
                          <div id="discount_details_info"><i class="fas fa-info-circle" style="color:#0000ffb0;"></i>
                            <div class="discount-tooltip">
                              <?php if ($m_product_discount > 0) { ?>
                                <p>Membership Product Discount <span class="amount" style="float: right;"><?=$m_product_discount; ?></span></p>
                              <?php } 
                                if ($reward_discount > 0) { ?>
                                <p>Reward Discount <span class="amount" style="float: right;"><?=$reward_discount;?></span></p>
                              <?php } ?>
                                <div style="border-top:1px solid #ccc;margin-top:1px;"><p>Total Discount <span class="amount" style="float: right;"><?=$single_payment_details->total_discount_amount; ?></span></p></div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?=$single_payment_details->total_discount_amount; ?></td>
                    </tr>
                    <tr class="tm_gray_bg ">
                      <td class="tm_width_3 tm_primary_color tm_bold">Sub Total</td>
                      <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?=$single_payment_details->booking_amount; ?></td>
                    </tr>
                    <?php if($single_payment_details->is_gst_applicable == '1'){ ?>
                    <tr class="tm_gray_bg">
                      <td class="tm_width_3 tm_primary_color">GST <span class="tm_ternary_color">(<?=$single_payment_details->salon_gst_rate.'%'; ?>)</span></td>
                      <td class="tm_width_3 tm_primary_color tm_text_right"><?=$single_payment_details->gst_amount; ?></td>
                    </tr>
                    <?php } ?>
                    <tr class="tm_accent_bg">
                        <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color">Grand Total </td>
                        <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color tm_text_right"><?=$single_payment_details->amount_to_paid; ?></td>
                    </tr>
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
            <p class="tm_m0">This is a computer-generated receipt; no signature is required<br>.</p>
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
          <a href="<?=base_url()?>salon-dashboard-new" class="tm_invoice_btn tm_color1">
  <span class="tm_btn_icon">
    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512" transform="rotate(90)">
      <path d="M256 504a16 16 0 01-11.31-4.69L4.69 267.31a16 16 0 0122.62-22.62L256 463.4l228.69-218.71a16 16 0 0122.62 22.62L267.31 499.31A16 16 0 01256 504z"/>
    </svg>
  </span>
  <span class="tm_btn_text">Back</span>
</a>
      </div>
    </div>
  </div> <?php }?>
  <script src="<?=base_url();?>invoice_assests/jquery.min.js"></script>
  <script src="<?=base_url();?>invoice_assests/jspdf.min.js"></script>
  <script src="<?=base_url();?>invoice_assests/html2canvas.min.js"></script>
  <script src="<?=base_url();?>invoice_assests/main.js"></script>

</body>
</html> 
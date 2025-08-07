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
  <?php 
  if(!empty($single_payment_details)){ 
    $subscription_details = $this->Admin_model->get_subscription_allocation_details($single_payment_details->subscription_allocation_id);
    $branch_formatted = sprintf('%03d', $single_payment_details->branch_id);
    $salon_formatted = sprintf('%03d', $single_payment_details->salon_id);
    $count_formatted = sprintf('%04d', $single_payment_details->id);
  ?>
  <div class="tm_container">
    <div class="tm_invoice_wrap">
      <div class="tm_invoice tm_style1 tm_type1" id="tm_download_section">
        <div class="tm_invoice_in">
          <div class="tm_invoice_head tm_top_head tm_mb15 tm_align_center">
            <div class="tm_invoice_left">
              <div class="tm_logo"><img src="<?=base_url();?>assets/images/napito_logo.jpg" style="max-height: 107px;" alt=""></div>
            </div>
            <div class="tm_invoice_right tm_text_right tm_mobile_hide">
              <div class="tm_f50 tm_text_uppercase tm_white_color">Tax Invoice</div>
            </div>
            <div class="tm_shape_bg tm_accent_bg tm_mobile_hide" style="width:84%;"></div>
          </div>
          <div class="tm_invoice_info tm_mb25">
            <div class="tm_card_note tm_mobile_hide"><b class="tm_primary_color">Date: </b><?php echo $single_payment_details->payment_date != "" ? date("d/m/Y",strtotime($single_payment_details->payment_date)) : '-'; ?><br><b class="tm_primary_color">Payment Status: </b>Complete</div>
            <div class="tm_invoice_info_list tm_white_color">
              <p class="tm_invoice_number tm_m0">Invoice No: 
                <b>
                  <?php
                    $total_count = $this->Admin_model->get_year_booking_count($single_payment_details->created_on,$single_payment_details->id);
                    $year = date('Y',strtotime($single_payment_details->created_on));
                    $month = date('m',strtotime($single_payment_details->created_on));

                    if ((int)$month >= 4) {
                      $fy_start = (int)$year % 100;
                      $fy_end = $fy_start + 1;
                    } else {
                      $fy_end = (int)$year % 100;
                      $fy_start = $fy_end - 1;
                    }
                    $financial_year = 'FY' . sprintf('%02d', $fy_start) . '-' . sprintf('%02d', $fy_end);
                    $count_formatted = sprintf('%04d', $total_count);
                    $invoice_id = 'NAP-GST-' . $financial_year . '-' . $count_formatted;
                    echo $invoice_id;
                  ?>
                  <!-- <?=$single_payment_details->invoice_id != "" ? $single_payment_details->invoice_id : 'NSP-' . $branch_formatted . '' . $salon_formatted . '' . $count_formatted; ?> -->
                </b>
              </p>
              <p class="tm_invoice_date tm_m0">HSN/SAC Code: <b>998313</b></p>
            </div>
            <div class="tm_invoice_seperator tm_accent_bg" style="width:70.5%;margin-right: -7px;"></div>
          </div>
          <div class="tm_invoice_head tm_mb10" style="height:150px;">
            <div class="tm_invoice_left">
			 <p class="tm_mb2"><b class="tm_primary_color">Receipt To:</b></p>
              <p>
                <?=$single_payment_details->branch_name?><br>
                <?=$single_payment_details->salon_number?><br>
                <?=$single_payment_details->email?>
              </p>
            </div>
            <div class="tm_invoice_right tm_text_right">
              <p class="tm_mb2"><b class="tm_primary_color">Pay To:</b></p>
              <p>
                  Schedule Savvy Solution Pvt. Ltd. <br>
                  +91 8806499090 <br>
                  schedulesavvy10@gmail.com <br>
                  H. NO. 2373, NEWASA KH, <br>
                  Nevasa, Ahilya Nagar, 414603
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
                      <th class="tm_width_3 tm_semi_bold tm_white_color" style="width:45%;text-align:left;">Details</th>
                        <th class="tm_width_4 tm_semi_bold tm_white_color" style="width:25%;text-align:left;">Amount</th>
                        <th class="tm_width_4 tm_semi_bold tm_white_color" style="width:15%;text-align:left;">Coins Discount</th>
                        <th class="tm_width_4 tm_semi_bold tm_white_color" style="width:15%;text-align:left;">Paid Amount</th>
                      </tr>
                    </thead>
                    <?php if($single_payment_details->payment_type == '0'){ ?>
                    <tbody>
                      <tr>
                        <th class="tm_width_3" style="width:45%;text-align:left;">
                          Napito Annual Subscription <?= !empty($subscription_details) ? '<small>(' . $subscription_details->subscription_name . ')</small>' : ''; ?><br>
                          <small><?= !empty($subscription_details) ? date('d M, Y h:i A', strtotime($subscription_details->subscription_start)) : ''; ?> To <?= !empty($subscription_details) ? date('d M, Y h:i A', strtotime($subscription_details->subscription_end)) : ''; ?><small>
                        </th>
                        <th class="tm_width_2" style="width:25%;text-align:left;">
                          <?= !empty($subscription_details) ? '₹ ' . $subscription_details->subscription_price : ''; ?>
                          <br><small>(Inc. 9% CGST & 9% SGST)</small>
                        </th>
                        <th class="tm_width_2" style="width:15%;text-align:left;">
                          <?='₹ ' . $single_payment_details->coin_balance_used_in_rs;?><br>
                          <?=$single_payment_details->coin_balance_used != "" && $single_payment_details->coin_balance_used > 0 ? '<small>(' . $single_payment_details->coin_balance_used . ' Coins Used)</small>' : '';?>
                        </th>
                        <th class="tm_width_2" style="width:15%;text-align:left;"><?='₹ ' . $single_payment_details->payment_amount;?></th>
                      </tr> 
                    </tbody>
                    <?php }else{ ?>
                    <tbody>
                      <tr>
                        <th class="tm_width_3" style="width:45%;text-align:left;">
                          Whatsapp Add-On Plan <?='<small>(' . $single_payment_details->plan_name . ')</small>'; ?><br>
                          Qty: <?=$single_payment_details->plan_qty;?> Coins
                        </th>
                        <th class="tm_width_2" style="width:25%;text-align:left;">
                          <?='₹ ' . $single_payment_details->plan_price;?>
                          <br><small>(Inc. 9% CGST & 9% SGST)</small>
                        </th>
                        <th class="tm_width_2" style="width:15%;text-align:left;">
                          <?='₹ ' . $single_payment_details->coin_balance_used_in_rs;?><br>
                          <?=$single_payment_details->coin_balance_used != "" && $single_payment_details->coin_balance_used > 0 ? '<small>(' . $single_payment_details->coin_balance_used . ' Coins Used)</small>' : '';?>
                        </th>
                        <th class="tm_width_2" style="width:15%;text-align:left;"><?='₹ ' . $single_payment_details->payment_amount;?></th>
                      </tr> 
                    </tbody>
                    <?php } ?>
                  </table>
              </div>
            </div>
            <div class="tm_invoice_footer tm_border_top tm_mb15 tm_m0_md">
              <div class="tm_left_footer" style="width:50% ;margin-top:50px ;">
                <p class="tm_mb2"><b class="tm_primary_color">Payment info:</b></p>
                <p class="tm_m0">GST No: 27ABLCS8528A1Z6</p>
                <p class="tm_m0">Payment By: <?=$single_payment_details->full_name;?></p>
                <p class="tm_m0">Mode: </p>
                <p class="tm_m0">Transaction ID: </p>
              </div>
              <div class="tm_right_footer" style="width:50% ;margin-top:50px ;">
                <table class="tm_mb15">
                  <tbody>
                    <!-- <tr class="tm_gray_bg "  style="background: #0080002e;border-top: 1px solid #ccc;">
                      <td class="tm_width_3 tm_primary_color tm_bold">Coins Discount </td>
                      <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"> <?=$single_payment_details->coin_balance_used_in_rs;?></td>
                    </tr> -->
                    <tr class="tm_accent_bg">
                        <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color">Total Amount<br><small>(Inc. Taxes)</small></td>
                        <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color tm_text_right"><?='₹ ' . $single_payment_details->payment_amount;?></td>
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
      </div>
    </div>
  </div>
  <?php } ?>
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
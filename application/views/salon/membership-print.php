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
  </style>
<?php if(!empty($customer_amount)){
		$single_profile = $this->Salon_model->get_single_branch_profile_all($customer_amount->branch_id,$customer_amount->salon_id);
		$branch_profile = $this->Salon_model->get_all_salon_profile_single_all($customer_amount->branch_id,$customer_amount->salon_id);
?>

    <?php if(!empty($single_profile)){?>
  <div class="tm_container">
    <div class="tm_invoice_wrap">
      <div class="tm_invoice tm_style1 tm_type1" id="tm_download_section">
        <div class="tm_invoice_in">
          <div class="tm_invoice_head tm_top_head tm_mb15 tm_align_center">
            <div class="tm_invoice_left">
              <div class="tm_logo"><img src="<?=base_url();?>admin_assets/images/store_logo/<?=$single_profile->store_logo?>" style="max-height: 107px;" alt="Logo"></div>
            </div>
            <div class="tm_invoice_right tm_text_right tm_mobile_hide">
              <div class="tm_f50 tm_text_uppercase tm_white_color">Receipt</div>
            </div>
            <div class="tm_shape_bg tm_accent_bg tm_mobile_hide"></div>
          </div>
          <div class="tm_invoice_info tm_mb25">
            <div class="tm_card_note tm_mobile_hide"><b class="tm_primary_color">Payment Status: </b><?php if($customer_amount->payment_status == '1'){ echo 'Completed'; }else{ echo 'Pending'; } ?></div>
            <div class="tm_invoice_info_list tm_white_color">
              <p class="tm_invoice_number tm_m0" >Receipt No: <b><?=$single_profile->salon_id?><?=$single_profile->id?><?=$single_profile->id?><?=$customer_amount->id?> </b></p>
              <p class="tm_invoice_date tm_m0" >Date: <b><?php echo ($customer_amount->payment_date != "") ? date('d/m/Y',strtotime($customer_amount->payment_date)) : '-'; ?></b></p>
            </div>
            <div class="tm_invoice_seperator tm_accent_bg"></div>
          </div>
          <div class="tm_invoice_head tm_mb10" style="height: 100px;">
            <div class="tm_invoice_left">
			 <p class="tm_mb2"><b class="tm_primary_color">Receipt To:</b></p>
              <p>
                Name: <?=$customer_amount->full_name?><br>
                Membership: <?=$customer_amount->membership_name?>
                <?php if($customer_amount->address != ""){ ?><br>Address: <?=$customer_amount->address?><?php } ?><br>
                Mobile: <?=$customer_amount->customer_phone?>
                <?php if($customer_amount->address != ""){ ?><br>Email: <?=$customer_amount->email?><?php } ?>
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
                      <th class="tm_width_4 tm_semi_bold tm_white_color"style="width:25%;">Description</th>
                      <th class="tm_width_2 tm_semi_bold tm_white_color" style="width:30%;">Membership</th>
                      <th class="tm_width_2 tm_semi_bold tm_white_color" style="width:20%;">Validity Period</th>
                      <th class="tm_width_1 tm_semi_bold tm_white_color" style="width:25%;text-align:right;">Amount</th>
                    </tr>
                  </thead>
                  <?php $sold_by = $this->Salon_model->get_single_emp_details($customer_amount->employee_id); ?>
                  <tbody>
                    <tr>
						<td class="tm_width_4" style="width:25%;"><b>Membership Payment</b></td>
						<td class="tm_width_2" style="width:30%;">
              <b><?=$customer_amount->membership_name?></b>
              <p>
                <small>
              <?php 
                if($customer_amount->discount_in == '0'){ 
                  echo $customer_amount->service_discount . '% Discount on Services & ' . $customer_amount->product_discount . '% Discount on Products';
                }elseif($customer_amount->discount_in == '1'){
                  echo 'Rs. ' . $customer_amount->service_discount . ' Discount on Services & Rs. ' . $customer_amount->product_discount . ' Discount on Products';
                }
              ?> 
                </small>
              </p>
            </td>
						<td class="tm_width_2" style="width:20%;"><b><?= ($customer_amount->membership_start != "" && $customer_amount->membership_end != "") ? date('d M Y',strtotime($customer_amount->membership_start)).' to '.date('d M Y',strtotime($customer_amount->membership_end)) : '-';?></b></td>
						<td class="tm_width_2 tm_text_right" style="width:25%;"><b><?=number_format((float)$customer_amount->membership_price, 2, '.', ',')?></b></td>
                    </tr> 
                  </tbody>
                </table>
              </div> 
            </div>
            <div class="tm_invoice_footer tm_border_top tm_mb15 tm_m0_md">
              <div class="tm_left_footer" style="width:35%;">
                <p class="tm_mb2"><b class="tm_primary_color">Payment info:</b></p>
                <?php if($customer_amount->is_counter == "Yes"){ echo '<p>Sold By: Counter Sale</p>'; } ?>
                <?php if($customer_amount->payment_mode != ""){ ?>
                  <?php if($customer_amount->is_gst_applicable == '1'){ ?>
                    <p class="tm_m0">GSTIN: <?=$customer_amount->salon_gst_no != "" ? $customer_amount->salon_gst_no : '-';?></p>
                  <?php } ?>
                  <p class="tm_m0">Payment Mode: <?=$customer_amount->payment_mode?></p>
                  <p class="tm_m0"><?=!empty($sold_by) ? 'Sold By: '.$sold_by->full_name : ''?></p>
                  <?php }elseif($customer_amount->payment_mode_multiple != ""){ ?>
                <table>
                <?php if($customer_amount->is_gst_applicable == '1'){ ?>
                    <tr>
                      <td style="border: none;padding: 0px 5px;"><small>GSTIN: <?=$customer_amount->salon_gst_no != "" ? $customer_amount->salon_gst_no : '-';?></td>
                    </tr>
                    <tr>
                      <td style="border: none;padding: 0px 5px;"><small><?=!empty($sold_by) ? 'Sold By: '.$sold_by->full_name : ''?></td>
                    </tr>
                  <?php
                }
                    $payment_mode_multiple = explode(',',$customer_amount->payment_mode_multiple);
                    $payment_transaction_id_multiple = explode(',',$customer_amount->payment_transaction_id_multiple);
                    $payment_amount_multiple = explode(',',$customer_amount->payment_amount_multiple);
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
                  <?php if ($customer_amount->discount_in_rs > 0) { ?>
                    <tr class="tm_gray_bg "  style="background: #0080002e;border-top: 1px solid #ccc;">
                      <td class="tm_width_3 tm_primary_color tm_bold">Discount</td>
                      <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?=number_format((float)$customer_amount->discount_in_rs, 2, '.', ',')?></td>
                    </tr>
                    <?php } ?>
                    <!-- <tr class="tm_gray_bg ">
                      <td class="tm_width_3 tm_primary_color tm_bold">Subtotal</td>
                      <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?=$customer_amount->membership_price - ($customer_amount->discount_in_rs != "" ? $customer_amount->discount_in_rs : 0.00)?></td>
                    </tr> -->
                    <?php if($customer_amount->is_gst_applicable == '1'){ ?>
                             <tr class="tm_gray_bg">
                                <td class="tm_width_3 tm_primary_color">GST <span class="tm_ternary_color">(<?=$customer_amount->salon_gst_rate.'%'; ?>)</span></td>
                                <td class="tm_width_3 tm_primary_color tm_text_right"><?php echo number_format((float)$customer_amount->gst_amount, 2, '.', ','); ?></td>
                            </tr>
                    <?php } ?>
                            <tr class="tm_accent_bg">
                                <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color">Grand Total </td>
                                <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color tm_text_right"><?php echo number_format((float)$customer_amount->membership_price - ($customer_amount->discount_in_rs != "" ? $customer_amount->discount_in_rs : 0.00) + $customer_amount->gst_amount, 2, '.', ','); ?></td>
                            </tr>
                            <?php if($customer_amount->adjust_amount != ""){ ?>
                            <tr class="tm_gray_bg ">
                              <td class="tm_width_3 tm_primary_color tm_bold">Adjust Amount<?=$customer_amount->adjust_amount_remark != '' ? '<br><small style="font-size: 65%;">(' . $customer_amount->adjust_amount_remark . ')</small>' : ''; ?></td>
                              <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?=$customer_amount->amount_round_type == 'Down' ? '-' : '+'; ?> <?=number_format($customer_amount->adjust_amount, 2, '.', ','); ?></td>
                            </tr>
                            <?php } ?>
                            <?php if($customer_amount->rounded_bill_amount != ""){ ?>
                            <tr class="tm_gray_bg ">
                              <td class="tm_width_3 tm_primary_color tm_bold">Round Amount</td>
                              <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?=number_format($customer_amount->rounded_bill_amount, 2, '.', ','); ?></td>
                            </tr>
                            <?php } ?>
                            <?php if($customer_amount->opening_pending_amount != ""){ ?>
                            <tr class="tm_gray_bg ">
                              <td class="tm_width_3 tm_primary_color tm_bold">Total Due Amount<br><small>(Including Prev. Due of Rs. <?=number_format($customer_amount->opening_pending_amount, 2, '.', ','); ?>)</small></td>
                              <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?=number_format(($customer_amount->opening_pending_amount + ($customer_amount->rounded_bill_amount != "" ? $customer_amount->rounded_bill_amount : 0)), 2, '.', ','); ?></td>
                            </tr>
                            <?php } ?>
                            <?php if($customer_amount->paid_amount != ""){ ?>
                            <tr class="tm_accent_bg">
                                <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color">Actual Paid Amount </td>
                                <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color tm_text_right"><?=number_format($customer_amount->paid_amount, 2, '.', ','); ?></td>
                            </tr>
                            <?php } ?>
                            <?php if($customer_amount->closing_pending_amount != ""){ ?>
                            <tr class="tm_gray_bg ">
                              <td class="tm_width_3 tm_primary_color tm_bold">Current Due Amount</td>
                              <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"><?=number_format($customer_amount->closing_pending_amount, 2, '.', ','); ?></td>
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
                  <!--<img src="assets/img/sign.svg" alt="Sign">-->
                  <p class="tm_m0 tm_ternary_color"></p>
                  <!-- <p class="tm_m0 tm_f16 tm_primary_color"> Itanagar, Arunachal Pradesh</p> -->
                </div>
              </div>
            </div>
          </div>
          <div class="tm_note tm_text_center tm_font_style_normal">
            <hr class="tm_mb15">
            <p class="tm_mb2"><b class="tm_primary_color">Terms & Conditions:</b></p>
            <p class="tm_m0">This is a computer-generated receipt; no signature is required<br>.</p>
          </div><!-- .tm_note -->
        </div>
      </div>
      <div class="tm_invoice_btns tm_hide_print">
        <!--<a href="javascript:window.print()" class="tm_invoice_btn tm_color1">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><circle cx="392" cy="184" r="24" fill='currentColor'/></svg>
          </span>
          <span class="tm_btn_text">Print</span>
        </a>-->
        <button id="tm_download_btn" class="tm_invoice_btn tm_color2">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
          </span>
          <span class="tm_btn_text">Download</span>
        </button>
        <?php if(!isset($_GET['mobile'])){ ?>
            <a href="<?=base_url()?>asign-membership-list" class="tm_invoice_btn tm_color1">
            <span class="tm_btn_icon">
              <!-- Replace the following SVG code with your "give back" icon or path -->
              <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512" transform="rotate(90)">
                <path d="M256 504a16 16 0 01-11.31-4.69L4.69 267.31a16 16 0 0122.62-22.62L256 463.4l228.69-218.71a16 16 0 0122.62 22.62L267.31 499.31A16 16 0 01256 504z"/>
              </svg>
            </span>
            <span class="tm_btn_text">Back</span>
          </a>
      <?php } ?>
      </div>
    </div>
  </div> <?php }} ?>
  <script src="<?=base_url();?>invoice_assests/jquery.min.js"></script>
  <script src="<?=base_url();?>invoice_assests/jspdf.min.js"></script>
  <script src="<?=base_url();?>invoice_assests/html2canvas.min.js"></script>
  <script src="<?=base_url();?>invoice_assests/main.js"></script>

</body>
</html> 
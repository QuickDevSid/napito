<?php include('header.php');?>
<style type="text/css">
    .photo-btn {
        border: solid 2px lightblue;
        border-radius: 3px;
    }

    .photo-btn a {
        text-decoration: none;
    }

    .btn_disapprove span {
        background-color: #e52525;
        color: black;
        border-radius: 4px;
        padding: 10px;
        font-weight: 600;
    }

    .btn_approve span {
        background-color: #42b342de;
        color: black;
        border-radius: 4px;
        padding: 10px;
        font-weight: 600;
    }

    .popup {
        width: 100%;
        height: 100%;
        display: none;
        position: fixed;
        top: 0px;
        left: 0px;
        background: rgba(0, 0, 0, 0.75);
        z-index: 999;
    }

    .popup-inner {
        max-width: 700px;
        width: 90%;
        padding: 20px;
        position: absolute;
        top: 30%;
        left: 50%;
        /* -moz-transform: translate(-50%, -50%); */
        /* -webkit-transform: translate(-50%, -50%); */
        transform: translate(-50%, -50%);
        box-shadow: 0px 2px 6px rgba(0, 0, 0, 1);
        border-radius: 3px;
        background: #fff;
    }
    .popup-close:hover {
    background: rgba(0,0,0,1);
    text-decoration: none;
    color: #fff;
    }
    #fees_amount{
        margin-left: 0px !important;
    }
</style>
            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                                Pending Services List
                            </h3>
                        </div>

                        <!-- <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <!-- <div class="clearfix"></div> -->

                    <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <!-- <div class="x_title">
                                
                                    <div class="clearfix"></div>
                                </div> -->
                    <div class="x_content">
                        <form method="post" name="approve" id="approve">
                            <button type="submit" name="sent_btn" id="sent_btn" class="btn btn-primary row-btns" value="sent_btn">Approve</button>
                            <br>
                            <table id="example" class="table table-striped responsive-utilities jambo_table">
                                <thead>
                                    <tr class="headings">
                                        <th>
                                            Sr. No.
                                        </th>
                                        <th>
                                            <input type="checkbox" class="tableflat" id="toggle-all">
                                        </th>
                                        <th>Branch</th>
                                        <th>Service</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Price</th>
                                        <th>Duration</th>
                                        <th>Gender</th>
                                        <th>Products</th>
                                        <th>Is Special</th>
                                        <th>Image</th>
                                        <th>Added On</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                        <tbody>
                                            <?php 
                                            // echo "<pre>";print_r($disaprove_services);exit;
                                            if(!empty($disaprove_services)){
                                                $i=1;
                                                    foreach($disaprove_services as $disaprove_services_result){
                                                        $products_text = '';
                                                        $branch_name = $this->Salon_model->get_current_branch($disaprove_services_result->branch_id);
                                                        $salon_name = $this->Salon_model->get_current_salon($disaprove_services_result->salon_id);
                                                        $service_products = $this->Admin_model->get_service_products_in(
                                                            $disaprove_services_result->product != "" ? explode(',', $disaprove_services_result->product) : [],
                                                            $disaprove_services_result->branch_id,
                                                            $disaprove_services_result->salon_id
                                                        );
                                                    
                                                        if (!empty($service_products)) {
                                                            $product_count = 0;
                                                            foreach ($service_products as $service_products_Result) {
                                                                $product_name = $service_products_Result->product_name;
                                                                $products_text .= $product_name;
                                                    
                                                                $product_count++;
                                                                if ($product_count < count($service_products)) {
                                                                    $products_text .= ', ';
                                                                }
                                                    
                                                                if ($product_count % 2 == 0) {
                                                                    $products_text .= "<br>";
                                                                }
                                                            }
                                                        }
                                            ?>
                                            <tr>
                                                <td scope="row"><?=$i++?></td>
                                                <td><input name="ids[]" type="checkbox" class="checkbox" value="<?=$disaprove_services_result->id?>" <?php if($disaprove_services_result->status == 1){?>checked="checked"<?php }?>></td>
                                                <td>
                                                    <?php if(!empty($salon_name)){
                                                        foreach($salon_name as $salon_name_result){?>
                                                            <?=$salon_name_result->salon_name?>
                                                    <?php }}?>
                                                     <?php if(!empty($branch_name)){
                                                        foreach($branch_name as $branch_name_result){?>
                                                           , <?=$branch_name_result->branch_name?>
                                                    <?php }}?>
                                                </td>
                                                <td><?=$disaprove_services_result->service_name?><?=$disaprove_services_result->service_name_marathi != "" ? '|' . $disaprove_services_result->service_name_marathi : ''; ?></td>
                                                <td><?=$disaprove_services_result->sup_category?><?=$disaprove_services_result->sup_category_marathi != "" ? '|' . $disaprove_services_result->sup_category_marathi : ''; ?></td>
                                                <td><?=$disaprove_services_result->subcategory?><?=$disaprove_services_result->sub_category_marathi != "" ? '|' . $disaprove_services_result->sub_category_marathi : ''; ?></td>
                                                <td><?=$disaprove_services_result->final_price != "" ? $disaprove_services_result->final_price : '-'; ?></td>
                                                <td><?=$disaprove_services_result->service_duration != "" ? $disaprove_services_result->service_duration . ' Mins' : '-'; ?></td>
                                                <td><?=$disaprove_services_result->gender == '0' ? 'Male' : ($disaprove_services_result->gender == '1' ? 'Female' : '-')?></td>
                                                <td><?=$products_text != "" ? $products_text : '-'; ?></td>
                                                <td><?=$disaprove_services_result->is_special == '1' ? 'Yes' : 'No'; ?></td>
                                                <td><?=$disaprove_services_result->category_image != '' ? '<a href="'.base_url().'admin_assets/images/service_image/'.$disaprove_services_result->category_image.'" download><img style="width: 50%;" src="'.base_url().'admin_assets/images/service_image/'.$disaprove_services_result->category_image.'"></a>' : '-'; ?></td>
                                                <td><?=$disaprove_services_result->created_on != "" ? date('d-m-Y h:i A',strtotime($disaprove_services_result->created_on)) : '-'; ?></td>
                                                <td>
                                                    <a class="btn_info" href="<?=base_url()?>add-admin-service/<?=$disaprove_services_result->id?>?pending"><span>Edit</span></a> 
                                                    <?php if($disaprove_services_result->status == "0"){?>
                                                        <a class="btn_approve" onclick="return confirm('Are you sure you want to approve this service?');" href="<?=base_url()?>approve/<?=$disaprove_services_result->id?>/tbl_salon_emp_service"><span>Approve</span></a> 
                                                    <?php }?>
                                                    <a style="cursor: pointer;" onclick="get_id(<?=$disaprove_services_result->id?>)" data-popup-open="popup-1" class="btn_disapprove"><span>Reject</span></a>
                                                </td>
                                            </tr>
                                        <?php }}?>

                                        </tbody>

                                    </table>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <br />
                        <br />
                        <br />

                    </div>
                </div>
                            <div id="bokking_detail_model" class="popup" data-popup="popup-1">
                                <div class="popup-inner">
                                    <div class="row">
                                        <div class="col-md-12 stylist_name_id"></div><br>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <form method="post" name="reason_form" id="reason_form" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="form-group col-md-12 col-sm-64 col-xs-12">
                                                    <label>Add Reason<b class="require">*</b></label>
                                                    <textarea type="text" class="form-select form-control" name="reject_reason" id="reject_reason" placeholder="Enter reason why you reject this service"></textarea>  
                                                    <input type="hidden" name="id" id="id"> 
                                                </div>
                                            </div>
                                                <div class="row" style="margin-top: 10px;">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                                    <div  data-popup-close="popup-1" type="submit" id="submit" class="btn btn-danger">Cancel</div  data-popup-close="popup-1">
                                                    </div>
                                            </div>
                                        </form>
                                        </div>
                                        <div class="col-md-12 status_btn_content">
                                            
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            </div>
 <?php include('footer.php');?>

 <script>
    $(function() {
  // Open
  $('[data-popup-open]').on('click', function(e) {
    var targeted_popup_class = $(this).attr('data-popup-open');    
    $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);    
    e.preventDefault();
  });
  
  // Close
  $('[data-popup-close]').on('click', function(e) {
    var targeted_popup_class = $(this).attr('data-popup-close');
    $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
    e.preventDefault();
  });  
  
});

$(document).ready(function() {
        $('#reason_form').validate({
            rules: {
                reject_reason: {
                    required: true,
                },
            },
            messages: {
                reject_reason: {
                    required: "Please enter reject reason!",
                },

            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
<script>
    function get_id(s_id){
        $('#id').val(s_id);
    }
</script>

<script>
$('#example').DataTable({ 
 dom: 'Blfrtip',
responsive: true,
lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
 
    buttons: [
        {
            extend: 'excel',
            filename: 'admin-pending-salon-service-list',
            exportOptions: {
                columns: [0,2,3,4] 
            }
        },
        
        
    ], 
});
</script>
<script type="text/javascript">  
$(document).ready(function(){
  // Toggle all checkboxes
  $('#toggle-all').click(function(){
    $('.checkbox').prop('checked', $(this).prop('checked'));
  });
  
  // Toggle the "Toggle All" checkbox if all checkboxes are checked or unchecked
  $('.checkbox').click(function(){
    if($('.checkbox:checked').length == $('.checkbox').length){
      $('#toggle-all').prop('checked', true);
    } else {
      $('#toggle-all').prop('checked', false);
    }
  });
});
</script>
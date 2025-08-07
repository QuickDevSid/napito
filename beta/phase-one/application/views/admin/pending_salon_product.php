 <?php include('header.php');?>

 <style type="text/css">
    .photo-btn{
  border: solid 2px lightblue;
  border-radius: 3px;
}
.photo-btn a{
  text-decoration: none;
}
.btn_disapprove{
    display:block;
}
.btn_disapprove span{
    background-color: #e52525;
    color: #ffffff;
    border-radius: 5px;
    padding: 8px;
    font-weight: 600;
}
.btn_approve{
    display:block;
    margin-bottom:8px;
}
.btn_approve span{
    background-color: green;
    color: #ffffff;
    border-radius: 5px;
    padding: 8px;
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

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <form method="post" name="approve" id="approve">
                                    <button type="submit" name="sent_btn" id="sent_btn" class="btn btn-primary row-btns" value="sent_btn">Approve</button>
                                <br>

                                   <table id="example" class="table table-striped responsive-utilities jambo_table">
                                            <thead>
                                                <tr class="headings">
                                                    <th>Sr.No.</th>
                                                    <th>
                                                        <input type="checkbox" class="tableflat" id="toggle-all" onchange="allconfirmCheckbox(event)">
                                                    </th>
                                                    <th>Salon Name</th>
                                                    <th>Product Name</th>
                                                    <th>Category</th>
                                                    <th>Sub Category</th>
                                                    <!-- <th>Unit</th> -->
                                                    <th>HSN Code</th>
                                                    <th>Selling Price</th>
                                                    <th>Discount</th>
                                                    <th>Incentive</th>
                                                    <th>Status</th>
                                                    <!-- <th>Actions</th> -->
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                            //    echo "<pre>"; print_r($product);exit;
                                                if(!empty($product)){
                                                    $i=1;
                                                    foreach($product as $product_result){ 
                                                        $product_sub_category = $this->Admin_model->get_sub_category_details($product_result->product_subcategory);
                                                ?>
                                                <tr>
                                                    <td scope="row"><?=$i++?></td>
                                                    <td><input name="ids[]" type="checkbox" class="checkbox" value="<?=$product_result->id?>" onchange="confirmCheckbox(event, <?=$product_result->id?>)"  <?php if($product_result->status == 1){?>checked="checked"<?php }?>></td>
										
                                                    <td><?=$product_result->branch_name?></td> 
                                                    <td><?=$product_result->product_name?></td> 
                                                    <td><?=$product_result->product_category?></td>
                                                    <td><?=!empty($product_sub_category) ? $product_sub_category->product_sub_category : '-'; ?></td>
                                                    <!-- <td><?=$product_result->unit_name?></td> -->
                                                    <td><?=$product_result->hsn_code?></td>
                                                    <td><?=$product_result->selling_price?></td>
                                                    <td><?=$product_result->discount?></td>
                                                    <td><?=$product_result->incentive?></td>
                                                    <!-- <td>
														<a title="Activate Now" class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>admin_active/<?=$product_result->id?>/tbl_product"><i class="fa-solid fa-toggle-off"></i></a>
													</td>
													<td>
                                                        <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>admin_delete/<?=$product_result->id?>/tbl_product"><i class="fa-solid fa-trash"></i></a>    
                                                    </td> -->

                                                    <td>
                                                        <?php if($product_result->status == "0"){?>
                                                            <a class="btn_approve" onclick="return confirm('Are you sure you want to approve this service?');" href="<?=base_url()?>approve/<?=$product_result->id?>/tbl_product"><span>Approve</span></a> 
                                                        <?php }?>
                                                            <a style="cursor: pointer;" onclick="get_id(<?=$product_result->id?>)" data-popup-open="popup-1" class="btn_disapprove"><span>Reject</span></a>
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
                            <div class="col-md-12">
                            <form method="post" name="reason_form" id="reason_form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-12 col-sm-64 col-xs-12">
                                        <label>Add Reason<b class="require">*</b></label>
                                        <textarea type="text" class="form-select form-control" name="reject_reason" id="reject_reason" placeholder="Enter reason why you reject this service"></textarea>  
                                        <input type="hidden" name="id" id="id"> 
                                    </div>
                                </div>
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-12">
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
            $('#example').DataTable({ 
             dom: 'Blfrtip',
            responsive: false,
            lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
                buttons: [
                    {
                        extend: 'excel',
                        filename: 'product-list',
                        exportOptions: {
                            columns: [0,2,3,4,5,6,7,8,9,10] 
                        }
                    },
                    
                ], 
        });
        </script>
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

    function get_id(s_id){
        $('#id').val(s_id);
    }

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


<script>
    function confirmCheckbox(event, id) {
        if (!confirm('Are you sure you want to check this checkbox?')) {
            event.preventDefault();
            document.querySelector('input[type="checkbox"][value="' + id + '"]').checked = false;
        }
    }


    function allconfirmCheckbox(event) {
        if (!confirm('Are you sure you want to check all checkbox?')) {
            event.preventDefault();
            document.querySelector('input[type="checkbox"]').checked = false;

            $('.checkbox').prop('checked', false);      
        }
    }
</script>

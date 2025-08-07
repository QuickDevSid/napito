<?php include('header.php');?>
<style type="text/css">
    .photo-btn{
  border: solid 2px lightblue;
  border-radius: 3px;
}
.photo-btn a{
  text-decoration: none;
}
.btn_disapprove span{
    background-color: #e52525;
    color: black;
    border-radius: 5px;
    padding: 8px;
    font-weight: 600;
}
.btn_approve span{
    background-color: green;
    color: black;
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
            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                                Pending Services List
                            </h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th>
                                                    <input type="checkbox" class="tableflat">
                                                </th>
                                                <th>Salon Name</th>
                                                <th>Branch Name</th>
                                                <th>Service Name</th>
                                                <th>Status</th>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php if(!empty($disaprove_services)){
                                                $i=1;
                                                    foreach($disaprove_services as $disaprove_services_result){
                                                    $branch_name = $this->Salon_model->get_current_branch($disaprove_services_result->branch_id);
                                                    $salon_name = $this->Salon_model->get_current_salon($disaprove_services_result->salon_id);
                                            ?>
                                            <tr>
                                                <th scope="row"><?=$i++?></th>
                                                    <?php if(!empty($salon_name)){
                                                        foreach($salon_name as $salon_name_result){?>
                                                            <td><?=$salon_name_result->salon_name?></td>
                                                    <?php }}?>
                                                     <?php if(!empty($branch_name)){
                                                        foreach($branch_name as $branch_name_result){?>
                                                            <td><?=$branch_name_result->branch_name?></td>
                                                    <?php }}?>

                                                        <td><?=$disaprove_services_result->service_name?></td>
                                                        
                                                        <td>
                                                           <?php if($disaprove_services_result->status == "0"){?>
                                                                <a class="btn_approve" onclick="return confirm('Are you sure you want to approve this service?');" href="<?=base_url()?>approve/<?=$disaprove_services_result->id?>/tbl_salon_emp_service"><span>Approve</span></a> 
                                                            <?php }?>
                                                            <a style="curser: pinter;" onclick="get_id(<?=$disaprove_services_result->id?>)" data-popup-open="popup-1" class="btn_disapprove"><span>Reject</span></a>
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
<?php include('header.php'); ?>


</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left" style="width:100%;">
                <h3>
                    Consent Form
                    <button style="float:right;" type="button" onclick="showPopup('exampleModal','')" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Share Consent Form
                    </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document" style="width:900px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Share Consent Form</h5>
                                    <button style="margin-top:-20px;" type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closePopup('exampleModal')">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div id="response">
                                        <form method="post" name="master_form" id="master_form" enctype="multipart/form-data">
                                            <input type="hidden" id="consent_form_id" name="consent_form_id" value="">
                                            <div class="row">
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Client <b class="require">*</b></label>
                                                    <select class="form-control choosen" name="customer" id="customer">
                                                        <option value="">Select Client</option>
                                                        <?php
                                                        if(!empty($customer)){
                                                            foreach ($customer as $result) {
                                                                echo '<option value="' . $result->id . '">' . $result->full_name . ', ' . $result->customer_phone . '</option>';
                                                        }}
                                                        ?>
                                                    </select>
                                                    <label for="customer" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                                </div>   
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Client Requirement <b class="require">*</b></label>
                                                    <input type="text" class="form-control" name="requirement" id="requirement" 
                                                        value="<?php if (!empty($single)) { echo $single->requirement; } ?>" placeholder="Enter requirement">
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Client Purpose <b class="require">*</b></label>
                                                    <input type="text" class="form-control" name="purpose" id="purpose" 
                                                        value="" placeholder="Enter purpose">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Condition <b class="require">*</b></label>
                                                    <input type="text" class="form-control" name="condition" id="condition" 
                                                        value="" placeholder="Enter condition">
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Stylist Suggest <b class="require">*</b></label>
                                                    <input type="text" class="form-control" name="stylist_suggest" id="stylist_suggest" 
                                                        value="" placeholder="Enter stylist suggestion">
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Stylist Decide Result <b class="require">*</b></label>
                                                    <input type="text" class="form-control" name="stylist_decide_result" id="stylist_decide_result" 
                                                        value="" placeholder="Enter stylist decide result">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Stylist Name <b class="require">*</b></label>
                                                    <input type="text" class="form-control" name="stylist_name" id="stylist_name" 
                                                        value="" placeholder="Enter stylist name">
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Customer Decision <b class="require">*</b></label>
                                                    <input type="text" class="form-control" name="customer_decision" id="customer_decision" 
                                                        value="" placeholder="Enter customer decision">
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Decision Result <b class="require">*</b></label>
                                                    <input type="text" class="form-control" name="decision_result" id="decision_result" 
                                                        value="" placeholder="Enter decision result">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Consent for Booking <b class="require">*</b></label>
                                                    <select class="form-control choosen" onchange="setConsentText()" name="consent_for_booking" id="consent_for_booking">
                                                        <option value="">Select Booking Type</option>
                                                        <option value="0">Service Booking</option>
                                                        <option value="1">Product Booking</option>
                                                        <option value="2">Both</option>
                                                    </select>
                                                    <label for="consent_for_booking" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                                </div>
                                                <div class="form-group col-md-4 col-xs-12">
                                                    <label>Select Message Type<b class="require">*</b></label>
                                                    <select class="form-control form-select" name="message_type" id="message_type">
                                                        <option value="">Select Option</option>
                                                        <option value="1" <?php if(!empty($booking_rules) && $booking_rules->booking_reminder_type == '1'){ echo 'selected'; }?>>SMS</option>
                                                        <option value="2" <?php if(!empty($booking_rules) && $booking_rules->booking_reminder_type == '2'){ echo 'selected'; }?>>Email</option>
                                                        <option value="3" <?php if(!empty($booking_rules) && $booking_rules->booking_reminder_type == '3'){ echo 'selected'; }?>>Whatsapp</option>
                                                    </select>
                                                    <label for="message_type" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                    <label>Service Booking Consent Agree Text <b class="require">*</b></label>
                                                    <textarea style="height: 150px;" readonly type="text" class="form-control" name="service_consent_agree_text" id="service_consent_agree_text" 
                                                        value="" placeholder="Enter Consent Agree Text"></textarea>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                    <label>Product Booking Consent Agree Text <b class="require">*</b></label>
                                                    <textarea style="height: 150px;" readonly type="text" class="form-control" name="product_consent_agree_text" id="product_consent_agree_text" 
                                                        value="" placeholder="Enter Consent Agree Text"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <button style="margin-top: 20px;" type="submit" id="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <table class="table table-striped" id="example">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Client Name</th>
                                    <th>Client Mobile</th>
                                    <th>Added On</th>
                                    <th>Shared On</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($consent_forms)) {
                                    $i = 1;
                                    foreach ($consent_forms as $shift_list_result) {
                                ?>
                                        <tr>
                                            <td scope="row">
                                                <?= $i++ ?>
                                            </td>
                                            <td><?= $shift_list_result->full_name; ?></td>
                                            <td>
                                                <?= $shift_list_result->customer_phone; ?>
                                                <!-- <?= $shift_list_result->email; ?> -->
                                            </td>
                                            <td><?= date('d M, Y h:i A',strtotime($shift_list_result->created_on)); ?></td>
                                            <td>
                                                <?php
                                                    if($shift_list_result->consent_link_sent_on == '0'){
                                                        echo 'SMS';
                                                    }elseif($shift_list_result->consent_link_sent_on == '1'){
                                                        echo 'Whatsapp';
                                                    }elseif($shift_list_result->consent_link_sent_on == '2'){
                                                        echo 'Email';
                                                    }else{
                                                        echo '-';
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($shift_list_result->customer_consent_status == '0'){
                                                        echo '<label class="label label-warning">Pending</label>';
                                                    }elseif($shift_list_result->customer_consent_status == '1'){
                                                        echo '<label class="label label-success">Accepted</label>';
                                                        if($shift_list_result->customer_consent_received_on != ''){
                                                            echo '<br>On: '.date('d M, Y h:i A',strtotime($shift_list_result->customer_consent_received_on));
                                                        }
                                                    }elseif($shift_list_result->customer_consent_status == '2'){
                                                        echo '<label class="label label-danger">Rejected</label>';
                                                    }else{
                                                        echo '-';
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <a title="Consent Form" class="btn btn-success" target="_blank" href="<?=base_url();?>client_consent_form?consent=<?=base64_encode($shift_list_result->id);?>">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                                <?php if($shift_list_result->customer_consent_status == "0"){ ?>
                                                    <button title="Share Again" style="padding: 5px 10px 5px 10px !important;" type="button" onclick="showPopup('exampleModal','<?=$shift_list_result->id;?>')" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                                                        <i style="font-size: 20px;" class="fas fa-share-alt"></i>
                                                    </button>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php');?>
<script>
    var service_consent = 'Stylist ने सुचवलेली सवे ा मी घेतलेली नसल्याने, Decision result मध्ये साांगितल्या प्रमाणे परिणाम ममळेल. साइड इफे क्ट्स होण्याची शक्टयता आहे, याची मला जाणीव असून, यासाठी मी पूणणपणे जबाबदाि िाहील.';
    var product_consent = 'होय, मला मान्य आहे की, याांनी सुचवलेले प्रॉडक्टट मी इथून घेत नसल्याने रिझल्ट जास्त ददवस ममळाला नाही. बाहेिील प्रॉडक्टटमुळे कोणतेही साइड इफेक्टट झाल्यास, मीच पूणपण णे जबाबदाि असेल.';
    $(document).ready(function() {
        $(".choosen").chosen({
            no_results_text: "Oops, nothing found!"
        });
        $('#master_form').validate({
            ignore:[],
            rules: {
                customer: 'required',
                requirement: 'required',
                purpose: 'required',
                condition: 'required',
                stylist_suggest: 'required',
                stylist_decide_result: 'required',
                stylist_name: 'required',
                customer_decision: 'required',
                decision_result: 'required',
                consent_for_booking: 'required',
                message_type: 'required',
                service_consent_agree_text: {
                    required: function(element) {
                        return $('#consent_for_booking').val() == '0' || $('#consent_for_booking').val() == '2';
                    }
                },
                product_consent_agree_text: {
                    required: function(element) {
                        return $('#consent_for_booking').val() == '1' || $('#consent_for_booking').val() == '2';
                    }
                }
            },
            messages: {
                customer: "Please select client",
                requirement: "Please enter requirement",
                purpose: "Please enter purpose",
                condition: "Please enter condition",
                stylist_suggest: "Please enter stylist suggestion",
                stylist_decide_result: "Please enter stylist decide result",
                stylist_name: "Please enter stylist name",
                customer_decision: "Please enter customer decision",
                decision_result: "Please enter decision result",
                consent_for_booking: "Please select booking type",
                service_consent_agree_text: "Please enter consent agree text",
                product_consent_agree_text: "Please enter consent agree text",
                message_type: "Please select message type"
            }
        });
        $('#example').DataTable({ 
            dom: 'Blfrtip',
            lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            buttons: [
                {
                    extend: 'excel',
                    filename: 'consent-form-list',
                    exportOptions: {
                        columns: [0,1,2,3,4,5] 
                    },
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        $('row c[r^="K"]', sheet).attr('s', '2');
                    }
                }
                
            ], 
        });
    });
    function showPopup(id,consent_id){
        $('#consent_form_id').val('');
        $('#requirement').val('');
        $('#purpose').val('');
        $('#condition').val('');
        $('#stylist_suggest').val('');
        $('#stylist_decide_result').val('');
        $('#stylist_name').val('');
        $('#customer_decision').val('');
        $('#decision_result').val('');
        $('#service_consent_agree_text').val('');
        $('#product_consent_agree_text').val('');

        $('#consent_for_booking').val('');
        $('#customer').val('');
        $('#consent_link_sent_on').val('');
        
        $('#consent_for_booking').trigger('chosen:updated');
        $('#customer').trigger('chosen:updated');
        $('#consent_link_sent_on').trigger('chosen:updated');

        var exampleModal = $('#'+id);
        exampleModal.css('display','block');
        exampleModal.css('opacity','1');
        $('.modal-open').css('overflow','auto').css('padding-right','0px'); 
        if(consent_id != ""){
            $.ajax({
                type: "POST",
                url: "<?=base_url();?>salon/Ajax_controller/get_consent_form_details_ajx",
                data:{
                    'id':consent_id
                },
                success: function (data) {
                    var result = JSON.parse(data);
                    if(!result.empty){
                        $('#consent_form_id').val(result.id);
                        $('#requirement').val(result.requirement);
                        $('#purpose').val(result.purpose);
                        $('#condition').val(result.condition);
                        $('#stylist_suggest').val(result.stylist_suggest);
                        $('#stylist_decide_result').val(result.stylist_decide_result);
                        $('#stylist_name').val(result.stylist_name);
                        $('#customer_decision').val(result.customer_decision);
                        $('#decision_result').val(result.decision_result);
                        $('#service_consent_agree_text').val(result.service_consent_agree_text);
                        $('#product_consent_agree_text').val(result.product_consent_agree_text);

                        if(result.consent_link_sent_on == '0'){
                            consent_link_sent_on = '1';
                        }else if(result.consent_link_sent_on == '1'){
                            consent_link_sent_on = '3';
                        }else if(result.consent_link_sent_on == '2'){
                            consent_link_sent_on = '2';
                        }else{
                            consent_link_sent_on = '';
                        }

                        $('#consent_for_booking').val(result.consent_for_booking);
                        $('#customer').val(result.customer_id);
                        $('#consent_link_sent_on').val(consent_link_sent_on);

                        $('#consent_for_booking').trigger('chosen:updated');
                        $('#customer').trigger('chosen:updated');
                        $('#consent_link_sent_on').trigger('chosen:updated');
                    }
                }
            });
        }
    }
    function closePopup(id){
        var exampleModal = $('#'+id);
        exampleModal.css('display','none');
        exampleModal.css('opacity','0');
        $('.modal-open').css('overflow','auto').css('padding-right','0px');
    }
    function setConsentText(){
        var consent_for_booking = $('#consent_for_booking').val();
        if(consent_for_booking == '0'){
            $('#service_consent_agree_text').val(service_consent).attr('readonly',false);
            $('#product_consent_agree_text').val('').attr('readonly',true);
        }else if(consent_for_booking == '1'){
            $('#service_consent_agree_text').val('').attr('readonly',true);
            $('#product_consent_agree_text').val(product_consent).attr('readonly',false);
        }else if(consent_for_booking == '2'){
            $('#service_consent_agree_text').val(service_consent).attr('readonly',false);
            $('#product_consent_agree_text').val(product_consent).attr('readonly',false);
        }else{
            $('#service_consent_agree_text').val('').attr('readonly',true);
            $('#product_consent_agree_text').val('').attr('readonly',true);
        }
    }
</script>

<script>
    $(document).ready(function() {
        $('#reports .child_menu').show();
        $('#reports').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.consent-form').addClass('active_cc');
    });
</script>
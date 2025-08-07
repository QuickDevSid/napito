
<?php include('header.php');?>
<style type="text/css">
 .error{
    
 }
 .input-content-option{
    height: 35px;
    width: 600px;
    border-radius: 5px;
    border: solid gray 1px;
    float: left;
}
</style>
  <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                                Add Employee Details
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
                                
                                <div class="x_content">
                                    <div class="container">
                                        <form method="post" name="employee_form" id="employee_form" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label>Full Name <b class="require">*</b></label>
                                            <input class="input-content" type="text" class="form-control" name="full_name" id="full_name" value="<?php if(!empty($single)) { echo $single->full_name;} ?>" placeholder="Enter full name">
                                            <input class="input-content" type="hidden" name="id"  id="id" value="<?php if(!empty($single)){ echo $single->id;}?>">
                                            <label style="margin-left: 0px; display: none;" id="full_name-error" class="error col-md-12" for="full_name"></label>
                                        </div>
                                        <div class="form-group"style="margin-top: 5px;">
                                            <label>WhatsApp number <b class="require">*</b></label>
                                            <input class="input-content" type="text" class="form-control" name="whatsapp_number" id="whatsapp_number" value="<?php if(!empty($single)) { echo $single->whatsapp_number;} ?>" placeholder="Enter employee whatsapp number">
                                            <label style="margin-left: 0px; display: none;" id="whatsapp_number-error" class="error col-md-12" for="whatsapp_number"></label>
                                        </div>
                                         <div class="form-group">
                                            <label>Email <b class="require">*</b></label>
                                            <input class="input-content" type="text" class="form-control" name="email" id="email" value="<?php if(!empty($single)) { echo $single->email;} ?>" placeholder="Enter employee email">
                                            <label style="margin-left: 0px; display: none;" id="email-error" class="error col-md-12" for="email"></label>
                                        </div> 
                                        <div class="form-group"style="margin-top: 5px;">
                                            <label>Description</label>
                                            <input class="input-content" type="text" class="form-control" name="description" id="description" value="<?php if(!empty($single)) { echo $single->description;} ?>" placeholder="Enter description">

                                        </div>
                                      
                                         <div class="form-group">
                                            <label>Address</label>
                                            <input class="input-content" type="text" class="form-control" name="address" id="address" value="<?php if(!empty($single)) { echo $single->address;} ?>" placeholder="Enter address">
                                        </div>
                                         
                                         <div class="form-group">
                                            <label" style="margin-top: 0px;">Please select Gender</label>
                                            <div style="float: left;">
                                                
                                            <input type="radio" id="male" name="gender" value="0">
                                            <label for="male">Male</label>&nbsp&nbsp
    
                                            <input type="radio" id="female" name="gender" value="1">
                                            <label for="female">Female</label>&nbsp&nbsp
    
                                                <input type="radio" id="prefer-not-say" name="gender" value="2">
                                                <label for="unisex">Prefer Not Say</label>
                                            </div>
                                         </div>
                                         <div class="form-group">
                                            <label>Select Shift <b class="require">*</b></label>
                                            <select class="form-select form-control input-content-option" name="shift_name" id="shift_name">
                                                <option value="" class="">Select</option>
                                                <?php if(!empty($shift_name)){ 
                                                    foreach($shift_name as $shift_name_result){?>

                                                    <option value="<?=$shift_name_result->id?>" <?php if(!empty($single) && $single->shift_name == $shift_name_result->id){?>selected="selected"<?php }?>><?=$shift_name_result->shift_name?></option>
                                                <?php }}?>
                                            </select>
                                            <label style="margin-left: 0px; display: none;" id="shift_name-error" class="error col-md-12" for="shift_name">Please enter service name</label>
                                        </div> 
                                        <div class="form-group">
                                            <label>Select Identity</label>
                                            <select class="form-select form-control input-content-option" name="identity" id="identity">
                                                <option value="" class="">Select</option>
                                                    <option name="identity" value="1">Pan Card</option>
                                                    <option name="identity" value="2">Aadhar Card</option>
                                                    <option name="identity" value="3">Driving License</option>
                                                    <option name="identity" value="4">Passport</option>
                                                    <option name="identity" value="5">Voter ID</option>
                                        
                                            </select>
                                            <label style="margin-left: 0px; display: none;" id="identity-error" class="error col-md-12" for="identity"></label>
                                        </div> 
                                        <div class="form-group">
                                            <label>Enter identity Number</label>
                                            <input class="input-content" type="text" class="form-control" name="identity_number" id="identity_number" value="<?php if(!empty($single)) { echo $single->identity_number;} ?>" placeholder="Enter employee aadhar number">
                                            <label style="margin-left: 0px; display: none;" id="identity_number-error" class="error col-md-12" for="identity_number"></label>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Upload Aadhar Front Side</label>
                                            <input class="input-content" type="file" class="form-control" accept=".pdf, .png, .jpg, .jpeg" name="aadhar_front" id="aadhar_front" value="<?php if(!empty($single)) { echo $single->aadhar_front;} ?>">
                                            <label style="margin-left: 0px; display: none;" id="aadhar_front-error" class="error col-md-12" for="aadhar_front"></label>
                                        </div>
                                        <div class="form-group">
                                            <label>Account Holder Name <b class="require">*</b></label>
                                            <input class="input-content" type="text" class="form-control" name="account_holder_name" id="account_holder_name" value="<?php if(!empty($single)) { echo $single->account_holder_name;} ?>" placeholder="Enter account holder name">
                                            <label style="margin-left: 0px; display: none;" id="account_holder_name-error" class="error col-md-12" for="account_holder_name"></label>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Account Number <b class="require">*</b></label>
                                            <input class="input-content" type="text" class="form-control" name="account_number" id="account_number" value="<?php if(!empty($single)) { echo $single->account_number;} ?>" placeholder="Enter account number">
                                            
                                            <label style="margin-left: 0px; display: none;" id="account_number-error" class="error col-md-12" for="account_number"></label>
                                        </div>
                                       
                                       <div class="form-group">
                                            <label>Account Type<b class="require">*</b></label>
                                            <input class="input-content" type="text" class="form-control" name="account_type" id="account_type" value="<?php if(!empty($single)) { echo $single->account_type;} ?>" placeholder="Enter account type">
                                           <label style="margin-left: 0px; display: none;" id="account_type-error" class="error col-md-12" for="account_type"></label> 

                                        </div>
                                        <div class="form-group">
                                            <label>Branch Name <b class="require">*</b></label>
                                            <input class="input-content" type="text" class="form-control" name="bank_branch_name" id="bank_branch_name" value="<?php if(!empty($single)) { echo $single->bank_branch_name;} ?>" placeholder="Enter account type">
                                            <label style="margin-left: 0px; display: none;" id="bank_branch_name-error" class="error col-md-12" for="bank_branch_name"></label>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>IFSC Code <b class="require">*</b></label>
                                            <input class="input-content" type="text" class="form-control" name="ifsc" id="ifsc" value="<?php if(!empty($single)) { echo $single->ifsc;} ?>" placeholder="Enter ifsc code">
                                            
                                            <label style="margin-left: 0px; display: none;" id="ifsc-error" class="error col-md-12" for="ifsc"></label>
                                        </div>
                                         <div class="form-group">
                                            <label>Select Desgnation<b class="require">*</b></label>
                                            <select class="form-select form-control input-content-option" name="desgnation" id="desgnation">
                                                <option value="" class="">Select</option>
                                                <?php if(!empty($select_designation)){ 
                                                    foreach($select_designation as $select_designation_result){?>

                                                    <option value="<?=$select_designation_result->id?>" <?php if(!empty($single) && $single->select_designation == $select_designation_result->id){?>selected="selected"<?php }?>><?=$select_designation_result->designation?></option>
                                                <?php }}?>
                                            </select>
                                            <label style="margin-left: 0px; display: none;" id="desgnation-error" class="error col-md-12" for="desgnation">Please enter service name</label>
                                        </div>
                                        <div class="form-group">
                                            <label>Select Service<b class="require">*</b></label>
                                            <select class="form-select form-control input-content-option" name="service_name" id="service_name">
                                                <option value="" class="">Select</option>
                                                <?php if(!empty($service_name)){ 
                                                    foreach($service_name as $service_name_result){?>

                                                    <option value="<?=$service_name_result->id?>" <?php if(!empty($single) && $single->service_name == $service_name_result->id){?>selected="selected"<?php }?>><?=$service_name_result->service?></option>
                                                <?php }}?>
                                            </select>
                                            <label style="margin-left: 0px; display: none;" id="service_name-error" class="error col-md-12" for="service_name">Please enter service name</label>
                                        </div>                                     
                                        <div class="form-group" style="float: left; margin-top: 70px;">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>  <!------------end of form---->
                                    </div>  <!----------end of container-------->

                                </div>
                            </div>
                        </div>

                      </div>  

                    </div>
                </div>
                <?php include('footer.php');
                    $id = 0;
                    if($this->uri->segment(2) !=""){
                        $id = $this->uri->segment(2);
                    }
                ?>


                <script>
                    $(document).ready(function () {     
            jQuery.validator.addMethod("validate_email", function(value, element) {
                if (/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value)) {
                    return true;
                }else {
                    return false;
                }
            }, "Please enter a valid Email.");  
            jQuery.validator.addMethod("noHTMLtags", function(value, element){
                if(this.optional(element) || /<\/?[^>]+(>|$)/g.test(value)){
                    if(value == ""){
                        return true;
                    }else{
                        return false;
                    }
                } else {
                    return true;
                }
            }, "HTML tags are Not allowed."); 
            $('#employee_form').validate({
                rules: {
                    full_name:'required',
                    whatsapp_number: {
                    required: true,
                    number: true,
                    mobile_no: true,
                    minlength: 10,
                    maxlength: 10,
                },
                    email: {
                    required: true,
                    validate_email: true,
                    noHTMLtags: true,
                    },
                    shift_name:'required',
                    account_holder_name :'required',
                    account_number:'required',
                    account_type:'required',
                    bank_branch_name:'required',
                    ifsc:'required',
                    desgnation:'required',
                    service_name:'required',
                    
                    
                },
                messages: {
                    full_name:"Please enter full name",
                    whatsapp_number: {
                    required:"Please enter whatsapp number number",
                    number: "Only number allowed!",
                    mobile_no: "Please enter valid number!",
                    minlength: "Minimum 10 digit required!",
                    maxlength: "Maximum 10 digit allowed!",
                },
                    email: {
                    required: "Please enter email!",
                    validate_email: "Please enter valid email!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                    aadhar_front:"Please upload aadhar front side",
                    profile_photo:"Please upload prifile photo",
                    shift_name:"Please select shift",
                    account_holder_name:'Please enter account holder name',
                    account_number:'Please enter account number',
                    account_type:'Please enter account type',
                    bank_branch_name:'Please enter bank branch name',
                    ifsc:'Please enter ifsc code',
                    desgnation:'Please enter designation',
                    service_name:'Please enter service name',
                },
                
            });
        });

$("#state").change(function(){  
    $.ajax({
        type: "POST",
        url: "<?=base_url();?>admin/Ajax_controller/get_city_ajax",
        data:{'state':$("#state").val()},
        success: function(data){
            $("#city").empty();
            $('#city').append('<option value="">Select City</option>');
            var opts = $.parseJSON(data);
            $.each(opts, function(i, d) {
               $('#city').append('<option value="' + d.id + '">' + d.name + '</option>');
            });
            $('#city').trigger('change');
        },
         error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    }); 
});



$("#email").keyup(function(){  
    $.ajax({
        type: "POST",
        url: "<?=base_url();?>admin/Ajax_controller/get_unique_owner_email",
        data:{'email':$("#email").val(),'id':'<?=$id?>'},
        success: function(data){console.log(data);
            if(data == "0"){
                $("#email_error").html('');
                $("#submit").show();
            }else{
                $("#email_error").html('This email is already added');
                $("#submit").hide();
            }
             
        },
         error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
        }); 
    });  

                </script>







<?php include('header.php');?>
<style type="text/css">
    .error{
        font-weight: bold;
    }
    
    .chosen-container a{
    background-color: white !important;
    height: 34px !important;
}
</style>
  <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Sub Catagory Master                  
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


                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">
                                    <div class="container">
                                        <form method="post" name="master_form" id="master_form" enctype="multipart/form-data"><div class="form-group">
                                            <label>Select Catagory</label>
                                            <select class="form-select form-control chosen-select" name="sup_catagory" id="sup_catagory">
                                                <option value="" class="">Select Catagory</option>
                                                <?php if(!empty($sup_catagory)){ 
                                                    foreach($sup_catagory as $sup_catagory_result){?>

                                                    <option value="<?=$sup_catagory_result->id?>" <?php if(!empty($single) && $single->sup_catagory == $sup_catagory_result->id){?>selected="selected"<?php }?>><?=$sup_catagory_result->services_name?></option>
                                                <?php }}?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Add Sub Catagory  <b class="require">*</b></label>
                                            <input type="text" class="form-control" name="sub_catagory" id="sub_catagory" value="<?php if(!empty($single)){ echo $single->sub_catagory; }?>" placeholder="Enter sub catagory">

                                            <div class="error" id="sub_catagory_error"></div>
                                            <input type="hidden" class="form-control" name="id" id="id" value="<?php if(!empty($single)){ echo $single->id; }?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Add 3rd Catagory</label>
                                            <input type="text" class="form-control" name="third_catagory" id="third_catagory" value="<?php if(!empty($single)){ echo $single->third_catagory; }?>" placeholder="Enter sub catagory">

                                            <div class="error" id="sub_catagory_error"></div>
                                            <input type="hidden" class="form-control" name="id" id="id" value="<?php if(!empty($single)){ echo $single->id; }?>">
                                        </div> 
 
                                        
                                        <div class="form-group">
                                            <button type="submit" id="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </form>  <!------------end of form---->
                                    </div>  <!----------end of container-------->

                                </div>
                            </div>

                        </div>



                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    
                                    <!-- <div class="clearfix"></div> -->
                                </div>
                                <div class="x_content">

                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>Catagory</th>
                                                <th> Sub Catagory</th>
                                                <th>Third Catagory</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($sub_catagory_list)){
                                                $i=1;
                                                    foreach($sub_catagory_list as $sub_catagory_list_result){
                                            ?>
                                            <tr>
                                                <th scope="row"><?=$i++?></th>
                                                <td><?=$sub_catagory_list_result->services_name?></td>
                                                <td><?=$sub_catagory_list_result->sub_catagory?></td>
                                                <td><?=$sub_catagory_list_result->third_catagory?></td>
                                                <td>
                                                    <?php if($sub_catagory_list_result->status == "1"){?>
                                                        <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$sub_catagory_list_result->id?>/tbl_service_subcategory"><i  style="color: blue; font-size: 25px;" class="fa-solid fa-toggle-on"></i></a>  
                                                    <?php }else{?>

                                                        <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$sub_catagory_list_result->id?>/tbl_service_subcategory"><i style="font-size: 25px;" class="fa-solid fa-toggle-off"></i></a> 
                                                    <?php }?>
                                                </td>
                                                <td>
                                                    <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$sub_catagory_list_result->id?>/tbl_service_subcategory"><i class="fa-solid fa-trash"></i></a>   

                                                    <a title="Edit" class="btn btn-primary" href="<?=base_url()?>add-sub-catagory/<?=$sub_catagory_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a>    
                                                </td>
                                            </tr>
                                        <?php }}?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                      </div>  

                    </div>
                </div>
                <?php include('footer.php');
                    $id= '0';
                    if($this->uri->segment(2) != ""){
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
            $('#master_form').validate({
                rules: {
                    sub_catagory: {
                        required: true, 
                        noHTMLtags: true,
                    },
                },
                messages: {
                    sub_catagory: {
                        required: "Please enter sub catagory", 
                        noHTMLtags: "HTML tags not allowed!",
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
$("#sub_catagory").keyup(function(){  
	$.ajax({
		type: "POST",
		url: "<?=base_url();?>admin/Ajax_controller/get_unique_sub_catagory",
		data:{'sub_catagory':$("#sub_catagory").val(),'id':'<?=$id?>'},
		success: function(data){console.log(data);
			if(data == "0"){
				$("#sub_catagory_error").html('');
				$("#submit").show();
			}else{
				$("#sub_catagory_error").html('This catagory type is already added');
				$("#submit").hide();
			}
			 
		},
		 error: function(jqXHR, textStatus, errorThrown) {
		   console.log(textStatus, errorThrown);
		}
		});	
	});

    
                </script>
                 <script type="text/javascript">
                        $(document).ready(function () {
                            $(".chosen-select").chosen({
                                max_selected_options: 5
                            });
                        });
                    </script>
                







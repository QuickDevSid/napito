<?php include('header.php');?>
<style type="text/css">
.input-content-option{
    height: 33px;
    width: 570px;
   
}
</style>

  <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Add Tips                 
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


                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">
                                    <form method="post" name="master_form" id="master_form" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Add Tips <b class="require">*</b></label>
                                                <input type="text" class="form-control" name="tips" id="tips" value="<?php if(!empty($single)){ echo $single->tips; }?>" placeholder="Enter tips name">

                                                <div class="error" id="facility_name_error"></div>
                                                <input type="hidden" class="form-control" name="id" id="id" value="<?php if(!empty($single)){ echo $single->id; }?>">
                                            </div>
                                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Upload Photo <b class="require">*</b></label>
                                                <input style="height: 50px;border: 0px;" type="file" class="form-control" name="tips_photo" id="tips_photo" value="<?php if(!empty($single)){ echo $single->tips_photo; }?>">
                                                <input style="height: 50px;border: 0px;" type="hidden" class="form-control" name="old_tips_photo" id="old_tips_photo" value="<?php if(!empty($single)){ echo $single->tips_photo; }?>">

                                                <div class="error" id="facility_name_error"></div>
                                            </div>
                                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Description <b class="require">*</b></label>
                                                <textarea type="text" class="form-control" name="description" id="description" placeholder="Enter description"><?php if(!empty($single)){ echo $single->description; }?></textarea>

                                                <div class="error" id="facility_name_error"></div>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <button style="margin-top: 30px;" type="submit" id="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </form> 
                                </div>  
                            </div>
                        </div>
                    </div>



                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    
                                    <!-- <div class="clearfix"></div> -->
                                </div>
                                <div class="x_content">

                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>facility Name</th>
                                                <th>Description</th>
                                                <th>facility Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php if(!empty($tips_list)){
                                        		$i=1;
                                        			foreach($tips_list as $tips_list_result){
                                        	?>
                                            <tr>
                                                <th scope="row"><?=$i++?></th>
                                                <td><?=$tips_list_result->tips?></td>
                                                <td><?=$tips_list_result->description?></td>
                                                <td><button class="photo-btn"><a target="_blank" href="<?=base_url()?>/admin_assets/images/tips_photo/<?=$tips_list_result->tips_photo?>" target="_blank">View Photo</a></button> </td>
                                                <td>
                                                	<a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>admin_delete/<?=$tips_list_result->id?>/tbl_tips_master"><i class="fa-solid fa-trash"></i></a>	

                                                	<a title="Edit" class="btn btn-success" href="<?=base_url()?>add-tips/<?=$tips_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a>	
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
                    tips: {
                        required: true, 
                        noHTMLtags: true,
                    },
                    description: {
                        required: true, 
                        noHTMLtags: true,
                    },
                    tips_photo: {
                        required: true, 
                        noHTMLtags: true,
                    },
                },
                messages: {
                    tips: {
                        required: "Please enter tips name!", 
                        noHTMLtags: "HTML tags not allowed!",
                    },
                     description: {
                        required: "Please enter description!", 
                        noHTMLtags: "HTML tags not allowed!",
                    },
                     tips_photo: {
                        required: "Please upload image!", 
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
$("#tips").keyup(function(){  
	$.ajax({
		type: "POST",
		url: "<?=base_url();?>admin/Ajax_controller/get_unique_tips",
		data:{'tips':$("#tips").val(),'id':'<?=$id?>'},
		success: function(data){console.log(data);
			if(data == "0"){
				$("#tips_error").html('');
				$("#submit").show();
			}else{
				$("#tips_error").html('This tips is already added');
				$("#submit").hide();
			}
			 
		},
		 error: function(jqXHR, textStatus, errorThrown) {
		   console.log(textStatus, errorThrown);
		}
		});	
	});	 
                </script>







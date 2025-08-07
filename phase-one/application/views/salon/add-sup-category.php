<?php include('header.php');?>
<style type="text/css">
   
    
</style>
  <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                              Add Services Category                   
                            </h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                               
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">


                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">
                                    <div class="container">
                                        <form method="post" name="master_form" id="master_form" enctype="multipart/form-data" accept-charset="UTF-8">
                                            <div class="row">
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Add Category <b class="require">*</b></label>
                                                    <input autocomplete="off" type="text" class="form-control" name="sup_category" id="sup_category" value="<?php if(!empty($single)){ echo $single->sup_category; }?>" placeholder="Enter category">

                                                    <div class="error" id="sup_category_error"></div>
                                                    <input type="hidden" class="form-control" name="id" id="id" value="<?php if(!empty($single)){ echo $single->id; }?>">
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Category In मराठी<b class="require">*</b></label>
                                                    <input autocomplete="off" type="text" class="form-control" name="sup_category_marathi" id="sup_category_marathi" value="<?php if(!empty($single)){ echo $single->sup_category_marathi; }?>" placeholder="Enter category in marathi">
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                    <label>Add Category Image<b class="require">*</b></label>
                                                    <input autocomplete="off" type="file" class="form-control" name="category_image" id="category_image" value="<?php if(!empty($single)){ echo $single->category_image; }?>" placeholder="Enter category">
                                                </div>
                                                
                                                <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                                    <div class="btn btn-info"><a class="add_service_sub_category" href="<?=base_url();?>add_service_sub_category" style="color: white;">Add Sub Category</a></div>
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
                                </div>
                                <div class="x_content">

                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>Category</th>
                                                <th>Category In Marathi</th>
                                                <th>Category Image</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php if(!empty($category_name_list)){
                                        		$i=1;
                                        			foreach($category_name_list as $category_name_list_result){
                                        	?>
                                            <tr>
                                                <th scope="row"><?=$i++?></th>
                                                <td><?=$category_name_list_result->sup_category?></td>
                                                <td><?=$category_name_list_result->sup_category_marathi?></td>
                                               <td><button class="photo-btn"><a target="_blank" href="<?= base_url() ?>\admin_assets\images\service_category_image/<?= $category_name_list_result->category_image ?>" target="_blank">View</a></button> </td>
                                                <td>
                                                    <?php if($category_name_list_result->status == "1"){?>
                                                        <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$category_name_list_result->id?>/tbl_service_category"><i class="fa-solid fa-toggle-on"></i></a>  
                                                    <?php }else{?>

                                                        <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$category_name_list_result->id?>/tbl_service_category"><i class="fa-solid fa-toggle-off"></i></a> 
                                                    <?php }?>
                                                </td>
                                                <td>
                                                	<a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$category_name_list_result->id?>/tbl_service_category"><i class="fa-solid fa-trash"></i></a>	

                                                	<a title="Edit" class="btn btn-success" href="<?=base_url()?>add-sup-category/<?=$category_name_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a>	
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
                    sup_category: {
                        required: true, 
                        noHTMLtags: true,
                    },
                    sup_category_marathi: {
                        required: true, 
                        noHTMLtags: true,
                    },
                    category_image:{
                        required: true, 
                        noHTMLtags: true,
                    }
                },
                messages: {
                    sup_category: {
                        required: "Please enter service name!", 
                        noHTMLtags: "HTML tags not allowed!",
                    },
                    category_image: {
                        required: "Please upload categoory image!", 
                        noHTMLtags: "HTML tags not allowed!",
                    },
                    sup_category_marathi: {
                        required: "Please enter sup category marathi!", 
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
$("#sup_category").keyup(function(){  
	$.ajax({
		type: "POST",
		url: "<?=base_url();?>salon/Ajax_controller/get_unique_sup_category",
		data:{'sup_category':$("#sup_category").val(),'id':'<?=$id?>'},
		success: function(data){
            console.log(data);
			if(data == "0"){
				$("#sup_category_error").html('');
				$("#submit").show();
			}else{
				$("#sup_category_error").html('This services is already added');
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
                                 
                            });
                        });
                    </script>
<script>
      $(document).ready(function () {
			$('#back-office .child_menu').show();
			$('#back-office').addClass('nv active');
			$('.right_col').addClass('active_right');
			$('.service-setup').addClass('active_cc');
		});
</script>







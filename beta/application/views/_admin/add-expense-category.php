<?php include('header.php');?>
<style type="text/css">
   
    
</style>
  <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Add Expenses Category                
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
                                        <form method="post" name="master_form" id="master_form" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Add Category <b class="require">*</b></label>
                                                <input type="text" class="form-control" name="expenses_name" id="expenses_name" value="<?php if(!empty($single)){ echo $single->expenses_name; }?>" placeholder="Enter catagory">
                                                <input type="hidden" class="form-control" name="id" id="id" value="<?php if(!empty($single)){ echo $single->id; }?>">
                                                <div id="expenses_name_error" class="error"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <button style="margin-top: 20px;" type="submit" id="submit" class="btn btn-primary">Submit</button>
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
                                                <th>Category</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php if(!empty($expense_category_list)){
                                        		$i=1;
                                        			foreach($expense_category_list as $expense_category_list_result){
                                        	?>
                                            <tr>
                                                <th scope="row"><?=$i++?></th>
                                                <td><?=$expense_category_list_result->expenses_name?></td>
                                                <td>
                                                    <?php if($expense_category_list_result->status == "1"){?>
                                                        <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$expense_category_list_result->id?>/tbl_expenses_category"><i class="fa-solid fa-toggle-on"></i></a>  
                                                    <?php }else{?>

                                                        <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$expense_category_list_result->id?>/tbl_expenses_category"><i class="fa-solid fa-toggle-off"></i></a> 
                                                    <?php }?>
                                                </td>
                                                <td>
                                                	<a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$expense_category_list_result->id?>/tbl_expenses_category"><i class="fa-solid fa-trash"></i></a>	

                                                	<a title="Edit" class="btn btn-success" href="<?=base_url()?>add-expense-category/<?=$expense_category_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a>	
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
                    expenses_name: {
                        required: true, 
                        noHTMLtags: true,
                    },
                },
                messages: {
                    expenses_name: {
                        required: "Please enter category name!", 
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
   $("#expenses_name").keyup(function(){  
	$.ajax({
		type: "POST",
		url: "<?=base_url();?>salon/Ajax_controller/get_unique_expenses_name",
		data:{'expenses_name':$("#expenses_name").val(),'id':'<?=$id?>'},
		success: function(data){
            console.log(data);

			if(data == "0"){
				$("#expenses_name_error").html('');
				$("#submit").show();
			}else{
				$("#expenses_name_error").html('This expenses category is already added');
				$("#submit").hide();
			}
			 
		},
		error: function(xhr, status, error) {
            console.error("AJAX Error: " + status + " - " + error);
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

<script>
    $(document).ready(function() {
        $('#expenses .child_menu').show();
        $('#expenses').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.add-expense-category').addClass('active_cc');
    });
</script>







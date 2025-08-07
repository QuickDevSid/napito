<?php include('header.php');?>
<style type="text/css">
.input-content-option{
    height: 33px;
    width: 570px;
   
}
#example_filter{
    display:none;
}
</style>

  <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Mobile App Catlogue                 
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
                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label>Gender <b class="require">*</b></label>
                                                <select class="form-control" id="gender" name="gender">
                                                    <option value="">Select Gender</option>
                                                    <?php if ($store_category->category == '0'){?>
                                                        <option id="male" value="0">Male</option>
                                                    <?php }?>
                                                    <?php if ($store_category->category == '1'){?>
                                                        <option id="female" value="1">Female</option>
                                                    <?php }?>
                                                    <?php if ($store_category->category == '2'){?>
                                                        <option id="male" value="0">Male</option>
                                                        <option id="female" value="1">Female</option>
                                                    <?php }?>
                                                </select>
                                                <div class="error" for="gender" id="gender_error"></div>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <label>Upload Photo <b class="require">*</b>
                                                    <!-- <small style="text-align:right;">(Note: Upload images with 150*200 dimension)</small> -->
                                                </label>
                                                <input style="height: 50px;border: 0px;" type="file" accept=".png,.jpg.jpeg" class="form-control" name="banner[]" id="banner" multiple>
                                                <div class="error" id="facility_name_error"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                                <button style="margin-top: 30px;" type="submit" id="submit" name="banner_submit" value="banner_submit" class="btn btn-success">Submit</button>
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

                                    <table id="example" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Gender</th>
                                                <th>Banner</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php if(!empty($facility_list)){
                                        		$i=1;
                                        			foreach($facility_list as $tips_list_result){
                                                        if($tips_list_result->gender == '0'){
                                                            $gender = 'Male';
                                                        }elseif($tips_list_result->gender == '1'){
                                                            $gender = 'Female';
                                                        }else{
                                                            $gender = '-';
                                                        }
                                        	?>
                                            <tr>
                                                <td scope="row"><?=$i++?></td>
                                                <td><?=$gender;?></td>
                                                <td>
                                                    <a title = "View" target="_blank" href="<?=base_url()?>admin_assets/images/catalogue/<?=$tips_list_result->banner?>" target="_blank">
                                                        <img style="height: 100px;width: 200px;" src="<?=base_url()?>admin_assets/images/catalogue/<?=$tips_list_result->banner?>">
                                                    </a>
                                                </td>
                                                <td>
                                                	<a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$tips_list_result->id?>/tbl_catalogue"><i class="fa-solid fa-trash"></i></a>	
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
                ignore:[],
                rules: {
                    gender: {
                        required: true, 
                        noHTMLtags: true,
                    },
                    'banner[]': {
                        required: true, 
                        noHTMLtags: true,
                    },
                },
                messages: {
                    gender: {
                        required: "Please select gender!", 
                        noHTMLtags: "HTML tags not allowed!",
                    },
                    'banner[]': {
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
                </script>


<script>
$('#example').DataTable({ 
    dom: 'lfrtip', // Removes both Excel button and the search box
    responsive: false,
    lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
});
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.add-catlogue-salon').addClass('active_cc');
    });
</script>





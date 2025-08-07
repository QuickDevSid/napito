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
                    Facility Master                  
                </h3>
                        </div>

                        <!--  <div class="title_right">
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
                                <div class="x_content">
                                    <div class="container">
                                        <form class="row" method="post" name="master_form" id="master_form" enctype="multipart/form-data">

                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <label>Add Facility  <b class="require">*</b></label>
                                            <input type="text" class="form-control" name="facility_name" id="facility_name" value="<?php if(!empty($single)){ echo $single->facility_name; }?>" placeholder="Enter facility name">

                                            <div class="error" id="facility_name_error"></div>
                                            <input type="hidden" class="form-control" name="id" id="id" value="<?php if(!empty($single)){ echo $single->id; }?>">
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <label>Upload Icon <b class="require">*</b> 
                                            <?php if(!empty($single) && $single->icon !=""){?> 
                                                <a title = "View" href="<?=base_url()?>admin_assets/images/facility_icon/<?=$single->icon?>" target="_blank"><i class="fas fa-eye"></i></a>
                                            <?php }?>
                                            </label>
                                            <input style="height: 50px;" type="file" accept=".png,.jpg.jpeg" class="form-control" name="icon" id="icon">
                                            <input style="height: 50px;border: 0px;" type="hidden" class="form-control" name="old_icon" id="old_icon" value="<?php if(!empty($single)){ echo $single->icon; }?>">
                                        </div>
                                        
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <button style="margin-top: 15px;" type="submit" id="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </form>  
                                    </div>  

                                </div>
                            </div>

                        </div>



                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    
                                    <!-- <div class="clearfix"></div> -->
                                </div>
                                <div class="x_content">

                                    <table class="table table-striped" id="example">
                                        <thead>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Facility Name</th>
                                                <th>Icon</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php if(!empty($facility_list)){
                                        		$i=1;
                                        			foreach($facility_list as $facility_list_result){
                                        	?>
                                            <tr>
                                                <td scope="row"><?=$i++?></td>
                                                <td><?=$facility_list_result->facility_name?></td>
                                                <td>
                                                <?php if($facility_list_result->icon != ""){ ?> 
                                                    <a title = "View" target="_blank" href="<?=base_url()?>admin_assets/images/facility_icon/<?=$facility_list_result->icon?>" target="_blank"><i class="fas fa-eye"></i></a>
                                                <?php }?>
                                                </td>
                                                <td>
                                                	<a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$facility_list_result->id?>/tbl_salon_facility_master"><i class="fa-solid fa-trash"></i></a>	

                                                	<a title="Edit" class="btn btn-success" href="<?=base_url()?>add-salon-facility/<?=$facility_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a>	
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
                    facility_name: {
                        required: true, 
                        noHTMLtags: true,
                    },
                    icon: {
                        required: function(element) {
                            return $('#old_icon').val() == '';
                        },
                        noHTMLtags: true,
                    },
                },
                messages: {
                    facility_name: {
                        required: "Please enter facility name!", 
                        noHTMLtags: "HTML tags not allowed!",
                    },
                    icon: {
                        required: "Please upload icon!", 
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
        $("#facility_name").keyup(function(){  
            $.ajax({
                type: "POST",
                url: "<?=base_url();?>salon/Ajax_controller/get_unique_facility_name",
                data:{'facility_name':$("#facility_name").val(),'id':'<?=$id?>'},
                success: function(data){console.log(data);
                    if(data == "0"){
                        $("#facility_name_error").html('');
                        $("#submit").show();
                    }else{
                        $("#facility_name_error").html('This facility name is already added!');
                        $("#submit").hide();
                    }
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });	
        });	
                </script>





<script>
$('#example').DataTable({ 
 dom: 'Blfrtip',
responsive: true,
lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
 
    buttons: [
        
        {
            extend: 'excel',
            filename: 'facilty-list',
            exportOptions: {
                columns: [0,1] 
            }
        },
        
        
    ], 
});
</script>
<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.add-salon-facility').addClass('active_cc');
    });
</script>





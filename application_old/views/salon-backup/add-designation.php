<?php include('header.php');?>
<style type="text/css">
   .error{
      font-weight: bold;
   } 
</style>
  <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Employee Designation Master                  
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
                                        <form method="post" name="master_form" id="master_form" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label>Add Designation<b class="require">*</b></label>
                                            <input type="text" class="form-control" name="designation" id="designation" value="<?php if(!empty($single)){ echo $single->designation; }?>">

                                            <div class="error" id="designation_error"></div>
                                            <input type="hidden" class="form-control" name="id" id="id" value="<?php if(!empty($single)){ echo $single->id; }?>">
                                        </div>

 
                                        
                                        <div class="form-group">
                                            <button style="margin-top: 20px;" type="submit" id="submit" class="btn btn-success">Submit</button>
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
                                                <th>Designation Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                                <?php if (!empty($designation_list)) {
                                                    $i = 1;
                                                    foreach ($designation_list as $designation_list_result) {
                                                        ?>
                                                        <tr>
                                                            <th scope="row"><?= $i++ ?></th>
                                                            <td><?= $designation_list_result->designation ?></td>
                                                                <?php if ($designation_list_result->designation !== 'Stylist') { ?>
                                                            <td>
                                                              <?php if($designation_list_result->status == "1"){?>
                                                                <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$designation_list_result->id?>/tbl_emp_designation"><i  style="color: blue; font-size: 25px;" class="fa-solid fa-toggle-on"></i></a><?php }else{?>

                                                                <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$designation_list_result->id?>/tbl_emp_designation"><i style="font-size: 25px;" class="fa-solid fa-toggle-off"></i></a> 
                                                                     <?php }?>  
                                                            </td>
                                                            <td>
                                                                    <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?= base_url() ?>delete/<?= $designation_list_result->id ?>/tbl_emp_designation"><i class="fa-solid fa-trash"></i></a>

                                                                    <a title="Edit" class="btn btn-primary" href="<?= base_url() ?>add-designation/<?= $designation_list_result->id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
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
                <?php include('footer.php');
                	$id= '0';
                	if($this->uri->segment(2) != ""){
						$id = $this->uri->segment(2);
                	}
                ?>
                <!--  <script>
             $(".alert").fadeTo(5000, 500).slideUp(500, function(){
                    $(".alert").slideUp(500);
                }); 
            </script>
 -->
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
                    designation: {
                        required: true, 
                        noHTMLtags: true,
                    },
                },
                messages: {
                    designation: {
                        required: "Please enter designation name", 
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
$("#designation").keyup(function(){  
    // alert($("#designation").val())
    $.ajax({
        type: "POST",
        url: "<?=base_url();?>salon/Ajax_controller/get_unique_designation",
        data:{'designation':$("#designation").val()},
        success: function(data){
            console.log(data);
            if(data == "0"){
                $("#designation_error").html('');
                $("#submit").show();
            }else{
                $("#designation_error").html('This designation is already added');
                $("#submit").hide();
            }
             
        },
         error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
        }); 
    }); 	 
                </script>







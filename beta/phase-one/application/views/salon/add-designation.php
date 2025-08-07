<?php include('header.php');?>
<style type="text/css">
   .error{
      font-weight: bold;
   } 
   .capitalize-first-letter::first-letter {
        text-transform: capitalize;
    }
</style>
  <!-- page content -->
            <div class="right_col" role="main">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Salon Employee Designations</h3>
                        </div>
                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                        <!-- <div class="x_panel">
                            <div class="x_content">
                                <form method="post" name="master_form" id="master_form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                            <label>Add Designation<b class="require">*</b></label>
                                                <input type="text" class="form-control capitalize-first-letter" name="designation" id="designation" value="<?php if(!empty($single)){ echo $single->designation; }?>" placeholder="Enter designation">
                                                <input type="hidden" class="form-control" name="id" id="id" value="<?php if(!empty($single)){ echo $single->id; }?>">
                                                <div class="error" id="designation_error"></div>
                                        </div>
                                    </div>
                                    <div class="row"> 
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <button style="margin-top: 20px;" type="submit" id="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>  
                            </div> 
                        </div> -->
                            <div class="x_panel">
                                <div class="x_content">
                                <div class="col-md-12 col-sm-6 col-xs-12">
                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Designation Name</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                            <tbody>
                                                <?php if (!empty($designation_list)) {
                                                    $i = 1;
                                                    foreach ($designation_list as $designation_list_result) {
                                                        ?>
                                                        <tr>
                                                            <td scope="row"><?= $i++ ?></td>
                                                            <td><?= $designation_list_result->designation ?></td>
                                                                <!-- <?php if ($designation_list_result->designation == 'Stylist') { ?>
                                                                    <td>
                                                                        ---+---
                                                                    </td>
                                                                <?php }else{ ?>
                                                                    <td >
                                                                        <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?= base_url() ?>delete/<?= $designation_list_result->id ?>/tbl_emp_designation"><i class="fa-solid fa-trash"></i></a>
                                                                        <a title="Edit" class="btn btn-success" href="<?= base_url() ?>add-designation/<?= $designation_list_result->id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                                                    </td>
                                                                    <?php }?> -->
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

<script>
    $('#example').DataTable({ 
        dom: 'Blfrtip',
        responsive: false,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                
         buttons: [
                        
            {
                extend: 'excel',
                filename: 'add-designation',
                exportOptions: {
                    columns: [0,1] 
                }
            }
        ], 
    });
</script>
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
                        required: "Please enter designation name!", 
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
                $("#designation_error").html('This designation is already added!');
                $("#submit").hide();
            }
             
        },
         error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
        }); 
    }); 	 
    // document.getElementById('designation').addEventListener('input', function() {
    //     let value = this.value;
    //     this.value = value.charAt(0).toUpperCase() + value.slice(1);
    // });
                </script>

<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.add_designation').addClass('active_cc');
    });
</script>








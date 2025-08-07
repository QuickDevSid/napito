<?php include('header.php');?>
  <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Catagory Master                  
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
                                            <label>Add Catagory <b class="require">*</b></label>
                                            <input type="text" class="form-control" name="catagory_type" id="catagory_type" value="<?php if(!empty($single)){ echo $single->catagory_type; }?>">

                                            <div class="error" id="catagory_type_error"></div>
                                            <input type="hidden" class="form-control" name="id" id="id" value="<?php if(!empty($single)){ echo $single->id; }?>">
                                        </div>

 
                                        
                                        <div class="form-group">
                                            <button style="margin-top: 15px;" type="submit" id="submit" class="btn btn-success">Submit</button>
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
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($catagory_type_list)){
                                                $i=1;
                                                    foreach($catagory_type_list as $catagory_type_list_result){
                                            ?>
                                            <tr>
                                                <th scope="row"><?=$i++?></th>
                                                <td><?=$catagory_type_list_result->catagory_type?></td>
                                                <td>
                                                    <?php if($catagory_type_list_result->status == "1"){?>
                                                        <a title="Inctive" onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$catagory_type_list_result->id?>/tbl_catagory_type"><i class="fa-solid fa-toggle-on" style="color: blue; font-size: 25px;"></i></a>  
                                                    <?php }else{?>

                                                        <a title="Active" class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$catagory_type_list_result->id?>/tbl_catagory_type"><i class="fa-solid fa-toggle-off" style="font-size: 25px;"></i></a>    
                                                    <?php }?>
                                                </td>
                                                <td>
                                                    <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$catagory_type_list_result->id?>/tbl_catagory_type"><i class="fa-solid fa-trash"></i></a> 

                                                    <a title="Edit" class="btn btn-primary" href="<?=base_url()?>catagory-type/<?=$catagory_type_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a>    
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
                    catagory_type: {
                        required: true, 
                        noHTMLtags: true,
                    },
                },
                messages: {
                    catagory_type: {
                        required: "Please enter catagory", 
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
$("#catagory_type").keyup(function(){  
    $.ajax({
        type: "POST",
        url: "<?=base_url();?>admin/Ajax_controller/get_unique_catagory_type",
        data:{'catagory_type':$("#catagory_type").val(),'id':'<?=$id?>'},
        success: function(data){console.log(data);
            if(data == "0"){
                $("#catagory_type_error").html('');
                $("#submit").show();
            }else{
                $("#catagory_type_error").html('This catagory type is already added');
                $("#submit").hide();
            }
             
        },
         error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
        }); 
    });  
                </script>







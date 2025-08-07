<?php include('header.php');?>
  <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                   Add Category                
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
                                    <div class="container">
                                        <form method="post" name="master_form" id="master_form" enctype="multipart/form-data">

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>Add Category <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="category_type" id="category_type" value="<?php if(!empty($single)){ echo $single->category_type; }?>" placeholder="Enter category">

                                            <div class="error" id="category_type_error"></div>
                                            <input type="hidden" class="form-control" name="id" id="id" value="<?php if(!empty($single)){ echo $single->id; }?>">
                                        </div>
                                        <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                            <button style="margin-top: 15px;" type="submit" id="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </form>  <!------------end of form---->
                                    </div>  <!----------end of container-------->

                                </div>
                            </div>

                        </div>



                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    
                                    <!-- <div class="clearfix"></div> -->
                                </div>
                                <div class="x_content">

                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>Category</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($category_type_list)){
                                                $i=1;
                                                    foreach($category_type_list as $category_type_list_result){
                                            ?>
                                            <tr>
                                                <td scope="row"><?=$i++?></td>
                                                <td><?=$category_type_list_result->category_type?></td>
                                                <td>
                                                    <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>admin_delete/<?=$category_type_list_result->id?>/tbl_category_type"><i class="fa-solid fa-trash"></i></a> 

                                                    <a title="Edit" class="btn btn-success" href="<?=base_url()?>category-type/<?=$category_type_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a>    
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
                    category_type: {
                        required: true, 
                        noHTMLtags: true,
                    },
                },
                messages: {
                    category_type: {
                        required: "Please enter category!", 
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
$("#category_type").keyup(function(){  
    $.ajax({
        type: "POST",
        url: "<?=base_url();?>admin/Ajax_controller/get_unique_category_type",
        data:{'category_type':$("#category_type").val(),'id':'<?=$id?>'},
        success: function(data){console.log(data);
            if(data == "0"){
                $("#category_type_error").html('');
                $("#submit").show();
            }else{
                $("#category_type_error").html('This category type is already added!');
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
        responsive: false,
        lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
        buttons: [
            {
                extend: 'excel',
                filename: 'category-list',
                exportOptions: {
                    columns: [0,1] 
                }
            },
            
        ], 
    });
</script>



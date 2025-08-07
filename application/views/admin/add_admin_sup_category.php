<?php include('header.php'); ?>
<style type="text/css">
    .cc_row {
        margin-bottom: 15px;
    }

    .x_content form {
        display: block;
    }
    .x_content .btn-success {
        margin-left: 0px;
    }

   
    .form-group{
        padding-left: 0;
    }



    .label-block {
        height: 42px;
    }

    .label-block label {
        line-height: 42px;
        margin: 0px;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Category
                </h3>
            </div>

        </div>
        <!-- <div class="clearfix"></div> -->

        <div class="row">



            <div class="x_panel">
                <div class="x_content">
                    <div class="container">
                        <form method="post" name="master_form" id="master_form" enctype="multipart/form-data">

                                <div class="row cc_row">
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Gender<b class="require">*</b></label>
                                        <select class="form-select form-control chosen-select" name="gender" id="gender" onchange="checkuniquename()">
                                            <option value="">Select Gender</option>
                                            <option value="0" <?php if(!empty($single) && $single->gender == '0'){?>selected="selected"<?php }?>>Male</option>
                                            <option value="1" <?php if(!empty($single) && $single->gender == '1'){?>selected="selected"<?php }?>>Female</option>
                                        </select>
									    <div class="error" id="gender_error"></div>
                                    </div> 
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Add Category <b class="require">*</b></label>
                                        <input autocomplete="off" type="text" class="form-control" name="sup_category" id="sup_category" onkeyup="checkuniquename()" <?php if (isset($_GET['flag']) && base64_decode($_GET['flag']) == 'not_allowed') {
                                                                                                                                                echo 'readonly';
                                                                                                                                            } ?> value="<?php if (!empty($single)) {
                                                                                                                                                                                                                                                            echo $single->sup_category;
                                                                                                                                                                                                                                                        } ?>" placeholder="Enter category">

                                        <div class="error" id="sup_category_error"></div>
                                        <input autocomplete="off" type="hidden" class="form-control" name="id" id="id" value="<?php if (!empty($single)) {
                                                                                                                                    echo $single->id;
                                                                                                                                } ?>">
                                        <input autocomplete="off" type="hidden" class="form-control" name="old_category_image" id="old_category_image" value="<?php if (!empty($single)) {
                                                                                                                                                                    echo $single->category_image;
                                                                                                                                                                } ?>">
                                        <input autocomplete="off" type="hidden" class="form-control" name="old_sup_category" id="old_sup_category" value="<?php if (!empty($single)) {
                                                                                                                                                                echo $single->sup_category;
                                                                                                                                                            } ?>">
                                        <input autocomplete="off" type="hidden" class="form-control" name="old_sup_category_marathi" id="old_sup_category_marathi" value="<?php if (!empty($single)) {
                                                                                                                                                                                echo $single->sup_category_marathi;
                                                                                                                                                                            } ?>">
                                        <input autocomplete="off" type="hidden" class="form-control" name="not_allowed" id="not_allowed" value="<?php if (isset($_GET['flag']) && base64_decode($_GET['flag']) == 'not_allowed') {
                                                                                                                                                    echo base64_decode($_GET['flag']);
                                                                                                                                                } ?>">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Add Category In मराठी<b class="require">*</b></label>
                                        <input autocomplete="off" type="text" class="form-control" <?php if (isset($_GET['flag']) && $_GET['flag'] == base64_encode('not_allowed')) {
                                                                                                        echo 'readonly';
                                                                                                    } ?> name="sup_category_marathi" id="sup_category_marathi" value="<?php if (!empty($single)) {
                                                                                                                                                                                                                                                                            echo $single->sup_category_marathi;
                                                                                                                                                                                                                                                                        } ?>" placeholder="Enter category">
                                    </div>
                                    <!-- </div> 
                                    <div class="row cc_row">  -->
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Add Category Image<b class="require">*</b> <?php if (!empty($single) && $single->category_image != "") { ?> <a href="<?= base_url() ?>admin_assets/images/service_category_image/<?= $single->category_image ?>" target="_blank">View</a><?php } ?></label>
                                        <input autocomplete="off" type="file" class="form-control" name="category_image" id="category_image" value="<?php if (!empty($single)) {
                                                                                                                                                        echo $single->category_image;
                                                                                                                                                    } ?>" placeholder="Enter category">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Can You Set This Category as Default</label><br>
                                        <div class="label-block">
                                            <label>
                                                <input type="radio" class="form-select" name="default_status" id="default_status" value="1" <?php if (!empty($single) && $single->default_status == 1) { ?>checked="checked" <?php } ?>> Yes
                                            </label>
                                            <label>
                                                <input type="radio" class="form-select" name="default_status" id="default_status" value="0" <?php if (!empty($single) && $single->default_status == 0) { ?>checked="checked" <?php } ?>> No
                                            </label>
                                        </div>
                                    </div>
                                </div>



                            <div class="form-group col-md-12 col-sm-12 col-xs-12 " style="margin-left: 10px;">
                                <button type="submit" id="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>


        </div>


        <div class="page-title-2">
            <div class="title_left">
                <h3>
                    Category List
                </h3>
            </div>

        </div>


            <form class="row" style="margin-left: 22px;" method="get" name="" id="" enctype="multipart/form-data">
               
                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label>Gender</label>
                        <select class="form-select form-control chosen-select" name="filter_gender" id="filter_gender">
                            <option value="">Select Gender</option>
                            <option value="0" <?php if (isset($_GET['filter_gender']) && $_GET['filter_gender'] == '0') { ?>selected="selected" <?php } ?>>Male</option>
                            <option value="1" <?php if (isset($_GET['filter_gender']) && $_GET['filter_gender'] == '1') { ?>selected="selected" <?php } ?>>Female</option>
                        </select>
                        <div class="error" id="filter_gender_error"></div>
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <button type="submit" id="filter_submit" class="btn btn-success">Search</button>
                        <?php if (isset($_GET['filter_gender'])) { ?>
                            <a id="filter_reset" style="margin-top:22px;" class="btn btn-warning" href="<?= base_url(); ?><?= $this->uri->segment(1); ?>">Reset</a>
                        <?php } ?>
                    </div>
            
            </form>
            <div class="x_panel">
                <div class="">
                    <button id="toggle-drag" class="btn btn-primary">Enable Order Update</button>
                    <label class="error" id="error-drag"></label>
                </div>
                <div class="x_content">
                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                        <thead>
                            <tr>
                                <th style="width:8%;">Sr. No.</th>
                                <th style="width:10%;" class="handle_order hidden">Update Order</th>
                                <th style="width:10%;">View Order</th>
                                <th>Category</th>
                                <th>Category In मराठी</th>
                                <th>Gender</th>
                                <th>Category Image</th>
                                <th>Default Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($category_name_list)) {
                                $i = 1;
                                foreach ($category_name_list as $category_name_list_result) {
                                    if (!empty($category_name_list_result->admin_id)) {
                                        $category_services = $this->Admin_model->get_category_services($category_name_list_result->id);
                                        $admin_category_services = $this->Admin_model->get_category_admin_services($category_name_list_result->id);

                                        	?>
                                            <tr class="draggable-rows" data-gender="<?=$category_name_list_result->gender;?>" data-id="<?=$category_name_list_result->id;?>" data-order="<?=$category_name_list_result->order;?>">
                                                <td style="width:8%;" class="sr-no" scope="row"><?=$i++?></td>
                                                <td style="width:10%;cursor:grab;" class="handle handle_order hidden order">
                                                    <i class="fas fa-grip-vertical"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td style="width:10%;" class="sr-no">
                                                    <?= $category_name_list_result->order != "" ? (int)$category_name_list_result->order : 0; ?>
                                                </td>
                                                <td><?=$category_name_list_result->sup_category?></td>
                                                <td><?=$category_name_list_result->sup_category_marathi?></td>
                                                <td>
                                                    <?php 
                                                        if($category_name_list_result->gender == '1'){
                                                            echo 'Female';
                                                        }elseif($category_name_list_result->gender == '0'){
                                                            echo 'Male';
                                                        }else{
                                                            echo '-';
                                                        }
                                                    ?>
                                                </td>
                                                <td><button class="photo-btn"><a target="_blank" href="<?= base_url() ?>\admin_assets\images\service_category_image/<?= $category_name_list_result->category_image ?>" target="_blank">View</a></button> </td>
                                                <td><?=$category_name_list_result->default_status == 1 ? 'Yes' : 'No'?></td>
                                                <td>
                                                    <?php if(empty($admin_category_services) && empty($category_services)){ ?>
                                                        <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>admin_delete/<?=$category_name_list_result->id?>/tbl_admin_service_category"><i class="fa-solid fa-trash"></i></a>	
                                                        <a title="Edit" class="btn btn-success" href="<?=base_url()?>add-admin-sup-category/<?=$category_name_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a>	
                                                    <?php }else{ ?>
                                                        <a title="Edit" class="btn btn-success" href="<?=base_url()?>add-admin-sup-category/<?=$category_name_list_result->id?>?flag=<?=base64_encode('not_allowed')?>"><i class="fa-solid fa-pen-to-square"></i></a>	
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                <?php }
                                    }
                                } ?>
                            </tbody>
                        </table>

            </div>
        </div>

    </div>


</div>
<?php include('footer.php');
$id = '0';
if ($this->uri->segment(2) != "") {
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
                    gender: {
                        required: true, 
                    },
                    <?php if(!empty($single) && $single->category_image == ""){?>
                        category_image: {
                            required: true, 
                            noHTMLtags: true,
                        },
                    <?php } ?>
                    
                },
                messages: {
                    sup_category: {
                        required: "Please enter service name!", 
                        noHTMLtags: "HTML tags not allowed!",
                    },
                    sup_category_marathi: {
                        required: "Please enter sup category marathi!", 
                        noHTMLtags: "HTML tags not allowed!",
                    },
                    gender: {
                        required: "Please select gender!", 
                    },
                    <?php if(!empty($single) && $single->category_image == ""){?>
                    category_image: {
                        required: "Please upload category image!    ", 
                        noHTMLtags: "HTML tags not allowed!",
                    },
                    <?php } ?>
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
        function checkuniquename(){
            $.ajax({
                type: "POST",
                url: "<?=base_url();?>admin/Ajax_controller/get_unique_sup_category",
                data:{'gender':$("#gender").val(),'sup_category':$("#sup_category").val(),'id':'<?=$id?>'},
                success: function(data){
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
        }
                </script>
                <script type="text/javascript">
                        $(document).ready(function () {
                            $(".chosen-select").chosen({
                                 
                            });
                        });
                    </script>
<script>
     $('#category_image').on('change', function() {
        // alert();
          var fileName = $(this).val();
          var extension = fileName.substring(fileName.lastIndexOf('.') + 1).toLowerCase();
          //alert(fileName);
          var allowedExtensions = ['png', 'jpg', 'jpeg', 'pdf'];
          if ($.inArray(extension, allowedExtensions) === -1) {
              alert('Only .png, .jpg, .jpeg, .pdf files are allowed.');
              // Clear the file input field
              $(this).val('');
          }
    });
</script>
<script>
    $(document).ready(function () {
        let dragEnabled = false;
              
        var table = $('#example').DataTable({ 
            dom: 'Blfrtip',
            responsive: true,
            lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],            
            buttons: [
                {
                    extend: 'excel',
                    filename: 'category-list',
                    exportOptions: {
                        columns: [0,2,3,4,6,7] 
                    }
                },
            ], 
        });

        $('#toggle-drag').click(function () {
            $('#error-drag').text('');
            var pageInfo = table.page.info();
            if (pageInfo.pages > 1) {
                $('#error-drag').text('Please load all entries on one page to enable order update.');
                return;
            }

            if($('#filter_gender').val() == ""){
                $('#error-drag').text('Please first filter the entries based on gender to enable order update.');
                return;
            }

            dragEnabled = !dragEnabled;

            if (dragEnabled) {
                $(this).text('Disable Order Update');
                $('.handle_order').removeClass('hidden');
                enableDragAndDrop();
            } else {
                $(this).text('Enable Order Update');
                $('.handle_order').addClass('hidden');
                disableDragAndDrop();
            }
        });

        function enableDragAndDrop() {
            $('#error-drag').text('');
            $('#example tbody').sortable({
                handle: '.handle',
                update: function(event, ui) {
                    var order = [];
                    $('.draggable-rows').each(function(index, element) {
                        var id = $(this).data('id');
                        var gender = $(this).data('gender');
                        $(this).data('order', index + 1);
                        
                        if (id) {
                            order.push({
                                id: id,
                                gender: gender,
                                order: index + 1
                            });
                        }
                    });

                    $.ajax({
                        url: '<?=base_url();?>admin/Ajax_controller/update_service_category_order',
                        method: 'POST',
                        data: { order: order },
                        dataType: 'json',
                        success: function(response) {
                            console.log('Order updated successfully', response);

                            $('.draggable-rows').each(function(index) {
                                var newOrder = index + 1;
                                
                                // $(this).find('.order').html('<i class="fas fa-grip-vertical"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+newOrder);
                                $(this).find('.order').html('<i class="fas fa-grip-vertical"></i>');
                                $(this).find('.sr-no').text(newOrder);
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log('An error occurred while updating the order', error);
                        }
                    });
                }
            }).disableSelection();
        }
        function disableDragAndDrop() {
            $('#error-drag').text('');
            $("#example tbody").sortable("destroy");
        }
    });
</script>






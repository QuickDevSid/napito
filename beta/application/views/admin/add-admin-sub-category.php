<?php include('header.php'); ?>
<style type="text/css">
    .error {
        font-weight: bold;
    }

    .chosen-container a {
        background-color: white !important;
        height: 34px !important;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Sub Category
                </h3>
            </div>

            <!-- <div class="title_right">
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
                            <form method="post" name="master_form" id="master_form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Gender<b class="require">*</b></label>
                                        <select class="form-select form-control chosen-select" name="gender" id="gender" onchange="fetchGenderCategories()">
                                            <option value="">Select Gender</option>
                                            <option value="0" <?php if(!empty($single) && $single->gender == '0'){?>selected="selected"<?php }?>>Male</option>
                                            <option value="1" <?php if(!empty($single) && $single->gender == '1'){?>selected="selected"<?php }?>>Female</option>
                                        </select>
									    <div class="error" id="gender_error"></div>
                                    </div> 
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Select Category <b class="require">*</b></label>
                                        <select class="form-select form-control chosen-select" name="sup_category"
                                            id="sup_category">
                                            <option value="" class="">Select Category</option>
                                            <?php 
                                            if(!empty($single)){
                                                $sup_category = $this->Admin_model->get_gender_categories($single->gender);
                                            }
                                            if (!empty($sup_category)) {
                                                foreach ($sup_category as $sup_category_result) { 
                                                    if($sup_category_result->gender == '1'){
                                                        $gender = ' - [Female]';
                                                    }elseif($sup_category_result->gender == '0'){
                                                        $gender = ' - [Male]';
                                                    }else{
                                                        $gender = '';
                                                    }
                                                    ?>

                                                    <option value="<?= $sup_category_result->id ?>" <?php if (!empty($single) && $single->sup_category == $sup_category_result->id) { ?>selected="selected" <?php } ?>><?= $sup_category_result->sup_category ?>|<?= $sup_category_result->sup_category_marathi; ?> <?=$gender;?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                        <input type="hidden" name="id" id="id" value="<?php if (!empty($single)) { echo $single->id; } ?>">
                                        <input type="hidden" name="old_sup_category" id="old_sup_category" value="<?php if (!empty($single)) { echo $single->sup_category; } ?>">
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Add Sub Category <b class="require">*</b></label>
                                        <input type="text" class="form-control" name="sub_category" id="sub_category"
                                            value="<?php if (!empty($single)) {
                                                echo $single->sub_category;
                                            } ?>"
                                            placeholder="Enter sub category">
                                    </div>
                                    <!-- </div>
                                    <div class="row"> -->
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Add Sub Category in मराठी<b class="require">*</b></label>
                                        <input type="text" class="form-control" name="sub_category_marathi" id="sub_category_marathi"
                                            value="<?php if (!empty($single)) {
                                                echo $single->sub_category_marathi;
                                            } ?>"
                                            placeholder="Enter sub category in Marathi">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Add Image <b class="require">*</b>
                                            <?php if(!empty($single) && $single->image != ""){ ?>
                                                <a target="_blank" href="<?=base_url();?>admin_assets/images/service_category_image/<?=$single->image;?>" style="text-decoration:underline;">View</a>
                                            <?php } ?>
                                        </label>
                                        <input autocomplete="off" accept=".jpg,.jpeg,.png" type="file" class="form-control" name="category_image" id="category_image" value="<?php if(!empty($single)){ echo $single->image; }?>">
                                        <input type="hidden" name="old_category_image" id="old_category_image" value="<?php if (!empty($single)) { echo $single->image; } ?>">
                                    </div>
                                </div>
                                <div style="padding-left: 0px;" class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <button style="margin-top: 15px;" type="submit" id="submit"
                                            class="btn btn-success">Submit</button>
                                </div>    
                            </form> <!------------end of form---->
                        </div> <!----------end of container-------->

                    </div>
                </div>

            </div>
            </div>



            <div class="page-title">

            <div class="title_left">
                <h3>
                    Sub Category List
                </h3>
            </div>
            </div>
            <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <form method="get" name="" id="" enctype="multipart/form-data">
                    <div class="row cc_row">
                        <div style="margin-left: 10px;" class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label>Gender</label>
                            <select class="form-select form-control chosen-select" name="filter_gender" id="filter_gender">
                                <option value="">Select Gender</option>
                                <option value="0" <?php if(isset($_GET['filter_gender']) && $_GET['filter_gender'] == '0'){?>selected="selected"<?php }?>>Male</option>
                                <option value="1" <?php if(isset($_GET['filter_gender']) && $_GET['filter_gender'] == '1'){?>selected="selected"<?php }?>>Female</option>
                            </select>
                            <div class="error" id="filter_gender_error"></div>
                        </div> 
                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <button type="submit" id="filter_submit" class="btn btn-success">Search</button>
                            <?php if(isset($_GET['filter_gender'])){ ?>
                                <a id="filter_reset" style="margin-top:22px;" class="btn btn-warning" href="<?=base_url();?><?=$this->uri->segment(1);?>">Reset</a>
                            <?php } ?>
                        </div>
                    </div>
                </form>
                <div class="x_panel">
                    <div class="x_title">
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
                                    <th>Sub Category</th>
                                    <th>Gender</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($sub_category_list)) {
                                    $i = 1;
                                    foreach ($sub_category_list as $sub_category_list_result) {
                                        $category_services = $this->Admin_model->get_subcategory_services($sub_category_list_result->id);
                                        $admin_category_services = $this->Admin_model->get_subcategory_admin_services($sub_category_list_result->id);

                                    ?>
                                        <tr class="draggable-rows" data-gender="<?=$sub_category_list_result->gender;?>" data-id="<?=$sub_category_list_result->id;?>" data-order="<?=$sub_category_list_result->order;?>">
                                            <td style="width:8%;" class="sr-no" scope="row">
                                                <?= $i++ ?>
                                            </td>
                                            <td style="width:10%;cursor:grab;" class="handle handle_order hidden order">
                                                <i class="fas fa-grip-vertical"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </td>
                                            <td style="width:10%;" class="sr-no">
                                                <?= $sub_category_list_result->order != "" ? (int)$sub_category_list_result->order : 0; ?>
                                            </td>
                                            <td><?= $sub_category_list_result->sup_category?></td>
                                            <td><?= $sub_category_list_result->sub_category?>|<?= $sub_category_list_result->sub_category_marathi?></td>
                                                <td>
                                                    <?php 
                                                        if($sub_category_list_result->gender == '1'){
                                                            echo 'Female';
                                                        }elseif($sub_category_list_result->gender == '0'){
                                                            echo 'Male';
                                                        }else{
                                                            echo '-';
                                                        }
                                                    ?>
                                                </td>
                                            <td>
                                                <?php if($sub_category_list_result->image != ""){ ?>
                                                    <a download href="<?=base_url();?>admin_assets/images/service_category_image/<?=$sub_category_list_result->image;?>">
                                                        <img src="<?=base_url();?>admin_assets/images/service_category_image/<?=$sub_category_list_result->image;?>" style="width:75px;">
                                                    </a>
                                                <?php }else{ echo '-'; } ?>
                                            </td>
                                            <td>
                                            <?php if(empty($admin_category_services) && empty($category_services)){ ?>
                                                <a title="Delete" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure to delete this record?');"
                                                    href="<?= base_url() ?>admin_delete/<?= $sub_category_list_result->id ?>/tbl_admin_sub_category"><i
                                                        class="fa-solid fa-trash"></i></a>

                                                <a title="Edit" class="btn btn-success"
                                                    href="<?= base_url() ?>add-admin-sub-category/<?= $sub_category_list_result->id ?>"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                                        <?php }else{ echo '-'; }?>
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
$id = '0';
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>


<script>
    $(document).ready(function () {  
        jQuery.validator.addMethod("validate_email", function (value, element) {
            if (/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value)) {
                return true;
            } else {
                return false;
            }
        }, "Please enter a valid Email.");
        jQuery.validator.addMethod("noHTMLtags", function (value, element) {
            if (this.optional(element) || /<\/?[^>]+(>|$)/g.test(value)) {
                if (value == "") {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        }, "HTML tags are Not allowed.");
        $('#master_form').validate({
            ignore: "hidden",
            rules: {
                gender: {
                    required: true,
                },
                sub_category: {
                    required: true,
                    noHTMLtags: true,
                },
                sup_category: {
                    required: true,
                    noHTMLtags: true,
                },
                sub_category_marathi: {
                    required: true,
                    noHTMLtags: true,
                },
                category_image: {
                    required: function(element) {
                        return $('#old_category_image').val() == '';
                    }
                },
            },
            messages: {
                gender: {
                    required: "Please select gender",
                },
                sup_category: {
                    required: "Please select category",
                    noHTMLtags: "HTML tags not allowed!",
                },
                sub_category: {
                    required: "Please enter sub category",
                    noHTMLtags: "HTML tags not allowed!",
                },
                sub_category_marathi: {
                    required: "Please enter sub category in marathi",
                    noHTMLtags: "HTML tags not allowed!",
                },
                category_image: {
                    required: "Please upload image",
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
<script type="text/javascript">
    $(document).ready(function () {
        $(".chosen-select").chosen({
             
        });
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
                    filename: 'admin-sub-category-list',
                    exportOptions: {
                        columns: [0,1,2,3,4] 
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
                        url: '<?=base_url();?>admin/Ajax_controller/update_service_subcategory_order',
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
	function fetchGenderCategories(){
		$.ajax({
			type: "POST",
			url: "<?= base_url(); ?>admin/Ajax_controller/get_gender_categories_ajax",
			data: {	'gender': $("#gender").val() },
			success: function(data) {
				$("#sup_category").empty();
				$('#sup_category').append('<option value="">Select Category</option>');
				var opts = $.parseJSON(data);
				$.each(opts, function(i, d) {
                    if(d.gender == '0'){
                        var gender = ' - [Male]';
                    }else if(d.gender == '1'){
                        var gender = ' - [Female]';
                    }else{
                        var gender = '';
                    }
					if(d.id == $('#old_sup_category').val()){
						$('#sup_category').append('<option selected value="' + d.id + '">' + d.sup_category + '|' + d.sup_category_marathi + '' + gender + '</option>');
					}else{
						$('#sup_category').append('<option value="' + d.id + '">' + d.sup_category + '|' + d.sup_category_marathi + '' + gender + '</option>');
					}
				});
				$('#sup_category').trigger('chosen:updated');
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	}
</script>
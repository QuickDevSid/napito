<?php include('header.php');?>
<style type="text/css">
    .input-content-option {
        height: 33px;
        width: 570px;

    }

    a.btn.btn-danger.remove {
        margin-top: 5px;
    }

    input[class="dashboardToggle"] {
        position: relative;
        appearance: none;
        width: 50px;
        height: 25px;
        background: #ccc;
        border-radius: 50px;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        transition: 0.4s;
    }


	input[class="dashboardToggle"]::after {
		position: absolute;
		content: "";
		width: 25px;
		height: 25px;
		top: 0;
		left: 0;
		background: #fff;
		border-radius: 50%;
		box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
		transform: scale(1.1);
		transition: 0.4s;
	}

	
</style>

  <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Add Tips                 
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
                        <form method="post" name="master_form" id="master_form" enctype="multipart/form-data">
                            <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <label>Add Tips <b class="require">*</b></label>
                                            <input type="text" class="form-control" name="tips" id="tips" value="<?php if (!empty($single)) {
                                                                                                                        echo $single->tips;
                                                                                                                    } ?>" placeholder="Enter tips name">

                                            <div class="error" id="facility_name_error"></div>
                                            <input type="hidden" class="form-control" name="id" id="id" value="<?php if (!empty($single)) {
                                                                                                                    echo $single->id;
                                                                                                                } ?>">
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <label>Upload Photo <b class="require">*</b>
                                                <?php if (!empty($single) && $single->tips_photo != "") { ?>
                                                    <?php for ($i = 0; $i < count(explode(',', $single->tips_photo)); $i++) { ?>
                                                        <a title="View" href="<?= base_url() ?>admin_assets/images/tips_photo/<?= explode(',', $single->tips_photo)[$i] ?>" target="_blank"><i class="fas fa-eye"></i></a>
                                                    <?php } ?>
                                                <?php } ?>
                                            </label>
                                            <input style="height: 50px;border: 0px;" type="file" accept=".png,.jpg.jpeg" class="form-control" name="tips_photo[]" id="tips_photo" multiple>
                                            <input style="height: 50px;border: 0px;" type="hidden" class="form-control" name="old_tips_photo" id="old_tips_photo" value="<?php if (!empty($single)) {
                                                                                                                                                                                echo $single->tips_photo;
                                                                                                                                                                            } ?>">
                                            <div class="error" id="facility_name_error"></div>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12" id="common_description">
                                            <label>Common Description <b class="require">*</b></label>
                                            <textarea type="text" class="form-control full-featured-non-premium" name="description" id="description" placeholder="Enter description"><?php if (!empty($single)) {
                                                                                                                                                                                            echo $single->description;
                                                                                                                                                                                        } ?></textarea>
                                            <div class="error" id="facility_name_error"></div>
                                        </div>
                                    </div>
                                </div>
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label>Add Items ? </label>
                                            <input style="height: 25px !important; display:block;margin-bottom: 15px;" type="checkbox" name="add_items" id="add_items" class="dashboardToggle" <?php if (!empty($single) && $single->add_items == '1') {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                } ?>>
                                        </div>
                                    </div>
                                    <div class="row optionBox" id="items_div" <?php if (!empty($single) && $single->add_items == '1') {
                                                                                    echo 'style="display:block;"';
                                                                                } else {
                                                                                    echo 'style="display:none;"';
                                                                                } ?>>
                                        <?php
                                        $total = 0;
                                        $i = 0;
                                        if (!empty($title_details)) {
                                            foreach ($title_details as $expsense_details_result) {
                                        ?>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 block">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Title <b class="require">*</b></label>
                                                                <input type="text" class="form-control" placeholder="Enter Title" id="item_name" name="item_name[]" value="<?= $expsense_details_result->item_name ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label style="display:block; visibility:hidden;">adds</label>
                                                                <a href="javascript:void(0)" class="btn btn-danger remove"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Description <b class="require">*</b></label>
                                                                <textarea class="form-control item_description full-featured-non-premium" placeholder="Enter Description" id="item_description_<?= $i; ?>" name="item_description[]"><?= $expsense_details_result->description ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        } else { ?>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 block">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Title <b class="require">*</b></label>
                                                            <input type="text" class="form-control" placeholder="Enter Title" id="item_name_<?= $i; ?>" name="item_name[]" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label style="display:block; visibility:hidden;">sdads</label>
                                                            <a class="btn btn-danger remove" href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Description <b class="require">*</b></label>
                                                            <textarea class="form-control item_description full-featured-non-premium" placeholder="Enter Description" id="item_description_<?= $i; ?>" name="item_description[]"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="col-md-12 block" style="margin-top: 10px;">
                                            <a href="javascript:void(0)" class="btn btn-primary add">Add More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button style="margin-top: 30px;" type="submit" id="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                    </div>
                    <div class="x_content">

                        <table id="example" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Tips Name</th>
                                    <th>Images</th>
                                    <th>Common Description</th>
                                    <th>Other Titles</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($tips_list)) {
                                    $i = 1;
                                    foreach ($tips_list as $tips_list_result) {
                                        $single_title_details = $this->Master_model->get_single_tip_titles($tips_list_result->id);
                                ?>
                                        <tr>
                                            <td scope="row"><?= $i++ ?></td>
                                            <td><?= $tips_list_result->tips ?></td>
                                            <td>
                                                <?php for ($i = 0; $i < count(explode(',', $tips_list_result->tips_photo)); $i++) { ?>
                                                    <a title="View" target="_blank" href="<?= base_url() ?>admin_assets/images/tips_photo/<?= explode(',', $tips_list_result->tips_photo)[$i] ?>" target="_blank"><i class="fas fa-eye"></i></a>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <button type="button" onclick="showDevicePopup('exampleModal_<?= $tips_list_result->id; ?>')" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_<?= $tips_list_result->id; ?>">
                                                    View
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" onclick="showRemarkMessage('<?= $tips_list_result->id; ?>')" data-toggle="modal" data-target="#MessageRemarkModal" class="btn btn-primary">
                                                    View
                                                </button>
                                            </td>
                                            <td>
                                                <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?= base_url() ?>admin_delete/<?= $tips_list_result->id ?>/tbl_tips_master"><i class="fa-solid fa-trash"></i></a>

                                                <a title="Edit" class="btn btn-success" href="<?= base_url() ?>add-tips/<?= $tips_list_result->id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="exampleModal_<?= $tips_list_result->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_<?= $tips_list_result->id; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel_<?= $tips_list_result->id; ?>">Common Description</h5>
                                                        <button type="button" style="margin-top: -25px;" class="close" data-dismiss="modal" aria-label="Close" onclick="closeDevicePopup('exampleModal_<?= $tips_list_result->id; ?>')">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php if ($tips_list_result->description != "") { ?>
                                                            <p><?= $tips_list_result->description ?></p>
                                                        <?php } else { ?>
                                                            <div style="text-align:center;">
                                                                <label class="error">Data Not Available</label>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>


    </div>

<div class="modal fade" id="MessageRemarkModal" tabindex="-1" aria-labelledby="MessageRemarkModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="width:1000px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="MessageRemarkModalLabel" style="display: flex; justify-content: space-between; align-items: center;">
                    <span id="remark_response_text_heading">Other Titles</span>
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;" onclick="closePopup('MessageRemarkModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="MessageRemarkModalResponse"></div>
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
<script src="https://cdn.jsdelivr.net/npm/tinymce@5/tinymce.min.js" referrerpolicy="origin"></script>


                <script>
 var validator; 
 var i = '<?php echo $i; ?>';
                    $(document).ready(function () {     
                        document.getElementById('add_items').addEventListener('change', function() {
                            var isChecked = this.checked;
                            if(isChecked){
                                $('#items_div').show();
                            }else{
                                $('#items_div').hide();
                            }
                        });

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
            $.validator.addMethod("requiredTinymce", function (value, element) {
                return tinymce.get(element.id).getContent() !== '';
            }, "Please enter a description!");
            validator = $('#master_form').validate({
                ignore: ":hidden:not(select)",
                rules: {
                    tips: {
                        required: true, 
                        noHTMLtags: true,
                    },
                    description: {
                        required: true, 
                        requiredTinymce: true,
                    },
                    'tips_photo[]': {
                        required: function(element) {
                            return $('#old_tips_photo').val() == '';
                        },
                        noHTMLtags: true,
                    },
                    'item_name[]': 'required',
                    'item_description[]': 'required',
                },
                messages: {
                    tips: {
                        required: "Please enter tips name!", 
                        noHTMLtags: "HTML tags not allowed!",
                    },
                     description: {
                        required: "Please enter description!", 
                    },
                    'tips_photo[]': {
                        required: "Please upload image!", 
                        noHTMLtags: "HTML tags not allowed!",
                    },
                    'item_name[]': 'Please enter item!', 
                    'item_description[]': 'Please enter description!', 
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
$("#tips").keyup(function(){  
	$.ajax({
		type: "POST",
		url: "<?=base_url();?>admin/Ajax_controller/get_unique_tips_name",
		data:{'tips':$("#tips").val(),'id':'<?=$id?>'},
		success: function(data){console.log(data);
			if(data == "0"){
				$("#facility_name_error").html('');
				$("#submit").show();
			}else{
				$("#facility_name_error").html('This tips is already added');
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
            filename: 'tips-list',
            exportOptions: {
                columns: [0,1,2,3] 
            }
        },
        
        
    ], 
});
</script>

<script>
    tinymce.init({
        selector: 'textarea.full-featured-non-premium',
        plugins: 'image link lists textcolor',
        menubar: false,
        // toolbar: 'undo redo | bold italic underline | forecolor backcolor | alignleft aligncenter alignright | numlist bullist | image link',
        toolbar: 'undo redo | bold italic underline | forecolor backcolor | alignleft aligncenter alignright | numlist bullist',
        height: 200,
        image_advtab: true,
        file_picker_types: 'image',
    });



                                
$('.add').click(function() {
    const newItemHtml = `
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 block">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Title <b class="require">*</b></label>
                        <input type="text" class="form-control" placeholder="Enter Title" id="item_name_${i}" name="item_name[]">
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label style="display:block; visibility:hidden;">Delete</label>
                        <a href="javascript:void(0)" class="btn btn-danger remove"><i class="fa fa-trash"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Description <b class="require">*</b></label>
                        <textarea class="form-control item_description full-featured-non-premium" placeholder="Enter Description" id="item_description_${i}" name="item_description[]"></textarea>
                    </div>
                </div>
            </div>
        </div>
    `;

    $('.block:last').before(newItemHtml);

    i++;

    tinymce.init({
        selector: 'textarea.full-featured-non-premium',
        plugins: 'image link lists textcolor',
        menubar: false,
        // toolbar: 'undo redo | bold italic underline | forecolor backcolor | alignleft aligncenter alignright | numlist bullist | image link',
        toolbar: 'undo redo | bold italic underline | forecolor backcolor | alignleft aligncenter alignright | numlist bullist',
        height: 200,
        image_advtab: true,
        file_picker_types: 'image',
    });
});

$('.optionBox').on('click', '.remove', function() {
    $(this).closest('.block').remove();
});

  
function showPopup(id){
        var exampleModal = $('#'+id);
        exampleModal.modal('show');
    }
    function closePopup(id){
        var exampleModal = $('#'+id);
        exampleModal.modal('hide');
    }
function showDevicePopup(id){
        var exampleModal = $('#'+id);
        exampleModal.css('display','block');
        exampleModal.css('opacity','1');
        $('.modal-open').css('overflow','auto').css('padding-right','0px'); 
    }
    function closeDevicePopup(id){
        var exampleModal = $('#'+id);
        exampleModal.css('display','none');
        exampleModal.css('opacity','0');
        $('.modal-open').css('overflow','auto').css('padding-right','0px');
    }  

    
    function showRemarkMessage(id){
        $.ajax({
            url: "<?= base_url(); ?>admin/Ajax_controller/get_tips_other_titles_ajx",
            method: 'POST',
            data: { id: id },
            success: function(response) {
                $('#MessageRemarkModalResponse').html(response)
                showPopup('MessageRemarkModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching details:', error);
                alert("Error fetching details");
            }
        });
    }
</script>





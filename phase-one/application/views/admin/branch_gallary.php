<?php include('header.php'); ?>
<style type="text/css">
    .error {
        font-weight: bold;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                   Branch Gallary for <?php if(!empty($salon_name)){ echo $salon_name->salon_name;}?>
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
                        <form method="post" name="gallary_form" id="gallary_form" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Select Catagory <b class="require">*</b></label>
										<select class="form-select form-control" name="category" id="category">
											<option value="" class="">Select Category</option>
											<?php if (!empty($gallary_category)) {
												foreach ($gallary_category as $gallary_category_result) { ?>

													<option value="<?= $gallary_category_result->id ?>" <?php if (!empty($single) && $single->category == $gallary_category_result->id) { ?>selected="selected" <?php } ?>><?= $gallary_category_result->category_type ?></option>
												<?php }
											} ?>  
										</select> 
										<input type="hidden" class="form-control" name="branch_id" id="branch_id" value="<?php echo $this->uri->segment(2); ?>">
										<label style="margin-left: 10px; display: none;" id="catagory-error" class="error col-md-12" for="catagory"></label>
									</div> 
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Upload Image <b class="require">*</b></label>
										<input style="height: 50px;border: 0px;" type="file" class="form-control" name="gallary_image[]" id="gallary_image" value="<?php if (!empty($single)) { echo $single->gallary_image;} ?>" multiple>
										<div class="error" id="gallary_image_error"></div>
									</div> 
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<button type="submit" id="submit" class="btn btn-success">Submit</button>
									</div>
								</div>
							</div>
                        </form>  
                    </div> 
                </div>
            </div>  
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="x_panel">
					<div class="x_title"></div>
					<div class="x_content"> 
						<table id="example" class="table table-striped responsive-utilities jambo_table" style="width:100%">
							<thead>
								<tr>
									<th>Sr. No.</th>
									<th>Catagory</th>
									<th>Image</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($gallary_list)) {
									$i = 1;
									foreach ($gallary_list as $gallary_list_result) {
								?>
										<tr>
											<th scope="row">
												<?= $i++ ?>
											</th>
											<td><?= $gallary_list_result->category_type ?></td>
											<td><a target="_blank" href="<?=base_url()?>admin_assets/images/gallary_image/<?= $gallary_list_result->gallary_image ?>">View</a></td>
											<td>
												<a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete_branch_images/<?=$gallary_list_result->id?>/<?=$gallary_list_result->gallary_image?>"><i class="fa-solid fa-trash"></i></a>
												<a title="Edit" class="btn btn-success" href="<?= base_url() ?>branch-gallary/<?= $gallary_list_result->id ?>"><i class="fa-solid fa-pen-to-square"></i></a> 
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
 $('#example').DataTable({ 
	dom: 'Blfrtip',
	responsive: false,
	scrollX:300,
	lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
			
	 buttons: [
					
		{
			extend: 'excel',
			filename: 'add-package',
			exportOptions: {
				//columns: [0,1,2,3,4,5,6,7,8] 
			}
		}
	], 
});
    $(document).ready(function() {
        jQuery.validator.addMethod("validate_email", function(value, element) {
            if (/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value)) {
                return true;
            } else {
                return false;
            }
        }, "Please enter a valid Email.");
        jQuery.validator.addMethod("noHTMLtags", function(value, element) {
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
        $('#gallary_form').validate({
            ignore: "",
            rules: {
                "category": {
                    required: true,
                    noHTMLtags: true,
                },

                "gallary_image[]": {
                    required: true,
                    noHTMLtags: true,
                },
            },
            messages: {

                "category": {
                    required: "Please enter catagory!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                "gallary_image[]": {
                    required: "Please upload image!",
                    noHTMLtags: "HTML tags not allowed!",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
    $("#sub_catagory").keyup(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/Ajax_controller/get_unique_sub_catagory",
            data: {
                'sub_catagory': $("#sub_catagory").val(),
                'id': '<?= $id ?>'
            },
            success: function(data) {
                console.log(data);
                if (data == "0") {
                    $("#sub_catagory_error").html('');
                    $("#submit").show();
                } else {
                    $("#sub_catagory_error").html('This catagory type is already added');
                    $("#submit").hide();
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".chosen-select").chosen({
             
        });
    });
</script>
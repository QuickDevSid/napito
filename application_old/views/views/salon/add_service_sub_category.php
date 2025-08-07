<?php include('header.php'); ?>
<style type="text/css">
    .error {
        color: red;
        float: left;
       
    }

     

    .chosen-select {
        height: 35px !important;
        border-radius: 5px !important;
        border: solid gray 1px !important;
    }
</style>
<div class="right_col" role="main">
        <div class="page-title">
            <div class="title_left">
                <h3>
                   Add Services Sub Category
                </h3>
            </div>

            <div class="title_right">
                
            </div>
        </div>

                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <form method="post" name="service_form" id="service_form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Select Category <b class="require">*</b></label>
                                        <select class="form-select form-control chosen-select" name="category" id="category">
                                            <option value="">Select Category</option>
                                            <?php if (!empty($category)) {
                                                foreach ($category as $category_result) { ?> 
                                                    <option value="<?= $category_result->id ?>" <?php if (!empty($single) && $single->category_id == $category_result->id) { ?>selected="selected" <?php } ?>><?=$category_result->sup_category?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
									<input type="hidden" class="form-select form-control" placeholder="Enter Sub Category" name="id" id="id" value="<?php if (!empty($single)){ echo $single->id;} ?>"> 
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Sub Category <b class="require">*</b></label>
                                        <input type="text" class="form-select form-control" placeholder="Enter Sub Category" name="sub_category" id="sub_category" value="<?php if (!empty($single)){ echo $single->sub_category;} ?>"> 
                                    </div>
									<div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label>Sub Category <small>(in Marathi)</small><b class="require">*</b></label>
                                        <input type="text" class="form-select form-control" placeholder="Enter Sub Category" name="sub_category_marathi" id="sub_category_marathi" value="<?php if (!empty($single)){ echo $single->sub_category_marathi;} ?>"> 
                                    </div>
                                       
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-top: 35px; margin-left: 25px;">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <div class="btn btn-info"><a href="<?= base_url(); ?>add-sub-category" style="color: white;"> Add Services</a></div>
                                        </div>
                                    <div>
                                <div>
                            </form>
                        </div> 
                    </div>
                </div>
        
        <div class="row">    
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_title">
                    <h3>Services Sub Category List</h3>
                </div>
                            <div class="x_panel">
                                <div class="x_content">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>Category</th>
                                                <th>Sub Category</th>
                                                <th>Sub Category Marathi</th> 
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php if(!empty($category_name_list)){
                                        		$i=1;
                                        			foreach($category_name_list as $category_name_list_result){
                                        	?>
                                            <tr>
                                                <th scope="row"><?=$i++?></th>
                                                <td><?=$category_name_list_result->sup_category?></td>
                                                <td><?=$category_name_list_result->sub_category?></td>
                                                <td><?=$category_name_list_result->sub_category_marathi?></td> 
                                                <td>
                                                    <?php if($category_name_list_result->status == "1"){?>
                                                        <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$category_name_list_result->id?>/tbl_service_sub_category"><i class="fa-solid fa-toggle-on"></i></a>  
                                                    <?php }else{?>

                                                        <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$category_name_list_result->id?>/tbl_service_sub_category"><i class="fa-solid fa-toggle-off"></i></a> 
                                                    <?php }?>
                                                </td>
                                                <td>
                                                	<a  title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$category_name_list_result->id?>/tbl_service_sub_category"><i class="fa-solid fa-trash"></i></a>	

                                                	<a  title="Edit" class="btn btn-success" href="<?=base_url()?>add_service_sub_category/<?=$category_name_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a>	
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
<?php include('footer.php');
$id = 0;
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>
<script type="text/javascript">
    $(document).ready(function () {
        $(".chosen-select").chosen({
             
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#service_form').validate({
            ignore: "",
            rules: {
                category: 'required',
                sub_category: 'required',
                sub_category_marathi: 'required', 
            },
            messages: {
                category: 'Please select category!',
                sub_category: 'Please enter sub category!',
                sub_category_marathi: 'Please enter sub category in marathi!', 
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
    $("#category").change(function () {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_sub_category",
            data: { 'category': $("#category").val() },
          
            success: function (data) {
                // alert(data);
                $("#sub_category").empty();
                $('#sub_category').append('<option value="">Select Sub Category</option>');
                var opts = JSON.parse(data);
                console.log(opts);
                $.each(opts, function (i, d) {
                    $('#sub_category').append('<option value="' + d.id + '">' + d.sub_category + '</option>');
                });
                $('#sub_category').trigger('chosen:updated');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
</script>
<script>
$("#sub_category").change(function () {
    var sup_category = $("#category").val();
    var sub_category = $("#sub_category").val();

    if (sup_category && sub_category) {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_third_category_options",
            data: { 'sup_category': sup_category, 'sub_category': sub_category },

            success: function (data) {
                
                var opts = JSON.parse(data);

                $("#third_category").empty();
                $('#third_category').append('<option value="">Select Third Category</option>');

                if (opts.length > 0) {
                    $.each(opts, function (i, d) {
                        $('#third_category').append('<option value="' + d.id + '">' + d.third_category + '</option>');
                    });

                    $('#third_category').css('display', 'block');
                } else {
                    $('#third_category').css('display', 'none');
                }

                $('#third_category').trigger('chosen:updated');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
});
$(document).ready(function () {
    $('#third_category').css('display', 'none');
});
</script>

<script>
      $(document).ready(function () {
			$('#back-office .child_menu').show();
			$('#back-office').addClass('nv active');
			$('.right_col').addClass('active_right');
			$('.service-setup').addClass('active_cc');
		});
</script>







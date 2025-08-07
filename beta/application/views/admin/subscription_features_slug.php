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
                    Add Subscription Feature Slug
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <form method="post" name="master_form" id="master_form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Feature <b class="require">*</b></label>
                                            <select class="form-control chosen-select" name="feature" id="feature">
                                                <option value="">Select Feature</option>
                                                <?php if(!empty($feature_list)){foreach($feature_list as $data){?>
                                                    <option value="<?=$data->id;?>" <?php if(!empty($single) && $single->feature == $data->id){ echo 'selected'; }?>><?=$data->feature;?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Slug <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="slug"
                                                id="slug" value="<?php if (!empty($single)) {
                                                    echo $single->slug;
                                                } ?>" placeholder="Enter slug">
                                            <div class="error" id="slug_error"></div>
                                            <input autocomplete="off" type="hidden" class="form-control input-box" name="id" id="id" value="<?php if (!empty($single)) {
                                                echo $single->id;
                                            } ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Description <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="description"
                                                id="description" value="<?php if (!empty($single)) {
                                                    echo $single->description;
                                                } ?>" placeholder="Enter slug description">
                                            <div class="error" id="slug_description_error"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <button style="margin-top: 27px;" type="submit" id="submit"
                                                class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form> <!------------end of form---->
                        </div> <!----------end of container-------->
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-6 col-xs-6">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <table id="example" class="table table-striped responsive-utilities jambo_table">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Feature</th>
                                        <th>Description</th>
                                        <th>Slug</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($slug_list)){
                                        $i=1;
                                            foreach($slug_list as $subscription_list_result){
                                                $is_added_in_subscription = $this->Admin_model->get_feature_subscriptions($subscription_list_result->feature);
                                    ?>
                                    <tr>
                                        <td scope="row"><?=$i++?></td>
                                        <td><?=$subscription_list_result->feature_name?></td>
                                        <td><?=$subscription_list_result->description?></td>
                                        <td><?=$subscription_list_result->slug?></td>
                                        <td>
                                            <?php if($is_added_in_subscription <= 0){ ?>
                                                <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>admin_delete/<?=$subscription_list_result->id?>/tbl_subscription_feature_slug"><i class="fa-solid fa-trash"></i></a>	
                                                <a title="Edit" class="btn btn-success" href="<?=base_url()?>subscription-features-slugs/<?=$subscription_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a>	
                                            <?php }else{ ?>
                                                -
                                            <?php } ?>
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
        $(".chosen-select").chosen({});
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
            ignore:[],
            rules: {
                feature: 'required',
                slug: 'required',
                description: 'required',
            },
            messages: {
                feature: "Please select subscription feature!", 
                slug: "Please enter subscription feature slug!", 
                description: "Please enter subscription feature slug description!", 
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
    $("#slug").keyup(function () {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/Ajax_controller/get_unique_subscription_feature_slug",
            data: { 'slug': $("#slug").val(), 'id': '<?= $id ?>' },
            success: function (data) {
                console.log(data);
                if (data == "0") {
                    $("#slug_error").html('');
                    $("#submit").show();
                } else {
                    // $("#slug_error").html('This subscription feature slug is already added');
                    // $("#submit").hide();
                    $("#slug_error").html('');
                    $("#submit").show();
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });	 
$('#example').DataTable({ 
 dom: 'Blfrtip',
responsive: true,
lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
 
    buttons: [
        
        {
            extend: 'excel',
            filename: 'subscription-feature-slug-list',
            exportOptions: {
                columns: [0,1,2,3] 
            }
        },
        
        
    ], 
});
</script>
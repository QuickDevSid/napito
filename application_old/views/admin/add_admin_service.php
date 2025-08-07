<?php include('header.php'); ?>

<style type="text/css">
    .error {
        font-weight: bold;
    }

    .chosen-container a {
        background-color: white !important;
        height: 34px !important;
    }
.divTimeSetterContainer {
  margin: 5px;
  float: left;
  position: absolute;
  left: 385px;
}
.tox.tox-tinymce{
height:350px !important;
}
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Add Service</h3>
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
                                        <label>Add Category<b class="require">*</b></label>
                                        <select class="form-select form-control chosen-select" name="category"  id="category">
                                            <option value="">Select Category</option>
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
                                                    <option value="<?= $sup_category_result->id ?>" <?php if (!empty($single) && $single->category == $sup_category_result->id) { ?>selected="selected" <?php } ?>><?= $sup_category_result->sup_category ?>|<?= $sup_category_result->sup_category_marathi ?> <?=$gender;?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                        <input type="hidden" class="form-control" name="id" id="id" value="<?php if (!empty($single)) { echo $single->id; } ?>">
                                    </div>
									<?php 
										$sub_cate = array();
										if(!empty($single)){
											$sub_cate = $this->Admin_model->get_selected_sub_category($single->category);
										}
									?>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Add Sub Category<b class="require">*</b></label>
                                        <select class="form-select form-control chosen-select" name="sub_category"  id="sub_category">
                                            <option value="">Select Sub Category</option>
											<?php if(!empty($sub_cate)){ foreach($sub_cate as $sub_cate_result){ 
                                                    if($sub_cate_result->gender == '1'){
                                                        $gender = ' - [Female]';
                                                    }elseif($sub_cate_result->gender == '0'){
                                                        $gender = ' - [Male]';
                                                    }else{
                                                        $gender = '';
                                                    }
                                                ?>
                                            <option value="<?=$sub_cate_result->id?>" <?php if($sub_cate_result->id == $single->sub_category){?>selected="selected"<?php }?>><?=$sub_cate_result->sub_category?>|<?=$sub_cate_result->sub_category_marathi?> <?=$gender;?></option>
											<?php }}?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Add Service <b class="require">*</b></label>
                                        <input type="text" class="form-control" name="service_name" id="service_name" value="<?php if (!empty($single)) { echo $single->service_name; } ?>" placeholder="Enter service name">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Add Service In Marathi<b class="require">*</b></label>
                                        <input type="text" class="form-control" name="service_name_marathi" id="service_name_marathi" value="<?php if (!empty($single)) { echo $single->service_name_marathi; } ?>" placeholder="Enter service name in marathi">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Upload Image <b class="require">*</b><?php if(!empty($single) && $single->category_image !=""){?> <a href="<?=base_url()?>admin_assets/images/service_image/<?=$single->category_image?>" target="_blank">View</a><?php }?></label>
                                        <input type="file" class="form-control" name="category_image" id="category_image">
                                        <input type="hidden" class="form-control" name="old_category_image" id="old_category_image" value="<?php if (!empty($single)){ echo $single->category_image;}?>">
                                        <input type="hidden" class="form-control" name="old_category" id="old_category" value="<?php if (!empty($single)){ echo $single->category;}?>">
                                        <input type="hidden" class="form-control" name="old_sub_category" id="old_sub_category" value="<?php if (!empty($single)){ echo $single->sub_category;}?>">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Duration in minuts<b class="require">*</b></label>
                                        <div class="div1" style="height: 2px;"></div>
                                        <div style="clear:both;"></div>
                                        <input type="text" class="form-control" name="service_duration" id="service_duration" value="<?php if (!empty($single)) { echo $single->service_duration; } ?>" placeholder="Enter service duration">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Amount<b class="require">*</b></label>
                                        <input type="text" class="form-control" name="final_price" id="final_price" value="<?php if (!empty($single)) {echo $single->final_price;  } ?>" placeholder="Enter service amount">
                                    </div>    
                                      <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label>Short Description</label></label>
                                        <input type="text"class="form-control" name="short_description" id="short_description" value="<?php if (!empty($single)) {echo $single->short_description; } ?>" placeholder="Enter service description">
                                    </div>
                                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label>Long Description</label>
                                        <textarea type="text" class="full-featured-non-premium" name="service_description" id="service_description"  cols="30" rows="10"><?php if (!empty($single)) {echo $single->service_description; } ?></textarea>
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12" style="padding: 10px;">
                                        <button type="submit" id="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form> 
                        </div> 
                    </div>
                </div>
            </div>



            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="padding-left: 0;">
                    <div class="x_title ms-3">
                    <h3>
                    Service List
                   </h3>
                    </div>
                    <div class="x_content">                        
                        <form method="get" name="" id="" enctype="multipart/form-data">
                            <div class="row cc_row">
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
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
                            <table id="example" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th style="width:10%;" class="handle_order hidden">Update Order</th>
                                        <th style="width:10%;">View Order</th>
                                        <th>Category</th>
                                        <th> Sub Category</th>
                                        <th> Service</th>
                                        <th> Gender</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <!-- <th>Default Status</th> -->
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($service_list)) {
                                        $i = 1;
                                        foreach ($service_list as $service_list_result) {
                                    ?>
                                            <tr class="draggable-rows" data-gender="<?=$service_list_result->gender;?>" data-id="<?=$service_list_result->id;?>" data-order="<?=$service_list_result->order;?>">
                                                <td style="width:8%;" class="sr-no" scope="row">
                                                    <?= $i++ ?>
                                                </td>
                                                <td style="width:10%;cursor:grab;" class="handle handle_order hidden order">
                                                    <i class="fas fa-grip-vertical"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </td>
                                                <td style="width:10%;" class="sr-no">
                                                    <?= $service_list_result->order != "" ? (int)$service_list_result->order : 0; ?>
                                                </td>
                                                <td><?= $service_list_result->sup_category ?>|<?= $service_list_result->sup_category_marathi ?></td>
                                                <td><?= $service_list_result->sub_category ?>|<?= $service_list_result->sub_category_marathi ?></td>
                                                <td><?= $service_list_result->service_name ?>|<?= $service_list_result->service_name_marathi ?></td>
                                                <td>
                                                    <?php
                                                        if($service_list_result->gender == '0'){
                                                            echo 'Male';
                                                        }elseif($service_list_result->gender == '1'){
                                                            echo 'Female';
                                                        }elseif($service_list_result->gender == '2'){
                                                            echo 'Other';
                                                        }else{
                                                            echo '-';
                                                        }
                                                    ?>
                                                </td>
                                                <td><?= $service_list_result->final_price ?></td>
                                                <td><?= $service_list_result->service_description != "" ? $service_list_result->service_description : '-' ?></td>
                                                <!-- <td><?=$service_list_result->default_status == 1 ? 'Yes' : 'No'?></td> -->
                                                <td><button class="photo-btn"><a target="_blank" href="<?= base_url() ?>\admin_assets\images\service_image/<?= $service_list_result->category_image ?>" target="_blank">View</a></button> </td>
                                                <td>
                                                    <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>admin_delete/<?= $service_list_result->id ?>/tbl_admin_services"><i class="fa-solid fa-trash"></i></a>

                                                    <a title="Edit" class="btn btn-success" href="<?= base_url() ?>add-admin-service/<?= $service_list_result->id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
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
</div>
<?php include('footer.php');
$id = '0';
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>

<script src="https://cdn.jsdelivr.net/npm/tinymce@5/tinymce.min.js" referrerpolicy="origin"></script>


<script>
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
        $('#master_form').validate({
            // ignore: ":hidden",
            ignore: ":hidden:not(select)",
            rules: {
                // discount_in: {
                //     required: true,
                //     noHTMLtags: true,
                // },
                // discount_type: {
                //     required: true,
                //     noHTMLtags: true,
                // },
                service_name: {
                    required: true,
                    noHTMLtags: true,
                },
                service_name_marathi: {
                    required: true,
                    noHTMLtags: true,
                },
                category: {
                    required: true,
                    noHTMLtags: true,
                },
                sub_category: {
                    required: true,
                    noHTMLtags: true,
                },
                /*category_image: {
                    required: function(element) {
                        return $('#old_category_image').val() == '';
                    },
                    noHTMLtags: true,
                },*/
                service_duration: {
                    required: true,
                    noHTMLtags: true,
                },
                gender: {
                    required: true,
                    noHTMLtags: true,
                },
                price: {
                    required: true,
                    noHTMLtags: true,
                },
                service_discount: {
                    required: function(element) {
                        return $('#discount_type').val() == '0';
                    },
                    noHTMLtags: true,
                    number: true,
                    max: function(element) {
                        if ($('#discount_in').val() == '0') {
                            return 100;
                        } else {
                            return Infinity;
                        }
                    },
                },
                min: {
                    required: function(element) {
                        return $('#discount_type').val() == '1';
                    },
                    noHTMLtags: true,
                    number: true,
                    min: 5,
                    max: 30,
                },
                max: {
                    required: function(element) {
                        return $('#discount_type').val() == '1';
                    },
                    noHTMLtags: true,
                    number: true,
                    min: 5,
                    max: 30,
                },
                final_price:{
                    required: true,
                    noHTMLtags: true,
                },
                // service_description:{
                //     required: true,
                //     noHTMLtags: true,
                // },
            },
            messages: {
                service_discount: {
                    required: "Please enter service discount!",
                    number: "Only number allowed!",
                    noHTMLtags: "HTML tags not allowed!",
                },

                min: {
                    required: "Please enter minimum length!",
                    number: "Only number allowed!",
                    noHTMLtags: "HTML tags not allowed!",
                },

                max: {
                    required: "Please enter  maximum length!",
                    number: "Only number allowed!",
                    noHTMLtags: "HTML tags not allowed!",
                },

                // discount_in: {
                //     required: "Please select discount type!",
                //     noHTMLtags: "HTML tags not allowed!",
                // },
                // discount_type: {
                //     required: "Please select discount type!",
                //     noHTMLtags: "HTML tags not allowed!",
                // }, 
                service_name: {
                    required: "Please enter service!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                service_name_marathi: {
                    required: "Please enter service name in marathi!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                category: {
                    required: "Please select category!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                sub_category: {
                    required: "Please select sub category!",
                    noHTMLtags: "HTML tags not allowed!",
                },
               /* category_image: {
                    required: "Please upload image!",
                    noHTMLtags: "HTML tags not allowed!",
                },*/
                service_duration: {
                    required: "Please enter service duration!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                gender: {
                    required: "Please select gender!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                price: {
                    required: "Please enter service price!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                final_price:{
                    required: "Please enter service amount!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                // service_description:{
                //     required: "Please enter long description!",
                //     noHTMLtags: "HTML tags not allowed!",
                // },
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


    $('#course').on('change', function() {
        $('#course').valid();
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

    $("#category").change(function() {
        // alert($("#sup_category").val());
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/Ajax_controller/get_sub_category_by_category",
            data: {
                'sup_category': $("#category").val(),
                'gender': $("#gender").val(),
            },
            success: function(data) {
                $("#sub_category").empty();
                $('#sub_category').append('<option value="">Select Sub Category</option>');
                var opts = JSON.parse(data);
                console.log(opts);
                $.each(opts, function(i, d) {
                    if(d.gender == '0'){
                        var gender = ' - [Male]';
                    }else if(d.gender == '1'){
                        var gender = ' - [Female]';
                    }else{
                        var gender = '';
                    }
					if(d.id == $('#old_sub_category').val()){
						$('#sub_category').append('<option selected value="' + d.id + '">' + d.sub_category + '|' + d.sub_category_marathi + '' + gender + '</option>');
					}else{
						$('#sub_category').append('<option value="' + d.id + '">' + d.sub_category + '|' + d.sub_category_marathi + '' + gender + '</option>');
					}
                });
                $('#sub_category').trigger('chosen:updated');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
    //  $("#discount_type").change(function() {
    //     hideshowFields();
    // });
    // function hideshowFields(){
    //     if($("#discount_type").val() == '0'){
    //         $(".min").hide();
    //         $(".max").hide();
    //         $(".service_discount").show();
    //         // $(".reward_point").show();
    //     }else{
    //         $(".min").show();
    //         $(".max").show();
    //         $(".service_discount").hide();
    //         // $(".reward_point").hide();
    //     }
    // }

        $("#min").keyup(function() {
        // var minValue = parseFloat($("#min").val());
        // if (minValue < 5){
        //     $('.min_message').text("Min value is not small than 5");
        //     $("#min").val("0");
        // }else{
        //     $('.min_message').empty();
        // }
        getdiscountvalue();
        });

        $("#max").keyup(function() {
        //     var maxValue = parseFloat($("#max").val());
        // if (maxValue > 30){
        //     $('.max_message').text("Max value is not greater than 30");
        //     $("#max").val("0")
        // }else{
        //     $('.max_message').empty();
        // }
            getdiscountvalue();
        });

        function getdiscountvalue() {
            var validValues = [15, 20, 10];
            var randomIndex = Math.floor(Math.random() * validValues.length);
            var randomValue = validValues[randomIndex];
            $("#service_discount").val(randomValue);
            // $("#reward_point").val(randomValue);
        }


        $("#submit").click(function() {
            $('.min_message').empty(); 
            $('.max_message').empty();
        });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".chosen-select").chosen({
             
        });
    });
</script>



<!-- <script>
   $(document).ready(function () {
    var options1 = {
        hour: {
            value: 0,
            min: 0,
            max: 24,
            step: 1,
            symbol: "hrs"
        },
        minute: {
            value: 0,
            min: 0,
            max: 60,
            step: 15,
            symbol: "min"
        },
        direction: "increment",
        inputHourTextbox: null,
        inputMinuteTextbox: null,
        postfixText: "",
        numberPaddingChar: '0'
    };
    var timesetterInstance1 = $(".div1").timesetter(options1);
    $(".div1").timesetter(options1).setHour();
    $(".div2").timesetter().setValuesByTotalMinutes(175);
});
</script> -->

<script>
                                  tinymce.init({
                                  selector: 'textarea.full-featured-non-premium',
                                  plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
                                  imagetools_cors_hosts: ['picsum.photos'],
                                  menubar: 'file edit view insert format tools table help',
                                  toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
                                  toolbar_sticky: true,
                                  autosave_ask_before_unload: true,
                                  autosave_interval: "30s",
                                  autosave_prefix: "{path}{query}-{id}-",
                                  autosave_restore_when_empty: false,
                                  autosave_retention: "2m",
                                  image_advtab: true,
                                  content_css: '//www.tiny.cloud/css/codepen.min.css',
                                  link_list: [
                                    { title: 'My page 1', value: 'http://www.tinymce.com' },
                                    { title: 'My page 2', value: 'http://www.moxiecode.com' }
                                  ],
                                  image_list: [
                                    { title: 'My page 1', value: 'http://www.tinymce.com' },
                                    { title: 'My page 2', value: 'http://www.moxiecode.com' }
                                  ],
                                  image_class_list: [
                                    { title: 'None', value: '' },
                                    { title: 'Some class', value: 'class-name' }
                                  ],
                                  importcss_append: true,
                                  file_picker_callback: function (callback, value, meta) {
                                  
                                    if (meta.filetype === 'file') {
                                      callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
                                    }

                                  
                                    if (meta.filetype === 'image') {
                                      callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
                                    }

                                  
                                    if (meta.filetype === 'media') {
                                      callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
                                    }
                                  },
                                  templates: [
                                        { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
                                    { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
                                    { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
                                  ],
                                  template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
                                  template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
                                  height: 178,
                                  image_caption: true,
                                  quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
                                  noneditable_noneditable_class: "mceNonEditable",
                                  toolbar_mode: 'sliding',
                                  contextmenu: "link image imagetools table",
                                });
</script>
<script>
	function fetchGenderCategories(){
		$.ajax({
			type: "POST",
			url: "<?= base_url(); ?>admin/Ajax_controller/get_gender_categories_ajax",
			data: {	'gender': $("#gender").val() },
			success: function(data) {
				$("#category").empty();
				$('#category').append('<option value="">Select Category</option>');
				var opts = $.parseJSON(data);
				$.each(opts, function(i, d) {
                    if(d.gender == '0'){
                        var gender = ' - [Male]';
                    }else if(d.gender == '1'){
                        var gender = ' - [Female]';
                    }else{
                        var gender = '';
                    }
					if(d.id == $('#old_category').val()){
						$('#category').append('<option selected value="' + d.id + '">' + d.sup_category + '|' + d.sup_category_marathi + '' + gender + '</option>');
					}else{
						$('#category').append('<option value="' + d.id + '">' + d.sup_category + '|' + d.sup_category_marathi + '' + gender + '</option>');
					}
				});
				$('#category').trigger('chosen:updated');
                $('#category').trigger('change');
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	}
</script>
<script>
    $(document).ready(function () {
        let dragEnabled = false;
              
        var table = $('#example').DataTable({ 
            dom: 'Blfrtip',
            responsive: true,
            scrollX:300,
            lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],            
            buttons: [
                {
                    extend: 'excel',
                    filename: 'admin-service-list',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6] 
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
                        url: '<?=base_url();?>admin/Ajax_controller/update_service_order',
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
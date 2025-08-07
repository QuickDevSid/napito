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
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Service
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
                            <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Add Category<b class="require">*</b></label>
                                        <select class="form-select form-control chosen-select" name="category"  id="category">
                                            <option value="">Select Category</option>
                                            <?php if (!empty($sup_category)) {
                                                foreach ($sup_category as $sup_category_result) { ?>

                                                    <option value="<?= $sup_category_result->id ?>" <?php if (!empty($single) && $single->category == $sup_category_result->id) { ?>selected="selected" <?php } ?>><?= $sup_category_result->sup_category ?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                        <input type="hidden" class="form-control" name="id" id="id" value="<?php if (!empty($single)) { echo $single->id; } ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Add Sub Category<b class="require">*</b></label>
                                        <select class="form-select form-control chosen-select" name="sub_category"  id="sub_category">
                                            <option value="">Select Sub Category</option>
                                        </select>
                                    </div>
                               
                                    <div class="form-group col-md-6">
                                        <label>Add Service <b class="require">*</b></label>
                                        <input type="text" class="form-control" name="service_name" id="service_name" value="<?php if (!empty($single)) { echo $single->service_name; } ?>" placeholder="Enter service name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Add Service In Marathi<b class="require">*</b></label>
                                        <input type="text" class="form-control" name="service_name_marathi" id="service_name_marathi" value="<?php if (!empty($single)) { echo $single->service_name_marathi; } ?>" placeholder="Enter service name in marathi">
                                    </div>
                                
                                    <div class="form-group col-md-6">
                                        <label>Upload Image <b class="require">*</b></label>
                                        <input type="file" class="form-control" name="category_image" id="category_image" value="<?php if (!empty($single)) {echo $single->category_image;  } ?>">
                                        <input type="hidden" class="form-control" name="old_category_image" id="old_category_image" value="<?php if (!empty($single)) {echo $single->category_image; } ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Duration in minuts<b class="require">*</b></label>
                                        <div class="div1" style="height: 2px;"></div>
                                        <div style="clear:both;"></div>
                                        <input type="text" class="form-control" name="service_duration" id="service_duration" value="<?php if (!empty($single)) { echo $single->service_duration; } ?>" placeholder="Enter service duration">
                                    </div>
                                
                                    <div class="form-group col-md-6">
                                        <label>Amount<b class="require">*</b></label>
                                        <input type="text" class="form-control" name="final_price" id="final_price" value="<?php if (!empty($single)) {echo $single->final_price;  } ?>" placeholder="Enter service amount">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <label>Can You Set This Service as Default</label>
                                            <select class="form-select form-control" name="default_status" id="default_status">
                                                <option value="">Select Option</option>
                                                <option value="1" <?php echo (!empty($single) && $single->default_status == 1) ? 'selected' : ''; ?>>Yes</option>
                                                <option value="0" <?php echo (!empty($single) && $single->default_status == 0) ? 'selected' : ''; ?>>No</option>
                                            </select>
                                        </div>
                               
                                  
                                    <div class="form-group col-md-6">
                                        <label>Discount In <b class="require">*</b></label>
                                        <select name="discount_in" id="discount_in" class="form-control">
                                            <option value="1" <?php if (!empty($single) && $single->discount_in == '1') { echo 'selected'; } ?>>Flat</option>
                                            <option value="0" <?php if (!empty($single) && $single->discount_in == '0') { echo 'selected'; } ?>>Percentage</option>
                                        </select>
                                    </div>
                                
                                    <div class="form-group col-md-6">
                                    <label>Discount Type <b class="require">*</b></label>
                                        <select name="discount_type" id="discount_type" class="form-control">
                                            <option value="1" <?php if (!empty($single) && $single->discount_type == '1') { echo 'selected'; } ?>>Flexible</option>
                                            <option value="0" <?php if (!empty($single) && $single->discount_type == '0') { echo 'selected'; } ?>>Fixed</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6 min" >
                                        <label>Flexible Min Length <b class="require">*</b></label>
                                        <input value="<?php if (!empty($single)) {echo $single->min; } ?>" type="text" name="min" id="min" class="form-control" placeholder="Enter greter than 5" value="">
                                        <div class="min_message error"></div>
                                    </div>
                                
                                    <div class="form-group col-md-6 max">
                                        <label>Flexible Max Length <b class="require">*</b></label>
                                        <input value="<?php if (!empty($single)) {echo $single->max; } ?>" type="text" name="max" id="max" class="form-control" placeholder="Enter smallest than 30" value="">
                                        <div class="max_message error"></div>
                                    </div>
                                    <div class="form-group col-md-6 service_discount" style="display: none;">
                                        <label>Service Discount <b class="require">*</b></label>
                                        <input type="text"class="form-control" name="service_discount" id="service_discount" value="<?php if (!empty($single)) {echo $single->service_discount; } ?>" placeholder="Enter service_discount">
                                    </div>
                               
                                    <div class="form-group col-md-6 reward_point" style="display: none;">
                                        <label>Reward Point </label>
                                        <input type="text"class="form-control" name="reward_point" id="reward_point" value="<?php if (!empty($single)) {echo $single->reward_point; } ?>" placeholder="Enter reward point">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Reminder In Days </label>
                                        <input type="text"class="form-control" name="reminder_duration" id="reminder_duration" value="<?php if (!empty($single)) {echo $single->reminder_duration; } ?>" placeholder="Enter reminder duration in days">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Short Description</label></label>
                                        <input type="text"class="form-control" name="short_description" id="short_description" value="<?php if (!empty($single)) {echo $single->short_description; } ?>" placeholder="Enter service description">
                                    </div>
                                    <div class="form-group col-md-12">
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
                <div class="x_panel">
                    <div class="x_title">
                    <h3>
                    Service List
                   </h3>
                    </div>
                    <div class="x_content">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Category</th>
                                    <th> Sub Category</th>
                                    <th> Service</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>Default Status</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($service_list)) {
                                    $i = 1;
                                    foreach ($service_list as $service_list_result) {
                                ?>
                                        <tr>
                                            <th scope="row">
                                                <?= $i++ ?>
                                            </th>
                                            <td><?= $service_list_result->sup_category ?>|<?= $service_list_result->sup_category_marathi ?></td>
                                            <td><?= $service_list_result->sub_category ?>|<?= $service_list_result->sub_category_marathi ?></td>
                                            <td><?= $service_list_result->service_name ?>|<?= $service_list_result->service_name_marathi ?></td>
                                            <td><?= $service_list_result->final_price ?></td>
                                            <td><?= $service_list_result->service_description ?></td>
                                            <td><?=$service_list_result->default_status == 1 ? 'Yes' : 'No'?></td>
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
            ignore: ":hidden",
            rules: {
                discount_in: {
                    required: true,
                    noHTMLtags: true,
                },
                discount_type: {
                    required: true,
                    noHTMLtags: true,
                },
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
                category_image: {
                    required: true,
                    noHTMLtags: true,
                },
                service_duration: {
                    required: true,
                    noHTMLtags: true,
                },
                price: {
                    required: true,
                    noHTMLtags: true,
                },
                service_discount: {
                    required: true,
                    noHTMLtags: true,
                    number: true,
                },
                min: {
                    required: true,
                    noHTMLtags: true,
                    number: true,
                },
                max: {
                    required: true,
                    noHTMLtags: true,
                    number: true,
                },
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

                discount_in: {
                    required: "Please select discount type!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                discount_type: {
                    required: "Please select discount type!",
                    noHTMLtags: "HTML tags not allowed!",
                }, 
                service_name: {
                    required: "Please enter service!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                service_name_marathi: {
                    required: "Please enter service name in marathi!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                category: {
                    required: "Please enter category!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                sub_category: {
                    required: "Please enter sub category!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                category_image: {
                    required: "Please upload image!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                service_duration: {
                    required: "Please enter service duration!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                price: {
                    required: "Please enter service price!",
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
</script>

<script>
    $("#category").change(function() {
        // alert($("#sup_category").val());
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/Ajax_controller/get_sub_category_by_category",
            data: {
                'sup_category': $("#category").val()
            },
            success: function(data) {
                $("#sub_category").empty();
                $('#sub_category').append('<option value="">Select Sub Category</option>');
                var opts = JSON.parse(data);
                console.log(opts);
                $.each(opts, function(i, d) {
                    $('#sub_category').append('<option value="' + d.id + '">' + d.sub_category + '</option>');
                });
                $('#sub_category').trigger('chosen:updated');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
     $("#discount_type").change(function() {
            if($("#discount_type").val()== 0){
                $(".min").hide();
                $(".max").hide();
                $(".service_discount").show();
                $(".reward_point").show();
            }else{
                $(".min").show();
                $(".max").show();
                $(".service_discount").hide();
                $(".reward_point").hide();
            }
        });

        $("#min").keyup(function() {
        var minValue = parseFloat($("#min").val());
        if (minValue < 5){
            $('.min_message').text("Min value is not small than 5");
            $("#min").val("")
        }else{
            $('.min_message').empty();
        }
        getdiscountvalue();
        });

        $("#max").keyup(function() {
            var maxValue = parseFloat($("#max").val());
        if (maxValue > 30){
            $('.max_message').text("Max value is not greter than 30");
            $("#max").val("")
        }else{
            $('.max_message').empty();
        }
            getdiscountvalue();
        });

        function getdiscountvalue() {
            var validValues = [15, 20, 10];
            var randomIndex = Math.floor(Math.random() * validValues.length);
            var randomValue = validValues[randomIndex];
            $("#service_discount").val(randomValue);
            $("#reward_point").val(randomValue);
        }

</script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".chosen-select").chosen({
            max_selected_options: 5
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

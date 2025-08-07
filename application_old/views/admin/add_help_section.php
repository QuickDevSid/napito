<?php include('header.php'); ?>
<style type="text/css">
    .error {
        color: red;
        float: left;
        
    }

    input[type="file"] {
        height: 50px;
    }
</style>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php if ($this->uri->segment(2) == "") { ?>Add <?php } else { ?>Update<?php  } ?> FAQ Management</h3>
            </div>   
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="x_panel">
                <div class="x_title">
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <form method="post" name="reason_form" id="reason_form" enctype="multipart/form-data">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">FAQ Title<span class="require">*</span></label>
                                            <input type="text" class="form-control" id="help_title" name="help_title" value="<?php if (!empty($single)) echo $single->help_title; ?>" placeholder="Enter FAQ Title">
                                            <input autocomplete="off" type="hidden" id="id" name="id" value="<?php if (!empty($single)) echo $single->id; ?>">
                                            <div class="error" id="unique_error"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <?php
                                                $website_type = (!empty($single)) ? $single->website_type : '';
                                            ?>
                                            <label for="">Type<span class="require">*</span></label>
                                            <select class="form-control chosen-select" name="website_type" id="website_type">
                                                <option value="">Please select Type</option>
                                                <option value="0" <?php if($website_type == '0') {?>selected="selected"<?php } ?>>Website</option>
                                                <option value="1" <?php if($website_type == '1') {?>selected="selected"<?php } ?>>Business</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">FAQ Description<span class="require">*</span></label>
                                            <textarea name="help_description" id="help_description" class="form-control" placeholder="Please Enter FAQ Description"><?php if(!empty($single)){ echo $single->help_description; }?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="x_panel">
                <div class="x_content">
                    <div class="container">
                        <div class="row">            
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <table id="example" class=" table table-striped table-bordered example_class" style="width:100%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Sr.No</th>
                                            <th scope="col">FAQ Title</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">FAQ Description</th>
                                            <th scope="col">Status</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
$id = 0;
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        $.validator.addMethod("alphabetsOnly", function(value, element) {
            return /^(?![\d])[a-zA-Z\d]+$/.test(value);
        });
        $('#reason_form').validate({
            ignore: ":hidden:not(select)",
            rules: {
                help_title: {
                    required:true,
                    // alphabetsOnly:true,
                },
                website_type:{
                    required:true,
                },
                help_description:{
                    required:true,
                },
            },
            messages: {
                help_title:  {
                    required:'Please enter FAQ title!',
                },
                website_type:{
                    required:'Please select type!',
                },
                help_description:{
                    required:'Please enter FAQ description!',
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
    var oldExportAction = function(self, e, dt, button, config) {
        if (button[0].className.indexOf('buttons-excel') >= 0) {
            if ($.fn.dataTable.ext.buttons.excelHtml5.available(dt, config)) {
                $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config);
            } else {
                $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
            }
        } else if (button[0].className.indexOf('buttons-print') >= 0) {
            $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
        }
    };

    var newExportAction = function(e, dt, button, config) {
        var self = this;
        var oldStart = dt.settings()[0]._iDisplayStart;
        dt.one('preXhr', function(e, s, data) {
            data.start = 0;
            data.length = 2147483647;
            dt.one('preDraw', function(e, settings) {
                oldExportAction(self, e, dt, button, config);

                dt.one('preXhr', function(e, s, data) {
                    settings._iDisplayStart = oldStart;
                    data.start = oldStart;
                });
                setTimeout(dt.ajax.reload, 0);
                return false;
            });
        });

        dt.ajax.reload();
    };

    var table = $('#example').DataTable({
        "lengthChange": true,
        "lengthMenu": [10, 25, 50, 100],
        'searching': true,
        "processing": true,
        "serverSide": true,
        "cache": false,
        "order": [],
        "columnDefs": [{
            "orderable": false,
            "targets": "_all"
        }],
        buttons: [{
            extend: "excelHtml5",
            messageBottom: '',
            filename: "FAQ Management List",
            action: newExportAction,
            exportOptions: {
                columns: [0, 1, 2,3,4],
                modifier: {
                    search: 'applied',
                    order: 'applied'
                },
            },
        }],
        dom: "Blfrtip",
        "ajax": {
            "url": "<?= base_url(); ?>admin/Ajax_controller/get_all_help_management_list_ajax",
            "type": "POST",
            "data": function(d) {
                d.status = $('#status_filter').val();
            }
        },
        "complete": function() {
            $('[data-toggle="tooltip"]').tooltip();
        },
    });
</script>
<script>
    $("#help_title").keyup(function() {
        $.ajax({
            url: '<?= base_url('admin/Ajax_controller/get_unique_help_title'); ?>',
            type: 'POST',
            data: {
                'id': '<?= $id ?>',
                'help_title': $('#help_title').val(),
            },
            success: function(response) {
                if (response != "0") {
                    $("#submit").hide();
                    $("#unique_error").html('This help title is already added!');
                } else {
                    $("#submit").show();
                    $("#unique_error").html('');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);

            }
        });
    });

    $(".chosen-select").chosen({
                    
    });

    $('#website_type').on('change', function() {
        $('#website_type').valid();
    });

</script>

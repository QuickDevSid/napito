<?php include('header.php'); ?>
<style type="text/css">
    .error {
        color: red;
        float: left;
        /*    position: absolute;*/
    }

    .input-content-option {
        height: 35px;
        width: 600px;
        border-radius: 5px;
        border: solid gray 1px;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Salon Close Reason
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
                    <div class="x_title">

                    </div>
                    <div class="x_content">
                        <div class="container">
                            <form method="post" name="customer_form" id="customer_form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <label>Title <b class="require">*</b></label>
                                    <input class="form-control" type="text" name="reason_title" id="reason_title" placeholder="Enter reason title" value="<?php if (!empty($single)) { echo $single->reason_title; } ?>">
                                        <input type="hidden" name="id" id="id"
                                            value="<?php if (!empty($single)) { echo $single->id; } ?>">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Description <b class="require">*</b></label>
                                        <textarea class="form-control" type="text" id="salon_close_reason" name="salon_close_reason"><?php if (!empty($single)) { echo $single->salon_close_reason; } ?></textarea>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-top: 20px;">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>    
                            </form> 
                        </div> 

                    </div>
                </div>
            </div>
            
            <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        Reason List                        
                    </div>
                    <div class="x_content">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($reason_list)) {
                                    $i = 1;
                                    foreach ($reason_list as $reason_list_result) {
                                        ?>
                                        <tr>
                                            <th scope="row">
                                                <?= $i++ ?>
                                            </th>
                                            <td><?= $reason_list_result->reason_title ?></td>
                                            <td><?= $reason_list_result->salon_close_reason ?></td>
                                            
                                            <td>
                                                <a title="Delete" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure to delete this record?');"
                                                    href="<?= base_url() ?>admin_delete/<?= $reason_list_result->id ?>/tbl_salon_close_reason"><i
                                                        class="fa-solid fa-trash"></i></a>

                                                <a title="Edit" class="btn btn-success"
                                                    href="<?= base_url() ?>salon-close-reason/<?= $reason_list_result->id ?>"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
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
$id = 0;
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>


<script>
    $(document).ready(function () {
        $('#customer_form').validate({
            rules: {
                reason_title: 'required',
                salon_close_reason: 'required',
            },
            messages: {
                reason_title: 'Please enter reason title!',
                salon_close_reason: 'Please enter description!',
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
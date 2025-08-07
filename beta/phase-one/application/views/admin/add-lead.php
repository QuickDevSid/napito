<?php include('header.php');?>
<style type="text/css">
.error{
    color: red;
    float: left;
/*    position: absolute;*/
 }
 input[type="file"]{
  height: 50px;
}
#viewButtonsContainer a{
       margin-top: 20px;
       margin-left: 30px;
}
</style>
  <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                                Add Lead
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
                            <div class="x_panel">
                                <div class="x_title">
                                          <h2><b>Add Salon</b></h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="container">
                                        <form method="post" name="customer_form" id="customer_form" enctype="multipart/form-data">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                        <label>Upload Lead Excel <b class="require">*</b></label>
                                                        <input type="file" class="form-control" name="excel_upload" id="excel_upload" value="<?php if(!empty($single)) { echo $single->lead_file;} ?>" placeholder="Enter salon name">
                                                        <label style="display: none;" id="salon_name-error" class="error col-md-12" for="salon_name"></label>
                                                    </div>
                                                
                                                <div class="form-group col-md-0 col-xs-12" style="margin-top: 40px;">
                                                    <button name="upload_excel" value="upload_excel" type="submit" class="btn btn-success">Submit</button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group" style="margin-top: 30px;margin-left: 100px;">
                                               <!-- <a class="btn btn-primary" href="<?=base_url();?>admin_assets">Dowload Excel Sheet</a> -->
                                               <a href="<?=base_url()?>assets/crm.xlsx" download class="btn btn-primary">Download Sample Excel</a>
                                              <a href="<?=base_url()?>lead-list" class="btn btn-primary">Show lead List</a>
                                            </div>       
                                                
                                                
                                                
                                            </div>    
                                    </form>  
                                    </div> 

                                </div>
                            </div>
                        </div>

                      </div>  

                    </div>
                </div>
                <?php include('footer.php');
                    $id = 0;
                    if($this->uri->segment(2) !=""){
                        $id = $this->uri->segment(2);
                    }
                ?>


                <script>
        $(document).ready(function () {     
            $('#customer_form').validate({
                rules: {
                    excel_upload: 'required',
                  
                },
                messages: {
                    excel_upload: 'Please upload sheet file!',
                    
                },
                errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
            });
        });
  

                </script>


<script>
    function generateViewButton(fileInputId) {
        var files = document.getElementById(fileInputId).files;
        var viewButtonsContainer = $('#viewButtonsContainer');

        for (var i = 0; i < files.length; i++) {
            var reader = new FileReader();
            reader.onload = (function (file) {
                return function (e) {
                    var viewButton = $('<a class="btn btn-info" target="_blank" href="'+ e.target.result +'">View</a>');
                    viewButtonsContainer.append(viewButton);
                };
            })(files[i]);

            reader.readAsDataURL(files[i]);
        }
    }

    $('#aadhar_front, #aadhar_back, #salon_photo').on('change', function () {
        generateViewButton(this.id);
    });
</script>







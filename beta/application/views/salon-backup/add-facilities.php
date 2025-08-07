<?php include('header.php');?>
<style type="text/css">
.error{
    color: red;
    float: left;
/*    position: absolute;*/
 }
 

</style>
  <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                                Add Facilities
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
                         <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                </div>
                                <div class="x_content">
                                    <div class="container">
                                        <form method="post" name="customer_form" id="customer_form" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                     <label>Facilities Name<b class="require">*</b></label>
                                                    <input type="text" class="form-control" name="facilities_name" id="facilities_name" value="<?php if(!empty($single)) { echo $single->facilities_name;} ?>" placeholder="Enter facilities name">
                                                    <input type="hidden" name="id" id="id" value="<?php if(!empty($single)){ echo $single->id;}?>">
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <label>Upload Image<b class="require">*</b></label>
                                                <input type="file" class="form-control" name="facilities_image" id="facilities_image" value="<?php if(!empty($single)) { echo $single->facilities_image;} ?>">
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <button style="margin-top: 40px;" type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>  <!------------end of form---->
                                    </div>  <!----------end of container-------->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    
                                    <!-- <div class="clearfix"></div> -->
                                </div>
                                <div class="x_content">

                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>Facilities Name</th>
                                                <th>Facilities Image</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                             <tbody>
                                            <?php if(!empty($facilities_list)){
                                                $i=1;
                                                    foreach($facilities_list as $facilities_list_result){
                                            ?>
                                            <tr>
                                                <th scope="row"><?=$i++?></th>
                                                <td><?=$facilities_list_result->facilities_name?></td>
                                               <td><button class="photo-btn btn btn-light"><a target="_blank" href="<?=base_url()?>\admin_assets\images\facilities_image/<?=$facilities_list_result->facilities_image?>" target="_blank">View Photo</a></button> </td>
                                                <td>
                                                    <?php if($facilities_list_result->status == "1"){?>
                                                        <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$facilities_list_result->id?>/tbl_salon_facilities"><i  style="color: blue; font-size: 25px;" class="fa-solid fa-toggle-on"></i></a>  
                                                    <?php }else{?>

                                                        <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$facilities_list_result->id?>/tbl_salon_facilities"><i style="font-size: 25px;" class="fa-solid fa-toggle-off"></i></a> 
                                                    <?php }?>
                                                </td>
                                                <td>
                                                    <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$facilities_list_result->id?>/tbl_salon_facilities"><i class="fa-solid fa-trash"></i></a>   

                                                    <a title="Edit" class="btn btn-primary" href="<?=base_url()?>add-shift/<?=$facilities_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a>   
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
                    facilities_name: 'required',
                    facilities_image: 'required',
                },
                messages: {
                    facilities_name: 'Please enter facilities  name',
                    facilities_image: 'Please upload facilities image',
                },
                errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
            });
        });
  

                </script>







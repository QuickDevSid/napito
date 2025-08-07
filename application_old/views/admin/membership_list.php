 <?php include('header.php');?>
<style type="text/css">
    .photo-btn{
  border: solid 2px lightblue;
  border-radius: 3px;
}
.photo-btn a{
  text-decoration: none;
}
</style>
            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                                Membership List
								<a href="<?=base_url();?>add_membership_management" class="btn btn-primary pull-right">Add New</a>
                            </h3>
                        </div>

                        <!-- <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <!-- <div class="clearfix"></div> -->

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                                        <button type="submit" id="filter_submit" style="margin-top:25px;" class="btn btn-success">Search</button>
                                        <?php if(isset($_GET['filter_gender'])){ ?>
                                            <a id="filter_reset" style="margin-top:25px;" class="btn btn-warning" href="<?=base_url();?><?=$this->uri->segment(1);?>">Reset</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </form>
                            <div class="x_panel">
                                <div class="x_title">
                                
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th>
                                                    Sr.No
                                                    <!-- <input type="checkbox" class="tableflat"> -->
                                                </th>
                                                <th>Membership Name</th>
                                                <th>Service Discount</th>
                                                <th>Product Discount</th>
                                                <th>Membership Price</th>
                                                <th>Gender</th>
                                                <th>Discount In</th>

                                                <th>Duration</th>
                                                <th>Discription</th> 
                                                <th >Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php if(!empty($membership)){
                                                $i=1;
                                                    foreach($membership as $membership_result){
                                            ?>
                                            <tr>
                                                <td scope="row"><?=$i++?></td>
                                                <td><?=$membership_result->membership_name?></td>
                                                <td><?=$membership_result->service_discount?> <?php if($membership_result->discount_in == "0"){ echo "%";}else{ echo "Rs";}?></td>
                                                <!-- <td><?=$membership_result->product_discount?> <?php if($membership_result->discount_in == "0"){ echo "%";}else{ echo "Rs";}?></td> -->
                                                <td> <?php if (!empty($membership_result->product_discount)) {
                                                                echo $membership_result->product_discount . ' ';
                                                                if ($membership_result->discount_in == "0") { echo "%";
                                                                } else {echo "Rs";}} else {
                                                                echo "-"; 
                                                            }
                                                        ?>
                                                    </td>
                                                <td><?=$membership_result->membership_price?></td>
                                                <td><?php if($membership_result->gender == "0"){ echo "Male";}else{ echo "Female";}?></td>
                                                <td><?php if($membership_result->discount_in == "0"){ echo "Percentage";}else{ echo "Flat";}?></td>
                                                
                                                <td><?=$membership_result->duration?></td>
                                                <td><?=$membership_result->description?></td>
                                                <td>  
                                                    <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>admin_delete/<?=$membership_result->id?>/tbl_admin_memebership"><i class="fa-solid fa-trash"></i></a>    
                                                    <a title="Edit" class="btn btn-success" href="<?=base_url()?>add_membership_management/<?=$membership_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a> 
                                                </td>
                                            </tr>
                                        <?php }}?> 
                                        </tbody> 
                                    </table>
                                </div>
                            </div>
                        </div>

                        <br />
                        <br />
                        <br />

                    </div>
                </div>
                <?php include('footer.php');?>


        
        <script>
            $(".chosen-select").chosen({
                    
            });
            $('#example').DataTable({ 
            dom: 'Blfrtip',
            responsive: true,
            lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
             
                buttons: [
                    
                    {
                        extend: 'excel',
                        filename: 'membership-list',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6,7,8] 
                        }
                    },
                   
                    
                ], 
        });
        </script>
</body>

</html>
 <?php include('header.php');?>
 <style>
.status-column-hidden {
    display: none;
}

.status-column-hidden-visible {
    display: table-cell;
}
</style>

            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                                Offer List
								<a href="<?=base_url();?>admin_add_offer" class="btn btn-primary pull-right">Add New</a>
                            </h3>
                        </div>

                        <!-- <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                
                            </div>
                        </div> -->
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
                                                    <th>Sr.No</th>
                                                    <th>Offers Name</th>
                                                    <th>Discount</th>
                                                    <th>Validity</th>
                                                    <th>Services</th>
                                                    <th>Gender</th>
                                                    <th>Reward Point</th>
                                                    <th>Description</th>
                                                    <!-- <th>Status</th>
                                                    <th class="status-column-hidden">Status</th> -->
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php if(!empty($offers_list)){
                                                    $i=1;
                                                        foreach($offers_list as $offers_list_result){
                                                            $service_name=$this->Admin_model->get_selected_service_name_for_offer($offers_list_result->service_name);
                                                ?>
                                                <tr>
                                                    <td scope="row"><?=$i++?></td>
                                                    <td><?=$offers_list_result->offers_name?></td>
                                                    
                                                    <?php if($offers_list_result->discount_in == 0){ ?>
                                                        <td><?=$offers_list_result->discount?>%</td>
                                                    <?php }else{ ?>
                                                        <td>Rs.<?=$offers_list_result->discount?></td>
                                                    <?php } ?> 
                                                    <td><?=$offers_list_result->duration?> Week</td>
                                                    <td><?php if(!empty($service_name)){
														foreach($service_name as $service_name_result){
															echo $service_name_result->service_name." ";
														}
													}?></td>
                                                    <td><?= ($offers_list_result->gender == 1) ? 'Female' : (($offers_list_result->gender == 0) ? 'Male' : 'Unisex'); ?></td>
                                                    <td><?=$offers_list_result->reward_point?></td>
                                                    <td><?=$offers_list_result->description?></td>
                                                    
                                                    <!-- <td>
                                                        <?php if($offers_list_result->status == "1"){?>
                                                            <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>admin_inactive/<?=$offers_list_result->id?>/tbl_admin_offers"><i class="fa-solid fa-toggle-on"></i></a>  
                                                        <?php }else{?>

                                                            <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>admin_active/<?=$offers_list_result->id?>/tbl_admin_offers"><i class="fa-solid fa-toggle-off"></i></a> 
                                                        <?php }?>
                                                    </td>

                                                    <td class="status-column-hidden">

                                                        <?php if($offers_list_result->status == "1"){?>
                                                            <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>admin_inactive/<?=$offers_list_result->id?>/tbl_admin_offers">Active</a>  
                                                        <?php }else{?>

                                                            <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>admin_active/<?=$offers_list_result->id?>/tbl_admin_offers">Inactive</a> 
                                                        <?php }?>
                                                    </td> -->
                                                    <td>
                                                        <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>admin_delete/<?=$offers_list_result->id?>/tbl_admin_offers"><i class="fa-solid fa-trash"></i></a>    

                                                        <a title="Edit" class="btn btn-success" href="<?=base_url()?>admin_add_offer/<?=$offers_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a> 

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


        <!-- <script>

            $('#example').DataTable({ 
             dom: 'Blfrtip',
            responsive: true,
            lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
                buttons: [
                    {
                        extend: 'excel',
                        filename: 'salon-offer-list',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6,7] 
                        }
                        format: {
                     
                        8: formatStatus
                    }
                    },
                    
                ], 
        });

        </script> -->
        <script>
            $(".chosen-select").chosen({
                    
            });
    $('#example').DataTable({ 
        dom: 'Blfrtip',
        responsive: true,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        buttons: [
            {
                extend: 'excel',
                filename: 'salon-offer-list',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7] 
                }
                // customize: function (xlsx) {
                //     var sheet = xlsx.xl.worksheets['sheet1.xml'];
                //     // Change column width of the hidden column
                //     $('row c[r^="K"]', sheet).attr('s', '2');
                // }
            }
        ]
    });
</script>


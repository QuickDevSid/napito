<?php include('header.php'); ?>
<style>
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
  opacity: 1.3 !important;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  
  /* Position the tooltip */
  position: absolute;
  z-index: 1;
  top: 100%;
  left: 50%;
  margin-left: -60px;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}

.status-column-hidden {
    display: none;
}

.status-column-hidden-visible {
    display: table-cell;
}
</style>
 <div class="right_col" role="main">
       
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Package List
					<a href="<?=base_url();?>admin_add_package" class="btn btn-primary pull-right">Add New</a>
                </h3>
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
                    <div class="x_content">
                        <div class="container"> 
                                <table id="examples" class="table table-striped responsive-utilities jambo_table" style="width:100%">
                                            <thead>
                                                <tr class="headings">
                                                    <th>
                                                       Sr. No.
                                                    </th>
                                                    <th>Package Name</th>
                                                    <th>Services</th>
                                                    <th>Gender</th> 
                                                    <th>Discount</th> 
                                                    <!-- <th>Reward Point</th> -->
                                                    <th>Package Expiry Number Of Days</th>
                                                    <th class="status-column-hidden">Package Button</th>
                                                    <th>Package Button</th>
                                                    <th class=" no-link last"><span class="nobr">Actions</span>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php if(!empty($package_list)){
                                                    $i=1;
                                                        foreach($package_list as $package_list_result){  
															 $service_name=$this->Admin_model->get_selected_service_name_for_offer($package_list_result->service_name);
                                                ?>
                                                <tr>
                                                    <td scope="row"><?=$i++?></td>
                                                    <td><?=$package_list_result->package_name?></td> 
                                                    <td> 
													<?php 
														$service_tooltip = "";
														$service_one = "";
														$k=0;
														if(!empty($service_name)){
														foreach($service_name as $service_name_result){
															if($k == 0){
																$service_one = $service_name_result->service_name;
															}
															$service_tooltip .=' '. $service_name_result->service_name." ";
														}
													}?>
													<div class="tooltip">
                                                        <p><?=$service_one?></p>
													<span class="tooltiptext"><?=$service_tooltip?></span>
													</div>
													</td>
                                                    <td>
                                                        <?php
                                                            if($package_list_result->gender == '0'){
                                                                echo 'Male';
                                                            }elseif($package_list_result->gender == '1'){
                                                                echo 'Female';
                                                            }else{
                                                                echo '-';
                                                            }
                                                        ?>
                                                    </td>
                                                    <?php if($package_list_result->discount_in == 0): ?>
                                                        <td><?=$package_list_result->discount?>%</td>
                                                    <?php else: ?>
                                                        <td>Rs.<?=$package_list_result->discount?></td>
                                                    <?php endif; ?>  
                                                    <!-- <td><?=$package_list_result->reward_point?></td> -->
                                                    <td><?=$package_list_result->count_value?> Days</td>
                                                    
                                                    <td class="status-column-hidden">
                                                        <button type="button" class="btn btn-sm" style="cursor: default;background-color:<?=$package_list_result->bg_color;?>; color:<?=$package_list_result->text_color;?>"><?=$package_list_result->package_name;?></button>
                                                    </td>

                                                    <td>
                                                        <button type="button" class="btn btn-sm" style="cursor: default;background-color:<?=$package_list_result->bg_color;?>; color:<?=$package_list_result->text_color;?>"><?=$package_list_result->package_name;?></button>
                                                    </td>
                                                   
                                                    <td>
                                                        <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>admin_delete/<?=$package_list_result->id?>/tbl_admin_package"><i class="fa-solid fa-trash"></i></a>    

                                                        <a title="Edit" class="btn btn-success" href="<?=base_url()?>admin_add_package/<?=$package_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a> 

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
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>


<script>
            $(".chosen-select").chosen({
                    
            });
    $('#examples').DataTable({ 
        dom: 'Blfrtip',
        responsive: true,
        // scrollX:300,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],      
         buttons: [      
            {
                extend: 'excel',
                filename: 'admin-package-list',
                exportOptions: {
                    columns: [0,1,2,3,4,5] 
                },
                customize: function (xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('row c[r^="K"]', sheet).attr('s', '2');
                }
            }
        ], 
    }); 
</script> 
 
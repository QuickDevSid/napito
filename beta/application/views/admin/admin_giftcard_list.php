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
       
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Gift Card
					<a href="<?=base_url();?>admin_add_giftcard" class="btn btn-primary pull-right">Add New</a>
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
                                <table id="example" class="table table-striped responsive-utilities jambo_table" style="width: 100%;">
                                            <thead>
                                                <tr class="headings">
                                                    <th>Sr.No</th>
                                                    <th>Gift Card Name</th>  
                                                    <th>Gender</th> 
                                                    <!-- <th>Services</th>  -->
                                                    <th>Purchase Price</th> 
                                                    <!-- <th>Worth Price</th> 
                                                    <th>Min. Booking Price</th>  -->
                                                    <th>Gift Card Code</th>
                                                    <th class="status-column-hidden">Gift Button</th>
                                                    <th>Gift Button</th>
                                                    <th class=" no-link last"><span class="nobr">Actions</span>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                            <?php if(!empty($gift_card_list)){
                                                    $i=1;
                                                        foreach($gift_card_list as $gift_card_list_result){
                                                            $service_name=$this->Admin_model->get_selected_service_name_for_offer($gift_card_list_result->service_name);
                                                ?>
                                                <tr>
                                                    <td scope="row"><?=$i++?></td>
                                                    <td><?=$gift_card_list_result->gift_name?></td>
                                                      
                                                    <td><?= ($gift_card_list_result->gender == 1) ? 'Female' : (($gift_card_list_result->gender == 0) ? 'Male' : 'Unisex'); ?></td>
													<!-- <td><?php if(!empty($service_name)){
														foreach($service_name as $service_name_result){
															echo $service_name_result->service_name." ";
														}
													}?></td> -->
                                                    <td><?=$gift_card_list_result->regular_price?></td>
                                                    <!-- <?php if($gift_card_list_result->discount_in == 0): ?>
                                                        <td><?=$gift_card_list_result->discount?>%</td>
                                                    <?php else: ?>
                                                        <td>Rs.<?=$gift_card_list_result->discount?></td>
                                                    <?php endif; ?>  -->
                                                    <!-- <td><?=$gift_card_list_result->gift_price?></td>
                                                    <td><?=$gift_card_list_result->min_booking_amt != "" ? $gift_card_list_result->min_booking_amt : '-';?></td> -->
                                                    <td><?=$gift_card_list_result->gift_card_code?></td>
                                                    <td class="status-column-hidden">
                                                        <button type="button" class="btn btn-sm" style="cursor: text; background-color:<?=$gift_card_list_result->bg_color;?>; color:<?=$gift_card_list_result->text_color;?>"><?=$gift_card_list_result->gift_name;?></button>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm" style="cursor: text; background-color:<?=$gift_card_list_result->bg_color;?>; color:<?=$gift_card_list_result->text_color;?>"><?=$gift_card_list_result->gift_name;?></button>
                                                    </td>
                                                    <td>
                                                        <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>admin_delete/<?=$gift_card_list_result->id?>/tbl_admin_gift_card"><i class="fa-solid fa-trash"></i></a>    

                                                        <a title="Edit" class="btn btn-success" href="<?=base_url()?>admin_add_giftcard/<?=$gift_card_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a> 

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
 $('#example').DataTable({ 
        dom: 'Blfrtip',
        responsive: true,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                
         buttons: [
                        
            {
                extend: 'excel',
                filename: 'giftcard-list',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6] 
                },
                customize: function (xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('row c[r^="K"]', sheet).attr('s', '2');
                }
            }
        ], 
    });
</script>
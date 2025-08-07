<?php include('header.php');?> 
<div class="right_col" role="main">
       
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Gift Card
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
                                <table id="example" class="table table-striped responsive-utilities jambo_table" style="width: 100%;">
                                            <thead>
                                                <tr class="headings">
                                                    <th>Sr.no</th>
                                                    <th>Gift Card Name</th>  
                                                    <th>Gender</th> 
                                                    <th>Discount</th> 
                                                    <th>Gift Card Code</th>
                                                    <th>Gift Button</th>
                                                    <th class=" no-link last"><span class="nobr">Actions</span>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                            <?php if(!empty($gift_card_list)){
                                                    $i=1;
                                                        foreach($gift_card_list as $gift_card_list_result){
                                                            $service_name=$this->Salon_model->get_selected_service_name_for_offer($gift_card_list_result->service_name)
                                                ?>
                                                <tr>
                                                    <td scope="row"><?=$i++?></td>
                                                    <td><?=$gift_card_list_result->gift_name?></td>
                                                      
                                                    <td><?= ($gift_card_list_result->gender == 1) ? 'Female' : (($gift_card_list_result->gender == 0) ? 'Male' : 'Unisex'); ?></td>
                                                    <?php if($gift_card_list_result->discount_in == 0): ?>
                                                        <td><?=$gift_card_list_result->discount?>%</td>
                                                    <?php else: ?>
                                                        <td>Rs.<?=$gift_card_list_result->discount?></td>
                                                    <?php endif; ?> 
                                                    <td><?=$gift_card_list_result->gift_card_code?></td>
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
 $('#example').DataTable({ 
        dom: 'Blfrtip',
        responsive: true,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                
         buttons: [
                        
            {
                extend: 'excel',
                filename: 'set-booking-status',
                exportOptions: {
                    columns: [0,1] 
                }
            }
        ], 
    });
</script>
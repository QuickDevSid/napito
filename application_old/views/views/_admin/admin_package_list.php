<?php include('header.php'); ?>
 <div class="right_col" role="main">
       
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Package
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
                                <table id="example" class="table table-striped responsive-utilities jambo_table">
                                            <thead>
                                                <tr class="headings">
                                                    <th>
                                                       Sr.no
                                                    </th>
                                                    <th>Package Name</th>
                                                    <th>Discount</th> 
                                                    <th>Reward Point</th>
                                                    <th>Package Expiry Number </th>
                                                    <th>Package Button</th>
                                                    <th class=" no-link last"><span class="nobr">Actions</span>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php if(!empty($package_list)){
                                                    $i=1;
                                                        foreach($package_list as $package_list_result){  
                                                ?>
                                                <tr>
                                                    <td scope="row"><?=$i++?></td>
                                                    <td><?=$package_list_result->package_name?></td> 
                                                    
                                                    <?php if($package_list_result->discount_in == 0): ?>
                                                        <td><?=$package_list_result->discount?>%</td>
                                                    <?php else: ?>
                                                        <td>Rs.<?=$package_list_result->discount?></td>
                                                    <?php endif; ?>  
                                                    <td><?=$package_list_result->reward_point?></td>
                                                    <td><?=$package_list_result->count_value?> <?=$package_list_result->count_type?></td>
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
        scrollX:300,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                
         buttons: [
                        
            {
                extend: 'excel',
                filename: 'add-package',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8] 
                }
            }
        ], 
    }); 
</script> 
 
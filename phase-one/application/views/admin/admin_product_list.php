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
                                Product List
								<a href="<?=base_url();?>admin_product_add" class="btn btn-primary pull-right">Add New</a>
                            </h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                   <table id="example" class="table table-striped responsive-utilities jambo_table">
                                            <thead>
                                                <tr class="headings">
                                                    <th>Sr.No</th>
                                                    <th>Product Name</th>
                                                    <th>Category</th>
                                                    <th>Sub Category</th>
                                                    <!-- <th>Unit</th> -->
                                                    <th>HSN Code</th>
                                                    <th>Selling Price</th>
                                                    <th>Discount</th>
                                                    <th>Incentive</th>
                                                    <th class="status-column-hidden">Status</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php if(!empty($product)){
                                                    $i=1;
                                                    foreach($product as $product_result){ 
                                                        $product_sub_category = $this->Admin_model->get_sub_category_details($product_result->sub_category);
                                                ?>
                                                <tr>
                                                    <td scope="row"><?=$i++?></td>
                                                    <td><?=$product_result->product_name?></td> 
                                                    <td><?=$product_result->product_category?></td>
                                                    <td><?=!empty($product_sub_category) ? $product_sub_category->product_sub_category : '-'; ?></td>
                                                    <!-- <td><?=$product_result->unit_name?></td> -->
                                                    <td><?=$product_result->hsn_code?></td>
                                                    <td><?=$product_result->selling_price?></td>
                                                    <td><?=$product_result->discount?></td>
                                                    <td><?=$product_result->incentive?></td>

                                                    <td class="status-column-hidden">
                                                        <?php if($product_result->status == "1"){?>
                                                            <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>admin_inactive/<?=$product_result->id?>/tbl_admin_product">Active</a>  
                                                        <?php }else{?>

                                                            <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>admin_active/<?=$product_result->id?>/tbl_admin_product">Inactive</a> 
                                                        <?php }?>
                                                    </td>



                                                    <td>
                                                        <?php if($product_result->status == "1"){?>
                                                            <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>admin_inactive/<?=$product_result->id?>/tbl_admin_product"><i class="fa-solid fa-toggle-on"></i></a>  
                                                        <?php }else{?>

                                                            <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>admin_active/<?=$product_result->id?>/tbl_admin_product"><i class="fa-solid fa-toggle-off"></i></a> 
                                                        <?php }?>
                                                        </td>
                                                        <td>
                                                        <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>admin_delete/<?=$product_result->id?>/tbl_admin_product"><i class="fa-solid fa-trash"></i></a>    

                                                        <a title="Edit" class="btn btn-success" href="<?=base_url()?>admin_product_add/<?=$product_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a> 

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
            $('#example').DataTable({ 
             dom: 'Blfrtip',
            responsive: false,
            lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
             
                buttons: [
                    {
                        extend: 'excel',
                        filename: 'admin-product-list',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6,7,8] 
                        },
                        customize: function (xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            $('row c[r^="K"]', sheet).attr('s', '2');
                        }
                    },
                    
                ], 
        });
        </script>

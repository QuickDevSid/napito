<?php include('header.php');?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Student List
                </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                    
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="example" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr class="headings">
                                    <th>
                                        <input type="checkbox" class="tableflat">
                                    </th>
                                    <th>Product Name</th>
                                    <th>Product Category</th>
                                    <th>Product Unit</th>
                                    <th>Opening Stock</th>
                                    <th>Closing Stock</th>
                                    <th>Purchase Price</th>
                                    <th>Selling Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if(!empty($product_list)){
                                    $i=1;
                                        foreach($product_list as $product_list_result){
                                ?>
                                <tr>
                                    <th scope="row"><?=$i++?></th>
                                    <td><?=$product_list_result->product_name?></td>
                                    <td><?=$product_list_result->product_category?></td>
                                    <td><?=$product_list_result->product_unit?></td>
                                    <td><?=$product_list_result->opening_stock?></td>
                                    <td><?=$product_list_result->closing_stock?></td>
                                    <td><?=$product_list_result->purchase_price?></td>
                                    <td><?=$product_list_result->selling_price?></td>
                                    <td>
                                        <?php if($product_list_result->status == "1"){?>
                                            <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$product_list_result->id?>/tbl_product"><i  style="color: blue; font-size: 25px;" class="fa-solid fa-toggle-on"></i></a>  
                                        <?php }else{?>

                                            <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$product_list_result->id?>/tbl_product"><i style="font-size: 25px;" class="fa-solid fa-toggle-off"></i></a> 
                                        <?php }?>
                                    </td>
                                    <td>
                                        <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$product_list_result->id?>/tbl_product"><i class="fa-solid fa-trash"></i></a>    

                                        <a title="Edit" class="btn btn-success" href="<?=base_url()?>add-product/<?=$product_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a> 

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
    <?php include('footer.php');?>


<script>
$('#example').DataTable({ 
dom: 'Blfrtip',
responsive: true,
lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
 
    buttons: [
        {
            extend: 'copy',
            filename: 'product-list',
            exportOptions: {
                columns: [0,1,2,3,4] 
            }
        },
        {
            extend: 'csv',
            filename: 'product-list',
            exportOptions: {
                columns: [0,1,2,3,4] 
            }
        },
        {
            extend: 'excel',
            filename: 'product-list',
            exportOptions: {
                columns: [0,1,2,3,4] 
            }
        },
        {
            extend: 'pdf',
            filename: 'product-list',
            exportOptions: {
                columns: [0,1,2,3,4] 
            }
        },
        {
            extend: 'print',
            filename: 'product-list',
            exportOptions: {
                columns: [0,1,2,3,4] 
            }
        }
        
    ], 
});
</script>
</body>

</html>
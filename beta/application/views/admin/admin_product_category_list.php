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
                                Product Category List
								<a href="<?=base_url();?>admin_product_category" class="btn btn-primary pull-right">Add New</a>
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
                            <div class="x_panel">
                                <div class="x_title">
                                    <button id="toggle-drag" class="btn btn-primary">Enable Order Update</button>
                                    <label class="error" id="error-drag"></label>
                                </div>
                                <div class="x_content">
                                   <table id="example" class="table table-striped responsive-utilities jambo_table">
                                            <thead>
                                                <tr class="headings">
                                                    <th style="width:8%;">Sr. No.</th>
                                                    <th style="width:10%;" class="handle_order hidden">Update Order</th>
                                                    <th style="width:10%;">View Order</th>
                                                    <th>Product Category</th>
                                                    <th>Product Category Marathi</th> 
                                                    <th class="status-column-hidden">Status</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php if(!empty($product_category)){
                                                    $i=1;
                                                    foreach($product_category as $product_category_result){ 
                                                        $category_products = $this->Admin_model->get_category_products($product_category_result->id);
                                                        $admin_category_products = $this->Admin_model->get_category_admin_products($product_category_result->id);
                                                ?>
                                                <tr class="draggable-rows" data-id="<?=$product_category_result->id;?>" data-order="<?=$product_category_result->order;?>">
                                                    <td style="width:8%;" class="sr-no" scope="row"><?=$i++?></td>
                                                    <td style="width:10%;cursor:grab;" class="handle handle_order hidden order">
                                                        <i class="fas fa-grip-vertical"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    </td>
                                                    <td style="width:10%;" class="sr-no">
                                                        <?= $product_category_result->order != "" ? (int)$product_category_result->order : 0; ?>
                                                    </td>
                                                    <td><?=$product_category_result->product_category?></td> 
                                                    <td><?=$product_category_result->product_category_marathi?></td> 
                                                    <td class="status-column-hidden">
                                                        <?php if($product_category_result->status == "1"){?>
                                                            <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>admin_inactive/<?=$product_category_result->id?>/tbl_product_category">Active</a>  
                                                        <?php }else{?>

                                                            <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>admin_active/<?=$product_category_result->id?>/tbl_product_category">Inactive</a> 
                                                        <?php }?>
                                                    </td>
                                                    <td>
                                                    <?php if(empty($category_products) && empty($admin_category_products)){ ?>
                                                            <?php if($product_category_result->status == "1"){?>
                                                                <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>admin_inactive/<?=$product_category_result->id?>/tbl_product_category"><i class="fa-solid fa-toggle-on"></i></a>  
                                                            <?php }else{?>

                                                                <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>admin_active/<?=$product_category_result->id?>/tbl_product_category"><i class="fa-solid fa-toggle-off"></i></a> 
                                                            <?php }?>
                                                            <?php }else{ echo '-'; } ?>
                                                            </td>
                                                            <td>
                                                            <?php if(empty($category_products) && empty($admin_category_products)){ ?>
                                                            <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>admin_delete/<?=$product_category_result->id?>/tbl_product_category"><i class="fa-solid fa-trash"></i></a>    

                                                            <a title="Edit" class="btn btn-success" href="<?=base_url()?>admin_product_category/<?=$product_category_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a> 
                                                    <?php }else{ ?>
                                                        <a title="Edit" class="btn btn-success" href="<?=base_url()?>admin_product_category/<?=$product_category_result->id?>?flag=<?=base64_encode('not_allowed')?>"><i class="fa-solid fa-pen-to-square"></i></a> 
                                                        <?php } ?>
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
    $(document).ready(function () {
        let dragEnabled = false;
              
        var table = $('#example').DataTable({ 
            dom: 'Blfrtip',
            responsive: true,
            lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],            
            buttons: [
                {
                    extend: 'excel',
                    filename: 'product-category-list',
                    exportOptions: {
                        columns: [0,2,3,4] 
                    }
                },
            ], 
        });

        $('#toggle-drag').click(function () {
            $('#error-drag').text('');
            var pageInfo = table.page.info();
            if (pageInfo.pages > 1) {
                $('#error-drag').text('Please load all entries on one page to enable order update.');
                return;
            }

            dragEnabled = !dragEnabled;

            if (dragEnabled) {
                $(this).text('Disable Order Update');
                $('.handle_order').removeClass('hidden');
                enableDragAndDrop();
            } else {
                $(this).text('Enable Order Update');
                $('.handle_order').addClass('hidden');
                disableDragAndDrop();
            }
        });

        function enableDragAndDrop() {
            $('#error-drag').text('');
            $('#example tbody').sortable({
                handle: '.handle',
                update: function(event, ui) {
                    var order = [];
                    $('.draggable-rows').each(function(index, element) {
                        var id = $(this).data('id');
                        $(this).data('order', index + 1);
                        
                        if (id) {
                            order.push({
                                id: id,
                                order: index + 1
                            });
                        }
                    });

                    $.ajax({
                        url: '<?=base_url();?>admin/Ajax_controller/update_product_category_order',
                        method: 'POST',
                        data: { order: order },
                        dataType: 'json',
                        success: function(response) {
                            console.log('Order updated successfully', response);

                            $('.draggable-rows').each(function(index) {
                                var newOrder = index + 1;
                                
                                // $(this).find('.order').html('<i class="fas fa-grip-vertical"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+newOrder);
                                $(this).find('.order').html('<i class="fas fa-grip-vertical"></i>');
                                $(this).find('.sr-no').text(newOrder);
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log('An error occurred while updating the order', error);
                        }
                    });
                }
            }).disableSelection();
        }
        function disableDragAndDrop() {
            $('#error-drag').text('');
            $("#example tbody").sortable("destroy");
        }
    });
</script>

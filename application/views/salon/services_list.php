<?php include('header.php'); ?>
<style type="text/css">
    .error {
        font-weight: bold;
    }

    .fade.in {
        display: block !important;
    }
.btn-success:hover,
.btn-success:focus,
.btn-success:active,
.btn-success.active,
.open .dropdown-toggle.btn-success {
    background-color: #1ABB9C !important;
    border-color: #1ABB9C !important;
    color: #FFFFFF !important;
}
.popup {
    width:100%;
    height:100%;
    display:none;
    position:fixed;
    top:0px;
    left:0px;
    background:rgba(0,0,0,0.75);
    z-index: 999999999999;
}
 
/* Inner */
.popup-inner {
    max-width:700px;
    width: 45%;
    padding:40px;
    position:absolute;
    top:35%;
    left:50%;
    -webkit-transform:translate(-50%, -50%);
    transform:translate(-50%, -50%);
    box-shadow:0px 2px 6px rgba(0,0,0,1);
    border-radius:3px;
    background:#fff;
}
 
/* Close Button */
.popup-close {
    width:30px;
    height:30px;
    padding-top:4px;
    display:inline-block;
    position:absolute;
    top:0px;
    right:0px;
    transition:ease 0.25s all;
    -webkit-transform:translate(50%, -50%);
    transform:translate(50%, -50%);
    border-radius:1000px;
    background:rgba(0,0,0,0.8);
    font-family:Arial, Sans-Serif;
    font-size:20px;
    text-align:center;
    line-height:100%;
    color:#fff;
    cursor: pointer;
}
 
.popup-close:hover {
    -webkit-transform:translate(50%, -50%) rotate(180deg);
    transform:translate(50%, -50%) rotate(180deg);
    background:rgba(0,0,0,1);
    text-decoration:none;
}



.popup-scroll{
  overflow-y: scroll;
  max-height: 300px;
  padding:0 1em 0 0;
}
/* .popup-scroll::-webkit-scrollbar {background-color:#EEE;width:10px;}
.popup-scroll::-webkit-scrollbar-thumb {
	border:1px #EEE solid;border-radius:2px;background:#777;
	-webkit-box-shadow: 0 0 8px #555 inset;box-shadow: 0 0 8px #555 inset;
	-webkit-transition: all .3s ease-out;transition: all .3s ease-out;
	}
.popup-scroll::-webkit-scrollbar-track {-webkit-box-shadow: 0 0 2px #ccc;box-shadow: 0 0 2px #ccc;}	 */

</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title" style="float: left;">
                                <h3>Service List for <?php if(!empty($salon_services)){ echo $salon_services->sup_category . '|' . $salon_services->sup_category_marathi; }?></h3>
                            </div>
                            <div style="float: right;">
                            <a  class="service-setup" href="<?= base_url(); ?>salon-services-list/<?=$salon_services->id;?>"><div class="btn btn-primary">Grid View</div></a>
                            <?php 
                            if(!empty($salon_services)){
                           

                                 ?>
                            <a  class="service-setup" href="<?= base_url(); ?>ready-sub-category/<?=$salon_services->id;?>"><div class="btn btn-primary">Add Service</div></a>

                                <?php
                                 }
                                ?>
                            <a  class="service-setup" href="<?= base_url(); ?>add-salon-services"><div class="btn btn-primary">Back</div></a>
                            </div>
                            <div class="x_content">   
                                <?php if (!empty($store_category)){
                                    if($store_category->category == '2'){ ?>
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
                                            <button type="submit" id="filter_submit" class="btn btn-success">Search</button>
                                            <?php if(isset($_GET['filter_gender'])){ ?>
                                                <a id="filter_reset" style="margin-top:22px;" class="btn btn-warning" href="<?=base_url();?><?=$this->uri->segment(1);?>/<?=$this->uri->segment(2);?>">Reset</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </form>
                                <?php }else{ ?>
                                    <input type="hidden" name="filter_gender" id="filter_gender" value="<?=$store_category->category;?>">
                                <?php }} ?>
                                <input type="hidden" name="category" id="category" value="<?=$this->uri->segment(2); ?>">
                                        <div class="x_title">
                                            <button id="toggle-drag" class="btn btn-primary">Enable Order Update</button>
                                            <label class="error" id="error-drag"></label>
                                        </div>                                    
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <table id="example" class="table table-striped responsive-utilities jambo_table" style="width:100%;">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:8%;">Sr. No.</th>
                                                                <th style="width:10%;" class="handle_order hidden">Update Order</th>
                                                                <th style="width:10%;">View Order</th>
                                                                <th>Service Name</th>
                                                                <th>Category</th>
                                                                <th>Sub Category</th>
                                                                <th>Gender</th>
                                                                <th>Duration</th>
                                                                <th>Price</th>
                                                                <!-- <th>Rewards</th> -->
                                                                <th>Products</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $count_product = 1; if(!empty($salon_services_list)){ foreach($salon_services_list as $service_products_result){   
                                                                    $is_allowed = $this->Salon_model->get_service_delete_allowed($service_products_result->id);
                                                                    $style = '';
                                                                    $title = '';
                                                                    if($service_products_result->is_special == '1'){
                                                                        $style = 'background-color: #d8efd1;"';
                                                                        $title = '<small style="font-size: 50%;"> (Special Service)</small>';
                                                                    }
                                                                    $service_products = $this->Salon_model->get_selected_service_products($service_products_result->product);                                                                          
                                                            ?>
                                                                <tr class="draggable-rows" style="<?=$style;?>" data-gender="<?=$service_products_result->gender;?>" data-id="<?=$service_products_result->id;?>" data-order="<?=$service_products_result->order;?>">
                                                                    <td style="width:8%;" class="sr-no" scope="row"><?=$count_product++?></td>
                                                                    <td style="width:10%;cursor:grab;" class="handle handle_order hidden order">
                                                                        <i class="fas fa-grip-vertical"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    </td>
                                                                    <td style="width:10%;" class="sr-no">
                                                                        <?= $service_products_result->order != "" ? (int)$service_products_result->order : 0; ?>
                                                                    </td>
                                                                    <td><?=$service_products_result->service_name;?> <?=$title;?></td>
                                                                    <td><?=$service_products_result->sup_category?>|<?=$service_products_result->sup_category_marathi?></td>
                                                                    <td><?= $service_products_result->subcategory ?>|<?= $service_products_result->sub_category_marathi ?></td>
                                                                    <td><?php
                                                                        if($service_products_result->gender == '0'){
                                                                            echo '<p>Male<p/>';
                                                                        }elseif($service_products_result->gender == '1'){
                                                                            echo '<p>Female</p>';
                                                                        }elseif($service_products_result->gender == '2'){
                                                                            echo '<p>Other</p>';
                                                                        }else{
                                                                            echo '-';
                                                                        }
                                                                    ?></td>
                                                                    <td><?=$service_products_result->service_duration;?> min</td>
                                                                    <td><?=$service_products_result->final_price;?></td>
                                                                    <!-- <td><?=$service_products_result->reward_point;?></td> -->
                                                                    <td>
                                                                        <?php if (!empty($service_products)) {
                                                                            $product_names = [];
                                                                            foreach ($service_products as $single_service_products_result) {
                                                                                $product_names[] = $single_service_products_result->product_name;
                                                                            }

                                                                            $chunks = array_chunk($product_names, 2);

                                                                            foreach ($chunks as $chunk) {
                                                                                echo implode(', ', $chunk);
                                                                                echo "<br>";
                                                                            }
                                                                        } else {
                                                                            echo '-';
                                                                        } ?>
                                                                    </td>
                                                                    <td>
                                                                    <?php if($is_allowed){ ?>
                                                                        <a title="Edit" class="btn btn-success" href="<?=base_url()?>add-salon-services/<?=$service_products_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a> 
                                                                        <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$service_products_result->id?>/tbl_salon_emp_service"><i class="fa-solid fa-trash"></i></a>    
                                                                    <?php }else{ ?>
                                                                        <label style="text-align:center; color:red;">Already Used</label>
                                                                    <?php } ?>
                                                                    </td>
                                                            <?php }} ?>
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

$id = '0';
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>

<script>


function view_description(service_id){
    $('[data-popup-open]').on('click', function(e)  {
        var service_id = jQuery(this).attr('data-popup-open');
        $('[data-popup="' + service_id + '"]').fadeIn(350);
 
        e.preventDefault();
    });
 
    //----- CLOSE
    $('[data-popup-close]').on('click', function(e)  {
        var service_id = jQuery(this).attr('data-popup-close');
        $('[data-popup="' + service_id + '"]').fadeOut(350);
 
        e.preventDefault();
    });
}
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.service-setup').addClass('active_cc');

        function closePopupOnClickOutside() {
            $('[data-popup]').on('click', function(e) {
                if (e.target === this) {
                    $(this).fadeOut(350);
                }
            });
        }
        closePopupOnClickOutside();

    });
</script>
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
                    filename: 'services-list',
                    exportOptions: {
                        columns: [0,2,3,4,5,6,7,8,9] 
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

            if($('#filter_gender').val() == ""){
                $('#error-drag').text('Please first filter the entries based on gender to enable order update.');
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
                        var gender = $(this).data('gender');
                        $(this).data('order', index + 1);
                        
                        if (id) {
                            order.push({
                                id: id,
                                gender: gender,
                                order: index + 1
                            });
                        }
                    });

                    $.ajax({
                        url: '<?=base_url();?>salon/Ajax_controller/update_service_order',
                        method: 'POST',
                        data: { order: order, category: $('#category').val() },
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
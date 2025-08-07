<?php include('header.php');?>
 <style type="text/css">
     .buttons-html5{
        background-color: lightblue;
     }
 </style>

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                             Gift Card List
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
                                    <table id="example" class="table table-striped responsive-utilities jambo_table" style="width: 100%;">
                                        <thead>
                                            <tr class="headings">
                                                <th>
                                                    <input type="checkbox" class="tableflat">
                                                </th>
                                                <th>Gift Name</th>
                                                <th>Services</th> 
                                                <th>Regular Price</th> 
                                                <th>Discount</th>
                                                <th>Gift Price</th>
                                                <th>Gift Button</th>
                                                <th>Status</th>
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
                                                <th scope="row"><?=$i++?></th>
                                                <td><?=$gift_card_list_result->gift_name?></td>
                                                <td>
                                                    <?php 
                                                        if(!empty($service_name)) {
                                                            $firstService = true;
                                                            foreach($service_name as $service_name_result) {
                                                                if (!$firstService) {
                                                                    echo " + ";
                                                                }
                                                                echo $service_name_result->service_name;
                                                                $firstService = false; 
                                                            }
                                                            echo ".";
                                                        }
                                                    ?>
                                                </td>
                                                <td><?=$gift_card_list_result->regular_price?></td>
                                                <?php if($gift_card_list_result->discount_in == 0): ?>
                                                    <td><?=$gift_card_list_result->discount?>%</td>
                                                <?php else: ?>
                                                    <td>Rs.<?=$gift_card_list_result->discount?></td>
                                                <?php endif; ?>
                                                <td><?=$gift_card_list_result->gift_price?></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm" style="background-color:<?=$gift_card_list_result->bg_color;?>; color:<?=$gift_card_list_result->text_color;?>"><?=$gift_card_list_result->gift_name;?></button>
                                                </td>
                                                <td>
                                                    <?php if($gift_card_list_result->status == "1"){?>
                                                        <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$gift_card_list_result->id?>/tbl_gift_card"><i  style="color: blue; font-size: 25px;" class="fa-solid fa-toggle-on"></i></a>  
                                                    <?php }else{?>

                                                        <a  title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$gift_card_list_result->id?>/tbl_gift_card"><i style="font-size: 25px;" class="fa-solid fa-toggle-off"></i></a> 
                                                    <?php }?>
                                                </td>
                                                <td>
                                                    <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$gift_card_list_result->id?>/tbl_gift_card"><i class="fa-solid fa-trash"></i></a>    

                                                    <a title="Edit" class="btn btn-success" href="<?=base_url()?>add-gift-card/<?=$gift_card_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a> 

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
            dom: 'Bfrtip',
            responsive: true,
            lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
             
                buttons: [
                    
                    {
                        extend: 'excel',
                        filename: 'offer-list',
                        exportOptions: {
                            columns: [0,1,2] 
                        }
                    }
                  
                    
                ], 
        });
        </script>
<script>
    $(document).ready(function() {
        $('#gift .child_menu').show();
        $('#gift').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.gift_card_list').addClass('active_cc');
    });
</script>
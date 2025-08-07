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
                            Offers List
                            </h3>
                        </div>
<!-- 
                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                
                            </div>
                        </div> -->
                    </div>
                    <!-- <div class="clearfix"></div> -->

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                                                <th>Offers Name</th>
                                                <th>Services</th> 
                                                <th>Regular Price</th> 
                                                <th>Discount</th>
                                                <th>Offers Price</th>
                                                <th>Validity</th>
                                                <th>Status</th>
                                                <th class=" no-link last"><span class="nobr">Actions</span>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php if(!empty($offers_list)){
                                                $i=1;
                                                    foreach($offers_list as $offers_list_result){
                                                        $service_name=$this->Salon_model->get_selected_service_name_for_offer($offers_list_result->service_name)
                                            ?>
                                            <tr>
                                                <th scope="row"><?=$i++?></th>
                                                <td><?=$offers_list_result->offers_name?></td>
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
                                                <td><?=$offers_list_result->regular_price?></td>
                                                <?php if($offers_list_result->discount_in == 1): ?>
                                                    <td><?=$offers_list_result->discount?>%</td>
                                                <?php else: ?>
                                                    <td>Rs.<?=$offers_list_result->discount?></td>
                                                <?php endif; ?>
                                                <td><?=$offers_list_result->offer_price?></td>
                                                <td><?=$offers_list_result->duration?> Week</td>
                                                <td>
                                                    <?php if($offers_list_result->status == "1"){?>
                                                        <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$offers_list_result->id?>/tbl_offers"><i  style="color: blue; font-size: 25px;" class="fa-solid fa-toggle-on"></i></a>  
                                                    <?php }else{?>

                                                        <a  title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$offers_list_result->id?>/tbl_offers"><i style="font-size: 25px;" class="fa-solid fa-toggle-off"></i></a> 
                                                    <?php }?>
                                                </td>
                                                <td>
                                                    <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$offers_list_result->id?>/tbl_offers"><i class="fa-solid fa-trash"></i></a>    

                                                    <a title="Edit" class="btn btn-success" href="<?=base_url()?>add-offers/<?=$offers_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a> 

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
      $(document).ready(function () {
			$('#offers-mngt .child_menu').show();
			$('#offers-mngt').addClass('nv active');
			$('.right_col').addClass('active_right');
			$('.offers_list').addClass('active_cc');
		});
</script>
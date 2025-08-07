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
                            Membership List
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
                                
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table class="table table-striped responsive-utilities jambo_table"style="width: 100%;" id="example">
                                        <thead>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>Membership Name</th>
                                                <th>Regular Price</th>
                                                <th>Service Discount</th>
                                                <th>Product Discount</th>
                                                <th>Memebership Price</th>
                                                <th>Memebership Button</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                             <tbody>
                                            <?php if(!empty($membership_list)){
                                                $i=1;
                                                    foreach($membership_list as $membership_list_result){
                                            ?>
                                            <tr>
                                                <th scope="row"><?=$i++?></th>
                                                <td><?=$membership_list_result->membership_name?></td>
                                                <td><?=$membership_list_result->regular_price?></td>

                                                <?php if($membership_list_result->discount_in == 0): ?>
                                                    <td><?=$membership_list_result->service_discount?>%</td>
                                                    <td><?=$membership_list_result->product_discount?>%</td>
                                                <?php else: ?>
                                                    <td>Rs.<?=$membership_list_result->service_discount?></td>
                                                    <td>Rs.<?=$membership_list_result->product_discount?></td>
                                                <?php endif; ?>

                                                <td><?=$membership_list_result->membership_price?></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm" style="background-color:<?=$membership_list_result->bg_color;?>; color:<?=$membership_list_result->text_color;?>"><?=$membership_list_result->membership_name;?></button>
                                                </td>
                                                <td>
                                                    <?php if($membership_list_result->status == "1"){?>
                                                        <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$membership_list_result->id?>/tbl_memebership"><i  style="color: blue; font-size: 25px;" class="fa-solid fa-toggle-on"></i></a>  
                                                    <?php }else{?>

                                                        <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$membership_list_result->id?>/tbl_memebership"><i style="font-size: 25px;" class="fa-solid fa-toggle-off"></i></a> 
                                                    <?php }?>
                                                </td>
                                                <td>
                                                    <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$membership_list_result->id?>/tbl_memebership"><i class="fa-solid fa-trash"></i></a>   

                                                    <a title="Edit" class="btn btn-primary" href="<?=base_url()?>add-membership/<?=$membership_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a>   
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
            scrollX: false,

            lengthMenu: [ [10, 25, 50,], [10, 25, 50] ],
             
                buttons: [
                    
                    {
                        extend: 'excel',
                        filename: 'course-list',
                        exportOptions: {
                            columns: [0,1,2] 
                        }
                    }
                    
                ], 
        });
        </script>
<script>
      $(document).ready(function () {
			$('#Membership .child_menu').show();
			$('#Membership').addClass('nv active');
			$('.right_col').addClass('active_right');
			$('.membership_list').addClass('active_cc');
		});
</script>
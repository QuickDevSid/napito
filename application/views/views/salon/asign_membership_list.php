<?php include('header.php');?>
 <style type="text/css">
     .buttons-html5{
        background-color: lightblue;
     }
 </style>

            <!-- page content -->
            <div class="right_col" role="main">
            <?php
        if($gst == ""){?>
        <div class="row"> 
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title" style="text-align: center;">
                        <img src="<?= base_url(); ?>\admin_assets\images\no_data\c_store.jpg">
                    </div>
                    <div style="text-align: center;font-size: 15px;">
                    Click to complete store profile <a style="color:blue;" class="store-profile" href="<?= base_url(); ?>store-profile">Store Profile</a>
                    </div>
                </div>
            </div>
        </div>
        <?php }else{?>
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                            Assign Membership List
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
                                    <table class="table table-striped responsive-utilities jambo_table"style="width: 100%;" id="example">
                                        <thead>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>Customer</th>
                                                <th>Mobile</th>
                                                <th>Memebership</th>
                                                <th>Period</th>
                                                <th>Price</th>
                                                <th>Sold By</th>
                                                <!-- <th>Dowload Receipt</th> -->
                                                <th>Payment Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                             <tbody>
                                            <?php if(!empty($asign_list)){
                                                $i=1;
                                                    foreach($asign_list as $asign_list_result){
                                                        $sold_by = $this->Salon_model->get_single_emp_details($asign_list_result->employee_id);
                                            ?>
                                            <tr>
                                                <td><?=$i++?></td>
                                                <td><?=$asign_list_result->full_name?></td>
                                                <td><?=$asign_list_result->customer_phone?></td>
                                                <td>
                                                    <button class="btn btn-sm" style="float:left; background-color: <?=$asign_list_result->bg_color; ?>; color:<?=$asign_list_result->text_color; ?>;"><?=$asign_list_result->membership_name?></button>
                                                </td>
                                                <td><?= ($asign_list_result->membership_start != "" && $asign_list_result->membership_end != "") ? date('d M Y',strtotime($asign_list_result->membership_start)).' to '.date('d M Y',strtotime($asign_list_result->membership_end)) : '-';?></td>
                                                <td><?=$asign_list_result->membership_price?></td>
                                                <td><?=!empty($sold_by) ? $sold_by->full_name : '-';?></td>
                                                <!-- <td><a style="color: blue;" href="<?= base_url(); ?>membership-print/<?=$asign_list_result->id?>">Download</a></td> -->
                                                <td>
                                                    <?php if($asign_list_result->payment_status == "1"){?>
                                                        <label class="label label-success">Completed</label>  
                                                    <?php }else{?>
                                                        <label class="label label-warning">Pending</label>  
                                                    <?php }?>
                                                </td>
                                                <td>
                                                     <!-- <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$asign_list_result->id?>/tbl_customer_membership_history"><i class="fa-solid fa-trash"></i></a>   -->
                                                    <?php if(date('Y-m-d') >= date('Y-m-d',strtotime($asign_list_result->membership_end))){ ?>
                                                        <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$asign_list_result->membership_id?>/tbl_memebership"><i class="fa-solid fa-trash"></i></a>     
                                                    <?php }else{
                                                        echo 'Active Membership';
                                                    } ?>
                                                    <!--<a title="Edit" class="btn btn-success" href="<?=base_url()?>asign-membership/<?=$asign_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a>   -->
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
                    <?php }?>
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
                        filename: 'asign-membership-list',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6,7,8] 
                        }
                    }
                    
                ], 
        });
        </script>
<script>
    $(document).ready(function() {
  
      
        $('#asign_membership .child_menu').show();
        $('#asign_membership').addClass('nv active');
        $('.asign_membership_list').addClass('active_cc');
        $('.right_col').addClass('active_right');
       
    });
</script>

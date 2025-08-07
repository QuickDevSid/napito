<?php include('header.php');?>
<style type="text/css">
    .photo-btn{
  border: solid 2px lightblue;
  border-radius: 3px;
}
.photo-btn a{
  text-decoration: none;
}
</style>
            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                            Customer Care Report List
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
                                                <th>Customer Name</th>
                                                <th>Mobile Number</th>
                                                <th>Last Calling Date</th>
                                                <th>Status</th>
                                                <th>Recording</th>
                                                <th>FeedBack</th>
                                                <th>Status</th>
                                                <th class=" no-link last"><span class="nobr">Actions</span>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php if(!empty($customer_care_report_list)){
                                                $i=1;
                                                    foreach($customer_care_report_list as $customer_care_report_list_result){
                                            ?>
                                            <tr>
                                                <th scope="row"><?=$i++?></th>
                                                <td><?=$customer_care_report_list_result->customer_name?></td>
                                                <td><?=$customer_care_report_list_result->phone?></td>
                                                <td><?=$customer_care_report_list_result->last_date?></td>
                                                <td><?=$customer_care_report_list_result->report_status?></td>
                                                <td style="width: 200px;"><?=$customer_care_report_list_result->audio_file?></td>
                                                <td><?=$customer_care_report_list_result->remark?></td>
                                                <td>
                                                    <?php if($customer_care_report_list_result->status == "1"){?>
                                                        <a title="Inctive"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>admin_inactive/<?=$customer_care_report_list_result->id?>/tbl_customer_care_report"><i class="fa-solid fa-toggle-on"></i></a>  
                                                    <?php }else{?>

                                                        <a title="Active"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>admin_active/<?=$customer_care_report_list_result->id?>/tbl_customer_care_report"><i class="fa-solid fa-toggle-off"></i></a> 
                                                    <?php }?>
                                                </td>
                                                <td>
                                                    

                                                    <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>admin_delete/<?=$customer_care_report_list_result->id?>/tbl_customer_care_report"><i class="fa-solid fa-trash"></i></a>    

                                                    <a title="Edit" class="btn btn-success" href="<?=base_url()?>customer-care-report-list/<?=$customer_care_report_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a> 

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
            responsive: true,
            lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
             
                buttons: [
                    
                    {
                        extend: 'excel',
                        filename: 'employee-list',
                        exportOptions: {
                            columns: [0,1,2,3,4] 
                        }
                    },
                   
                    
                ], 
        });
        </script>
</body>

</html>
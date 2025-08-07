<?php include('header.php');?>


<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                     Customer calling List
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

            <div class="col-md-12 col-sm-12 col-xs-12">
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
                            <th>Calling Date/Time</th>
                            <th>Status</th>
                            <th>Remark</th>
                            <th>Call Recording</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($view_history_list)){
                            $i = 1;
                            foreach($view_history_list as $view_history_list_result){
                        ?>
                        <tr>
                            <th scope="row"><?=$i++?></th>
                            <td><?=$view_history_list_result->last_date?></td>
                            <td><?=$view_history_list_result->report_status?></td>
                            <td><?=$view_history_list_result->remark?></td>
                            <td><?=$view_history_list_result->audio_file?></td>
                            <td>
                                <?php if($view_history_list_result->status == "1"){?>
                                <a title="Inctive" onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$view_history_list_result->id?>/tbl_customer_care_report"><i class="fa-solid fa-toggle-on" style="color: blue; font-size: 25px;"></i></a> <?php }else{?>

                               <a title="Active" class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$view_history_list_result->id?>/tbl_customer_care_report"><i class="fa-solid fa-toggle-off" style="font-size: 25px;"></i></a>    
                                   <?php }?>
                            </td>
                            
                            <td>
                                <a class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$view_history_list_result->id?>/tbl_customer_care_report"><i class="fa-solid fa-trash"></i></a>
                                <a class="btn btn-success" href="<?=base_url()?>view-calling-history/<?=$view_history_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                        </tr>
                        <?php }} ?>
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
            extend: 'copy',
            filename: 'salon-list',
            exportOptions: {
                columns: [0,1,2,3,4] 
            }
        },
        {
            extend: 'csv',
            filename: 'salon-list',
            exportOptions: {
                columns: [0,1,2,3,4] 
            }
        },
        {
            extend: 'excel',
            filename: 'salon-list',
            exportOptions: {
                columns: [0,1,2,3,4] 
            }
        },
        {
            extend: 'pdf',
            filename: 'salon-list',
            exportOptions: {
                columns: [0,1,2,3,4] 
            }
        },
        {
            extend: 'print',
            filename: 'salon-list',
            exportOptions: {
                columns: [0,1,2,3,4] 
            }
        }
        
    ], 
});
</script>
</body>

</html>
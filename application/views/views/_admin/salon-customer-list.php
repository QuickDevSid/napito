<?php include('header.php');?>


<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Salon Customer Feedback
                </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    
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
                                <th>Salon Name</th>
                                <th>Branch Name</th>
                                <th>Add Customer Feedback</th>
                              
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($branch_list)) {
                                $i = 1;
                                foreach ($branch_list as $branch_list_result) {
                                    ?>
                                    <tr>
                                        <th scope="row">
                                            <?= $i++ ?>
                                        </th>
                                        <td>
                                            <?= $branch_list_result->salon_name?>
                                        </td>
                                        <td>
                                            <?= $branch_list_result->branch_name ?>
                                        </td>
                                        <td><a style="color: blue;" href="<?=base_url(); ?>customer-care-report/<?= $branch_list_result->salon_id?>/<?= $branch_list_result->id?>">View Customer </a></td>
                                        
                                        </td>
                                        
                                    </tr>
                                <?php }
                            } ?>

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
            filename: 'salon-list',
            exportOptions: {
                columns: [0,1,2,3,4] 
            }
        },
       
        
    ], 
});
</script>
</body>

</html>
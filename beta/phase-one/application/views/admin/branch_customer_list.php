<?php include('header.php');?>


<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    <?php if(!empty($branch)){ echo $branch->branch_name.', '.$branch->salon_name; }?> Customer List
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
                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                        <thead>
                            <tr class="headings">
                                <th>
                                    Sr.No
                                    <!-- <input type="checkbox" class="tableflat"> -->
                                </th>
                                <th>Customer Name</th>
                                <th>Mobile No.</th>
                                <th>Email</th>
                              
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($customers)) {
                                $i = 1;
                                foreach ($customers as $branch_list_result) {
                                    ?>
                                    <tr>
                                        <td scope="row">
                                            <?= $i++ ?>
                                        </td>
                                        <td>
                                            <?= $branch_list_result->full_name?>
                                        </td>
                                        <td>
                                            <?= $branch_list_result->customer_phone ?>
                                        </td>
                                        <td>
                                            <?= $branch_list_result->email != "" ? $branch_list_result->email : '-' ?>
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
responsive: false,
lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
 
    buttons: [
       
        {
            extend: 'excel',
            filename: 'customer-feedback-list',
            exportOptions: {
                columns: [0,1,2] 
            }
        },
       
        
    ], 
});
</script>
</body>

</html>
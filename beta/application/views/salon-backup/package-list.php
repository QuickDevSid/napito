 <?php include('header.php');?>

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                                Package List
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
                                                <th>Package Name</th>
                                                <th>Services</th>
                                                <th>Status</th>
                                                <th class=" no-link last"><span class="nobr">Actions</span>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php if(!empty($package_list)){
                                                $i=1;
                                                    foreach($package_list as $package_list_result){
                                            ?>
                                            <tr>
                                                <th scope="row"><?=$i++?></th>
                                                <td><?=$package_list_result->package_name?></td>
                                                <td><?=$package_list_result->service_name?></td>
                                                <td>
                                                    <?php if($package_list_result->status == "1"){?>
                                                        <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$package_list_result->id?>/tbl_package"><i  style="color: blue; font-size: 25px;" class="fa-solid fa-toggle-on"></i></a>  
                                                    <?php }else{?>

                                                        <a title="Delete"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$package_list_result->id?>/tbl_package"><i style="font-size: 25px;" class="fa-solid fa-toggle-off"></i></a> 
                                                    <?php }?>
                                                </td>
                                                <td>
                                                    <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$package_list_result->id?>/tbl_package"><i class="fa-solid fa-trash"></i></a>    

                                                    <a title="Edit" class="btn btn-success" href="<?=base_url()?>add-salon/<?=$package_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a> 

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
                        extend: 'copy',
                        filename: 'package-list',
                        exportOptions: {
                            columns: [0,1,2] 
                        }
                    },
                    {
                        extend: 'csv',
                        filename: 'package-list',
                        exportOptions: {
                            columns: [0,1,2] 
                        }
                    },
                    {
                        extend: 'excel',
                        filename: 'package-list',
                        exportOptions: {
                            columns: [0,1,2] 
                        }
                    },
                    {
                        extend: 'pdf',
                        filename: 'package-list',
                        exportOptions: {
                            columns: [0,1,2] 
                        }
                    },
                    {
                        extend: 'print',
                        filename: 'package-list',
                        exportOptions: {
                            columns: [0,1,2] 
                        }
                    }
                    
                ], 
        });
        </script>
</body>

</html>
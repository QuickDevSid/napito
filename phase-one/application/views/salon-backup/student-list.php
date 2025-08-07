 <?php include('header.php');?>

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                                Student List
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
                                                <th>Student Name</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Course Name</th>
                                                <th>Date Of Birth</th>
                                                <th>Gender</th>
                                                <th>Fees History</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php if(!empty($student_list)){
                                                $i=1;
                                                    foreach($student_list as $student_list_result){
                                            ?>
                                            <tr>
                                                <th scope="row"><?=$i++?></th>
                                                <td><?=$student_list_result->student_name?></td>
                                                <td><?=$student_list_result->phone?></td>
                                                <td><?=$student_list_result->address?></td>
                                                <td><?=$student_list_result->course_name?></td>
                                                <td><?=$student_list_result->dob?></td>
                                                <td><?= ($student_list_result->gender == 1) ? "female" : "male" ?></td>
                                                <td><a style="color: blue;" href="<?=base_url();?>fees-history/<?=$student_list_result->id?>">Fees History</a></td>
                                                                                                                    
                                                <td>
                                                    <?php if($student_list_result->status == "1"){?>
                                                        <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$student_list_result->id?>/tbl_student"><i  style="color: blue; font-size: 25px;" class="fa-solid fa-toggle-on"></i></a>  
                                                    <?php }else{?>

                                                        <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$student_list_result->id?>/tbl_student"><i style="font-size: 25px;" class="fa-solid fa-toggle-off"></i></a> 
                                                    <?php }?>
                                                </td>
                                                <td>
                                                    <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$student_list_result->id?>/tbl_student"><i class="fa-solid fa-trash"></i></a>    

                                                    <a title="Edit" class="btn btn-success" href="<?=base_url()?>add-student/<?=$student_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a> 

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
            responsive: false,
            lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
             
                buttons: [
                    {
                        extend: 'copy',
                        filename: 'offer-list',
                        exportOptions: {
                            columns: [0,1,2,3,4] 
                        }
                    },
                    {
                        extend: 'csv',
                        filename: 'offer-list',
                        exportOptions: {
                            columns: [0,1,2,3,4] 
                        }
                    },
                    {
                        extend: 'excel',
                        filename: 'offer-list',
                        exportOptions: {
                            columns: [0,1,2,3,4] 
                        }
                    },
                    {
                        extend: 'pdf',
                        filename: 'offer-list',
                        exportOptions: {
                            columns: [0,1,2,3,4] 
                        }
                    },
                    {
                        extend: 'print',
                        filename: 'offer-list',
                        exportOptions: {
                            columns: [0,1,2,3,4] 
                        }
                    }
                    
                ], 
        });
        </script>
</body>

</html>
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
                            Courses List
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
                                    <table class="table table-striped" id="example">
                                        <thead>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>Course Name</th>
                                                <th>Service</th>
                                                <th>Fee Amount</th>
                                                <th>Time</th>
                                                <th>Duration</th>
                                                <th>Holiday</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                             <tbody>
                                            <?php if(!empty($course_list)){
                                                $i=1;
                                                    foreach($course_list as $course_list_result){
                                            ?>
                                            <tr>
                                                <th scope="row"><?=$i++?></th>
                                                <td><?=$course_list_result->course_name?></td>
                                                <td><?=$course_list_result->service?></td>
                                                <td><?=$course_list_result->fees_amount?></td>
                                                <td><?=$course_list_result->time?></td>
                                                <td><?=$course_list_result->duration?></td>
                                                <td><?=$course_list_result->holiday?></td>
                                                <td>
                                                    <?php if($course_list_result->status == "1"){?>
                                                        <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$course_list_result->id?>/tbl_course_master"><i  style="color: blue; font-size: 25px;" class="fa-solid fa-toggle-on"></i></a>  
                                                    <?php }else{?>

                                                        <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$course_list_result->id?>/tbl_course_master"><i style="font-size: 25px;" class="fa-solid fa-toggle-off"></i></a> 
                                                    <?php }?>
                                                </td>
                                                <td>
                                                    <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$course_list_result->id?>/tbl_course_master"><i class="fa-solid fa-trash"></i></a>   

                                                    <a title="Edit" class="btn btn-primary" href="<?=base_url()?>add-course/<?=$course_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a>   
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
            responsive: false,
            lengthMenu: [ [10, 25, 50,], [10, 25, 50] ],
             
                buttons: [
                    {
                        extend: 'copy',
                        filename: 'course-list',
                        exportOptions: {
                            columns: [0,1,2] 
                        }
                    },
                    {
                        extend: 'csv',
                        filename: 'course-list',
                        exportOptions: {
                            columns: [0,1,2] 
                        }
                    },
                    {
                        extend: 'excel',
                        filename: 'course-list',
                        exportOptions: {
                            columns: [0,1,2] 
                        }
                    },
                    {
                        extend: 'pdf',
                        filename: 'course-list',
                        exportOptions: {
                            columns: [0,1,2] 
                        }
                    },
                    {
                        extend: 'print',
                        filename: 'course-list',
                        exportOptions: {
                            columns: [0,1,2] 
                        }
                    }
                    
                ], 
        });
        </script>
</body>

</html>
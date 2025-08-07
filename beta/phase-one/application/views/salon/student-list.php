 <?php include('header.php');?>
 <style>
  .status-column-hidden {
        display: none;
    }

    .status-column-hidden-visible {
        display: table-cell;
    }
 </style>

            <!-- page content -->
            <div class="right_col" role="main">
                <div class=""><?php
        if($gst == ""){?>
        <div class="row"> 
            <div class="col-md-12 col-sm-12 col-xs-12">
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
                        <div class="title_left" style="width:100%;">
                            <h3>
                                Student List<a style="float:right;" href="<?=base_url();?>add-student" class="btn btn-primary">Add Student</a>
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
                                                </th>
                                                <th>Student Name</th>
                                                <th>Phone</th>
                                                <th>Courses</th>
                                                <th>Address</th>
                                                <th>Date Of Birth</th>
                                                <th>Gender</th>
                                                <!-- <th>Total Fee</th> -->
                                                <th>Fees History</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php if(!empty($student_list)){
                                                $i=1;
                                                    foreach($student_list as $student_list_result){
                                                        $courses = $this->Salon_model->get_student_courses($student_list_result->id);
                                                        $courses_text = '';
                                                        if(!empty($courses)){
                                                            foreach($courses as $courses_result){
                                                                $courses_text .= $courses_result->course_name.', ';
                                                            }
                                                        }
                                            ?>
                                            <tr>
                                                <td><?=$i++?></td>
                                                <td><?=$student_list_result->student_name?></td>
                                                <td><?=$student_list_result->phone?></td>
                                                <td><?=rtrim($courses_text, ', ');?></td>
                                                <td><?=$student_list_result->address?></td>

                                                <td><?=$student_list_result->dob?></td>
                                                <td><?= ($student_list_result->gender == 1) ? "female" : "male" ?></td>
                                                
                                                <!-- <td><?=$student_list_result->fees_amount?></td> -->
                                                <td><a style="color: blue;" href="<?=base_url();?>student-fees-history/<?=$student_list_result->id?>">Fees History</a></td>
                                                <td>
                                                    <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$student_list_result->id?>/tbl_student"><i class="fa-solid fa-trash"></i></a>    

                                                    <!-- <a title="Edit" class="btn btn-success" href="<?=base_url()?>update-student/<?=$student_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a>  -->

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
            dom: 'Blfrtip',
            responsive: false,
            lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
             
                buttons: [
                   
                    {
                        extend: 'excel',
                        filename: 'student-list',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6,8] 
                        },
                        customize: function (xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            $('row c[r^="K"]', sheet).attr('s', '2');
                        }
                    }
                ], 
        });
        </script>
<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.student_list').addClass('active_cc');
    });
</script>
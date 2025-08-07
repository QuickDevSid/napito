 <?php include('header.php'); ?>
 <style type="text/css">
     .buttons-html5 {
         background-color: lightblue;
     }

     .status-column-hidden {
         display: none;
     }

     .status-column-hidden-visible {
         display: table-cell;
     }
 </style>

 <!-- page content -->
 <div class="right_col" role="main">
     <?php
        if ($gst == "") { ?>
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
     <?php } else { ?>
         <div class="page-title">
             <div class="title_left">
                 <h3>
                     Courses List<a style="float:right;" href="<?= base_url(); ?>add-course" class="btn btn-primary">Add Course</a>
                 </h3>
             </div>

             <!-- <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div> -->

             <div class="row">

                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                     <div class="x_panel">
                         <div class="x_title">

                             <div class="clearfix"></div>
                         </div>
                         <div class="x_content">
                             <table class="table table-striped responsive-utilities jambo_table" style="width: 100%;" id="example">
                                 <thead>
                                     <tr>
                                         <th>Sr No</th>
                                         <th>Course Name</th>
                                         <th>Details</th>
                                         <th>Fee Amount</th>
                                         <!-- <th>Time</th> -->
                                         <th>Duration</th>
                                         <th>Holiday</th>
                                         <th class="status-column-hidden">Status</th>
                                         <th>Status</th>
                                         <th>Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php if (!empty($course_list)) {
                                            $i = 1;
                                            foreach ($course_list as $course_list_result) {
                                                $service_name = $this->Salon_model->get_selected_service_name_for_offer($course_list_result->service)
                                        ?>
                                             <tr>
                                                 <td><?= $i++ ?></td>
                                                 <td><?= $course_list_result->course_name ?></td>
                                                 <td>
                                                     <?php echo $course_list_result->course_details; ?>
                                                 </td>
                                                 <td><?= $course_list_result->fees_amount ?></td>
                                                 <!-- <td><?= $course_list_result->time ?></td> -->
                                                 <td><?= $course_list_result->duration ?> Month</td>
                                                 <td><?= $course_list_result->holiday ?></td>
                                                 <td class="status-column-hidden">
                                                     <?php if ($course_list_result->status == "1") { ?>
                                                         <a title="Active" onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?= base_url() ?>inactive/<?= $course_list_result->id ?>/tbl_course_master">Active</a>
                                                     <?php } else { ?>

                                                         <a title="Inctive" class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?= base_url() ?>active/<?= $course_list_result->id ?>/tbl_course_master">Inactive</a>
                                                     <?php } ?>
                                                 </td>
                                                 <td>
                                                     <?php if ($course_list_result->status == "1") { ?>
                                                         <a title="Active" onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?= base_url() ?>inactive/<?= $course_list_result->id ?>/tbl_course_master"><i class="fa-solid fa-toggle-on"></i></a>
                                                     <?php } else { ?>

                                                         <a title="Inctive" class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?= base_url() ?>active/<?= $course_list_result->id ?>/tbl_course_master"><i class="fa-solid fa-toggle-off"></i></a>
                                                     <?php } ?>
                                                 </td>
                                                 <td>
                                                     <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?= base_url() ?>delete/<?= $course_list_result->id ?>/tbl_course_master"><i class="fa-solid fa-trash"></i></a>

                                                     <a title="Edit" class="btn btn-success" href="<?= base_url() ?>add-course/<?= $course_list_result->id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
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
         <?php } ?>
         </div>
 </div>
         <?php include('footer.php'); ?>


         <script>
             $('#example').DataTable({
                 dom: 'Bfrtip',
                 responsive: true,
                 scrollX: false,

                 lengthMenu: [
                     [10, 25, 50, -1],
                     [10, 25, 50, "All"]
                 ],
                 buttons: [{
                         extend: 'excel',
                         filename: 'course-list',
                         exportOptions: {
                             columns: [0, 1, 2, 3, 4, 5, 6]
                         },
                         customize: function(xlsx) {
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
                 $('.course_list').addClass('active_cc');
             });
         </script>
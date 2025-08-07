 <?php include('header.php'); ?>
 <style>
    td{
        height: 30px;
    }
    td a{
        color: var(--primary) !important;
    }
</style>
 <!-- page content -->
 <div class="right_col" role="main">
     <div class="">
         <div class="page-title">
             <div class="title_left">
                 <h3>
                     Student Allocated Courses Details
                 </h3>
             </div>

             <!-- <div class="title_right">
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
                         <table id="example" class="table table-striped responsive-utilities jambo_table">
                             <thead>
                                 <tr class="headings">
                                     <th>
                                         Sr.No
                                     </th>
                                     <th>Student Name</th>
                                     <th>Course Name</th>
                                     <th>Total Fee</th>
                                     <th>Total Paid</th>
                                     <th>Pending Fees</th>
                                     <th>Fees History</th>
                                 </tr>
                             </thead>

                             <tbody>
                                 <?php if (!empty($payment_entry_list)) {
                                        $i = 1;
                                        foreach ($payment_entry_list as $payment_entry_list_result) {
                                    ?>
                                         <tr>
                                             <td><?= $i++ ?></td>
                                             <td><?= $payment_entry_list_result->student_name ?></td>
                                             <td><?= $payment_entry_list_result->course_name ?></td>
                                             <td><?= $payment_entry_list_result->total_fees ?></td>
                                             <td><?= $payment_entry_list_result->total_paid_fees ?></td>
                                             <td><?= $payment_entry_list_result->total_pending_fees ?></td>
                                             <td><a style="color: blue;text-decoration:underline;" href="<?= base_url(); ?>fees-history/<?= $payment_entry_list_result->id ?>">View History</a></td>
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
            lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
             
                buttons: [
                   
                    {
                        extend: 'excel',
                        filename: 'offer-list',
                        exportOptions: {
                            columns: [0,1,2,3,4,5] 
                        }
                    },
                    
                ], 
        });
        </script>
<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.payment-history').addClass('active_cc');
    });
</script>

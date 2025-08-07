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
                            Offers List
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
                                                <th>Customer Name</th>
                                                <th>Service Name</th>
                                                <th>Time Slot</th>
                                                <th>Price</th>
                                                <th>Actions</span>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php if(!empty($booking_list)){
                                                $i=1;
                                                    foreach($booking_list as $booking_list_result){
                                            ?>
                                            <tr>
                                                <th scope="row"><?=$i++?></th>
                                                <td><?=$booking_list_result->customer_name?></td>
                                                <td><?=$booking_list_result->service_name?></td>
                                                <td><?=$booking_list_result->time_slot?></td>
                                                <td><?=$booking_list_result->price?></td>
                                                <td>
                                                    <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$booking_list_result->id?>/tbl_new_booking"><i class="fa-solid fa-trash"></i></a>    

                                                    <a title="Edit" class="btn btn-success" href="<?=base_url()?>booking-calender/<?=$booking_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a> 

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
                    // {
                    //     extend: 'copy',
                    //     filename: 'offer-list',
                    //     exportOptions: {
                    //         columns: [0,1,2] 
                    //     }
                    // },
                    // {
                    //     extend: 'csv',
                    //     filename: 'offer-list',
                    //     exportOptions: {
                    //         columns: [0,1,2] 
                    //     }
                    // },
                    {
                        extend: 'excel',
                        filename: 'offer-list',
                        exportOptions: {
                            columns: [0,1,2] 
                        }
                    }
                    // {
                    //     extend: 'pdf',
                    //     filename: 'offer-list',
                    //     exportOptions: {
                    //         columns: [0,1,2] 
                    //     }
                    // },
                    // {
                    //     extend: 'print',
                    //     filename: 'offer-list',
                    //     exportOptions: {
                    //         columns: [0,1,2] 
                    //     }
                    // }
                    
                ], 
        });
        </script>
<script>
      $(document).ready(function () {
			$('#booking_management .child_menu').show();
			$('#booking_management').addClass('nv active');
			$('.right_col').addClass('active_right');
			$('.booking_calender').addClass('active_cc');
		});
</script>
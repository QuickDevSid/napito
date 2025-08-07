 <?php include('header.php');?>

            <!-- page content -->
            <div class="right_col" role="main">
            <?php
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
                        <div class="title_left">
                            <h3>
                                Student Fees History List
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
                                                <th>Course</th>
                                                <th>Total Fees</th>
                                                <th>Paid Amount</th>
                                                <th>Pending Fees</th>
                                                <th>Payment Date</th>
                                                <th>Mode</th>
                                                <th>Transaction ID</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php 
                                                $total_total_fees = 0;
                                                $total_paid_fees = 0;
                                                $total_pending_fees = 0;
                                            if(!empty($fees_history)){
                                                $i=1;
                                                    foreach($fees_history as $fees_history_result){
                                                        $total_total_fees += $fees_history_result->total_fees != "" ? (float)($fees_history_result->total_fees) : 0.00;
                                                        $total_paid_fees += $fees_history_result->amount_to_paid != "" ? (float)($fees_history_result->amount_to_paid) : 0.00;
                                                        $total_pending_fees += $fees_history_result->total_pending_fees != "" ? (float)($fees_history_result->total_pending_fees) : 0.00;
                                            ?>
                                            <tr>
                                                <td><?=$i++?></td>
                                                <td><?=$fees_history_result->student_name.'<br>'.$fees_history_result->phone;?></td>
                                                <td><?=$fees_history_result->course_name?></td>
                                                <td><?=$fees_history_result->total_fees?></td>
                                                <td><?=$fees_history_result->amount_to_paid?></td>
                                                <td><?=$fees_history_result->total_pending_fees?></td>
                                                <td><?=date('d/m/Y',strtotime($fees_history_result->date));?></td>
                                                <td>
                                                    <?php
                                                        if($fees_history_result->payment_mode == '1'){
                                                            echo 'UPI';
                                                        }elseif($fees_history_result->payment_mode == '2'){
                                                            echo 'Cash';
                                                        }elseif($fees_history_result->payment_mode == '3'){
                                                            echo 'Cheque';
                                                        }elseif($fees_history_result->payment_mode == '4'){
                                                            echo 'Online';
                                                        }else{
                                                            echo '-';
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if($fees_history_result->transaction_id != ""){
                                                            echo $fees_history_result->transaction_id;
                                                        }else{
                                                            echo '-';
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php }}?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="text-align:center;" colspan="3">Total <small>(In INR)</small></th>
                                                <th><?=$total_total_fees?></th>
                                                <th><?=$total_paid_fees?></th>
                                                <th><?=$total_pending_fees?></th>
                                                <th colspan="3"></th>
                                            </tr>
                                        </tfoot>
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
                        filename: 'offer-list',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6,7,8] 
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
        $('.payment-history').addClass('active_cc');
    });
</script>
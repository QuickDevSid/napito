<?php include('header.php');?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Salary List
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
                                        Sr. No.
                                    </th>
                                    <th>Empolyee Name</th>
                                    <th>Period</th>
                                    <th>Present Days</th>
                                    <th>Absent Days</th>
                                    <th>Half Days</th>
                                    <th>Salary</th>
                                    <th>Deduction</th>
                                    <th>Loan Amount</th>
                                    <th>Total Paid</th>
                                    <th>Paid Date</th>
                                    <th>Slip</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                // echo "<pre>"; print_r($salary_list); exit;
                                if(!empty($salary_list)){
                                    $i=1;
                                        foreach($salary_list as $salary_list_result){
                                ?>
                                <tr>
                                    <th scope="row"><?=$i++?></th>
                                    <td><?=$salary_list_result->full_name?></td>
                                    <td><?=date('d-m-Y',strtotime($salary_list_result->from_date));?> To <?=date('d-m-Y',strtotime($salary_list_result->to_date));?></td>
                                    <td><?= $salary_list_result->present_days ?></td>                                   
                                    <td><?= $salary_list_result->absent_days ?></td>                                   
                                    <td><?= $salary_list_result->half_days ?></td>                                   
                                    <td><?= number_format(floatval($salary_list_result->basic_pay), 2) ?></td>                                   
                                    <td><?= number_format(floatval($salary_list_result->basic_pay - $salary_list_result->paid_amt - $salary_list_result->loan_deduction_amount), 2) ?></td>                                 
                                    <td><?= $salary_list_result->loan_deduction_amount != '' ? number_format(floatval($salary_list_result->loan_deduction_amount), 2) : '0.00' ?></td>                                 
                                    <td><?= number_format(floatval($salary_list_result->paid_amt), 2) ?></td> 
                                    <td><?=date('d-m-Y',strtotime($salary_list_result->payed_date))?></td>                                  
                                    <td>
                                        <a title="Salary Slip" style="text-decoration:underline;" target="_blank" class="btn btn-light" href="<?=base_url()?>print_salary_slip/<?=$salary_list_result->id?>">View</a>                                     
                                    </td>
                                </tr>
                            <?php }}?>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
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
            filename: 'salon-salary-list',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10] 
            }
        },
       
        
        
    ], 
});
</script>
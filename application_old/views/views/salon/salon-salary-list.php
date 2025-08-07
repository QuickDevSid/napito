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
                        <table style="width: 100%;" id="example" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr class="headings">
                                    <th>
                                        Sr. No.
                                    </th>
                                    <th>Empolyee Name</th>
                                    <th>Month</th>
                                    <th>Salary</th>
                                    <th>Incentive</th>
                                    <th>Total Paid</th>
                                    <th>Loan Amount</th>
                                    <th>Paid Date</th>
                                    <th>Slip</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if(!empty($salary_list)){
                                    $i=1;
                                        foreach($salary_list as $salary_list_result){
                                            $month_name = '';
                                            if($salary_list_result->salaried_month == '01'){
                                                $month_name = 'Jan';
                                            }else if($salary_list_result->salaried_month == '02'){
                                                $month_name = 'Feb';
                                            }else if($salary_list_result->salaried_month == '03'){
                                                $month_name = 'Mar';
                                            }else if($salary_list_result->salaried_month == '04'){
                                                $month_name = 'Apr';
                                            }else if($salary_list_result->salaried_month == '05'){
                                                $month_name = 'May';
                                            }else if($salary_list_result->salaried_month == '06'){
                                                $month_name = 'Jun';
                                            }else if($salary_list_result->salaried_month == '07'){
                                                $month_name = 'Jul';
                                            }else if($salary_list_result->salaried_month == '08'){
                                                $month_name = 'Aug';
                                            }else if($salary_list_result->salaried_month == '09'){
                                                $month_name = 'Sept';
                                            }else if($salary_list_result->salaried_month == '10'){
                                                $month_name = 'Oct';
                                            }else if($salary_list_result->salaried_month == '11'){
                                                $month_name = 'Nov';
                                            }else if($salary_list_result->salaried_month == '12'){
                                                $month_name = 'Dec';
                                            }
                                ?>
                                <tr>
                                    <th scope="row"><?=$i++?></th>
                                    <td><?=$salary_list_result->full_name?></td>
                                    <td><?=$month_name; ?>-<?=date('y',strtotime($salary_list_result->salaried_year))?></td>
                                    <td><?= number_format(floatval($salary_list_result->paid_salary_amt), 2) ?></td>                                   
                                    <td><?= number_format(floatval($salary_list_result->paid_incentive), 2) ?></td>   
                                    <td><?= $salary_list_result->is_loan_deduction == '1' ? number_format(floatval($salary_list_result->loan_deduction_amount), 2) : '0.00' ?></td>                                 
                                    <td><?= number_format(floatval($salary_list_result->paid_amt), 2) ?></td> 
                                    <td><?=date('d-m-Y',strtotime($salary_list_result->payed_date))?></td>                                  
                                    <td>
                                        <a title="Salary Slip" style="text-decoration:underline;" target="_blank" class="btn btn-light" href="<?=base_url()?>salon_print_salary_slip/<?=$salary_list_result->id?>">View</a>                                     
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
                columns: [0,1,2,3,4,5,6] 
            }
        },
       
        
        
    ], 
});
</script>
<script>
    $(document).ready(function() {
        $('#reports .child_menu').show();
        $('#reports').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.cc_salon_salary_list').addClass('active_cc');
    });
</script>
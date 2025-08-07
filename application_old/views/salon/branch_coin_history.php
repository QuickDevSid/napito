<?php include('header.php');?>

<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left" style="width:97%;">
            <h3 style="font-size: 20px;">
                Coin History
                <button type="button" style="float:right;margin-right:-30px" class="btn btn-primary">Current Balance: <?=$profile->coin_balance != "" ? (int)$profile->coin_balance : 0;?></button>
            </h3>
            <small style="margin-left:20px" ><b>(Rs. <?=per_coin_in_rs;?> Per Coin Earned)</b></small>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <table class="table table-striped responsive-utilities jambo_table"style="width: 100%;" id="example">
                        <thead>
                            <tr>
                                <th>Entry On</th>
                                <th>Entry Type</th>
                                <th>Opening Balance</th>
                                <th>Coin Amount</th>
                                <th>Closing Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i=1; 
                            if(!empty($branch_coin_history)){ 
                                foreach($branch_coin_history as $branch_coin_history_result){ 
                                    $entry_type = '';
                                    $entry_description = '';
                                    if($branch_coin_history_result->entry_type == '0'){
                                        if($branch_coin_history_result->debit_type == '0'){
                                            $entry_type = 'Used In Subscription Payment';
                                        }
                                        $style="background-color:#f3616147;";
                                    }elseif($branch_coin_history_result->entry_type == '1'){
                                        if($branch_coin_history_result->credit_type == '0'){
                                            $entry_type = 'Mobile App Customer Registration';
                                            $customer = $this->Salon_model->get_customer_info($branch_coin_history_result->customer_id);
                                            $entry_description = !empty($customer) ? '<small>Customer: ' . $customer->full_name . ', ' . $customer->customer_phone . '</small>' : '';
                                        }elseif($branch_coin_history_result->credit_type == '1'){
                                            $entry_type = 'Branch Referral Earning';
                                            $branch = $this->Salon_model->get_branch_info($branch_coin_history_result->refer_to_branch_id);
                                            $entry_description = !empty($branch) ? '<small>Branch: ' . $branch->branch_name . ' [' . $branch->salon_name . ']</small>' : '';
                                        }
                                        $style="background-color:#0080002e;";
                                    }
                            ?>
                            <tr style="<?=$style;?>">
                                <td><?=date('d M, Y h:i A',strtotime($branch_coin_history_result->created_on));?></td>
                                <td><?=$entry_type != "" ? $entry_type : '-';?><?=$entry_description != "" ? '<br>' . $entry_description : '';?></td>
                                <td><?=$branch_coin_history_result->opening_balance;?></td>
                                <td><?=$branch_coin_history_result->coin_amount;?></td>
                                <td><?=$branch_coin_history_result->closing_balance;?></td>
                            </tr>
                            <?php }} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php');?>
<script>
    $(document).ready(function() {
        $('#example').DataTable({ 
            responsive:true,
            dom: 'Blfrtip',
            lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
            buttons: [				
                {
                    extend: 'excel',
                    filename: 'branch-list',
                    exportOptions: {
                        columns: [0,1,2,3,4] 
                    }
                },	
            ], 
        });
    });
    $(document).ready(function() {
        $('#marketing .child_menu').show();
        $('#marketing').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.coin_history').addClass('active_cc');
    });
</script>
<?php include('header.php');?>
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left" style="width:100%;">
            <h3 style="font-size: 20px;">
                Branch Coin History
                <small style="float:right;"> (Rs. <?=per_coin_in_rs;?> Per Coin Earned)</small>
            </h3>
        </div>
        <?php if(!empty($branch_details)){ ?>
        <div class="title_left">
        <h4 style="color:#383838; text-align:center;"><?=$branch_details->branch_name;?>, <?=$branch_details->salon_name;?></h4>
        </div>
        <?php } ?>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <table class="table table-striped responsive-utilities jambo_table"style="width: 100%;" id="example">
                        <thead>
                            <tr>
                                <!-- <th>Sr. No.</th> -->
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
                                    if($branch_coin_history_result->entry_type == '0'){
                                        if($branch_coin_history_result->debit_type == '0'){
                                            $entry_type = 'Used In Subscription Payment';
                                        }
                                        $style="background-color:#f3616147;";
                                    }elseif($branch_coin_history_result->entry_type == '1'){
                                        if($branch_coin_history_result->credit_type == '0'){
                                            $entry_type = 'Mobile App Customer Registration';
                                        }elseif($branch_coin_history_result->credit_type == '1'){
                                            $entry_type = 'Branch Referral Earning';
                                        }
                                        $style="background-color:#0080002e;";
                                    }
                            ?>
                            <tr style="<?=$style;?>">
                                <!-- <td><?=$i++;?></td> -->
                                <td><?=date('d M, Y h:i A',strtotime($branch_coin_history_result->created_on));?></td>
                                <td><?=$entry_type != "" ? $entry_type : '-';?></td>
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
            dom: 'Blfrtip',
            responsive:true,
            lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
            buttons: [				
                {
                    extend: 'excel',
                    filename: 'branch-list',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9,10] 
                    }
                },	
            ], 
        });
    });
</script>
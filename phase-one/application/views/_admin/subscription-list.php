<?php include('header.php');?>


<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    subscription List
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
                                            <tr>
                                                <th>Sr No</th>
                                                <th>Subscription Name</th>
                                                <th>Pincode </th>
                                                <th>Category</th>
                                                <th>No. of Stylist </th>
                                                <th>Amount </th>
                                                <th>No. of Installments </th>
                                                <th>Percent of Amount </th>
                                                <th>Duration </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php if(!empty($subscription_list)){
                                        		$i=1;
                                        			foreach($subscription_list as $subscription_list_result){
                                        	?>
                                            <tr>
                                                <th scope="row"><?=$i++?></th>
                                                <td><?=$subscription_list_result->subscription_name?></td>
                                                <td><?=$subscription_list_result->pincode?></td>
                                                <td><?=$subscription_list_result->category?></td>
                                                <td><?=$subscription_list_result->stylist?></td>
                                                <td><?=$subscription_list_result->amount?></td>
                                                <td><?=$subscription_list_result->installment?></td>
                                                <td><?=$subscription_list_result->percent_amount?></td>
                                                <td><?=$subscription_list_result->duration?></td>
                                                <td>
                                                	<a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>admin_delete/<?=$subscription_list_result->id?>/tbl_subscription_master"><i class="fa-solid fa-trash"></i></a>	

                                                	<a title="Edit" class="btn btn-success" href="<?=base_url()?>add-subscription/<?=$subscription_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a>	
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
 dom: 'Blfrtip',
responsive: false,
lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
 
    buttons: [
        
        {
            extend: 'excel',
            filename: 'subscription-list',
            exportOptions: {
                columns: [0,1,2,3,4] 
            }
        },
        
        
    ], 
});
</script>

<?php include('header.php');?>


<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Subscription List
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
                                                <th>Sr.No</th>
                                                <th>Name</th>
                                                <!-- <th>Category</th> -->
                                                <th>Amount </th>
                                                <!-- <th>No. of Installments </th>
                                                <th>Percent of Amount </th> -->
                                                <th>Validity <small>(In Days)</small></th>
                                                <th>Features</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php if(!empty($subscription_list)){
                                        		$k=1;
                                        			foreach($subscription_list as $subscription_list_result){
                                                        $is_subscription_applied = $this->Admin_model->check_is_subscription_applied($subscription_list_result->id);
                                                        // $is_subscription_applied = array();
                                            ?>
                                            <tr>
                                                <td scope="row"><?=$k++?></td>
                                                <td><?=$subscription_list_result->subscription_name?></td>
                                                <!-- <td> -->
                                                    <?php
                                                        // if($subscription_list_result->category == '0'){
                                                        //     echo 'Male';
                                                        // }elseif($subscription_list_result->category == '1'){
                                                        //     echo 'Female';
                                                        // }elseif($subscription_list_result->category == '2'){
                                                        //     echo 'Unisex';
                                                        // }else{
                                                        //     echo '-';
                                                        // }
                                                    ?>
                                                <!-- </td> -->
                                                <td><?=$subscription_list_result->amount?></td>
                                                <!-- <td><?=$subscription_list_result->installment?></td>
                                                <td><?=$subscription_list_result->percent_amount?></td> -->
                                                <td><?=$subscription_list_result->duration != "" ? $subscription_list_result->duration : '-'; ?></td>
                                                <td>
                                                    <a onclick="showPopup('subscriptionFeaturesModal_<?=$subscription_list_result->id;?>')" title="Subscription Features" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#subscriptionFeaturesModal_<?=$subscription_list_result->id;?>">
                                                        <i class="fa-solid fa-bell"></i>
                                                    </a>
                                                    <!-- Subscription Features Modal -->
                                                    <div class="modal fade" id="subscriptionFeaturesModal_<?=$subscription_list_result->id;?>" tabindex="-1" aria-labelledby="subscriptionFeaturesModalLabel_<?=$subscription_list_result->id;?>" aria-hidden="true">
                                                      <div class="modal-dialog" style="width: 1000px;">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="subscriptionFeaturesModalLabel_<?=$subscription_list_result->id;?>">Subscription Features</h5>           
                                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('subscriptionFeaturesModal_<?=$subscription_list_result->id;?>')">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                          </div>
                                                          <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <table id="features_table_<?=$subscription_list_result->id;?>" class="table table-striped responsive-utilities jambo_table features_table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th style="width:10%;">Sr. No.</th>
                                                                                <th style="width:35%;">Feature</th>
                                                                                <th style="width:35%;">Description</th>
                                                                                <th style="width:20%;">Feature Link</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                                $subscription_features = $this->Admin_model->get_subscription_features_list(explode(',',$subscription_list_result->features));
                                                                                if($subscription_features && !empty($subscription_features)){
                                                                                    $i=1;
                                                                                    foreach($subscription_features as $subscription_features_result){
                                                                            ?>
                                                                            <tr>
                                                                                <td style="width:10%;"><?=$i++?></td>
                                                                                <td style="width:35%;"><?=$subscription_features_result->feature_name;?></td>
                                                                                <td style="width:35%;"><?=$subscription_features_result->description;?></td>
                                                                                <td style="width:20%;"><?=$subscription_features_result->slug;?></td>
                                                                            </tr>
                                                                            <?php }}else{ ?>
                                                                            <tr>
                                                                                <td colspan="3">No Features Found</td>
                                                                            </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>                                                    
                                                </td>
                                                <td>
                                                    <?php if(empty($is_subscription_applied)){ ?>
                                                	    <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>admin_delete/<?=$subscription_list_result->id?>/tbl_subscription_master"><i class="fa-solid fa-trash"></i></a>	
                                                        <a title="Edit" class="btn btn-success" href="<?=base_url()?>add-subscription/<?=$subscription_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a>	
                                                    <?php }else{ ?>
                                                        -
                                                    <?php } ?>
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
lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
 
    buttons: [
        
        {
            extend: 'excel',
            filename: 'subscription-list',
            exportOptions: {
                columns: [0,1,2,3] 
            }
        },
        
        
    ], 
});
$('.features_table').DataTable({ 
 dom: 'Blfrtip',
lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
 
    buttons: [
        
        {
            extend: 'excel',
            filename: 'subscription-feature-list',
            exportOptions: {
                columns: [0,1,2,3] 
            }
        },
        
        
    ], 
});
    function showPopup(id){
        var exampleModal = $('#'+id);
        exampleModal.modal('show');
    }
    function closePopup(id){
        var exampleModal = $('#'+id);
        exampleModal.modal('hide');
    }
</script>

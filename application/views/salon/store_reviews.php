<?php include('header.php'); ?>
<style type="text/css">

.gridDiv{
    text-align: center;
    border: 1px solid #ccc;
    border-radius: 12px;
    margin: 5px;    
    padding-right: 0px !important;
    padding-left: 0px !important;
    width: 24% !important;
}
.gridDiv img{
    width: 150px;
    height: 150px;
    margin-bottom: 5px;
    margin-top: 5px;
}

td .btn{
    max-width: 100px;
}
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Store Reviews
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <table style="width: 100% !important;" id="example" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr class="headings">
                                    <th>Sr. No.</th>
                                    <th>Customer</th>
                                    <th>Phone No.</th>
                                    <th>Stars</th>
                                    <th>Description</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if(!empty($reviews)){
                                    $i=1;
                                        foreach($reviews as $salary_list_result){
                                ?>
                                <tr>
                                    <th scope="row"><?=$i++?></th>
                                    <td><?=$salary_list_result->full_name?></td>
                                    <td><?=$salary_list_result->customer_phone?></td>
                                    <td>
                                        <?php 
                                            $totalStars = 5;
                                            $filledStars = $salary_list_result->stars;
                                            $emptyStars = $totalStars - $filledStars;
                                        
                                            for ($j = 0; $j < $filledStars; $j++) {
                                                echo '<i class="fa fa-star" style="margin-left: 5px;font-size: 15px;color: gold;"></i>';
                                            }
                                        
                                            for ($j = 0; $j < $emptyStars; $j++) {
                                                echo '<i class="fa fa-star" style="margin-left: 5px;font-size: 15px;color: #cccc;"></i>';
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <button type="button" onclick="showPopup(<?=$salary_list_result->id;?>)" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_<?=$salary_list_result->id;?>">
                                            View
                                        </button>
                                        <div class="modal fade" id="exampleModal_<?=$salary_list_result->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_<?=$salary_list_result->id;?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel_<?=$salary_list_result->id;?>">Description</h5>
                                                        <button style="margin-top: -25px;" type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closePopup(<?=$salary_list_result->id;?>)">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?=$salary_list_result->description != "" ? '<p>'.$salary_list_result->description.'</p>' : '<p style="text-align: center;">Not Available</p>'; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
</div>
<?php include('footer.php'); ?>
<script>
    $(document).ready(function() {
        $('#example').DataTable({ 
            dom: 'Blfrtip',
            responsive: true,
            lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],        
            buttons: [    
                {
                    extend: 'excel',
                    filename: 'salon-salary-list',
                    exportOptions: {
                        columns: [0,1,2,3,4] 
                    }
                },  
            ], 
        });
        $('#marketing .child_menu').show();
        $('#marketing').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.salon-reviews').addClass('active_cc');
    });
    function showPopup(id){
        var exampleModal = $('#exampleModal_'+id);
        exampleModal.css('display','block');
        exampleModal.css('opacity','1');
        $('.modal-open').css('overflow','auto').css('padding-right','0px'); 
    }
    function closePopup(id){
        var exampleModal = $('#exampleModal_'+id);
        exampleModal.css('display','none');
        exampleModal.css('opacity','0');
        $('.modal-open').css('overflow','auto').css('padding-right','0px');
    }
</script>
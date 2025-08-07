<?php include('header.php');?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left" style="width:100%;">
                <h3 style="width:100%;">
                    Enquiries List <a style="float:right;" class="btn btn-primary" href="<?=base_url();?>add-enquiry-form">Add New</a>
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
                        <table id="example" class="content_table table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Employee</th>
                                    <th>Service</th>
                                    <th>Follow-Up On</th>
                                    <th>Type</th>
                                    <th>Mode</th>
                                    <th>Enquiry Date</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 1;
                                    if(!empty($result)){
                                        foreach($result as $data){
                                ?>  
                                <tr>
                                    <td><?=$i++;?></td>
                                    <td><?=$data->customer_name;?></td>
                                    <td><?=$data->mobile;?></td>
                                    <td><?=$data->full_name;?></td>
                                    <td><?=$data->enquiry_services != "" ? $data->enquiry_services : '-';?></td>
                                    <td><?=date('d M, Y h:i A',strtotime($data->date.' '.$data->time));?></td>
                                    <td><?=$data->type;?></td>
                                    <td>
                                        <?php
                                            if($data->mode == '1'){
                                                echo 'Email';
                                            }elseif($data->mode == '2'){
                                                echo 'Phone';
                                            }elseif($data->mode == '3'){
                                                echo 'Whatsapp';
                                            }else{
                                                echo '-';
                                            }
                                        ?>
                                    </td>
                                    <td><?=$data->enquiry_date != "" ? date('d M, Y',strtotime($data->enquiry_date)) : '-';?></td>
                                    <td><?=$data->description;?></td>
                                </tr>
                                <?php }}else{ ?>
                                    <tr>
                                        <td colspan="10" style="text-align:center;">No Data Available</td>
                                    </tr>
                                <?php } ?>
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
// responsive: false,
// scrollX:300,
lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
 
    buttons: [
        
       
        {
            extend: 'excel',
            filename: 'salon-inquiry-list',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9] 
            }
        },
       
        
        
    ], 
});
</script>
<script>
    $(document).ready(function() {
        $('#enquiry .child_menu').show();
        $('#enquiry').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.all_enquiry').addClass('active_cc');
    });
</script>
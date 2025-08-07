<?php include('header.php');?>
<style>
    .set_price_btn{
        width: 100px;
        padding: 5px 8px;
        /* background-color: black; */
        color: white;
        border-radius: 5px;
        border: none;

    }
    table#example td button{
        max-width: 135px;
    }
   
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Service List
                </h3>
                <a  class="service-setup" href="<?= base_url(); ?>add-salon-services"><div style="font-size: 14px;
    float: right;
    color: #7f7fdf;"><?php if (isset($category_name)) { echo $category_name; } ?> <span style="font-size: 17px;"> <i class="fa-solid fa-arrow-right"></i> <span></div></a>
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
                    <div class="x_content">
                        <table id="example" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr class="headings">
                                    <th>
                                       Sr.no
                                    </th>
                                    <th>Sub Category</th>
                                    <th>Set Service Details</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if(!empty($salon_services_list)){
                                    // echo "<pre>";print_r($salon_services_list);exit;
                                    $i=1;
                                    $check=0;
                                        foreach($salon_services_list as $salon_services_list_result){
                                ?>
                                <tr>
                                    <td scope="row"><?=$i++?></td>
                                    <td><?=$salon_services_list_result->sub_category?></td>
                                    <td>
                                    <a href="<?= base_url('ready-services/' . $salon_services_list_result->id) ?>/applied">
                                            <button class="set_price_btn btn-info">Set Price</button>
                                    <!-- <?php if(!empty($services_list)){
                                        foreach($services_list as $services_list_result){
                                            $check=1;
                                        ?>
                                        <?php if($services_list_result->sub_category == $salon_services_list_result->id){?>
                                            <a href="<?= base_url('ready-services/' . $salon_services_list_result->id) ?>/applied">
                                            <button class="set_price_btn">Set Price</button>
                                        </a>
                                        <?php }else{?>
                                            No Service Available
                                            <?php break;?>
                                        <?php }?>
                                        <?php }}?>
                                        <?php if($check == 0){?>
                                            No Service Available
                                        <?php }?>    -->
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
            filename: 'ready-services',
            exportOptions: {
                columns: [0,1,2,3,4] 
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
        $('.service-setup').addClass('active_cc');
    });
</script>
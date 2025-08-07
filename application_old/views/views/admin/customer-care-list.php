<?php include('header.php');?>


<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Customer Care List
                </h3>
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
                    <div class="x_title">
                    
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="example" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr class="headings">
                            <th>
                                Sr.No
                                <!-- <input type="checkbox" class="tableflat"> -->
                            </th>
                            <th>Company Name</th>
                            <th>Whatsapp Number</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Document</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($customer_care_list)){
                            $i = 1;
                            foreach($customer_care_list as $customer_care_list){
                        ?>
                        <tr>
                            <td scope="row"><?=$i++?></td>
                            <td><?=$customer_care_list->company_name?></td>
                            <td><?=$customer_care_list->whatsapp_number?></td>
                            <td><?=$customer_care_list->email?></td>
                            <td><?=$customer_care_list->address?></td>
                            <td><button class="photo-btn"><a target="_blank" href="<?=base_url()?>\admin_assets\images\document/<?=$customer_care_list->document?>" target="_blank">View</a></button> </td>
                            <td>
                                <a class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>admin_delete/<?=$customer_care_list->id?>/tbl_customer_care"><i class="fa-solid fa-trash"></i></a>
                                <a class="btn btn-success" href="<?=base_url()?>add-customer-care/<?=$customer_care_list->id?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                        </tr>
                        <?php }} ?>
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
responsive: true,
lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
 
    buttons: [
       
        {
            extend: 'excel',
            filename: 'customer-care-list',
            exportOptions: {
                columns: [0,1,2,3,4] 
            }
        },
        
        
    ], 
});
</script>
</body>

</html>
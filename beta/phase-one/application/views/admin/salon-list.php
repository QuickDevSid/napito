 <?php include('header.php');?>


            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                                Salon List
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
                                    <tr class="headings">
                                        <th>
                                            <input type="checkbox" class="tableflat">
                                        </th>
                                        <th>Salon Name</th>
                                        <th>Salon Owner Name</th>
                                        <th>Salon Owner Number</th>
                                        <th>Email</th>
                                        <th>GST</th>
                                        <th>Add Branch</th>
                                        <th>Add Gallary</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($add_salon_record)){
                                        $i = 1;
                                        foreach($add_salon_record as $add_salon_record_result){
                                    ?>
                                    <tr>
                                        <th scope="row"><?=$i++?></th>
                                        <td><?=$add_salon_record_result->salon_name?></td>
                                        <td><?=$add_salon_record_result->salon_owner_name?></td>
                                        <td><?=$add_salon_record_result->salon_owner_number?></td>
                                        <td><?=$add_salon_record_result->email?></td>
                                        <td>
                                            <?php
                                                if($add_salon_record_result->is_gst_applicable == '1'){
                                                    echo $add_salon_record_result->gst_no;
                                                }else{
                                                    echo 'Not Applicable';
                                                }
                                            ?>
                                        </td>
                                        <td><a style="color: blue;" href="<?=base_url();?>add-branch/<?=$add_salon_record_result->id?>">Add</a></td>
                                        <td><a  style="color: blue;" href="<?=base_url();?>salon-gallary/<?= $add_salon_record_result->id?>">Add Image</a></td>
                                        <td>
                                            <a class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>admin_delete/<?=$add_salon_record_result->id?>/tbl_salon"><i class="fa-solid fa-trash"></i></a>
                                            <a class="btn btn-success" href="<?=base_url()?>add-salon/<?=$add_salon_record_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a>
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
            responsive: false,
            lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
             
                buttons: [
                    {
                        extend: 'excel',
                        filename: 'salon-list',
                        exportOptions: {
                            columns: [0,1,2,3,4] 
                        }
                    },
                    
                ], 
        });
        </script>

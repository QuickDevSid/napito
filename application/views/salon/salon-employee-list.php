 <?php include('header.php');?>

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                                Employee List
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
                                    <table id="example" class="table table-striped responsive-utilities jambo_table display" style="width: 100%;">
                                        <thead>
                                            <tr class="headings">
                                                <th>
                                                    <input type="checkbox" class="tableflat">
                                                </th>
                                                <th>Name</th>
                                                <th>Service</th>
                                                <th>Role</th>
                                                <th>Address</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php if(!empty($salon_employee_list)){
                                                $i=1;
                                                    foreach($salon_employee_list as $salon_employee_list_result){
                                            ?>
                                            <tr>
                                                <th scope="row"><?=$i++?></th>
                                                <td><?=$salon_employee_list_result->full_name?></td>
                                                <td><?=$salon_employee_list_result->email?></td>
                                                <td><?=$salon_employee_list_result->whatsapp_number?></td>
                                                <td><?=$salon_employee_list_result->address?></td>
                                                <td>
                                                    <?php if($salon_employee_list_result->status == "1"){?>
                                                        <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$salon_employee_list_result->id?>/tbl_salon_employee"><i  style="color: blue; font-size: 25px;" class="fa-solid fa-toggle-on"></i></a>  
                                                    <?php }else{?>
                                                        <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$salon_employee_list_result->id?>/tbl_salon_employee"><i style="font-size: 25px;" class="fa-solid fa-toggle-off"></i></a> 
                                                    <?php }?>
                                                </td>
                                                <td>
                                                    <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$salon_employee_list_result->id?>/tbl_salon_employee"><i class="fa-solid fa-trash"></i></a>    

                                                    <a title="Edit" class="btn btn-success" href="<?=base_url()?>add-salon-employee/<?=$salon_employee_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a> 

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
                dom: 'Bfrtip',
                responsive: true,
                scrollX: false,

                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                
                buttons: [
                
                    {
                        extend: 'excel',
                        filename: 'offer-list',
                        exportOptions: {
                            columns: [0,1,2,3,4] 
                        }
                    },
                
                    
                ], 
            });
        </script>
<script>
      $(document).ready(function () {
			$('#employee .child_menu').show();
			$('#employee').addClass('nv active');
			$('.right_col').addClass('active_right');
			$('.salon_employee_list').addClass('active_cc');
		});
</script>
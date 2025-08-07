 <?php include('header.php');?>
<style type="text/css">
    .photo-btn{
  border: solid 2px lightblue;
  border-radius: 3px;
}
.photo-btn a{
  text-decoration: none;
}
</style>
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
                                <div class="input-group">
                                    
                                </div>
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
                                                    Sr.No
                                                </th>
                                                <th>User Type</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Mobile No.</th>
                                                <th>Designation</th>
                                                <th>Profile Photo</th>
                                                <?php if($this->session->userdata('user_type') == '0'){ ?>
                                                <th>Actions</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php if(!empty($add_employee_record)){
                                                $i=1;
                                                    foreach($add_employee_record as $add_employee_record_result){
                                            ?>
                                            <tr>
                                                <td scope="row"><?=$i++?></td>
                                                <td>
                                                    <?php
                                                        if($add_employee_record_result->user_type == '0'){
                                                            echo 'Admin';
                                                        }elseif($add_employee_record_result->user_type == '1'){
                                                            echo 'Staff';
                                                        }else{
                                                            echo '-';
                                                        }
                                                    ?>
                                                </td>
                                                <td><?=$add_employee_record_result->full_name?></td>
                                                <td><?=$add_employee_record_result->email?></td>
                                                <td><?=$add_employee_record_result->phone?></td>
                                                <td><?=$add_employee_record_result->desiganation?></td>
                                                <td><button class="photo-btn"> <a target="_blank" href="<?=base_url();?>/admin_assets/images/employee_profile/<?=$add_employee_record_result->profile_photo?>" target="_blank">View Photo</a></button> </td>
                                                <?php if($this->session->userdata('user_type') == '0'){ ?>
                                                    <td>                                                  
                                                        <?php if($this->session->userdata('admin_id') != $add_employee_record_result->id){ ?>
                                                            <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>admin_delete/<?=$add_employee_record_result->id?>/tbl_employee"><i class="fa-solid fa-trash"></i></a>    
                                                        <?php } ?>
                                                        <a title="Edit" class="btn btn-success" href="<?=base_url()?>add-employee/<?=$add_employee_record_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a> 
                                                    </td>
                                                    <?php } ?>
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
                        filename: 'employee-list',
                        exportOptions: {
                            columns: [0,1,2,3] 
                        }
                    },
                   
                    
                ], 
        });
        </script>
</body>

</html>
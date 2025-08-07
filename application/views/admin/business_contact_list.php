<?php include('header.php');?>
 <style>
.status-column-hidden {
    display: none;
}

.status-column-hidden-visible {
    display: table-cell;
}
</style>
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                                Business Contact List
                            </h3>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <!-- <form method="get" name="" id="" enctype="multipart/form-data">
                                <div class="row cc_row">
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Gender</label>
                                        <select class="form-select form-control chosen-select" name="filter_gender" id="filter_gender">
                                            <option value="">Select Gender</option>
                                            <option value="0" <?php if(isset($_GET['filter_gender']) && $_GET['filter_gender'] == '0'){?>selected="selected"<?php }?>>Male</option>
                                            <option value="1" <?php if(isset($_GET['filter_gender']) && $_GET['filter_gender'] == '1'){?>selected="selected"<?php }?>>Female</option>
                                        </select>
                                        <div class="error" id="filter_gender_error"></div>
                                    </div> 
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <button type="submit" id="filter_submit" style="margin-top:25px;" class="btn btn-success">Search</button>
                                        <?php if(isset($_GET['filter_gender'])){ ?>
                                            <a id="filter_reset" style="margin-top:25px;" class="btn btn-warning" href="<?=base_url();?><?=$this->uri->segment(1);?>">Reset</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </form> -->
                            <div class="x_panel">
                                <div class="x_title">
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                   <table id="example" class="table table-striped responsive-utilities jambo_table">
                                            <thead>
                                                <tr class="headings">
                                                    <th>Sr.No</th>
                                                    <th>Name</th>
                                                    <th>Mobile Number</th>
                                                    <th>Business Name</th>
                                                    <th>City</th>
                                                    <th>Message</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($business_contact)){
                                                    $i=1;
                                                        foreach($business_contact as $business_contact_result){ ?>
                                                <tr>
                                                    <td scope="row"><?=$i++?></td>
                                                    <td><?=$business_contact_result->name?></td>
                                                    <td><?=$business_contact_result->mobile_number?></td>
                                                    <td><?=$business_contact_result->business_name?></td>
                                                    <td><?=$business_contact_result->city?></td>
                                                    <td><?=$business_contact_result->message?></td>
                                                    <td><a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>admin_delete/<?=$business_contact_result->id?>/tbl_contact_us"><i class="fa-solid fa-trash"></i></a></td>
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
            $(".chosen-select").chosen({
                    
            });
    $('#example').DataTable({ 
        dom: 'Blfrtip',
        responsive: true,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        buttons: [
            {
                extend: 'excel',
                filename: 'business-contact-list',
                exportOptions: {
                    columns: [0,1,2,3,4,5] 
                }
             
            }
        ]
    });
</script>


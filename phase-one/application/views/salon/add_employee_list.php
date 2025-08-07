<?php include('header.php'); ?>
<style>
    .tabs {
        width: 100%;
    }

    .tab-nav {
        display: flex;
        /* background: #f0f0f0; */
        border-bottom: 1px solid #ddd;
        text-decoration: none !important;
    }

    .nav-item {
        display: block;
        padding: 10px 0px;
        cursor: pointer;
        margin-right: 10px;
        text-decoration: none !important;
        font-weight: bold;
    }

    .nav-item.selected {
        font-weight: bold;
        /* background: #fff; */
        background: none !important;
        border-bottom: 2px solid #0000ff !important;
        border-radius: 0px !important;
        color: #0000ff;
    }

    .tab {
        display: none;
        padding: 16px;
    }

    .tab.selected {
        display: block;
    }

    .tab-pag {
        padding: 0 16px;
        display: flex;
        justify-content: flex-end;
    }

    .pag-item {
        display: block;
        padding: 12px;
        cursor: pointer;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-right: 8px;
    }

    .pag-item:last-child {
        margin-right: 0;
    }

    .pag-item.hidden {
        display: none;
    }

    .pag-item-submit {

        font-size: 14px;
        color: #fff;


    }
    .popup {
    width:100%;
    height:100%;
    display:none;
    position:fixed;
    top:0px;
    left:0px;
    background:rgba(0,0,0,0.75);
    z-index: 999999999999;
}
 
/* Inner */
.popup-inner {
    max-width:700px;
    width: 45%;
    padding:40px;
    position:absolute;
    top:20%;
    left:50%;
    -webkit-transform:translate(-50%, -50%);
    transform:translate(-50%, -50%);
    box-shadow:0px 2px 6px rgba(0,0,0,1);
    border-radius:3px;
    background:#fff;
}
 
/* Close Button */
.popup-close {
    width:30px;
    height:30px;
    padding-top:4px;
    display:inline-block;
    position:absolute;
    top:0px;
    right:0px;
    transition:ease 0.25s all;
    -webkit-transform:translate(50%, -50%);
    transform:translate(50%, -50%);
    border-radius:1000px;
    background:rgba(0,0,0,0.8);
    font-family:Arial, Sans-Serif;
    font-size:20px;
    text-align:center;
    line-height:100%;
    color:#fff;
}
 
.popup-close:hover {
    -webkit-transform:translate(50%, -50%) rotate(180deg);
    transform:translate(50%, -50%) rotate(180deg);
    background:rgba(0,0,0,1);
    text-decoration:none;
}



.popup-scroll{
  overflow-y: scroll;
  max-height: 300px;
  padding:0 1em 0 0;
}
.popup-scroll::-webkit-scrollbar {background-color:#EEE;width:10px;}
.popup-scroll::-webkit-scrollbar-thumb {
	border:1px #EEE solid;border-radius:2px;background:#777;
	-webkit-box-shadow: 0 0 8px #555 inset;box-shadow: 0 0 8px #555 inset;
	-webkit-transition: all .3s ease-out;transition: all .3s ease-out;
	}
.popup-scroll::-webkit-scrollbar-track {-webkit-box-shadow: 0 0 2px #ccc;box-shadow: 0 0 2px #ccc;}	


.status-column-hidden {
        display: none;
    }

    .status-column-hidden-visible {
        display: table-cell;
    }
</style>
<div class="right_col" role="main">
    
       
        <div class="row">
            <div class="tabs" id="exTab2">
                <ul class="nav nav-tabs message-tab">
                    <li class="">
                        <a href="<?=base_url()?>add_employee" >Add Employee</a>
                    </li>
                    <li class="active">
                        <a href="<?=base_url()?>add_employee_list" >Employee List</a>
                    </li>
                   
                    <li>
                        <a class="" href="<?=base_url()?>employee_incentive_master" >Empolyee Incentive</a>
                    </li>
                    <!--<li>-->
                    <!--    <a class="" href="<?=base_url()?>add_working_hours" >Add Working Hours</a>-->
                    <!--</li>-->


                </ul>
                <br>
            </div>

            <div class="tab-content">
                <div class="tab-panel">
                    <div class="x_panel">
                        <div class="x_content">
                            
                        <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="example" class="table table-striped responsive-utilities jambo_table" style="width: 100%;">
                                            <thead>
                                                <tr class="headings">
                                                    <th>
                                                       Sr.no
                                                    </th>
                                                    <th>Action</th>
                                                    <th>Name</th>
                                                    <th>Phone Number</th>
                                                    <th>Gender</th>
                                                    <th>Designation</th>
                                                    <th>Stylist Services</th>
                                                    <th>Shift</th>
                                                    <th>Upcoming Shift</th>
                                                    <th>Salary Method</th>
                                                    <th>Salary <small>(Per Month)</small></th>
                                                    <th>Current Pending<br>Incentive</th>
                                                    <th>DOB</th>
                                                    <th>Email </th>
                                                    <th>Profile Image</th>
                                                    <th>Identity Type</th>
                                                    <th>Identity Proof</th>
                                                    <th>Address</th>
                                                    <th>Date Of Joining</th>
                                                    <!-- <th>Bank Name</th> -->
                                                    <th>Account Holder Name</th>
                                                    <th>Account Number</th>
                                                    <th>IFSC Code</th>
                                                    <th>Description</th>
                                                    <th class="status-column-hidden">Status</th>
                                                    <!-- <th>Status</th> -->
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php if(!empty($salon_employee_list)){
                                                    $k=1;
                                                        foreach($salon_employee_list as $salon_employee_list_result){
                                                            $salary_method = $this->Salon_model->get_single_salary_method($salon_employee_list_result->salary_method);  
                                                            $designation = $this->Salon_model->get_single_designation_details($salon_employee_list_result->designation);
                                                            $shift_update_history = $this->Salon_model->get_employee_shift_update_history($salon_employee_list_result->id);
                                                            $product_incentives = $this->Salon_model->get_employee_product_incentives($salon_employee_list_result->id);
                                                            $generated_salaries = $this->Salon_model->get_employee_generated_salaries($salon_employee_list_result->id);
                                                            $upcoming_appointments = $this->Salon_model->get_salon_employee_upcoming_appointments($salon_employee_list_result->id);
                                                            $total_product_incentives = 0;
                                                            if(!empty($product_incentives)){
                                                                foreach($product_incentives as $product_incentives_result){
                                                                    $total_product_incentives += $product_incentives_result->incentive_amount;
                                                                }
                                                            }

                                                            $this->db->where('id', $salon_employee_list_result->upcoming_shift_id);
                                                            $this->db->where('shift_type', $salon_employee_list_result->upcoming_shift_type);
                                                            $this->db->where('is_deleted', '0');
                                                            $this->db->where('salon_id',$this->session->userdata('salon_id'));
                                                            $this->db->where('branch_id',$this->session->userdata('branch_id'));
                                                            $upcoming_shift = $this->db->get('tbl_shift_master')->row();

                                                            // $total_generated_salaries = 0;
                                                            // if(!empty($generated_salaries)){
                                                            //     foreach($generated_salaries as $generated_salaries_result){
                                                            //         $total_generated_salaries += $generated_salaries_result->incentive_amount;
                                                            //     }
                                                            // }
                                                 ?>
                                                <tr>
                                                    <td ><?=$k++?></td>
                                                   <td>
                                                    <?php if(empty($upcoming_appointments)){ ?>
                                                        <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$salon_employee_list_result->id?>/tbl_salon_employee"><i class="fa-solid fa-trash"></i></a>    
                                                    <?php }else{ ?>
                                                        <a title="Transfer Bookings" class="btn btn-warning" href="<?=base_url();?>transfer-bookings?stylist=<?=$salon_employee_list_result->id;?>" style="text-decoration:underline;" target="_blank"><i class="fa fa-exchange" aria-hidden="true"></i></a>
                                                    <?php } ?>
                                                        <a title="Edit" class="btn btn-success" href="<?=base_url()?>add_employee/<?=$salon_employee_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a> 
                                                        <button title="Shift Update History" type="button" onclick="showPopup(<?=$salon_employee_list_result->id;?>)" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_<?=$salon_employee_list_result->id;?>">
                                                            <i class="fas fa-history"></i>
                                                        </button>
                                                        <div class="modal fade" id="exampleModal_<?=$salon_employee_list_result->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_<?=$salon_employee_list_result->id;?>" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content" style="width: 900px;">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel_<?=$salon_employee_list_result->id;?>">Shift Update History</h5>
                                                                    <button type="button" style="margin-top: -20px;" class="close" data-dismiss="modal" aria-label="Close" onclick="closePopup(<?=$salon_employee_list_result->id;?>)">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div id="response_<?=$salon_employee_list_result->id;?>">
                                                                        <table id="table_shift_details_<?=$salon_employee_list_result->id;?>" class="table table_shift_details table-striped jambo_table" style="width:100% !important;">
                                                                            <thead>
                                                                                <th>Sr. No.</th>
                                                                                <th>Assigned Shift</th>
                                                                                <th>Prev. Shift</th>
                                                                                <th>Assigned On</th>
                                                                                <th>Assigned Type</th>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php 
                                                                                $l = 1;
                                                                                if(!empty($shift_update_history)){ 
                                                                                    foreach($shift_update_history as $shift_update_history_result){ 
                                                                                        $pre_shift_details = $this->Salon_model->get_single_shift_details($shift_update_history_result->pre_shift_id);
                                                                                        $new_shift_details = $this->Salon_model->get_single_shift_details($shift_update_history_result->assigned_shift_id);
                                                                                
                                                                                        if($shift_update_history_result->pre_shift_type == '0'){
                                                                                            $pre_shift_type = '<br>Type: Regular Shift';
                                                                                        }elseif($shift_update_history_result->pre_shift_type == '1'){
                                                                                            $pre_shift_type = '<br>Type: Rotational Shift';
                                                                                        }else{
                                                                                            $pre_shift_type = '';
                                                                                        }
                                                                                        if($shift_update_history_result->assigned_shift_type == '0'){
                                                                                            $new_shift_type = '<br>Type: Regular Shift';
                                                                                        }elseif($shift_update_history_result->assigned_shift_type == '1'){
                                                                                            $new_shift_type = '<br>Type: Rotational Shift';
                                                                                        }else{
                                                                                            $new_shift_type = '';
                                                                                        }
                                                                                ?>
                                                                                <tr>
                                                                                    <th><?=$l++;?></th>
                                                                                    <th><?php if(!empty($new_shift_details)){ echo $new_shift_details->shift_name.$new_shift_type; } ?></th>
                                                                                    <th><?= $shift_update_history_result->previous_shift_name != "" ? $shift_update_history_result->previous_shift_name.''.$pre_shift_type : (!empty($pre_shift_details) ? $pre_shift_details->shift_name.''.$pre_shift_type : '-');?></th>
                                                                                    <!-- <th><?php if(!empty($pre_shift_details)){ echo $pre_shift_details->shift_name.''.$pre_shift_type; } ?></th> -->
                                                                                    <th><?php if($shift_update_history_result->shift_applied_on != "" && $shift_update_history_result->shift_applied_on != null){ echo date('d M, y h:i A',strtotime($shift_update_history_result->shift_applied_on)); }else{ echo '-'; } ?></th>
                                                                                    <th>
                                                                                        <?php
                                                                                            if($shift_update_history_result->assign_type == '0'){
                                                                                                echo 'First Time Assigned';
                                                                                            }elseif($shift_update_history_result->assign_type == '1'){
                                                                                                echo 'Auto Updated';
                                                                                            }elseif($shift_update_history_result->assign_type == '2'){
                                                                                                echo 'Manually Updated';
                                                                                            }else{
                                                                                                echo '-';
                                                                                            }
                                                                                        ?>
                                                                                    </th>                                                                                    
                                                                                </tr>
                                                                                <?php }}else{ ?>
                                                                                <tr>
                                                                                    <th colspan="5" style="text-align:center;">Data not available</th>                                                                               
                                                                                </tr>
                                                                                <?php } ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><?=$salon_employee_list_result->full_name?></td>
                                                    <td><?=$salon_employee_list_result->whatsapp_number?></td>
                                                    <td><?=($salon_employee_list_result->gender == '0') ? 'Male' : (($salon_employee_list_result->gender == '1') ? 'Female' : 'Other'); ?></td>
                                                    <!-- <td><?=date('d-m-Y',strtotime($salon_employee_list_result->dob))?></td> -->                                                   
                                                   <td><?=$salon_employee_list_result->designation_name; ?></td>
                                                   <!-- <td><?=$salon_employee_list_result->service_names?></td> -->
                                                   <td>
                                                        <button title="Stylist Services" type="button" onclick="showServicesPopup(<?=$salon_employee_list_result->id;?>)" class="btn btn-primary" data-toggle="modal" data-target="#exampleservicesModal_<?=$salon_employee_list_result->id;?>">
                                                            View
                                                        </button>
                                                        <div class="modal fade" id="exampleservicesModal_<?=$salon_employee_list_result->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleservicesModalLabel_<?=$salon_employee_list_result->id;?>" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content" style="width: 500px;">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleservicesModalLabel_<?=$salon_employee_list_result->id;?>">Stylist Services</h5>
                                                                    <button type="button" style="margin-top: -20px;" class="close" data-dismiss="modal" aria-label="Close" onclick="closeServicesPopup(<?=$salon_employee_list_result->id;?>)">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div id="services_response_<?=$salon_employee_list_result->id;?>">
                                                                    <?php 
                                                                        $services = $salon_employee_list_result->service_names;
                                                                        $service_names_marathi = $salon_employee_list_result->service_names_marathi;
                                                                        
                                                                        if ($services != "" && $service_names_marathi != "") {
                                                                            $serviceArray = explode(',', $services);
                                                                            $serviceMarathiArray = explode(',', $service_names_marathi);

                                                                            $length = min(count($serviceArray), count($serviceMarathiArray));
                                                                        ?>
                                                                            <table style="width:100%;" class="table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Sr. No.</th>
                                                                                        <th>Service Name</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php 
                                                                                    $serialNumber = 1;
                                                                                    
                                                                                    for ($i = 0; $i < $length; $i++) {
                                                                                        echo '<tr>';
                                                                                        echo '<td>' . $serialNumber . '</td>';
                                                                                        echo '<td>' . trim($serviceArray[$i]) . ' | ' . trim($serviceMarathiArray[$i]) . '</td>';
                                                                                        echo '</tr>';
                                                                                        $serialNumber++;
                                                                                    }
                                                                                    ?>
                                                                                </tbody>
                                                                            </table>
                                                                    <?php
                                                                        } else {
                                                                            echo 'Services not available';
                                                                        }
                                                                    ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                   <td><?=$salon_employee_list_result->shift_names?></td>
                                                   <td><?=$salon_employee_list_result->shift_type == '1' && !empty($upcoming_shift) ? $upcoming_shift->shift_name : '-'?></td>
                                                   <!-- <td>Level <?=$salon_employee_list_result->salary_method?></td> -->
                                                   <td><?php
                                                   if(!empty($salary_method)){
                                                        echo  'Level ' . $salary_method->level . ' [Rs. ' . $salary_method->start_amount . ' to Rs. ' . $salary_method->end_amount . ']';  
                                                    }else{ 
                                                        echo  '-';
                                                    }
                                                         ?></td>

                                                    <td><?=$salon_employee_list_result->salary?></td>
                                                    <td><?=$salon_employee_list_result->current_pending_incentive; ?></td>
                                                    <td>
                                                        <?php                                    
                                                            if($salon_employee_list_result->dob != "" && $salon_employee_list_result->dob != NULL && $salon_employee_list_result->dob != "0000-00-00" && $salon_employee_list_result->dob != "1970-01-01"){
                                                                echo date('d-m-Y', strtotime($salon_employee_list_result->dob));
                                                            } else{
                                                                echo "-";
                                                            } 
                                                        ?>
                                                    </td> 
                                                    <td><?=$salon_employee_list_result->email?></td>
                                                    <td>
                                                        <?php
                                                         if($salon_employee_list_result->profile_photo !=''){ ?>
                                                         <a class="btn btn-info" target="_blank" href="<?= base_url(); ?>admin_assets/images/employee_profile/<?=$salon_employee_list_result->profile_photo?>">View</a>
                                                        <?php } else{
                                                            echo "-";
                                                          }
                                                        ?>
                                                   </td>
                                                   
                                                   <td>
                                                        <?php
                                                            $identity = $salon_employee_list_result->identity;
                                                            if ($identity == 1) {
                                                                echo "Pan Card";
                                                            } elseif ($identity == 2) {
                                                                echo "Aadhaar Card";
                                                            } elseif ($identity == 3) {
                                                                echo "Driving License";
                                                            } elseif ($identity == 4) {
                                                                echo "Passport";
                                                            } elseif ($identity == 5) {
                                                                echo "Voter ID";
                                                            } else {
                                                                echo "Unknown";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                         if($salon_employee_list_result->identy_proof !=''){ ?>
                                                       <a class="btn btn-info" target="_blank" href="<?= base_url(); ?>admin_assets/images/employee_aadhar/<?=$salon_employee_list_result->identy_proof?>">View</a>
                                                        <?php } else{
                                                            echo "-";
                                                          }
                                                        ?>
                                                   </td>
                                                   <td><?=$salon_employee_list_result->address?></td>
                                                    <td><?=date('d-m-Y',strtotime($salon_employee_list_result->date_of_join))?></td>
                                                    <!-- <td><?=$salon_employee_list_result->bank_name?></td> -->
                                                    <td>
                                                        <!-- <?=$salon_employee_list_result->account_holder_name?> -->
                                                    <?= !empty($salon_employee_list_result->account_holder_name) ? $salon_employee_list_result->account_holder_name : '-' ?></td>
                                                    <td>
                                                        <!-- <?=$salon_employee_list_result->account_number?> -->
                                                        <?= !empty($salon_employee_list_result->account_number) ? $salon_employee_list_result->account_number : '-' ?>
                                                    </td>
                                                    <td>
                                                        <!-- <?=$salon_employee_list_result->ifsc?> -->
                                                        <?= !empty($salon_employee_list_result->ifsc) ? $salon_employee_list_result->ifsc : '-' ?>
                                                    </td>
                                                   
                                                   <td>
                                                    <?php if($salon_employee_list_result->description != ""){ ?>
                                                        <button title="Description" type="button" onclick="showDescPopup(<?=$salon_employee_list_result->id;?>)" class="btn btn-info" data-toggle="modal" data-target="#exampledescModal_<?=$salon_employee_list_result->id;?>">
                                                            View
                                                        </button>
                                                        <div class="modal fade" id="exampledescModal_<?=$salon_employee_list_result->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampledescModalLabel_<?=$salon_employee_list_result->id;?>" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content" style="width: 500px;">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampledescModalLabel_<?=$salon_employee_list_result->id;?>">Description</h5>
                                                                    <button type="button" style="margin-top: -20px;" class="close" data-dismiss="modal" aria-label="Close" onclick="closeDescPopup(<?=$salon_employee_list_result->id;?>)">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div id="desc_response_<?=$salon_employee_list_result->id;?>">
                                                                        <?php echo $salon_employee_list_result->description != "" ? $salon_employee_list_result->description : 'Text not available'; ?>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- <a class="btn btn-info" data-popup-open="popup-1" onclick="view_description('<?php echo $salon_employee_list_result->description; ?>')">View</a> -->
                                                    <?php }else{ ?>
                                                        -
                                                    <?php } ?>
                                                    </td>
                                                   

                                                   <td class="status-column-hidden">
                                                        <?php if($salon_employee_list_result->status == "1"){?>
                                                            <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$salon_employee_list_result->id?>/tbl_salon_employee">Active</a>  
                                                        <?php }else{?> 
                                                            <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$salon_employee_list_result->id?>/tbl_salon_employee">Inactive</a> 
                                                        <?php }?>
                                                    </td>
                                                    <!-- <td>
                                                        <?php if($salon_employee_list_result->status == "1"){?>
                                                            <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$salon_employee_list_result->id?>/tbl_salon_employee"><i class="fa-solid fa-toggle-on"></i></a>  
                                                        <?php }else{?> 
                                                            <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$salon_employee_list_result->id?>/tbl_salon_employee"><i class="fa-solid fa-toggle-off"></i></a> 
                                                        <?php }?>
                                                    </td> -->
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
                </div>


        </div>

</div>
<?php include('footer.php');
$id = 0;
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>

<script>

        $('#example').DataTable({ 
        dom: 'Blfrtip',
        responsive: false,
        scrollX:300,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                
         buttons: [          
            {
                extend: 'excel',
                filename: 'employee-list',
                exportOptions: {
                    columns: [0,1,2,3,4,5,7,9,10,11,12,13,14,15,16,17,18,20] 
                }
            }
        ], 
    });
    function showServicesPopup(id){
        var exampleModal = $('#exampleservicesModal_'+id);
        exampleModal.css('display','block');
        exampleModal.css('opacity','1');
        $('.modal-open').css('overflow','auto').css('padding-right','0px'); 
    }
    function closeServicesPopup(id){
        var exampleModal = $('#exampleservicesModal_'+id);
        exampleModal.css('display','none');
        exampleModal.css('opacity','0');
        $('.modal-open').css('overflow','auto').css('padding-right','0px');
    }
    function showDescPopup(id){
        var exampleModal = $('#exampledescModal_'+id);
        exampleModal.css('display','block');
        exampleModal.css('opacity','1');
        $('.modal-open').css('overflow','auto').css('padding-right','0px'); 
    }
    function closeDescPopup(id){
        var exampleModal = $('#exampledescModal_'+id);
        exampleModal.css('display','none');
        exampleModal.css('opacity','0');
        $('.modal-open').css('overflow','auto').css('padding-right','0px');
    }
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



<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.employee-setup').addClass('active_cc');
    });
</script>






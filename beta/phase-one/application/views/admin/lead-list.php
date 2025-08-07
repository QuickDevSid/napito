<?php include('header.php');?>
<style>
    .edit-form {
	position: absolute;
	height: 305px;
	width: 300px;
	padding: 20px;
	right: 0;
	background-color: #fff;
	z-index: 5;
	display: none;
	border-radius: 5px;
	box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
}
.edit-form h4{
	text-align: center;
	padding: 5px 0px;
}
.edit-form label{
	font-size: 16px;
	font-weight: 500;
}
.edit-form button{
	width: 100%;
	height: 40px;
	margin-top: 10px;
    color: #fff;
    background-color: #0d2a48;
    border-radius: 5px
}
</style>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Lead List
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
                            <th>
                                Sr.No
                                <!-- <input type="checkbox" class="tableflat"> -->
                            </th>
                            <th>Salon Owner Name</th>
                            <th>Mobile Number</th>
                            <th>Salon Name</th>
                            <th>Assigned Executive</th>
                            <th>Remark</th>
                            <th>Status</th>
                            <th>Status Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($all_lead_list)){
                            $i = 1;
                            foreach($all_lead_list as $all_lead_list_result){
                        ?>
                        <tr>
                            <th scope="row"><?=$i++?></th>
                            <td><a href="<?=base_url()?>owner-detail/<?=$all_lead_list_result->id?>"><?=$all_lead_list_result->salon_owner_name ?></td></a>
                            <td><?=$all_lead_list_result->owner_number?></td>
                            <td><?=$all_lead_list_result->salon_name?></td>
                            <td><?=$all_lead_list_result->assigned_executive?></td>
                            <td><?=$all_lead_list_result->remark?></td>
                            <td><?=$all_lead_list_result->status_of_salon?></td>
                            <td>
                            <a  title="Edit Status"  href="#" class="btn btn-success toggle-edit-form" data-target="<?=$all_lead_list_result->id?>">
                                        <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>admin_delete/<?=$all_lead_list_result->id?>/tbl_lead_branch"><i class="fa-solid fa-trash"></i></a>
                            <div class="edit-form" style="display:none;" id="<?=$all_lead_list_result->id?>">
                                        
                                        <form action="" method='post' id="change_status_form">
                                            <div class="contaienr">
                                                <div class="row">

                                                    <div class="form-group">
                                                        <label for="status" class="form-label">Change Status:</label>
                                                        <select id="status" class="form-control "  name="status">
                                                            <option value="">Select Status</option>
                                                            <?php if(!empty($status_list)){
                                                                foreach($status_list as $status){?>
                                                                    <option value="<?=$status->status_name?>"><?=$status->status_name?></option>
                                                                
                                                            <?php } } ?>
                                                        
                                                        
                                                        </select>
                                                        <input type="hidden" value="<?=$all_lead_list_result->id?>"  id="lead_id" name="lead_id" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="remark" class="form-label">Remark:</label>
                                                        <textarea id="remark" class="form-control " name="remark"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                    <input type="checkbox" id="addreminder"  name="add-reminder">
                                                     <label for="addreminder">Want to add a reminder?</label><br>
                                                 
                                                    <input type="date" style="display: none;"  id="reminder" name="reminder" class="form-control">

                                                 
                                                    </div>
                                                    <div class="form-group">
                                                        <button class="btn btn-success" value="submit_action" name="submit_action" type="submit">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
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
            filename: 'lead-list',
            exportOptions: {
                columns: [0,1,2,3,4,5] 
            }
        },
        
        
    ], 
});
</script>
<script>
const editButtons = document.querySelectorAll('.toggle-edit-form');
const editForms = document.querySelectorAll('.edit-form');
editButtons.forEach(button => {
    button.addEventListener('click', function (event) {
        event.preventDefault();
        const targetId = button.getAttribute('data-target');
        const editForm = document.getElementById(targetId);

        // Close all edit forms except the one associated with the clicked button
        editForms.forEach(form => {
            if (form.id !== targetId) {
                form.style.display = 'none';
                
            }
        });

        // Toggle the display of the clicked edit form
        if (editForm.style.display === 'none' || editForm.style.display === '') {
            editForm.style.display = 'block';
            editForm.style.width = '300px';

        } else {
            editForm.style.display = 'none';
            
        }
    });
});
const checkboxes = document.querySelectorAll('.edit-form input[type="checkbox"]');

checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function () {
        const reminderInput = checkbox.parentElement.querySelector('.form-control[name="reminder"]');
        if (reminderInput.style.display === 'none' || reminderInput.style.display === '') {
            reminderInput.style.display = 'block';
        } else {
            reminderInput.style.display = 'none';
            reminderInput.value = '';
        }
    });
});

</script>
  
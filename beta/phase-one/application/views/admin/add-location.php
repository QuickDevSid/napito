<?php include('header.php');?>
<style type="text/css">
.input-content-option{
    height: 33px;
    width: 570px;
   
}
</style>

  <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Add Location                 
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


                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">
                                    <form method="post" name="master_form" id="master_form" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                            <label>State <b class="require">*</b></label>
                                                <select class="form-control" name="state" id="state">
                                                    <option value="" class="">Select State</option>
                                                    <?php 
                                                    $state = $this->Admin_model->get_state_list();
                                                    if (!empty($state)) {
                                                        foreach ($state as $state_result) { ?>
                                                            <option value="<?= $state_result->id ?>" <?php if(!empty($single) && $single->state_id == $state_result->id){ echo 'selected'; } ?>><?= $state_result->name ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                                <label id="state-error" class="error" for="state" style="display:none;">Please select a salon type</label>
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                <label>City <b class="require">*</b></label>
                                                <select class="form-control" name="city" id="city_name">
                                                    <option value="">Select City</option>
                                                    <?php 
                                                    if (!empty($single)) {
                                                        $cities = $this->Admin_model->get_state_city_list($single->state_id);
                                                        if (!empty($cities)) {
                                                            foreach ($cities as $state_result) { 
                                                    ?>
                                                            <option value="<?= $state_result->id ?>" <?php if(!empty($single) && $single->city_id == $state_result->id){ echo 'selected'; } ?>><?= $state_result->name ?></option>
                                                    <?php }}} ?>
                                                </select>
                                                <label id="city_name-error" class="error" for="city_name" style="display:none;">Please select a salon type</label>
                                            </div>
                                            <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                                <label>Location Name <b class="require">*</b></label>
                                                <input type="text" class="form-control" name="location" id="location" value="<?php if(!empty($single)){ echo $single->name; }?>" placeholder="Enter Location Name">

                                                <div class="error" id="facility_name_error"></div>
                                                <input type="hidden" class="form-control" name="id" id="id" value="<?php if(!empty($single)){ echo $single->id; }?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                                <button style="margin-top: 30px;" type="submit" id="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </form> 
                                </div>  
                            </div>
                        </div>
                    </div>



                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    
                                    <!-- <div class="clearfix"></div> -->
                                </div>
                                <div class="x_content">

                                    <table id="example" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Location Name</th>
                                                <th>City</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php if(!empty($location_list)){
                                        		$i=1;
                                        			foreach($location_list as $tips_list_result){
                                        	?>
                                            <tr>
                                                <td scope="row"><?=$i++?></td>
                                                <td><?=$tips_list_result->name?></td>
                                                <td><?=$tips_list_result->city_name.', '.$tips_list_result->state_name?></td>
                                                <td>
                                                	<a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>admin_delete/<?=$tips_list_result->id?>/tbl_location"><i class="fa-solid fa-trash"></i></a>	

                                                	<a title="Edit" class="btn btn-success" href="<?=base_url()?>add-location/<?=$tips_list_result->id?>"><i class="fa-solid fa-pen-to-square"></i></a>	
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
                <?php include('footer.php');
                	$id= '0';
                	if($this->uri->segment(2) != ""){
						$id = $this->uri->segment(2);
                	}
                ?>


                <script>
                    $(document).ready(function () {   
                    $("select").chosen({
                        width: "100%"
                    });  
            $('#master_form').validate({
                ignore:[],
                rules: {
                    location: {
                        required: true, 
                    },
                    city: {
                        required: true, 
                    },
                    state: {
                        required: true, 
                    },
                },
                messages: {
                    location: {
                        required: "Please enter location name!", 
                    },
                    city: {
                        required: "Please select city!", 
                    },
                    state: {
                        required: "Please select state!", 
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
$("#location").keyup(function(){  
	$.ajax({
		type: "POST",
		url: "<?=base_url();?>admin/Ajax_controller/get_unique_location_name",
		data:{'location':$("#location").val(),'id':'<?=$id?>'},
		success: function(data){console.log(data);
			if(data == "0"){
				$("#facility_name_error").html('');
				$("#submit").show();
			}else{
				$("#facility_name_error").html('This location is already added');
				$("#submit").hide();
			}
			 
		},
		 error: function(jqXHR, textStatus, errorThrown) {
		   console.log(textStatus, errorThrown);
		}
		});	
	});	 
        $("#state").change(function() {
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>admin/Ajax_controller/get_city_ajax",
                data: {
                    'state': $("#state").val()
                },
                success: function(data) {
                    $("#city_name").empty();
                    $('#city_name').append('<option value="">Select City</option>');
                    var opts = $.parseJSON(data);
                    $.each(opts, function(i, d) {
                        $('#city_name').append('<option value="' + d.id + '">' + d.name + '</option>');
                    });
                    $('#city_name').trigger('chosen:updated');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
                </script>


<script>
$('#example').DataTable({ 
 dom: 'Blfrtip',
responsive: false,
lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
 
    buttons: [
        {
            extend: 'excel',
            filename: 'Locations List',
            exportOptions: {
                columns: [0,1,2] 
            }
        },
        
        
    ], 
});
</script>





<?php include('header.php'); ?>
<style type="text/css">
.list_radio{
    display: flex;
    gap: 15px;
    align-items: center;
}
.WrapRow{
    display:flex;
    gap:15px;
    flex-wrap: wrap;
    width: 95%;
    margin: 0 auto;
}
.add_enquiry_form .form-control{
    margin: 0px !important;
}
.add_enquiry_form{
    text-align: left !important;
}
.add_reminder_form .form-control{
    margin: 0px !important;
}
.add_reminder_form{
    text-align: left !important;
}
</style>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left" style="width:100%;">
                <h3 style="width:100%;">
                    Reminders
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-5 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <form id="add_reminder_form" class="add_reminder_form" name="add_reminder_form" method="post" action="<?=base_url();?>add-reminder" enctype="multipart/form-data" data-parsley-validate>                                
                                <div class="row">                  
                                    <div class="col-xs-12 form-group">
                                        <label for="fullname">Description</label>
                                        <textarea class="form-control" placeholder="Enter Description" name="description" id="description"></textarea>
                                    </div>   
                                    <div class="col-xs-6 form-group">
                                        <label for="fullname">Reminder Date</label>
                                        <input type="text" class="form-control custom_date" placeholder="Select Reminder Date" name="reminder_date" id="reminder_date" value="">
                                    </div>                                                                                 
                                </div> 
                                <input type="hidden" name="redirect_to" id="redirect_to" value="1">                                                                                
                                <div class="row">
                                    <div class="col-md-2  col-sm-3 col-xs-12">
                                        <button type="submit" id="submit_reminder_button" class="btn btn-success" style="margin-top:25px;">Submit</button>
                                    </div>	
                                </div>	
                                <div class="clearfix"></div>
                            </form>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <table id="example" class="content_table table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;">Sr. No.</th>
                                        <th style="text-align:center;">Date</th>
                                        <th style="text-align:center;">Description</th>
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
                                        <td><?=date('d-m-Y',strtotime($data->reminder_date));?></td>
                                        <td><?=$data->description;?></td>
                                    </tr>
                                    <?php }}else{ ?>
                                        <tr>
                                            <td colspan="3" style="text-align:center;">No Data Available</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="loader_div">
    <div  class="loader-new"></div>
</div>
<?php include('footer.php');?>
<script>		
    $(document).ready(function() {
        $(".chosen-option").chosen();
        $(".custom_date").datepicker({
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true,
            maxDate: "60",
            minDate: 0,
            yearRange: "-100:+0",
        });
        $('.timepicker').clockpicker({
            donetext: 'Done', 
            twelvehour: false
        });
        $("#add_reminder_form").validate({
            ignore: [],
            rules: {
                description: "required",
                reminder_date: "required",
            },
            messages: {
                description: "Please enter description!",
                reminder_date: "Please select reminder date!",
            },
            submitHandler: function(form) {
                if (confirm("Do you want to submit the form?")) {
                    form.submit();
                }
            }
        });
    }); 
$('#example').DataTable({ 
dom: 'Blfrtip',
responsive: false,
scrollX:300,
lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
 
    buttons: [
        
       
        {
            extend: 'excel',
            filename: 'salon-salary-list',
            exportOptions: {
                columns: [0,1,2] 
            }
        },
       
        
        
    ], 
});
</script>
<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.reminder-setup').addClass('active_cc');
    });
</script>
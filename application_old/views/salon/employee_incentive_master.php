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
/* .popup-scroll::-webkit-scrollbar {background-color:#EEE;width:10px;}
.popup-scroll::-webkit-scrollbar-thumb {
	border:1px #EEE solid;border-radius:2px;background:#777;
	-webkit-box-shadow: 0 0 8px #555 inset;box-shadow: 0 0 8px #555 inset;
	-webkit-transition: all .3s ease-out;transition: all .3s ease-out;
	}
.popup-scroll::-webkit-scrollbar-track {-webkit-box-shadow: 0 0 2px #ccc;box-shadow: 0 0 2px #ccc;}	 */



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
                        <a href="<?=base_url()?>add_employee<?php if(isset($_GET['redirect'])){ echo '?redirect=' . $_GET['redirect']; }?>" >Add Employee</a>
                    </li>
                    <li class="">
                        <a href="<?=base_url()?>add_employee_list<?php if(isset($_GET['redirect'])){ echo '?redirect=' . $_GET['redirect']; }?>" >Employee List</a>
                    </li>
                   
                    <li class="active">
                        <a class="" href="<?=base_url()?>employee_incentive_master<?php if(isset($_GET['redirect'])){ echo '?redirect=' . $_GET['redirect']; }?>" >Empolyee Target Setup</a>
                    </li>


                </ul>
                <br>
            </div>

            <div class="tab-content">
                <div class="tab-panel">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <div class="row">
                                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                   <form  method="post" name="incentive_form" id="incentive_form" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Select Level <b class="require">*</b></label>
                                                <select class="form-select form-control" name="level" id="level">
                                                    <option value="" class="">Select Level</option>
                                                    <option <?=(!empty($single) && $single->level == '1') ? 'selected' : ''; ?> value="1" class="">Level 1</option>
                                                    <option <?=(!empty($single) && $single->level == '2') ? 'selected' : ''; ?> value="2" class="">Level 2</option>
                                                    <option  <?=(!empty($single) && $single->level == '3') ? 'selected' : ''; ?> value="3" class="">Level 3</option>
                                                    <option <?=(!empty($single) && $single->level == '4') ? 'selected' : ''; ?> value="4" class="">Level 4</option>
                                                    <option <?=(!empty($single) && $single->level == '5') ? 'selected' : ''; ?> value="5" class="">Level 5</option>
                                                    
                                                </select>
                                                <label style="display:none;" for="level" generated="true" class="error">Please select percentage/flat</label>
                                                <input type="hidden" name="id" id="id" value="<?php if(!empty($single)){ echo $single->id;} ?>">
                                            </div>
                                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Start Amount<b class="require">*</b></label>
                                                <input autocomplete="off"  class="form-control" type="text" name="start_amount" id="start_amount" value="<?php if (!empty($single)) {echo $single->start_amount; } ?>" placeholder="Enter Start Amount">
                                            </div>
                                            
                                        <!-- </div>
                                        <div class="row">    -->
                                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>End Amount<b class="require">*</b></label>
                                                <input autocomplete="off"  class="form-control" type="text" name="end_amount" id="end_amount" value="<?php if (!empty($single)) {echo $single->end_amount; } ?>" placeholder="Enter End Amount">
                                            </div>
                                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Percentage/Flat <b class="require">*</b></label>
                                                <select class="form-select form-control" name="per_or_flat" id="per_or_flat">
                                                    <option value="" class="">Select Percentage/Flat</option>
                                                    <option <?=(!empty($single) && $single->per_or_flat == '0') ? 'selected' : ''; ?> value="0" class="">Percentage</option>
                                                    <option <?=(!empty($single) && $single->per_or_flat == '1') ? 'selected' : ''; ?> value="1" class="">Flat</option>
                                                </select>
                                                <label style="display:none;" for="per_or_flat" generated="true" class="error">Please select percentage/flat</label>
                                            </div>
                                                
                                        <!-- </div>
                                            <div class="row">  -->
                                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <label>Incentive <b class="require">*</b></label>
                                                        <input autocomplete="off"  class="form-control" type="text" name="incentive" id="incentive" value="<?php if (!empty($single)) {echo $single->incentive; } ?>" placeholder="Enter Incentive ">
                                                    </div> 
                                            </div>
                                        <div class="row">
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                              <button class=" btn btn-primary" type="submit">Submit</button>
                                            </div>
                                        </div>
                                        <hr>
                                     </form>
                                   </div> 
                                 
                                </div>
                            </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12 " style="margin-top:10px;">
                                            <table id="example" class="table table-striped responsive-utilities jambo_table" style="width: 100%;">
                                                <thead>
                                                    <tr class="headings">
                                                        <th>
                                                        Sr. No.
                                                        </th>
                                                        <th>Level</th>
                                                        <th>Start Amount</th>
                                                        <th>End Amount </th>
                                                        <th>Incentive</th>
                                                        <!-- <th class="status-column-hidden">Status</th>
                                                        <th>Status</th> -->
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php if(!empty($incetive_list)){
                                                        $i=1;
                                                        foreach($incetive_list as $list){
                                                    ?>
                                                    <tr>
                                                        <td scope="row"><?=$i++?></td>
                                                        <td>Level <?=$list->level?></td>
                                                        <td><?=number_format($list->start_amount,2)?></td>
                                                        <td><?=number_format($list->end_amount,2)?></td>
                                                        <td>
                                                            <?php if($list->per_or_flat == '0'){
                                                                echo $list->incentive.'%';
                                                            }elseif($list->per_or_flat == '1'){ 
                                                                echo 'Flat Rs. '.$list->incentive;
                                                            }else{
                                                                echo '-';
                                                            } ?>
                                                        </td>


                                                        <!-- <td class="status-column-hidden">
                                                            <?php if($list->status == "1"){?>
                                                                <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$list->id?>/tbl_salon_employee_incentive">Active</a>  
                                                            <?php }else{?> 
                                                                <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$list->id?>/tbl_salon_employee_incentive">Inactive</a> 
                                                            <?php }?>
                                                        </td>

                                                        <td>
                                                            <?php if($list->status == "1"){?>
                                                                <a title="Active"  onclick="return confirm('Are you sure to inactivate this record?');" class="btn btn-light" href="<?=base_url()?>inactive/<?=$list->id?>/tbl_salon_employee_incentive"><i class="fa-solid fa-toggle-on"></i></a>  
                                                            <?php }else{?> 
                                                                <a title="Inctive"  class="btn btn-light" onclick="return confirm('Are you sure to activate this record?');" href="<?=base_url()?>active/<?=$list->id?>/tbl_salon_employee_incentive"><i class="fa-solid fa-toggle-off"></i></a> 
                                                            <?php }?>
                                                        </td> -->


                                                        <td>
                                                            <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>delete/<?=$list->id?>/tbl_salon_employee_incentive"><i class="fa-solid fa-trash"></i></a>    
                                                            <!-- <a title="Edit" class="btn btn-success" href="<?=base_url()?>employee_incentive_master/<?=$list->id?>"><i class="fa-solid fa-pen-to-square"></i></a> -->
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
    $(document).ready(function() {
        $('#incentive_form').validate({
            ignore:[],
            rules: {
                level: {
                    required: true
                },
                per_or_flat: {
                    required: true
                },
                start_amount: {
                    required: true,
                    number: true
                },
                end_amount: {
                    required: true,
                    number: true
                },
                incentive: {
                    required: true,
                    number: true
                }
            },
            messages: {
                level: {
                    required: "Please select a level"
                },
                per_or_flat: {
                    required: "Please select percentage/flat"
                },
                start_amount: {
                    required: "Please enter the start amount",
                    number: "Please enter a valid number for the start amount"
                },
                end_amount: {
                    required: "Please enter the end amount",
                    number: "Please enter a valid number for the end amount"
                },
                incentive: {
                    required: "Please enter incentive",
                    number: "Please enter a valid number for the incentive",
                }
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".chosen-select").chosen({

        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.employee-setup').addClass('active_cc');
    });
</script>
<script>

        $('#example').DataTable({ 
        dom: 'Blfrtip',
        responsive: true,
        // scrollX:300,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                
         buttons: [
                        
            {
                extend: 'excel',
                filename: 'Incentive Master',
                exportOptions: {
                    columns: [0,1,2,3,4] 
                }
            }
        ], 
    });
    $('#level').change(function() {            
        $.ajax({
            type: "POST",
            url: "<?=base_url();?>salon/Ajax_controller/get_level_incentive_setup",
            data:{'level':$("#level").val()},
            success: function(data){
                var opts = $.parseJSON(data);
                console.log(opts);
                if (opts && Object.keys(opts).length > 0) { 
                    $('#start_amount').val(opts.start_amount);
                    $('#end_amount').val(opts.end_amount);
                    $('#per_or_flat').val(opts.per_or_flat).trigger('chosen:updated');
                    $('#incentive').val(opts.incentive);
                    $('#id').val(opts.id);
                }else{
                    $('#start_amount').val('');
                    $('#end_amount').val('');
                    $('#per_or_flat').val('').trigger('chosen:updated');
                    $('#incentive').val('');
                    $('#id').val('');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
</script>
$slots_morning = [];
$slots_afternoon = [];
$slots_evening = [];

for($i=0;$i<count($slots);$i++){
    $slot_time = date('H:i:s', strtotime($slots[$i]['from']));
    if ($slot_time >= '05:00:00' && $slot_time < '13:00:00') {
        $slots_morning[] = $slots[$i];
    } elseif ($slot_time >= '13:00:00' && $slot_time < '18:00:00') {
        $slots_afternoon[] = $slots[$i];
    } else {
        $slots_evening[] = $slots[$i];
    }
}
if($booking_start != ""){
    if ($booking_start >= '05:00:00' && $booking_start < '13:00:00') {
        $is_morning_active = 'active';
        $is_afternoon_active = '';
        $is_evening_active = '';
        $morning_content = 'display: block;';
        $afternoon_content = 'display: none;';
        $evening_content = 'display: none;';
    }elseif ($booking_start >= '13:00:00' && $booking_start < '18:00:00') {
        $is_morning_active = '';
        $is_afternoon_active = 'active';
        $is_evening_active = '';
        $morning_content = 'display: none;';
        $afternoon_content = 'display: block;';
        $evening_content = 'display: none;';
    } else {
        $is_morning_active = '';
        $is_afternoon_active = '';
        $is_evening_active = 'active';
        $morning_content = 'display: none;';
        $afternoon_content = 'display: none;';
        $evening_content = 'display: block;';
    }
}else{
    $is_morning_active = 'active';
    $is_afternoon_active = '';
    $is_evening_active = '';
    $morning_content = 'display: block;';
    $afternoon_content = 'display: none;';
    $evening_content = 'display: none;';
}





        <div class="tab">
            <button type="button" class="slot-tablinks <?=$is_morning_active;?>" onclick="openSlot(event, 'Morning')">Morning</button>
            <button type="button" class="slot-tablinks <?=$is_afternoon_active;?>" onclick="openSlot(event, 'Afternoon')">Afternoon</button>
            <button type="button" class="slot-tablinks <?=$is_evening_active;?>" onclick="openSlot(event, 'Evening')">Evening</button>
        </div>
        <div id="Morning" class="slot-tabcontent" style="<?=$morning_content;?>">
            <div class="row timeslot_row" style="margin: 0px !important; height: 100px !important; max-height: 250px; overflow: hidden; overflow-y: auto;">
                <?php
                if(!empty($slots_morning)){
                    foreach ($slots_morning as $slot) {
                        $allowed_booking_datetime = date('Y-m-d H:i:s', strtotime($slot['from'] . ' - ' . $minutes_early_booking . ' minutes'));
                        $current_date = date('Y-m-d H:i:s');
                        if ($current_date <= $allowed_booking_datetime) {
                            $selected_start = $this->input->post('selected_start') != "" ? date('Y-m-d H:i:s', strtotime($this->input->post('selected_start'))) : date('Y-m-d H:i:s', strtotime($slot['from']));
                            if (date('Y-m-d H:i:s', strtotime($slot['from'])) >= $selected_start) {
                                $is_vacent = $this->check_slot_vacent_for_selected_services($slot['from'], $user_selected_service);
                                $style = $is_vacent ? "#00800045" : "#ff000061";
                    ?>
                                <div class="single_timeslot" style="background-color:<?=$style;?>;display: inline-block !important;padding: 2px 2px !important; width: 13% !important;margin: 5px 0px !important;">
                                    <input type="radio" <?php if($booking_start != '' && $booking_start == date('H:i:s',strtotime($slots[$i]['from']))){ echo 'checked'; }?> class="booking_start_time_slot" name="booking_start_time_slot_<?=$booking_details_id;?>" id="booking_start_time_slot_<?=$booking_details_id;?>" value="<?=date('h:i A',strtotime($slots[$i]['from']));?>" onchange="setBookingStartEdit('',<?=$booking_details_id;?>)">
                                    <label style=" font-size: 11px;"><?=date('h:i A',strtotime($slots[$i]['from']));?></label>
                                </div>
                    <?php
                            }
                        }
                    }
                }else{
                ?>
                <div>
                    <label style="margin:0 auto;"> Slots not available </label>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div id="Afternoon" class="slot-tabcontent" style="<?=$afternoon_content;?>">
            <div class="row timeslot_row" style="margin: 0px !important; height: 100px !important; max-height: 250px; overflow: hidden; overflow-y: auto;">
                <?php
                if(!empty($slots_afternoon)){
                    foreach ($slots_afternoon as $slot) {
                        $allowed_booking_datetime = date('Y-m-d H:i:s', strtotime($slot['from'] . ' - ' . $minutes_early_booking . ' minutes'));
                        $current_date = date('Y-m-d H:i:s');
                        if ($current_date <= $allowed_booking_datetime) {
                            $selected_start = $this->input->post('selected_start') != "" ? date('Y-m-d H:i:s', strtotime($this->input->post('selected_start'))) : date('Y-m-d H:i:s', strtotime($slot['from']));
                            if (date('Y-m-d H:i:s', strtotime($slot['from'])) >= $selected_start) {
                                $is_vacent = $this->check_slot_vacent_for_selected_services($slot['from'], $user_selected_service);
                                $style = $is_vacent ? "#00800045" : "#ff000061";
                    ?>
                                <div class="single_timeslot" style="background-color:<?=$style;?>;display: inline-block !important;padding: 2px 2px !important; width: 13% !important;margin: 5px 0px !important;">
                                    <input type="radio" <?php if($booking_start != '' && $booking_start == date('H:i:s',strtotime($slots[$i]['from']))){ echo 'checked'; }?> class="booking_start_time_slot" name="booking_start_time_slot_<?=$booking_details_id;?>" id="booking_start_time_slot_<?=$booking_details_id;?>" value="<?=date('h:i A',strtotime($slots[$i]['from']));?>" onchange="setBookingStartEdit('',<?=$booking_details_id;?>)">
                                    <label style=" font-size: 11px;"><?=date('h:i A',strtotime($slots[$i]['from']));?></label>
                                </div>
                                <?php
                            }
                        }
                    }
                }else{
                ?>
                <div class="single_timeslot" style="text-align:center;">
                    <label> Slots not available </label>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div id="Evening" class="slot-tabcontent" style="<?=$evening_content;?>">
            <div class="row timeslot_row" style="margin: 0px !important; height: 100px !important; max-height: 250px; overflow: hidden; overflow-y: auto;">
                <?php
                if(!empty($slots_evening)){
                    foreach ($slots_evening as $slot) {
                        $allowed_booking_datetime = date('Y-m-d H:i:s', strtotime($slot['from'] . ' - ' . $minutes_early_booking . ' minutes'));
                        $current_date = date('Y-m-d H:i:s');
                        if ($current_date <= $allowed_booking_datetime) {
                            $selected_start = $this->input->post('selected_start') != "" ? date('Y-m-d H:i:s', strtotime($this->input->post('selected_start'))) : date('Y-m-d H:i:s', strtotime($slot['from']));
                            if (date('Y-m-d H:i:s', strtotime($slot['from'])) >= $selected_start) {
                                $is_vacent = $this->check_slot_vacent_for_selected_services($slot['from'], $user_selected_service);
                                $style = $is_vacent ? "#00800045" : "#ff000061";
                    ?>
                                <div class="single_timeslot" style="background-color:<?=$style;?>;display: inline-block !important;padding: 2px 2px !important; width: 13% !important;margin: 5px 0px !important;">
                                    <input type="radio" <?php if($booking_start != '' && $booking_start == date('H:i:s',strtotime($slots[$i]['from']))){ echo 'checked'; }?> class="booking_start_time_slot" name="booking_start_time_slot_<?=$booking_details_id;?>" id="booking_start_time_slot_<?=$booking_details_id;?>" value="<?=date('h:i A',strtotime($slots[$i]['from']));?>" onchange="setBookingStartEdit('',<?=$booking_details_id;?>)">
                                    <label style=" font-size: 11px;"><?=date('h:i A',strtotime($slots[$i]['from']));?></label>
                                </div>
                                <?php
                            }
                        }
                    }
                }else{
                ?>
                <div class="single_timeslot" style="text-align:center;">
                    <label> Slots not available </label>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        <script>
            $('#booking_timeslots').css('border','1px solid #ccc').css('border-radius','5px;');
            function openSlot(evt, slotPeriod) {
                var i, tabcontent, tablinks;

                // Hide all tab contents
                tabcontent = document.getElementsByClassName("slot-tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }

                // Remove the active class from all tabs
                tablinks = document.getElementsByClassName("slot-tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }

                // Show the current tab and add an "active" class to the button that opened the tab
                document.getElementById(slotPeriod).style.display = "block";
                evt.currentTarget.className += " active";
            }    
        </script>
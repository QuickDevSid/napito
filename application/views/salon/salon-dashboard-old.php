  <!-- <?php if (!empty($single_rules)) { ?>
	<?php
                        $startTime = date('H', strtotime($single_rules->salon_start_time));
                        $endTime = date('H', strtotime($single_rules->salon_end_time));
                        $duration = $single_rules->session_avg_duration;
                        for ($hour = $startTime; $hour <= $endTime; $hour++) {
                            for ($minute = 0; $minute < 60; $minute += $duration) {

                                $time = sprintf('%02d:%02d', $hour, $minute);
                                echo '<div class="current_week_time_detail"><div class="">' . $time . '</div></div>';
                                $currentDate = new DateTime();
                                $currentDayIndex = ($currentDate->format('w') + 1) % 7 ?: 7;
                                for ($week_day = 1; $week_day <= 7; $week_day++) {
                                    if ($currentDayIndex == $week_day) {
                                        $count = 0;
                                        if (!empty($booking_list)) {
                                            foreach ($booking_list as $booking_list_result) {
                                                if ($booking_list_result->time_slot == $time){
                                                    $count++;
                                                }
                                            }
                                        }
                                        if ($count == 0) {
                                            echo '  <div class="current_week_time_detail" style="background-color: #fffadf;">
                                                                <div class="">---------</div>
                                                            </div>';
                                        } else {
                                            echo '  <div class="current_week_time_detail" style="background-color: #fffadf;">
                                                <div class="">' . $count . ' Booking</div>
                                            </div>';
                                        }
                                    } else {
                                        echo '  <div class="current_week_time_detail">
                                                        <div class="">---------</div>
                                                    </div>';
                                    }
                                }
                            }
                        }
                        ?>
                <?php } ?>  -->
function renderCalendar(calendarEl, stylistData) {
    var storeOpenTime = '00:00';
    var storeCloseTime = '00:00';
    var shift_break_from = '00:00';
    var shift_break_to = '00:00';
    var slotDuration = slotDurationMain;

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridDay',
        datesSet: function(arg) {
            var self = this;
            var selectedDate = arg.start;
            $.ajax({
                url: BASE_URL + "salon/Ajax_controller/get_stylistwise_shift_ajx",
                method: 'POST',
                data: {
                    exe: stylistData.single.id,
                    dashboard_calendar:'1',
                    date: selectedDate.toLocaleDateString()
                },
                success: function(response) {
                    var shiftData = JSON.parse(response);
                    if (shiftData && shiftData.shift_from && shiftData.shift_to) {
                        var storeOpenTime = shiftData.shift_from;
                        var storeCloseTime = shiftData.shift_to;

                        var shift_break_from = shiftData.shift_break_from;
                        var shift_break_to = shiftData.shift_break_to;

                        self.setOption('slotMinTime', storeOpenTime);
                        self.setOption('slotMaxTime', storeCloseTime);
                    } else {
                        var storeOpenTime = '00:00';
                        var storeCloseTime = '00:00';

                        var shift_break_from = '00:00';
                        var shift_break_to = '00:00';

                        self.setOption('slotMinTime', storeOpenTime);
                        self.setOption('slotMaxTime', storeCloseTime);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching stylist schedule:', error);
                    alert("Error fetching stylist schedule");
                }
            });
        },
        select: function(arg) {
            var self = this;
            // Check if the current view is 'timeGridDay'
            if (self.view.type === 'timeGridWeek') {
                // Perform action only when in the day view

                var selectedDate = arg.start;
                var maxDate = new Date(max_date_str);
                var allowed_early_mins = minutes_early_booking_str;

                if (selectedDate.toLocaleDateString() <= maxDate.toLocaleDateString()) {
                    var currentDate = new Date();
                    if (selectedDate >= currentDate) {
                        var currentTimeMillis = currentDate.getTime();
                        var allowedTimeMillis = allowed_early_mins * 60000;
                        var allowedTime = currentTimeMillis + allowedTimeMillis;

                        var allowedDateTime = new Date(allowedTime);
                        if (selectedDate >= allowedDateTime) {
                            var date = arg.start.toLocaleDateString();
                            var time = arg.start.toLocaleTimeString();
                            var dateTimeString = date + ' ' + time;
                            var url = BASE_URL + 'add-new-booking-new?start=' + dateTimeString + '&stylist=' + stylistData.single.id + '&customer=';
                            // if (confirm("Are you sure you want to proceed?")) {
                            openConfirmationDialog("Are you sure you want to proceed?", function(confirmed) {
                                if (confirmed) {
                                    // If user confirms, open the link in a new tab
                                    window.open(url, '_blank');
                                }
                            });
                        } else {
                            var options = {
                                year: 'numeric',
                                month: 'numeric',
                                day: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit',
                                second: '2-digit',
                                hour12: true
                            };
                            var allowedDateTimeString = allowedDateTime.toLocaleString(undefined, options);
                            // alert("Booking allowed from " + allowedDateTimeString);
                            openDialog("Booking allowed from " + allowedDateTimeString);
                        }
                    } else {
                        // alert("Booking for past is not allowed.");
                        openDialog('Booking for past is not allowed.');
                    }
                } else {
                    // alert("As per Booking Rules, booking for this slot is not allowed.");
                    openDialog('As per Booking Rules, booking for this slot is not allowed.');
                }
            }
        },
        eventClick: function(arg) {
            // console.log('Clicked time slot:', arg.event.start, arg.event.end, arg.event.id);
            if (arg.event.extendedProps.booking_service_status == "2") {
                var selectedDate = arg.event.start;
                var maxDate = new Date(max_date_str);
                var allowed_early_mins = minutes_early_booking_str;
                if (selectedDate.toLocaleDateString() <= maxDate.toLocaleDateString()) {
                    var currentDate = new Date();
                    if (selectedDate >= currentDate) {
                        var currentTimeMillis = currentDate.getTime();
                        var allowedTimeMillis = allowed_early_mins * 60000;
                        var allowedTime = currentTimeMillis + allowedTimeMillis;

                        var allowedDateTime = new Date(allowedTime);
                        var date = arg.event.start.toLocaleDateString();
                        var time = arg.event.start.toLocaleTimeString();
                        var dateTimeString = date + ' ' + time;
                        var url = BASE_URL + 'add-new-booking-new?start=' + dateTimeString + '&stylist=' + stylistData.single.id + '&customer=';
                        // if (confirm("Are you sure you want to book for this timeslot?")) {
                        openConfirmationDialog("Are you sure you want to book for this timeslot?", function(confirmed) {
                            if (confirmed) {
                                window.open(url, '_blank');
                            }
                        });
                    }
                }
            } else {
                showBookingDetailsDiv(arg.event.extendedProps.booking_id);
            }
        },
        dateClick: function(arg) {
            calendar.changeView('timeGridDay', arg.date);
        },
        views: {
            dayGridMonth: {
                buttonText: 'Month'
            },
            timeGridWeek: {
                buttonText: 'Week'
            },
            timeGridDay: {
                buttonText: 'Day'
            }
        },
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: stylistData.bookings.map(function(booking) {
            var color = '';
            switch (booking.booking_status) {
                case '1':
                    color = '#FFD580';
                    break;
                case '5':
                    color = '#90EE90';
                    break;
                case '2':
                    color = '#FFB6C1';
                    break;
                default:
                    color = '#ADD8E6';
            }
            return {
                booking_id: booking.id,
                booking_no: booking.booking_no,
                customer_id: booking.customer_id,
                customer_name: booking.customer_full_name,
                customer_mobile: booking.customer_phone,
                booking_payment_status: booking.payment_status,
                booking_status: booking.booking_status,
                booking_service_payment_id: booking.booking_payment_id,
                review_id: booking.review_id,

                is_rescheduling_allowed: booking.is_rescheduling_allowed,
                is_cancel_allowed: booking.is_cancel_allowed,

                final_payable_price: booking.final_payable_price,
                final_discount_amount: booking.final_discount_amount,
                final_gst_amount: booking.final_gst_amount,
                final_final_price: booking.final_final_price,

                title: booking.customer_full_name,
                description: booking.booking_description,
                start: formatDate(booking.service_start_date, booking.service_start_time),
                end: formatDate(booking.service_end_date, booking.service_end_time),
                color: color,
            };
        }),
        eventContent: function(arg) {
            var viewType = arg.view.type;
            var dotHtml = '<div class="dot" style="background-color:' + arg.event.backgroundColor + ';"></div>';
            var timeHtml = '';
            var descHtml = '';
            var customerHtml = '';

            // Check if it's not the month view
            if (viewType !== 'dayGridMonth') {
                customerHtml = '<p class="time" style="font-size:13px;color:#000;"><b>' + arg.event.extendedProps.customer_name + ', ' + arg.event.extendedProps.customer_mobile + '</b></p>';
                timeHtml = '<p class="time" style="color:#000;"><b>' + arg.timeText + '</b></p>';
                descHtml = '<p class="time" style="color:#000;">' + arg.event.extendedProps.description + '</p>';
            }

            var buttonHtml = '';
            // Check if it's the week or day view
            if (viewType === 'timeGridWeek' || viewType === 'timeGridDay') {
                if (arg.event.extendedProps.booking_payment_status === '0' && (arg.event.extendedProps.booking_status === '1' || arg.event.extendedProps.booking_status === '3' || arg.event.extendedProps.booking_status === '4')) {
                    var eventStartTime = new Date(arg.event.start);
                    var currentTime = new Date();
                    // if (eventStartTime > currentTime) {
                    buttonHtml += '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Add New Service" id="addServiceButton_' + arg.event.extendedProps.booking_id + '" onclick="showAddServicePopupCalender(event, ' + arg.event.extendedProps.booking_id + ')" data-toggle="modal" data-target="#addServiceModal" class="btn btn-primary event-action-button"><i style="font-size: 17px;color: black;" class="fa fa-plus"></i></button>';
                    // }
                }
                if (arg.event.extendedProps.booking_status === '5') {
                    if (arg.event.extendedProps.booking_payment_status === '0') {
                        // buttonHtml += '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Generate Bill" type="button" id="bill_generate_button_' + arg.event.extendedProps.booking_id + '" onclick="showBillGenerationPopupCalendar(event, ' + arg.event.extendedProps.booking_id + ')" data-toggle="modal" data-target="#BookingBillModal" class="btn btn-primary event-action-button"><i style="font-size: 15px;color: black;" class="fas fa-file-invoice"></i></button>';

                        var encodedId = btoa(arg.event.extendedProps.booking_id);
                        var bill_url = BASE_URL + 'bill-setup/' + encodedId;
                        buttonHtml += '<a style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Generate Bill" type="button" id="bill_generate_button_' + arg.event.extendedProps.booking_id + '" href=" ' + bill_url + ' " class="btn btn-primary event-action-button"><i style="font-size: 15px;color: black;" class="fas fa-file-invoice"></i></button>';
                    } else {
                        buttonHtml += '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Receipt" id="receiptButton_' + arg.event.extendedProps.booking_id + '" onclick="openReceiptLink(event, \'' + btoa(arg.event.extendedProps.booking_id) + '\', \'' + btoa(arg.event.extendedProps.booking_service_payment_id) + '\')" class="btn btn-primary event-action-button"><i style="font-size: 15px;color: black;" class="fas fa-receipt"></i></button>';
                        buttonHtml += '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Update Payment Details" type="button" id="updateBill_' + arg.event.extendedProps.booking_id + '" class="btn btn-primary event-action-button" onclick="showBillUpdatePopupCalender(event, ' + arg.event.extendedProps.booking_id + ')" data-toggle="modal" data-target="#updateBillModal"><i style="color:black;font-size: 15px;margin-left: 4px;" class="fas fa-edit"></i></button>';
                    }
                }
            }

            var editButtonHtml = '';
            if (arg.event.extendedProps.booking_payment_status === '0' && (arg.event.extendedProps.booking_status === '1' || arg.event.extendedProps.booking_status === '3' || arg.event.extendedProps.booking_status === '4')) {
                var eventStartTime = new Date(arg.event.start);
                var currentTime = new Date();
                // if (eventStartTime > currentTime) {
                var editButtonHtml = '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Edit Booking" type="button" id="edit_button_' + arg.event.extendedProps.booking_id + '" onclick="showBookingEditPopupFromEvent(event, ' + arg.event.extendedProps.booking_id + ')" data-toggle="modal" data-target="#BookingEditModal" class="btn btn-primary event-action-button"><i style="font-size: 15px;color: black;" class="fas fa-pencil"></i></button>';
                // }
            }

            var cancelButtonHtml = '';
            if (arg.event.extendedProps.booking_payment_status === '0' && arg.event.extendedProps.is_cancel_allowed == '1' && (arg.event.extendedProps.booking_status === '1' || arg.event.extendedProps.booking_status === '3' || arg.event.extendedProps.booking_status === '4')) {
                var cancelButtonHtml = '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Cancel Service" type="button" id="cancel_button_' + arg.event.extendedProps.booking_id + '" onclick="showCancelPopupCalender(event, ' + arg.event.extendedProps.booking_id + ')" data-toggle="modal" data-target="#exampleModalCancel" class="btn btn-primary event-action-button"><i style="color:red;font-size: 20px;" class="fas fa-times"></i></button>';
            }

            var completeButtonHtml = '';
            if (arg.event.extendedProps.booking_payment_status === '0' && (arg.event.extendedProps.booking_status === '1' || arg.event.extendedProps.booking_status === '3' || arg.event.extendedProps.booking_status === '4')) {
                var completeButtonHtml = '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Complete Booking" type="button" id="complete_button_' + arg.event.extendedProps.booking_id + '" onclick="showCompletePopupCalender(event, ' + arg.event.extendedProps.booking_id + ')" data-toggle="modal" data-target="#ServiceCompleteModal" class="btn btn-primary event-action-button"><i style="color:green;font-size: 20px;" class="fas fa-check"></i></button>';
            }

            var callButtonHtml = '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Call Customer" type="button" id="call_button_' + arg.event.extendedProps.booking_id + '" class="btn btn-primary event-action-button" onclick="window.location.href=\'tel:' + arg.event.extendedProps.customer_mobile + '\'"><i style="color:red;font-size: 15px;margin-left: 4px;" class="fas fa-phone"></i></button>';

            var noteButtonHtml = '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Customer Note" type="button" id="note_button_' + arg.event.extendedProps.booking_id + '" class="btn btn-primary event-action-button" onclick="showBookingNotesDivCalendar(event, ' + arg.event.extendedProps.booking_id + ')" data-toggle="modal" data-target="#bookingNoteModal"><i style="color:black;font-size: 15px;margin-left: 4px;" class="fas fa-sticky-note"></i></button>';

            var reviewButtonHtml = '';
            if (arg.event.extendedProps.review_id != '') {
                var reviewButtonHtml = '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Customer Review" type="button" id="review_button_' + arg.event.extendedProps.booking_id + '" class="btn btn-primary event-action-button" onclick="showBookingReviewDivCalender(event, ' + arg.event.extendedProps.review_id + ')" data-toggle="modal" data-target="#bookingReviewModal"><i style="color:black;font-size: 15px;margin-left: 3px;" class="fas fa-comment-dots"></i></button>';
            }

            var eventContentHtml = '<div class="event-container calender_event_' + arg.event.extendedProps.booking_id + '">' + dotHtml + '<div class="event-info">' + customerHtml + '' + timeHtml + '' + descHtml + '<p class="title" style="color:#000;"></p>' + editButtonHtml + '' + completeButtonHtml + '' + cancelButtonHtml + '' + buttonHtml + '' + callButtonHtml + '' + noteButtonHtml + '' + reviewButtonHtml + '</div></div>';

            if (viewType === 'dayGridMonth') {
                eventContentHtml = '<div class="event-container calender_event_' + arg.event.extendedProps.booking_id + '">' + dotHtml + '<div class="event-info">' + customerHtml + '' + timeHtml + '<p class="title" style="color:#000;"><b>' + arg.event.title + '</b></p></div></div>';
            }

            var popuphtml = '' +
                // '<p>' +  arg.event.extendedProps.booking_no + '</p>';
                '<p>' + arg.event.extendedProps.customer_name + ', ' + arg.event.extendedProps.customer_mobile + '</p>';
            if (arg.event.extendedProps.booking_payment_status === '1') {
                popuphtml += '<p style="font-size:12px;width:100%;">Payable <small style="float:right;">Rs. ' + (parseFloat(arg.event.extendedProps.final_discount_amount) + parseFloat(arg.event.extendedProps.final_payable_price)).toFixed(2) + '</small></p>' +
                    '<p style="font-size:12px;width:100%;">Discount <small style="float:right;">Rs. ' + parseFloat(arg.event.extendedProps.final_discount_amount).toFixed(2) + '</small></p>' +
                    '<p style="font-size:12px;width:100%;">GST <small style="float:right;">Rs. ' + parseFloat(arg.event.extendedProps.final_gst_amount).toFixed(2) + '</small></p>' +
                    '<p style="font-size:12px;width:100%;">Final Amt <small style="float:right;">Rs. ' + parseFloat(arg.event.extendedProps.final_final_price).toFixed(2) + '</small></p>';
            }
            setTimeout(() => {
                tippy('.calender_event_' + arg.event.extendedProps.booking_id + '', {
                    content: popuphtml,
                    allowHTML: true,
                    placement: 'top',
                    theme: 'light-border',
                });
            }, 0);

            return {
                html: eventContentHtml
            };
        },

        slotDuration: slotDuration,
        slotMinTime: storeOpenTime,
        slotMaxTime: storeCloseTime,
        slotLabelFormat: {
            hour: 'numeric',
            minute: '2-digit',
            omitZeroMinute: false,
            meridiem: 'short'
        },
        selectable: true,
    });

    calendar.setOption('headerToolbar', {
        left: 'prev,next today', // Add stylist's name button to the left side
        // left: 'stylistNameButton prev,next today', // Add stylist's name button to the left side
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
    });

    calendar.render();
}

var bellSound_path = BASE_URL + 'salon_assets/bell-ringing-01c.wav';
var branch_id = ENC_BRANCH_ID;
var salon_id = ENC_SALON_ID;
var uid = UID;
var type = CONNECTION_TYPE;
var project = WS_PROJECT;
var socketURL = SOCKET_BASE_URL + "?project=" + project + "&uid=" + uid + "&type=" + type;

var websocket = new WebSocket(socketURL);
var bellSound = new Audio(bellSound_path);

websocket.onopen = function() {
    console.log('Connected to WebSocket server at ' + socketURL);
};

websocket.onmessage = function(event) {
    try {
        var eventData = JSON.parse(event.data);
        console.log(eventData.message_type);
        if (eventData.service_date && eventData.stylist) {
            var alertBox = document.getElementById('alert-box');
            var message = eventData.message;
            alertBox.innerHTML = message;
            alertBox.style.display = 'block';
            setTimeout(function() {
                alertBox.style.display = 'none';
                console.log('bellSound_path: ', bellSound_path);
                bellSound.play();
            }, 10000);
            setStylistCalendar(eventData.stylist);
        } else if (eventData.customer_id && eventData.message_type == 'booking_placed') {
            var alertBox = document.getElementById('alert-box');
            var message = eventData.message;
            alertBox.innerHTML = message;
            alertBox.style.display = 'block';
            setTimeout(function() {
                alertBox.style.display = 'none';
                console.log('bellSound_path: ', bellSound_path);
                bellSound.play();
            }, 10000);
        } else if (eventData.subscription_id) {
            console.log('Subscription data updation triggered');
            updateSubscriptionData();
        }
    } catch (error) {
        console.log('Error parsing WebSocket message:', error);
    }
};

websocket.onclose = function(event) {
    console.log('WebSocket connection closed:', event);
};

websocket.onerror = function(error) {
    console.log('WebSocket error:', error);
};
document.addEventListener('DOMContentLoaded', function() {
    initCalendar();
    initWebSocket();
});

function initCalendar(initialDate = null, serviceTime = null){
    serviceTime = serviceTime || undefined;
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
        initialView: 'resourceTimeGridDay', // Agenda view with resources
        slotDuration: slotDurationMain, // Use the PHP-generated variable directly
        slotLabelInterval: slotDurationMain,
        editable: true,
        selectable: true,
        nowIndicator: true,
        allDaySlot: false,
        scrollTime: (() => {
            if (serviceTime) {
                return serviceTime;
            }
            const date = new Date();
            date.setMinutes(date.getMinutes() - 10);
            return date.toTimeString().slice(0, 5);
        })(),
        initialDate: initialDate || undefined,
        selectAllow: function(selectInfo) {
            const now = moment();
            return moment(selectInfo.start).isSameOrAfter(now);
        },
        selectMirror: true,
        resourceAreaWidth: single_size,
        resourceAreaHeaderContent: 'Resources',
        resources: BASE_URL + 'salon/Ajax_controller/fetch_resources_ajx',
        events: BASE_URL + 'salon/Ajax_controller/fetch_resources_events',
        headerToolbar: {
            left: 'resourceTimeGridDay,resourceTimeGridWeek,dayGridMonth,yearView',
            center: 'title',
            right: 'prev,customTodayButton,next'
        },
        resourceLabelContent: function(arg) {
            return {
                html: `
                    <div class="resource-info-wrapper stylist_sale_details_info" id="stylist_sale_details_info_${arg.resource.id}">
                        ${arg.resource.extendedProps.column_header}
                    </div>
                `
            };
        },
        customButtons: {
            customTodayButton: {
                text: 'Today',
                click: function() {
                    calendar.today();
                }
            }
        },
        views: {
            yearView: {
                type: 'dayGrid',
                duration: { years: 1 },
                buttonText: 'Year',
                titleFormat: { year: 'numeric' }
            },
            resourceTimeGridDay: {
                buttonText: 'Day',
                titleFormat: { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' }
            },
            resourceTimeGridWeek: {
                buttonText: 'Week',
                titleFormat: { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' }
            },
            dayGridMonth: {
                buttonText: 'Month',
                titleFormat: { month: 'long', year: 'numeric' }
            }
        },
        eventClick: function(arg) {
            if (arg.event.extendedProps.event_type == '2') {
                var now = moment();
                if (moment(arg.event.end).isAfter(now)) {
                    Swal.fire({
                        title: 'Remove Short Break?',
                        text: 'Do you want to remove this short break?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, remove it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Call your AJAX to delete the break
                            $.ajax({
                                url: BASE_URL + "salon/Ajax_controller/remove_short_break",
                                type: "POST",
                                data: {
                                    break_id: arg.event.id
                                },
                                success: function(response) {
                                    if (response == '1') {
                                        Swal.fire('Removed!', 'The short break has been removed.', 'success');
                                        arg.event.remove();
                                    } else {
                                        Swal.fire('Something went wrong, please try again.', 'error');
                                    }
                                },
                                error: function() {
                                    Swal.fire('Error!', 'Server error occurred.', 'error');
                                }
                            });
                        }
                    });
                }
            }else if(arg.event.extendedProps.event_type == '1'){
                showBookingDetailsDiv(arg.event.extendedProps.booking_id);
            }
        },
        eventDrop: function(info) {
            if (info.event.extendedProps.event_type == '1') {                
                const now = moment();

                const originalStart = moment(info.oldEvent.start);
                if (originalStart.isBefore(now)) {
                    displayMessage('Past Appointment cannot be Rescheduled', 'error');
                    info.revert();
                    return;
                }

                const newStart = moment(info.event.start);
                if (newStart.isBefore(now)) {
                    displayMessage('Cannot Reschedule the Appointment to past time', 'error');
                    info.revert();
                    return;
                }

                if (info.event.extendedProps.booking_status == '1') {
                    $.ajax({
                        url: BASE_URL + 'salon/Ajax_controller/reschedule_appointment_ajax',
                        type: 'POST',
                        data: {
                            id: info.event.id,
                            merged_service_ids: info.event.extendedProps.merged_service_ids,
                            title: info.event.title,
                            start: formatDateTimeCalendar(info.event.start),
                            end: info.event.end ? formatDateTimeCalendar(info.event.end) : null,
                            resourceId: info.event.getResources()[0]?.id || null
                        },
                        success: function(response) {
                            if(response == '1'){
                                displayMessage('Appointment Reschdule Not Allowed', 'error');
                                info.revert();
                            }else if(response == '0'){
                                displayMessage('Something went wrong', 'error');
                                info.revert();
                            }else if(response == '2'){
                                displayMessage('Booking is spread accross different timeslots, so can not reshedule from here', 'error');
                                info.revert();
                            }else{
                                displayMessage('Appointment Rescheduled Successfully', 'success');
                            }
                        },
                        error: function() {
                            displayMessage('Error updating event', 'error');
                            info.revert();
                        }
                    });
                }else{
                    displayMessage('Booking is completed', 'error');
                    info.revert();
                }
            }else{
                displayMessage('This action not allowed', 'error');
                info.revert();
            }
        },
        eventResize: function(info) {
            // Update event on resize
            $.ajax({
                url: 'edit-event.php',
                type: 'POST',
                data: {
                    id: info.event.id,
                    title: info.event.title,
                    start: info.event.start.toISOString(),
                    end: info.event.end ? info.event.end.toISOString() : null,
                    resourceId: info.event.getResources()[0]?.id || null
                },
                success: function(response) {
                    displayMessage('Event updated successfully', 'success');
                },
                error: function() {
                    displayMessage('Error updating event', 'error');
                    info.revert();
                }
            });
        },
        dateClick: function(arg) {
            calendar.changeView('resourceTimeGridDay', arg.date);
        },
        eventContent: function(arg) {
            if(arg.event.extendedProps.event_type == '1'){
                var viewType = arg.view.type;
                var bookingStatus = arg.event.extendedProps.booking_status;
                var timeHtml = '';
                var descHtml = '';
                var customerHtml = '';
                var servicesHtml = ''; // To hold the merged service names
                var editButtonHtml = '';
                var completeButtonHtml = '';
                var cancelButtonHtml = '';
                var buttonHtml = '';
                var callButtonHtml = '';
                var noteButtonHtml = '';
                var reviewButtonHtml = '';
                var dotHtml = '';

                if (viewType == 'resourceTimeGridDay' || viewType == 'resourceTimeGridWeek') {
                    customerHtml = '<p class="customer" style="margin: 0;font-size:13px;color:#000;"><b>' + arg.event.extendedProps.customer_name + '</b></p>';
                    timeHtml = '<p class="time" style="color:#000;"><b>' + arg.timeText + '</b></p>';
                    descHtml = '<p class="description" style="margin: 0;color:#000;">' + (arg.event.extendedProps.booking_description || '') + '</p>';
                    servicesHtml = '<p class="services" style="margin: 0;color:#000; font-size: 12px;">' + arg.event.title + '</p>'; // Display merged services
                }else if(viewType == 'dayGridMonth' || viewType == 'yearView'){
                    dotHtml = '<div class="dot" style="background-color:' + arg.event.backgroundColor + ';"></div>';
                    customerHtml = '<label class="customer" style="font-size:13px;color:#000;"><b>' + arg.event.extendedProps.customer_name + '</b></label>';
                    timeHtml = '<label class="time" style="color:#000;">&nbsp;&nbsp;(' + arg.timeText + ')</label>';
                }

                if (viewType === 'resourceTimeGridDay') {
                    if (arg.event.extendedProps.booking_payment_status === '0' && (arg.event.extendedProps.booking_status === '1' || arg.event.extendedProps.booking_status === '3' || arg.event.extendedProps.booking_status === '4')) {
                        var eventStartTime = new Date(arg.event.start);
                        var currentTime = new Date();
                        // buttonHtml += '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Add New Service" id="addServiceButton_' + arg.event.extendedProps.booking_id + '" onclick="showAddServicePopupCalender(event, ' + arg.event.extendedProps.booking_id + ')" data-toggle="modal" data-target="#addServiceModal" class="btn btn-primary event-action-button"><i style="font-size: 17px;color: black;" class="fa fa-plus"></i></button>';
                    }
                    if (arg.event.extendedProps.booking_status === '5') {
                        if (arg.event.extendedProps.booking_payment_status === '0') {
                            var encodedId = btoa(arg.event.extendedProps.booking_id);
                            var bill_url = BASE_URL  + 'bill-setup/' + encodedId;
                            buttonHtml += '<a style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Generate Bill" type="button" id="bill_generate_button_' + arg.event.extendedProps.booking_id + '" href=" ' + bill_url + ' " class="btn btn-primary event-action-button"><i style="font-size: 15px;color: black;" class="fas fa-file-invoice"></i></button>';
                        } else {
                            buttonHtml += '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Receipt" id="receiptButton_' + arg.event.extendedProps.booking_id + '" onclick="openReceiptLink(event, \'' + btoa(arg.event.extendedProps.booking_id) + '\', \'' + btoa(arg.event.extendedProps.booking_service_payment_id) + '\')" class="btn btn-primary event-action-button"><i style="font-size: 15px;color: black;" class="fas fa-receipt"></i></button>';
                            buttonHtml += '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Update Payment Details" type="button" id="updateBill_' + arg.event.extendedProps.booking_id + '" class="btn btn-primary event-action-button" onclick="showBillUpdatePopupCalender(event, ' + arg.event.extendedProps.booking_id + ')" data-toggle="modal" data-target="#updateBillModal"><i style="color:black;font-size: 15px;margin-left: 4px;" class="fas fa-edit"></i></button>';
                        }
                    }

                    if (arg.event.extendedProps.booking_payment_status === '0' && (arg.event.extendedProps.booking_status === '1' || arg.event.extendedProps.booking_status === '3' || arg.event.extendedProps.booking_status === '4')) {
                        var eventStartTime = new Date(arg.event.start);
                        var currentTime = new Date();
                        var editButtonHtml = '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Edit Booking" type="button" id="edit_button_' + arg.event.extendedProps.booking_id + '" onclick="showBookingEditPopupFromEvent(event, ' + arg.event.extendedProps.booking_id + ')" data-toggle="modal" data-target="#BookingEditModal" class="btn btn-primary event-action-button"><i style="font-size: 15px;color: black;" class="fas fa-pencil"></i></button>';
                    }

                    if (arg.event.extendedProps.booking_payment_status === '0' && arg.event.extendedProps.is_cancel_allowed == '1' && (arg.event.extendedProps.booking_status === '1' || arg.event.extendedProps.booking_status === '3' || arg.event.extendedProps.booking_status === '4')) {
                        var cancelButtonHtml = '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Cancel Service" type="button" id="cancel_button_' + arg.event.extendedProps.booking_id + '" onclick="showCancelPopupCalender(event, ' + arg.event.extendedProps.booking_id + ')" data-toggle="modal" data-target="#exampleModalCancel" class="btn btn-primary event-action-button"><i style="color:red;font-size: 20px;" class="fas fa-times"></i></button>';
                    }

                    if (arg.event.extendedProps.booking_payment_status === '0' && (arg.event.extendedProps.booking_status === '1' || arg.event.extendedProps.booking_status === '3' || arg.event.extendedProps.booking_status === '4')) {
                        var completeButtonHtml = '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Complete Booking" type="button" id="complete_button_' + arg.event.extendedProps.booking_id + '" onclick="showCompletePopupCalender(event, ' + arg.event.extendedProps.booking_id + ')" data-toggle="modal" data-target="#ServiceCompleteModal" class="btn btn-primary event-action-button"><i style="color:green;font-size: 20px;" class="fas fa-check"></i></button>';
                    }

                    var callButtonHtml = '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Call Customer" type="button" id="call_button_' + arg.event.extendedProps.booking_id + '" class="btn btn-primary event-action-button" onclick="window.location.href=\'tel:' + arg.event.extendedProps.customer_phone + '\'"><i style="color:red;font-size: 15px;margin-left: 4px;" class="fas fa-phone"></i></button>';

                    var noteButtonHtml = '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Customer Note" type="button" id="note_button_' + arg.event.extendedProps.booking_id + '" class="btn btn-primary event-action-button" onclick="showBookingNotesDivCalendar(event, ' + arg.event.extendedProps.booking_id + ')" data-toggle="modal" data-target="#bookingNoteModal"><i style="color:black;font-size: 15px;margin-left: 4px;" class="fas fa-sticky-note"></i></button>';

                    if (arg.event.extendedProps.review_id != '') {
                        var reviewButtonHtml = '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Customer Review" type="button" id="review_button_' + arg.event.extendedProps.booking_id + '" class="btn btn-primary event-action-button" onclick="showBookingReviewDivCalender(event, ' + arg.event.extendedProps.review_id + ')" data-toggle="modal" data-target="#bookingReviewModal"><i style="color:black;font-size: 15px;margin-left: 3px;" class="fas fa-comment-dots"></i></button>';
                    }                     
                }

                var eventContentHtml = '<div class="event-container calender_event_' + arg.event.extendedProps.booking_id + '">' +
                    '<div class="event-info">' +
                    dotHtml +
                    customerHtml +
                    timeHtml +
                    descHtml +
                    '<p class="title" style="margin: 0;color:#000;"></p>' +
                    editButtonHtml +
                    completeButtonHtml +
                    cancelButtonHtml +
                    buttonHtml +
                    callButtonHtml +
                    noteButtonHtml +
                    // reviewButtonHtml +
                    '</div></div>';   

                var popuphtml = '' +
                    '<p>' + arg.event.extendedProps.customer_name + ', ' + arg.event.extendedProps.customer_phone + '</p>';
                setTimeout(() => {
                    tippy('.calender_event_' + arg.event.extendedProps.booking_id + '', {
                        content: popuphtml,
                        allowHTML: true,
                        placement: 'top',
                        theme: 'light-border',
                    });
                }, 0);
            }else if(arg.event.extendedProps.event_type == '2'){ // short break
                var startTime = moment(arg.event.start).format('hh:mm A');
                var endTime = moment(arg.event.end).format('hh:mm A');

                var breakHtml = '<p class="time" style="color:#000;"><b>Short Break</b>: ' + startTime + ' - ' + endTime + '</p>';

                var cancelBreakButtonHtml = '';
                var now = moment();
                if (moment(arg.event.end).isAfter(now)) {
                    var cancelBreakButtonHtml = '<button style="padding:0;margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Remove Break" id="remove_break_' + arg.event.id + '" class="btn btn-primary event-action-button"><i style="font-size: 20px;color: green;" class="fas fa-unlock"></i></button>';
                }

                var eventContentHtml = '<div class="event-container>' +
                    '<div class="event-info" style="width: 100%;display: flex;flex-direction: column;height: 100%;justify-content: center;align-items: center;text-align: center;">' +
                    breakHtml +
                    '<p class="title" style="color:#000;"></p>' +
                    cancelBreakButtonHtml +
                    '</div></div>';   
            }else if(arg.event.extendedProps.event_type == '3'){ // shift break
                var startTime = moment(arg.event.start).format('hh:mm A');
                var endTime = moment(arg.event.end).format('hh:mm A');

                var breakHtml = '<p class="time" style="color:#000;"><b>Shift Break</b>: ' + startTime + ' - ' + endTime + '</p>';

                var eventContentHtml = '<div class="event-container>' +
                    '<div class="event-info" style="width: 100%;display: flex;flex-direction: column;height: 100%;justify-content: center;align-items: center;text-align: center;">' +
                    breakHtml +
                    '</div></div>';   
            }

            return {
                html: eventContentHtml
            };
        },
        select: function(info) {
            const startFormatted = moment(info.start).format('hh:mm A');
            const startDateFormatted = moment(info.start).format('D MMMM, YYYY');
            const endFormatted = moment(info.end).format('hh:mm A');
            Swal.fire({
                // title: 'Selected Time',
                html: `<p><strong>Date: </strong>${startDateFormatted}</p><p><strong>Time: </strong>${startFormatted} to ${endFormatted}</p>`,
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: '<i title="New Appointment" class="fas fa-plus"></i>',
                denyButtonText: '<i title="Short Break" class="fas fa-lock"></i>',
                cancelButtonText: '<i title="Cancel" class="fas fa-times"></i>',
                // icon: 'question'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Add Event button clicked
                    const start = moment(info.start).format('YYYY-MM-DD HH:mm:ss');
                    const end = moment(info.end).format('YYYY-MM-DD HH:mm:ss');
                    const resourceId = info.resource.id;

                    const url = BASE_URL + 'add-new-booking-new?start=' + encodeURIComponent(start) + '&end=' + encodeURIComponent(end) + '&stylist=' + resourceId + '&customer=';
                    // window.open(url, '_blank');
                    window.location.href = url;
                } else if (result.isDenied) {
                    // Lock Period clicked
                    const start = info.startStr;
                    const end = info.endStr;
                    const resourceId = info.resource.id;

                    $.ajax({
                        url: BASE_URL + 'salon/Ajax_controller/lock_time_period',
                        type: 'POST',
                        data: {
                            start: start,
                            end: end,
                            stylist_id: resourceId
                        },
                        success: function(response) {
                            var opts = $.parseJSON(response);
                            if(opts.status == '1'){
                                Swal.fire('Success!', 'Short break added successfully.', 'success');
                                calendar.addEvent({
                                    id: opts.break_id,
                                    title: 'Short Break',
                                    start: start,
                                    end: end,
                                    resourceId: resourceId,
                                    backgroundColor: '#fb968f',
                                    extendedProps: {
                                        event_type: '2'
                                    }
                                });
                            }else{
                                Swal.fire('Error!', 'Selection is not valid, please try again.', 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error!', 'Failed to add short break.', 'error');
                        }
                    });
                }
            });
        },
        // Set the start and end of the visible time slots
        visibleRange: {
            start: salon_avg_working.start,
            end: salon_avg_working.end
        },
        // Ensure that the slotMinTime and slotMaxTime are also set for proper rendering
        slotMinTime: salon_avg_working.start,
        slotMaxTime: salon_avg_working.end
    });

    // Populate resource dropdown
    $.getJSON(BASE_URL + 'salon/Ajax_controller/fetch_resources_ajx', function(data) {
        var $select = $('#eventResource');
        $select.empty();
        data.forEach(function(resource) {
            $select.append(`<option value="${resource.id}">${resource.title || resource.id}</option>`); // Use resource.title here
        });
    });

    calendar.render();
}

function displayMessage(message, type) {
    let alertClass = '';
    let colorStyle = '';

    if (type === 'success') {
        alertClass = 'alert-success';
        colorStyle = 'white';
    } else if (type === 'error') {
        alertClass = 'alert-danger';
        colorStyle = 'white';
    } else {
        alertClass = 'alert-info';
        colorStyle = 'white';
    }

    const alertHtml = `
        <div class="login_hide_show alert ${alertClass} animated fadeInUp" style="color: ${colorStyle}; margin-top: 10px;">
            <strong style="color: ${colorStyle};"></strong> ${message}
        </div>
    `;

    $('.response').html(alertHtml);

    setTimeout(function () {
        $('.response').fadeOut('slow', function () {
            $(this).empty().show();
        });
    }, 5000);
}

function initWebSocket() {
    const bellSound_path = BASE_URL + 'salon_assets/bell-ringing-01c.wav';
    const bellSound = new Audio(bellSound_path);

    const socketURL = SOCKET_BASE_URL + "?project=" + WS_PROJECT + "&uid=" + UID + "&type=" + CONNECTION_TYPE;
    const websocket = new WebSocket(socketURL);

    websocket.onopen = function() {
        console.log('Connected to WebSocket at', socketURL);
    };

    websocket.onmessage = function(event) {
        try {
            const eventData = JSON.parse(event.data);
            console.log('WebSocket Event Type:', eventData.message_type);

            if (eventData.service_date && eventData.stylist) {
                var service_start_time = eventData.service_start_time;
                showAlertWithSound(eventData.message, bellSound);
                initCalendar(eventData.service_date,service_start_time);
            } else if (eventData.customer_id && eventData.message_type == 'trying_for_booking') {
                showAlertWithSound(eventData.message, bellSound);
                showDashboardCounts();
            } else if (eventData.subscription_id) {
                console.log('Subscription data update triggered');
                updateSubscriptionData();
            }
        } catch (error) {
            console.error('WebSocket parsing error:', error);
        }
    };

    websocket.onclose = function(event) {
        console.log('WebSocket closed:', event);
    };

    websocket.onerror = function(error) {
        console.log('WebSocket error:', error);
    };
}

function showAlertWithSound(message, bellSound) {
    const alertBox = document.getElementById('alert-box');
    alertBox.innerHTML = message;
    alertBox.style.display = 'block';
    setTimeout(() => {
        alertBox.style.display = 'none';
        bellSound.play();
    }, 10000);
}

function formatDateTimeCalendar(date) {
    if (!date) return null;
    const pad = (n) => n.toString().padStart(2, '0');

    const year = date.getFullYear();
    const month = pad(date.getMonth() + 1);
    const day = pad(date.getDate());
    const hours = pad(date.getHours());
    const minutes = pad(date.getMinutes());
    const seconds = pad(date.getSeconds());

    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
}

$(document).ready(function() {    
    const now = new Date();
    const formattedDateTime = formatDateTime_without_second(now);
    ringAppointmentNotification(formattedDateTime);
    
    checkAndRingNotification();
    setInterval(checkAndRingNotification, 60000);
});
function checkAndRingNotification() {
    const now = new Date();
    const formattedDateTime = formatDateTime_without_second(now);
    const minutes = now.getMinutes();
    console.log("Current Minutes:", minutes);

    if (minutes % 5 === 0) {
        ringAppointmentNotification(formattedDateTime);
    }
}

var appointmentBellSound_path = BASE_URL + 'salon_assets/bell-ringing-01c.wav';
var appointmentBellSound = new Audio(appointmentBellSound_path);
function ringAppointmentNotification(currentDateTime){
    $.ajax({
        url: BASE_URL + "salon/Ajax_controller/fetch_appointment_ajax",
        method: 'POST',
        data: {
            'currentDateTime': currentDateTime
        },
        success: function(response) {
            var opts = $.parseJSON(response);
            if (opts.status == '1') {
                var alertBox = document.getElementById('alert-box');
                var message = opts.message;
                alertBox.innerHTML = message;
                alertBox.style.display = 'block';
                setTimeout(function() {
                    alertBox.style.display = 'none';
                    appointmentBellSound.play();
                }, 10000);
            } else {
                console.log('Appointments not available');
            }
        },
        error: function() {
            console.log('Error occured');
        }
    });
}

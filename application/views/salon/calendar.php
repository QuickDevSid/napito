<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FullCalendar Scheduler Integration</title>
    <!-- FullCalendar Scheduler CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.5/main.min.css" rel="stylesheet">
    <!-- Bootstrap CSS for modal styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f4f4f9;
        }
        #calendar {
            max-width: 1100px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .response {
            height: 60px;
            text-align: center;
        }
        .success {
            background: #cdf3cd;
            padding: 10px;
            border: #c3e6c3 1px solid;
            display: inline-block;
            border-radius: 4px;
        }
        .error {
            background: #f8d7da;
            padding: 10px;
            border: #f5c6cb 1px solid;
            display: inline-block;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h2>FullCalendar Scheduler with Resources</h2>
    <input type="date" id="datePicker">
    <div class="response"></div>
    <div id="calendar"></div>

    <!-- Modal for Adding/Editing Events -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Add/Edit Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="eventForm">
                        <div class="mb-3">
                            <label for="eventTitle" class="form-label">Event Title</label>
                            <input type="text" class="form-control" id="eventTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="eventStart" class="form-label">Start Date</label>
                            <input type="datetime-local" class="form-control" id="eventStart" required>
                        </div>
                        <div class="mb-3">
                            <label for="eventEnd" class="form-label">End Date</label>
                            <input type="datetime-local" class="form-control" id="eventEnd" required>
                        </div>
                        <div class="mb-3">
                            <label for="eventResource" class="form-label">Resource</label>
                            <select class="form-control" id="eventResource" required>
                                <!-- Populated dynamically -->
                            </select>
                        </div>
                        <input type="hidden" id="eventId">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="deleteEventBtn" style="display: none;">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveEventBtn">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- FullCalendar Scheduler JS (includes core and scheduler) -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.5/main.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php  
	$booking_rules = $this->Salon_model->get_booking_rules();
if (!empty($booking_rules)) {
    $rules_employee_selection = $booking_rules->employee_selection;
    $slot = $booking_rules->slot_time;
    $days_early_booking = $booking_rules->max_booking_range_day;
    $minutes_early_booking = $booking_rules->booking_time_range;
    if ($days_early_booking != "") {
        $max_date = date('Y-m-d', strtotime('+' . $days_early_booking . ' day'));
    } else {
        $max_date = date('Y-m-d', strtotime('+0 day'));
    }
} else {
    $rules_employee_selection = '1';
    $slot = 5;
    // $minutes_early_booking = $booking_rules->buffering_time;
    $minutes_early_booking = 0;
    $max_date = date('Y-m-d', strtotime('+0 day'));
}
$today = date('Y-m-d');
$hours = floor($slot / 60);
$minutes = $slot % 60;
$hoursFormatted = str_pad($hours, 2, '0', STR_PAD_LEFT);
$minutesFormatted = str_pad($minutes, 2, '0', STR_PAD_LEFT);

$slotDuration = "'{$hoursFormatted}:{$minutesFormatted}:00'";
?>
    <script>
        var slotDuration = <?php echo $slotDuration; ?>;
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
                initialView: 'resourceTimeGridDay', // Agenda view with resources
                slotDuration: slotDuration, // Use the PHP-generated variable directly
                slotLabelInterval: slotDuration,
                editable: true,
                selectable: true,
                selectMirror: true,
                resourceAreaWidth: '20%',
                resourceAreaHeaderContent: 'Resources',
                resources: '<?php echo base_url(); ?>salon/Ajax_controller/fetch_resources_ajx',
                events: '<?php echo base_url(); ?>salon/Ajax_controller/fetch_resources_events',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'resourceTimeGridDay,resourceTimeGridWeek'
                },
                select: function(info) {
                    // Open modal for adding new event
                    $('#eventModalLabel').text('Add Event');
                    $('#eventForm')[0].reset();
                    $('#eventId').val('');
                    $('#eventStart').val(info.startStr.slice(0, 16));
                    $('#eventEnd').val(info.endStr.slice(0, 16));
                    $('#eventResource').val(info.resource ? info.resource.id : '');
                    $('#deleteEventBtn').hide();
                    $('#eventModal').modal('show');
                },
                eventClick: function(info) {
                    // Open modal for editing event
                    $('#eventModalLabel').text('Edit Event');
                    $('#eventId').val(info.event.id);
                    $('#eventTitle').val(info.event.title);
                    $('#eventStart').val(info.event.start.toISOString().slice(0, 16));
                    $('#eventEnd').val(info.event.end ? info.event.end.toISOString().slice(0, 16) : '');
                    $('#eventResource').val(info.event.getResources()[0]?.id || '');
                    $('#deleteEventBtn').show();
                    $('#eventModal').modal('show');
                },
                eventDrop: function(info) {
                    // Update event on drag-and-drop
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
                eventContent: function(arg) {
                  var viewType = arg.view.type;
                  var dotHtml = '<div class="dot" style="background-color:' + arg.event.backgroundColor + ';"></div>';
                  var timeHtml = '';
                  var descHtml = '';
                  var customerHtml = '';
                  var servicesHtml = ''; // To hold the merged service names

                  // Check if it's not the month view
                  if (viewType == 'resourceTimeGridDay' || viewType == 'resourceTimeGridWeek') {
                      customerHtml = '<p class="customer" style="font-size:13px;color:#000;"><b>' + arg.event.extendedProps.customer_name + ', ' + arg.event.extendedProps.customer_phone + '</b></p>';
                      timeHtml = '<p class="time" style="color:#000;"><b>' + arg.timeText + '</b></p>';
                      descHtml = '<p class="description" style="color:#000;">' + (arg.event.extendedProps.description || '') + '</p>';
                      servicesHtml = '<p class="services" style="color:#000; font-size: 12px;">' + arg.event.title + '</p>'; // Display merged services
                  }

                  var buttonHtml = '';
                  // Check if it's the week or day view
                  if (viewType === 'resourceTimeGridDay' || viewType === 'resourceTimeGridWeek') {
                      if (arg.event.extendedProps.booking_payment_status === '0' && (arg.event.extendedProps.booking_status === '1' || arg.event.extendedProps.booking_status === '3' || arg.event.extendedProps.booking_status === '4')) {
                          var eventStartTime = new Date(arg.event.start);
                          var currentTime = new Date();
                          buttonHtml += '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Add New Service" id="addServiceButton_' + arg.event.extendedProps.booking_id + '" onclick="showAddServicePopupCalender(event, ' + arg.event.extendedProps.booking_id + ')" data-toggle="modal" data-target="#addServiceModal" class="btn btn-primary event-action-button"><i style="font-size: 17px;color: black;" class="fa fa-plus"></i></button>';
                      }
                      if (arg.event.extendedProps.booking_status === '5') {
                          if (arg.event.extendedProps.booking_payment_status === '0') {
                              var base_url = "<?php echo base_url(); ?>";
                              var encodedId = btoa(arg.event.extendedProps.booking_id);
                              var bill_url = base_url + 'bill-setup/' + encodedId;
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
                      var editButtonHtml = '<button style="margin-right:0px;background-color:transparent !important; border:none;outline:none; box-shadow:none;" title="Edit Booking" type="button" id="edit_button_' + arg.event.extendedProps.booking_id + '" onclick="showBookingEditPopupFromEvent(event, ' + arg.event.extendedProps.booking_id + ')" data-toggle="modal" data-target="#BookingEditModal" class="btn btn-primary event-action-button"><i style="font-size: 15px;color: black;" class="fas fa-pencil"></i></button>';
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

                  var eventContentHtml = '<div class="event-container calender_event_' + arg.event.extendedProps.booking_id + '">' +
                      dotHtml +
                      '<div class="event-info">' +
                      customerHtml +
                      timeHtml +
                      servicesHtml + // Display the merged services here
                      descHtml +
                      '<p class="title" style="color:#000;"></p>' +
                      editButtonHtml +
                      completeButtonHtml +
                      cancelButtonHtml +
                      buttonHtml +
                      callButtonHtml +
                      noteButtonHtml +
                      reviewButtonHtml +
                      '</div></div>';

                  if (viewType !== 'resourceTimeGridDay' || viewType !== 'resourceTimeGridWeek') {
                      eventContentHtml = '<div class="event-container calender_event_' + arg.event.extendedProps.booking_id + '">' +
                          dotHtml +
                          '<div class="event-info">' +
                          customerHtml +
                          timeHtml +
                          '<p class="title" style="color:#000;"><b>' + arg.event.title + '</b></p>' + // Also show in month view
                          '</div></div>';
                  }

                  var popuphtml = '' +
                      '<p>' + arg.event.extendedProps.customer_name + ', ' + arg.event.extendedProps.customer_mobile + '</p>' +
                      '<p style="font-size:12px;width:100%;"><b>Services:</b><br>' + arg.event.title.replace(/, /g, '<br>') + '</p>'; // Show multi-line services in popup
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
              }
            });

            // Populate resource dropdown
            $.getJSON('<?php echo base_url(); ?>salon/Ajax_controller/fetch_resources_ajx', function(data) {
                var $select = $('#eventResource');
                $select.empty();
                data.forEach(function(resource) {
                  $select.append(`<option value="${resource.id}">${resource.title || resource.id}</option>`); // Use resource.title here
                });
            });

            // Save event
            $('#saveEventBtn').click(function() {
                var eventData = {
                    id: $('#eventId').val(),
                    title: $('#eventTitle').val(),
                    start: $('#eventStart').val(),
                    end: $('#eventEnd').val(),
                    resourceId: $('#eventResource').val()
                };

                $.ajax({
                    url: eventData.id ? 'edit-event.php' : 'add-event.php',
                    type: 'POST',
                    data: eventData,
                    success: function(response) {
                        calendar.refetchEvents();
                        $('#eventModal').modal('hide');
                        displayMessage(eventData.id ? 'Event updated successfully' : 'Event added successfully', 'success');
                    },
                    error: function() {
                        displayMessage('Error saving event', 'error');
                    }
                });
            });

            // Delete event
            $('#deleteEventBtn').click(function() {
                if (confirm('Are you sure you want to delete this event?')) {
                    $.ajax({
                        url: 'delete-event.php',
                        type: 'POST',
                        data: { id: $('#eventId').val() },
                        success: function(response) {
                            calendar.refetchEvents();
                            $('#eventModal').modal('hide');
                            displayMessage('Event deleted successfully', 'success');
                        },
                        error: function() {
                            displayMessage('Error deleting event', 'error');
                        }
                    });
                }
            });

            calendar.render();

            function displayMessage(message, type) {
                $('.response').html(`<div class="${type}">${message}</div>`);
                setTimeout(function() {
                    $('.response').empty();
                }, 3000);
            }
        });
    </script>
</body>
</html>
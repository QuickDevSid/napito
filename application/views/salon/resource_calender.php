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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
                initialView: 'resourceTimeGridDay', // Agenda view with resources
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
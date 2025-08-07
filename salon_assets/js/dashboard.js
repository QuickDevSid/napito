var selected_stylists_calendar = '';
$(document).ready(function() {
    $('#payment_form').validate({
            ignore: "",
            rules: {
                paid_amount: {
                    required: true,
                    noHTMLtags: true,
                },
                payment_mode: {
                    required: true,
                    noHTMLtags: true,
                },
                payment_date: {
                    required: true,
                    noHTMLtags: true,
                },
            },
            messages: {
                paid_amount: {
                    required: "Please enter paid amount!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                payment_mode: {
                    required: "Please enter payment method!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                payment_date: {
                    required: "Please select date!",
                    noHTMLtags: "HTML tags not allowed!",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
        
        showDashboardCounts();
    });   
    
    function showDashboardCounts() {
        $.ajax({
            type: "POST",
            url: BASE_URL + "salon/Ajax_controller/get_dashboard_counts_ajx",
            data: {},
            success: function(data) {
                var opts = $.parseJSON(data);
                $('#today_booking_count').text(parseInt(opts.today_all));
                $('#in_process_booking_count').text(parseInt(opts.in_process));
                $('#pending_booking_count').text(parseInt(opts.pending));
                $('#completed_booking_count').text(parseInt(opts.completed));
                $('#cancelled_booking_count').text(parseInt(opts.cancelled));
                $('#trying_booking_count').text(parseInt(opts.trying_booking));
            },
        });
    }
    
    function showDashboardDataPopup(type) {
        $('.loader_div').show();
        $.ajax({
            url: BASE_URL + "salon/Ajax_controller/get_dashboard_popup_data_ajx",
            method: 'POST',
            data: {
                type: type
            },
            success: function(response) {
                $('#dashboardModal_response').html(response)
                showPopup('dashboardModal');
                $('.loader_div').hide();
                
                if ($.fn.DataTable.isDataTable('#example')) {
                    $('#example').DataTable().destroy();
                }

                $('#example').DataTable(); 
            },
            error: function() {
                $('.loader_div').hide();
                alert("Error fetching service details");
            }
        });
    }

    function calculateSalesDashbaordCounts() {
        $('.loader_div').show();
        $('#today_sale_count').text(parseFloat('0.00').toFixed(2));
        $('#total_sale_count').text(parseFloat('0.00').toFixed(2));
        $('#total_service_sale_count').text(parseFloat('0.00').toFixed(2));
        $('#total_product_sale_count').text(parseFloat('0.00').toFixed(2));
        $('#total_package_sale_count').text(parseFloat('0.00').toFixed(2));
        $('#total_membership_sale_count').text(parseFloat('0.00').toFixed(2));
        $('#total_giftcard_sale_count').text(parseFloat('0.00').toFixed(2));
        $.ajax({
            type: "POST",
            url: BASE_URL + "salon/Ajax_controller/get_dashboard_sales_counts_ajx",
            data: {},
            success: function(data) {
                setTimeout(function() {
                    $('.loader_div').hide();
                    var opts = $.parseJSON(data);
                    // $('#today_sale_count').text(formatNumberInIndianFormat(parseFloat(opts.today_service_sale + opts.today_service_product_sale + opts.today_product_sale + opts.today_membership_sale + opts.today_package_sale + opts.today_giftcard_sale).toFixed(2)));
                    // $('#total_sale_count').text(formatNumberInIndianFormat(parseFloat(opts.total_service_sale + opts.total_service_product_sale + opts.total_product_sale + opts.total_membership_sale + opts.total_package_sale + opts.total_giftcard_sale).toFixed(2)));
                    // $('#total_service_sale_count').html(formatNumberInIndianFormat(parseFloat(opts.total_service_product_sale + opts.total_service_sale).toFixed(2)) + '<small><i title="Including Service Products" style="font-size: 12px;margin-top: 5px;margin-left: 5px;cursor:pointer;color:#008ec8;float:right;" class="fas fa-info-circle"></i></small>');
                    // $('#total_product_sale_count').text(formatNumberInIndianFormat(parseFloat(opts.total_product_sale).toFixed(2)));
                    // $('#total_package_sale_count').text(formatNumberInIndianFormat(parseFloat(opts.total_package_sale).toFixed(2)));
                    // $('#total_membership_sale_count').text(formatNumberInIndianFormat(parseFloat(opts.total_membership_sale).toFixed(2)));
                    // $('#total_giftcard_sale_count').text(formatNumberInIndianFormat(parseFloat(opts.total_giftcard_sale).toFixed(2)));
                    
                    $('#today_sale_count').text(formatNumberInIndianFormat(parseFloat(opts.today_service_sale + opts.today_service_product_sale + opts.today_product_sale + opts.today_membership_sale + opts.today_package_sale + opts.today_giftcard_sale).toFixed(2)));
                    $('#total_sale_count').text(formatNumberInIndianFormat(parseFloat(opts.today_service_sale + opts.today_service_product_sale + opts.today_product_sale + opts.today_membership_sale + opts.today_package_sale + opts.today_giftcard_sale).toFixed(2)));
                    $('#total_service_sale_count').html(formatNumberInIndianFormat(parseFloat(opts.today_service_product_sale + opts.today_service_sale).toFixed(2)) + '<small><i title="Including Service Products" style="font-size: 12px;margin-top: 5px;margin-left: 5px;cursor:pointer;color:#008ec8;float:right;" class="fas fa-info-circle"></i></small>');
                    $('#total_product_sale_count').text(formatNumberInIndianFormat(parseFloat(opts.today_product_sale).toFixed(2)));
                    $('#total_package_sale_count').text(formatNumberInIndianFormat(parseFloat(opts.today_package_sale).toFixed(2)));
                    $('#total_membership_sale_count').text(formatNumberInIndianFormat(parseFloat(opts.today_membership_sale).toFixed(2)));
                    $('#total_giftcard_sale_count').text(formatNumberInIndianFormat(parseFloat(opts.today_giftcard_sale).toFixed(2)));
                }, 1000);
            },
        });
    }
    
    function formatDate(dateString, timeString) {
        const date = new Date(dateString + 'T' + timeString);
        const year = date.getFullYear();
        const month = ('0' + (date.getMonth() + 1)).slice(-2);
        const day = ('0' + date.getDate()).slice(-2);
        const hours = ('0' + date.getHours()).slice(-2);
        const minutes = ('0' + date.getMinutes()).slice(-2);
        const seconds = ('0' + date.getSeconds()).slice(-2);
        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    }

    function formatNumberInIndianFormat(num) {
        // Convert number to string
        num = num.toString();

        // Split integer and decimal parts
        let [integerPart, decimalPart] = num.split('.');

        // Add commas to the integer part
        let lastThree = integerPart.slice(-3);
        let otherNumbers = integerPart.slice(0, -3);

        if (otherNumbers !== '') {
            lastThree = ',' + lastThree;
        }

        integerPart = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ',') + lastThree;

        // Combine integer and decimal parts
        return decimalPart ? integerPart + '.' + decimalPart : integerPart;
    }

    function calculateRedemptionDashbaordCounts() {
        $('.loader_div').show();
        $('#total_used_memberships_count').text(parseInt('0.00'));
        $('#total_used_coupons_count').text(parseInt('0.00'));
        $('#total_used_offers_count').text(parseInt('0.00'));
        $('#total_used_package_count').text(parseInt('0.00'));
        $('#total_used_giftcards_count').text(parseInt('0.00'));
        $.ajax({
            type: "POST",
            url: BASE_URL + "salon/Ajax_controller/get_dashboard_redemption_counts_ajx",
            data: {},
            success: function(data) {
                setTimeout(function() {
                    $('.loader_div').hide();
                    var opts = $.parseJSON(data);
                    $('#total_used_memberships_count').text(parseInt(opts.total_used_memberships_count));
                    $('#total_used_coupons_count').text(parseInt(opts.total_used_coupons_count));
                    $('#total_used_offers_count').text(parseInt(opts.total_used_offers_count));
                    $('#total_used_package_count').text(parseInt(opts.total_used_package_count));
                    $('#total_used_giftcards_count').text(parseInt(opts.total_used_giftcards_count));
                }, 1000);
            },
        });
    }

    function calculateFinanceDashbaordCounts() {
        $('.loader_div').show();
        $('#total_cash_sales').text(parseFloat('0.00'));
        $('#total_upi_sales').text(parseFloat('0.00'));
        $('#total_cheque_sales').text(parseFloat('0.00'));
        $('#total_card_sales').text(parseFloat('0.00'));
        $('#total_due_sales').text(parseFloat('0.00'));
        $('#total_petty_cash').text(parseFloat('0.00'));
        $.ajax({
            url: BASE_URL + "salon/Ajax_controller/fetch_finance_report_data_ajx",
            method: 'POST',
            data: {
                from_date: '',
                to_date: ''
            },
            success: function(data) {
                setTimeout(function() {
                    $('.loader_div').hide();
                    var response = JSON.parse(data);
                    $('#total_cash_sales').text(formatNumberInIndianFormat(parseFloat(response.total_cash_sales).toFixed(2)));
                    $('#total_upi_sales').text(formatNumberInIndianFormat(parseFloat(response.total_upi_sales).toFixed(2)));
                    $('#total_cheque_sales').text(formatNumberInIndianFormat(parseFloat(response.total_cheque_sales).toFixed(2)));
                    $('#total_card_sales').text(formatNumberInIndianFormat(parseFloat(response.total_card_sales).toFixed(2)));
                    $('#total_due_sales').text(formatNumberInIndianFormat(parseFloat(response.total_due_sales).toFixed(2)));
                    $('#total_petty_cash').text(formatNumberInIndianFormat(parseFloat(response.total_petty_cash).toFixed(2)));
                }, 1000);
            },
            error: function() {
                $('.loader_div').hide();
                alert("Error fetching service details");
            }
        });
    }

    function calculateProductDashbaordCounts() {
        $('.loader_div').show();
        $('#low_stock_product_count').text(parseInt('0.00'));
        $('#high_stock_product_count').text(parseInt('0.00'));
        $.ajax({
            url: BASE_URL + "salon/Ajax_controller/get_dashboard_product_counts_ajx",
            method: 'POST',
            data: {
                from_date: '',
                to_date: ''
            },
            success: function(data) {
                setTimeout(function() {
                    $('.loader_div').hide();
                    var response = JSON.parse(data);
                    $('#low_stock_product_count').text(parseInt(response.low_stock_product_count));
                    $('#high_stock_product_count').text(parseInt(response.high_stock_product_count));
                }, 1000);
            },
            error: function() {
                $('.loader_div').hide();
                alert("Error fetching service details");
            }
        });
    }

    // Calendar JS Start
    function showServiceDetailsDiv(id) {
        $.ajax({
            url: BASE_URL + "salon/Ajax_controller/get_booking_service_details_ajx",
            method: 'POST',
            data: {
                booking_service_details_id: id,
                redirect: window.location.href
            },
            success: function(response) {
                $('#booking_details_response').html(response)
                showPopup('myModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching booking details:', error);
                alert("Error fetching booking details");
            }
        });
    }

    function showBookingDetailsDiv(id) {
        $.ajax({
            url: BASE_URL + "salon/Ajax_controller/get_booking_details_ajx",
            method: 'POST',
            data: {
                booking_id: id,
                redirect: window.location.href
            },
            success: function(response) {
                $('#booking_details_response').html(response)
                showPopup('myModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching booking details:', error);
                alert("Error fetching booking details");
            }
        });
    }

    function showBookingNotesDivCalendar(event, id) {
        event.stopPropagation();
        $.ajax({
            url: BASE_URL + "salon/Ajax_controller/get_booking_note_ajx",
            method: 'POST',
            data: {
                booking_id: id
            },
            success: function(response) {
                $('#booking_note_response').html(response)
                showPopup('bookingNoteModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching booking details:', error);
                alert("Error fetching booking details");
            }
        });
    }

    function showBookingNotesDiv(id) {
        $.ajax({
            url: BASE_URL + "salon/Ajax_controller/get_booking_note_ajx",
            method: 'POST',
            data: {
                booking_id: id
            },
            success: function(response) {
                $('#booking_note_response').html(response)
                showPopup('bookingNoteModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching booking details:', error);
                alert("Error fetching booking details");
            }
        });
    }

    function showBookingReviewDiv(id) {
        $.ajax({
            url: BASE_URL + "salon/Ajax_controller/get_booking_review_ajx",
            method: 'POST',
            data: {
                booking_review_id: id
            },
            success: function(response) {
                $('#booking_review_response').html(response)
                showPopup('BookingReviewModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching booking details:', error);
                alert("Error fetching booking details");
            }
        });
    }

    function showBookingReviewDivCalender(event, id) {
        event.stopPropagation();
        $.ajax({
            url: BASE_URL + "salon/Ajax_controller/get_booking_review_ajx",
            method: 'POST',
            data: {
                booking_review_id: id
            },
            success: function(response) {
                $('#booking_review_response').html(response)
                showPopup('BookingReviewModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching booking details:', error);
                alert("Error fetching booking details");
            }
        });
    }

    function showReschedulePopup(id) {
        $.ajax({
            url: BASE_URL + "salon/Ajax_controller/show_service_reschedule_popup_ajx",
            method: 'POST',
            data: {
                booking_service_details_id: id
            },
            success: function(response) {
                $('#reschedule_details_response').html(response)
                showPopup('ServiceRescheduleModal');
            },
            error: function() {
                alert("Error fetching service details");
            }
        });
    }

    function rescheduleService(id) {
        var service_date = $('#service_date_' + id).val();
        var service_executive = $('#service_executive_' + id).val();
        var service_stylist_timeslot_hidden = $('#service_stylist_timeslot_hidden_' + id).val();
        if (service_executive != '') {
            $('#service_executive_error_' + id).hide();
            $('#service_executive_error_' + id).text('');
            if (service_date != '') {
                $('#service_date_error_' + id).hide();
                $('#service_date_error_' + id).text('');
                // if (confirm("Are you sure you want to proceed?")) {
                openConfirmationDialog("Are you sure you want to proceed?", function(confirmed) {
                    if (confirmed) {
                        $('.loader_div').show();
                        $.ajax({
                            url: BASE_URL + "salon/Ajax_controller/reschedule_service_ajx",
                            method: 'POST',
                            data: {
                                booking_service_details_id: id,
                                service_date: service_date,
                                service_executive: service_executive,
                                service_stylist_timeslot_hidden: service_stylist_timeslot_hidden,
                            },
                            success: function(response) {
                                setTimeout(function() {
                                    $('.loader_div').hide();
                                    if (response === '1') {
                                        closePopup('ServiceRescheduleModal');
                                        $('#reschedule_btn_div').html('')
                                        showServiceDetailsDiv(id);
                                        initCalendar();
                                    }
                                }, 2000);
                            },
                            error: function() {
                                alert("Error fetching service details");
                            }
                        });
                    }
                });
            } else {
                $('#service_date_error_' + id).show();
                $('#service_date_error_' + id).text('Please select date!');
            }
        } else {
            $('#service_executive_error_' + id).show();
            $('#service_executive_error_' + id).text('Please select stylist!');
        }
    }

    function showCancelPopupCalender(event, id) {
        event.stopPropagation();
        $.ajax({
            url: BASE_URL + "salon/Ajax_controller/show_service_cancel_popup_ajx",
            method: 'POST',
            data: {
                booking_service_details_id: '',
                booking_id: id
            },
            success: function(response) {
                $('#cancel_details_response').html(response)
                showPopup('ServiceCancelModal');
                cancelService(id);
            },
            error: function() {
                alert("Error fetching service details");
            }
        });
    }

    function showCancelPopup(id) {
        $.ajax({
            url: BASE_URL + "salon/Ajax_controller/show_service_cancel_popup_ajx",
            method: 'POST',
            data: {
                booking_service_details_id: '',
                booking_id: id
            },
            success: function(response) {
                $('#cancel_details_response').html(response)
                showPopup('ServiceCancelModal');
                cancelService(id);
            },
            error: function() {
                alert("Error fetching service details");
            }
        });
    }
    function showBillUpdatePopupCalender(event,id) {
        event.stopPropagation();
        $.ajax({
            url: BASE_URL + "salon/Ajax_controller/show_bill_update_popup_ajx",
            method: 'POST',
            data: {
                booking_id: id
            },
            success: function(response) {
                $('#update_bill_response').html(response)
                showPopup('updateBillModal');
            },
            error: function() {
                alert("Error fetching booking details");
            }
        });
    }
    function showBillUpdatePopup(id) {
        $.ajax({
            url: BASE_URL + "salon/Ajax_controller/show_bill_update_popup_ajx",
            method: 'POST',
            data: {
                booking_id: id
            },
            success: function(response) {
                $('#update_bill_response').html(response)
                showPopup('updateBillModal');
            },
            error: function() {
                alert("Error fetching booking details");
            }
        });
    }

    function cancelService(id) {
        var remark = $('#remark_' + id).val();
        var checkedServices = [];
        $('.service_details_checkboxes:checked').each(function() {
            checkedServices.push($(this).val());
        });
        if (checkedServices.length > 0) {
            $('#remark_error_' + id).text('');
            if (confirm("Are you sure you want to cancel the Appointment?")) {
            // openConfirmationDialog("Are you sure you want to cancel the Appointment?", function(confirmed) {
                var confirmed = true;
                if (confirmed) {
                    $('.loader_div').show();
                    $.ajax({
                        url: BASE_URL + "salon/Ajax_controller/cancel_service_ajx",
                        method: 'POST',
                        data: {
                            booking_id: id,
                            remark: remark,
                            services_to_cancel: checkedServices
                        },
                        success: function(response) {
                            setTimeout(function() {
                                $('.loader_div').hide();
                                if (response === '1') {
                                    closePopup('ServiceCancelModal');
                                    $('#cancel_btn_div').html('')
                                    // showBookingDetailsDiv(id);
                                    initCalendar();
                                }
                            }, 2000);
                        },
                        error: function() {
                            alert("Error fetching service details");
                        }
                    });
                }
            }else{
                closePopup('ServiceCancelModal');
            }
        } else {
            $('#remark_error_' + id).text('Please select atleast one service!');
        }
    }

    function completeService(id) {
        if (confirm("Are you sure the Appointment is Complete?")) {
        // openConfirmationDialog("Are you sure the Appointment is Complete?", function(confirmed) {
            $('.loader_div').show();
            $.ajax({
                url: BASE_URL + "salon/Ajax_controller/complete_service_ajx",
                method: 'POST',
                data: {
                    booking_id: id
                },
                success: function(response) {
                    if (response === '1') {
                        var encodedId = btoa(id);
                        window.location.href = BASE_URL + 'bill-setup/' + encodedId;
                    }
                    // setTimeout(function() {
                    //     $('.loader_div').hide();
                    //     if (response === '1') {
                    //         closePopup('ServiceCompleteModal');
                    //         $('#payment_btn_div').html('-');
                    //         initCalendar();

                    //         var encodedId = btoa(id);
                    //         window.location.href = BASE_URL + 'bill-setup/' + encodedId;
                    //     }
                    // }, 2000);
                },
                error: function() {
                    alert("Error fetching service details");
                }
            });
        }else{
            closePopup('ServiceCompleteModal');
        }
    }

    function showCompletePopupCalender(event, id) {
        event.stopPropagation();
        $.ajax({
            url: BASE_URL + "salon/Ajax_controller/show_service_complete_popup_ajx",
            method: 'POST',
            data: {
                booking_id: id
            },
            success: function(response) {
                $('#complete_details_response').html(response)
                showPopup('ServiceCompleteModal');
                completeService(id);
            },
            error: function() {
                alert("Error fetching service details");
            }
        });
    }

    function showCompletePopup(id) {
        $.ajax({
            url: BASE_URL + "salon/Ajax_controller/show_service_complete_popup_ajx",
            method: 'POST',
            data: {
                booking_id: id
            },
            success: function(response) {
                $('#complete_details_response').html(response)
                showPopup('ServiceCompleteModal');
                completeService(id);
            },
            error: function() {
                alert("Error fetching service details");
            }
        });
    }

    function showAddServicePopupCalender(event, id) {
        event.stopPropagation();
        $.ajax({
            url: BASE_URL + "salon/Ajax_controller/show_add_service_popup_ajx",
            method: 'POST',
            data: {
                booking_service_details_id: '',
                booking_id: id
            },
            success: function(response) {
                $('#add_service_response').html(response)
                showPopup('addServiceModal');
            },
            error: function() {
                alert("Error fetching service details");
            }
        });
    }

    function showAddServicePopup(id) {
        $.ajax({
            url: BASE_URL + "salon/Ajax_controller/show_add_service_popup_ajx",
            method: 'POST',
            data: {
                booking_service_details_id: '',
                booking_id: id
            },
            success: function(response) {
                $('#add_service_response').html(response)
                showPopup('addServiceModal');
            },
            error: function() {
                alert("Error fetching service details");
            }
        });
    }

    function appendSlotsDiv(booking_details_id, append_to_ID, duration) {
        var date = $('#service_date_' + booking_details_id).val();

        $("#service_executive_div_" + booking_details_id).hide();
        $("#service_executive_" + booking_details_id).val('');

        $.ajax({
            type: "POST",
            url: BASE_URL + "salon/Ajax_controller/get_stylist_reschedule_timeslots_updated_ajx",
            data: {
                'date': date,
                'duration': duration,
                'booking_details_id': booking_details_id
            },
            success: function(data) {
                $("#" + append_to_ID).html('');
                $("#" + append_to_ID).append(data);
            },
        });
    }

    function setStylist(radioButton, booking_details_id) {
        var selectedTimeSlot = $(radioButton).val();
        if (selectedTimeSlot !== "" && typeof selectedTimeSlot !== "undefined") {
            $.ajax({
                type: "POST",
                url: BASE_URL + "salon/Ajax_controller/get_available_stylists_servicewise_reschedule_ajx",
                data: {
                    'booking_details_id': booking_details_id,
                    'selectedTimeSlot': selectedTimeSlot
                },
                success: function(data) {
                    $("#service_executive_" + booking_details_id).chosen();
                    $("#service_executive_" + booking_details_id).val('');
                    var stylists = $.parseJSON(data);
                    if (stylists.length > 0) {
                        $("#service_executive_" + booking_details_id).empty();
                        $("#service_executive_" + booking_details_id).append('<option value="">Select Executive</option>');
                        var opts = $.parseJSON(data);
                        var count = 1;
                        // console.log(opts)
                        $.each(opts, function(i, d) {
                            is_service_available = d.is_service_available;
                            is_shift_available = d.is_shift_available;
                            is_booking_present = d.is_booking_present;
                            is_customer_booking_present = d.is_customer_booking_present;
                            is_on_break = d.is_on_break;
                            short_break_flag = d.short_break_flag;

                            if (is_service_available == '1') {
                                if (is_shift_available == '1') {
                                    if (is_booking_present == '0') {
                                        if (is_customer_booking_present == '0') {
                                            var message = '';
                                            var disabled = '';
                                            var is_Allowed = 1;
                                            if (count == 1) {
                                                var selected = 'selected';
                                            }
                                        } else {
                                            var message = '- Customer Service Present';
                                            // var message = '- Not Available';
                                            var disabled = 'disabled';
                                            var is_Allowed = 0;
                                        }
                                    } else {
                                        var message = '- Slot Already Booked';
                                        // var message = '- Not Available';
                                        var disabled = 'disabled';
                                        var is_Allowed = 0;
                                    }
                                } else {
                                    if (is_on_break == '1') {
                                        var message = '- Stylist On Break';
                                        var disabled = 'disabled';
                                        var is_Allowed = 0;
                                    } else {
                                        var message = '- Shift Not Available';
                                        var disabled = 'disabled';
                                        var is_Allowed = 0;
                                    }
                                }

                                if (is_Allowed == 1 && disabled != 'disabled') {
                                    if(short_break_flag == '1'){
                                        if (count == 1) {
                                            var selected = 'selected';
                                            count++;
                                        } else {
                                            var selected = '';
                                        }
                                    }else{
                                        var message = '- Stylist On Short Break';
                                        var disabled = 'disabled';
                                    }
                                } else {
                                    var selected = '';
                                }

                                if (rules_employee_selection == '2') {
                                    selected = '';
                                }

                                $("#service_executive_" + booking_details_id).append('<option ' + disabled + ' ' + selected + ' value="' + d.stylist_details.id + '">' + d.stylist_details.full_name + ' ' + message + '</option>');
                            } else {
                                var disabled = 'disabled';
                                var message = '- Stylist Not Available';
                            }
                        });
                        $("#service_executive_" + booking_details_id).trigger('chosen:updated');
                        $("#service_executive_div_" + booking_details_id).show();
                    } else {
                        $("#service_executive_" + booking_details_id + "_chosen").hide();
                        $("#service_executive_" + booking_details_id).hide();
                        $("#service_executive_div_" + booking_details_id).append('<label style="font-size:10px;" class="error">Please, first set Stylist designation employees.</label>');
                        $("#service_executive_div_" + booking_details_id).show();
                    }
                },
            });
        }
    }
    
    function openReceiptLink(event, bookingId, bookingDetailsId) {
        event.stopPropagation();
        var url = BASE_URL + "booking-print/" + bookingId + "/" + bookingDetailsId;
        window.open(url, '_blank');
    }

    function openEditLink(event, bookingId, dateTimeString, customer) {
        event.stopPropagation();
        var url = BASE_URL + 'add-new-booking-new?start=' + dateTimeString + '&booking_id= ' + bookingId + '&customer= ' + customer + '';
        window.open(url, '_blank');
    }

    

    function showBookingEditPopup(id) {
        $.ajax({
            url: BASE_URL + "salon/Ajax_controller/get_booking_edit_details_ajx",
            method: 'POST',
            data: {
                booking_id: id
            },
            success: function(response) {                
                var encodedId = btoa(id);
                window.location.href = BASE_URL + 'reschedule/' + encodedId;
                // $('#booking_edit_response').html(response)
                // showPopup('BookingEditModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching booking details:', error);
                alert("Error fetching booking details");
            }
        });
    }

    function showBookingEditPopupFromEvent(event, id) {
        event.stopPropagation();
        $.ajax({
            url: BASE_URL + "salon/Ajax_controller/get_booking_edit_details_ajx",
            method: 'POST',
            data: {
                booking_id: id
            },
            success: function(response) {
                var encodedId = btoa(id);
                window.location.href = BASE_URL + 'reschedule/' + encodedId;
                // $('#booking_edit_response').html(response)
                // showPopup('BookingEditModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching booking details:', error);
                alert("Error fetching booking details");
            }
        });
    }

    function showBillGenerationPopupCalendar(event, id) {
        event.stopPropagation();
        $.ajax({
            url: BASE_URL + "salon/Ajax_controller/get_booking_bill_generation_details_ajx",
            method: 'POST',
            data: {
                booking_id: id
            },
            success: function(response) {
                $('#booking_bill_generation_response').html(response)
                showPopup('BookingBillModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching booking details:', error);
                alert("Error fetching booking details");
            }
        });
    }

    function showBillGenerationPopup(id) {
        $.ajax({
            url: BASE_URL + "salon/Ajax_controller/get_booking_bill_generation_details_ajx",
            method: 'POST',
            data: {
                booking_id: id
            },
            success: function(response) {
                $('#booking_bill_generation_response').html(response)
                showPopup('BookingBillModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching booking details:', error);
                alert("Error fetching booking details");
            }
        });
    }

    function setServicePrice(serviceDetailsID, bookingID) {
        var service_price = parseFloat($('#single_service_price_' + serviceDetailsID).val());
        var service_rewards = $('#service_rewards_hidden_' + serviceDetailsID).val();
        var current_total = parseFloat($('#total_service_amount_' + bookingID).val());
        var selected_coupon_id = parseFloat($('#selected_coupon_id_' + bookingID).val());
        var is_giftcard_applied = parseFloat($('#is_giftcard_applied_' + bookingID).val());
        var applied_giftcard_id = parseFloat($('#applied_giftcard_id_' + bookingID).val());

        if ($('#service_checkbox_' + serviceDetailsID).is(':checked')) {
            $(".product_checkbox_" + serviceDetailsID).attr('disabled', false);

            current_total = current_total + service_price;

            var tempArray = [];

            $(".product_checkbox_" + serviceDetailsID).each(function() {
                $(this).prop('checked', true);
                tempArray.push($(this).val());
            });

            for (var i = 0; i < tempArray.length; i++) {
                setServiceProductPrice(serviceDetailsID, tempArray[i], bookingID);
            }
        } else {
            $(".product_checkbox_" + serviceDetailsID).attr('disabled', true);

            current_total = current_total - service_price;

            var tempArray = [];
            $(".product_checkbox_" + serviceDetailsID).each(function() {
                if ($(this).prop('checked')) {
                    $(this).prop('checked', false);
                    tempArray.push($(this).val());
                }
            });

            for (var i = 0; i < tempArray.length; i++) {
                setServiceProductPrice(serviceDetailsID, tempArray[i], bookingID);
            }

            if (selected_coupon_id != '' && selected_coupon_id != "0") {
                removeCoupon(bookingID, selected_coupon_id, 'prev');
            }

            if (is_giftcard_applied == '1' && applied_giftcard_id != '' && applied_giftcard_id != "0") {
                removeGiftCard(bookingID);
            }
        }
        $('#total_service_amount_' + bookingID).val(parseFloat(current_total).toFixed(2));
        $('#total_service_amount_text_' + bookingID).text(parseFloat(current_total).toFixed(2));

        setPayableServiceAmount(bookingID);
    }

    function setServiceProductPrice(serviceDetailsID, productDetailsID, bookingID) {
        var product_price = parseFloat($('#single_service_product_price_' + serviceDetailsID + '_' + productDetailsID).val());
        var current_total = parseFloat($('#total_product_amount_' + bookingID).val());
        var selected_product = parseInt($('#selected_product_' + serviceDetailsID).text());
        var selected_coupon_id = parseFloat($('#selected_coupon_id_' + bookingID).val());
        var is_giftcard_applied = parseFloat($('#is_giftcard_applied_' + bookingID).val());
        var applied_giftcard_id = parseFloat($('#applied_giftcard_id_' + bookingID).val());

        if ($('#service_products_checkbox_' + serviceDetailsID + '_' + productDetailsID).is(':checked')) {
            current_total = current_total + product_price;
            selected_product = selected_product + 1;
        } else {
            current_total = current_total - product_price;
            selected_product = selected_product - 1;

            if (selected_coupon_id != '' && selected_coupon_id != "0") {
                removeCoupon(bookingID, selected_coupon_id, 'prev');
            }

            if (is_giftcard_applied == '1' && applied_giftcard_id != '' && applied_giftcard_id != "0") {
                removeGiftCard(bookingID);
            }
        }
        $('#total_product_amount_' + bookingID).val(parseFloat(current_total).toFixed(2));
        $('#total_product_amount_text_' + bookingID).text(parseFloat(current_total).toFixed(2));
        $('#selected_product_' + serviceDetailsID).text(parseInt(selected_product));

        setPayableServiceProductAmount(bookingID);
    }

    function setPayableServiceAmount(bookingID) {
        giftcard_discount = parseFloat($('#gift_discount_' + bookingID).val());
        member_service_discount = $('#m_service_discount_' + bookingID).val();
        membership_discount_type = parseFloat($('#membership_discount_type_' + bookingID).val());

        if (typeof member_service_discount === 'undefined' || member_service_discount === '') {
            member_service_discount = 0;
        } else {
            member_service_discount = parseFloat(member_service_discount);
        }

        total_service_amount = parseFloat($('#total_service_amount_' + bookingID).val());

        if (membership_discount_type == '0') {
            discount = (total_service_amount * member_service_discount) / 100;
        } else if (membership_discount_type == '1') {
            discount = member_service_discount;
        } else {
            discount = 0;
        }

        if (total_service_amount == 0) {
            discount = 0;
        }

        $('#m_service_discount_amount_' + bookingID).val(parseFloat(discount).toFixed(2));

        payable = total_service_amount - discount - giftcard_discount;

        $('#service_payable_hidden_' + bookingID).val(parseFloat(payable).toFixed(2));

        $('#service_payable_text_' + bookingID).text(parseFloat(payable).toFixed(2));

        setPayableAmount(bookingID);
    }

    function setPayableServiceProductAmount(bookingID) {
        member_product_discount = $('#m_product_discount_' + bookingID).val();
        membership_discount_type = parseFloat($('#membership_discount_type_' + bookingID).val());

        if (typeof member_product_discount === 'undefined' || member_product_discount === '') {
            member_product_discount = 0;
        } else {
            member_product_discount = parseFloat(member_product_discount);
        }

        total_product_amount = parseFloat($('#total_product_amount_' + bookingID).val());

        if (membership_discount_type == '0') {
            discount = (total_product_amount * member_product_discount) / 100;
        } else if (membership_discount_type == '1') {
            discount = member_product_discount;
        } else {
            discount = 0;
        }

        if (total_product_amount == 0) {
            discount = 0;
        }

        $('#m_product_discount_amount_' + bookingID).val(parseFloat(discount).toFixed(2));

        payable = total_product_amount - discount;

        $('#product_payable_hidden_' + bookingID).val(parseFloat(payable).toFixed(2));

        $('#product_payable_text_' + bookingID).html(parseFloat(payable).toFixed(2));

        setPayableAmount(bookingID);
    }

    function setPayableAmount(bookingID) {
        service_payable = parseFloat($('#service_payable_hidden_' + bookingID).val());
        product_payable = parseFloat($('#product_payable_hidden_' + bookingID).val());
        package_payable = parseFloat($('#package_amount_' + bookingID).val());
        membership_payable = parseFloat($('#membership_payment_amount_' + bookingID).val());

        payable = service_payable + product_payable + package_payable + membership_payable;

        $('#payable_hidden_' + bookingID).val(parseFloat(payable).toFixed(2));

        setBookingAmount(bookingID);
    }


    function setBookingAmount(bookingID) {
        calculateTotalDiscount(bookingID);

        coupon_discount = parseFloat($('#coupon_discount_amount_' + bookingID).val());
        reward_discount = parseFloat($('#reward_discount_amount_' + bookingID).val());
        payable = parseFloat($('#payable_hidden_' + bookingID).val());

        booking = payable - coupon_discount - reward_discount;

        $('#booking_amount_hidden_' + bookingID).val(parseFloat(booking).toFixed(2));
        $('#booking_amount_' + bookingID).text(parseFloat(booking).toFixed(2));

        setGST(bookingID);
    }

    function setGST(bookingID) {
        rate = 18;
        booking_amount = parseFloat($('#booking_amount_hidden_' + bookingID).val());

        gst_amount = (rate * booking_amount) / 100;

        $('#gst_amount_hidden_' + bookingID).val(parseFloat(gst_amount).toFixed(2));
        $('#gst_amount_' + bookingID).text(parseFloat(gst_amount).toFixed(2));

        setGrandTotal(bookingID);
    }

    function setGrandTotal(bookingID) {
        booking_amount = parseFloat($('#booking_amount_hidden_' + bookingID).val());
        gst_amount = parseFloat($('#gst_amount_hidden_' + bookingID).val());
        customer_pending_amount = parseFloat($('#customer_pending_amount_' + bookingID).val());

        total = booking_amount + gst_amount;

        allowed_max = total + customer_pending_amount;
        $('#total_due_' + bookingID).text(parseFloat(allowed_max).toFixed(2));

        $('#paid_amount_' + bookingID).val(parseFloat(allowed_max).toFixed(2)).attr('max', parseFloat(allowed_max).toFixed(2));
        $('#grand_total_hidden_' + bookingID).val(parseFloat(total).toFixed(2));
        $('#grand_total_' + bookingID).text(parseFloat(total).toFixed(2));

        calculatePendingAmount(bookingID);
    }

    function calculatePendingAmount(bookingID) {
        grand_total = parseFloat($('#grand_total_hidden_' + bookingID).val()) || 0;
        paid_amount = parseFloat($('#paid_amount_' + bookingID).val()) || 0;
        customer_pending_amount = parseFloat($('#customer_pending_amount_' + bookingID).val()) || 0;

        pending_now = (grand_total + customer_pending_amount) - paid_amount;

        $('#pending_amount_' + bookingID).val(parseFloat(pending_now).toFixed(2));
    }

    function calculateTotalDiscount(bookingID) {
        $('#discount_details_div_' + bookingID).html('');
        var membership_service_discount_amount = parseFloat($('#m_service_discount_amount_' + bookingID).val());
        var membership_product_discount_amount = parseFloat($('#m_product_discount_amount_' + bookingID).val());
        var coupon_discount_amount = parseFloat($('#coupon_discount_amount_' + bookingID).val());
        var giftcard_discount_amount = parseFloat($('#gift_discount_' + bookingID).val());
        var reward_discount_amount = parseFloat($('#reward_discount_amount_' + bookingID).val());

        total_discount = membership_service_discount_amount + membership_product_discount_amount + coupon_discount_amount + giftcard_discount_amount + reward_discount_amount;
        $('#discount_amount_' + bookingID).text(parseFloat(total_discount).toFixed(2));
        $('#total_discount_hidden_' + bookingID).val(parseFloat(total_discount).toFixed(2));

        var discount_details = '<div id="discount_details_info"><i class="fas fa-info-circle" style="color:#008ec8;"></i>';
        discount_details += '<div class="discount-tooltip">';
        if (membership_service_discount_amount > 0) {
            discount_details += '<p>Membership Service Discount <span class="amount" style="float: right;">' + membership_service_discount_amount.toFixed(2) + '</span></p>';
        }
        if (membership_product_discount_amount > 0) {
            discount_details += '<p>Membership Product Discount <span class="amount" style="float: right;">' + membership_product_discount_amount.toFixed(2) + '</span></p>';
        }
        if (coupon_discount_amount > 0) {
            discount_details += '<p>Coupon Discount <span class="amount" style="float: right;">' + coupon_discount_amount.toFixed(2) + '</span></p>';
        }
        if (giftcard_discount_amount > 0) {
            discount_details += '<p>Gift Card Discount <span class="amount" style="float: right;">' + giftcard_discount_amount.toFixed(2) + '</span></p>';
        }
        if (reward_discount_amount > 0) {
            discount_details += '<p>Reward Discount <span class="amount" style="float: right;">' + reward_discount_amount.toFixed(2) + '</span></p>';
        }
        discount_details += '<div style="border-top:1px solid #ccc;margin-top:1px;"><p>Total Discount <span class="amount" style="float: right;">' + total_discount.toFixed(2) + '</span></p></div>'; // Add total discount here
        discount_details += '</div></div>';
        if (total_discount > 0) {
            $('#discount_details_div_' + bookingID).html(discount_details);
        }
    }

    function applyCoupon(bookingID, couponId, type) {
        $('.loader_div').show();
        setTimeout(function() {
            $('#coupon_error_' + bookingID + '_' + couponId).html('');
            var coupon_expiry = $('#coupon_expiry_' + bookingID + '_' + couponId).val();
            var coupon_min_price = parseFloat($('#coupon_min_price_' + bookingID + '_' + couponId).val());
            var coupon_offers = parseFloat($('#coupon_offers_' + bookingID + '_' + couponId).val());
            var coupon_name = $('#coupon_name_' + bookingID + '_' + couponId).val();

            var payable = parseFloat($('#payable_hidden_' + bookingID).val());
            var selected_package_id = $('#package_id_' + bookingID).val();
            var is_giftcard_applied = $('#is_giftcard_applied_' + bookingID).val();

            if (selected_package_id == "") {
                if (is_giftcard_applied == "0" || is_giftcard_applied == "") {
                    var currentDate = new Date();
                    var yyyy = currentDate.getFullYear();
                    var mm = String(currentDate.getMonth() + 1).padStart(2, '0');
                    var dd = String(currentDate.getDate()).padStart(2, '0');
                    var todayDate = yyyy + '-' + mm + '-' + dd;

                    if (payable >= coupon_min_price) {
                        if (todayDate <= coupon_expiry) {
                            expiry_flag = 0;
                        } else {
                            if (type == 'previous') {
                                expiry_flag = 0;
                            } else {
                                expiry_flag = 1;
                            }
                        }
                        if (expiry_flag == 0) {
                            var previousCouponId = $('#package_id_' + bookingID).val();
                            if (previousCouponId !== '') {
                                removeCoupon(bookingID, previousCouponId, 'prev');
                            }
                            $('.loader_div').show();

                            $('#coupon_discount_amount_' + bookingID).val(parseFloat(coupon_offers).toFixed(2));
                            $('#selected_coupon_id_' + bookingID).val(couponId);

                            coupon_div = $('#coupon_button_' + bookingID + '_' + couponId);

                            coupon_div.html('');

                            // new_coupon_div = '<button class="btn btn-warning" type="button" onclick="if(confirm(\'Are you sure you want to remove the coupon?\')) { removeCoupon(' + bookingID + ',' + couponId + ',\'new\'); }" style="font-size:10px; padding:5px 12px;" data-toggle="tooltip" data-placement="top" title="Remove Coupon">Remove</button>';
                            new_coupon_div = '<button class="btn btn-warning" type="button" onclick="openConfirmationDialog(\'Are you sure you want to remove the coupon?\', function(confirmed) { if (confirmed) { removeCoupon(' + bookingID + ',' + couponId + ',\'new\'); } })" style="font-size:10px; padding:5px 12px;" data-toggle="tooltip" data-placement="top" title="Remove Coupon">Remove</button>';

                            coupon_div.html(new_coupon_div);

                            $('.loader_div').hide();
                        } else {
                            if (type == 'previous') {
                                $('#coupon_error_' + bookingID + '_' + couponId).html('');
                                $('#coupon_discount_amount_' + bookingID).val(parseFloat(0.00).toFixed(2));
                                $('#selected_coupon_id_' + bookingID).val('');
                            }
                            $('.loader_div').hide();
                            // alert('Coupon code is expired');
                            openDialog('Coupon code is expired');
                        }
                    } else {
                        $('.loader_div').hide();
                        if (type == 'previous') {
                            $('#coupon_error_' + bookingID + '_' + couponId).html('');
                            $('#coupon_discount_amount_' + bookingID).val(parseFloat(0.00).toFixed(2));
                            $('#selected_coupon_id_' + bookingID).val('');
                            // alert('Previously applied coupon ' + coupon_name + ' not applicable now as Minimum Payable amount require: Rs.'+coupon_min_price);
                            openDialog('Previously applied coupon ' + coupon_name + ' not applicable now as Minimum Payable amount require: Rs.' + coupon_min_price);
                        } else {
                            // alert('Coupon ' + coupon_name + ' not applicable. Minimum Payable amount require: Rs.'+coupon_min_price);
                            openDialog('Coupon ' + coupon_name + ' not applicable. Minimum Payable amount require: Rs.' + coupon_min_price);
                        }
                    }
                } else {
                    $('.loader_div').hide();
                    // alert('Coupon code not applicable on applied giftcard');
                    openDialog('Coupon code not applicable on applied giftcard');
                }
            } else {
                $('.loader_div').hide();
                // alert('Coupon code not applicable if package is selected');
                openDialog('Coupon code not applicable if package is selected');
            }
            setBookingAmount(bookingID);
        }, 1500);
    }

    function removeCoupon(bookingID, couponId, type) {
        $('.loader_div').show();
        setTimeout(function() {
            $('#coupon_error_' + bookingID + '_' + couponId).html('');
            $('#coupon_discount_amount_' + bookingID).val(parseFloat(0.00).toFixed(2));
            if (type === 'new') {
                $('#selected_coupon_id_' + bookingID).val('');
            }

            coupon_div = $('#coupon_button_' + bookingID + '_' + couponId);
            coupon_div.html('');
            new_coupon_div =
                '<button class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="applyCoupon(' + bookingID + ',' + couponId + ')">Apply</button>\
        ';
            coupon_div.html(new_coupon_div);

            setBookingAmount(bookingID);

            $('.loader_div').hide();
        }, 1500);
    }

    function applyGiftCard(bookingID, type) {
        $('.loader_div').show();
        setTimeout(function() {
            $('#giftcard_error_' + bookingID).hide();
            var selected_package_id = $('#package_id_' + bookingID).val();
            var selected_coupon_id = $('#selected_coupon_id_' + bookingID).val();
            var customer = $('#customer_id_' + bookingID).val();

            var booking_services = [];

            $('.booking_services_' + bookingID + ':checked').each(function() {
                var selected_service_id = $('#single_service_id_' + $(this).val()).val();
                var details_id = $(this).val();

                var serviceDetails = {
                    service_id: selected_service_id,
                    details_id: details_id
                };

                booking_services.push(serviceDetails);
            });
            var code = $('#giftcard_no_' + bookingID).val();
            if (selected_package_id == "") {
                if (selected_coupon_id == "") {
                    if (code != "") {
                        if (booking_services.length > 0) {
                            $.ajax({
                                type: "POST",
                                url: BASE_URL + "salon/Ajax_controller/check_giftcard_ajx",
                                data: {
                                    'code': code,
                                    'customer': customer,
                                    'services': booking_services,
                                    'booking_id': bookingID
                                },
                                success: function(data) {
                                    $('.loader_div').hide();
                                    $('#is_giftcard_applied_' + bookingID).val('0');
                                    $('#applied_giftcard_id_' + bookingID).val('');
                                    var opts = $.parseJSON(data);

                                    is_valid = opts.is_valid;
                                    is_customer_used = opts.is_customer_used;
                                    giftcard_services = opts.giftcard_services;
                                    custom_array = opts.custom_array;
                                    giftcard_id = opts.giftcard_id;

                                    total_giftcard_discount = 0;

                                    if (is_valid == '1') {
                                        const onlyServiceIds = booking_services.map(item => item.service_id);
                                        const hasMatchingService = onlyServiceIds.some(id => giftcard_services.includes(id));
                                        if (hasMatchingService) {
                                            if (is_customer_used == '0') {
                                                if (!$.isEmptyObject(custom_array)) {
                                                    $('#giftcard_error_' + bookingID).hide();
                                                    $('#giftcard_error_' + bookingID).html('');

                                                    $('#giftcard_remove_button_' + bookingID).show();
                                                    $('#giftcard_button_' + bookingID).hide();
                                                    $('#giftcard_no_' + bookingID).prop('disabled', true);

                                                    $.each(custom_array, function(i, d) {
                                                        var service = parseInt(d.service, 10);
                                                        for (l = 0; l < booking_services.length; l++) {
                                                            if (d.service == booking_services[l].service_id) {
                                                                service_price = parseFloat($('#single_service_price_' + booking_services[l].details_id).val());
                                                                discount = parseFloat(d.discount);
                                                                if (d.discount_in == '0') {
                                                                    discount = discount * service_price;
                                                                }

                                                                total_giftcard_discount = total_giftcard_discount + discount;
                                                            }
                                                        }
                                                    });
                                                    $('#gift_discount_' + bookingID).val(parseFloat(total_giftcard_discount).toFixed(2));
                                                    $('#is_giftcard_applied_' + bookingID).val('1');
                                                    $('#applied_giftcard_id_' + bookingID).val(giftcard_id);

                                                    $('#giftcard_success_' + bookingID).html('Giftcard applied successfully');
                                                    $('#giftcard_success_' + bookingID).show();

                                                    setPayableServiceAmount(bookingID);
                                                } else {
                                                    $('#giftcard_error_' + bookingID).html('Invalid Giftcard no');
                                                    $('#giftcard_error_' + bookingID).show();
                                                    $('#giftcard_success_' + bookingID).html('');
                                                    $('#giftcard_success_' + bookingID).hide();
                                                    $('#giftcard_no_' + bookingID).val('');

                                                    setTimeout(function() {
                                                        $('#giftcard_error_' + bookingID).hide();
                                                    }, 4000);
                                                }
                                            } else {
                                                $('#giftcard_error_' + bookingID).html('Customer has used it before');
                                                $('#giftcard_error_' + bookingID).show();
                                                $('#giftcard_success_' + bookingID).html('');
                                                $('#giftcard_success_' + bookingID).hide();
                                                $('#giftcard_no_' + bookingID).val('');

                                                setTimeout(function() {
                                                    $('#giftcard_error_' + bookingID).hide();
                                                }, 4000);
                                            }
                                        } else {
                                            if (type == 'previous') {
                                                $('#giftcard_error_' + bookingID).html('Previously applied giftcard is not applicable now, as available services not allowed for this Gift Card');
                                            } else {
                                                $('#giftcard_error_' + bookingID).html('Selected Services not allowed for applied Gift Card');
                                            }
                                            $('#giftcard_error_' + bookingID).show();
                                            $('#giftcard_success_' + bookingID).html('');
                                            $('#giftcard_success_' + bookingID).hide();
                                            $('#giftcard_no_' + bookingID).val('');

                                            setTimeout(function() {
                                                $('#giftcard_error_' + bookingID).hide();
                                            }, 4000);
                                        }
                                    } else {
                                        $('#giftcard_error_' + bookingID).html('Invalid Giftcard no');
                                        $('#giftcard_error_' + bookingID).show();
                                        $('#giftcard_success_' + bookingID).html('');
                                        $('#giftcard_success_' + bookingID).hide();
                                        $('#giftcard_no_' + bookingID).val('');

                                        setTimeout(function() {
                                            $('#giftcard_error_' + bookingID).hide();
                                        }, 4000);
                                    }
                                },
                            });
                        } else {
                            $('.loader_div').hide();
                            // alert('Please select services');
                            openDialog('Please select services');
                            $('#giftcard_no_' + bookingID).val('');
                        }
                    } else {
                        $('.loader_div').hide();
                        // alert('Please enter giftcard no');
                        openDialog('Please enter giftcard no');
                        $('#giftcard_no_' + bookingID).val('');
                    }
                } else {
                    $('.loader_div').hide();
                    // alert('Giftcard not applicable on applied coupon');
                    openDialog('Giftcard not applicable on applied coupon');
                    $('#giftcard_no_' + bookingID).val('');
                }
            } else {
                $('.loader_div').hide();
                // alert('Giftcard not applicable on packages');
                openDialog('Giftcard not applicable on packages');
                $('#giftcard_no_' + bookingID).val('');
            }
        }, 1500);
    }

    function removeGiftCard(bookingID) {
        $('.loader_div').show();
        setTimeout(function() {
            $('#giftcard_error_' + bookingID).html('');
            $('#giftcard_error_' + bookingID).hide();
            $('#giftcard_success_' + bookingID).html('');
            $('#giftcard_success_' + bookingID).hide();

            $('#gift_discount_' + bookingID).val(parseFloat(0.00).toFixed(2));
            $('#is_giftcard_applied_' + bookingID).val('0');
            $('#applied_giftcard_id_' + bookingID).val('');
            $('#giftcard_no_' + bookingID).val('');

            $('#giftcard_remove_button_' + bookingID).hide();
            $('#giftcard_button_' + bookingID).show();
            $('#giftcard_no_' + bookingID).prop('disabled', false);
            setPayableServiceAmount(bookingID);
            $('.loader_div').hide();
        }, 1500);
    }

    function applyRewards(bookingID) {
        $('.loader_div').show();
        setTimeout(function() {
            var customer_reward_available = parseInt($('#customer_reward_available_' + bookingID).val());
            var customer_gender = $('#customer_gender_' + bookingID).val();
            var total_value = 0;

            $.ajax({
                type: "POST",
                url: BASE_URL + "salon/Ajax_controller/get_reward_setup_ajx",
                data: {
                    'gender': customer_gender
                },
                success: function(data) {
                    var opts = $.parseJSON(data);
                    if (!$.isEmptyObject(opts)) {
                        rs_per_reward = opts.rs_per_reward;
                        reward_point = opts.reward_point;
                        minimum_reward_required = parseInt(opts.minimum_reward_required);
                        maximum_reward_required = opts.maximum_reward_required;

                        payableHidden = parseFloat($('#payable_hidden_' + bookingID).val());

                        if (payableHidden > 0) {
                            if (customer_reward_available >= minimum_reward_required) {
                                if (customer_reward_available > maximum_reward_required) {
                                    available_rewards = maximum_reward_required;
                                } else {
                                    available_rewards = customer_reward_available;
                                }

                                consider_rewards = available_rewards / reward_point;
                                total_value = consider_rewards * rs_per_reward;

                                $('#reward_discount_amount_' + bookingID).val(parseFloat(total_value).toFixed(2));
                                $('#used_rewards_' + bookingID).val(available_rewards);
                                $('#customer_rewards_text_' + bookingID).html('');
                                $('#customer_rewards_text_' + bookingID).html('Rewards Balance: <s>' + customer_reward_available + '</s> ' + (customer_reward_available - available_rewards) + '<br>Discount: Rs.' + parseFloat(total_value).toFixed(2));
                                $('#used_rewards_msg_' + bookingID).html('<label style="color:green;font-size:10px;">' + available_rewards + ' Rewards used</label>');

                                setBookingAmount(bookingID);

                                $('#rewards_button_' + bookingID).hide();
                                $('#rewards_remove_button_' + bookingID).show();
                            } else {
                                // alert('Minimum reward points required are: '+ minimum_reward_required);
                                openDialog('Minimum reward points required are: ' + minimum_reward_required);
                            }
                        } else {
                            // alert('Total amount is not valid.');
                            openDialog('Total amount is not valid.');
                        }
                        $('.loader_div').hide();
                    }
                },
            });
        }, 1500);
    }

    function removeRewards(bookingID) {
        $('.loader_div').show();
        setTimeout(function() {
            var customer_reward_available = parseInt($('#customer_reward_available_' + bookingID).val());
            $('#reward_discount_amount_' + bookingID).val(parseFloat(0).toFixed(2));
            $('#used_rewards_' + bookingID).val(0);
            $('#customer_rewards_text_' + bookingID).html('');
            $('#customer_rewards_text_' + bookingID).html('Rewards Balance: ' + customer_reward_available);
            $('#used_rewards_msg_' + bookingID).html('');

            setBookingAmount(bookingID);

            $('#rewards_button_' + bookingID).show();
            $('#rewards_remove_button_' + bookingID).hide();

            $('.loader_div').hide();
        }, 1500);
    }

    function checkArraysMatch(array1, array2) {
        return $.grep(array1, function(value1) {
            return $.grep(array2, function(value2) {
                return value1 === value2;
            }).length > 0;
        }).length > 0;
    }
    // End    
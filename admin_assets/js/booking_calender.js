function showcurrent_week() {
  get_all_week_day_name();
  $('.cc_bb_week_name').fadeIn();
  $('.cc_bb_week_detail').fadeIn();
  $('.cc_bb_today').fadeOut();
  $('.cc_bb_month_name').fadeOut();
  $('.cc_bb_month_detail').fadeOut();
  $('#btn_week').css('background-color', 'black');
  $('#btn_day').css('background-color', '#2c3e50');
  $('#btn_month').css('background-color', '#2c3e50');
  $('#calender_status').val(7);

  var currentDate = new Date();
  var startDate = new Date(currentDate);
  startDate.setDate(currentDate.getDate() - currentDate.getDay());
  var endDate = new Date(currentDate);
  endDate.setDate(currentDate.getDate() + (6 - currentDate.getDay()));
  var options = { month: 'short', day: 'numeric' };
  var opti = {day: 'numeric' };
  var formattedStartDate = startDate.toLocaleDateString('en-US', options);
  var week_start = startDate.toLocaleDateString('en-US', opti);
  var formattedEndDate = endDate.toLocaleDateString('en-US', options);
  var formattedWeekRange = formattedStartDate + ' – ' + formattedEndDate + ', ' + currentDate.getFullYear();
  $('.currentDate_php').text(formattedWeekRange);
  get_all_week_day_name(week_start);

}

function showcurrent_day() {
  $('.cc_bb_week_name').fadeOut();
  $('.cc_bb_week_detail').fadeOut();
  $('.cc_bb_month_name').fadeOut();
  $('.cc_bb_month_detail').fadeOut();
  $('.cc_bb_today').fadeIn();
  $('#btn_day').css('background-color', 'black');
  $('#btn_week').css('background-color', '#2c3e50');
  $('#btn_month').css('background-color', '#2c3e50');
  $('#calender_status').val(1);

  var currentDate = new Date();
  var options = { year: 'numeric', month: 'long', day: 'numeric' };
  var formattedDate = currentDate.toLocaleDateString('en-US', options);
  $('.currentDate_php').text(formattedDate);
}



function show_past_day() {

  var calender_status = $('#calender_status').val();
  $('#next_btn').css('background-color', '#2c3e50');
  $('#past_btn').css('background-color', 'black');
  if (calender_status == 1) {
    var cc_date = parseInt($('#current_date').val(), 10);
    $('.cc_bb_week_name').fadeOut();
    $('.cc_bb_week_detail').fadeOut();
    $('.cc_bb_month_name').fadeOut();
    $('.cc_bb_month_detail').fadeOut();
    $('.cc_bb_today').fadeIn();
    $('#next_btn').css('background-color', '#2c3e50');
    $('#btn_week').css('background-color', '#2c3e50');
    $('#btn_month').css('background-color', '#2c3e50');

    var currentDateString = $('#dummy_t_date').val();
    var parts = currentDateString.split("/");
    var currentDate = new Date(parts[2], parts[1] - 1, parts[0]);
    var oneDayAgo = new Date(currentDate);
    oneDayAgo.setDate(currentDate.getDate() - 1);

    var formattedOneDayAgo = oneDayAgo.getDate().toString().padStart(2, '0') + '/' + (oneDayAgo.getMonth() + 1).toString().padStart(2, '0') + '/' + oneDayAgo.getFullYear();
    $('#dummy_t_date').val(formattedOneDayAgo);
    var options = { day: 'numeric', month: 'long', year: 'numeric' }; 
    var formattedCurrentDate = oneDayAgo.toLocaleDateString('en-US', options);
    $('.currentDate_php').text(formattedCurrentDate);

  }
  else if (calender_status == 7) {
    var week_status = parseInt($('#week_status').val());
    var count_week = parseInt(week_status) - parseInt(7);
    $('#week_status').val(count_week);

    $('.cc_bb_week_name').fadeIn();
    $('.cc_bb_week_detail').fadeIn();
    $('.cc_bb_today').fadeOut();
    $('.cc_bb_month_name').fadeOut();
    $('.cc_bb_month_detail').fadeOut();
    $('#btn_week').css('background-color', 'black');
    $('#btn_day').css('background-color', '#2c3e50');
    $('#btn_month').css('background-color', '#2c3e50');
    $('#calender_status').val(7);

    var currentDate = new Date();
    var nextWeekStartDate = new Date(currentDate);
    nextWeekStartDate.setDate(currentDate.getDate() + count_week);
    var nextWeekEndDate = new Date(nextWeekStartDate);
    nextWeekEndDate.setDate(nextWeekStartDate.getDate() + 6);

    var options = { month: 'short', day: 'numeric' };
    var opti = {day: 'numeric' };
    var week_start = nextWeekStartDate.toLocaleDateString('en-US', opti);
    var formattedStartDate = nextWeekStartDate.toLocaleDateString('en-US', options);
    var formattedEndDate = nextWeekEndDate.toLocaleDateString('en-US', options);
    var formattedWeekRange = formattedStartDate + ' – ' + formattedEndDate + ', ' + nextWeekStartDate.getFullYear();
    $('.currentDate_php').text(formattedWeekRange);
    get_all_week_day_name(week_start);

  }
  else if (calender_status == 30) {
    var month_status = parseInt($('#month_status').val());
    var count_month = parseInt(month_status) - parseInt(1);
    $('#month_status').val(count_month);

    $('.cc_bb_week_name').fadeOut();
    $('.cc_bb_week_detail').fadeOut();
    $('.cc_bb_today').fadeOut();
    $('.cc_bb_month_name').fadeIn();
    $('.cc_bb_month_detail').fadeIn();
    $('.cc_bb_month_detail').empty();
    $('#btn_day').css('background-color', '#2c3e50');
    $('#btn_week').css('background-color', '#2c3e50');
    $('#btn_month').css('background-color', 'black');
    $('#calender_status').val(30);

    var currentDate = new Date();
    currentDate.setMonth(currentDate.getMonth() + count_month);

    var options = { month: 'long', year: 'numeric' };
    var formattedDate = currentDate.toLocaleDateString('en-US', options);
    $('.currentDate_php').text(formattedDate);

  var currentDate = new Date();
  var opt = { month: 'numeric',day: 'numeric', year: 'numeric'};
  var todaydate = currentDate.toLocaleDateString('en-US', opt);

    var currentDate = new Date();
    currentDate.setMonth(currentDate.getMonth() + count_month);
    currentDate.setDate(1);

    var lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);

    var lastDayOfMonth = lastDay.getDate();

  get_all_week_day_name_for_month(currentDate,lastDay,todaydate);

  $('.cc_bb_month_detail').append('<div class="current_month_date_detail">\
                                      <div class="">'+ lastDayOfMonth + '</div>\
                                    </div>');

  }
}

function show_next_day() {
  $('#next_btn').css('background-color', 'black');
  $('#past_btn').css('background-color', '#2c3e50');
  var calender_status = $('#calender_status').val();
  if (calender_status == 1) {
    var cc_date = $('#current_date').val();
    $('.cc_bb_week_name').fadeOut();
    $('.cc_bb_week_detail').fadeOut();
    $('.cc_bb_month_name').fadeOut();
    $('.cc_bb_month_detail').fadeOut();
    $('.cc_bb_today').fadeIn();
    $('#btn_day').css('background-color', 'black');
    $('#btn_week').css('background-color', '#2c3e50');
    $('#btn_month').css('background-color', '#2c3e50');

    var currentDateString = $('#dummy_t_date').val();
    var parts = currentDateString.split("/");
    var currentDate = new Date(parts[2], parts[1] - 1, parts[0]);
    var oneDayAgo = new Date(currentDate);
    oneDayAgo.setDate(currentDate.getDate() + 1);

    var formattedOneDayAgo = oneDayAgo.getDate().toString().padStart(2, '0') + '/' + (oneDayAgo.getMonth() + 1).toString().padStart(2, '0') + '/' + oneDayAgo.getFullYear();
    $('#dummy_t_date').val(formattedOneDayAgo);
    var options = { day: 'numeric', month: 'long', year: 'numeric' }; 
    var formattedCurrentDate = oneDayAgo.toLocaleDateString('en-US', options);
    $('.currentDate_php').text(formattedCurrentDate);
    // get_week_day_name(formattedDate,fff);

  }
  else if (calender_status == 7) {
    var week_status = parseInt($('#week_status').val());
    var count_week = parseInt(week_status) + parseInt(7);
    $('#week_status').val(count_week);

    // $('.cc_bb_week_name').empty();
    $('.cc_bb_week_name').fadeIn();
    $('.cc_bb_week_detail').fadeIn();
    $('.cc_bb_today').fadeOut();
    $('.cc_bb_month_name').fadeOut();
    $('.cc_bb_month_detail').fadeOut();
    $('#btn_week').css('background-color', 'black');
    $('#btn_day').css('background-color', '#2c3e50');
    $('#btn_month').css('background-color', '#2c3e50');
    $('#calender_status').val(7);

    var currentDate = new Date();
    var nextWeekStartDate = new Date(currentDate);
    nextWeekStartDate.setDate(currentDate.getDate() + count_week);
    var nextWeekEndDate = new Date(nextWeekStartDate);
    nextWeekEndDate.setDate(nextWeekStartDate.getDate() + 6);

    var options = { month: 'short', day: 'numeric' };
    var opti = {day: 'numeric' };
    var week_start = nextWeekStartDate.toLocaleDateString('en-US', opti);
    var formattedStartDate = nextWeekStartDate.toLocaleDateString('en-US', options);
    var formattedEndDate = nextWeekEndDate.toLocaleDateString('en-US', options);
    var formattedWeekRange = formattedStartDate + ' – ' + formattedEndDate + ', ' + nextWeekStartDate.getFullYear();
    $('.currentDate_php').text(formattedWeekRange);
    get_all_week_day_name(week_start);

  }
  else if (calender_status == 30) {
    var month_status = parseInt($('#month_status').val());
    var count_month = parseInt(month_status) + parseInt(1);
    $('#month_status').val(count_month);

    $('.cc_bb_week_name').fadeOut();
    $('.cc_bb_week_detail').fadeOut();
    $('.cc_bb_today').fadeOut();
    $('.cc_bb_month_name').fadeIn();
    $('.cc_bb_month_detail').fadeIn();
    $('.cc_bb_month_detail').empty();
    $('#btn_day').css('background-color', '#2c3e50');
    $('#btn_week').css('background-color', '#2c3e50');
    $('#btn_month').css('background-color', 'black');
    $('#calender_status').val(30);

    var currentDate = new Date();
    currentDate.setMonth(currentDate.getMonth() + count_month);

    var options = { month: 'long', year: 'numeric' };
    var formattedDate = currentDate.toLocaleDateString('en-US', options);
    $('.currentDate_php').text(formattedDate);

    var currentDate = new Date();
    var opt = {month: 'numeric',day: 'numeric', year: 'numeric'};
    var todaydate = currentDate.toLocaleDateString('en-US', opt);

    var currentDate = new Date();
    currentDate.setMonth(currentDate.getMonth() + count_month);
    currentDate.setDate(1);

    var lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);

    var lastDayOfMonth = lastDay.getDate();

  get_all_week_day_name_for_month(currentDate,lastDay,todaydate);

  $('.cc_bb_month_detail').append('<div class="current_month_date_detail">\
                                      <div class="">'+ lastDayOfMonth + '</div>\
                                    </div>');

  }
}

function get_current_day_value() {
  var currentDate = new Date();
  currentDate.setDate(currentDate.getDate());
  var opt_opt = { day: 'numeric' };
  var current_day = currentDate.toLocaleDateString('en-US', opt_opt);
  return (current_day);
}

function get_all_week_day_name(start_week) {
  $('.cc_bb_week_name').empty();
  $('.cc_bb_week_name').append('<div class="current_week_name">\
                                    <div class="">Time</div>\
                                  </div>');
  var daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
  var currentDate = new Date();
  var currentDayIndex = currentDate.getDay();
  for (var i = 0; i < daysOfWeek.length; i++,start_week++) {
    if (currentDayIndex == i) {
      $('.cc_bb_week_name').append('<div class="current_week_name" style="background-color: #fffadf;">\
                                      <div class="">'+daysOfWeek[i] + '</div>\
                                    </div>');
    } else {
      $('.cc_bb_week_name').append('<div class="current_week_name">\
                                      <div class="">'+ daysOfWeek[i] + '</div>\
                                    </div>');
    }
  }
}

function count_week_index(format_week) {
  var daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
  for (var i = 0; i < daysOfWeek.length; i++) {
    if (format_week == daysOfWeek[i]) {
      return (i);
    }
  }
}

 
// function show_selected_date(day){
//   $('.cc_bb_week_name').fadeOut();
//   $('.cc_bb_week_detail').fadeOut();
//   $('.cc_bb_month_name').fadeOut();
//   $('.cc_bb_month_detail').fadeOut();
//   $('.cc_bb_today').fadeIn();
//   $('#btn_day').css('background-color', 'black');
//   $('#btn_week').css('background-color', '#2c3e50');
//   $('#btn_month').css('background-color', '#2c3e50');
//   $('#calender_status').val(1);

//   var currentDate = new Date();
//   var options = { year: 'numeric', month: 'long', day: 'numeric' };
//   var formattedDate = currentDate.toLocaleDateString('en-US', options);
//   $('.currentDate_php').text(formattedDate);
// }




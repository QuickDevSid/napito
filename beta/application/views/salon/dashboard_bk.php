function showcurrent_week() {
  get_all_week_day_name();
  $('.cc_bb_week_name').show();
  $('.cc_bb_week_detail').show();
  $('.cc_bb_today').hide();
  $('.cc_bb_month_name').hide();
  $('.cc_bb_month_detail').hide();
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
  var formattedStartDate = startDate.toLocaleDateString('en-US', options);
  var formattedEndDate = endDate.toLocaleDateString('en-US', options);
  var formattedWeekRange = formattedStartDate + ' – ' + formattedEndDate + ', ' + currentDate.getFullYear();
  $('.currentDate_php').text(formattedWeekRange);

}

function showcurrent_day() {
  $('.cc_bb_week_name').hide();
  $('.cc_bb_week_detail').hide();
  $('.cc_bb_month_name').hide();
  $('.cc_bb_month_detail').hide();
  $('.cc_bb_today').show();
  $('#btn_day').css('background-color', 'black');
  $('#btn_week').css('background-color', '#2c3e50');
  $('#btn_month').css('background-color', '#2c3e50');
  $('#calender_status').val(1);

  var currentDate = new Date();
  var options = { year: 'numeric', month: 'long', day: 'numeric' };
  var formattedDate = currentDate.toLocaleDateString('en-US', options);
  $('.currentDate_php').text(formattedDate);
}

function showcurrent_month() {

  $('.cc_bb_week_name').hide();
  $('.cc_bb_week_detail').hide();
  $('.cc_bb_today').hide();
  $('.cc_bb_month_name').show();
  $('.cc_bb_month_detail').show();
  $('.cc_bb_month_detail').empty();
  $('#btn_day').css('background-color', '#2c3e50');
  $('#btn_week').css('background-color', '#2c3e50');
  $('#btn_month').css('background-color', 'black');
  $('#calender_status').val(30);
  

  var currentDate = new Date();
  var opt = { month: 'long', year: 'numeric' };
  var formattedDate = currentDate.toLocaleDateString('en-US', opt);
  $('.currentDate_php').text(formattedDate);

  var currentDate = new Date();
  var opt = {day: 'numeric'};
  var todaydate = currentDate.toLocaleDateString('en-US', opt);

  var currentDate = new Date();
  currentDate.setDate(1);
  var lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);

  get_all_week_day_name_for_month(currentDate,lastDay,todaydate);

  // while (currentDate <= lastDay) {
  //   var options = { day: 'numeric' };
  //   var formattedDay = currentDate.toLocaleDateString('en-US', options);
  //   if(todaydate != formattedDay){
  //   $('.cc_bb_month_detail').append('<div class="current_month_date_detail">\
  //                                       <div class="">'+ formattedDay +'</div>\
  //                                     </div>');
  //   }else{
  //     $('.cc_bb_month_detail').append('<div class="current_month_date_detail" style="background-color: #fffadf;color: black;">\
  //                                       <div>'+ formattedDay +'</div>\
  //                                     </div>');
  //   }
  //   currentDate.setDate(currentDate.getDate() + 1);
  // }
}

function show_past_day() {
  var calender_status = $('#calender_status').val();
  $('#next_btn').css('background-color', '#2c3e50');
  $('#past_btn').css('background-color', 'black');
  if (calender_status == 1) {
    var cc_date = parseInt($('#current_date').val(), 10);
    $('.cc_bb_week_name').hide();
    $('.cc_bb_week_detail').hide();
    $('.cc_bb_month_name').hide();
    $('.cc_bb_month_detail').hide();
    $('.cc_bb_today').show();
    $('#next_btn').css('background-color', '#2c3e50');
    $('#btn_week').css('background-color', '#2c3e50');
    $('#btn_month').css('background-color', '#2c3e50');


    var currentDate = new Date();

    currentDate.setDate(currentDate.getDate() - 1);
    var opt = { day: 'numeric' };
    var format_date = currentDate.toLocaleDateString('en-US', opt);

    var current_day = get_current_day_value();

    var ttt = parseFloat(cc_date) + parseFloat(format_date);
    var fff = parseFloat(ttt) - parseFloat(current_day)

    var options = { year: 'numeric', month: 'long', fff: 'numeric' };
    var formattedDate = currentDate.toLocaleDateString('en-US', options);
    $('.currentDate_php').text(fff + ' ' + formattedDate);
    $('#current_date').val(parseFloat(fff));

  }
  else if (calender_status == 7) {
    var week_status = parseInt($('#week_status').val());
    var count_week = parseInt(week_status) - parseInt(7);
    $('#week_status').val(count_week);

    $('.cc_bb_week_name').show();
    $('.cc_bb_week_detail').show();
    $('.cc_bb_today').hide();
    $('.cc_bb_month_name').hide();
    $('.cc_bb_month_detail').hide();
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
    var formattedStartDate = nextWeekStartDate.toLocaleDateString('en-US', options);
    var formattedEndDate = nextWeekEndDate.toLocaleDateString('en-US', options);
    var formattedWeekRange = formattedStartDate + ' – ' + formattedEndDate + ', ' + nextWeekStartDate.getFullYear();
    $('.currentDate_php').text(formattedWeekRange);

  }
  else if (calender_status == 30) {
    var month_status = parseInt($('#month_status').val());
    var count_month = parseInt(month_status) - parseInt(1);
    $('#month_status').val(count_month);

    $('.cc_bb_week_name').hide();
    $('.cc_bb_week_detail').hide();
    $('.cc_bb_today').hide();
    $('.cc_bb_month_name').show();
    $('.cc_bb_month_detail').show();
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
    currentDate.setMonth(currentDate.getMonth() + count_month);
    currentDate.setDate(1);

    var lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);

    while (currentDate <= lastDay) {
      var options = { day: 'numeric' };
      var formattedDay = currentDate.toLocaleDateString('en-US', options);

      $('.cc_bb_month_detail').append('<div class="current_month_date_detail">\
                                             <div class="">' + formattedDay + '</div>\
                                             </div>');

      currentDate.setDate(currentDate.getDate() + 1);
    }

  }
}

function show_next_day() {
  $('#next_btn').css('background-color', 'black');
  $('#past_btn').css('background-color', '#2c3e50');
  var calender_status = $('#calender_status').val();
  if (calender_status == 1) {
    var cc_date = $('#current_date').val();
    $('.cc_bb_week_name').hide();
    $('.cc_bb_week_detail').hide();
    $('.cc_bb_month_name').hide();
    $('.cc_bb_month_detail').hide();
    $('.cc_bb_today').show();
    $('#btn_day').css('background-color', 'black');
    $('#btn_week').css('background-color', '#2c3e50');
    $('#btn_month').css('background-color', '#2c3e50');

    var currentDate = new Date();
    currentDate.setDate(currentDate.getDate() + 1);

    var options = { day: 'numeric' };
    var format_date = currentDate.toLocaleDateString('en-US', options);

    var current_day = get_current_day_value();

    var ttt = parseFloat(cc_date) + parseFloat(format_date);
    var fff = parseFloat(ttt) - parseFloat(current_day)

    var options = { year: 'numeric', month: 'long' };
    var formattedDate = currentDate.toLocaleDateString('en-US', options);

    $('.currentDate_php').text(fff + ' ' + formattedDate);
    $('#current_date').val(parseFloat(fff));
    // get_week_day_name(formattedDate,fff);

  }
  else if (calender_status == 7) {
    var week_status = parseInt($('#week_status').val());
    var count_week = parseInt(week_status) + parseInt(7);
    $('#week_status').val(count_week);

    $('.cc_bb_week_name').show();
    $('.cc_bb_week_detail').show();
    $('.cc_bb_today').hide();
    $('.cc_bb_month_name').hide();
    $('.cc_bb_month_detail').hide();
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
    var formattedStartDate = nextWeekStartDate.toLocaleDateString('en-US', options);
    var formattedEndDate = nextWeekEndDate.toLocaleDateString('en-US', options);
    var formattedWeekRange = formattedStartDate + ' – ' + formattedEndDate + ', ' + nextWeekStartDate.getFullYear();
    $('.currentDate_php').text(formattedWeekRange);

  }
  else if (calender_status == 30) {
    var month_status = parseInt($('#month_status').val());
    var count_month = parseInt(month_status) + parseInt(1);
    $('#month_status').val(count_month);

    $('.cc_bb_week_name').hide();
    $('.cc_bb_week_detail').hide();
    $('.cc_bb_today').hide();
    $('.cc_bb_month_name').show();
    $('.cc_bb_month_detail').show();
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
    var opt = {day: 'numeric'};
    var todaydate = currentDate.toLocaleDateString('en-US', opt);

    var currentDate = new Date();
    currentDate.setMonth(currentDate.getMonth() + count_month);
    currentDate.setDate(1);

    var lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);

    get_all_week_day_name_for_month(currentDate,lastDay,todaydate);

    // while (currentDate <= lastDay) {
    //   var options = { day: 'numeric' };
    //   var formattedDay = currentDate.toLocaleDateString('en-US', options);

    //   $('.cc_bb_month_detail').append('<div class="current_month_date_detail">\
    //                                         <div class="">' + formattedDay + '</div>\
    //                                         </div>');

    //   currentDate.setDate(currentDate.getDate() + 1);
    // }

  }
}

function get_current_day_value() {
  var currentDate = new Date();
  currentDate.setDate(currentDate.getDate());
  var opt_opt = { day: 'numeric' };
  var current_day = currentDate.toLocaleDateString('en-US', opt_opt);
  return (current_day);
}

function get_all_week_day_name() {
  $('.cc_bb_week_name').empty();
  $('.cc_bb_week_name').append('<div class="current_week_name">\
                                    <div class="">Time</div>\
                                  </div>');
  var daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
  var currentDate = new Date();
  var currentDayIndex = currentDate.getDay();
  for (var i = 0; i < daysOfWeek.length; i++) {
    if (currentDayIndex == i) {
      $('.cc_bb_week_name').append('<div class="current_week_name" style="background-color: #fffadf;">\
                                      <div class="">' + daysOfWeek[i] + '</div>\
                                    </div>');
    } else {
      $('.cc_bb_week_name').append('<div class="current_week_name">\
                                      <div class="">' + daysOfWeek[i] + '</div>\
                                    </div>');
    }
  }
}

function get_all_week_day_name_for_month(currentDate,lastDay,todaydate) {
  $('.cc_bb_month_name').empty();

  var daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
  for (var i = 0; i < daysOfWeek.length; i++) {

    $('.cc_bb_month_name').append('<div class="current_week_name_for_month">\
                                      <div class="">' + daysOfWeek[i] + '</div>\
                                    </div>');
  }

  // var currentDate = new Date();
  // var opt = { day: 'numeric' };
  // var todaydate = currentDate.toLocaleDateString('en-US', opt);

  // var currentDate = new Date();
  // currentDate.setDate(1);
  // var lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);

  while (currentDate <= lastDay) {
    console.log(currentDate);
    console.log(lastDay);
    var options = { day: 'numeric' };
    var opt_week = { weekday: 'long' };
    var formattedDay = currentDate.toLocaleDateString('en-US', options);
    var format_week = currentDate.toLocaleDateString('en-US', opt_week);
    var week_index = count_week_index(format_week);
    for (var j = 0; j < daysOfWeek.length; j++) {
      if (week_index == j) {
        if (todaydate != formattedDay) {
          $('.cc_bb_month_detail').append('<div class="current_month_date_detail">\
                                                <div class="">'+ formattedDay + '</div>\
                                              </div>');
                                              break;
        } else {
          $('.cc_bb_month_detail').append('<div class="current_month_date_detail" style="background-color: #fffadf;color: black;">\
                                                  <div>'+ formattedDay + '</div>\
                                                </div>');
                                                break;
        }
      }
      else if(formattedDay == 1 && formattedDay){
        $('.cc_bb_month_detail').append('<div class="current_month_date_detail">\
                                                  <div>------</div>\
                                                </div>');
                                                // break;

      }
    }
    currentDate.setDate(currentDate.getDate() + 1);
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




<?php

// Set your timezone!!
use website\EventList;

date_default_timezone_set('Europe/Berlin');

$timestamp = $this->timestamp;

//ISO-8601 numeric representation of the day of the week
$week_day_number = date('N', $timestamp) * 1;
$day_count = date('t', $timestamp);
$today = $this->today;
$current_date_ym = $_GET["ym"] ?? date("Y-m");

$titleMonth = $this->titleMonth;



$weeks = [];
$week = "";


//Last month days
$day_count_last_month = date('t', strtotime('-1 month', $timestamp)) * 1;
$last_month = date('Y-m', strtotime('-1 month', $timestamp));

for ($i = 1; $i <= ($week_day_number - 1); $i++) {
    $last_month_day_number = ($day_count_last_month - ($week_day_number - 1)) + $i;
    $last_month_date = $last_month . "-$last_month_day_number";
    $events = $this->render_quick_events($last_month_date);

    $week .= " <div class='day-content'>
                 <span class='day-number'>
                     <span class='badge'>$last_month_day_number</span>
                 </span>
                 <div class='month-week_events'>$events</div>
               </div>";
}

//$week_day_number = $week_day_number + 1;
for ($day = 1; $day <= $day_count; $day++, $week_day_number++) {
    $date_now = $current_date_ym . '-' . sprintf("%02d", $day);
    $current_month_day = $day == 1 ? $day . ". " . substr($titleMonth, 0, 3) : $day;
    $events = $this->render_quick_events($date_now);
//    $render_current_month_events = render_events($events, $date, $today);
    $active_class = $today == $date_now ? "active" : "inactive";


//print_p($date_now . "------" . $this->today);


    $week .= "<div class='day-content'>
                 <span class='day-number'>
                     <span class='badge $active_class'>$current_month_day</span>
                 </span>
                 <div class='month-week_events'>$events</div>
               </div>";

    // Sunday OR last day of the month
    if ($week_day_number % 7 == 0 || $day == $day_count) {

        // last day of the month
        if ($day == $day_count && $week_day_number % 7 != 0) {

            for ($j = 1; $j <= (7 - $week_day_number % 7); $j++) {
                $next_month = date('Y-m', strtotime('+1 month', $timestamp));
                $next_month_name = substr(date('F', strtotime('+1 month', $timestamp)), 0, 3);
                $next_month_day = $j == 1 ? $j . ". " . $next_month_name : $j;
                $next_month_date = $next_month . "-$next_month_day";
                $events = $this->render_quick_events($next_month_date);



                $week .= "<div class='day-content weekend'>
                 <span class='day-number'>
                     <span class='badge'>$next_month_day</span>
                 </span>
                 <div class='month-week_events'></div>
               </div>";
            }
        }

        $weeks[] = "<div class='month_week'>$week</div>";

        $week = '';
    }
}



$output_month_weeks = implode('', $weeks);

?>


<div class="month">
    <div class="month_day-names">
        <div><span class="month_day-name">Mon</span></div>
        <div><span class="month_day-name">Tue</span></div>
        <div><span class="month_day-name">Wed</span></div>
        <div><span class="month_day-name">Thu</span></div>
        <div><span class="month_day-name">Fri</span></div>
        <div><span class="month_day-name">Sat</span></div>
        <div><span class="month_day-name">Sun</span></div>
    </div>
        <?=$output_month_weeks?>
</div>




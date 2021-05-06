<?php

//googleカレンダーAPIから祝日を取得

$year = date("Y");

function getHolidays($year){
    
    $api_key = 'AIzaSyAt5KTiJE733ESlNqTYXSMs5FDfBZEU0nI';//
    $holidays = array();//祝日をいれる配列
    $holidays_id = 'japanese__ja@holiday.calendar.google.com';
    $url = sprintf(
        'https://www.googleapis.com/calendar/v3/calendars/%s/events?'.
		'key=%s&timeMin=%s&timeMax=%s&maxResults=%d&orderBy=startTime&singleEvents=true',
        $holidays_id,
        $api_key,
    );
}
?>
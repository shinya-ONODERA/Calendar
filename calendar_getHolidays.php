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
        $year.'-01-01T00:00:00Z' ,//取得開始日
        $year.'-12-31T00:00:00Z' ,//取得終了日
        150 //最大取得数
    );

    if($results = file_get_contents($url, true)){
        //file_get_conetents関数を使用
        //URLの中に情報が入っていれば（trueなら）以下を実行する
        $results = json_decode($results);
        //json形式で取得した情報を配列に格納
        foreach($results -> items as $item) {
            $date = strtotime((string) $item->start->date);
            $title = (string) $item->summary;
            $holidays[date('Y-m-d', $date)]= $title;
        }
        ksort($holidays);
        //祝日の配列の並び替え
        //ksort関数で配列をキーで逆順に（1月からの順にした）
    }
    return $holidays;
}
?>
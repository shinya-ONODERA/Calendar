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

function display_to_Holidays($date,$Holidays_array) {
    //第一引数は日付け"Y-m-d"型、第二引数には祝日の配列データ
    //display_to_Holidays("Y-m-d","Y-m-d")→引数１と引数２の日付が一致すればその日の祝日名を取得する
    if(array_key_exists($date,$Holidays_array)){
        //array_key_exists関数を使用
        //$dateが$Holidays_arrayに存在するか確認
        //各日付と祝日の配列データを照らし合わせる

        $holidays = "<br/>".$Holidays_array[$date];
        //祝日が見つかれば祝日名を$holidaysに入れておく
        return $holidays;
    }
}
//その日の祝日名を取得
?>
<?php
namespace App\Calendars\General;

use Carbon\Carbon;
// CarbonはLaravelで日付を扱う時に使うライブラリ
use Auth;

class CalendarView{

  private $carbon;
  function __construct($date){
    $this->carbon = new Carbon($date);
  }

// タイトル
  public function getTitle(){
    return $this->carbon->format('Y年n月');
  }

// カレンダーを出力する
  function render(){
    $html = [];
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table border">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th class="border">月</th>';
    $html[] = '<th class="border">火</th>';
    $html[] = '<th class="border">水</th>';
    $html[] = '<th class="border">木</th>';
    $html[] = '<th class="border">金</th>';
    $html[] = '<th class="border day-sat">土</th>';
    $html[] = '<th class="border day-sun">日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';

    $weeks = $this->getWeeks();

    foreach($weeks as $week){
      $html[] = '<tr class="'.$week->getClassName().'">';

      $days = $week->getDays();
      foreach($days as $day){
        $startDay = $this->carbon->copy()->format("Y-m-01");// 今月の初日 ("Y-m-01"の01がポイント)
        $toDay = $this->carbon->copy()->format("Y-m-d");// 今日の日付

        if($startDay <= $day->everyDay() && $toDay > $day->everyDay()){
          $html[] = '<td class="calendar-td past-day border '.$day->getClassName().'">';// past-dayで過去の日付をグレーアウトしてそう。
        }else{
          $html[] = '<td class="calendar-td border '.$day->getClassName().'">';
        }
        $html[] = $day->render();

        // 下記、条件の確認
        // authReserveDay()にeveryDay()があるか
        // →該当の日が予約日かどうか
        if(in_array($day->everyDay(), $day->authReserveDay())){
          $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
          if($reservePart == 1){
            $reservePart = "リモ1部";
          }else if($reservePart == 2){
            $reservePart = "リモ2部";
          }else if($reservePart == 3){
            $reservePart = "リモ3部";
          }
          // 下記、条件の確認
          // 該当日が月初よりも後で、今日よりも後の場合
          if($startDay <= $day->everyDay() && $toDay > $day->everyDay()){
            $html[] = '<p class="m-auto p-0 w-75 general_day" style="font-size:13px">'.$reservePart.'参加</p>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }else{
            $html[] = '<button type="submit" class="btn btn-danger p-0 w-75 reserve-modal-open" name="delete_date" style="font-size:12px" value="'. $day->authReserveDate($day->everyDay())->first()->setting_reserve .' " data-part= "'.$reservePart.'" reserve_date="'. $day->authReserveDate($day->everyDay())->first()->setting_reserve .'" reserve_part="'.$day->authReserveDate($day->everyDay())->first()->setting_part.'">'. $reservePart .'</button>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }
        // elseif条件追加
        // 該当の日が予約日でなく、月初よりも後で、今日よりも後の場合
        }elseif (!in_array($day->everyDay(), $day->authReserveDay()) && $startDay <= $day->everyDay() && $toDay > $day->everyDay()) {
          $html[] = '<p class="m-auto p-0 w-75 general_day" style="font-size:12px">受付終了</p>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
        }else{
          $html[] = $day->selectPart($day->everyDay());
        }
        $html[] = $day->getDate();
        $html[] = '</td>';
      }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    $html[] = '<form action="/reserve/calendar" method="post" id="reserveParts">'.csrf_field().'</form>';
    $html[] = '<form action="/delete/calendar" method="post" id="deleteParts">'.csrf_field().'</form>';

    return implode('', $html);
  } // --- function render() ---



  protected function getWeeks(){
    $weeks = [];

    // 初日
    $firstDay = $this->carbon->copy()->firstOfMonth();

    // 月末まで
    $lastDay = $this->carbon->copy()->lastOfMonth();

    // １週目
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;

    // 作業の日
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();

    // 月末までループさせる
    while($tmpDay->lte($lastDay)){
      // 週カレンダーviewを作成する
      $week = new CalendarWeek($tmpDay, count($weeks));
      $weeks[] = $week;

      // 1週ごとに+7日することで$tmpDayを翌週に移動する
      $tmpDay->addDay(7);
    }
    return $weeks;

    // $html[] ='<div id="reserve-modal modal">
    //          <p>予約日：'. $day->authReserveDate($day->everyDay())->first()->setting_reserve .'</p>
    //          <p>時間：'.$reservePart.'</p>
    //          <p>上記の予約をキャンセルしてもよろしいですか？</p>
    //          <button id="reserve-modal-close">閉じる</button>
    //          <button onclick="deletePost()">キャンセル</button>
    //           </div>';
  }


}

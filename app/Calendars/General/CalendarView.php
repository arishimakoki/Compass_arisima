<?php
namespace App\Calendars\General;

use Carbon\Carbon;
use Auth;

class CalendarView{

  private $carbon;
  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  public function getTitle(){
    return $this->carbon->format('Y年n月');
  }

  function render(){
    $html = [];
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th>土</th>';
    $html[] = '<th>日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';
    $weeks = $this->getWeeks();
    foreach($weeks as $week){
      $html[] = '<tr class="'.$week->getClassName().'">';

      $days = $week->getDays();
      foreach($days as $day){
        $startDay = $this->carbon->copy()->format("Y-m-01");
        $toDay = $this->carbon->copy()->format("Y-m-d");

        if($startDay <= $day->everyDay() && $toDay > $day->everyDay()){
          $html[] = '<td class="calendar-td" style="background-color:#ddd;>';
        }else{
          $html[] = '<td class="calendar-td '.$day->getClassName().'">';
        }
        $html[] = $day->render();

        if(in_array($day->everyDay(), $day->authReserveDay())){
          $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
          if($reservePart == 1){
            $reservePart = "リモ1部";
          }else if($reservePart == 2){
            $reservePart = "リモ2部";
          }else if($reservePart == 3){
            $reservePart = "リモ3部";
          }
          if($startDay <= $day->everyDay() && $toDay > $day->everyDay()){
          }else{
            $html[] = '<button type="submit" getPart="'.$day->authReserveDate($day->everyDay())->first()->setting_part.'" getDate="'.$day->authReserveDate($day->everyDay())->first()->setting_reserve.'" getDate_modal="'. $day->authReserveDate($day->everyDay())->first()->setting_reserve .'" getPart_modal="'.$reservePart .'"   class="delete-modal-open btn btn-danger p-0 w-75" name="delete_date" style="font-size:12px" value="'. $day->authReserveDate($day->everyDay())->first()->setting_reserve .'">'. $reservePart .'</button>';
            //$html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }
        }else{
          //$html[] = $day->selectPart($day->everyDay());
        }

         if($startDay <= $day->everyDay() && $toDay > $day->everyDay()){
          $html[] = "受付終了";
        }

        if($day->everyDay() && $toDay > $day->everyDay()){
          $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px"></p>';
          $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
        }else if(in_array($day->everyDay(), $day->authReserveDay())){
          //$html[] = $day->selectPart($day->everyDay());
          $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px"></p>';
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


    $html[] = '<div class="modal js-modal">';
    $html[] ='<div class="modal__bg js-modal-close"></div>';
    $html[] ='<div class="modal__content">';
    $html[] = '<form action= "'.route('deleteParts').'" method="post">';
    $html[] ='<div class="w-100">';

    $html[] = '<div class="modal-Date w-50 m-auto">';
    $html[] =  '<p type="text" name="getDate" class="w-100"></p>';
    $html[] = '</div>';
    $html[] ='<div class="modal-Part w-50 m-auto pt-3 pb-3">';
    $html[] = '<p name="getPart" class="w-100"></p>';
    $html[] =  '</div>';
    $html[] ='<div class="modal-text w-50 m-auto pt-3 pb-3">';
    $html[] = '<p>上記の予約をキャンセルしてもよろしいですか？</p>';
    $html[] =  '</div>';

    $html[] =  '<div class="w-50 m-auto edit-modal-btn d-flex">';
    $html[] =  '<a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>';
    $html[] =  '<input type="hidden" class="part-modal-hidden" name="getPart" value="">';
    $html[] =  '<input type="hidden" class="reserve-modal-hidden" name="getDate" value="">';

    $html[] =  '<button type="submit" class="btn btn-primary d-block" value="キャンセル">キャンセル</button>';

    $html[] ='</div>';
    $html[] = '</div>';
    $html[] = csrf_field();
    $html[] ='</form>';
    $html[] ='</div>';
    $html[] ='</div>';

    return implode('', $html);
  }

  protected function getWeeks(){
    $weeks = [];
    $firstDay = $this->carbon->copy()->firstOfMonth();
    $lastDay = $this->carbon->copy()->lastOfMonth();
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
    while($tmpDay->lte($lastDay)){
      $week = new CalendarWeek($tmpDay, count($weeks));
      $weeks[] = $week;
      $tmpDay->addDay(7);
    }
    return $weeks;
  }
}

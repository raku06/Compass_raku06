@extends('layouts.sidebar')

@section('content')
<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="border w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
    <div class="w-75 m-auto border" style="border-radius:5px;">

      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
        {!! $calendar->render() !!}
      </div>
    </div>
    <div class="text-right w-75 m-auto">
      <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
    </div>
  </div>
</div>



<div id="reserve-modal" class="modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
            <p>予約日：'. $day->authReserveDate($day->everyDay())->first()->setting_reserve .'</p>
            <p>時間：'.$reservePart.'</p>
            <p>上記の予約をキャンセルしてもよろしいですか？</p>
            <button id="reserve-modal-close">閉じる</button>
            <button onclick="deletePost()">キャンセル</button>
  </div>
</div>

<script>

             function deletePost() {
               // 削除処理を行う
             }
</script>
@endsection

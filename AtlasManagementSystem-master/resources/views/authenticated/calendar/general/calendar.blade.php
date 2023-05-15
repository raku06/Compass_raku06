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



<div class="modal reserve-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
            <p>予約日：<span class="reserve-date"></span></p>
            <input type="hidden" class="reserve_date" name="reserve_date" form="deleteParts">
            <p>時間： <span class="reserve-part"></p>
            <input type="hidden" class="reserve_part" name="reserve_part" form="deleteParts">
            <p>上記の予約をキャンセルしてもよろしいですか？</p>
            <button class="reserve-modal-close">閉じる</button>
            <div class="text-right w-75 m-auto">
              <input type="submit" class="btn btn-danger" value="キャンセル" form="deleteParts">
            </div>
  </div>
</div>
@endsection

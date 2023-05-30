@extends('layouts.sidebar')
@section('content')
<div class="w-100 vh-100 d-flex" style="align-items:center; justify-content:center;">
<div class="reserve_setting_outer pt-5 pb-5">
  <div class="w-100 m-auto  p-5 reserve_setting">
    <p class="calendar_title">{{ $calendar->getTitle() }}</p>
    {!! $calendar->render() !!}
    <div class="adjust-table-btn m-auto text-right">
      <input type="submit" class="btn btn-primary reserve_setting_btn" value="登録" form="reserveSetting" onclick="return confirm('登録してよろしいですか？')">
    </div>
  </div>
</div>
</div>
@endsection

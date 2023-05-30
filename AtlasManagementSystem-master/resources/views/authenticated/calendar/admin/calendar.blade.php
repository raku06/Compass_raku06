@extends('layouts.sidebar')

@section('content')
<div class=" pt-5 pb-5">
  <div class="m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF; box-shadow: 0 5px 10px 1px #d1d1d1; width:80%;" >
    <div class="w-75 m-auto">
      <p class="text-center" style="font-size:20px;" >{{ $calendar->getTitle() }}</p>
      <p>{!! $calendar->render() !!}</p>
    </div>
  </div>
</div>

@endsection

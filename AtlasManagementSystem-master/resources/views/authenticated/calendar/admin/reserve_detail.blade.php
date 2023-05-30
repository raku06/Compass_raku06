@extends('layouts.sidebar')

@section('content')
<div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="m-auto h-75 w-60">
    <p style="font-size:20px"><span>{{$date}}日</span><span class="ml-3">{{$part}}部</span></p>
    <div class=" reserve_detail">
      <table class="reserve_detail_table m-auto">
        <tr class="text-center">
          <th class="w-25">ID</th>
          <th class="w-25">名前</th>
          <th class="w-25">場所</th>
        </tr>
        @foreach($reservePersons as $reservePerson)
        @foreach($reservePerson->users as $user)
        <tr class="text-center reserve_person_box">
          <td class="w-25 reserve_person">{{$user->id}}</td>
          <td class="w-25 reserve_person">{{$user->over_name}}{{$user->under_name}}</td>
          <td class="w-25 reserve_person">リモート</td>
        </tr>
        @endforeach
        @endforeach
      </table>
    </div>
  </div>
</div>
@endsection

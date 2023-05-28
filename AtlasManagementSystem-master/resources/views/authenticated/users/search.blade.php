@extends('layouts.sidebar')

@section('content')
<div class="search_content w-100 d-flex">
  <div class="reserve_users_area">
    @foreach($users as $user)
    <div class=" one_person">
      <div class="one_person_inner">
        <span class="span_label">ID : </span><span>{{ $user->id }}</span>
      </div>
      <div>
        <span class="span_label">名前 : </span>
        <a href="{{ route('user.profile', ['id' => $user->id]) }}">
          <span>{{ $user->over_name }}</span>
          <span>{{ $user->under_name }}</span>
        </a>
      </div>
      <div class="one_person_inner">
        <span class="span_label">カナ : </span>
        <span>({{ $user->over_name_kana }}</span>
        <span>{{ $user->under_name_kana }})</span>
      </div>
      <div class="one_person_inner">
        @if($user->sex == 1)
        <span class="span_label">性別 : </span><span>男</span>
        @else
        <span class="span_label">性別 : </span><span>女</span>
        @endif
      </div>
      <div class="one_person_inner">
        <span class="span_label">生年月日 : </span><span>{{ $user->birth_day }}</span>
      </div>
      <div class="one_person_inner">
        @if($user->role == 1)
        <span class="span_label">権限 : </span><span>教師(国語)</span>
        @elseif($user->role == 2)
        <span class="span_label">権限 : </span><span>教師(数学)</span>
        @elseif($user->role == 3)
        <span class="span_label">権限 : </span><span>講師(英語)</span>
        @else
        <span class="span_label">権限 : </span><span>生徒</span>
        @endif
      </div>
      <div class="one_person_inner">
        @if($user->role == 4)
        <span class="span_label">選択科目 : </span>
        @foreach($user->subjects as $subject)
        <span>{{ $subject->subject }}</span>
        @endforeach
        @endif
      </div>
    </div>
    @endforeach
  </div>
  <div class="search_area w-25">
    <p class="search_text">検索</p>
    <div class="">
      <div>
        <input type="text" class="free_word" name="keyword" placeholder="キーワードを検索" form="userSearchRequest">
      </div>
      <div class="search_category_select_container">
        <lavel class="search_category_select_label">カテゴリ</lavel>
        <select class="search_category_select" form="userSearchRequest" name="category">
          <option class="option" value="name">名前</option>
          <option value="id">社員ID</option>
        </select>
      </div>
      <div class="search_category_select_container">
        <label class="search_category_select_label">並び替え</label>
        <select class="search_category_select" name="updown" form="userSearchRequest">
          <option value="ASC">昇順</option>
          <option value="DESC">降順</option>
        </select>
      </div>
      <div class="">
        <p class="search_conditions"><span>検索条件の追加</span><span class="search_conditions_arrow"></span></p>
        <div class="search_conditions_inner">
            <label class="search_category_select_label">性別</label>
          <div class="sex_box">
            <span>男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
            <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
          </div>
            <label class="search_category_select_label">権限</label>
          <div>
            <select name="role" form="userSearchRequest" class="engineer search_category_select">
              <option selected disabled>----</option>
              <option value="1">教師(国語)</option>
              <option value="2">教師(数学)</option>
              <option value="3">教師(英語)</option>
              <option value="4" class="">生徒</option>
            </select>
          </div>
            <label class="search_category_select_label">選択科目</label>
          <div class="selected_engineer">
            <div>
              <label>国語</label>
              <input type="checkbox" name="subject[]" value="1" form="userSearchRequest">
            </div>
            <div>
              <label>数学</label>
            <input type="checkbox" name="subject[]" value="2" form="userSearchRequest">
            </div>
            <div>
              <label>英語</label>
            <input type="checkbox" name="subject[]" value="3" form="userSearchRequest">
            </div>
          </div>
        </div>
      </div>
      <div>
        <input type="submit" name="search_btn" value="検索" form="userSearchRequest" class="search_submit">
      </div>
      <div>
        <input type="reset" value="リセット" form="userSearchRequest" class="search_reset_btn">
      </div>
    </div>
    <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
  </div>
</div>
@endsection

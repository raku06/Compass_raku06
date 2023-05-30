@extends('layouts.sidebar')

@section('content')
<div class="board_area w-100 border m-auto d-flex">
  <div class="post_view w-75 mt-5">
    <!-- <p class="w-75 m-auto">投稿一覧</p> -->
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3">
      <p class="posts-name"><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
      <p><a class="post_title" href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>
      <div class="post_bottom_area d-flex">
        <div class="d-flex post_status ">
          <div class="post_category">
            @foreach($post->subCategories as $sub_category)
            <p class="category_btn">{{$sub_category->sub_category}}</p>
           @endforeach
          </div>
          <div class="post_btn_box d-flex">
          <div class="mr-5">
            <p class="m-0"><i class="fa fa-comment"></i><span class="">{{$post_comment->commentCounts($post->id)->count()}}</span></p>
          </div>
          <div>
            @if(Auth::user()->is_Like($post->id))
            <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{$like->likeCounts($post->id)}}</span></p>
            @else
            <p class="m-0"><i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{$like->likeCounts($post->id)}}</span></p>
            @endif
          </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="other_area  w-25">
    <div class=" m-4">
      <div class="posts_btn"><a href="{{ route('post.input') }}">投稿</a></div>
      <div class="sesrch_area">
        <input class="search_keyword" type="text" placeholder="キーワードを検索" name="keyword" form="postSearchRequest">
        <input class="search_keyword_btn" type="submit" value="検索" form="postSearchRequest">
      </div>
      <input type="submit" name="like_posts" class="category_btn search_like_btn" value="いいねした投稿" form="postSearchRequest">
      <input type="submit" name="my_posts" class="category_btn my_posts_btn" value="自分の投稿" form="postSearchRequest">
      <p class="categories_search">カテゴリー検索</p>
      <ul>
        @foreach($categories as $category)
        <div class="main_category_box">
        <li class="main_categories" category_id="{{ $category->id }}"><span>{{ $category->main_category }}</span> <span class="main_categories_arrow"></span> </li>
        <div class="sub_category_box">
        @foreach($category->subCategories as $sub_category)
        <li>
          <form action="{{ route('post.show') }}" method="get" id="postSearchRequest_{{$sub_category->id}}">
            <input type="submit" name="category_word" class="sub_category_btn" value="{{ $sub_category->sub_category }}" form="postSearchRequest_{{$sub_category->id}}">
            <input type="hidden" name="category_id" class="category_btn" value="{{$sub_category->main_category_id}}" form="postSearchRequest_{{$sub_category->id}}">
          </form>
        </li>
        @endforeach
        </div>
        </div>
        @endforeach
      </ul>
    </div>
  </div>
  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</div>
@endsection

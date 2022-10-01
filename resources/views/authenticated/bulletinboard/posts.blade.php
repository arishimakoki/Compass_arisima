@extends('layouts.sidebar')

@section('content')
<div class="board_area w-100 border m-auto d-flex">
  <div class="post_view w-75 mt-5">
    <p class="w-75 m-auto">投稿一覧</p>
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3">
      <p><span class="text">{{ $post->user->over_name }}</span><span class="text ml-3">{{ $post->user->under_name }}さん</span><span class="text ml-3"><font size="2">{{ $post->created_at }}</font></span></p>
      <p><a href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>
      <div class="post_bottom_area d-flex">
        <div class="d-flex post_status">
          <div class="mr-5">
            <i class="fa fa-comment"></i><span class="">
            {{ $post->postComments->count() }}</span>
          </div>
          <div>
            @if(Auth::user()->is_Like($post->id))
            <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{ $post->likes_count }}</span></p>
            @else
            <p class="m-0"><i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{ $post->likes->count() }}</span></p>
            @endif
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="other_area border w-25">
    <div class="border-posts-side m-4">
      <div class="">
        <a href="{{ route('post.input') }}" class="posts-btn btn btn-info">投稿</a></div>
      <div class="post-search-area">
        <input type="text" placeholder="キーワードを検索" name="keyword" form="postSearchRequest">
        <button type="submit" value="検索" form="postSearchRequest" class="search-icon btn btn-info" ><i class="fas fa-search"></i></button>
      </div>
      <button type="submit" name="like_posts" class="btn btn-success iine_btn" value="いいねした投稿" form="postSearchRequest">いいねの投稿</button>
      <button type="submit" name="my_posts" class="btn btn-warning myposts_btn text-white" value="自分の投稿" form="postSearchRequest">自分の投稿</button>
      <div class="category-area">
        <label>カテゴリー</label>
       <ul>
        @foreach($categories as $category)
        <li class="main_categories" category_id="{{ $category->id }}"><span>{{ $category->main_category }}<span></li>
          @foreach($category->subCategories as $sub_category)
            <input type="submit" name="my_posts" class="category_btn" value="{{$sub_category->sub_category}}" form="postSearchRequest">
          @endforeach
        @endforeach
       </ul>
      </div>
    </div>
  </div>
  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</div>
@endsection

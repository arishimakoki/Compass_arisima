@extends('layouts.sidebar')
@section('content')
<div class="commentarea vh-100 d-flex">
  <div class="w-50 mt-5">
    <div class="w-100  m-3 detail_container">
      <div class="p-3">
        <div class="detail_inner_head">
          <div>
          </div>
           @if (!Auth::guest() && Auth::user()->id == $post->user_id)
          <div>
            <span class="edit-modal-open  btn btn-primary" post_title="{{ $post->post_title }}" post_body="{{ $post->post }}" post_id="{{ $post->id }}">編集</span>
            <a href="{{ route('post.delete', ['id' => $post->id]) }}"onclick="return confirm('本当に削除しますか？');" class="btn btn-danger">削除</a>
          </div>
           @endif
        </div>

        <div class="contributor d-flex">
          <p><font size="3">
            <span>{{ $post->user->over_name }}</span>
            <span>{{ $post->user->under_name }}</span>
            さん
             </font>
          </p>
          <span class="ml-3 mt-1">{{ $post->created_at }}</span>
        </div>
        <div class="detsail_post_title"><b>{{ $post->post_title }}</b></div>
        <div class="mt-3 detsail_post">{{ $post->post }}</div>
      </div>
      <div class="p-3 mt-5">
        <div class="comment_container">
          @foreach($post->postComments as $comment)
          <div class="comment_area border-bottom">
            <p>
              <span>{{ $comment->commentUser($comment->user_id)->over_name }}</span>
              <span>{{ $comment->commentUser($comment->user_id)->under_name }}さん</span>
            </p>
            <p>{{ $comment->comment }}</p>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <div class="w-50 p-3">
    <div class="comment_container border m-5">
      <div class="comment_area p-3">
        <p class="comment-text m-0"><font size="3">コメントする</font></p>
        <textarea class="w-100" name="comment" form="commentRequest"></textarea>
        <input type="hidden" name="post_id" form="commentRequest" value="{{ $post->id }}">
        <button type="submit" class="comment_btn btn btn-info" form="commentRequest" value="投稿">投稿する</button>
        <form action="{{ route('comment.create') }}" method="post" id="commentRequest">{{ csrf_field() }}</form>
      </div>
    </div>
  </div>
</div>
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    <form action="{{ route('post.edit') }}" method="post">
      <div class="w-100">
        <div class="modal-inner-title w-50 m-auto">
          <input type="text" name="post_title" placeholder="タイトル" class="w-100">
        </div>
        <div class="modal-inner-body w-50 m-auto pt-3 pb-3">
          <textarea placeholder="投稿内容" name="post_body" class="w-100"></textarea>
        </div>
        <div class="w-50 m-auto edit-modal-btn d-flex">
          <a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
          <input type="hidden" class="edit-modal-hidden" name="post_id" value="">
          <button type="submit" class="btn btn-primary d-block" value="編集" onclick="return confirm('編集しますか？');">編集</button>
        </div>
      </div>
      {{ csrf_field() }}
    </form>
  </div>
</div>
@endsection

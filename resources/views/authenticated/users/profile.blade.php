@extends('layouts.sidebar')

@section('content')
<div class="vh-100 border">
  <div class="top_area w-75 m-auto pt-5">
    <span>{{ $user->over_name }}</span><span>{{ $user->under_name }}さんのプロフィール</span>
    <div class="user_detail p-3">
      <div class="user_profile">
      <table>
        <img src="https://lull-compass.com/image/icon-default_men.svg" alt="トップ">
        <thead>
         <tr>
          <th>名前</th>
          <th>カナ</th>
          <th>性別</th>
          <th>生年月日</th>
            @if($user->role == 4)
             <th>選択科目</th>
            @endif
         </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <span>{{ Auth::user()->over_name }}</span><span class="ml-1">{{ Auth::user()->under_name }}</span>
            </td>
            <td>
              <span>{{ Auth::user()->over_name_kana }}</span><span class="ml-1">{{ Auth::user()->under_name_kana }}</span>
            </td>
            <td>
              @if(Auth::user()->sex == 1)<span>男</span>
               @elseif(Auth::user()->sex == 2)
                <span>女</span>
               @elseif(Auth::user()->sex == 3)
                <span>その他</span>
               @endif
            </td>
          <td><span>{{ Auth::user()->birth_day }}</span></td>
            <td>
               @foreach($user->subjects as $subject)
                  <span>{{ $subject->subject }}</span>
               @endforeach
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    @if($user->role == 4)
       <div class="user_subjects">
        @can('admin')
        <span class="subject_edit_btn">選択科目の編集</span>
        <div class="subject_inner">
          <form action="{{ route('user.edit') }}" method="post">
            @foreach($subject_lists as $subject_list)
            <div>
              <label>{{ $subject_list->subject }}</label>
              <input type="checkbox" name="subjects[]" value="{{ $subject_list->id }}">
            </div>
            @endforeach
            <input type="submit" value="編集" class="btn btn-primary">
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            {{ csrf_field() }}
          </form>
        </div>
        @endcan
      </div>
      @endif
    </div>
  </div>
</div>
@endsection

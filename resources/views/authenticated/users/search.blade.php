@extends('layouts.sidebar')

@section('content')
<p>ユーザー検索</p>
<div class="search_content w-100 border d-flex">
  <div class="reserve_users_area">
       @foreach($users as $user)
       <div class="border one_person">
     <table>
      <tbody>
        <tr class="user-list-card">
          <div>
            <th class="user-list-icon">
               <img src="https://lull-compass.com/image/icon-default_men.svg" alt="トップ">
            </th>
             <th class="user-list-name">
              <span class="user-list-id">{{ $user->id }}</span>
                 <a href="{{ route('user.profile', ['id' => $user->id]) }}">
                   <span>{{ $user->over_name }}</span>
                   <span>{{ $user->under_name }}</span>
                 </a><br>
                   <span>({{ $user->over_name_kana }}</span>
                   <span>{{ $user->under_name_kana }})</span><br>
                      @if($user->sex == 1)
                        <span class="user-list-id">性別 : 男</span>
                      @else
                        <span class="user-list-id">性別 : 女</span>
                      @endif
             </th>
           </div>
           <div>
             <td class="user-list-bio">
                    <span class="bold">生年月日：{{ $user->birth_day }}</span><br>
                  @if($user->role == 1)
                     <span class="bold">権限: </span><span> 教師(国語)</span>
                   @elseif($user->role == 2)
                    <span class="bold">権限 : </span><span>教師(数学)</span>
                    @elseif($user->role == 3)
                    <span class="bold">権限 : </span><span>講師(英語)</span>
                    @else
                   <span class="bold">権限 : </span><span>生徒</span><br>
                    @endif

                  @if($user->role == 4)
                  @if($user->subject_id == 1)
                    <span class="bold">国語</span>
                            @elseif($user->subject_id == 2)
                    <span>選択科目 : </span><span>数学</span>
                    @else
                    <span>選択科目 : </span><span>英語</span>
                    @endif
                    @endif
                 </dl>
              </td>
           </div>
          </tr>
          </tbody>
        </table>
      </div>
    @endforeach


</div>
  <div class="search_area w-25 border">
    <div class="row">
      <h3>検索</h3>
    </div>
    <div class="">
      <div>
        <input type="text" class="free_word" name="keyword" placeholder="キーワードを検索" form="userSearchRequest">
      </div>
      <label for="category">
        <div class="small">カテゴリ</div>
        <select form="userSearchRequest" name="category">
          <option value="name">名前</option>
          <option value="id">社員ID</option>
        </select>
      </label>
      <label for="sort">
        <div class="small">並び替え</div>
        <select name="updown" form="userSearchRequest">
          <option value="ASC">昇順</option>
          <option value="DESC">降順</option>
        </select>
      </label>
      <div class="">
        <p class="m-0 search_conditions"><span>検索条件の追加</span></p>
        <div class="search_conditions_inner">
          <div>
            <label>性別</label>
            <span>男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
            <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
          </div>
          <div>
            <label>権限</label>
            <select name="role" form="userSearchRequest" class="engineer">
              <option selected disabled>----</option>
              <option value="1">教師(国語)</option>
              <option value="2">教師(数学)</option>
              <option value="3">教師(英語)</option>
              <option value="4" class="">生徒</option>
            </select>
          </div>
          <div class="selected_engineer">
            <label>選択科目</label>
          @foreach($subjects as $subject)
          <div class="">
            <input type="checkbox" name="subject[]" value="{{ $subject->id }}" form="userSearchRequest">
            <label>{{ $subject->subject }}</label>
          </div>
          @endforeach
          </div>
        </div>
      </div>
      <div>
        <button type="submit" name="search_btn" value="検索" form="userSearchRequest" class="search_btn btn btn-info"><i class="fas fa-search"></i>検索する </button>
      </div>
      <div>
        <button type="submit" value="リセット" form="userSearchRequest" class="reset_btn">リセット</button>
      </div>
    </div>
    <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
  </div>
</div>
@endsection

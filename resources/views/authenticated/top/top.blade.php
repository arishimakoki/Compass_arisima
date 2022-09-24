@extends('layouts.sidebar')

@section('content')
<div class="vh-100 border">
  <div class="top_area w-75 m-auto pt-5">
    <h2>マイページ</h2>
    <div class="user_status p-3">
      <table>
        <img src="https://lull-compass.com/image/icon-default_men.svg" alt="トップ">
        <thead>
         <tr>
          <th>名前</th>
          <th>カナ</th>
          <th>性別</th>
          <th>生年月日</th>
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
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

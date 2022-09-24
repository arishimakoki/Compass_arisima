<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>AtlasBulletinBoard</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&family=Oswald:wght@200&display=swap" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="all_content">
 <div id="nav-group">
   <header>
    <h1>
      <a href="{{ route('top.show') }}">
        <img src="https://lull-compass.com/image/compass-logo.svg" alt="" width="200px">
      </a>
    </h1>
    <nav>
      <ul>
        <li >
        <li  class="current-header" >
          <a href="{{ route('top.show') }}" data-toggle="tooltip" tooltip="マイページ" flow="down">
            <img src="https://lull-compass.com/image/icon-default_men.svg" alt="トップ">
          </a>
        </li>
        <li>
          <a href="/logout" onclick="return checkSubmit('ログアウトしますか？')" data-toggle="tooltip" tooltip="ログアウト" flow="down">
          <img src="https://lull-compass.com/image/icon/logout.svg" alt="ログアウト">
          </a>
        </li>
      </ul>
    </nav>
  </header>
 </div>
  <div class="d-flex">
    <div class="sidebar" ::-webkit-scrollbar>
      <ul>
      @section('sidebar')
      <li>
        <a href="{{ route('calendar.general.show',['user_id' => Auth::id()]) }}">
        <span> スクール予約</span></a>
      </li>
      @if(Auth::user()->role <= 3 )
      <li>
        <a href="{{ route('calendar.admin.show',['user_id' => Auth::id()]) }}">
        <span> スクール予約確認</span></a>
      </li>
      <li>
        <a href="{{ route('calendar.admin.setting',['user_id' => Auth::id()]) }}">
          <span>スクール枠登録</span> </a>
      </li>
       @endif
      <li>
        <a href="{{ route('post.show') }}">
        <span> 掲示板</span></a>
      </li>
      <li>
        <a href="{{ route('user.show') }}">
        <span> ユーザー検索</span></a>
      </li>
      @show
    </div>
    <div class="main-container">
      @yield('content')
      </ul>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/register.js') }}" rel="stylesheet"></script>
  <script src="{{ asset('js/bulletin.js') }}" rel="stylesheet"></script>
  <script src="{{ asset('js/user_search.js') }}" rel="stylesheet"></script>
  <script src="{{ asset('js/calendar.js') }}" rel="stylesheet"></script>
</body>
</html>

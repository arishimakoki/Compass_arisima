<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AtlasBulletinBoard</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
  <link href="{{ asset('css/logout.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&family=Oswald:wght@200&display=swap" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>
  <div class="login-form">
	  <img src="https://lull-compass.com/image/compass-logo.svg" alt="">
	    <div class="form-group">
		    <h1>ログイン</h1>
  <form action="{{ route('loginPost') }}" method="POST">

        <div class="input-group">
          <label class="d-block m-0" style="font-size:13px;">メールアドレス</label>
            <input type="text"  name="mail_address">
        </div>

        <div class="input-group">
          <label class="d-block m-0" style="font-size:13px;">パスワード</label>
            <input type="password" name="password">
        </div>

        <div class="text-right m-3">
          <button type="submit">ログイン</button>
        </div>

        <div class="text-center">
          <a href="{{ route('registerView') }}">新規登録</a>
        </div>

      {{ csrf_field() }}
    </form>
   </div>
 </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/register.js') }}" rel="stylesheet"></script>
</body>
</html>

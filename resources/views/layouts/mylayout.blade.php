<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@if (! Request::is('/')){{ $title }} | @endif{{ env('APP_NAME') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link href="{{ asset('css/magic.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>
	<div id="app">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>menu
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
@guest
	<ul class="navbar-nav ml-auto">
		<li class="nav-item">
			<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
		</li>
		<li class="nav-item">
            <a class="nav-link" href="https://scrapbox.io/my-dev-memo/TaskTractTrack_-_%E7%B5%82%E3%82%8F%E3%81%A3%E3%81%9F%E3%81%93%E3%81%A8%E3%81%A0%E3%81%91%E6%99%82%E9%96%93%E8%A8%88%E6%B8%AC%E3%81%97%E3%82%88%E3%81%86" target="_blank">
                <i class="fas fa-question-circle"></i>　
            </a>
        </li>
	</ul>
@else
	<ul class="navbar-nav ml-auto">
		<li class="nav-item">
			<a class="nav-link" href="{{ route('performances') }}">時間計測</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('reports') }}">レポート</a>
		</li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         {{ Auth::user()->name }} 
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
			<a class="dropdown-item" href="{{ route('tasks') }}">タスク管理</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             @csrf
            </form>
        </div>
      </li>
        <li class="nav-item">
            <a class="nav-link" href="https://scrapbox.io/my-dev-memo/TaskTractTrack_-_%E7%B5%82%E3%82%8F%E3%81%A3%E3%81%9F%E3%81%93%E3%81%A8%E3%81%A0%E3%81%91%E6%99%82%E9%96%93%E8%A8%88%E6%B8%AC%E3%81%97%E3%82%88%E3%81%86" target="_blank">
                <i class="fas fa-question-circle"></i>　
            </a>
        </li>
	</ul>
@endguest
  </div>
</nav>
<div class="container mt-2">
@if (Session::has('danger'))
	<div class="alert alert-danger" role="alert">
		{{ session('danger') }}
	</div>
@endif
@if (Session::has('success'))
	<div class="alert alert-success" role="alert">
		{{ session('success') }}
	</div>
@endif

	@yield('content')
</div>
<p id="page-top"><a href="#" id="inner-page-top">TOP</a></p>
</div><!-- id:app -->

<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/util.js') }}"></script>
</body>
</html>

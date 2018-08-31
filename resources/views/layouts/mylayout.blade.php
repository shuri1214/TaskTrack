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
	</ul>
@else
	<ul class="navbar-nav ml-auto">
		<li class="nav-item">
			<a class="nav-link" href="{{ route('performances') }}">計測</a>
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
	</ul>
@endguest
  </div>
</nav>
<div class="container mt-2">
	@yield('content')
</div>
    </div><!-- id:app -->

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

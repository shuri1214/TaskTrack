@php
    $title = '計測終了';
@endphp
@extends('layouts.mylayout')
@section('title', $title)

@section('content')
<h1>{{ $title }}</h1>

<div class="row">
<div class="col-12">
	<div class="card img-thumbnail mx-auto" style="width: 22rem;">
		<img class="card-img-top" alt="カードの画像" src="{{ asset('img/finish-mattari.png') }}">
  		<div class="card-body">
    		<p class="card-text">お疲れ様でした</p>
			<p class="card-text">計測結果をみる場合 <i class="fas fa-hand-point-right"></i> <a href="{{ route('reports') }}">レポート</a></p>
			<p class="card-text">また計測する場合 <i class="fas fa-hand-point-right"></i> <a href="{{ route('performances') }}">時間計測</a></p>
  		</div>
	</div>
</div><!-- end of col -->
</div><!-- end of row -->

@endsection

@php
    $title = '計測';
@endphp
@extends('layouts.mylayout')
@section('title', $title)

@section('content')
    <h1>タスク時間計測</h1>
	<div class="card card-body bg-light">
	ただいま：　第 {{ $measure->id }} MEASURE  @if ( $measure->status == 'ready' ) 開始前 @else 計測中 @endif
	</div>
@if ( $measure->status == 'ready')
    <form class="buttun-group col-sm-12 mt-1" action="/timer/start/{{ $measure->id }}" method="POST">
        {{ csrf_field() }}
		<button type="submit" class="btn btn-info col-sm-3">
			計測開始
		</button>
	</form>
@endif

@if ($measure->status == 'doing')
    <h2 class="mt-3">タスク一覧 <small>最終start time: {{ $start_time }}</small> </h2>
	<div class="row">
	@foreach ($tasks as $task)
		<div class="col-sm-3 mb-2">
    		<form action="/performance/{{ $task->id }}" method="POST">
        		{{ csrf_field() }}
            	<input type="hidden" name="measure_id" value=" {{ $measure->id }}" id="measure_id">
            	<button class="btn btn-primary col-sm-12">{{ $task->name }}</button>
      		</form>
		</div>
	@endforeach
	</div>

	<div class="row border-top mt-2">
		<div class="col-sm-12"><small>＊計測終了しますか？</small></div>
    	<form class="mt-1 col-sm-6" action="/timer/stop/{{ $measure->id }}" method="POST">
           {{ csrf_field() }}
           <button type="submit" class="col-sm-12 btn btn-info">
                計測終了
           </button>
    	</form>
	</div>
@endif


@endsection

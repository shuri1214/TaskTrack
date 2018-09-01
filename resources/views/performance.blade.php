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
			<i class="fas fa-stopwatch"></i> 計測開始
		</button>
	</form>
@endif

@if ($measure->status == 'doing')
    <h2 class="mt-3">タスク一覧 <span class="h6 small">《現タスク開始》 {{ $start_time }}</span> </h2>
	<div class="row">
	@foreach ($tasks as $task)
		<div class="col-sm-3 mb-2">
    		<form action="/performance/{{ $measure->id }}/task/{{ $task->id }}" method="POST">
        		{{ csrf_field() }}
            	<!-- input type="hidden" name="measure_id" value=" {{ $measure->id }}" id="measure_id"-->
            	<button class="btn btn-primary col-sm-12" data-toggle="tooltip" title="{{ $task->name }}" >{{ $task->name }} <i class="fas fa-thumbtack"></i></button>
      		</form>
		</div>
	@endforeach
	</div>
	<div class="row border-top mt-1 mb-1">
		<div class="col-sm-12"><small>＊新しいタスクですか？</small></div>
		<form class="form-inline col-sm-12" action="/performance/{{ $measure->id }}/newtask" method="POST">
			{{ csrf_field() }}
			<label for="task-name" class="control-label">新規タスク</label>
			<input type="text" name="name" id="task-name" class="form-control col-sm-3" placeholder="やっていたタスク名" aria-label="やっていたタスク名" aria-describedby="basic-addon">
            <button class="btn btn-primary col-sm-2">で計測登録 <i class="fas fa-thumbtack"></i></button>
            <!-- input type="hidden" name="measure_id" value=" {{ $measure->id }}" id="measure_id" -->
			<input type="hidden" name="active" id="task-active" value="true">
		</form>
	</div>

	<div class="row border-top mt-1 pt-2">
		<div class="col-sm-12"><small>＊計測終了しますか？</small></div>
    	<form class="mt-1 col-sm-3" action="/timer/stop/{{ $measure->id }}" method="POST">
           {{ csrf_field() }}
           <button type="submit" class="col-sm-12 btn btn-info">
                <i class="fas fa-stopwatch"></i> 計測終了
           </button>
    	</form>
	</div>
@endif


@endsection

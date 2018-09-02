@php
    $title = 'レポート';
@endphp
@extends('layouts.mylayout')
@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
	<div class="form-group">
    	<label for="report-select">MEASURE リスト</label>
    	<select class="form-control" id="report-select" >
		@foreach ($measures as $m )
			<option value="{{$m->id}}" @if ( $m->id == $selected_measure_id) selected @endif > {{$m->id}} : {{ $m->start_time}} - {{ $m->end_time }}</option>
		@endforeach
    	</select>
	</div>
@if ( count($performances)>0 )
	<div class="card mb-4">
		<div class="card-header">
			計測一覧
		</div>
		<ul class="list-group list-group-flush">
		@foreach ($performances as $p )
			<li class="list-group-item" id="perform-{{$p->id}}"><span>{{ $p->start_time}}</span> - <span>{{$p->end_time}}</span> <i class="fas fa-thumbtack"></i> <strong>{{ $p->task_name }}</strong> </li>
		@endforeach
		</ul>
		<div class="card-footer text-right">以上が計測されたタスクです</div>
	</div>
@else
	<div>
		計測タスクがありません
	</div>
@endif
@endsection

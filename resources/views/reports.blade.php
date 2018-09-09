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
<!-- ToDo: for applying to postgreSQL
	<div class="table-responsive">
		<h5>作業時間リスト</h5>
		<table id="report-table" class="table table-bordered tablesorter">
			<thead><th> Time </th><th> Name </th></thead>
			<tbody>
	@foreach ($report as $r)
				<tr>
					<td>{{ $r->total_time }} </td>
					<td>{{ $r->task_name}} </td>
				</tr>
	@endforeach
			</tbody>
		</table>
	</div>
-->

	<div class="mt-4 mb-4">
		<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#performancedlist" aria-expanded="false" aria-controls="performancedlist">
    	計測一覧表示
		</button>
		<div id="performancedlist" class="collapse card mt-2">
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
	</div>
@else
		<div>
			計測タスクがありません
		</div>
@endif
@endsection

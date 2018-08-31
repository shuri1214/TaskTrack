@php
    $title = 'タスク管理';
@endphp
@extends('layouts.mylayout')
@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
	<!-- 新規タスク登録 -->
    <form action="/tasks" method="POST" class="form-horizontal">
        {{ csrf_field() }}
		<div class="row">
        	<div class="form-group form-inline col-sm-12">
            	<label for="task-name" class="col-sm-2 control-label">登録タスク名</label>
				<input type="text" name="name" id="task-name" class="col-sm-4 form-control">
				<label for="task-active" class="ml-2"><input type="checkbox" name="active" id="task-active" checked>計測対象の状態で登録</label>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
            	<button type="submit" class="btn btn-primary">
                	<i class="fas fa-asterisk"></i> タスク登録
            	</button>
        	</div>
		</div>
    </form>

    <!-- 登録済みタスク管理 -->
    <h2 class="mt-5">登録済みタスク一覧</h2>
	<div class="card mb-2">
		<div class="card-header">登録済み</div>
		@foreach ($tasks as $task)
		<div class="row mb-1 mt-1">
		<div class="col-sm-9">
			<form class="form-inline col-sm-9">
			<input type="text" name="name" value="{{ $task->name }}" class="form-control col-sm-7">
			<div class="col-sm-3">
			<input type="checkbox" @if ( $task->active ) checked @endif >計測対象
			</div>
			<button class="btn btn-primary col-sm-2">更新</button>
			</form>
		</div>
		<div class="col-sm-3">
			<form class="form-inline" action="/tasks/{{ $task->id }}" method="POST">
               	{{ csrf_field() }}
               	{{ method_field('DELETE') }}
             	 <button class="btn btn-danger col-sm-5">削除</button>
            </form>
		</div>
		</div>
		@endforeach
		<div class="card-footer text-right">タスク一覧</div>
	</div>
@endsection

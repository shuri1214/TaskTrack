@extends('layout')

@section('content')
    <h1>計測タスクリスト</h1>
    <!-- Current Tasks -->
    <h2>Start Task</h2>

	<table class="table table-striped">
		<tbody>
			<tr><td>
			@if ( $measure->status == 'ready' )
			<form action="/timer/start/{{ $measure->id }}" method="POST"> 
				{{ csrf_field() }}
				<button type="submit" class="btn btn-default">
					計測開始 {{ $measure->id }} measure
				</button>
			</form>
			@else
			<form action="/timer/stop/{{ $measure->id }}" method="POST">
				{{ csrf_field() }}
				@if ($start_time != null )
					{{ $start_time }}
				@endif
				＊最後に終了したタスクのボタンは押せてますか？
				<button type="submit" class="btn btn-default">
					計測終了 {{ $measure->id }} measure
				</button>
			</form>
			@endif
			</td></tr>
		</tbody>
	</table>
	<!-- ToDo: Start button -->
    <h2>Current Tasks</h2>
    <table class="table table-striped task-table">
        <thead>
            <th>Task</th><th>&nbsp;</th>
        </thead>

        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <!-- Task Name -->
                    <td>
                        <div>{{ $task->name }}
							 @if ( $task->active )
								< Active >
							@else
								< Inactive >
							@endif
						</div>
                    </td>
                    <td>
                        <form action="/performance/{{ $task->id }}" method="POST">
                            {{ csrf_field() }}
							<input type="hidden" name="measure_id" value=" {{ $measure->id }}" id="measure_id">
                            <button>{{ $task->name }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

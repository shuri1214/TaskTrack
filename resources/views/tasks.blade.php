@extends('layout')

@section('content')
    <h1>Task List</h1>
    <form action="/tasks" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <!-- Task Name -->
        <div class="form-group">
            <label for="task" class="col-sm-3 control-label">Task</label>
            <div class="col-sm-6">
                <input type="text" name="name" id="task-name" class="form-control">
                <input type="checkbox" name="active" id="task-active" class="form-control">
            </div>
        </div>

        <!-- Add Task Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Add Task
                </button>
            </div>
        </div>
    </form>

    <!-- Current Tasks -->
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
                        <form action="/tasks/{{ $task->id }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}                    
                            <button>Delete Task</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

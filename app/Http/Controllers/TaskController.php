<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Log;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$user_id = Auth::id();
		$tasks = User::find($user_id)->tasks;
		return view('tasks', ['tasks' => $tasks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$name = request('name');
		$active = (request('active')==true ? true : false );
		$task = new Task;
		if( !$task->saveNewtask($name,$active )) return redirect('/tasks'); // アラートメッセージとかの処理があれば
		return redirect('/tasks');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  request path task ID(String)  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$task = Task::find($id);
		$task->name = request('name');
        $task->active = (request('active')==true ? true : false );
        $task->save();
        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, Task $task)
    {
		$task = Task::find($id);
		$task->delete();
		return redirect('/tasks'); 
    }
}

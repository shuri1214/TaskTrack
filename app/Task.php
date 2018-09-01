<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
	public function performances()
	{
		return $this->hasMany('App\Performace');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	/**
	 * 新規登録処理
	 * return(success) Task $task
	 * return(fail) false
	*/
	public function scopeSaveNewTask($query,$name,$active)
	{
		if(!Auth::check() ) return false;
		$user_id = Auth::id();
		$task = new Task;
		$task->user_id = $user_id;
		$task->name = request('name');
		$task->active = $active;
		if(! $task->save()) return false;
		return $task;
	}
}

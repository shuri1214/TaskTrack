<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Measure;
use Log;

class Performance extends Model
{
	protected $fillable = ['task_id','measure_id','start_time','end_time','perform_time'];
    //
	public function task()
	{
		return $this->belongsTo('App\Task');	
	}
    public function measure()
    {
        return $this->belongsTo('App\Measure');
    }

	public function scopeInsertPerform($task_id,$measure_id)
	{
		// start_timeを取得
		// * measure_idがすでにあれば、start_timeはmaxのperformance_id値、無ければmeasureTBLのstart_time
		$start_time = 'ToDo';
		$end_time = Carbon::now();
		$perform_time = $start_time->diffInSeconds($end_time);
		$data = array(
				'task_id'=>$task_id,
				'measure_id'=>$measure_id,
				'start_time'=>$start_time,
				'end_time'=>$end_time,
				'perform_time'=>$perform_time
			);
	}

}

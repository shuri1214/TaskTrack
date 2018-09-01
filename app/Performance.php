<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Measure;
use Log;

class Performance extends Model
{
	protected $fillable = ['task_id','task_name','measure_id','start_time','end_time','perform_time'];
    //
	public function task()
	{
		return $this->belongsTo('App\Task');	
	}
    public function measure()
    {
        return $this->belongsTo('App\Measure');
    }

}

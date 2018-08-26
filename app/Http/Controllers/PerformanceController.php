<?php

namespace App\Http\Controllers;

use App\Task;
use App\Performance;
use App\Measure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Log;

class PerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// 計測状態を取り出し、viewに設定
		$measure= Measure::latestIncompleteStatus()->first();
		$tasks = Task::where('active',true)->get();
		$start_time = self::getStartTime();
		return view('performance', ['tasks' => $tasks , 'measure'=>$measure , 'start_time'=>$start_time]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  path(task_id)  $task_id
     * @return \Illuminate\Http\Response
     */
    public function regist(Request $request,$task_id)
    {
		// measure_idを取得
		$measure_id = Measure::where('status', Measure::$status_doing)->value('id');
		
		// performanceテーブルに新規登録
		$p = new Performance();
		$start_time = new Carbon(self::getStartTime()); // datetime型
        $end_time = Carbon::now();
        $perform_time = $start_time->diffInSeconds($end_time);
        $data = array(
                'task_id'=>$task_id,
                'measure_id'=>$measure_id,
                'start_time'=>$start_time,
                'end_time'=>$end_time,
                'perform_time'=>$perform_time
            );
		$p->fill($data)->save();
		return redirect('/performances');
    }


/* private */

	private function getStartTime()
	{
		$m = new Measure();
		$m = $m->where('status', Measure::$status_doing );
        $m_id = $m->value('id');
		if ($m_id == null) return null; // そもそもmeasureの開始がされていない
        $m_s_time = $m->value('start_time');
        // performance
		$p = new Performance();
        $p = $p->where('measure_id',$m_id);
        if($p->get()->isEmpty() ) return $m_s_time; // 1measure周期中に1度もタスクが完了していないのでmeasureTBLのstart
        // 1度でもタスク完了なら、続けて別のタスクを開始した前提なので、前タスクの終了時刻を取得
        $p_s_time = $p->max('end_time');

		return $p_s_time;
	}
}

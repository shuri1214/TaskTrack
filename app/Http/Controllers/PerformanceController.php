<?php

namespace App\Http\Controllers;

use App\Task;
use App\Performance;
use App\Measure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Log;

class PerformanceController extends Controller
{

	public function __construct()
	{
		//$this->middleware('auth')->except(['index', 'show']);
		$this->middleware('auth');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// 計測状態を取り出し、viewに設定
		$measure= Measure::latestIncompleteStatus()->first();
		$user_id = Auth::id();
		$tasks = Task::where('user_id',$user_id)->where('active',true)->get();
		$st = new \DateTime(self::getStartTime());
		$start_time = $st->format('H:i:s');
		return view('performance', ['tasks' => $tasks , 'measure'=>$measure , 'start_time'=>$start_time]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  path(task_id)  $task_id
     * @return \Illuminate\Http\Response
     */
    public function regist(Request $request,$measure_id,$task_id)
    {
        $user_id = Auth::id(); // user_id
        if(! self::isLoggedinUser($user_id) ) return redirect('/performances'); // 不正ログインだと思うんだ・・・
		// performanceテーブルに新規登録
		$ret = self::storePerformance(  $task_id, $measure_id );
		return redirect('/performances');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  path(measure_id)  $measure_id
     * @return \Illuminate\Http\Response
     */
    public function registwithtask(Request $request,$measure_id)
	{
        $user_id = Auth::id(); // user_id
		if(! self::isLoggedinUser($user_id) ) return redirect('/performances'); // 不正ログインだと思うんだけど・・
		// Taskテーブルに新規登録
        $task_name = request('name');
        $task_active = true;
        $task = new Task;
		$task = $task->saveNewtask($task_name,$task_active );
		if(!$task) return redirect('/performances');

        // performanceテーブルに新規登録
		$task_id = $task->id;
        $ret = self::storePerformance( $task_id, $measure_id );
		
		return redirect('/performances');
	}

/* private */

	private function getStartTime()
	{
		$u_id = Auth::id();
		$m = new Measure();
		$m = $m->where('user_id',$u_id)->where('status', Measure::$status_doing );
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

	private function storePerformance($task_id,$measure_id)
	{
        // performanceテーブルに新規登録
        $p = new Performance();
        $start_time = new Carbon(self::getStartTime()); // datetime型
        $end_time = Carbon::now();
        $data = array(
                'task_id'=>$task_id,
                'measure_id'=>$measure_id,
                'start_time'=>$start_time,
                'end_time'=>$end_time
            );
        $p->fill($data)->save();
		return $p;
	}

    /**
     * ログインユーザーがリクエストで飛んできたかチェック(要らないかも)
     */
    private function isLoggedinUser($user_id)
    {
        if (!Auth::check()) return false; // こっちは要らない気がする
        if(Auth::id() != $user_id) return false;
        return true;
    }
}

<?php

namespace App\Http\Controllers;

use DB;
use App\Performance;
use App\Measure;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Log;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	/**
	 * diaplay measure and performance
	 * @param Request $request request params
	*/
	public function index(Request $request)
	{
		$req_mid = $request->mid;
		// user id
		$user_id = Auth::id();
		// requestチェッック
		$m_owner_user_id = Measure::where( 'id', $req_mid)->value('user_id');
		if( ! empty($req_mid) && $m_owner_user_id != $user_id ){
			abort(500); // 直打ちされたとか不正リクエストとしてエラー扱い（やりすぎ感はある）
		}
		// user に紐づいた measure 取得
		$um = new User;
		$um = $um->find( $user_id )
					->measures()
					->orderBy('created_at', 'desc');
		$ms = $um->get();

		//measure に関するperformance 取得
		$performances = array();
		$report = array();
		if( !empty($ms) && $um->first() !== null ){
			$query_mid = ( empty($req_mid) ? $um->first()->id : $req_mid );
			$mp = new Measure;
			$performances = $mp->find($query_mid)->performances()
				->orderBy('id','desc')
				->get();
			// 時々値がおかしい気がする・・・TBLカラム見直しが必要か  ToDo
			//$report = DB::select('select SEC_TO_TIME(SUM( TIMEDIFF(end_time , start_time))) as total_time, task_name from performances where measure_id = ? group by task_name order by total_time desc' , [$query_mid] );
			$report = DB::select('select (end_time - start_time) as total_time, task_name from performances where measure_id = ? group by task_name order by total_time desc' , [$query_mid] );
		}

		return view( 'reports', ['measures'=>$ms,'selected_measure_id'=>$req_mid, 'performances'=>$performances, 'report'=>$report]);
	}
}

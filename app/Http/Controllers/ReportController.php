<?php

namespace App\Http\Controllers;

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
	 * @param request param
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
		// request にmeasure id 設定がある場合、useridと紐づいてあるかどうかかくにんする
		$performances = array();
		if( !empty($ms) ){
			$query_mid = ( empty($req_mid) ? $um->first()->id : $req_mid );
			$mp = new Measure;
			$performances = $mp->find($query_mid)->performances()
				->orderBy('id','desc')
				->get();
		}

		return view( 'reports', ['measures'=>$ms,'selected_measure_id'=>$req_mid, 'performances'=>$performances]);
	}
}

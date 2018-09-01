<?php

namespace App\Http\Controllers;

use App\Measure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;

class MeasureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Store a newly measure reacord and start measuring.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   measure id $id
     * @return \Illuminate\Http\Response
     */
    public function start(Request $request , $id)
    {
		$measure = Measure::find($id);
        $user_id = $measure->user_id;
        if(!self::isLoggedinUser($user_id)) return redirect('/performances'); // 怪しいなら登録しない(要らないきもする)
		$measure->fill(array('user_id'=>$user_id, 'status' => Measure::$status_doing , 'start_time'=> Carbon::now()))->save();
		return redirect('/performances');
    }

    /**
     * Updaate measure table column end_time. for ending measure.
     *
     * @param  HttpRequest  $request
     * @param   measure id $id
     * @return \Illuminate\Http\Response
     */
    public function end(Request $request , $id)
    {
        $measure = Measure::find($id);
		$user_id = $measure->user_id;
		if(!self::isLoggedinUser($user_id)) return redirect('/performances'); // 怪しいなら登録しない
        $measure->fill(array('status' => Measure::$status_done,'end_time'=> Carbon::now()))->save();
        return redirect('/performances');
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

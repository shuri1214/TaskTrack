<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Log;

class Measure extends Model
{
	// 状態定義
	public static $status_ready = 'ready';
	public static $status_doing = 'doing';
	public static $status_done = 'done';

	protected $fillable = ['user_id','status','start_time','end_time'];

	public function performances()
	{
		return $this->hasMany('App\performances');
	}

    public function user()
    {
        return $this->belongsTo('App\User');
    }

	/*
	* 最新のready/doing状態を取得するクエリ。無ければ新規作成
	* return 最新状態のMeasureオブジェクト.該当無い場合はnull
	*/
	public function scopeLatestIncompleteStatus($query,$recursion = 0) 
	{
		if( $recursion == 0 && ! Auth::check() ) return null; // 認証されていないなら使えない.再帰処理時は数字で判定
		$user_id = Auth::id();
		if($recursion > 1) return null; //　想定外の再帰回数. null返却
		$ret = $query->where('user_id',$user_id)->whereIn('status',[self::$status_ready,self::$status_doing]);
		if ($ret->get()->isEmpty()) {
			$m = new Measure();
			$ret = $m->fill(array('user_id'=> $user_id ,'status'=>self::$status_ready , 'start_time'=>Carbon::now()))->save();
			if($ret == false) return null; // 更新失敗 null返却
			return self::scopeLatestIncompleteStatus($query,++$recursion);
		}
		return $ret;
	}
}

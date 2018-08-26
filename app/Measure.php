<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Log;

class Measure extends Model
{
	// 状態定義
	public static $status_ready = 'ready';
	public static $status_doing = 'doing';
	public static $status_done = 'done';

	protected $fillable = ['status','start_time','end_time'];

	public function performances()
	{
		return $this->hasMany('App\performances');
	}


	/*
	* 最新のready/doing状態を取得するクエリ。無ければ新規作成
	* return 最新状態のMeasureオブジェクト.該当無い場合はnull
	*/
	public function scopeLatestIncompleteStatus($query,$recursion = 0) 
	{
		if($recursion > 1) return null; //　想定外の再帰回数. null返却
		$ret = $query->whereIn('status',[self::$status_ready,self::$status_doing]);
		if ($ret->get()->isEmpty()) {
			$m = new Measure();
			$ret = $m->fill(array('status'=>self::$status_ready , 'start_time'=>Carbon::now()))->save();
			if($ret == false) return null; // 更新失敗 null返却
			return self::scopeLatestIncompleteStatus($query,++$recursion);
		}
		return $ret;
	}
}

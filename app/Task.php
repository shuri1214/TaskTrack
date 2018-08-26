<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	public function performances()
	{
		return $this->hasMany('App\Performace');
	}
}

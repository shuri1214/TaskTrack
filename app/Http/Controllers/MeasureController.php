<?php

namespace App\Http\Controllers;

use App\Measure;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
		$measure->fill(array('status' => Measure::$status_doing , 'start_time'=> Carbon::now()))->save();
		return redirect('/performances');
    }

    /**
     * Display the specified resource.
     *
     * @param  HttpRequest  $request
     * @param   measure id $id
     * @return \Illuminate\Http\Response
     */
    public function end(Request $request , $id)
    {
        $measure = Measure::find($id);
        $measure->fill(array('status' => Measure::$status_done,'end_time'=> Carbon::now()))->save();
        return redirect('/performances');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Measure  $measure
     * @return \Illuminate\Http\Response
     */
    public function edit(Measure $measure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Measure  $measure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Measure $measure)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Measure  $measure
     * @return \Illuminate\Http\Response
     */
    public function destroy(Measure $measure)
    {
        //
    }
}

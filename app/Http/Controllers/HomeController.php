<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         //
        // for test case
        $tasks = \Auth::user()->myTasks()->get();
    //    return $tasks;
        $shareableTask = \App\Shareable::all();
        $filtered = $shareableTask->filter(function ($value, $key) {
            if($value->share_user_id != \Auth::user()->id){
                return $value;
            }
        });

        $tasksForOthers = $filtered->map(function ($item, $key) {
            return $item->task;
        });
        $allTasks = $tasksForOthers->merge($tasks); // Contains foo and bar.
       // $myTasks = \Auth::user()->myTasks();
       $allTasks = $allTasks->filter(function ($value, $key) {
        return $value != null ;
    });

        return view('home')->with('data',$allTasks);

      //  return view('home');
    }
}

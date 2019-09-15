<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Shareable;

use Validator;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
  $this->middleware('auth');
    }
    public function index()
    {
        /*
        //
        // for test case
        $tasks =\Auth::user()->myTasks()->get();
    //    return $tasks;
        $shareableTask = \App\Shareable::all();
        $filtered = $shareableTask->filter(function ($value, $key) {
            if($value->share_user_id !=\Auth::user()->id){
                return $value;
            }
        });

        $tasksForOthers = $filtered->map(function ($item, $key) {
            return $item->task;
        });


        $allTasks = $tasks->merge($tasksForOthers); // Contains foo and bar.
       // $myTasks = \Auth::user()->myTasks();
        return view('home')->with('data',$allTasks);
        */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'content' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $request->request->add(['user_id' => \Auth::user()->id]); //add request
        $request->request->remove('check');


        $newRecord = Task::firstOrCreate($request->all());


        return $newRecord;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->check){
            $UpdatedRecord = Task::find($id);
            $result = $UpdatedRecord->update($request->all());
        return $this->createResponseMessage($result);
        }
        //
        $validator = Validator::make($request->all(), [
            'content' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $UpdatedRecord = Task::find($id);
        $result = $UpdatedRecord->update($request->all());
    return $this->createResponseMessage($result);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $record = Task::findOrFail($id);
            if($record->user_id != \Auth::user()->id){
                return response()->json(['message'=>'unauthorize'],401);
            }
            $result =  Task::destroy($record->id);
        } catch (ModelNotFoundException $e) {
            return ['error' => 'the Task ($id) not found '];
        }

        return $this->createResponseMessage($result);
    }
}

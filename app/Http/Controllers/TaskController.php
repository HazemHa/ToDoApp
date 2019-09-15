<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
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
//    /   $this->middleware('auth');
    }
    public function index()
    {
        //
        // for test case
        $tasks = \App\User::find(2)->myTasks()->get();
       // $myTasks = \Auth::user()->myTasks();
        return view('main')->with('data',$tasks);
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

        $newRecord = Task::create($request->all());


        return $this->createResponseMessage($newRecord);
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
          //  $record = Task::findOrFail($id);
         //   $result =  Task::destroy($record->id);
        } catch (ModelNotFoundException $e) {
            return ['error' => 'the Task ($id) not found '];
        }

       // return $this->createResponseMessage($result);
    }
}

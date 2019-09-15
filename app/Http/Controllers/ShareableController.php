<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Shareable;

class ShareableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validator = \Validator::make($request->all(), [
            'task_id' => 'required|unique:shareable'
        ], [
            'task_id.unique' => 'you have been share The task before',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $user = \App\User::find(2);

        $shareableTask = new Shareable;
        $shareableTask->task_type = 'App\Task';
        $shareableTask->task_id = $request->task_id;
        $shareableTask->share_user_id = $user->id;

        $result =  $shareableTask->save();

        return $this->createResponseMessage($result);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $record = Shareable::findOrFail($id);
            $result = Shareable::destroy($record->id);
        } catch (ModelNotFoundException $e) {
            return ['error' => 'the Shareable ($id) not found '];
        }

        return $this->createResponseMessage($result);
    }
}

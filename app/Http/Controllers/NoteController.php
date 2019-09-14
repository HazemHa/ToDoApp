<?php

namespace App\Note\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Note\Model\Note;
use Validator;

class NoteController extends Controller
{
    /***Store a newly created resource in storage.*
     *
@param\Illuminate\Http\Request $request *
@return\Illuminate\Http\Response *
     */
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'content' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $newRecord = Note::create($request->all());


        return $this->createResponseMessage($newRecord);
    }

    // this for update record :
    /***
Update the specified resource in storage.**
@param\Illuminate\Http\Request $request *
@param int $id *
@return\Illuminate\Http\Response *
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'content' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }


        $UpdatedRecord = Note::find($id);
        $UpdatedRecord->content = $request->content;
        $UpdatedRecord->isDone = $request->isDone;


        $result = $UpdatedRecord->update($request->all());
        $result = $UpdatedRecord->save();

        return $this->createResponseMessage($result);
    }

    // this for destroy record :
    /***
Remove the specified resource from storage.*
     *
@param int $id *
 @return\Illuminate\Http\Response
     **/
    public function destroy($id)
    {

        try {
            $record = Note::findOrFail($id);
            $result =  Note::destroy($record->id);
        } catch (ModelNotFoundException $e) {
            return ['error' => 'the Note ($id) not found '];
        }

        return $this->createResponseMessage($result);
    }
}

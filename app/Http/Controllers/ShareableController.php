<?php

namespace App\Shareable\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Shareable\Model\Shareable;
use App\Shareable\Http\Requests\ShareableRequest;
use Validator;

class ShareableController extends Controller
{
    /***Store a newly created resource in storage.*
     *
    @param\Illuminate\Http\Request $request *
     @return\Illuminate\Http\Response *
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'note' => 'required',
            'from' => 'required',
            'shareable_user_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }


        $newRecord = new Shareable;
        $newRecord->note = $request->note;
        $newRecord->from = $request->from;
        $newRecord->shareable_user_id = $request->shareable_user_id;
        $result =  $newRecord->save();

        return $this->createResponseMessage($result);
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
            'note' => 'required',
            'from' => 'required',
            'shareable_user_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }


        $UpdatedRecord = Shareable::find($id);
        $UpdatedRecord->note = $request->note;
        $UpdatedRecord->from = $request->from;
        $UpdatedRecord->shareable_user_id = $request->shareable_user_id;


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
            $record = Shareable::findOrFail($id);
            $result =  Shareable::destroy($record->id);
        } catch (ModelNotFoundException $e) {
            return ['error' => 'the Shareable ($id) not found '];
        }

        return $this->createResponseMessage($result);
    }
}

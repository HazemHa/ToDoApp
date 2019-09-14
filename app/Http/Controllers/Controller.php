<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $messageSuccess = array('success' => 'task completed successfully');


    public $messageError = array('error' => 'task not completed successfully');
    public function createResponseMessage($result)
    {
        if ($result) {
            return response()->json($this->messageSuccess);
        } else {
            return response()->json($this->messageError);
        }
    }
}

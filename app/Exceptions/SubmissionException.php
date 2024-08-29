<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubmissionException extends Exception
{

    public function render(Request $request)
    {
        if ($request->isJson()) {
            return response()->json([
                'message' => $this->getMessage()
            ], $this->getCode());
        }

        return false;

    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\SubmissionException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Submission\PostRequest;
use App\Jobs\Submission\StoreSubmission;

class SubmissionController extends Controller
{
    public function submit(PostRequest $request)
    {

        try{

            StoreSubmission::dispatch($request->validated());

        } catch (\Exception $exception){
            throw new SubmissionException(__("Missing submission."), 404, $exception);
        }

        return response(['message' => 'ok'],200);
    }
}

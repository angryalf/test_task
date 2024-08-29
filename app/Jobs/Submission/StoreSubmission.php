<?php

namespace App\Jobs\Submission;

use App\Events\SubmissionSaved;
use App\Models\Submission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreSubmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $submissionData;

    /**
     * Create a new job instance.
     */
    public function __construct($submissionData)
    {
        $this->submissionData = $submissionData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        // store Submission
        $submission = Submission::create($this->submissionData);

        // fire SubmissionSaved Event
        event(new SubmissionSaved($submission));

    }
}

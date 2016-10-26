<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Contracts\Mail\Mailer;

use Log;
use Mail;

class ImportMozPlaces implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("Job started");
        Mail::send('email.welcome', ['data'=>'data'], function ($message) {
            $message->from('jb@piacentino.com', 'Jb Piacentino');
            $message->to('test@example.com');
        });
        Log::info("Job finished");
     
    }
}

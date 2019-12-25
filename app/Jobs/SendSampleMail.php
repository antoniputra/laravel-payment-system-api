<?php

namespace App\Jobs;

use App\Mail\SampleMail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SendSampleMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $retryAfter = 5;

    /**
     * @var App\User
     */
    protected $user;

    /**
     * @var integer
     */
    protected $number;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $number = 0)
    {
        $this->user = $user;
        $this->number = $number;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Illustration
        // Storage::disk('local')->append('myqueue.txt', $this->number . ' - ' . $this->user->email);

        // Sending Mail
        Mail::to($this->user)->send(new SampleMail($this->user));
    }

    public function failed(\Exception $exception)
    {
        Storage::disk('local')->append('myqueue.txt', '[failed]' . $this->user->email);
    }
}

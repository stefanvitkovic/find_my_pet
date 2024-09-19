<?php

namespace App\Jobs;

use App\Mail\FoundedMail;
use App\Mail\MissingMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mailData;
    protected $pet;
  
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mailData,$pet)
    {
        $this->mailData = $mailData;
        $this->pet = $pet;
    }
  
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->mailData->missing == 'missing')
        {
            $email = new MissingMail($this->mailData,$this->pet);
        }else{
            $email = new FoundedMail($this->mailData,$this->pet);
        }
        Mail::to($this->mailData->email)->send($email);

    }
}

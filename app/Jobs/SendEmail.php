<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $headers = 'From: tareapresencial@ieszaidinvergeles.org' . "\r\n";
        mail('mhidari0108@ieszaidinvergeles.org', 'Prueba', "Prueba Prueba Prueba Prueba Prueba Prueba Prueba Prueba ", $headers);
        // Mail::to('tareapresencial@ieszaidinvergeles.org')->send(new MyMail($this->message));
    }
}

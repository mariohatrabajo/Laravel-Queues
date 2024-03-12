<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Texto;

class Prueba implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct($q)
    {
        $this->queue = $q;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Para el proceso durante 2s
        sleep(2);
        // Añadimos un elemento a la bbdd
        $texto = new Texto();
        $texto->texto = $this->queue;
        $texto->save();
    }
}

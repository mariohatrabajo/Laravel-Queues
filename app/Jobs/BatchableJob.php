<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Texto;
use Illuminate\Bus\Batchable;

class BatchableJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        // Comprobamos que el paquete de trabajos no ha sido cancelado
        if (!$this->batch()->cancelled()) {
            // Para el proceso durante 2s
            sleep(2);
            // Añadimos un elemento a la bbdd
            $texto = new Texto();
            $texto->texto = "Batchable";
            $texto->save();        
        }
    }
}

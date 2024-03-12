<?php

use Illuminate\Support\Facades\Route;
use App\Jobs\Prueba;
use App\Jobs\SendEmail;
use App\Jobs\BatchableJob;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;

Route::get('/', function () {
    // Ejecuta el proceso despues del return
    // Prueba::dispatchAfterResponse();

    // Inicia el proceso en la queue 'default'
    Prueba::dispatch('default');

    return view('welcome');
})->name('welcome');


Route::get('/prueba', function(){
    // Iniciamos 10 procesos en la queue 'secondary'
    for($i = 0; $i < 10; $i++){
        Prueba::dispatch('secondary_'.$i)->onQueue('secondary');
    }
    return redirect(route('welcome'));
})->name('prueba');

Route::get('/batches', function(){
    echo 'Starting Batch<br>';
    $batch = Bus::batch([
        new BatchableJob(),
        new BatchableJob(),
        new BatchableJob(),
        new BatchableJob(),
        new BatchableJob(),
    ])->before(function (Batch $batch) {
        // The batch has been created but no jobs have been added...
        echo 'The batch has been created but no jobs have been added<br>';
    
    // De aqui para abajo solo funciona si está en modo síncrono
    })->progress(function (Batch $batch) {
        // A single job has completed successfully...
        echo 'A single job has completed successfully<br>';
    })->then(function (Batch $batch) {
        // All jobs completed successfully...
        echo 'All jobs completes successfully<br>';
    })->catch(function (Batch $batch, Throwable $e) {
        // First batch job failure detected...
        echo 'First batch job failure detected<br>';
    })->finally(function (Batch $batch) {
        // The batch has finished executing...
        echo 'The batch has finished executing<br>';
    })
    ->name('First Batch')
    ->dispatch();
     
    // return $batch->id;
})->name('batches');

Route::get('/sendEmail', function(){
    SendEmail::dispatch('default')->onQueue('default');
    return redirect(route('welcome'));
})->name('email');

/**
 * Iniciar el worker:
 * php artisan queue:work database --queue=default,secondary
 */
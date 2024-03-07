<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Artisan;

class MakeCrud extends FactoryFileCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'devx:make:crud {classname} {--mod= : this is module Name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command to make crud';

    function getFilePath(): string
    {
        return '';
    }

    function getStubPath(): string
    {
        return '';
    }

    function getSuffix(): string
    {
        return 'crud';
    }

    // function handle()
    // {
    //     dd($this->option("--mod="));
    // }

    function getOtherCommands()
    {
        Artisan::call('devx:make:repo', ['classname' => $this->argument('classname')]);
        Artisan::call('devx:make:blade', ['classname' => $this->argument('classname')]);
        Artisan::call('devx:make:route', ['classname' => $this->argument('classname')]);
        Artisan::call('devx:make:model', ['classname' => $this->argument('classname')]);
        Artisan::call('devx:make:migration', ['classname' => $this->argument('classname')]);
        Artisan::call('devx:make:controller', ['classname' => $this->argument('classname')]);
    }
}

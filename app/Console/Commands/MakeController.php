<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Artisan;

class MakeController extends FactoryFileCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'devx:make:controller {classname}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command to make controller class';

    function getFilePath(): string
    {
        return "app/Http/Controllers/Admin/";
    }

    function getStubPath(): string
    {
        return __DIR__ . "/Stubs/Controller.stub";
    }

    function getSuffix(): string
    {
        return "Controller";
    }

    function getOtherCommands()
    {
        Artisan::call('devx:make:request', ['classname' => $this->argument('classname')]);
        Artisan::call('devx:make:request', ['classname' => $this->argument('classname'), 'type' => 'u']);
    }
}

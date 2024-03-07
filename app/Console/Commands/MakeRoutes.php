<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Pluralizer;

class MakeRoutes extends FactoryFileCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'devx:make:route {classname}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command to make crud';

    function getClassName()
    {
        return 'web';
    }
    
    function getFileTitle()
    {
        return ucwords($this->argument("classname"));
    }

    function getFileVarSinquular()
    {
        return Pluralizer::singular($this->argument("classname"));
    }
    
    function getFileNameUsSinqular()
    {
        return ucwords(Pluralizer::singular($this->argument("classname")));
    }

    function getFilePath(): string
    {
        return "routes/";
    }

    function getStubPath(): string
    {
        return __DIR__ . "/Stubs/Route.stub";
    }

    function getSuffix(): string
    {
        return '';
    }

    function getOtherCommands(){}
}

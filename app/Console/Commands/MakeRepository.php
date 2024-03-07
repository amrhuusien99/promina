<?php

namespace App\Console\Commands;

use Illuminate\Support\Pluralizer;

class MakeRepository extends FactoryFileCommand
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'devx:make:repo {classname}';    

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command to make repository class';

    function getFilePath(): string
    {
        return "app/Http/Repositories/Eloquent/Admin/";
    }

    function getFileVarSinquular()
    {
        return Pluralizer::singular($this->argument("classname"));
    }

    function getStubPath(): string
    {
        return __DIR__ . "/Stubs/Repository.stub";
    }

    function getSuffix(): string
    {
        return "Repository";
    }

    function getOtherCommands(){}
}

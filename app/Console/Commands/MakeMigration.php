<?php

namespace App\Console\Commands;

class MakeMigration extends FactoryFileCommand
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'devx:make:migration {classname}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command to make migration class';
    
    function getClassName()
    {
        return $this->argument("classname");
    }

    function getFilePath(): string
    {
        return "database/migrations/2023_10_19_000000_create_";
    }

    function getStubPath(): string
    {
        return __DIR__ . "/Stubs/Migration.stub";
    }

    function getSuffix(): string
    {
        return "_table";
    }

    function getOtherCommands(){}
}

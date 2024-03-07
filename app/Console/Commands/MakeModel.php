<?php

namespace App\Console\Commands;


class MakeModel extends FactoryFileCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'devx:make:model {classname}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command to make model class';

    function getFilePath(): string
    {
        return "app/Models/";
    }

    function getStubPath(): string
    {
        return __DIR__ . "/Stubs/Model.stub";
    }

    function getSuffix(): string
    {
        return "";
    }

    function getOtherCommands(){}
}

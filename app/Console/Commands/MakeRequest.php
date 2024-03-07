<?php

namespace App\Console\Commands;


class MakeRequest extends FactoryFileCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'devx:make:request {classname} {type?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command to make request class';

    function getFilePath(): string
    {
        return "app/Http/Requests/Admin/{$this->getClassName()}Requests/";
    }

    function getClassType()
    {
        $class_type = '';
        switch($this->argument("type")) {
            case('u'):
                $class_type = 'Update';
                break;
                
            default:
                $class_type = 'Store';
                break;
        }
        return $class_type;
    }

    function getStubPath(): string
    {
        $class_type = $this->getClassType();
        return __DIR__ . "/Stubs/{$class_type}Request.stub";
    }

    function getSuffix(): string
    {
        $class_type = $this->getClassType();
        return "{$class_type}Request";
    }

    function getOtherCommands(){}
}

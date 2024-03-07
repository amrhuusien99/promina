<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Pluralizer;

class MakeBlade extends FactoryFileCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'devx:make:blade {classname} {type?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command to make request class';

    function getClassName()
    {
        return strtolower($this->getClassType());
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
        return "resources/views/admin/{$this->getNormalClassName()}/";
    }

    function getClassType()
    {
        $blade_type = '';
        switch($this->argument("type")) {
            case('i'):
                $blade_type = 'Index';
                break;
            case('c'):
                $blade_type = 'Create';
                break;
            case('u'):
                $blade_type = 'Update';
                break;
                
            case('a'):
                $blade_type = 'Archives';
                break;
                
            default:
                $blade_type = 'Index';
                break;
        }
        return $blade_type;
    }

    function getStubPath(): string
    {
        $blade_type = $this->getClassType();
        return __DIR__ . "/Stubs/{$blade_type}.stub";
    }

    function getSuffix(): string
    {
        return ".blade";
    }

    function getOtherCommands()
    {
        Artisan::call('devx:make:blade', ['classname' => $this->argument('classname'), 'type' => 'c']);
        Artisan::call('devx:make:blade', ['classname' => $this->argument('classname'), 'type' => 'u']);
        Artisan::call('devx:make:blade', ['classname' => $this->argument('classname'), 'type' => 'a']);
    }
}

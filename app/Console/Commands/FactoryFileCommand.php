<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Pluralizer;

abstract class FactoryFileCommand extends Command
{

    protected $file;

    public function __construct(Filesystem $file)
    {
        parent::__construct();
        $this->file = $file;
    }

    abstract function getFilePath(): string;
    abstract function getStubPath(): string;
    abstract function getSuffix(): string;
    abstract function getOtherCommands();
    public function getFileTitle(){}
    public function getFileVarSinquular(){}
    public function getFileNameUsSinqular(){}
    public function getVarRouteFromCommand(){}

    function getClassName()
    {
        return ucwords(Pluralizer::singular($this->argument("classname")));
    }

    function getNormalClassName()
    {
        return $this->argument("classname");
    }


    function makeDir($path)
    {
        $this->file->makeDirectory($path, 0777, true, true);
    }

    function getFileKeys($routes_content = NULL)
    {
        return [
            '$NAME' => $this->getClassName(),
            '$NORMALNAME' => $this->getNormalClassName(),
            '$FILTITLE' => $this->getFileTitle(),
            '$FILEVARSINQULAR' => $this->getFileVarSinquular(),
            '$FILENAMEUSSINQULAR' => $this->getFileNameUsSinqular(),
            '//ROUTEFROMCOMMANDLINE' => $routes_content
        ];
    }

    function setFileContint($file_path, $fileKeys)
    {
        $keys = [];
        $values = [];
        $content = file_get_contents($file_path);
        foreach ($fileKeys as $key => $value) {
            $keys [] = $key;
            $values [] = $value;
        }
        $template = str_replace($keys, $values, $content);
        return $template;
    }

    function handle()
    {
        if($this->getSuffix() != 'crud'){
            $file_path = base_path($this->getFilePath()) . $this->getClassName() . $this->getSuffix() . '.php';
            if($this->file->exists($file_path) && $this->getFilePath() !== "routes/"){
                return $this->info("file {$this->getSuffix()} is exists");
            }
            $this->makeDir(dirname($file_path));
            $file_content = $this->setFileContint($this->getStubPath(), $this->getFileKeys());
            if($this->getFilePath() == "routes/"){
                $file_content = $this->setFileContint($file_path, $this->getFileKeys($file_content . "      //ROUTEFROMCOMMANDLINE"));
            }
            $this->file->put($file_path, $file_content);
        }
        $this->getOtherCommands();
        $this->info('created has been done');
    }
    
}

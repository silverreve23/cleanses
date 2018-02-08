<?php

namespace SBKInfo\Cleanses\Commands;

use Illuminate\Console\Command;

class CleanserCommand extends Command{

	protected $signature = "make:cleanser {class}";
    private $pathCleanses = null;
    private $pathStubClass = null;
    private $stubCleanseClass = null;
    
	protected $description = 'Command description.';

	public function __construct(){

		parent::__construct();
        
        $this->pathCleanses = base_path(
            'database/cleanses'
        );
        
        $this->pathStubClass = './../../stubs/class.stub';

	}

	public function handle(){

		$message = "\nCreate cleanse started!\n";
        
		$this->info($message);
        $this->parseClass();
        $this->createClass();
        

	}
     
    private function parseClass(){
        
        $this->stubCleanseClass = file_get_contents(
            $this->pathStubClass
        );
        
        echo $this->stubCleanseClass;
        
//        $this->stubCleanseClass = str_replace();
        
        
    }  
    
    private function createClass(){
        
        $class = $this->argument('class');
        
        $nameCleanseClass = $this->pathCleanses
            .'/'
            .$class
            .'.php';
        
        $message = 'Error! This class name exist!';
        
        if(file_exists($this->pathCleanses))
            if(!file_exists($nameCleanseClass)){
                
                $message = "Create cleanse finished!\n";
        
                file_put_contents(
                    $nameCleanseClass, 
                    $this->stubCleanseClass
                );
                
                $this->info($message);
                
            }
            else
                $this->error($message);
        
        
    }

}

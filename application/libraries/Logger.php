<?php

/**
 * 
 * monolog-like logger for Codeigniter 3
 * use it as library or manually include
 * 
 * @adib-enc
 * 
 */
class Logger{
    /**
     * Detailed debug information
     */
    public const DEBUG = 100;

    /**
     * Interesting events
     *
     * Examples: User logs in, SQL logs.
     */
    public const INFO = 200;

    /**
     * Uncommon events
     */
    public const NOTICE = 250;

    /**
     * Exceptional occurrences that are not errors
     *
     * Examples: Use of deprecated APIs, poor use of an API,
     * undesirable things that are not necessarily wrong.
     */
    public const WARNING = 300;

    /**
     * Runtime errors
     */
    public const ERROR = 400;

    /**
     * Critical conditions
     *
     * Example: Application component unavailable, unexpected exception.
     */
    public const CRITICAL = 500;

    /**
     * Action must be taken immediately
     *
     * Example: Entire website down, database unavailable, etc.
     * This should trigger the SMS alerts and wake you up.
     */
    public const ALERT = 550;

    /**
     * Urgent alert.
     */
    public const EMERGENCY = 600;

    /**
     * Monolog API version
     *
     * This is only bumped when API breaks are done and should
     * follow the major version of the library
     *
     * @var int
     */
    public const API = 2;
    
    public $type;
    public $filename, $baseDir;

    public function __construct($type = "file"){
        $this->setDefaultDir()
            ->setDefaultFilename();
    }

    public function now(){
        return date("Y-m-d H:i:s");
    }
    
    public function appendToFile($text){
        // $mt = microtime(true);
        $mt = "";
        $text = "[".$this->now()."] $mt ".$text;
        return file_put_contents($this->getFilename(), $text.PHP_EOL , FILE_APPEND | LOCK_EX);
    }

    // append text 2 file
    public function addRecord(int $level, string $message, array $context = []): bool{
        if( !empty($context)){
            $context = json_encode($context);
        }else{
            $context = "";
        }
        $arr = [$level, $message, $context];
        $text = implode(" ", $arr);

        return $this->appendToFile($text);
    }

    public function logs($a){

    }

    /**
     * Log data at INFO level
     * 
     * with ci superobject :
     * $this->logger->info("Test");
     * $this->logger->info("Info");
     * 
     */
    public function info($message, array $context = [])
    {
        $this->addRecord(static::INFO, (string) $message, $context);

        return [static::INFO, (string) $message, $context];
    }
 
	public function getType(){
		return $this->type;
	}

	public function setType($type){
		$this->type = $type;

		return $this;
    }
 
	public function getFilename(){
		return $this->filename;
	}

	public function setFilename($filename){
		$this->filename = $this->getBaseDir().$filename;

		return $this;
    }

	public function setAbsFilename($filename){
		$this->filename = $filename;

		return $this;
    }
    
	public function setDefaultDir(){
        $this->baseDir = APPPATH."/logs/";

        return $this;
    }

	public function setDefaultFilename(){
        $baseDir = APPPATH."/logs/";
		return $this->setFilename($baseDir."ci3.log");
	}
 
	public function getBaseDir(){
		return $this->baseDir;
	}

	public function setBaseDir($baseDir){
		$this->baseDir = $baseDir;

		return $this;
	}
}
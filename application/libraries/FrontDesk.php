<?php

include_once(__DIR__."/Logger.php");

// depend on logger lib
class FrontDesk{
    public $logger;

    public function __construct($type = "file"){
        $this->setDefaultDir()
            ->setDefaultFilename();
        $this->logger = new Logger();
    }

    public function initStats(){
        $this->setFilename("stats.json");
        $cnts = [
            "today" => 1,
            "currentMonth" => 1,
            "currentYear" => 1,
        ];
        $v = [
            "counts" => $cnts,
            "last" => $this->now(),
        ];
        file_put_contents($this->getFilename(), json_encode($v, JSON_PRETTY_PRINT));

        return $v;
    }
    
    public function countsVisitor(){
        $this->setFilename("stats.json");
        $fname = $this->getFilename();

        /* 
        if visitor file exist
            update existing & return parsed
        else
            init and return parsed
        */

        // prevent duplication
        if( file_exists($fname) ){
            $allowAddCounter = $this->conditionalLogsVisitor();
            $data = null;
            
            if(!$allowAddCounter){
                return $this->getCurrentStats();
            }
            $data = $this->updateStats();
        }else{
            $data = $this->initStats();
        }

        return $data;
    }
    
    public function getCurrentStats(){
        $this->setFilename("stats.json");
        $fname = $this->getFilename();
        $ret = json_decode( file_get_contents($fname), true );
        return $ret;
    }
    
    public function updateStats(){
        $this->setFilename("stats.json");
        $cstat = $this->getCurrentStats();
        $counts = $cstat['counts'];
        $ctoday = $counts['today'];
        $cstat['counts']['today'] = $ctoday + 1;
        $cstat['counts']['currentMonth'] = $counts['currentMonth'] + 1;
        $cstat['counts']['currentYear'] = $counts['currentYear'] + 1;
        $cstat['last'] = $this->now();

        $this->toJsonFile($cstat);
        
        return $cstat;
    }

    public function toJsonFile($data){
        return file_put_contents($this->getFilename(), json_encode($data, JSON_PRETTY_PRINT));
    }

    /* 
    logs visitor ONLY if not logged
    return true if successfully logged, else return false
    */
    public function conditionalLogsVisitor(){
        $fname = $this->today().".visitor.log";
        $this->setFilename($fname);
        $logfile = $this->getFilename();
        if(! file_exists($logfile)){
            $this->toFile("", $logfile);
        }
        $cont = file_get_contents($logfile);

        if( strlen($cont) >0 ){
            $loggedToday = strpos($cont, $_SERVER['REMOTE_ADDR']) > 0;
        }else{
            $loggedToday = false;
        }

        if(!$loggedToday){
            $this->logsVisitor();
            return true;
        }

        return false;
    }

    public function logsVisitor(){
        $this->logger
            ->setFilename($this->today().".visitor.log")
            ->info($_SERVER['REMOTE_ADDR']." ".$_SERVER['REQUEST_URI'], []);
    }

    public function now(){
        return date("Y-m-d H:i:s");
    }
    
    public function today(){
        return substr( $this->now(),0,10);
    }

    public function appendToFile($text){
        $mt = microtime(true);
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

    function toFile($content = "cnt", $file = "file"){
        $f = fopen($file, "w");
        fwrite($f,$content);
        fclose($f);
        return true;
    }
}
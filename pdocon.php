<?php
class PdoCon extends PDO { 
    
    private $engine; 
    private $host; 
    private $database; 
    private $user; 
    private $pass; 
    
    public function __construct(){ 
    	    
		$this->engine = 'mysql'; 
        $this->host = 'xxxx'; 
        $this->database = 'formularios'; 
        $this->user = 'root'; 
        $this->pass = 'xxxxx'; 

        $dns = $this->engine.':dbname='.$this->database.";host=".$this->host; 
        
        parent::__construct( $dns, $this->user, $this->pass ); 
        $this->exec("SET CHARACTER SET utf8");
    } 
} 
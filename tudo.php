<?php

class PdoCon extends PDO { 
    
    private $engine; 
    private $host; 
    private $database; 
    private $user; 
    private $pass; 
    
    public function __construct(){ 
    	
    	if($_SERVER["HTTP_HOST"] == "11localhost:8888"){
	        $this->engine = 'mysql'; 
	        $this->host = 'localhost'; 
	        $this->database = 'formularios'; 
	        $this->user = 'root'; 
	        $this->pass = 'root'; 
    	} else {
    		$this->engine = 'mysql'; 
	        $this->host = 'cpro21753.publiccloud.com.br'; 
	        $this->database = 'formularios'; 
	        $this->user = 'root'; 
	        $this->pass = '050887'; 
    	}
        
        $dns = $this->engine.':dbname='.$this->database.";host=".$this->host; 
        
        parent::__construct( $dns, $this->user, $this->pass ); 
        $this->exec("SET CHARACTER SET utf8");
    } 
} 

class Pessoa {
	public $nome;
	public $dt_nascimento;
	public $sexo;
	public $estado;
}

class Perguntas{

	public function listaPerguntas() {
		$con = new PdoCon();
		$sql = 'SELECT id, tipo, txt_pergunta, obrigatoria FROM perguntas';
		$arrayPerguntas = Array();
	    foreach ($con->query($sql) as $row) {
	    	$pergunta = new stdClass();
	    	$pergunta->id = $row['id'];
	    	$pergunta->tipo = $row['tipo'];
	    	$pergunta->txt_pergunta = $row['txt_pergunta'];
	    	$pergunta->obrigatoria = $row['obrigatoria'];
	    	$arrayPerguntas[] = $pergunta;
	    }
	    return $arrayPerguntas;
	}

	
}










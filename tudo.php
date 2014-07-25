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

	public function grava() {
		return true;
	}
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

	public function grava($key, $resposta, $id_pessoa) {
		if ($pergunta = $this->verificaPergunta($key)) {
			$con = new PdoCon();

			// TODO : VALIDAR O INSERT

			$con->exec("INSERT INTO respostas (id_pergunta, resposta, id_pessoa) VALUE ('" . $pergunta->id . "', '" . $resposta . "', '" . $id_pessoa . "' ) ");
			echo "haahha";
		} else {
			return false;
		}

	}

	private function verificaPergunta($key) {
		$arrayPergunta = explode("_", $key);
		if (isset($arrayPergunta[0]) && $arrayPergunta[0] == 'pergunta') {
			
			$idPergunta = intval($arrayPergunta[1]);
			$pergunta = $this->consulta($idPergunta);

			if($pergunta) {
				return $pergunta;
			} else {
				return false;
			}

		} else {
			return false;
		}
	}

	public function consulta($id) {
		$con = new PdoCon();
		$sql = 'SELECT id, tipo, txt_pergunta, obrigatoria FROM perguntas WHERE id = ' . $id;

		// TODO : VALIDAR SE ESTÁ RETORNANDO ALGUMA COISA
		foreach ($con->query($sql) as $row) {
			$pergunta = new stdClass();
	    	$pergunta->id = $row['id'];
	    	$pergunta->tipo = $row['tipo'];
	    	$pergunta->txt_pergunta = $row['txt_pergunta'];
	    	$pergunta->obrigatoria = $row['obrigatoria'];
	    	return $pergunta;
	    }
	    

	}
	
}










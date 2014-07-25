<?php
include "tudo.php";

// [pergunta_1_resposta] => 
// [pergunta_2] => 
// [pergunta_3_resposta] => 
// [pergunta_4_resposta] => 
// [pergunta_6] => 
// [pergunta_8] => 
// [pergunta_9_resposta] => 
// [pergunta_11_resposta] => 
// [pergunta_13] => 

$pessoa = new Pessoa();
$pessoa->nome = $_POST["nome"];
$pessoa->dt_nascimento = $_POST["dt_nascimento"];
$pessoa->sexo = $_POST["sexo"];
$pessoa->estado = $_POST["estado"];

$perguntas = new Perguntas();

if ($pessoa->grava()) {

	foreach ($_POST as $key => $resposta) {
		$perguntas->grava($key, $resposta, 1);
	}

}

//header("Location: index.php");




<?php
include "tudo.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Questionário para intolerantes à lactose</title>
	<style type="text/css">
		* {
			margin: 0;
			padding: 0;
			font-size: 15px;
			font-family: "Tahoma";
		}

		h1 {
			padding: 0 0 30px 10px;
			font-size: 24px;
			margin-top: 20px;
		}

		#collapse {
			width: 982px;
			margin: 0 auto;
			padding: 10px;
		}

		form {
			float: left;
			padding: 10px 10px 0;
			box-shadow: 0px 0px 16px #D3D3D3;
			border-radius: 4px;
			margin-bottom: 20px;
		}

		.linha {
			float: left;
			clear: both;
			width: 98%;
			padding: 10px;
			margin-bottom: 10px;
		}

		form .linha:last-child {
			margin-bottom: 0;
		}

		.gray {
			background: rgb(240, 240, 240);
		}

		label {
			width: 100%;
			clear: both;
			float: left;
			margin-bottom: 5px;
			font-size: 15px;
		}

		.radiogroup label {
			margin: 2px 0 5px;
		}

		.radiogroup label.lblInputText {
			float: left;
			clear: none;
			width: auto;
			margin-right: 10px;
			margin-top: 5px;
		}

		input[type="text"], select {
			clear: both;
			height: 22px;
			padding: 4px;
			margin-right: 4px;
			font-size: 15px;
			width: 20%;
			border-radius: 2px;
			border: 1px solid #D3D3D3;
		}

		select {
			height: 38px;	
			width: 15%;
		}

		select#estado {
			height: 38px;	
			width: 7%;
		}

		input[type="radio"] {
			margin-right: 5px;
			margin-top: 4px;
			float: left;
		}

		input[type="text"]#nome {
			width: 25%;
		}

		input[type="text"]#idade {
			width: 10%;
		}

		input[type="text"].small {
			width: 3%;
			text-align: center;
		}

		input[type="text"]#listaIntolerancia {
			width: 40%;
		}

		input[type="text"]#consumirAlimentos {
			width: 99%;
		}

		.linha.buttons {
			text-align: right;
			width: 99%;
		}

		.linha.buttons i {
			text-align: left;
			float: left;
			font-size: 12px;
			color: #FF0000;
		}

		input[type="submit"], input[type="reset"] {
			border-radius: 3px;
			border: 0;
			padding: 10px 24px;
			cursor: pointer;
			background: rgb(195, 195, 195);
			font-size: 16px;
		} 
		
		input[type="reset"] {
			background: none;
			text-decoration: underline;
			font-size: 14px;
		}

		#showListaIntolerancia {
			display: none;
		}

		.required {
			border: 1px solid red !important;
		}

		.linha p {
			color: #FF0000;
		}

	</style>
</head>
<body>
	<div id="collapse">
	<h1>Questionário para intolerantes à lactose</h1>
		<div class="linha">
			<p>A(s) questão(ões) 2, 3 e 6 são obrigatórias.</p>
		</div>
		<form id="formulario" method="post" action="grava.php">
			<div class="linha">
				<label>1. Nome</label>
				<input id="nome" name="nome" type="text"/>
			</div>
			<div class="linha gray">
				<label>2. Data de nascimento*</label>
				<input id="data_nascimento" name="dt_nascimento" type="text"/>
			</div>
			<div class="linha">
				<label>3. Sexo*</label>
				<select name="sexo">
					<option select="selected">Selecione...</option>
					<option>Masculino</option>
					<option>Feminino</option>
				</select>
			</div>
			<div class="linha gray">
				<label>4. Estado*</label>
				<select name="estado" id="estado">
				    <option value="AC">AC</option>
				    <option value="AL">AL</option>
				    <option value="AM">AM</option>
				    <option value="AP">AP</option>
				    <option value="BA">BA</option>
				    <option value="CE">CE</option>
				    <option value="DF">DF</option>
				    <option value="ES">ES</option>
				    <option value="GO">GO</option>
				    <option value="MA">MA</option>
				    <option value="MG">MG</option>
				    <option value="MS">MS</option>
				    <option value="MT">MT</option>
				    <option value="PA">PA</option>
				    <option value="PB">PB</option>
				    <option value="PE">PE</option>
				    <option value="PI">PI</option>
				    <option value="PR">PR</option>
				    <option value="RJ">RJ</option>
				    <option value="RN">RN</option>
				    <option value="RO">RO</option>
				    <option value="RR">RR</option>
				    <option value="RS">RS</option>
				    <option value="SC">SC</option>
				    <option value="SE">SE</option>
				    <option value="SP">SP</option>
				    <option value="TO">TO</option>
				</select>
			</div>

			<?php
				$perguntas = new Perguntas();
				$arrayPerguntas = $perguntas->listaPerguntas();
				foreach ($arrayPerguntas as $key => $pergunta) {
					if ( ($key % 2) == 0) {
						$pinta = "";
					} else {
						$pinta = "gray";
					}

					// Chave mais o numero de campos que a pessoa tem
					$numeroPergunta = $key+5;

			?>
			<div class="linha <?php echo $pinta; ?>">
				<label><?php echo  $numeroPergunta . ". ". $pergunta->txt_pergunta; ?><?php if ($pergunta->obrigatoria == "S") { echo "*"; } ?></label>

				<?php

				$name = "pergunta_" . $pergunta->id;

				switch ($pergunta->tipo) {
					case 'VFT':
					?>
						<div class="radiogroup">
							<label id="nRestaurantesLactose"><input type="radio" name="<?php echo $name ?>" for="nRestaurantesLactose"><span>Não</span></label>
							<label id="RestaurantesLactose"><input type="radio" name="<?php echo $name ?>" for="RestaurantesLactose"><span>Sim</span></label>	
							<label class="lblInputText" for="nomeRestaurante">Quais</label>
							<input type="text" id="nomeRestaurante" name="<?php echo $name ?>_resposta">							
						</div>
					<?php
						break;
					case 'VF':
					?>
						<div class="radiogroup">
							<label id="semIntolerancia"><input type="radio" name="<?php echo $name ?>" for="semIntolerancia"><span>Não</span></label>
							<label id="comIntolerancia"><input type="radio" name="<?php echo $name ?>" for="comIntolerancia"><span>Sim</span></label>	
							<div id="showListaIntolerancia">
								<label class="lblInputText" for="listaIntolerancia">Quais</label><input type="text" id="listaIntolerancia">			
							</div>
						</div>
					<?php
						break;
					case 'TEXTO':
					
					?> <input type="text" id="consumirAlimentos" name="<?php echo $name ?>" /><?php	
						
						break;
					case 'PONTUACAO':
					?>
						<label for="opt1"><input id="opt1"  class="small" type="text"/><span>Encontrar produtos sem lactose</span></label>
						<label for="opt2"><input id="opt2" class="small" type="text"/><span>Achar e compartilhar receitas para intolerantes à lactose</span></label>
						<label for="opt3"><input id="opt3" class="small" type="text"/><span>Um espaço para troca de ideias e informações</span></label>
						<label for="opt4"><input id="opt4" class="small" type="text"/><span>Locais que ofereçam pratos sem lactose</span></label>
					<?php
						break;
					default:
						
						?> <input type="text" id="consumirAlimentos" name="<?php echo $name ?>" /><?php	

						break;
				}
				?>
				
			</div>
			<?php
				}
			?>
			<div class="linha buttons">
				<i>* Questões obrigatórias</i>
				<input type="reset" value="Limpar" />
				<input type="submit" value="Enviar" />
			</div>
		</form>
	</div>
</body>
</html>
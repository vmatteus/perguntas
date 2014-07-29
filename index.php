<?php
include "tudo.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Questionário para intolerantes à lactose</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script>

	function perguntaSn(name) {
		var pergunta = $("[name="+name+"]"); 
		var pergunta_resposta = $("[name="+name+"_resposta]"); 
		var lbl_pergunta_respota = $(".lbl"+name+"_resposta"); 
		pergunta.click(function(){
			if (pergunta.filter(':checked').val() == "S") {
				pergunta_resposta.show();
				lbl_pergunta_respota.show();
			} else {
				pergunta_resposta.hide();
				lbl_pergunta_respota.hide();
			}
		});
	}

	function validaCampos() {
		
		var dt_nascimento = $("[name=dt_nascimento]");
		var sexo = $("[name=sexo]");
		var estado = $("[name=estado]");

		var txt_e = "é obrigatória."; // são ou é
		var txt_sao = "são obrigatórias."; // são ou é
		var txt_e_ou_sao = "";
		var num_quest_obrigatorias = "";

		var countObrigatorias = 0;
		
		if (dt_nascimento.val() == "") {
			countObrigatorias++;
			num_quest_obrigatorias = "2";
			txt_e_ou_sao = txt_e;
		}

		if (sexo.val() == "") {
			if(countObrigatorias > 0) {
				countObrigatorias++;
				num_quest_obrigatorias += ", 3";
				txt_e_ou_sao = txt_sao;
			} else {
				countObrigatorias++;
				num_quest_obrigatorias += "3";
				txt_e_ou_sao = txt_e;
			}
		}

		if (estado.val() == "") {
			if(countObrigatorias > 1) {
				countObrigatorias++;
				num_quest_obrigatorias += ", 4";
				txt_e_ou_sao = txt_sao;
			} else {
				countObrigatorias++;
				num_quest_obrigatorias += "4";
				txt_e_ou_sao = txt_e;
			}
		}

		var txt_obrigatorio = "A(s) questão(ões) "+ num_quest_obrigatorias + " " + txt_e_ou_sao;

		if (countObrigatorias > 0) {
			$(".questoesObrigatorias").html(txt_obrigatorio);
			$("body").scrollTop(0);
			return false;
		} else {
			return true;
		}

	}

	$(document).ready(function(){
		
		// VFT
		perguntaSn("pergunta_1");
		perguntaSn("pergunta_3");
		perguntaSn("pergunta_4");
		perguntaSn("pergunta_5");
		perguntaSn("pergunta_9");
		perguntaSn("pergunta_11");

		// pergunta2, pergunta6, pergunta7, pergunta8, pergunta10, pergunta12, pergunta13
		

		$("#formulario").submit(function(){
			return validaCampos();
		});

	});
	</script>
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
			<p class="questoesObrigatorias"></p>
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
					<option value="" select="selected">Selecione...</option>
					<option value="Masculino">Masculino</option>
					<option value="Feminino">Feminino</option>
				</select>
			</div>
			<div class="linha gray">
				<label>4. Estado*</label>
				<select name="estado" id="estado">
					<option value="">Selecione...</option>
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

				<?php 
				$perguntaLabel = $pergunta->txt_pergunta;
				$perguntaLabelArray = explode("|", $perguntaLabel);
				if (count($perguntaLabelArray) > 1) {
					$perguntaLabel = $perguntaLabelArray[0];
				}
				?>

				<label><?php echo  $numeroPergunta . ". ". $perguntaLabel; ?><?php if ($pergunta->obrigatoria == "S") { echo "*"; } ?></label>

				<?php

				$name = "pergunta_" . $pergunta->id;

				switch ($pergunta->tipo) {
					case 'VFT':
					?>
						<div class="radiogroup">
							<label id="<?php echo $name ?>_n"><input type="radio" name="<?php echo $name ?>" for="nRestaurantesLactose" value="N"><span>Não</span></label>
							<label id="<?php echo $name ?>_s"><input type="radio" name="<?php echo $name ?>" for="RestaurantesLactose" value="S"><span>Sim</span></label>	
							<label style="display: none" class="lblInputText lbl<?php echo $name ?>_resposta" for="<?php echo $name ?>_resposta">Quais</label>
							<input style="display: none" type="text" id="<?php echo $name ?>_resposta" name="<?php echo $name ?>_resposta">							
						</div>
					<?php
						break;
					case 'VF':
					?>
						<div class="radiogroup">
							<label id="semIntolerancia"><input type="radio" name="<?php echo $name ?>" for="semIntolerancia" value="N"><span>Não</span></label>
							<label id="comIntolerancia"><input type="radio" name="<?php echo $name ?>" for="comIntolerancia" value="S"><span>Sim</span></label>	
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

					array_shift($perguntaLabelArray);
					foreach ($perguntaLabelArray as $perguntaPont) {
					?>
						<label for="opt1"><input id="opt1"  class="small" type="text"/><span><?php echo $perguntaPont; ?></span></label>
					<?php
					} 
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
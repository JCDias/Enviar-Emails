<?php
	//Configurações data e hora 
	date_default_timezone_set('America/Sao_Paulo');
	
	//Incluindo classe do phpmailer
	require_once('C:\wamp\www\Lutas\PHPMailer-master\class.phpmailer.php');
	require_once('C:\wamp\www\Lutas\PHPMailer-master\class.smtp.php');
	
	
	//Preparando o email
	$mail = new PHPMailer();
	
	// Configurando acesso ao gmail caso outro servidor alterar essas configurações
	$mail->IsSMTP();
	$mail->Mailer = 'smtp';
	$mail->SMTPAuth = true;
	$mail->Host = 'smtp.gmail.com'; // "ssl://smtp.gmail.com" didn't worked
	$mail->Port = 465;
	$mail->SMTPSecure = 'ssl';
	// or try these settings (worked on XAMPP and WAMP):
	// $mail->Port = 587;
	// $mail->SMTPSecure = 'tls';
	
	//Setando usuário e senha
	$mail->Username = "email@email.com";
	$mail->Password = "senha";
	 
	$mail->IsHTML(true); // if you are going to send HTML formatted emails
	//$mail->SingleTo = true; // if you want to send a same email to multiple users. multiple emails will be sent one-by-one.
	
	//Alterar o tempo máximo de execução
	ini_set('max_execution_time','3600'); //Tempo Máximo de 1 hora para enviar todos os emails, alterar conforme a quantidade a ser envida
	
	//Definindo nome do remetente
	$mail->From = "Email do Remetente";
	$mail->FromName = utf8_decode("Nome do remetente");
	
	$hifem = '-';
	
	//Assunto e corpo da mensagem
	$mail->Subject   = utf8_decode('Assunto do email');
	$mail->Body      = utf8_decode('Corpo da mensagem'); // Utilizar 2 <br/> para separar o texto
	
	//Array de nomes gerado pelo lertxt.php
	$nomes = [];
	
	//Array de emails gerado pelo lertxt.php
	$emails = [];
	
	//Exibir a data e horário de início do envio
	echo "Inicio: ".date('d/m/Y H:i:s')."<br/>";
	
	//Fazer for aki para alterar o AddAddress e o AddAttachment
	for($i=0;$i<=7;$i++){ // Sempre mudar para quantidade total de email menos 1
		
		//Setando email e nome do destinatário
		$mail->AddAddress($emails[$i]);
		
		//Anexando o Arquivo
		$nome_arquivo = $nomes[$i].'.pdf';
		$mail->AddAttachment( $nome_arquivo);
		
		// Enviando Email
		if(!$mail->Send()){
			//Exibir mensagem de erro para cada email
			echo utf8_decode(($i+1)." - A Mensagem não foi enviada <br />PHPMailer Error: ") . $mail->ErrorInfo.'<br/>';
		}else{
			//exibir mensagem de sucesso para cada email
			echo ($i+1)." - Mensagem enviada para ".$nomes[$i]." Arquivo:  ".$nome_arquivo.' Email: '.$emails[$i].' - '.date('H:i:s')."<br/>";
			$mail->ClearAllRecipients();//Limpar os campos
			$mail->ClearAttachments();//Limpar os anexos
		}
	}//fim do for
	
	//Exibir a data e horário de términio do envio
	echo "Fim: ".date('d/m/Y H:i:s');
	
?>
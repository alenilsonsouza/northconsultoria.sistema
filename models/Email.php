<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

class Email extends model{

	private $nome;
	private $email;
	private $telefone;
	private $assunto;
	private $mensagem;

	public function setNome($nome){
		if(filter_var($nome, FILTER_SANITIZE_STRING)){
			$this->nome = $nome;
		}
	}

	public function setEmail($email){
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			$this->email = $email;
		}
	}

	public function setTelefone($telefone){
		if(filter_var($telefone, FILTER_SANITIZE_STRING)){
			$this->telefone = $telefone;
		}
	}

	public function setAssunto($assunto){
		if(filter_var($assunto, FILTER_SANITIZE_STRING)){
			$this->assunto = $assunto;
		}
	}

	public function setMensagem($mensagem){
		if(filter_var($mensagem, FILTER_SANITIZE_STRING)){
			$this->mensagem = $mensagem;
		}
	}
	
	public function enviarContato(){

		$site = new Site();
		$item = $site->getArray();

		$para    = $item['emails'];
		$assunto = $this->assunto;
		$subject = 'Life Cartões - '.$this->assunto;
		$message = "
		<html>
		<head>
		  <title>AleEvolucoes</title>
		</head>
		<body>
		  <table>
		    <tr>
		      <td>Nome: </td>
		      <td>".$this->nome."</td>
		    </tr>
		    <tr>
		      <td>E-mail: </td>
		      <td>".$this->email."</td>
		    </tr>
		    <tr>
		      <td>Assunto: </td>
		      <td>".$this->assunto."</td>
		    </tr>
		   
		    <tr>
		      <td>Mensagem / Descrição do projeto:</td>
		      <td>".$this->mensagem."</td>
		    </tr>
		  </table>
		</body>
		</html>
		";
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "From: Site <site@aleevolucoes.com.br>\r\n";
		$headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
		$headers .= "X-Mailer: PHP/" . phpversion ();

		mail($para, $subject, $message, $headers);
	}

	public function enviarOrcamento(){

		$site = new Site();
		$item = $site->getArray();

		$para    = $item['emails'];
		$assunto = $this->assunto;
		$subject = 'Pedido de Orçamento - '.$this->assunto;
		$message = "
		<html>
		<head>
		  <title>AleEvolucoes</title>
		</head>
		<body>
		  <table>
		    <tr>
		      <td>Nome: </td>
		      <td>".$this->nome."</td>
		    </tr>
		    <tr>
		      <td>E-mail: </td>
		      <td>".$this->email."</td>
		    </tr>
		    <tr>
		      <td>Telefone: </td>
		      <td>".$this->telefone."</td>
		    </tr>
		    <tr>
		      <td>Mensagem</td>
		      <td>".$this->mensagem."</td>
		    </tr>
		  </table>
		</body> 
		</html>
		";
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "From: Site <site@aleevolucoes.com.br>\r\n";
		$headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
		$headers .= "X-Mailer: PHP/" . phpversion ();

		mail($para, $subject, $message, $headers);
	}

	public function sendEmail() {
		
		// Instantiation and passing `true` enables exceptions
		$mail = new PHPMailer(true);

		try {
			//Server settings
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
			$mail->isSMTP();                                            // Send using SMTP
			$mail->Host       = 'mail.lifecartoes.com.br';              // Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = 'sitelifecartoes';                     // SMTP username
			$mail->Password   = 'S43A59GSA';                               // SMTP password
			//$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
			$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

			//Recipients
			$mail->setFrom('sitelifecartoes@lifecartoes.com.br', 'Life Cartões');
			$mail->addAddress($this->email, $this->nome);     // Add a recipient

			// Attachments
			//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

			// Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = $this->assunto;
			$mail->Body    = $this->mensagem;
			//$mail->AltBody = $this->mensagem;

			$mail->send();
			return $mail->ErroInfo;
		} catch (Exception $e) {
			return $mail->ErrorInfo;
		}
	}

	// envio com função mail() para o email setado
	public function sendEmailTo(){

		$para    = $this->email;
		$subject = $this->assunto;

		//Montagem do corpo do email em HTML
		$message = "
		<html>
			<head>
				<title>Life Cartões</title>
			</head>
			<body>
				<p>Olá <strong>".$this->nome."</strong>,</p>	
				".$this->mensagem."
			</body>
		</html>";

		//Cabeçalhos
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "From: Life Cartões <sitelifecartoes@lifecartoes.com.br>\r\n";
		$headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
		$headers .= "X-Mailer: PHP/" . phpversion ();
		
		if(ENVIRONMENT == 'preview' || ENVIRONMENT == 'production'){
			mail($para, $subject, $message, $headers);
		}
		
	}
}



<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

class Email extends model
{

	private $nome;
	private $email;
	private $telefone;
	private $assunto;
	private $mensagem;
	private $emailTo = 'pianaseguros@gmail.com, northconsultoria.es@gmail.com, smnorteconsultoria@gmail.com';
	private $emailFrom = 'contato@northconsultoria.net.br';
	private $link;
	private $title = 'North Consultoria';

	public function setNome($nome)
	{
		$this->nome = $nome;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function setTelefone($telefone)
	{
		$this->telefone = $telefone;
	}

	public function setAssunto($assunto)
	{
		$this->assunto = $assunto;
	}

	public function setMensagem($mensagem)
	{
		$this->mensagem = $mensagem;
	}

	public function setLink($link)
	{
		$this->link = $link;
	}

	public function enviarContato()
	{

		$para    = $this->emailTo;
		$subject = $this->assunto . ' North Consultoria';
		$message = "
		<html>
		<head>
		  <title>{$this->title}</title>
		</head>
		<body>
		  <table>
		    <tr>
		      <td>Nome: </td>
		      <td>" . $this->nome . "</td>
		    </tr>
		    <tr>
		      <td>E-mail: </td>
		      <td>" . $this->email . "</td>
		    </tr>
		    <tr>
		      <td>Assunto: </td>
		      <td>" . $this->assunto . "</td>
		    </tr>
		   
		    <tr>
		      <td>Mensagem:</td>
		      <td>" . $this->mensagem . "</td>
		    </tr>
		  </table>
		</body>
		</html>
		";
		$this->toSend($para, $subject, $message);
	}

	public function enviarOrcamento()
	{

		$site = new Site();
		$item = $site->getArray();

		$para    = $this->emailTo;
		$subject = 'Pedido de Orçamento - ' . $this->assunto;
		$message = "
		<html>
		<head>
		  <title>{$this->title}</title>
		</head>
		<body>
		  <table>
		    <tr>
		      <td>Nome: </td>
		      <td>" . $this->nome . "</td>
		    </tr>
		    <tr>
		      <td>E-mail: </td>
		      <td>" . $this->email . "</td>
		    </tr>
		    <tr>
		      <td>Telefone: </td>
		      <td>" . $this->telefone . "</td>
		    </tr>
		    <tr>
		      <td>Mensagem</td>
		      <td>" . $this->mensagem . "</td>
		    </tr>
		  </table>
		</body> 
		</html>
		";
		$this->toSend($para, $subject, $message);
	}

	public function sendEmail()
	{

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
	public function sendEmailTo()
	{

		$para    = $this->email;
		$subject = $this->assunto;

		//Montagem do corpo do email em HTML
		$message = "
		<html>
			<head>
				<title>{$this->title}</title>
			</head>
			<body>
				<p>Olá <strong>" . $this->nome . "</strong>,</p>	
				" . $this->mensagem . "
			</body>
		</html>";

		$this->toSend($para, $subject, $message);
	}

	public function sendToClient()
	{

		$para    = $this->email;
		$subject = 'Aceito - North Consultoria - ' . $this->assunto;
		$message = "
		<html>
		<head>
		  <title>{$this->title}</title>
		</head>
		<body>
		  <p>Olá {$this->nome}, você aceitou os termos de North Consultoria.</p>

		</body>
		</html>
		";
		$this->toSend($para, $subject, $message);
	}

	public function sendToConfirmClient()
	{

		$para    = $this->emailTo;
		$subject = 'Aceito - North Consultoria  - ' . $this->nome;
		$message = "
		<html>
		<head>
		  <title>{$this->title}</title>
		</head>
		<body>
		  <p>{$this->nome} aceitou os termos de North Consultoria.</p>

		</body>
		</html>
		";
		$this->toSend($para, $subject, $message);
	}

	public function sendLinkTermToClient()
	{

		$para    = $this->email;
		$subject = 'Termo de adesão - North Consultoria';
		$message = "
		<html>
		<head>
		  <title>{$this->title}</title>
		</head>
		<body>
		  <p>Olá {$this->nome}, abaixo segue o link do termo de adesão do plano.</p>
		  <p>Clique no link abaixo para aceitar os termos</p>
		  <p><a href='https:{$this->link}'>Clique aqui para acessar o termo.</a></p> 

		  <p><strong>OBS: Caso não consiga acessar o link, copie e cole o link abaixo na barra de endereço do navegador:</strong></p>
		  <p>https:{$this->link}</p>
		</body>
		</html>
		";

		$this->toSend($para, $subject, $message);
	}

	private function toSend($para, $subject, $message)
	{
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "From: {$this->title} <{$this->emailFrom}>\r\n";
		$headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
		$headers .= "X-Mailer: PHP/" . phpversion();

		// Segurança para evitar erro de envio na mensagem do e-mail
		$message = wordwrap($message, 70, "\r\n");

		if (ENVIRONMENT == 'production' || ENVIRONMENT == 'preview') {
			mail($para, $subject, $message, $headers);
		}
	}
}

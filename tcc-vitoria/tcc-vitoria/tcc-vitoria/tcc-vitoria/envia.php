<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
 
 <?php
  
 $arquivo = $_FILES['arquivo'];
 $nome = $_POST['nome'];
 $replyto = $_POST['replyto']; 
 $mensagem_form = $_POST['mensagem'];
  
 $to = "email@dominio";
 $remetente = "email@seu-dominio";
 $boundary = "XYZ-" . date("dmYis") . "-ZYX";
 $headers = "MIME-Version: 1.0\n";
 $headers.= "From: $remetente\n";
 $headers.= "Reply-To: $replyto\n";
 $headers.= "Content-type: multipart/mixed; boundary=\"$boundary\"\r\n";  
 $headers.= "$boundary\n"; 
  
 $corpo_mensagem = " 
 <br>Formulário via site
 <br>--------------------------------------------<br>
 <br><strong>Nome:</strong> $nome
 <br><strong>Email:</strong> $replyto
 <br><strong>Mensagem:</strong> $mensagem_form
 <br><br>--------------------------------------------
 ";
  
 if(file_exists($arquivo["tmp_name"]) and !empty($arquivo)){
  
     $fp = fopen($_FILES["arquivo"]["tmp_name"],"rb"); 
  $anexo = fread($fp,filesize($_FILES["arquivo"]["tmp_name"])); 
  $anexo = base64_encode($anexo);
  fclose($fp); 
     $anexo = chunk_split($anexo); 
     $mensagem = "--$boundary\n";
     $mensagem.= "Content-Transfer-Encoding: 8bits\n"; 
     $mensagem.= "Content-Type: text/html; charset=\"utf-8\"\n\n";
     $mensagem.= "$corpo_mensagem\n"; 
     $mensagem.= "--$boundary\n"; 
     $mensagem.= "Content-Type: ".$arquivo["type"]."\n";  
     $mensagem.= "Content-Disposition: attachment; filename=\"".$arquivo["name"]."\"\n";  
     $mensagem.= "Content-Transfer-Encoding: base64\n\n";  
     $mensagem.= "$anexo\n";  
     $mensagem.= "--$boundary--\r\n"; 
 }
  else
  {
  $mensagem = "--$boundary\n"; 
  $mensagem.= "Content-Transfer-Encoding: 8bits\n"; 
  $mensagem.= "Content-Type: text/html; charset=\"utf-8\"\n\n";
  $mensagem.= "$corpo_mensagem\n";
 }
  

 if(mail($to, $mensagem, $headers))
 {
  echo "<br><br><center><b><font color='green'>Mensagem enviada com sucesso!";
 } 
  else
  {
  echo "<br><br><center><b><font color='red'>Ocorreu um erro ao enviar a mensa";}
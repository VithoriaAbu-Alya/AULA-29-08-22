<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Cadastro de Cliente</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
	<div class='container'>
		<fieldset>
			<legend><h1>Cadastro de Reclamações</h1></legend>
			
			<form action="action_cliente.php" method="post" id='form-contato' enctype='multipart/form-data'>
				<div class="row">
					<label for="nome">Selecionar Foto</label>
			      	<div class="col-md-2">
					    <a href="#" class="thumbnail">
					      <img src="fotos/padrao.jpg" height="190" width="150" id="foto-cliente">
					    </a>
				  	</div>
				  	<input type="file" name="foto" id="foto" value="foto" >
			  	</div>

			    <div class="form-group">
			      <label for="nome">Nome</label>
			      <input type="text" class="form-control" id="nome" name="nome" placeholder="Infome o Nome">
			      <span class='msg-erro msg-nome'></span>
			    </div>

			    <div class="form-group">
			      <label for="email">E-mail</label>
			      <input type="email" class="form-control" id="email" name="email" placeholder="Informe o E-mail">
			      <span class='msg-erro msg-email'></span>
			    </div>
				<div class="form-group">
                 <label class="col-md-4 control-label" for="mensagem">Sobre o que é sua reclamação?</label>
                  <div class="col-md-4">                     
                 <textarea class="form-control" id="mensagem" name="mensagem"></textarea>
                </div>
			    </div>


			   
			 

			    <input type="hidden" name="acao" value="incluir">
			    <button type="submit" class="btn btn-primary" id='botao'> 
			      Gravar
			    </button>
			    <a href='index_reclamacao.php' class="btn btn-danger">Cancelar</a>
			</form>
		</fieldset>
	</div>
	<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>
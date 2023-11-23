<?php
        include_once 'conexao.php';
        //Receber os dados do formulário
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        

        //Verificar se o usuário clicou no botão
        if (!empty($dados['CadUsuario'])) {
            //var_dump($dados);

            $empty_input = false;

            $dados = array_map('trim', $dados);
            if (in_array("", $dados)) {
                $empty_input = true;
                echo "<p style='color: #f00;'>Erro: Necessário preencher todos campos!</p>";
            } elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
                $empty_input = true;
                echo "<p style='color: #f00;'>Erro: Necessário preencher com e-mail válido!</p>";
            }

            if (!$empty_input) {
                $query_usuario = "INSERT INTO usuarios (nome, email, senha, telefone, genero, data_nascimento, cidade, estado, endereco ) 
                VALUES (:nome, :email, :senha, :telefone, :genero, :data_nascimento, :cidade, :estado, :endereco)";
                $cad_usuario = $conexao->prepare($query_usuario);
                $cad_usuario->bindParam(':nome', $dados['nome']);
                $cad_usuario->bindParam(':email', $dados['email']);
                $cad_usuario->bindParam(':senha', $dados['senha']);
                $cad_usuario->bindParam(':telefone', $dados['telefone']);
                $cad_usuario->bindParam(':genero', $dados['genero']);
                $cad_usuario->bindParam(':data_nascimento', $dados['data_nascimento']);
                $cad_usuario->bindParam(':cidade', $dados['cidade']);
                $cad_usuario->bindParam(':estado', $dados['estado']);
                $cad_usuario->bindParam(':endereco', $dados['endereco']);
                $cad_usuario->execute();
                if ($cad_usuario->rowCount()) {
                    echo "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";
                    unset($dados);
                } else {
                    echo "<p style='color: #f00;'>Erro: Usuário não cadastrado com sucesso!</p>";
                }
            }
        }
        ?>

<?php
/*

    if(isset($_POST['submit']))
    {
         print_r('Nome: ' . $_POST['nome']);
         print_r('<br>');
         print_r('Email: ' . $_POST['email']);
         print_r('<br>');
         print_r('Senha: ' . $_POST['senha']);
         print_r('<br>');
         print_r('Gênero: ' . $_POST['genero']);
         print_r('<br>');
         print_r('Telefone: ' . $_POST['telefone']);
         print_r('<br>');
         print_r('Sexo: ' . $_POST['genero']);
         print_r('<br>');
         print_r('Data de nascimento: ' . $_POST['data_nascimento']);
         print_r('<br>');
         print_r('Cidade: ' . $_POST['cidade']);
         print_r('<br>');
         print_r('Estado: ' . $_POST['estado']);
         print_r('<br>');
         print_r('Endereço: ' . $_POST['endereco']);
         print_r('<br>');
         

        include_once('config.php');

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $telefone = $_POST['telefone'];
        $sexo = $_POST['genero'];
        $data_nasc = $_POST['data_nascimento'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $endereco = $_POST['endereco'];

        $result = mysqli_query($conexao, "INSERT INTO usuarios(nome,senha,email,telefone,sexo,data_nascimento,cidade,estado,endereco) 
        VALUES ('$nome','$senha','$email','$telefone','$sexo','$data_nasc','$cidade','$estado','$endereco')");

        //header('Location: login.php');
    } */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário | GN</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
        }
        .box{
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background-color: rgba(0, 0, 0, 0.6);
            padding: 15px;
            border-radius: 15px;
            width: 20%;
        }
        fieldset{
            border: 3px solid dodgerblue;
        }
        legend{
            border: 1px solid dodgerblue;
            padding: 10px;
            text-align: center;
            background-color: dodgerblue;
            border-radius: 8px;
        }
        .inputBox{
            position: relative;
        }
        .inputUser{
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
        }
        .labelInput{
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
        }
        .inputUser:focus ~ .labelInput,
        .inputUser:valid ~ .labelInput{
            top: -20px;
            font-size: 12px;
            color: dodgerblue;
        }
        #data_nascimento{
            border: none;
            padding: 8px;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
        }
        #submit{
            background-image: linear-gradient(to right,rgb(0, 92, 197), rgb(90, 20, 220));
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }
        #submit:hover{
            background-image: linear-gradient(to right,rgb(0, 80, 172), rgb(80, 19, 195));
            
        }
        body{ font-family: Arial, Helvetica, sans-serif;
            background: url('../tcc-vitoria/imagens/MicrosoftTeams-image.png');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            text-align: center;
            color: white;
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <a href="index.php">Voltar</a>
    <div class="box">
        <form name="cad-usuario" action="formulario.php" method="POST">
            <fieldset>
                <legend><b>Cadraste-se</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required value="<?php
            if (isset($dados['nome'])) {
                echo $dados['nome'];
            }
            ?>">
                    <label for="nome" class="labelInput">Nome completo</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="password" name="senha" id="senha" class="inputUser" required>
                    <label for="senha" class="labelInput">Senha</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" required value="<?php
            if (isset($dados['email'])) {
                echo $dados['email'];
            }
            ?>">
                    <label for="email" class="labelInput">Email</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" required value="<?php
            if (isset($dados['telefone'])) {
                echo $dados['telefone'];
            }
            ?>">
                    <label for="telefone" class="labelInput">Telefone</label>
                </div>
                <p>Sexo:</p>
                <input type="radio" id="feminino" name="genero" value="feminino" required <?php if (isset($dados['genero']) && $dados['genero']=='feminino') echo 'checked';?>>
                <label for="feminino">Feminino</label>
                <br>
                <input type="radio" id="masculino" name="genero" value="masculino" required <?php if (isset($dados['genero']) && $dados['genero']=='masculino') echo 'checked';?>>
                <label for="masculino">Masculino</label>
                <br>
                <input type="radio" id="outro" name="genero" value="outro" required <?php if (isset($dados['genero']) && $dados['genero']=='outro') echo 'checked';?>>
                <label for="outro">Outro</label>
                <br><br>
                <label for="data_nascimento"><b>Data de Nascimento:</b></label>
                <input type="date" name="data_nascimento" id="data_nascimento" required value="<?php
            if (isset($dados['data_nascimento'])) {
                echo $dados['data_nascimento'];
            }
            ?>">
                <br><br><br>
                <div class="inputBox">
                    <input type="text" name="cidade" id="cidade" class="inputUser" required  value="<?php if (isset($dados['cidade'])) { echo $dados['cidade']; } ?>">
                    <label for="cidade" class="labelInput">Cidade</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="estado" id="estado" class="inputUser" required value="<?php if (isset($dados['estado'])) { echo $dados['estado']; } ?>">
                    <label for="estado" class="labelInput">Estado</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="endereco" id="endereco" class="inputUser" required value="<?php if (isset($dados['endereco'])) { echo $dados['endereco']; } ?>">
                    <label for="endereco" class="labelInput">Endereço</label>
                </div>
                <br><br>
                <input type="submit" id="submit" value="Cadastrar" name="CadUsuario">
            </fieldset>
        </form>
    </div>
</body>
</html>
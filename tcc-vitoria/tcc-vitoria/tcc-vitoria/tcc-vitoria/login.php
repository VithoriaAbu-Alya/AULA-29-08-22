<?php
session_start();
ob_start();
include_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style2.css">
    <title>Tela de login</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            
            
        }
        div{
            background-color: rgba(0, 0, 0, 0.6);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            padding: 80px;
            border-radius: 15px;
            color: #fff;
        }
        input{
            padding: 15px;
            border: none;
            outline: none;
            font-size: 15px;
        }
        .inputSubmit{
            background-color: dodgerblue;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 10px;
            color: white;
            font-size: 15px;
            
        }
        .inputSubmit:hover{
            background-color: deepskyblue;
            cursor: pointer;
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
        
    
}
        
        
        
    </style>
</head>

<body>

  
    <?php
 
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
 
    if (!empty($dados['SendLogin'])) {
       
        //echo "oi";
        $query_usuario = "SELECT id, nome, email, senha 
                        FROM usuarios 
                        WHERE email =:email  
                        LIMIT 1";
        $result_usuario = $conexao->prepare($query_usuario);
        $result_usuario->bindParam(':email', $dados['email']);
        $result_usuario->execute();
        
        if(($result_usuario) and ($result_usuario->rowCount() != 0)) {
        
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            if($dados['senha']==$row_usuario['senha']){
                
                $_SESSION['id'] = $row_usuario['id'];
                $_SESSION['nome'] = $row_usuario['nome'];
                $_SESSION['email'] = $row_usuario['idEMAIL'];
                header("Location: index_reclamacao.php");
            }else{
                $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Usuário ou senha inválida!</p>";
            }
        }else{
            $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Usuário ou senha inválida!</p>";
        }

        
    }

    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>

    <a href="index.php">Voltar</a>
    <div>
        <h1>Login</h1>

        <form action="" method="POST">
            <input type="text" name="email" placeholder="Email">
            <br><br>
            <input type="password" name="senha" placeholder="Senha">
         <br>  <br> <a href="formulario.php">Cadastra-se</a><br>
            <br><br>
            <input class="inputSubmit" type="submit" name="SendLogin" value="Acessar">
        </form>
    </div>
</body>
</html>
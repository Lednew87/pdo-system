<?php
session_start();
ob_start();
include_once 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    
    <link rel="shortcut icon" href="images/logo.ico" type="image/x-ico">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style-index.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <title>Health Tech</title>

</head>

<body>
		<header>
		<h1>Seja bem vindo a Health Tech! Trabalhando junto com você contra a desprescrição receituária!</h1>
		</header>
        
    <div class="box-model">
                
            <form method="POST" action="">

                
                    <legend>LOGIN</legend>

                    <label>Usuário</label>
                    <input class="input-padrao" type="email" name="usuario" required placeholder="Digite o email cadastrado" value="<?php if(isset($dados['usuario'])){ echo $dados['usuario']; } ?>"><br><br>

                    <label>Senha</label>
                    <input class="input-padrao" type="password" name="senha_usuario" min="6" required placeholder="Digite a senha" value="<?php if(isset($dados['senha_usuario'])){ echo $dados['senha_usuario']; } ?>"><br><br>

                    <input class="botao" type="submit" value="ACESSAR" name="SendLogin">

            </form>
    </div>

    <footer>
			<h2 class="copyright">&copy; Copyright Karina Tonzar - 2023</h2>
		</footer>

</body>

</html>

<?php
    //Exemplo criptografar a senha
    //echo password_hash(220103, PASSWORD_DEFAULT);
?>

    <?php
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (!empty($dados['SendLogin'])) {
        //var_dump($dados);
        $query_usuario = "SELECT id, nome, usuario, senha_usuario 
        FROM usuarios 
        WHERE usuario LIKE :usuario LIMIT 1";
        $result_usuario = $conn->prepare($query_usuario);
        $result_usuario->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);
        $result_usuario->execute();

        if(($result_usuario) AND ($result_usuario->rowCount() != 0)){
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            //var_dump($row_usuario);
            if(password_verify($dados['senha_usuario'], $row_usuario['senha_usuario'])){
                $_SESSION['id'] = $row_usuario['id'];
                $_SESSION['nome'] = $row_usuario['nome'];
                header("Location: dashboard.php");

            }else{$_SESSION['msg'] = "<p style='color: #ff0000'>Usuário ou senha inválidos!</p>";   
            }
        }else{$_SESSION['msg'] = "<p style='color: #ff0000'>Usuário ou senha inválidos!</p>";  
    } 
}   
        
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
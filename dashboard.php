<?php
session_start();
ob_start();
include_once 'conexao.php';

if((!isset($_SESSION['id'])) AND (!isset($_SESSION['nome']))){
    $_SESSION['msg'] = "<p style='color: #ff0000'>Faça o login para acessar a página!</p>";
    header("Location: index.php");

}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style-dash.css">
    <link rel="shortcut icon" href="images/logo.ico" type="image/x-ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <title>Health Tech</title>

</head>

<body>
    <?php
         $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
         //var_dump($dados); 

    ?>
    <h1>Bem vindo(a) <?php echo $_SESSION['nome']; ?>!</h1>

        <div class="tabela">

            <div class="box-model">
                        
                        <form method="POST" action="">
                        
                            <legend>CONSULTAR</legend>

                            <label>Prontuário</label>
                            <input class="input-padrao" type="text" name="num_prontuario" id="num_prontuario" placeholder="Digite o número do prontuário."required value="<?php if(isset($dados['num_prontuario'])) {echo $dados['num_prontuario'];}?>">
        
                            <input class="botao" type="submit" value="CONSULTAR" name="Consultar">

                            <a href="sair.php">SAIR</a>
        
                        </form>
            </div>


            <table class="dados">

                <thead>
                    <tr>
                        <th>NOME</th>
                        <th>PRONTUÁRIO</th>
                        <th>MEDICAÇÕES</th>
                        <th>OBSERVAÇÕES</th>
                       
                    </tr>

                </thead>

                <tbody>

                    <?php

                            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                                //var_dump($dados); 
                            
                            if (!empty($dados['Consultar'])) {
                                
                                $prontuario = $dados['num_prontuario'];


                                $query_prontuarios ="SELECT id_paciente, nome, prontuario, medicacao, observacoes FROM pacientes WHERE prontuario LIKE :prontuario LIMIT 1";
                                $result_prontuarios = $conn->prepare($query_prontuarios);
                                $result_prontuarios->bindParam(':prontuario', $prontuario, PDO::PARAM_STR);

                                $result_prontuarios->execute();

                                if ($row_prontuario = $result_prontuarios->fetch(PDO::FETCH_ASSOC)) {
                                    //var_dump($row_prontuario);
                                    echo "<tr>";
                                    echo "<td>" . $row_prontuario['nome'] . "</td>";
                                    echo "<td>" . $row_prontuario['prontuario'] . "</td>";
                                    echo "<td>" . $row_prontuario['medicacao'] . "</td>";
                                    echo "<td>" . $row_prontuario['observacoes'] . "</td>";
                                    echo "</tr>";

                                }else {$_SESSION['msg'] = "<p style='color: #ff0000'>Prontuário não encontrado!</p>"; 
                                }
                                //} else {$_SESSION['msg'] = "<p style='color: #ff0000'>Digite um valor válido!</p>"; 
                            }
                    

 
                    ?>

                </tbody>

            </table>

        </div>
    
        <footer>
			<h2 class="copyright">&copy; Copyright Karina Tonzar - 2023</h2>
		</footer>

</body>

</html> 	

<?php

 if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
?>

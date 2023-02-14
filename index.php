<?php
session_start();

    include("conexao.php");

    if(isset($_POST['submit'])){
        $email = mysqli_real_escape_string($strcon, $_POST['email']);
        $pass = mysqli_real_escape_string($strcon, $_POST['senha']);

        if($email == "" || $pass == ""){
            echo "Nome de usuario ou senha não digitada<br>";
        }
        else{
            $sql = "SELECT * FROM usuarios
            WHERE email = '$email'";

            $res = mysqli_query($strcon, $sql) or die ("Erro ao efetuar login");

            $linha = mysqli_fetch_assoc($res);
            $hashsenha = password_verify($pass, $linha['senha']);

            if(is_array($linha) && !empty($linha) && $hashsenha){
                $validUser = $linha['email'];
                $_SESSION['valid'] = $validUser;
                $_SESSION['name'] = $linha['nome'];
                $_SESSION['id'] = $linha['id'];
                
            }
            else{
                echo "Nome de usuario ou senha incorreta<br>";
            }
            if(isset($_SESSION['valid'])){
                header("LOCATION: home.php");
            }
            
        }
    }
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="reset.css">
  <link rel="stylesheet" href="style.css">
  <title>Login</title>
</head>
<body>
    
    <form action="index.php" name="login" class="form-padrao" method="POST">
        <h2>Login</h2>
        <input class="input-padrao" type="email" name="email" placeholder="E-mail"><br>
        <input class="input-padrao" type="password" name="senha" placeholder="Senha"><br>
        <a href="registrar.php">Registrar-se</a><br>
        <input type="submit" name="submit" class="button" value="Entrar">
    </form>
   

</body>
</html>
    

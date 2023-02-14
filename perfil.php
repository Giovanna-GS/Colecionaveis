<?php
  session_start();
  include('conexao.php');
  if(!isset($_SESSION['valid'])){
    header("LOCATION: home.php");
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
    <title>Alterar Cadastro</title>
  </head>
  <body>
    <nav>
    <p class="logo"><?php echo $_SESSION['name'] ?></p>
    <a href="home.php">Pagina Inicial</a>
    <a href="adicionar.php">Adicionar produto</a>
    <a href="logout.php">Sair</a>
  </nav>
    <?php
    
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM usuarios
    WHERE id = '$id'";

    $registro = mysqli_query($strcon, $sql) or die("Erro de conexão");
    $res = mysqli_fetch_array($registro);
    $nome = $res['nome'];
    $sobrenome = $res['sobrenome'];
    $cpf = $res['cpf'];
    $email = $res['email'];
    $endereco = $res['endereco'];
    $numero = $res['numero'];
    $cidade = $res['cidade'];
    $senha = $res['senha'];
    $foto = $res['foto'];
    ?>

  <form action="perfil.php" method="POST" class="form-padrao">
    <img src= <?php echo $foto ?> width="200px" alt="foto do perfil"><br>

   <label for="nome" class="valor">Nome</label>
   <input type="text" name="nome" class="input-padrao" value="<?php echo $nome?>"> <br>

   <label for="sobrenome" class="valor">Sobrenome</label>
   <input type="text" name="sobrenome" class="input-padrao" value="<?php echo $sobrenome?>"> <br>

   <label for="cpf" class="valor">CPF</label>
   <input type="text" name="cpf" class="input-padrao" value="<?php echo $cpf?>" disabled="disabled"> <br>

   <label for="email" class="valor">E-mail</label>
   <input type="text" name="email" class="input-padrao" value="<?php echo $email?>"> <br>

   <label for="endereco" class="valor">Endereço</label>
   <input type="text" name="endereco" class="input-padrao" value="<?php echo $endereco ?>"> <br>

   <label for="numero" class="valor">Nº</label>
   <input type="numer" name="numero" class="input-padrao" value="<?php echo $numero ?>"> <br>
   
   <label for="cidade" class="valor">Cidade</label>
   <input type="text" name="cidade" class="input-padrao" value="<?php echo $cidade?>"> <br>

   <label for="senha" class="valor">Senha</label>
   <input type="password" name="senha" class="input-padrao" required><br>

    <input type="submit" value="Alterar" name="submit" class="button">
  </form>
    
  <?php

  if(isset($_POST['submit'])){
    $nomeNovo = $_POST['nome'];
    $sobrenomeNovo = $_POST['sobrenome'];
    $emailNovo = $_POST['email'];
    $enderecoNovo = $_POST['endereco'];
    $numero = $_POST['numero'];
    $cidadeNova = $_POST['cidade'];
    $senhaNova = $_POST['senha'];

    if($nomeNovo == "" || $sobrenomeNovo == "" || $emailNovo == "" || $enderecoNovo == "" || $cidadeNova == "" || $numero == "" ){
      echo "Nenhuma alteração foi realizada";
    }
    else{
      $hashsenha = trim(password_hash($senha, PASSWORD_DEFAULT));
      $sql1 = " UPDATE usuarios
      SET nome = '$nomeNovo', sobrenome = '$sobrenomeNovo', email = '$email', endereco = '$enderecoNovo', numero = '$numero', cep = '$cep', cidade = '$cidadeNova', senha = '$hashsenha'
      WHERE id = '$id'";
      $atualizar = mysqli_query($strcon, $sql1) or die ("Erro de conexão");
      header("LOCATION: home.php");
    }
  }
  ?>
  </body>
  </html>
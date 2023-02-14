<?php
include("conexao.php");

if(isset($_POST["submit"])){
$arqImagem = $_FILES["arquivo"]["name"];
$arqTemporario = $_FILES["arquivo"]["tmp_name"];
$caminhoImagem = "imagens/".$arqImagem;
$uploadOK = 1;
 if(file_exists($caminhoImagem)){
    echo "Foto já cadastrada<br>";
    $uploadOK = 0;
 }
 else if(move_uploaded_file($arqTemporario, $caminhoImagem) && $uploadOK){
    $msg = "Imagem enviada com sucesso";
 }
 else{
    $msg = "Falha ao enviar imagem";
 }

 $nome = $_POST['nome'];
 $sobrenome = $_POST['sobrenome'];
 $cpf = $_POST['cpf'];
 $email = $_POST['email'];
 $endereco = $_POST['endereco'];
 $numero = $_POST['numero'];
 $cidade = $_POST['cidade'];
 $pass = $_POST['senha'];
 

 if($nome == "" || $sobrenome == "" || $cpf == "" || $email== "" || $endereco == "" || $cidade == "" || $pass == "" || $numero ==""){
    echo "Todos os campos devem ser preenchidos";
 }
 else {
    $hashsenha = trim(password_hash($pass, PASSWORD_DEFAULT));
    $sql = "INSERT INTO usuarios(nome, sobrenome, cpf, email, endereco, numero, cidade, senha, foto)
    VALUES ('$nome', '$sobrenome', '$cpf', '$email', '$endereco', '$numero', '$cidade', '$hashsenha', '$caminhoImagem')";
    mysqli_query($strcon, $sql) or die ("Erro de cadastro");
    echo "Cadastro realizado com sucesso!";
    header("LOCATION: index.php");
 }
}
else{
   ?>
   <!DOCTYPE html>
   <html lang="en">
   <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="style.css">
     <title>Registrar</title>
   </head>
   <body>
     <form name="registro" action="registrar.php" method="POST" enctype="multipart/form-data" class="form-padrao">
         <h1>Registra-se</h1>
           <input class="input-padrao" type="text" name="nome" placeholder="Nome"><br>
           <input class="input-padrao" type="text" name="sobrenome" placeholder="Sobrenome"><br>
           <input class="input-padrao" type="text" name="cpf" placeholder="CPF"><br>
           <input class="input-padrao" type="email" name="email" placeholder="E-mail"><br>
           <input class="input-padrao" type="text" name="endereco" placeholder="Endereço"><br>
           <input class="input-padrao" type="number" name="numero" placeholder="Nº"><br>
           <input class="input-padrao" type="text" name="cidade" placeholder="Cidade"><br>
           <input class="input-padrao" type="password" name="senha" placeholder="Senha"><br>
           Foto: <br><input type="file" name="arquivo" id="arquivo"><br>
           <input class="button" type="submit" name="submit" value="Registrar">
   <?php
         }
   ?>
     
   </body>
   </html>
   




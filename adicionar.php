<?php 
session_start();
include("conexao.php");

if(isset($_POST['submit'])){
  $arqImagem = $_FILES["arquivo"]["name"];
  $arqTempoprario = $_FILES["arquivo"]["tmp_name"];
  $caminhoImagem = "imagensProdutos/".$arqImagem;
  $uploadOK = 1;
  
  if(file_exists($caminhoImagem)){
    echo "Foto já cadastrada<br>";
    $uploadOK = 0;
  }
  else if(move_uploaded_file($arqTempoprario, $caminhoImagem) && $uploadOK){
    $msg = "Imagem enviada com sucesso";
  }

  else{
    $msg = "Falha ao enviar imagem";
  }
  $nome = $_POST['nome'];
  $quantidade = $_POST['quantidade'];
  $preco = $_POST['preco'];
  $data = $_POST['data'];
  $descricao = $_POST['descricao'];
  $login = $_SESSION['id'];


  if($nome == "" || $quantidade == "" || $preco == "" || $data == "" || $descricao == ""){
  echo "Todos os campos devem ser preenchidos<br>";
  }
  else{
  $sql = "INSERT INTO produtos(nome, quantidade, valor, user_id, dataCad, descricao, foto)  
          VALUES ('$nome', '$quantidade', '$preco', '$login','$data', '$descricao', '$caminhoImagem')";
  mysqli_query($strcon, $sql) or die ("Erro de cadastro");
  echo "Produto cadastrado com sucesso✔<br>";

  header ("LOCATION: produtos.php");
  
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
  <link rel="stylesheet" href="reset.css">
  <link rel="stylesheet" href="style.css">
  <title>Adicionar Produtos</title>
</head>
<body>

<nav>
<p class="logo"><?php echo $_SESSION['name'] ?></p>
    <a href="home.php">Pagina Inicial</a>
    <a href="produtos.php">Ver produtos</a>
    <a href="logout.php">Sair</a>
  </nav>

  <form action="adicionar.php" method="POST" class="form-padrao" enctype = "multipart/form-data">

    <label for="foto">Foto</label>
    <input  type="file" name="arquivo"> <br>

    <label for="nome">Nome do produto</label>
    <input class="input-padrao" type="text" name="nome"><br>

    <label for="quantidade">Quantidade</label>
    <input class="input-padrao" type="number" name="quantidade"><br>

    <label for="preco">Preço</label>
    <input class="input-padrao" type="namber" name="preco"><br>

    <label for="data">Data de Cadastro</label>
    <input class="input-padrao" type="date" name="data"><br>

    <label for="descricao">Descrição</label>
    <textarea class="text-area" name="descricao" cols="40" rows="10" maxlength=500></textarea><br>

    <input class="button" type="submit" name="submit" value="Cadastrar">
  </form>
  <?php
}
?>
  
</body>
</html>
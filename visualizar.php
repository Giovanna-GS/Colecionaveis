<?php
session_start();
 include('conexao.php');

 if(!isset($_SESSION['valid'])){
    header("LOCATION: index.php");
 }

 $id = $_GET['id'];
 $sql = "SELECT * FROM produtos
         WHERE id = '$id'";

         $registro = mysqli_query($strcon, $sql) or die ("Erro de conexão");
         $res = mysqli_fetch_array($registro);
         $nome = $res['nome'];
         $descricao = $res['descricao'];
         $foto = $res['foto'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
    <title>Visualizar Produtos</title>
</head>
<body>
  <nav>
  <p class="logo"><?php  echo $_SESSION['name'] ?></p>
    <a href="home.php">Pagina Inicial</a>
    <a href="produtos.php">Ver produto</a>
    <a href="logout.php">Sair</a>
  </nav>
  <div class="info">
    <h2><?php echo $nome ?></h2>
    <img src="<?php echo $foto ?>" width="200px" alt="">
    <p><?php echo $descricao?></p>
    </div>
</body>
</html>
<?php
session_start();

if(!isset($_SESSIO['valid'])){
  include("conexao.php");
 
$resultado = mysqli_query($strcon, "SELECT * FROM usuarios");

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Pagina Inicial</title>
</head>
<body>
<h2 class="titulo">Bem-Vindo <?php echo $_SESSION['name'] ?></h2>
<div class="home">
<div class="bloco">
  <img src="assets/produtos.png" alt="books">
  <a href="produtos.php">Adicionar e editar</a>
</div>
<div class="bloco">
  <img src="assets/perfilAlt.png" alt="notebook">
  <a href="perfil.php">Editar Perfil</a>
</div>
<div class="bloco">
  <img src="assets/logout.png" alt="">
  <a href="logout.php">Sair</a>
</div>
</div>
</body>
</html>
<?php
}

?>
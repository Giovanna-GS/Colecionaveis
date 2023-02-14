<?php
session_start();

if(!isset($_SESSION['valid'])){
  header("LOCATION: index.php");
}
include("conexao.php");

$sql = "SELECT * FROM produtos
WHERE user_id =".$_SESSION['id']." ORDER BY id DESC";
$registro = mysqli_query($strcon, $sql) or die ("Erro de conexão");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="reset.css">
  <link rel="stylesheet" href="style.css">
  <title>Produtos</title>
</head>
<body>
  
  <nav>
  <p class="logo"><?php echo $_SESSION['name'] ?></p>
    <a href="home.php">Pagina Inicial</a>
    <a href="adicionar.php">Adicionar produto</a>
    <a href="logout.php">Sair</a>
  </nav>

  <table width="80%" border=0>
    <tr bgcolor = '#FD9214'>
    <th>Nome</th>
    <th>Quantidade</th>
    <th>Preço R$</th>
    <th>Data</th>
    <th>Mais</th>
    </tr>
 

  <?php
  while($res = mysqli_fetch_array($registro)){
    ?>
    <tr align=center bgcolor='#5BC0EB'>
      <td><?php echo $res['nome']?></td>
      <td><?php echo $res['quantidade']?></td>
      <td><?php echo $res['valor']?></td>
      <td><?php echo $res['dataCad']?></td>
      <td><?php echo "<a href=\"editar.php?id=$res[id]\">Editar</a>|<a href=\"excluir.php?id=$res[id]\" onclick=\"return confirm(tem certeza?)\">Excluir</a> |<a href=\"visualizar.php?id=$res[id]\">Mais</a>"?></td>
    </tr>
    <?php
  }
  ?>
   </table>
</body>
</html>
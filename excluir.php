<?php
session_start();

if(!isset($_SESSION['valid'])){
    header("LOCATION: index.php");
}
include("conexao.php");

$id = $_GET['id'];
$sql = "DELETE FROM produtos WHERE id = '$id'";
$registro = mysqli_query($strcon, $sql) or die ("Erro de conexão");

echo "Produto excluido";
header("refresh: 3, url=produtos.php");

?>
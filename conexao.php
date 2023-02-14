<?php
$servidor = "localhost";
$usuario = "colecionaveis";
$senha = "123";
$banco = "colecionaveis";
$strcon = mysqli_connect($servidor, $usuario, $senha, $banco);
if(!$strcon){
    die("Banco de dados sem conexão");
}
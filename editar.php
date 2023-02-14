<?php
    session_start();
    include('conexao.php');
    if(!isset($_SESSION['valid'])){
        header("LOCATION: login.php");
    }
    $id = $_GET['id'];
    $sql = "SELECT * FROM produtos
            WHERE id = '$id'";

    $registro = mysqli_query($strcon, $sql) or die("Erro de conexão");
    $res = mysqli_fetch_array($registro);
        $nomeProduto = $res['nome'];
        $qtd = $res['quantidade'];
        $valor = $res['valor'];
        $descricao = $res['descricao'];
?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="reset.css">
        <link rel="stylesheet" href="style.css">
        <title>Editar</title>
    </head>
    <body>
    <nav>
        <p class="logo"><?php  echo $_SESSION['name'] ?></p>
        <a href="home.php">Pagina Inicial</a>
        <a href="produtos.php">Ver produto</a>
        <a href="logout.php">Sair</a>
    </nav>
    
    <form action='' method='POST' class="form-padrao">
            <h1>Editar cadastro dos colecionaveis</h1>

            <label for="nome">Produto</label> 
            <input type='text' class="input-padrao" name='nomeProduto' value="<?php echo $nomeProduto ?>"><br>

            <label for="quantidade">Quantidade</label>
            <input class="input-padrao" type='number' name='qtd' value= <?php echo $qtd ?>><br>

            <label for="valor">Preço</label>
            <input class="input-padrao" type='text' name='valor' value= <?php echo $valor ?>><br>
            
            <label for="descricao">Descrição</label>
            <textarea class="text-area" name="descricao" cols="40" rows="10" maxlength=500 ><?php echo $descricao ?></textarea><br>

            <br><input class="button" type='submit' name='submit' value='Atualizar'>
        </form>
    </body>
    </html>
<?php
    if(isset($_POST['submit'])){
        $nome = $_POST['nomeProduto'];
        $quantidade = $_POST['qtd'];
        $valor = $_POST['valor'];
        $descricao = $_POST['descricao'];

        if(empty($nome) || empty($quantidade) || empty($valor) || empty($descricao)){
            if(empty($nome)){
                echo "Nome do produto não digitado";
            }
            if(empty($quantidade)){
                echo "Quantidade do produto não digitada";
            }
            if(empty($valor)){
                echo "Valor do produto não digitado";
            }
            if(empty($descricao)){
                echo "Descrição do colecionavel em branco";
            }
        }
        else{
            $sql1 = "UPDATE produtos
                SET nome = '$nome', descricao = '$descricao', quantidade = '$quantidade', valor = '$valor'
                WHERE id = '$id'";
            $atualizar = mysqli_query($strcon, $sql1) or die("Erro de cadastro");
            header("Location: produtos.php");
        }
    }
    ?>
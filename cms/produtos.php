<?php
	session_start();

	$logado = $_SESSION['login'];

	require_once "module.php";
    $conexao = conectar();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Adm. Conteúdo</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php
		include 'header.html';
	?>

	<?php
		include 'nav.php';
	?>

	<div class="content">
		<div class="container_conteudo">
            <div class="produtos-wrapper">
                <div class="produto-item">
                    <a href="conteudo_produtodestaque.php">
                        <img src="imagens/destaque.png">
                    </a>
                </div>

                <div class="produto-item">
                    <a href="conteudo_produtopromocao.php">
                        <img src="imagens/promocao.png">
                    </a>
                </div>

                <div class="produto-item">
                    <a href="conteudo_cadastroprodutos.php">
                        <img src="imagens/conveyor.png">
                    </a>
                </div>
            </div>
            
            <div class="produtos-wrapper">
                <div class="produto-item">
                    <a href="conteudo_categoria.php">
                        <img src="imagens/list.png">
                    </a>
                </div>

                <div class="produto-item">
                    <a href="conteudo_subcategoria.php">
                        <img src="imagens/subcategoria.png">
                    </a>
                </div>
                
                <div class="produto-item">
                    <a href="conteudo_estatisticas.php">
                        <img src="imagens/graph.png">
                    </a>
                </div>
            </div>
		</div>
	</div>
    <?php
            include "footer.html";
        ?>
</body>
</html>
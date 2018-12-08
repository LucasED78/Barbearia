<?php
	session_start();
	$logado = $_SESSION['login'];
    $nivel = $_SESSION['nivel'];

    if($nivel != 'administrador'){
        echo("<script>")."alert('Somente administradores podem acessar essa área!!');"."</script>";
        echo("<script>window.location = 'cmsindex.php';</script>");
    }
	
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
		<div class="container-conteudo">
			<div class="card-conteudo">
				<a href="conteudo_sobrebarbearia.php">
                    <h1>Barbearia</h1>
					<img src="imagens/beard.jpeg">
				</a>
			</div>

			<div class="card-conteudo">
				<a href="conteudo_sobrecentro.php">
                    <h1>Centro Estético</h1>
                    <img src="imagens/cestetico.jpeg">
				</a>
			</div>

			<div class="card-conteudo">
                <a href="conteudo_sobreprojeto.php">
                    <h1>Empresa</h1>
                    <img src="imagens/projeto.jpeg">
                </a>
			</div>

			<div class="card-conteudo">
				<a href="conteudo_sobrelojas.php">
                    <h1>Lojas</h1>
					<img src="imagens/loja.jpeg">
				</a>
			</div>
		</div>
	</div>
    <?php
            include "footer.html";
        ?>
</body>
</html>
<?php
	session_start();

	require_once "module.php";
    $conexao = conectar();

	$logado = $_SESSION['login'];
    $nivel = $_SESSION['nivel'];
    
    if($nivel != 'administrador'){
        echo("<script>")."alert('Somente administradores podem acessar essa área!!');"."</script>";
        echo("<script>window.location = 'cmsindex.php';</script>");
    }

	//verificando se o botão de enviar existe
	if(isset($_GET['btnOk'])){
		$nome = $_GET['txtnome']; //resgatando variável do nome

		$sql = "INSERT INTO tbl_niveis(nome) values('".$nome."')"; //query pra inserir

		mysqli_query($conexao,$sql); //código para enviar a query ao banco

		header('location: nivel.php'); //redirecionando a página
	}

	//verificando se existe a variável status
	if(isset($_GET['status'])){ 
		$status = $_GET['status']; //resgatando a variável status
		
		//se for igual a ativo, ele ativa o nível, caso contrário, desativa
		if($status == 'ativo'){
			$id = $_GET['id']; //resgatando id da url
			$sql = 'UPDATE tbl_niveis SET status = 1 WHERE id ='.$id; //query para atualizar
			mysqli_query($conexao,$sql); //enviando query para o banco
			header('location: nivel.php'); //redirecionando a página
		}else if($status == 'inativo'){
			$id = $_GET['id'];
			$sql = 'UPDATE tbl_niveis SET status = 0 WHERE id ='.$id;
			mysqli_query($conexao,$sql);
			header('location: nivel.php');
		}
	}

	//verificando se existe a variável modo
	if(isset($_GET['modo'])){
		$modo = $_GET['modo']; //resgatando a variável modo

		//se modo for igual a excluir, faz o processo de exclusão do banco
		if($modo == 'excluir'){
			$id = $_GET['id']; //resgatando id
			$sql = 'DELETE FROM tbl_niveis WHERE id='.$id; //query para excluir
			mysqli_query($conexao,$sql); //enviando para o banco
			header('location: nivel.php'); //redirecionando a página
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Níveis</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<?php include 'header.html'; ?>

	<?php include 'nav.php';?>

	<div class="content">
		<form method="get" action="nivel.php" class="frmNivel">
			<ul>	
				<li>
					<label class="cadastrar_nivel_label">
						Nome: 
					</label>
				</li>

				<li>
					<input type="text" name="txtnome" class="cadastrar_nivel_input">

					<button type="submit" name="btnOk" class="btn">
						enviar
					</button>
				</li>
			</ul>
		</form>

		<table class="table-model">
			<tr class="table-row" style="font-weight: bold;">
				<td class="table-cell">
					Nome
				</td>

				<td class="table-cell">
					Status
				</td>

				<td>
					Opções
				</td>
			</tr>

			<?php
				$sql = 'select * from tbl_niveis';
				$resultado = mysqli_query($conexao,$sql);

				while($rsNivel = mysqli_fetch_array($resultado)){
			?>

			<tr class="table-row">
				<td class="table-cell" style="border-right: 0.5px solid #202020">
					<?php echo(utf8_encode($rsNivel['nome']))?>
				</td>

				<td class="table-cell" style="border-right: 0.5px solid #202020">
					<a href="nivel.php?status=ativo&id=<?php echo($rsNivel['id'])?>">
						<img src="imagens/ativar.png">
					</a>

					<a href="nivel.php?status=inativo&id=<?php echo($rsNivel['id'])?>">
						<img src="imagens/desativar.png">
					</a>
				</td>

				<td class="table-cell">
					<a href="nivel.php?modo=excluir&id=<?php echo($rsNivel['id'])?>" onclick="return confirm('Deseja excluir o nível?')">
						<img src="imagens/delete.png">
					</a>
				</td>
			</tr>

			<?php
				}
			?>
		</table>
	</div>
    <?php
            include "footer.html";
        ?>
</body>
</html>
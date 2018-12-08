<?php
	session_start();

    //declaração de variáveis
	$logado = $_SESSION['login'];
    $preco = "";
    $imagem = null;
    $btnsalvar = "salvar";

    //conexao com o banco de dados
	require_once "module.php";
    $conexao = conectar();
    
    /*verificando existência do botão salvar*/
	if(isset($_GET['btnsalvar'])){
		$preco = $_GET['txtpreco'];
		$idSessao = $_GET['txtsessao'];
        $idProduto = $_GET['txtproduto'];
        $imagem = $_GET['txtfoto'];
        
        /*verificando se o conteúdo do botão é igual a salvar*/
        if($_GET['btnsalvar'] == 'salvar'){
            /*query pra inserir dados no banco*/
            $sql = "INSERT INTO tbl_promocao(preco, imagem, idProduto, idSessao) values('".$preco."', '".$imagem."', '".$idProduto."', '".$idSessao."')";
            header('location: conteudo_produtopromocao.php');
        }else if($_GET['btnsalvar'] == 'editar'){
            /*verificando se a imagem foi selecionada ou não*/
            if($imagem != null){
                /*query pra atualizar no banco com a imagem*/
                $sql = "UPDATE tbl_promocao SET preco = '".$preco."', imagem = '".$imagem."', idProduto = '".$idProduto."', idSessao = '".$idSessao."' WHERE id =".$_SESSION['id'];
                header('location: conteudo_produtopromocao.php');
            }else{
                /*query pra atualizar no banco sem a imagem*/
                $sql = "UPDATE tbl_promocao SET preco = '".$preco."', idProduto = '".$idProduto."', idSessao = '".$idSessao."' WHERE id =".$_SESSION['id'];
                header('location: conteudo_produtopromocao.php');
            }
        }
        /*enviando a query para o banco junto com a conexao*/
        mysqli_query($conexao, $sql);
        header('location: conteudo_produtopromocao.php');
	}

    /*verificando se existe a variável modo*/
	if(isset($_GET['modo'])){
		$modo = $_GET['modo'];

        /*verificando se modo é igual a excluir*/
		if($modo == 'excluir'){
            $id = $_GET['id']; //resgatando id

            /*query para excluir dados do banco*/
			$sql = 'delete from tbl_promocao where id ='.$id;
			mysqli_query($conexao,$sql);
			header('location: conteudo_produtopromocao.php');
		}else if($modo == 'editar'){ //verificando se o modo é igual a editar
            $id = $_GET['id'];
            $_SESSION['id'] = $id;

            /*query para recuperar dados do banco*/
            $sql = 'SELECT * FROM tbl_promocao where id ='.$id;
            $resultado = mysqli_query($conexao, $sql);
            if($rsPromocao = mysqli_fetch_array($resultado)){
                /*pegando os dados recuperados e setando nas variáveis*/
                $preco = $rsPromocao['preco'];
                $imagem = $rsPromocao['imagem'];
                $btnsalvar = 'editar';
            }
        }
	}

    /*verificando se existe a variável status*/
	if(isset($_GET['status'])){
		$status = $_GET['status'];
		$id = $_GET['id'];

        //verificando se status é igual a ativar
		if($status == 'ativar'){
            //query pra atualizar o status
            $sql = "UPDATE tbl_promocao set status = 1 WHERE id=".$id;
            mysqli_query($conexao, $sql);
            header('location: conteudo_produtopromocao.php');
		}else if($status == 'desativar'){//verificado se status é igual a desativar
			$sql = "UPDATE tbl_promocao SET status = 0 WHERE id =".$id;
			mysqli_query($conexao, $sql);
			header('location: conteudo_produtopromocao.php');
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="css/style.css">
    <script src="js/jquery.min.js"></script>
        <script src="js/jquery.form.js"></script>
        <script>
            $(document).ready(function(){
                $('#fotos').live('change', function(){
                    $('#frmImagem').ajaxForm({
                        target:'#visualizar'
                    }).submit();
                })
            })
        </script>
</head>
<body>
	
	<?php
		include 'header.html';
	?>

	<?php
		include 'nav.php';
	?>

	<div class="content">
        <form method="post" action="upload.php" class="frmImagem" enctype="multipart/form-data" name="frmImagem" id="frmImagem">
                <ul>
                    <li id="visualizar">
                        <?php
                            if($imagem != null){
                                echo("<img src='$imagem'>");
                            }
                        ?>
                    </li>

                    <li>
                        <input type="file" name="fleimage" id="fotos">
                    </li>
                </ul>
            </form>
        
		<form action="conteudo_produtopromocao.php" name="frmCms" class="frmConteudo" method="GET">
			<select name="txtsessao">
				<?php
				$sql = "SELECT * FROM tbl_sessao WHERE id > 6 and id < 9";
				$resultado = mysqli_query($conexao,$sql);
				while($rsSessao = mysqli_fetch_array($resultado)){ ?>
				<option value="<?php echo($rsSessao['id']) ?>"><?php echo(utf8_encode($rsSessao['nome'])) ?>
				</option>
				<?php } ?>
			</select>
			<label class="default_label">Preco</label>
			<input type="number" class="default_input" value="<?php echo($preco) ?>" name="txtpreco">
			<input type="hidden" name="txtfoto">
            <label class="default_label">Produto</label>
            <select name="txtproduto">
                <?php
                    $sql = "SELECT * FROM tbl_produtos";
                    $resultado = mysqli_query($conexao, $sql);
                    while($rsProduto = mysqli_fetch_array($resultado)){ ?>
                    <option value="<?php echo($rsProduto['id']) ?>"><?php echo(utf8_encode($rsProduto['nome'])) ?>
                    </option>

            <?php } ?>
            </select>
            <button value="<?php echo($btnsalvar)?>" name="btnsalvar"><?php echo($btnsalvar) ?></button>
		</form>

		<?php include "tabelaprodutopromocao.php"; ?>
	</div>
</body>
</html>
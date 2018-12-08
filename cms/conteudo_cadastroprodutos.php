<?php
	session_start();

    //declaração de variáveis
	$logado = $_SESSION['login'];
    $nome = "";
    $descricao = "";
    $preco = "";
    $imagem = null;
    $btnsalvar = "salvar";

    //conexao com o banco de dados
	require_once "module.php";
    $conexao = conectar();
    
    /*verificando existência do botão salvar*/
	if(isset($_GET['btnsalvar'])){
		$nome = $_GET['txtnome'];
		$descricao = $_GET['txtdesc'];
        $preco = $_GET['txtpreco'];
		$idSessao = $_GET['txtsessao'];
        $imagem = $_GET['txtfoto'];
        $idSubcategoria = $_GET['txtsubcategoria'];
        
        /*verificando se o conteúdo do botão é igual a salvar*/
        if($_GET['btnsalvar'] == 'salvar'){
            $sql = "INSERT INTO tbl_produtos(nome, preco, descricao, imagem, idSessao, idSubcategoria) values('".$nome."', '".$preco."', '".$descricao."', '".$imagem."', '".$idSessao."', '".$idSubcategoria."')";
        }else if($_GET['btnsalvar'] == 'editar'){
            if($imagem != null){
                $sql = "UPDATE tbl_produtos SET nome = '".$nome."', preco = '".$preco."', descricao = '".$descricao."', imagem = '".$imagem."' WHERE id =".$_SESSION['id'];
            }else{
                $sql = "UPDATE tbl_produtos SET nome = '".$nome."', preco = '".$preco."', descricao = '".$descricao."' WHERE id =".$_SESSION['id'];
            }
        }
        /*enviando a query para o banco junto com a conexao*/
        mysqli_query($conexao, $sql);
        header('location: conteudo_cadastroprodutos.php');
	}

    /*verificando se existe a variável modo*/
	if(isset($_GET['modo'])){
		$modo = $_GET['modo'];
        $id = $_GET['id'];

        if($modo == 'excluir'){
            $sql = 'DELETE FROM tbl_produtos WHERE id ='.$id;
            mysqli_query($conexao, $sql);
            header('location: conteudo_cadastroprodutos.php');
        }else{
            $id = $_GET['id'];
            $_SESSION['id'] = $id;
            $sql = 'SELECT * FROM tbl_produtos where id ='.$id;
            $resultado = mysqli_query($conexao, $sql);
            if($rsProduto = mysqli_fetch_array($resultado)){
                $nome = $rsProduto['nome'];
                $descricao = $rsProduto['descricao'];
                $preco = $rsProduto['preco'];
                $imagem = $rsProduto['imagem'];
                $btnsalvar = 'editar';
            }
        }
	}

    /*verificando se existe a variável status*/
	if(isset($_GET['status'])){
		$status = $_GET['status'];
        $id = $_GET['id'];
        
        if($status == 'ativar'){
            $sql = 'UPDATE tbl_produtos SET status = 1 WHERE id ='.$id;
            mysqli_query($conexao, $sql);
            header('location: conteudo_cadastroprodutos.php');
        }else{
            $sql = 'UPDATE tbl_produtos SET status = 0 WHERE id ='.$id;
            mysqli_query($conexao, $sql);
            header('location: conteudo_cadastroprodutos.php');
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
        
		<form action="conteudo_cadastroprodutos.php" name="frmCms" class="frmConteudo" method="GET">
			<select name="txtsessao">
				<?php
				$sql = "SELECT * FROM tbl_sessao where id = 9";
				$resultado = mysqli_query($conexao,$sql);
				while($rsSessao = mysqli_fetch_array($resultado)){?>
				<option value="<?php echo($rsSessao['id']) ?>"><?php echo($rsSessao['nome']) ?>
				</option>
				<?php }
			?>
			</select>
			<label class="default_label">nome</label>
			<input type="text" class="default_input" value="<?php echo($nome) ?>" name="txtnome">
            <label class="default_label">preco</label>
			<input type="text" class="default_input" value="<?php echo($preco) ?>" name="txtpreco">
			<label class="default_label">Descrição</label>
			<textarea name="txtdesc"><?php echo($descricao)?></textarea>
            
            <select name="txtsubcategoria">
            <?php
                $sql = 'SELECT * FROM tbl_subcategoria where status = 1';
                $resultado = mysqli_query($conexao, $sql);
                while($rsSubcategoria = mysqli_fetch_array($resultado)){
            ?>
                <option value="<?php echo($rsSubcategoria['id']) ?>"><?php echo(utf8_encode($rsSubcategoria['nome'])) ?> </option>
            <?php } ?>
                
            </select>
            
			<input type="hidden" name="txtfoto">

            <button value="<?php echo($btnsalvar)?>" name="btnsalvar"><?php echo($btnsalvar) ?></button>
		</form>

		<?php include "tabelaprodutos.php"; ?>
	</div>
</body>
</html>

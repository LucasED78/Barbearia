<?php
	session_start();

    //declaração de variáveis
	$logado = $_SESSION['login'];
    $titulo = '';
    $descricao = '';
    $subtitulo = '';
    $imagem = null;
    $btnsalvar = 'salvar';

    //conexao com o banco de dados
	require_once "module.php";
    $conexao = conectar();

    /*verificando existência do botão salvar*/
	if(isset($_GET['btnsalvar'])){
		$titulo = $_GET['txttitulo'];
        $subtitulo = $_GET['txtsubtitulo'];
		$descricao = $_GET['txtdesc'];
		$idSessao = $_GET['txtsessao'];
        $imagem = $_GET['txtfoto'];
        
        /*verificando se o conteúdo do botão é igual a salvar*/
        if($_GET['btnsalvar'] == 'salvar'){
            /*query pra inserir dados no banco*/
            $sql = "INSERT INTO tbl_sobre_projeto(titulo, subtitulo, descricao, imagem, idSessao) values('".$titulo."', '".$subtitulo."', '".$descricao."', '".$imagem."', '".$idSessao."')";
        }else if($_GET['btnsalvar'] == 'editar'){
            /*verificando se a imagem foi selecionada ou não*/
            if($imagem != null){
                /*query pra atualizar no banco com a imagem*/
                $sql = "UPDATE tbl_sobre_projeto SET titulo = '".$titulo."', subtitulo = '".$subtitulo."', descricao = '".$descricao."', imagem = '".$imagem."', idSessao = '".$idSessao."' WHERE id =".$_SESSION['id'];
                header('location: conteudo_sobreprojeto.php');
            }else{
                /*query pra atualizar no banco sem a imagem*/
                $sql = "UPDATE tbl_sobre_projeto SET titulo = '".$titulo."', subtitulo = '".$subtitulo."', descricao = '".$descricao."', idSessao = '".$idSessao."' WHERE id =".$_SESSION['id'];
                header('location: conteudo_sobreprojeto.php');
            }
        }
        /*enviando a query para o banco junto com a conexao*/
        mysqli_query($conexao, $sql);
        header('location: conteudo_sobreprojeto.php');
    }

    /*verificando se existe a variável modo*/    
    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        /*verificando se modo é igual a excluir*/
        if($modo == 'excluir'){
            $id = $_GET['id']; //resgatando id

            /*query para excluir dados do banco*/
            $sql = 'DELETE FROM tbl_sobre_projeto WHERE id ='.$id;
            mysqli_query($conexao, $sql);
            header('location: conteudo_sobreprojeto.php');
        }else if($modo == 'editar'){ //verificando se o modo é igual a editar
            $id = $_GET['id'];
            $_SESSION['id'] = $id;

            /*query para recuperar dados do banco*/
            $sql = 'SELECT * FROM tbl_sobre_projeto where id ='.$id;
            $resultado = mysqli_query($conexao, $sql);
            if($rsProjeto = mysqli_fetch_array($resultado)){
                /*pegando os dados recuperados e setando nas variáveis*/
                $titulo = $rsProjeto['titulo'];
                $subtitulo = $rsProjeto['subtitulo'];
                $descricao = $rsProjeto['descricao'];
                $imagem = $rsProjeto['imagem'];
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
            $sql = 'UPDATE tbl_sobre_projeto SET status = 1 WHERE id ='.$id;
            mysqli_query($conexao, $sql);
            header('location: conteudo_sobreprojeto.php');
        }else if($status == 'desativar'){//verificado se status é igual a desativar
            $sql = 'UPDATE tbl_sobre_projeto SET status = 0 WHERE id ='.$id;
            mysqli_query($conexao, $sql);
            header('location: conteudo_sobreprojeto.php');
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
        
		<form action="conteudo_sobreprojeto.php" name="frmCms" class="frmConteudo" method="get">
			<select name="txtsessao">
				<?php
				$sql = "SELECT * FROM tbl_sessao where id > 2 and id < 6";
				$resultado = mysqli_query($conexao,$sql);
				while($rsSessao = mysqli_fetch_array($resultado)){?>
				<option value="<?php echo($rsSessao['id']) ?>"><?php echo(utf8_encode($rsSessao['nome'])) ?>
				</option>
				<?php }
			?>
			</select>
			<label class="default_label">Título</label>
			<input type="text" class="default_input" value="<?php echo($titulo) ?>" name="txttitulo">
            <label class="default_label">Subtítulo</label>
			<input type="text" class="default_input" value="<?php echo($subtitulo) ?>" name="txtsubtitulo">
			<label class="default_label">Descrição</label>
			<textarea name="txtdesc"><?php echo($descricao)?></textarea>
			<input type="hidden" name="txtfoto">

            <button value="<?php echo($btnsalvar) ?>" name="btnsalvar"><?php echo($btnsalvar) ?></button>
		</form>

		<?php include "tabelasobreprojeto.php"; ?>
	</div>
</body>
</html>

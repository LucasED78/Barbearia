<?php
	session_start();
    
    //declaração de variáveis
	$logado = $_SESSION['login'];
    $nivel = $_SESSION['nivel'];
    $nome = "";
    $btnsalvar = "salvar";
    
    if($nivel != 'administrador'){
        echo("<script>")."alert('Somente administradores podem acessar essa área!!');"."</script>";
        echo("<script>window.location = 'cmsindex.php';</script>");
    }
    
    //conexao com o banco de dados
	require_once "module.php";
    $conexao = conectar();
    
    /*verificando existência do botão salvar*/
	if(isset($_GET['btnsalvar'])){
		$nome = $_GET['txtcategoria'];
		$subcategoria = $_GET['txtsubcategoria'];
        
        /*verificando se o conteúdo do botão é igual a salvar*/
        if($_GET['btnsalvar'] == 'salvar'){
            /*query pra inserir dados no banco*/
            $sql = "INSERT INTO tbl_categoria(nome) values('".$nome."')";
            header('location: conteudo_categoria.php');
        }else if($_GET['btnsalvar'] == 'editar'){
            $sql = "UPDATE tbl_categoria SET nome = '".$nome."' WHERE id =".$_SESSION['id'];
            header('location: conteudo_categoria.php');
            }
        /*enviando a query para o banco junto com a conexao*/
        mysqli_query($conexao, $sql);
        header('location: conteudo_categoria.php');
	}

    /*verificando se existe a variável modo*/
	if(isset($_GET['modo'])){
		$modo = $_GET['modo'];

        /*verificando se modo é igual a excluir*/
		if($modo == 'excluir'){
            $id = $_GET['id']; //resgatando id

             /*query para excluir dados do banco*/
			$sql = 'delete from tbl_categoria where id ='.$id;
			mysqli_query($conexao,$sql);
			header('location: conteudo_categoria.php');
		}else if($modo == 'editar'){ //verificando se o modo é igual a editar
            $id = $_GET['id'];
            $_SESSION['id'] = $id;

            /*query para recuperar dados do banco*/
            $sql = 'SELECT * FROM tbl_categoria where id ='.$id;
            $resultado = mysqli_query($conexao, $sql);
            if($rsCategoria = mysqli_fetch_array($resultado)){
                /*pegando os dados recuperados e setando nas variáveis*/
                $nome = $rsCategoria['nome'];
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
            $sql = "UPDATE tbl_categoria set status = 1 WHERE id=".$id;
            mysqli_query($conexao, $sql);
            header('location: conteudo_categoria.php');
		}else if($status == 'desativar'){//verificado se status é igual a desativar
			$sql = "UPDATE tbl_categoria SET status = 0 WHERE id =".$id;
			mysqli_query($conexao, $sql);
			header('location: conteudo_categoria.php');
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
        
		<form action="conteudo_categoria.php" name="frmCms" class="frmConteudo" method="GET">
			<label class="default_label">Categoria</label>
			<input type="text" class="default_input" value="<?php echo($nome) ?>" name="txtcategoria">
			<input type="hidden" name="txtfoto">

            <button value="<?php echo($btnsalvar)?>" name="btnsalvar"><?php echo($btnsalvar) ?></button>
		</form>

		<?php include "tabelacategoria.php"; ?>
	</div>
</body>
</html>

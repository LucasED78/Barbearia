<?php
	session_start();

    //declaração de variáveis
	$logado = $_SESSION['login'];
    $nivel = $_SESSION['nivel'];

    if($nivel != 'administrador'){
        echo("<script>")."alert('Somente administradores podem acessar essa área!!');"."</script>";
        echo("<script>window.location = 'cmsindex.php';</script>");
    }

    $subcategoria = "";
    $btnsalvar = "salvar";

    //conexao com o banco de dados
	require_once "module.php";
    $conexao = conectar();
    
    /*verificando existência do botão salvar*/
	if(isset($_GET['btnsalvar'])){
		$categoria = $_GET['txtcategoria'];
		$subcategoria = $_GET['txtsubcategoria'];
        
        /*verificando se o conteúdo do botão é igual a salvar*/
        if($_GET['btnsalvar'] == 'salvar'){
            /*query pra inserir dados no banco*/
            $sql = "INSERT INTO tbl_subcategoria(nome, idCategoria) values('".$subcategoria."', '".$categoria."')";
            header('location: conteudo_subcategoria.php');
        }else if($_GET['btnsalvar'] == 'editar'){
            $sql = "UPDATE tbl_subcategoria SET nome = '".$subcategoria."' WHERE id =".$_SESSION['id'];
            header('location: conteudo_subcategoria.php');
            }
        /*enviando a query para o banco junto com a conexao*/
        mysqli_query($conexao, $sql);
        header('location: conteudo_subcategoria.php');
	}

    /*verificando se existe a variável modo*/
	if(isset($_GET['modo'])){
		$modo = $_GET['modo'];

        /*verificando se modo é igual a excluir*/
		if($modo == 'excluir'){
            $id = $_GET['id']; //resgatando id

             /*query para excluir dados do banco*/
			$sql = 'delete from tbl_subcategoria where id ='.$id;
			mysqli_query($conexao,$sql);
			header('location: conteudo_subcategoria.php');
		}else if($modo == 'editar'){ //verificando se o modo é igual a editar
            $id = $_GET['id'];
            $_SESSION['id'] = $id;

            /*query para recuperar dados do banco*/
            $sql = 'SELECT * FROM tbl_subcategoria where id ='.$id;
            $resultado = mysqli_query($conexao, $sql);
            if($rsSubcategoria = mysqli_fetch_array($resultado)){
                /*pegando os dados recuperados e setando nas variáveis*/
                $subcategoria = $rsSubcategoria['nome'];
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
            $sql = "UPDATE tbl_subcategoria set status = 1 WHERE id=".$id;
            mysqli_query($conexao, $sql);
            header('location: conteudo_subcategoria.php');
		}else if($status == 'desativar'){//verificado se status é igual a desativar
			$sql = "UPDATE tbl_subcategoria SET status = 0 WHERE id =".$id;
			mysqli_query($conexao, $sql);
			header('location: conteudo_subcategoria.php');
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
		<form action="conteudo_subcategoria.php" name="frmCms" class="frmConteudo" method="GET">
            <label class="default_label">Categoria</label>
            <select name="txtcategoria">
                <?php
                    $sql = 'SELECT * FROM tbl_categoria where status = 1';
                    $resultado = mysqli_query($conexao, $sql);
                    while($rsCategoria = mysqli_fetch_array($resultado)){
                ?>
                <option value="<?php echo($rsCategoria['id']) ?>"><?php echo(utf8_encode($rsCategoria['nome'])) ?></option>
                <?php } ?>
            </select>
            
			<label class="default_label">Subcategoria</label>
			<input type="text" class="default_input" value="<?php echo($subcategoria) ?>" name="txtsubcategoria">

            <button value="<?php echo($btnsalvar)?>" name="btnsalvar"><?php echo($btnsalvar) ?></button>
		</form>

		<?php include "tabelasubcategoria.php"; ?>
	</div>
</body>
</html>

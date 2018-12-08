<?php
	session_start();

    //declaração de variáveis
	$logado = $_SESSION['login'];
    $rua = '';
    $numero = '';
    $cidade = '';
    $bairro = '';
    $cep = '';
    $celular = '';
    $telefone = '';
    $imagem = null;
    $btnsalvar = 'salvar';

    //conexao com o banco de dados
	require_once "module.php";
    $conexao = conectar();

    /*verificando existência do botão salvar*/
	if(isset($_GET['btnsalvar'])){
		$rua = $_GET['txtrua'];
        $numero = $_GET['txtnumero'];
        $cidade = $_GET['txtcidade'];
        $bairro = $_GET['txtbairro'];
        $cep = $_GET['txtcep'];
        $celular = $_GET['txtcelular'];
        $telefone = $_GET['txtfone'];
		$idSessao = $_GET['txtsessao'];
        $imagem = $_GET['txtfoto'];
        
        /*query pra inserir dados no banco*/
        if($_GET['btnsalvar'] == 'salvar'){
            $sql = "INSERT INTO tbl_sobre_lojas(rua, numero, bairro, cep, cidade, telefone, celular, imagem, idSessao) values('".$rua."', '".$numero."', '".$bairro."', '".$cep."', '".$cidade."', '".$telefone."', '".$celular."', '".$imagem."', '".$idSessao."')";
        }else if($_GET['btnsalvar'] == 'editar'){
            /*verificando se a imagem foi selecionada ou não*/
            if($imagem != null){
                /*query pra atualizar no banco com a imagem*/
                $sql = "UPDATE tbl_sobre_lojas SET rua = '".$rua."', numero = '".$numero."', cidade = '".$cidade."', bairro = '".$bairro."', cep = '".$cep."', celular = '".$celular."', telefone = '".$telefone."', idSessao = '".$idSessao."', imagem = '".$imagem."' WHERE id =".$_SESSION['id'];
            }else{
                /*query pra atualizar no banco sem a imagem*/
                $sql = "UPDATE tbl_sobre_lojas SET rua = '".$rua."', numero = '".$numero."', cidade = '".$cidade."', bairro = '".$bairro."', cep = '".$cep."', celular = '".$celular."', telefone = '".$telefone."', idSessao = '".$idSessao."' WHERE id =".$_SESSION['id'];
            }
        }
        /*enviando a query para o banco junto com a conexao*/
        mysqli_query($conexao, $sql);
        header('location: conteudo_sobrelojas.php');
    }

    /*verificando se existe a variável modo*/
    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        /*verificando se modo é igual a excluir*/
        if($modo == 'excluir'){
            $id = $_GET['id']; //resgatando id

            /*query para excluir dados do banco*/
            $sql = 'DELETE FROM tbl_sobre_lojas WHERE id ='.$id;
            mysqli_query($conexao, $sql);
            header('location: conteudo_sobrelojas.php');
        }else if($modo == 'editar'){ //verificando se o modo é igual a editar
            $id = $_GET['id'];
            $_SESSION['id'] = $id;

            /*query para recuperar dados do banco*/
            $sql = 'SELECT * FROM tbl_sobre_lojas where id ='.$id;
            $resultado = mysqli_query($conexao, $sql);
            if($rsLoja = mysqli_fetch_array($resultado)){
                /*pegando os dados recuperados e setando nas variáveis*/
                $rua = $rsLoja['rua'];
                $numero = $rsLoja['numero'];
                $cidade = $rsLoja['cidade'];
                $bairro = $rsLoja['bairro'];
                $celular = $rsLoja['celular'];
                $telefone = $rsLoja['telefone'];
                $cep = $rsLoja['cep'];
                $imagem = $rsLoja['imagem'];
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
            $sql = 'UPDATE tbl_sobre_lojas SET status = 1 WHERE id ='.$id;
            mysqli_query($conexao, $sql);
            header('location: conteudo_sobrelojas.php');
        }else if($status == 'desativar'){ //verificado se status é igual a desativar
            $sql = 'UPDATE tbl_sobre_lojas SET status = 0 WHERE id ='.$id;
            mysqli_query($conexao, $sql);
            header('location: conteudo_sobrelojas.php');
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
        
		<form action="conteudo_sobrelojas.php" name="frmCms" class="frmConteudo" method="get">
			<select name="txtsessao">
				<?php
				$sql = "SELECT * FROM tbl_sessao where id = 6";
				$resultado = mysqli_query($conexao,$sql);
				while($rsSessao = mysqli_fetch_array($resultado)){?>
				<option value="<?php echo($rsSessao['id']) ?>"><?php echo(utf8_encode($rsSessao['nome'])) ?>
				</option>
				<?php }
			?>
			</select>
			<label class="default_label">rua</label>
			<input type="text" class="default_input" value="<?php echo($rua) ?>" name="txtrua">
            <label class="default_label">número</label>
			<input type="text" class="default_input" value="<?php echo($numero) ?>" name="txtnumero">
			<label class="default_label">cidade</label>
			<input type="text" class="default_input" value="<?php echo($cidade) ?>" name="txtcidade">
            <label class="default_label">bairro</label>
			<input type="text" class="default_input" value="<?php echo($bairro) ?>" name="txtbairro">
            <label class="default_label">cep</label>
			<input type="text" class="default_input" value="<?php echo($cep) ?>" name="txtcep">
            <label class="default_label">celular</label>
			<input type="text" class="default_input" value="<?php echo($celular) ?>" name="txtcelular">
            <label class="default_label">telefone</label>
			<input type="text" class="default_input" value="<?php echo($telefone) ?>" name="txtfone">
			<input type="hidden" name="txtfoto">

            <button type="submit" value="<?php echo($btnsalvar) ?>" name="btnsalvar"><?php echo($btnsalvar) ?></button>
		</form>

		<?php include "tabelasobrelojas.php"; ?>
	</div>
</body>
</html>

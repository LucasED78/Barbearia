<?php
	session_start();
    //declaração de variáveis
	$logado = $_SESSION['login'];
    $nivel = $_SESSION['nivel'];

    if($nivel != 'administrador'){
        echo("<script>")."alert('Somente administradores podem acessar essa área!!');"."</script>";
        echo("<script>window.location = 'cmsindex.php';</script>");
    }

    //conexao com o banco de dados
	require_once "module.php";
    $conexao = conectar();
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
        <table class="table-model">
            <tr class="table-row">
                <td class="table-cell" colspan="5">
                    <h1>Conteúdos Cadastrados</h1>
                </td>
            </tr>

            <tr class="table-row" style="font-weight: bold; background-color: lightgray;">
                <td class="table-cell">
                    Categoria
                </td>

                <td class="table-cell">
                    Cliques
                </td>
                
                <td class="table-cell">
                    Gráfico
                </td>
            </tr>
        
        <?php
            $sql = "SELECT * FROM tbl_produtos";

            $resultado = mysqli_query($conexao, $sql);

            while($rsProdutos = mysqli_fetch_array($resultado)){
        ?>
        
		<tr class="table-row">
            <td class="table-cell" style="border-right: 0.5px solid #202020;"><?php                     echo(utf8_encode($rsProdutos['nome'])) ?></td>

            <td class="table-cell" style="border-right: 0.5px solid #202020;"><?php echo($rsProdutos['clique']) ?></td>
            
            <td class="table-cell">
                <?php 
                    $clique = $rsProdutos['clique'];
                    $clique *= 5;
                ?>
                
                <div style="width: <?php echo $clique.'px' ?>; background-color: red;">
                    <?php echo $clique.'%' ?>
                </div>
            </td>
        </tr>
        
        <?php } ?>
        </table>
	</div>
</body>
</html>

<?php
	session_start();

    //declaração de variáveis
	$logado = $_SESSION['login'];
    $descricao = '';
    $imagem = null;
    $btnsalvar = 'salvar';

    //conexao com o banco de dados
	require_once "module.php";
    $conexao = conectar();

    /*verificando se existe a variável status*/
    if(isset($_GET['status'])){
        $status = $_GET['status'];
        $id = $_GET['id'];
        
        //verificando se status é igual a ativar
        if($status == 'ativar'){
            //query pra atualizar o status
            $sql = 'UPDATE tbl_produtos set destaque = 1 where id ='.$id;
            mysqli_query($conexao, $sql);
            header('location: conteudo_produtodestaque.php');
            }else if($status == 'desativar'){//verificado se status é igual a desativar
                $sql = 'UPDATE tbl_produtos SET destaque = 0 WHERE id ='.$id;
                mysqli_query($conexao, $sql);
                header('location: conteudo_produtodestaque.php');
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
        <table class="table-model">
            <tr class="table-row">
                <td class="table-cell" colspan="5">
                    <h1>Conteúdos Cadastrados</h1>
                </td>
            </tr>

            <tr class="table-row" style="font-weight: bold; background-color: lightgray;">
                <td class="table-cell">
                    Nome
                </td>

                <td class="table-cell">
                    Preço
                </td>

                <td class="table-cell">
                    Opções
                </td>
            </tr>

            <?php
                $sql = "select * from tbl_produtos";

                $resultado = mysqli_query($conexao, $sql);

                while($rsProduto = mysqli_fetch_array($resultado)){
            ?>

            <tr class="table-row">
                <td class="table-cell" style="border-right: 0.5px solid #202020;"><?php echo(utf8_encode($rsProduto['nome'])) ?></td>

                <td class="table-cell" style="border-right: 0.5px solid #202020;"><?php echo($rsProduto['preco']) ?></td>

                <td class="table-cell">
                    <a href="conteudo_produtodestaque.php?status=ativar&id=<?php echo($rsProduto['id']) ?>">
                      <img src="imagens/ativar.png">
                    </a>

                    <a href="conteudo_produtodestaque.php?status=desativar&id=<?php echo($rsProduto['id'])?>">
                      <img src="imagens/desativar.png">
                    </a>
                </td>
            </tr>

            <?php
                }
            ?>
        </table>

	</div>
</body>
</html>

<?php 
	require_once "module.php";
    $conexao = conectar();

	if(isset($_POST['id'])){
		$id = $_POST['id'];
        $sql = 'UPDATE tbl_produtos set clique = clique + 1 WHERE id ='.$id;
        $resultado = mysqli_query($conexao, $sql);
        
        $sql1 = 'SELECT * FROM tbl_produtos WHERE id ='.$id;
        $resultado = mysqli_query($conexao, $sql1);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<script src="js/jquery.js"></script>

	<script>
		$(document).ready(function(){
            $('#fechar').click(function(){
                $('.container').fadeOut(1000);
            });
        });
	</script>
</head>
<body>
    <div id="fechar">
        <img src="imagens/cancel.png" width="32" height="32">
    </div>

    <div>
        <?php 
            while($rsProdutos = mysqli_fetch_array($resultado)){
        ?>
        
        <div class="det_img">
            <img src="cms/<?php echo($rsProdutos['imagem']) ?>">
        </div>
        
        <article>
            <p><?php echo(utf8_encode($rsProdutos['nome'])) ?></p>
            <p><?php echo(utf8_encode($rsProdutos['preco'])) ?></p>
            <p><?php echo(utf8_encode($rsProdutos['descricao'])) ?></p>
            <p><?php echo(utf8_encode($rsProdutos['clique'])) ?></p>
        </article>
        
        <?php } ?>
    </div>
</body>
</html>
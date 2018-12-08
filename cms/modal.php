<?php 
	require_once "module.php";
    $conexao = conectar();

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = 'select * from tbl_fconosco where id ='.$id;
		$resultado = mysqli_query($conexao,$sql);

		if($rs = mysqli_fetch_array($resultado)){
			$nome = $rs['nome'];
			$email = $rs['email'];
			$profissao = $rs['profissao'];
			$critica = $rs['critica'];
			$telefone = $rs['telefone'];
			$sexo = $rs['genero'];
			$obs = $rs['facebook'];
			$homepage = $rs['home'];
			$celular = $rs['celular'];
		}
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
        <img src="imagens/cancel.png">
    </div>

    <div>
        <ul>
            <li>
                <label class="default_label">Nome: </label>
                <input class="default_input" type="text" required name="txtnome" value="<?php echo(utf8_encode($rs['nome'])) ?>">
            </li>

            <li>
                <label class="default_label">Telefone: </label>
                <input class="default_input" type="tel" name="txttelefone" value="<?php echo($rs['telefone']) ?>">
            </li>

            <li>
                <label class="default_label">Celular: </label>
                <input class="default_input" type="text" name="txtcelular" value="<?php echo($rs['celular']) ?>">
            </li>

            <li>
                <label class="default_label">E-mail: </label>
                <input class="default_input" required type="email" required name="txtemail" value="<?php echo(utf8_encode($rs['email']))?>">
            </li>

            <li>
                <label class="default_label">Homepage: </label>
                <input class="default_input" type="url" name="txthome" value="<?php echo(utf8_encode($rs['home'])) ?>">
            </li>

            <li>
                <label class="default_label">Facebook: </label>
                <input class="default_input" type="url" name="txtface" value="<?php echo(utf8_encode($rs['facebook']))?>">
            </li>

            <li>
                <label class="default_label">Informação de produtos: </label>
                <input class="default_input" type="text" name="txtinfo" value="<?php echo(utf8_encode($rs['informacao'])) ?>">
            </li>

            <li>
                <label class="default_label">Sexo: </label>
                <input class="radio" type="radio" name="sexo" value="M" checked>Masculino
                <input class="radio" type="radio" name="sexo" value="F">Feminino
                <input class="radio" type="radio" name="sexo" value="I">Indefinido
            </li>

            <li>
                <label class="default_label">Profissão: </label>

                <input class="default_input" required type="text" name="txtprofissao" value="<?php echo(utf8_encode($rs['profissao'])) ?>">
            </li>

            <li>
                <label class="default_label">Sugestão/críticas: </label>
                <textarea name="txtcritica"><?php
                    if (isset($obs)) {
                        echo $obs;
                    }
                 ?></textarea>
            </li>
        </ul>
    </div>
</body>
</html>
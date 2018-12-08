<?php
   session_start();
    require_once "module.php";
    $nivel = $_SESSION['nivel'];
    $logado = $_SESSION['login'];

    if($nivel == 'básico'){
        echo("<script>")."alert('Somente administradores podem acessar essa área!!');"."</script>";
        echo("<script>window.location = '../index.php';</script>");
    }
    
    $conexao = conectar();

    /*verificando se existe a variável de login, caso não exista, redireciona o usuário´para a página de login*/
    if(!isset($logado)){
        header('location: ../index.php');
    }

    if(isset($_GET['btnsair'])){
        $logout = $_GET['btnsair'];
        $_SESSION['logout'] = $logout;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>CMS</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    
    <body>
        <header>
            <div class="header-left">
                <h1>CMS - Sistema de Gerenciamento</h1>
            </div>

            <div class="header-right">
                <img src="imagens/testeimg.png">
            </div>
        </header>

        <nav>
            <div class="left">
                <ul>    
                    <li>
                        <div class="img">
                            <img src="imagens/admconteudo.png" alt="opção do menu">
                        </div>
                        <a href="conteudo.php">Adm. Conteúdo</a></li>

                    <li>
                        <div class="img">
                            <img src="imagens/fale-conosco.png" alt="opção do menu">
                        </div>
                        <a href="faleconosco.php">Adm. Fale Conosco</a></li>

                    <li>
                        <div class="img">
                            <img src="imagens/admproduto.png" alt="opção do menu">
                        </div>
                        <a href="produtos.php">Adm. Produtos</a></li>

                    <li>
                        <div class="img">
                            <img src="imagens/admusuario.png" alt="opção do menu">
                        </div>  
                        <a href="cadastro.php">Adm. Usuários</a></li>

                    <li>
                        <div class="img">
                            <img src="imagens/nivel.png" alt="opcção do menu">
                        </div>
                        <a href="nivel.php">Níveis</a>
                    </li>
                </ul>
            </div>

            <div class="right">

                <div id="panel_user">
                    <p class="panel-txt">Bem vindo, <?php echo($logado)?></p>
                    <div>
                        <?php
                            $sql = "select foto from tbl_usuario where usuario='$logado'"; //fazer com que o id venha parar nessa página
                            $result = mysqli_query($conexao,$sql);

                            while ($rsFoto = mysqli_fetch_array($result)) {

                        ?>

                        <div id="perfil">
                            <img src="<?php echo($rsFoto['foto'])?>">
                        </div> 
                    </div>       

                    <?php
                        }
                    ?>

                    <div>
                        <form method="get" action="../index.php">
                            <button class="btn" id="btn_logout" style="margin: 0; margin-left: 10px;" name="btnsair">logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        
        <div class="content">
        
        </div>

        <footer>
            Desenvolvido por Lucas Eduardo
        </footer>
    </body>
</html>
<?php
    /*conexão com o banco*/
        require_once "module.php";
        $conexao = conectar();

    if(isset($_GET['btnlog'])){
        /* se o botão de logar for acionado, a sessao vai ser criada*/
        session_start();

        /*resgatando os valores das caixas de texto e guardando em váriaveis de usuario e senha*/
        $login = $_GET['txtusuario'];
        $senha = $_GET['txtpassword'];

        //resgatando a senha e a transformando em md5
        $encryptSenha = md5($senha);

        /*query que busca no banco o usuario cadastrado, caso exista*/
        $sql = mysqli_query($conexao, "select * from tbl_usuario where usuario = '$login' and senha = '$encryptSenha' and status = 1");

        /*se o numero de linhas for maior que 0, significa que existe algum usuario cadastrado, então ele atribui o login e a senha a duas váriaveis de sessões que guardam esses dois valores*/
        if(mysqli_num_rows($sql) > 0){
            $_SESSION['login'] = $login;
            $_SESSION['senha'] = $encryptSenha;
            header('location:cms/cmsindex.php');
        }else{
            /*se não existir, reseta as váriaveis de sessão e redireciona o usuário para o index*/
            unset($_SESSION['login']);
            unset($_SESSION['senha']);
            echo("<script>alert('usuário ou senha incorretos!!');</script>");
        }
    }

    /*se existir a variável de sessão logout, significa que alguém deslogou, então ele destrói a sessão de vez e desloga o usuario*/
    if(isset($_SESSION['logout'])){
        session_destroy();
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="CSS/style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Home</title>
        <script src="js/jquery.js"></script>
        <script>
            $(document).ready(function(){
                $(".categoria li").not($('.categoria li a')).click(function (e) {
                $('ul.subcategoria').not( $(this).children() ).slideUp();
                $(this).children("ul.subcategoria").slideToggle();
                e.stopPropagation()
                });
                
                $('.logo-mobile').click(function(){
                    $('.menu-mobile').fadeIn(1000);
                });
                
                $('.menu-mobile li').not($('.menu-mobile li a')).click(function(e){
                $('ul.submenu-mobile').not($(this).children()).slideUp();
                $(this).children('ul.submenu-mobile').slideToggle();
                e.stopPropagation()
                });
            })
        </script>
    </head>

    <body>
        <style>
            .content{
                overflow: visible;
                height: auto;
            }
            
            @media screen and (min-width: 1000px) and (max-width: 1920px){
                .logo-mobile{
                    display: none;
            }
            
                .menu-mobile{
                    display: none;
            }
            
                .submenu-mobile{
                    display: none;
            }
        }
        </style>

        <div class="back">
            <nav>
                <?php
                    include "menumobile.html";
                ?>
                
                <div class="logo">
                    <img src="Imagens/Home/hairdresser-chairwhite.png" alt="logo">
                </div>

                <div class="nav-left">
                    <ul class="menu">
                        <li><a class="sub-a" href="index.php">Home</a></li>
                        <li>Produtos
                            <ul class="submenu">
                                <li><a class="sub-a" href="produtomes.php">Produto do Mês</a></li>
                                <li><a class="sub-a" href="promocao.php">Promoções</a></li>
                            </ul>
                        </li>
                        <li>Sobre
                            <ul class="submenu">
                                <li><a class="sub-a" href="barbearia.php">Cachorro Loko</a></li>
                                <li><a class="sub-a" href="cestetico.php">Centro Estético</a></li>
                                <li><a class="sub-a" href="sobre.php">Projeto</a></li>
                                <li><a class="sub-a" href="lojas.php">Lojas</a></li>
                            </ul>
                        </li>
                        <li>Contato
                            <ul class="submenu">
                                <li><a class="sub-a" href="faleconosco.php">Fale Conosco</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="nav-right">
                    <article>
                        <p>Usuário: </p>
                        <p>Senha: </p>
                    </article>

                    <form>
                        <input type="text" name="txtusuario">
                        <input type="password" name="txtpassword">
			            <button name="btnlog">logar</button>
                    </form>
                </div>
            </nav>
            
            <form method="get" action="subcategoria.php">
                <input type="text" placeholder="pesquise aqui..." name="txtsearch">
            </form>
        </div>

        <div class="front">
            <header>
                  <img class="mySlides" src="Imagens/slider/slide1.jpeg" alt="slide 1">
                  <img class="mySlides" src="Imagens/slider/slide2.jpeg" alt="slide 2">
                  <img class="mySlides" src="Imagens/slider/slide3.jpeg" alt="slide 3">
                <button class="prev" style="float: left;" onclick="plusDivs(-1)">&#10094;</button>
                <button class="next" style="float: right;" onclick="plusDivs(+1)">&#10095;</button>
            </header>

            <div class="content">
                <section class="content-left">
                    <?php
                        $sql = 'SELECT * from tbl_categoria where status = 1';
                        $resultado = mysqli_query($conexao, $sql);
                        while($rsCategoria = mysqli_fetch_array($resultado)){
                    ?>
                    <ul class="categoria">
                        <li class="categoria-item" value="<?php echo($cont) ?>">
                            <?php echo(utf8_encode($rsCategoria['nome'])) ?>
                            <?php
                            $sql1 = 'SELECT * from tbl_subcategoria where status = 1 and idCategoria ='.$rsCategoria['id'];
                            $resultado1 = mysqli_query($conexao, $sql1);
                            while($rsSubcategoria = mysqli_fetch_array($resultado1)){ ?>
                            <ul class="subcategoria">
                                <li><a href="subcategoria.php?idSubcategoria=<?php echo($rsSubcategoria['id']) ?>"><?php echo(utf8_encode($rsSubcategoria['nome']))?></a></li>
                            </ul>
                            <?php } ?>
                            <?php } ?>
                        </li>
                    </ul>
                </section>

                <section class="content-right">
                    <div class="catalogo">
                        
                        <?php
                            if(isset($_GET['idSubcategoria'])){
                                $idSubcategoria = $_GET['idSubcategoria'];
                                
                                if(isset($_GET['txtsearch'])){
                                    $pesquisa = $_GET['txtsearch'];
                                    $sql = "SELECT * FROM tbl_produtos where status = 1 and idSubcategoria = '".$idSubcategoria."' and pesquisa = '".$pesquisa."' ";
                                }else{
                                    $sql = "SELECT * from tbl_produtos where status = 1 and idSubcategoria = '".$idSubcategoria."'";
                                }
                                   
                                $resultado = mysqli_query($conexao, $sql);
                                while($rsProdutos = mysqli_fetch_array($resultado)){
                        ?>
                        
                        <div class="catalogo-item">
                            <img class="imagem-produto" src="cms/<?php echo($rsProdutos['imagem']) ?>" alt="imagem do catalogo">

                            <article style="text-align: left;">
                                <p>Nome: <?php echo(utf8_encode($rsProdutos['nome'])) ?> </p>
                                <p>Preço: <?php echo($rsProdutos['preco']) ?> </p>
                                <p>Descrição: <?php echo(utf8_encode($rsProdutos['descricao'])) ?> </p>
                                <p style="text-align: right;">Detalhes: </p>
                            </article>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                </section>

                <div class="redes-sociais">
                    <div class="rs-itens">
                        <img src="Imagens/facebook128.png" alt="facebook">
                    </div>

                    <div class="rs-itens">
                        <img src="Imagens/instagram128.png" alt="instagram">
                    </div>

                    <div class="rs-itens">
                        <img src="Imagens/twitter128.png" alt="twitter">
                    </div>
                </div>
            </div>

            <footer>
                <div class="footer-item">
                    <img src="Imagens/Home/hairdresser-chairwhite.png" alt="logo">
                </div>

                <div class="footer-item">
                    <article>
                        <a href="#">O Projeto</a><br>
                        <a href="#">Barbearia</a><br>
                        <a href="#">Centro Estético</a><br>
                    </article>
                </div>

                <div class="footer-item">
                    <article>
                        <a href="#">Produto do Mês</a><br>
                        <a href="#">Promoções</a><br>
                    </article>
                </div>

                <div class="footer-item">
                    <article>
                        <a href="#">Fale Conosco</a>
                    </article>
                </div>

                <div class="footer-redes">
                    <img src="Imagens/Home/instagram.png" alt="instagram">
                    <img src="Imagens/Home/facebook-logo-in-circular-button-outlined-social-symbol.png" alt="facebook">
                    <img src="Imagens/Home/twitter-circular-button.png" alt="twitter">
                    <img src="Imagens/Home/google-plus-circular-button.png" alt="google plus">
                    <img src="Imagens/Home/social-youtube-circular-button.png" alt="youtube">
                </div>
            </footer>
        </div>

        <script type="text/javascript">
            var slideIndex = 1;
            showDivs(slideIndex);

            function plusDivs(n) {
              showDivs(slideIndex += n);
            }

            function showDivs(n) {
              var i;
              var x = document.getElementsByClassName("mySlides");
              if (n > x.length) {slideIndex = 1}
              if (n < 1) {slideIndex = x.length}
              for (i = 0; i < x.length; i++) {
                 x[i].style.display = "none";
              }
              x[slideIndex-1].style.display = "block";
            }

            var myIndex = 0;
            carousel();

            function carousel() {
                var i;
                var x = document.getElementsByClassName("mySlides");
                for (i = 0; i < x.length; i++) {
                   x[i].style.display = "none";
                }
                myIndex++;
                if (myIndex > x.length) {myIndex = 1}
                x[myIndex-1].style.display = "block";
                setTimeout(carousel, 2000); // Change image every 2 seconds
            }
        </script>

    </body>
</html>

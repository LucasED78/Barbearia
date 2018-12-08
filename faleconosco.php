<?php
    require_once "module.php";
    $conexao = conectar();
        
    if(isset($_POST['btnsub'])){
        $nome = $_POST['txtnome'];
        $telefone = $_POST['txttelefone'];
        $celular = $_POST['txtcelular'];
        $email = $_POST['txtemail'];
        $home = $_POST['txthome'];
        $facebook = $_POST['txtface'];
        $informacao = $_POST['txtinfo'];
        $genero = $_POST['sexo'];
        $profissao = $_POST['txtprofissao'];
        $critica = $_POST['txtcritica'];

        $sql = "insert into tbl_fconosco(nome, telefone, celular, email, home, facebook, informacao, genero, profissao, critica) values('".$nome."', '".$telefone."', '".$celular."', '".$email."', '".$home."', '".$facebook."', '".$informacao."', '".$genero."', '".$profissao."', '".$critica."');";
        
        if(mysqli_query($conexao, $sql)){
            header('location: faleconosco.php');
        }else{
            echo "OCORREU UM ERRO NA INSERÇÃO AO BANCO!!! VERIFIQUE A QUERY E TENTE NOVAMENTE!!";
        }
    }

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Home</title>
		<link rel="stylesheet" type="text/css" href="CSS/style.css">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Fale Conosco</title>
        <script type="text/javascript" src="js/jquery-3.2.1.min.js">
        </script>
        
        <script type="text/javascript" src="js/jquery.mask.js">
        </script>
        
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
        <script type="text/javascript">
            /*função em javascript para validar alguns campos e impedir caracteres indevidos*/
            function validar(caracter, blockType, campo){
                document.getElementById(campo).style="background-color: white;"
                
                if(window.Event){
                    var letra = caracter.charCode;
                }else{
                    var letra = character.which;
                }
                
                /*lógica para bloquear caracter*/
                if(blockType == 'number'){
                    if (letra >= 48 && letra <= 57){
                        if(letra != 8 && letra != 32 && letra != 9){
                            document.getElementById(campo).style="background-color: #F4A1A1";
                            return false;
                        }
                    }
                    /*lógica para bloquear numeros*/
                }else if(blockType == 'caracter'){
                    if(letra < 48 || letra > 57){
                        if(letra != 8 && letra != 32 && letra !=9 && letra != 45 & letra != 40 && letra != 41){
                            document.getElementById(campo).style="background-color: #F4A1A1;"
                            return false;
                        }
                    }else{
                        
                    }
                }
            }
            
            function abrirMenu(){
                menu = document.getElementById("menu-mobile");
                
                menu.style.display = "block";
            }
            
            function abrirSubmenu(){
                submenu = document.getElementById("submenu-mobile");
                
                submenu.style.display = "block";
            }
		</script>
        
        <style>
            header{
                background-image: url(Imagens/Barbearia/pexels-photo-529922.jpeg);
                background-size: cover;
                font-family: lobster;
                height: 500px;
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
                                <li><a class="sub-a" href="produtomes.html">Produto do Mês</a></li>
                                <li><a class="sub-a" href="promocao.html">Promoções</a></li>
                            </ul>
                        </li>
                        <li>Sobre
                            <ul class="submenu">
                                <li><a class="sub-a" href="barbearia.html">Cachorro Loko</a></li>
                                <li><a class="sub-a" href="cestetico.html">Centro Estético</a></li>
                                <li><a class="sub-a" href="sobre.html">Projeto</a></li>
                                <li><a class="sub-a" href="lojas.html">Lojas</a></li>
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
                    </form>
                </div>
            </nav>
        </div>
        
        <div class="front">
            <header>
                <div class="overlay">
                    <h1>Fale Conosco</h1>
                    <div class="border"></div>
                </div>
            </header>
            
            <div class="content">
                <form class="fale-conosco" method="post" action="faleconosco.php">
                    <ul>
                        <li>
                            <label class="lbl_fconosco">Nome: </label>
                            <input class="input-normal" type="text" required name="txtnome" id="nome" onkeypress="return validar(event, 'number', 'nome');">
                        </li>

                        <li>
                            <label class="lbl_fconosco">Telefone: </label>
                            <input class="input-normal" type="tel" id="telefone" name="txttelefone" onkeypress="return validar(event, 'caracter', 'telefone');">
                            <script>$("#telefone").mask('(00) 0000-0000');</script>
                        </li>

                        <li>
                            <label class="lbl_fconosco">Celular: </label>
                            <input class="input-normal" type="text" id="celular" name="txtcelular" onkeypress="return validar(event, 'caracter', 'celular');">
                            <script>$("#celular").mask('(00) 00000-0000');</script>
                        </li>

                        <li>
                            <label class="lbl_fconosco">E-mail: </label>
                            <input class="input-normal" required type="email" required name="txtemail">
                        </li>

                        <li>
                            <label class="lbl_fconosco">Homepage: </label>
                            <input class="input-normal" type="url" name="txthome">
                        </li>

                        <li>
                            <label class="lbl_fconosco">Facebook: </label>
                            <input class="input-normal" type="url" name="txtface">
                        </li>

                        <li>
                            <label class="lbl_fconosco">Informação de produtos: </label>
                            <input class="input-normal" type="text" name="txtinfo">
                        </li>

                        <li>
                            <label class="lbl_fconosco">Sexo: </label>
                            <input class="radio" type="radio" name="sexo" value="M">Masculino
                            <input class="radio" type="radio" name="sexo" value="F">Feminino
                            <input class="radio" type="radio" name="sexo" value="I">Indefinido
                        </li>

                        <li>
                            <label class="lbl_fconosco">Profissão: </label>

                            <input class="input-normal" required type="text" name="txtprofissao">
                        </li>

                        <li>
                            <label class="lbl_fconosco">Sugestão/críticas: </label>
                            <textarea name="txtcritica"></textarea>
                        </li>

                        <li>
                            <button type="submit" name="btnsub" class="btn-submit">ENVIAR</button>
                        </li>
                    </ul>
            </form>
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
	</body>
</html>
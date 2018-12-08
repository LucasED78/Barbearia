<?php
    session_start();

    if((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)){
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:index.php');
    }

    $logado = $_SESSION['login'];
    

    if(isset($_GET['btnsair'])){
        $logout = $_GET['btnsair'];
        $_SESSION['logout'] = $logout;
    }

    require_once "module.php";
    $conexao = conectar();

    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        if($modo == 'excluir'){
            $id = $_GET['id'];
            
            $sql = "DELETE FROM tbl_fconosco WHERE id =".$id;
            mysqli_query($conexao, $sql);
            header('location: faleconosco.php');
        }
    }
?>

<html>
    <head>
        <title>Cadastro</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/jquery.js"></script>

        <script>
            $(document).ready(function(){
                $('.visualizar').click(function(){ //chamando o evento click do jquery na div visualizar
                    $('.container').fadeIn(1000); //colocando o efeito fadeIn na div container
                });
                
            });

            function modal(idItem){ //criando uma função que recebe o id do item
                 $.ajax({ //iniciando o ajax
                    type: "POST", //tipo de requisição POST OU GET
                    url: "modal.php", //página que será acessada
                    data: {id:idItem}, //qual é o dado que vai guardar
                    success: function(dados){ //atribuindo os dados acima em uma variável
                        $('.modal').html(dados); //descarregando os dados na div modal
                    }
                 });
            };
        </script>
    </head>
    
    <body>
        <div class="container">
            <div class="modal">
                
            </div>
        </div>

        <?php
            include "header.html";
        ?>

        <?php
            include "nav.php";
        ?>
        <div class="content">
            <table class="table-model">
                <tr class="table-row">
                    <td class="table-cell" colspan="5">
                        <h1>Lista de Mensagens</h1>
                    </td>
                </tr>

                <tr class="table-row" style="font-weight: bold; background-color: lightgray;">
                    <td class="table-cell">
                        Nome
                    </td>

                    <td class="table-cell">
                        Gênero
                    </td>

                    <td class="table-cell">
                        Profissão
                    </td>

                    <td class="table-cell">
                        Crítica
                    </td>
                    
                    <td class="table-cell">
                        Opções
                    </td>
                </tr>
                
                <?php
                    $sql = "select * from tbl_fconosco";
                
                    $resultado = mysqli_query($conexao, $sql);
                
                    while($rsFaleConosco = mysqli_fetch_array($resultado)){
                ?>

                <tr class="table-row">
                    <td class="table-cell" style="border-right: 0.5px solid #202020;"><?php echo (utf8_encode($rsFaleConosco['nome']))?></td>

                    <td class="table-cell" style="border-right: 0.5px solid #202020;"><?php echo (utf8_encode($rsFaleConosco['genero']))?></td>

                    <td class="table-cell" style="border-right: 0.5px solid #202020;"><?php echo (utf8_encode($rsFaleConosco['profissao']))?></td>

                    <td class="table-cell" style="border-right: 0.5px solid #202020;"><?php echo (utf8_encode($rsFaleConosco['critica']))?></td>
                    
                    <td class="table-cell">
                        <img class="visualizar" src="imagens/loupe.png" onclick="modal(<?php echo($rsFaleConosco['id'])?>)">
                        
                        <a href="faleconosco.php?modo=excluir&id=<?php echo($rsFaleConosco['id'])?>" onclick="return confirm('Deseja excluir o registro?')">
                            <img src="imagens/delete.png">
                        </a>
                    </td>
                </tr>
                
                <?php
                    }
                ?>
            </table>
        </div>
        <?php
            include "footer.html";
        ?>
    </body>
</html>
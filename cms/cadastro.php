<?php
    //iniciando a sessão
    session_start();
    
    //declaração de variáveis
    $logado = $_SESSION['login'];
    $nivel = $_SESSION['nivel'];
    $nome = "";
    $email = "";
    $usuario = "";
    $botao = 'salvar';
    $imagem = null;

    if($nivel != 'administrador'){
        echo("<script>")."alert('Somente administradores podem acessar essa área!!');"."</script>";
        echo("<script>window.location = 'cmsindex.php';</script>");
    }
    
    //conexão com o banco e seleção do mesmo
    require_once "module.php";
    $conexao = conectar();

    /*verificando existência do botão de envio, caso exista, ele realiza o insert no banco ou a edição baseado no valor que estiver inserido no botão de envio*/
    
    if(isset($_GET['btnenviar'])){
        $usuario = $_GET['txtusuario'];
        $senha = $_GET['txtsenha'];
        $nome = $_GET['txtnome'];
        $email = $_GET['txtemail'];
        $nivel = $_GET['txtnivel'];
        $imagem = $_GET['txtfoto'];

        //encriptando a senha em md5 para envia-la ao banco de dados
        $encryptSenha = md5($senha);
        
        if($_GET['btnenviar'] == 'salvar'){
            $sql = "INSERT INTO tbl_usuario(nome, email, usuario, senha, idNivel, foto) VALUES('".$nome."', '".$email."', '".$usuario."', '".$encryptSenha."', '".$nivel."', '".$imagem."')";
        }else if($_GET['btnenviar'] == 'editar'){
            /*se a imagem for diferente de nulo, faz o update no banco com a imagem, caso contrário, atualiza apenas os campos preenchidos*/
            if($imagem != null){
                $sql = "UPDATE tbl_usuario SET nome = '".$nome."', email = '".$email."', usuario = '".$usuario."', senha = '".$encryptSenha."', idNivel = '".$nivel."', foto = '".$imagem."' WHERE id =".$_SESSION['id'];
                header('location: cadastro.php');
            }else{
                $sql = "UPDATE tbl_usuario SET nome = '".$nome."', email = '".$email."', usuario = '".$usuario."', senha = '".$encryptSenha."', idNivel = '".$nivel."' WHERE id =".$_SESSION['id'];
                header('location: cadastro.php');
            }
        }
            
        mysqli_query($conexao, $sql);
        header('location:cadastro.php');
    }

    //verificando se existe a variável modo e caso exista, resgatamos seu valor
    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        /*verificando se o valor da variável modo é excluir ou editar e baseado nisso realizamos a exclusão ou edição do registro do usuário*/
        if($modo == 'excluir'){
            $id = $_GET['id']; //resgatando a variável ID que foi enviada para url
            $sql = "delete from tbl_usuario where id =".$id; //query para excluir registro
            mysqli_query($conexao,$sql);
            header('location: cadastro.php');
        }else if($modo == 'editar'){
            $id = $_GET['id'];
            
            $_SESSION['id'] = $id; /*criando uma variável de sessão e atribuindo a ela o valor da variável id;*/
            
            $sql = "SELECT * FROM tbl_usuario WHERE id =".$id;
            $resultado = mysqli_query($conexao,$sql);
            
            if($rsUsuario = mysqli_fetch_array($resultado)){
                $id = $rsUsuario['id'];
                $nome = $rsUsuario['nome'];
                $email = $rsUsuario['email'];
                $usuario = $rsUsuario['usuario'];
                $botao = 'editar';
                $imagem = $rsUsuario['foto'];
            }
        }
    }

    /*verificando se existe a variável status*/
    if(isset($_GET['status'])){
        $status = $_GET['status'];
        $id = $_GET['id'];

        //verificando se status é igual a ativo
        if($status == 'ativo'){
            //query pra atualizar o status
            $sql = 'UPDATE tbl_usuario SET status = 1 WHERE id='.$id;
            mysqli_query($conexao,$sql);
            header('location: cadastro.php');
        }else if($status == 'inativo'){//verificado se status é igual a inativo
            $sql = 'UPDATE tbl_usuario SET status = 0 WHERE id='.$id;
            mysqli_query($conexao,$sql);
            header('location: cadastro.php');
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Cadastro</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
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
            include "header.html";
        ?>

        <?php
            include ("nav.php");
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
            
            <form method="get" action="cadastro.php" class="cadastro" name="frmCms">
                <ul>
                    <li>
                        <select name="txtnivel" class="default_select">
                            <?php
                                $sql = "SELECT * from tbl_niveis";
                                $resultado = mysqli_query($conexao,$sql);
                                echo '<option>',"selecione...",'</option>';
                                while($result = mysqli_fetch_array($resultado)){?>     
                            <option value="<?php echo $result['id'];?>">
                                <?php echo utf8_encode($result['nome'])?>
                            </option>
                            <?php }
                            ?>
                        </select>
                    </li>

                    <li>
                        <label><span class="default_label">Nome: </span> </label>
                        <input class="default_input" id="nome" type="text" name="txtnome" value="<?php echo ($nome);?>" onkeypress="return validar(event, 'number', 'nome');">
                        <input type="hidden" name="txtfoto">
                    </li>

                    <li>
                        <label><span class="default_label">E-mail: </span> </label>
                        <input class="default_input" type="email" name="txtemail" value="<?php echo ($email);?>">
                    </li>

                    <li>
                        <label><span class="default_label">Usuário: </span> </label>
                        <input class="default_input" type="text" name="txtusuario" value="<?php echo ($usuario);?>">
                    </li>

                    <li>
                        <label><span class="default_label">Senha: </span> </label>
                        <input class="default_input" type="password" name="txtsenha">
                    </li>

                    <li>
                        <button name="btnenviar" class="btn" value="<?php echo($botao); ?>">
                            <?php echo($botao); ?>
                        </button>
                    </li>
                </ul>
            </form>
            
            <table class="table-model">
                <tr class="table-row" style="background-color: lightgray; font-weight: bold;">
                    <td class="table-cell">
                        Nome
                    </td>

                    <td class="table-cell">
                        Usuário
                    </td>

                    <td class="table-cell">
                        Nível
                    </td>

                    <td class="table-cell">
                        Status
                    </td>
                    
                    <td class="table-cell">
                        Opções
                    </td>
                </tr>
                
                <?php
                    $sql = "SELECT u.id, u.nome, u.email, u.usuario, n.nome AS nivel FROM tbl_usuario AS u, tbl_niveis AS n WHERE u.idNivel = n.id";
                
                    $resultado = mysqli_query($conexao, $sql);
                
                    while($rsUsuario = mysqli_fetch_array($resultado)){
                ?>

                <tr class="table-row">
                    <td class="table-cell" style="color:<?php echo($cor)?> border-right: 0.5px solid #202020;"><?php echo (utf8_encode($rsUsuario['nome'])) ?></td>

                    <td class="table-cell" style="border-right: 0.5px solid #202020;"><?php echo (utf8_encode($rsUsuario['usuario']))?></td>

                    <td class="table-cell" style="border-right: 0.5px solid #202020;"><?php echo (utf8_encode($rsUsuario['nivel']))?>
                    
                    </td>

                    <td class="table-cell" style="border-right: 0.5px solid #202020">
                        <a href="cadastro.php?status=ativo&id=<?php echo($rsUsuario['id']) ?>">
                            <img src="imagens/ativar.png">
                        </a>

                        <a href="cadastro.php?status=inativo&id=<?php echo($rsUsuario['id']) ?>">
                            <img src="imagens/desativar.png">
                        </a>
                    </td>
                    
                    <td class="table-cell">
                        <!-- enviando para a url uma varíavel modo que vai guardar os valores de editar ou excluir e também o id do usuário, para saber qual deve ser excluido -->
                        <a href="cadastro.php?modo=editar&id=<?php echo($rsUsuario['id'])?>">
                            <img src="imagens/edit.png">
                        </a>
                        
                        <a href="cadastro.php?modo=excluir&id=<?php echo($rsUsuario['id'])?>" onclick="return confirm('Deseja excluir o usuário?')">
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

        <script type="text/javascript" charset="utf-8" async defer>
                function validar(caracter, blockType, campo){
                    document.getElementById('campo').style="background-color: white;";

                    if(window.event){
                        var letra = caracter.charCode;
                    }else{
                        var letra = carater.which;
                    }

                    if(blockType == 'number'){
                        if(letra >= 48 && letra <= 57 ){
                            if(letra != 8 && letra != 32 && letra != 9 ){
                                document.getElementById(campo).style="background-color: #F4A1A1";
                                return false;
                            }
                        }
                    }


                }
        </script>
    </body>
</html>
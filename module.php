<?php
    function conectar(){
        $conexao = mysqli_connect('localhost', 'root', 'bcd127', 'dbpc3020181');
        
        return $conexao;
    }

    function nivelar($nivel){
        $msg = "<script>"."alert('Somente administradores possuem acesso á essa área!!');"."</script>";
        
        if($nivel != 'administrador'){
            echo($msg);
            header('location: index.php');
        }
    }
?>
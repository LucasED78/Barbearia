<?php
    function conectar(){
        $conexao = mysqli_connect('localhost', 'root', 'bcd127', 'barbearia');
        
        return $conexao;
    }
?>
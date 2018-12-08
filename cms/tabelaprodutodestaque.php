<table class="table-model">
    <tr class="table-row">
        <td class="table-cell" colspan="5">
            <h1>Conteúdos Cadastrados</h1>
        </td>
    </tr>

    <tr class="table-row" style="font-weight: bold; background-color: lightgray;">
        <td class="table-cell">
            Titulo
        </td>

        <td class="table-cell">
            Texto
        </td>

        <td class="table-cell">
            Imagem
        </td>

        <td class="table-cell">
            Sessão
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

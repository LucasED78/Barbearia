<table class="table-model">
    <tr class="table-row">
        <td class="table-cell" colspan="5">
            <h1>Conteúdos Cadastrados</h1>
        </td>
    </tr>

    <tr class="table-row" style="font-weight: bold; background-color: lightgray;">
        <td class="table-cell">
            Categoria
        </td>

        <td class="table-cell">
            Opções
        </td>
    </tr>

    <?php
        $sql = "select * from tbl_categoria";

        $resultado = mysqli_query($conexao, $sql);

        while($rsCategoria = mysqli_fetch_array($resultado)){
    ?>

    <tr class="table-row">
        <td class="table-cell" style="border-right: 0.5px solid #202020;"><?php echo(utf8_encode($rsCategoria['nome'])) ?></td>

        <td class="table-cell">
            <a href="conteudo_categoria.php?modo=editar&id=<?php echo($rsCategoria['id']) ?>">
                <img src="imagens/edit.png">
            </a>
            
            <a href="conteudo_categoria.php?status=ativar&id=<?php echo($rsCategoria['id']) ?>">
              <img src="imagens/ativar.png">
            </a>

            <a href="conteudo_categoria.php?status=desativar&id=<?php echo($rsCategoria['id'])?>">
              <img src="imagens/desativar.png">
            </a>

            <a href="conteudo_categoria.php?modo=excluir&id=<?php echo($rsCategoria['id'])?>" onclick="return confirm('Deseja excluir o registro?')">
                <img src="imagens/delete.png">
            </a>
        </td>
    </tr>

    <?php
        }
    ?>
</table>

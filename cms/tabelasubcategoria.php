<table class="table-model">
    <tr class="table-row">
        <td class="table-cell" colspan="5">
            <h1>Conteúdos Cadastrados</h1>
        </td>
    </tr>

    <tr class="table-row" style="font-weight: bold; background-color: lightgray;">
        <td class="table-cell">
            Subcategoria
        </td>
        
        <td class="table-cell">
            Categoria
        </td>

        <td class="table-cell">
            Opções
        </td>
    </tr>

    <?php
        $sql = "select s.nome as subcategoria, s.id, c.nome as categoria, c.id as idCategoria from tbl_categoria as c, tbl_subcategoria as s where c.id = s.idCategoria";

        $resultado = mysqli_query($conexao, $sql);

        while($rsSubcategoria = mysqli_fetch_array($resultado)){
    ?>

    <tr class="table-row">
        <td class="table-cell" style="border-right: 0.5px solid #202020;"><?php echo(utf8_encode($rsSubcategoria['subcategoria'])) ?></td>
        
        <td class="table-cell" style="border-right: 0.5px solid #202020;"><?php echo(utf8_encode($rsSubcategoria['categoria'])) ?></td>

        <td class="table-cell">
            <a href="conteudo_subcategoria.php?modo=editar&id=<?php echo($rsSubcategoria['id']) ?>">
                <img src="imagens/edit.png">
            </a>
            
            <a href="conteudo_subcategoria.php?status=ativar&id=<?php echo($rsSubcategoria['id']) ?>">
              <img src="imagens/ativar.png">
            </a>

            <a href="conteudo_subcategoria.php?status=desativar&id=<?php echo($rsSubcategoria['id'])?>">
              <img src="imagens/desativar.png">
            </a>

            <a href="conteudo_subcategoria.php?modo=excluir&id=<?php echo($rsSubcategoria['id'])?>" onclick="return confirm('Deseja excluir o registro?')">
                <img src="imagens/delete.png">
            </a>
        </td>
    </tr>

    <?php
        }
    ?>
</table>

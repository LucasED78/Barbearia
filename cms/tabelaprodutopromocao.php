<table class="table-model">
    <tr class="table-row">
        <td class="table-cell" colspan="5">
            <h1>Conteúdos Cadastrados</h1>
        </td>
    </tr>

    <tr class="table-row" style="font-weight: bold; background-color: lightgray;">
        <td class="table-cell">
            Nome
        </td>

        <td class="table-cell">
            Preco
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
        $sql = "select s.id, s.nome, p.nome, p.id as sessao, sp.* from tbl_sessao as s, tbl_produtos as p, tbl_promocao as sp where s.id = sp.idSessao and sp.idProduto = p.id";

        $resultado = mysqli_query($conexao, $sql);

        while($rsPromocao = mysqli_fetch_array($resultado)){
    ?>

    <tr class="table-row">
        <td class="table-cell" style="border-right: 0.5px solid #202020;"><?php echo(utf8_encode($rsPromocao['nome'])) ?></td>

        <td class="table-cell" style="border-right: 0.5px solid #202020;"><?php echo($rsPromocao['preco']) ?></td>

        <td class="table-cell" style="border-right: 0.5px solid #202020;"><img class="image" src="<?php echo($rsPromocao['imagem'])?>"></td>

        <td class="table-cell" style="border-right: 0.5px solid #202020;"><?php echo(utf8_encode($rsPromocao['sessao'])) ?></td>

        <td class="table-cell">
            <a href="conteudo_produtopromocao.php?modo=editar&id=<?php echo($rsPromocao['id']) ?>">
                <img src="imagens/edit.png">
            </a>
            
            <a href="conteudo_produtopromocao.php?status=ativar&id=<?php echo($rsPromocao['id']) ?>">
              <img src="imagens/ativar.png">
            </a>

            <a href="conteudo_produtopromocao.php?status=desativar&id=<?php echo($rsPromocao['id'])?>">
              <img src="imagens/desativar.png">
            </a>

            <a href="conteudo_produtopromocao.php?modo=excluir&id=<?php echo($rsPromocao['id'])?>" onclick="return confirm('Deseja excluir o registro?')">
                <img src="imagens/delete.png">
            </a>
        </td>
    </tr>

    <?php
        }
    ?>
</table>

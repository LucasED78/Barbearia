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
        $sql = "select p.id as produto, p.*, s.id, s.nome as sessao from tbl_produtos as p, tbl_sessao as s where p.idSessao = s.id";

        $resultado = mysqli_query($conexao, $sql);

        while($rsProduto = mysqli_fetch_array($resultado)){
    ?>

    <tr class="table-row">
        <td class="table-cell" style="border-right: 0.5px solid #202020;"><?php echo(utf8_encode($rsProduto['nome'])) ?></td>

        <td class="table-cell" style="border-right: 0.5px solid #202020;"><?php echo($rsProduto['preco']) ?></td>

        <td class="table-cell" style="border-right: 0.5px solid #202020;"><img class="image" src="<?php echo($rsProduto['imagem'])?>"></td>

        <td class="table-cell" style="border-right: 0.5px solid #202020;"><?php echo(utf8_encode($rsProduto['sessao'])) ?></td>

        <td class="table-cell">
            <a href="conteudo_cadastroprodutos.php?modo=editar&id=<?php echo($rsProduto['produto']) ?>">
                <img src="imagens/edit.png">
            </a>
            
            <a href="conteudo_cadastroprodutos.php?status=ativar&id=<?php echo($rsProduto['produto']) ?>">
              <img src="imagens/ativar.png">
            </a>

            <a href="conteudo_cadastroprodutos.php?status=desativar&id=<?php echo($rsProduto['produto'])?>">
              <img src="imagens/desativar.png">
            </a>

            <a href="conteudo_cadastroprodutos.php?modo=excluir&id=<?php echo($rsProduto['produto'])?>" onclick="return confirm('Deseja excluir o registro?')">
                <img src="imagens/delete.png">
            </a>
        </td>
    </tr>

    <?php
        }
    ?>
</table>

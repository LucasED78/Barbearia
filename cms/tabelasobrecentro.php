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
        $sql = "select s.id, s.nome, sp.* from tbl_sessao as s, tbl_sobre_penelope as sp where s.id = sp.idSessao";

        $resultado = mysqli_query($conexao, $sql);

        while($rsPenelope = mysqli_fetch_array($resultado)){
    ?>

    <tr class="table-row">
        <td class="table-cell" style="border-right: 0.5px solid #202020;"><?php echo(utf8_encode($rsPenelope['titulo'])) ?></td>

        <td class="table-cell" style="border-right: 0.5px solid #202020;"><?php echo(utf8_encode($rsPenelope['descricao'])) ?></td>

        <td class="table-cell" style="border-right: 0.5px solid #202020;"><img class="image" src="<?php echo($rsPenelope['imagem'])?>"></td>

        <td class="table-cell" style="border-right: 0.5px solid #202020;"><?php echo(utf8_encode($rsPenelope['nome'])) ?></td>

        <td class="table-cell">
            <a href="conteudo_sobrecentro.php?modo=editar&id=<?php echo($rsPenelope['id']) ?>">
                <img src="imagens/edit.png">
            </a>
            
            <a href="conteudo_sobrecentro.php?status=ativar&id=<?php echo($rsPenelope['id'])?>">
              <img src="imagens/ativar.png">
          </a>

            <a href="conteudo_sobrecentro.php?status=desativar&id=<?php echo($rsPenelope['id']) ?>">
              <img src="imagens/desativar.png">
          </a>

            <a href="conteudo_sobrecentro.php?modo=excluir&id=<?php echo($rsPenelope['id'])?>" onclick="return confirm('Deseja excluir o registro?')">
                <img src="imagens/delete.png">
            </a>
        </td>
    </tr>

    <?php
        }
    ?>
</table>

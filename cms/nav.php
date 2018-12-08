<nav>
    <div class="left">
        <ul>    
            <li>
                <div class="img">
                    <img src="imagens/admconteudo.png" alt="opção do menu">
                </div>
                <a href="conteudo.php">Adm. Conteúdo</a></li>

            <li>
                <div class="img">
                    <img src="imagens/fale-conosco.png" alt="opção do menu">
                </div>
                <a href="faleconosco.php">Adm. Fale Conosco</a></li>

            <li>
                <div class="img">
                    <img src="imagens/admproduto.png" alt="opção do menu">
                </div>
                <a href="produtos.php">Adm. Produtos</a></li>

            <li>
                <div class="img">
                    <img src="imagens/admusuario.png" alt="opção do menu">
                </div>  
                <a href="cadastro.php">Adm. Usuários</a></li>
				
			<li>
				<div class="img">
					<img src="imagens/nivel.png" alt="opcção do menu">
				</div>
				<a href="nivel.php">Níveis</a>
			</li>
        </ul>
    </div>

    <div class="right">

        <div id="panel_user">
            <p class="panel-txt">Bem vindo, <?php echo($logado)?></p>
            <div>
                <?php
                    $sql = "select foto from tbl_usuario where usuario='$logado'"; //fazer com que o id venha parar nessa página
                    $result = mysqli_query($conexao,$sql);

                    while ($rsFoto = mysqli_fetch_array($result)) {

                ?>

                <div id="perfil">
                    <img src="<?php echo($rsFoto['foto'])?>">
                </div> 
            </div>       
            
            <?php
                }
            ?>

            <div>
                <form method="get" action="../index.php">
                    <button class="btn" id="btn_logout" style="margin: 0; margin-left: 10px;" name="btnsair">logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>
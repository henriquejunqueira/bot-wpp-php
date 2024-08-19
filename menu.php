<?php
    $paginaAtual = $_SERVER['PHP_SELF'];
    
    function defineAtivo($paginaAtual, $pagina){
        return $paginaAtual === $pagina ? 'active' : '';
    }

?>
<nav class="nav-collapse">
	<ul>
		<li class="menu-item <?php echo defineAtivo($paginaAtual, '/BOT/index.php'); ?>"><a href="index.php" data-scroll>VENDAS</a></li>
        <li class="menu-item <?php echo defineAtivo($paginaAtual, '/BOT/produtos.php'); ?>"><a href="produtos.php" data-scroll>PRODUTOS</a></li>
        <li class="menu-item <?php echo defineAtivo($paginaAtual, '/BOT/pedidos.php'); ?>"><a href="pedidos.php" data-scroll>PEDIDOS</a></li>
        <li class="menu-item <?php echo defineAtivo($paginaAtual, '/BOT/config.php'); ?>"><a href="config.php" data-scroll>CONFIGURAÇÕES</a></li> 
          
        <?php if($tipo_cliente == 2){?>     
        <li class="menu-item <?php echo defineAtivo($paginaAtual, '/BOT/admin.php'); ?>"><a href="admin.php" data-scroll>ADMIN</a></li>
        <?php }?>    
        <li class="menu-item"><a href="sair.php" data-scroll>SAIR</a></li>
    
	</ul>
</nav>
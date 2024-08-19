<?php

    //$busca_pedidos = "SELECT * FROM pedidos WHERE status = 'aguardando' AND email_painel = '$email_cliente'";
    $busca_pedidos = "SELECT * FROM pedidos WHERE status = 'aguardando'";
    $resultado_pedidos = mysqli_query($conn, $busca_pedidos);
    $total_pedidos = mysqli_num_rows($resultado_pedidos);
    //echo $total_pedidos;
    
    while($dados_pedidos = mysqli_fetch_array($resultado_pedidos)){
        $nome_cliente = $dados_pedidos['nome_cliente'];
        $id_pedido = $dados_pedidos['id'];
        $id_cliente = $dados_pedidos['id_cliente'];
        $telefone_cliente = $dados_pedidos['telefone'];
        $endereco_cliente = $dados_pedidos['endereco'];
        $quant_gas_cliente = $dados_pedidos['quant_gas'];
        $quant_agua_cliente = $dados_pedidos['quant_agua'];
        $forma_pagamento_cliente = $dados_pedidos['forma_pagamento'];
        $status_cliente = $dados_pedidos['status'];
        $data_hora_cliente = $dados_pedidos['data_hora'];
        $email_painel = $dados_pedidos['email_painel'];
 ?>       
        <div align='center'>
            <form id="form1" name="form1" method="post" action="">
            	<table width="80%" border="0">
            		<tr>
            			<td colspan="2"><div align="center"><H1>NOVO PEDIDO</H1></div></td>
            		</tr>
            		<tr>
            			<td><div align="center"><b>PRODUTO</b></div></td>
            			<td><div align="center"><b>QUANTIDADE</b></div></td>
            		</tr>
                    <tr>
                    	<td><br><div align="center">GÁS</div></td>
                    	<td><div align="center"><?= "$quant_gas_cliente"; ?></div></td>
                    </tr>
                    <tr>
                    	<td><br><div align="center">ÁGUA</div></td>
                    	<td><div align="center"><?= "$quant_agua_cliente"; ?></div></td>
                    </tr>
                    <tr>
                    	<td colspan="2"><div align="center"><b>CLIENTE:</b></div></td>
                    </tr>
                    <tr>
                    	<td colspan="2"><div align="center"><?= "<strong>$nome_cliente</strong> - $telefone_cliente"; ?></div></td>
                    </tr>
                    <tr>
                    	<td colspan="2"><div align="center"><b>ENDEREÇO<b></div></td>
                    </tr>
                    <tr>
                    	<td colspan="2"><div align="center"><?= "$endereco_cliente"; ?></div></td>
                    </tr>
                    <tr>
                    	<td colspan="2"><div align="center"><b>FORMA DE PAGAMENTO<b></div></td>
                    </tr>
                    <tr>
                    	<td colspan="2"><div align="center"><?= "$forma_pagamento_cliente"; ?></div></td>
                    </tr>
                    <tr>
                    	<td>&nbsp;</td>
                    	<td>&nbsp;</td>
                    </tr>
                    <tr>
                    	<td>
                        	<label>
                        		<div align="center">
                        			<input type="hidden" name="id_pedido" id="id_pedido" value="<?= $id_pedido; ?>" />
                        			<input type="submit" name="button" id="button" value="ACEITAR" formaction="aceitar.php" />
                        		</div>
                        	</label>
                        </td>
            			<td>
            				<label>
            					<div align="center">
            						<input type="submit" name="recusar" style="background-color: red;" id="recusar" value="RECUSAR" formaction="recusar.php" />
            					</div>
            				</label>
            			</td>
            			</tr>
            	</table>
            </form>
        </div>
        <br>
        <br>
        
<?php

    }

?>
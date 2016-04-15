<?php

// Include database class
include '../bigMWebService/model/conection.php';
//require user class
include ('../bigMWebService/model/User.php');
$id = "1";
$nome = "admin";
$user = new User($nome ,$id );
$idPedido = intval($_GET['q']);
$trocoPara = doubleval($_GET['trocoPara']);
$metodoDePagamento = intval($_GET['$metodoDePagamento']);
$jsonItemPedido =  $user->getItemPedidoJSON($idPedido);
//$jsonItemPedido = json_decode($jsonItemPedido);
//debug_to_console($idPedido);
if(empty($jsonItemPedido))
{
	echo"<tr>
				<th scope='row'> - </th>
				<td>Pedido</td>
				<td>Incompleto</td>
				<td>NEGADO</td>
			</tr>";
}
else{
	$total = 0;
	foreach($jsonItemPedido as $val)
	{
		echo"<tr>
					<th scope='row'>" .$val['idItem']. "</th>
					<td>" .$val['nome']. "</td>
					<td>Completo</td>
					<td>" .$val['valor']. "</td>
				</tr>";
		$total = $total + doubleval($val['valor']);
	}
	echo"<tr>
				<th scope='row'> </th>
				<td style='color:red;'></td>
				<td style='color:red;'>Total</td>
				<td style='color:red;'>R$ " .number_format($total, 2, '.', '')."</td>
			</tr>";
	if ($metodoDePagamento==1/*dinheiro*/) {
		echo"<tr>
							<th scope='row'> </th>
							<td style='color:red;'></td>
							<td style='color:red;'>Troco Para</td>
							<td style='color:red;'>R$ " .number_format($trocoPara, 2, '.', '')."</td>
						</tr>";
		$troco = $trocoPara - $total;
		echo"<tr>
							<th scope='row'> </th>
							<td style='color:red;'></td>
							<td style='color:red;'>Dar de troco</td>
							<td style='color:red;'>R$ " .number_format($troco, 2, '.', '')."</td>
						</tr>";
	}

}



?>

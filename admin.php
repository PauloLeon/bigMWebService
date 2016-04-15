
<?php
header('Content-Type: text/html; charset=UTF-8');
error_reporting(0);
// Include database class
include '../bigMWebService/model/conection.php';
//require user class
include ('../bigMWebService/model/User.php');
$id = "1";
$nome = "admin";
$user = new User($nome ,$id );
$inputPedido = "";
if (!empty($_POST['confirmar'])) {
	debug_to_console("confirmar");
	debug_to_console($_POST['inputPedido']);
		$user->confimarPedido($_POST['inputPedido']);
}

if (!empty($_POST['rejeitar'])) {
	  debug_to_console("rejeitar");
		debug_to_console($_POST['inputPedido']);
		$user->rejeitarPedido($_POST['inputPedido']);
}
$jsonPedidos = $user->getPedidosJSON();

function debug_to_console( $data )
{
		 if ( is_array( $data ) )
				 $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
		 else
				$output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";
		 echo $output;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Administração</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=960, user-scalable=yes">
	<link rel="shortcut icon" href="imagem/favicon.png" type="image/png" />
	<meta name="author" content="Paulo Rosa" />
	<link href="/bigMWebService/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="/bigMWebService/bootstrap-3.3.6-dist/css/bootstrap.min.css">
	<link href="/bigMWebService/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="/bigMWebService/js/jquery-2.2.1.min.js"></script>
	<script type="text/javascript" src="/bigMWebService/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>

	<style>
		.btn-default {
			background: #5C0A09;
			background-color: rgb(92, 10, 9);
			background-image: none;
			background-repeat: repeat;
			background-attachment: scroll;
			background-position: 0% 0%;
			background-clip: border-box;
			background-origin: padding-box;
			background-size: auto auto;
			color: #fff;
		}
	</style>
</head>

<body>
	<!-- Top menu -->
	<nav class="navbar navbar-no-bg" role="navigation" style="background-color:#5C0A09;">
		<div class="container">
			<ul class="nav navbar-right top-nav ">
				<li class="dropdown">
					<a style="color: white;padding-bottom: 15px;" aria-expanded="false" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" style="padding: 5px;"> </i>Admin<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li> <a href="/bigMWebService/produtos.php" style="color: #428bca;"><i class="fa fa-fw fa-user"></i> Área de Produtos</a> </li>
						<li> <a href="#" style="color: #428bca;"><i class="fa fa-fw fa-envelope"></i> Caixa de Mensagens</a> </li>
						<li> <a href="#" style="color: #428bca;"><i class="fa fa-fw fa-gear"></i> Configuração de Conta</a> </li>
						<li class="divider"></li>
						<li> <a href="action_logout.php" style="color: #c94141;"><i class="fa fa-fw fa-power-off"></i> Sair</a> </li>
					</ul>
				</li>
			</ul>
			</div>
	</nav>
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<h3 class="page-header" style="margin-top: 20px;">Área de Administração</h3>
		</div>
		<div class="col-md-2"></div>
		<div class="col-lg-12" id="admin">
 			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="row hidden-xs ">
						<div class="col-xs-12 col-sm-6 col-md-6">
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<h3 class="panel-title">
								<div class="input-group pull-right" style="margin-bottom:20px;">
									<input class="search pull-right" placeholder="Pesquisar" aria-describedby="basic-addon1" style="height: 30px;"/>
									<span class="input-group-addon " id="basic-addon1">
										<span class="glyphicon glyphicon-search" aria-hidden="true">
										</span>
									</span>
								</div>
							</h3>
						</div>
					</div>
					<h3 class="panel-title visible-sm visible-xs"> <div class="form-group visible-xs">
									<div class="input-group">
									<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
									<input class="search" placeholder="Pesquisar" aria-describedby="basic-addon1" style="height: 30px;"/>
						</div>
					</div></h3>
					<div class="panel panel-danger">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-4 col-sm-4 col-md-4">
									<h3 class="panel-title">Cliente</h3></div>
								<div class="col-xs-4 col-sm-4 col-md-4">
									<h3 class="panel-title">Status</h3></div>
							<div class="col-xs-4 col-sm-4 col-md-4">
								<h3 class="panel-title">Hora</h3></div>
					</div>
						</div>

						<div class="panel-body">
							<ul id="listPedidos" class="list list-group" style="width: auto">
								<?php
			              if (empty($jsonPedidos)) {
			                  echo'<li class="list-group-item">'.'Ainda não recebemos pedidos hoje.'.'</li>';
			              }

			              foreach ($jsonPedidos as $val) {
												//para resolver o utf-8
												$status = $val['status'];
											  utf8_decode($status);
												if ($status == "Aprovado") {
													echo'<li
				              				  id='.$val['idPedidos'].'
				              				  cliente="'.$val['fk_idCliente'].'"
																data="'.$val['data'].'"
																rua="'.$val['rua'].'"
																numero="'.$val['numero'].'"
																complemento="'.$val['complemento'].'"
																fone="'.$val['fone'].'"
																status="'.$val['status'].'"
																nome="'.$val['nome'].'"
																tempoDeEntrega="'.$val['tempoDeEntrega'].'"
																class="list-group-item"  data-toggle="modal" data-target="#detalheModal" style="padding-top: 15px;padding-bottom: 15px;" >
																		 <div class="pedidosSearch row">
			 																<div class="col-xs-4 col-sm-4 col-md-4">'.$val['nome'].'</div>
			 																<div style="color: blue;" class="col-xs-4 col-sm-4 col-md-4">'.$status.'</div>
			 															<div class="col-xs-4 col-sm-4 col-md-4">'.$val['data'].'</div>
			 													</div>
				              				</li>';
												} else 	if ($status == "Rejeitado"){
													echo'<li
				              				  id='.$val['idPedidos'].'
				              				  cliente="'.$val['fk_idCliente'].'"
																data="'.$val['data'].'"
																rua="'.$val['rua'].'"
																numero="'.$val['numero'].'"
																complemento="'.$val['complemento'].'"
																fone="'.$val['fone'].'"
																status="'.$val['status'].'"
																nome="'.$val['nome'].'"
																tempoDeEntrega="'.$val['tempoDeEntrega'].'"
																class="list-group-item"  data-toggle="modal" data-target="#detalheModal" style="padding-top: 15px;padding-bottom: 15px;" >
																		 <div class="pedidosSearch row">
			 																<div class="col-xs-4 col-sm-4 col-md-4">'.$val['nome'].'</div>
			 																<div style="color: red;" class="col-xs-4 col-sm-4 col-md-4">'.$status.'</div>
			 															<div class="col-xs-4 col-sm-4 col-md-4">'.$val['data'].'</div>
			 													</div>
				              				</li>';
												} else {
													echo'<li
				              				  id='.$val['idPedidos'].'
				              				  cliente="'.$val['fk_idCliente'].'"
																data="'.$val['data'].'"
																rua="'.$val['rua'].'"
																numero="'.$val['numero'].'"
																complemento="'.$val['complemento'].'"
																fone="'.$val['fone'].'"
																status="'.$val['status'].'"
																nome="'.$val['nome'].'"
																tempoDeEntrega="'.$val['tempoDeEntrega'].'"
																class="list-group-item"  data-toggle="modal" data-target="#detalheModal" style="padding-top: 15px;padding-bottom: 15px;" >
																		 <div class="pedidosSearch row">
			 																<div class="col-xs-4 col-sm-4 col-md-4">'.$val['nome'].'</div>
			 																<div style="color: gray;" class="col-xs-4 col-sm-4 col-md-4">'.$status.'</div>
			 															<div class="col-xs-4 col-sm-4 col-md-4">'.$val['data'].'</div>
			 													</div>
				              				</li>';
												}


			              }
			          ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>
			<!--MODAL DETALHE -Card -->
			<div class="modal fade" id="detalheModal">
			  <div class="modal-dialog">
			    <div class="modal-content">
						<form style="padding: 10px;"  class="form-horizontal" role="form" draggable="true" action="admin.php" method="post">
			      <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title">Pedido Detalhado</h4>
			      </div>
			      <div class="modal-body">
							<div class="form-group">
			          <input class="form-control" id="pedidoInput" style="height: 0px;padding: 0px;margin:0px;
						    visibility: hidden;"type="text" name="inputPedido" value="<?=$varPedido;?>">
			        </div>
							<div class="form-group">
			          <label class="control-label" for="clienteLabel">Cliente</label>
			          <input class="form-control" id="clienteLabel" placeholder="Cliente"
			               type="text" name="inputCliente" value="<?=$varCliente;?>">
			        </div>
							<div class="form-group">
			          <label class="control-label" for="foneLabel">Telefone</label>
			          <input class="form-control" id="foneLabel" placeholder="Fone"
			               type="text" name="inputFone" value="<?=$varClienteTelefone;?>">
			        </div>
							<div class="form-group">
			          <label class="control-label" for="enderecoLabel">Endereco</label>
			          <input class="form-control" id="enderecoLabel" placeholder="Cliente"
			               type="text" name="inputEndereco" value="<?=$varClienteEndereco;?>">
			        </div>
							<div class="form-group">
			          <label class="control-label" for="tempoLabel">Tempo de Entrega</label>
			          <input class="form-control" id="tempoLabel" placeholder="Tempo de Entrega"
			               type="date" name="inputTempo"	value="<?=$varTempo;?>">
			        </div>
							<div class="form-group">
			          <label class="control-label" for="tempoLabel">Pedidos</label>
			        </div>
							<table class="table">
							  <thead class="thead-default">
							    <tr>
							      <th>#</th>
							      <th>Produto</th>
							      <th>Observação</th>
							      <th>Valor</th>
							    </tr>
							  </thead>
								<tbody id="tbody">
							  </tbody>
							</table>
			      </div>
			      <div class="modal-footer">
							<div class="form-group">
			        </div>
							<button type="submit" name="confirmar" value="Submit"class="btn btn-primary" >Confirmar Pedido</button>
							<button type="submit" name="rejeitar" value="Submit" class="btn btn-default" >Rejeitar Pedido</button>
			      </div>
			      </form>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
</body>
</html>

<?php
echo file_get_contents(dirname(__FILE__).'/adminScript.php', true);
 ?>

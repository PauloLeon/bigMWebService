
<?php
header('Content-Type: text/html; charset=UTF-8');
error_reporting(0);
// Include database class
include '../bigMWebService/model/conection.php';
//require user class
include ('../bigMWebService/model/User.php');
$id = "1";
$nome = "admin";
$foda = new User($nome ,$id );
$jsonPedidos = $foda->getPedidosJSON();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Big Mengão</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=960, user-scalable=yes">
	<link rel="shortcut icon" href="imagem/favicon.png" type="image/png" />
	<meta name="author" content="Paulo Rosa" />
	<link rel="stylesheet" href="/bigMWebService/bootstrap-3.3.6-dist/css/bootstrap.min.css">
	<script type="text/javascript" src="/bigMWebService/js/jquery-2.2.1.min.js"></script>
	<script type="text/javascript" src="/bigMWebService/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
	<link href="/bigMWebService/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css">
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
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="http://localhost:8888/recad-mpeg/indexbigmengo.html" style="color: white;">
					<!--<img src="../recad-mpeg/image/bigtest.png" class="img-responsive"style="width:150px;">-->
					bigmengaologo
				</a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="top-navbar-1">
				<ul class="nav navbar-nav navbar-right">
					<li>
					</li>
				</ul>
				<ul class="nav navbar-right top-nav ">
					<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
						Admin
						<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li> <a href="#"style="color: #428bca;" ><i class="fa fa-fw fa-user"></i> Perfil</a> </li>
							<li> <a href="#" style="color: #428bca;"><i class="fa fa-fw fa-envelope"></i> Caixa de Mensagens</a> </li>
							<li> <a href="#" style="color: #428bca;"><i class="fa fa-fw fa-gear"></i> Configuração de Conta</a> </li>
							<li class="divider"></li>
							<li> <a href="action_logout.php"style="color: #c94141;" ><i class="fa fa-fw fa-power-off"></i> Sair</a> </li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="row" id="pedidos">
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
							<h3 class="panel-title"><div class="form-group">
								<button class="btn btn-success" data-toggle="modal" data-target="#incluirModal" name="incluir" onClick="incluirOnClick()" value="submit_insert"><span class="glyphicon glyphicon-plus"></span> Novo Pedido</button>
							</div></h3>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<h3 class="panel-title">
								<div class="input-group pull-right">
									<input class="search pull-right" placeholder="Pesquisar" aria-describedby="basic-addon1" style="height: 30px;"/>
									<span class="input-group-addon " id="basic-addon1">
										<span class="glyphicon glyphicon-search" aria-hidden="true">
										</span>
									</span>
								</div>
							</h3>
						</div>
					</div>
					<h3 class="panel-title visible-sm visible-xs"><div class="form-group visible-xs">
						<button class="btn btn-success" data-toggle="modal" data-target="#incluirModal" name="incluir" onClick="incluirOnClick()" value="submit_insert"><span class="glyphicon glyphicon-plus"></span> Nova Turma</button>
									</div></h3>
					<h3 class="panel-title visible-sm visible-xs"> <div class="form-group visible-xs">
									<div class="input-group">
									<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
									<input class="search" placeholder="Pesquisar" aria-describedby="basic-addon1" style="height: 30px;"/>
						</div>
					</div></h3>
					<div class="panel panel-danger">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-2 col-sm-2 col-md-2">
									<h3 class="panel-title">Pedido</h3></div>
								<div class="col-xs-2 col-sm-2 col-md-2">
									<h3 class="panel-title">Cliente</h3></div>
								<div class="col-xs-2 col-sm-2 col-md-2">
									<h3 class="panel-title">Status</h3></div>
							<div class="col-xs-2 col-sm-2 col-md-2">
								<h3 class="panel-title">Hora</h3></div>
						<div class="col-xs-4 col-sm-4 col-md-4">
							<h3 class="panel-title">Tempo de Entrega</h3></div>
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
												echo'<li
			              				  id='.$val['idPedidos'].'
			              				  cliente="'.$val['fk_idCliente'].'" class="list-group-item"  data-toggle="modal" data-target="#detalheModal" style="padding-top: 15px;padding-bottom: 15px;" >
																	 <div class="pedidosSearch row">
		 																<div class="col-xs-2 col-sm-2 col-md-2">'.$val['idPedidos'].'</div>
		 																<div class="col-xs-2 col-sm-2 col-md-2">'.$val['fk_idCliente'].'</div>
		 																<div class="col-xs-2 col-sm-2 col-md-2">'.$status.'</div>
		 															<div class="col-xs-2 col-sm-2 col-md-2">'.$val['data'].'</div>
		 														<div class="col-xs-4 col-sm-4 col-md-4">'.$val['tempoDeEntrega'].'</div>
		 													</div>
			              				</li>';
			              }
			          ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-2"></div>
			</div>

			<!--MODAL DETALHE -Card -->
			<div class="modal fade" id="detalheModal">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title">Pedido Detalhado</h4>
			      </div>
			      <div class="modal-body">
							<div class="form-group">
			          <label class="control-label" for="clienteLabel">Cliente</label>
			          <input class="form-control" id="clienteLabel" placeholder="Cliente"
			               type="text" name="inputCliente" value="<?=$varCliente;?>">
			        </div>
			        <div class="form-group">
			          <label class="control-label" for="dataLabel">Data</label>
			          <input class="form-control" id="dataLabel" placeholder="Data"
			               type="date" name="inputData"	value="<?=$varData;?>">
			        </div>
							<div class="form-group">
			          <label class="control-label" for="tempoLabel">Tempo de Entrega</label>
			          <input class="form-control" id="tempoLabel" placeholder="Data"
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
							      <th>Descrição</th>
							      <th>Valor</th>
							    </tr>
							  </thead>
							  <tbody>
							    <tr>
							      <th scope="row">1</th>
							      <td>Big Leitão</td>
							      <td>Completo</td>
							      <td>R$15,00</td>
							    </tr>
							    <tr>
							      <th scope="row">2</th>
							      <td>Big Mengão</td>
							      <td>Sem Salada</td>
							      <td>R$12,00</td>
							    </tr>
							    <tr>
							      <th scope="row">3</th>
							      <td>Coca-Cola</td>
							      <td>Zero</td>
							      <td>R$5,00</td>
							    </tr>
							  </tbody>
							</table>
							<div id="listStatus" class="thumbnail scrollable-menu" role="menu" style="background-color: #F2DEDE;">
											<li id="2" class="list-group-item " style="margin-left: 30px;  margin-right: 30px;">
												<div style="width: 66px;" class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-mini bootstrap-switch-id-my-checkbox bootstrap-switch-on bootstrap-switch-animate">
													<div style="width: 96px; margin-left: 0px;" class="bootstrap-switch-container ">
														<input id="my-checkbox" name="1" data-size="mini" data-on-text="Sim" data-off-text="Não" data-animate="true" unchecked type="checkbox">
													</div>
												</div>
												&nbsp;Aguardando Aprovação
											</li>
											<li id="3" class="list-group-item " style="margin-left: 30px;  margin-right: 30px;">
												<div style="width: 66px;" class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-mini bootstrap-switch-id-my-checkbox bootstrap-switch-on bootstrap-switch-animate">
													<div style="width: 96px; margin-left: 0px;" class="bootstrap-switch-container ">
														<input id="my-checkbox" name="2" data-size="mini" data-on-text="Sim" data-off-text="Não" data-animate="true" unchecked type="checkbox">
													</div>
												</div>
												&nbsp;Aprovado
										 </li>
										 <li id="4" class="list-group-item " style="margin-left: 30px;  margin-right: 30px;">
												<div style="width: 66px;" class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-mini bootstrap-switch-id-my-checkbox bootstrap-switch-on bootstrap-switch-animate">
													<div style="width: 96px; margin-left: 0px;" class="bootstrap-switch-container ">
														<input id="my-checkbox" name="3" data-size="mini" data-on-text="Sim" data-off-text="Não" data-animate="true" unchecked type="checkbox">
													</div>
												</div>
												&nbsp;Pedido em Produção
										</li>
										<li id="5" class="list-group-item " style="margin-left: 30px;  margin-right: 30px;">
												<div style="width: 66px;" class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-mini bootstrap-switch-id-my-checkbox bootstrap-switch-on bootstrap-switch-animate">
													<div style="width: 96px; margin-left: 0px;" class="bootstrap-switch-container ">
														<input id="my-checkbox" name="4" data-size="mini" data-on-text="Sim" data-off-text="Não" data-animate="true" unchecked type="checkbox">
													</div>
												</div>
												&nbsp;Pronto para Entrega
								    </li>
									  <li id="6" class="list-group-item " style="margin-left: 30px;  margin-right: 30px;">
												<div style="width: 66px;" class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-mini bootstrap-switch-id-my-checkbox bootstrap-switch-on bootstrap-switch-animate">
													<div style="width: 96px; margin-left: 0px;" class="bootstrap-switch-container ">
														<input id="my-checkbox" name="5" data-size="mini" data-on-text="Sim" data-off-text="Não" data-animate="true" unchecked type="checkbox">
													</div>
												</div>
												&nbsp;Finalizado
										</li>
						</div>
			      </div>
			      <div class="modal-footer">
							<div class="form-group">
			          <label class="control-label" for="tempoLabel" style="color:#AD3232">Troco para R$50,00</label>
			        </div>
							<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
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

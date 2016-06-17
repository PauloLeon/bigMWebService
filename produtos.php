
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
$idProduto = "";
//ativando ou desativando
if (!empty($_POST['ativo'])) {
		$user->setAtivoJSON($_POST['idProduto']);
}
if (!empty($_POST['inativo'])) {
		$user->setInativoJSON($_POST['idProduto']);
}
if (!empty($_POST['submitNewProduto'])) {
		$user->addProduto($_POST['nomeProduto'],$_POST['descricao'],$_POST['valoradd'],$_POST['idCategoria']);
}
if (!empty($_POST['excluir'])) {
		$user->excluirProduto($_POST['idProduto']);
}
if (!empty($_POST['editar'])) {
		$user->editarProduto($_POST['idProduto'],$_POST['nomeProduto'],$_POST['descricao'],$_POST['valor']);
}
if (!empty($_POST['submitNewCategoria'])) {
		$user->addCategoria($_POST['categoriaInputAdd']);
}
if (!empty($_POST['excluirCategoria'])) {
		$user->excluirCategoria($_POST['idCategoriaAdd']);
}
if (!empty($_POST['editarCategoria'])) {
		$user->editarCategoria($_POST['idCategoriaAdd'],$_POST['categoriaInputAdd']);
}
//obtendo lista de itens
$jsonItens= $user->getItensJSON();
$jsonCategoria= $user->getCategoriaJSON();



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
            <title>Ativação de Produtos</title>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=960, user-scalable=yes">
                    <link rel="shortcut icon" href="imagem/favicon.png" type="image/png" />
                    <meta name="author" content="Paulo Rosa" />
                    <link href="/bigMWebService/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css">
                        <link href="/bigMWebService/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
                            <link rel="stylesheet" href="/bigMWebService/bootstrap-3.3.6-dist/css/bootstrap.min.css">
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
                                <nav class="navbar navbar-no-bg" role="navigation" style="background-color:#3C8FD0;">
                                    <div class="container">
                                        <div class="navbar-header">
                                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
                                                <span class="sr-only">Toggle navigation</span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                            </button>
                                        </div>
                                        <!-- Collect the nav links, forms, and other content for toggling -->
                                        <div class="collapse navbar-collapse" id="top-navbar-1">
                                            <ul class="nav navbar-right top-nav ">
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" style="color: white;padding-bottom: 15px;" data-toggle="dropdown">
                                                        <i class="fa fa-user" style="padding: 5px;"></i>Admin
                                                        <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="/bigMWebService/admin.php"style="color: #428bca;" >
                                                                <i class="fa fa-fw fa-user"></i> Admin
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" style="color: #428bca;">
                                                                <i class="fa fa-fw fa-envelope"></i> Caixa de Mensagens
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" style="color: #428bca;">
                                                                <i class="fa fa-fw fa-gear"></i> Configuração de Conta
                                                            </a>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                            <a href="action_logout.php"style="color: #c94141;" >
                                                                <i class="fa fa-fw fa-power-off"></i> Sair
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>
                                <div class="col-md-2"></div>
                                <div class="col-md-6">
                                    <h3 class="page-header" style="margin-top: 20px;">Área de Produtos</h3>
                                </div>
                                <div class="col-md-4">
																	<div class="form-group">
																		<button class="btn btn-success" data-toggle="modal" data-target="#categoriaModal" name="categoriaIncluir"  value="submit_insert">Cadastro Categoria</button>
																	</div>
																</div>
                                <div class="col-lg-12" id="admin">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="row -xs ">
                                                <div class="col-xs-12 col-sm-6 col-md-6">
																									<h3 class="panel-title">
																										<div class="form-group">
																											<button class="btn btn-success" data-toggle="modal" data-target="#incluirModal" name="incluir" value="submit_insert"><span class="glyphicon glyphicon-plus"></span>Novo Produto</button>
																										</div>
																									</h3>
																								</div>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <h3 class="panel-title">
                                                        <div class="input-group pull-right" style="margin-bottom:20px;">
                                                            <input class="search pull-right" placeholder="Pesquisar" aria-describedby="basic-addon1" style="height: 30px;">
                                                                <span class="input-group-addon " id="basic-addon1">
                                                                    <span class="glyphicon glyphicon-search" aria-="true"></span>
                                                                </span>
                                                            </div>
                                                        </h3>
                                                    </div>
                                                </div>
                                                <h3 class="panel-title visible-sm visible-xs">
                                                    <div class="form-group visible-xs">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">
                                                                <span class="glyphicon glyphicon-search" aria-="true"></span>
                                                            </span>
                                                            <input class="search" placeholder="Pesquisar" aria-describedby="basic-addon1" style="height: 30px;">
                                                            </div>
                                                        </div>
                                                    </h3>
																										<h2 class="panel-title" style="text-align: center; margin-bottom: 10px; color: red;">Clique no produto para editar</h2>
                                                    <div class="panel panel-primary">
                                                        <div class="panel-heading">
                                                            <div class="row">
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <h3 class="panel-title">Produtos Ativos</h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel-body">
                                                            <ul id="listPedidos" class="list list-group" style="width: auto">
																															<?php
																																 if (empty($jsonItens)) {
																																		 echo'<li class="list-group-item">'.'Ops! Alguma coisa aconteceu, você está sem produtos cadastrados no sistema.'.'</li>';
																																 }

																																 foreach ($jsonItens as $val) {
																																		 //para resolver o utf-8
																																		 $ativo = $val['ativo'];
																																		 if ($ativo==1) {
																																		 	$ativo = "Disponível";
																																			echo'<li id='.$val['idItem'].'
																																			 				nome="'.$val['nome'].'"
																																							descricao="'.$val['descricao'].'"
																																							valor="'.$val['valor'].'"
																																							categoria="'.$val['categoria'].'" class="list-group-item"  data-toggle="modal" data-target="#detalheModal" style="padding-top: 15px;padding-bottom: 15px;" >
 																																						 <div class="pedidosSearch row">
 																																								 <div class="col-xs-2 col-sm-2 col-md-2">'.$val['nome'].'</div>
																																								 <div class="col-xs-4 col-sm-4 col-md-4">'.$val['descricao'].'</div>
																																								 <div class="col-xs-2 col-sm-2 col-md-2">R$'.$val['valor'].'</div>
 																																								 <div style="color: blue;" class="col-xs-4 col-sm-4 col-md-4">'.$ativo.'</div>
 																																						 </div>
 																																				 </li>';
																																		 } else {
																																		 	$ativo = "Indisponível";
																																			echo'<li id='.$val['idItem'].'
																																								nome="'.$val['nome'].'"
																																								descricao="'.$val['descricao'].'"
																																								valor="'.$val['valor'].'"
																																								categoria="'.$val['categoria'].'"  class="list-group-item"  data-toggle="modal" data-target="#detalheModal" style="padding-top: 15px;padding-bottom: 15px;" >
 																																						 <div class="pedidosSearch row">
																																						 		 <div class="col-xs-2 col-sm-2 col-md-2">'.$val['nome'].'</div>
																																								 <div class="col-xs-4 col-sm-4 col-md-4">'.$val['descricao'].'</div>
																																								 <div class="col-xs-2 col-sm-2 col-md-2">R$'.$val['valor'].'</div>
 																																								 <div style="color: red;" class="col-xs-4 col-sm-4 col-md-4">'.$ativo.'</div>
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
                                        <div style="display: none;" class="modal fade" id="detalheModal">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-="true">×</span>
                                                        </button>
                                                        <h4 style="" class="modal-title">Produto no App</h4>
                                                    </div>
                                                    <div class="modal-body">
																											<form class="form-horizontal" role="form" draggable="true" action="produtos.php" method="post">
                                                        <h9 style="color: red;" class="modal-title">Obs. Desativando esse produto os clientes não poderão pedir em seu celular o produto em questão.</h9>
																												<input type="text" class="form-control" id="id" name="idProduto" value="<?=$idProduto;?>" style="visibility: hidden; height: 0px;padding: 0px;margin:0px;" />
																												<!-- nome -->
																											  <div class="form-group">
																											    <label class="col-md-3 control-label" for="nome">Nome</label>
																											    <div class="col-md-8">
																											    <input id="nomeProduto" name="nomeProduto" class="form-control input-md" required="" type="text" value=" <?=$nomeProduto;?>">
																											    </div>
																											  </div>
																												<!-- Descrição -->
																											  <div class="form-group">
																											    <label class="col-md-3 control-label" for="nome">Descrição</label>
																											    <div class="col-md-8">
																											    <input id="descricao" name="descricao" class="form-control input-md" required="" type="text" value=" <?=$descricao;?>">
																											    </div>
																											  </div>
																												<!-- valor -->
																											  <div class="form-group">
																											    <label class="col-md-3 control-label" for="nome">Valor</label>
																											    <div class="col-md-8">
																														<div class="input-group">
																															<span class="input-group-addon">R$</span>
																															<input id="valor" name="valor" class="form-control input-md" required="" type="text" value=" <?=$valor;?>">
																														</div>
																													</div>
																											  </div>
																												<!-- categoria -->
																											  <div class="form-group">
																											    <label class="col-md-3 control-label" for="nome">Categoria</label>
																											    <div class="col-md-8">
																											    <input id="categoria" name="categoria" disabled="disabled" class="form-control input-md" required="" type="text" value=" <?=$categoria;?>">
																											    </div>
																											  </div>
                                                    </div>
                                                    <div class="modal-footer">
																											  <button type="submit" class="btn btn-danger pull-left" name="excluir" value="Submit">Excluir</button>
																												<button type="submit" class="btn btn-warning pull-left" name="editar" value="Submit">Alterar</button>
                                                        <button type="submit" class="btn btn-default" name="inativo" value="Submit">Indisponível</button>
																												<button type="submit" class="btn btn-primary" name="ativo" value="Submit">Disponível</button>
                                                    </div>
																									</form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->

																				<!--MODAL incluir -Card -->
																				<div style="display: none;" class="modal fade" id="incluirModal">
																						<div class="modal-dialog">
																								<div class="modal-content">
																										<div class="modal-header">
																												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																														<span aria-="true">×</span>
																												</button>
																												<h4 style="" class="modal-title">Produto no App</h4>
																										</div>
																										<div class="modal-body">
																											<form class="form-horizontal" role="form" draggable="true" action="produtos.php" method="post">
																												<!-- nome -->
																												<div class="form-group">
																													<label class="col-md-3 control-label" for="nome">Nome</label>
																													<div class="col-md-8">
																													<input id="nomeProduto" name="nomeProduto" class="form-control input-md" required="" type="text" value="<?=$nomeProduto;?>">
																													</div>
																												</div>
																												<!-- Descrição -->
																												<div class="form-group">
																													<label class="col-md-3 control-label" for="nome">Descrição</label>
																													<div class="col-md-8">
																													<input id="descricao" name="descricao" class="form-control input-md" required="" type="text" value="<?=$descricao;?>">
																													</div>
																												</div>
																												<!-- valor -->
																												<div class="form-group">
																													<label class="col-md-3 control-label" for="nome">Valor</label>
																													<div class="col-md-8">
																														<div class="input-group">
																															<span class="input-group-addon">R$</span>
																															<input id="valoradd" name="valoradd" class="form-control input-md" required="" type="text" value="<?=$valor;?>">
																														</div>
																													</div>
																												</div>
																												<input type="text" class="form-control" id="idCategoria" name="idCategoria" value="<?=$idCategoria;?>" style="visibility: hidden; height: 0px;padding: 0px;margin:0px;" />
																												<!-- Categoria Drop Down-->
																											  <div class="form-group">
																											    <label class="col-md-3 control-label" for="buttondropdown">Categoria</label>
																											    <div class="col-md-8">
																											      <div class="input-group">
																											        <input id="categoriaInput" name="categoriaInput" class="form-control" placeholder="" required="" type="text" value="<?=$categoria;?>">
																											        <div class="input-group-btn">
																											          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
																											            Selecione
																											            <span class="caret"></span>
																											          </button>
																											          <ul id="categoriaList" class="dropdown-menu pull-right">
																																	<?php
																																		 if (empty($jsonCategoria)) {
																																				 echo'<li class="list-group-item">'.'Ops! Alguma coisa aconteceu, você está sem produtos cadastrados no sistema.'.'</li>';
																																		 }

																																		 foreach ($jsonCategoria as $val) {
																																					echo '<li ><a id='.$val['idCategoria'].' href="#">'.$val['nome'].'</a></li>';
																																		 }
																																 ?>
																											          </ul>
																											        </div>
																											      </div>
																											    </div>
																											  </div>
																										</div>
																										<div class="modal-footer">
																												<button type="submit" class="btn btn-primary" id="submitNewProduto" name="submitNewProduto" value="Submit">Adicionar</button>
																										</div>
																									</form>
																								</div>
																								<!-- /.modal-content -->
																						</div>
																						<!-- /.modal-dialog -->
																				</div>
																				<!-- /.modal -->


																				<!--MODAL incluir Categoria -Card -->
																				<div style="display: none;" class="modal fade" id="categoriaModal">
																						<div class="modal-dialog">
																								<div class="modal-content">
																										<div class="modal-header">
																												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																														<span aria-="true">×</span>
																												</button>
																												<h4 style="" class="modal-title">Categoria no App</h4>
																										</div>
																										<div class="modal-body">
																											<form class="form-horizontal" role="form" draggable="true" action="produtos.php" method="post">
																												<input type="text" class="form-control" id="idCategoriaAdd" name="idCategoriaAdd" value="<?=$idCategoriaAdd;?>" style="visibility: hidden; height: 0px;padding: 0px;margin:0px;" />
																												<!-- Categoria Drop Down-->
																												<div class="form-group">
																													<label class="col-md-3 control-label" for="buttondropdown">Categoria</label>
																													<div class="col-md-8">
																														<div class="input-group">
																															<input id="categoriaInputAdd" name="categoriaInputAdd" class="form-control" placeholder="" required="" type="text" value=" <?=$descricaoCategoria;?>">
																															<div class="input-group-btn">
																																<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
																																	Selecione
																																	<span class="caret"></span>
																																</button>
																																<ul id="categoriaListAdd" class="dropdown-menu pull-right">
																																	<?php
																																		 if (empty($jsonCategoria)) {
																																				 echo'<li class="list-group-item">'.'Ops! Alguma coisa aconteceu, você está sem produtos cadastrados no sistema.'.'</li>';
																																		 }

																																		 foreach ($jsonCategoria as $val) {
																																					echo '<li ><a id='.$val['idCategoria'].' href="#">'.$val['nome'].'</a></li>';
																																		 }
																																 ?>
																																</ul>
																															</div>
																														</div>
																													</div>
																												</div>
																										</div>
																										<div class="modal-footer">
																												<button type="submit" class="btn btn-danger" id="excluirCategoria" name="excluirCategoria" value="Submit">excluir</button>
																											<button type="submit" class="btn btn-warning" id="editarCategoria" name="editarCategoria" value="Submit">editar</button>
																												<button type="submit" class="btn btn-primary" id="submitNewCategoria" name="submitNewCategoria" value="Submit">Adicionar</button>
																										</div>
																									</form>
																								</div>
																								<!-- /.modal-content -->
																						</div>
																						<!-- /.modal-dialog -->
																				</div>
																				<!-- /.modal -->
                                    </body>
                                </html>
<?php
echo file_get_contents(dirname(__FILE__).'/ProdutosScript.php', true);
 ?>

<!--<script src"/bigMWebService/js/jquery-2.2.1.min.js"></script>-->
<script type="text/javascript" src="js/jquery-min.js"></script>
<script src="/bigMWebService/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<script src="js/bootstrap-switch.js"></script>
<script src="/bigMWebService/js/list.js"></script>



<script >
    //para o pesquisar
    var optionsnew = {
      valueNames: [ 'pedidosSearch' ]
    };

    var userList1 = new List('pedidos', optionsnew);

    //definindo os id's do checkbox
    $("[id='my-checkbox']").bootstrapSwitch();
    $("[name='checkLancamento']").bootstrapSwitch();
    $("[name='checkLancamento']").bootstrapSwitch('size','mini'	);
    $("[name='checkLancamento']").bootstrapSwitch('onText','Disciplina');
    $("[name='checkLancamento']").bootstrapSwitch('offText','Turma');
    $("[name='checkLancamento']").bootstrapSwitch('offColor','primary');
    $("[name='checkLancamento']").bootstrapSwitch('onColor','success');

		$("#listEscolas li").click(function() {

		});

    $("#listStatus li").click(function() {
      console.log($('this').prop('id'));
		});

    //para quando o modal abrir
    $('#detalheModal').on('show.bs.modal', function (e)
    {
      //isso aqui vem do banco
      nameID = 1;
      $('input[name='+nameID+']').bootstrapSwitch('state', true);
    });

    //para quando o modal fechar retornar ao padrão
    $('#detalheModal').on('hidden.bs.modal', function (e) {
      $("[id='my-checkbox']").bootstrapSwitch('state',false);
    });

 </script>

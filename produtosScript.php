<script src"/bigMWebService/js/jquery-2.2.1.min.js"></script>
<script src="js/bootstrap-switch.js"></script>
<script src="/bigMWebService/js/list.js"></script>
<script  src="/bigMWebService/js/jquery.maskedinput.min.js"></script>




<script >

    $("#listPedidos li").click(function() {
        console.log("Entrou");
        console.log($(this).attr('id'));
        $('#id').attr('value',$(this).attr('id'));
        console.log($('#id').attr('value'));
        $('#nomeProduto').attr('value',$(this).attr('nome'));
        $('#descricao').attr('value',$(this).attr('descricao'));
        $('#valor').attr('value',$(this).attr('valor'));
		});
/*
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
    });*/

 </script>

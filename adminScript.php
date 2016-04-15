<script src"/bigMWebService/js/jquery-2.2.1.min.js"></script>
<script src="js/bootstrap-switch.js"></script>
<script src="/bigMWebService/js/list.js"></script>



<script >
    //para o pesquisar
    var optionsnew = {
      valueNames: [ 'pedidosSearch' ]
    };

    var userList1 = new List('admin', optionsnew);

    //definindo os id's do checkbox
    $("[id='my-checkbox']").bootstrapSwitch();
    $("[id='my-checkbox']").bootstrapSwitch('radioAllOff','true');
    $("[name='checkLancamento']").bootstrapSwitch();
    $("[name='checkLancamento']").bootstrapSwitch('size','mini'	);
    $("[name='checkLancamento']").bootstrapSwitch('onText','Disciplina');
    $("[name='checkLancamento']").bootstrapSwitch('offText','Turma');
    $("[name='checkLancamento']").bootstrapSwitch('offColor','primary');
    $("[name='checkLancamento']").bootstrapSwitch('onColor','success');


		$("#listPedidos li").click(function() {
       //add cliente ao card
        var cliente = $(this).attr('nome');
        $("[id='clienteLabel']").val(jQuery.trim(cliente));
        //add fone ao card
         var fone = $(this).attr('fone');
         $("[id='foneLabel']").val(jQuery.trim(fone));
        //add endereco ao card
         var rua = $(this).attr('rua');
         var bairro = $(this).attr('bairro');
         var numero = $(this).attr('numero');
         var complemento = $(this).attr('complemento');
         $("[id='enderecoLabel']").val(""+rua+" "+complemento+" Numero="+numero+" , "+bairro);
       //add data ao card
        var data = $(this).attr('data');
        $("[id='dataLabel']").val(jQuery.trim(data));
        //add tempo de entrega ao card
         var tempoDeEntrega = $(this).attr('tempoDeEntrega');
         $("[id='tempoLabel']").val(jQuery.trim(tempoDeEntrega));
         //add status ao card
          var status = $(this).attr('status');
          var name = idStatus(status);
          $("#listStatus input[name|="+name+"]").bootstrapSwitch('state', true);
          //add pedidos ao card
          var idPedido = $(this).attr('id');
          $("[id='pedidoInput']").val(jQuery.trim(idPedido));
          buscaItemPedido(idPedido);

        //var auxId = $(this).attr('id');
        //$("#inputIdEdit").val(auxId);
        //$("#inputIdEdit").prop('disabled', true);
		});

    $("#listStatus li").click(function() {
      console.log($('this').prop('id'));

		});

    function idStatus(status)
    {
      if (status = "Aguardando Aprovação") {
        for (var i = 3; i <= 5; i++) {
          $("#listStatus input[name|="+i+"]").bootstrapSwitch('readonly', true);
        }
        var name = 1;
        return name;
      }else if(status = "Aprovado"){
        $("#listStatus input[name|="+1+"]").bootstrapSwitch('readonly', true);
        $("#listStatus input[name|="+4+"]").bootstrapSwitch('readonly', true);
        $("#listStatus input[name|="+5+"]").bootstrapSwitch('readonly', true);
        var name = 2;
        return name;
      }else if(status = "Pedido em Produção"){
        $("#listStatus input[name|="+1+"]").bootstrapSwitch('readonly', true);
        $("#listStatus input[name|="+2+"]").bootstrapSwitch('readonly', true);
        $("#listStatus input[name|="+5+"]").bootstrapSwitch('readonly', true);
        var name = 3;
        return name;
      }else if(status = "Pronto para Entrega"){
        for (var i = 1; i <= 3; i++) {
          $("#listStatus input[name|="+i+"]").bootstrapSwitch('readonly', true);
        }
        var name = 4;
        return name;
      }else if(status = "Finalizado"){
        for (var i = 1; i <= 3; i++) {
          $("#listStatus input[name|="+i+"]").bootstrapSwitch('readonly', true);
        }
        var name = 5;
        return name;
      }
    }

    function buscaItemPedido(idPedido,trocoPara,metodoDePagamento) {
        if (idPedido == "") {
            document.getElementById("txtHint").innerHTML = "";
            return;
        } else {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                   document.getElementById("tbody").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET","getItemPedido.php?q="+idPedido+"&trocoPara="+trocoPara+"&metodoDePagamento="+metodoDePagamento,true);
            xmlhttp.send();
        }
    }
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

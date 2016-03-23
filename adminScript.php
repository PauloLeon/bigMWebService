<script src"/bigMWebService/js/jquery-2.2.1.min.js"></script>
<script src="/bigMWebService/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>



<script >
    //para o pesquisar
    var optionsnew = {
      valueNames: [ 'escolaSearch' ]
    };

    var userList1 = new List('users_2', optionsnew);

 		$("#inputIdEdit").prop('disabled', true);
		$("#listEscolas li").click(function() {

			var auxNome = $(this).attr('nome');
		    var auxCidade = $(this).attr('cidade');

			$("#inputNomeEdit").val(jQuery.trim(auxNome));

			$("#inputCidadeEdit").val(jQuery.trim(auxCidade));

			var auxId = $(this).attr('id');
			$("#inputIdEdit").val(auxId);
			$("#inputIdEdit").prop('disabled', true);
		});

		function clickEdit()
		{
			$("#inputIdEdit").prop('disabled', false);
		}

		function incluirOnClick()
		{

		}
 </script>

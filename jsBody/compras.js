$(document).ready(function() {

    $('#dataTables').dataTable({
		"order": [[0, 'desc']],
        "lengthMenu": [[10], [10]],
	});
	
	
     
});

$('#nuevo').on('click', function () {
	var controlJunta = document.getElementById('juntasC').value;
    if (controlJunta==1) {
        $('#respuesta').addClass('mensaje');
		$('#proceso').val('Registro');
		$('#abreModal').modal({
			show: true,
			backdrop: 'static'
		});
    }else{
		swal('Oops!', 'No tiene autorización para ingresar nueva data', 'error');
	}
	
});


var url = 'compras_Modificar.php';

function modificar() {
	var factu=document.getElementById('factura').value;
	$('#reg').attr('disabled', true);
	$.ajax({
		type: 'GET',
		url: url,
		data: $('#formulario').serialize(),
		success: function (data) {
			if (data == 'Registro completado con exito') {
				$('#reg').attr('disabled', false);
				$('#respuesta').addClass('mensaje').html(data).show(200).delay(1500).hide(200);
				document.location = 'compras.php?factura=' + factu;
			} else {
				$('#reg').attr('disabled', false);
				$('#respuesta').addClass('mensajeError').html(data).show(200).delay(1500).hide(200);
			}
		}
	});
	return false;
}


$('#cerrar').on('click',function() {
	var usuario= document.getElementById('usua').value;
	var numgas=document.getElementById('numgas').value;
	var BDtot=parseFloat(document.getElementById('total').value);
	var factot=parseFloat(document.getElementById('totFactu').value);
		
	if (BDtot==factot) {
		$.ajax({
			type: 'GET',
			url: url,
			data: 'proceso=' + 'cerrar' + '&numgas=' + numgas + '&usua=' + usuario,
			success: function (data) {
				if (data == 'Registro completado con exito') {
					$('#reg').attr('disabled', true);
					$('#cerrar').attr('disabled', true);
					$('#respuesta').addClass('mensaje').html(data).show(200).delay(1500).hide(200);
					document.location = 'comprasPorCerrar.php';
				} else {
					$('#reg').attr('disabled', false);
					$('#cerrar').attr('disabled', false);
					$('#respuesta').addClass('mensajeError').html(data).show(200).delay(1500).hide(200);
				}
			}
		});
	} else {
		swal('Oops!', 'El gasto registrado difiere del total de la factura', 'error');
	
	}	
});


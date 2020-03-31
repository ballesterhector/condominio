$(document).ready(function() {
    $('#dataTables').dataTable({
		"order": [[0, 'desc']],
        "lengthMenu": [[10], [10]],
	});

    total();

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

function compraDetalle() {
	var numgas=document.getElementById('numgas').value;
	$('#reg').attr('disabled', true);
	$.ajax({
		type: 'GET',
		url: url,
		data: $('#formulario').serialize(),
		success: function (data) {
			if (data == 'Registro completado con exito') {
				$('#reg').attr('disabled', false);
				$('#respuesta').addClass('mensaje').html(data).show(200).delay(500).hide(200);
				location.reload();
				
			} else {
				$('#reg').attr('disabled', false);
				$('#respuesta').addClass('mensajeError').html(data).show(200).delay(1500).hide(200);
			}
		}
		
	});
	return false;
}

$('#cost').on('change',function(){
	var costo = document.getElementById('cost').value;
	var cantid = document.getElementById('cantid').value;
	var totalFactura = document.getElementById('totFactu').value;
	var registrados = document.getElementById('total').value;
	var saldo = totalFactura-registrados;
	var gastoARegistrar =costo*cantid;
	document.getElementById('gastotot').value= gastoARegistrar;

	
		if (gastoARegistrar>saldo) {
			swal('Oops!', 'La cantidad a registrar es superior al total de la factura', 'error');
			$('#reg').attr('disabled', true);
		}else{
			$('#reg').attr('disabled', false);
		}	
});

$('#cantid').on('change',function(){
	var costo = document.getElementById('cost').value;
	var cantid = document.getElementById('cantid').value;
	var totalFactura = document.getElementById('totFactu').value;
	var registrados = document.getElementById('total').value;
	var saldo = totalFactura-registrados;
	var gastoARegistrar =costo*cantid;
	document.getElementById('gastotot').value= gastoARegistrar;

	
		if (gastoARegistrar>saldo) {
			swal('Oops!', 'La cantidad a registrar es superior al total de la factura', 'error');
			$('#reg').attr('disabled', true);
		}else{
			$('#reg').attr('disabled', false);
		}
});


function total(){
	var numgas=document.getElementById('numgas').value;
	$.ajax({
		type: 'GET',
		url: url,
		data: 'proceso=' + 'totalgasto' + '&numgas=' + numgas,
		success: function (valores) {
			var datos = eval(valores);
			$('#total').val(datos[0]['gasto']);
		}
	});
}


$('#descrip').on('click',function(){
	var totFac = parseFloat(document.getElementById('totFactu').value);
	var ejecutado= parseFloat(document.getElementById('total').value);

	$('#saldo').val(totFac - ejecutado);
});




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
					document.location = 'compras.php?factura =0';
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


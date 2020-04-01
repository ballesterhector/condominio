$(document).ready(function () {
	$('#dataTables').dataTable({
		"order": [[0, 'asc']],
		"lengthMenu": [[15], [15]],
		//ocultar columna
        //"columnDefs":   [{"targets": [ 1 ],"visible": false}]
	});
	
	
}); //fin ready

function agregarRegistro() {
	var url = 'gastos_Funciones.php';
	$('#reg').attr('disabled', true);
	$.ajax({
		type: 'GET',
		url: url,
		data: $('#formulario').serialize(),
		success: function (data) {
			if (data == 'Registro completado con exito') {
				$('#clos').attr('disabled', true);
				$('#respuesta').addClass('mensaje').html(data).show(200).delay(1500).hide(200);

				modal();
			} else {
				$('#reg').attr('disabled', false);
				$('#respuesta').addClass('mensajeError').html(data).show(200).delay(1500).hide(200);
				//location.reload();
			}
		}
	});
	return false;
}

function modal() {
	var url = 'gastos_Funciones.php';
	$.ajax({
		type: 'GET',
		url: url,
		data: 'proceso=' + 'ultimo',
		success: function (data) {
			var datos = eval(data);
			location.href="gastos2.php?numRegistro=" + datos[0]['numgasto'];
		}
	});
	return false;
}

$('#gast').on('change',function(){
    var difer=parseFloat(document.getElementById('dife').value);
  	var gasto=parseFloat(document.getElementById('gast').value);
	if(gasto>difer || gasto<= parseFloat(0)){
		swal("Monto errado!", "El gasto ingresado es inconsistente", "error");
		$('#reg').attr('disabled', true);
		$('.dif').addClass('btn-danger');
		//setTimeout('location.reload()', 1100);
	}else{
		$('#reg').attr('disabled', false);
	}
});


function agregarDetalle() {
	var url = 'gastos_Funciones.php';
	$('#reg').attr('disabled', true);
		$.ajax({
			type: 'GET',
			url: url,
			data: $('#formulariodetalle').serialize(),
			success: function (data) {
				if (data == 'Registro completado con exito') {
					$('#clos').attr('disabled', true);
					$('#respuesta').addClass('mensaje').html(data).show(200).delay(1500).hide(200);
					setTimeout('location.reload()', 700);

				} else {
					$('#reg').attr('disabled', false);
					$('#respuesta').addClass('mensajeError').html(data).show(200).delay(1500).hide(200);
					//location.reload();
				}
			}
		});
	return false;
}

$('#peribusca').on('change',function(){
    var cj = document.getElementById('cjbusca').value;
    var perio = document.getElementById('peribusca').value;
    location.href="gastosconsulta.php?coju=" + cj +'&period=' + perio;
});

$('#peribuscaapt').on('change',function(){
    var cj = document.getElementById('cjbusca').value;
    var perio = document.getElementById('peribuscaapt').value;
    location.href="gastosconsultaAPT.php?coju=" + cj +'&period=' + perio;
});

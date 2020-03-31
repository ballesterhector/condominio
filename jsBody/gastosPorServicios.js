$(document).ready(function() {
    initControls(); //Para evitar devolverse

    $('#dataTables').dataTable({
		"order": [[0, 'desc']],
        "lengthMenu": [[10], [10]],
	});
	
	var hoy = new Date();
	var dia = hoy.getDay();
	var dia2 = dia < 10 ? "0" + (hoy.getDay()) : dia;
	var mes = hoy.getMonth();
	var mes2 = mes < 10 ? "0" + (hoy.getMonth()+1) : mes+1;
	var fecha=  mes2 + "/" + hoy.getFullYear();
	var fechaCompleta=  dia2 + "/" + mes2 + "/" + hoy.getFullYear();
	$('#period').val(fecha);
	
	permiso();

});

var url = 'gastosPorServicios_modificar.php';

function modificar() {
	$('#reg').attr('disabled', true);
	$.ajax({
		type: 'GET',
		url: url,
		data: $('#formulario').serialize(),
		success: function (data) {
			if (data == 'Registro completado con exito') {
				$('#reg').attr('disabled', false);
				$('#respuesta').addClass('mensaje').html(data).show(200).delay(1500).hide(200);
				document.location = 'gastosPorServicios.php';
			} else {
				$('#reg').attr('disabled', false);
				$('#respuesta').addClass('mensajeError').html(data).show(200).delay(1500).hide(200);
			}
		}
	});
	return false;
}


function permiso() {
	var controlJunta = document.getElementById('propie').value;
    if (controlJunta==0) {
	   let actualiza = new Promise((resolve, reject) => {
		swal("No autorizado!", "No tiene autorizacion para ingresar a este módulo", "error");
			setTimeout(function () {
				document.location.href = "index_Entrada.php";
			}, 3800);
		});
	}
}



//evitar devolverse
function initControls() {
	window.location.hash = "red";
	window.location.hash = "Red" //chrome
	window.onhashchange = function () {
		window.location.hash = "red";
	}
}
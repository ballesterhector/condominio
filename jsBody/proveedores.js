$(document).ready(function() {
    initControls(); //Para evitar devolverse

	$('#dataTables').dataTable({
		"order": [[1, 'asc'],[2, 'asc']],
        "lengthMenu": [[10], [10]],
              
	});

    $('input').on('change', function() {
        var numero = document.getElementById('numprovee').value;
        var field = $(this);
        var dataString = 'value='+field.val()+'&field='+field.attr('name')+'&numero='+numero;
       
		$.ajax({
            type: "POST",
            url: "proveedores_Funciones.php",
            data: dataString,
            success: function (data) {
                $('#respuesta').addClass('mensaje').html('Registro completado').show(200).delay(91500).hide(200);
				setTimeout('location.reload()', 1550);
             }
        });
    });

    $('textarea').on('change', function() {
        var numero = document.getElementById('numprovee').value;
        var field = $(this);
        var dataString = 'value='+field.val()+'&field='+field.attr('name')+'&numero='+numero;
       
		$.ajax({
            type: "POST",
            url: "proveedores_Funciones.php",
            data: dataString,
            success: function (data) {
                $('#respuesta').val('sksksk');
              // location.reload();
             }
        });
    });
});

var url = 'proveedores_Modificaciones.php';

$('#nuevo').on('click', function () {
	var controlJunta = document.getElementById('juntasC').value;
	var espropi = document.getElementById('propie').value;
    if (controlJunta==1 || espropi==1) {
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

function modificar() {
	$('#reg').attr('disabled', true);
	$.ajax({
		type: 'GET',
		url: url,
		data: $('#formulario').serialize(),
		success: function (data) {
			if (data == 'Registro completado con exito') {
				$('#clos').attr('disabled', true);
				$('#respuesta').addClass('mensaje').html(data).show(200).delay(1500).hide(200);
				setTimeout('location.reload()', 1000);
			} else {
				$('#reg').attr('disabled', false)
				$('#respuesta').addClass('mensajeError').html(data).show(200).delay(1500).hide(200);
			}
		}
	});
	return false;
}


//evitar devolverse
function initControls() {
	window.location.hash = "red";
	window.location.hash = "Red" //chrome
	window.onhashchange = function () {
		window.location.hash = "red";
	}
}
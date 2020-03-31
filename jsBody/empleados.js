$(document).ready(function() {

    $('#dataTables').dataTable({
		"order": [[1, 'asc']],
		"lengthMenu": [[13], [13]],
	"columnDefs": [{"targets": [ 2 ], "visible": false /*ocultar columna*/}]
	});
        
    
    initControls(); //Para evitar devolverse

    modificarData();    

    bloquear();

    $('input').on('change', function() {
        var numero = document.getElementById('numEmpleado').value;
        var usua = document.getElementById('usuari').value;
        var field = $(this);
        var dataString = 'value='+field.val()+'&field='+field.attr('name') + '&numero='+numero + '&nomusua='+usua;
       
		$.ajax({
            type: "POST",
            url: "empleados_Funciones.php",
            data: dataString,
            success: function (data) {
                $('#respuesta').addClass('mensaje').html('Registro completado').show(200).delay(1500).hide(200);
				setTimeout('location.reload()', 550);
             }
        });
    });
    
    $('textarea').on('change', function() {
        var numero = document.getElementById('numEmpleado').value;
        var usua = document.getElementById('usuari').value;
        var field = $(this);
        var dataString = 'value='+field.val()+'&field='+field.attr('name') + '&numero='+numero + '&nomusua='+usua;
       
		$.ajax({
            type: "POST",
            url: "empleados_Funciones.php",
            data: dataString,
            success: function (data) {
                $('#respuesta').addClass('mensaje').html('Registro completado').show(200).delay(1500).hide(200);
				setTimeout('location.reload()', 550);
            }
        });
    });
    
    $('select').on('change', function() {
        var numero = document.getElementById('numEmpleado').value;
        var usua = document.getElementById('usuari').value;
        var field = $(this);
        var dataString = 'value='+field.val()+'&field='+field.attr('name') + '&numero='+numero + '&nomusua='+usua;
       
		$.ajax({
            type: "POST",
            url: "empleados_Funciones.php",
            data: dataString,
            success: function (data) {
                $('#respuesta').addClass('mensaje').html('Registro completado').show(200).delay(1500).hide(200);
				setTimeout('location.reload()', 550);
            }
        });
	});
});

var url = 'empleados_Modificaciones.php';

function modificarData() {
    var controlJunta = document.getElementById('juntasC').value;
    var cargoJunta = document.getElementById('juntasCargo').value;
    if (controlJunta==1 & cargoJunta=='Presidente') {
        $('.desbloq').removeAttr('disabled');
    }
}

$('#nomina').on('change',function(){
	if ($('#nomina').val()==0) {
		$('#salario').attr('placeholder','Sueldo').css('background', 'rgba(193, 193, 255, 0.83)');;
	}else{
		$('#salario').attr('placeholder','Salario').css('background', 'rgba(249, 185, 242, 0.83)');;
	}
});


function bloquear() {
    var controlJunta = document.getElementById('juntasC').value;
    
    if (controlJunta==1) {
        $('.bloquear').removeAttr('disabled');
    }
}

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


$('#cedula').on('change',function () {
    var cedul = $("#cedula").val(); //Detectamos los Caracteres del Inp
    var carCacteres = cedul.length;
    if (carCacteres>11) {
        swal('Oops!', 'Ingrese un máximo de 11 caracteres', 'error');
    } else {
        $.ajax({
            type: 'GET',
            url: url,
            data: 'proceso=' + 'Edicion' + '&cedula=' + cedul,
            success: function (data) {
                var datos = eval(data);
                if(datos!=null){
                    swal('Oops!', 'LA CEDULA SE ENCUENTRA REGISTRADA', 'error');
                    $('#cedula').val('').css('background', '#c9fccc');
                }
            }    
        });        
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
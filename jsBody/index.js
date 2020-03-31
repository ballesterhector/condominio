$(document).ready(function () {
	/*asignar  css al recibir el foco*/
	$('#numusua').hide();
	$('#login').hide();
	$('#register').hide();
	$('#reset').hide();
}); //fin ready


var url = 'index_funciones.php';


//verifica si la cedula se encuentra registrada
$('#cedula').on('change',function () {
    var cedul = $("#cedula").val(); //Detectamos los Caracteres del Inp
    var carCacteres = cedul.length;
    if (carCacteres>11) {
		swal('Oops!', 'Ingrese un máximo de 11 caracteres', 'error');
		$('#cedula').val('').css('background', '#c9fccc');
    } else {
        $.ajax({
            type: 'GET',
            url: url,
            data: 'proceso=' + 'Edicion' + '&cedula=' + cedul + '&clave='+ 'pre2',
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


/*cerrar ventana*/
$('.close').on('click',function(){
	var field = $(this);
	var dataString = field.attr('name');
	$('#login').hide();
	$('#register').hide();
	$('#reset').hide();
})


/*animando los botones del navbar*/
$('#menuIngresar').on('click',function(){
	if ($("#login").is(":visible")) {
		
	} else {
		$('#login').show();
		$('#register').hide();
		$('#reset').hide();
	};
	
});

$('#menuRegistro').on('click',function(){
	if ($("#register").is(":visible")) {
		
	} else {
		$('#register').show();
		$('#login').hide();
		$('#reset').hide();
	};
	
});

$('#menuReseteo').on('click',function(){
	if ($("#reset").is(":visible")) {
		
	} else {
		$('#reset').show();
		$('#login').hide();
		$('#register').hide();
	};
	
});
/*fin animando los botones del navbar*/

//registra nuevos usuarios en base de datos

function registro() {
	var claveA = document.getElementById('clave').value;
	var claveB = document.getElementById('claveR').value;

	if (claveA != claveB) {
		swal('Oops!', 'Las contraseñas no concuerdan', 'error');
		$('#clave').css('background-color', '#88FF88');
		$('#claveR').css('background-color', '#88FF88');
		return false;
	} else {
		$.ajax({
			type: 'GET',
			url: url,
			data: $('#formularioregistro').serialize(),
			success: function (data) {
				if (data == 'Registro completado con exito') {
					$('#reg').attr('disabled', true);
					$('#alertas').addClass('mensaje').html(data).show(200).delay(91500).hide(200);
					let actualiza = new Promise((resolve, reject) => {
						setTimeout(function () {
							location.reload();
						}, 2000);
					});
				} else {
					$('#reg').disabled = false;
					$('#alertas').addClass('mensajeError').html(data).show(200).delay(1500).hide(200);
				}
			}
		});
		return false;
	}
	
}

/*resetear clave*/
/*verifica si la cedula se encuentra registrada*/
$('#cedularesetea').on('change', function () {
	var cedu = document.getElementById('cedularesetea').value;
	var url = 'index_funciones.php';
	$.ajax({
		type: 'GET',
		url: url,
		data: 'proceso=' + 'lineas' + '&cedula=' + cedu + '&clave=' + 'pera',
		success: function (valores) {
			var datos = eval(valores);
			var linea = datos[0]['lineas'];
			if (linea == 0) {
				swal("Data incorrecta!", "La cedula ingresada no se encuentra registrada", "error");
				$('#cedularesetea').val('');
			} else {
				$('#usuarioresetea').show();
			}
		}
	});
});

/*verifica si el usuario existe*/
$('#usuarioresetea').on('change', function () {
	var usua = document.getElementById('usuarioresetea').value;
	var url = 'index_funciones.php';
	$.ajax({
		type: 'GET',
		url: url,
		data: 'proceso=' + 'nCedu' + '&usuar=' + usua + '&clave=' + 'pera',
		success: function (valores) {
			var datos = eval(valores);
			var linea = datos[0]['lineas'];
			if (linea == 0) {
				swal("Data incorrecta!", "La cedula ingresada no se encuentra registrada", "error");
				$('#usuarioresetea').hide();
				$('#nuevopass').hide();
			} else {
				$('#usuarioresetea').show();
			}
			
		}
	});
});

function resetea() {
	$.ajax({
		type: 'GET',
		url: url,
		data: $('#formularioresetea').serialize(),
		success: function (data) {
			if (data == 'Registro completado con exito') {
				$('#alertasresetea').addClass('mensaje').html('La contraseňa fue actualizada').show(200).delay(2500).hide(200);
				setTimeout('location.reload()', 3550);
			} else {
				$('#rest').show();
				$('#alertasresetea').addClass('mensajeError').html(data).show(200).delay(1500).hide(200);
			}
		}
	});
	return false;
}
/* fin resetear clave*/


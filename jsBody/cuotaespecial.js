$(document).ready(function () {
	$('#dataTables').dataTable({
		"order": [[1, 'asc'],[4, 'asc'],[3, 'asc']],
		"lengthMenu": [[12], [12]],

		"columnDefs": [
			{ "width": "20%", "targets": 0,
				"width": "40%", "targets": 1,
				"width": "10%", "targets": 3,
				"width": "10%", "targets": 4,
				"width": "10%", "targets": 6,
				"width": "5%", "targets": 7,
				"targets": [ 0 ], "visible": false /*ocultar columna*/
			}
		  ]
	});

}); //fin ready


function agregarRegistro() {
	var url = 'cuotaespecial_Funciones.php';
	$('#reg').attr('disabled', true);
	$.ajax({
		type: 'GET',
		url: url,
		data: $('#formulario').serialize(),
		success: function (data) {
			if (data == 'Registro completado con exito') {
				$('#clos').attr('disabled', true);
				$('#respuesta').addClass('mensaje').html(data).show(200).delay(1500).hide(200);
			//	location.href="cuotaEspecial.php?cenum=0.php";

			} else {
				$('#reg').attr('disabled', false);
				$('#respuesta').addClass('mensajeError').html(data).show(200).delay(1500).hide(200);
				//location.href="cuotaEspecial.php?cenum=0.php";
			}
		}
	});
	return false;
}

$('#detaapt').on('click',function(){
	location.href="cuotaEspecialpropietario.php?numpropi=" + 0 + '&anos=' + 2014 ;
});

$('#chec').on('click',function(){
	var cj=document.getElementById('cjbusca').value;
	var url = 'cuotaespecial_Funciones.php';
	if(cj==0){
		swal("Dato faltante!", "Debe ingresar la residencia a facturar", "error");
	}else{
		$.ajax({
		type: 'GET',
		url: url,
		data: 'proceso=' + 'facturar' + '&cjto=' + cj,
		success: function (data) {
			if (data == 'Registro completado con exito') {
				$('#clos').attr('disabled', true);
				$('#respuesta').addClass('mensaje').html(data).show(200).delay(1500).hide(200);
				//setTimeout('location.reload()', 1100);

			} else {
				$('#reg').attr('disabled', false);
				$('#respuesta').addClass('mensajeError').html(data).show(200).delay(1500).hide(200);
				//location.reload();
			}
		}
	});
	return false;
	}
	setTimeout('location.reload()', 1100);
});
/*dta para el select anidado que busca el CJ y despues el edificio*/
$('#resid').change(function(){
    $('#resid option:selected').each(function(){
        idresid = $(this).val();
        $.get("cuotaespecial_Funciones.php",{id_resid:idresid},function(data){$('#edif').html(data)});
    });
});



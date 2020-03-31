$(document).ready(function() {
    initControls(); //Para evitar devolverse

    $('#dataTables').dataTable({
		"order": [[0, 'desc']],
        "lengthMenu": [[10], [10]],
	});
	
	permiso();
	
     
});

var url = 'inventariosRetiros_modificar.php';


$('#insumo').on('change',function(){
	var insumo = document.getElementById('insumo').value;
	var cantid = document.getElementById('retiro').value;
	$.ajax({
		type: 'GET',
		url: url,
		data: 'proceso=' + 'existencia' + '&producto=' + insumo,
		success: function (valores) {
			var datos = eval(valores);
			$('#existencia').val(datos[0]['cantidad']);
        }     
	});	
});



function permiso() {
	var controlJunta = document.getElementById('juntasC').value;
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
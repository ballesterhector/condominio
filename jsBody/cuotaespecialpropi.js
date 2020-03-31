$(document).ready(function () {
	$('#dataTables').dataTable({
		"order": [[0, 'asc'],[7, 'asc']],
		"lengthMenu": [[12], [12]],

		"columnDefs": [
			{ "width": "20%", "targets": 0,
				"width": "40%", "targets": 1,
				"width": "10%", "targets": 3,
				"width": "10%", "targets": 4,
				"width": "10%", "targets": 6,
				"width": "5%", "targets": 7,
				"targets": [ 0 ], "visible": false /*ocultar columna*/
			},
			{"targets": [ 7 ], "visible": false /*ocultar columna*/}
		  ]
	});

}); //fin ready

$('#saltar').on('click',function(){
    var propie = document.getElementById('propi').value;
    var anos = document.getElementById('anosbusca').value;
    location.href="cuotaEspecialpropietario.php?numpropi="+ propie + '&anos=' + anos;
});

/*dta para el select anidado que busca el CJ y despues el edificio*/
$('#resid').change(function(){
    $('#resid option:selected').each(function(){
        idresid = $(this).val();
        $.get("cuotaespecialPropi_Funciones.php",{id_resid:idresid},function(data){$('#propi').html(data)});
    });
});



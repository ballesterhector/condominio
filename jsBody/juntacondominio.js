$(document).ready(function() {
   
    $('#dataTables').dataTable({
		"order": [[1, 'asc']],
        "lengthMenu": [[10], [10]],
        "pagingType": "full_numbers",
        
	});

    $('select').on('blur', function() {
        var numero = document.getElementById('numpropie').value;
        var field = $(this);
        var dataString = 'value='+1+'&field='+field.attr('name')+'&numero='+numero;
      	$.ajax({
            type: "POST",
            url: "juntacondominio_Funciones.php",
            data: dataString,
            success: function (data) {
               location.reload();
            }
        });
    });
});



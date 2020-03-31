$(document).ready(function() {
    initControls(); //Para evitar devolverse

    modificarData();

    $('#dataTables').dataTable({
		"order": [[2, 'asc'],[3, 'asc']],
        "lengthMenu": [[10], [10]],
        
       
	});

    $('input').on('change', function() {

        var field = $(this);
        var dataString = 'value='+field.val()+'&field='+field.attr('name');
		$.ajax({
            type: "POST",
            url: "Residencias_Funciones.php",
            data: dataString,
            success: function (data) {
                $('#respuesta').addClass('mensaje').html('Registro completado').show(200).delay(1500).hide(200);
				setTimeout('location.reload()', 550);
             }
        });
    });

    
});

function modificarData() {
    var controlJunta = document.getElementById('juntasC').value;
    var cedulDue = document.getElementById('cedujs').value;
    
    if (controlJunta==1 || cedulDue==5010351) {
        $('.desbloq').removeAttr('disabled');
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

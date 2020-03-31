$(document).ready(function() {
    initControls(); //Para evitar devolverse

    modificarpropietario();

    $('#dataTables').dataTable({
		"order": [[1, 'asc']],
        "lengthMenu": [[10], [10]],
	});

    $('input').on('change', function() {
        var numero = document.getElementById('numero').value;
        var field = $(this);
        var dataString = 'value='+field.val()+'&field='+field.attr('name')+'&numero='+numero;
       
		$.ajax({
            type: "POST",
            url: "propietarios_Funciones.php",
            data: dataString,
            success: function (data) {
                $('#respuesta').addClass('mensaje').html('Registro completado').show(200).delay(2500).hide(200);
				setTimeout('location.reload()', 550);
             }
        });
    });

    $('select').on('change', function() {
        var numero = document.getElementById('numero').value;
        var field = $(this);
        var dataString = 'value='+field.val()+'&field='+field.attr('name')+'&numero='+numero;
       
		$.ajax({
            type: "POST",
            url: "propietarios_Funciones.php",
            data: dataString,
            success: function (data) {
                $('#respuesta').addClass('mensaje').html('Registro completado').show(200).delay(1500).hide(200);
				document.location = 'usuarios.php';
             }
        });
    });

    $('textarea').on('change', function() {
        var numero = document.getElementById('numero').value;
        var field = $(this);
        var dataString = 'value='+field.val()+'&field='+field.attr('name')+'&numero='+numero;
       
		$.ajax({
            type: "POST",
            url: "propietarios_Funciones.php",
            data: dataString,
            success: function (data) {
                $('#respuesta').addClass('mensaje').html('Registro completado').show(200).delay(1500).hide(200);
				setTimeout('location.reload()', 550);
             }
        });
    });
 
    var estado = $('#estado').val();
        if (estado=='Inactivo') {
           $('input').css('background','#fca171');
           $('select').css('background','#fca171');
           $('textarea').css('background','#fca171');
    }

});

function modificarpropietario() {
    var controlJunta = document.getElementById('propie').value;
    if (controlJunta==1) {
        $('#esPropieta').removeAttr("disabled");
            $('#estadoUsuario').removeAttr("disabled");
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
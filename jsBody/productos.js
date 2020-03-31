$(document).ready(function() {

    $('#dataTables').dataTable({
		"order": [[2, 'asc'],[1, 'asc']],
        "lengthMenu": [[10], [10]]
        
    });
    
    
    initControls(); //Para evitar devolverse

    bloquear();

    
});

var url = 'productos_funciones.php';

function bloquear() {
    var controlJunta = document.getElementById('juntasC').value;
    
    if (controlJunta==1) {
        $('.bloquear').removeAttr('disabled');
    }
}

function agregar() {
    $('#reg').attr('disabled', true);
    $.ajax({
        type: 'GET',
        url: url,
        data: $('#formulario').serialize(),
        success: function (data) {
            if (data == 'Registro completado con exito') {
                $('#clos').attr('disabled', true);
                $('#respuesta').addClass('mensaje').html('Data registrada').show(200).delay(1500).hide(200);
                let actualiza = new Promise((resolve, reject) => {
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                });
            } else {
                $('#reg').attr('disabled', false);
                $('#respuesta').addClass('mensajeError').html('Data no registrada, posible producto duplicado.').show(200).delay(1900).hide(200);

                
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
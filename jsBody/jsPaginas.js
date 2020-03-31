$(document).ready(function() {
    initControls(); //Para evitar devolverse
    
    main();

    confirmar();
  
});

var contador = 1;

function main() {
    $('.menu-bar').click(function(){
        if (contador==1) {
            $('nav').animate({
                left: '0'
            });
            contador = 0;
                
        } else {
            contador = 1;
            $('nav').animate({
                left: '-100%'
            });
           
        }
    });

    //mostramos y ocultamos sub-menus
    $('.submenu').click(function(){
        $(this).children('.children').slideToggle();
    });

}

   
$(function () {
	$('[data-toggle="tooltip"]').tooltip();
});

$(function () {
	$('[data-toggle="popover"]').popover();
});


function confirmar(){
    var espropi = document.getElementById('propie').value;
    if (espropi == 0 ) {
        swal("No autorizado!", "Solicite autorización a la Junta de Condominio", "error");
        setTimeout(function () {
            document.location.href = "index_Entrada.php";
        }, 2800);
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
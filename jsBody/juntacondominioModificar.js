$(document).ready(function() {
    initControls(); //Para evitar devolverse

    $('input').on('change', function() {
      var numero2 = document.getElementById('numusu').value;
      var field = $(this);
      var dataString = 'value='+field.val()+'&field='+field.attr('name')+'&numero='+numero2;
      $.ajax({
          type: "POST",
          url: "juntacondominio_Funciones.php",
          data: dataString,
          success: function (data) {
            $('#respuesta').addClass('mensaje').html('Registro completado').show(200).delay(1500).hide(200);
            setTimeout('location.reload()', 550);
          }
      });
  });

    $('select').on('change', function() {
        var numero2 = document.getElementById('numusu').value;
        var field = $(this);
        var dataString = 'value='+field.val()+'&field='+field.attr('name')+'&numero='+numero2;
      	$.ajax({
            type: "POST",
            url: "juntacondominio_Funciones.php",
            data: dataString,
            success: function (data) {
              $('#cargo').css('background','#eb5');
              $('#respuesta').addClass('mensaje').html('Registro completado, recuerde actualizar el cargo').show(200).delay(1500).hide(200);
                setTimeout('location.reload()', 2250);
            }
        });
    });
});


//evitar devolverse
function initControls() {
	window.location.hash = "red";
	window.location.hash = "Red" //chrome
	window.onhashchange = function () {
		window.location.hash = "red";
	}
}
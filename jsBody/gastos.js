$(document).ready(function() {
    initControls(); //Para evitar devolverse

    $('#dataTables').dataTable({
		"order": [[2, 'asc'],[3, 'desc']],
		"lengthMenu": [[10], [10]],
		
	});
	
	    
});

$('#peri').on('change',function(){
	var data = document.getElementById('peri').value;
	document.location = 'gastosDetalles.php?periodo=' + data;
});




//evitar devolverse
function initControls() {
	window.location.hash = "red";
	window.location.hash = "Red" //chrome
	window.onhashchange = function () {
		window.location.hash = "red";
	}
}

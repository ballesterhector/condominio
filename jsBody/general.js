$(document).ready(function() {
	initControls(); //Para evitar devolverse

    $('.dropdown-submenu > a').submenupicker();


});

$(function () {
	$('[data-toggle="tooltip"]').tooltip();
});

$(function () {
	$('[data-toggle="popover"]').popover();
});



//evitar devolverse
function initControls() {
	window.location.hash = "red";
	window.location.hash = "Red" //chrome
	window.onhashchange = function () {
		window.location.hash = "red";
	}
}
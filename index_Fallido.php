<?php
    require "html/head.php";
?>



		
		<div class="container cajaIndex">
			<div class="formIngresar">
				<h2 class="letra">DISCULPE</h2>
						<div class="input letra" style="color:red; text-align: center;font-size:24px">
							No se ha podido verificar su información de conexión
						</div>
				<div class="ayud">
					<input type="button" class="btn btn-info boton" name="salir" id="salir" value="salir" onclick="salir()">
				</div>
			</div>
		</div>	
		<script src="aplicaciones/js/jquery-3.2.1.min.js"></script>
		<script src="aplicaciones/js/bootstrap.min.js"></script>
	</body>
</html>
		<script type="text/javascript">
			$(document).ready(function() {
				//$('.dropdown-submenu > a').submenupicker();
				initControls(); //Para evitar devolverse

			});

			function salir() {
				document.location.href = 'index.php';
			}
			//evitar devolverse
			function initControls() {
				window.location.hash = "red";
				window.location.hash = "Red" //chrome
				window.onhashchange = function() {
					window.location.hash = "red";
				}
			}

		</script>

	</body>

</html>

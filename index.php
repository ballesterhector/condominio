<?php
  require "html/indexlogeo.php";
?>


  <body>
    <div class="container">
      <div class="img">
          <img src="imagenes/asda.png">
      </div>
      <nav class="circular-menu">
            <div class="circle">
              <a href="index.php" class="fa fa-user fa-3x"><span class="logi ingresar">Login</span></a>
              <a href="indexRegistro.php" class="fa fa-user-plus fa-3x"><span class="logi">Registro</span></a>
              <a href="indexReseteo.php" class="fa fa-address-card fa-3x"><span class="logi">Resetear</span></a>
            </div>
            <a href="" class="menu-button fa fa-bars fa-2x"></a>
      </nav>

      <!--login-->
      <div id="forloguear" class="form-action topindex" >
        <h2>Ingresar</h2>
        <form action="index_valida.php" id='loguear' method="get">
						<input type="text" name="usua" class="form-control" id="usua" placeholder="Usuario" required="require" autocomplete="off" autofocus="autofocus"/>
						<input type="password" name="passw" class="form-control" placeholder="Contraseňa" required="require" />
						<div class="ayudindex">
              <input type="submit" value="Login" class="buttonindex" />
              <a href="#" onclick="window.open('http:aplicaciones/ayudas/login.pdf')" /><i class="fas fa-book fa-3x" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Manual"></i></a>
					    </div>
					</form>
      </div>	
    </div>
    <script src="jsBody/jquery-3.2.1.min.js"></script>
			
    <script type="text/javascript">
        $(document).ready(function(){

        });
        
        var items = document.querySelectorAll('.circle a');
        for(var i = 0, l = items.length; i < l; i++) {
          items[i].style.left = (50 - 35*Math.cos(-0.5 * Math.PI - 2*(1/l)*i*Math.PI)).toFixed(4) + "%";
          items[i].style.top = (50 + 35*Math.sin(-0.5 * Math.PI - 2*(1/l)*i*Math.PI)).toFixed(4) + "%";
        }

        document.querySelector('.menu-button').onclick = function(e) {
          e.preventDefault(); document.querySelector('.circle').classList.toggle('open');
        }
        
        //evitar devolverse
        function deshabilitaRetroceso(){
            window.location.hash="no-back-button";
            window.location.hash="Again-No-back-button" //chrome
            window.onhashchange=function(){window.location.hash="no-back-button";}
        }

    </script>
  </body>
</html>    
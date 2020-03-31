<?php
	class conectarDB{

		function __construct(){
			try {
					$host="localhost";
					$db_name="condominio2";
					$user="root";
					$pass="asda2019";

					$this->con=mysqli_connect($host,$user,$pass) or die ("Error en la conexión a la base de datos");

					mysqli_select_db($this->con,$db_name)  or die ("No se encontró la base de datos");
					mysqli_query ($this->con, "SET NAMES 'utf8'");	
					//echo "Conexión valida";


			} catch (Exception $e)
			{
				throw $e;
			}

		}

		function consultar($sql){
			$respuesta=mysqli_query($this->con,$sql);

			$data=Null;

			while($fila=mysqli_fetch_assoc($respuesta)){

				$data[]=$fila;

			}

			return $data;
		}

		function subconsulta($sql){
			$respuesta=mysqli_query($this->con,$sql);

			$data=Null;

			while($fila=mysqli_fetch_assoc($respuesta)){

				$data[]=$fila;

			}

			return $data;
		}

		function actualizar($sql){
			mysqli_query($this->con,$sql);

			if(mysqli_affected_rows($this->con)<=0){
				echo 'La actualización no fue efectuada';
			}else{
				echo 'Registro completado con exito';

			}
		}

	}//fin de la clase

	//evita errores por tiempo pero debe ser programada en php.ini en date
	//date_default_timezone_set('America/Caracas');

 ?>

<?php
include_once 'conectar/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$retiro = $_GET['numRetir'];



$consulta = "CAll inventarioResumen(0)";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

    require "html/head.php";
?>
    <div class="titulo">
        <div class="columna1">
            <h2 class="letra">Retiros del inventario </h2>
        </div>
        <div class="columna2">
            <a href="#" onclick="window.open('http:ayudas/compras.pdf')" /><span class="icon-local_library" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Manual"></span></a>
            <a href="#" onclick="window.open('http:inventariosRetirosPDF.php?numRetir= <?php echo $_GET['numRetir'] ?>'  )" /><span class="icon-local_print_shopprint" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Reporte"></span></a>
        </div>
        <div class="columna3">
        <h3 class="letra"><?php echo $residencias ?></h3>
        </div>
    </div>      
    <div class="container">
        <div class="row">
        <!-- BOTTON DE NUEVO   <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div> -->   
        </div>    
    </div>    
    <br>  
    <div class="container cajaConCrud">
        <div class="columna1">
            <div>
                <span>Retiro</span>
            </div>
            <div>   
                <input type="text" class="form-control" style="text-align:center" id="despacho" value="<?php echo $_GET['numRetir'] ?>" disabled>
            </div>
        </div>

        <div class="row columna2">
            <div class="col-lg-12">
                <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                        <tr class="bg-info">
                            <th class="text-center">Insumo num</th>
                            <th class="text-center">Insumo</th>
                            <th class="text-center">Existencia</th>
                            <th class="text-center">Unidad</th>
                            <th class="text-center">Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['rubroCodigo_inv'] ?></td>
                                <td><?php echo $dat['insumoRubr'] ?></td>
                                <td><?php echo $dat['cantidad'] ?></td>
                                <td><?php echo $dat['presentacion'] ?></td>
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                </div>
            </div>
        </div>  
    </div>    
      
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas">    
            <input type="hidden" id="retiro" value="<?php echo $retiro ?>">
            <input type="hidden" id="existencia">
            <div class="modal-body">
                <div class="form-group">
                <label for="idinsumo" class="col-form-label">Código insumo:</label>
                <input type="text" class="form-control" id="idinsumo" disabled>
                </div>
                <div class="form-group">
                <label for="insumo" class="col-form-label">Insumo:</label>
                <input type="text" class="form-control" id="insumo" disabled>
                </div>                
                <div class="form-group">
                <label for="aretirar" class="col-form-label">A retirar:</label>
                <input type="number" class="form-control" id="aretirar" min="1">
                </div>            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
      
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="jsBody/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="jsBody/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>    
     
    <script type="text/javascript" src="jsBody/inventarios.js"></script>  
    
    
  </body>
</html>

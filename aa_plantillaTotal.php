<?php 
    require "html/head.php";
?>
        <div class="titulo">
            <div class="columna1">
                <h2 class="letra">Retiro de rubros del inventario</h2>
            </div>
            <div class="columna2">
                <a href="#" onclick="window.open('http:ayudas/compras.pdf')" /><span class="icon-local_library" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Manual"></span></a>
            </div>
            <div class="columna3">
            <h3 class="letra"><?php echo $residencias ?></h3>
            </div>
        </div>
    







            <?php require "html/footer.php"?>
        </div>
        
        <script type="text/javascript">
        $(document).ready(function() {

            $('#dataTables').dataTable({
                "order": [[0, 'asc']],
                "lengthMenu": [[10], [10]],
            });

            });
        </script>
    </body>
</html>    
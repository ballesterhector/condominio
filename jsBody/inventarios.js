$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Retirar</button><button class='btn btn-danger btnBorrar' style='visibility:hidden'>Borrar</button></div></div>"  
       },

       {
            "targets": [ 0 ],
            "visible": true,
            "searchable": true
         }
    ],
        
        //Para cambiar el lenguaje a español
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
        
    });
    
$("#btnNuevo").click(function(){
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Persona");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    idinsumo = parseInt(fila.find('td:eq(0)').text());
    insumo = fila.find('td:eq(1)').text();
    existencia = parseFloat(fila.find('td:eq(2)').text());
    
    $("#idinsumo").val(idinsumo);
    $("#insumo").val(insumo);
    $("#existencia").val(existencia);

    if($("#aretirar").val()>1){
        $("#aretirar").val(1);
        $('#btnGuardar').removeAttr('disabled');
        $("#btnGuardar").css("background-color", "#28a745");
    }
   // $("#aretirar").val(aretirar);
    opcion = 1; //editar
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Despachar insumo");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaPersonas.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});

$('#aretirar').change(function(){
    existencia = parseFloat($.trim($("#existencia").val()));
    aretirar = parseFloat($.trim($("#aretirar").val()));
    if(aretirar > existencia){
        alert('El monto a retirar es superior a la existencia');
        $('#btnGuardar').attr('disabled','true');
        $("#btnGuardar").css("background-color", "red");
    }else{
        $('#btnGuardar').removeAttr('disabled');
        $("#btnGuardar").css("background-color", "#28a745");
    }
});
    
$("#formPersonas").submit(function(e){
    e.preventDefault();    
    idinsumo = $.trim($("#idinsumo").val());
    aretirar = $.trim($("#aretirar").val());
    retiro = $.trim($("#retiro").val());
    existencia = $.trim($("#existencia").val());   
    $.ajax({
        url: "inventariocrudRetiro.php",
        type: "POST",
        dataType: "json",
        data: {idinsumo:idinsumo, retiro:retiro, aretirar:aretirar, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].rubroCodigo_inv;
            insumo = data[0].insumoRubr;
            existencia = data[0].cantidad;
            presentacion = data[0].presentacion;
            if(opcion == 1){tablaPersonas.row(fila).data([id,insumo,existencia,presentacion]).draw();}
            else{tablaPersonas.row(fila).data([id,insumo,existencia,presentacion]).draw();}            
        }        
    });
    
    $("#modalCRUD").modal("hide");    
    
});    
    
});
<!-- 18 Julio 2018 -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.4.0
            </div>
            <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->
<!-- jQuery 3 -->

<script src="<?php echo base_url();?>assets/template/jquery/jquery.min.js"></script>
<script src="<?= base_url()?>assets/template/dist/js/jquery-3.7.1.js"></script>
<!-- HighCharts -->
<script src="<?php echo base_url();?>assets/template/highcharts/highcharts.js"></script>
<script src="<?php echo base_url();?>assets/template/highcharts/exporting.js"></script>
<!-- jquery-print -->
<script src="<?php echo base_url();?>assets/template/jquery-print/jquery.print.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/template/bootstrap/js/bootstrap.min.js"></script>
<!-- http://jqueryui.com/ para AUTOCOMPLETAR Busquedas v1.12.1 -->
<script src="<?php echo base_url();?>assets/template/jquery-ui/jquery-ui.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>

<!-- SlimScroll -->
<script src="<?php echo base_url();?>assets/template/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url();?>assets/template/datatables.net/js/jQuery.datatables.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Pdf Excel -->
<script src="<?php echo base_url();?>assets/template/datatables-export/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/buttons.print.min.js"></script>
<!-- Sweet Allert
    si lo habilitamos no funciona el presionar la imagen del usuario para cerrar la Sesion
 <script src="<?= base_url()?>js/bootstrap.min.js"></script> -->
<script src="<?= base_url()?>assets/template/dist/js/sweetalert2.all.min.js"></script>

<!-- FastClick -->
<script src="<?php echo base_url();?>assets/template/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/template/dist/js/demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Ver ejemplos en www.codexworld.com

$(document).ready(function () {
    // Agregado 5/09/2024
//    console.log("footer sweetalert2");

    $("#fechainicio").datepicker({
         format: "yyyy-mm-dd",
       language: "fr",
    changeMonth: true,
     changeYear: true
      });

    var base_url="<?php echo base_url();?>";
    var year = (new Date).getFullYear();
    console.log(base_url);
    //
    // comentado 6 de Setiembre 2024
    //  tmb descomentar la funcion datagrafico al final de este codigo
    //  datagrafico(base_url,year);
    $("#year").on("change", function(){
        year = $(this).val();
        datagrafico(base_url,year);
    });
   $(".btn-remove").on("click", function(e){
        e.preventDefault();
        var ruta = $(this).attr("href");
        //alert(ruta);
        $.ajax({
            url: ruta,
            type:"POST",
            success:function(resp){
                //http://localhost/ventas_ci/mantenimiento/productos
                window.location.href = base_url + resp;
            }
        });
    });
    $("#comprobantes").on("change",function(){
        option = $(this).val();

        if (option != ""){
            infocomprobante = option.split("*");

            $("#idcomprobante").val(infocomprobante[0]);
            $("#igv").val(infocomprobante[2]);
            $("#serie").val(infocomprobante[3]);
            $("#numero").val(generarnumero(infocomprobante[1]));
            alert("Ventas comprobantes : "+ val(infocomprobante[2]));
        }else{
            // Si es vacío los blanqueamos, quedan en cero.
            alert("Ventas comprobantes ESTOY VACIO");
            $("#idcomprobante").val(null);
            $("#igv").val(null);
            $("#serie").val(null);
            $("#numero").val(null);
        }
        sumarVentas();
    });

    $(".btn-view-categoria").on("click", function(){
        // Capturamos el valor del botón
        var  categoria = $(this).val();
        // Quitamos los asteriscos del String recibido;
        var infocliente = categoria.split("*");
        html ="<p><strong>Nombre:</strong>"+infocliente[1]+"</p>";
        html+="<p><strong>Descripcion:</strong>"+infocliente[2]+"</p>";
        $("#modal-default .modal-body").html(html);
        });
    $(".btn-view-cliente").on("click", function(){
        // Capturamos el valor del botón
        console.log("btn-view-cliente");
        var  cliente = $(this).val();
        console.log(cliente);
        // Quitamos los asteriscos del String recibido;
        var infocliente = cliente.split("*");
        console.log(infocliente);
        html ="<p><strong>Nombres:</strong>"+infocliente[1]+"</p>";
        html+="<p><strong>Apellidos:</strong>"+infocliente[2]+"</p>";
        html+="<p><strong>Telefono:</strong>"+infocliente[3]+"</p>";
        html+="<p><strong>Dirección:</strong>"+infocliente[4]+"</p>";
        html+="<p><strong>RUC:</strong>"+infocliente[5]+"</p>";
        html+="<p><strong>Empresa:</strong>"+infocliente[6]+"</p>";
        html+="<p><strong>EMail:</strong>"+infocliente[7]+"</p>";
        $("#modal-default .modal-body").html(html);
    });

    $(".btn-view-proveedor").on("click", function(){
        // Capturamos el valor del botón
        var  proveedor = $(this).val();
        // Quitamos los asteriscos del String recibido;
        var infocliente = proveedor.split("*");
        html ="<p><strong>Nombres:</strong>"+infocliente[1]+"</p>";
        html+="<p><strong>Apellidos:</strong>"+infocliente[2]+"</p>";
        html+="<p><strong>Telefono:</strong>"+infocliente[3]+"</p>";
        html+="<p><strong>Dirección:</strong>"+infocliente[4]+"</p>";
        html+="<p><strong>RUC:</strong>"+infocliente[5]+"</p>";
        html+="<p><strong>Empresa:</strong>"+infocliente[6]+"</p>";
        $("#modal-default .modal-body").html(html);
    });

    $(".btn-view-producto").on("click", function(){
        var  producto = $(this).val();
        //alert(split();cliente);
        var infoproducto = producto.split("*");
        html =  "<p><strong>Código:</strong>"+infoproducto[1]+"</p>";
        html += "<p><strong>Nombres:</strong>"+infoproducto[2]+"</p>";
        html += "<p><strong>Descripción:</strong>"+infoproducto[3]+"</p>";
        html += "<p><strong>Precio:</strong>"+infoproducto[4]+"</p>";
        html += "<p><strong>Stock:</strong>"+infoproducto[5]+"</p>";
        html += "<p><strong>Categoría:</strong>"+infoproducto[6]+"</p>";

        $("#modal-default .modal-body").html(html);
    });

    $(".btn-view").on("click", function(){
        var id = $(this).val();
        $.ajax({
            url: base_url + "mantenimiento/categorias/view/" + id,
            type: "POST",
            success:function(resp){
                $("#modal-default .modal-body").html(resp);
                //alert(resp);
            }

        });
    });
    $(".btn-view-usuario").on("click", function(){
        var id = $(this).val();
        $.ajax({
            url: base_url + "administrador/usuarios/view",
            type: "POST",
            //enviamos el valor del "idusuario" que va a contener el valor de la variable "id"
            data:{idusuario:id},
            success:function(resp){
                // resp es la respuesta a imprimir en la ventana Modal
                $("#modal-default .modal-body").html(resp);
                //alert(resp);
            }

        });
    });
     $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    title: "Listado de Ventas",
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: "Listado de Ventas",
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
                    }
                }
            ],
                    language: {
                "lengthMenu": "Mostrar _MENU_ registros por pagina",
                "zeroRecords": "No se encontraron resultados en su busqueda",
                "searchPlaceholder": "Buscar registros",
                "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
                "infoEmpty": "No existen registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "search": "Buscar:",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
            }
        });

    $('#example1').DataTable({
        /* Ordenamos la tabla de Ventas por Fecha Descendente  */
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se encontraron resultados en su búsqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });

$('#liq2').DataTable({
        /* Ordenamos la tabla de Ventas por Fecha Descendente  */
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se encontraron resultados en su búsqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });
    $('.sidebar-menu').tree();

    $(document).on("click",".btn-check",function(){
        //Recuperamos la informaciòn del "btn-check" del add
        cliente = $(this).val();
        infocliente = cliente.split("*");
        //Seleccionamos nuestro campo oculto
        $("#idcliente").val(infocliente[0]);
        $("#cliente").val(infocliente[1]);
        // Ocultamos la ventana modal
        $("#modal-default").modal("hide");
    });

    $("#producto").autocomplete({
        //source lo que muestra al introduc.una letra
        source:function(request, response){
            $.ajax({
                url: base_url+"movimientos/ventas/getProductos",
                type: "POST",
                dataType: "json",
                data:{ valor: request.term},
                success:function(data){
                    response(data);
                }
            });
        },
        minLength:2,
        select:function(event, ui){
            //Pasamos la informaciòn de "ventas\add.php" al botón "AGREGAR"
            data = ui.item.id + "*" + ui.item.codigo + "*" + ui.item.label + "*" + ui.item.precio + "*" + ui.item.stock;
            $("#btn-agregar").val(data);
                $("#producto").val(null);
            },
        });
        $("#btn-agregar").on("click",function(){
            // el Método "on" 
            // data = contiene los datos que tiene el botón
            data = $(this).val();
            if (data != '' ){
                // Etiquetas "tr" contiene la fila
                // Etiquetas "td" contiene los valores de las celdas de la fila
                // Separamos con "split" los campos recibidos desde el id="infoproducto"
                // id       Toma el INDICE 1
                // nombre   Toma el INDICE 2
                // precio   Toma el INDICE 3
                // stock    Toma el INDICE 4
                // cantidad se solicita un Input 
                // importe  Toma tmb el INDICE 3
                // se crean los campos ocultos para guardar en un array los valores por filas.
                infoproducto = data.split("*"); //pasa a ser Array

                html = "<tr>";
                html += "<td><input type='hidden' name='idproductos[]' value='"+infoproducto[0]+"'>"+infoproducto[1]+"</td>";
                html += "<td>"+infoproducto[2]+"</td>";
                // quite el type='hidden'  para que permitiera ingresarlo
                html += "<td><input type='hidden' name='precios[]' value='"+infoproducto[3]+"'>"+infoproducto[3]+"</td>";
                //number_format((int)$producto->precio, 2, ",", ".")
                html += "<td>"+infoproducto[4]+"</td>"; 
                // se agrega una clase "cantidades"
                html += "<td><input type='text' name='cantidades[]' value='1' class='cantidades'></td>";
                html += "<td><input type='hidden' name='importes[]' value='"+infoproducto[3]+"'><p>"+infoproducto[3]+"</p></td>";
                html += "<td><button type='button' class='btn btn-danger btn-remove-producto'><span class='fa fa-remove'></span></button></td>";
                html += "</tr>";
                $("#tbventas tbody").append(html);
                // Ante cualquier cambio en los campos calculamos los Totales
                sumarVentas();
                $("#tbventas").val(null);
                $("#producto").val(null);
            }else{
                alert("Seleccione un producto...");
        }
    });

    $(document).on("click",".btn-remove-producto", function(){
        $(this).closest("tr").remove();
        sumarVentas();
    });

    $(document).on("keyup","#tbventas input.cantidades", function(){
        //seleccionamos la Tabla y el Input Cantidades
        cantidad = $(this).val();
        // para recuperar el valor de la columan "PRECIO"
        // uso la clase "closest" va al "tr" y diretamente accede al indice 2 selecciona el valor
        // 2 porque es la posición 0=Codigo, 1=Nombre
        precio =  $(this).closest("tr").find("td:eq(2)").text();
        var importe = cantidad * precio;
        $(this).closest("tr").find("td:eq(5)").children("p").text(importe.toFixed(2));
        $(this).closest("tr").find("td:eq(5)").children("input").val(importe.toFixed(2));
        sumarVentas();
    });




    // Reportes 
    // Compras
    $(document).on("click", ".btn-view-compras",function(){
        valor_id = $(this).val();
        $.ajax({
            // Indicamos donde esta nuestro controlador
            url: base_url + "movimientos/compras/view",
            type:"POST",
            dataType:"html",
            data:{id:valor_id},
            success:function(data){
                $("#modal-default .modal-body").html(data);
            }
        });
    });
    // Ventas
    $(document).on("click", ".btn-view-venta",function(){
        valor_id = $(this).val();
        $.ajax({
            // Indicamos donde esta nuestro controlador
            url: base_url + "movimientos/ventas/view",
            type:"POST",
            dataType:"html",
            data:{id:valor_id},
            success:function(data){
                $("#modal-default .modal-body").html(data);
            }
        });
    });
    $(document).on("click",".btn-print",function(){
        $("#modal-default .modal-body").print({
            title:"Comprobante de Venta",
        });
    });
    $(document).on("click", ".btn-view-rep-prod",function(){
    valor_id = $(this).val();
    //alert('Recibi :' + valor_id);
    $.ajax({
        // Indicamos donde esta nuestro controlador
        url: base_url + "reportes/productos/rep_prod_view",
        type:"POST",
        dataType:"html",
        data:{id:valor_id},
        success:function(data){
            $("#modal-default .modal-body").html(data);
            }
        });
    });
    // ---------------------
    // -->  COMPRAS    <--
    // ---------------------
    $("#comprobantes-compras").on("change",function(){
        // recuperamos el valor del input "comprobante"

        option = $(this).val();
        // Separamos con "split" los campos recibidos desde el id="comprobantes"
        // id       Toma el INDICE 0
        // cantidad Toma el INDICE 1
        // igv      Toma el INDICE 2
        // serie    Toma el INDICE 3        

        if (option != ""){

            infocomprobante = option.split("*");

            // Seteamos los valores de los campos recibidos después del cambio
            // del botón comprobante en los siguientes campos de ReadOnly

            $("#idcomprobante").val(infocomprobante[0]);
            $("#numero").val(generarnumero(infocomprobante[1]));
            $("#igv").val(infocomprobante[2]);
            $("#serie").val(infocomprobante[3]);

        }else{
            // Si el campo es "Seleccione" es porque está vacío y
            // no soleecionó comprobante, entonce blanqueamos los campos,
            // quedan en cero.
            $("#idcomprobante").val(null);
            $("#numero").val(null);
            $("#igv").val(null);
            $("#serie").val(null);

        }
        // sumarCompras();
    });

    $("#comprobantesdos").on("change",function(){
        var info = $(this).val();

        if (info != ""){
        // Quitamos los asteriscos del String recibido;
            var infocomprobantedos = info.split("*");

            $("#idcomprobante").val(infocomprobantedos[0]);

            $("#igv").val(infocomprobantedos[2]);
            $("#serie").val(infocomprobantedos[3]);
            $("#numero").val(generarnumero(infocomprobantedos[1]));
            alert("Ventas comprobantesdos : "+ val(infocomprobantedos[2]));
        }else{
            // Si es vacío los blanqueamos, quedan en cero.
            alert("Ventas comprobantesdos ESTOY VACIO");
            $("#idcomprobante").val(null);
            $("#igv").val(null);
            $("#serie").val(null);
            $("#numero").val(null);
        }
        sumarComprasDos();
    });



    $(document).on("click",".btn-check-compras-dos",function(){
        //Recuperamos la informaciòn del "btn-check" del add
        proveedor = $(this).val();
        infocliente = proveedor.split("*");
        //Seleccionamos nuestro campo oculto
        $("#idproveedor").val(infocliente[0]);
        $("#proveedor").val(infocliente[1]);
        // Ocultamos la ventana modal
        $("#modal-default").modal("hide");
    });
    $(document).on("click",".btn-remove-producto-compras", function(){
        $(this).closest("tr").remove();
        sumarCompras();
    });
    $("#producto-compras").autocomplete({
        //source lo que muestra al introduc.una letra
        source:function(request, response){
            $.ajax({
                url: base_url+"movimientos/compras/getProductos",
                type: "POST",
                dataType: "json",
                data:{ valor: request.term},
                success:function(data){
                    response(data);
                }
            });
        },
        minLength:2,
        select:function(event, ui){
            //Pasamos la informaciòn al boton 
            data = ui.item.id + "*" + ui.item.codigo + "*" + ui.item.label + "*" + ui.item.precio + "*" + ui.item.stock;
            $("#btn-agregar-compras").val(data);
                $("#producto-compras").val(null);
            },
        });
    /*
                    html = "<tr>";
                html += "<td><input type='hidden' name='idproductos[]' value='"+infoproducto[0]+"'>"+infoproducto[1]+"</td>";
                html += "<td>"+infoproducto[2]+"</td>";
                // quite el type='hidden'  para que permitiera ingresarlo
                html += "<td><input type='hidden' name='precios[]' value='"+infoproducto[3]+"'>"+infoproducto[3]+"</td>";
                //number_format((int)$producto->precio, 2, ",", ".")
                html += "<td>"+infoproducto[4]+"</td>";
                html += "<td><input type='text' name='cantidades[]' value='1' class='cantidades'></td>";
                html += "<td><input type='hidden' name='importes[]' value='"+infoproducto[3]+"'><p>"+infoproducto[3]+"</p></td>";
                html += "<td><button type='button' class='btn btn-danger btn-remove-producto'><span class='fa fa-remove'></span></button></td>";
                html += "</tr>";
*/
    $("#btn-agregar-compras").on("click",function(){
        data = $(this).val();
        //alert("Data: " + data);
        if (data != '' ){
            infoproducto = data.split("*"); //pasa a ser Array
               html = "<tr>";
                html += "<td><input type='hidden' name='idproductos[]' value='"+infoproducto[0]+"'>"+infoproducto[1]+"</td>";
                html += "<td>"+infoproducto[2]+"</td>";
                // quite el type='hidden'  para que permitiera ingresarlo
                html += "<td><input type='hidden' name='precios[]' value='"+infoproducto[3]+"'>"+infoproducto[3]+"</td>";
                //number_format((int)$producto->precio, 2, ",", ".")
                html += "<td>"+infoproducto[4]+"</td>"; 
                // se agrega una clase "cantidades"
                html += "<td><input type='text' name='cantidades[]' value='1' class='cantidades'></td>";
                html += "<td><input type='hidden' name='importes[]' value='"+infoproducto[3]+"'><p>"+infoproducto[3]+"</p></td>";
                html += "<td><button type='button' class='btn btn-danger btn-remove-producto'><span class='fa fa-remove'></span></button></td>";
                html += "</tr>";
            $("#tbcompras tbody").append(html);
            // Ante cualquier cambio en los campos calculamos los Totales
             sumarCompras();
            //$("#tbcompras").val(null);
            $("#btn-agregar").val(null);
            $("#producto-compras").val(null);
        }else{
            alert("Seleccione un producto...");
        }
    });

    // ---------------------
    // -->  COMPRAS  DOS  <--
    // ---------------------
      $("#btn-agregar-compras-dos").on("click",function(){
         data = $(this).val();
         if(!data) {
            console.log('sin valor >'+data);
            data = '1*2*Varios*1*9999*1*1';
        }
         // alert(data);
            if (data != '' ){
                // Etiquetas "tr" contiene la fila
                // Etiquetas "td" contiene los valores de las celdas de la fila
                // Separamos con "split" los campos recibidos desde el id="infoproducto"
                // id       Toma el INDICE 1
                // nombre   Toma el INDICE 2
                // precio   Toma el INDICE 3
                // stock    Toma el INDICE 4
                // cantidad Toma el INDICE 5 - CANTIDAD, se solicita un Input 
                // importe  Toma el INDICE 6 - Subtotal
                // se crean los campos ocultos para guardar en un array los valores por filas.
                data_new = data.concat("*1"); //--Cantidad por Defecto
                alert(data_new);
                infoproducto = data_new.split("*"); //pasa a ser Array

                //fruits.push("Kiwi");
              html = "<tr>";
                html += "<td><input type='hidden' name='idproductos[]' value='"+infoproducto[0]+"'>"+infoproducto[1]+"</td>";
                html += "<td>"+infoproducto[2]+"</td>";
                // quite el type='hidden'  para que permitiera ingresarlo
                html += "<td><input type='text' name='precios[]'  style='text-align:right'  value='"+infoproducto[3]+"' class='precios' </td>";

                //number_format((int)$producto->precio, 2, ",", ".")
                html += "<td>"+infoproducto[4]+"</td>"; 
                // se agrega una clase "cantidades"
                html += "<td><input type='text' name='cantidades[]' value='"+infoproducto[5]+"' class='cantidades'  style='text-align:right' ></td>";
                html += "<td><input type='hidden' name='importes[]' style='text-align:right'  value='"+infoproducto[3]+"'><p>"+infoproducto[3]+"</p></td>";
                html += "<td><button type='button' class='btn btn-danger btn-remove-producto-compras-dos'><span class='fa fa-remove'></span></button></td>";
                html += "</tr>";
                console.log('cantidades : '+infoproducto[5]);
            $("#tbcomprasdos tbody").append(html);
                // Ante cualquier cambio en los campos calculamos los Totales
                sumarComprasDos();
                $("#tbcomprasdos").val(null);
                $("#producto-compras-dos").val(null);
            }else{
                alert("Seleccione un producto...");
        }
    });
    $(document).on("click",".btn-remove-producto-compras-dos", function(){
        $(this).closest("tr")[0].remove();
        sumarComprasDos();
    });


    $("#producto-compras-dos").autocomplete({
        //source lo que muestra al introduc.una letra
        source:function(request, response){
            $.ajax({
                url: base_url+"movimientos/comprasdos/getProductos",
                type: "POST",
                dataType: "json",
                data:{ valor: request.term},
                success:function(data){
                    response(data);
                }
            });
        },
        minLength:2,
        select:function(event, ui){
            //Pasamos la informaciòn al boton
            //data = ui.item.id + "*" + ui.item.codigo + "*" + ui.item.label + "*" + ui.item.precio + "*" + ui.item.stock;
            data = ui.item.id + "*" + ui.item.codigo + "*" + ui.item.label + "*" + ui.item.precio + "*" + ui.item.stock;
            $("#btn-agregar-compras-dos").val(data);
                $("#producto-compras-dos").val(null);
            },
        });

     $(document).on("click", ".btn-view-compra",function(){

        valor_id = $(this).val();
        $.ajax({
            // Indicamos donde esta nuestro controlador
            url: base_url + "movimientos/compras/view",
            type:"POST",
            dataType:"html",
            data:{id:valor_id},
            success:function(data){
                $("#modal-default .modal-body").html(data);
            }
        });
    });
    $(document).on("click",".btn-print-compra",function(){
        $("#modal-default .modal-body").print({
            title:"Comprobante de Compra",
        });
    });
    $(document).on("change","#tbcomprasdos input.cantidades", function(){
              //seleccionamos la Tabla y el Input Cantidades
        cantidad = $(this).val();
        // para recuperar el valor de la columan "PRECIO"
        // uso la clase "closest" va al "tr" y diretamente accede al indice 2 selecciona el valor
        // 2 porque es la posición 0=Codigo, 1=Nombre
console.log("A - #tbcomprasdos input.cantidades infoproducto : "+ infoproducto);
        infoproducto[5] = cantidad;
        // precios =  $("#precios").val(); //
        precios =  infoproducto[3]; // $("input[name=precios]").val();
console.log("A.a - #tbcomprasdos input.cantidades precios : "+ precios);
        infoproducto[3] = precios;
console.log("A.a.a - #tbcomprasdos input.cantidades precios : "+ infoproducto[3] );

//console.log("A.a.a.a - #tbcomprasdos input.cantidades infoproducto : "+ $("input[name=precios]").val());        
        var importe = cantidad * precios;
        infoproducto[6] = importe;
console.log("B #tbcomprasdos input.cantidades infoproducto : "+ infoproducto);
        $(this).closest("tr").find("td:eq(5)").children("p").text(importe.toFixed(2));
        $(this).closest("tr").find("td:eq(5)").children("input").val(importe.toFixed(2));
        sumarComprasDos();
    });




    // precios
    $(document).on("change","#tbcomprasdos input.precios", function(){
        //seleccionamos la Tabla y el Input Cantidades
        precios = $(this).val();
        infoproducto[3]=precios;
        cantidad =  infoproducto[5]; // $("input[name=cantidades]").val();
console.log('#tbcomprasdos-input.precios precio : ' + infoproducto[3]);
      //  alert('Entre en precios por input de datos :' + infoproducto[3] );
        // para recuperar el valor de la columan "PRECIO"
        // uso la clase "closest" va al "tr" y diretamente accede al indice 2 selecciona el valor
        // 2 porque es la posición 0=Codigo, 1=Nombre

//        cantidad = $("#cantidades").val();
//        alert('input.precios Cantidad: ' + cantidad );
        var importe = cantidad * precios;
        infoproducto[6] = importe;
console.log('#tbcomprasdos-input.precios cantidad : ' + cantidad);
console.log('#tbcomprasdos-input.precios precios  : ' + precios);
console.log('#tbcomprasdos-input.precios infoproducto  a: ' + infoproducto);

        $("input[name=subtotal]").val(importe.toFixed(2));
console.log('#tbcomprasdos-input.precios infoproducto  b: ' + infoproducto);

        $(this).closest("tr").find("td:eq(5)").children("p").text(importe.toFixed(2));
        $(this).closest("tr").find("td:eq(5)").children("input").val(importe.toFixed(2));
console.log('#tbcomprasdos-input.precios infoproducto  c: ' + infoproducto);
        sumarComprasDos();
/*
        $(this).closest("tr").find("td:eq(5)").children("p").text(importe.toFixed(2));
        $(this).closest("tr").find("td:eq(5)").children("input").val(importe.toFixed(2));

        sumarCompras();
       */
    });

// Filtro por Fecha
         $("#liq1").on("change", function(){
            chkigv1 = $(this).val();
            var text = $('#liq1').find('input[name="faniomes"]').val();
            console.log('liq1 change var text = faniomes: ' + text);
            var dt = $('#liq2').DataTable().search( text.substr(0,7) ).draw();
            });


// Boleto Pago DGI 2/901

    $(document).on("click", ".btn-view-boletopagodgi",function(){
        valor_id = $(this).val();
        $.ajax({
            // Indicamos donde esta nuestro controlador
            url: base_url + "movimientos/boletopagodgi/view",
            type:"POST",
            dataType:"html",
            data:{id:valor_id},
            success:function(data){
                $("#modal-default .modal-body").html(data);
            }
        });
    });

});


function generarnumero(numero){
 //Numero es para sumar la Boleta o la Factura
 if (numero>= 99999 && numero< 999999){
    return Number(numero)+1;
 }
 if (numero>= 9999 && numero< 99999){
    return "0" + (Number(numero)+1);
 }
if (numero>= 999 && numero< 9999){
    return "00" + (Number(numero)+1);
 }
if (numero>= 99 && numero< 999){
    return "000" + (Number(numero)+1);
 }
if (numero>= 9 && numero< 99){
    return "0000" + (Number(numero)+1);
 }
 if (numero< 9){
    return "00000" + (Number(numero)+1);
 }
}

function sumarComprasDos(){
     subtotal = 0;
     precios  =  infoproducto[3];
console.log('precios : '+precios);
     //precios =  $("input[name=precios]").val();

    // El "tr" each es para recorrer toda la columna "5" y suma los importes
    $("#tbcomprasdos tbody tr").each(function(){
        subtotal = subtotal + Number($(this).find("td:eq(5)").text());
      //  subtotal = subtotal + precios;
alert("sumarComprasDos antes del subtotal: " + subtotal );
       $("input[name=subtotal]").val(subtotal.toFixed(2));
       $("input[name=igv]").val(22);
      // $("#igv").val(infocomprobantedos[2]);

    alert("sumarComprasDos despues igv subtotal: " + subtotal );
    });
    $("input[name=subtotal]").val(subtotal.toFixed(2));
   // $("#igv").val(infocomprobantedos[2]);
    $("#igv").val(22);
   $("input[name=subtotal]").val(subtotal.toFixed(2));
    //$("#igv").val(infocomprobante[2]);
    porcentaje = $("#igv").val();
    igv = subtotal * (porcentaje/100);
    $("input[name=igv]").val(igv.toFixed(2));
    descuento = $("input[name=descuento").val();
    total = subtotal + igv - descuento;
    $("input[name=total]").val(total.toFixed(2));
}


function sumarCompras(){
    subtotal = 0;

    $("#tbcompras tbody tr").each(function(){
        subtotal = subtotal + Number($(this).find("td:eq(5)").text());
        alert("sumarCompras subtotal: " + subtotal );
    });

        $("input[name=subtotal]").val(subtotal.toFixed(2));
        $("#igv").val(infocomprobante[2]);
        porcentaje = $("#igv").val();
        igv = subtotal * (porcentaje/100);
        $("input[name=igv]").val(igv.toFixed(2));
        descuento = $("input[name=descuento").val();
        total = subtotal + igv - descuento;
        $("input[name=total]").val(total.toFixed(2));

    } 

function sumarVentas(){
    subtotal = 0;
    // El "tr" each es para recorrer toda la columna "5" y suma los importes
    $("#tbventas tbody tr").each(function(){
        subtotal = subtotal + Number($(this).find("td:eq(5)").text());
    });
    $("input[name=subtotal]").val(subtotal.toFixed(2));
    $("#igv").val(infocomprobante[2]);
    porcentaje = $("#igv").val();
    igv = subtotal * (porcentaje/100);
    $("input[name=igv]").val(igv.toFixed(2));
    descuento = $("input[name=descuento").val();
    total = subtotal + igv - descuento;
    $("input[name=total]").val(total.toFixed(2));
}

// GMoreno
/*
function checkLiq1() {

    var sumigv1    = 0;
    var chkfecha1  = 0;
    var chkpresentada1 =  '';
    var liq_presentada='N';
    var faniomes = $('#liq1').find('input[name="faniomes"]').val();
    // var chkigv1 = $('#liq1').find('checkbox[name="chkigv1"]').checked();
    console.log('faniomes: ' + faniomes);
    //console.log('1-chekLiq1: '+ $('#liq1').find('input[name="chkigv1"]').val();

    // el HTML debe contener un nombre de formulario en este caso
    // se definio en el HTML  <form name="listForm">
//alert('checkLiq1 antes for: ');

    try{

        console.log(document.getElementsById("chkfecha1").value);
        console.log(document.getElementsById("chkigv").value);

        console.log(document.listForm1.chkpresentada1.value);
        console.log(document.listForm1.chkigv1.length);

        console.log('------------');

    //  var text = $('#liq1').find('input[name="faniomes"]').val();
        var d = new Date(document.listForm1.chkfecha1.value);
        console.log(d.getFullYear());
        console.log('0'+(d.getMonth()+1));

        var anio=d.getFullYear();
        var mes= '0'+(d.getMonth()+1);
        console.log(anio+mes);
        console.log('------------');

    }catch(e){
        if(e){
            alert ('No puedo definir las variables');
        }
    }

    alert('2-chekLiq1');
    for (i=0;i<document.listForm1.chkigv1.length;i++) {

        if (document.listForm1.chkigv1[i].checked) {

            console.log('#Liq1.Index : ' + i );

            sumigv1    = sumigv1 + parseInt(document.listForm1.chkigv1[i].value);
            console.log('#Liq1.chkfecha1: ' + parseInt(document.listForm1.chkfecha1[i].value));
    //        chkfecha1 =  parseInt(document.listForm1.chkfecha1[i].value);
        }
    }
    console.log('li1:igv : ' + document.listForm1.chkigv1.value);

    //$("input[name=faniomes]").text(anio+mes);

    //$("input[name=chkfecha1]").val(chkfecha1.toFixed(2));
        var base_url="<?php echo base_url();?>";
        var chkfecha1= document.listForm1.faniomes.value;
        var igv1    = document.listForm1.chkigv1.value;
        var liq_pres= document.listForm1.chkpresentada1.value;
        console.log('#chkfecha1 : ' + chkfecha1);
        console.log('#chkigv1 : ' + igv1);
        console.log('#chkliq_pres : ' + liq_pres);
        $.ajax({
            type:"POST",
            url: base_url + "administrador/LiquidacionMensual/redraw/"+chkfecha1,
            data: { fecha: chkfecha1 },
          //  success:function(respuesta){
              success:function(data){
                alert('los datos...'+chkfecha1);
                console.log('los datos...'+chkfecha1);
               $('#liq2').serialize();
            },  error:function(jqXHR, textStatus, errorThrown){
                console.log('error: ' + errorThrown);
            }
        });

}

function checkLiq2() {
    var listaids  = "";
    var sumigv    = 0;
    var sumsubtot = 0;
    var sumtotal  = 0;
    var end       = 0;
    // el HTML debe contener un nombre de formulario en este caso
    // se definio en el HTML  <form name="listForm">

    //console.log(document.listForm2.chkigv.length);
    //var chkigv = $('#liq1').find('input[input="chkigv2"]').val();
    console.log('largo chkigv : ' + document.listForm2.chkigv.length);

    for (i=0;i<document.listForm2.chkigv.length;i++) {

        if (document.listForm2.chkigv[i].checked) {

            console.log('#Liq2.id : ' + parseInt(document.listForm2.chkid[i].value) );
            listaids  = listaids +  parseInt(document.listForm2.chkid[i].value) + ",";

            console.log('#Liq2.igv: ' + parseInt(document.listForm2.chkigv[i].value));            
            sumigv    = sumigv    + parseInt(document.listForm2.chkigv[i].value);

            console.log('#Liq2.Subtotal: ' + parseInt(document.listForm2.chksubtotal[i].value));
            sumsubtot = sumsubtot    + parseInt(document.listForm2.chksubtotal[i].value);
            console.log('#Liq2.Total: '    + parseInt(document.listForm2.chktotal[i].value));
            sumtotal = sumtotal      + parseInt(document.listForm2.chktotal[i].value);
        }
    }
    $("input[name=igv]").val(sumigv);
    $("input[name=subtotal]").val(sumsubtot.toFixed(2));
    $("input[name=total]").val(sumtotal.toFixed(2));
    // GM
    console.log('largo listaids : ' + listaids.length);
    end = listaids.length;
    listaids = listaids.substring(0, end-1);
    console.log('largo : ' + listaids);
    $("input[name=listaids]").val(listaids);

}
*/
function number_format(number, decimals, dec_point, thousands_point) {

    if (number == null || !isFinite(number)) {
        throw new TypeError("number is not valid");
    }

    if (!decimals) {
        var len = number.toString().split('.').length;
        decimals = len > 1 ? len : 0;
    }

    if (!dec_point) {
        dec_point = '.';
    }

    if (!thousands_point) {
        thousands_point = ',';
    }

    number = parseFloat(number).toFixed(decimals);

    number = number.replace(".", dec_point);

    var splitNum = number.split(dec_point);
    splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
    number = splitNum.join(dec_point);

    return number;
}
/*
console.log(number_format(132323232320.321, 2, ',', '.'));
console.log(number_format(10.22));
console.log(number_format(100));
console.log(number_format(1000, 2, ',', '.'));
*/

/* Comentado 6 de Setiembre 2024
function datagrafico(base_url,year){
    var base_url='<?php echo base_url();?>';
    console.log('base_url : ' + base_url);
    namesMonth = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Set','Oct','Nov','Dic'];
    console.log(namesMonth);
    console.log("Año: " + year);
    console.log("url: " + base_url + 'Dashboard/getData/'+year,   );
    $.ajax({
        url: base_url + 'Dashboard/getData/'+year,
        type:'post',
        dataType:'json',
        data:{ year:year },

    success:function(data){
            var meses = new Array();
            var montos = new Array();
          //  alert(typeof JSON.stringify({year: 'year'})),
            $.each(data,function(key, value){
                meses.push(namesMonth[value.mes - 1]);
                valor = Number(value.monto);
                montos.push(valor);
   //             alert('meses');
                console.log(meses + ' ' + valor + ' ' + montos);
            })
            // alert(year);
            graficar(meses,year,montos);
        },
        fail:function() {
            alert( 'Datagrafico Error!!' );
        },
        error: function(xhr, status, error) {
            alert("xhr " + xhr);
            alert("status " + status);
            alert("error " + error);

                 var err = JSON.parse(xhr.responseText);
            alert(err.Message);
        }
    });

    $.ajaxSetup({
    error: function( jqXHR, textStatus, errorThrown ) {
            if (jqXHR.status === 0) {
                alert('Not connect: Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found [404]');
            } else if (jqXHR.status == 500) {
                alert('Internal Server Error [500].');
            } else if (textStatus === 'parsererror') {
                alert('Requested JSON parse failed.');
            } else if (textStatus === 'timeout') {
                alert('Time out error.');
            } else if (textStatus === 'abort') {
                alert('Ajax request aborted.');
            } else {
                alert('Uncaught Error: ' + jqXHR.responseText);
            }
            }
        })
}

function graficar(meses,year,montos){
    Highcharts.chart('grafico', {
        chart: {
            type: 'column'
        },
        title: {
        text: 'Monto acumulado de ventas por mes'
        },
        subtitle: {
            text: 'Año: ' + year
        },
        xAxis: {
            categories: meses,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
            text: 'Monto Acumulado en $U'
            }
        },
   tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">Monto: </td>' +
            '<td style="padding:0"><b>{point.y:.0f} $U</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            },
            series:{
                dataLabels:{
                    enabled:true,
                formatter:function(){
                    return Highcharts.numberFormat(this.y,0)
                    }
                }
            }
        },
        series: [{
//            type: 'line',
            name: 'Meses',
            data: montos
        }]
    });
}

*/

</script>
</body>
</html>
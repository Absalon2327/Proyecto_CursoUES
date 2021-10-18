$(function (){
	$('#formulario_registro').parsley();

	/*$('#telefono').inputmask({
		mask: '9999-9999',

	});*/


	var fecha_hoy = new Date(); 
	$('#fecha').datepicker({
	    format: "dd/mm/yyyy",
	    todayBtn: true,
	    clearBtn: false,
	    language: "es",
	    calendarWeeks: true,
	    autoclose: true,
	    todayHighlight: true,
	    endDate:fecha_hoy
	});
	cargar_datos();
	// $(".select2").select2();

	$(document).on("click",".btn_eliminar",function(e){
		e.preventDefault();
		var id = $(this).attr("data-idcat");
		var datos = {"eliminar_categoria":"si_eliminala","id":id}
		$.ajax({
	        dataType: "json",
	        method: "POST",
	        url:'json_categorias.php',
	        data : datos,
	    }).done(function(json) {
	    	cargar_datos();

	    });
	});
	$(document).on("click",".btn_editar",function(e){

		e.preventDefault(); 
		var id = $(this).attr("data-idcat");
		console.log("El id es: ",id);
		var datos = {"consultar_info":"si_este_id","id":id}
		$.ajax({
	        dataType: "json",
	        method: "POST",
	        url:'json_categorias.php',
	        data : datos,
	    }).done(function(json) {
	    	console.log("EL consultar especifico",json);
	    	if (json[0]=="Exito") {
	    		
	    		$('#llave_categoria').val(id);
	    		$('#ingreso_datos').val("si_actualizalo");
	    		$('#nombre_cate').val(json[2]['nombre_categoria']);	    		
	    		$('#estado_cat').val(json[2]['estado_categoria']); 
				$("#estado_cat").prop("disabled", false);
	    		$('#md_registrar_categoria').modal('show');
	    	}
	    	 
	    }).fail(function(){

	    }).always(function(){

	    });


	});



	$(document).on("click","#registrar_categoria",function(e){
		e.preventDefault();
		console.log("Capturando evento");
		//$('#myModal').modal('show'); para abrir modal
		//$('#myModal').modal('hide'); para cerrar modal		
		$('#md_registrar_categoria').modal('show');
		
		$(".select2").select2({
	    }).on("select2:opening", 
	        function(){
	            $(".modal").removeAttr("tabindex", "-1");
	    }).on("select2:close", 
	        function(){ 
	            $(".modal").attr("tabindex", "-1");
	    });
    
	});


	$(document).on("submit","#formulario_registro",function(e){
		e.preventDefault();
		var datos = $("#formulario_registro").serialize();
		console.log("Imprimiendo datos: ",datos);

		$.ajax({
            dataType: "json",
            method: "POST",
            url:'json_categorias.php',
            data : datos,
        }).done(function(json) {
        	console.log("EL GUARDAR",json);

        	cargar_datos();
        }).fail(function(){

        }).always(function(){

        });


	});
});

function cargar_datos(){
	var datos = {"consultar_info":"si_consultala"}
	$.ajax({
        dataType: "json",
        method: "POST",
        url:'json_categorias.php',
        data : datos,
    }).done(function(json) {
    	console.log("EL consultar",json);
    	$("#datos_tabla").empty().html(json[1]);
    	$('#tabla_categorias').DataTable();
    	$('#md_registrar_categoria').modal('hide');
    }).fail(function(){

    }).always(function(){

    });
}
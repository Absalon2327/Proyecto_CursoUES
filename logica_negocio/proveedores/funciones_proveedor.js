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
		var id = $(this).attr("data-idprov");
		var datos = {"eliminar_proveedor":"si_eliminar","id":id}
		$.ajax({
	        dataType: "json",
	        method: "POST",
	        url:'json_proveedor.php',
	        data : datos,
	    }).done(function(json) {
	    	cargar_datos();

	    });
	});
	$(document).on("click",".btn_editar",function(e){
	
		e.preventDefault(); 
		var id = $(this).attr("data-idprov");
		console.log("El id es: ",id);
		var datos = {"consultar_info":"si_este_id","id":id}
		$.ajax({
	        dataType: "json",
	        method: "POST",
	        url:'json_proveedor.php',
	        data : datos,
	    }).done(function(json) {
	    	console.log("EL consultar especifico",json);

	    	if (json[0]=="Exito") {	    	
	    		$('#llave_proveedor').val(id);
	    		$('#ingreso_datos').val("si_actualizalo");
	    		$('#nombre_prov').val(json[2]['nombre_proveedor']);
	    		$('#num_regis_prov').val(json[2]['nrc_proveedor']);
	    		$('#nit_prov').val(json[2]['nit_proveedor']);
	    		$('#direc_prov').val(json[2]['direccion_proveedor']);
	    		$('#telefono_prov').val(json[2]['telefono_proveedor']);
	    		$('#nacionalidad_prov').val(json[2]['nacionalidad_proveedor']);
	    		$('#est_prov').prop("disabled", false);
	    		$('#est_prov').val(json[2]['estado_proveedor']);
				
	    		$('#md_registrar_proveedor').modal('show');
	    	}
	    	
	    	 
	    }).fail(function(){

	    }).always(function(){

	    });


	});



	$(document).on("click","#registrar_proveedor",function(e){
		e.preventDefault();
		console.log("Capturando evento");
		//$('#myModal').modal('show'); para abrir modal
		//$('#myModal').modal('hide'); para cerrar modal
		$('#nombre_prov').val("");
	    $('#num_regis_prov').val("");
	    $('#nit_prov').val("");
	    $('#direc_prov').val("");
	    $('#telefono_prov').val("");
		$('#md_registrar_proveedor').modal('show');

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
            url:'json_proveedor.php',
            data : datos,
        }).done(function(json) {
        	console.log("EL GUARDAR",json);
        		$('#nombre_prov').val("");
	    		$('#num_regis_prov').val("");
	    		$('#nit_prov').val("");
	    		$('#direc_prov').val("");
	    		$('#telefono_prov').val("");
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
        url:'json_proveedor.php',
        data : datos,
    }).done(function(json) {
    	console.log("EL consultar",json);
    	$("#datos_tabla").empty().html(json[1]);
    	$("#cantidad_proveedor").empty().html(json[2]);
    	$('#tabla_proveedores').DataTable();
    	$('#md_registrar_proveedor').modal('hide');
    }).fail(function(){

    }).always(function(){

    });
}
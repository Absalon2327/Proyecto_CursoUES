<?php 
	
	require_once("../../Conexion/Modelo.php");
	$modelo = new Modelo();
	if (isset($_POST['eliminar_categoria']) && $_POST['eliminar_categoria']=="si_eliminala") {
		$array_eliminar = array(
			"table"=>"tb_categorias",
			"id_categoria"=>$_POST['id']

		);
		$resultado = $modelo->eliminar_generica($array_eliminar);
		if($resultado[0]=='1' && $resultado[4]>0){
        	print json_encode(array("Exito",$_POST,$resultado));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$resultado));
			exit();
        }
		


	}else if (isset($_POST['ingreso_datos']) && $_POST['ingreso_datos']=="si_actualizalo") {		
		$array_update = array(
            "table" => "tb_categorias",
            "id_categoria" => $_POST['llave_categoria'],
            "nombre_categoria" => $_POST['nombre_cate'],
            "estado_categoria" => $_POST['estado_cat']
        );
		$resultado = $modelo->actualizar_generica($array_update);

		if($resultado[0]=='1' && $resultado[4]>0){
        	print json_encode(array("Exito",$_POST,$resultado));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$resultado));
			exit();
        }


	}else if (isset($_POST['consultar_info']) && $_POST['consultar_info']=="si_este_id") {

		$resultado = $modelo->get_todos("tb_categorias","WHERE id_categoria = '".$_POST['id']."'");
		if($resultado[0]=='1'){
        	print json_encode(array("Exito",$_POST,$resultado[2][0]));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$resultado));
			exit();
        }



	}else if (isset($_POST['ingreso_datos']) && $_POST['ingreso_datos']=="si_registro") {
		$_POST['direccion']="sna vicente";
		$id_insertar = $modelo->retonrar_id_insertar("tb_categorias"); 
        $array_insertar = array(
            "table" => "tb_categorias",
            "id_categoria"=>$id_insertar,
            "nombre_categoria" => $_POST['nombre_cate'],
            "estado_categoria" => $_POST['est_categoria']
        );
        $result = $modelo->insertar_generica($array_insertar);
        if($result[0]=='1'){        	

        	print json_encode(array("Exito",$_POST,$result,$result[2][0]));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$result));
			exit();
        }
    
		 
	}else{
		$htmltr = $html="";
		$cuantos = 0;
		$sql = "SELECT * FROM tb_categorias WHERE estado_categoria = 'activo';";
		$result = $modelo->get_query($sql);
		if($result[0]=='1'){
			
			foreach ($result[2] as $row) {				
				 $htmltr.='<tr>
	                            <td class="text-center">'.$row['nombre_categoria'].'</td>	                            
	                            <td class="text-center">
	                            	<div class="dropdown m-b-10">
                                        <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Seleccione
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a data-idcat="'.$row['id_categoria'].'" class="dropdown-item btn_editar" href="javascript:void(0)">Editar</a>
                                            <a data-idcat="'.$row['id_categoria'].'" class="dropdown-item btn_eliminar" href="javascript:void(0)">Eliminar</a>
                                        </div>
                                    </div>

	                            </td>
	                        </tr>';	
			}
			$html.='<table id="tabla_categorias" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre</th>                            
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';
            $html.=$htmltr;
			$html.='</tbody>
                    	</table>';


        	print json_encode(array("Exito",$html,$cuantos,$_POST,$result));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$result));
			exit();
        }
	}

?>
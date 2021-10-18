<?php 
	
	require_once("../../Conexion/Modelo.php");
	$modelo = new Modelo();
	if (isset($_POST['eliminar_proveedor']) && $_POST['eliminar_proveedor']=="si_eliminar") {
		$array_eliminar = array(
			"table"=>"tb_proveedor",
			"id_proveedor"=>$_POST['id']

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
            "table" => "tb_proveedor",
            "id_proveedor" => $_POST['llave_proveedor'],
            "nombre_proveedor" => $_POST['nombre_prov'],
            "nrc_proveedor" => $_POST['num_regis_prov'],
            "nit_proveedor" => $_POST['nit_prov'],
            "direccion_proveedor" => $_POST['direc_prov'],
            "telefono_proveedor" => $_POST['telefono_prov'],
            "nacionalidad_proveedor" => $_POST['nacionalidad_prov'],
            "estado_proveedor" => $_POST['estado_prov'],
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

		$resultado = $modelo->get_todos("tb_proveedor","WHERE id_proveedor = '".$_POST['id']."'");
		if($resultado[0]=='1'){
        	print json_encode(array("Exito",$_POST,$resultado[2][0]));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$resultado));
			exit();
        }



	}else if (isset($_POST['ingreso_datos']) && $_POST['ingreso_datos']=="si_registro") {
		
		$id_insertar = $modelo->retonrar_id_insertar("tb_proveedor"); 
        $array_insertar = array(
            "table" => "tb_proveedor",
            "id_proveedor"=>$id_insertar,
            "nombre_proveedor" => $_POST['nombre_prov'],
            "nrc_proveedor" => $_POST['num_regis_prov'],
            "nit_proveedor" => $_POST['nit_prov'],
            "direccion_proveedor" => $_POST['direc_prov'],
            "telefono_proveedor" => $_POST['telefono_prov'],
            "nacionalidad_proveedor" => $_POST['nacionalidad_prov'],
            "estado_proveedor" => $_POST['estado_prov'],
           
        );
        $result = $modelo->insertar_generica($array_insertar);
        if($result[0]=='1'){

        	print json_encode(array("Exito",$_POST,$result[2][0]));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$result));
			exit();
        }
    
		 
	}else{
		$htmltr = $html="";
		$cuantos = 0;
		$sql = "SELECT *,(SELECT count(*) as cuantos FROM tb_proveedor) as cuantos FROM tb_proveedor WHERE estado_proveedor = 'activo';";
		$result = $modelo->get_query($sql);
		if($result[0]=='1'){
			
			foreach ($result[2] as $row) {
				$cuantos = $row['cuantos'];				
				$htmltr.='<tr>
	                            <td>'.$row['nombre_proveedor'].'</td>
	                            <td>'.$row['nrc_proveedor'].'</td>
	                            <td>'.$row['nit_proveedor'].'</td>
	                            <td>'.$row['direccion_proveedor'].'</td>
	                            <td>'.$row['telefono_proveedor'].'</td>
	                            <td>'.$row['nacionalidad_proveedor'].'</td>	                           
	                            <td>
	                            	<div class="dropdown m-b-10">
                                        <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Seleccione
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a data-idprov="'.$row['id_proveedor'].'" class="dropdown-item btn_editar" href="javascript:void(0)">Editar</a>
                                            <a data-idprov="'.$row['id_proveedor'].'" class="dropdown-item btn_eliminar" href="javascript:void(0)">Eliminar</a>
                                        </div>
                                    </div>

	                            </td>
	                        </tr>';	
			}
			$html.='<table id="tabla_proveedores" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>NRC</th>
                            <th>NIT</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Nacionalidad</th>
                            <th>Acciones</th>
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
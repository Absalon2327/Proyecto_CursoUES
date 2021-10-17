<?php include '../../layouts/header.php'; ?>
<!-- C3 charts css -->
<link href="../../public/plugins/c3/c3.min.css" rel="stylesheet" type="text/css" />
<link href="../../public/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="../../public/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="../../public/plugins/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css">

<?php include '../../layouts/headerStyle.php'; ?>
<style>
    
    div#registrar_proveedor {
        cursor: pointer;
    }
    .error_modificado li.parsley-required {
        position: absolute;
        margin-top: 42px;
        margin-left: -330px;
    }
</style>
<body class="fixed-left">

    <?php include '../../layouts/loader.php'; ?>

    <!-- Begin page -->
    <div id="wrapper">

    <?php include '../../layouts/navbar.php'; ?>

        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                <?php include '../../layouts/topbar.php'; ?>
                 

                <!-- ==================
                     PAGE CONTENT START
                     ================== -->

                <div class="page-content-wrapper">

                    <div class="container-fluid">
                        
                        <div class="row">
                            <div class="col-md-6 col-xl-6" >
                                <div class="mini-stat clearfix bg-white">
                                    <span class="mini-stat-icon bg-purple mr-0 float-right"><i class="mdi mdi-cake"></i></span>
                                    <div class="mini-stat-info">
                                        <span class="counter text-purple" id="cantidad_proveedor">25140</span>
                                        Productos registrados
                                    </div>
                                    <div class="clearfix"></div>
                                     
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6" id="registrar_proveedor">
                                <div class="mini-stat clearfix bg-white">
                                    <span class="mini-stat-icon bg-blue-grey mr-0 float-right"><i class="mdi mdi-account-multiple-plus"></i></span>
                                    <div class="mini-stat-info">
                                        <span class="counter text-blue-grey">Registrar</span>
                                        Nuevo Producto
                                    </div>
                                    <div class="clearfix"></div>
                                     
                                </div>
                            </div>
                             
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card m-b-20">
                                    <div class="card-body" id="datos_tabla">
 

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                         

                        

                    </div><!-- container -->

                </div> <!-- Page content Wrapper -->

            </div> <!-- content -->

            <?php include '../../layouts/footer.php'; ?>

            <!-- aca las modales-->
   
            <div class="modal fade" id="md_registrar_proveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro nuevo producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                    <div class="modal-body">
                      
                        <form name="formulario_registro" id="formulario_registro">
                            <input type="hidden" id="ingreso_datos" name="ingreso_datos" value="si_registro">
                            <input type="hidden" id="llave_proveedor" name="llave_proveedor" value="si_registro">
                                <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label>Nombre Producto</label>
                                        <input type="text" autocomplete="off" name="nombre_prov" data-parsley-required-message="El nombre es requerido" id="nombre" class="form-control" required placeholder="Canasta"/>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="control-label">Categoría</label>
                                        <select id="categoria_pro" name="categoria_pro" class="form-control select2">
                                             
                                            <option value="1" >CALZADO</option>
                                            <option value="2" selected>PLASTICOS</option>
                                        </select>               
                                      </div>
                                    </div>


                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label>Existencia</label>
                                        <input  type="number" name="existencia_pro" data-parsley-required-message="Campo  requerido" id="existencia_pro" maxlength="10" class="form-control" required placeholder="1"/>
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label>Costo de Compra</label>
                                        <input type="number" autocomplete="off" name="costo_compra" data-parsley-required-message="Campo  requerido" id="costo_compra" class="form-control" required placeholder="00.00"/>
                                      </div>
                                    </div>
                                    <div class="col-6" style="margin-left: 25%;">
                                        <div class="card m-b-20">
                                            <div class="card-body">

                                                <h4 class="mt-0 header-title">Añade un Foto</h4>
                                                <p class="text-muted m-b-30 font-14">
                                                </p>

                                                <div class="m-b-30">
                                                    <form action="#" class="dropzone">
                                                        <div class="fallback">
                                                            <input name="file" type="file" multiple="multiple">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
                           
                    
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" id="boton_enviar"  class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
              </div>
            </div>
        </div>
        <!-- End Right content here -->

    </div>
    <!-- END wrapper -->


<?php include '../../layouts/footerScript.php'; ?>

    <!-- Peity chart JS -->
    <script src="../../public/plugins/peity-chart/jquery.peity.min.js"></script>

    <!--C3 Chart-->
    <script src="../../public/plugins/d3/d3.min.js"></script>
    <script src="../../public/plugins/c3/c3.min.js"></script>

    <!-- KNOB JS -->
    <script src="../../public/plugins/jquery-knob/excanvas.js"></script>
    <script src="../../public/plugins/jquery-knob/jquery.knob.js"></script>

    <!-- Page specific js -->
    <script src="../../public/assets/pages/dashboard.js"></script>

    <!-- Required datatable js -->
    <script src="../../public/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../public/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="../../public/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="../../public/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="../../public/plugins/datatables/jszip.min.js"></script>
    <script src="../../public/plugins/datatables/pdfmake.min.js"></script>
    <script src="../../public/plugins/datatables/vfs_fonts.js"></script>
    <script src="../../public/plugins/datatables/buttons.html5.min.js"></script>
    <script src="../../public/plugins/datatables/buttons.print.min.js"></script>
    <script src="../../public/plugins/datatables/buttons.colVis.min.js"></script>
    <!-- Responsive examples -->
    <script src="../../public/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="../../public/plugins/datatables/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="../../public/assets/pages/datatables.init.js"></script>
        
    <!-- App js -->
    <script src="../../public/assets/js/app.js"></script>
    <script src="../../public/plugins/select2/js/select2.min.js"></script>
    <!-- Bootstrap inputmask js -->
    <script src="../../public/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>

    
    <script type="text/javascript" src="../../public/plugins/parsleyjs/parsley.min.js"></script>
    <script src="../../public/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

      <script src="../../public/plugins/dropzone/dist/dropzone.js"></script>

    <script src="funciones_productos.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
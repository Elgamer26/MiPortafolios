<main class="app-content">

    <div class="app-title">
        <div>
            <h1><i class="fa fa-list"></i> Lista de tipos -
                <button class="btn btn-success" onclick="ModalTipo_();"><i class="fa fa-plus"></i> Nuevo tipo</button> 
            </h1>
            <!-- <p>Table to display analytical data effectively</p> -->
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
            <li class="breadcrumb-item">Tipos</li>
        </ul>
    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <h6><i class="fa fa-list"></i> Lista tipos </h6>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="TablaTipo">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th> 
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</main>


<div class="modal fade" id="nuevo_tipo" tabindex="-1" role="dialog" aria-labelledby="nuevo_tipoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #009688;">
                <h5 class="modal-title" id="nuevo_tipoLabel" style="color: white;">Nuevo tipo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="nombre_tipo_">Nombre</label> <b><label style="color: red;" id="nombre_tipo__obligg"></label></b>
                            <input class="form-control" maxlength="50" id="nombre_tipo_" autocomplete="off" type="text" placeholder="Ingrese nombre">
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="RegistrarTipo();">Registrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="nuevo_tipo_edit" tabindex="-1" role="dialog" aria-labelledby="nuevo_tipo_editLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #009688;">
                <h5 class="modal-title" id="nuevo_tipo_editLabel" style="color: white;">Editar Tipo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <input type="number" hidden id="id_tiposs">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="nombre_tipo_edit">Nombre</label> <b><label style="color: red;" id="nombre_tipo_edit_obligg"></label></b>
                            <input class="form-control" maxlength="50" id="nombre_tipo_edit" autocomplete="off" type="text" placeholder="Ingrese nombre">
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="EditarTipos();">Registrar</button>
            </div>
        </div>
    </div>
</div>


<script>
    var BaseUrl;
    BaseUrl = "<?php echo base_url(); ?>";

    

    function ModalTipo_() {
        $("#nombre_tipo_").val(""); 
        $("#nombre_tipo__obligg").html(""); 

        $("#nuevo_tipo").modal({
            backdrop: "static",
            keyboard: false
        });
        $("#nuevo_tipo").modal("show");
    }
</script>
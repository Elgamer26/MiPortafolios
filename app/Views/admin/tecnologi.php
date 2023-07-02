<main class="app-content">

    <div class="app-title">
        <div>
            <h1><i class="fa fa-stack-overflow"></i> Lista de tecnologias -
                <button class="btn btn-success" onclick="ModalLenguaje();"><i class="fa fa-plus"></i> Nuevo lenguaje</button> -
                <button class="btn btn-warning" onclick="ModalTecnologia();"><i class="fa fa-plus"></i> Nueva tecnologia</button>
            </h1>
            <!-- <p>Table to display analytical data effectively</p> -->
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
            <li class="breadcrumb-item">Tecnologias</li>
        </ul>
    </div>

    <div class="row">

        <div class="col-md-6">
            <div class="tile">
                <div class="tile-body">
                    <h6><i class="fa fa-list"></i> Lista lenguajes </h6>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="TablaLenguaje">
                            <thead>
                                <tr>
                                    <!-- <th>#</th> -->
                                    <th>Nombre</th>
                                    <th>Imagen</th>
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

        <div class="col-md-6">
            <div class="tile">
                <div class="tile-body">
                    <h6><i class="fa fa-list"></i> Lista tecnologias </h6>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="TablaTecnologia">
                            <thead>
                                <tr>
                                    <!-- <th>#</th> -->
                                    <th>Nombre</th>
                                    <th>Imagen</th>
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

<div class="modal fade" id="nuevoLenguaje" tabindex="-1" role="dialog" aria-labelledby="nuevoLenguajeLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #009688;">
                <h5 class="modal-title" id="nuevoLenguajeLabel" style="color: white;">Nuevo lenguaje</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="nombresLenguaje">Nombre</label> <b><label style="color: red;" id="nombresLenguaje_obligg"></label></b>
                            <input class="form-control" maxlength="30" id="nombresLenguaje" autocomplete="off" type="text" placeholder="Ingrese nombre">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group text-center">
                            <label>Foto lenguaje</label> <b><label style="color: red;" id="fotoLenguaje_obligg"></label></b>
                            <img id="img_lenguaje" height="187px" width="200px" class="border rounded mx-auto d-block img-fluid" src="<?php echo base_url(); ?>public/img/lenguaje/lenguaje.jpg" />
                            <input type="file" class="form-control" id="fotoLenguaje" onchange="mostrar_imagen_lenguajr(this)" />
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="RegistraLenguaje();">Registrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="nuevoLenguajeedit" tabindex="-1" role="dialog" aria-labelledby="nuevoLenguajeeditLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #009688;">
                <h5 class="modal-title" id="nuevoLenguajeeditLabel" style="color: white;">Editar lenguaje</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="number" id="idlenguajeedit" hidden>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="nombresLenguajeedit">Nombre</label> <b><label style="color: red;" id="nombresLenguaje_obliggedit"></label></b>
                            <input class="form-control" maxlength="30" id="nombresLenguajeedit" autocomplete="off" type="text" placeholder="Ingrese nombre">
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="EditarLneguaje();">Editar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalFotoLenguaje" role="dialog" aria-labelledby="ModalFotoLenguajeLabel" aria-hidden="true">
    <div class="modal-dialog xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #009688;">
                <h5 class="modal-title" id="ModalFotoLenguajeLabel" style="color: white;">Editar foto lenguaje</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <input type="number" id="id_foto_lenguaje" hidden>
                        <div class="col-md-12 mb-3 form-group">
                            <div class="ibox-body text-center">

                                <img class="img-circle" id="foto_lenguaje" style="border-radius: 50%;" white="250px" height="250px">
                                <h5 class="font-strong m-b-10 m-t-10"><span>Foto de lenguaje</span></h5>
                                <div>
                                    <input type="file" id="foto_new_lenguaje" class="form-control" onchange="mostrar_imagen_edit_lenguaje(this)">
                                    <input type="text" id="foto_actu_lenguaje" hidden>
                                    <button class="btn btn-info btn-rounded mb-3" onclick="editar_foto_lenguaje();"><i class="fa fa-plus"></i> Cambiar foto</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="nuevaTecnologia" tabindex="-1" role="dialog" aria-labelledby="nuevaTecnologiaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #009688;">
                <h5 class="modal-title" id="nuevaTecnologiaLabel" style="color: white;">Nueva tecnologia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="nombresTecnologia">Nombre</label> <b><label style="color: red;" id="nombresTecnologia_obligg"></label></b>
                            <input class="form-control" maxlength="30" id="nombresTecnologia" autocomplete="off" type="text" placeholder="Ingrese nombre">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group text-center">
                            <label>Foto Tecnologia</label> <b><label style="color: red;" id="fotoTecnologia_obligg"></label></b>
                            <img id="img_tecnologia" height="187px" width="200px" class="border rounded mx-auto d-block img-fluid" src="<?php echo base_url(); ?>public/img/tecnologia/tecnologia.jpg" />
                            <input type="file" class="form-control" id="fototecnologia" onchange="mostrar_imagen_tecnologia(this)" />
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="RegistrarTecnologia();">Registrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="nuevaTecnologiaeditar" tabindex="-1" role="dialog" aria-labelledby="nuevaTecnologiaeditarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #009688;">
                <h5 class="modal-title" id="nuevaTecnologiaeditarLabel" style="color: white;">Editar tecnologia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <input type="number" id="idtecnologiaedit" hidden>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="nombresTecnologiaeditar">Nombre</label> <b><label style="color: red;" id="nombresTecnologiaeditar_obligg"></label></b>
                            <input class="form-control" maxlength="30" id="nombresTecnologiaeditar" autocomplete="off" type="text" placeholder="Ingrese nombre">
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="EditarTecnologia();">Editar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalFotoTecnologia" role="dialog" aria-labelledby="ModalFotoTecnologiaLabel" aria-hidden="true">
    <div class="modal-dialog xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #009688;">
                <h5 class="modal-title" id="ModalFotoTecnologiaLabel" style="color: white;">Editar foto tecnologia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <input type="number" id="id_foto_tecnologia" hidden>
                        <div class="col-md-12 mb-3 form-group">
                            <div class="ibox-body text-center">

                                <img class="img-circle" id="foto_tecnologia" style="border-radius: 50%;" white="250px" height="250px">
                                <h5 class="font-strong m-b-10 m-t-10"><span>Foto de tecnologia</span></h5>
                                <div>
                                    <input type="file" id="foto_new_tecnologia" class="form-control" onchange="mostrar_imagen_edit_tecnologia(this)">
                                    <input type="text" id="foto_actu_tecnologia" hidden>
                                    <button class="btn btn-info btn-rounded mb-3" onclick="editar_foto_tecnologia();"><i class="fa fa-plus"></i> Cambiar foto</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var BaseUrl;
    BaseUrl = "<?php echo base_url(); ?>";

    function ModalLenguaje() {

        $("#nombresLenguaje").val("");
        $("#fotoLenguaje").val("");
        $("#img_lenguaje").attr("src", BaseUrl + "public/img/lenguaje/lenguaje.jpg").height(187).width(200);

        $("#nombresLenguaje_obligg").html("");
        $("#fotoLenguaje_obligg").html("");

        $("#nuevoLenguaje").modal({
            backdrop: "static",
            keyboard: false
        });
        $("#nuevoLenguaje").modal("show");

    }

    function ModalTecnologia() {

        $("#nombresTecnologia").val("");
        $("#fototecnologia").val("");
        $("#img_tecnologia").attr("src", BaseUrl + "public/img/tecnologia/tecnologia.jpg").height(187).width(200);

        $("#nombresTecnologia_obligg").html("");
        $("#fotoTecnologia_obligg").html("");

        $("#nuevaTecnologia").modal({
            backdrop: "static",
            keyboard: false
        });
        $("#nuevaTecnologia").modal("show");

    }


    function mostrar_imagen_lenguajr(input) {
        var filename = document.getElementById("fotoLenguaje").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {

            if (input.files) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#img_lenguaje").attr("src", e.target.result).height(187).width(200);
                }
                reader.readAsDataURL(input.files[0]);
            }

        } else {
            swal.fire(
                "Mensaje de alerta",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            $("#img_lenguaje").attr("src", BaseUrl + "public/img/lenguaje/lenguaje.jpg").height(187).width(200);
            return document.getElementById("fotoLenguaje").value = "";
        }

    }

    function mostrar_imagen_edit_lenguaje(input) {
        var filename = document.getElementById("foto_new_lenguaje").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {

            if (input.files) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#foto_lenguaje").attr("src", e.target.result).height(187).width(200);
                }
                reader.readAsDataURL(input.files[0]);
            }

        } else {
            swal.fire(
                "Mensaje de alerta",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            return document.getElementById("foto_new_lenguaje").value = "";
        }

    }


    function mostrar_imagen_tecnologia(input) {
        var filename = document.getElementById("fototecnologia").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {

            if (input.files) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#img_tecnologia").attr("src", e.target.result).height(187).width(200);
                }
                reader.readAsDataURL(input.files[0]);
            }

        } else {
            swal.fire(
                "Mensaje de alerta",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            $("#img_tecnologia").attr("src", BaseUrl + "public/img/tecnologia/tecnologia.jpg").height(187).width(200);
            return document.getElementById("fototecnologia").value = "";
        }

    }

    function mostrar_imagen_edit_tecnologia(input) {
        var filename = document.getElementById("foto_new_tecnologia").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {

            if (input.files) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#foto_tecnologia").attr("src", e.target.result).height(187).width(200);
                }
                reader.readAsDataURL(input.files[0]);
            }

        } else {
            swal.fire(
                "Mensaje de alerta",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            return document.getElementById("foto_new_tecnologia").value = "";
        }

    }
</script>
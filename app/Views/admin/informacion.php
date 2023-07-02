<main class="app-content">

    <div class="app-title">
        <div>
            <h1><i class="fa fa-user"></i> Datos de perfil
            </h1>
            <!-- <p>Table to display analytical data effectively</p> -->
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
            <li class="breadcrumb-item">Perfil</li>
        </ul>
    </div>

    <div class="row user">
        <div class="col-md-12">
            <div class="profile">
                <div class="info"><img class="user-img" id="foto_perfil" width="110" height="110">
                    <h4 id="nombre_perfil">Jorge Ramirez</h4>
                    <p>Developer</p>
                    <input hidden id="fotomia_actual" type="text">
                    <input class="form-control" id="fotomia" type="file">
                    <p></p>
                    <button class="btn btn-success" onclick="EditarFotoPerfil();">Cargar foto</button>
                </div>
                <div class="cover-image"></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="tab-content">

                <div class="tab-pane active" id="user-settings">
                    <div class="tile user-settings">
                        <h4 class="line-head">Información</h4>

                        <div class="row mb-4">

                            <div class="col-md-4">
                                <label>Hoja de vida</label>
                                <input type="text" hidden id="hoja_actual">
                                <input onchange="file_pdf(this)" id="hoja_vida" class="form-control" type="file">
                            </div>

                            <div class="col-md-2">
                                <label>Cargar hoja de vida</label>
                                <button class="btn btn-warning" onclick="SubirHojaVida();"><i class="fa fa-file"></i>Cargar...</button>
                            </div>

                            <div class="col-md-2">
                                <label>Hoja de vida</label><br>
                                <b><a target="_blank" id="verhojavida">Ver hoja de vida? <i class="fa fa-eye"></i> </a></b>
                            </div>

                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label>Nombres</label> <b><label style="color: red;" id="nombresperfil_oblig"></label></b>
                                <input class="form-control" id="nombres" onkeypress="return soloLetras(event)" maxlength="50" type="text">
                            </div>
                            <div class="col-md-4">
                                <label>Apellidos</label> <b><label style="color: red;" id="apellidosperfil_oblig"></label></b>
                                <input class="form-control" id="apellidos" onkeypress="return soloLetras(event)" maxlength="50" type="text">
                            </div>
                            <div class="col-md-4">
                                <label>Correo</label> <b><label style="color: red;" id="correoperfil_oblig"></label></b>
                                <input class="form-control" id="correo" maxlength="70" type="text">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-2">
                                <label>Telefono</label> <b><label style="color: red;" id="telefonoperfil_oblig"></label></b>
                                <input class="form-control" id="telefono" onkeypress="return soloNumeros(event)" maxlength="10" type="text">
                            </div>
                            <div class="col-md-2">
                                <label>Pais</label> <b><label style="color: red;" id="paisperfil_oblig"></label></b>
                                <input class="form-control" id="pais" onkeypress="return soloLetras(event)" maxlength="20" type="text">
                            </div>
                            <div class="col-md-5">
                                <label>Dirección</label> <b><label style="color: red;" id="direccionperfil_oblig"></label></b>
                                <input class="form-control" id="direccion" maxlength="60" type="text">
                            </div>
                            <div class="col-md-3">
                                <label>Profesión</label> <b><label style="color: red;" id="profesionperfil_oblig"></label></b>
                                <input class="form-control" id="profesion" onkeypress="return soloLetras(event)" maxlength="60" type="text">
                            </div>
                        </div>

                        <div class="row mb-12">
                            <div class="col-md-12">
                                <label>Mas sobre Mí</label> <b><label style="color: red;" id="sobremiperfil_oblig"></label></b>
                                <textarea class="form-control" id="sobremi" cols="5" rows="3"></textarea>
                            </div>
                        </div>

                        <br>

                        <div class="row mb-10">
                            <div class="col-md-12">
                                <button class="btn btn-primary" onclick="EditarDatosPerfil();"><i class="fa fa-fw fa-lg fa-check-circle"></i> Guardar</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

<script>
    var BaseUrl;
    var correoPerfil = true
    BaseUrl = "<?php echo base_url(); ?>";

    function mostrar_imagen_informacion(input) {
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

    function file_pdf(input) {
        var filename = document.getElementById("hoja_vida").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile != "pdf") {

            swal.fire(
                "Mensaje de alerta",
                "Solo se aceptan PDF - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            return document.getElementById("hoja_vida").value = "";
        }

    }
</script>
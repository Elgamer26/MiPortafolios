<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/style.css">

<main class="app-content">

    <div class="app-title">
        <div>
            <h1><i class="fa fa-laptop"></i> Editar proyecto
            </h1>
            <!-- <p>Table to display analytical data effectively</p> -->
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>admin/ListaProyectos">Lista proyecto</a></li>
            <li class="breadcrumb-item">Editar proyecto</li>
        </ul>
    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">

                    <form id="form_registrar_proyecto">

                        <div class="row mb-4 registra_proyecto_class">

                            <input type="hidden" id="productoID" value="<?= esc($proyecto["id"]); ?>">

                            <div class="col-md-8">
                                <label>Nombre</label> <b><label style="color: red;" id="nombre_proyecto_obligg"></label></b>
                                <input type="text" class="form-control" id="nombre_proyecto" value="<?= esc($proyecto["proyecto"]); ?>" maxlength="150" placeholder="nombre del proyecto">
                            </div>

                            <div class="col-md-2">
                                <label>Precio</label> <b><label style="color: red;" id="precio_obligg"></label></b>
                                <input type="text" onkeypress="return filterfloat(event, this);" value="<?= esc($proyecto["precio"]); ?>" class="form-control" id="precio_proyecto" maxlength="8" placeholder="precio del proyecto">
                            </div>

                            <div class="col-md-2">
                                <label>Descuento</label> <b><label style="color: red;" id="descuento_obligg"></label></b>
                                <input type="text" class="form-control" onkeypress="return filterfloat(event, this);" value="<?= esc($proyecto["descuento"]); ?>" value="0" id="descuento_proyecto" maxlength="8" placeholder="descuento del proyecto"><br>
                            </div>

                            <?php
                            $valordes = array("no", "procentaje", "moneda");
                            $textodes = array("Sin descuento", "Porcentaje", "Moneda");
                            ?>

                            <div class="col-md-2">
                                <label>Tipo descuento</label> <b><label style="color: red;" id="tipo_descuento_obligg"></label></b>
                                <select class="form-control select2" id="tipo_descuento" style="width: 100%;">

                                    <?php for ($i = 0; $i < count($valordes); $i++) { ?>
                                        <option value="<?= esc($valordes[$i]); ?>" <?php if ($proyecto["tipo_des"] == $valordes[$i]) {
                                                                                        echo 'selected';
                                                                                    } ?>><?= esc($textodes[$i]); ?></option>
                                    <?php  } ?>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label>Lenguaje</label> <b><label style="color: red;" id="lenguaje_oblig"></label></b>
                                <select class="form-control select2" id="idlenguaje" style="width: 100%;">

                                    <?php if (!empty($lenguaje) && is_array($lenguaje)) {
                                        foreach ($lenguaje as $lenguaje_item) { ?>
                                            <option value="<?= esc($lenguaje_item["id"]); ?>" <?php if ($proyecto["idlenguaje"] == $lenguaje_item["id"]) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?= esc($lenguaje_item["nombre"]); ?></option>
                                        <?php }
                                    } else { ?>
                                        <option value="">No hay lenguaje</option>
                                    <?php }
                                    ?>

                                </select>
                            </div>

                            <div class="col-md-3">
                                <label>Tecnologia</label> <b><label style="color: red;" id="tecnologia_oblig"></label></b>
                                <select class="form-control select2" id="idtecnologia" style="width: 100%;">

                                    <?php if (!empty($tecnologia) && is_array($tecnologia)) {
                                        foreach ($tecnologia as $tecnologia_item) { ?>
                                            <option value="<?= esc($tecnologia_item["id"]); ?>" <?php if ($proyecto["idtecnologia"] == $tecnologia_item["id"]) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?= esc($tecnologia_item["nombre"]); ?></option>
                                        <?php }
                                    } else { ?>
                                        <option value="">No hay tecnologia</option>
                                    <?php }
                                    ?>

                                </select>
                            </div>

                            <div class="col-md-3">
                                <label>Tipo proyecto</label> <b><label style="color: red;" id="tipo_proyecto_obligg"></label></b>
                                <select class="form-control select2" id="id_tipo_proyecto" style="width: 100%;">

                                    <?php if (!empty($tipo) && is_array($tipo)) {
                                        foreach ($tipo as $tipo_item) { ?>
                                            <option value="<?= esc($tipo_item["id"]); ?>" <?php if ($proyecto["id_tipo_proyecto"] == $tipo_item["id"]) {
                                                                                                echo 'selected';
                                                                                            } ?>><?= esc($tipo_item["nombre"]); ?></option>
                                        <?php }
                                    } else { ?>
                                        <option value="">No hay tipo</option>
                                    <?php }
                                    ?>

                                </select>
                            </div>

                            <div class="col-md-2">
                                <label>Fecha creación</label> <b><label style="color: red;" id="fecha_obligg"></label></b>
                                <input type="date" class="form-control" id="fecha_creacion" value="<?= esc($proyecto["fecha_proyecto"]); ?>"><br>
                            </div>

                            <div class="col-md-12">
                                <label>Detalle proyecto</label> <b><label style="color: red;" id="detalle_obligg"></label></b>
                                <textarea class="form-control" id="detalle_proyecto" cols="3" rows="3"><?= esc($proyecto["detalle"]); ?></textarea>
                            </div>

                            <div class="col-md-12">
                                <h3 style="padding: 20px 0; text-align: center;"> Imágenes <b><label style="color: red;" id="foto_ogligg"></label></b></h3>

                                <div class="row">

                                    <?php
                                    foreach ($imagenes as $imagenes_item) { ?>

                                        <div class="col-md-3 text-center" style="padding: 0px 0px 15px 0px;">
                                            <div style="padding: 0px 0px 10px 0px">
                                                <img class="user-img" id="foto_perfil" width="200" height="200" src="<?= base_url() . "public/img/proyectos/" . esc($imagenes_item["foto"]); ?>">
                                            </div>
                                            <a style="color: white;" onclick="QuitarImagenProyect(<?= esc($imagenes_item['id']); ?>, <?= esc($imagenes_item['id_proyecto']); ?>, '<?= ($imagenes_item['foto']); ?>');" class="btn btn-danger"><i class="fa fa-trash"></i> Quitar imagen</a>
                                        </div> 

                                    <?php }  ?>

                                </div>
                                <br>
                            </div>

                            <div class="col-md-12">
                                <div id="wrapper">
                                    <h3 style="padding: 20px 0; text-align: center;">Cargar Imágenes <b><label style="color: red;" id="foto_ogligg"></label></b></h3>
                                    <div id="container-input">
                                        <div class="wrap-file">
                                            <div class="content-icon-camera">
                                                <input type="file" id="file" name="file[]" accept="image/*" multiple />
                                                <div class="icon-camera"></div>
                                            </div>
                                            <div id="preview-images">
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div><br>
                            </div>

                            <div class="col-md-12">
                                <a style="color: white;" class="btn btn-primary" onclick=""><i class="fa fa-fw fa-lg fa-check-circle"></i> Editar</a>
                                -
                                <a style="color: white;" class="btn btn-danger" href="<?php echo base_url(); ?>admin/ListaProyectos"> Volver</a>
                                -
                                <a style="color: white;" class="btn btn-warning" onclick="CrargraImagenPoryecto();"><i class="fa fa-image"></i> Cargar imagen</a>

                            </div>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</main>

<script>
    var BaseUrl;
    BaseUrl = "<?php echo base_url(); ?>";

    ///////////editar datos del proyecto
    function QuitarImagenProyect(id, id_proyecto, foto) {
        Swal.fire({
            title: 'Eliminar imagen de proyecto?',
            text: "La imagen del se proyecto se eliminará!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {

                $(".tile").LoadingOverlay("show", {
                    text: "Cargando...",
                });

                $.ajax({
                    type: "POST",
                    url: BaseUrl + "admin/QuitarImagenProyecto",
                    data: {
                        id: id,
                        id_proyecto: id_proyecto,
                        foto: foto
                    },
                    success: function(response) {
                        $(".tile").LoadingOverlay("hide");
                        if (response == 1) {
                            return Swal.fire({
                                title: 'Imagen eliminada',
                                text: "La imagen del proyecto se elimino con exito",
                                icon: 'success',
                                showCancelButton: false,
                                allowOutsideClick: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            })
                        } else {
                            return swal.fire("Error", "Error al eliminar la imagen del proyecto", "error");
                        }
                    }
                });
            }
        })
    }

    function CrargraImagenPoryecto() {
        var id = document.getElementById("productoID").value;
        let archivo = document.getElementById("file").files.length;

        if (archivo == 0) {
            return swal.fire(
                "Mensaje de advertencia",
                "Ingrese una imagen para actualizar",
                "warning"
            );
        }

        var nombrearchivo = "imagen_producto";
        var formdata = new FormData();

        //este for es para obtener las imagenes del del input file[]
        for (let i = 0; i < archivo; i++) {
            var img = document.getElementById("file").files[i];
            formdata.append("img_extra[" + i + "]", img);
        }

        formdata.append("id", id);
        formdata.append("nombrearchivo", nombrearchivo);

        $(".card").LoadingOverlay("show", {
            text: "Cargando...",
        });

        $.ajax({
            url: BaseUrl + "Admin/EditarFotoProducto",
            type: "POST",
            //aqui envio toda la formdata
            data: formdata,
            contentType: false,
            processData: false,
            success: function(resp) {
                $(".card").LoadingOverlay("hide");
                if (resp > 0) {
                    if (resp == 1) {
                        Swal.fire({
                            title: "",
                            text: "Foto del producto se edito con exito",
                            icon: "success",
                            showCancelButton: true,
                            showCancelButton: false,
                            allowOutsideClick: false,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Ok",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    } else if (resp == 2) {
                        return swal.fire(
                            "Mensaje de advertencia",
                            "Ingrese una imagen para actualizar",
                            "warning"
                        );
                    }
                } else {
                    return swal.fire("Error", "Error en la Matrix" + resp, "error");
                }
            },
        });
        return false;
    }
</script>
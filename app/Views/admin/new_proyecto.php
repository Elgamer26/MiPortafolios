<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/style.css">

<main class="app-content">

    <div class="app-title">
        <div>
            <h1><i class="fa fa-laptop"></i> Nuevo proyecto
            </h1>
            <!-- <p>Table to display analytical data effectively</p> -->
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
            <li class="breadcrumb-item">Proyecto</li>
        </ul>
    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">

                    <form id="form_registrar_proyecto">

                        <div class="row mb-4 registra_proyecto_class">

                            <div class="col-md-8">
                                <label>Nombre</label> <b><label style="color: red;" id="nombre_proyecto_obligg"></label></b>
                                <input type="text" class="form-control" id="nombre_proyecto" maxlength="150" placeholder="nombre del proyecto">
                            </div>

                            <div class="col-md-2">
                                <label>Precio</label> <b><label style="color: red;" id="precio_obligg"></label></b>
                                <input type="text" onkeypress="return filterfloat(event, this);" class="form-control" id="precio_proyecto" maxlength="8" placeholder="precio del proyecto">
                            </div>

                            <div class="col-md-2">
                                <label>Descuento</label> <b><label style="color: red;" id="descuento_obligg"></label></b>
                                <input type="text" class="form-control" onkeypress="return filterfloat(event, this);" value="0" id="descuento_proyecto" maxlength="8" placeholder="descuento del proyecto"><br>
                            </div>

                            <div class="col-md-2">
                                <label>Tipo descuento</label> <b><label style="color: red;" id="tipo_descuento_obligg"></label></b>
                                <select class="form-control select2" id="tipo_descuento" style="width: 100%;">
                                    <option value="no">Sin descuento</option>
                                    <option value="procentaje">Porcentaje</option>
                                    <option value="moneda">Moneda</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label>Lenguaje</label> <b><label style="color: red;" id="lenguaje_oblig"></label></b>
                                <select class="form-control select2" id="idlenguaje" style="width: 100%;">

                                    <?php if (!empty($lenguaje) && is_array($lenguaje)) {
                                        foreach ($lenguaje as $lenguaje_item) { ?>
                                            <option value="<?= esc($lenguaje_item["id"]); ?>"><?= esc($lenguaje_item["nombre"]); ?></option>
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
                                            <option value="<?= esc($tecnologia_item["id"]); ?>"><?= esc($tecnologia_item["nombre"]); ?></option>
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
                                            <option value="<?= esc($tipo_item["id"]); ?>"><?= esc($tipo_item["nombre"]); ?></option>
                                        <?php }
                                    } else { ?>
                                        <option value="">No hay tipo</option>
                                    <?php }
                                    ?>

                                </select>
                            </div>

                            <div class="col-md-2">
                                <label>Fecha creación</label> <b><label style="color: red;" id="fecha_obligg"></label></b>
                                <input type="date" class="form-control" id="fecha_creacion"><br>
                            </div>

                            <div class="col-md-12">
                                <label>Detalle proyecto</label> <b><label style="color: red;" id="detalle_obligg"></label></b>
                                <textarea class="form-control" id="detalle_proyecto" cols="3" rows="3"></textarea>
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
                                        <!-- <button id="publish">Publicar</button> -->
                                    </div>
                                    <!-- <h2 id="success"></h2> -->
                                </div><br>
                            </div>

                            <div class="col-md-12">
                                <a style="color: white;" class="btn btn-primary" onclick="Registra_Proyecto();"><i class="fa fa-fw fa-lg fa-check-circle"></i> Guardar</a>
                                -
                                <a style="color: white;" class="btn btn-danger" onclick="location.reload();"><i class="fa fa-trash"></i> Limpiar</a>
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
</script>
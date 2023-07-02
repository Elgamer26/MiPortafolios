<main class="app-content">

    <div class="app-title">
        <div>
            <h1><i class="fa fa-laptop"></i> Lista de proyectos
            </h1>
            <!-- <p>Table to display analytical data effectively</p> -->
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
            <li class="breadcrumb-item">Proyectos</li>
        </ul>
    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <h6><i class="fa fa-list"></i> Lista de proyectos </h6>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center" id="TablaProyectos">
                            <thead>
                                <tr>
                                    <th>Opcion</th>
                                    <th>Estado</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Descuento</th>
                                    <th>Tipo desc.</th>
                                    <th>Lenguaje</th>
                                    <th>Tecnologia</th>
                                    <th>Tipo proyecto</th>
                                    <th>Fecha registro</th>
                                    <th>Fecha proyecto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($lista) && is_array($lista)) {
                                    foreach ($lista as $lista_item) { ?>
                                        <tr>
                                            <th>
                                                <a style="color: white;" href="<?php echo base_url(); ?>admin/EditarProyecto/<?= esc($lista_item["id"]); ?>" class='editar btn btn-primary btn-sm' title='Editar el proyecto'><i class='fa fa-edit'></i></a>
                                            </th>
                                            <td>
                                                <?php if ($lista_item["estado"] == 1) { ?>
                                                    <span class="badge badge-success">Activo</span>
                                                <?php } else {  ?>
                                                    <span class="badge badge-danger">Inactivo</span>
                                                <?php } ?>
                                            </td>
                                            <td><?= esc($lista_item["proyecto"]); ?></td>
                                            <td>$ <?= esc($lista_item["precio"]); ?></td>
                                            <td>$ <?= esc($lista_item["descuento"]); ?></td>
                                            <th><?= esc($lista_item["tipo_des"]); ?></th>
                                            <td><?= esc($lista_item["lenguaje"]); ?></td>
                                            <td><?= esc($lista_item["tecnologia"]); ?></td>
                                            <td><?= esc($lista_item["tipo_proyecto"]); ?></td>
                                            <td><?= esc($lista_item["fecha_registro"]); ?></td>
                                            <td><?= esc($lista_item["fecha_proyecto"]); ?></td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <th></th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th></th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>

</main>

<script>
    var BaseUrl;
    BaseUrl = "<?php echo base_url(); ?>";
</script>
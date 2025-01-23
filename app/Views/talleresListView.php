<?php include("templates/parte1.php"); ?>
<div class="row">
    <div class="col-12">

        <!-- SELECT `id`, `id_distribuidores`, `provincias`, `id_localidades`, `direccion`, `numero`, `cp`, `created_at`, `updated_at` FROM `talleres` WHERE 1-->


        <table class="table datatable" id="tabla">
            <thead>
                <tr>
                    <th>Id distribuidores</th>
                    <th>Provincias</th>
                    <th>Id localidades</th>
                    <th>Direccion</th>
                    <th>Numero</th>
                    <th>Codigo Postal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php

                if ($talleres > 0) {
                    foreach ($talleres as $r) {
                ?>
                        <tr>
                            <td><?php echo $r["id_distribuidores"]; ?></td>
                            <td><?php echo $r["provincias"]; ?></td>
                            <td><?php echo $r["id_localidades"]; ?></td>
                            <td><?php echo $r["direccion"]; ?></td>
                            <td><?php echo $r["numero"]; ?></td>
                            <td><?php echo $r["cp"]; ?></td>
                                                  
                            <td><a href="<?php echo baseUrl(); ?>/talleres/editar?id=<?php echo $r["id"]; ?>"><i class="fa-solid fa-pen-to-square fa-2x"></i></a>
                                &nbsp;&nbsp;
                                <a href="<?php echo baseUrl(); ?>/talleres/eliminar?id=<?php echo $r["id"]; ?>" data-id="<?php echo $r["id"]; ?>" class="borrar"><i class="fa-solid fa-trash text-danger"></i>
                                    <a href="modulo_localidades_print.php?id=<?php echo $r["id"]; ?>"><i
                                            class="fa-solid fa-print"></i></a>
                                    &nbsp;&nbsp;
                                </a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
            <tfooter>
            <th>Id distribuidores</th>
                    <th>Provincias</th>
                    <th>Id localidades</th>
                    <th>Direccion</th>
                    <th>Numero</th>
                    <th>Codigo Postal</th>
                    <th>Acciones</th>
                </tr>
            </tfooter>
        </table>

    </div>
</div>
<?php include("templates/parte2.php"); ?>
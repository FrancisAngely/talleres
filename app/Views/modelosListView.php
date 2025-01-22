<?php include("templates/parte1.php"); ?>
<div class="row">
    <div class="col-12">

        <!-- SELECT `id`, `modelo`, `descripcion`, `precio`, `foto`, `created_at`, `updated_at` FROM `modelos` WHERE 1-->


        <table class="table datatable" id="tabla">
            <thead>
                <tr>
                    <th>Modelo</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Foto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php

                if ($modelos > 0) {
                    foreach ($modelos as $r) {
                ?>
                        <tr>
                            <td><?php echo $r["modelo"]; ?></td>
                            <td><?php echo $r["descripcion"]; ?></td>
                            <td><?php echo $r["precio"]; ?></td>
                            <td><img src="<?php echo baseUrl(); ?>/uploads/<?php echo $r["foto"]; ?>" alt="" width="100"></td>
                           
                            <td><a href="<?php echo baseUrl(); ?>/modelos/editar?id=<?php echo $r["id"]; ?>"><i class="fa-solid fa-pen-to-square fa-2x"></i></a>
                                &nbsp;&nbsp;
                                <a href="<?php echo baseUrl(); ?>/modelos/eliminar?id=<?php echo $r["id"]; ?>" data-id="<?php echo $r["id"]; ?>" class="borrar"><i class="fa-solid fa-trash text-danger"></i>
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
                <th>Modelo</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Foto</th>
                <th>Acciones</th>
                </tr>
            </tfooter>
        </table>

    </div>
</div>
<?php include("templates/parte2.php"); ?>
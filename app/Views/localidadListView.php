<?php include("templates/parte1.php"); ?>
<div class="row">
    <div class="col-12">


        <table class="table datatable" id="tabla">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Cmun</th>
                    <th>DC</th>
                    <th>Localidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php

                if ($localidades > 0) {
                    foreach ($localidades as $r) {
                ?>
                        <tr>
                            <td><?php echo $r["id"]; ?></td>
                            <td><?php echo $r["cmun"]; ?></td>
                            <td><?php echo $r["dc"]; ?></td>
                            <td><?php echo $r["localidad"]; ?></td>

                            <td><a href="<?php echo baseUrl(); ?>/localidades/editar?id=<?php echo $r["id"]; ?>"><i class="fa-solid fa-pen-to-square fa-2x"></i></a>
                                &nbsp;&nbsp;
                                <a href="<?php echo baseUrl(); ?>/localidades/eliminar?id=<?php echo $r["id"]; ?>" data-id="<?php echo $r["id"]; ?>" class="borrar"><i class="fa-solid fa-trash text-danger"></i>
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
                <th>Id</th>
                <th>Cmun</th>
                <th>DC</th>
                <th>Localidad</th>
                <th>Acciones</th>
                </tr>
            </tfooter>
        </table>

    </div>
</div>
<?php include("templates/parte2.php"); ?>
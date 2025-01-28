<?php include("templates/parte1.php"); ?>
<div class="row">
    <div class="col-12">


        <table class="table datatable" id="tabla">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Razon Social</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>CIF-NIF-NIE</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php

                if ($distribuidores > 0) {
                    foreach ($distribuidores as $r) {
                ?>
                        <tr>
                            <td><?php echo $r["id"]; ?></td>
                            <td><?php echo $r["razon_social"]; ?></td>
                            <td><?php echo $r["nombre"]; ?></td>
                            <td><?php echo $r["apellidos"]; ?></td>
                            <td><?php echo $r["cif_nif_nie"]; ?></td>

                            <td><a href="<?php echo baseUrl(); ?>/distribuidores/editar?id=<?php echo $r["id"]; ?>"><i
                                        class="fa-solid fa-pen-to-square fa-2x"></i></a>
                                &nbsp;&nbsp;
                                <a href="<?php echo baseUrl(); ?>/distribuidores/eliminar?id=<?php echo $r["id"]; ?>"
                                    data-id="<?php echo $r["id"]; ?>" class="borrar"><i
                                        class="fa-solid fa-trash text-danger"></i>

                            <td><a href="<?php echo baseUrl(); ?>/distribuidores/imprimir?id=<?php echo $r["id"]; ?>"><i
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
                <th>Razon Social</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>CIF-NIF-NIE</th>
                <th>Acciones</th>
                </tr>
            </tfooter>
        </table>

    </div>
</div>
<?php include("templates/parte2.php"); ?>
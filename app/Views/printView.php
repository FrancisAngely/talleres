<?php

include("files_dompdf/config.php");

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include("files_dompdf/style.php"); ?>
</head>

<body>

    <table class="paginaA4" cellspacing=0 cellpadding=0>
        <?php include("files_dompdf/cabecera.php"); ?>

        <tr class="contenido">
            <td class="contenedor">
                <!-- ficha -->
                <table class="ficha" cellspacing=0 cellpadding=0>
                    <tr>
                        <td>
                            <div class="invoice">
                                <div class="invoice-header">
                                    <h1>Ficha de Factura</h1>
                                    <p>Documento generado automáticamente</p>
                                </div>

                                <div class="invoice-details">
                                    <table>

                                        <tr>
                                            <th>Campo</th>
                                            <br>
                                            <th>Detalle</th>
                                        </tr>
                                        <h1>Talleres</h1>
                                        <tr>
                                            <td>Id Distribuidores</td>
                                            <td><?= $talleres["id_distribuidores"]; ?></td>
                                        </tr>
                                        <hr>
                                        <tr>
                                            <td>Provincias</td>
                                            <td><?= $talleres["provincias"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Id localidades</td>
                                            <td><?= $talleres["id_localidades"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Direccion</td>
                                            <td><?= $talleres["direccion"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Numero</td>
                                            <td><?= $talleres["numero"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td>CP</td>
                                            <td><?= $talleres["cp"]; ?></td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="footer">
                                    <p>&copy; 2025 - Todos los derechos reservados</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>


            </td>
        </tr>
        <?php include("files_dompdf/pie.php"); ?>
    </table>


</body>

</html>
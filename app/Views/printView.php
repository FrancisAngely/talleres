<?php
include("files_dompdf/config.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include("files_dompdf/style.php"); ?>
    <style>
    /* Estilo para la ficha */
    .ficha {
        margin-top: 10pt;
        margin-left: 10pt;
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        /* Establece ancho fijo para las columnas */
    }

    .ficha th,
    .ficha td {
        font-size: 12pt;
        /* Reducir tamaño de fuente */
        padding: 6pt;
        /* Reducir espacio interno de las celdas */
        border: 1px solid #d2d2d2;
        text-align: left;
        word-wrap: break-word;
        white-space: nowrap;
        /* Evitar que las palabras se partan */
    }

    .ficha th {
        background-color: #d2d2d2;
        font-weight: 300;
    }

    /* Estilo para el título de la página */
    h1 {
        font-size: 20pt;
        text-align: center;
        margin-bottom: 20px;
    }

    /* Estilo para la tabla principal */
    .paginaA4 {
        width: 100%;
        margin: 0 auto;
        border: none;
        page-break-before: always;
        /* Evitar mezcla con el pie */
    }

    .contenido {
        padding: 10px;
        overflow: hidden;
        /* Evitar que el contenido se desborde */
    }

    .contenedor {
        page-break-inside: avoid;
        /* Evitar que el contenedor se divida entre páginas */
    }

    /* Estilos para el pie de página */
    .footer {
        page-break-before: always;
        position: fixed;
        bottom: 0;
        width: 100%;
        text-align: center;
        font-size: 12pt;
        padding: 10pt 0;
    }

    /* Ajuste para pantallas pequeñas (en dispositivos móviles) */
    @media screen and (max-width: 768px) {
        .ficha {
            font-size: 10pt;
            /* Reducir aún más el tamaño de fuente */
        }

        .ficha th,
        .ficha td {
            padding: 4pt;
            /* Reducir el padding para ahorrar espacio */
        }
    }
    </style>
</head>

<body>

    <table class="paginaA4" cellspacing="0" cellpadding="0">
        <?php include("files_dompdf/cabecera.php"); ?>

        <tr class="contenido">
            <td class="contenedor">
                <!-- ficha -->
                <table class="ficha" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>ID Distribuidor</th>
                            <th>Razón Social</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>CIF/NIF/NIE</th>
                            <th>Provincia</th>
                            <th>Localidad</th>
                            <th>Dirección</th>
                            <th>Número</th>
                            <th>Código Postal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($distribuidoresConTalleres as $row): ?>
                        <tr>
                            <td><?= $row['distribuidor_id'] ?></td>
                            <td><?= $row['razon_social'] ?></td>
                            <td><?= $row['nombre'] ?></td>
                            <td><?= $row['apellidos'] ?></td>
                            <td><?= $row['cif_nif_nie'] ?></td>
                            <td><?= $row['provincias'] ?></td>
                            <td><?= $row['id_localidades'] ?></td>
                            <td><?= $row['direccion'] ?></td>
                            <td><?= $row['numero'] ?></td>
                            <td><?= $row['cp'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </td>
        </tr>

        <?php include("files_dompdf/pie.php"); ?>
    </table>

</body>

</html>
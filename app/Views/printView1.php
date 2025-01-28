<?php
include("files_dompdf/config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("files_dompdf/style.php"); ?>
    <title>Ficha de Distribuidor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .ficha {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .invoice-header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .invoice-header h1 {
            margin: 0;
        }

        .invoice-section {
            margin-bottom: 20px;
        }

        .invoice-section h2 {
            color: #007bff;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
        }

        .invoice-details {
            display: flex;
            flex-wrap: wrap;
        }

        .invoice-details .detail {
            width: 50%;
            padding: 10px;
            box-sizing: border-box;
        }

        .invoice-details .detail label {
            font-weight: bold;
            display: block;
        }

        .invoice-details .detail p {
            margin: 5px 0 0 0;
        }
    </style>
</head>

<body>
    <div class="ficha">
        <div class="invoice-header">
            <h1>Ficha de Distribuidor</h1>
            <p>Documento generado automáticamente</p>
        </div>

        <div class="invoice-section">
            <h2>Distribuidor</h2>
            <div class="invoice-details">
                <div class="detail">
                    <label>Id Distribuidor</label>
                    <p><?= $talleres["id_distribuidores"]; ?></p>
                </div>
                <div class="detail">
                    <label>Nombre del Distribuidor</label>
                    <p><?= $distribuidorNombre; ?></p>
                </div>
                <div class="detail">
                    <label>Apellido del Distribuidor</label>
                    <p><?= $distribuidorApellido; ?></p>
                </div>
                <div class="detail">
                    <label>Razón Social del Distribuidor</label>
                    <p><?= $distribuidorRazonSocial; ?></p>
                </div>
            </div>
        </div>

        <div class="invoice-section">
            <h2>Talleres</h2>
            <div class="invoice-details">
                <div class="detail">
                    <label>Número de Talleres</label>
                    <p><?= $numTalleres; ?></p>
                </div>
                <div class="detail">
                    <label>Provincias</label>
                    <p><?= $talleres["provincias"]; ?></p>
                </div>
                <div class="detail">
                    <label>Id localidades</label>
                    <p><?= $talleres["id_localidades"]; ?></p>
                </div>
                <div class="detail">
                    <label>Direccion</label>
                    <p><?= $talleres["direccion"]; ?></p>
                </div>
                <div class="detail">
                    <label>Numero</label>
                    <p><?= $talleres["numero"]; ?></p>
                </div>
                <div class="detail">
                    <label>CP</label>
                    <p><?= $talleres["cp"]; ?></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
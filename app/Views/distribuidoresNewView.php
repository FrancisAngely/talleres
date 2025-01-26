<?php include("templates/parte1.php"); ?>
<div class="row">
    <div class="col-12">
        <?= validation_list_errors();
        $errors = validation_errors();
        ?>
<!-- SELECT `id`, `razon_social`, `nombre`, `apellidos`, `cif_nif_nie`, `created_at`, `updated_at` FROM `distribuidores` WHERE 1  -->
        <form action="<?php echo baseUrl(); ?>/distribuidores/crear" method="post" enctype="multipart/form-data" id="form1">

            <div class="mb-3">
                <label for="razon_social" class="form-label">Razon Social</label>
                <span id="razon_social_error" class="text-danger"></span>
                <input type="text" class="form-control" id="razon_social" name="razon_social" placeholder="Razon Social">
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <span id="nombre_error" class="text-danger"></span>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
            </div>

            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <span id="apellidos_error" class="text-danger"></span>
                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos">
            </div>

            <div class="mb-3">
                <label for="cif_nif_nie" class="form-label">CIF-NIF-NIE</label>
                <span id="cif_nif_nie_error" class="text-danger"></span>
                <input type="text" class="form-control" id="cif_nif_nie" name="cif_nif_nie" placeholder="CIF-NIF-NIE">

            <div class="mb-3">
                <input type="submit" class="form-control" value="Aceptar" id="btnform11">
            </div>

        </form>

    </div>
</div>
<?php include("templates/parte2.php"); ?>
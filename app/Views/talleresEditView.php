<?php include("templates/parte1.php"); ?>
<div class="row">
    <div class="col-12">
        <?= validation_list_errors();
        $errors = validation_errors();
        ?>
        <!-- SELECT `id`, `id_distribuidores`, `provincias`, `id_localidades`, `direccion`, `numero`, `cp`, `created_at`, `updated_at` FROM `talleres` WHERE 1-->

        <form action="<?php echo baseUrl(); ?>/talleres/actualizar" method="post" enctype="multipart/form-data" id="form1">

            <input type="hidden" class="form-control" id="id" name="id" value="<?= $datos["id"]; ?>">

            <!--Nuevo Codigo-->
            <div class="mb-3">
                <label for="id_distribuidores" class="form-label">Id distribuidores</label>
                <span id="id_distribuidores_error" class="text-danger"></span>
                <input type="text" class="form-control" id="id_distribuidores" name="id_distribuidores" placeholder="Id distribuidores"  value="<?= $datos["id_distribuidores"]; ?>">
            </div>
            <div class="mb-3">
                <label for="provincias" class="form-label">Provincias</label>
                <span id="provincias_error" class="text-danger"></span>
                <input type="text" class="form-control" id="provincias" name="provincias" placeholder="Provincias"  value="<?= $datos["provincias"]; ?>">
            </div>

            <div class="mb-3">
                <label for="id_localidades" class="form-label">Id localidad</label>
                <span id="id_localidades_error" class="text-danger"></span>
                <input type="number" class="form-control" id="id_localidades" name="id_localidades" placeholder="Id localidad" value="<?= $datos["id_localidades"]; ?>">
            </div>

            <div class="mb-3">
                <label for="direccion" class="form-label">direccion</label>
                <span id="direccion_error" class="text-danger"></span>
                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion" value="<?= $datos["direccion"]; ?>">
            </div>

            <div class="mb-3">
                <label for="numero" class="form-label">Numero</label>
                <span id="numero_error" class="text-danger"></span>
                <input type="number" class="form-control" id="numero" name="numero" placeholder="Numero" value="<?= $datos["numero"]; ?>">
            </div>

            <div class="mb-3">
                <label for="cp" class="form-label">cp</label>
                <span id="cp_error" class="text-danger"></span>
                <input type="text" class="form-control" id="cp" name="cp" placeholder="Codigo postal" value="<?= $datos["cp"]; ?>">
            </div>

            <div class="mb-3">
                <input type="submit" class="form-control" value="Aceptar" id="btnform11">
            </div>

        </form>

    </div>
</div>
<?php include("templates/parte2.php"); ?>
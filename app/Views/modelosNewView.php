<?php include("templates/parte1.php"); ?>
<div class="row">
    <div class="col-12">
        <?= validation_list_errors();
        $errors = validation_errors();
        ?>
        <!-- SELECT `id`, `modelo`, `descripcion`, `precio`, `foto`, `created_at`, `updated_at` FROM `modelos` WHERE 1-->
        <form action="<?php echo baseUrl(); ?>/modelos/crear" method="post" enctype="multipart/form-data" id="form1">

            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <span id="modelo_error" class="text-danger"></span>
                <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Modelo">
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">descripcion</label>
                <span id="descripcion_error" class="text-danger"></span>
                <textarea name="descripcion" rows="10" cols="50"></textarea>
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">precio</label>
                <span id="precio_error" class="text-danger"></span>
                <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio">
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <span id="foto_error" class="text-danger"></span>
                <input type="file" class="form-control" id="foto" name="foto">
            </div>

            <div class="mb-3">
                <input type="submit" class="form-control" value="Aceptar" id="btnform11">
            </div>

        </form>

    </div>
</div>
<?php include("templates/parte2.php"); ?>
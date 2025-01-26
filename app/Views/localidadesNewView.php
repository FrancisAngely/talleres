<?php include("templates/parte1.php"); ?>
<div class="row">
    <div class="col-12">
        <?= validation_list_errors();
        $errors = validation_errors();
        ?>

        <form action="<?php echo baseUrl(); ?>/localidades/crear" method="post" enctype="multipart/form-data" id="form1">

            <div class="mb-3">
                <label for="id_provincias" class="form-label">Id provincia</label>
                <span id="id_provincias_error" class="text-danger"></span>
                <input type="number" class="form-control" id="id_provincias" name="id_provincias"
                    placeholder="id_provincias">
            </div>
            <div class="mb-3">
                <label for="cmun" class="form-label">Cmun</label>
                <span id="cmun_error" class="text-danger"></span>
                <input type="number" class="form-control" id="cmun" name="cmun" placeholder="cmun">
            </div>

            <div class="mb-3">
                <label for="dc" class="form-label">DC</label>
                <span id="dc_error" class="text-danger"></span>
                <input type="number" class="form-control" id="dc" name="dc" placeholder="dc">
            </div>

            <div class="mb-3">
                <label for="localidad" class="form-label">Localidad</label>
                <span id="localidad_error" class="text-danger"></span>
                <input type="text" class="form-control" id="localidad" name="localidad" placeholder="localidad">

            <div class="mb-3">
                <input type="submit" class="form-control" value="Aceptar" id="btnform11">
            </div>

        </form>

    </div>
</div>
<?php include("templates/parte2.php"); ?>
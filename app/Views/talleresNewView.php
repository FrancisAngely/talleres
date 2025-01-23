<?php include("templates/parte1.php"); ?>
<div class="row">
    <div class="col-12">
        <?= validation_list_errors();
        $errors = validation_errors();
        ?>
        <!-- SELECT `id`, `id_distribuidores`, `provincias`, `id_localidades`, `direccion`, `numero`, `cp`, `created_at`, `updated_at` FROM `talleres` WHERE 1-->
        <form action="<?php echo baseUrl(); ?>/talleres/crear" method="post" enctype="multipart/form-data" id="form1">

            <div class="mb-3">
                <label for="id_distribuidores" class="form-label">Id distribuidores</label>
                <span id="id_distribuidores_error" class="text-danger"></span>
                <input type="text" class="form-control" id="id_distribuidores" name="id_distribuidores" placeholder="Id distribuidores">
            </div>

            <div class="mb-3">
                <label for="provincia" class="form-label">Provincias</label>
                <?php echo form_dropdown('provincias', $optionsProvincias, set_value('provincias'), 'class="form-control" id="provincias" '); ?>
                <?php
                if (isset($errors["provincias"])) echo validation_show_error('provincias');
                ?>
            </div>

            <!-- <div class="mb-3">
                <label for="id_localidades" class="form-label">Id localidad</label>
                <span id="id_localidades_error" class="text-danger"></span>
                <input type="number" class="form-control" id="id_localidades" name="id_localidades" placeholder="Id localidad">

            </div> -->

            <div class="mb-3">
                <label for="id_localidades" class="form-label">Localidades</label>
                <?php echo form_dropdown('id_localidades', $optionsLocalidades, set_value('id_localidades'), 'class="form-control" id="id_localidades" '); ?>
                <?php
                if (isset($errors["id_localidades"])) echo validation_show_error('id_localidades');
                ?>
            </div>

            <div class="mb-3">
                <label for="direccion" class="form-label">direccion</label>
                <span id="direccion_error" class="text-danger"></span>
                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion">
            </div>

            <div class="mb-3">
                <label for="numero" class="form-label">Numero</label>
                <span id="numero_error" class="text-danger"></span>
                <input type="number" class="form-control" id="numero" name="numero" placeholder="Numero">
            </div>

            <div class="mb-3">
                <label for="cp" class="form-label">cp</label>
                <span id="cp_error" class="text-danger"></span>
                <input type="text" class="form-control" id="cp" name="cp" placeholder="Codigo postal">
            </div>

            <div class="mb-3">
                <input type="submit" class="form-control" value="Aceptar" id="btnform11">
            </div>

        </form>

    </div>
</div>
<?php include("templates/parte2.php"); ?>
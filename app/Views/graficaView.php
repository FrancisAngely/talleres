<?php include("templates/parte1.php"); ?>
<div class="row">
    <div class="col-12">
        <?= validation_list_errors();
        $errors = validation_errors();

        ?>
        <div class="col-lg-6 mt-2">
            <canvas id="id1"></canvas>
        </div>
    </div>
    <?php include("templates/parte2.php"); ?>

    <script>
    var ctx = document.getElementById('id1').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?= $xValues ?>],
            datasets: [{
                label: 'Número de Talleres por Distribuidor',
                data: [<?= $yValues ?>],
                backgroundColor: [<?= $colores ?>]
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    </script>
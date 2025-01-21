
<?php var_dump($datos);?>
<div id="<?= $idGrafLine;?>" style="max-width:700px; height:400px"></div>

        
    <script src="https://www.gstatic.com/charts/loader.js"></script>
<script>
function drawChart() {
// Set Data
const data = google.visualization.arrayToDataTable([
  <?= $datos;?>
  ]);
// Set Options
const options = {
  title: 'House Prices vs Size',
  hAxis: {title: 'Square Meters'},
  vAxis: {title: 'Price in Millions'},
  legend: 'none'
};
// Draw Chart
const chart = new google.visualization.LineChart(document.getElementById('<?= $idGrafLine;?>'));
chart.draw(data, options);
}
 google.charts.load('current',{packages:['corechart']});

google.charts.setOnLoadCallback(drawChart);


</script>
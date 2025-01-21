

<div id="<?= $idGrafBarra2;?>" style="height: 320px;"></div>

  

<!-- Vendor js -->
<script src="<?php echo baseUrl();?>/assets/js/vendor.min.js"></script>

<!-- Sparkline charts -->
<script src="<?php echo baseUrl();?>/assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>

<script>

$(document).ready(function () {
   
            $("#<?= $idGrafBarra2;?>").sparkline([<?= $datos;?>], {
                type: "bar",
                height: "165",
                barWidth: "10",
                barSpacing: "3",
                barColor: "#26a69a"
            });
       
       
});

</script>
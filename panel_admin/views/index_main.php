<html>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Institución', 'Investigadores'],
                <?php foreach($datosGrafica as $datos):?>
                ['<?php echo $datos['institucion']; ?>', <?php echo $datos['cantidad_investigadores'];?>]
                <?php endforeach;?>
            ]);

            var options = {
                title: 'Instituciones de la Red',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
    </script>
</head>

<body>
    <h1>Bienvenido al Sistema</h1>
    <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
</body>
</html>
<?php
 $con = mysqli_connect('webinfo.iutmontp.univ-montp2.fr','sornayj','<wxcvbn,;:!123','sornayj');
?>
<!DOCTYPE HTML>
<html>
<head>
 <meta charset="utf-8">
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawChart);
 function drawChart() {
 var data = google.visualization.arrayToDataTable([

       ['time', 'temperature', 'loudness'],
       <?php 
      			$query = "SELECT tmp.time, temperature, loudness FROM Ap_Temperature tmp JOIN Ap_LoudnessSensor ls ON tmp.time = ls.time  ORDER BY time ASC LIMIT 25";

      			 $exec = mysqli_query($con, $query);
             while($row = mysqli_fetch_array($exec)){
           
             echo "['". $row['time'] .", ', ".$row['temperature'].", " . $row['loudness'] . "],";

             }
       ?> 

 
 ]);

 var options = {
          title: 'Evolution de la température',
          curveType: 'none',
          legend: { position: 'bottom' },
          backgroundColor: { fill:'transparent' },
          series: {
          0: {targetAxisIndex: 0},
          1: {targetAxisIndex: 1}
          },
          vAxes: {
          0: {title: 'temperature'},
          1: {title: 'loudness'}

        },

          

 };
 var chart = new google.visualization.ComboChart(document.getElementById("linechartTemp"));
 chart.draw(data,options);
 }
	
    </script>


</head>
<body>
 <div class="container-fluid">
 <div id="linechartTemp" style="width: 100%; height: 500px;"></div>
 </div>

</body>
</html>

<!--"['".$row['time']."',".$row['temperature']."],";
"['" . $row['var1'] . "', '" . $row['var2'] . "'," . $row['var3'] . "],"; -->
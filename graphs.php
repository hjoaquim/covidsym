<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

   $DATABASE_HOST = 'localhost';
   $DATABASE_USER = 'root';
   $DATABASE_PASS = '';
   $DATABASE_NAME = 'sim';
   // Try and connect using the info above.
   $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME) or die('Failed to connect to MySQL: ' . mysqli_error($connect));
   
   $query = "SELECT count(*) FROM diag_diagnostico where gender=0 and `Corona result`=0";
   $result_males0 = @mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));

   $query = "SELECT count(*)  FROM diag_diagnostico where gender=0 and `Corona result`=1";
   $result_males1 = @mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));

   $query = "SELECT count(*)  FROM diag_diagnostico where gender=0 and `Corona result`=2";
   $result_males2 = @mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));

   $query = "SELECT count(*)  FROM diag_diagnostico where gender=1 and `Corona result`=0";
   $result_females0 = @mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));

   $query = "SELECT count(*)  FROM diag_diagnostico where gender=1 and `Corona result`=1";
   $result_females1 = @mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));

   $query = "SELECT count(*)  FROM diag_diagnostico where gender=1 and `Corona result`=2";
   $result_females2 = @mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));


   $males0 = mysqli_fetch_row($result_males0)[0];
   $males1 = mysqli_fetch_row($result_males1)[0];
   $males2 = mysqli_fetch_row($result_males2)[0];

   $females0 = mysqli_fetch_row($result_females0)[0];
   $females1 = mysqli_fetch_row($result_females1)[0];
   $females2 = mysqli_fetch_row($result_females2)[0];

   $query = "SELECT count(*)  FROM diag_diagnostico";
   $result_n_cases = @mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
   $number_of_cases = mysqli_fetch_row($result_n_cases)[0];

   $query = "SELECT count(*)  FROM diag_diagnostico where age<40 and `Corona result`=0";
   $result_age = @mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
   $age1_0 = mysqli_fetch_row($result_age)[0];
   
   $query = "SELECT count(*)  FROM diag_diagnostico where age<40 and `Corona result`=1";
   $result_age = @mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
   $age1_1 = mysqli_fetch_row($result_age)[0];
   
   $query = "SELECT count(*)  FROM diag_diagnostico where age<40 and `Corona result`=2";
   $result_age = @mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
   $age1_2 = mysqli_fetch_row($result_age)[0];

   $query = "SELECT count(*)  FROM diag_diagnostico where age>40 and `Corona result`=0";
   $result_age = @mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
   $age2_0 = mysqli_fetch_row($result_age)[0];
   
   $query = "SELECT count(*)  FROM diag_diagnostico where age>40 and `Corona result`=1";
   $result_age = @mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
   $age2_1 = mysqli_fetch_row($result_age)[0];
   
   $query = "SELECT count(*)  FROM diag_diagnostico where age>40 and `Corona result`=2";
   $result_age = @mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
   $age2_2 = mysqli_fetch_row($result_age)[0];


$dataPoints = array( 
	array("label"=>"Risk 0, <40", "y"=>$age1_0/$number_of_cases),
	array("label"=>"Risk 1, <40", "y"=>$age1_1/$number_of_cases),
	array("label"=>"Risk 2, <40", "y"=>$age1_2/$number_of_cases),
	array("label"=>"Risk 0, >40", "y"=>$age2_0/$number_of_cases),
	array("label"=>"Risk 1, >40", "y"=>$age2_1/$number_of_cases),
	array("label"=>"Risk 2, >40", "y"=>$age2_2/$number_of_cases)
)


 
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Risk distribution"
	},
	subtitles: [{
		text: "Above and below age 40"
	}],
	data: [{
		type: "pie",
		yValueFormatString: "#,##0.00\"%\"",
		indexLabel: "{label} ({y})",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<?php include_once 'header.php';?>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
<?php
    include_once 'footer.php';
?>
</html>        
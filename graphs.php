<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['loggedin'], $_SESSION['usr_type']) && $_SESSION['usr_type']!=2) {
        header('Location: index.php');
        exit;
    }

    include_once 'header.php';
    echo('
    <section class="ftco-section">
    <div class="container">
    <div class="row d-md-flex">
    ');

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

    $query = "SELECT age as AGE,`Corona result` as MEDICAL_DECISION  FROM diag_diagnostico";
    $result_age = @mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
    $age_rows = mysqli_fetch_all($result_age);

    //creates an empty sized 10 array
    $age_gap = array_fill(0, 11, array_fill(0, 3, 0));


    foreach ($age_rows as $row) {

        if ($row['MEDICAL_DECISION'] == 0) {
            $age_gap[$row['AGE'] / 10][0]++;
        }
        if ($row['MEDICAL_DECISION'] == 1) {
            $age_gap[$row['AGE'] / 10][1]++;
        }
        if ($row['MEDICAL_DECISION'] == 2) {
            $age_gap[$row['AGE'] / 10][2]++;
        }

    }


    $dataPoints1 = array(
        array("label" => "0-10", "y" => $age_gap[0][0]),
        array("label" => "10-20", "y" => $age_gap[1][0]),
        array("label" => "20-30", "y" => $age_gap[2][0]),
        array("label" => "30-40", "y" => $age_gap[3][0]),
        array("label" => "40-50", "y" => $age_gap[4][0]),
        array("label" => "50-60", "y" => $age_gap[5][0]),
        array("label" => "60-70", "y" => $age_gap[6][0]),
        array("label" => "70-80", "y" => $age_gap[7][0]),
        array("label" => "80-90", "y" => $age_gap[8][0]),
        array("label" => "90-100", "y" => $age_gap[9][0]),
        array("label" => "100-110", "y" => $age_gap[10][0])
    );
    $dataPoints2 = array(
        array("label" => "0-10", "y" => $age_gap[0][1]),
        array("label" => "10-20", "y" => $age_gap[1][1]),
        array("label" => "20-30", "y" => $age_gap[2][1]),
        array("label" => "30-40", "y" => $age_gap[3][1]),
        array("label" => "40-50", "y" => $age_gap[4][1]),
        array("label" => "50-60", "y" => $age_gap[5][1]),
        array("label" => "60-70", "y" => $age_gap[6][1]),
        array("label" => "70-80", "y" => $age_gap[7][1]),
        array("label" => "80-90", "y" => $age_gap[8][1]),
        array("label" => "90-100", "y" => $age_gap[9][1]),
        array("label" => "100-110", "y" => $age_gap[10][1])
    );

    echo('
    
    <div id="page-container">
    <div class="content" style="text-align: center">
        <br>
        <div id="chartContainer" style="width: 77.5%; margin-left: 250px; padding-bottom: 500px !important;"></div>
        <br><br><br>
        <div id="chartContainer2" style="width: 77.5%; margin-left: 250px;"></div>

        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </div>

    ');

    echo('
    </section>
    </div>
    </div>
    ');
    include_once 'footer.php';

?>
<script>
    var number_of_cases_gender = [<?php echo join(',', $number_of_cases) ?>];

    var malevalue0 = [<?php echo join(',', $males0) ?>];
    var malevalue1 = [<?php echo join(',', $males1) ?>];
    var malevalue2 = [<?php echo join(',', $males2) ?>];

    var femalevalue0 = [<?php echo join(',', $females0) ?>];
    var femalevalue1 = [<?php echo join(',', $females1) ?>];
    var femalevalue2 = [<?php echo join(',', $females2) ?>];


    window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            exportEnabled: true,
            animationEnabled: true,
            title: {
                text: "Number of cases by Gender"
            },
            data: [{
                type: "pie",
                startAngle: 90,
                toolTipContent: "<b>{label}</b>: {y}%",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 16,
                indexLabel: "{label} - {y}%",
                dataPoints: [{
                    y: (100 * malevalue0[0] / number_of_cases_gender[0]).toFixed(2),
                    label: "Male - Prescription Granted"
                },
                    {

                        y: (100 * malevalue1[0] / number_of_cases_gender[0]).toFixed(2),
                        label: "Male - Prescription Granted"

                    },
                    {
                        y: (100 * femalevalue1[0] / number_of_cases_gender[0]).toFixed(2),
                        label: "Female - Prescription Granted"
                    },
                    {
                        y: (100 * femalevalue0[0] / number_of_cases_gender[0]).toFixed(2),
                        label: "Female - Prescription Denied"
                    },
                ]
            }]
        });

        var chart2 = new CanvasJS.Chart("chartContainer2", {
            animationEnabled: true,
            theme: "light2",// "light1", "light2", "dark1", "dark2"
            title: {
                text: "COVID-19 Prescription Grouped by ages"
            },
            axisY: {
                includeZero: true
            },
            legend: {
                cursor: "pointer",
                verticalAlign: "center",
                horizontalAlign: "right",
                itemclick: toggleDataSeries
            },
            data: [{
                type: "column",
                name: "Prescription denied",
                indexLabel: "{y}",
                yValueFormatString: "#0.##",
                showInLegend: true,
                dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
            },
                {
                    type: "column",
                    name: "Prescription granted",
                    indexLabel: "{y}",
                    yValueFormatString: "#0.##",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                },
            ]
        });


        chart.render();
        chart2.render();


    }

    function toggleDataSeries(e) {
        if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        } else {
            e.dataSeries.visible = true;
        }
        chart2.render();
    }
</script>
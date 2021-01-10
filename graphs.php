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


    echo "Total diagnosis =>".$number_of_cases;
    echo "<br>";
    echo "Male and risk=0 => ".$males0;
    echo "<br>";
    echo "Male and risk=1 => ".$males1;
    echo "<br>";
    echo "Male and risk=2 => ".$males2;
    echo "<br>";

    echo "Female and risk=0 => ".$females0;
    echo "<br>";
    echo "Female and risk=1 => ".$females1;
    echo "<br>";
    echo "Female and risk=2 => ".$females2;
    echo "<br>";

    echo "Age<40 and risk=0 => ".$age1_0;
    echo "<br>";

    echo "Age<40 and risk=1 => ".$age1_1;
    echo "<br>";

    echo "Age<40 and risk=2 => ".$age1_2;
    echo "<br>";

    echo "Age>40 and risk=0 => ".$age2_0;
    echo "<br>";

    echo "Age>40 and risk=1 => ".$age2_1;
    echo "<br>";

    echo "Age>40 and risk=2 => ".$age2_2;
    echo "<br>";


    echo('
    </section>
    </div>
    </div>
    ');
    include_once 'footer.php';

?>
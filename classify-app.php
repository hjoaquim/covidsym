<?php 
    $id_consulta = $_POST['id_consulta'];

    $age = $_POST['age'];
    $temp = $_POST['temp'];
    $gender = $_POST['gender'];

    if(isset($_POST['cough']))
        $cough = 1;
    else
        $cough = 0;

    if(isset($_POST['throat']))
        $throat = 1;
    else
        $throat = 0;
        
    if(isset($_POST['weakness']))
        $weakness = 1;
    else
        $weakness = 0;
    
    if(isset($_POST['breathing']))
        $breathing = 1;
    else
        $breathing = 0;

    if(isset($_POST['drowsiness']))
        $drowsiness = 1;
    else
        $drowsiness = 0;

    if(isset($_POST['chest']))
        $chest = 1;
    else
        $chest = 0;

    if(isset($_POST['travel']))
        $travel = 1;
    else
        $travel = 0;
    
    if(isset($_POST['diabetes']))
        $diabetes = 1;
    else
        $diabetes = 0;

    if(isset($_POST['heart']))
        $heart = 1;
    else
        $heart = 0;

    if(isset($_POST['lung']))
        $lung = 1;
    else
        $lung = 0;

    if(isset($_POST['immunity']))
        $immunity = 1;
    else
        $immunity = 0;

    if(isset($_POST['progressed']))
        $progressed = 1;
    else
        $progressed = 0;

    if(isset($_POST['blood']))
        $blood = 1;
    else
        $blood = 0;

    if(isset($_POST['kidney']))
        $kidney = 1;
    else
        $kidney = 0;

    if(isset($_POST['appetide']))
        $appetide = 1;
    else
        $appetide = 0;
        
    if(isset($_POST['smell']))
        $smell = 1;
    else
        $smell = 0;
        

    $class = -1;
    // Terminal Node 1
    if($progressed == 1 && $travel == 1 && $age <= 27)
        $class = 1;

    // Terminal Node 2
    else if($diabetes == 1 && $progressed == 1 && $travel == 1 && $age > 27)
        $class = 2;

    // Terminal Node 3
    else if($diabetes == 0 && $progressed == 1 && $travel == 1 && $age > 27 && $age <= 45.5)
        $class = 2;

    // Terminal Node 4
    else if($diabetes == 0 && $progressed == 1 && $travel == 1 && $age > 45.5)
        $class = 1;

    // Terminal Node 5
    else if($drowsiness == 1 && $progressed == 0 && $travel == 1)
        $class = 1;

    // Terminal Node 6
    else if($drowsiness == 0 && $progressed == 0 && $travel == 1 && $age <= 54 && $temp <= 98.9)
        $class = 1;

    // Terminal Node 7
    else if($drowsiness == 0 && $progressed == 0 && $travel == 1 && $age <= 54 && $temp > 98.9)
        $class = 2;

    // Terminal Node 8
    else if($drowsiness == 0 && $progressed == 0 && $travel == 1 && $age > 54)
        $class = 0;

    // Terminal Node 9
    else if($cough == 1 && $chest == 1 && $travel == 0)
        $class = 2;

    // Terminal Node 10
    else if($cough == 0 && $chest == 1 && $travel == 0)
        $class = 1;

    // Terminal Node 11
    else if($immunity == 1 && $chest == 0 && $travel == 0)
        $class = 1;

    // Terminal Node 12
    else if($diabetes == 1 && $immunity == 0 && $chest == 0 && $travel == 0)
        $class = 2;

    // Terminal Node 13
    else if($diabetes == 0 && $immunity == 0 && $chest == 0 && $travel == 0)
        $class = 0;

    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'sim';
    // Try and connect using the info above.
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME) or die('Failed to connect to MySQL: ' . mysqli_error($connect));
    $query = "INSERT INTO `diag_diagnostico`(`F_CONSULTA`, `age`, `gender`, `body temperature`, `Dry Cough`, `sore throat`, `weakness`, `breathing problem`, `drowsiness`, `pain in chest`, `travel history to infected countries`, `diabetes`, `heart disease`, `lung disease`, `stroke or reduced immunity`, `symptoms progressed`, `high blood pressue`, `kidney disease`, `change in appetide`, `Loss of sense of smell`, `Corona result`) VALUES (".$id_consulta.",".$age.",".$temp.",".$gender.",".$cough.",".$cough.",".$weakness.",".$breathing.",".$drowsiness.",".$chest.",".$travel.",".$diabetes.", ".$heart.",".$lung.",".$immunity.",".$progressed.",".$blood.",".$kidney.",".$appetide.", ".$smell.", ".$class.")";
    $result = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
    //$consulta = mysqli_fetch_row($result_consulta);
    mysqli_close($con);

    header('Location: finish-app.php?id_consulta='.$id_consulta.'&risk='.$class.'');
    exit();
 
?>
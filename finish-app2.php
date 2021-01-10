<?php


    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'sim';
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME) or die('Failed to connect to MySQL: ' . mysqli_error($connect));
    
    
    if(isset($_POST['prescription']))
        $prescription = 1;
    else
        $prescription = 0;

    
    $query = "UPDATE `diag_consulta` SET `PRESCRICAO`=".$prescription.",`NOTAS`='".$_POST['notes']."',`CTL_ACTIVO`='N' WHERE ID=".$_POST['id_consulta']."";
    $result = @mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));    

    mysqli_close($con);

    //header('Location: mycovid.php');
    $message = "Appointment finished sucessfully";
    echo "<SCRIPT>alert('$message'); window.location.replace('mycovid.php');</SCRIPT>";
    exit();

?>
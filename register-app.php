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

    $query_medico = "SELECT ID FROM UTL_UTILIZADORES WHERE NOME='".$_POST['medico']."'";
    $result_paciente = mysqli_query($con, $query_medico) or die('The query failed: ' . mysqli_error($con));
    $id_medico = mysqli_fetch_row($result_paciente);

    $query = "INSERT INTO diag_consulta (F_MEDICO, F_UTENTE, DT_CONSULTA) VALUES (".$id_medico[0].",".$_POST['user_id'].",'".$_POST['date']."')";
    $result = @mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
    mysqli_close($con);
    
    if($result!= FALSE){
        $message = "Appointment successfully scheduled";
    }else{ 
        $message = "Appointment scheduling failed";
    }

    echo "<SCRIPT>alert('$message'); window.location.replace('mycovid.php');</SCRIPT>";

?>
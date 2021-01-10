<?php

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include_once 'header.php';
    echo("
    <head>
        <style>
        table, th, td {
            border: 1px solid black;
            text-align: center;
          }
        </style>
    <head>
    ");

    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'sim';
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME) or die('Failed to connect to MySQL: ' . mysqli_error($connect));

    if (!isset($_SESSION['loggedin'])) {
        header('Location: index.php');
        exit;
    }

    if($_SESSION['usr_type']==3)
        $query = "SELECT * FROM diag_consulta where F_MEDICO=".$_SESSION['id']."";
    else if($_SESSION['usr_type']==4)
        $query = "SELECT * FROM diag_consulta where F_UTENTE=".$_SESSION['id']."";

    $result = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));  
    
    echo('
    <section class="ftco-section">
    <div class="container">
    <div class="row d-md-flex">
    <table>
        <th>Appointment Nr</th>
        <th>F_MEDICO</th>
        <th>F_UTENTE</th>
        <th>DT_CONSULTA</th>
        <th>PRESCRICAO</th>
        <th>NOTAS</th>
        <th>ATIVO</th>
        <th>DT_MARCACAO</th>
    ');

    while($row = mysqli_fetch_row($result)){
        echo('
            <tr>
                <td style="border: 1px solid black;text-align:center;">'.$row[0].'</td>
                <td>'.$row[1].'</td>
                <td>'.$row[2].'</td>
                <td>'.$row[3].'</td>
                <td>'.$row[4].'</td>
                <td>'.$row[5].'</td>
                <td>'.$row[7].'</td>
                <td>'.$row[6].'</td>
            </tr>
        ');
    }

    echo ("
        </table>
        </div>
        </div>
        </section>
    ");
    

    include_once 'footer.php';

?>
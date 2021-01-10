<?php
    if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    

    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'sim';

    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME) or die('Failed to connect to MySQL: ' . mysqli_error($connect));
    $query = 'SELECT F_TIPO_UTILIZADOR FROM utl_utilizadores WHERE ID = "'.$_SESSION['id'].'"';
    $result = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
    $tipo_utl = mysqli_fetch_row($result);

    mysqli_close($con);

    if($tipo_utl[0] == 1){
        echo (
            '<div class="pricing-entry pb-5 text-center">
                <div>
                    <p><span class="price">User menu</span>
                </div>
                <ul>
                    <li><a href="admin-functionalities.php?op=1">List users</a></li>
                    <li><a href="admin-functionalities.php?op=2">Register user</a></li>
                    <li><a href="admin-functionalities.php?op=3">Search user</a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
                </ul>
            </div>'
        );
    }
    else if($tipo_utl[0] == 2){
        echo (
            '<div class="pricing-entry pb-5 text-center">
                <div>
                    <p><span class="price">User menu</span>
                </div>
                <ul>
                    <li><a href="graphs.php">Graphs</a></li>
                    <li><a href="info-inv.php">Information</a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
                </ul>
            </div>'
        );
    }
    else if($tipo_utl[0] == 3){
        echo (
            '<div class="pricing-entry pb-5 text-center">
                <div>
                    <p><span class="price">User menu</span>
                </div>
                <ul>
                    <li><a href="next-app.php">Next appointment</a></li>
                    <li><a href="app-history.php">Appointment history</a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
                </ul>
            </div>'
        );
    }
    else if($tipo_utl[0] == 4){
        echo (
            '<div class="pricing-entry pb-5 text-center">
                <div>
                    <p><span class="price">User menu</span>
                </div>
                <ul>
                <li><a href="appointments.php">Make an appointment</a></li>
                <li><a href="app-history.php">Appointment history</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
                </ul>
            </div>'
        );
    }

?>
<?php
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'sim';

    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME) or die('Failed to connect to MySQL: ' . mysqli_error($connect));
    $query = 'SELECT F_TIPO_UTILIZADOR FROM utl_utilizadores WHERE ID = "'.$_SESSION['id'].'"';
    $result = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
    $tipo_utl = mysqli_fetch_row($result);

    mysqli_close($con);

    if($tipo_utl[0] != 4){
        echo (
            '<div class="pricing-entry pb-5 text-center">
                <div>
                    <p><span class="price">User menu</span>
                </div>
                <ul>
                    <li><a href="#">List users</a></li>
                    <li><a href="#">Register user</a></li>
                    <li><a href="#">Search user</a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
                </ul>
            </div>'
        );
    }
    else{
        echo (
            '<div class="pricing-entry pb-5 text-center">
                <div>
                    <p><span class="price">User menu</span>
                </div>
                <ul>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
                </ul>
            </div>'
        );
    }

?>
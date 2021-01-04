<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['loggedin'], $_SESSION['usr_type']) && $_SESSION['usr_type']!='admin') {
        header('Location: index.html');
        exit;
    }

    include_once 'header.php';

    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'sim';
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME) or die('Failed to connect to MySQL: ' . mysqli_error($connect));

    switch ($_GET['op']){

        case 1:
            list_users($con);
            break;

        case 2:
            echo "case 2";
            break;

        case 3:
            echo "case 3";
            break;
    }

    include_once 'footer.php';
    mysqli_close($con);


// functions here
function list_users($con){

    $query = "select a.id, a.username, a.nome, a.foto, b.desc_utl from utl_utilizadores a inner join utl_tipos_utilizadores b on a.F_TIPO_UTILIZADOR=b.ID";
    $result = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));

    echo '<section class="ftco-section">';
    echo "<div class='row'>";
    while($row = mysqli_fetch_array($result)){
        echo ('
        <div class="col-lg-3 col-md-6 d-flex mb-sm-4 ftco-animate">
            <div class="staff" style="height:95%">
                <div class="img mb-4" style="background-image: url(data:image/png;base64,'.base64_encode($row["foto"]).');"></div>
                    <div class="info text-center">
                        <h3>'.$row["nome"].'</h3>
                        <span class="position">ID: '.$row["id"].'</span>
                        <span class="position">Username: '.$row["username"].'</span>
                        <span class="position">'.$row["desc_utl"].'</span>
                    </div>
            </div>
        </div>
        ');
    }
    echo "</div>";
    echo '</section>';

}

?>


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

if ( !isset($_POST['username'], $_POST['password'], $_POST['name'], $_POST['address'],
    $_POST['district'], $_POST['contact'], $_POST['email'], $_POST['birthdate'],
    $_POST['health-card-number'], $_POST['nif'], $_POST['gender'])) 
{
	// Could not get the data that should have been sent.
	header("Location: core.php");
	exit();
}

$qr_loc = 'SELECT COD_DISTRITO FROM LOC_DISTRITOS WHERE LOC_DISTRITOS.NOME_DISTRITO="'.$_POST['district'].'";';
$res_loc = mysqli_query($con, $qr_loc) or die('The query failed: ' . mysqli_error($con));
$loc = mysqli_fetch_row($res_loc);

switch($_POST["op"]){

    case 1:
        $tp_user = 4;
        break;
    
    case 2:
        $tp_user = $_POST["tipo_utl"];

}

$ctl_activo = 'S';
$pw = password_hash($_POST['password'],PASSWORD_DEFAULT);
$newDate = date("Y-m-d", strtotime($_POST['birthdate']));  

if($_POST['gender'] == 'male')
    $genero = 'M';
else
    $genero = 'F';

$query = 'INSERT INTO utl_utilizadores(username, password, nome, morada, f_localidade, telemovel, email, dt_nascimento, nr_saude, nif, genero, f_tipo_utilizador, ctl_activo) VALUES("'.$_POST['username'].'", "'.$pw.'", "'.$_POST['name'].'", "'.$_POST['address'].'", '.$loc[0].', "'.$_POST['contact'].'", "'.$_POST['email'].'", "'.$newDate.'", '.$_POST['health-card-number'].', '.$_POST['nif'].', "'.$genero.'", '.$tp_user.', "'.$ctl_activo.'");';
$result = @mysqli_query($con, $query);

mysqli_close($con);

if ($result == FALSE) {
    $message = "Registation failed.";
    echo "<SCRIPT>alert('$message'); window.location.replace('mycovid.php');</SCRIPT>";
}
else{
    $message = "Registered Sucessfully.";
    echo "<SCRIPT>alert('$message'); window.location.replace('mycovid.php');</SCRIPT>";
}
//header("Location: mycovid.php");

exit();

?>
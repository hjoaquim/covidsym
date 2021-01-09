<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'sim';


$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME) or die('Failed to connect to MySQL: ' . mysqli_error($connect));

if (!isset($_SESSION['name'])) {
	header("Location: core.php");
	exit();
}

switch ($_POST['op']){
    case 1: 
        $usr_to_change = $_SESSION["name"];
        break;
    
    case 2: 
        $usr_to_change = $_POST["username_to_change"];
        break;

    case 3: 
        $query = "UPDATE utl_utilizadores SET CTL_ACTIVO='N' where username='".$_POST["username_to_change"]."'";
        $res = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
        mysqli_close($con);
        header("Location: mycovid.php");
        exit();
        break;

    case 4: 
        $query = "UPDATE utl_utilizadores SET CTL_ACTIVO='S' where username='".$_POST["username_to_change"]."'";
        $res = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
        mysqli_close($con);
        header("Location: mycovid.php");
        exit();
        break;
}

$qr_loc = 'SELECT COD_DISTRITO FROM LOC_DISTRITOS WHERE LOC_DISTRITOS.NOME_DISTRITO="'.$_POST['district'].'";';
$res_loc = mysqli_query($con, $qr_loc) or die('The query failed: ' . mysqli_error($con));
$loc = mysqli_fetch_row($res_loc);

$newDate = date("Y-m-d", strtotime($_POST['birthdate']));  

if($_POST['gender'] == 'male')
    $genero = 'M';
else
    $genero = 'F';

if($_FILES["myimage"]["name"] != ''){
    $imagename=$_FILES["myimage"]["name"]; 
    $imagetmp=addslashes (file_get_contents($_FILES['myimage']['tmp_name']));
}

if(empty($_POST['password']) && $_FILES["myimage"]["name"] == '') {
    //$query = 'UPDATE utl_utilizadores SET NOME="'.$_POST['name'].'", MORADA="'.$_POST['address'].'", F_LOCALIDADE='.$loc[0].', TELEMOVEL="'.$_POST['contact'].'", EMAIL="'.$_POST['email'].'", DT_NASCIMENTO="'.$newDate.'", NR_SAUDE='.$_POST['health-card-number'].', NIF='.$_POST['nif'].', GENERO="'.$genero.'" WHERE username="'.$_SESSION['name'].'"';
    $query = "UPDATE utl_utilizadores SET NOME='".$_POST['name']."', MORADA='".$_POST["address"]."', F_LOCALIDADE='$loc[0]', TELEMOVEL='".$_POST["contact"]."', EMAIL='".$_POST['email']."', DT_NASCIMENTO='".$newDate."', NR_SAUDE='".$_POST["health-card-number"]."', NIF='".$_POST['nif']."', GENERO='".$genero."'  WHERE username='".$usr_to_change."'";
}
else if(empty($_POST['password']) && $_FILES["myimage"]["name"] != ''){
    $query = "UPDATE utl_utilizadores SET FOTO='$imagetmp', imgname='$imagename', NOME='".$_POST['name']."', MORADA='".$_POST["address"]."', F_LOCALIDADE='$loc[0]', TELEMOVEL='".$_POST["contact"]."', EMAIL='".$_POST['email']."', DT_NASCIMENTO='".$newDate."', NR_SAUDE='".$_POST["health-card-number"]."', NIF='".$_POST['nif']."', GENERO='".$genero."'  WHERE username='".$usr_to_change."'";
    //$query ="UPDATE utl_utilizadores SET FOTO='$imagetmp', imgname='$imagename'";
}
else if(!empty($_POST['password']) && $_FILES["myimage"]["name"] == ''){
    $pw = password_hash($_POST['password'],PASSWORD_DEFAULT);
    //$query = 'UPDATE utl_utilizadores SET password="'.$pw.'", NOME="'.$_POST['name'].'", MORADA="'.$_POST['address'].'", F_LOCALIDADE='.$loc[0].', TELEMOVEL="'.$_POST['contact'].'", EMAIL="'.$_POST['email'].'", DT_NASCIMENTO="'.$newDate.'", NR_SAUDE='.$_POST['health-card-number'].', NIF='.$_POST['nif'].', GENERO="'.$genero.'"  WHERE username="'.$_SESSION['name'].'"';
    $query = "UPDATE utl_utilizadores SET password='".$pw."', NOME='".$_POST['name']."', MORADA='".$_POST["address"]."', F_LOCALIDADE='$loc[0]', TELEMOVEL='".$_POST["contact"]."', EMAIL='".$_POST['email']."', DT_NASCIMENTO='".$newDate."', NR_SAUDE='".$_POST["health-card-number"]."', NIF='".$_POST['nif']."', GENERO='".$genero."'  WHERE username='".$usr_to_change."'";
}
else if(!empty($_POST['password']) && $_FILES["myimage"]["name"] != ''){
    $pw = password_hash($_POST['password'],PASSWORD_DEFAULT);
    //$query = 'UPDATE utl_utilizadores SET FOTO="`.$imagetmp.`", imgname="'.$imagename.'", password="'.$pw.'", NOME="'.$_POST['name'].'", MORADA="'.$_POST['address'].'", F_LOCALIDADE='.$loc[0].', TELEMOVEL="'.$_POST['contact'].'", EMAIL="'.$_POST['email'].'", DT_NASCIMENTO="'.$newDate.'", NR_SAUDE='.$_POST['health-card-number'].', NIF='.$_POST['nif'].', GENERO="'.$genero.'"  WHERE username="'.$_SESSION['name'].'"';
    $query = "UPDATE utl_utilizadores SET FOTO='$imagetmp', imgname='$imagename',password='".$pw."', NOME='".$_POST['name']."', MORADA='".$_POST["address"]."', F_LOCALIDADE='$loc[0]', TELEMOVEL='".$_POST["contact"]."', EMAIL='".$_POST['email']."', DT_NASCIMENTO='".$newDate."', NR_SAUDE='".$_POST["health-card-number"]."', NIF='".$_POST['nif']."', GENERO='".$genero."'  WHERE username='".$usr_to_change."'";
}

$result = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));

mysqli_close($con);

header("Location: mycovid.php");
exit();

?>
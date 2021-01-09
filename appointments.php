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

$query = "SELECT NOME FROM UTL_UTILIZADORES WHERE username='".$_SESSION['name']."'";
$result_paciente = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
$nome_paciente = mysqli_fetch_row($result_paciente);

$query = "SELECT ID,NOME FROM UTL_UTILIZADORES WHERE F_TIPO_UTILIZADOR=3";
$result_medicos = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));


include_once 'header.php';

$optionString = '';
while($row = mysqli_fetch_array($result_medicos)){
    $optionString .='<option>'.$row[1].'</option>';
}

echo ('
<section class="ftco-section">
<div class="container">
<div class="row">
<div class="comment-form-wrap pt-5">
<h3 class="mb-5">Make an appointment</h3>

<form action="register-app.php" method="post">
      <div class="form-group">
        <p>username: '.$_SESSION['name'].'</p>
      </div>
      <div class="form-group">
        <p>Name: '.$nome_paciente[0].'</p>
      </div>
      <div class="form-group">
        Doctor: <select name="medico">'.$optionString.'</select>
      </div>
      <div class="form-group">
        <input type="datetime-local" name="date" placeholder="Date" id="date" required >
      </div>
      <div class="form-group">
        <input type="submit" value="Finish" class="btn btn-primary py-3 px-5">
      </div>
      <input type="hidden" name="user_id" value="'.$_SESSION['id'].'">
</form>

</div>
</div>
</div>
</section>
');

include_once 'footer.php';
?>
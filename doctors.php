<?php
  include_once 'header.php';

  if (session_status() == PHP_SESSION_NONE) {
	session_start();
}


	$DATABASE_HOST = 'localhost';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = '';
	$DATABASE_NAME = 'sim';
	$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME) or die('Failed to connect to MySQL: ' . mysqli_error($connect));

		
	$query = "select a.id, a.username, a.nome, a.foto, b.desc_utl from utl_utilizadores a inner join utl_tipos_utilizadores b on a.F_TIPO_UTILIZADOR=b.ID where a.ctl_activo='S' and a.f_tipo_utilizador=3";
    $result = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));

    echo '<section class="ftco-section">';
	
	echo ('
	<div class="container">
		<div class="row justify-content-center mb-5 pb-5">
		<div class="col-md-7 text-center heading-section ftco-animate">
		  <h2 class="mb-3">Meet Our Experienced Doctors</h2>
		</div>
	  </div>
	');
	
	echo "<div class='row'>";
    while($row = mysqli_fetch_array($result)){
        echo ('
        <div class="col-lg-3 col-md-6 d-flex mb-sm-4 ftco-animate">
            <div class="staff" style="height:95%">
                <div class="img mb-4" style="background-image: url(data:image/png;base64,'.base64_encode($row["foto"]).');"></div>
                    <div class="info text-center">
                        <h3>'.$row["nome"].'</h3>
                        <span class="position">'.$row["desc_utl"].'</span>
                    </div>
            </div>
        </div>
        ');
    }

    echo "</div>";
    echo '</section>';

	mysqli_close($con);

	include_once 'footer.php';
?>
<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  include_once 'header.php';

  $DATABASE_HOST = 'localhost';
  $DATABASE_USER = 'root';
  $DATABASE_PASS = '';
  $DATABASE_NAME = 'sim';

  $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME) or die('Failed to connect to MySQL: ' . mysqli_error($connect));
  $query = 'SELECT count(*) FROM UTL_UTILIZADORES';
  $result = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
  $n_users = mysqli_fetch_row($result);~

  $query = 'SELECT count(*) FROM UTL_UTILIZADORES where f_tipo_utilizador=3';
  $result = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
  $n_medicos = mysqli_fetch_row($result);

  $query = 'SELECT count(*) FROM diag_consulta';
  $result = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
  $n_consultas = mysqli_fetch_row($result);

  
  $query = 'SELECT count(*) FROM diag_consulta where prescricao=1';
  $result = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
  $n_presc = mysqli_fetch_row($result);

  mysqli_close($con);


  echo('
    <section class="ftco-section ftco-services">
      <div class="container">
      	<div class="row justify-content-center mb-5 pb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <h2 class="mb-2">Our Service</h2>
            <p>
			The COVID-19 pandemic that we experience today has as a characteristic
			easily contagious and difficult to diagnose as it presents symptoms identical to those of a
			common flu or constipation. Since testing is the most common and reliable diagnostic technique
			, and that the country has limited testing capacity, it is important to have
			diagnosis support that assesses the risk of being in the presence of a patient with
			COVID-19 and screen cases that are least likely to give priority
			testing of the highest risk cases.
			</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">         
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block text-center">
              <div class="icon d-flex justify-content-center align-items-center">
					<span class="flaticon-dentist"></span>
              </div>
              <div class="media-body p-2 mt-3">
                <h3 class="heading">Diagnosis</h3>
              </div>
            </div>
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block text-center">
              <div class="icon d-flex justify-content-center align-items-center">
            		<span class="flaticon-anesthesia"></span>
              </div>
              <div class="media-body p-2 mt-3">
                <h3 class="heading">Prescription</h3>
              </div>
            </div>
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(images/bg_1.jpg);" data-stellar-background-ratio="0.5">
    	<div class="container">
    		<div class="row d-flex align-items-center">
    			<div class="col-md-3 aside-stretch py-5">
    				<div class=" heading-section heading-section-white ftco-animate pr-md-4">
				<h2 class="mb-3">Achievements</h2>
				<p>Some data about this web application>
	          </div>
    			</div>
    			<div class="col-md-9 py-5 pl-md-5">
		    		<div class="row">
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18">
		              <div class="text">
		                <strong class="number" data-number="'.$n_users[0].'">0</strong>
		                <span>Users</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18">
		              <div class="text">
		                <strong class="number" data-number="'.$n_medicos[0].'">0</strong>
		                <span>Experienced doctors</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18">
		              <div class="text">
		                <strong class="number" data-number="'.$n_consultas[0].'">0</strong>
		                <span>Appointments</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18">
		              <div class="text">
		                <strong class="number" data-number="'.$n_presc[0].'">0</strong>
		                <span>Prescriptions</span>
		              </div>
		            </div>
		          </div>
		        </div>
		      </div>
	      </div>
    	</div>
    </section>
  ');


  include_once 'footer.php';
?>

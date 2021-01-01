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

  $query = 'SELECT nome_distrito FROM loc_distritos';
  $result = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
  mysqli_close($con);
?>








<head>
<link href="css/css_login.css" rel="stylesheet" type="text/css">
</head>

<!--<div class="col-md-6 ftco-animate img about-image order-md-last" style="background-image: url(images/about.jpg);"></div>-->
<!-- <div class="col-md-6 ftco-animate pr-md-5 order-md-first"> -->
	<div class="row">

		<div class="col-md-12 nav-link-wrap mb-5">
			<div class="nav ftco-animate nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  			<a class="nav-link active" id="login-tab" data-toggle="pill" href="#login" role="tab" aria-controls="login" aria-selected="true">Login</a>
				<a class="nav-link" id="signup-tab" data-toggle="pill" href="#signup" role="tab" aria-controls="signup" aria-selected="false">Sign up</a>
      </div>
    </div>

    <!-- <div class="col-md-12 d-flex align-items-center"> -->
      <div class="tab-content ftco-animate" id="v-pills-tabContent">

      	<div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
        	<!-- <h2 class="mb-4">Login</h2> -->
        	<!-- LOGIN Form -->
  				<p>
          	<div>
            	<!-- <h1>Login</h1> -->
              <form action="authenticate.php" method="post">
	              <label for="username">
	            		<i class="fas fa-user" style="color:white"></i>
	              </label>
	              <input type="text" name="username" placeholder="Username" id="username" required>
	              <label for="password">
	                <i class="fas fa-lock"></i>
	              </label>
	            	<input type="password" name="password" placeholder="Password" id="password" required>
	            	<input type="submit" value="Login">
          		</form>
          	</div>
        	</p>
      	</div>




				<div class="tab-pane fade" id="signup" role="tabpanel" aria-labelledby="signup-tab">

					<p>
          	<div>
            	<!-- <h1>Sign up</h1> -->

              <form action="signup.php" method="post">
                <table>

                  <tr>
                      <td>
                        <label for="username">
                        <i class="fas fa-user"></i>
                        </label>
                        <input type="text" name="username" placeholder="Username" id="username" required>
                      </td>
                      <td>
                        <label for="password">
                        <i class="fas fa-lock"></i>
                        </label>
                        <input type="password" name="password" placeholder="Password" id="password" required>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <label for="name">
                          <i class="fas fa-user"></i>
                        </label>
                        <input type="text" name="name" placeholder="Name" id="name" required>
                      </td>
                      <td>
                        <label for="address">
                          <i class="fas fa-home"></i>
                        </label>
                        <input type="text" name="address" placeholder="Address" id="address" required>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <label for="district">
                        <i class="fas fa-map"></i>
                        </label>
                        <!-- <input type="text" name="district" placeholder="District" id="district" required> -->
                        <select name="district" id="district" required>
                        <?php
                          while($row = mysqli_fetch_array($result)){
                            echo "<option>".$row['nome_distrito']."</option>";
                          }
                        ?>
                        </select>
                      </td>

                      <td>
                        <label for="contact">
                        <i class="fas fa-phone-alt"></i>
                        </label>
                        <input type="tel" name="contact" placeholder="Contact" pattern="[0-9]{9}" id="contact" required>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <label for="email">
                        <i class="fas fa-envelope"></i>
                        </label>
                        <input type="email" name="email" placeholder="Email" id="email" required>
                      </td>

                      <td>
                        <label for="birthdate">
                        <i class="fas fa-calendar"></i>
                        </label>
                        <input type="date" name="birthdate" placeholder="Birthdate" id="birthdate" required >
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <label for="health-card-number">
                        <i class="fas fa-clinic-medical"></i>
                        </label>
                        <input type="number" name="health-card-number" placeholder="Health card number" id="health-card-number" required>
                      </td>

                      <td>
                        <label for="nif">
                        <i class="fas fa-id-card"></i>
                        </label>
                        <input type="number" name="nif" placeholder="NIF" id="nif" required>
                      </td>
                    
                    </tr>

                    <tr>
                      <td>
                        <label for="gender">
                        <i class="fas fa-venus-mars"></i>
                        </label>
                        <select name="gender" id="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        </select>
                        <!--
                        <input type="text" name="gender" placeholder="Gender" id="gender" required>
                        -->
                      </td>
                    </tr>

                    <tr>
                      <td> <input type="submit" value="Submit"> <td>
                    <tr>

                  </table>

              </form>
          	</div>
        	</p>
    		</div>
      </div>
    <!-- </div> -->
	</div>
<!-- </div> -->

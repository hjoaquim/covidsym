<!--<div class="col-md-6 ftco-animate img about-image order-md-last" style="background-image: url(images/about.jpg);"></div>-->
<div class="col-md-6 ftco-animate pr-md-5 order-md-first">
	<div class="row">
		<div class="col-md-12 nav-link-wrap mb-5">
			<div class="nav ftco-animate nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  			<a class="nav-link active" id="login-tab" data-toggle="pill" href="#login" role="tab" aria-controls="login" aria-selected="true">Login</a>
				<a class="nav-link" id="signup-tab" data-toggle="pill" href="#signup" role="tab" aria-controls="signup" aria-selected="false">Sign up</a>
      </div>
    </div>
    <div class="col-md-12 d-flex align-items-center">
      <div class="tab-content ftco-animate" id="v-pills-tabContent">
      	<div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
        	<!-- <h2 class="mb-4">Login</h2> -->
        	<!-- LOGIN Form -->
  				<p>
          	<div class="login">
            	<h1>Login</h1>
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
        	<!--<div>
          	<h2 class="mb-4">To Accomodate All Patients</h2>
        		<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
          	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt voluptate, quibusdam sunt iste dolores consequatur</p>
        	</div>-->
					<p>
          	<div class="login">
            	<h1>Sign up</h1>
              <form action="authenticate.php" method="post">
	              <label for="name">
	            		<i class="fas fa-user" style="color:white"></i>
	              </label>
	              <input type="text" name="name" placeholder="Name" id="name" required>
	              <label for="address">
	                <i class="fas fa-home"></i>
	              </label>
	            	<input type="text" name="address" placeholder="Address" id="address" required>
								<label for="town">
	            		<i class="fas fa-city" style="color:white"></i>
	              </label>
	              <input type="text" name="town" placeholder="Town" id="town" required>
								<label for="district">
	            		<i class="fas fa-map" style="color:white"></i>
	              </label>
	              <input type="text" name="district" placeholder="District" id="district" required>
								<label for="contact">
									<i class="fas fa-phone-alt"></i>
								</label>
								<input type="text" name="contact" placeholder="Contact" pattern="[0-9]{9}" id="contact" required>
								<label for="email">
									<i class="fas fa-envelope"></i>
								</label>
								<input type="text" name="email" placeholder="Email" id="email" required>
								<label for="birthdate">
									<i class="fas fa-calendar"></i>
								</label>
								<input type="text" name="birthdate" placeholder="Birthdate" id="birthdate" required>
								<label for="gender">
									<i class="fas fa-venus-mars"></i>
								</label>
								<!--<select name="gender" id="gender">
  								<option value="male">Male</option>
  								<option value="female">Female</option>
  								<option value="undefined">Other</option>
								</select>-->
								<input type="text" name="gender" placeholder="Gender" id="gender" required>
								<label for="nif">
									<i class="fas fa-id-card"></i>
								</label>
								<input type="text" name="nif" placeholder="NIF" id="nif" required>
								<label for="health-card-number">
									<i class="fas fa-clinic-medical"></i>
								</label>
								<input type="text" name="health-card-number" placeholder="Health card number" id="health-card-number" required>
								<label for="alergies">
									<i class="fas fa-file-medical"></i>
								</label>
								<input type="text" name="alergies" placeholder="Alergies" id="alergies" required>
								<label for="username">
									<i class="fas fa-user"></i>
								</label>
								<input type="text" name="username" placeholder="Username" id="username" required>
								<label for="password">
									<i class="fas fa-lock"></i>
								</label>
								<input type="password" name="password" placeholder="Password" id="password" required>
								<input type="submit" value="Signup">
          		</form>
          	</div>
        	</p>
    		</div>
      </div>
    </div>
	</div>
</div>

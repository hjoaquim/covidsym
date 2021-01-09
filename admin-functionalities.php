<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['loggedin'], $_SESSION['usr_type']) && $_SESSION['usr_type']!='admin') {
        header('Location: index.php');
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
            register_user($con);
            break;

        case 3:
            search_user($con);
            break;
    }

    include_once 'footer.php';
    mysqli_close($con);


// functions here
function list_users($con){

    $query = "select a.id, a.username, a.nome, a.foto, b.desc_utl from utl_utilizadores a inner join utl_tipos_utilizadores b on a.F_TIPO_UTILIZADOR=b.ID where a.ctl_activo='S'";
    $result = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));

    echo '<section class="ftco-section">';

    echo ('
	<div class="container">
		<div class="row justify-content-center mb-5 pb-5">
		<div class="col-md-7 text-center heading-section ftco-animate">
		  <h2 class="mb-3">Meet Our Users</h2>
		  <p>This view is admin only</p>
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
                        <a href="admin-functionalities.php?search='.$row["username"].'&op=3"> <h3>'.$row["nome"].'</h3> </a>
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

function search_user($con){

    echo '<section class="ftco-section">';
    echo ('<div class="row justify-content-center mb-5 pb-5">');
    echo ('

    <div>
        <form action="admin-functionalities.php">
            <input type="text" placeholder="Search by username" name="search">
            <input type="hidden" name="op" value="3">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>

    ');

    

    if(isset($_GET['search'])){

        $query = 'SELECT * FROM utl_utilizadores WHERE username = "'.$_GET['search'].'"';
        $result = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));



        if (mysqli_num_rows($result) > 0) {
            
            $user = mysqli_fetch_row($result);

            $query = 'SELECT NOME_DISTRITO FROM LOC_DISTRITOS WHERE COD_DISTRITO = '.$user[6].';';
            $result = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
            $dist = mysqli_fetch_row($result);

            $query = 'SELECT DESC_UTL FROM UTL_TIPOS_UTILIZADORES WHERE ID='.$user[13].';';
            $result = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
            $tipo = mysqli_fetch_row($result);

            $query = 'SELECT nome_distrito FROM loc_distritos';
            $result_dist = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));

            $optionString = '';
            while($row = mysqli_fetch_array($result_dist)){
                $optionString .='<option>'.$row["nome_distrito"].'</option>';
            }

            mysqli_close($con);

            echo('
            
                    <table>
                    <form action="change-user.php" method="post"  enctype="multipart/form-data">
                                <tr>                                
                                    
                                    <td>
                                    <div class="pricing-entry pb-5 text-center">
                                            
                                                <table>
                                                    <tr>
                                                        <td>Choose Image:</td>
                                                        <td><input type="file" id="myimage" name="myimage"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Username:</td>
                                                        <td>'.$user[1].'</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Nome:</td>
                                                        <td><input type="text" name="name" value="'.$user[3].'" style="width: 300px"></td>
                                                    <tr>

                                                    <tr>
                                                        <td>Password: <input type="checkbox" onclick="showpw()"></td>
                                                        <td>
                                                            <input type="password" name="password" style="width: 300px" id=myPw>
                                                        </td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>Morada:</td>
                                                        <td>
                                                            <input type="text" name="address" value="'.$user[5].'" style="width: 300px">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Distrito:</td>
                                                        <td>
                                                        <select name="district" id="district" style="width: 300px">
                                                        <option>'.$dist[0].'</option>
                                                        '.$optionString.'
                                                        </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Telemóvel:</td>
                                                        <td>
                                                            <input type="tel" name="contact" value="'.$user[7].'" id="contact" style="width: 300px">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email:</td>
                                                        <td>
                                                            <input type="email" name="email" value="'.$user[8].'" id="email" style="width: 300px">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Data de Nascimento:</td>
                                                        <td>
                                                            <input type="date" name="birthdate" value="'.$user[9].'" id="birthdate" style="width: 300px">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nº cartão de utente:</td>
                                                        <td>
                                                            <input type="number" name="health-card-number" value="'.$user[10].'" id="health-card-number" style="width: 300px">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>NIF:</td>
                                                        <td>
                                                            <input type="number" name="nif" value="'.$user[11].'" id="nif" style="width: 300px">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Genero:</td>
                                                        <td>
                                                            <select name="gender" id="gender" style="width: 300px">
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tipo de utilizador:</td>
                                                        <td>'.$tipo[0].'</td>
                                                    </tr>

                                                    <input type="hidden" name="op" value="2">
                                                    <input type="hidden" name="username_to_change" value="'.$user[1].'">

                                                    <tr><td><td> <input type="submit" value="Save changes"> </td></td></tr>

                                                </table>
                                            </div>
                                    </td>

                                </tr>
                </form>
                </table>

            ');

            if($user[15]=='S'){
                echo ('
                    <form action="change-user.php" method="post">
                        
                        <input type="hidden" name="op" value="3">
                        <input type="hidden" name="username_to_change" value="'.$user[1].'">
                        <tr><td><td> <input type="submit" value="Deactivate user"> </td></td><tr>
                    
                    </form>
                ');
            }
            else{
                echo ('
                <form action="change-user.php" method="post">
                    
                    <input type="hidden" name="op" value="4">
                    <input type="hidden" name="username_to_change" value="'.$user[1].'">
                    <tr><td><td> <input type="submit" value="Activate user"> </td></td><tr>
                
                </form>
            ');
            }

        }
        else{
            $message = "User not found";
            echo "<SCRIPT>alert('$message'); window.location.replace('admin-functionalities.php?op=3');</SCRIPT>";
        }

        
    }
    

    echo "</div>";
    echo '</section>';
}

function register_user($con){
    echo('
    <section class="ftco-section">
    <div class="container">
    <div class="row d-md-flex">

    <link href="css/css_login.css" rel="stylesheet" type="text/css">

    <div class="row">

    <div class="col-md-12 nav-link-wrap mb-5">
        <div class="nav ftco-animate nav-pills fadeInUp ftco-animated" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link active show" id="login-tab" data-toggle="pill" href="#login" role="tab" aria-controls="login" aria-selected="true">Register user</a>
    </div>
    </div>

  <div class="tab-content ftco-animate fadeInUp ftco-animated" id="v-pills-tabContent">

      <div class="tab-pane fade active show" id="login" role="tabpanel" aria-labelledby="login-tab">
        <div>

        <form action="signup.php" method="post">
            <table>

              <tbody><tr>
                  <td>
                    <label for="username">
                    <i class="fas fa-user" aria-hidden="true"></i>
                    </label>
                    <input type="text" name="username" placeholder="Username" id="username" required="">
                  </td>
                  <td>
                    <label for="password">
                    <i class="fas fa-lock" aria-hidden="true"></i>
                    </label>
                    <input type="password" name="password" placeholder="Password" id="password" required="">
                  </td>
                </tr>

                <tr>
                  <td>
                    <label for="name">
                      <i class="fas fa-user" aria-hidden="true"></i>
                    </label>
                    <input type="text" name="name" placeholder="Name" id="name" required="">
                  </td>
                  <td>
                    <label for="address">
                      <i class="fas fa-home" aria-hidden="true"></i>
                    </label>
                    <input type="text" name="address" placeholder="Address" id="address" required="">
                  </td>
                </tr>

                <tr>
                  <td>
                    <label for="district">
                    <i class="fas fa-map" aria-hidden="true"></i>
                    </label>
                    <select name="district" id="district" required="">
                    <option>Aveiro</option><option>Beja</option><option>Braga</option><option>Bragança</option><option>Castelo Branco</option><option>Coimbra</option><option>Évora</option><option>Faro</option><option>Guarda</option><option>Leiria</option><option>Lisboa</option><option>Portalegre</option><option>Porto</option><option>Santarém</option><option>Setúbal</option><option>Viana do Castelo</option><option>Vila Real</option><option>Viseu</option><option>Ilha da Madeira</option><option>Ilha de Porto Santo</option><option>Ilha de Santa Maria</option><option>Ilha de São Miguel</option><option>Ilha Terceira</option><option>Ilha da Graciosa</option><option>Ilha de São Jorge</option><option>Ilha do Pico</option><option>Ilha do Faial</option><option>Ilha das Flores</option><option>Ilha do Corvo</option>                        </select>
                  </td>

                  <td>
                    <label for="contact">
                    <i class="fas fa-phone-alt" aria-hidden="true"></i>
                    </label>
                    <input type="tel" name="contact" placeholder="Contact" pattern="[0-9]{9}" id="contact" required="">
                  </td>
                </tr>

                <tr>
                  <td>
                    <label for="email">
                    <i class="fas fa-envelope" aria-hidden="true"></i>
                    </label>
                    <input type="email" name="email" placeholder="Email" id="email" required="">
                  </td>

                  <td>
                    <label for="birthdate">
                    <i class="fas fa-calendar" aria-hidden="true"></i>
                    </label>
                    <input type="date" name="birthdate" placeholder="Birthdate" id="birthdate" required="">
                  </td>
                </tr>

                <tr>
                  <td>
                    <label for="health-card-number">
                    <i class="fas fa-clinic-medical" aria-hidden="true"></i>
                    </label>
                    <input type="number" name="health-card-number" placeholder="Health card number" id="health-card-number" required="">
                  </td>

                  <td>
                    <label for="nif">
                    <i class="fas fa-id-card" aria-hidden="true"></i>
                    </label>
                    <input type="number" name="nif" placeholder="NIF" id="nif" required="">
                  </td>
                
                </tr>

                <tr>
                  <td>
                    <label for="gender">
                    <i class="fas fa-venus-mars" aria-hidden="true"></i>
                    </label>
                    <select name="gender" id="gender" required="">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                
                  </td>

                  <td>
                    <label for="utl_type">
                    <i class="fas fa-users-cog" aria-hidden="true"></i>
                    <select name="tipo_utl" id="tipo_utl" required="">
                        <option value="1">admin</option>
                        <option value="2">Investigador</option>
                        <option value="3">Médico</option>
                        <option value="4">Utente</option>
                    </select>
                  </td>
                    
                </tr>

                <tr>
                  <td> <input type="submit" value="Submit"> </td><td>
                </td></tr><tr>

              </tr></tbody></table>

              <input type="hidden" value="2" name="op">

          </form>
          
        </div>
      </div>
 
    </div>
    </div>
    </div>
    </section>
    ');
}


?>
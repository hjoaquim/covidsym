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
            echo "case 2";
            break;

        case 3:
            search_user($con);
            break;
    }

    include_once 'footer.php';
    mysqli_close($con);


// functions here
function list_users($con){

    $query = "select a.id, a.username, a.nome, a.foto, b.desc_utl from utl_utilizadores a inner join utl_tipos_utilizadores b on a.F_TIPO_UTILIZADOR=b.ID";
    $result = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));

    /*
    $number=mysqli_num_rows($result);

    if(isset($_GET['pageSize']))
        $pageSize=$_GET['pageSize']; 			//numero de pesquisas por pagina
    else
        $pageSize=8;
    
    if(isset($_GET['pageNumber']))
        $pageNumber=$_GET['pageNumber'];		//numero da pagina de pesquisa
    else
        $pageNumber=1;

    $nPages=ceil($number/$pageSize);
    */

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
    
/*
    for($i=1 ; $i <= $number ; $i++){

        if($row = mysqli_fetch_array($result)){
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

    }

    for ($j = 1; $j <= $nPages; $j++) 
        echo '<a href=admin-functionalities.php?op=1&pageNumber='.$j.'&pageSize='.$pageSize.'>'. $j.'</a></td>';

*/
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
                                                        <option><?=$dist[0]?></option>
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
                                                        <td><'.$tipo[0].'</td>
                                                    </tr>

                                                    <tr><td><td> <input type="submit" value="Save changes"> <td></td></tr>

                                                </table>
                                            </div>
                                    </td>

                                </tr>
                </form>
                </table>

            ');

        }
        else{
            $message = "User not found";
            echo "<SCRIPT>alert('$message'); window.location.replace('admin-functionalities.php?op=3');</SCRIPT>";
        }

        
    }
    

    echo "</div>";
    echo '</section>';
}



?>


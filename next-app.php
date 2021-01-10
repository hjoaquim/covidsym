<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['loggedin'], $_SESSION['usr_type']) && $_SESSION['usr_type']!=3) {
        header('Location: index.php');
        exit;
    }

    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'sim';
    // Try and connect using the info above.
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME) or die('Failed to connect to MySQL: ' . mysqli_error($connect));
    $query = "SELECT * FROM diag_consulta where DT_CONSULTA in (SELECT min(DT_CONSULTA) from diag_consulta WHERE  F_MEDICO=".$_SESSION['id']." and CTL_ACTIVO='S')";
    $result_consulta = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
    $consulta = mysqli_fetch_row($result_consulta);

    $query = "SELECT * FROM utl_utilizadores where id=".$consulta[2]."";
    $result_paciente = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
    $paciente = mysqli_fetch_row($result_paciente);

    $query = "SELECT NOME_DISTRITO FROM LOC_DISTRITOS WHERE COD_DISTRITO=".$paciente[6]."";
    $result_dist = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));
    $dist = mysqli_fetch_row($result_dist);

    mysqli_close($con);

    include_once 'header.php';

    echo('

    <style>img {border-radius: 50%;}</style>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row d-md-flex">
    
            <table>
                <th>Patient info</th>
                <th>Symptoms</th>
                <tr>
                    <td>
                        <div class="pricing-entry pb-5 text-center">
                            
                            <img style:"border-radius: 50%;" src="data:image/png;base64,'.base64_encode($paciente[4]).'" width=100px/>
                            
                                <table style="padding:50px">

                                    <tr>
                                        <td>Nome:</td>
                                        <td>'.$paciente[3].'</td>
                                    <tr>

                                    <tr>
                                        <td>Morada:</td>
                                        <td>
                                            '.$paciente[5].'
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Distrito:</td>
                                        <td>'.$dist[0].'</td>
                                    </tr>

                                    <tr>
                                        <td>Telemóvel:</td>
                                        <td>
                                            '.$paciente[7].'
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Email:</td>
                                        <td>
                                            '.$paciente[8].'
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Data de Nascimento:</td>
                                        <td>
                                            '.$paciente[9].'
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Nº cartão de utente:</td>
                                        <td>
                                            '.$paciente[10].'
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>NIF:</td>
                                        <td>
                                            '.$paciente[11].'
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Genero:</td>
                                        <td>
                                        '.$paciente[12].'
                                        </td>
                                    </tr>

                                </table>
                        </div>
                    </td>


                    <td>
                        <div class="pricing-entry pb-5 text-center">
                            <form action="change-user.php" method="post">
                                <table>
                                    
                                    <tr>
                                        <td><label for="age"></label><br></td>
                                        <td><input type="number" id="age" name="age"></td>
                                    </tr>
                                    
                                    <tr>
                                        <td><label for=""></label><br></td>
                                        <td><input type="checkbox" id="" name="" value="1"></td>
                                    </tr>

                                </table>
                            </form>
                        </div>
                    </td>


                </tr>



        </table>
        </div>
    </section>

    ');

    include_once 'footer.php';

/*
 <table border: 1px solid black;>
            <tr>

                <td>
                    <table>
                        <th>Appointment info</th>
                    </table>
                </td>

            </tr>
        </table>
*/

?>

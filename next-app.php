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
        <h2>Appointment Environment</h2>
        <br><br>
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
                            <form action="classify-app.php" method="post">
                                <table>
                                    
                                    <tr>
                                        <td><label for="age">Age</label><br></td>
                                        <td><input type="number" id="age" name="age" required></td>
                                    </tr>

                                    <tr>
                                        <td><label for="temp">Body Temperature</label><br></td>
                                        <td><input type="number" id="temp" name="temp" required></td>
                                    </tr>

                                    <tr>
                                        <td><label for="">Gender (0->M 1->F)</label><br></td>
                                        <td>
                                            <select name="gender" required>
                                                <option>0</option>
                                                <option>1</option>
                                            </select>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td><label for="cough">Dry Cough</label><br></td>
                                        <td><input type="checkbox" id="cough" name="cough" value="1"></td>
                                    </tr>

                                    <tr>
                                        <td><label for="throat">Sore throat</label><br></td>
                                        <td><input type="checkbox" id="throat" name="throat" value="1"></td>
                                    </tr>

                                    <tr>
                                        <td><label for="weakness">Weakness</label><br></td>
                                        <td><input type="checkbox" id="weakness" name="weakness" value="1"></td>
                                    </tr>
                                    
                                    <tr>
                                        <td><label for="breathing">Breathing problem</label><br></td>
                                        <td><input type="checkbox" id="breathing" name="breathing" value="1"></td>
                                    </tr>

                                    <tr>
                                        <td><label for="drowsiness">Drowsiness</label><br></td>
                                        <td><input type="checkbox" id="drowsiness" name="drowsiness" value="1"></td>
                                    </tr>

                                    <tr>
                                        <td><label for="chest">Pain in chest</label><br></td>
                                        <td><input type="checkbox" id="chest" name="chest" value="1"></td>
                                    </tr>

                                    <tr>
                                        <td><label for="travel">Travel history to infected countries</label><br></td>
                                        <td><input type="checkbox" id="travel" name="travel" value="1"></td>
                                    </tr>

                                    <tr>
                                        <td><label for="diabetes">Diabetes</label><br></td>
                                        <td><input type="checkbox" id="diabetes" name="diabetes" value="1"></td>
                                    </tr>

                                    <tr>
                                        <td><label for="heart">Hearth disease</label><br></td>
                                        <td><input type="checkbox" id="heart" name="heart" value="1"></td>
                                    </tr>

                                    <tr>
                                        <td><label for="lung">Lung disease</label><br></td>
                                        <td><input type="checkbox" id="lung" name="lung" value="1"></td>
                                    </tr>

                                    <tr>
                                        <td><label for="immunity">Stroke or reduced immunity</label><br></td>
                                        <td><input type="checkbox" id="immunity" name="immunity" value="1"></td>
                                    </tr>

                                    <tr>
                                        <td><label for="immunity">Stroke or reduced immunity</label><br></td>
                                        <td><input type="checkbox" id="immunity" name="immunity" value="1"></td>
                                    </tr>

                                    <tr>
                                        <td><label for="progressed">Symptoms progressed</label><br></td>
                                        <td><input type="checkbox" id="progressed" name="progressed" value="1"></td>
                                    </tr>

                                    <tr>
                                        <td><label for="blood">High blood pressue</label><br></td>
                                        <td><input type="checkbox" id="blood" name="blood" value="1"></td>
                                    </tr>

                                    <tr>
                                        <td><label for="kidney">Kidney disease</label><br></td>
                                        <td><input type="checkbox" id="kidney" name="kidney" value="1"></td>
                                    </tr>

                                    
                                    <tr>
                                        <td><label for="appetide">Change in appetide</label><br></td>
                                        <td><input type="checkbox" id="appetide" name="appetide" value="1"></td>
                                    </tr>

                                    <tr>
                                        <td><label for="smell">Loss of sense of smell</label><br></td>
                                        <td><input type="checkbox" id="smell" name="smell" value="1"></td>
                                    </tr>

                                    <input name="id_consulta" id="id_consulta" type="hidden" value="'.$consulta[0].'">

                                    <tr><td><td> <input type="submit" value="Proceed with Appointment"> <td></td></tr>
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

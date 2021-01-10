<?php


    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'], $_SESSION['usr_type']) && $_SESSION['usr_type']==3) {
        header('Location: index.html');
        exit;
    }

    include_once 'header.php';

    echo ('

    <section class="ftco-section">
            <div class="container">
                <div class="row d-md-flex">
    
    ');
    
    
    echo ('<div class="comment-form-wrap pt-5">
                    <h3 class="mb-5">Prescription section</h3>
                    <form action="finish-app2.php" method="post">
                          <div class="form-group">
                            Appointment number: '.$_GET['id_consulta'].'
                          </div>
                          <div class="form-group">
                            Risk: '.$_GET['risk'].'
                          </div>
                          <div class="form-group">
                            <input type="text" name="notes" class="form-control" placeholder="Final Considerations" required>
                          </div>
                          <div class="form-group">
                            COVID-19 Test Prescription
                            <input type="checkbox" name="prescription" class="form-control" placeholder="Final Considerations" value="1">
                          </div>
                          <div class="form-group">
                            <input type="submit" value="Finish Appointment" class="btn btn-primary py-3 px-5">
                           </div>

                           <input name="id_consulta" id="id_consulta" type="hidden" value="'.$_GET['id_consulta'].'">
                    </form>
                  </div>
        ');
    
    echo ('
    
    </section>
            </div>
                </div>
    
    ');


    include_once 'footer.php';


?>

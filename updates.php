<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    include_once 'header.php';
    echo('
    <section class="ftco-section">
    <div class="container">
    <div class="row d-md-flex">
    ');

    echo('
    <iframe src="https://ourworldindata.org/grapher/daily-new-confirmed-cases-of-covid-19-vs-cumulative-cases-positive-rate?time=earliest..latest" loading="lazy" style="width: 100%; height: 600px; border: 0px none;"></iframe>
    ');


    echo('
    </section>
    </div>
    </div>
    ');
    include_once 'footer.php';
?>
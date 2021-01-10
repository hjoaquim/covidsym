<?php 
    echo "<table>";



    foreach ($_POST as $key => $value) {
        echo "<tr>";
        echo "<td>";
        echo $key;
        echo "</td>";
        echo "<td>";
        echo $value;
        echo "</td>";
        echo "</tr>";

    }



    echo "</table>";

/*
if (SYMPTOMS == 1 &&TRAVEL_H == 1 && AGE <= 27)
    $class = 1;

if(SYMPTOMS == 1 && TRAVEL_H == 1 && AGE > 27)
    $class = 2;

if( SYMPTOMS == 0 && TRAVEL_H == 1)
    $class = 1;

if(DRY_COUG == 1 PAIN(IN) == 1 && TRAVEL_H == 0)
    $class = 2;

if(DRY_COUG == 0 && PAIN(IN) == 1 && TRAVEL_H == 0)
    $class = 1;


if( STROKE_O == 1 && PAIN(IN) == 0 && TRAVEL_H == 0)
    $class = 1;


if(STROKE_O == 0 && PAIN(IN) == 0 && TRAVEL_H == 0)
    $class = 0;
/*

?>
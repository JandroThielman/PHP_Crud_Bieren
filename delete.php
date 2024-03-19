<?php
// auteur: Jandro
// functie: verwijder een bier op basis van de id
include 'functions.php';

// Haal bier uit de database
if(isset($_GET['biercode'])){

    // test of insert gelukt is
    if(deletebieren($_GET['biercode']) == true){
        echo '<script>alert("biercode: ' . $_GET['biercode'] . ' is verwijderd")</script>';
        echo "<script> location.replace('bieren.php'); </script>";
    } else {
        echo '<script>alert("bieren is NIET verwijderd")</script>';
    }
}
?>


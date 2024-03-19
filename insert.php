<?php
    // functie: formulier en database insert bieren
    // auteur: Jandro

    echo "<h1>Insert bieren</h1>";

    require_once('functions.php');
	 
    // Test of er op de insert-knop is gedrukt 
    if(isset($_POST) && isset($_POST['btn_ins'])){

        // test of insert gelukt is
        if(insertbieren($_POST) == true){
            echo "<script>alert('brouwer is toegevoegd')</script>";
        } else {
            echo '<script>alert("brouwer is NIET toegevoegd")</script>';
        }
    }
?>
<html>
    <body>
        <form method="post">

        <label for="type">Naam:</label>
        <input type="text" id="type" name="naam" required><br>

        <label for="prijs">Soort:</label>
        <input type="text" id="prijs" name="soort" required><br>

        <label for="type">Stijl:</label>
        <input type="text" id="type" name="stijl" required><br>

        <label for="type">Alcohol:</label>
        <input type="number" id="type" name="alcohol" required><br>

        <?php dropdown(); ?> <br>

        <input type="submit" name="btn_ins" value="Insert">
        </form>
        
        <br><br>
        <a href='bieren.php'>Home</a>
    </body>
</html>

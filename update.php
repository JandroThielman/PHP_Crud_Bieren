<?php
    // functie: update brouwer
    // auteur: Jandro

    require_once('functions.php');

    if(isset($_POST['btn_wzg'])){

        if(updatebieren($_POST) == true){
            echo "<script>alert('bieren is gewijzigd')</script>";
        } else {
            echo '<script>alert("bieren is NIET gewijzigd")</script>';
        }
        
    }

    if(isset($_GET['biercode'])){  
        $id = $_GET['biercode'];
        $row = getBieren($id);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Wijzig brouwer</title>
</head>
<body>
  <h2>Wijzig brouwer</h2>

  <form method="post">

    <label for="type">Naam:</label>
    <input type="text" id="type" name="naam" value="<?php echo $row['naam']?>"><br>

    <label for="prijs">Soort:</label>
    <input type="text" id="prijs" name="soort" value="<?php echo $row['soort']?>"><br>

    <label for="type">Stijl:</label>
    <input type="text" id="type" name="stijl" value="<?php echo $row['stijl']?>"><br>

    <label for="type">Alcohol:</label>
    <input type="number" id="type" name="alcohol" value="<?php echo $row['alcohol']?>"><br>

    <?php dropdown(); ?> <br>

  <input type="submit" name="btn_wzg" value="Wijzigen">
</form>

  <br><br>

  <a href='bieren.php'>Home</a>

</body>
</html>

<?php
    } else {
        "Geen id opgegeven<br>";
    }
?>
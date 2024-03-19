<?php   
// auteur: Jandro
// functie: algemene functies tbv hergebruik

include_once "config.php";

 function connectDb(){
    $servername = SERVERNAME;
    $username = USERNAME;
    $password = PASSWORD;
    $dbname = DATABASE;
   
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $conn;
    } 
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

 }

 
 function getData($table){
    $conn = connectDb();

    $sql = "SELECT * FROM $table";
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();

    return $result;
 }

 function getBieren($biercode){
    $conn = connectDb();

    $sql = "SELECT * FROM " . CRUD_TABLE . " WHERE biercode = :biercode";
    $query = $conn->prepare($sql);
    $query->execute([':biercode'=>$biercode]);
    $result = $query->fetch();

    return $result;
 }


 function ovzBieren(){

    $result = getData(CRUD_TABLE);

    printTable($result);
    
 }

 
function printTable($result){

    $table = "<table>";

    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th>" . $header . "</th>";   
    }

    foreach ($result as $row) {
        
        $table .= "<tr>";
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";
        }
        $table .= "</tr>";
    }
    $table.= "</table>";

    echo $table;
}


function crudBieren(){

    $txt = "
    <h1>Crud Bieren</h1>
    <nav>
		<a href='insert.php'>Toevoegen nieuwe bieren</a>
    </nav><br>";
    echo $txt;

    $result = getData(CRUD_TABLE);

    printCrudbieren($result);
    
 }

function printCrudbieren($result){
    $table = "<table>";

    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th>" . $header . "</th>";   
    }
    $table .= "<th colspan=2>Actie</th>";
    $table .= "</th>";

    foreach ($result as $row) {
        
        $table .= "<tr>";
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";  
        }
        
        $table .= "<td>
            <form method='post' action='update.php?biercode=$row[biercode]' >       
                <button>Wzg</button>	 
            </form></td>";

        $table .= "<td>
            <form method='post' action='delete.php?biercode=$row[biercode]' >       
                <button>Verwijder</button>	 
            </form></td>";

        $table .= "</tr>";
    }
    $table.= "</table>";

    echo $table;
}


function updatebieren($row){

    $biercode = $_GET['biercode'];

    $conn = connectDb();

    $sql = "UPDATE " . CRUD_TABLE .
    " SET 
        naam = :naam,
        soort = :soort,
        stijl = :stijl,
        alcohol = :alcohol,
        brouwcode = :brouwcode
    WHERE biercode = :biercode
    ";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':naam'=>$_POST['naam'],
        ':soort'=>$_POST['soort'],
        ':stijl'=>$_POST['stijl'],
        ':alcohol'=>$_POST['alcohol'],
        ':brouwcode'=>$_POST['brouwcode'],
        ':biercode'=>$biercode
    ]);

    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;
}

function insertbieren($post){

    $conn = connectDb();

    $sql = "
        INSERT INTO " . CRUD_TABLE . " (naam, soort, stijl, alcohol, brouwcode)
        VALUES (:naam, :soort, :stijl, :alcohol, :brouwcode)
    ";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':naam'=>$_POST['naam'],
        ':soort'=>$_POST['soort'],
        ':stijl'=>$_POST['stijl'],
        ':alcohol'=>$_POST['alcohol'],
        ':brouwcode'=>$_POST['brouwcode'],
    ]);

    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;
}

function dropdown(){
    $result = getData("brouwer");

    $text = "
    Choose a brouwcode:
        <select name='brouwcode' >";

        foreach ($result as $row) {
            $text .= "<option value='echo $row[brouwcode]'>$row[naam]</option>\n";
        }

        $text .= "</select>";

    echo $text;
}

function deletebieren($biercode){

    $conn = connectDb();
    
    $sql = "
    DELETE FROM " . CRUD_TABLE . 
    " WHERE biercode = :biercode";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
    ':biercode'=>$_GET['biercode']
    ]);

    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;
}

?>
<?php
//PDO databázové pripojenie
$host = "localhost";
$dbname = "data";
$port = 3306;
$username = "root";
$password = ""; 
//Možnosti
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
);
// Pripojenie PDO
try {
    $conn = new PDO('mysql:host='.$host.';dbname='.$dbname.";port=".$port, $username,
            $password, $options);
} catch (PDOException $e) {    
    die("Chyba pripojenia: " . $e->getMessage());
}

try {
   
// Dotaz pre získanie otázok
$sql_otazky = "SELECT otazka FROM otazky";

// Príprava dotazu pre otázky..že je otazka pripravena
$stmt_otazky = $conn->prepare($sql_otazky);

// vykoná pripravený dotaz s konkrétnymi hodnotami na databáze pre otázky
$stmt_otazky->execute();

// Získanie otázok
$otazky = $stmt_otazky->fetchAll(PDO::FETCH_COLUMN);

// Dotaz pre získanie odpovedi
$sql_odpovede = "SELECT odpoved FROM odpovede";

// Priprava dotazu pre odpovede..otazaka pripravena
$stmt_odpovede = $conn->prepare($sql_odpovede);

// vykoná pripravený dotaz s konkrétnymi hodnotami na databáze pree odpovede
$stmt_odpovede->execute();

// Získanie odpovedí
$odpovede = $stmt_odpovede->fetchAll(PDO::FETCH_COLUMN);
// Zlúčenie otázok a odpovedí do jednej premennej
$otazky_odpovede = array();

// Prechádzanie cez otázky a priradenie odpovedí
for ($i = 0; $i < count($otazky); $i++) {
    $otazky_odpovede[$otazky[$i]] = $odpovede[$i];
}


    // Výpis výsledkov
  
} catch (PDOException $e) {
    echo "Chyba: " . $e->getMessage();
}
?>


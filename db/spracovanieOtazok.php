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

// Príprava dotazu pre otázky
$stmt_otazky = $conn->prepare($sql_otazky);

// Vykonanie dotazu pre otázky
$stmt_otazky->execute();

// Získanie otázok
$otazky = $stmt_otazky->fetchAll(PDO::FETCH_COLUMN);

// Dotaz pre získaniu odpovedi
$sql_odpovede = "SELECT odpoved FROM odpovede";

// Priprava dotazu pr odpovedi
$stmt_odpovede = $conn->prepare($sql_odpovede);

// Vykonanie dotazu pr odpovede
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


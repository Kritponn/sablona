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
    // SQL dotaz na získanie údajov zo stĺpca otázky
    $sql = "SELECT odpoved FROM odpovede";

    // Príprava dotazu
    $stmt = $conn->prepare($sql);

    // Vykonanie dotazu
    $stmt->execute();

    // Získanie výsledkov
    $odpovede = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Výpis výsledkov
  
} catch (PDOException $e) {
    echo "Chyba: " . $e->getMessage();
}
?>


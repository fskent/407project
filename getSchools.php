<?php

include('connect.txt'); //txt file with connection parameters

try {
    $dsn = "mysql:host=$server;dbname=$dbname;port=$port";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $opt);
} catch(PDOException $e) {
    echo 'DB Connection Failed: ' . $e->getMessage();
    die();
}

$select_schools = "SELECT * FROM schools";


try {
    $stmt = $pdo->prepare($select_schools);
    $stmt->execute();
    $results = $stmt->fetchAll();
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    $pdo->rollback();
    die();
}
echo '<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select School<span class="caret"></span></button>';
echo '<ul class="dropdown-menu">';
foreach ($results as $row) { 
    echo '<li><a href="#">'.$row[university].'</a></li>';
}
echo '</ul>';
//close the connections
$pdo = null;
$stmt = null;
?>
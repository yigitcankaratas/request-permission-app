<?php
// MySQL bağlantı testi
$host = '172.18.0.1';
$db   = 'meritdesk';
$user = 'root';
$pass = 'rootpass';
$port = 3306;

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass);
    echo "Bağlantı başarılı!";
} catch (PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
}
?>

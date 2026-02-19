<?php
        $host = $_ENV['DB_HOST'];
        $dbname = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];

        // Tentative de connexion avec PDO
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        $pdo = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    
        // Requête pour lister les menus
        $stmt = $pdo->prepare("SELECT * FROM menus");
        $stmt->execute();
        $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Convertir en JSON
        header('Content-Type: application/json');
        echo json_encode($menus);
?>
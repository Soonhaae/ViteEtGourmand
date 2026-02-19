<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application PHP + MySQL avec Docker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .card {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .success { color: #28a745; }
        .error { color: #dc3545; }
        h1 { color: #333; }
        pre {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
        }
        .menus-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .menu-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        .menu-card h4 {
            margin-top: 0;
            color: #4CAF50;
        }
        .menu-prix {
            font-weight: bold;
            color: #333;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Vite & Gourmand</h1>
        <h1>🐘 Application PHP + MySQL + Docker</h1>
        <p>Bienvenue dans l'application Vite & Gourmand :)</p>
    </div>

    <div class="card">
        <h2>📋 Informations PHP</h2>
        <pre><?php
        echo "Version PHP: " . phpversion() . "\n";
        echo "Serveur: " . $_SERVER['SERVER_SOFTWARE'] . "\n";
        echo "Extensions MySQL chargées: " . (extension_loaded('mysqli') ? '✓ Oui' : '✗ Non');
        ?></pre>
    </div>

    <div class="card">
        <h2>🗄️ Test de connexion MySQL</h2>
        <?php
        $host = $_ENV['DB_HOST'];
        $dbname = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];

        try {
            // Tentative de connexion avec PDO
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
            $pdo = new PDO($dsn, $user, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            
            echo "<p class='success'>✓ Connexion à MySQL réussie!</p>";
            echo "<pre>";
            echo "Host: $host\n";
            echo "Base de données: $dbname\n";
            echo "Utilisateur: $user\n";
            
            // Affiche la version MySQL
            $version = $pdo->query('SELECT VERSION()')->fetchColumn();
            echo "Version MySQL: $version\n";
            echo "</pre>";

            // Exemple de requête
            $stmt = $pdo->query("SHOW TABLES");
            $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
            
            echo "<h3>Tables dans la base de données:</h3>";
            if (count($tables) > 0) {
                echo "<ul>";
                foreach ($tables as $table) {
                    echo "<li>$table</li>";
                }
                echo "</ul>";
            } else {
                echo "<p><em>Aucune table trouvée. La base est vide.</em></p>";
            }

            // Requête pour lister les menus
            if (in_array('menus', $tables)) {
                echo "<h3>Liste des menus:</h3>";
                $stmt = $pdo->query("SELECT * FROM menus");
                $menus = $stmt->fetchAll();
                
                if (count($menus) > 0) {
                    echo "<div class='menus-container'>";
                    
                    foreach ($menus as $menu) {
                        echo "<div class='menu-card'>";
                        echo "<h4>" . htmlspecialchars($menu['titre']) . "</h4>";
                        echo "<p>" . htmlspecialchars($menu['description']) . "</p>";
                        echo "<p class='menu-prix'>" . htmlspecialchars($menu['prix_base']) . " €</p>";
                        echo "</div>";
                    }
                    
                    echo "</div>";
                } else {
                    echo "<p><em>Aucun menu trouvé.</em></p>";
                }
            }

        } catch (PDOException $e) {
            echo "<p class='error'>✗ Erreur de connexion à MySQL:</p>";
            echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
        }
        ?>
    </div>

</body>
<script>
    console.log('Page chargée!');
    
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM prêt');
    });

    fetch('getmenus.php')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            // Utiliser data ici
        })
        .catch(error => console.error('Erreur:', error));
</script>
</html>

<?php

echo 'running test.php';

include 'autoload.php';

try {
    // Set up DSN (Data Source Name)
    $dsn = 'mysql:host='.$config['db_host'].';dbname='.$config['db_database'];

    // Create a PDO instance
    $pdo = new PDO($dsn, $config['db_user'], $config['db_pass']);

    // Set PDO attributes
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); // Fetch mode to objects

    echo 'Database connection successful.';
} catch (PDOException $e) {
    // Handle connection error
    echo 'Database connection failed: '.$e->getMessage();
}

// Test the connection and query function
try {
    // Example test query (modify according to your database schema)
    $stmt = $pdo->query('SELECT * FROM todos LIMIT 1');
    $results = $stmt->fetchAll();

    if ($results) {
        echo '<pre>';
        print_r($results);
        echo '</pre>';
    } else {
        echo 'No results found or query failed.';
    }
} catch (Exception $e) {
    echo 'Error: '.$e->getMessage();
}

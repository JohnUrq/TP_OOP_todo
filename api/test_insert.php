<?php

// Include your database connection file here
include 'autoload.php';

try {
    // Example data to insert (modify according to your database schema)
    $todoTitle = 'Test Todo Item';

    // Prepare the insert statement
    $stmt = $pdo->prepare('INSERT INTO todo_lists (title) VALUES (:title)');

    // Bind parameters
    $stmt->bindParam(':title', $todoTitle);

    // Execute the insert statement
    if ($stmt->execute()) {
        echo 'Data successfully inserted.<br>';

        // Retrieve the last inserted ID
        $lastInsertId = $pdo->lastInsertId();

        // Fetch the inserted data to verify
        $stmt = $pdo->prepare('SELECT * FROM todo_lists WHERE id = :id');
        $stmt->bindParam(':id', $lastInsertId);
        $stmt->execute();

        $result = $stmt->fetch();

        if ($result) {
            echo '<pre>';
            print_r($result);
            echo '</pre>';
        } else {
            echo 'Failed to fetch the inserted data.';
        }
    } else {
        echo 'Failed to insert data.';
    }
} catch (Exception $e) {
    echo 'Error: '.$e->getMessage();
}

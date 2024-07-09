<?php

$dsn = 'mysql:host='.$config['db_host'].';dbname='.$config['db_database'];
$pdo = new PDO($dsn, $config['db_user'], $config['db_pass']);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

// create query function as a helper fn to find records and things like that.
function query($sql, $params = [])
{
    global $pdo;
    // debug($sql);
    // debug($params);

    // example $sql
    // $sql = 'INSERT INTO users(name, email, status) VALUES(:name, :email, :status)';
    // example $params
    // ['name'=> $name, 'email' => $email, 'status' => $status]
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    // use strtok to get first word of query eg insert or select or update
    $query_type = strtok($sql, ' ');

    // debug($stmt);
    switch ($query_type) {
        case 'INSERT':
            return $pdo->lastInsertId();

            break;

        case 'SELECT':
            return $stmt->fetchAll();

            break;

        case 'UPDATE':
        case 'DELETE':
            return true;

            break;
    }

    return $pdo;
}

function debug($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';

    exit('Debug function complete.');
}
